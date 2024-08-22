<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\User;
use App\Models\Basic;
use App\Models\LocationMaster;
use App\Models\Rm_cost;
use App\Models\Division;
use App\Models\Product_Material;
use App\Models\existing_product;
use App\Models\MedRequest;
use App\Models\ExMedRequest;
use App\Models\Primary_location;
use App\Models\Secondary_location;
use App\Models\EpdPrimaryLocations;
use App\Models\EpdSecondaryLocations;
use App\Models\SecondaryLocationHistory;
use App\Models\RmCostHistory;
use App\Models\MoqHistory;
use App\Models\dist_channel;
use App\Models\BasicsHistory;
use App\Models\EpdRejectHistory;
use App\Models\PrimaryLocationHistory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer as Writer;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use App\Exports\CostSheetExport;
use App\Exports\EPDCostSheetExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class FinnanceController extends Controller
{

    public function fetch_basic_buss(Request $request)
    {
        $authuser=auth()->user()->id;
        if(isset($request->rej)){
            $data = Basic::select('*')
            ->orderby('id','desc')->where('b_logistic_approval',2)->where('logistic_user',$authuser)->orWhere('b_damage_approval',2)->get();
            $sts="rej";
        }else if(isset($request->app)){
            $data = Basic::select('*')
            ->orderby('id','desc')->where('b_logistic_approval',1)->where('b_damage_approval',1)->get();
            $sts="app";
        }else{
            $data = Basic::select('*')
            ->orderby('id','desc')->where('b_logistic_approval',0)->where('b_damage_approval',0)->get();
            $sts="";
        }


        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) use ($sts){

                if(($row->logistic!=null && $row->b_logistic_approval==0 && $row->damage!=null && $row->b_damage_approval==0)|| ($row->logistic!=null && $row->b_logistic_approval==1 && $row->damage!=null && $row->b_damage_approval==1)){
                        $btn  = '<a id="add_id" class="btn btn-success btn-sm" onclick="openmodel('.$row->id.',1)" >View</a>';
                }else if($row->b_logistic_approval==2 ||$row->b_damage_approval==2){
                        $btn  = '<a id="add_id" class="btn btn-success btn-sm" onclick="openmodel('.$row->id.',2)" >Update</a>';

                }else{
                    $btn  = '<a id="add_id" class="btn btn-primary btn-sm" onclick="openmodel('.$row->id.',3)" >Add Info</a>';

                }
                return $btn;
            })
            ->addColumn('rejected', function($row){
                $rej='';
                if($row->b_logistic_approval == 2){
                   $rej.= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff00b0!important;" >Logistic</span>';
                }if($row->b_damage_approval == 2){
                   $rej.= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff00b0!important;" >Damages</span>';
                }
                return $rej;

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
            ->rawColumns(['action','version','rejected','remarks','division'])
            ->make(true);
    }

    public function fetch_basic_prod()
    {
        $data = Basic::select('*')->orderby('id','desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('retailer_margins', function($row){
                $location = Primary_location::where('pro_id','=', $row->pro_id)->get();
                $p_loc = '';
                foreach ($location as $locations){
                    $p_loc .= '<span class="badge badge-danger" style="background-color: #D6D3D3;color:#000000c7;">'. $locations->retailer_margin.'%</span><br>';
                }
                return $p_loc;
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
            ->addColumn('primary_scheme', function($row){
                $location = Primary_location::where('pro_id','=', $row->pro_id)->get();
                $p_loc = '';
                foreach ($location as $locations){
                    $p_loc .= '<span class="badge badge-danger" style="background-color: #D6D3D3;color:#000000c7;">'. $locations->primary_scheme.'%</span><br>';
                }
                return $p_loc;
            })
            ->addColumn('rs_margin', function($row){
                $location = Primary_location::where('pro_id','=', $row->pro_id)->get();
                $p_loc = '';
                foreach ($location as $locations){
                    $p_loc .= '<span class="badge badge-danger" style="background-color: #D6D3D3;color:#000000c7;">'. $locations->rs_margin.'%</span><br>';
                }
                return $p_loc;
            })
            ->addColumn('ss_margin', function($row){
                $location = Primary_location::where('pro_id','=', $row->pro_id)->get();
                $p_loc = '';
                foreach ($location as $locations){
                    $p_loc .= '<span class="badge badge-danger" style="background-color: #D6D3D3;color:#000000c7;">'. $locations->ss_margin.'%</span><br>';
                }
                return $p_loc;
            })
            ->addColumn('from_to_locate', function($row){
                $location = Primary_location::where('pro_id','=', $row->pro_id)->select('from_location','to_location')->get();
                $p_loc = '';
                foreach ($location as $locations){
                    $pf_location=LocationMaster::find($locations->from_location);
                    $pt_location=LocationMaster::find($locations->to_location);

                    $p_loc .= '<span class="badge badge-secondary" style="background-color: #21c4b1ab;color:#000000c7;">'. $pf_location->location .' - '.$pt_location->location.' </span>';
                }
                // $locate = $p_loc;
                return $p_loc;
            })
            ->addColumn('sec_location', function($row){
                $slocation = Secondary_location::where('pro_id','=', $row->pro_id)->select('from_location','to_location')->get();
                $sec_loc = '';
                foreach ($slocation as $sec){
                    $sf_location=LocationMaster::find($sec->from_location);
                    $st_location=LocationMaster::find($sec->to_location);

                    $sec_loc .= '<span class="badge badge-secondary" style="background-color: #0ce024a6;color:#000000c7;">'. $sf_location->location .' - '.$st_location->location.' </span>';
                }
                return $sec_loc;
            })
            // ->addColumn('action', function($row){
            //     $btn  = '<a class="btn btn-success btn-sm" onclick="bf_approve('.$row->id.')" ><i class="bx bx-check icon nav-icon"></i></a>';
            //     return $btn;
            // })
            ->addColumn('version', function($row){
                $version  = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
                return $version;
            })
            // 'action',
            ->rawColumns(['retailer_margins','division','primary_scheme','rs_margin','ss_margin','version','from_to_locate','sec_location'])
            ->make(true);
    }


    public function approved_product()
    {
        $data = Basic::orderby('id','desc')->get()->unique('pro_id');

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('retailer_margin', function($row){
                $retail_margin = $row->retailer_margin.'%';
                return $retail_margin;
            })
            ->addColumn('primary_scheme', function($row){
                return $row->primary_scheme.'%';
            })
            ->addColumn('rs_margin', function($row){
                return $row->rs_margin.'%';
            })
            ->addColumn('ss_margin', function($row){
                return $row->ss_margin.'%';
            })
            ->addColumn('version', function($row){
                $version  = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
                return $version;
            })

            ->rawColumns(['retail_margin','primary_scheme','rs_margin','ss_margin','version'])
            ->make(true);
    }


    public function rejected_prod()
    {
        $data = Basic::where('bf_product_approval','Rejected')->select('*');
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('retailer_margin', function($row){
                $retail_margin = $row->retailer_margin.'%';
                return $retail_margin;
            })
            ->addColumn('primary_scheme', function($row){
                return $row->primary_scheme.'%';
            })
            ->addColumn('rs_margin', function($row){
                return $row->rs_margin.'%';
            })
            ->addColumn('ss_margin', function($row){
                return $row->ss_margin.'%';
            })
            ->addColumn('version', function($row){
                $version  = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
                return $version;
            })

            ->rawColumns(['retail_margin','primary_scheme','rs_margin','ss_margin','version'])
            ->make(true);
    }


    public function fetch_finance_data(Request $request)
    {
        $id = $request->id;
        $data = Basic::where('id',$id)->first();
        return response()->json([
            'result' => $data
        ]);
    }

    public function fetch_basic_cost()
    {
        // Join basics and product materials table
        $primary_data=Primary_location::all();

        $data = Basic::join('product__materials', 'basics.pro_id', '=', 'product__materials.product_id')->join('secondary_locations','basics.pro_id','=','secondary_locations.pro_id')->join('primary_locations','basics.pro_id','=','primary_locations.pro_id')
        ->select('basics.*')
        ->where("basics.status",3)->whereNotNull("basics.logistic")->whereNotNull("secondary_locations.cost")->whereNotNull("primary_locations.cost")->whereNotNull("primary_locations.rs_margin")->whereNotNull("basics.specific_gravity")->whereNotNull("basics.conv_cost")
        ->whereNotNull("basics.damage")->whereNotNull("basics.salesTax")->whereNotNull('basics.fg_scrap')->groupBy('basics.pro_id');
        if(auth()->user()->role == 'Finance'){
            $data =$data->where('basics.csheet_approval','Pending');
        }
        if(auth()->user()->role == 'Marketing'){
            $data =$data->where('basics.csheet_approval','Approved')
            ->where('basics.mt_csheet_approval','Pending');
        }
        $data =$data->whereNotNull("product__materials.MOQ")
        ->latest('basics.created_at')
        ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn  = '<a href="'.url('/').'/viewcostsheet/'.$row->id.'" id="add_id" class="btn btn-primary btn-sm" style="margin-right:1px">View</a>';
                $btn .= '<a href="'.url('/').'/export/'.$row->id.'" id="add_id" class="btn btn-primary btn-sm" >Download</a>';
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

    public function save_finnance(Request $request)
    {
        $id = $request->hid_name;
        $authuser=auth()->user()->id;
        $logistic_date=date('Y-m-d H:i:s');
        if(isset($request->damage_name)){
            Basic::where('id',$id)->update(['damage'=>$request->damage_name,'b_damage_approval'=>0]);

        }if(isset($request->logistic_name)){
            Basic::where('id',$id)->update(['b_logistic_approval'=>0,'logistic'=>$request->logistic_name]);

        }
        Basic::where('id',$id)->update(['logistic_user'=> $authuser,'logistic_date'=>$logistic_date]);
        return response()->json([
            'status' => 'success'
        ]);
    }

    // public function reject_prod(Request $request)
    // {
    //     $id = $request->id;
    //     Basic::where('id',$id)->update(['bf_product_approval'=>'Rejected']);
    //     return response()->json([
    //         'status' => 'success'
    //     ]);
    // }

    // public function approve_rmscrap(Request $request)
    // {
    //     $id = $request->id;
    //     Basic::where('id',$id)->update(['bf_rm_scrap_approval'=>'Approved']);
    //     return response()->json([
    //         'status' => 'success'
    //     ]);
    // }

    // public function reject_rmscrap(Request $request)
    // {
    //     $id = $request->id;
    //     Basic::where('id',$id)->update(['bf_rm_scrap_approval'=>'Rejected']);
    //     return response()->json([
    //         'status' => 'success'
    //     ]);
    // }


    // public function approve_pmscrap(Request $request)
    // {
    //     $id = $request->id;
    //     Basic::where('id',$id)->update(['bf_pm_scrap_approval'=>'Approved']);
    //     return response()->json([
    //         'status' => 'success'
    //     ]);
    // }

    // public function reject_pmscrap(Request $request)
    // {
    //     $id = $request->id;
    //     Basic::where('id',$id)->update(['bf_pm_scrap_approval'=>'Rejected']);
    //     return response()->json([
    //         'status' => 'success'
    //     ]);
    // }

    // public function approve_rmcost(Request $request)
    // {
    //     $id = $request->id;
    //     Basic::where('id',$id)->update(['bf_rm_cost_approval'=>'Approved']);
    //     return response()->json([
    //         'status' => 'success'
    //     ]);
    // }

    // public function reject_rmcost(Request $request)
    // {
    //     $id = $request->id;
    //     Basic::where('id',$id)->update(['bf_rm_cost_approval'=>'Rejected']);
    //     return response()->json([
    //         'status' => 'success'
    //     ]);
    // }

    // public function approve_pmcost(Request $request)
    // {
    //     $id = $request->id;
    //     Basic::where('id',$id)->update(['bf_pm_cost_approval'=>'Approved']);
    //     return response()->json([
    //         'status' => 'success'
    //     ]);
    // }

    // public function reject_pmcost(Request $request)
    // {
    //     $id = $request->id;
    //     Basic::where('id',$id)->update(['bf_pm_cost_approval'=>'Rejected']);
    //     return response()->json([
    //         'status' => 'success'
    //     ]);
    // }

    // public function approve_ccost(Request $request)
    // {
    //     $id = $request->id;
    //     Basic::where('id',$id)->update(['bf_ccost_approval'=>'Approved']);
    //     return response()->json([
    //         'status' => 'success'
    //     ]);
    // }

    // public function reject_ccost(Request $request)
    // {
    //     $id = $request->id;
    //     Basic::where('id',$id)->update(['bf_ccost_approval'=>'Rejected']);
    //     return response()->json([
    //         'status' => 'success'
    //     ]);
    // }


    // public function approve_freight(Request $request)
    // {
    //     $id = $request->id;
    //     Basic::where('id',$id)->update(['bf_freight_approval'=>'Approved']);
    //     return response()->json([
    //         'status' => 'success'
    //     ]);
    // }

    // public function reject_freight(Request $request)
    // {
    //     $id = $request->id;
    //     Basic::where('id',$id)->update(['bf_freight_approval'=>'Rejected']);
    //     return response()->json([
    //         'status' => 'success'
    //     ]);
    // }


    // public function approve_npdsheet(Request $request)
    // {
    //     $id = $request->id;
    //     Basic::where('id',$id)->update(['csheet_approval'=>'Approved']);
    //     return response()->json([
    //         'status' => 'success'
    //     ]);
    // }

    // public function reject_npdsheet(Request $request)
    // {
    //     $id = $request->id;
    //     Basic::where('id',$id)->update(['csheet_approval'=>'Rejected']);
    //     return response()->json([
    //         'status' => 'success'
    //     ]);
    // }

    // public function approve_tax(Request $request)
    // {
    //     $id = $request->id;
    //     Basic::where('id',$id)->update(['tax_approval'=>'Approved']);
    //     return response()->json([
    //         'status' => 'success'
    //     ]);
    // }

    // public function reject_tax(Request $request)
    // {
    //     $id = $request->id;
    //     Basic::where('id',$id)->update(['tax_approval'=>'Rejected']);
    //     return response()->json([
    //         'status' => 'success'
    //     ]);
    // }


    // public function approve_rmformu_cost(Request $request)
    // {
    //     $id = $request->id;
    //     Basic::where('id',$id)->update(['bf_ingic_approval'=>'Approved']);
    //     return response()->json([
    //         'status' => 'success'
    //     ]);
    // }

    // public function reject_rmformu_cost(Request $request)
    // {
    //     $id = $request->id;
    //     Basic::where('id',$id)->update(['bf_ingic_approval'=>'Rejected']);
    //     return response()->json([
    //         'status' => 'success'
    //     ]);
    // }

    // public function approved_rm_cost(Request $request)
    // {
    //     $data = Basic::select('*')
    //             ->where('status', '3')
    //             ->where('bf_product_approval', 'Approved')
    //             ->where('bf_rm_cost_approval', 'Approved')
    //             ->orderby('id', 'desc')
    //             ->get()->unique('pro_id');
    //     $table = array();
    //     $i = 1;
    //     foreach ($data as $row) {
    //     $table1 = array();
    //     $table1['Product_Name'] = $row->Product_name;
    //     $table1['version'] = $row->version;
    //     $table1['Fill_Volume'] = $row->Volume.''.$row->uom;
    //     $table1['Cofiguration'] = $row->case_configuration;
    //     $table1['Quantity'] = $row->quantity;
    //     $table1['version'] = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
    //     $table1['Action1']='<button type="button" class="btn btn-primary btn-sm" onclick="rmcost_show('.$row->id.')"><i class="bx bx-show icon nav-icon"></i></button>';
    //     $table[] = $table1;
    //     $i++;
    //     }
    //     $response = array(
    //     "data" => $table
    //     );
    //     echo json_encode($response);
    // }

    // public function rejected_rmcost(Request $request)
    // {
    //     $data = Basic::select('*')
    //             ->where('status', '3')
    //             ->where('bf_product_approval', 'Approved')
    //             ->where('bf_rm_cost_approval', 'Rejected')
    //             ->get();
    //     $table = array();
    //     $i = 1;
    //     foreach ($data as $row) {
    //     $table1 = array();
    //     $table1['Product_Name'] = $row->Product_name;
    //     $table1['Fill_Volume'] = $row->Volume.''.$row->uom;
    //     $table1['Cofiguration'] = $row->case_configuration;
    //     $table1['Quantity'] = $row->quantity;
    //     $table1['version'] = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
    //     $table1['Action1']='<button type="button" class="btn btn-primary btn-sm" onclick="rmcost_show('.$row->id.')"><i class="bx bx-show icon nav-icon"></i></button>';
    //     $table[] = $table1;
    //     $i++;
    //     }
    //     $response = array(
    //     "data" => $table
    //     );
    //     echo json_encode($response);
    // }


    // public function approved_rmscrap(Request $request)
    // {
    //     $data = Basic::select('*')
    //             ->where('status', '3')
    //             ->where('bf_product_approval', 'Approved')
    //             ->where('bf_rm_scrap_approval', 'Approved')
    //             ->orderby('id', 'desc')
    //             ->get()->unique('pro_id');
    //     $table = array();
    //     $i = 1;
    //     foreach ($data as $row) {
    //     $table1 = array();
    //     $table1['Product_Name'] = $row->Product_name;
    //     $table1['version'] = $row->version;
    //     $table1['Fill_Volume'] = $row->Volume.''.$row->uom;
    //     $table1['Cofiguration'] = $row->case_configuration;
    //     $table1['Quantity'] = $row->quantity;
    //     $table1['version'] = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
    //     $table1['Action1']='<button type="button" class="btn btn-primary btn-sm" onclick="rmscrap_show('.$row->id.')"><i class="bx bx-show icon nav-icon"></i></button>';
    //     $table[] = $table1;
    //     $i++;
    //     }
    //     $response = array(
    //     "data" => $table
    //     );
    //     echo json_encode($response);
    // }

    // public function rejected_rmscrap(Request $request)
    // {
    //     $data = Basic::select('*')
    //             ->where('status', '3')
    //             ->where('bf_product_approval', 'Approved')
    //             ->where('bf_rm_scrap_approval', 'Rejected')
    //             ->get();
    //     $table = array();
    //     $i = 1;
    //     foreach ($data as $row) {
    //     $table1 = array();
    //     $table1['Product_Name'] = $row->Product_name;
    //     $table1['Fill_Volume'] = $row->Volume.''.$row->uom;
    //     $table1['Cofiguration'] = $row->case_configuration;
    //     $table1['Quantity'] = $row->quantity;
    //     $table1['version'] = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
    //     $table1['Action1']='<button type="button" class="btn btn-primary btn-sm" onclick="rmscrap_show('.$row->id.')"><i class="bx bx-show icon nav-icon"></i></button>';
    //     $table[] = $table1;
    //     $i++;
    //     }
    //     $response = array(
    //     "data" => $table
    //     );
    //     echo json_encode($response);
    // }

    // public function approved_pmscrap(Request $request)
    // {
    //     $data = Basic::select('*')
    //             ->where('status', '3')
    //             ->where('bf_product_approval', 'Approved')
    //             ->where('bf_pm_scrap_approval', 'Approved')
    //             ->orderby('id', 'desc')
    //             ->get()->unique('pro_id');
    //     $table = array();
    //     $i = 1;
    //     foreach ($data as $row) {
    //     $table1 = array();
    //     $table1['Product_Name'] = $row->Product_name;
    //     $table1['version'] = $row->version;
    //     $table1['Fill_Volume'] = $row->Volume.''.$row->uom;
    //     $table1['Cofiguration'] = $row->case_configuration;
    //     $table1['Quantity'] = $row->quantity;
    //     $table1['version'] = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
    //     $table1['Action1']='<button type="button" class="btn btn-primary btn-sm" onclick="pmscrap_show('.$row->id.')"><i class="bx bx-show icon nav-icon"></i></button>';
    //     $table[] = $table1;
    //     $i++;
    //     }
    //     $response = array(
    //     "data" => $table
    //     );
    //     echo json_encode($response);
    // }

    // public function rejected_pmscrap(Request $request)
    // {
    //     $data = Basic::select('*')
    //             ->where('status', '3')
    //             ->where('bf_product_approval', 'Approved')
    //             ->where('bf_pm_scrap_approval', 'Rejected')
    //             ->get();
    //     $table = array();
    //     $i = 1;
    //     foreach ($data as $row) {
    //     $table1 = array();
    //     $table1['Product_Name'] = $row->Product_name;
    //     $table1['Fill_Volume'] = $row->Volume.''.$row->uom;
    //     $table1['Cofiguration'] = $row->case_configuration;
    //     $table1['Quantity'] = $row->quantity;
    //     $table1['version'] = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
    //     $table1['Action1']='<button type="button" class="btn btn-primary btn-sm" onclick="pmscrap_show('.$row->id.')"><i class="bx bx-show icon nav-icon"></i></button>';
    //     $table[] = $table1;
    //     $i++;
    //     }
    //     $response = array(
    //     "data" => $table
    //     );
    //     echo json_encode($response);
    // }


    // public function approved_ccost()
    // {
    //     $data = Basic::select('*')
    //     ->where('bf_product_approval','Approved')
    //     ->where('bf_ccost_approval','Approved')
    //     ->orderby('id','desc')->get()->unique('pro_id');

    //     return Datatables::of($data)
    //     ->addIndexColumn()
    //     ->addColumn('volume', function($row){
    //         $btn  = $row->Volume.''.$row->uom;
    //         return $btn;
    //     })
    //     ->addColumn('conv_cost', function($row){
    //         $btn  = $row->conv_cost.''.$row->conv_uom;
    //         return $btn;
    //     })
    //     ->addColumn('version', function($row){
    //         $version  = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
    //         return $version;
    //     })
    //     ->rawColumns(['volume','conv_cost','version'])
    //     ->make();
    // }

    // public function rejected_ccost()
    // {
    //     $data = Basic::select('*')
    //     ->where('bf_product_approval','Approved')
    //     ->where('bf_ccost_approval','Rejected')
    //     ->orderby('id','desc')->get();

    //     return Datatables::of($data)
    //     ->addIndexColumn()
    //     ->addColumn('volume', function($row){
    //         $btn  = $row->Volume.''.$row->uom;
    //         return $btn;
    //     })
    //     ->addColumn('conv_cost', function($row){
    //         $btn  = $row->conv_cost.''.$row->conv_uom;
    //         return $btn;
    //     })
    //     ->addColumn('version', function($row){
    //         $version  = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
    //         return $version;
    //     })
    //     ->rawColumns(['volume','conv_cost','version'])
    //     ->make();
    // }

    // public function approved_freight()
    // {
    //     $data = Basic::select('*')
    //     ->where('bf_product_approval','Approved')
    //     ->where('bf_freight_approval','Approved')
    //     ->orderby('id','desc')->get()->unique('pro_id');

    //     return Datatables::of($data)
    //     ->addIndexColumn()
    //     ->addColumn('volume', function($row){
    //         $btn  = $row->Volume.''.$row->uom;
    //         return $btn;
    //     })
    //     ->addColumn('version', function($row){
    //         $version  = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
    //         return $version;
    //     })
    //     ->rawColumns(['volume','version'])
    //     ->make();
    // }

    // public function rejected_freight()
    // {
    //     $data = Basic::select('*')
    //     ->where('bf_product_approval','Approved')
    //     ->where('bf_freight_approval','Rejected')
    //     ->orderby('id','desc')->get();

    //     return Datatables::of($data)
    //     ->addIndexColumn()
    //     ->addColumn('volume', function($row){
    //         $btn  = $row->Volume.''.$row->uom;
    //         return $btn;
    //     })
    //     ->addColumn('version', function($row){
    //         $version  = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
    //         return $version;
    //     })
    //     ->rawColumns(['volume','version'])
    //     ->make();
    // }


    public function approved_npdsheet()
    {
        $data = Basic::where('csheet_approval',"!=",'Pending');
        if(auth()->user()->role == 'Finance'){
            $data = $data->where('csheet_approval','Approved');
        }
        if(auth()->user()->role == 'Marketing'){
            $data =$data->where('csheet_approval','Approved')->where('mt_csheet_approval', 'Approved');
        }
        $data =$data->latest()->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn  = '<a href="'.url('/').'/viewcostsheet/'.$row->id.'" id="add_id" class="btn btn-primary btn-sm" style="margin-right:1px">View</a>';
                $btn .= '<a href="'.url('/').'/export/'.$row->id.'" id="add_id" class="btn btn-primary btn-sm" >Download</a>';
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

    public function rejected_npdsheet()
    {
        $data = Basic::where('csheet_approval',"!=",'Pending');
        if(auth()->user()->role == 'Finance'){
            $data = $data->where('csheet_approval','Rejected');
        }
        if(auth()->user()->role == 'Marketing'){
            $data =$data->where('csheet_approval','Approved')->where('mt_csheet_approval', 'Rejected');
        }
        $data =$data->latest()->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn  = '<a href="'.url('/').'/viewcostsheet/'.$row->id.'" id="add_id" class="btn btn-primary btn-sm" style="margin-right:1px">View</a>';
                $btn .= '<a href="'.url('/').'/export/'.$row->id.'" id="add_id" class="btn btn-primary btn-sm" >Download</a>';
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

    // public function approved_pm_cost()
    // {
    //     $data = Basic::select('*')
    //             ->where('status', '3')
    //             ->where('bf_product_approval', 'Approved')
    //             ->where('bf_pm_cost_approval', 'Approved')
    //             ->orderby('id', 'desc')
    //             ->get()->unique('pro_id');

    //     return Datatables::of($data)
    //     ->addIndexColumn()
    //     ->addColumn('action', function($row){
    //         $btn  = '<a class="edit btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl" onclick="openpmview('.$row->id.')"><i class="bx bx-show icon nav-icon"></i></a>';
    //         return $btn;
    //     })
    //     ->addColumn('volume', function($row){
    //         $volume  = $row->Volume.''.$row->uom;
    //         return $volume;
    //     })
    //     ->addColumn('version', function($row){
    //         $version  = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
    //         return $version;
    //     })
    //     ->rawColumns(['action','volume','version'])
    //     ->make(true);
    // }


    // public function rejected_pmcost()
    // {
    //     $data = Basic::select('*')
    //         ->where('status', '3')
    //         ->where('bf_product_approval', 'Approved')
    //         ->where('bf_pm_cost_approval', 'Rejected')
    //         ->orderby('id', 'desc')
    //         ->get()->unique('pro_id');

    //     return Datatables::of($data)
    //     ->addIndexColumn()
    //     ->addColumn('action', function($row){
    //         $btn  = '<a class="edit btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl" onclick="openpmview('.$row->id.')"><i class="bx bx-show icon nav-icon"></i></a>';
    //         return $btn;
    //     })
    //     ->addColumn('volume', function($row){
    //         $volume  = $row->Volume.''.$row->uom;
    //         return $volume;
    //     })
    //     ->addColumn('version', function($row){
    //         $version  = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
    //         return $version;
    //     })
    //     ->rawColumns(['action','volume','version'])
    //     ->make(true);
    // }

    public function get_ingre_comp()
    {
        $data = Basic::select('*')
        ->where('specific_gravity','!=',null)
        ->orderby('id','desc')->get()->unique('pro_id');
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn  = '<a class="edit btn btn-success btn-sm" onclick="openmodel('.$row->id.')" ><i class="bx bx-show icon nav-icon"></i></a>';
                return $btn;
            })
            ->addColumn('version', function($row){
                $version  = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
                return $version;
            })
            // 'action',
            ->rawColumns(['action','version'])
            ->make(true);
    }


    // public function approved_rmform()
    // {
    //     $data = Basic::select('*')
    //     ->where('bf_product_approval','Approved')
    //     ->where('bf_ingic_approval','Approved')
    //     ->where('specific_gravity','!=',null)
    //     ->orderby('id','desc')->get()->unique('pro_id');
    //     return Datatables::of($data)
    //         ->addIndexColumn()
    //         ->addColumn('action', function($row){
    //             $btn  = '<a class="edit btn btn-primary btn-sm" onclick="openmodel2('.$row->id.')" ><i class="bx bx-show icon nav-icon"></i></a>';
    //             return $btn;
    //         })
    //         ->addColumn('version', function($row){
    //             $version  = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
    //             return $version;
    //         })
    //         ->rawColumns(['action','version'])
    //         ->make(true);
    // }

    // public function rejected_rmform()
    // {
    //     $data = Basic::select('*')
    //     ->where('bf_product_approval','Approved')
    //     ->where('bf_rm_cost_approval','Approved')
    //     ->where('bf_pm_cost_approval','Approved')
    //     ->where('bf_ingic_approval','Rejected')
    //     ->where('specific_gravity','!=',null);
    //     return Datatables::of($data)
    //         ->addIndexColumn()
    //         ->addColumn('action', function($row){
    //             $btn  = '<a id="add_id" class="edit btn btn-primary btn-sm" onclick="openmodel2('.$row->id.')" ><i class="bx bx-show icon nav-icon"></i></a>';
    //             return $btn;
    //         })
    //         ->addColumn('version', function($row){
    //             $version  = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
    //             return $version;
    //         })
    //         ->rawColumns(['action','version'])
    //         ->make(true);
    // }


    public function get_tax()
    {
        $data = Basic::select('*')
        ->where('salesTax','!=','')
        ->orderby('id','desc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            // ->addColumn('action', function($row){
            //     $btn  = '<a class="btn btn-success btn-sm" onclick="btax_approve('.$row->id.')" ><i class="bx bx-check icon nav-icon" style="font-weight: 1000;"></i></a>';
            //     return $btn;
            // })
            ->addColumn('version', function($row){
                $version  = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
                return $version;
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
            ->rawColumns(['version','division'])
            ->make(true);
    }


    // public function approved_tax(Request $request)
    // {
    //     $data = Basic::select('*')
    //     ->where('bf_product_approval','Approved')
    //     ->where('salesTax','!=','')
    //     ->where('hsnCode','!=','');

    //     if($request->tax == 'approved'){
    //         $data = $data->where('tax_approval','Approved');
    //         $data = $data->orderby('id','desc')->get()->unique('pro_id');
    //     }else{
    //         $data = $data->where('tax_approval','Rejected');
    //         $data = $data->orderby('id','desc')->get();
    //     }

    //     return Datatables::of($data)
    //         ->addIndexColumn()
    //         ->addColumn('version', function($row){
    //             $version  = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
    //             return $version;
    //         })
    //         ->rawColumns(['version'])
    //         ->make(true);
    // }

    public function viewcostsheet(Request $request ,$id)
    {
        $data['basic'] =  Basic::where('id',$id)->select('*')->first();
        $basic = $data['basic'];

        $logistics=$basic->logistic/100;
        $damages=$basic->damage/100;
        $stax=$basic->salesTax/100;
        $dist_channel=dist_channel::find( $basic->distribution_value);
        $data['dist_channel']=$dist_channel->dist_name;
        $data['rm_costs'] = Rm_cost::where('Product_id',$basic->pro_id)
                        // ->where('version',$basic->version)
                        ->select('*')->get();

                        $data['rmCost'] = Rm_cost::where('b_id',$id)->first();
                        $data['rmCostValue'] = Rm_cost::where('b_id',$id)->get(['scrap','Ingredient','id']);


        $data['location']=Primary_location::where('pro_id',$basic->pro_id)->get();
        $secfreight=Secondary_location::where('pro_id',$basic->pro_id)->get();
        $data['sec_location']=Secondary_location::where('pro_id',$basic->pro_id)->get();
        $data['to_location']=[];
        foreach($data['location'] as $key =>$frmloc ){
            $frml=LocationMaster::find($frmloc->from_location);
            $tol=LocationMaster::find($frmloc->to_location);
            $data['from_location'][]=$frml->location;
            $data['to_location'][]=$tol->location;
            $data['secfreight'][]=$secfreight[$key]->cost;
            
        }

        $data['product_material'] = Product_Material::where('product_id',$basic->pro_id)
                            // ->where('version',$basic->version)
                            ->select('*')->get();



        // dd($data['rm_costs']);

        // $data['nmval']
        $data['volume'] =  round(($basic->Volume/1000),2);
        $data['mrp'] = round($basic->mrp_price*$basic->case_configuration ,2);


        $data['total']=[];
        $data['total1']=[];
        $data['material']=[];
        $data['moq']=[];
        $total_rm=0;
        $total_rm1=0;

        foreach ($data['product_material'] as $product_material) {
            $totals=json_decode($product_material->pm_cost);
            $data['moq'][]=json_decode($product_material->MOQ);
            $data['material'][]=$product_material->material;
            $data['materialId'][]=$product_material->id;
            $data['labelId'][]=$product_material->id;
            $data['moqStatus'][]=json_decode($product_material->p_moq_approval);
            if(isset($totals[0])){
                $summ_moq=array_sum($totals);
                $data['total'][]= $totals;
                $data['total1']= $totals[0]/$basic->case_configuration;
                $total_rm+= $summ_moq;
                $total_rm1+= $summ_moq/$basic->case_configuration;
            }else{
                $data['total'][]= 0;
                $data['total1']= 0;
                $total_rm+=0;
                $total_rm1+=0;
            }

        }
        $data['fillvolume']=$basic->Volume*$basic->case_configuration;


        $cg=0;
        foreach($data['location'] as $loc ){

            $rsmargin=$loc->rs_margin/100;
            $ssmargin=$loc->ss_margin/100;
            $primary_scheme=$loc->primary_scheme/100;
            $retailer_margin=$loc->retailer_margin/100;


            if($primary_scheme >1 || $retailer_margin >1 ){
                $data['landed_retailer'] = round($data['mrp']*(1-$retailer_margin)/(1-$primary_scheme) ,2);
            }else{
                $data['landed_retailer']=0;
            }

            $data['landed_cost_to_rs'] = round($data['landed_retailer']/(1+$rsmargin) ,2);
            $data['rm_scrap'] = $data['rm_costs']->sum('scrap');
            $data['rm_scraps'] =  round(($data['rm_scrap']/100),2);
            $weieg=round($data['fillvolume']/1000 ,2);
            $weieg1=round($data['basic']->Volume/1000 ,2);
            $data['rmcost']=  round($data['basic']->total_rm_cost * $weieg *(1+ $data['basic']->fg_scrap),2);
            // dd($data['basic']->total_rm_cost,$data['basic']->fg_scrap,$weieg,$data['rmcost']);
            $data['rmcost1']= round($data['basic']->total_rm_cost  * $weieg1 * (1+ $data['basic']->fg_scrap),2);
            // $data['total_rm_cost'] = $data['rm_cost'] * $data['volume'] * ( 1 +  $data['rm_scraps'] );
            if( $data['rm_scraps'] != "0"){
                $data['total_rm_cost'] = round($basic->specific_gravity * $data['rmcost'] /  $data['rm_scraps'] ,2);
            }else{

                $data['total_rm_cost'] = '0';
            }

            $data['conv_cost'] = round($basic->conv_cost / $basic->case_configuration ,2);

            // new
            if($data['dist_channel']== "GT"){
                $data['rs'][]=  round($data['mrp']/((1+$retailer_margin)*(1+$primary_scheme)),2);
                $rs_data=  round($data['mrp']/((1+$retailer_margin)*(1+$primary_scheme)),2);
                $data['rs1'][]=round($basic->mrp_price/((1+$retailer_margin)*(1+$primary_scheme)),2);
                $rs_data1=round($basic->mrp_price/((1+$retailer_margin)*(1+$primary_scheme)),2);
                $data['rsTitle'] = "MRP(Per Case)/((1+Retailer Margin(Per Case))*(1+Primary Scheme(Per Case)))";
                $data['rsTitle1'] = "MRP(Per Unit)/((1+Retailer Margin(Per Case))*(1+Primary Scheme(Per Case)))";
            }else{
                $data['rs'][]=round(($data['mrp'] - ($data['mrp']*($retailer_margin))) / (1+$primary_scheme),2);
                $rs_data=round(($data['mrp'] - ($data['mrp']*($retailer_margin))) / (1+$primary_scheme),2);
                $data['rs1'][]=round(($basic->mrp_price - ($basic->mrp_price*($retailer_margin))) / (1+$primary_scheme),2);
                $rs_data1=round(($basic->mrp_price - ($basic->mrp_price*($retailer_margin))) / (1+$primary_scheme),2);
                $data['rsTitle'] = "MRP(Per Case) - (MRP(Per Case)*(Retailer Margin(Per Case))) / (1+Primary Scheme(Per Case))";
                $data['rsTitle1'] = "MRP(Per Unit) - (MRP(Per Unit)*(Retailer Margin(Per Case))) / (1+Primary Scheme(Per Case))";
            }
            $data['rsDis'][]= round(($rs_data / (1+$rsmargin) / (1+$ssmargin)),2);
            $rdis_data= round(($rs_data / (1+$rsmargin) / (1+$ssmargin)),2);
            $data['rsDis1'][] = round(($rs_data1 / (1+$rsmargin) / (1+$ssmargin)),2);
            $rdis_data1 = round(($rs_data1 / (1+$rsmargin) / (1+$ssmargin)),2);
            // dd(  $data['rsDis'] );
            $data['nr'][] = round($rdis_data /(1+$stax),2);
            $data['nr1'][] = round($rdis_data1 /(1+$stax),2);

            $data['netsales'][]= round($rdis_data  /(1+$stax),2);
            $netsales= round($rdis_data  /(1+$stax),2);
            $data['netsales1'][]=round($rdis_data1/(1+$stax),2);
            $netsales1=round($rdis_data1/(1+$stax),2);


            // $data['basic']->total_rm_cost * (1+$data['rm_scrap']) * $data['fillvolume']/1000;

            // dd($data['rmcost'] ,$data['totalcost'],$data['conv_cost']);
            $data['totalbasic']=round($data['rmcost'] + $total_rm + $data['basic']->conv_cost, 2);
            $data['totalbasic1']=round($data['rmcost1'] + $total_rm1 +  $data['conv_cost'], 2);
            //  dd( $data['totalbasic']);

            $costprim=$loc->cost;
            $data['primary_f'][]= round($costprim,2) ;
            $data['primary_f1'][]=  round(  $costprim/ $basic->case_configuration,2);
            $data['product'][]=$data['basic']->Product_name;
            $data['cost_location'][]=$loc->cost;
            $data['cogs'][]=round($data['primary_f'][$cg] +$data['totalbasic'],2);
            $data['cogs1'][]=round($data['primary_f1'][$cg] +$data['totalbasic1'],2);

            if($netsales>0){
                $data['gmval'][]= round($netsales- $data['cogs'][$cg],2);
                $data['gmpercents'][]= round(($data['gmval'][$cg]/$netsales)*100,2);

            }else{
                $data['gmval'][]= 0;
                $data['gmpercents'][]=0;
            }
            if($netsales1>0){
                $data['gmval1'][]= round($netsales1- $data['cogs1'][$cg],2);
                $data['gmpercents1'][]=  round(($data['gmval1'][$cg]/$netsales1)*100,2);
            }else{
                $data['gmval1'][]= 0;
                $data['gmpercents1'][]=0;
            }


            $nmval=($data['gmval'][$cg])-(($secfreight[$cg]->cost)+($logistics* $netsales)+($damages* $netsales));
            $nmval1=($data['gmval1'][$cg])-(($secfreight[$cg]->cost/$basic->case_configuration)+($logistics* $netsales1)+($damages* $netsales1));
            $data['nm_val'][]= round($nmval,2);
            $data['nm_val1'][]=  round($nmval1,2);

            if($netsales>0){
                $data['nm_perc'][]= round(($nmval/$netsales*100),2);
            }else{
                $data['nm_perc'][]= 0;
            }
            if($netsales1>0){
                $data['nm_perc1'][]= round(($nmval1/$netsales1*100),2);
            }else{
                $data['nm_perc1'][]= 0;
            }

          $cg++;
        }



       return view('finance.vcostsheet',compact('data'));

    }



    public function export(Request $request ,$id)
    {

        $data['basic'] =  Basic::where('id',$id)->select('*')->first();
        $basic = $data['basic'];

        $logistics=$basic->logistic/100;
        $damages=$basic->damage/100;
        $stax=$basic->salesTax/100;
        $dist_channel=dist_channel::find( $basic->distribution_value);
        $data['dist_channel']=$dist_channel->dist_name;
        $data['rm_costs'] = Rm_cost::where('Product_id',$basic->pro_id)
                            ->select('*')->get();
        $data['location']=Primary_location::where('pro_id',$basic->pro_id)->get();
        $data['sec_location']=Secondary_location::where('pro_id',$basic->pro_id)->get();
        $data['from_location']=[];
        $data['to_location']=[];
        foreach($data['location'] as $frmloc){
            $frml=LocationMaster::find($frmloc->from_location);
            $tol=LocationMaster::find($frmloc->to_location);
            $data['from_location'][]=$frml->location;
                $data['to_location'][]=$tol->location;
        }

        $data['product_material'] = Product_Material::where('product_id',$basic->pro_id)
                            ->select('*')->get();

        // dd($data['rm_costs']);

        // $data['nmval']
        $data['volume'] = $basic->Volume/1000;
        $data['mrp'] = round($basic->mrp_price*$basic->case_configuration ,2);

        $data['rm_scrap'] = $data['rm_costs']->sum('scrap');
        $data['rm_cost'] = $data['rm_costs']->sum('rate');
        $data['rm_scraps'] =  round(($data['rm_scrap']/100),2);
        if($data['rm_scrap'] != "0"){
            $data['total_rm_cost'] = round($basic->specific_gravity * $data['rm_cost'] / $data['rm_scraps'] ,2);
        }else{

            $data['total_rm_cost'] = '0';
        }

        $data['conv_cost'] = round($basic->conv_cost / $basic->case_configuration ,2);

        $data['html']='';
        $data['total']=[];
        $data['total1']=[];
        $data['material']=[];
        $data['moq']=[];
        $data['totalcost']=0;
        $data['totalcost1']=0;
        $dats='';
          foreach ($data['product_material'] as $product_material) {
              $totals=json_decode($product_material->pm_cost);
              $data['moq'][]=json_decode($product_material->MOQ);
              $data['total'][]= $totals;
              $data['material'][]=$product_material->material;
                $data['total1']= $totals[0]/$basic->case_configuration;
                // foreach( $totals as $tot){
                //     $data['totalcost']+=$tot;
                //     $data['totalcost1']+=$tot/$basic->case_configuration;
                // }
                $summ_moq=array_sum($totals);
                 $data['totalcost']+= $summ_moq;
                 $data['totalcost1']+= $summ_moq/$basic->case_configuration;


          }
            $data['fillvolume']= $basic->Volume*$basic->case_configuration;





            $data['rmcost']=$data['basic']->total_rm_cost * (1+$data['basic']->fg_scrap) * $data['fillvolume']/1000;
            if($data['rmcost'] == 0)
            $data['rmcost']="0";
            else
            $data['rmcost']=$data['basic']->total_rm_cost * (1+$data['basic']->fg_scrap) * $data['fillvolume']/1000;
            $data['rmcost1']=$data['basic']->total_rm_cost  * $data['basic']->Volume/1000 * (1+$data['basic']->fg_scrap);
            if($data['rmcost1'] == 0)
            $data['rmcost1']="0";
            else
            $data['rmcost1']=$data['basic']->total_rm_cost  * $data['basic']->Volume/1000 * (1+$data['basic']->fg_scrap);
            $data['basic']->total_rm_cost * (1+$data['rm_scraps']) * $data['fillvolume']/1000;


            $data['totalbasic']=round($data['rmcost'] + $data['totalcost']+ $data['basic']->conv_cost,2) ;
            $data['totalbasic1']=round($data['rmcost1'] + $data['totalcost1']+$data['conv_cost'] ,2);
            foreach($data['location'] as $loc ){
                $data['product'][]=$data['basic']->Product_name;
                $data['cost_location'][]=$loc->cost;


             }
                 $i = 0;
                 $num=1;
                 $data1['A1']['Description']="Description";
                 $data1['b1']['Description']="Product Name";
                 $data1['c1']['Description']="Location";
                 $data1['d1']['Description']="Specific Gravity";
                 $data1['e1']['Description']="Weight(kg)";
                 $data1['f1']['Description']="PCS per CAS measure ";
                 $data1['g1']['Description']="MRP";
                 $data1['h1']['Description']="Retailer Margin % ";
                 $data1['i1']['Description']="Primary scheme (inbuilt) %";
                 $data1['j1']['Description']="Landed cost to retailer";
                 $data1['k1']['Description']="RS Margin % ";
                 $data1['l1']['Description']="Landed Cost to Distributor";
                 $data1['m1']['Description']="Sales Tax/ GST %";
                 $data1['n1']['Description']="Net sales";
                 $data1['o1']['Description']="RM Scrap factor";
                 $data1['p1']['Description']="Formulation cost";
                 $data1['q1']['Description']="Total RM Cost";
                 $data1['r1']['Description']="Total PM Cost";
                 $data1['s1']['Description']="Covo.cost";
                 $data1['t1']['Description']="Total Basic";
                 $data1['u1']['Description']="Primary Freight";
                 $data1['v1']['Description']="COGS";
                 $data1['w1']['Description']="GM in value";
                 $data1['x1']['Description']="GM %";
                 $data1['y1']['Description']="Secondary Freight %";
                 $data1['z1']['Description']="Damages %";
                 $data1['ab']['Description']="Logistics %";
                 $data1['cd']['Description']="NM in Value";
                 $data1['ef']['Description']="NM %";
                 $data1['gh']['Description']="NR";
                 $data1['ij']['Description']="Fill Volume(ml)";
                 $data1['kl']['Description']="Launch Qty";
                 $data1['mn']['Description']="SS Margin %";
                 $data1['op']['Description']="FG scrap";

                 $k=0;

                 foreach ( $data['product_material'] as $item) {
                    $moq=json_decode($item->MOQ);
                    $pm_c=json_decode($item->pm_cost);
                    foreach( $moq as $m){
                        $data1[$k]['Description']= $item->material;
                    $k++;

                    }
                 }
                 foreach ($data['location']  as $header) {
                    $rsmargin=$header->rs_margin/100;

                    $ssmargin=$header->ss_margin/100;
                    $primary_scheme=$header->primary_scheme/100;
                    $retailer_margin=$header->retailer_margin/100;
                    if($data['dist_channel']== "GT"){
                        $data['rs']= round($data['mrp']/((1+$retailer_margin)*(1+$primary_scheme)),2);
                        $data['rs1']=round($basic->mrp_price/((1+$retailer_margin)*(1+$primary_scheme)),2);
                    }else{
                        $data['rs']=round(($data['mrp'] - ($data['mrp']*($retailer_margin))) / (1+$primary_scheme),2);
                        $data['rs1']=round(($basic->mrp_price - ($basic->mrp_price*($retailer_margin))) / (1+$primary_scheme),2);
                    }
                    $data['rsDis'] = round($data['rs'] / (1+$rsmargin) / (1+$ssmargin),2);
                    $data['rsDis1'] = round($data['rs1'] / (1+$rsmargin) / (1+$ssmargin),2);
                    $data['nr'] = round($data['rsDis'] /(1+$stax),2);
                    $data['nr1'] = round($data['rsDis1'] /(1+$stax),2);
                    $data['netsales']= round($data['rsDis'] /(1+$stax),2);
                    $data['netsales1']=round($data['rsDis1'] /(1+$stax),2);
                    $data['primary_frieght']= $data['cost_location'][$i];
                    $data['primary_frieght1']= round( $data['cost_location'][$i]/$basic->case_configuration,2);


                    $data['cogs']=round($data['primary_frieght'] +$data['totalbasic'],2);
                    $data['cogs1']=round($data['primary_frieght1'] +$data['totalbasic1'],2);
                      if($data['netsales']>0){
                            $data['gmval']= round($data['netsales']- $data['cogs'],2);
                            $data['gmpercents']= round($data['gmval']/$data['netsales'],2);

                        }else{
                            $data['gmval']= 0;
                            $data['gmpercents']=0;
                        }
                        if($data['netsales1']>0){
                            $data['gmval1']= round($data['netsales1']- $data['cogs1'],2);
                            $data['gmpercents1']=  round($data['gmval1']/$data['netsales1'],2);

                        }else{
                            $data['gmval1']= 0;
                            $data['gmpercents1'][]=0;
                        }

                        // dd($data['gmval'] , ($header->cost/100)* $data['netsales'],$logistics* $data['netsales'], $damages* $data['netsales']);

                        $nmval=($data['gmval'])-($data['sec_location'][$i]->cost+($logistics* $data['netsales'])+($damages* $data['netsales']));
                        $nmval1=($data['gmval1'])-(($data['sec_location'][$i]->cost/$basic->case_configuration)+($logistics* $data['netsales1'])+($damages* $data['netsales1']));
                        $data['nm_val'][]= $nmval;
                        $data['nm_val1'][]=  $nmval1;

                    if($data['netsales']>0){
                        $data['nm_perc'][]= $nmval/$data['netsales'];
                    }else{
                        $data['nm_perc'][]= 0;
                    }
                    if($data['netsales1']>0){
                        $data['nm_perc1'][]= $nmval1/$data['netsales1'];
                    }else{
                        $data['nm_perc1'][]= 0;
                    }
                    $key = "Per piece".$i;
                    $key1 = "Per case".$i;
                    $key3 = "%".$i;
                    $data1['A1'][ $key3]="%";
                    $data1['A1'][$key]="Per Case";
                    $data1['A1'][$key1]="Per Unit";
                    $data1['b1'][ $key3]="";
                    $data1['b1'][$key]=$data['basic']->Product_name;
                    $data1['b1'][$key1]='';
                    $data1['c1'][ $key3]="";
                    $data1['c1'][$key]=$data['from_location'][$i].'-'.$data['to_location'][$i];
                    $data1['c1'][$key1]='';
                    $data1['d1'][ $key3]="";
                    $data1['d1'][$key]=$data['basic']->specific_gravity;
                    $data1['d1'][$key1]=$data['basic']->specific_gravity;
                    $data1['e1'][ $key3]="";
                    $data1['e1'][$key]=$data['fillvolume']/1000;
                    $data1['e1'][$key1]=$data['basic']->Volume/1000;
                    $data1['f1'][ $key3]="";
                    $data1['f1'][$key]=$data['basic']->case_configuration;
                    $data1['f1'][$key1]=1;
                    $data1['g1'][ $key3]="";
                    $data1['g1'][$key]=$data['mrp'];
                    $data1['g1'][$key1]=$data['basic']->mrp_price;
                    $data1['h1'][ $key3]="";
                    $data1['h1'][$key]=$header->retailer_margin;
                    $data1['h1'][$key1]=$header->retailer_margin;
                    $data1['i1'][ $key3]="";
                    $data1['i1'][$key]=$header->primary_scheme;
                    $data1['i1'][$key1]=$header->primary_scheme;
                    $data1['j1'][ $key3]="";
                    $data1['j1'][$key]= $data['rs'];
                    $data1['j1'][$key1]=$data['rs1'];
                    $data1['k1'][ $key3]="";
                    $data1['k1'][$key]=$header->rs_margin;
                    $data1['k1'][$key1]=$header->rs_margin;
                    $data1['l1'][ $key3]="";
                    $data1['l1'][$key]= $data['rsDis'];
                    $data1['l1'][$key1]=$data['rsDis1'];
                    $data1['m1'][ $key3]="";
                    $data1['m1'][$key]= $basic->salesTax;
                    $data1['m1'][$key1]=$basic->salesTax;
                    $data1['n1'][ $key3]="";
                    $data1['n1'][$key]=  round($data['netsales'],2);
                    $data1['n1'][$key1]= round($data['netsales1'],2);
                    $data1['o1'][ $key3]="";
                    $data1['o1'][$key]= $data['rm_scrap'] ;
                    $data1['o1'][$key1]=$data['rm_scrap'] ;
                    $j=0;

                    foreach ( $data['product_material'] as $item) {
                        $key = "Per piece".$i;
                        $key1 = "Per case".$i;
                        $key3 = "%".$i;
                        $moq=json_decode($item->MOQ);
                        $pm_c=json_decode($item->pm_cost);
                        $mo_q=0;
                        foreach($moq as $mo){
                            $data1[ $j][ $key3]=$mo;
                            $data1[ $j][$key]=  $pm_c[$mo_q];
                            // print_r($data1[ $j][$key].',');

                            $data1[ $j][$key1]= round($pm_c[$mo_q] / $basic->case_configuration,2);
                            if($data1[ $j][$key1] <=0.00){
                                  $data1[ $j][$key1]= "0";
                            }
                            $mo_q++;
                            $j++;
                        }

                    }
                    // dd($data1);
                    $data1['p1'][ $key3]="";
                    $data1['p1'][$key]=  $data['basic']->total_rm_cost;
                    $data1['p1'][$key1]= $data['basic']->total_rm_cost;
                    $data1['q1'][ $key3]="";
                    $data1['q1'][$key]= round( $data['rmcost'],2);
                    $data1['q1'][$key1]=round( $data['rmcost1'],2);
                    $data1['r1'][ $key3]="";
                    $data1['r1'][$key]= round( $data['totalcost'],2);
                    $data1['r1'][$key1]=round($data['totalcost1'],2);
                    $data1['s1'][ $key3]="";
                    $data1['s1'][$key]= $data['basic']->conv_cost;
                    $data1['s1'][$key1]=$data['conv_cost'] ;
                    $data1['t1'][ $key3]="";
                    $data1['t1'][$key]=$data['totalbasic'] ;
                    $data1['t1'][$key1]= $data['totalbasic1'];
                    $data1['u1'][ $key3]="";
                    $data1['u1'][$key]=$data['cost_location'][$i];
                    $data1['u1'][$key1]= round($data['cost_location'][$i]/ $basic->case_configuration,2);
                    $data1['v1'][ $key3]="";
                    $data1['v1'][$key]= $data['cogs'] ;
                    $data1['v1'][$key1]=$data['cogs1'] ;
                    $data1['w1'][ $key3]="";
                    $data1['w1'][$key]= $data['gmval'] ;
                    $data1['w1'][$key1]=$data['gmval1'] ;
                    $data1['x1'][ $key3]="";
                    $data1['x1'][$key]= $data['gmpercents']*100 ;
                    $data1['x1'][$key1]=$data['gmpercents1'];
                    $data1['y1'][ $key3]="";
                    $data1['y1'][$key]= $data['sec_location'][$i]->cost ;
                    $data1['y1'][$key1]=round($data['sec_location'][$i]->cost/ $basic->case_configuration,2) ;
                    $data1['z1'][ $key3]=$basic->damage;
                    $data1['z1'][$key]= round($damages * $data['netsales'],2) ;
                    $data1['z1'][$key1]=round($damages * $data['netsales1'],2) ;
                    $data1['ab'][ $key3]=$basic->logistic;
                    $data1['ab'][$key]=round($logistics * $data['netsales'],2) ;
                    $data1['ab'][$key1]=round($logistics * $data['netsales1'],2) ;
                    $data1['cd'][ $key3]="";
                    $data1['cd'][$key]=round($data['nm_val'][$i],2) ;
                    $data1['cd'][$key1]=round($data['nm_val1'][$i],2) ;
                    $data1['ef'][ $key3]="";
                    $data1['ef'][$key]=round($data['nm_perc'][$i]*100,2) ;
                    $data1['ef'][$key1]=round($data['nm_perc1'][$i]*100,2) ;
                    $data1['gh'][ $key3]="";
                    $data1['gh'][$key]=$data['nr'];
                    $data1['gh'][$key1]=$data['nr1'];
                    $data1['ij'][ $key3]="";
                    $data1['ij'][$key]= $data['fillvolume'];
                    $data1['ij'][$key1]=$data['basic']->Volume;
                    $data1['kl'][ $key3]="";
                    $data1['kl'][$key]= $data['basic']->quantity;
                    $data1['kl'][$key1]=$data['basic']->quantity;
                    $data1['mn'][ $key3]="";
                    $data1['mn'][$key]= $header->ss_margin;
                    $data1['mn'][$key1]=$header->ss_margin;
                    $data1['op'][ $key3]=$data['basic']->fg_scrap;
                    $data1['op'][$key]=  $data['basic']->total_rm_cost * $data['basic']->fg_scrap;
                    $data1['op'][$key1]= $data['basic']->total_rm_cost * $data['basic']->fg_scrap;

                    $i++;
                 }

                $data2 = [
                        $data1['A1'],$data1['b1'],$data1['c1'], $data1['kl'],
                        $data1['d1'],$data1['ij'],$data1['e1'],$data1['f1'],$data1['g1'],$data1['h1'],
                        $data1['i1'],$data1['j1'],$data1['k1'], $data1['mn'],$data1['l1'], $data1['gh'],$data1['m1'],$data1['n1'],$data1['o1'],$data1['p1'],$data1['q1'],$data1['op']
                ];
                $b=0;
                foreach ( $data['product_material'] as $item) {
                    $moq=json_decode($item->MOQ);
                    foreach( $moq as $m){
                    $data2[]=$data1[$b];
                    $b++;

                    }
                }
                $datas=[$data1['r1'],$data1['s1'],
                $data1['t1'],$data1['u1'],
                $data1['v1'],
                $data1['w1'],
                $data1['x1'],
                $data1['y1'],
                $data1['z1'],
                $data1['ab'],
                $data1['cd'],
                $data1['ef']];
                $data=array_merge($data2,$datas);
                return Excel::download(new CostSheetExport($data),'NpdCostsheet.xlsx');

    }
    public function exporttempdetails(Request $request){

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $colOneCell = 1;
        for($colOne = 0; $colOne < count($request->columnOne); $colOne++){
            if(
                $request->columnOne[$colOne] == "Description" || $request->columnOne[$colOne] == "Product Name" ||
                $request->columnOne[$colOne] == "MRP" || $request->columnOne[$colOne] == "Net Sales" ||
                $request->columnOne[$colOne] == "Total PM Cost" || $request->columnOne[$colOne] == "Total RM Cost" ||
                $request->columnOne[$colOne] == "Total Basic" || $request->columnOne[$colOne] == "COGS" ||
                $request->columnOne[$colOne] == "GM in Value" || $request->columnOne[$colOne] == "NM in Value" ||
                $request->columnOne[$colOne] == "NM%" || $request->columnOne[$colOne] == "GM%"
            ){
                $sheet->setCellValue('A'.$colOneCell, $request->columnOne[$colOne])->getStyle("A".$colOneCell)->getFont()->setBold(true);
                $sheet->getColumnDimension('A')->setWidth(30);
            }else{
                if($request->columnOne[$colOne] == "Dynamic"){
                    $mergeCount = ($colOneCell + $request->columnOne[$colOne+1])-1;
                    $sheet->mergeCells('A'.$colOneCell.':'.'A'.$mergeCount);
                    $sheet->setCellValue('A'.$colOneCell, $request->columnOne[$colOne+2])->getStyle('A'.$colOneCell)->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);;
                    $colOneCell=$colOneCell+(($request->columnOne[$colOne+1])-1);
                    $colOne=$colOne+2;
                    $sheet->getColumnDimension('A')->setWidth(30);
                }else{
                    $sheet->setCellValue('A'.$colOneCell, $request->columnOne[$colOne]);
                    $sheet->getColumnDimension('A')->setWidth(30);
                }
            }
            $colOneCell++;
        }
        // Letters B to BZ
        $letters = [
            'B','C','D','E','F','G','H','I',
            'J','K','L','M','N','O','P','Q',
            'R','S','T','U','V','Y','Z','AA',
            'AB','AC','AD','AE','AF','AG','AH',
            'AI','AJ','AK','AL','AM','AN','AP',
            'AQ','AR','AS','AT','AU','AV','AW',
            'AX','AY','AZ','BA','BB','BC','BD',
            'BE','BF','BG','BH','BI','BJ','BK',
            'BL','BM','BN','BP','BQ','BR',
            'BS','BT','BU','BV','BY','BZ'
        ];
        $percentage=0;
        $perCase=1;
        $perUnit=2;
        for($l=0;$l<$request->locationCount;$l++){
            $sheet->setCellValue($letters[$percentage].'1', "%")->getStyle($letters[$percentage].'1')->getFont()->setBold(true);
            $sheet->setCellValue($letters[$perCase].'1', "Per Case")->getStyle($letters[$perCase].'1')->getFont()->setBold(true);
            $sheet->setCellValue($letters[$perUnit].'1', "Per Unit")->getStyle($letters[$perUnit].'1')->getFont()->setBold(true);
            $sheet->mergeCells($letters[$perCase].'2'.':'.$letters[$perUnit].'2');
            $sheet->setCellValue($letters[$perCase].'2', $request->productname[$l])->getStyle($letters[$perCase].'2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells($letters[$perCase].'3'.':'.$letters[$perUnit].'3');
            $sheet->setCellValue($letters[$perCase].'3', $request->quantity[$l])->getStyle($letters[$perCase].'3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells($letters[$perCase].'4'.':'.$letters[$perUnit].'4');
            $sheet->setCellValue($letters[$perCase].'4', $request->location[$l])->getStyle($letters[$perCase].'4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells($letters[$perCase].'5'.':'.$letters[$perUnit].'5');
            $sheet->setCellValue($letters[$perCase].'5', $request->sp_gravity[$l])->getStyle($letters[$perCase].'5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $colThreeCell = 6;
            // for($colThree = 0; $colThree < count($request->columnThree); $colThree++){
            //     $sheet->setCellValue($letters[$perCase].$colThreeCell, $request->columnThree[$colThree]);
            //     $sheet->setCellValue($letters[$perUnit].$colThreeCell, $request->columnFour[$colThree]);
            //     $colThreeCell++;
            // }

            $dynamicVar1 = "dyn_val_".$l;
            $rowOne1 = 0;
            $rowTwo1 = 1;
            $rowThree1 = 2;

            for($dynamic=0;$dynamic<count($request->$dynamicVar1);$dynamic++){
                if(isset($request->$dynamicVar1[$rowOne1])){

                    $dynZero = $request->$dynamicVar1[$rowOne1];
                    $dynZero ==0 ? $dynZero = "" : $dynZero;
                    $sheet->setCellValue($letters[$percentage].$colThreeCell, $dynZero);
                    $sheet->setCellValue($letters[$perCase].$colThreeCell, $request->$dynamicVar1[$rowTwo1]);
                    $sheet->setCellValue($letters[$perUnit].$colThreeCell, $request->$dynamicVar1[$rowThree1]);
                    $colThreeCell++;

                }
                $rowOne1=$rowOne1+3;
                $rowTwo1=$rowTwo1+3;
                $rowThree1=$rowThree1+3;
            }
            for($label=0;$label<count($request->labels);$label++){
                $var = "moqCase_".$l.$request->labels[$label];
                $var2 = "moqUnit_".$l.$request->labels[$label];
                $var3 = "label_".$label;
                for ($s=0; $s < count($request->$var3); $s++) {
                    $textName = explode(",", $request->$var3[$s]);
                    if($letters[$percentage] == "B"){
                        $sheet->setCellValue($letters[$percentage].$colThreeCell, $textName[1]);
                    }
                    if(isset($request->$var[$s])){
                        $sheet->setCellValue($letters[$perCase].$colThreeCell, $request->$var[$s]);
                        $sheet->setCellValue($letters[$perUnit].$colThreeCell,$request->$var2[$s]);
                    }
                    $colThreeCell++;
                }
            }
            // for($colThreeL = 0; $colThreeL < count($request->columnThreeL); $colThreeL++){
            //     $sheet->setCellValue($letters[$perCase].$colThreeCell, $request->columnThreeL[$colThreeL]);
            //     $sheet->setCellValue($letters[$perUnit].$colThreeCell, $request->columnFourL[$colThreeL]);
            //     $colThreeCell++;
            // }
            $dynamicVar = "dynamicVal_".$l;
            $rowOne = 0;
            $rowTwo = 1;
            $rowThree = 2;
            for($dynamic=0;$dynamic<count($request->$dynamicVar);$dynamic++){
                if(isset($request->$dynamicVar[$rowOne])){
                    $dynZero = $request->$dynamicVar[$rowOne];
                    $dynZero ==0 ? $dynZero = "" : $dynZero;
                    $sheet->setCellValue($letters[$percentage].$colThreeCell, $dynZero);
                    $sheet->setCellValue($letters[$perCase].$colThreeCell, $request->$dynamicVar[$rowTwo]);
                    $sheet->setCellValue($letters[$perUnit].$colThreeCell, $request->$dynamicVar[$rowThree]);
                }
                $colThreeCell++;
                $rowOne=$rowOne+3;
                $rowTwo=$rowTwo+3;
                $rowThree=$rowThree+3;
            }
            $percentage=$percentage+3;
            $perCase=$perCase+3;
            $perUnit=$perUnit+3;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = 'NPD Cost Sheet';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        ob_end_clean();
        ob_start();
        $writer->save('php://output');
    }


// -----------EXISTING PRODUCT----------

    public function get_exists_tax()
    {
        $data = existing_product::where('status','!=','1')
        ->orderby('id','desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn  = '<a class="btn btn-success btn-sm" onclick="btax_approve('.$row->id.')" ><i class="bx bx-check icon nav-icon" style="font-weight: 1000;"></i></a>';
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

    public function fetch_exist_buss()
    {
        $data = existing_product::where('status', '!=', '1')
        ->where(function ($query) {
            $query->where('damage_approval', 'pending')
                ->orWhereNull('damage_approval')
                ->orWhere('logistic_approval', 'pending')
                ->orWhereNull('logistic_approval');
        })
        ->orderby('id','desc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $array = ['damage', 'logistic'];
                $check_histroy = EpdRejectHistory::where('epro_id',$row->id)->whereIn('column_name', $array)->get();

                if( $check_histroy->isEmpty()) {
                    $btn = '';
                }else{
                    $btn = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >Rejection value updated by you!</span><br>';
                }

                if($row->logistic  !="" && $row->logistic != null){
                    $btn .= '<a class="btn btn-success btn-sm" onclick="exopenmodel('.$row->id.')" >View Info</a>';
                }else{
                    $btn .= '<a class="btn btn-primary btn-sm" onclick="exopenmodel('.$row->id.')" >Add Info</a>';
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

    public function fetch_exist_app_buss()
    {
        $data = existing_product::where('status','!=','1')
        ->where('damage_approval','approved')
        ->where('logistic_approval','approved')
        ->where('excsheet_approval','!=','rejected')
        ->where('mt_exsheet_approval','!=','rejected')
        ->orderby('id','desc')
        ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                if($row->logistic  !="" && $row->logistic != null){
                    $btn  = '<a class="btn btn-success btn-sm" onclick="exopenmodel('.$row->id.')" >View</a>';
                }else{
                    $btn  = '<a class="btn btn-primary btn-sm" onclick="exopenmodel('.$row->id.')" >Add Info</a>';
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
            ->rawColumns(['action'])
            ->make(true);
    }


    public function fetch_exist_rej_buss()
    {
        $data = existing_product::where('status','!=','1')
        ->where(function ($query) {
            $query->orWhere('damage_approval', 'rejected')
                ->orWhere('logistic_approval', 'rejected')
                ->orWhere('mt_exsheet_approval', 'rejected')
                ->orWhere('excsheet_approval', 'rejected');
        })
        ->orderby('id','desc')
        ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                if($row->excsheet_approval == 'rejected' || $row->mt_exsheet_approval == 'rejected'){
                    $btn = '<a class="btn btn-danger btn-sm" onclick="exopenmodel('.$row->id.')" >View</a>';
                }elseif($row->logistic  !="" && $row->logistic != null){
                    $btn = '<a class="btn btn-danger btn-sm" onclick="exopenmodel('.$row->id.')" >Update Info</a>';
                }else{
                    $btn = '<a class="btn btn-primary btn-sm" onclick="exopenmodel('.$row->id.')" >Add Info</a>';
                }
                return $btn;
            })
            ->addColumn('status', function($row){
                $status = '';

                if($row->damage_approval == 'rejected'){
                    $damage_histroy = EpdRejectHistory::where('epro_id',$row->id)->where('column_name', 'damage')->orderBy('id','desc')->first();
                    $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff0053!important;" ><b>Damage Remark : </b>'.$damage_histroy->remarks.'</span><br>';
                }
                if($row->logistic_approval == 'rejected'){
                    $logistic_histroy = EpdRejectHistory::where('epro_id',$row->id)->where('column_name', 'logistic')->orderBy('id','desc')->first();
                    $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #b50941!important;" >Logistic Remark : </b>'.$logistic_histroy->remarks.'</span><br>';
                }
                if($row->excsheet_approval == 'rejected'){
                    $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff0053!important;" >Rejected by Finance</span><br>';
                }
                if($row->mt_exsheet_approval == 'rejected'){
                    $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff0053!important;" >Rejected by Marketing Team</span><br>';
                }
                return $status;
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
            ->rawColumns(['action','status','division'])
            ->make(true);
    }


    public function fetch_finance_exdata(Request $request)
    {
        $id = $request->id;
        $data =  existing_product::where('id',$id)->where('damage','!=','')->first();
        return response()->json([
            'result' => $data
        ]);
    }

    public function save_exfinnance(Request $request)
    {
        $id = $request->ex_id;
        if(isset($request->exlogistic_id)){
            $data['logistic'] = $request->exlogistic_id;
            $data['logistic_approval']= 'pending';
        }
        if(isset($request->exdamage_id)){
            $data['damage'] = $request->exdamage_id;
            $data['damage_approval']= 'pending';
        }

        $data['damageuser'] = auth()->user()->id;
        $data['damagedate'] = date('Y-m-d H:i:s');

        existing_product::where('id',$id)->update($data);
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function get_exists_freight()
    {
        $data = existing_product::where('status','!=','1')
        ->orderby('id','desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn  = '<a class="btn btn-success btn-sm" onclick="exfrei_approve('.$row->id.')" ><i class="bx bx-check icon nav-icon" style="font-weight: 1000;"></i></a>';
                return $btn;
            })
            ->addColumn('prim_Location', function($row){
                $location = EpdPrimaryLocations::where('pro_id','=', $row->epro_id)->select('from_location','to_location')->get();
                $p_loc = '';
                foreach ($location as $locations){
                    $p_flocation = LocationMaster::find($locations->from_location);
                    $p_tolocation = LocationMaster::find($locations->to_location);
                    $p_loc .= '<span class="badge badge-secondary" style="background-color: #21c4b1ab;color:#000000c7;">'. $p_flocation->location .'  -  '.$p_tolocation->location.' </span><br>';
                }

                return $p_loc;
            })
            ->addColumn('sec_location', function($row){
                $locate = EpdSecondaryLocations::where('epro_id','=', $row->epro_id)->select('from_location','to_location')->get();
                $sec_loc = '';
                foreach ($locate as $locations){
                    $s_flocation = LocationMaster::find($locations->from_location);
                    $s_tolocation = LocationMaster::find($locations->to_location);
                    $sec_loc .= '<span class="badge badge-secondary" style="background-color: #0ce024a6;color:#000000c7;">'. $s_flocation->location .'  -  '.$s_flocation->location.' </span><br>';
                }
                return $sec_loc;
            })
            ->addColumn('prim_freight', function($row){
                $location = EpdPrimaryLocations::where('pro_id','=', $row->epro_id)->select('freight')->get();
                $p_fri = '';
                foreach ($location as $val){
                    $pf = !empty($val->freight) ? $val->freight : '--';
                    $p_fri .= '<span class="badge badge-secondary" style="background-color: #21c4b1ab;color:#000000c7;">'. $pf .' </span><br>';
                }
                return $p_fri;
            })
            ->addColumn('sec_freight', function($row){
                $locate = EpdSecondaryLocations::where('epro_id','=', $row->epro_id)->select('freight')->get();
                $sec_fri = '';
                foreach ($locate as $vall){
                    $f = !empty($vall->freight) ? $vall->freight : '--';
                    $sec_fri .= '<span class="badge badge-secondary" style="background-color: #0ce024a6;color:#000000c7;">'. $f .' </span><br>';
                }
                return $sec_fri;
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
            ->rawColumns(['action','prim_Location','sec_location','prim_freight','sec_freight','division'])
            ->make(true);
    }

    public function fetch_cost_sheet()
    {
        $data = Basic::select('*')
        ->orderby('id','desc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                // $btn  = '<a href="../viewcostsheet/'.$row->id.'" id="add_id" class="btn btn-primary btn-sm" style="margin-right:1px">View</a>';
                // $btn .= '<a href="../export/'.$row->id.'" id="add_id" class="btn btn-primary btn-sm" >Download</a>';
                $btn  = '<a href="'.url('/').'/viewcostsheet/'.$row->id.'" id="add_id" class="btn btn-primary btn-sm" style="margin-right:1px">View</a>';
                $btn .= '<a href="'.url('/').'/export/'.$row->id.'" id="add_id" class="btn btn-primary btn-sm" >Download</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function approved_costsheet()
    {
        $data = Basic::select('*')
        ->where('mt_csheet_approval','Approved')
        ->orderby('id','desc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn  = '<a href="'.url('/').'/viewcostsheet/'.$row->id.'" id="add_id" class="btn btn-primary btn-sm" style="margin-right:1px">View</a>';
                $btn .= '<a href="'.url('/').'/export/'.$row->id.'" id="add_id" class="btn btn-primary btn-sm" >Download</a>';
                return $btn;
            })
            ->addColumn('status', function($row){
                if($row->csheet_approval == 'Pending'){
                    $status = '<span class="badge bg-warning text-dark">Pending</span>';
                }elseif($row->csheet_approval == 'Rejected'){
                    $status = '<span class="badge bg-danger text-dark" style="color:white!important;">Rejected</span>';
                }else {
                    $status = '<span class="badge bg-success text-dark" style="color:white!important;">Approved</span>';
                }

                return $status;
            })
            ->rawColumns(['action','status'])
            ->make(true);
    }

    public function rejected_costsheet()
    {
        $data = Basic::select('*')
        ->where('mt_csheet_approval','Rejected')
        ->orderby('id','desc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn  = '<a href="'.url('/').'/viewcostsheet/'.$row->id.'" id="add_id" class="btn btn-primary btn-sm" style="margin-right:1px">View</a>';
                $btn .= '<a href="'.url('/').'/export/'.$row->id.'" id="add_id" class="btn btn-primary btn-sm" >Download</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function approve_mtsheet(Request $request)
    {
        $id = $request->id;
        Basic::where('id',$id)->update(['mt_csheet_approval'=>'Approved']);
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function reject_mtsheet(Request $request)
    {
        $id = $request->id;
        Basic::where('id',$id)->update(['mt_csheet_approval'=>'Rejected']);
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function existing_cost_sheet()
    {
        $data = existing_product::select('*')
        ->where('excsheet_approval','approved')
        ->where('mt_exsheet_approval','pending')
        ->orderby('id','desc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn  = '<a href="'.route('view_excostsheet', [$row->id]) . '" class="btn btn-primary btn-sm" style="margin-right:1px">View</a>';

                // $btn  = '<a href="../view_excostsheet/'.$row->id.'" id="add_id" class="btn btn-primary btn-sm" style="margin-right:1px">View</a>';
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


    // public function view_excostsheet(Request $request)
    public function view_excostsheet(Request $request ,$id)
    {
        $data['basic'] =  existing_product::where('id',$id)->select('*')->first();
        $basic = $data['basic'];

        $data['type'] = $basic->material_type;
        $data['material_name'] = $basic->material_name;
        $data['mrp_piece'] = $basic->mrp_piece;
        $data['fill_volume'] = $basic->fill_volume;
        $data['plant'] = $basic->plant;
        $data['mrp_per_case'] = $basic->mrp;
        // $data['mrp_per_case'] = round($basic->mrp_piece * $basic->pieces_per_case ,2);
        $data['salesTax'] = $basic->salesTax;

        $data['rm_cost'] = $basic->rmcost;
        $data['rm_scrap_cost'] = $basic->rmscrap;
        $data['pm_cost'] = $basic->pmcost;
        $data['pm_scrap_cost'] = $basic->pmscrap;
        $data['conv_cost'] = $basic->conv_cost;

        $data['location'] = EpdPrimaryLocations :: where('pro_id',$basic->epro_id)->get();
        $data['pcount'] = $data['location']->count();

        $dist_channel = dist_channel::find($basic->distribution_channel);
        $data['dist_channel'] = $dist_channel ? $dist_channel->dist_name : "";

        $data['p_loc'] = [];
        $data['primary_freight'] = [];
        $data['cost_to_retailer'] = [];
        $data['Cost_after_scheme'] = [];
        $data['Landed_Cost_to_RS'] = [];
        $data['nr_per_case_before'] = [];
        $data['nr_per_case'] = [];
        $data['Total_Basic_Price'] = [];
        $data['gm_per_case'] = [];
        $data['gm_percent'] = [];
        $data['gm_per_case_ex_fact'] = [];
        $data['gm_percent_ex_fact'] = [];
        $data['freight_case'] = [];
        $data['damage_per_case'] = [];
        $data['Logistics_cost_per_case'] = [];
        $data['Total_Variable_cost_per_case'] = [];
        $data['cogs'] = [];
        $data['Estimated_NM_per_case'] = [];
        $data['Estimated_NM_percent'] = [];
        $data['p_cost_approval'] = '';
        $data['nr_percase_title'] = '';

        foreach ($data['location'] as $key => $val){
            $pf_location = LocationMaster::find($val->from_location);
            $pt_location = LocationMaster::find($val->to_location);

            $data['p_loc'][] = $pf_location->location .' (to) '.$pt_location->location;

            // retailer margin percentage value + 1
            $retailmargin1 = 1 + ($val->retailer_margin/100);
            $retailmargin_another = 1 - ($val->retailer_margin/100);
            // primary scheme percentage value +1
            $primscheme1 = 1 + ($val->primary_scheme/100);
            // rs margin percentage value +1
            $rsmargn1 = 1 + ($val->rs_margin/100);
            // ss margin percentage value +1
            $ssmargn1 = 1 + ( $val->ss_margin/100);
            // salestax percentage value +1
            $salestx = 1+ ($data['salesTax']/100);

            $cost_to_retailer = round($data['mrp_per_case'] / $retailmargin1 ,2);
            $data['cost_to_retailer'][] = $cost_to_retailer;

            $cost_after_scheme = round($cost_to_retailer / $primscheme1 ,2);
            $data['Cost_after_scheme'][] = $cost_after_scheme;

            $landed_cost_to_rs = round($cost_after_scheme / $rsmargn1 / $ssmargn1,2);
            $data['Landed_Cost_to_RS'][] = $landed_cost_to_rs;

            // $nr_per_case_before = round($landed_cost_to_rs / (1+ $basic->salesTax/100 ),2);
            // $data['nr_per_case_before'][] = $nr_per_case_before;

            if($data['dist_channel'] == "GT"){

                // NR Per Case = a/ (1+b %)( 1+c %)/(1+d%)/(1+e%)/(1+f%) – If Markup 
                // A -MRP 
                // B -Retailer Margin 
                // C -Primary Scheme 
                // D -RS Margin 
                // E -SS Margin 
                // F -Tax 
                $cost_to_retailer = round($data['mrp_per_case'] / $retailmargin1 ,2);
                $data['cost_to_retailer'][] = $cost_to_retailer;
                // $nr_per_case_before = round($data['mrp_per_case'] / $retailmargin1 * $primscheme1 / $rsmargn1 / $ssmargn1 / $salestx ,2);
                // $data['nr_per_case_before'][] = $nr_per_case_before;
                // $data['nr_percase_title'] = "MRP(Per Case)/ (1+ Retailer margin%)* (1+ Primary scheme%)/ (1+ RS margin%)/ (1+ SS margin%)/ (1+ Sales tax%)";
            }else{
                // NR Per Case = (a-(a*b%))/(1+c%)/(1+d%)/(1+e%)/(1+f%) – If Markdown 
                $cost_to_retailer = round($data['mrp_per_case'] * $retailmargin_another ,2);
                $data['cost_to_retailer'][] = $cost_to_retailer;
                // $nr_per_case_before = round( ($data['mrp_per_case'] - ($data['mrp_per_case'] * ($val->retailer_margin/100)) )/ $primscheme1 / $rsmargn1 / $ssmargn1 / $salestx ,2);
                // $data['nr_per_case_before'][] = $nr_per_case_before;
                // $data['nr_percase_title'] = "( MRP(Per Case)-(MRP(Per Case)*Retailer margin%) )/ (1+ Primary scheme%)/ (1+ RS margin%)/ (1+ SS margin%)/ (1+ Sales tax%)";
            }


            $landed_cost_to_rs = round($cost_after_scheme / $rsmargn1 / $ssmargn1,2);
            $data['Landed_Cost_to_RS'][] = $landed_cost_to_rs;
            $nr_per_case_before = round( $landed_cost_to_rs / $salestx ,2);
            $data['nr_per_case_before'][] = $nr_per_case_before;
            $data['nr_percase_title'] = "( Landed Cost to RS/ (1+ Sales tax%)";
            $nr_per_case = $nr_per_case_before - 0.00;
            $data['nr_per_case'][] = $nr_per_case;
            // $data['nr_per_case'] = $nr_per_case_before - $basic->secondary_freight;

            $data['primary_freight'][] = $val->freight;

            $total_basic_price = round($data['rm_cost'] + $data['rm_scrap_cost'] + $data['pm_cost'] + $data['pm_scrap_cost'] + $data['conv_cost'] + $val->freight, 2);
            $data['Total_Basic_Price'][] = $total_basic_price ;
            $gm_per_case = round ($nr_per_case_before - $total_basic_price, 2);
            $data['gm_per_case'][] = $gm_per_case;

            if($data['nr_per_case_before'] != '0'){
                $data['gm_percent'][] = round (($gm_per_case / $nr_per_case_before)*100, 2);
            }else{
                $data['gm_percent'][] = $gm_per_case*100;
            }

            $gm_per_case_ex_fact = round ($gm_per_case + $val->freight, 2);
            $data['gm_per_case_ex_fact'][] = $gm_per_case_ex_fact;

            $data['gm_percent_ex_fact'][] = round (($gm_per_case_ex_fact / $nr_per_case)*100, 2);

            $damage_per_case = round ($nr_per_case * ($basic->damage/100), 2);
            $data['damage_per_case'][] = $damage_per_case;

            $logistics_cost_per_case = round ($nr_per_case * ($basic->logistic/100), 2);
            $data['Logistics_cost_per_case'][] = $logistics_cost_per_case;

            // $freight_case = round ($nr_per_case * ( $val->freight ), 2);
            // $data['freight_case'][] = $freight_case;
            
            $data['seclocation'] = EpdSecondaryLocations :: where('epro_id',$basic->epro_id)->where('from_location',$val->to_location)->get();
            foreach ($data['seclocation'] as $sval){
                if($val->to_location == $sval->from_location){
                    $data['sfreight'][] = $sval->freight;
                    $freight_case = round ( ( $sval->freight / $nr_per_case ), 3);
                    $data['freight_case'][] = $freight_case * 100;
                    $data['s_cost_approval'] = $sval->s_cost_approval;
                }else{
                    $data['sfreight'][] ="0";
                    $freight_case = "0";
                    $data['freight_case'][] = "0";
                    $data['s_cost_approval'] = "0";
                }
            }

            $total_variable_cost_per_case = round ($freight_case + $damage_per_case + $logistics_cost_per_case, 2);
            $data['Total_Variable_cost_per_case'][] = $total_variable_cost_per_case;

            $cogs = round ($total_basic_price + $total_variable_cost_per_case, 2);//total basic price
            $data['cogs'][] = $cogs;

            $estimated_nm_per_case = round ($nr_per_case - $cogs, 2);
            $data['Estimated_NM_per_case'][] = $estimated_nm_per_case;

            $data['Estimated_NM_percent'][] = round (($estimated_nm_per_case / $nr_per_case)*100, 2);

            $data['p_cost_approval'] = $val->p_cost_approval;
            $data['rm_approval'] = $val->retail_margin_approval;
            $data['ps_approval'] = $val->prim_scheme_approval;
            $data['rsm_approval'] = $val->rsm_approval;
            $data['ssm_approval'] = $val->ssmargin_approval;
        }

        $data['stylesandjs']="2";
        return view('finance.vex_costsheet',compact('data'));
    }

    public function approve_epdsheet(Request $request)
    {
        $id = $request->id;
        $data['material_type'] = $request->type;
        $data['material_name'] = $request->material_name;
        $data['fill_volume'] = $request->fill_volume;
        $data['plant'] = $request->sap_plant;
        $data['rmcost'] = $request->rmcost;
        $data['rmscrap'] = $request->rmscrap;
        $data['pmcost'] = $request->pmcost;
        $data['pmscrap'] = $request->pmscrap;
        $data['conv_cost'] = $request->convcost;
        $data['mrp'] = $request->mrp;
        $data['mrp_piece'] = $request->mrppiece;
        $data['excsheet_approval'] = 'approved';

        existing_product::where('id',$id)->update($data);
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function reject_epdsheet(Request $request)
    {
        $id = $request->id;
        $data['material_type'] = $request->type;
        $data['material_name'] = $request->material_name;
        $data['fill_volume'] = $request->fill_volume;
        $data['plant'] = $request->sap_plant;
        $data['rmcost'] = $request->rmcost;
        $data['rmscrap'] = $request->rmscrap;
        $data['pmcost'] = $request->pmcost;
        $data['pmscrap'] = $request->pmscrap;
        $data['conv_cost'] = $request->convcost;
        $data['mrp'] = $request->mrp;
        $data['mrp_piece'] = $request->mrppiece;
        $data['excsheet_approval'] = 'rejected';

        existing_product::where('id',$id)->update($data);
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function approve_mt_epdsheet(Request $request)
    {
        $id = $request->id;
        existing_product::where('id',$id)->update(['mt_exsheet_approval'=>'approved']);
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function reject_mt_epdsheet(Request $request)
    {
        $id = $request->id;
        existing_product::where('id',$id)->update(['mt_exsheet_approval'=>'rejected']);
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function approved_excostsheet()
    {
        $data = existing_product::select('*')
        ->where('excsheet_approval','approved')
        ->where('mt_exsheet_approval','approved')
        ->orderby('id','desc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn  = '<a href="'.route('view_excostsheet', [$row->id]) . '" class="btn btn-primary btn-sm" style="margin-right:1px">View</a>';
                $btn .= '<a href="'.url('/').'/epdexport/'.$row->id.'" class="btn btn-primary btn-sm" >Download</a>';
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

    public function rejected_excostsheet()
    {
        $data = existing_product::select('*')
        ->where('excsheet_approval','approved')
        ->where('mt_exsheet_approval','rejected')
        ->orderby('id','desc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn  = '<a  href="'.route('view_excostsheet', [$row->id]) . '" class="btn btn-primary btn-sm" style="margin-right:1px">View</a>';
                $btn .= '<a href="'.url('/').'/epdexport/'.$row->id.'" class="btn btn-primary btn-sm" >Download</a>';
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

    public function fetch_ex_cost()
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
        ->where('existing_products.rmcost_verified', 'verified')
        ->where('existing_products.pmcost_verified', 'verified')
        // ->whereNotIn('epd_primary_locations.p_cost_approval', [1, 2])
        // ->whereNotIn('epd_secondary_locations.s_cost_approval', [1, 2])
        ->select('existing_products.*')
        ->orderby('existing_products.id','desc')
        ->groupBy('existing_products.epro_id')
        ->get();


        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                // $btn  = '<a href="'.url('/').'/view_excostsheet/'.$row->id.'" id="add_id" class="btn btn-primary btn-sm" style="margin-right:1px">View</a>';
                $btn  = '<a class="btn btn-primary btn-sm" style="margin-right:1px" data-id='.$row->material_code.' data-proid='.$row->id.' onclick="view_api_form(this)" >View</a>';
                // $btn .= '<a href="'.url('/').'/epdexport/'.$row->id.'" id="add_id" class="btn btn-primary btn-sm" >Download</a>';
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


    public function approved_epdsheet()
    {
        $data = existing_product::select('*')
        ->where('excsheet_approval','approved')
        ->orderby('id','desc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn  = '<a  href="'.route('view_excostsheet', [$row->id]) . '" id="add_id" class="btn btn-primary btn-sm" style="margin-right:1px">View</a>';
                $btn .= '<a href="'.url('/').'/epdexport/'.$row->id.'" id="add_id" class="btn btn-primary btn-sm" >Download</a>';
                return $btn;
            })
            ->addColumn('status', function($row){
                if($row->csheet_approval == 'Pending'){
                    $status = '<span class="badge bg-warning text-dark">Pending</span>';
                }elseif($row->csheet_approval == 'Rejected'){
                    $status = '<span class="badge bg-danger text-dark" style="color:white!important;">Rejected</span>';
                }else {
                    $status = '<span class="badge bg-success text-dark" style="color:white!important;">Approved</span>';
                }
                return $status;
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
            ->rawColumns(['action','status','division'])
            ->make(true);
    }

    public function rejected_epdsheet()
    {
        $data = existing_product::select('*')
        ->where('excsheet_approval','rejected')
        ->orderby('id','desc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn  = '<a  href="'.route('view_excostsheet', [$row->id]) . '"  id="add_id" class="btn btn-primary btn-sm" style="margin-right:1px">View</a>';
                $btn .= '<a href="'.url('/').'/epdexport/'.$row->id.'" id="add_id" class="btn btn-primary btn-sm" >Download</a>';
                return $btn;
            })
            ->addColumn('version', function($row){
                $version  = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
                return $version;
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
            ->rawColumns(['action','version','division'])
            ->make(true);
    }


    public function epdexport(Request $request ,$id)
    {
        $value =  existing_product::where('id',$id)->select('*')->first();

        $material_code = $value->material_code;
        $pieces_per_case = $value->pieces_per_case;
        $mrp_piece = $value->mrp_piece;
        $mrp_per_case = $value->mrp;
        $fill_volume = $value->fill_volume;
        $specific_gravity = $value->specific_gravity;
        $sales_tax = $value->salesTax;
        $retailer_margin = '0';
        $primary_scheme = '0';
        $rs_margin = '0';
        $ss_margin = '0';

        $rm_cost = $value->rmcost;
        $rm_scrap_cost = $value->rmscrap;
        $pm_cost = $value->pmcost;
        $pm_scrap_cost = $value->pmscrap;
        $conv_cost = $value->conv_cost;

        $location = EpdPrimaryLocations :: where('pro_id',$value->epro_id)->get();
        $prmcount = $location->count();

        // $seclocation = EpdSecondaryLocations :: where('epro_id',$value->epro_id)->get();

        $dist_channel = dist_channel::find($value->distribution_channel);
        $ddist_channel = $dist_channel ? $dist_channel->dist_name : "";

        $plocation = [];
        $retailer_margin = [];
        $primary_scheme = [];
        $rs_margin = [];
        $ss_margin = [];
        $cost_to_retailer = [];
        $cost_after_scheme = [];
        $landed_cost_to_rs = [];
        $nr_per_case_before = [];
        $sec_scheme = '0';
        $nr_per_case = [];
        $total_basic_price = [];
        $gm_per_case = [];
        $gm_percent = [];
        $gm_per_case_ex_fact = [];
        $gm_percent_ex_fact = [];
        $secondary_freight = [];
        $damage = $value->damage;
        $logistic = $value->logistic;
        $freight_case = [];
        $damage_per_case = [];
        $logistics_cost_per_case = [];
        $total_variable_cost_per_case = [];
        $cogs = [];
        $nr_per_case2 = [];
        $cogs2 = [];
        $estimated_nm_per_case = [];
        $estimated_nm_percent = [];
        // $primary_freight = [];

        foreach ($location as $val){
            $pf_location = LocationMaster::find($val->from_location);
            $pt_location = LocationMaster::find($val->to_location);

            $plocation[] = $pf_location->location .' (to) '.$pt_location->location;

            $retailer_margin[] = $val->retailer_margin;
            $primary_scheme[] = $val->primary_scheme;
            $rs_margin[] = $val->rs_margin;
            $ss_margin[] = $val->ss_margin;

            $retailer_margin_1 = 1 + ($val->retailer_margin/100);
            $retailer_margin_another = 1 - ($val->retailer_margin/100);
            $primscheme_1 = 1 + ($val->primary_scheme/100);
            $rsmargn_1 = 1 + ($val->rs_margin/100);
            $ssmargn_1 = 1 + ($val->ss_margin/100);
            $salestx_1 = 1 + ($value->salesTax/100);

          

          


            if($ddist_channel == "GT"){
                $costtoretailer = round($mrp_per_case / $retailer_margin_1,2);
                $cost_to_retailer[] = $costtoretailer;
                // $nrPerCaseBefore = round($mrp_per_case / $retailer_margin_1 * $primscheme_1 / $rsmargn_1 / $ssmargn_1 / $salestx_1 ,2);
                // $nr_per_case_before[] = $nrPerCaseBefore;
    
            }else{
                $costtoretailer = round($mrp_per_case * $retailer_margin_another,2);
                $cost_to_retailer[] = $costtoretailer;
                // $nrPerCaseBefore = round( ($mrp_per_case - ($mrp_per_case * ($val->retailer_margin/100)) )/ $primscheme_1 / $rsmargn_1 / $ssmargn_1 / $salestx_1 ,2);
                // $nr_per_case_before[] = $nrPerCaseBefore;
            }
            $costAfterScheme = round($costtoretailer / $primscheme_1,2);
            $cost_after_scheme[] = $costAfterScheme;

            $landedCostToRs = round($costAfterScheme / $rsmargn_1/ $ssmargn_1 ,2);
            $landed_cost_to_rs[] = $landedCostToRs;

            $nrPerCaseBefore = round($landedCostToRs/ $salestx_1 ,2);
            $nr_per_case_before[] = $nrPerCaseBefore;
            $nrPerCase = $nrPerCaseBefore - 0.00;
            $nr_per_case[] = $nrPerCase;
            $nr_per_case2 = $nrPerCase;
            // $data['nr_per_case'] = $nrPerCaseBefore - $basic->secondary_freight;

            $primary_freight[] = $val->freight;

            $totalBasicPrice = round($rm_cost + $rm_scrap_cost + $pm_cost + $pm_scrap_cost + $conv_cost + $val->freight, 2);
            $total_basic_price[] = $totalBasicPrice ;
            $gmPerCase = round ($nrPerCaseBefore - $totalBasicPrice, 2);
            $gm_per_case[] = $gmPerCase;

            if($nrPerCaseBefore != '0'){
                $gm_percent[] = round (($gmPerCase / $nrPerCaseBefore)*100, 2);
            }else{
                $gm_percent[] = $gmPerCase*100;
            }

            $gmPerCaseExFact = round ($gmPerCase + $val->freight, 2);
            $gm_per_case_ex_fact[] = $gmPerCaseExFact;

            $gm_percent_ex_fact[] = round (($gmPerCaseExFact / $nrPerCase)*100, 2);

            $damagePerCase = round ($nrPerCase * ($value->damage/100), 2);
            $damage_per_case[] = $damagePerCase;

            $logisticsCostPerCase = round ($nrPerCase * ($value->logistic/100), 2);
            $logistics_cost_per_case[] = $logisticsCostPerCase;

            // $freightCase = round ($nrPerCase * ( $val->freight/100 ), 2);
            // $freight_case[] = $freightCase;

            $data['seclocation'] = EpdSecondaryLocations :: where('epro_id',$value->epro_id)->where('from_location',$val->to_location)->get();
            foreach ($data['seclocation'] as $sval){
                if($val->to_location == $sval->from_location){
                    $secondary_freight[] = $sval->freight;
                    $freightCase = round (( $sval->freight / $nrPerCase), 3);
                    $freight_case[] = $freightCase *100;
                }
                else{
                    $secondary_freight[] ="";
                    $freightCase = "";
                    $freight_case[] = "";
                }
            }

            $totalVariableCostPerCase = round ($freightCase + $damagePerCase + $logisticsCostPerCase, 2);
            $total_variable_cost_per_case[] = $totalVariableCostPerCase;

            $cogs_val = round ($totalBasicPrice + $totalVariableCostPerCase, 2);//total basic price
            $cogs[] = $cogs_val;
            $cogs2 = $cogs_val;

            $estimatedNmPerCase = round ($nrPerCase - $cogs_val, 2);
            $estimated_nm_per_case[] = $estimatedNmPerCase;

            $estimated_nm_percent[] = round (($estimatedNmPerCase / $nrPerCase)*100, 2);


            // foreach ($data['seclocation'] as $sval){
            //     if($val->to_location == $sval->from_location){
            //         $freight_case = round ($nrPerCase * ( $sval->freight/100 ), 2);
            //         $data['freight_case'][] = $freight_case;
            //     }
            // }
        }

        $data = [];

        $data[] = [
            [
                'material_code' => 'CavinKare Pvt Ltd',
                'BSC Cream' => '',
            ],
            [
                'material_code' => 'Tentative Cost sheet',
                'BSC Cream' => '',
            ],
            [
                'material_code' => 'Material Code : '.$value->material_code ,
                'BSC Cream' => '',
            ],
            [
                'material_code' => 'Plant : '.$value->plant,
                'BSC Cream' => '',
            ],
            [
                'material_code' => '',
                'Per piece' => ''
            ],
        ];

        $row1 = ['Other Column 1' => ['Particulars']];
        $row1['Other Column 2'][] = 'Material code';
        $row1['Location Column'][] = 'Location';
        $row1['Other Column 3'][] = 'No. of Pcs / case';
        $row1['Other Column 4'][] = 'MRP per piece';
        $row1['Other Column 5'][] = 'MRP per case';
        $row1['Other Column 6'][] = 'Fill Volume';
        $row1['Other Column 7'][] = 'Specific gravity';
        $row1['Other Column 8'][] = 'Average Sales Tax (%)';
        $row1['Other Column 9'][] = 'Retailers margin (%)';
        $row1['Other Column 10'][] = 'Primary Scheme (%)';
        $row1['Other Column 11'][] = 'RS Margin (%)';
        $row1['Other Column 12'][] = 'Super Margin (%)';
        $row1['Other Column 13'][] = 'Landed Cost to Retailer';
        $row1['Other Column 14'][] = 'Cost after Scheme';
        $row1['Other Column 15'][] = 'Landed Cost to Distributor';
        $row1['Other Column 16'][] = 'NR per Case ( before Sec TPR)';
        $row1['Other Column 17'][] = 'Scheme ( Sec)';
        $row1['Other Column 18'][] = 'Net Realisation per Case';
        $row1['Other Column 19'][] = 'RM Cost';
        $row1['Other Column 20'][] = 'RM Scrap %';
        $row1['Other Column 21'][] = 'PM Cost';
        $row1['Other Column 22'][] = 'PM Scrap %';
        $row1['Other Column 23'][] = 'Conv. Cost';
        $row1['Other Column 24'][] = 'Primary freight';
        $row1['Other Column 25'][] = 'Total Basic Price';
        $row1['Other Column 26'][] = 'GM per case';
        $row1['Other Column 27'][] = 'GM %';
        $row1['Other Column 28'][] = 'GM per case (Ex-Factory)';
        $row1['Other Column 29'][] = 'GM % (Ex-Factory)';
        $row1['Other Column 30'][] = 'Secondary Freight';
        $row1['Other Column 31'][] = 'Damages (%)';
        $row1['Other Column 32'][] = 'Logistics cost (%)';
        $row1['Other Column 33'][] = 'Secondary Freight/case %';
        $row1['Other Column 34'][] = 'Damages per case';
        $row1['Other Column 35'][] = 'Logistics cost per case';
        $row1['Other Column 36'][] = 'Total Variable cost per case';
        $row1['Other Column 37'][] = 'Estd COGS ( Inclusive of Variable cost) per case';
        $row1['Other Column 38'][] = 'NR per Case';
        $row1['Other Column 39'][] = 'COGS per case';
        $row1['Other Column 40'][] = 'Estimated NM Per Case';
        $row1['Other Column 41'][] = 'Estimated NM (%)';

        for ($i = 0; $i < $prmcount; $i++) {
            $row1['Other Column 1'][] = 'Per Case';
            $row1['Other Column 2'][] = $material_code;
            $row1['Location Column'][] = $plocation[$i];
            $row1['Other Column 3'][] = $pieces_per_case;
            $row1['Other Column 4'][] = $mrp_piece;
            $row1['Other Column 5'][] = $mrp_per_case;
            $row1['Other Column 6'][] = $fill_volume;
            $row1['Other Column 7'][] = $specific_gravity;
            $row1['Other Column 8'][] = $sales_tax .'%';
            $row1['Other Column 9'][] = $retailer_margin[$i] . '%';
            $row1['Other Column 10'][] = $primary_scheme[$i].'%';
            $row1['Other Column 11'][] = $rs_margin[$i].'%';
            $row1['Other Column 12'][] = $ss_margin[$i].'%';
            $row1['Other Column 13'][] = $cost_to_retailer[$i];
            $row1['Other Column 14'][] = $cost_after_scheme[$i];
            $row1['Other Column 15'][] = $landed_cost_to_rs[$i];
            $row1['Other Column 16'][] = $nr_per_case_before[$i];
            $row1['Other Column 17'][] = $sec_scheme;
            $row1['Other Column 18'][] = $nr_per_case[$i];
            $row1['Other Column 19'][] = $rm_cost;
            $row1['Other Column 20'][] = $rm_scrap_cost;
            $row1['Other Column 21'][] = $pm_cost;
            $row1['Other Column 22'][] = $pm_scrap_cost;
            $row1['Other Column 23'][] = $conv_cost;
            $row1['Other Column 24'][] = $primary_freight[$i];
            $row1['Other Column 25'][] = $total_basic_price[$i];
            $row1['Other Column 26'][] = $gm_per_case[$i];
            $row1['Other Column 27'][] = $gm_percent[$i].'%';
            $row1['Other Column 28'][] = $gm_per_case_ex_fact[$i];
            $row1['Other Column 29'][] = $gm_percent_ex_fact[$i].'%';
            $row1['Other Column 30'][] = $secondary_freight[$i];
            $row1['Other Column 31'][] = $damage.'%';
            $row1['Other Column 32'][] = $logistic.'%';
            $row1['Other Column 33'][] = $freight_case[$i];
            $row1['Other Column 34'][] = $damage_per_case[$i];
            $row1['Other Column 35'][] = $logistics_cost_per_case[$i];
            $row1['Other Column 36'][] = $total_variable_cost_per_case[$i];
            $row1['Other Column 37'][] = $cogs[$i];
            $row1['Other Column 38'][] = $nr_per_case[$i];
            $row1['Other Column 39'][] = $cogs[$i];
            $row1['Other Column 40'][] = $estimated_nm_per_case[$i];
            $row1['Other Column 41'][] = $estimated_nm_percent[$i].'%';

        }
        $data[] = $row1;

        // return Excel::download(new EPDCostSheetExport($data),'epdcostsheet.xlsx');
        return Excel::download(new EPDCostSheetExport($data,$prmcount),'EPD Cost Sheet.xlsx');

    }

    public function pending_request()
    {
        $data = MedRequest::select('*')
        ->where('approve_status','pending')
        ->orderby('id','desc')->get()->unique('pro_id');

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn  = '<a class="btn btn-success btn-sm" onclick="bf_approve('.$row->id.')" ><i class="bx bx-check icon nav-icon"></i></a>';
                return $btn;
            })
            ->addColumn('division', function($row){
                $basic = Basic::where('pro_id',$row->pro_id)->first();
                if($basic->division !=null){
                $divisioname = Division::find($basic->division);
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
            ->rawColumns(['action','version','division'])
            ->make(true);
    }


    // -----------NEw PRODUCT----------
    public function approve_request(Request $request)
    {
        $id = $request->id;
        MedRequest::where('id',$id)->update(['approve_status'=>'approved']);
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function reject_request(Request $request)
    {
        $id = $request->id;
        MedRequest::where('id',$id)->update(['approve_status'=>'rejected']);
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function approved_medrequest()
    {
        $data = MedRequest::select('*')
        ->where('approve_status','approved')
        ->orderby('id','desc')->get()->unique('pro_id');

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('request', function($row){
                $request  = '<div class="badge bg-success text-dark ms" style="color:white!important;background-color: #2d00ff!important;">Amount : '.$row->amount.'</div><br>
                            <div class="badge bg-success text-dark ms" style="color:white!important;background-color: #8a0ad8f2!important;">Remarks : '.$row->remarks.'</div>';
                return $request;
            })
             ->addColumn('division', function($row){
                $basic = Basic::where('pro_id',$row->pro_id)->first();
                if($basic->division !=null){
                $divisioname = Division::find($basic->division);
                $division =$divisioname->division;
                }else{
                    $division ="--";
                }
                return $division;
             })
            ->rawColumns(['request','division'])
            ->make(true);
    }


    public function rejected_medrequest()
    {
        $data = MedRequest::select('*')
        ->where('approve_status','rejected')
        ->orderby('id','desc')->get()->unique('pro_id');

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('version', function($row){
                $version  = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
                return $version;
            })
            ->addColumn('request', function($row){
                $request  = '<div class="badge bg-success text-dark ms" style="color:white!important;background-color: #2d00ff!important;">Amount : '.$row->amount.'</div><br>
                            <div class="badge bg-success text-dark ms" style="color:white!important;background-color: #8a0ad8f2!important;">Remarks : '.$row->remarks.'</div>';
                return $request;
            })
            ->addColumn('division', function($row){
                $basic = Basic::where('pro_id',$row->pro_id)->first();
                if($basic->division !=null){
                $divisioname = Division::find($basic->division);
                $division =$divisioname->division;
                }else{
                    $division ="--";
                }
                return $division;
             })
            ->rawColumns(['version','request','division'])
            ->make(true);
    }

    //existing Product
    public function pending_exrequest()
    {
        $data = ExMedRequest::select('*')
        ->where('approve_status','pending')
        ->orderby('id','desc')->get()->unique('epro_id');

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn  = '<a class="btn btn-success btn-sm" onclick="bf_approve('.$row->id.')" ><i class="bx bx-check icon nav-icon"></i></a>';
                return $btn;
            })
             ->addColumn('division', function($row){
                $basic =  existing_product::where('epro_id',$row->epro_id)->first();
                if($basic->division !=null){
                $divisioname = Division::find($basic->division);
                $division =$divisioname->division;
                }else{
                    $division ="--";
                }
                return $division;
             })
            ->rawColumns(['action','division'])
            ->make(true);
    }

    public function approved_exmedrequest()
    {
        $data = ExMedRequest::select('*')
        ->where('approve_status','approved')
        ->orderby('id','desc')->get()->unique('epro_id');

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('request', function($row){
                $request  = '<div class="badge bg-success text-dark ms" style="color:white!important;background-color: #2d00ff!important;">Amount : '.$row->amount.'</div><br>
                            <div class="badge bg-success text-dark ms" style="color:white!important;background-color: #8a0ad8f2!important;">Remarks : '.$row->remarks.'</div>';
                return $request;
            })
             ->addColumn('division', function($row){
                $basic = existing_product::where('epro_id',$row->epro_id)->first();
                if($basic->division !=null){
                $divisioname = Division::find($basic->division);
                $division =$divisioname->division;
                }else{
                    $division ="--";
                }
                return $division;
             })
            ->rawColumns(['request','division'])
            ->make(true);
    }

    public function rejected_exmedrequest()
    {
        $data = ExMedRequest::select('*')
        ->where('approve_status','rejected')
        ->orderby('id','desc')->get()->unique('epro_id');

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('request', function($row){
                $request  = '<div class="badge bg-success text-dark ms" style="color:white!important;background-color: #2d00ff!important;">Amount : '.$row->amount.'</div><br>
                            <div class="badge bg-success text-dark ms" style="color:white!important;background-color: #8a0ad8f2!important;">Remarks : '.$row->remarks.'</div>';
                return $request;
            })
             ->addColumn('division', function($row){
                $basic = existing_product::where('epro_id',$row->epro_id)->first();
                if($basic->division !=null){
                $divisioname = Division::find($basic->division);
                $division =$divisioname->division;
                }else{
                    $division ="--";
                }
                return $division;
             })
            ->rawColumns(['request','division'])
            ->make(true);
    }

    public function approve_exrequest(Request $request)
    {
        $id = $request->id;
        ExMedRequest::where('id',$id)->update(['approve_status'=>'approved']);
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function reject_exrequest(Request $request)
    {
        $id = $request->id;
        ExMedRequest::where('id',$id)->update(['approve_status'=>'rejected']);
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function npdCostSheetApproval(Request $request){
        if($request->value == "Fill Volume (ml)"){
            $col = "b_volume_approval";
            $valueCol = "Volume";
          }
          else if($request->value == "PCS per CAS measure"){
            $col = "b_case_approval";
            $valueCol = "case_configuration";
        }else if($request->value == "MRP"){
            $col = "b_mrp_price_approval";
            $valueCol = "mrp_price";
        }else if($request->value == "Retailer Margin %"){
            $col = "b_retailer_margin_approval";
            $valueCol = "retailer_margin";
        }
        else if($request->value == "SS Margin %"){
            $col = "b_ss_margin_approval";
            $valueCol = "ss_margin";
        }else if($request->value == "Primary scheme (inbuilt) %"){
            $col = "b_primary_scheme_approval";
            $valueCol = "primary_scheme";
        }else if($request->value == "RS Margin %"){
            $col = "b_rs_margin_approval";
            $valueCol = "rs_margin";
        }else if($request->value == "Sales Tax/ GST %"){
            $col = "b_salesTax_approval";
            $valueCol = "salesTax";
        }else if($request->value == "Covo.cost"){
            $col = "b_conv_cost_approval";
            $valueCol = "conv_cost";
        }else if($request->value == "RM Scrap factor"){
            $col = "p_scrap_approval";
            $valueCol = "scrap";
        }else if($request->value == "Damages %"){
            $col = "b_damage_approval";
            $valueCol = "damage";
        }else if($request->value == "Logistics %"){
            $col = "b_logistic_approval";
            $valueCol = "logistic";
        }else if($request->value == "Primary Freight"){
            $col = "p_cost_approval";
            $valueCol = "cost";
        }
        else if($request->value == "Secondary Freight %"){
            $col = "s_cost_approval";
            $valueCol = "cost";
        }
        else if($request->value == "FG Scrap"){
            $col = "fg_scrap_approval";
            $valueCol = "fg_scrap";
        }
        if($request->type == "Approved"){
            $status = 1;
            $message = "Approved Successfully";
        }else{
            $status = 2;
            $message = "Rejected Successfully";
        }
        $productId = "";
        if($request->value == "RM Scrap factor"){
            // dd($request->colValue);d
            foreach($request->colValue as $val){
                $ids = explode(",",$val);
                $getOldData = Rm_cost::where('id',$ids[1])->first();
                if($request->type != "Approved"){
                    $saveHistory = new RmCostHistory();
                    $saveHistory->rm_costs_id = $ids[1];
                    $saveHistory->product_id = $getOldData->Product_id;
                    $saveHistory->scrap = $getOldData->scrap;
                    $saveHistory->remarks = $request->remarks;
                    $saveHistory->save();
                }else{
                    Rm_cost::where('id',$ids[1])->update([$valueCol=>$ids[0]]);
                }
                Rm_cost::where('id',$ids[1])->update([$col=>$status]);
                $productId = $getOldData->Product_id;
            }
        }else if($request->value == "Primary Freight"||$request->value == "SS Margin %"||$request->value == "Primary scheme (inbuilt) %"||$request->value == "RS Margin %"||$request->value == "Retailer Margin %"){

            $getProductId = Basic::where('id',$request->id)->pluck('pro_id')->first();
            $getOldData = Primary_location::where('pro_id',$getProductId)->get();
            $k = 0;
            foreach ($getOldData as $old) {
                if($request->type != "Approved"){
                    $saveHistory = new PrimaryLocationHistory();
                    $saveHistory->location_id = $old->id;
                    $saveHistory->product_id = $old->pro_id;
                    $saveHistory->cost = $old->$valueCol;
                    $saveHistory->description = $valueCol;
                    $saveHistory->remarks = $request->remarks;
                    $saveHistory->save();
                }else{
                    Primary_location::where('id',$old->id)->update(["cost"=>$request->colValue[$k]]);
                }
                if($col == "p_cost_approval"){
                    Primary_location::where('id',$old->id)->update([$col=>$status]);

                }else{
                    $primary=Primary_location::find($old->id);
                    Basic::where('pro_id',$primary->pro_id)->update([$col=>$status]);
                }
                $productId = $old->pro_id;
                $k++;
            }
        
         }else if($request->value == "Secondary Freight %"){

            $getProductId = Basic::where('id',$request->id)->pluck('pro_id')->first();
            $getOldData = Secondary_location::where('pro_id',$getProductId)->get();
            $k = 0;
            foreach ($getOldData as $old) {
                if($request->type != "Approved"){
                    $saveHistory = new SecondaryLocationHistory();
                    $saveHistory->location_id = $old->id;
                    $saveHistory->product_id = $old->pro_id;
                    $saveHistory->cost = $old->$valueCol;
                    $saveHistory->description = $valueCol;
                    $saveHistory->remarks = $request->remarks;
                    $saveHistory->save();
                }else{
                    Secondary_location::where('id',$old->id)->update(["cost"=>$request->colValue[$k]]);
                }
                if($col == "s_cost_approval"){
                    Secondary_location::where('id',$old->id)->update([$col=>$status]);
                }
                $productId = $old->pro_id;
                $k++;
            }
        }else{
            $getOldData = Basic::where('id',$request->id)->first();
            if($request->type != "Approved"){
                $saveHistory = new BasicsHistory();
                $saveHistory->basics_id = $request->id;
                $saveHistory->product_id = $getOldData->pro_id;
                $saveHistory->description = $valueCol;
                $saveHistory->value = $getOldData->$valueCol;
                $saveHistory->remarks=$request->remarks;
                $saveHistory->save();
            }else{
                Basic::where('id',$request->id)->update([$valueCol=>$request->colValue]);
            }
            Basic::where('id',$request->id)->update([$col=>$status]);
            $productId = $getOldData->pro_id;
        }

        // Check Approval Status
        $data = Basic::where('pro_id',$productId)->first();
        $data1 = Rm_cost::where('Product_id',$productId)->first();
        $data2 = Primary_location::where('pro_id',$productId)->first();
        $data3 = Secondary_location::where('pro_id',$productId)->first();

        $check = 0;
        if($data->b_volume_approval == 0 ||
        $data->b_volume_approval == 2 ||
        $data->b_case_approval == 0 ||
        $data->b_case_approval == 2 ||
        $data->b_mrp_price_approval == 0 ||
        $data->b_mrp_price_approval == 2 ||
        $data->b_retailer_margin_approval == 0 ||
        $data->b_retailer_margin_approval == 2 ||
        $data->b_ss_margin_approval == 0 ||
        $data->b_ss_margin_approval == 2 ||
        $data->b_primary_scheme_approval == 0 ||
        $data->b_primary_scheme_approval == 2 ||
        $data->b_rs_margin_approval == 0 ||
        $data->b_rs_margin_approval == 2 ||
        $data->b_salesTax_approval == 0 ||
        $data->b_salesTax_approval == 2 ||
        $data->b_conv_cost_approval == 0 ||
        $data->b_conv_cost_approval == 2 ||
        $data->b_damage_approval == 0 ||
        $data->b_damage_approval == 2||
        $data->b_logistic_approval == 0 ||
        $data->b_logistic_approval == 2){
            $check = 1;
        }
        if($data1->p_scrap_approval == 0 ||
        $data1->p_scrap_approval == 2){
            $check = 1;
        }
        if($data2->p_cost_approval == 0 ||
        $data2->p_cost_approval == 2){
            $check = 1;
        }
        if( $data3 ->s_cost_approval == 0 ||
        $data2->p_cost_approval == 2){
            $check = 1;
        }
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => $message,
            "check" => $check
        ]);
    }


    public function approveRejectMoq(Request $request){

        $getData = Product_Material::where('id',$request->labelId)->first();
        $moqStatus = json_decode($getData->p_moq_approval);
        $moq = json_decode($getData->MOQ);
        $pmCost = json_decode($getData->pm_cost);
        $vendor = json_decode($getData->vendor);
        $moqStatus[$request->iVal] = $request->type;
        $moq[$request->iVal] = $request->moqValue;
        $pmCost[$request->iVal] = $request->moqCase;
        if($request->type == 1){
            $message = "Approved Successfully";
        }else{
            $message = "Rejected Successfully";
            $saveHistory = new MoqHistory();
            $saveHistory->moq_id = $request->labelId;
            $saveHistory->product_id = $getData->product_id;
            $saveHistory->vendor = $vendor[$request->iVal];
            $saveHistory->moq = $request->moqValue;
            $saveHistory->remarks = $request->remarks;
            $saveHistory->save();
        }
        Product_Material::where('id',$request->labelId)->update([
            'p_moq_approval'=>json_encode($moqStatus),
            'MOQ'=>json_encode($moq),
            'pm_cost'=>json_encode($pmCost)
        ]);
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => $message
        ]);
    }

    // Update status in basic table
    public function sheetOverallApproval(Request $request){
        if(auth()->user()->role == "Marketing"){
            $col = "mt_csheet_approval";
        }elseif(auth()->user()->role == "Finance"){
            $col = "csheet_approval";
        }
        $basicData = Basic::where('id',$request->id)->update([$col=>$request->type]);
        if($request->type == "Approved"){
            $message = "Approved Successfully";
        }else{
            $message = "Rejected Successfully";
        }
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => $message
        ]);
    }


    public function exportepdcs(Request $request){
        $material_code = $request->material_code;
        $plant = $request->plant;
        $plocation = $request->plocation;
        $pieces_per_case = $request->pieces_per_case;
        $mrp_piece = $request->mrp_piece;
        $mrp_per_case = $request->mrp_per_case;
        $fill_volume = $request->fill_volume;
        $specific_gravity = $request->specific_gravity;
        $sales_tax = $request->sales_tax;

        $retailer_margin = $request->retailer_margin;
        $primary_scheme = $request->primary_scheme;
        $rs_margin = $request->rs_margin;
        $ss_margin = $request->ss_margin;
        $cost_to_retailer = $request->cost_to_retailer;
        $cost_after_scheme = $request->cost_after_scheme;
        $landed_cost_to_rs = $request->landed_cost_to_rs;
        $nr_per_case_before = $request->nr_per_case_before;
        $sec_scheme = $request->sec_scheme;
        $nr_per_case = $request->nr_per_case;

        $rm_cost = $request->rm_cost;
        $rm_scrap_cost = $request->rm_scrap_cost;
        $pm_cost = $request->pm_cost;
        $pm_scrap_cost = $request->pm_scrap_cost;
        $conv_cost = $request->conv_cost;

        $primary_freight = $request->primary_freight;
        $total_basic_price = $request->total_basic_price;
        $gm_per_case = $request->gm_per_case;
        $gm_percent = $request->gm_percent;
        $gm_per_case_ex_fact = $request->gm_per_case_ex_fact;
        $gm_percent_ex_fact = $request->gm_percent_ex_fact;
        $secondary_freight = $request->secondary_freight;
        $damage = $request->damage;
        $logistic = $request->logistic;
        $freight_case = $request->freight_case;
        $damage_per_case = $request->damage_per_case;
        $logistics_cost_per_case = $request->logistics_cost_per_case;
        $total_variable_cost_per_case = $request->total_variable_cost_per_case;
        $cogs = $request->cogs;
        $nr_per_case2 = $request->nr_per_case2;
        $cogs2 = $request->cogs2;
        $estimated_nm_per_case = $request->estimated_nm_per_case;
        $estimated_nm_percent = $request->estimated_nm_percent;

        $prmcount = $request->prmcount;
        $data = [];

        $data[] = [
            [
                'material_code' => 'CavinKare Pvt Ltd',
                'BSC Cream' => '',
            ],
            [
                'material_code' => 'Tentative Cost sheet',
                'BSC Cream' => '',
            ],
            [
                'material_code' => 'Material Code : '.$request->material_code ,
                'BSC Cream' => '',
            ],
            [
                'material_code' => 'Plant : '.$plant,
                'BSC Cream' => '',
            ],
            [
                'material_code' => '',
                'Per piece' => ''
            ],
        ];
        // Section 1: Particulars
        // $row1['Other Column 1'][] = 'Particulars';
        $row1 = ['Other Column 1' => ['Particulars']];
        $row1['Other Column 2'][] = 'Material code';
        $row1['Location Column'][] = 'Location';
        $row1['Other Column 3'][] = 'No. of Pcs / case';
        $row1['Other Column 4'][] = 'MRP per piece';
        $row1['Other Column 5'][] = 'MRP per case';
        $row1['Other Column 6'][] = 'Fill Volume';
        $row1['Other Column 7'][] = 'Specific gravity';
        $row1['Other Column 8'][] = 'Average Sales Tax (%)';
        $row1['Other Column 9'][] = 'Retailers margin (%)';
        $row1['Other Column 10'][] = 'Primary Scheme (%)';
        $row1['Other Column 11'][] = 'RS Margin (%)';
        $row1['Other Column 12'][] = 'Super Margin (%)';
        $row1['Other Column 13'][] = 'Landed Cost to Retailer';
        $row1['Other Column 14'][] = 'Cost after Scheme';
        $row1['Other Column 15'][] = 'Landed Cost to Distributor';
        $row1['Other Column 16'][] = 'NR per Case ( before Sec TPR)';
        $row1['Other Column 17'][] = 'Scheme ( Sec)';
        $row1['Other Column 18'][] = 'Net Realisation per Case';
        $row1['Other Column 19'][] = 'RM Cost';
        $row1['Other Column 20'][] = 'RM Scrap %';
        $row1['Other Column 21'][] = 'PM Cost';
        $row1['Other Column 22'][] = 'PM Scrap %';
        $row1['Other Column 23'][] = 'Conv. Cost';
        $row1['Other Column 24'][] = 'Primary freight';
        $row1['Other Column 25'][] = 'Total Basic Price';
        $row1['Other Column 26'][] = 'GM per case';
        $row1['Other Column 27'][] = 'GM %';
        $row1['Other Column 28'][] = 'GM per case (Ex-Factory)';
        $row1['Other Column 29'][] = 'GM % (Ex-Factory)';
        $row1['Other Column 30'][] = 'Secondary Freight';
        $row1['Other Column 31'][] = 'Damages (%)';
        $row1['Other Column 32'][] = 'Logistics cost (%)';
        $row1['Other Column 33'][] = 'Secondary Freight/case %';
        $row1['Other Column 34'][] = 'Damages per case';
        $row1['Other Column 35'][] = 'Logistics cost per case';
        $row1['Other Column 36'][] = 'Total Variable cost per case';
        $row1['Other Column 37'][] = 'Estd COGS ( Inclusive of Variable cost) per case';
        $row1['Other Column 38'][] = 'NR per Case';
        $row1['Other Column 39'][] = 'COGS per case';
        $row1['Other Column 40'][] = 'Estimated NM Per Case';
        $row1['Other Column 41'][] = 'Estimated NM (%)';

        for ($i = 0; $i < $prmcount; $i++) {
            $row1['Other Column 1'][] = 'Per Case';
            $row1['Other Column 2'][] = $material_code;
            $row1['Location Column'][] = $plocation[$i];
            $row1['Other Column 3'][] = $pieces_per_case;
            $row1['Other Column 4'][] = $mrp_piece;
            $row1['Other Column 5'][] = $mrp_per_case;
            $row1['Other Column 6'][] = $fill_volume;
            $row1['Other Column 7'][] = $specific_gravity;
            $row1['Other Column 8'][] = $sales_tax .'%';
            $row1['Other Column 9'][] = $retailer_margin[$i] . '%';
            $row1['Other Column 10'][] = $primary_scheme[$i].'%';
            $row1['Other Column 11'][] = $rs_margin[$i].'%';
            $row1['Other Column 12'][] = $ss_margin[$i].'%';
            $row1['Other Column 13'][] = $cost_to_retailer[$i];
            $row1['Other Column 14'][] = $cost_after_scheme[$i];
            $row1['Other Column 15'][] = $landed_cost_to_rs[$i];
            $row1['Other Column 16'][] = $nr_per_case_before[$i];
            $row1['Other Column 17'][] = $sec_scheme;
            $row1['Other Column 18'][] = $nr_per_case[$i];
            $row1['Other Column 19'][] = $rm_cost;
            $row1['Other Column 20'][] = $rm_scrap_cost;
            $row1['Other Column 21'][] = $pm_cost;
            $row1['Other Column 22'][] = $pm_scrap_cost;
            $row1['Other Column 23'][] = $conv_cost;
            $row1['Other Column 24'][] = $primary_freight[$i];
            $row1['Other Column 25'][] = $total_basic_price[$i];
            $row1['Other Column 26'][] = $gm_per_case[$i];
            $row1['Other Column 27'][] = $gm_percent[$i].'%';
            $row1['Other Column 28'][] = $gm_per_case_ex_fact[$i];
            $row1['Other Column 29'][] = $gm_percent_ex_fact[$i].'%';
            $row1['Other Column 30'][] = $secondary_freight[$i];
            $row1['Other Column 31'][] = $damage.'%';
            $row1['Other Column 32'][] = $logistic.'%';
            $row1['Other Column 33'][] = $freight_case[$i];
            $row1['Other Column 34'][] = $damage_per_case[$i];
            $row1['Other Column 35'][] = $logistics_cost_per_case[$i];
            $row1['Other Column 36'][] = $total_variable_cost_per_case[$i];
            $row1['Other Column 37'][] = $cogs[$i];
            $row1['Other Column 38'][] = $nr_per_case2[$i];
            $row1['Other Column 39'][] = $cogs2[$i];
            $row1['Other Column 40'][] = $estimated_nm_per_case[$i];
            $row1['Other Column 41'][] = $estimated_nm_percent[$i].'%';

        }
        $data[] = $row1;

        // $filename = "epdcostsheet.xlsx";
        return Excel::download(new EPDCostSheetExport($data,$prmcount),'EPD Cost Sheet.xlsx');

    }

    //API

    public function get_plant(Request $request){
        $met_code = $request->mcode;
        $url = 'http://13.126.161.240:8002/sap/bc/zckpp01';
        // $username = 'CKPL_ABAP_03';
        // $password = 'Winter01';
        $username = 'SAP_API_01';
        $password = 'Cavin@123';

        // $url = 'http://10.100.7.73:8002/sap/bc/zckpp01';

        if(isset($request->mtype)){
            $jsonRequest = '[{"matnr":"'.$met_code.'","werks":"*","mtart":"'.$request->mtype.'","type":"NPD/EPD"}]';
        }else{
            $jsonRequest = '[{"matnr":"'.$met_code.'","werks":"*","mtart":"*","type":"NPD/EPD"}]';
        }

        // Create a cURL handle
        $ch = curl_init($url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonRequest); // Set the JSON data here
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic ' . base64_encode("$username:$password"),
            'Content-Type: application/json', // Set the Content-Type header for JSON
        ));

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        } else {
            // Process the API response
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            if ($httpCode == 200) {
                // Successful response
                $data = $response;
                // var_dump($data);
            } else {
                // Handle non-200 HTTP status codes
                echo 'HTTP Error: ' . $httpCode;
                echo 'API Response: ' . $response;
            }
        }
        // Close cURL handle

        return response()->json([
            'result' => json_decode($data),
        ]);
    }
    // public function get_price(Request $request){
    //     $met_code = $request->mcode;
    //     $plantype = $request->plantype;

    //     $url = 'http://13.126.161.240:8002/sap/bc/zme2l_api';

    //     // Replace 'username' and 'password' with your actual credentials
    //     $username = 'CKPL_ABAP_03';
    //     $password = 'Winter01';
    //     // $currentDate = date('d.m.Y');
    //     // $fiveDaysAgo = date('d.m.Y', strtotime("-5 days"));
    //     $currentDate = "08.01.2023";
    //     $fiveDaysAgo = "04.03.2021";
    //     // Define the JSON request data
    //     $jsonRequest = '[{"matnr":"'.$met_code.'","werks":"'. $plantype.'","date": "'.$fiveDaysAgo.','.$currentDate.'"}]';

    //     $ch = curl_init($url);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonRequest);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    //         'Authorization: Basic ' . base64_encode("$username:$password"),
    //         'Content-Type: application/json',
    //     ));

    //     $response = curl_exec($ch);
    //     $data = json_decode($response, true);

    //     $uniqueRecords = [];
    //      if (curl_errno($ch)) {
    //         echo 'Curl error: ' . curl_error($ch);
    //     } else {
    //         $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    //         if ($httpCode == 200) {
    //             $data = $uniqueResponse;
    //             // var_dump($data);
    //         } else {
    //             echo 'HTTP Error: ' . $httpCode;
    //             echo 'API Response: ' . $uniqueResponse;
    //         }
    //     }

    //     foreach ($data['Data'] as $record) {
    //         $materialName = $record['MATERIAL NAME'];
    //         $docDate = $record['DOC DATE'];
    //         $uniqueKey = $materialName;

    //         // If the material exists and the current record has a more recent date, update the unique record
    //         if (isset($uniqueRecords[$uniqueKey]) && strtotime($docDate) > strtotime($uniqueRecords[$uniqueKey]['DOC DATE'])) {
    //             $uniqueRecords[$uniqueKey] = $record;
    //         } elseif (!isset($uniqueRecords[$uniqueKey])) {
    //             // If the material does not exist in uniqueRecords, add the current record
    //             $uniqueRecords[$uniqueKey] = $record;
    //         }
    //     }

    //     // Convert the unique records back to a JSON response
    //     $uniqueResponse = json_encode(['Data' => array_values($uniqueRecords)], JSON_PRETTY_PRINT);


    //     return response()->json([
    //         'result' => json_decode($data),
    //     ]);
    // }
    public function get_price(Request $request)
    {
        $met_code = $request->mcode;
        $plantype = $request->plantype;

        $url = 'http://13.126.161.240:8002/sap/bc/zme2l_api';
        // $url = 'http://10.100.7.73:8002/sap/bc/zme2l_api';

        // Replace 'username' and 'password' with your actual credentials
        $username = 'CKPL_ABAP_03';
        $password = 'Winter01';
        // $username = 'SAP_API_01';
        // $password = 'Cavin@1234';

        // Define the JSON request data
        // $currentDate = "08.01.2023";
        // $fiveDaysAgo = "04.03.2021";
        $currentDate = date('d.m.Y');
        $sixMonthsAgo = date('d.m.Y', strtotime("-6 months"));
        $jsonRequest = json_encode([
            [
                'matnr' => $met_code,
                'werks' => $plantype,
                'date'  => "$sixMonthsAgo,$currentDate",
            ]
        ]);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonRequest);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Basic ' . base64_encode("$username:$password"),
            'Content-Type: application/json',
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return response()->json([
                'error' => 'Curl error: ' . curl_error($ch),
            ], 500);
        }

        $data = json_decode($response, true);

        if (json_last_error() != JSON_ERROR_NONE) {
            return response()->json([
                'error' => 'Json Decode Error ',
            ], 500);
        }

        $uniqueRecords = [];
        if(isset($data['Data'] )){
            foreach ($data['Data'] as $record) {
                $materialName = $record['MATERIAL NAME'];
                $docDate = $record['DOC DATE'];
                $uniqueKey = $materialName;

                if (isset($uniqueRecords[$uniqueKey]) && strtotime($docDate) > strtotime($uniqueRecords[$uniqueKey]['DOC DATE'])) {
                    $uniqueRecords[$uniqueKey] = $record;
                } elseif (!isset($uniqueRecords[$uniqueKey])) {
                    $uniqueRecords[$uniqueKey] = $record;
                }
                break;
            }

            $uniqueResponse = json_encode(['Data' => array_values($uniqueRecords)], JSON_PRETTY_PRINT);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            if ($httpCode == 200) {
                $data = $uniqueResponse;
            } else {
                return response()->json([
                    'error' => 'HTTP Error: ' . $httpCode,
                    'api_response' => $uniqueResponse,
                ], $httpCode);
            }
        }else{
            $data="Sap data not available";
        }


        return response()->json([
            'result' => json_decode($data),
        ]);
    }

    public function send_apirequest(Request $request){
        // $id = $request->pro_id;
        $id = $_GET['proid'];
        $material_code = $request->mcode;
        $material_type = $request->mtype;
        $plant = $request->plant;
        $date = date('d.m.Y');

        $username = 'SAP_API_01';
        $password = 'Cavin@123';

        // $username = env('SAP_USERNAME');
        // $password = env('SAP_PASSWORD');
        // dd($_ENV);
        // print_r($username);
        // exit;

        $url = 'http://13.126.161.240:8002/sap/bc/zckpp02';

        // //GET SCRAP
        // $url = 'http://10.100.7.73:8002/sap/bc/zckpp02';
        $jsonRequest = '[{"MATERIAL_CODE":"'.$material_code.'","MATERIAL_TYPE":"'.$material_type.'","PLANT":"'.$plant.'","DATE":"'.$date.'"}]';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonRequest); // Set the JSON data here
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic ' . base64_encode("$username:$password"),
            'Content-Type: application/json', // Set the Content-Type header for JSON
        ));

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        } else {
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($httpCode == 200) {
                $data1 = $response;
                // var_dump($data);
            } else {
                echo 'HTTP Error: ' . $httpCode;
                echo 'API Response: ' . $response;
            }
        }
        $dataa1 = json_decode($data1, true);

        if(isset($dataa1['Data'][0]['MAKTX'])){
            $material_name = $dataa1['Data'][0]['MAKTX'];
        }else{
            echo "No Data Found in SAP for this material code : $material_code !";
            return false;
        }

        // $materialname = 'test';
        $materialname = $dataa1['Data'][0]['COMP_NAME'];
        $material_name = $dataa1['Data'][0]['MAKTX'];

            if( (preg_match("/(\d+)G/i", $material_name, $matches))||(preg_match("/(\d+) G/i", $material_name, $matches)) ) {
                $grams = $matches[1];
            }
            if ((preg_match("/(\d+) P/i", $material_name, $matches))||(preg_match("/(\d+)P/i", $material_name, $matches)) ){
                $pcs = $matches[1];
            }
            if ((preg_match("/(\d+) M/i", $material_name, $matches))||(preg_match("/(\d+)M/i", $material_name, $matches))  ){
                $ml = $matches[1];
            }
            if ((preg_match("/(\d+) K/i", $material_name, $matches))||(preg_match("/(\d+)K/i", $material_name, $matches))  ){
                $kg = $matches[1];
            }

            if(isset($grams)&&(!isset($pcs))){
                $fill_volume=$grams."GM";
            }else if(isset($grams)&&(isset($pcs))){
                $fill_volume=$grams."GM";
            }else if(((!isset($grams)) && (isset($pcs)) && (!isset($ml)) && ((!isset($kg))))){
                $fill_volume=$pcs."PCS";
            }else if(isset($kg)&&(!isset($pcs))){
                $fill_volume=$kg."Kg";
            }
            else if(isset($ml)&&(!isset($pcs))){
                $fill_volume=$ml."ML";
            }
            else if(isset($ml)&&(isset($pcs))){
                $fill_volume=$ml."ML";
            }else{
                $fill_volume="0.00";
            }
        $add_rmscrap = '0';
        $add_pmscrap = '0';
        foreach ($dataa1['Data'] as $item) {
            $firstDigit ='';
            $component = $item['COMPONENT'];
            $firstDigit = (string)$component[0];

            $comp_scrap = $item['COMP_SCRAP'];
            if($firstDigit == 6){
                $add_rmscrap = (float)$add_rmscrap + (float)$comp_scrap;
            }elseif($firstDigit == 5){
                $add_pmscrap = (float)$add_pmscrap + (float)$comp_scrap;
            }
        }
        // // print_r($add_pmscrap);exit;
        $rmscrap = $add_rmscrap;
        $pmscrap = $add_pmscrap;


        // GET MRP ------------------xxxxxxx--------------------start-----------------------------------------
        $url2 = 'http://13.126.161.240:8002/sap/bc/zmek3'; //quality link
        // $url2 = 'http://10.100.7.73:8002/sap/bc/zmeK3'; // production link
        $jsonRequest2 = '[{"plant":"'.$plant.'","material":"'.$material_code.'","date":"'.$date.'"}]';

        $ch2 = curl_init($url2);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch2, CURLOPT_POST, true);
        curl_setopt($ch2, CURLOPT_POSTFIELDS, $jsonRequest2);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic ' . base64_encode("$username:$password"),
            'Content-Type: application/json',
        ));

        $response2 = curl_exec($ch2);
        if (curl_errno($ch2)) {
            echo 'Curl error: ' . curl_error($ch2);
        } else {
            $httpCode2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
            if ($httpCode2 == 200) {
                $data2 = $response2;
                // var_dump($data);
            } else {
                echo 'HTTP Error: ' . $httpCode2;
                echo 'API Response: ' . $response2;
            }
        }
        $dataa2 = json_decode($data2, true);

        if(isset($dataa2['Data'][0]['Amount'])){
            $amount = $dataa2['Data'][0]['Amount'];
        }else{
            echo "No Data Found in SAP for this material code : $material_code !";
            return false;
        }

        // // GET RM  PM & CONV. COST  ---------xxxxxxxxxx-----------------------------------------start-------
        // $url3 = 'http://13.126.161.240:8002/sap/bc/zckpp09'; //quality link
        // // $url3 = 'http://10.100.7.73:8002/sap/bc/zckpp09'; //production link
        // $jsonRequest3 = '[{"plant":"'.$plant.'","material":"'.$material_code.'","date":"'.$date.'"}]';

        // $ch3 = curl_init($url3); 
        // curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch3, CURLOPT_POST, true);
        // curl_setopt($ch3, CURLOPT_POSTFIELDS, $jsonRequest3);
        // curl_setopt($ch3, CURLOPT_HTTPHEADER, array(
        //     'Authorization: Basic ' . base64_encode("$username:$password"),
        //     'Content-Type: application/json',
        // ));

        // $response3 = curl_exec($ch3);

        // if (curl_errno($ch3)) {
        //     echo 'Curl error: ' . curl_error($ch3);
        // } else {
        //     $httpCode3 = curl_getinfo($ch3, CURLINFO_HTTP_CODE);

        //     if ($httpCode3 == 200) {
        //         $data3 = $response3;
        //         // var_dump($data);
        //     } else {
        //         echo 'HTTP Error: ' . $httpCode3;
        //         echo 'API Response: ' . $response3;
        //     }
        // }

        // $dataa3 = json_decode($data3, true);

        // $add_rmcost = '0';
        // $add_pmcost = '0';
        // $add_conv_cost = '0';

        // if(isset($dataa3['Data'])){
        //     foreach ($dataa3['Data'] as $itm) {
        //         $centerDigit ='';

        //         if (array_key_exists('IN_MAT', $itm)) {
        //             if( isset( $itm['COST'] ) ){
        //                 $cost = $itm['COST'];
        //             }else{
        //                 $cost = '0';
        //             }
        //             if($material_code == $itm['IN_MAT']){
        //                 $add_conv_cost = (float)$add_conv_cost + (float)$cost;
        //             }else{
        //                 $mat = $itm['IN_MAT'];
        //                 $centerDigit = (string)$mat[11];

        //                 if($centerDigit == 6){
        //                     $add_rmcost = (float)$add_rmcost + (float)$cost;
        //                 }elseif($centerDigit == 5){
        //                     $add_pmcost = (float)$add_pmcost + (float)$cost;
        //                 }
        //             }
        //         }
        //     }
        // }

        // $rmcost = $add_rmcost;
        // $pmcost = $add_pmcost;
        // $conv_cost = $add_conv_cost;

        $data['basic'] =  existing_product::where('id',$id)->select('*')->first();
        $basic = $data['basic'];

        $data['type'] = $material_type;
        $data['material_name'] = $materialname;
        $data['fill_volume'] = $fill_volume;
        $data['plant'] = $plant;
        $data['mrp_piece'] = $amount;
        $data['mrp_per_case'] = $basic->pieces_per_case * $amount;
        // $data['mrp_per_case'] = $basic->pieces_per_case * $basic->mrp_piece;
        $data['salesTax'] = $basic->salesTax;

        $data['rm_cost'] = $basic->rmcost;
        $data['rm_scrap_cost'] = $rmscrap;
        $data['pm_cost'] = $basic->pmcost;
        $data['pm_scrap_cost'] = $pmscrap;
        $data['conv_cost'] = $basic->conv_cost;

        $data['location'] = EpdPrimaryLocations :: where('pro_id',$basic->epro_id)->get();
        $data['pcount'] = $data['location']->count();

        $dist_channel = dist_channel::find($basic->distribution_channel);
        $data['dist_channel'] = $dist_channel ? $dist_channel->dist_name : "";

        $data['p_loc'] = [];
        $data['primary_freight'] = [];
        $data['cost_to_retailer'] = [];
        $data['Cost_after_scheme'] = [];
        $data['Landed_Cost_to_RS'] = [];
        $data['nr_per_case_before'] = [];
        $data['nr_per_case'] = [];
        $data['Total_Basic_Price'] = [];
        $data['gm_per_case'] = [];
        $data['gm_percent'] = [];
        $data['gm_per_case_ex_fact'] = [];
        $data['gm_percent_ex_fact'] = [];
        $data['freight_case'] = [];
        $data['damage_per_case'] = [];
        $data['Logistics_cost_per_case'] = [];
        $data['Total_Variable_cost_per_case'] = [];
        $data['cogs'] = [];
        $data['Estimated_NM_per_case'] = [];
        $data['Estimated_NM_percent'] = [];
        $data['p_cost_approval'] = '';

        foreach ($data['location'] as $val){
            $pf_location = LocationMaster::find($val->from_location);
            $pt_location = LocationMaster::find($val->to_location);

            $data['p_loc'][] = $pf_location->location .' (to) '.$pt_location->location;

            // retailer margin percentage value + 1
            $retailmargin1 = 1 + ($val->retailer_margin/100);
            $retailmargin_another = 1 - ($val->retailer_margin/100);
            // primary scheme percentage value +1
            $primscheme1 = 1 + ($val->primary_scheme/100);
            // rs margin percentage value +1
            $rsmargn1 = 1 + ($val->rs_margin/100);
            // ss margin percentage value +1
            $ssmargn1 = 1 + ( $val->ss_margin/100);
            // salestax percentage value +1
            $salestx = 1+ ($basic->salesTax/100);

            $cost_to_retailer = round($data['mrp_per_case'] / $retailmargin1,2);
            $data['cost_to_retailer'][] = $cost_to_retailer;

            $cost_after_scheme = round($cost_to_retailer / $primscheme1,2);
            $data['Cost_after_scheme'][] = $cost_after_scheme;

            $landed_cost_to_rs = round($cost_after_scheme / $rsmargn1 / $ssmargn1,2);
            $data['Landed_Cost_to_RS'][] = $landed_cost_to_rs;

            // $nr_per_case_before = round($landed_cost_to_rs / (1+ $basic->salesTax/100 ),2);
            // $data['nr_per_case_before'][] = $nr_per_case_before;

            if($data['dist_channel'] == "GT"){

                // NR Per Case = a/ (1+b %)( 1+c %)/(1+d%)/(1+e%)/(1+f%) – If Markup 
                // A -MRP // B -Retailer Margin // C -Primary Scheme // D -RS Margin // E -SS Margin // F -Tax 
                $cost_to_retailer = round($data['mrp_per_case'] / $retailmargin1,2);
                $data['cost_to_retailer'][] = $cost_to_retailer;
                // $nr_per_case_before = round($cost_to_retailer/ $salestx ,2);
                // $data['nr_per_case_before'][] = $nr_per_case_before;
                // $data['nr_percase_title'] = "MRP(Per Case)/ (1+ Retailer margin%)* (1+ Primary scheme%)/ (1+ RS margin%)/ (1+ SS margin%)/ (1+ Sales tax%)";

            }else{
                // NR Per Case = (a-(a*b%))/(1+c%)/(1+d%)/(1+e%)/(1+f%) – If Markdown 
                $cost_to_retailer = round($data['mrp_per_case'] * $retailmargin_another,2);
                $data['cost_to_retailer'][] = $cost_to_retailer;
                // $nr_per_case_before = round( ($data['mrp_per_case'] - ($data['mrp_per_case'] * ($val->retailer_margin/100)) )/ $primscheme1 / $rsmargn1 / $ssmargn1 / $salestx ,2);
                // $data['nr_per_case_before'][] = $nr_per_case_before;
                // $data['nr_percase_title'] = "( MRP(Per Case)-(MRP(Per Case)*Retailer margin%) )/ (1+ Primary scheme%)/ (1+ RS margin%)/ (1+ SS margin%)/ (1+ Sales tax%)";
            }

            $landed_cost_to_rs = round($cost_after_scheme / $rsmargn1 / $ssmargn1,2);
            $data['Landed_Cost_to_RS'][] = $landed_cost_to_rs;
            $nr_per_case_before = round( $landed_cost_to_rs  / $salestx ,2);
            $data['nr_per_case_before'][] = $nr_per_case_before;
            $data['nr_percase_title'] = "( Landed Cost to RS/ (1+ Sales tax%)";
            $nr_per_case = $nr_per_case_before - 0.00;
            $data['nr_per_case'][] = $nr_per_case;
            // $data['nr_per_case'] = $nr_per_case_before - $basic->secondary_freight;

            // $data['primary_freight'][] = round($nr_per_case*($val->freight/100), 2);
            $data['primary_freight'][] = $val->freight;

            $total_basic_price = round($data['rm_cost'] + $data['rm_scrap_cost'] + $data['pm_cost'] + $data['pm_scrap_cost'] + $data['conv_cost'] + $val->freight, 2);
            $data['Total_Basic_Price'][] = $total_basic_price ;
            $gm_per_case = round ($nr_per_case_before - $total_basic_price, 2);
            $data['gm_per_case'][] = $gm_per_case;

            if($data['nr_per_case_before'] != '0'){
                $data['gm_percent'][] = round (($gm_per_case / $nr_per_case_before)*100, 2);
            }else{
                $data['gm_percent'][] = $gm_per_case*100;
            }

            $gm_per_case_ex_fact = round ($gm_per_case + $val->freight, 2);
            $data['gm_per_case_ex_fact'][] = $gm_per_case_ex_fact;

            $data['gm_percent_ex_fact'][] = round (($gm_per_case_ex_fact / $nr_per_case)*100, 2);

            $damage_per_case = round ($nr_per_case * ($basic->damage/100), 2);
            $data['damage_per_case'][] = $damage_per_case;

            $logistics_cost_per_case = round ($nr_per_case * ($basic->logistic/100), 2);
            $data['Logistics_cost_per_case'][] = $logistics_cost_per_case;


            // $freight_case = round ($nr_per_case * ( $val->freight/100 ), 2);
            // $data['freight_case'][] = $freight_case;
            $data['seclocation'] = EpdSecondaryLocations :: where('epro_id',$basic->epro_id)->where('from_location',$val->to_location)->get();
            foreach ($data['seclocation'] as $sval){
                if($val->to_location == $sval->from_location){
                    $data['sfreight'][] = $sval->freight;
                    $freight_case = round ( $sval->freight / $nr_per_case, 3);
                    $data['freight_case'][] = $freight_case * 100;
                    // dd($freight_case);
                    $data['s_cost_approval'] = $sval->s_cost_approval;
                }else{
                    $data['sfreight'][] ="0";
                    $freight_case = "0";
                    $data['freight_case'][] = "0";
                    $data['s_cost_approval'] = "0";
                }
            }
            
            $total_variable_cost_per_case = round ($freight_case + $damage_per_case + $logistics_cost_per_case, 2);
            $data['Total_Variable_cost_per_case'][] = $total_variable_cost_per_case;

            $cogs = round ($total_basic_price + $total_variable_cost_per_case, 2);//total basic price
            $data['cogs'][] = $cogs;

            $estimated_nm_per_case = round ($nr_per_case - $cogs, 2);
            $data['Estimated_NM_per_case'][] = $estimated_nm_per_case;

            $data['Estimated_NM_percent'][] = round (($estimated_nm_per_case / $nr_per_case)*100, 2);

            $data['p_cost_approval'] = $val->p_cost_approval;
            $data['rm_approval'] = $val->retail_margin_approval;
            $data['ps_approval'] = $val->prim_scheme_approval;
            $data['rsm_approval'] = $val->rsm_approval;
            $data['ssm_approval'] = $val->ssmargin_approval;

        }

        $data['stylesandjs']="1";
        return view('finance.vex_costsheet',compact('data'));

    }


    public function approve_epd_svalue(Request $request) {
        $id = $request->id;
        $type = $request->type;
        $colmName = $request->colum;
        $colValue = $request->value;


        if($colmName == 'pieces_per_case'){
            $col = 'noofpcs_approval';
        }elseif($colmName == 'salesTax'){
            $col = 'tax_approval';
        }elseif($colmName == 'damage'){
            $col = 'damage_approval';
        }elseif($colmName == 'logistic'){
            $col = 'logistic_approval';
        }elseif($colmName == 'primary_freight'){
            $col = 'p_cost_approval';
        }elseif($colmName == 'secondary_freight'){
            $col = 's_cost_approval';
        }elseif($colmName == 'retailer_margin'){
            $col = 'retail_margin_approval';
        }elseif($colmName == 'primary_scheme'){
            $col = 'prim_scheme_approval';
        }elseif($colmName == 'rs_margin'){
            $col = 'rsm_approval';
        }elseif($colmName == 'ss_margin'){
            $col = 'ssmargin_approval';
        }elseif($colmName == 'specific_gravity'){
            $col = 'gravity_approval';
        }

        if($colmName == "primary_freight" || $colmName == 'retailer_margin' || $colmName == 'primary_scheme' || $colmName == 'rs_margin' || $colmName == 'ss_margin'){
            $geteProductId = existing_product::where('id',$id)->pluck('epro_id')->first();

            if($type == "approved"){
                EpdPrimaryLocations::where('pro_id',$geteProductId)->update([$col => '1']);
                $message = "Approved Successfully";
            }else{
                EpdPrimaryLocations::where('pro_id',$geteProductId)->update([$col => '2']);
                $getLocation = EpdPrimaryLocations::where('pro_id',$geteProductId)->get();
                foreach ($getLocation as $k => $locate) {
                    $sHistory = new EpdRejectHistory();
                    $sHistory->epro_id = $id;
                    $sHistory->location = $locate->from_location;
                    $sHistory->column_name = $colmName;
                    $sHistory->value = $colValue[$k];
                    $sHistory->remarks = $request->remarks;
                    $sHistory->save();
                }
                $message = "Rejected Successfully";
            }
        }elseif($colmName == "secondary_freight"){
            $geteProductId = existing_product::where('id',$id)->pluck('epro_id')->first();

            if($type == "approved"){
                EpdSecondaryLocations::where('epro_id',$geteProductId)->update([$col => '1']);
                $message = "Approved Successfully";
            }else{
                EpdSecondaryLocations::where('epro_id',$geteProductId)->update([$col => '2']);
                $getLocation = EpdSecondaryLocations::where('epro_id',$geteProductId)->get();
                foreach ($getLocation as $k => $locate) {
                    $sHistory = new EpdRejectHistory();
                    $sHistory->epro_id = $id;
                    $sHistory->location = $locate->from_location;
                    $sHistory->column_name = $colmName;
                    $sHistory->value = $colValue[$k];
                    $sHistory->remarks = $request->remarks;
                    $sHistory->save();
                }
                $message = "Rejected Successfully";
            }
        }else{
            if($type != "approved"){
                $sHistory = new EpdRejectHistory();
                $sHistory->epro_id = $id;
                $sHistory->location = null;
                $sHistory->column_name = $colmName;
                $sHistory->value = $colValue;
                $sHistory->remarks = $request->remarks;
                $sHistory->save();
                $message = "Rejected Successfully";
            }else{
                existing_product::where('id',$id)->update([$colmName => $colValue]);
                $message = "Approved Successfully";
            }
            existing_product::where('id',$request->id)->update([$col => $type]);
        }

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => $message,
        ]);
    }

    public function get_approval_details(Request $request) {
        $id = $request->id;
        $data['existing'] = existing_product::select('*')->where('id',$id)->first();
        $data['location'] = EpdPrimaryLocations::where('pro_id',$data['existing']->epro_id)->first();

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'result' => $data,
        ]);

    }

    public function update_specific_gravity(Request $request) {

        existing_product::where('id',$request->id)->update(['specific_gravity' => $request->spg]);

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Specific Gravity Updated Successfully',
        ]);
    }


    public function get_epd_rmcost(Request $request){
        $material_code = $request->mcode;
        $plant = $request->mplant;
        return $this->call_rm_cost_api($material_code, $plant);
    }

     // GET RM  PM & CONV. COST  ---------xxxxxxxxxx-----------------------------------------start-------
    public function call_rm_cost_api($material_code, $plant){
        $date = date('d.m.Y');
        $username = 'SAP_API_01';
        $password = 'Cavin@123';

        $url3 = 'http://13.126.161.240:8002/sap/bc/zckpp09'; //quality link
        // $url3 = 'http://10.100.7.73:8002/sap/bc/zckpp09'; //production link
        $jsonRequest3 = '[{"plant":"'.$plant.'","material":"'.$material_code.'","date":"'.$date.'"}]';

        $ch3 = curl_init($url3); 
        curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch3, CURLOPT_POST, true);
        curl_setopt($ch3, CURLOPT_POSTFIELDS, $jsonRequest3);
        curl_setopt($ch3, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic ' . base64_encode("$username:$password"),
            'Content-Type: application/json',
        ));
        $response3 = curl_exec($ch3);
        if (curl_errno($ch3)) {
            echo 'Curl error: ' . curl_error($ch3);
        } else {
            $httpCode3 = curl_getinfo($ch3, CURLINFO_HTTP_CODE);

            if ($httpCode3 == 200) {
                $data3 = $response3;
            } else {
                echo 'HTTP Error: ' . $httpCode3;
                echo 'API Response: ' . $response3;
            }
        }

        $dataa3 = json_decode($data3, true);

        $add_conv_cost = '0';

        $rm_data = [];
        $pm_data = [];

        if(isset($dataa3['Data'])){
            foreach ($dataa3['Data'] as $itm) {
                if (array_key_exists('IN_MAT', $itm)) {
                    if( isset( $itm['COST'] ) ){
                        $cost = $itm['COST'];
                    }else{
                        $cost = '0';
                    }
                    if($material_code == $itm['IN_MAT']){
                        $add_conv_cost = (float)$add_conv_cost + (float)$cost;
                    }else{
                        if ($itm['IN_MAT'][11] == '6') {
                            $rm_data[] = $itm;
                        } elseif ($itm['IN_MAT'][11] == '5') {
                            $pm_data[] = $itm;
                        }

                    }
                }
            }
        }

       
        $conv_cost = $add_conv_cost;

        return array(
            'rmdta' => $rm_data,
            'pmdta' => $pm_data,
            'conv_cost' => $conv_cost
        );
    }

    

}
