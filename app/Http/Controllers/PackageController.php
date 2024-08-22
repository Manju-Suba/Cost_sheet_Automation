<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\User;
use App\Models\Basic;
use App\Models\Rm_cost;
use App\Models\Product_Material;
use App\Models\Division;
use DB;

class PackageController extends Controller
{
    public function fetch_basic_pack()
    {
        $data = Basic::leftJoin('product__materials','basics.pro_id','=','product__materials.product_id')
        ->select('basics.*')
        // ->groupby('basics.pro_id')
        ->orderby('id','desc')
        ->whereNull('product__materials.product_id')
        ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn  = '<a id="add_id" class="btn btn-primary btn-sm" onclick="openmodel('.$row->id.')" ><i class="fa fa-edit"></i></a>';
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
            ->rawColumns(['action','division'])
            ->make(true);
    }

    public function show_pack(Request $request)
    {

        $basic = Basic::where('id', $request->id)->first();
        if(isset($request->label)){
            $row = Product_Material::where('product_id',$basic->pro_id)->select('*');

        }else{
            if($request->sts_bar == 3||$request->sts_bar == 4){
                $row = Product_Material::where('product_id',$basic->pro_id)->where('p_moq_approval','NOT LIKE','%2%')->select('*');

            }else if($request->sts_bar ==2){
                $row = Product_Material::where('product_id',$basic->pro_id)->where('p_moq_approval','LIKE','%2%')->select('*');
            }else{
                $row = Product_Material::where('product_id',$basic->pro_id)->where('p_moq_approval','NOT LIKE','%0%')->where('p_moq_approval','NOT LIKE','%2%')->select('*');

            }
        }
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $otpLength = 4; // Change this to the desired OTP length
        $otp = '';

        for ($i = 0; $i < $otpLength; $i++) {
            $randomIndex = rand(0, strlen($characters) - 1);
            $otp .= $characters[$randomIndex];
        }

        return Datatables::of($row)
            ->addIndexColumn()
            // ->addColumn('action', function($row){
            //     $btn  = '<a id="add_id" class="btn btn-primary btn-sm" >PM Cost</a>';
            //     return $btn;
            // })
            ->addColumn('moq', function($row) use ($otp){
                if(!empty($row->MOQ)){
                    $imp = json_decode($row->MOQ);

                    $first_moq = $imp[0];
                    $cont = count($imp);
                    $moq_approval=json_decode($row->p_moq_approval);
                    $first_app = $moq_approval[0];
                }else{
                    $first_moq ='';
                    $cont = '0';
                    $first_app ="";
                }
                if($first_app =="2"){
                    $readonly1="";
                }else{
                    $readonly1="readonly";
                }
                if( $row->p_moq_approval == "0"){
                    $readonly1="";
                }
                $moq = '<div style="width:60px;" class="moq_input'.$row->id.'"><input type="text" class="form-control input-xs" id="id_moq" name="moq_name'.$row->id.'[]" value="'.$first_moq.'" '.$readonly1.'></div>';


                for($i=1 ; $i<$cont ; $i++ ){
                    $moq_val = $imp[$i];
                    $moq_app = $moq_approval[$i];
                    if($moq_app == "2"){
                        $readonly="";
                      }else{
                          $readonly="readonly";
                      }
                    $moq .= '<div style="display: inline-flex;padding-top:3px;"><input type="text" class="form-control input-xs" id="'.$otp.'" name="moq_name'.$row->id.'[]" value="'.$moq_val.'" '.$readonly.'></div>';
                }
                return $moq;
            })
            ->addColumn('vendor', function($row) use ($otp) {
                if(!empty($row->vendor)){
                    $ven = json_decode($row->vendor);
                    $first_vendor = $ven[0];
                    $contv = count($ven);
                    $moq_approval=json_decode($row->p_moq_approval);
                    $first_app = $moq_approval[0];

                }else{
                    $first_vendor ='';
                    $contv = '0';
                    $first_app ="";

                }
                if($first_app =="2"){
                    $readonly1="";
                }else{
                    $readonly1="readonly";
                }
                if( $row->p_moq_approval== "0"){
                    $readonly1="";
                }

                $vendor  = '<div style="width:60px;" class="vendor_input'.$row->id.'"><div><input type="text" class="form-control input-xs" id="id_vendor" name="vendor_name'.$row->id.'[]"  value="'.$first_vendor.'" size="0" '.$readonly1.'></div></div>';

                for($i=1 ; $i<$contv ; $i++ ){
                    $ven_val = $ven[$i];
                    $moq_app = $moq_approval[$i];
                    if($moq_app == "2"){
                      $readonly="";
                    }else{
                        $readonly="readonly";
                    }
                    $vendor .= '<div style="display: inline-flex;padding-top:3px;"><input type="text" class="form-control input-xs" id="id_vendor" name="vendor_name'.$row->id.'[]"   value="'.$ven_val.'" '. $readonly.'></div>';
                }
                return $vendor;
            })
            ->addColumn('basic', function($row) use ($otp) {
                if(!empty($row->basic)){
                    $bas = json_decode($row->basic);

                    $first_basic = $bas[0];
                    $contb = count($bas);
                    $moq_approval=json_decode($row->p_moq_approval);
                    $first_app = $moq_approval[0];
                }else{
                    $first_basic ='';
                    $contb = '0';
                    $first_app ="";
                }
                if($first_app =="2"){
                    $readonly1="";
                }else{
                    $readonly1="readonly";
                }
                if(  $row->p_moq_approval == "0"){
                    $readonly1="";
                }
                $basic_name  = '<div style="width:60px;" class="basic_input'.$row->id.'"><div><input type="text" class="form-control input-xs" id="id_basic'.$row->id.'" name="basic_name'.$row->id.'[]" value="'.$first_basic.'" '.$readonly1.' oninput="validateNumericInput(this)"></div></div>';
                for($i=1 ; $i<$contb ; $i++ ){
                    $bas_val = $bas[$i];
                    $moq_app = $moq_approval[$i];
                    if($moq_app == "2"){
                      $readonly="";
                    }else{
                        $readonly="readonly";
                    }
                    $basic_name .= '<div style="display: inline-flex;padding-top:3px;"><input type="text" class="form-control input-xs"  id="id_basic'.$otp.'"  name="basic_name'.$row->id.'[]" value="'.$bas_val.'" '.$readonly.' oninput="validateNumericInput(this)"></div>';
                }
                return $basic_name;
            })
            ->addColumn('freight', function($row) use ($otp) {
                if(!empty($row->freight)){
                    $frt = json_decode($row->freight);
                    $first_freit = $frt[0];
                    $contf = count($frt);
                    $moq_approval=json_decode($row->p_moq_approval);
                    $first_app = $moq_approval[0];
                }else{
                    $first_freit ='';
                    $contf = '0';
                    $first_app ="";
                }
                if($first_app =="2"){
                    $readonly1="";
                }else{
                    $readonly1="readonly";
                }
                if( $row->p_moq_approval == "0"){
                    $readonly1="";
                }
                $freight  = '<div style="width:60px;" class="freight_input'.$row->id.'"><div></div><input type="text" class="form-control input-xs" id="'.$row->id.'" name="freight_name'.$row->id.'[]" value="'.$first_freit.'" onkeyup="catchval(event)" '.$readonly1.' oninput="validateNumericInput(this)"></div></div>';
                for($i=1 ; $i<$contf ; $i++ ){
                    $frt_val = $frt[$i];
                    $moq_app = $moq_approval[$i];
                    if($moq_app == "2"){
                      $readonly="";
                    }else{
                        $readonly="readonly";
                    }

                    $freight .= '<div style="display: inline-flex;padding-top:3px;"><input type="text" class="form-control input-xs" id="'.$otp.'" name="freight_name'.$row->id.'[]" value="'.$frt_val.'" '.$readonly.' onkeyup="catchEnter('.$row->id.')" oninput="validateNumericInput(this)"></div>';
                }
                return $freight;
            })
            ->addColumn('pmcost', function($row) use ($otp){
                // (Basic + Freight) *(Qty)*(1+Scrap%)

                if(!empty($row->basic)){
                    $pbas = json_decode($row->basic);
                    $pfrt = json_decode($row->freight);

                    $contpm = count($pbas);
                    $pm_cost_1 = ($row->quantity*($pfrt[0]+$pbas[0]))+(($row->quantity*($pfrt[0]+$pbas[0]))* ($row->scrap/100));
                    $pmcost1 = round($pm_cost_1,2);
                }else{
                    $pmcost1 = '';
                    $contpm = '0';
                }
                $pmcost_val  = '<div style="" class="pm_input'.$row->id.'"><div><input type="text" style="width: auto;max-width: 115px!important;" class="form-control input-xs" id="id_pmcost'.$row->id.'" name="pm_cost'.$row->id.'[]" value="'.$pmcost1.'" readonly>
                <input type="hidden" class="form-control input-xs" id="quantity'.$row->id.'" name="quantity[]" value="'.$row->quantity.'"><input type="hidden" class="form-control input-xs" id="pmscrap'.$row->id.'" name="pmscrap[]" value="'.$row->scrap.'"></div></div>';

                for($i=1 ; $i<$contpm ; $i++ ){
                    $pm_cost1_ = ($row->quantity*($pfrt[$i]+$pbas[$i]))+(($row->quantity*($pfrt[$i]+$pbas[$i]))* ($row->scrap/100));
                    $pmcost1_ = round($pm_cost1_,2);

                    $pmcost_val .= '<div style="display: inline-flex;padding-top:3px;"><input type="text" style="width: auto;max-width: 115px!important;" class="form-control input-xs" id="id_pmcost'.$otp.'"  name="pm_cost'.$row->id.'[]" value="'.$pmcost1_.'" readonly></div>';
                }
                $pmcost_val.='<input type="hidden" id="id" name="id[]" value="'.$row->id.'" >';
                return $pmcost_val;

                // Product_Material::where('id',$row->id)->update(['pm_cost'=>$btn]);

            })
            ->addColumn('action', function($row){
                if($row->basic !="" && $row->freight !="" && $row->vendor && !empty($row->MOQ)){
                    $action = '';
                }else{
                    // $action = '<button class="add-child-btn">Add Child</button>';
                    $action = '<div class="action_container" ><button type="button" class="btn-success" id="plus" onclick="moqplus(' . $row->id . ')" ><i class="fa fa-plus"></i></button></div>';
                }
                return $action;
            })
            ->addColumn('remarks', function($row){

                return '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Edit" class="px-2 text-primary" "> <i class="fa fa-eye"  onclick="open_remarks('. $row->id .')"></i></a>';
              })

            ->rawColumns(['moq','vendor','basic','freight','pmcost','action','remarks'])
            ->make(true);
    }


