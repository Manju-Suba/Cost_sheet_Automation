<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\User;
use App\Models\Basic;
use App\Models\Rm_cost;
use App\Models\Division;
use App\Models\Product_Material;
use App\Models\existing_product;
use App\Models\LocationMaster;
use DB;
use App\Models\Secondary_location;
use App\Models\Primary_location;
use App\Models\EpdPrimaryLocations;
use App\Models\EpdSecondaryLocations;
use App\Models\EpdRejectHistory;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LocationImport;
use Validator;

class LogisticController extends Controller
{
    public function fetch_basic_logic(Request $request)
    {
        // $data = Basic::select('*')
        // ->orderby('id','desc')->get()->unique('pro_id');
        $data = Basic::join('primary_locations','basics.pro_id','=','primary_locations.pro_id')->where('primary_locations.p_cost_approval',0)->select('*')
        ->orderby('basics.id','desc')->groupBy('basics.pro_id')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $get_pri_freight = Primary_location::where('pro_id',$row->pro_id)->select('*')->get();
                $get_pris= Primary_location::where('pro_id',$row->pro_id)->select('*')->pluck('cost')->toArray();
                if(in_array(null,$get_pris) ){
                    $btn  = '<a id="add_id" class="btn btn-primary btn-sm" onclick="openmodel('."'".$row->pro_id."'".')" > Add Freight</a>';
                }else{
                    $btn  = '<a id="add_id" class="btn btn-success btn-sm" onclick="openmodel('."'".$row->pro_id."'".')" >View Freight</a>';
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
            ->rawColumns(['action','status','version','division'])
            ->make(true);
    }
    public function fetch_basic_logic_approval(Request $request){
        $authuser=auth()->user()->id;
        if(isset($request->app)){
            $data = Basic::join('primary_locations','basics.pro_id','=','primary_locations.pro_id')->where('primary_locations.p_cost_approval',1)->select('*')
            ->orderby('basics.id','desc')->get()->unique('pro_id');
        }
        else{
            $data = Basic::join('primary_locations','basics.pro_id','=','primary_locations.pro_id')->where('primary_locations.p_cost_approval',2)->select('*')->where('primary_locations.freight_user',$authuser)
            ->orderby('basics.id','desc')->get()->unique('pro_id');
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $get_pri_freight = Primary_location::where('pro_id',$row->pro_id)->select('*')->first();


                if($get_pri_freight->p_cost_approval == 1){
                    $btn  = '<a id="add_id" class="btn btn-success btn-sm" onclick="openmodel('."'".$row->pro_id."'".',1)" >View Freight</a>';
                }
                else{
                    $btn  = '<a id="add_id" class="btn btn-primary btn-sm" onclick="openmodel('."'".$row->pro_id."'".',3)" >Update Freight</a>';
                }
                return $btn;
            })
            ->addColumn('Rejected', function($row){
                return "Freight Rejected";
            })
            ->addColumn('remarks', function($row){

                $basics=Basic::where('pro_id',$row->pro_id)->first();
                return '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Edit" class="px-2 text-primary" "> <i class="fa fa-eye"  onclick="open_remarks('.$basics->id.')"></i></a>';
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

            ->rawColumns(['action','status','version','remarks','dividion'])
            ->make(true);

    }
    public function fetch_basic_sublogic(Request $request)
    {
        if(isset($request->app)){
        $data = Basic::join('secondary_locations','basics.pro_id','=','secondary_locations.pro_id')->where('secondary_locations.s_cost_approval',1)->select('*')
        ->orderby('basics.id','desc')->get()->unique('pro_id');
        }else if(isset($request->rej)){
        $data = Basic::join('secondary_locations','basics.pro_id','=','secondary_locations.pro_id')->where('secondary_locations.s_cost_approval',2)->select('*')
        ->orderby('basics.id','desc')->get()->unique('pro_id');
        }else{
        $data = Basic::join('secondary_locations','basics.pro_id','=','secondary_locations.pro_id')->where('secondary_locations.s_cost_approval',0)->select('*')
        ->orderby('basics.id','desc')->get()->unique('pro_id');
        }


        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) use ($request)  {
                $get_sec_freight = Secondary_location::where('pro_id',$row->pro_id)->select('*')->first();
                $get_sec_freight1 = Secondary_location::where('pro_id',$row->pro_id)->select('*')->get();
                // if(!empty($get_sec_freight->cost) ){
                //     $btn  = '<a class="btn btn-success btn-sm" onclick="openmodel('."'".$row->pro_id."'".')" >Update Freight</a>';
                // }else{
                //     $btn  = '<a class="btn btn-primary btn-sm" onclick="openmodel('."'".$row->pro_id."'".')" >Add Freight</a>';
                // }
                if(isset($request->app)){
                    $btn  = '<a class="btn btn-success btn-sm" onclick="openmodel('."'".$row->pro_id."'".',1)" >View Freight</a>';
                }else if(isset($request->rej)){
                    $btn  = '<a class="btn btn-success btn-sm" onclick="openmodel('."'".$row->pro_id."'".',2)" >Update Freight</a>';
                }else{
                    foreach($get_sec_freight1 as $freights){
                        if($freights->cost!=null){
                            $btn  = '<a class="btn btn-success btn-sm" onclick="openmodel('."'".$row->pro_id."'".',1)" >View Freight</a>';
                        }
                        else{
                        $btn  = '<a class="btn btn-primary btn-sm" onclick="openmodel('."'".$row->pro_id."'".',2)" >Add Freight</a>';
                        break;
                        }
                    }
                }
                return $btn;
            })
            ->addColumn('version', function($row){
                $version  = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
                return $version;
            })
            ->addColumn('rejected', function($row){
                $version  = 'Freight Rejected';
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
            ->addColumn('remarks', function($row){

                $basics=Basic::where('pro_id',$row->pro_id)->first();
                return '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Edit" class="px-2 text-primary" "> <i class="fa fa-eye"  onclick="open_remarks('.$basics->id.')"></i></a>';
              })
            ->rawColumns(['action','version','remarks','division'])
            ->make(true);
    }

    public function save_primary_frieght(Request $request){
        // $validated_form= Validator::make($request->all(),[
        //     'primary_freight.*' => 'required|numeric',
        //     'primary_id.*' => 'required|numeric',
        // ]);
        $freight_user=auth()->user()->id;
        $freight_date=date('Y-m-d H:i:s');
        foreach ($request->pri_freight as $key => $value) {
            $location = Primary_location::where('id','=',$request->pri_freight_id[$key])->update(['cost'=>$value,'p_cost_approval'=>0,'freight_user'=>$freight_user,'freight_date'=>$freight_date]);
        }
        return response()->json([
            'status' =>'success'
        ]);
    }


    public function save_secondary_freight(Request $request)
    {
        $freight_user=auth()->user()->id;
        $freight_date=date('Y-m-d H:i:s');
        foreach ($request->sec_freight as $key => $value) {
            $location = Secondary_location::where('id','=',$request->sec_freight_id[$key])->update(['cost'=>$value,'freight_user'=>$freight_user,'freight_date'=>$freight_date,'s_cost_approval'=>0]);
        }
        return response()->json([
            'status' =>'success'
        ]);
    }

    public function exist_logic(Request $request)
    {
        $data = existing_product::join('epd_primary_locations','existing_products.epro_id','=','epd_primary_locations.pro_id')
        ->where(function ($query) {
            $query->where(function ($subquery) {
                $subquery->whereNotIn('epd_primary_locations.p_cost_approval', [1, 2])
                         ->orWhereNull('epd_primary_locations.p_cost_approval');
            });
        })
        ->select('existing_products.*','epd_primary_locations.freight')
        ->orderby('existing_products.id','desc')
        ->groupBy('existing_products.epro_id')
        ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                // $array = ['primary_freight', 'secondary_freight'];
                $check_histroy = EpdRejectHistory::where('epro_id',$row->id)->where('column_name', 'freight')->orderBy('id','desc')->first();

                if (is_null($check_histroy)) {
                    $btn = '';
                }else{
                    $btn = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >Rejection value updated by you!</span><br>';
                }

                if($row->freight !="" && $row->freight != null ){
                    $btn .= '<a id="add_id" class="btn btn-success btn-sm" onclick="openmodel('."'".$row->epro_id."'".')" >View Freight</a>&nbsp;';
                }else{
                    $btn .= '<a id="add_id" class="btn btn-primary btn-sm" onclick="openmodel('."'".$row->epro_id."'".')" >Add Freight</a>&nbsp;';
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


    public function exist_logic_approved(Request $request)
    {
        $authuser = auth()->user()->id;
        if(isset($request->app)){
            $data = existing_product::join('epd_primary_locations','existing_products.epro_id','=','epd_primary_locations.pro_id')
            ->where('epd_primary_locations.p_cost_approval',1)->select('*')
            ->where('epd_primary_locations.freightuser',$authuser)
            ->orderby('existing_products.id','desc')
            ->get()->unique('epro_id');
        }
        else{
            $data = existing_product::join('epd_primary_locations','existing_products.epro_id','=','epd_primary_locations.pro_id')
            ->where('epd_primary_locations.p_cost_approval',2)->select('*')
            ->where('epd_primary_locations.freightuser',$authuser)
            ->orderby('existing_products.id','desc')->get()->unique('epro_id');
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                if($row->p_cost_approval == 1){
                    $btn  = '<a id="add_id" class="btn btn-success btn-sm" onclick="openmodel('."'".$row->epro_id."'".')" >View Freight</a>';
                }
                else{
                    $btn  = '<a id="add_id" class="btn btn-primary btn-sm" onclick="openmodel('."'".$row->epro_id."'".')" >Update Freight</a>';
                }
                return $btn;
            })
            ->addColumn('status', function($row){
                $status = "";
                if($row->p_cost_approval == '2'){
                    $pfreight_his = EpdRejectHistory::where('epro_id',$row->id)->where('column_name', 'primary_freight')->orderBy('id','desc')->first();
                    if(!empty($pfreight_his)){
                        $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff00b0!important;" ><b>Primary Freight Remark : </b>'.$pfreight_his->remarks.'</span><br>';
                    }else{
                        $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff00b0!important;" >Freight Rejected</span>';
                    }
                }
                if($row->excsheet_approval == 'rejected'){
                    $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff00b0!important;" >Rejected by Finance</span><br>';
                }
                if($row->mt_exsheet_approval == 'rejected'){
                    $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff00b0!important;" >Rejected by Marketing Team</span><br>';
                }

                // $status = '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff00b0!important;" >Freight Rejected</span>';
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

    public function exist_seclogic(Request $request)
    {
        if(isset($request->app)){
            $data = existing_product::join('epd_secondary_locations','existing_products.epro_id','=','epd_secondary_locations.epro_id')
            ->where('epd_secondary_locations.s_cost_approval',1)->select('*')
            ->orderby('existing_products.id','desc')
            ->get()->unique('epro_id');
        }else if(isset($request->rej)){
            $data = existing_product::join('epd_secondary_locations','existing_products.epro_id','=','epd_secondary_locations.epro_id')
            ->where('epd_secondary_locations.s_cost_approval',2)->select('*')
            ->orderby('existing_products.id','desc')
            ->get()->unique('epro_id');
        }else{
            $data = existing_product::join('epd_secondary_locations','existing_products.epro_id','=','epd_secondary_locations.epro_id')
            ->where(function ($query) {
                $query->where(function ($subquery) {
                    $subquery->whereNotIn('epd_secondary_locations.s_cost_approval', [1, 2])
                             ->orWhereNull('epd_secondary_locations.s_cost_approval');
                });
            })
            ->select('existing_products.*','epd_secondary_locations.freight','epd_secondary_locations.s_cost_approval')
            ->orderby('existing_products.id','desc')
            ->groupBy('existing_products.epro_id')
            ->get();
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                if($row->s_cost_approval == 1){
                    $btn  = '<a class="btn btn-success btn-sm" onclick="openmodel('."'".$row->epro_id."'".')" >View Freight</a>';

                }else if($row->s_cost_approval == 2 ){
                    $btn  = '<a class="btn btn-success btn-sm" onclick="openmodel('."'".$row->epro_id."'".')" >Update Freight</a>';

                }else{
                    if($row->freight != "" && $row->freight != null){
                        $btn  = '<a class="btn btn-success btn-sm" onclick="openmodel('."'".$row->epro_id."'".')" >View Freight</a>';
                    }else{
                        $btn  = '<a class="btn btn-primary btn-sm" onclick="openmodel('."'".$row->epro_id."'".')" >Add Sec.Freight</a>';
                    }
                }
                return $btn;
            })
            ->addColumn('status', function($row){
                $status = "";
                if($row->s_cost_approval == '2'){
                    $sfreight_his = EpdRejectHistory::where('epro_id',$row->id)->where('column_name', 'secondary_freight')->orderBy('id','desc')->first();
                    if(!empty($sfreight_his)){
                        $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff00b0!important;" ><b>Primary Freight Remark : </b>'.$pfreight_his->remarks.'</span><br>';
                    }else{
                        $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff00b0!important;" >Freight Rejected</span>';
                    }
                }
                if($row->excsheet_approval == 'rejected'){
                    $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff00b0!important;" >Rejected by Finance</span><br>';
                }
                if($row->mt_exsheet_approval == 'rejected'){
                    $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff00b0!important;" >Rejected by Marketing Team</span><br>';
                }

                // $version  = 'Freight Rejected';
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

    // public function exist_logic_rejected(Request $request)
    // {
    //     $data = existing_product::where('status','!=','1')
    //     // ->where('mt_exsheet_approval','pending')
    //     ->where(function ($query) {
    //         $query->orWhere('pfreight_approval', 'rejected')
    //             ->orWhere('sfreight_approval', 'rejected')
    //             ->orWhere('mt_exsheet_approval', 'rejected')
    //             ->orWhere('excsheet_approval', 'rejected');
    //     })
    //     ->orderby('id','desc')
    //     ->get();

    //     return Datatables::of($data)
    //         ->addIndexColumn()
    //         ->addColumn('action', function($row){
    //             $btn = '<a class="btn btn-info btn-sm" onclick="openmodel('.$row->id.')" >Primary Freight</a>&nbsp;';
    //             $btn .='<a class="btn btn-primary btn-sm" onclick="sec_openmodel('.$row->id.')" >Secondary Freight</a>';

    //             return $btn;
    //         })
    //         ->addColumn('status', function($row){
    //             $status = '';

    //             if($row->pfreight_approval == 'rejected'){
    //                 $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff0053!important;" >Primary Freight</span><br>';
    //             }
    //             if($row->sfreight_approval == 'rejected'){
    //                 $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff0053!important;" >Secondary Freight</span><br>';
    //             }
    //             if($row->excsheet_approval == 'rejected'){
    //                 $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff0053!important;" >Rejected by Finance</span><br>';
    //             }
    //             if($row->mt_exsheet_approval == 'rejected'){
    //                 $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff0053!important;" >Rejected by Marketing Team</span><br>';
    //             }
    //             return $status;
    //         })
    //         ->addColumn('version', function($row){
    //             $version  = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
    //             return $version;
    //         })
    //         ->rawColumns(['action','status','version'])
    //         ->make(true);
    // }


    public function epd_save_primary_frieght(Request $request)
    {
        $freightuser = auth()->user()->id;
        $freightdate = date('Y-m-d H:i:s');

        foreach ($request->pri_freight as $key => $value) {
            $location = EpdPrimaryLocations::where('id','=',$request->pri_freight_id[$key])->update(['freight'=>$value,'p_cost_approval'=> 0,'freightuser'=>$freightuser,'freightdate'=>$freightdate]);
        }

        return response()->json([
            'status' =>'success'
        ]);

    }

    public function epd_save_secondary_freight(Request $request)
    {
        $freightuser = auth()->user()->id;
        foreach ($request->sec_freight as $key => $value) {
            $location = EpdSecondaryLocations::where('id','=',$request->sec_freight_id[$key])->update(['freight' => $value,'freightsuser' => $freightuser,'s_cost_approval' => 0]);
        }
        return response()->json([
            'status' =>'success'
        ]);
    }


    public function fetch_expri(Request $request)
    {
        $data = EpdPrimaryLocations::where('pro_id',$request->id)->select('*');

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('cost_box', function($row){
                $vis = ( $row->freight != '' && $row->p_cost_approval == 0 || $row->p_cost_approval == 1) ? 'disabled' : '';

                if($row->excsheet_approval == 'rejected' || $row->mt_exsheet_approval == 'rejected'){
                    $vis = 'disabled';
                }

                $cost  = '<input type="hidden" id="pri_freight_id"  name="pri_freight_id[]" value="'.$row->id.'">';
                $cost  .= '<input type="number" class="form-control input-xs" min="0" id="pri_freight" name="pri_freight[]" '.$vis.' onkeypress="return /[0-9.]/i.test(event.key)" value="'.$row->freight.'">';
                return $cost;
            })
            ->addColumn('from_location', function($row){
                $from = LocationMaster::find($row->from_location);
                return $from->location;
            })
            ->addColumn('to_location', function($row){
                $to = LocationMaster::find($row->to_location);
                return $to->location;
            })
            ->addColumn('conditions', function($row){
                if(($row->freight== "" && $row->p_cost_approval == null)){
                    $value ="add";
                }elseif($row->p_cost_approval == 2){
                    $value = "update";
                }else{
                    $value="view";
                }
                return $value;

            })
            ->rawColumns(['cost_box','conditions'])
            ->make(true);
    }

    public function fetch_exsec(Request $request)
    {
        $data = EpdSecondaryLocations::where('epro_id',$request->id)->select('*');
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('cost_box', function($row){

                $vis = ( $row->freight != '' && $row->s_cost_approval == 0 || $row->s_cost_approval == 1) ? 'disabled' : '';

                if($row->excsheet_approval == 'rejected' || $row->mt_exsheet_approval == 'rejected'){
                    $vis = 'disabled';
                }
                
                $cost  = '<input type="hidden" id="sec_freight_id" name="sec_freight_id[]" value="'.$row->id.'">';
                $cost  .= '<input type="number" class="form-control input-xs" id="sec_freight" min="0" '.$vis.' onkeypress="return /[0-9.]/i.test(event.key)" name="sec_freight[]" value="'.$row->freight.'">';
                return $cost;
            })
            ->addColumn('from_location', function($row){
                $from = LocationMaster::find($row->from_location);
                return $from->location;
            })
            ->addColumn('to_location', function($row){
                $to = LocationMaster::find($row->to_location);
                return $to->location;
            })
            ->addColumn('conditions', function($row){
                if(($row->freight == null && $row->s_cost_approval == 0)){
                    $value ="add";
                }elseif($row->s_cost_approval == 2){
                    $value ="update";
                }else{
                    $value="view";
                }
                return $value;

            })
            ->rawColumns(['cost_box','conditions'])
            ->make(true);
    }

    public function get_freight_data(Request $request)
    {
        $data = Basic::select('*')
        ->orderby('id','desc')->get();

        // $data = Basic::join('primary_locations','basics.pro_id','=','primary_locations.pro_id')
        // ->where('primary_locations.cost','!=',null)
        // ->select('basics.*')
        // ->get()->unique('basics.pro_id');

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn  = '<a class="btn btn-success btn-sm" onclick="bf_approve('.$row->id.')" ><i class="bx bx-check icon nav-icon"></i></a>';
                return $btn;
            })
            ->addColumn('pri_frit', function($row){
                $location = Primary_location::where('pro_id','=', $row->pro_id)->select('from_location','to_location','cost')->get();
                $p_loc = '';
                foreach ($location as $locations){
                    $pf_location=LocationMaster::find($locations->from_location);
                    $pt_location=LocationMaster::find($locations->to_location);
                    $p_loc .= '<span class="badge badge-secondary" style="background-color: #21c4b1ab;color:#000000c7;">'. $pf_location->location .' - '.$pt_location->location.' </span>';
                }
                return $p_loc;
            })
            ->addColumn('sec_frit', function($row){
                $location = Secondary_location::where('pro_id',$row->pro_id)->get();

                $p_loc = '';
                foreach ($location as $locations){
                    $pf_location=LocationMaster::find($locations->from_location);
                    $pt_location=LocationMaster::find($locations->to_location);
                    $p_loc .= '<span class="badge badge-secondary" style="background-color: #bb8ee0;color:#000000c7;">'. $pf_location->location .' - '.$pt_location->location.' </span>';
                }


                return $p_loc;
            })
             ->addColumn('pri_frit_cost', function($row){
                $location = Primary_location::where('pro_id','=', $row->pro_id)->select('from_location','to_location','cost')->get();
                $p_loc = '';
                foreach ($location as $locations){
                    $pf_location=LocationMaster::find($locations->from_location);
                    $pt_location=LocationMaster::find($locations->to_location);
                    if($locations->cost!=null)
                    $p_loc .= '<span class="badge badge-secondary" style="background-color: #21c4b1ab;color:#000000c7;">'. $locations->cost.' </span>';
                    else
                    $p_loc .= '<span class="badge badge-secondary" style="background-color: #21c4b1ab;color:#000000c7;">-- </span>';
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
           
             ->addColumn('sec_frit_cost', function($row){
                $location = Secondary_location::where('pro_id','=', $row->pro_id)->select('from_location','to_location','cost')->get();
                $p_loc = '';
                foreach ($location as $locations){
                    $pf_location=LocationMaster::find($locations->from_location);
                    $pt_location=LocationMaster::find($locations->to_location);
                     if($locations->cost!=null)
                    $p_loc .= '<span class="badge badge-secondary" style="background-color: #bb8ee0;color:#000000c7;">'. $locations->cost.' </span>';
                    else
                    $p_loc .= '<span class="badge badge-secondary" style="background-color: #bb8ee0;color:#000000c7;">'. $locations->cost.' </span>';
                }
                return $p_loc;
            })
            ->addColumn('volume', function($row){
                $btn  = $row->Volume.' '.$row->uom;
                return $btn;
            })
            ->addColumn('version', function($row){
                $version  = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
                return $version;
            })
            ->rawColumns(['action','division','volume','version','pri_frit','sec_frit','sec_frit_cost','pri_frit_cost'])
            ->make(true);
    }

    public function fetch_prilocation(Request $request)
    {
        $data = Primary_location::where('pro_id',$request->id)->select('*');

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('from_location', function($row){
                $from=LocationMaster::find($row->from_location);
                return $from->location;
            })
            ->addColumn('to_location', function($row){
                $to=LocationMaster::find($row->to_location);
                return $to->location;
            })
            ->addColumn('cost_box', function($row){
                $cost  = '<input type="hidden" id="pri_freight_id"  name="pri_freight_id[]" value="'.$row->id.'">';
                if(($row->cost==null && $row->p_cost_approval==0)||$row->p_cost_approval==2)
                $cost  .= '<input type="number" class="form-control input-xs" min="0" max="100" id="pri_freight" name="pri_freight[]" value="'.$row->cost.'">';
                else
                $cost  .= '<input type="number" class="form-control input-xs" min="0" max="100" id="pri_freight" name="pri_freight[]" value="'.$row->cost.'" readonly>';
                return $cost;
            })
            ->addColumn('conditions', function($row){
                if(($row->cost==null && $row->p_cost_approval==0)||$row->p_cost_approval==2){
                    $value ="add";
                }else{
                    $value="view";
                }
                return $value;

            })
            ->rawColumns(['cost_box','conditions'])
            ->make(true);
    }

    public function fetch_seclocation(Request $request)
    {
        $data = Secondary_location::where('pro_id',$request->id)->select('*');
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('cost_box', function($row){
                $cost  = '<input type="hidden" id="sec_freight_id" name="sec_freight_id[]" value="'.$row->id.'">';
                if(($row->cost==null && $row->s_cost_approval==0)||$row->s_cost_approval==2)
                $cost  .= '<input type="number" class="form-control sec_freight_val input-xs" id="sec_freight" min="0" max="100"  name="sec_freight[]" value="'.$row->cost.'">';
                else
                $cost  .= '<input type="number" class="form-control  sec_freight_val input-xs" id="sec_freight" min="0" max="100"  name="sec_freight[]" value="'.$row->cost.'" readonly>';
                return $cost;
            })
            ->addColumn('from_location', function($row){
                $from=LocationMaster::find($row->from_location);
                return $from->location;
            })
            ->addColumn('to_location', function($row){
                $to=LocationMaster::find($row->to_location);
                return $to->location;
            })
            ->rawColumns(['cost_box'])
            ->make(true);
    }


    //master upload function
    public function location_fetch(Request $request)
    {
        $data = LocationMaster::select('*')->where('type',$request->type);
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn  = '<a title="edit" class="btn btn-primary btn-sm mr-2" style="margin-right:2px" onclick="edit_form(' . $row->id . ')" ><i class="fas fa-edit"></i></a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }


    public function primary_tolocation_fetch()
    {
        $data = LocationMaster::select('location')->where('type','primary_to');
        return Datatables::of($data)
        ->addIndexColumn()
        ->rawColumns([])
        ->make(true);
    }

    public function upload_location(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'location_upload' => 'required|mimes:xls,xlsx,csv',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'response' => 'error',
                'message' => $validator->errors(),
            ]);
        }

        $import = new LocationImport($request); // Pass $request to the constructor
        Excel::import($import, $request->file('location_upload'));

        if (!empty($import->importErrors)) {
            return response()->json([
                'response' => false,
                'message' => 'Validation error',
                'errors' => $import->importErrors,
            ]);
        } else {
            return response()->json([
                'response' => 'success',
                'message' => 'Data imported successfully',
            ]);
        }
    }

    public function get_location(Request $request,$id)
    {
        $data = LocationMaster::find($id);
        return response()->json([
            "data" => $data
        ]);
    }

    public function update_location(Request $request)
    {
       $id = $request->location_id;
       LocationMaster::find($id)->update(['location' => $request->edit_location]);
        return response()->json([
            "response" => "success"
        ]);
    }

}
