<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Basic;
use App\Models\Rm_cost;
use App\Models\Division;
use App\Models\Product_Material;
use App\Models\EpdRMCostDetails;
use App\Models\EpdPmCostDetails;
use App\Models\existing_product;
use App\Models\EpdCostUpdaionHistory;
use DataTables;
use Validator;
use App\Imports\PmImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class PurchaseController extends Controller
{

    public function fetch_basic()
    {
        $data = Basic::select('*')
        ->where('product_status',0)
        ->orderby('id','desc')->get()->unique('pro_id');

        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn  = '<a id="id_pm" class="edit btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl" onclick="open_pm('.$row->id.')">Add PM</a>';
            return $btn;
        })
        ->addColumn('volume', function($row){
            $volume  = $row->Volume.''.$row->uom;
            return $volume;
        })
        ->rawColumns(['action','volume'])
        ->make(true);
    }

    // public function save_prodmaterial(Request $request)
    // {

    //         $basic = Basic::where('id', $request->product_id)->first();

    //     $i=0;
    //     foreach ($request->pm_name as $value) {
    //         Product_Material::create([
    //             'product_id'=>$basic->pro_id,
    //             'version'=>$basic->version,
    //             'material' => $request->pm_name[$i],
    //             'product_details' => $request->pmdetail_name[$i],
    //             'specification' => $request->pmspec_name[$i],
    //             'quantity' => $request->qty_name[$i],
    //             'MOQ' => $request->moq_name[$i],
    //             'vendor' => $request->vendor_name[$i],
    //             'basic' => $request->basic_name[$i],
    //             'freight' => $request->freight_name[$i]
    //         ]);
    //         $i++;
    //     }
    //     Basic::where('id',$request->product_id)->update(['product_status'=>1]);
    //     return response()->json([
    //         'status' =>"success"
    //     ]);
    // }

    public function save_prodmaterial_packageing(Request $request)
    {
        $rules = [];
        $authuser=auth()->user()->id;
        $date=date('Y-m-d H:i:s');
        foreach($request->input('pm_name') as $key => $value) {
            $rules["pm_name.{$key}"] = 'required';
            $rules["pmdetail_name.{$key}"] = 'required';
            $rules["pmspec_name.{$key}"] = 'required';
            $rules["qty_name.{$key}"] = 'required';
            // $rules["scrap.{$key}"] = 'required';
        }
        $validated_form = Validator::make($request->all(), $rules);
        if($validated_form->fails()){
            return response()->json(['error'=>$validated_form->errors()->all()]);
        }

        $basic   = Basic::where('id', $request->product_id)->first();
        $i=0;
        foreach ($request->pm_name as $value) {
            Product_Material::create([
                'product_id'=>$basic->pro_id,
                'material' => $request->pm_name[$i],
                'product_details' => $request->pmdetail_name[$i],
                'specification' => $request->pmspec_name[$i],
                'quantity' => $request->qty_name[$i],
                'scrap' => $request->scrap[$i],
                'uom' => $request->uom[$i],
                'package_user' =>  $authuser,
                'package_date' => $date,
                'scrap_user'=>$authuser
            ]);
            $i++;
        }
        if(in_array('',$request->scrap)){
            Basic::where('id',$request->product_id)->update(['product_status'=>1]);
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
            Basic::where('id',$request->product_id)->update(['product_status'=>1]);
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

    public function fetch_pending_details()
    {
        // $data = Basic::select('*')->where('product_status',1);
        $data = Basic::join('product__materials','basics.pro_id','=','product__materials.product_id')
                    ->whereNull('product__materials.scrap')
                    ->select('product__materials.product_id as basic_id','product__materials.id','product__materials.scrap','basics.Product_name')->get()->toArray();
        $id = [];
        foreach ($data as $key => $value) {
            $id[] = $data[$key]['basic_id'];
        }
        $value = Basic::whereIn('pro_id',$id)->where('product_status',1)->select('*')->orderby('id','desc')->get();

        return Datatables::of($value)
        ->addIndexColumn()
        ->addColumn('status', function($row){

            if($row->bf_pm_cost_approval == 'Pending'){
                $btn = '<span class="badge bg-warning text-dark">Finance team in progress</span>';
            }elseif($row->bf_pm_cost_approval == 'Rejected'){
                $btn = '<span class="badge bg-danger text-dark" style="color:white!important;">Rejected by Finance team</span>';
            }else {
                $btn = '<span class="badge bg-secondary text-dark">Operation team in progress</span>';
            }

            // $btn  = '<span class="badge bg-warning text-dark">operation team in progress</span>';
            return $btn;
        })
        ->addColumn('action', function($row){
            $btn  = '<a id="viewrm_id" class="btn btn-primary btn-sm" onclick="open_pmview('.$row->id.')">View PM</a>';
            return $btn;
        })
        ->addColumn('volume', function($row){
            $volume  = $row->Volume.''.$row->uom;
            return $volume;
        })
        ->addColumn('version', function($row){
            $version  = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
            return $version;
        })
        ->rawColumns(['action','status','volume','version'])
        ->make();
    }

    public function fetch_pmcompleted_data()
    {
        $data = Basic::join('product__materials','basics.pro_id','=','product__materials.product_id')
                    ->whereNull('product__materials.scrap')
                    ->select('product__materials.product_id as basic_id','product__materials.id','product__materials.scrap','basics.Product_name')->get()->toArray();
        $id = [];
        foreach ($data as $key => $value) {
            $id[] = $data[$key]['basic_id'];
        }
        $value = Basic::whereNotIn('pro_id',$id)
        ->where('product_status',1)
        ->select('*')->orderby('id','desc')->get();

        return Datatables::of($value)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn  = '<a id="id_edit" class="edit btn btn-primary btn-sm" onclick="open_view('.$row->id.')">View PM</a>';
            return $btn;
        })
        ->rawColumns(['action','status'])
        ->make();
    }

    public function getpmdetails_scrap(Request $request)
    {
        $basic = Basic::where('id', $request->prd_id)->first();
        $data = Product_Material::select('*')->where('product_id',$basic->pro_id)->get();
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('moq_array', function($row){
            $moq = json_decode($row->MOQ);

            $val='';
            if($row->basic !=""){
                foreach($moq as $moq_val){
                    $val .= '<span class="badge badge-secondary" style="background-color: #a5b1a7a6;color:#000000c7;">'. $moq_val .' </span><br>';
                }
            }
            return $val;
        })
        ->addColumn('vendor_array', function($row){
            $vendor = json_decode($row->vendor);

            $val='';
            if($row->basic !=""){
                foreach($vendor as $vendor_val){
                    $val .= '<span class="badge badge-secondary" style="background-color: #a5b1a7a6;color:#000000c7;">'. $vendor_val .' </span><br>';
                }
            }
            return $val;
        })
        ->addColumn('basic_array', function($row){
            $basic = json_decode($row->basic);

            $val='';
            if($row->basic !=""){
                foreach($basic as $basic_val){
                    $val .= '<span class="badge badge-secondary" style="background-color: #a5b1a7a6;color:#000000c7;">'. $basic_val .' </span><br>';
                }
            }
            return $val;
        })
        ->addColumn('freight_array', function($row){
            $freight = json_decode($row->freight);

            $val='';
            if($row->freight !=""){
                foreach($freight as $freight_val){
                    $val .= '<span class="badge badge-secondary" style="background-color: #a5b1a7a6;color:#000000c7;">'. $freight_val .' </span><br>';
                }
            }
            return $val;
        })
        ->rawColumns(['moq_array','vendor_array','basic_array','freight_array'])
        ->make();
    }

    public function get_PMcost()
    {
        $data = Basic::select('*')
        ->where('product_status','1')->orderby('id','desc')->get();

        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn  = '<a class="edit btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl" onclick="openpmview('.$row->id.')"><i class="bx bx-show icon nav-icon"></i></a>';
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
        ->rawColumns(['action','volume','division'])
        ->make(true);
    }


    public function save_moq(Request $request)
    {
        $authuser=auth()->user()->id;
        $currentdate=date('Y-m-d H:i:s');
        foreach($request->id as $ids){
            $vend="vendor_name".strval( $ids);
            $basics="basic_name".strval( $ids);
            $freight="freight_name".strval( $ids);
            $moq="moq_name".strval( $ids);
            $pmcost="pm_cost".strval( $ids);
            if(in_array('',$request->$vend)||in_array('',$request->$basics)||in_array('',$request->$freight)||in_array('',$request->$moq)){
                    return response()->json([
                        'status' =>"failed"
                    ]);
            }
        }
        foreach($request->id as $ids){
                $vend="vendor_name".strval( $ids);
                $basics="basic_name".strval( $ids);
                $freight="freight_name".strval( $ids);
                $moq="moq_name".strval( $ids);
                $pmcost="pm_cost".strval( $ids);
                $data['vendor'] = $request->$vend;
                $data['basic'] = $request->$basics;
                $data['freight'] = $request->$freight;
                $data['MOQ'] = $request->$moq;
                $data['pm_cost'] = $request->$pmcost;
                $data['pm_user']=$authuser;
                $data['pm_date']=$currentdate;
                $datas=  Product_Material::find($ids);
                if($datas->p_moq_approval !=0){
                    $moq_app=json_decode($datas->p_moq_approval);
                    $v=0;
                    foreach($request->$basics as $b){
                        if($moq_app[$v] == "1"){
                            $data['p_moq_approval'][]= "1";
                        }else{
                            $data['p_moq_approval'][]= "0";
                        }
                    $v++;
                    }
                }else{
                    foreach($request->$basics as $b){
                        $data['p_moq_approval'][]= "0";
                    }
                }


                Product_Material::where('id',$ids)->update($data);
                unset($data['p_moq_approval']);

            }
        return response()->json([
            'status' =>"success"
        ]);
    }

    public function bulkupload_pm(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'excel_upload' => 'required|mimes:xls,xlsx,csv',
        ]);
        if($validator->errors()->count() > 0){
            return response()->json([
            "status" =>$validator->errors()
        ]);
        }
        $import = new PmImport($request);

        // dd($validator->errors());
        Excel::import($import,request()->file('excel_upload'));
        // DB::commit();

        return response()->json([
            "status" => "success",
            "message"=>"Saved successfully"
            ]);
    }

    public function epd_pm_rate_verified(){

    }

    public function fetch_epd_rm_view()
    {
        // salesTax  primary_freight   secondary_freight  damage  logistic
        $data = existing_product::join('epd_primary_locations','existing_products.epro_id','=','epd_primary_locations.pro_id')
        ->join('epd_secondary_locations','existing_products.epro_id','=','epd_secondary_locations.epro_id')
        ->where('epd_primary_locations.freight', '!=',"")
        ->where('epd_primary_locations.retailer_margin', '!=',"")
        ->where('epd_primary_locations.primary_scheme', '!=',"")
        ->where('epd_primary_locations.rs_margin', '!=',"")
        ->where('epd_primary_locations.ss_margin', '!=',"")
        ->where('epd_secondary_locations.freight', '!=',"")
        ->where('existing_products.excsheet_approval','pending')
        ->where('existing_products.salesTax', '!=', '')
        ->where('existing_products.damage', '!=', '')
        ->where('existing_products.logistic', '!=', '')
        ->where('existing_products.specific_gravity', '!=', '0')
        // ->where('existing_products.rmcost_verified', 'not yet')
        // ->whereNotIn('epd_primary_locations.p_cost_approval', [1, 2])
        // ->whereNotIn('epd_secondary_locations.s_cost_approval', [1, 2])
        ->select('existing_products.*')
        ->orderby('existing_products.rmcost_verified','asc')
        ->orderby('existing_products.id','desc')
        ->groupBy('existing_products.epro_id')
        ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                if($row->rmcost_verified == 'not yet'){
                    $btn  = '<a class="btn btn-primary btn-sm" style="margin-right:1px" data-id='.$row->material_code.' data-proid='.$row->id.' onclick="view_api_form(this)" >Verify</a>';
                }else{
                    $btn  = '<a class="btn btn-success btn-sm" style="margin-right:1px" data-id='.$row->material_code.' data-proid='.$row->id.' onclick="view_api_form(this)" >Verified</a>';
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
            ->rawColumns(['action','division'])
            ->make(true);
    }

    public function save_sap_rmcost(Request $request)
    {
        $authuser = auth()->user()->id;
        $material_type = $request->material_type;
        $plant = $request->plant;

        $rm_product_list = $request->rmproduct;
        $rm_cost_list = $request->rmcost;
        $rmcost = array_sum($rm_cost_list);

        $rmdata = $request->rm_data_list;
        $rm_data_list = json_decode($rmdata, true);

        // $rmcost = 0;
        if (json_last_error() === JSON_ERROR_NONE) {
            foreach ($rm_data_list as $k => $item) {
                // $rmcost = (float)$rmcost + (float)$item['COST'];

                // if($item['IN_MAT_DESC'] != $rm_product_list[$k] ){
                    EpdRMCostDetails::create([
                        'epro_id' => $request->pro_id,
                        'plant' => $plant,
                        'in_mat_desc' => $item['IN_MAT_DESC'],
                        'fin_mat_desc' => isset($item['FIN_MAT_DESC']) ? $item['FIN_MAT_DESC'] : '',
                        'bom_qty' => isset($item['BOM_QTY']) ? $item['BOM_QTY'] : '',
                        'meeht' => isset($item['Meeht']) ? $item['Meeht'] : '',
                        'rate' => isset($item['RATE']) ? $item['RATE'] : '',
                        'cost' => $rm_cost_list[$k],
                        'user_id' => $authuser
                    ]);
                // }
            }
        } else {
            return response()->json([
                'error' => 'Error decoding JSON: ' . json_last_error_msg(),
            ], 400);
        }


        $pmdata = $request->pm_data_list;
        $pm_data_list = json_decode($pmdata, true);

        $pmcost = 0;
        if (json_last_error() === JSON_ERROR_NONE) {
            foreach ($pm_data_list as $item) {
                $pmcost = (float)$pmcost + (float)$item['COST'];

                EpdPmCostDetails::create([
                    'epro_id' => $request->pro_id,
                    'plant' => $plant,
                    'in_mat_desc' => $item['IN_MAT_DESC'],
                    'fin_mat_desc' => isset($item['FIN_MAT_DESC']) ? $item['FIN_MAT_DESC'] : '',
                    'bom_qty' => isset($item['BOM_QTY']) ? $item['BOM_QTY'] : '',
                    'meeht' => isset($item['Meeht']) ? $item['Meeht'] : '',
                    'rate' => isset($item['RATE']) ? $item['RATE'] : '',
                    'cost' => $item['COST'],
                    'user_id' => $authuser
                ]);
            }
        } else {
            return response()->json([
                'error' => 'Error decoding JSON: ' . json_last_error_msg(),
            ], 400);
        }
        

        // if(isset($request->rm_cost)){
            $data['material_type'] = $request->material_type;
            $data['plant'] = $plant;
            $data['rmcost'] = $rmcost;
            $data['pmcost'] = $pmcost;
            $data['conv_cost'] = $request->conv_cost;
            $data['rmcost_verified'] = 'verified';

            existing_product::where('id',$request->pro_id)->update($data);
        //     existing_product::where('id',$request->pro_id)->update(['pmcost' => $request->pm_cost,'pmcost_verified' => 'verified']);
        
        return response()->json([
            'status' =>"success"
        ]);
    }

    public function save_sap_pmcost(Request $request)
    {
        $authuser = auth()->user()->id;
        $pro_id = $request->pro_id;
        $pm_product_list = $request->pmproduct;
        $pm_cost_list = $request->pmcost;

        foreach ($pm_product_list as $k => $item) {
            $get_exist_pm_data = EpdPmCostDetails::where('epro_id', $pro_id)->where('in_mat_desc', $item)->first();

            if($get_exist_pm_data->cost != $pm_cost_list[$k] ){
                EpdPmCostDetails::where('epro_id', $pro_id)->where('in_mat_desc', $item)->update(['cost' => $pm_cost_list[$k] , 'user_id' => $authuser]);
            }
        }

        $pmcost = array_sum($pm_cost_list);
        existing_product::where('id',$pro_id)->update(['pmcost' => $pmcost,'pmcost_verified' => 'verified']);
        
        return response()->json([
            'status' =>"success"
        ]);
    }


    public function get_epd_data(Request $request)
    {
        $data = existing_product::where('id',$request->pro_id)->first();

        $rmdetails = [];
        $pmdetails = [];
        if($data->rmcost_verified == "verified"){
            $rmdetails = EpdRMCostDetails::where('epro_id',$request->pro_id)->get();
            $pmdetails = EpdPmCostDetails::where('epro_id',$request->pro_id)->get();
        }
        return response()->json([
            "data" => $data,
            "rmdetails" => $rmdetails,
            "pmdetails" => $pmdetails
        ]);
    }

    public function overall_epd_sheet(Request $request)
    {

        if($request->app == "approved"){
            $data = existing_product::select('*')
            ->where('excsheet_approval','approved')
            ->where('mt_exsheet_approval','!=','rejected')
            ->orderby('id','desc')->get();
        }else{
            $data = existing_product::select('*')
            ->where('excsheet_approval','rejected')
            ->OrWhere('mt_exsheet_approval','rejected')
            ->orderby('id','desc')->get();
        }
       
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn  = '<a class="btn btn-success btn-sm" style="margin-right:1px" data-id='.$row->material_code.' data-proid='.$row->id.' onclick="view_api_form(this)" >Verified</a>';
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

    public function fetch_epd_pm_view()
    {
        $data = existing_product::join('epd_primary_locations','existing_products.epro_id','=','epd_primary_locations.pro_id')
        ->join('epd_secondary_locations','existing_products.epro_id','=','epd_secondary_locations.epro_id')
        ->where('epd_primary_locations.freight', '!=',"")
        ->where('epd_primary_locations.retailer_margin', '!=',"")
        ->where('epd_primary_locations.primary_scheme', '!=',"")
        ->where('epd_primary_locations.rs_margin', '!=',"")
        ->where('epd_primary_locations.ss_margin', '!=',"")
        ->where('epd_secondary_locations.freight', '!=',"")
        ->where('existing_products.excsheet_approval','pending')
        ->where('existing_products.salesTax', '!=', '')
        ->where('existing_products.damage', '!=', '')
        ->where('existing_products.logistic', '!=', '')
        ->where('existing_products.specific_gravity', '!=', '0')
        ->where('existing_products.rmcost_verified', 'verified')
        // ->whereNotIn('epd_primary_locations.p_cost_approval', [1, 2])
        // ->whereNotIn('epd_secondary_locations.s_cost_approval', [1, 2])
        ->select('existing_products.*')
        ->orderby('existing_products.rmcost_verified','asc')
        ->orderby('existing_products.id','desc')
        ->groupBy('existing_products.epro_id')
        ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                if($row->pmcost_verified == 'not yet'){
                    $btn  = '<a class="btn btn-primary btn-sm" style="margin-right:1px" data-id='.$row->material_code.' data-proid='.$row->id.' onclick="view_api_form(this)" >Verify</a>';
                }else{
                    $btn  = '<a class="btn btn-success btn-sm" style="margin-right:1px" data-id='.$row->material_code.' data-proid='.$row->id.' onclick="view_api_form(this)" >Verified</a>';
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
            ->rawColumns(['action','division'])
            ->make(true);
    }



}