    public function show_packpending()
    {
        // $data = Basic::where('status', '3')->get();
        $table = array();
        $i = 1;
        $data = Basic::join('product__materials','basics.pro_id','=','product__materials.product_id')
        ->whereNull('product__materials.scrap')
        ->select('product__materials.product_id as basic_id','product__materials.id','product__materials.scrap','basics.Product_name')->get()->toArray();
        $id = [];
        foreach ($data as $key => $value) {
            $id[] = $data[$key]['basic_id'];
        }
        $val = Basic::whereIn('pro_id',$id)->select('*')->get();
        // $val = Basic::whereIn('pro_id',$id)->whereIn('status', ['2','3'])->select('*')->get();

        foreach ($val as $row) {
            $table1 = array();
            $table1['Product_Name'] = $row->Product_name;
            $table1['Fill_Volume'] = $row->Volume;
            $table1['Cofiguration'] = $row->case_configuration;
            $table1['Quantity'] = $row->quantity;
            // $table1['version'] = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';

            $table1['status'] = '<span class="badge bg-secondary text-dark">Operation team in progress</span>';
            $table1['Action'] = '<button type="button" class="btn btn-success btn-sm" id="rmview" data-bs-toggle="modal" data-bs-target="#pmviewmodel" onclick="editshow(' . $row->id . ')">PM View</button>
                ';

            $table[] = $table1;
            $i++;
        }
        $response = array(
        "data" => $table
        );
        echo json_encode($response);

    }

