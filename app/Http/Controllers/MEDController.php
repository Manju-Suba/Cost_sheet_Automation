<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Basic;
use App\Models\existing_product;
use App\Models\MedRequest;
use App\Models\ExMedRequest;
use DataTables;
use DB;
use Auth;

class MEDController extends Controller
{
    public function approved_coststs()
    {
        $data = Basic::select('*')
        // ->where('bf_freight_approval','Approved')
        ->where('csheet_approval','Approved')
        ->orderby('id','desc')->get()->unique('pro_id');

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $req = MedRequest::select('*')
                ->where('pro_id',$row->pro_id)
                ->orderby('id','desc')
                ->first();
                if($req){
                    $btn  = '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Edit" class="px-2 text-primary" onclick = "openmodel('.$row->id.')"><i class="bx bx-pencil font-size-18"></i></a>';
                }else{
                    $btn  = '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Edit" class="px-2 text-primary" onclick = "openmodel('.$row->id.')" disabled><i class="bx bx-pencil font-size-18"></i></a>';
                }
                return $btn;
            })
            ->addColumn('bstatus', function($row){
                $req = MedRequest::select('*')
                ->where('pro_id',$row->pro_id)
                ->orderby('id','desc')
                ->first();

                if($req){

                    if($req->approve_status == 'pending'){
                        $status = '<span class="badge bg-warning text-dark">Request Sent</span>';
                    }elseif($req->approve_status == 'rejected'){
                        $status = '<span class="badge bg-danger text-dark" style="color:white!important;">Rejected by Finance</span>';
                    }else {
                        $status = '<span class="badge bg-success text-dark" style="color:white!important;">Approved by Finance</span>';
                    }
                }else{
                    $status = '<span class="badge bg-warning text-dark">NO Request</span>';
                }

                return $status;
            })
            ->rawColumns(['action','bstatus'])
            ->make(true);
    }


    public function send_request(Request $request)
    {
        if($request->input('pro_id') != ""){

            MedRequest::where('id',$request->pro_id)->update([
                'amount'            => $request->amount,
                'remarks'           => $request->remarks,
                'approve_status'    =>"pending",
            ]);

        }else{
            $basic = Basic::select('*')->where('id', $request->input('hid_id'))->get();

            $data  = array(
                'pro_id'            => $basic[0]->pro_id ,
                'product_name'      => $basic[0]->Product_name,
                'version'           => $basic[0]->version,
                'amount'            => $request->input('amount'),
                'remarks'           => $request->input('remarks'),
                'approve_status'    =>"pending",
                'status'            =>"0"
            );
            $insert = MedRequest::insert($data);
        }
    }


    public function fetchdetails(Request $request)
    {
        $id = $request->id;
        $data = Basic::where('id',$id)->first();

        if($data){
            $req = MedRequest::select('*')
            ->where('pro_id',$data->pro_id)
            ->where('version',$data->version)
            ->orderby('id','desc')
            ->first();
        }else{
            $req ='';
        }
        return response()->json([
            'status' => 'success',
            'result' => $data,
            'reqd' => $req
        ]);
    }

    public function exists_approved_costs()
    {
        $data = existing_product::select('*')
        // ->where('exproduct_approval','Approved')
        ->where('excsheet_approval','approved')
        ->orderby('id','desc')->get()->unique('epro_id');

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $req = ExMedRequest::select('*')
                ->where('epro_id',$row->epro_id)
                ->orderby('id','desc')
                ->first();
                if($req){
                    $btn  = '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Edit" class="px-2 text-primary" onclick = "epdopenmodel('.$row->id.')"><i class="bx bx-pencil font-size-18"></i></a>';
                }else{
                    $btn  = '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Edit" class="px-2 text-primary" onclick = "epdopenmodel('.$row->id.')" disabled><i class="bx bx-pencil font-size-18"></i></a>';
                }
                return $btn;
            })
            ->addColumn('bstatus', function($row){
                $req = ExMedRequest::select('*')
                ->where('epro_id',$row->epro_id)
                ->orderby('id','desc')
                ->first();

                if($req){

                    if($req->approve_status == 'pending'){
                        $status = '<span class="badge bg-warning text-dark">Request Sent</span>';
                    }elseif($req->approve_status == 'rejected'){
                        $status = '<span class="badge bg-danger text-dark" style="color:white!important;">Rejected by Finance</span>';
                    }else {
                        $status = '<span class="badge bg-success text-dark" style="color:white!important;">Approved by Finance</span>';
                    }
                }else{
                    $status = '<span class="badge bg-warning text-dark">NO Request</span>';
                }

                return $status;
            })
            ->rawColumns(['action','bstatus'])
            ->make(true);
    }

    public function fetchepdetails(Request $request)
    {
        $id = $request->id;
        $data = existing_product::where('id',$id)->first();

        if($data){
            $req = ExMedRequest::select('*')
            ->where('epro_id',$data->epro_id)
            ->orderby('id','desc')
            ->first();
        }else{
            $req ='';
        }
        return response()->json([
            'status' => 'success',
            'result' => $data,
            'reqd' => $req
        ]);
    }

    public function send_epdrequest(Request $request)
    {
        if($request->input('epro_id') != ""){

            ExMedRequest::where('id',$request->epro_id)->update([
                'amount'            => $request->epdamount,
                'remarks'           => $request->epdremarks,
                'approve_status'    =>"pending",
            ]);

        }else{
            $basic = existing_product::select('*')->where('id', $request->input('ehid_id'))->get();

            $data  = array(
                'epro_id'           => $basic[0]->epro_id ,
                'material_code'     => $basic[0]->material_code,
                'amount'            => $request->input('epdamount'),
                'remarks'           => $request->input('epdremarks'),
                'approve_status'    =>"pending",
                'status'            =>"0"
            );
            $insert = ExMedRequest::insert($data);
        }
    }




}
