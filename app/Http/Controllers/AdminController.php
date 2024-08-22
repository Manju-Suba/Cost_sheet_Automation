<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Basic;
use App\Models\Division;
use App\Models\existing_product;
use App\Models\EpdPrimaryLocations;
use App\Models\EpdSecondaryLocations;
use App\Models\Plant;
use App\Models\uom;
use App\Models\dist_channel;
use App\Models\Secondary_location;
use App\Models\Product_Material;
use App\Models\LocationMaster;
use App\Models\Rm_cost;
use Carbon\Carbon;
use App\Mail\email;
use Illuminate\Support\Facades\Mail;
use DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportUser;
use App\Exports\ExportUser;
use DataTables;
use App\Models\Primary_location;

class AdminController extends Controller
{
    //

    public function  market()
    {
        // $data = uom::where('id',11)->orWhere('id',12)->get();
        $data = uom::all();
        $dist_channel = dist_channel::where('dist_name','!=','')->get();
        $primaryfrom=LocationMaster::where('type','primary_from')->get();
        $primaryto=LocationMaster::where('type','primary_to')->get();
        $division=Division::all();
        $secondaryto=LocationMaster::where('type','secondary_to')->get();
        return view('Marketing.marketing',compact('data','dist_channel','primaryfrom','primaryto','secondaryto','division'));
    }

    public function  purchase()
    {
        return view('R&D.purchase');
    }

    public function  epd_specific_gravity()
    {
        return view('R&D.epd_gravity_capture');
    }

    public function  location()
    {
        return view('Marketing.location');
    }

    public function oprations()
    {
        $data = uom::select('*')->get();
        $plant = Plant::select('*')->get();
        return view('operations.opration',compact('data','plant'));
    }
    public function  formulation()
    {
        return view('R&D.Rmformulation');
    }
    public function  taxation()
    {
        return view('Taxation.tax');
    }
    public function  packing()
    {
        $uom=Uom::all();
        return view('Packing.pack',compact('uom'));
    }
    public function Logistic()
    {
        return view('logistcis.Logistic');
    }
    public function LogisticSub()
    {
        return view('logistcis.LogisticSub');
    }

    public function epd_damage()
    {
        return view('finance.bfinance');
    }

    public function product_approval()
    {
        return view('finance.bproduct_approval');
    }

    public function rm_cost_approval()
    {
        return view('finance.brm_cost_approval');
    }

    public function rm_scrap_approval()
    {
        return view('finance.rm_scrap_approval');
    }

    public function pm_scrap_approval()
    {
        return view('finance.pm_scrap_approval');
    }

    public function conversion_cost_approval()
    {
        return view('finance.ccost_approval');
    }

    public function pm_cost_approval()
    {
        return view('finance.bpm_cost_approval');
    }

    public function ingic_approval()
    {
        return view('finance.bingic_approval');
    }

    public function tax_approval()
    {
        return view('finance.btax_approval');
    }

    public function pfreight_approval()
    {
        return view('finance.pfreight_approval');
    }

    public function extax_approval()
    {
        return view('finance.extax_approval');
    }

    public function exfreight_approval()
    {
        return view('finance.exfreight_approval');
    }

    public function epd_logistic()
    {
        return view('logistcis.epd_logistic');
    }

    public function epd_sec_logistic()
    {
        return view('logistcis.epd_secLogistic');
    }

    public function location_master()
    {
        return view('logistcis.locationMaster');
    }

    public function rmview()
    {
        return view('purchase.rmnew');
    }
    public function pmview()
    {
        return view('purchase.pmnew');
    }

    public function uom()
    {
        return view('Marketing.uom');
    }
    public function division()
    {
        return view('Marketing.division');
    }

    public function costsheet_approval()
    {
        return view('finance.npd_costsheet_approval');
    }

    public function epd_costsheet_approval()
    {
        return view('finance.epd_costsheet_approval');
    }

    public function epd_cs_approve_mt(){
        return view('finance.marketing_approve_ecs');
    }

    public function npd_cost_sheet()
    {
        return view('Marketing.npd_cost_sheet');
    }

    public function epd_cost_sheet()
    {
        return view('Marketing.epd_cost_sheet');
    }

    public function med_request()
    {
        return view('Marketing.med_request');
    }

