<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Illuminate\Support\Facades\Validator;
use App\Models\Product_Material;
use App\Models\Basic;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithMapping;
use DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
class PmImport implements ToCollection, WithHeadingRow,SkipsEmptyRows
{
    /**
    * @param Collection $collection
    */

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function collection(Collection $rows)
    {

         $authuser=auth()->user()->id;
         $date=date('Y-m-d H:i:s');
         Validator::make($rows->toArray(), [
                '*.pm' => 'required', // 'sapcode' is required if 'ingredient' is null
                '*.pm_details' => 'required', // 'ingredient' is required if 'sapcode' is null
                '*.pm_specification' => 'required',
                '*.qty' => 'required|numeric',
                '*.uom' => 'required',
                '*.scrap' => 'nullable|numeric',
         ])->validate();
         $basic   = Basic::where('id', $this->request->pro_id1)->first();
         $scrap=[];
        foreach ($rows as $row) {
            if( $row['scrap']!=''){
                $authuser1=auth()->user()->id;
            }else{
                $authuser1=0;
            }
            $scrap[]=$row['scrap'];
            Product_Material::create([
                'product_id'=>$basic->pro_id,
                'material' =>$row['pm'],
                'product_details' => $row['pm_details'],
                'specification' => $row['pm_specification'],
                'quantity' => $row['qty'],
                'scrap' => $row['scrap'],
                'uom' => $row['uom'],
                'package_user' => $authuser ,
                'package_date' => $date,
                'scrap_user'=>$authuser1
             ]);
        }
        Basic::where('id',$this->request->pro_id1)->update(['product_status'=>1]);
        if(in_array(null,$scrap)){
            $users=User::where("multirole",'LIKE', "%operations%")->get();
            // $users=User::whereIn("role",['operations'])->get();
            foreach($users as $user){
                $data = array([
                    'product_name'=> $basic->Product_name,
                    'user_name'=>$user->name,
                    'initiater_name'=>auth()->user()->name,
                    'date'=>date('d.m.Y'),
                    'duedate'=> date('d.m.Y', strtotime("+1 days")),

                ]);
                Mail::send('emails.myemail', $data[0], function($message) use($user) {
                    $message->to('mariaarul@cavinkare.com')->subject("NPD Cost Sheet Assigned");
                    // $message->to($user->email)->subject("NPD Cost Sheet Assigned");

                });
            }
        }else{
            // $users=User::whereIn("role",['PM Purchase'])->get();
            $users=User::where("multirole",'LIKE', "%PM Purchase%")->get();
            foreach($users as $user){
                $data = array([
                    'product_name'=> $basic->Product_name,
                    'user_name'=>$user->name,
                    'initiater_name'=>auth()->user()->name,
                    'date'=>date('d.m.Y'),
                    'duedate'=> date('d.m.Y', strtotime("+1 days")),

                ]);
                Mail::send('emails.myemail', $data[0], function($message) use($user) {
                    $message->to('mariaarul@cavinkare.com')->subject("NPD Cost Sheet Assigned");
                    // $message->to($user->email)->subject("NPD Cost Sheet Assigned");

                });
            }
        }
        return response()->json([
            'status' =>"success"
        ]);
    }


}
