<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Basic;
use App\Models\Rm_cost;
use App\Models\Division;
use App\Models\Plant;
use App\Models\Product_Material;
use App\Mail\email;
use Illuminate\Support\Facades\Mail;
use DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportUser;
use App\Imports\PlantImport;
use App\Imports\RmImport;
use App\Exports\ExportUser;
use DataTables;
use Auth;
use Validator;

class CostController extends Controller
{

    public function edit(Request $request)
    {
        $id = $request->input('id');
        $data['basic'] = Basic::where('id', $id)->first();

        if($data['basic']){
            $chwe = $data['basic']->pro_id;
            $data['get_rm_cost'] = Rm_cost::where('Product_id',$chwe)->get();
            $data['count'] = count($data['get_rm_cost']);
        }
        //  print_r($user);
        echo json_encode($data);
    }

    public function save_rmcost(Request $request)
    {

        $Pro_id  = $request->input('pro_id');
        $basic = Basic::where('pro_id',$Pro_id)
        ->orderby('id','desc')->first();

        $Ingredient = $request->input('Ingredient');
        $Cost = $request->input('Cost');
        $Rate = $request->input('Rate');
        $rate=[];
        $scrap=[];
        foreach ($Ingredient as $val => $ing) {
            $rate[]=$request->input('Rate')[$val];
            $Product_id  = $request->input('Product_id');
            $p_name = $request->input('p_name');
            if($request->input('scrap')[$val]!=''){
                $userid=auth()->user()->id;
                $scrap[]=$request->input('scrap')[$val];
            }else{
                $userid=0;
                $scrap[]=0;
            }
            Rm_cost::create([
                'b_id' => $basic->id,
                'Product_id' => $Pro_id,
                'Product_name' => $p_name,
                'Ingredient' => $request->input('Ingredient')[$val],
                'rate' => $request->input('Rate')[$val],
                'scrap' => $request->input('scrap')[$val],
                'inscrap' => $request->input('inscrap')[$val],
                'mcost' => $request->input('mcost')[$val],
                'sapcode'=>$request->sapcode[$val],
                'scrap_user' =>  $userid,
                'rm_user'=>auth()->user()->id,
                'qty' => !empty($request->input('Cost')[$val]) ? $request->input('Cost')[$val] : null,
            ]);
            }
            $status = '2';
            $costval = Basic::where('id', $Product_id)->update(['status' => $status,'specific_gravity'=>$request->specific_gravity]);
            $nonEmptyValues = array_filter($request->sapcode);

            if (!empty($nonEmptyValues)) {
                $users=User::where("multirole",'LIKE', "%operations%")->get();
                foreach($users as $user){
                    $data = array([
                        'product_name'=> $p_name,
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
                return response()->json([
                    "status" => "success",
                    "message"=>"Data Sent To Operation Team"
                 ]);
            }else{
                $users=User::where("multirole",'LIKE', "%RM Purchase%")->get();
                // $users=User::whereIn("role",['RM Purchase'])->get();
                foreach($users as $user){
                    $data = array([
                        'product_name'=> $p_name,
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
                return response()->json([
                    "status" => "success",
                    "message"=>"Data Sent To Purchase Team"
                 ]);
            }


    }

    public function send_operation_team(Request $request)
    {
        $Pro_id  = $request->input('pro_id');
        $get_last_version = Basic::where('pro_id',$Pro_id)->orderby('id','desc')->first();

        $Ingredient = $request->input('Ingredient');
        $Product_id  = $request->input('Product_id');
        $rate=[];
        foreach ($Ingredient as $val => $ing) {
            $p_name  = $request->input('p_name');
            if($request->input('scrap')[$val]!=''){
                $user=auth()->user()->id;
                $scrap[]=$request->input('scrap')[$val];
            }else{
                $user=0;
                $scrap[]=0;
            }
            $rate[]=$request->input('Rate')[$val];
            Rm_cost::create([
                // 'version' => $cnew_version,
                'b_id' => $get_last_version->id,
                'Product_id' => $Pro_id,
                'Product_name' => $p_name,
                'sapcode'=>$request->sapcode[$val],
                'Ingredient' => $request->input('Ingredient')[$val],
                'rate' => $request->input('Rate')[$val],
                'inscrap' => $request->input('inscrap')[$val],
                'mcost' => $request->input('mcost')[$val],
                'qty' => $request->input('Cost')[$val],
                'scrap' => $request->input('scrap')[$val],
                'scrap_user'=>$user,
                'rm_user'=>auth()->user()->id,
            ]);
        }
        $status = '3';
        $costval = Basic::where('id', $Product_id)->update(['status' => $status,'specific_gravity'=>$request->specific_gravity]);
        $rmcost= Rm_cost::where('b_id',$get_last_version->id)->whereNull('scrap')->orwhereNull('rate')->where('b_id',$get_last_version->id)->get();
        if($rmcost->count()==0){
            $ratessum=array_sum($request->input('mcost'));
            $scrapcos=array_sum($request->input('inscrap'));
            $basictable = Basic::find($get_last_version->id);
            $totalrm_cost =   round($basictable->specific_gravity * ($ratessum / $scrapcos),2);
            $basictable->total_rm_cost = round($totalrm_cost,2);
            $basictable->save();
        }
        // $users=User::whereIn("role",['operations'])->get();
          $users=User::where("multirole",'LIKE', "%operations%")->get();
            foreach($users as $user){
                $data = array([
                    'product_name'=> $p_name,
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

    public function bulkupload_rm(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'excel_upload' => 'required|mimes:xls,xlsx,csv',
        ]);
        if($validator->errors()->count() > 0){
            return response()->json([
            "status" =>$validator->errors()
        ]);
        }
        $import = new RmImport($request);

        // dd($validator->errors());
        Excel::import($import,request()->file('excel_upload'));
        // DB::commit();

        return response()->json([
            "status" => "success",
            "message"=>$import->importmessage
         ]);
    }
    public function show_pending()
    {
        // $data = Basic::where('status', '3')->get();
        $table = array();
        $i = 1;
        $data = Basic::join('rm_costs','basics.pro_id','=','rm_costs.product_id')
        ->whereNull('rm_costs.scrap')
        ->select('rm_costs.product_id as basic_id','rm_costs.id','rm_costs.scrap','basics.Product_name')->get()->toArray();
        $id = [];
        foreach ($data as $key => $value) {
            $id[] = $data[$key]['basic_id'];
        }
        $val = Basic::whereIn('pro_id',$id)->whereIn('status', ['3'])->select('*')->get();
        // $val = Basic::whereIn('pro_id',$id)->whereIn('status', ['2','3'])->select('*')->get();

        foreach ($val as $row) {
            $table1 = array();
            $table1['Product_Name'] = $row->Product_name;
            $table1['Fill_Volume'] = $row->Volume;
            $table1['Cofiguration'] = $row->case_configuration;
            $table1['Quantity'] = $row->quantity;
            // $table1['version'] = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
            if ($row->status == 2) {
                $table1['status'] = '<span class="badge bg-warning text-dark">purchase team in progress</span>';
            } else {
                $table1['status'] = '<span class="badge bg-secondary text-dark">Operation team in progress</span>';
            }
            $table1['Action'] = '<button type="button" class="btn btn-success btn-sm" id="rmview" data-bs-toggle="modal" data-bs-target="#rmviewmodel" onclick="editshow(' . $row->id . ')">RM View</button>
                ';

            $table[] = $table1;
            $i++;
        }
        $response = array(
        "data" => $table
        );
        echo json_encode($response);

    }
    public function show_rmviewpurchase()
    {
        $data = Basic::where('status', '2')->orderBy('id','desc')->get();
        $table = array();
        $i = 1;
        foreach ($data as $row) {
        $table1 = array();
        $table1['Product_Name'] = $row->Product_name;
        $table1['Fill_Volume'] = $row->Volume;
        $table1['Cofiguration'] = $row->case_configuration;
        $table1['Quantity'] = $row->quantity;
        if($row->division !=null){
                $divisioname = Division::find($row->division);
                $division =$divisioname->division;
        }else{
                $division ="--";
        }
        $table1['division'] = $division;
        if ($row->status == 1) {
            $table1['status'] = '<span class="badge bg-warning text-dark">purchse team in progress</span>';
        } else {
            $table1['status'] = '<span class="badge bg-warning text-dark">Operation team in progress</span>';
        }

        $table1['Action1'] = '<button type="button" class="btn btn-success btn-sm"  id="rmcost" onclick="edit_cost('.$row->id.')">Add Rate</button>';
        $table[] = $table1;
        $i++;
        }
        $response = array(
        "data" => $table
        );
        echo json_encode($response);
    }

    public function get_Ingredients(Request $request)
    {
        $id = $request->input('id');
        $data = Rm_cost::where('Product_id', $id)->get();


        $table = array();
        $i = 1;
        foreach ($data as $row) {
        $table1 = array();
        $table1['Ingredients'] = $row->Ingredient;
        $table1['rate'] = $row->rate;
        $table1['cost'] = $row->cost;
        $table1['Scrap'] = $row->scrap;
        $table1['inscrap'] = $row->inscrap;
        $table1['mcost'] = $row->mcost;
        $table[] = $table1;
        $i++;
        }
        $response = array(
        "data" => $table
        );
        echo json_encode($response);
    }

    public function editcost(Request $request)
    {
        $bid = $request->input('id');
        $get_pro = Basic::where('id',$bid)->first();

        $data = Rm_cost::where('Product_id', $get_pro->pro_id)->get();
        if ($data) {
            $count = count($data);
            $id = array();
            $Product_id = array();
            $Ingredient = array();
            $rate = array();
            $qty = array();
            $scrap = array();
            $scrap_user = array();
            $sapcode = array();
            $rm_user = array();
            $plant;
            foreach ($data as $val) {
                $id[] = $val->id;
                $Product_id[] = $val->Product_id;
                $Ingredient[] = $val->Ingredient;
                $scrap[] = $val->scrap;
                $scrap_user[] = $val->scrap_user;
                $sapcode[] = $val->sapcode;
                $rm_user[] = $val->rm_user;
                // $scrap[]                  = $val->sro;
                if( $val->sapcode!=null){

                  if($get_pro->plant == null){
                    $res['status'] = "error";
                    return response($res);
                  }else{
                    $basic_plant=Plant::find($get_pro->plant);
                    $plant= $basic_plant->name;
                  }
                }else{
                    $plant="";
                }
                if ($val->rate == null) {
                    $rate[] = '';
                } else {
                    $rate[]  = $val->rate;
                }

                if ($val->qty == null) {
                    $qty[] = '-';
                } else {
                    $qty[]  = $val->qty;
                }
            }
        } else {
            $count      = '';
            $id         = '';
            $Product_id = '';
            $Ingredient = '';
            $scrap   = '';
            $scrap_user='';
            $rate       = '';
            $qty       = '';
            $plant       = '';
            $sapcode='';
            $rm_user='';
        }
        $res['bid'] = $bid;
        $res['count'] = $count;
        $res['id'] = $id;
        $res['Product_id'] = $Product_id;
        $res['rate'] = $rate;
        $res['qty'] = $qty;
        $res['scrap'] = $scrap;
        $res['Ingredient'] = $Ingredient;
        $res['scrap_user'] = $scrap_user;
        $res['sapcode'] = $sapcode;
        $res['plant'] = $plant;
        $res['rm_user'] = $rm_user;
        $res['status'] = "success";
        return response($res);
    }

    public function update_cost(Request $request)
    {
        $bid                    = $request->input('editbid');
        $Product_id             = $request->input('editProduct_id');
        $auth_user=auth()->user()->id;
        $get_last_version = Basic::where('pro_id',$Product_id)->orderby('id','desc')->first();
        // if($get_last_version){
        //     $cnew_version = $get_last_version->version;
        // }else{
        //     $cnew_version = 'V1.0';
        // }
        $p_name                 = $request->input('editp_name');
        $Ingredient             = $request->input('editIngredient');
        $scrapcost=[];

        if ($Ingredient != "") {
            $datss=DB::table('rm_costs')->where('Product_id', $Product_id)->get();
            foreach ($Ingredient as $val => $Ingredient) {
                if($request->input('scrap_user')[$val]!=''){
                    $scp=$request->input('scrap_user')[$val];
                }else{
                    $scp=0;
                }
                if($request->input('scrap')[$val]==='null'){
                    $scpval=null;
                }else{
                    $scpval=$request->input('scrap')[$val];
                    
                }
                $scrapcost[]=round($request->input('editcostval')[$val] *(1+$request->input('scrap')[$val]) ,2);
                $scrapcostval=round($request->input('editcostval')[$val] *(1+$request->input('scrap')[$val]) ,2);
                $ratescost[]=round($scrapcostval * $request->input('editRate')[$val],2);
                
                $inscrap=Rm_cost::where('id',$datss[$val]->id)->first();
                $inscrap_val=$inscrap->inscrap;

                
                $rm =Rm_cost::where('id',$datss[$val]->id)->update([
                    // 'version'       => $cnew_version,
                    'b_id'          => $get_last_version->id,
                    // 'Product_id'    => $Product_id,
                    // 'Product_name'  => $p_name,
                    'Ingredient'    => $request->input('editIngredient')[$val],
                    'sapcode'    => $request->input('sapcode')[$val],
                    'rate'          => $request->input('editRate')[$val],
                    'qty'           => $request->input('editcostval')[$val],
                    'scrap'          =>  $scpval,
                    'scrap_user'     => $request->input('scrap_user')[$val],
                    'rm_user'=> $request->input('rm_user')[$val],
                    'purchase_user'     =>$auth_user,
                    'mcost'=>$inscrap_val*$request->input('editRate')[$val],
                ]);
            }
        }
        $status = '3';
       $rates= array_sum($ratescost);
       $scrapcos= array_sum($scrapcost);
       if(!in_array(null,$request->input('scrap'))){
        $basictable = Basic::find($bid);
        // dd($basictable->specific_gravity, $rates,$scrapcos);
         $totalrm_cost =  round($basictable->specific_gravity * $rates / $scrapcos ,2);
       
        // dd($basictable->specific_gravity, $rates,$scrapcos,$totalrm_cost );
        $basictable->total_rm_cost= $totalrm_cost ;
        $basictable->save();
       }
       $costval = Basic::where('id', $bid)->update(['status' => $status]);
       $nonEmptyValues = array_filter($request->input('sapcode'));
            if (!empty($nonEmptyValues)) {
                $products = Basic::find($get_last_version->id);
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

            }
        
    }

    public function get_RMopration(Request $request)
    {
        $user=auth()->user()->id;
        if(isset($request->rej)){
            $data = Basic::join('rm_costs','basics.pro_id','=','rm_costs.product_id')
            ->where('rm_costs.Ingredient','!=',null)->where('rm_costs.scrap_user', $user)->where('p_scrap_approval',2)
            ->select('basics.*','rm_costs.p_scrap_approval','rm_costs.scrap','basics.plant')
             ->where('basics.status', '3')->groupBy('rm_costs.product_id')->orderBy('id', 'desc')
            ->get();
        }else if(isset($request->app)){
            $data = Basic::join('rm_costs','basics.pro_id','=','rm_costs.product_id')->where('rm_costs.scrap_user', $user)->where('p_scrap_approval',1)
            ->where('rm_costs.Ingredient','!=',null) ->where('basics.status', '3')
            ->select('basics.*','rm_costs.p_scrap_approval','rm_costs.scrap','basics.plant')->groupBy('rm_costs.product_id')->orderBy('id', 'desc')
            ->get();
        }
        else{
            $data = Basic::join('rm_costs','basics.pro_id','=','rm_costs.product_id')
            ->where('rm_costs.p_scrap_approval',0)
            ->whereIn('basics.status', [2,3])
            ->select('basics.*','rm_costs.p_scrap_approval','rm_costs.scrap','basics.plant')->groupBy('rm_costs.product_id')->orderBy('id', 'desc')
            ->get();
        // $data = Basic::select('*')
        // ->where('status', '3')
        // ->orderby('id', 'desc')
        // ->get();
        }


        $table = array();
        $i = 1;
        foreach ($data as $row) {

            $table1 = array();
            $table1['Product_Name'] = $row->Product_name;
            $table1['Fill_Volume'] = $row->Volume.''.$row->uom;
            $table1['Cofiguration'] = $row->case_configuration;
            $table1['Quantity'] = $row->quantity;
            if(isset($request->rej)){
                $table1['Action1']='<button type="button" class="btn btn-primary btn-sm" id ="add_scrap" onclick="scrapmodal('.$row->id.',2)">Update Scrap</button>';

            }else if(isset($request->app)){
                $table1['Action1']='<button type="button" class="btn btn-primary btn-sm" id ="add_scrap" onclick="scrapmodal('.$row->id.',3)">View Scrap</button>';

            }
            else{
                $rm_cost=Rm_cost::where('b_id',$row->id)->get();
                $sapcode=[];
                foreach($rm_cost as $rmcost){
                    if($rmcost->scrap== null && $rmcost->Ingredient!=null){
                        // dd();
                        // if($rmcost->Ingredient!=null){
                            // print_r($rmcost->Ingredient);
                        $table1['Action1']='<button type="button" class="btn btn-primary btn-sm" id ="add_scrap"` onclick="scrapmodal('.$row->id.',1)" >Add Scrap</button>';
                        break;

                    }else if($rmcost->scrap!= null && $rmcost->Ingredient!=null ){
                        $table1['Action1']='<button type="button" class="btn btn-secondary btn-sm" id ="add_scrap" onclick="scrapmodal('.$row->id.',1)" >View Scrap</button>';

                    }
                        else{
                    $table1['Action1']='<button type="button" class="btn btn-primary btn-sm" id ="add_scrap"` onclick="scrapmodal('.$row->id.',1)" hidden>Add Scrap</button>';
                    break;
                    }
                }
                foreach($rm_cost as $rmcost){
                    $sapcode[]=$rmcost->sapcode;
                }
                foreach ($sapcode as $value) {
                    if ($value !== null) {
                        $hasNonNullValue = true;
                        break; // Exit the loop as soon as a non-null value is found
                    }else{
                        $hasNonNullValue = false;
                    }
                }
                if($row->plant==null && $hasNonNullValue){
                    $table1['Action1'].='<button type="button" class="btn btn-success btn-sm mx-1" id ="add_scrap" onclick="plantmodal('.$row->id.',0)">Add Plant</button>';

                }else if($row->plant!=null){
                    $table1['Action1'].='<button type="button" class="btn btn-secondary btn-sm mx-1" id ="add_scrap" onclick="plantmodal('.$row->id.','.$row->plant.')">View Plant</button>';
                }
            }
                if($row->division !=null){
                $divisioname = Division::find($row->division);
                $division =$divisioname->division;
                }else{
                    $division ="--";
                }
              $table1['division']= $division;
            $table1['remarks'] = '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Edit" class="px-2 text-primary" "> <i class="fa fa-eye"  onclick="open_remarks1('.$row->id.')"></i></a>';
            $table[] = $table1;
            $i++;
        }
        $response = array(
        "data" => $table
        );
        echo json_encode($response);
    }

    public function get_RMcost(Request $request)
    {
        $data = Basic::join('rm_costs','rm_costs.product_id','=','basics.pro_id')
        ->where('rm_costs.Ingredient','!=',null)
        ->select('basics.*')
        ->groupBy('rm_costs.product_id')->orderby('id','desc')->get();
        $table = array();
        $i = 1;
        foreach ($data as $row) {
        $table1 = array();
        $table1['Product_Name'] = $row->Product_name;
        $table1['Fill_Volume'] = $row->Volume.''.$row->uom;
        $table1['Cofiguration'] = $row->case_configuration;
        $table1['Quantity'] = $row->quantity;
         if($row->division !=null){
            $divisioname = Division::find($row->division);
            $division =$divisioname->division;
            }else{
                $division ="--";
            }
        $table1['division'] = $division;
        $table1['version'] = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
        // $table1['Action1']='<button type="button" class="btn btn-primary btn-sm" onclick="bf_approve('.$row->id.')"><i class="bx bx-check icon nav-icon"></i></button>';
        $table1['Action1']='<button type="button" class="btn btn-primary btn-sm" onclick="rmcost_show('.$row->id.')"><i class="bx bx-show icon nav-icon"></i></button>';

        $table[] = $table1;
        $i++;
        }
        $response = array(
        "data" => $table
        );
        echo json_encode($response);
    }


    public function add_scrap(Request $request)
    {
        $p_name  = $request->input('p_name');
        $user=auth()->user()->id;
        $i=0;
        foreach($request->id_val as $id){
            if($request->stat==2){
            Rm_cost::find($id)->update(['scrap' => $request->scrap_name[$i],
            'inscrap'=> $request->inscrap_name[$i],
            'mcost'=> $request->mcost_name[$i],
            'scrap_user'=>$user,
            'p_scrap_approval'=>0]);
            }else{
                Rm_cost::find($id)->update(['scrap' => $request->scrap_name[$i], 'inscrap'=> $request->inscrap_name[$i],
               'mcost'=> $request->mcost_name[$i],'scrap_user'=>$user]);

            }
            $i++;
        }

        $rmcost= Rm_cost::where('b_id',$request->b_id[0])->whereNull('scrap')->orwhereNull('rate')->where('b_id',$request->b_id[0])->get();
        $rmcost_rates= Rm_cost::where('b_id',$request->b_id[0])->get();
        $scrap=array();
        $rates1=array();
        foreach($rmcost_rates as $rmcosts ){
        $scrap[]=$rmcosts->scrap/100;
        $rates1[]=$rmcosts->rate;
        }
        // dd($rmcost->count());
        if($rmcost->count()==0){
            $rates=array_sum($request->mcost_name);
            $scrapcos=array_sum($request->inscrap_name);

            $basictable = Basic::find($request->b_id[0]);
            $totalrm_cost = round(($basictable->specific_gravity * $rates)/$scrapcos ,2);

            $basictable->total_rm_cost= $totalrm_cost ;
            $basictable->save();
        }
        return response()->json([
            'status' => 'success'
        ]);

    }

    public function get_RMscrap(Request $request)
    {
        $data = Basic::join('rm_costs','basics.pro_id','=','rm_costs.product_id')
        ->where('rm_costs.scrap','!=',null)
        ->select('rm_costs.product_id as basic_id','rm_costs.id','rm_costs.scrap','basics.Product_name')->get()->toArray();
        $id = [];
        foreach ($data as $key => $value) {
            $id[] = $data[$key]['basic_id'];
        }
        $val = Basic::whereIn('pro_id',$id)
        ->select('*')->orderby('id','desc')->get();

        $table = array();
        $i = 1;
        foreach ($val as $row) {
        $table1 = array();
        $table1['Product_Name'] = $row->Product_name;
        $table1['Fill_Volume'] = $row->Volume.' '.$row->uom;
        $table1['Cofiguration'] = $row->case_configuration;
        $table1['Quantity'] = $row->quantity;
        $table1['version'] = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
        // $table1['Action1']='<button type="button" class="btn btn-primary btn-sm" onclick="bf_approve('.$row->id.')"><i class="bx bx-check icon nav-icon"></i></button>';
        $table1['Action1']='<button type="button" class="btn btn-primary btn-sm" onclick="rmscrap_show('.$row->id.')"><i class="bx bx-show icon nav-icon"></i></button>';
        if($row->division !=null){
            $divisioname = Division::find($row->division);
            $division =$divisioname->division;
            }else{
                $division ="--";
            }
        $table1['division']= $division;
        $table[] = $table1;
        $i++;
        }
        $response = array(
        "data" => $table
        );
        echo json_encode($response);
    }


    public function get_PMscrap(Request $request)
    {
        $data = Basic::join('product__materials','basics.pro_id','=','product__materials.product_id')
        ->where('product__materials.scrap','!=',null)
        ->select('product__materials.product_id as basic_id','product__materials.id','product__materials.scrap','basics.Product_name')->get()->toArray();
        $id = [];
        foreach ($data as $key => $value) {
            $id[] = $data[$key]['basic_id'];
        }
        $val = Basic::whereIn('pro_id',$id)
        ->select('*')->orderby('id','desc')->get();

        $table = array();
        $i = 1;
        foreach ($val as $row) {
        $table1 = array();
        $table1['Product_Name'] = $row->Product_name;
        $table1['Fill_Volume'] = $row->Volume.''.$row->uom;
        $table1['Cofiguration'] = $row->case_configuration;
        $table1['Quantity'] = $row->quantity;
        if($row->division !=null){
            $divisioname = Division::find($row->division);
            $division =$divisioname->division;
            }else{
                $division ="--";
            }
        $table1['division'] =  $division;
        $table1['version'] = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
        // $table1['Action1']='<button type="button" class="btn btn-primary btn-sm" onclick="bf_approve('.$row->id.')"><i class="bx bx-check icon nav-icon"></i></button>';
        $table1['Action1']='<button type="button" class="btn btn-primary btn-sm" onclick="pmscrap_show('.$row->id.')"><i class="bx bx-show icon nav-icon"></i></button>';

        $table[] = $table1;
        $i++;
        }
        $response = array(
        "data" => $table
        );
        echo json_encode($response);
    }


    public function get_ccost()
    {
        $data = Basic::select('*')
        ->where('conv_cost','!=',null)
        ->orderby('id','desc')->get()->unique('pro_id');

        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('volume', function($row){
            $btn  = $row->Volume.' '.$row->uom;
            return $btn;
        })
        ->addColumn('conv_cost', function($row){
            $btn  = $row->conv_cost.' ('.$row->conv_uom .' )';
            return $btn;
        })
        ->addColumn('division', function($row){
                if($row->division !=null){
                $divisioname = Division::find($row->division);
                $division =$divisioname->division;
                }else{
                    $division ="--";
                }
                return $division;
             })
        // ->addColumn('action', function($row){
        //     $btn  = '<button type="button" class="btn btn-primary btn-sm" onclick="bf_approve('.$row->id.')"><i class="bx bx-check icon nav-icon"></i></button>';
        //     return $btn;
        // })'action',
        ->rawColumns(['conv_cost','volume','division'])
        ->make();

    }

    public function getIngredient(Request $request)
    {
        $user=auth()->user()->id;
        $bid = $request->prd_id;
        $basic = Basic::where('id', $bid)->first();
        if($request->stat == 2||$request->stat == 3){
            $data =Rm_cost::where('Product_id',$basic->pro_id)->where('scrap_user', $user)->get();
        }else{
             $data =Rm_cost::where('Product_id',$basic->pro_id)->get();

        }

        $table = array();
        $i = 1;
        foreach ($data as $row) {
        $table1 = array();
        $table1['Ingredients'] = $row->Ingredient;
        $table1['rate'] = $row->rate;
        $table1['qty'] = $row->qty;
        if(Auth::user()->role == 'Finance'){
            if($row->scrap!=null){
                $table1['Scrap'] = $row->scrap;
            }else{
                $table1['Scrap'] = '-';
            }
            if($row->inscrap!=null)
            $table1['inscrap'] = $row->inscrap;
            else 
            $table1['inscrap'] = "--";
            if($row->mcost!=null)
            $table1['mcost'] = $row->mcost;
            else
            $table1['mcost'] ="--";
        }else{
            if($row->scrap!=null){
                if($request->stat == 2){
                    $table1['Scrap'] = '<input type="hidden" class="form-control input-xs"  name="b_id[]" value="'.$row->b_id.'" ><input type="hidden" class="form-control input-xs"  name="id_val[]" value="'.$row->id.'" >
                    <input type="text" class="form-control input-xs scrapeditval" id="id_scrap" name="scrap_name[]" value="'.$row->scrap.'"  required>';
                    $table1['inscrap'] ='<input type="text" class="form-control input-xs inscrapeditval" name="inscrap_name[]" value="'.$row->inscrap.'"  required readonly>';
                    $table1['mcost'] ='<input type="text" class="form-control input-xs mcosteditval" name="mcost_name[]" value="'.$row->mcost.'"  required readonly><input class="qtyeditval" value="'.$row->qty.'" hidden><input class="rateeditval" value="'.$row->rate.'" hidden>';

                }else{
                    $table1['Scrap'] = '<input type="hidden" class="form-control input-xs"  name="b_id[]" value="'.$row->b_id.'" ><input type="hidden" class="form-control input-xs"  name="id_val[]" value="'.$row->id.'" ><input type="text" class="form-control input-xs scrapeditval" id="id_scrap" name="scrap_name[]" value="'.$row->scrap.'" required>';
                    $table1['inscrap'] ='<input type="text" class="form-control input-xs inscrapeditval" name="inscrap_name[]" value="'.$row->inscrap.'"  required readonly>';
                    $table1['mcost'] ='<input type="text" class="form-control input-xs mcosteditval" name="mcost_name[]" value="'.$row->mcost.'"  required readonly><input class="qtyeditval" value="'.$row->qty.'" hidden><input class="rateeditval" value="'.$row->rate.'" hidden>';
                }
            }else{
                $table1['Scrap'] = '<input type="hidden" class="form-control input-xs"  name="b_id[]" value="'.$row->b_id.'" ><input type="hidden" class="form-control input-xs"  name="id_val[]" value="'.$row->id.'" ><input type="text" class="form-control input-xs scrapeditval" id="id_scrap" name="scrap_name[]" value="" required>';
                $table1['inscrap'] ='<input type="text" class="form-control input-xs inscrapeditval" name="inscrap_name[]" value="'.$row->inscrap.'"  required readonly>';
                $table1['mcost'] ='<input type="text" class="form-control input-xs mcosteditval" name="mcost_name[]" value="'.$row->mcost.'"  required readonly><input class="qtyeditval" value="'.$row->qty.'" hidden><input class="rateeditval" value="'.$row->rate.'" hidden>';

            }
        }

        $table[] = $table1;
        $i++;
        }
        $response = array(
        "data" => $table
        );
        echo json_encode($response);
    }


    public function fetch_pm_data(Request $request){
        // $data = Basic::select('*')
        // ->where('product_status',1)
        // ->orderby('id', 'desc')
        // ->get();
        $data=Basic::join('product__materials','product__materials.product_id','=','basics.pro_id')
         ->where('product_status',1)
         ->select('basics.*','product__materials.scrap',)
         ->orderby('id', 'desc')->groupBy('product__materials.product_id')
         ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('volume', function($row){
                $btn  = $row->Volume.''.$row->uom;
                return $btn;
            })
            ->addColumn('action', function($row){
                if($row->scrap!=''||$row->scrap!=null){
                    $btn  = '<a class="edit btn btn-primary btn-sm" onclick="pmscrapmodal('.$row->id.')">Update Scrap</a>';
                }else{
                    $btn  = '<a class="edit btn btn-primary btn-sm" onclick="pmscrapmodal('.$row->id.')">Add Scrap</a>';

                }
                return $btn;

            })
             ->addColumn('division', function($row){
                if($row->division !=null){
                $divisioname = Division::find($row->division);
                $division =$divisioname->division;
                }else{
                    $division ="--";
                }
                return $division;
             })
            ->rawColumns(['action','volume','division'])
            ->make();
    }

    public function getpmdetails(Request $request)
    {
        // dd($request->prd_id);
        $basic = Basic::where('id', $request->prd_id)->first();

        $data = Product_Material::select('*')->where('product_id',$basic->pro_id);
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('wtscrap', function($row) use ($basic){
                if($row->scrap!=null){
                    $btn  = '<input type="hidden" name="id_pm_val[]" value="'.$row->id.'"><input type="text" class="form-control input-xs" name="scrap_pm[]" value="'.$row->scrap.'" required oninput="validateNumericInput(this)">';
                }
                else{
                    $btn  = '<input type="hidden" name="id_pm_val[]" value="'.$row->id.'"><input type="text" class="form-control input-xs" name="scrap_pm[]" required oninput="validateNumericInput(this)">';
                }
                return $btn;
            })
            ->rawColumns(['wtscrap'])
            ->make();
    }

    public function add_pm_scrap(Request $request)
    {
        $auth_user=auth()->user()->id;
        foreach($request->id_pm_val as $key => $value){
            Product_Material::where('id',$value)->update(['scrap' => $request->scrap_pm[$key],'scrap_user'=>$auth_user]);
        }
        $basic_id= Product_Material::where('id',$value)->first();
        $basic=Basic::where('pro_id',$basic_id->product_id)->first();
        $users=User::where("multirole",'LIKE', "%PM Purchase%")->get();
        // $users=User::whereIn("role",['PM Purchase'])->get();
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
        return response()->json([
            'status' => 'scrap added'
        ]);
    }


    public function conversation_details(Request $request)
    {

        if(isset($request->rej)){
            $data = Basic::select('*')
            ->where('b_conv_cost_approval',2)
            ->orderby('id', 'desc')
            ->get();
        }
        else if(isset($request->app)){
            $data = Basic::select('*')
            ->where('b_conv_cost_approval',1)
            ->orderby('id', 'desc')
            ->get();
        }

        else{
            $data = Basic::select('*')
            ->where('b_conv_cost_approval',0)
            ->orderby('id', 'desc')
            ->get();
        }

        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('volume', function($row){
            $btn  = $row->Volume.''.$row->uom;
            return $btn;
        })
        ->addColumn('action', function($row){
               if ($row->conv_cost == null && $row->b_conv_cost_approval == 0){
                $btn  = '<button type="button" id ="conv_id" class="btn btn-primary btn-sm con" onclick="openconv('.$row->id.',1);" style="margin-right:1px">Add Conv.Cost</button>';
               }else if($row->b_conv_cost_approval == 2){
                $btn  = '<button type="button" id ="conv_id" class="btn btn-primary btn-sm con" onclick="openconv('.$row->id.',2);" style="margin-right:1px">Update Conv.Cost</button>';
               }else{
                $btn  = '<button type="button" class="btn btn-success btn-sm" onclick="openconv('.$row->id.',3);" style="margin-right:1px">view Conv.Cost</button>';
               }


            return $btn;
        })
        ->addColumn('division', function($row){
                if($row->division !=null){
                $divisioname = Division::find($row->division);
                $division =$divisioname->division;
                }else{
                    $division ="--";
                }
                return $division;
             })
        ->addColumn('remarks', function($row){

            $basics=Basic::where('pro_id',$row->pro_id)->first();
            return '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Edit" class="px-2 text-primary" "> <i class="fa fa-eye"  onclick="open_remarks('.$basics->id.')"></i></a>';
          })
        ->rawColumns(['action','volume','remarks','division'])
        ->make();
    }

    public function add_conv(Request $request)
    {
        $auth_user=auth()->user()->id;
        $date=date('Y-m-d H:i:s');
        $id = $request->hid_pid;
        $file = $request->excel_upload;
        $message1 = 'upload error';
        if ($request->hasFile('excel_upload')) {
            $pattafile = $request->file('excel_upload')->getClientOriginalName();
            $patfilename = str_replace(' ', '_', $pattafile);
            $breakup_docname  = date('mdYHis') . uniqid() . $patfilename;
            $request->file('excel_upload')->move(public_path("assets/uploads"), $breakup_docname);
        }else{
            $breakup_docname = '';
        }
        if($request->status_bar ==2){
            Basic::find($id)->update(['conv_cost' => $request->conv_cost , 'conv_uom' => $request->uom , 'breakup_excel' => $breakup_docname,'b_conv_cost_approval'=> 0,'convo_user'=>$auth_user,'convo_date'=> $date]);
        }else{
            Basic::find($id)->update(['conv_cost' => $request->conv_cost , 'conv_uom' => $request->uom , 'breakup_excel' => $breakup_docname,'convo_user'=>$auth_user,'convo_date'=> $date]);
        }
        return response()->json([
            'status' =>'success'
        ]);
    }

    public function edit_conversion_cost(Request $request)
    {
        $id = $request->id;
        $data = Basic::where('id',$id)->where('conv_cost','!=','')->first();
        return response()->json([
            'status' => 'success',
            'result' => $data
        ]);
    }

    public function fetchallplant()
    {
        $data = Plant::select('*');
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn  = '<a id="edit_uom" title="edit"  class="edit btn btn-primary btn-sm mr-2" style="margin-right:2px" onclick="edit_form(' . $row->id . ')" ><i class="fas fa-edit"></i></a>';
            // $btn .= '<a class="delete btn btn-danger btn-sm" data-row-id="' . $row->id . '" id="del_id" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Delete</a>';
            // $btn .= '<a class="delete btn btn-danger btn-sm delete_id" title="delete" id="del_id" onclick="open_confirm(' . $row->id . ');" ><i class="fas fa-trash"></i></a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

        public function getplant(Request $request,$id)
        {

            $data = Plant::find($id);
            // dd($data);
            return response()->json([
                "status" => "Plant edited successfully",
                "data" => $data
            ]);
        }
        public function saveplant(Request $request)
        {
            $data=plant::where("name",$request->plant_name)->get();
            if( $data ->count() > 0){
                return response()->json([
                    "status" => "error"
                ]);
            }else{

                Plant::create(['name' => $request->plant_name]);
                return response()->json([
                    "status" => "success"
                ]);
            }


        }

        public function delete_plant(Request $request,$id)
        {
            Plant::find($id)->delete();
            return response()->json([
                "status" => "plant deleted successfully"
            ]);
        }

        public function update_plant(Request $request)
        {
            $id = $request->update_id_name;
            Plant::find($id)->update(['name' => $request->edit_plant_name]);
            return response()->json([
                "status" => "plant updated successfully"
            ]);
        }
        public function bulkupload_plant(Request $request)
        {
            $validator = Validator::make($request->all(),[
                'excel_upload' => 'required|mimes:xls,xlsx,csv',
            ]);
            if($validator->errors()->count() > 0){
                return response()->json([
                "status" =>$validator->errors()
            ]);
            }

            // dd($validator->errors());
            Excel::import(new PlantImport,request()->file('excel_upload'));
            // DB::commit();

            return response()->json([
                "status" => "Plant  Imported  successfully"
             ]);
        }




        public function map_plant(Request $request)
            {
                $id = $request->input('bas_id');

                Basic::find($id)->update(['plant'=>$request->input('plant_name')]);
                return response()->json([
                    'status' => 'success'
                ]);
            }
            
            public function add_fgscrap(Request $request)
            {
                $auth_user=auth()->user()->id;
                $id = $request->input('fgs_id');
                Basic::find($id)->update(['fg_scrap'=>$request->input('fgs_name'),'fg_scrap_approval'=>0,'fg_scrap_user'=>$auth_user]);
                return response()->json([
                    'status' => 'success'
                ]);
            }
            public function fgScrapDatas(Request $request)
            {
            $auth_user=auth()->user()->id;
            if(isset($request->rej))
            $data = Basic::select('*')
            ->where('fg_scrap_approval',2)
            ->where('fg_scrap_user',$auth_user)
            ->orderby('id', 'desc')
            ->get();
            else if(isset($request->app))
            $data = Basic::select('*')
            ->where('fg_scrap_approval',1)
            ->orderby('id', 'desc')
            ->get();
            else
            $data = Basic::select('*')
            ->where('fg_scrap_approval',0)
            ->orderby('id', 'desc')
            ->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $action='';
                if($row->fg_scrap==null ){
                        $action.='<button type="button" class="btn btn-success btn-sm mx-1" id ="add_scrap" onclick="fgscrapmodal('.$row->id.',0,0)">Add FG Scrap</button>';

                }else if($row->fg_scrap!=null&&($row->fg_scrap_approval==1||$row->fg_scrap_approval==0)){
                    $action.='<button type="button" class="btn btn-secondary btn-sm mx-1" id ="add_scrap" onclick="fgscrapmodal('.$row->id.','.$row->fg_scrap.',1)">View FG Scrap</button>';
                }
                else if($row->fg_scrap_approval==2){
                    $action.='<button type="button" class="btn btn-secondary btn-sm mx-1" id ="add_scrap" onclick="fgscrapmodal('.$row->id.','.$row->fg_scrap.',2)">Update FG Scrap</button>';
                }
                return $action;
            })
             ->addColumn('division', function($row){
                if($row->division !=null){
                $divisioname = Division::find($row->division);
                $division =$divisioname->division;
                }else{
                    $division ="--";
                }
                return $division;
             })
            ->addColumn('remarks', function($row){
        
                return '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Edit" class="px-2 text-primary" "> <i class="fa fa-eye"  onclick="open_remarks_scrap('.$row->id.')"></i></a>';
            })
            ->rawColumns(['action','remarks','division'])
            ->make();
            }
                
        }

        
        