    public function costsheet()
    {
        return view('finance.costsheet');
    }

    public function approved_cost_sheets()
    {
        return view('MED.approved_cost_sheets');
    }

    public function med_request_approval()
    {
        return view('finance.med_request_approval');
    }

    public function exmed_request_approval()
    {
        return view('finance.exmed_request_approval');
    }

    public function  pmpurchase()
    {
        return view('purchase.pmcost_update_form');
    }
    public function  epdproducts()
    {
        $dist_channel = dist_channel::where('dist_name','!=','')->get();
        return view('common.epdproducts',compact('dist_channel'));
    }

    public function epd_pm_rate_verified(){
        return view('purchase.epd_pm_cost_verify');
    }
    
    public function epd_rm_rate_verified(){
        return view('purchase.epd_rm_cost_verify');
    }

    // public function save(Request $request)
    // {
    //     $name           = $request->input('product_name');
    //     $Volume           = $request->input('Volume');
    //     $uom           = $request->input('uom');
    //     $configuration    = $request->input('case_configuration');
    //     $quantity    = $request->input('quantity');
    //     $mrp_price    = $request->input('mrp_price');
    //     $from_location    = $request->input('from_location');
    //     $to_location    = $request->input('to_location');
    //     $retailer_margin    = $request->input('retailer_margin');
    //     $primary_scheme    = $request->input('primary_scheme');
    //     $rs_margin    = $request->input('rs_margin');
    //     $ss_margin    = $request->input('ss_margin');
    //     $status="0";
    //     $data           = array('Product_name' => $name, 'Volume' => $Volume, 'uom' => $uom,'case_configuration' => $configuration, 'quantity' => $quantity, 'mrp_price' => $mrp_price, 'from_location' => $from_location, 'to_location' => $to_location, 'retailer_margin' => $retailer_margin, 'primary_scheme' => $primary_scheme, 'rs_margin' => $rs_margin, 'ss_margin' => $ss_margin,'status'=>$status);
    //     $insert         = DB::table('basics')->insert($data);
    // }
    // public function show()
    // {

    //     $data = Basic::all();
    //     // dd( $data);
    //     $table = array();
    //     $i = 1;
    //     foreach ($data as $row) {
    //         // $productCode = rand(1234567890,50);
    //         // $productCode =array();
    //         $volume = $row->Volume.''.$row->uom ;
    //         $table1 = array();
    //         //  print_r( $row)
    //         $table1['Product_Name'] = $row->Product_name;
    //         $table1['Fill_Volume'] = $volume;
    //         $table1['Cofiguration'] = $row->case_configuration;
    //         $table1['Quantity'] = $row->quantity;
    //         $table1['Price'] = $row->mrp_price;
    //         $table1['From_Location'] = $row->from_location;

    //         $table1['to_Location'] = $row->to_location;
    //         $table1['Margin'] = $row->retailer_margin;
    //         $table1['Primary_Scheme'] = $row->primary_scheme;
    //         $table1['RS_Margin'] = $row->rs_margin;
    //         $table1['ss_Margin'] = $row->ss_margin;

    //         // $table1['Action'] = '<button type="button" class="btn btn-Warning btn-icon"  data-toggle="modal" data-target="#model1"onclick="edit(' . $row->emp_id . ')" ><i class="fa-solid fa-user-pen"></i></button>
    //         //                        <button type="button" class="btn btn-danger btn-icon"   onclick="deleteid(' . $row->emp_id . ')" ><i class="fa-solid fa-trash"></i></button>';
    //         $table[] = $table1;
    //         $i++;
    //     }
    //     $response = array(
    //         "data" => $table
    //     );
    //     echo json_encode($response);
    // }
    public function save_uom(Request $request)
    {
        $request->uom;
        uom::create(['uom_name' => $request->uom_name]);
        return response()->json([
            "status" => "uom saved successfully"
        ]);
    }

    public function get_uom(Request $request,$id)
    {
        $data = uom::find($id);
        // dd($data);
        return response()->json([
            "status" => "uom edited successfully",
            "data" => $data
        ]);

    }

    public function delete_uom(Request $request,$id)
    {

        uom::find($id)->delete();
        return response()->json([
            "status" => "uom deleted successfully"
        ]);

    }

