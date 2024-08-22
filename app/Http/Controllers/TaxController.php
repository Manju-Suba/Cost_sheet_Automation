<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DataTables;
use App\Models\User;
use App\Models\Basic;
use App\Models\Division;
use App\Models\Rm_cost;
use App\Models\Product_Material;
use App\Models\existing_product;
use App\Models\EpdRejectHistory;

use DB;

class TaxController extends Controller
{
    public function fetch_basic_tax(Request $request)
    {
         $authuser=auth()->user()->id;
        if(isset($request->rej)){
            $data = Basic::select('*')->where('b_salesTax_approval',2)->where('tax_user',$authuser)
            ->orderby('id','desc')->get();
        }else if(isset($request->app)){
            $data = Basic::select('*')->where('b_salesTax_approval',1)
            ->orderby('id','desc')->get();
        }else{
            $data = Basic::select('*')->where('b_salesTax_approval',0)
            ->orderby('id','desc')->get();
        }


        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function($row){
                if($row->tax_approval == 'Pending'){
                    $status = '<span class="badge bg-warning text-dark">Pending</span>';
                }elseif($row->tax_approval == 'Rejected'){
                    $status = '<span class="badge bg-danger text-dark" style="color:white!important;">Rejected</span>';
                }else {
                    $status = '<span class="badge bg-success text-dark" style="color:white!important;">Approved</span>';
                }
                return $status;
            })
            ->addColumn('action', function($row){

                if($row->b_salesTax_approval ==1||($row->b_salesTax_approval ==0 && $row->salesTax !=null)  ){
                    $btn  = '<a class="edit btn btn-success btn-sm" onclick="openmodel('.$row->id.',1)" >View</a>';
                }else if($row->b_salesTax_approval ==2){
                    $btn  = '<a class="edit btn btn-primary btn-sm" onclick="openmodel('.$row->id.',2)" >Update GST</a>';
                }
                else{
                $btn  = '<a class="edit btn btn-primary btn-sm" onclick="openmodel('.$row->id.',1)" >Add GST</a>';
                }
                return $btn;
            })
            ->addColumn('rejected', function($row){ 

                if($row->b_salesTax_approval ==2){
                    return "Tax Rejected";

                }else{
                    return "--";
                }
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

              return '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Edit" class="px-2 text-primary" "> <i class="fa fa-eye"  onclick="open_remarks('.$row->id.')"></i></a>';
            })
            ->rawColumns(['status','action','version','remarks','division'])
            ->make(true);
    }

    public function save_gst(Request $request)
    {
        $id = $request->hid_id;
        $tax_user=auth()->user()->id;
        $tax_date=date('Y-m-d H:i:s');
        if($request->sts == 2){
            Basic::find($id)->update(['salesTax'=>$request->sales,'hsnCode'=>$request->hsn_code,'b_salesTax_approval'=>0,'tax_user'=> $tax_user,'tax_date'=>$tax_date]);

        }else{
            Basic::find($id)->update(['salesTax'=>$request->sales,'hsnCode'=>$request->hsn_code,'tax_user'=> $tax_user,'tax_date'=>$tax_date]);

        }
        return response()->json([
            'status' => 'success'
        ]);
    }


    public function fetch_gst(Request $request)
    {
        $id = $request->id;
        $data = Basic::where('id',$id)->where('salesTax','!=','')->first();
        return response()->json([
            'status' => 'success',
            'result' => $data
        ]);
    }


    //EPD Tax
    public function existp_tax()
    {
        $data = existing_product::where('status','!=','1')
        ->where(function ($query) {
            $query->where(function ($subquery) {
                $subquery->where('tax_approval', 'pending')
                         ->orWhereNull('tax_approval');
            });
        })
        ->where('mt_exsheet_approval','pending')
        ->where('excsheet_approval','pending')
        ->orderBy('id', 'desc')
        ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $check_histroy = EpdRejectHistory::where('epro_id',$row->id)->where('column_name', 'salesTax')->get();
                if( $check_histroy->isEmpty()) {
                    $btn = '';
                }else{
                    $btn = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >Rejection value updated by you!</span><br>';
                }

                if($row->salesTax !=""){
                    $btn .= '<a id="add_id" class="edit btn btn-success btn-sm" disabled onclick="exopenmodel('.$row->id.')" >View</a>';
                }else{
                    $btn .= '<a id="add_id" class="edit btn btn-primary btn-sm" onclick="exopenmodel('.$row->id.')" >Add GST</a>';
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


    public function exists_tax_approved()
    {
        $data = existing_product::where('status','!=','1')
        ->where('tax_approval', 'approved')
        ->where('excsheet_approval','!=', 'rejected')
        ->where('mt_exsheet_approval','!=', 'rejected')
        ->orderBy('id', 'desc')
        ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                if($row->salesTax !=""){
                    $btn  = '<a id="add_id" class="edit btn btn-success btn-sm" disabled onclick="exopenmodel('.$row->id.')" >View</a>';
                }else{
                    $btn  = '<a id="add_id" class="edit btn btn-primary btn-sm" onclick="exopenmodel('.$row->id.')" >Add GST</a>';
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


    public function exists_tax_rejected()
    {
        $data = existing_product::where('status','!=','1')
        ->where(function ($query) {
            $query->orWhere('tax_approval', 'rejected')
            ->orWhere('mt_exsheet_approval', 'rejected')
            ->orWhere('excsheet_approval', 'rejected');
        })
        ->orderBy('id', 'desc')
        ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                if($row->salesTax !=""){
                    $btn  = '<a id="add_id" class="edit btn btn-danger btn-sm" disabled onclick="exopenmodel('.$row->id.')" >Update GST</a>';
                }else{
                    $btn  = '<a id="add_id" class="edit btn btn-primary btn-sm" onclick="exopenmodel('.$row->id.')" >Add GST</a>';
                }
                return $btn;
            })
            ->addColumn('status', function($row){
                $status = '';

                if($row->tax_approval == 'rejected'){
                    $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff0053!important;" >SalesTax</span><br>';
                }
                if($row->excsheet_approval == 'rejected'){
                    $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff0053!important;" >Rejected by Finance</span><br>';
                }
                if($row->mt_exsheet_approval == 'rejected'){
                    $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff0053!important;" >Rejected by Marketing Team</span><br>';
                }
                return $status;
            })
            ->addColumn('remark', function($row){
                $get_remark = EpdRejectHistory::where('epro_id',$row->id)->where('column_name', 'salesTax')->orderBy('id', 'desc')->first();

                if ($get_remark === null) {
                    $remark = '';
                }else{
                    $remark = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >'.$get_remark->remarks.'</span><br>';
                }
                return $remark;
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
            ->rawColumns(['action','status','remark','division'])
            ->make(true);
    }

    public function save_expgst(Request $request)
    {
        $id = $request->ex_id;
        $data['salesTax'] = $request->exist_sales;
        $data['hsnCode'] = $request->exist_hsn_code;
        $data['taxuser'] = auth()->user()->id;
        $data['taxdate'] = date('Y-m-d H:i:s');

        $data['tax_approval']= 'pending';
        existing_product::where('id',$id)->update($data);
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function fetch_exgst(Request $request)
    {
        $id = $request->id;
        $data = existing_product::where('id',$id)->where('salesTax','!=','')->orderby('id','desc')->first();
        return response()->json([
            'status' => 'success',
            'result' => $data
        ]);
    }

}
