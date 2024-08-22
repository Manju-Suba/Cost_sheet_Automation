<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Basic;
use App\Models\Rm_cost;
use App\Models\Division;
use App\Models\Product_Material;
use App\Models\existing_product;
use App\Models\EpdRejectHistory;

use DataTables;
use Auth;

class ResearchController extends Controller
{
    public function show_basics()
    {

        $data = Basic::where('status',0)->orderby('id','desc')->get()->unique('pro_id');
        $table = array();
        $i = 1;
        foreach ($data as $row) {
        $table1 = array();
        $table1['Product_Name'] = $row->Product_name;
        $table1['Fill_Volume'] =  $row->Volume.''.$row->uom;
        $table1['Cofiguration'] = $row->case_configuration;
        $table1['Quantity'] = $row->quantity;
        if($row->division !=null){
        $divisioname = Division::find($row->division);
        $division =$divisioname->division;
        }else{
            $division ="--";
        }
         $table1['division'] = $division;
        $table1['Action'] = '<button type="button" class="btn btn-success btn-sm" id="rmadd" data-bs-toggle="modal" data-bs-target="#rmratemodel" onclick="edit('.$row->id.')">RM Rate</button>
            ';
        $table[] = $table1;
        $i++;
        }
        $response = array(
        "data" => $table
        );

        echo json_encode($response);
    }

    public function show_rmview()
    {

        $data = Basic::join('rm_costs','basics.pro_id','=','rm_costs.product_id')
                    ->whereNull('rm_costs.scrap')->orWhereNull('rm_costs.rate')
                    ->select('rm_costs.product_id as basic_id','rm_costs.id','rm_costs.scrap','basics.Product_name')->get()->toArray();
                    $id = [];
        foreach ($data as $key => $value) {
            $id[] = $data[$key]['basic_id'];
        }
        $val = Basic::whereIn('pro_id',$id)->whereIn('status', ['2','3'])->select('*')->get();

        $table = array();
        $i = 1;
        foreach ($val as $row) {
        $table1 = array();
        $table1['Product_Name'] = $row->Product_name;
        $table1['version'] = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
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
        if ($row->status == 2) {
            $table1['status'] = '<span class="badge bg-warning text-dark">purchase team in progress</span>';
        }else {
            $table1['status'] = '<span class="badge bg-secondary text-dark">Operation team in progress</span>';
        }
        $table1['Action'] = '<button type="button" class="btn btn-success btn-sm"  id="rmview" data-bs-toggle="modal" data-bs-target="#rmviewmodel" onclick="editshow(' . $row->id . ')">RM View</button>
            ';

        $table[] = $table1;
        $i++;
        }
        $response = array(
        "data" => $table
        );
        echo json_encode($response);
    }