    public function update_uom(Request $request)
    {
       $id = $request->update_id_name;
       uom::find($id)->update(['uom_name' => $request->edit_uom_name]);
        return response()->json([
            "status" => "uom updated successfully"
        ]);
    }

    public function distribution_channel()
    {
        return view('Marketing.distribution_channel');
    }
    public function plant_master()
    {
        return view('operations.plantmaster');
    }

    public function dashboard(){
        $role =  auth()->user()->role;
        $npd_pending_count = Basic::where('csheet_approval','pending')->count();
        $npd_completed_count = Basic::where('csheet_approval','approved')->count();
        $npd_rejected_count = Basic::where('csheet_approval','rejected')->count();
        $epd_pending_count = existing_product::where('excsheet_approval','pending')->count();
        $epd_completed_count = existing_product::where('excsheet_approval','approved')->count();
        $epd_rejected_count = existing_product::where('excsheet_approval','rejected')->count();
        return view('index',compact('epd_pending_count','epd_completed_count','epd_rejected_count','npd_pending_count','npd_completed_count','npd_rejected_count','role'));
    }
    public function dashBoardData(){
        $authuser=auth()->user()->role;
            $data = Basic::orderBy('id','desc')->get();
            if($authuser == "Marketing"||$authuser == "R&D"|| $authuser == "Tax"||$authuser == "Packaging"||$authuser == "Logistic"||$authuser == "operations"){


                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('initiated_date', function($row){
                $date=Carbon::parse($row->created_at)->format('d-m-Y H:i:s');
                return $date;
                })

                ->addColumn('pendinginputs', function($row) use ($authuser){
                    $inputs='';
                    $row->statuscount=0;
                    if($authuser =="Logistic"){
                        $pm_costs_ids=Primary_location::where('pro_id',$row->pro_id)->whereNull('cost')->get();
                        $sm_costs_ids=Secondary_location::where('pro_id',$row->pro_id)->whereNull('cost')->get();
                        if($pm_costs_ids->count()>0 ){
                            $inputs.='<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" >P:frieght</span><br>';
                            $row->statuscount+=1;
                        }
                        if($sm_costs_ids->count()>0 ){
                            $inputs.='<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" >S:frieght</span><br>';
                            $row->statuscount+=1;
                        }

                    }else{
                         if( $row->conv_cost ==null){
                        $inputs.='<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" >Conv cost </span><br>';
                        $row->statuscount+=1;
                        }
                         if( $row->fg_scrap ==null){
                        $inputs.='<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" >FG Scrap </span><br>';
                        $row->statuscount+=1;
                        }
                        $pm_scrap= Product_Material::whereNull('scrap')->where('product_id',$row->pro_id)->groupby('product_id')->get();
                        if($pm_scrap->count()>0){
                            $inputs.='<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" >Pm Scrap</span><br>';
                            $row->statuscount+=1;
                        }
                        $rmcost= Rm_cost::whereNotNull('sapcode')->where('Product_id',$row->pro_id)->groupby('Product_id')->get();
                        if($rmcost->count()>0){
                            if($row->plant == null){
                                $inputs.='<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" >Plant</span><br>';
                                $row->statuscount+=1;
                            }
                        }
                        $rm_scrap= Rm_cost::whereNull('scrap')->whereNotNull('Ingredient')->where('Product_id',$row->pro_id)->pluck('Product_id');
                        $rm_sap= Rm_cost::whereNull('scrap')->whereNotNull('sapcode')->where('Product_id',$row->pro_id)->pluck('Product_id');
                        if($rm_scrap->count()>0  && $rm_sap->count()==0){
                            $inputs.='<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" >RM Scrap</span>';
                            $row->statuscount+=1;
                        }
                    }


                    if($inputs ==""){
                        return "--";
                    }
                    return $inputs;
                })
                ->addColumn('status', function($row)use  ($authuser){
                    if($authuser =="R&D"){
                        if($row->specific_gravity!=null)
                            $row->status_val="Completed";
                        else
                           $row->status_val="Pending";
                    }
                    else if($authuser =="Tax"){
                        if($row->salesTax!=null)
                               $row->status_val="Completed";
                        else
                           $row->status_val="Pending";
                    }
                    else if($authuser =="Packaging"){
                        $pm_costs_ids=Product_Material::where('product_id',$row->pro_id)->get();
                        if($pm_costs_ids->count()>0)
                           $row->status_val="Completed";
                        else
                           $row->status_val="Pending";

                       }
                    else{
                       $row->status_val="";
                     }
                     if($row->status_val == "Completed" || $row->statuscount < 0)
                      return " <i class='bx bxs-circle text-success'></i>Completed";
                    else if($row->status_val == "Pending" || $row->statuscount >0)
                      return " <i class='bx bxs-circle text-danger'></i>Pending";
                    else
                       return "<i class='bx bxs-circle text-success'></i>Completed";

                })
                -> addColumn('duedate', function($row)  {
                    $due=Carbon::parse($row->created_at)->addDay()->format('d-m-Y H:i:s');
                    $duedate="";
                    $now= date("Y-m-d H:i:s");

                    if( $now > $row->created_at->addDays(1) && ($row->status_val =="Pending" || $row->statuscount >0))
                     $duedate="<span class='text-danger'>$due</span>";
                    else
                        $duedate=$due;
                    return $duedate;
                })
                ->rawColumns(['initiated_date','pendinginputs','status','duedate'])
                ->make(true);
            }
            else if($authuser == "PM Purchase"||$authuser=="RM Purchase"){
                if($authuser == "RM Purchase")
                   $data1=Rm_cost::groupBy("Product_id")->get();
                else
                    $data1=Product_Material::groupBy("product_id")->get();

                return Datatables::of($data1)
                ->addIndexColumn()
                ->addColumn('initiated_date', function($row){
                    $date=Carbon::parse($row->created_at)->format('d-m-Y H:i:s');
                    return $date;
                })
                ->addColumn('status', function($row) use ($authuser){
                    if($authuser == "RM Purchase")
                    $pm=Rm_cost::where("Product_id",$row->Product_id)->pluck('rate');
                     else
                    $pm=Product_Material::where("product_id",$row->product_id)->pluck('pm_cost');
                    if(in_array(null,collect($pm)->all())){
                        $row->status_val="Pending";
                    }else{
                        $row->status_val="Completed";
                    }
                    if($row->status_val =="Completed")
                    return " <i class='bx bxs-circle text-success'></i>Completed";
                    else
                    return " <i class='bx bxs-circle text-danger'></i>Pending";
                })
                ->addColumn('duedate', function($row){
                    $due=Carbon::parse($row->created_at)->addDay()->format('d-m-Y H:i:s');
                    $duedate="";
                    $now= date("Y-m-d H:i:s");

                    if( $now >$row->created_at->addDays(1) &&  $row->status_val=="Pending")
                     $duedate="<span class='text-danger'>$due</span>";
                    else
                        $duedate=$due;
                    return $duedate;
                })
                ->addColumn('Product_name', function($row) use ($authuser){
                    if($authuser == "RM Purchase")
                    $basics=Basic::where('pro_id',$row->Product_id)->first();
                    else
                    $basics=Basic::where('pro_id',$row->product_id)->first();
                    return $basics->Product_name;

                })
                ->addColumn('pro_id', function($row)use ($authuser){
                    if($authuser == "RM Purchase")
                    return $row->Product_id;
                    else
                    return $row->product_id;

                })

                ->rawColumns(['initiated_date','status','duedate','Product_name','product_id'])
                ->make(true);

            }
            else if($authuser == "Finance"){
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('initiated_date', function($row){
                    $date=Carbon::parse($row->created_at)->format('d-m-Y H:i:s');
                    return $date;
                })
                ->addColumn('pendinginputs', function($row){
                    $row->status_val=0;
                    $inputs='';
                    if($row->specific_gravity==null){
                        $inputs.='<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" >R&D:ingredients</span><br>';
                        $row->status_val+=1;
                    }
                    if($row->salesTax==null){
                        $inputs.= '<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" >Tax:Salestax</span><br>';
                        $row->status_val+=1;
                    }

                    $pm_costs_ids=Product_Material::where('product_id',$row->pro_id)->get();
                    if($pm_costs_ids->count()==0){
                        $inputs.='<span class="badge bg-success text-dark" style="color:white!important;background-color:#028AAE!important;" >Packaging:label</span><br>';
                        $row->status_val+=1;
                    }
                    $pm_costs_ids1=Primary_location::where('pro_id',$row->pro_id)->whereNull('cost')->get();
                    $sm_costs_ids=Secondary_location::where('pro_id',$row->pro_id)->whereNull('cost')->get();
                    if($pm_costs_ids1->count()>0 ){
                        $inputs.='<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" >Logistic:Pfrieght</span><br>';
                        $row->statuscount+=1;
                    }
                    if($sm_costs_ids->count()>0 ){
                        $inputs.='<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" >Logistic:Sfrieght</span><br>';
                        $row->statuscount+=1;
                    }
                    // operations
                    if( $row->conv_cost ==null){
                        $inputs.='<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" >Operations:Conv cost </span><br>';
                        $row->status_val+=1;
                    }
                    $pm_scrap= Product_Material::whereNull('scrap')->where('product_id',$row->pro_id)->groupby('product_id')->get();
                    if($pm_scrap->count()>0){
                        $inputs.='<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" >Operations:Pm Scrap</span><br>';
                        $row->status_val+=1;
                    }
                    $rmcost= Rm_cost::whereNotNull('sapcode')->where('Product_id',$row->pro_id)->groupby('Product_id')->get();
                    if($rmcost->count()>0){
                        if($row->plant == null){
                            $inputs.='<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" >Operations:Plant</span><br>';
                            $row->status_val+=1;
                        }
                    }
                    $rm_scrap= Rm_cost::whereNull('scrap')->where('Product_id',$row->pro_id)->pluck('Product_id');
                    $rm_sap= Rm_cost::whereNull('scrap')->whereNotNull('sapcode')->where('Product_id',$row->pro_id)->pluck('Product_id');
                    if($rm_scrap->count()>0  && $rm_sap->count()==0){
                        $inputs.='<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" >Operations:RM Scrap</span><br>';
                        $row->status_val+=1;
                    }
                    // PM RM
                    $pm=Product_Material::where("product_id",$row->pro_id)->pluck('pm_cost');
                    if($pm->count()>0){
                        if(in_array(null,collect($pm)->all())){
                            $inputs.='<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" >PM Purchase: cost</span><br>';
                            $row->status_val+=1;
                        }

                    }
                    $rm=Rm_cost::where("Product_id",$row->pro_id)->pluck('rate');

                    if($rm->count()>0){
                        if(in_array(null,collect($rm)->all())){
                            $inputs.='<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" >RM Purchase: rate</span><br>';
                            $row->status_val+=1;
                        }
                    }
                    if($row->damage==null){
                        $inputs.='<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" >Finance:Damages&logistics</span><br>';
                        $row->status_val+=1;
                    }
                    if($inputs ==""){
                        return "--";
                    }
                    return $inputs;

                })
                ->addColumn('status', function($row){
                    if($row->status_val!=0)
                         return  '<i class="bx bxs-circle text-danger"></i>Pending';
                    else
                        return  '<i class="bx bxs-circle text-success"></i>Completed';

                })

                ->rawColumns(['initiated_date','pendinginputs','status'])
                ->make(true);


            }

    }