    public function fetch_completed_pm(Request $request)
    {
        $authuser=auth()->user()->id;
        $null_product = Product_Material::whereNull('scrap')->groupby('product_id')->select('product_id')->get()->toArray();//take scrap null
        $all_product = Product_Material::groupby('product_id')->select('product_id')->get()->toArray();//take all
        $result = array_diff_key($all_product,$null_product);//without null
        $array = array_column($result, 'product_id');
        if(isset($request->rej)){
        $val= Basic::join('product__materials','product__materials.product_id','=','basics.pro_id')->whereIn('basics.pro_id',$array)->where('product__materials.p_moq_approval', 'LIKE', "%2%",)->where('product__materials.pm_user',$authuser)->orderby('id','desc')->select('basics.*','product__materials.basic','product__materials.p_moq_approval','product__materials.pm_cost','product__materials.product_id')->groupBy('basics.pro_id')->get();
            // like 2
        }
        else if(isset($request->app)){
        $val= Basic::join('product__materials','product__materials.product_id','=','basics.pro_id')->select('basics.*','product__materials.p_moq_approval','product__materials.basic','product__materials.pm_cost','product__materials.product_id')->whereIn('basics.pro_id',$array)->where('product__materials.p_moq_approval','NOT LIKE', "%2%")->where('product__materials.p_moq_approval','NOT LIKE', "%0%")->orderby('id','desc')->groupBy('basics.pro_id')->get();
        // NOT LIKE 2 NOT LIKE 0
        }
        else{
        // $val = Basic::whereIn('pro_id',$array)->orderby('id','desc')->select('*')->get();
        if(isset($request->label)){
            $val= Basic::join('product__materials','product__materials.product_id','=','basics.pro_id')->select('basics.*','product__materials.basic','product__materials.p_moq_approval','product__materials.pm_cost','product__materials.product_id')->where('product__materials.p_moq_approval','LIKE', "%0%")->where('product__materials.p_moq_approval','NOT LIKE', "%2%")->whereIn('basics.pro_id',$array)->orderby('id','desc')->groupBy('basics.pro_id')->get();
            // NOT LIKE 2 like 0
        }else{
            $val1= Basic::join('product__materials','product__materials.product_id','=','basics.pro_id')->select('basics.*','product__materials.basic','product__materials.p_moq_approval','product__materials.product_id','product__materials.pm_cost')->whereNotNull('product__materials.scrap')->where('product__materials.p_moq_approval','LIKE', "%0%")->where('product__materials.p_moq_approval','NOT LIKE', "%2%")->orderby('id','desc')->get();
            // NOT LIKE 2 like 0
            $id = [];
            foreach ($val1 as $key => $value) {
                $id[] = $val1[$key]['product_id'];
            }

            $val = Basic::whereIn('pro_id',$id)
            ->orderby('id','desc')
            // ->where('status',3)
            ->select('*')->get()->unique('pro_id');

        }

        }
        return Datatables::of($val)
            ->addIndexColumn()
            ->addColumn('action', function($row) use ($request){

                if(isset($request->app)){
                    $btn  = '<a id="add_id" class="edit btn btn-success btn-sm" onclick="open_modal('. $row->id .',1)">PM View</a>';
                }else if($request->rej){
                    $btn  = '<a id="add_id" class="edit btn btn-primary btn-sm" onclick="open_modal('. $row->id .',2)">Update</a>';
                }else{
                    if($row->basic!=null|| isset($request->label)){
                        $btn  = '<a id="add_id" class="edit btn btn-success btn-sm" onclick="open_modal('. $row->id .',3)">View </a>';
                    }else{
                        $dats=Product_material::where('product_id',$row->pro_id)->get();

                        foreach($dats as $detes){

                            if($detes->MOQ != null){

                              $btn  = '<a id="add_id" class="edit btn btn-success btn-sm" onclick="open_modal('. $row->id .',3)">View PM </a>';
                            }else{


                              $btn  = '<a id="add_id" class="edit btn btn-primary btn-sm" onclick="open_modal('. $row->id .',4)">Add PM </a>';
                              break;

                            }
                        }

                    }

                }
                return $btn;
            })
            ->addColumn('volume', function($row){
                $volume  = $row->Volume.''.$row->uom;
                return $volume;
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
            ->addColumn('version', function($row){
                $version  = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
                return $version;
            })
            ->rawColumns(['action','volume','version','division'])
            ->make(true);
    }


}