    public function fetch_basic_rd(Request $request)
    {

        $data = Basic::join('rm_costs','basics.pro_id','=','rm_costs.product_id')
            ->select('rm_costs.product_id as basic_id','rm_costs.id','rm_costs.scrap','basics.Product_name','basics.total_rm_cost','basics.p_total_rm_cost_approval')->whereNull('rm_costs.scrap')->get()->toArray();
        // if(isset($request->rej)){
        //     $data = Basic::join('rm_costs','basics.pro_id','=','rm_costs.product_id')->where('basics.p_total_rm_cost_approval',2)
        //     ->select('rm_costs.product_id as basic_id','rm_costs.id','rm_costs.scrap','basics.Product_name','basics.Product_name','basics.p_total_rm_cost_approval')->get()->toArray();
        // }elseif(isset($request->app)){
        //     $data = Basic::join('rm_costs','basics.pro_id','=','rm_costs.product_id')->where('basics.p_total_rm_cost_approval',1)
        //     ->select('rm_costs.product_id as basic_id','rm_costs.id','rm_costs.scrap','basics.Product_name','basics.Product_name','basics.p_total_rm_cost_approval')->get()->toArray();
        // }else{
        //     $data = Basic::join('rm_costs','basics.pro_id','=','rm_costs.product_id')->where('basics.p_total_rm_cost_approval',0)
        //     ->select('rm_costs.product_id as basic_id','rm_costs.id','rm_costs.scrap','basics.Product_name','basics.Product_name','basics.p_total_rm_cost_approval')->get()->toArray();
        // }
        $id = [];
        foreach ($data as $key => $value) {
            $id[] = $data[$key]['basic_id'];
        }

        $val = Basic::whereNotIn('pro_id',$id)
        ->orderby('id','desc')
        ->where('status',3)
        ->select('*')->get()->unique('pro_id');

        return Datatables::of($val)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                if($row->specific_gravity !="" && $row->specific_gravity != null){
                    $btn  = '<a class="edit btn btn-success btn-sm" onclick="openadd_modal('. $row->id .')">Update</a>';
                }else{
                    $btn  = '<a class="edit btn btn-primary btn-sm" onclick="openadd_modal('. $row->id .')">Add</a>';
                }
                return $btn;
            })
            ->addColumn('volume', function($row){
                $volume  = $row->Volume.''.$row->uom;
                return $volume;
            })
            ->addColumn('rejected', function($row){
                // if($row->p_total_rm_cost_approval ==2 ){
                    // $rej  = '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff00b0!important;" >RM cost rejected</span>';
                // }else{
                    $rej='--';
                // }

                return $rej;
            })
            ->addColumn('version', function($row){
                $version  = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
                return $version;
            })
            ->rawColumns(['action','volume','version','rejected'])
            ->make(true);
    }

    public function fetch_rmcalc(Request $request)
    {
        $bid = $request->id;
        $basic = Basic::where('id', $bid)->first();

        $data = Rm_cost::where('Product_id',$basic->pro_id)->select('*');
        $role= Auth::user()->role;

        if($role == 'Finance'){
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('ingredientComposition', function($row){
                $btn  = $row->Icomposition;
                return $btn;
            })
            ->rawColumns(['ingredientComposition'])
            ->make(true);

        }else{

            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('sap', function($row){
                $btn  = '';
                return $btn;
            })
            ->addColumn('action', function($row){

                $check_histroy = EpdRejectHistory::where('epro_id',$row->id)->whereIn('column_name', $array)->get();

                if( $check_histroy->isEmpty()) {
                    $btn = '';
                }else{
                    $btn = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >Rejection value updated by you!</span><br>';
                }

                if($row->Icomposition !="" && $row->Icomposition !=null){
                    // $btn  = '<a id="add_id" class="edit btn btn-success btn-sm" disabled data-id="'.$row->id.'"  >Updated</a>';
                    $btn .='<button type="button" disabled class="edit btn btn-success btn-sm" data-id="' . $row->id . '" id="add_id">Updated</button>';

                    return $btn;
                }
                else{
                    $btn .= '<a id="add_id" class="edit btn btn-primary btn-sm add_change" data-id="'.$row->id.'" >Add</a>';
                    return $btn;
                }
            })
            ->addColumn('ingredientComposition', function($row){
                if($row->Icomposition){
                    $btn  = '<input type"text" class="form-control input-xs" style="width:50%" value="'.$row->Icomposition.'">';
                    return $btn;
                }
                else{
                    $btn  = '<input type"text" class="form-control input-xs" style="width:50%" >';
                    return $btn;
                }
            })
            ->rawColumns(['action','ingredientComposition','sap'])
            ->make(true);
        }
    }

    public function get_gravity(Request $request)
    {
        $basic = Basic::where('id', $request->id)->first();
        return response()->json([
            'res' => $basic
        ]);

    }

    public function fetch_completed_rm(Request $request)
    {
        if(isset($request->purchase)){
            $data = Basic::join('rm_costs','basics.pro_id','=','rm_costs.product_id')
                        ->whereNull('rm_costs.rate')
                        ->where('basics.id','desc')
                        ->select('rm_costs.product_id as basic_id','rm_costs.id','rm_costs.scrap','rm_costs.scrap','basics.Product_name')->get()->toArray();
            $id = [];
            foreach ($data as $key => $value) {
                $id[] = $data[$key]['basic_id'];
            }

            $val = Basic::whereNotIn('id',$id)->where('status',3)->orderby('id','desc')->select('*')->get()->unique('pro_id');
        }else{
            $data = Basic::join('rm_costs','basics.pro_id','=','rm_costs.product_id')
                    ->whereNull('rm_costs.scrap')
                    ->orderBy('basics.id','desc')
                    ->select('rm_costs.product_id as basic_id','rm_costs.id','rm_costs.scrap','rm_costs.scrap','basics.Product_name')->get()->toArray();
        $id = [];
        foreach ($data as $key => $value) {
            $id[] = $data[$key]['basic_id'];
        }
        $val = Basic::whereNotIn('pro_id',$id)->where('status',3)->orderby('id','desc')->select('*')->get()->unique('pro_id');
        }

        return Datatables::of($val)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn  = '<a id="add_id" class="edit btn btn-primary btn-sm" onclick="open_modal('. $row->id .')">RM View</a>';
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
            ->addColumn('division', function($row){
                if($row->division !=null){
                $divisioname = Division::find($row->division);
                $division =$divisioname->division;
                }else{
                    $division ="--";
                }
                return $division;
             })
            ->rawColumns(['action','volume','version','division'])
            ->make(true);
    }

    public function fetch_completed_rm_rejected(Request $request){

        $user = auth()->user()->id;
        $data = Basic::join('rm_costs','basics.pro_id','=','rm_costs.product_id')
                    ->where('rm_costs.p_scrap_approval',2)
                    ->where('basics.id','desc')
                    ->select('rm_costs.product_id as basic_id','rm_costs.id','rm_costs.scrap','rm_costs.scrap','basics.Product_name')->get()->toArray();
        $id = [];
        foreach ($data as $key => $value) {
            $id[] = $data[$key]['basic_id'];
        }
        if(isset($request->app)){
            $val = Basic::join('rm_costs','basics.pro_id','=','rm_costs.product_id')->where('rm_costs.p_scrap_approval',1)->where('basics.status',3)->orderby('basics.id','desc')->where('rm_costs.scrap_user',$user)->select('basics.*')->get()->unique('pro_id');

        }else{
        $val = Basic::join('rm_costs','basics.pro_id','=','rm_costs.product_id')->where('rm_costs.p_scrap_approval',2)->where('rm_costs.scrap_user',$user)->where('basics.status',3)->orderby('basics.id','desc')->select('basics.*','rm_costs.p_scrap_approval')->get()->unique('pro_id');

        }
        return Datatables::of($val)
            ->addIndexColumn()
            ->addColumn('action', function($row)use ($request){
                if($request->app){
                    $btn  = '<button type="button" class="btn btn-success btn-sm" id="rm_reject" data-bs-toggle="modal" data-bs-target="#rejectedmodal" onclick="rejected_modal('. $row->id .',1)">View RM Rate</button>';
                }else{
                    $btn  = '<button type="button" class="btn btn-primary btn-sm" id="rm_reject" data-bs-toggle="modal" data-bs-target="#rejectedmodal" onclick="rejected_modal('. $row->id .',2)"> Update RM Rate</button>';

                }
                return $btn;
            })
            ->addColumn('volume', function($row){
                $volume  = $row->Volume.''.$row->uom;
                return $volume;
            })
            ->addColumn('Rejected', function($row){
                $rej='';
                if($row->p_scrap_approval == 2){
                    $rej= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff00b0!important;" >Scrap</span>';
                }
                return $rej;
            })
            ->addColumn('version', function($row){
                $version  = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$row->version.'</span>';
                return $version;
            })
            ->addColumn('remarks', function($row){

                return '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Edit" class="px-2 text-primary" "> <i class="fa fa-eye"  onclick="open_remarks('.$row->id.')"></i></a>';
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
            ->rawColumns(['action','volume','version','Rejected','remarks','division'])
            ->make(true);
    }
 public function update_rm_cost(Request $request){
    $Pro_id  = $request->input('edit_pro_id');
    $basic = Basic::where('pro_id',$Pro_id)
    ->orderby('id','desc')->first();

    
    $Ingredient = $request->input('edit_ingredient');
    $Cost = $request->input('edit_qty');
    $Rate = $request->input('edit_rate');
    $rm_id = $request->input('edit_rm_id');
    $inscrap = $request->input('edit_inscrap');
    $mcost = $request->input('edit_mcost');
    foreach ($Ingredient as $val => $ing) {
        $data=Rm_cost::find($rm_id[$val]);
        $data->b_id=$basic->id;
        $data->Ingredient=$request->input('edit_ingredient')[$val];
        $data->rate= $request->input('edit_rate')[$val];
        $data->scrap= $request->input('edit_scrap')[$val];
        $data->inscrap= $request->input('edit_inscrap')[$val];
        $data->mcost= $request->input('edit_mcost')[$val];
        $data->qty= !empty($request->input('edit_qty')) ? $request->input('edit_qty')[$val] : null;
        $data->p_scrap_approval= 0;
        $data->save();
            // 'version' => $cnew_version,

        }
         $rmcost= Rm_cost::where('b_id',$basic->id)->whereNull('scrap')->orwhereNull('rate')->where('b_id',$basic->id)->get();
        if($rmcost->count()==0){
            $ratessum=array_sum($mcost);
            $scrapcos=array_sum($inscrap);

            $basictable = Basic::find($basic->id);
            $totalrm_cost =   round($basictable->specific_gravity * $ratessum / $scrapcos ,2);
            $basictable->total_rm_cost = $totalrm_cost ;

            $basictable->save();
        }
 }

    public function add_composition(Request $request)
    {
        $id = $request->id;
        $data = Rm_cost::where('id',$request->id)->update(['Icomposition'=>$request->data]);

        if($data){
            $status ="success";
        }else{
            $status ="not saved";
        }
        return response()->json([
            'status' => $status
        ]);
    }

    public function save_total_rmcost(Request $request)
    {
        $id = $request->id;
        Basic::find($request->id)->update([
            'specific_gravity' =>$request->specific,
            'total_rm_cost' =>$request->rm_cost,
        ]);
        return response()->json([
            'status'=>'success'
        ]);
    }

    public function get_Ingredients(Request $request)
    {
        $id = $request->input('id');
        $basic = Basic::where('id', $id)->first();
        $data = Rm_cost::where('Product_id', $basic->pro_id)->get();

        $table = array();
        $i = 1;
        foreach ($data as $row) {
            $table1 = array();
            //  print_r( $row)
            if($row->Ingredient!=null)
            $table1['Ingredients'] = $row->Ingredient;
            else
            $table1['Ingredients'] = "--";
            if($row->rate!=null)
            $table1['rate'] = $row->rate;
            else
            $table1['rate'] ="--";
            $table1['qty'] = $row->qty;
            if($row->inscrap!=null)
            $table1['inscrap'] = $row->inscrap;
            else
            $table1['inscrap'] = "--";
            if($row->scrap!=null)
            $table1['scrap'] = $row->scrap;
            else
            $table1['scrap'] = "--";
            if($row->mcost!=null)
            $table1['mcost'] = $row->mcost;
            else
            $table1['mcost'] = "--";
            $table[] = $table1;
            $i++;
        }
        $response = array(
        "data" => $table
        );
        echo json_encode($response);
    }

    public function get_added_scrap(Request $request)
    {
        $user=auth()->user()->id;
        $id = $request->input('id');
        $Basic = Basic::where('id', $id)->first();
        if(isset($request->comp)){
            $data = Rm_cost::where('Product_id', $Basic->pro_id)->get();
        }else{
           $data = Rm_cost::where('Product_id', $Basic->pro_id)->where('scrap_user',$user)->get();
        }

        $table = array();
        $i = 1;
        foreach ($data as $row) {
            $table1 = array();
            //  print_r( $row)
            $table1['Ingredients'] = $row->Ingredient;
            $table1['p_scrap_approval'] = $row->p_scrap_approval;
            $table1['rate'] = $row->rate;
            $table1['qty'] = $row->qty;
            if($row->scrap!=null)
            $table1['Scrap'] = $row->scrap;
            else
            $table1['Scrap'] ="--";
            if($row->inscrap!=null)
            $table1['inscrap'] = $row->inscrap;
            else
            $table1['inscrap'] = "--";
            if($row->mcost!=null)
            $table1['mcost'] = $row->mcost;
            else
            $table1['mcost'] = "--";
            $table1['pro_id'] = $row->Product_id;
            $table1['id'] = $row->id;
            $table[] = $table1;
            $i++;
        }
        $response = array(
        "data" => $table
        );
        echo json_encode($response);
    }

    public function get_ex_sgravity_pending_record(Request $request)
    {
        $data = existing_product::select('*')
        ->where('status','!=','1')
        ->where('gravity_approval', 'pending')
        ->orderby('id','desc')
        ->groupBy('epro_id')
        ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('division', function($row){
                if($row->division !=null){
                $divisioname = Division::find($row->division);
                $division =$divisioname->division;
                }else{
                    $division ="--";
                }
                return $division;
             })
            ->addColumn('action', function($row){
                $btn = '';
                $array = ['specific_gravity']; 
                $check_histroy = EpdRejectHistory::where('epro_id',$row->id)->whereIn('column_name', $array)->get();

                if( $check_histroy->isEmpty()) {
                    if($row->specific_gravity == 0){
                        $btn .= '<a id="add_id" class="btn btn-primary btn-sm" onclick="openmodel('."'".$row->epro_id."'".')" >Add Gravity</a>&nbsp;';
                    }else{
                        $btn .= '<a id="add_id" class="btn btn-success btn-sm" onclick="openmodel('."'".$row->epro_id."'".')" >View Gravity</a>&nbsp;';
                    }
                }else{
                    $btn = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >Rejection value updated by you!</span><br><a id="add_id" class="btn btn-success btn-sm" onclick="openmodel('."'".$row->epro_id."'".')" >View Gravity</a>';
                }
                return $btn;
            })
            ->rawColumns(['division','action'])
            ->make(true);
    }

    public function get_exist_gravity_approved(Request $request)
    {
        if($request->app == "app"){
            $data = existing_product::where('status','!=','1')
            ->where('gravity_approval', 'approved')
            ->where('excsheet_approval','!=', 'rejected')
            ->where('mt_exsheet_approval','!=', 'rejected')
            ->orderBy('id', 'desc')
            ->groupBy('epro_id')
            ->get();
        }else{
            $data = existing_product::where('status','!=','1')
            ->where(function ($query) {
                $query->orWhere('gravity_approval', 'rejected')
                ->orWhere('mt_exsheet_approval', 'rejected')
                ->orWhere('excsheet_approval', 'rejected');
            })
            ->orderBy('id', 'desc')
            ->groupBy('epro_id')
            ->get();
        }
       
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('division', function($row){
                if($row->division !=null){
                $divisioname = Division::find($row->division);
                $division =$divisioname->division;
                }else{
                    $division ="--";
                }
                return $division;
             })
            ->addColumn('action', function($row){
                if($row->gravity_approval == "rejected"){
                    $btn  = '<a id="add_id" class="edit btn btn-success btn-sm" onclick="openmodel('."'".$row->epro_id."'".')" >Update</a>';
                }else{
                    $btn  = '<a id="add_id" class="edit btn btn-success btn-sm" disabled onclick="openmodel('."'".$row->epro_id."'".')" >View</a>';
                }
                return $btn;
            })
            ->addColumn('status', function($row){
                $status = '';

                if($row->gravity_approval == 'rejected'){
                    $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff0053!important;" >Specific Gravity</span><br>';
                }
                if($row->excsheet_approval == 'rejected'){
                    $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff0053!important;" >Rejected by Finance</span><br>';
                }
                if($row->mt_exsheet_approval == 'rejected'){
                    $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff0053!important;" >Rejected by Marketing Team</span><br>';
                }
                return $status;
            })
            ->rawColumns(['division','action','status'])
            ->make(true);
    }

    public function fetch_gravity(Request $request)
    {
        $id = $request->id;
        $data = existing_product::where('epro_id',$id)->where('specific_gravity','!=','')->orderby('id','desc')->first();
        return response()->json([
            'status' => 'success',
            'result' => $data
        ]);
    }

    public function save_gravity(Request $request)
    {
        $id = $request->hid_id;

        $data['specific_gravity'] = $request->spec_gravity;
        $data['gravity_user'] = auth()->user()->id;
        $data['gravity_date'] = date('Y-m-d H:i:s');
        $data['gravity_approval']= 'pending';
        existing_product::where('epro_id',$id)->update($data);
        return response()->json([
            'status' => 'success'
        ]);
    }


}