    public function epdDashboardData(){
        $authuser = auth()->user()->role;
        $data = existing_product::where('status','!=',1)->orderBy('id','desc')->get();
            // if($authuser == "Marketing"){

                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('initiated_date', function($row){
                    $date = Carbon::parse($row->created_at)->format('d-m-Y H:i:s');
                    return $date;
                })
                -> addColumn('duedate', function($row)  {
                    $duedate = $row->created_at->addDays(1)->format('d-m-Y H:i:s');
                    $now = date("Y-m-d H:i:s");

                    if( $now > $row->created_at){

                        $location = EpdPrimaryLocations::where('pro_id','=', $row->epro_id)->where('freight','')->orderBy('id','desc')->first();
                        $seclocation = EpdSecondaryLocations::where('epro_id','=', $row->epro_id)->where('freight','')->orderBy('id','desc')->first();

                        if(!empty($location) || !empty($seclocation) || $row->salesTax == null || $row->damage == "" || $row->logistic == ""){
                            $duedate = "<span class='text-danger'>$duedate</span>";
                        }
                    }
                    return $duedate;
                })
                -> addColumn('pending_data', function($row)  {
                    $pdata='';

                    $authuser = auth()->user()->role;

                    if($authuser == "Logistic"){
                        $location = EpdPrimaryLocations::where('pro_id','=', $row->epro_id)->where('freight','')->orderBy('id','desc')->first();
                        if( !empty($location) ){
                            $pdata.= '<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" > Primary Freight</span><br>';
                        }

                        $seclocation = EpdSecondaryLocations::where('epro_id','=', $row->epro_id)->where('freight','')->orderBy('id','desc')->first();
                        if( !empty($seclocation) ){
                            $pdata.= '<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" > Secondary Freight</span><br>';
                        }
                    }

                    if($authuser == "Finance"){
                        if($row->salesTax == null){
                            $pdata.= '<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" >Tax Team: Salestax</span><br>';
                        }

                        if($row->specific_gravity == 0){
                            $pdata.= '<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" >R&D Team: Specific Gravity</span><br>';
                        }

                        $location = EpdPrimaryLocations::where('pro_id','=', $row->epro_id)->where('freight','')->orderBy('id','desc')->first();
                        if( !empty($location) ){
                            $pdata.= '<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" >Logistic Team: Primary Freight</span><br>';
                        }

                        $seclocation = EpdSecondaryLocations::where('epro_id','=', $row->epro_id)->where('freight','')->orderBy('id','desc')->first();
                        if( !empty($seclocation) ){
                            $pdata.= '<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" >Logistic Team: Secondary Freight</span><br>';
                        }

                        if($row->damage == ''){
                            $pdata.= '<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" >Finance Team: Damage</span><br>';
                        }

                        if($row->logistic == ''){
                            $pdata.= '<span class="badge bg-success text-dark" style="color:white!important;background-color: #028AAE!important;" >Finance Team: Logistic</span><br>';
                        }
                    }

                    if($pdata ==''){
                        return "--";
                    }

                    return $pdata;
                })
                ->addColumn('status', function($row){
                    $authuser = auth()->user()->role;
                    if($authuser == "Tax"){
                        if(!empty($row->salesTax) ){
                            return  '<i class="bx bxs-circle text-success"></i> Completed';
                        }else{
                            return  '<i class="bx bxs-circle text-danger"></i> Pending';
                        }

                    }else if($authuser == "Logistic"){

                        $location = EpdPrimaryLocations::where('pro_id','=', $row->epro_id)->where('freight','')->orderBy('id','desc')->first();
                        $seclocation = EpdSecondaryLocations::where('epro_id','=', $row->epro_id)->where('freight','')->orderBy('id','desc')->first();
                        if(empty($location) && empty($seclocation) ){
                            return  '<i class="bx bxs-circle text-success"></i> Completed';
                        }else{
                            return  '<i class="bx bxs-circle text-danger"></i> Pending';
                        }

                    }else if($authuser == "Finance"){
                        $location = EpdPrimaryLocations::where('pro_id','=', $row->epro_id)->where('freight','')->orderBy('id','desc')->first();
                        $seclocation = EpdSecondaryLocations::where('epro_id','=', $row->epro_id)->where('freight','')->orderBy('id','desc')->first();
                        if(empty($location) && empty($seclocation) && $row->salesTax != null && $row->damage != "" && $row->logistic != ""){
                            return  '<i class="bx bxs-circle text-success"></i> Completed';
                        }else{
                            return  '<i class="bx bxs-circle text-danger"></i> Pending';
                        }
                    }else if($authuser == "R&D"){
                        if($row->specific_gravity != 0 ){
                            return  '<i class="bx bxs-circle text-success"></i> Completed';
                        }else{
                            return  '<i class="bx bxs-circle text-danger"></i> Pending';
                        }
                    }else if($authuser == "RM Purchase"){
                        if(!empty($row->rmcost) ){
                            return  '<i class="bx bxs-circle text-success"></i> Completed';
                        }else{
                            return  '<i class="bx bxs-circle text-danger"></i> Pending';
                        }
                    }else if($authuser == "PM Purchase"){
                        if(!empty($row->pmcost) ){
                            return  '<i class="bx bxs-circle text-success"></i> Completed';
                        }else{
                            return  '<i class="bx bxs-circle text-danger"></i> Pending';
                        }
                    }else{
                        return  '<i class="bx bxs-circle text-danger"></i> Pending';
                    }

                })
                ->rawColumns(['initiated_date','duedate','status','pending_data'])
                ->make(true);
            // }
    }



}
