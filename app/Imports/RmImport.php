<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Illuminate\Support\Facades\Validator;
use App\Models\Rm_cost;
use App\Models\User;
use App\Models\Basic;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithMapping;
use DB;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class RmImport implements ToCollection, WithHeadingRow,SkipsEmptyRows
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

         Validator::make($rows->toArray(), [
                '*.sapcode' => 'required_if:*.ingredient,null', // 'sapcode' is required if 'ingredient' is null
                '*.ingredients' => 'required_if:*.sapcode,null', // 'ingredient' is required if 'sapcode' is null
                '*.rate' => 'nullable|numeric',
                '*.qty' => 'numeric',
                '*.scrap' => 'nullable|numeric',
         ])->validate();
        $sapcode=[];
        $ingredient=[];
        $rate=[];
        $scrap=[];
        $scrapcost=[];

        foreach ($rows as $row) {
            $sapcode[]=$row['sapcode'];
            $scrap[]=$row['scrap'];

            // $row['scrap'] = $authuser;
            if($row['scrap']!=''){
                $authuser=auth()->user()->id;
                $scrapcost[]=$row['scrap'];
            }else{
                $authuser=0;
                $scrapcost[]=0;
            }
            if($row['sapcode']!=''){
                $ing=null;
                $rates= null;
                $ingredient[]=null;
                $rate[]=null;
            }else{
                $ing=$row['ingredients'];
                $rates=$row['rate'];
                $ingredient[]=$row['ingredients'];
                $rate[]=$row['rate'];
            }
            $inscrap = round($row['qty']*(1+$row['scrap']),2);
            $mcost =  round($inscrap * $rates ,2);
            $inscrap1[]= $row['qty']*(1+$row['scrap']);
            $mcost1[]= $inscrap * $rates;
            Rm_cost::create([
                'b_id' => $this->request->pid1,
                'sapcode' => $row['sapcode'],
                'Ingredient'=>$ing,
                'rate' =>$rates,
                'qty' => $row['qty'],
                'scrap' => $row['scrap'],
                'scrap_user' => $authuser,
                'inscrap' => $inscrap,
                'mcost' =>  $mcost,
                'rm_user'=>auth()->user()->id,
                'Product_id' =>$this->request->pro_id1,
                'Product_name' => $this->request->pname1,
            ]);

        }
        if(in_array(null,$rate)){
            $nonEmptyValues = array_filter($sapcode);
            $allPositive = true;
            foreach ($rate as $value) {
                if ($value <= 0) {
                    $allPositive = false;
                    break;
                }
            }
            
            if (!empty($nonEmptyValues) ) {
            $this->importmessage="Data sent to Operation Team";
            }else{
                if($allPositive){
                  $this->importmessage="Data sent to  Operation Team";
                }else{
                  $this->importmessage="Data sent to  Purchase Team"; 
                }

            }
            Basic::where('id', $this->request->pid1)->update(['status' => 2,'specific_gravity'=>$this->request->spec_grav]);
        }else if(in_array(null,$scrap)){
            $this->importmessage="Data sent to Operation Team";
            Basic::where('id', $this->request->pid1)->update(['status' => 3,'specific_gravity'=>$this->request->spec_grav]);

        }else{
            $this->importmessage="Data sent to Operation Team";
            Basic::where('id', $this->request->pid1)->update(['status' => 3,'specific_gravity'=>$this->request->spec_grav]);
        }
        $rmcost= Rm_cost::where('b_id',$this->request->pid1)->whereNull('scrap')->orwhereNull('rate')->where('b_id',$this->request->pid1)->get();
        if($rmcost->count()==0){
            $ratessum=array_sum($mcost1);
            $scrapcos=array_sum($inscrap1);

            $basictable = Basic::find($this->request->pid1);
            $totalrm_cost =   round($basictable->specific_gravity * $ratessum / $scrapcos ,2);
            
            $basictable->total_rm_cost = $totalrm_cost ;
              
            $basictable->save();
        }
        $nonEmptyValues = array_filter($sapcode);
        $products=Basic::find($this->request->pid1);
            if (!empty($nonEmptyValues)) {
                $users=User::where("multirole",'LIKE', "%operations%")->get();
                // $users=User::whereIn("role",['operations'])->get();
                foreach($users as $user){
                    $data = array([
                        'product_name'=> $products->Product_name,
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
                $users=User::where("multirole",'LIKE', "%RM Purchase%")->get();
                // $users=User::whereIn("role",['RM Purchase'])->get();
                foreach($users as $user){
                    $data = array([
                        'product_name'=> $products->Product_name,
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


    }


}
