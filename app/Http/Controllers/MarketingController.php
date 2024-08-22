<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Basic;
use App\Models\uom;
use App\Models\Secondary_location;
use App\Models\Primary_location;
use App\Models\Location;
use App\Models\Division;
// use App\Models\Product_material;
use App\Models\LocationMaster;
use App\Models\EpdPrimaryLocations;
use App\Models\EpdSecondaryLocations;
use App\Models\SecondaryLocationHistory;
use App\Models\BasicsHistory;
use App\Models\RmCostHistory;
use App\Models\MoqHistory;
use App\Models\PrimaryLocationHistory;
use Illuminate\Support\Facades\Mail;


use App\Models\existing_product;
use App\Models\dist_channel;
use App\Models\EpdRejectHistory;

use DataTables;
use Validator;
use DB;
use Auth;

use Illuminate\Http\Request;

class MarketingController extends Controller
{

    public function exist_save(Request $request)
    {
        $validated= Validator::make($request->all(),[
            'material_code' => 'required|max:255',
            'pieces_per_case' => 'required|numeric',
            'epd_division' => 'required|max:255',
            'exdistribution_channel' => 'required',
            'primaryfrom_location.*' => 'required|string|max:255',
            'primaryto_location.*' => 'required|string|max:255',
            'secondaryfrom_location.*' => 'required|string|max:255',
            'secondaryto_location.*' => 'required|string|max:255',
            'retailer_margin.*' => 'required|numeric',
            'primary_scheme.*' => 'required|numeric',
            'rs_margin.*' => 'required|numeric',
            'ss_margin.*' => 'required|numeric',
        ]);

        
        if($validated ->fails()){
            return response()->json(['error'=>$validated->errors()->toArray()]);
        }

        $etarget  = DB::table('existing_products')->orderBy('id','desc')->limit(1)->get();
        if(isset($etarget[0])){
            $epid = 'EP'.str_pad( ($etarget[0]->id +1 ), 9, '0', STR_PAD_LEFT );
        }else{
            $epid = 'EP000000001';
        }
        $epro_id                = $epid;
        $material_code          = $request->input('material_code');
        $pieces_per_case        = $request->input('pieces_per_case');
        $epd_division        = $request->input('epd_division');
        $dist_channel        = $request->input('exdistribution_channel');
        $noofpcs_approval       = 'pending';
        $tax_approval           = 'pending';
        $mt_exsheet_approval    = 'pending';
        $excsheet_approval      = 'pending';
        $status                 = "0";

        $data = array('epro_id'=> $epro_id,'division'=>$epd_division, 'material_code' => $material_code,'pieces_per_case' => $pieces_per_case,'distribution_channel'=> $dist_channel, 'salesTax'=>'' ,'hsnCode'=>'' ,'damage'=>'', 'logistic'=>'','status' => $status,'noofpcs_approval' =>$noofpcs_approval,'tax_approval'=>$tax_approval,'mt_exsheet_approval' => $mt_exsheet_approval,'excsheet_approval' => $excsheet_approval,'marketuser' => auth()->user()->id);

        $insert = DB::table('existing_products')->insert($data);

        foreach ($request->primaryfrom_location as $key => $primaryFrom) {
            $location = new EpdPrimaryLocations();
            $location->pro_id = $epid;
            $location->from_location = $primaryFrom;
            $location->to_location = $request->primaryto_location[$key];
            $location->retailer_margin = $request->retailer_margin[$key];
            $location->primary_scheme = $request->primary_scheme[$key];
            $location->rs_margin = $request->rs_margin[$key];
            $location->ss_margin = $request->ss_margin[$key];
            $location->freight = '';
            $location->save();
        }

        foreach ($request->secondaryfrom_location as $k => $secFrom) {
            $slocation = new EpdSecondaryLocations();
            $slocation->epro_id = $epid;
            $slocation->from_location = $secFrom;
            $slocation->to_location = $request->secondaryto_location[$k];
            $slocation->freight = '';
            $slocation->save();
        }
        
        // $users = User::whereIn("role",['Tax','Logistic','Finance'])->get();
        $rolesSearch = ['Tax','Logistic','Finance'];

        $users = User::where(function ($query) use ($rolesSearch) {
            foreach ($rolesSearch as $role) {
                $query->orWhere('multirole', 'like', '%' . $role . '%');
            }
        })->get();

        foreach($users as $user){
            $data = array([
                'material_code' => $request->input('material_code'),
                'to_name' => $user->name,
                'initiater_name' => auth()->user()->name,
                'date' => date('d.m.Y'),
                'duedate' => date('d.m.Y', strtotime("+1 days")),
            ]);

            Mail::send('emails.epdAssignedMail', $data[0], function($message) use($user) {
                $message->to('mariaarul@cavinkare.com')->subject("EPD Cost Sheet Assigned");
                // $message->to($user->email)->subject("EPD Cost Sheet Assigned");
            });
        }
        return response()->json(['success'=>'Inserted Successfully']);

    }


    public function edit_epddetails(Request $request)
    {
        $data = existing_product::where('id',$request->id)->first();

        $primary_fromLocationm = EpdPrimaryLocations::Join('location_masters','epd_primary_locations.from_location','=','location_masters.id')->where('epd_primary_locations.pro_id',$data->epro_id)->get();
        $primary_toLocation = EpdPrimaryLocations::Join('location_masters','epd_primary_locations.to_location','=','location_masters.id')->where('epd_primary_locations.pro_id',$data->epro_id)->get();
        $secondary_fromLocation = EpdSecondaryLocations::Join('location_masters','epd_secondary_locations.from_location','=','location_masters.id')->where('epd_secondary_locations.epro_id',$data->epro_id)->get();
        $secondary_toLocation = EpdSecondaryLocations::Join('location_masters','epd_secondary_locations.to_location','=','location_masters.id')->where('epd_secondary_locations.epro_id',$data->epro_id)->get();

        $epd_pcount = EpdPrimaryLocations::where('pro_id',$data->epro_id)->count();
        $epd_scount = EpdSecondaryLocations::where('epro_id',$data->epro_id)->count();

        return response()->json([
            'status' => 'success',
            'result' => $data,
            'prim1' => $primary_fromLocationm,
            'prim2' => $primary_toLocation,
            'second1' => $secondary_fromLocation,
            'second2' => $secondary_toLocation,
            'pcount' => $epd_pcount,
            'scount' => $epd_scount,
        ]);
    }


    public function save(Request $request)
    {
        $validated_form= Validator::make($request->all(),[
        // $validated_form = $request->validate([
            'product_name' => 'required|max:255',
            'Volume' => 'required|numeric',
            'uom' => 'required|max:255',
            'division' => 'required|max:255',
            'case_configuration' => 'required|numeric',
            'primary_from_location.*' => 'required|string|max:255',
            'primary_to_location.*' => 'required|string|max:255',
            'secondary_from_location.*' => 'required|string|max:255',
            'secondary_to_location.*' => 'required|string|max:255',
            // 'quantity' => 'required|numeric',
            'mrp_price' => 'required|numeric',
            'retailer_margin.*' => 'required|numeric',
            'primary_scheme.*' => 'required|numeric',
            'rs_margin.*' => 'required|numeric',
            'ss_margin.*' => 'required|numeric',
            'distribution_channel' => 'required|max:255',
        ]);
        if($validated_form ->fails()){
            return response()->json(['error'=>$validated_form->errors()->toArray()]);
        }

        $target  = DB::table('basics')->orderBy('id','desc')->limit(1)->get();
        if(isset($target[0])){
            $pid = 'PR'.str_pad( ($target[0]->id +1 ), 9, '0', STR_PAD_LEFT );
        }else{
            $pid = 'PR000000001';
        }

        $pro_id             = $pid;
        $name               = $request->input('product_name');
        $Volume             = $request->input('Volume');
        $uom                = $request->input('uom');
        $configuration      = $request->input('case_configuration');
        $quantity           = $request->input('quantity');
        $mrp_price          = $request->input('mrp_price');
        $from_location      = $request->input('from_location');
        $division      = $request->input('division');
        $to_location        = $request->input('to_location');
        $distribution_value =$request->input('distribution_channel');
        $status                 ="0";
        $version                 ="V1.0";

        $data  = array('pro_id'=>$pro_id ,'Product_name' => $name, 'Volume' => $Volume, 'uom' => $uom,'case_configuration' => $configuration, 'quantity' => $quantity, 'mrp_price' => $mrp_price,  'distribution_value' => $distribution_value,'mt_csheet_approval'=> 'Pending','csheet_approval' => 'Pending',
        'status'=>$status,'product_status'=>"0",'version' =>$version,'marketuser'=>auth()->user()->id,'division'=>$division);
        $insert = DB::table('basics')->insert($data);

        foreach ($request->primary_from_location as $index => $primaryFrom) {
            $location = new Primary_location();
            $location->pro_id = $pid;
            $location->from_location = $primaryFrom;
            $location->to_location = $request->primary_to_location[$index];
            $location->retailer_margin = $request->retailer_margin[$index];
            $location->primary_scheme = $request->primary_scheme[$index];
            $location->rs_margin = $request->rs_margin[$index];
            $location->ss_margin = $request->ss_margin[$index];
            $location->save();
        }
        foreach ($request->secondary_from_location as $index => $secondaryFrom) {
            $location = new Secondary_location();
            $location->pro_id = $pid;
            $location->from_location = $secondaryFrom;
            $location->to_location = $request->secondary_to_location[$index];
            $location->save();
        }

        // $users=User::whereIn("role",['R&D','operations','Tax','Packaging','Logistic','Finance'])->get();
        $rolesToSearch = ['R&D', 'operations', 'Tax', 'Packaging', 'Logistic', 'Finance'];

        $users = User::where(function ($query) use ($rolesToSearch) {
            foreach ($rolesToSearch as $role) {
                $query->orWhere('multirole', 'like', '%' . $role . '%');
            }
        })->get();

        foreach($users as $user){
            $data = array([
                'product_name'=>$request->input('product_name'),
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
    public function show_rejected(){
        $authuser=auth()->user()->id;
        $data = Basic::select('*')->orderby('id','desc')->where('marketuser',$authuser)
        ->where('b_volume_approval',2)
        ->orWhere('b_case_approval',2)->where('marketuser',$authuser)
        // ->orWhere('b_quantity_approval',2)
        ->orWhere('b_mrp_price_approval',2)->where('marketuser',$authuser)
        ->orWhere('b_primary_scheme_approval',2)->where('marketuser',$authuser)
        ->orWhere('b_rs_margin_approval',2)->where('marketuser',$authuser)
        ->orWhere('b_ss_margin_approval',2)->where('marketuser',$authuser)
        ->orwhere('b_retailer_margin_approval',2)->where('marketuser',$authuser)->get();
        $table = array();
        $i = 1;
        foreach ($data as $row) {
            $volume = $row->Volume.' '.$row->uom ;
            $rejected='';
            if($row->b_volume_approval == 2){
                $rejected.='<span class="badge badge-secondary" style="background-color: #E44141;color:white;">Volume</span>';
            }
            if($row->b_case_approval == 2){
                $rejected.='<span class="badge badge-secondary" style="background-color: #E44141;color:white;">Case Configuration</span>';
            }
            if($row->b_quantity_approval == 2){
                $rejected.='<span class="badge badge-secondary" style="background-color: #E44141;color:white;">Quantity</span>';
            }
            if($row->b_mrp_price_approval == 2){
                $rejected.='<span class="badge badge-secondary" style="background-color: #E44141;color:white;">Mrp</span>';
            }
            if($row->b_primary_scheme_approval == 2){
                $rejected.='<span class="badge badge-secondary" style="background-color: #E44141;color:white;">Primary Scheme%</span>';
            }
            if($row->b_rs_margin_approval == 2){
                $rejected.='<span class="badge badge-secondary" style="background-color: #E44141;color:white;">RS Margin</span>';
            }
            if($row->b_ss_margin_approval == 2){
                $rejected.='<span class="badge badge-secondary" style="background-color: #E44141;color:white;">SS Margin</span>';
            }
            if($row->b_retailer_margin_approval == 2){
                $rejected.='<span class="badge badge-secondary" style="background-color: #E44141;color:white;">Retailer Margin</span>';
            }

            $table1 = array();

            $location = Primary_location::where('pro_id','=', $row->pro_id)->select('from_location','to_location')->get();
            $p_loc = '';
            foreach ($location as $locations){
                $pf_location=LocationMaster::find($locations->from_location);
                $pt_location=LocationMaster::find($locations->to_location);

                $p_loc .= '<span class="badge badge-secondary" style="background-color: #21c4b1ab;color:#000000c7;">'. $pf_location->location .' - '.$pt_location->location.' </span>';
            }

            $slocation = Secondary_location::where('pro_id','=', $row->pro_id)->select('from_location','to_location')->get();
            $sec_loc = '';
            foreach ($slocation as $sec){
                $sf_location=LocationMaster::find($sec->from_location);
                $st_location=LocationMaster::find($sec->to_location);

                $sec_loc .= '<span class="badge badge-secondary" style="background-color: #0ce024a6;color:#000000c7;">'. $sf_location->location .' - '.$st_location->location.' </span>';
            }
            $distchanel = dist_channel::find($row->distribution_value);
            $dist_c =$distchanel->dist_name;
            if($row->division !=null){
            $divisioname = Division::find($row->division);
            $division =$divisioname->division;
            }else{
                $division ="--";
            }
            $table1['Division'] = $division;
            $table1['version'] = $row->version;
            $table1['Product_Name'] = $row->Product_name;
            $table1['Fill_Volume'] = $volume;
            $table1['Cofiguration'] = $row->case_configuration;
            $table1['Quantity'] = $row->quantity;
            $table1['Price'] = $row->mrp_price;
            $table1['primary_Location'] = $p_loc;
            $table1['rejected'] = $rejected;
            $table1['distribution_value'] = $dist_c;
            $table1['secondary_Location'] = $sec_loc;
            $table1['Margin'] = $row->retailer_margin.'%';
            $table1['Primary_Scheme'] = $row->primary_scheme.'%';
            $table1['RS_Margin'] = $row->rs_margin.'%';
            $table1['ss_Margin'] = $row->ss_margin.'%';
            $table1['Action'] = '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Edit" class="px-2 text-primary" onclick = "edit_details('.$row->id.',2)"><i class="bx bx-pencil font-size-18"></i></a>';
            $table1['remarks'] = '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Edit" class="px-2 text-primary" "> <i class="fa fa-eye"  onclick="open_remarks('.$row->id.')"></i></a>';
            $table[] = $table1;
            $i++;
        }
        $response = array(
            "data" => $table
        );
        echo json_encode($response);
    }
    public function show_approved(){
        $authuser=auth()->user()->id;
        $data = Basic::select('*')->orderby('id','desc')
        ->where('b_volume_approval',1)
        ->where('b_case_approval',1)
        // ->where('b_quantity_approval',1)
        ->where('b_mrp_price_approval',1)
        ->where('b_primary_scheme_approval',1)
        ->where('b_rs_margin_approval',1)
        ->where('b_ss_margin_approval',1)
        ->where('b_retailer_margin_approval',1)->where('marketuser',$authuser)->get();
        $table = array();
        $i = 1;
        foreach ($data as $row) {
            $volume = $row->Volume.' '.$row->uom ;
            $table1 = array();

            $location = Primary_location::where('pro_id','=', $row->pro_id)->select('from_location','to_location')->get();
            $p_loc = '';
            foreach ($location as $locations){
                $pf_location=LocationMaster::find($locations->from_location);
                $pt_location=LocationMaster::find($locations->to_location);

                $p_loc .= '<span class="badge badge-secondary" style="background-color: #21c4b1ab;color:#000000c7;">'. $pf_location->location .' - '.$pt_location->location.' </span>';
            }

            $slocation = Secondary_location::where('pro_id','=', $row->pro_id)->select('from_location','to_location')->get();
            $sec_loc = '';
            foreach ($slocation as $sec){
                $sf_location=LocationMaster::find($sec->from_location);
                $st_location=LocationMaster::find($sec->to_location);

                $sec_loc .= '<span class="badge badge-secondary" style="background-color: #0ce024a6;color:#000000c7;">'. $sf_location->location .' - '.$st_location->location.' </span>';
            }
            $distchanel = dist_channel::find($row->distribution_value);
            $dist_c =$distchanel->dist_name;
            if($row->division !=null){
            $divisioname = Division::find($row->division);
            $division =$divisioname->division;
            }else{
                $division ="--";
            }
            $table1['Division'] = $division;
            $table1['version'] = $row->version;
            $table1['Product_Name'] = $row->Product_name;
            $table1['Fill_Volume'] = $volume;
            $table1['Cofiguration'] = $row->case_configuration;
            $table1['Quantity'] = $row->quantity;
            $table1['Price'] = $row->mrp_price;
            $table1['primary_Location'] = $p_loc;
            // $table1['approved'] = $rejected;

            $table1['secondary_Location'] = $sec_loc;
            $table1['distribution_value'] = $dist_c;
            $table1['Margin'] = $row->retailer_margin.'%';
            $table1['Primary_Scheme'] = $row->primary_scheme.'%';
            $table1['RS_Margin'] = $row->rs_margin.'%';
            $table1['ss_Margin'] = $row->ss_margin.'%';
            $table[] = $table1;
            $i++;
        }
        $response = array(
            "data" => $table
        );
        echo json_encode($response);
    }
    public function show()
    {
        $authuser=auth()->user()->id;
        $data  = Basic::select('*')->orderby('id','desc')
        ->Where('b_volume_approval',0)
        ->Where('b_case_approval',0)
        // ->Where('b_quantity_approval',0)
        ->Where('b_mrp_price_approval',0)
        ->Where('b_primary_scheme_approval',0)
        ->Where('b_rs_margin_approval',0)
        ->Where('b_ss_margin_approval',0)
        ->Where('b_retailer_margin_approval',0)->where('marketuser',$authuser)->get();

        $table = array();
        $i = 1;
        foreach ($data as $row) {
            $volume = $row->Volume.' '.$row->uom ;

            $table1 = array();

            $location = Primary_location::where('pro_id','=', $row->pro_id)->select('from_location','to_location')->get();
            $p_loc = '';
            foreach ($location as $locations){
                $pf_location=LocationMaster::find($locations->from_location);
                $pt_location=LocationMaster::find($locations->to_location);

                $p_loc .= '<span class="badge badge-secondary" style="background-color: #21c4b1ab;color:#000000c7;">'. $pf_location->location .' - '.$pt_location->location.' </span>';
            }

            $slocation = Secondary_location::where('pro_id','=', $row->pro_id)->select('from_location','to_location')->get();
            $sec_loc = '';
            foreach ($slocation as $sec){
                $sf_location=LocationMaster::find($sec->from_location);
                $st_location=LocationMaster::find($sec->to_location);

                $sec_loc .= '<span class="badge badge-secondary" style="background-color: #0ce024a6;color:#000000c7;">'. $sf_location->location .' - '.$st_location->location.' </span>';
            }

            $distchanel = dist_channel::find($row->distribution_value);
            $dist_c =$distchanel->dist_name;
           if($row->division !=null){
            $divisioname = Division::find($row->division);
            $division =$divisioname->division;
            }else{
                $division ="--";
            }
            $table1['Division'] = $division;
            $table1['version'] = $row->version;
            $table1['Product_Name'] = $row->Product_name;
            $table1['Fill_Volume'] = $volume;
            $table1['Cofiguration'] = $row->case_configuration;
            $table1['Quantity'] = $row->quantity;
            $table1['Price'] = $row->mrp_price;
            $table1['primary_Location'] = $p_loc;
            $table1['distribution_value'] = $dist_c;
            $table1['secondary_Location'] = $sec_loc;
            $table1['Margin'] = $row->retailer_margin.'%';
            $table1['Primary_Scheme'] = $row->primary_scheme.'%';
            $table1['RS_Margin'] = $row->rs_margin.'%';
            $table1['ss_Margin'] = $row->ss_margin.'%';
            $table1['Action'] = '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Edit" class="px-2 text-primary" onclick = "edit_details('.$row->id.',1)"><i class="fa fa-eye font-size-18"></i></a>';
            $pm=Primary_location::where('pro_id','=', $row->pro_id)->whereNotNull('cost')->get()->count();
            // $prod=Product_material::where('product_id',$row->pro_id)->get()->count();
            if($row->conv_cost==null && $row->specific_gravity == null && $row->salesTax== null && $row->damage== null && $pm==0)
                $table1['Action'].=' <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="px-2 text-danger" onclick = "open_confirm('.$row->id.')"><i class="bx bx-trash-alt font-size-18"></i></a>';
            $table[] = $table1;
            $i++;
        }
        $response = array(
            "data" => $table
        );
        echo json_encode($response);
    }


    public function exists_product()
    {
        if(Auth::user()->role == 'Finance'){
            $data = existing_product::where('status','!=','1')->orderby('id','desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn  = '<a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="View" class="px-2 text-primary" onclick = "edit_epddetails('.$row->id.')"><i class="fa fa-eye font-size-14"></i></a>';
                    return $btn;
                })
                ->addColumn('prim_location', function($row){

                    $location = EpdPrimaryLocations::where('pro_id','=', $row->epro_id)->select('from_location','to_location')->get();
                    $p_loc = '';
                    foreach ($location as $locations){
                        $p_flocation = LocationMaster::find($locations->from_location);
                        $p_tolocation = LocationMaster::find($locations->to_location);
                        $p_loc .= '<span class="badge badge-secondary" style="background-color: #21c4b1ab;color:#000000c7;">'. $p_flocation->location .'  -  '.$p_tolocation->location.' </span>';
                    }

                    return $p_loc;
                })
                ->addColumn('sec_location', function($row){
                    $locate = EpdSecondaryLocations::where('epro_id','=', $row->epro_id)->select('from_location','to_location')->get();
                    $sec_loc = '';
                    foreach ($locate as $locations){
                        $s_flocation = LocationMaster::find($locations->from_location);
                        $s_tolocation = LocationMaster::find($locations->to_location);
                        $sec_loc .= '<span class="badge badge-secondary" style="background-color: #0ce024a6;color:#000000c7;">'. $s_flocation->location .'  -  '.$s_flocation->location.' </span>';
                    }

                    return $sec_loc;
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
                ->rawColumns(['action','prim_location','sec_location','division'])
                ->make(true);
        }else{


            $data = existing_product::where('status','!=','1')
            ->join('epd_primary_locations as epl', function ($join) {
                $join->on('existing_products.epro_id', '=', 'epl.pro_id')
                    ->where('epl.id', '=', DB::raw("(SELECT MAX(id) FROM epd_primary_locations WHERE pro_id = existing_products.epro_id)"));
            });

            if(Auth::user()->role == 'Marketing'){
                $data = $data->where('marketuser',auth()->user()->id);
            }

            $data = $data->where(function ($query) {
                $query->orWhere(function ($subquery) {
                    $subquery->where('existing_products.noofpcs_approval', 'pending')
                             ->orWhereNull('existing_products.noofpcs_approval');
                // })->orWhere(function ($subquery) {
                //     $subquery->where('existing_products.mrp_pcs_approval', 'pending')
                //              ->orWhereNull('existing_products.mrp_pcs_approval');
                })->orWhere(function ($subquery) {
                    $subquery->where('epl.retail_margin_approval', '0')
                            ->orWhereNull('epl.retail_margin_approval');
                })->orWhere(function ($subquery) {
                    $subquery->where('epl.prim_scheme_approval', '0')
                            ->orWhereNull('epl.prim_scheme_approval');
                })->orWhere(function ($subquery) {
                    $subquery->where('epl.rsm_approval', '0')
                            ->orWhereNull('epl.rsm_approval');
                })->orWhere(function ($subquery) {
                    $subquery->where('epl.ssmargin_approval', '0')
                            ->orWhereNull('epl.ssmargin_approval');
                });
            })
            ->where('existing_products.noofpcs_approval','pending')
            ->where('existing_products.mt_exsheet_approval','pending')
            ->where('existing_products.excsheet_approval','pending')
            ->select(
                'existing_products.*',
            )
            ->orderBy('existing_products.id', 'desc')
            ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $array = ['pieces_per_case', 'mrp_piece' ,'retailer_margin','primary_scheme','rs_margin','ss_margin'];
                    $check_histroy = EpdRejectHistory::where('epro_id',$row->id)->whereIn('column_name', $array)->get();

                    if( $check_histroy->isEmpty()) {

                        if(Auth::user()->role == 'Marketing'){
                            $btn = '<a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="px-2 text-primary" onclick = "edit_epddetails('.$row->id.')"><i class="fa fa-eye font-size-14"></i></a>
                            <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="px-2 text-danger" onclick = "open_exconfirm('.$row->id.')"><i class="bx bx-trash-alt font-size-18"></i></a>';
                        }else{
                            $btn = '<a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="px-2 text-primary" onclick = "edit_epddetails('.$row->id.')"><i class="fa fa-eye font-size-14"></i></a> ';
                        }
                    }else{
                        $btn = '<span class="badge bg-success text-dark" style="color:white!important;background-color: #ff00b0!important;" >Rejection value updated by you!</span><a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="px-2 text-primary" onclick = "edit_epddetails('.$row->id.')"><i class="fa fa-eye font-size-14"></i></a>';
                    }

                    // $btn = '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Edit" class="px-2 text-primary" onclick = "edit_epddetails('.$row->id.')"><i class="bx bx-pencil font-size-18"></i></a>
                    // <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="px-2 text-danger" onclick = "open_exconfirm('.$row->id.')"><i class="bx bx-trash-alt font-size-18"></i></a>';

                    return $btn;
                })
                ->addColumn('prim_location', function($row){
                    $from_location = EpdPrimaryLocations::join('location_masters', 'location_masters.id', '=', 'epd_primary_locations.from_location')
                    ->where('epd_primary_locations.pro_id', $row->epro_id)
                    ->select('location_masters.location')
                    ->get();

                    $to_location = EpdPrimaryLocations::join('location_masters', 'location_masters.id', '=', 'epd_primary_locations.to_location')
                    ->where('epd_primary_locations.pro_id', $row->epro_id)
                    ->select('location_masters.location')
                    ->get();

                    $p_loc = '';
                    foreach ($from_location as $k => $locate){
                        $p_loc .= '<span class="badge badge-secondary" style="background-color: #21c4b1ab;color:#000000c7;">'. $locate['location'] .' to '.$to_location[$k]['location'].' </span>';
                    }

                    return $p_loc;
                })
                ->addColumn('sec_location', function($row){
                    $sfrom_location = EpdSecondaryLocations::join('location_masters', 'location_masters.id', '=', 'epd_secondary_locations.from_location')
                    ->where('epd_secondary_locations.epro_id', $row->epro_id)
                    ->select('location_masters.location')->get();

                    $sto_location = EpdSecondaryLocations::join('location_masters', 'location_masters.id', '=', 'epd_secondary_locations.to_location')
                    ->where('epd_secondary_locations.epro_id', $row->epro_id)
                    ->select('location_masters.location')->get();

                    $sec_loc = '';
                    foreach ($sfrom_location as $k => $slocate){
                        $sec_loc .= '<span class="badge badge-success" style="background-color: #0ce024a6;color:#000000c7;">'. $slocate['location'] .' to '.$sto_location[$k]['location'].' </span>';
                    }

                    return $sec_loc;
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
                ->rawColumns(['action','prim_location','sec_location','division'])
                ->make(true);
        }

    }

    public function exists_approved(){
        $data = existing_product::where('status','!=','1')->where('marketuser',auth()->user()->id)
        ->where('existing_products.noofpcs_approval', 'approved')
        // ->where('existing_products.mrp_pcs_approval', 'approved')
        ->where('existing_products.mt_exsheet_approval', '!=','rejected')
        ->where('existing_products.excsheet_approval', '!=','rejected')
        ->select(
            'existing_products.id as id',
            'existing_products.*',
            'epl.retail_margin_approval',
            'epl.prim_scheme_approval',
            'epl.rsm_approval',
            'epl.ssmargin_approval'
        )
        ->join('epd_primary_locations as epl', function ($join) {
            $join->on('existing_products.epro_id', '=', 'epl.pro_id')
                ->where('epl.id', '=', DB::raw("(SELECT MAX(id) FROM epd_primary_locations WHERE pro_id = existing_products.epro_id)"));
        })
        ->where('epl.retail_margin_approval','1')
        ->where('epl.prim_scheme_approval','1')
        ->where('epl.rsm_approval','1')
        ->where('epl.ssmargin_approval','1')
        ->orderBy('existing_products.id', 'desc')
        ->get();

        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn = '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Edit" class="px-2 text-primary" onclick = "edit_epddetails('.$row->id.')"><i class="fa fa-eye font-size-18"></i></a>';
            // $btn = '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Edit" class="px-2 text-primary" onclick = "edit_epddetails('.$row->id.')"><i class="bx bx-pencil font-size-18"></i></a>
            // <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="px-2 text-danger" onclick = "open_exconfirm('.$row->id.')"><i class="bx bx-trash-alt font-size-18"></i></a>';

            return $btn;
        })
        ->addColumn('prim_location', function($row){
            $from_location = EpdPrimaryLocations::join('location_masters', 'location_masters.id', '=', 'epd_primary_locations.from_location')
            ->where('epd_primary_locations.pro_id', $row->epro_id)
            ->select('location_masters.location')
            ->get();

            $to_location = EpdPrimaryLocations::join('location_masters', 'location_masters.id', '=', 'epd_primary_locations.to_location')
            ->where('epd_primary_locations.pro_id', $row->epro_id)
            ->select('location_masters.location')
            ->get();

            $p_loc = '';
            foreach ($from_location as $k => $locate){
                $p_loc .= '<span class="badge badge-secondary" style="background-color: #21c4b1ab;color:#000000c7;">'. $locate['location'] .' (to) '.$to_location[$k]['location'].' </span>';
            }

            return $p_loc;
        })
        ->addColumn('sec_location', function($row){
            $sfrom_location = EpdSecondaryLocations::join('location_masters', 'location_masters.id', '=', 'epd_secondary_locations.from_location')
            ->where('epd_secondary_locations.epro_id', $row->epro_id)
            ->select('location_masters.location')->get();

            $sto_location = EpdSecondaryLocations::join('location_masters', 'location_masters.id', '=', 'epd_secondary_locations.to_location')
            ->where('epd_secondary_locations.epro_id', $row->epro_id)
            ->select('location_masters.location')->get();

            $sec_loc = '';
            foreach ($sfrom_location as $k => $slocate){
                $sec_loc .= '<span class="badge badge-success" style="background-color: #0ce024a6;color:#000000c7;">'. $slocate['location'] .' (to) '.$sto_location[$k]['location'].' </span>';
            }

            return $sec_loc;
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
        ->rawColumns(['action','prim_location','sec_location','division'])
        ->make(true);
    }

    public function exists_rejected(){
        $data = existing_product::where('status','!=','1')->where('marketuser',auth()->user()->id)

        ->select(
            'existing_products.id as id',
            'existing_products.*',
            'epl.retail_margin_approval',
            'epl.prim_scheme_approval',
            'epl.rsm_approval',
            'epl.ssmargin_approval',
          
        )
        ->join('epd_primary_locations as epl', function ($join) {
            $join->on('existing_products.epro_id', '=', 'epl.pro_id')
                ->where('epl.id', '=', DB::raw("(SELECT MAX(id) FROM epd_primary_locations WHERE pro_id = existing_products.epro_id)"));
        })
        ->where(function ($query) {
            $query->orWhere('existing_products.noofpcs_approval', 'rejected')
                // ->orWhere('existing_products.mrp_pcs_approval', 'rejected')
                ->orWhere('existing_products.mt_exsheet_approval', 'rejected')
                ->orWhere('existing_products.excsheet_approval', 'rejected')
                ->orWhere('epl.retail_margin_approval', '2')
                ->orWhere('epl.prim_scheme_approval', '2')
                ->orWhere('epl.rsm_approval', '2')
                ->orWhere('epl.ssmargin_approval', '2');
        })
        // ->where(function ($query) {
        //     $query->orWhere('epl.retail_margin_approval', '2')
        //         ->orWhere('epl.prim_scheme_approval', '2')
        //         ->orWhere('epl.rsm_approval', '2')
        //         ->orWhere('epl.ssmargin_approval', '2');
        // })
        ->orderBy('existing_products.id', 'desc')
        ->get();
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){

            if($row->excsheet_approval == 'rejected' || $row->mt_exsheet_approval == 'rejected'){
                $btn = '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff0053!important;" >Rejected</span><br>';
            }else{
                $btn = '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Edit" class="px-2 text-primary" onclick = "edit_epddetails('.$row->id.')"><i class="bx bx-pencil font-size-18"></i></a>';
            }

            // $btn = '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Edit" class="px-2 text-primary" onclick = "edit_epddetails('.$row->id.')"><i class="bx bx-pencil font-size-18"></i></a>
            // <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="px-2 text-danger" onclick = "open_exconfirm('.$row->id.')"><i class="bx bx-trash-alt font-size-18"></i></a>';

            return $btn;
        })
        ->addColumn('status', function($row){
            $status = '';

            if($row->noofpcs_approval == 'rejected'){
                $pieces_pcase_histroy = EpdRejectHistory::where('epro_id',$row->id)->where('column_name', 'pieces_per_case')->orderBy('id','desc')->first();
                $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff0053!important;" >No of Pieces per Case : '.$pieces_pcase_histroy->remarks.' </span><br>';
            }
            // if($row->mrp_pcs_approval == 'rejected'){
            //     $mrp_pcs_histroy = EpdRejectHistory::where('epro_id',$row->id)->where('column_name', 'mrp_piece')->orderBy('id','desc')->first();
            //     $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff0053!important;" >MRP Per Piece : '.$mrp_pcs_histroy->remarks.' </span><br>';
            // }
            if($row->retail_margin_approval == '2'){
                $rm_histroy = EpdRejectHistory::where('epro_id',$row->id)->where('column_name', 'retailer_margin')->orderBy('id','desc')->first();
                $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff0053!important;" >Retailer Margin % : '.$rm_histroy->remarks.'</span><br>';
            }
            if($row->prim_scheme_approval == '2'){
                $ps_histroy = EpdRejectHistory::where('epro_id',$row->id)->where('column_name', 'primary_scheme')->orderBy('id','desc')->first();
                $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff0053!important;" >Primary Scheme % '.$ps_histroy->remarks.'</span><br>';
            }
            if($row->rsm_approval == '2'){
                $rsm_histroy = EpdRejectHistory::where('epro_id',$row->id)->where('column_name', 'rs_margin')->orderBy('id','desc')->first();
                $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff0053!important;" >RS Margin % : '.$rsm_histroy->remarks.'</span><br>';
            }
            if($row->ssmargin_approval == '2'){
                $ssm_histroy = EpdRejectHistory::where('epro_id',$row->id)->where('column_name', 'ss_margin')->orderBy('id','desc')->first();
                $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff0053!important;" >SS Margin % : '.$ssm_histroy->remarks.'</span><br>';
            }

            if($row->excsheet_approval == 'rejected'){
                $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff0053!important;" >Rejected by Finance</span><br>';
            }
            if($row->mt_exsheet_approval == 'rejected'){
                $status .= '<span class="badge bg-danger text-dark" style="color:white!important;background-color: #ff0053!important;" >Rejected by Marketing Team</span><br>';
            }
            return $status;
        })
        ->addColumn('prim_location', function($row){
            $from_location = EpdPrimaryLocations::join('location_masters', 'location_masters.id', '=', 'epd_primary_locations.from_location')
            ->where('epd_primary_locations.pro_id', $row->epro_id)
            ->select('location_masters.location')
            ->get();

            $to_location = EpdPrimaryLocations::join('location_masters', 'location_masters.id', '=', 'epd_primary_locations.to_location')
            ->where('epd_primary_locations.pro_id', $row->epro_id)
            ->select('location_masters.location')
            ->get();

            $p_loc = '';
            foreach ($from_location as $k => $locate){
                $p_loc .= '<span class="badge badge-secondary" style="background-color: #21c4b1ab;color:#000000c7;">'. $locate['location'] .' (to) '.$to_location[$k]['location'].' </span>';
            }

            return $p_loc;
        })
        ->addColumn('sec_location', function($row){
            $sfrom_location = EpdSecondaryLocations::join('location_masters', 'location_masters.id', '=', 'epd_secondary_locations.from_location')
            ->where('epd_secondary_locations.epro_id', $row->epro_id)
            ->select('location_masters.location')->get();

            $sto_location = EpdSecondaryLocations::join('location_masters', 'location_masters.id', '=', 'epd_secondary_locations.to_location')
            ->where('epd_secondary_locations.epro_id', $row->epro_id)
            ->select('location_masters.location')->get();

            $sec_loc = '';
            foreach ($sfrom_location as $k => $slocate){
                $sec_loc .= '<span class="badge badge-success" style="background-color: #0ce024a6;color:#000000c7;">'. $slocate['location'] .' (to) '.$sto_location[$k]['location'].' </span>';
            }

            return $sec_loc;
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
        ->rawColumns(['action','status' ,'prim_location','sec_location','division'])
        ->make(true);
    }


    public function save_uom(Request $request)
    {
        $request->uom;
        uom::create(['uom_name' => $request->uom_name]);
        return response()->json([
            "status" => "uom saved successfully"
        ]);
    }
    public function fetch_uom()
    {
        $data = uom::select('*');
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn  = '<a id="edit_uom" title="edit"  class="edit btn btn-primary btn-sm mr-2" style="margin-right:2px" onclick="edit_form(' . $row->id . ')" ><i class="fas fa-edit"></i></a>';
            // $btn .= '<a class="delete btn btn-danger btn-sm delete_id" title="delete" id="del_id" onclick="open_confirm(' . $row->id . ');" ><i class="fas fa-trash"></i></a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
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

    public function delete_basic(Request $request)
    {
        $id = $request->id;
        Basic::find($id)->delete();
        return response()->json([
            'status' => 'deleted successfully'
        ]);
    }

    public function edit_details(Request $request)
    {
        $id = $request->id;
        $data = Basic::where('id',$id)->first();

        $primary_locate1 = Primary_location::Join('location_masters','primary_locations.from_location','=','location_masters.id')->where('pro_id',$data->pro_id)->get();
        $primary_locate2 = Primary_location::Join('location_masters','primary_locations.to_location','=','location_masters.id')->where('pro_id',$data->pro_id)->get();
        $secondary_locate1 = Secondary_location::Join('location_masters','secondary_locations.from_location','=','location_masters.id')->where('pro_id',$data->pro_id)->get();
        $secondary_locate2 = Secondary_location::Join('location_masters','secondary_locations.to_location','=','location_masters.id')->where('pro_id',$data->pro_id)->get();

        $pcount = Primary_location::where('pro_id',$data->pro_id)->count();
        $scount = Secondary_location::where('pro_id',$data->pro_id)->count();

        return response()->json([
            'status' => 'success',
            'result' => $data,
            'prim1' => $primary_locate1,
            'prim2' => $primary_locate2,
            'second1' => $secondary_locate1,
            'second2' => $secondary_locate2,
            'pcount' => $pcount,
            'scount' => $scount,
        ]);
    }

    public function update_details(Request $request)
    {
        $check_approval_status = Basic::where('id',$request->hid_id)->orderby('id','desc')->first();
        $secondary=Primary_location::where('pro_id',$check_approval_status->pro_id)->get();
        $pid = $check_approval_status->pro_id;
            // $previous_version 	= substr($check_approval_status[0]->version, -3);
            // $previous_version = str_replace('V', '', $check_approval_status[0]->version);
            // $cnew_version = $previous_version+('0.1');
            // $version = 'V'.$cnew_version;
        $data=[];
        if(isset($request->edit_Volume)){
            $data['Volume'] = $request->edit_Volume;
            $data['b_volume_approval'] = 0;
        }
        if(isset($request->edit_case_configuration)){
            $data['case_configuration'] = $request->edit_case_configuration;
            $data['b_case_approval'] = 0;
        }
        if(isset( $request->edit_quantity)){
            $data['quantity'] = $request->edit_quantity;
            $data['b_quantity_approval'] = 0;
        }
        if(isset($request->edit_mrp_price)){
            $data['mrp_price'] = $request->edit_mrp_price;
            $data['b_mrp_price_approval'] = 0;
        }
        if(isset($request->edit_retailer_margin)){
            $i=0;
            foreach( $secondary as  $second){
                $k=Primary_location::find($second->id);
                $k->retailer_margin = $request->edit_retailer_margin[$i];
                $k->save();
                $i++;
            }
            $data['b_retailer_margin_approval'] = 0;
        }
        if(isset($request->edit_primary_scheme)){
            $i=0;
            foreach( $secondary as  $second){
                $k=Primary_location::find($second->id);
                $k->primary_scheme = $request->edit_primary_scheme[$i];
                $k->save();
                $i++;
            }
            $data['b_primary_scheme_approval'] = 0;

        }if(isset($request->edit_rs_margin)){
            $i=0;
            foreach( $secondary as  $second){
                $k=Primary_location::find($second->id);
                $k->rs_margin = $request->edit_rs_margin[$i];
                $k->save();
                $i++;
            }
            $data['b_rs_margin_approval'] = 0;
        }
        if(isset($request->edit_ss_margin)){
            $i=0;
            foreach( $secondary as  $second){
                $k=Primary_location::find($second->id);
                $k->ss_margin = $request->edit_ss_margin[$i];
                $k->save();
                $i++;
            }
            $data['b_ss_margin_approval'] = 0;
        }


        Basic::where('id',$request->hid_id)->update($data);


        return response()->json([
            'status' => 'success'
        ]);
    }

    public function update_exist_details(Request $request)
    {

        if(isset($request->edit_pieces_pcase)){
            $data['pieces_per_case'] = $request->edit_pieces_pcase;
            $data['noofpcs_approval']= 'pending';
            DB::table('existing_products')->where('id',$request->exhid_id)->update($data);
        }
        // if(isset($request->edit_mrp_price)){
        //     $dataa['mrp_piece'] = $request->edit_mrp_price;
        //     $dataa['mrp_pcs_approval']= 'pending';
        //     DB::table('existing_products')->where('id',$request->exhid_id)->update($dataa);
        // }

        $check__status = existing_product::where('id',$request->exhid_id)->orderby('id','desc')->first();

        $pFromLocation= EpdPrimaryLocations::where('pro_id',$check__status->epro_id)->get();

        if(isset($request->editretailer_margin)){
            // $data['retailer_margin'] = $request->editretailer_margin;
            foreach( $pFromLocation as $i => $prim){
                $data1['retailer_margin'] = $request->editretailer_margin[$i];
                $data1['retail_margin_approval'] = null;
                EpdPrimaryLocations::where('id',$prim->id)->update($data1);
            }
        }

        if(isset($request->editprimary_scheme)){
            foreach( $pFromLocation as $i => $prim){
                $data2['primary_scheme'] = $request->editprimary_scheme[$i];
                $data2['prim_scheme_approval'] = null;
                EpdPrimaryLocations::where('id',$prim->id)->update($data2);
            }
        }

        if(isset($request->editrs_margin)){
            foreach( $pFromLocation as $i => $prim){
                $data3['rs_margin'] = $request->editrs_margin[$i];
                $data3['rsm_approval'] = null;
                EpdPrimaryLocations::where('id',$prim->id)->update($data3);
            }
        }

        if(isset($request->editss_margin)){
            foreach( $pFromLocation as $i => $prim){
                $data3['ss_margin'] = $request->editss_margin[$i];
                $data3['ssmargin_approval'] = null;
                EpdPrimaryLocations::where('id',$prim->id)->update($data3);
            }
        }

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function delete_ex(Request $request)
    {
        $id = $request->id;
        DB::table('existing_products')->where('id',$id)->update([
            'status'         => 1,
        ]);
        return response()->json([
            'status' => 'deleted successfully'
        ]);
    }

    public function fetch_dist_ch()
    {
        $data = dist_channel::select('*');
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn  = '<a id="edit_uom" title="edit"  class="edit btn btn-primary btn-sm mr-2" style="margin-right:2px" onclick="edit_form(' . $row->id . ')" ><i class="fas fa-edit"></i></a>';
            // $btn .= '<a class="delete btn btn-danger btn-sm delete_id" title="delete" id="del_id" onclick="open_confirm(' . $row->id . ');" ><i class="fas fa-trash"></i></a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function get_dist_ch(Request $request,$id)
    {
        $data = dist_channel::find($id);
        // dd($data);
        return response()->json([
            "status" => "Distribution channel edited successfully",
            "data" => $data
        ]);
    }
    public function save_dist_ch(Request $request)
    {
        dist_channel::create(['dist_name' => $request->dist_name]);
        return response()->json([
            "status" => "Distribution channel saved successfully"
        ]);
    }

    public function delete_dist_ch(Request $request,$id)
    {
        dist_channel::find($id)->delete();
        return response()->json([
            "status" => "Distribution channel deleted successfully"
        ]);
    }

    public function update_dist_ch(Request $request)
    {
       $id = $request->update_id_name;
       dist_channel::find($id)->update(['dist_name' => $request->edit_dist_name]);
        return response()->json([
            "status" => "Distribution channel updated successfully"
        ]);
    }

   public function view_remarks(Request $request){
    $basics=Basic::find($request->id);


    if($request->type=="market"){

        if($basics->b_case_approval ==  2){
            $historys= BasicsHistory::where('product_id', $basics->pro_id)
                        ->where('description','case_configuration')
                        ->orderBy('created_at', 'desc')
                       ->first();
            $history[]=$historys->remarks;
        }
        if($basics->b_volume_approval ==  2){
            $historys= BasicsHistory::where('product_id', $basics->pro_id)
                        ->where('description','Volume')
                        ->orderBy('created_at', 'desc')
                       ->first();
            $history[]=$historys->remarks;
        }
        if($basics->b_mrp_price_approval ==  2){
            $historys= BasicsHistory::where('product_id', $basics->pro_id)
                        ->where('description','mrp_price')
                        ->orderBy('created_at', 'desc')
                       ->first();
            $history[]=$historys->remarks;
        }
        if($basics->b_ss_margin_approval ==  2){
            $historys= PrimaryLocationHistory::where('product_id', $basics->pro_id)
                        ->where('description','ss_margin')
                        ->orderBy('created_at', 'desc')
                       ->first();
            $history[]=$historys->remarks;
        }
        if($basics->b_retailer_margin_approval ==  2){
            $historys= PrimaryLocationHistory::where('product_id', $basics->pro_id)
                        ->where('description','retailer_margin')
                        ->orderBy('created_at', 'desc')
                       ->first();
            $history[]=$historys->remarks;
        }
        if($basics->b_primary_scheme_approval ==  2){
            $historys= PrimaryLocationHistory::where('product_id', $basics->pro_id)
                        ->where('description','primary_scheme')
                        ->orderBy('created_at', 'desc')
                       ->first();
            $history[]=$historys->remarks;
        }
        if($basics->b_rs_margin_approval ==  2){
            $historys= PrimaryLocationHistory::where('product_id', $basics->pro_id)
                        ->where('description','rs_margin')
                        ->orderBy('created_at', 'desc')
                       ->first();
            $history[]=$historys->remarks;
        }

    }
    else if($request->type=="fg_scrap"){

        $history=BasicsHistory::where('product_id', $basics->pro_id)
        ->where('description', 'fg_scrap')
        ->pluck('remarks')
        ->first();

    }else if($request->type=="tax"){

        $history=BasicsHistory::where('product_id', $basics->pro_id)
        ->where('description', 'salesTax')
        ->pluck('remarks')
        ->first();

    }else if($request->type=="freight"){
        $history=PrimaryLocationHistory::where('product_id', $basics->pro_id)
        ->where('description','cost')->groupBy('description')
        ->pluck('remarks')
        ->first();
    
      }else if($request->type=="secfreight"){
        $history=SecondaryLocationHistory::where('product_id', $basics->pro_id)
        ->where('description','cost')->groupBy('description')
        ->pluck('remarks')
        ->first();
    }
    else if($request->type=="damages"){
        //  ['damage',
        if($basics->b_damage_approval ==  2){
            $historys= BasicsHistory::where('product_id', $basics->pro_id)
                        ->where('description','logistic')
                        ->orderBy('created_at', 'desc')
                       ->first();
            $history[]=$historys->remarks;
        }
        if($basics->b_logistic_approval ==  2){
            $historys= BasicsHistory::where('product_id', $basics->pro_id)
            ->where('description','damage')
            ->orderBy('created_at', 'desc')
            ->first();
           $history[]=$historys->remarks;
        }



    }
    else if($request->type=="conv"){
        $history=BasicsHistory::where('product_id', $basics->pro_id)
        ->where('description', 'conv_cost')
        ->orderBy('created_at', 'desc') // Order records by created_at in descending order
        ->pluck('remarks')
        ->first();
    }
    else if($request->type=="scrap"){
        $history=RmCostHistory::where('product_id', $basics->pro_id)->groupBy('remarks')
        ->orderBy('created_at', 'desc') // Order records by created_at in descending order
        ->pluck('remarks')
        ->first();
    }
    else if($request->type=="pmcost"){
        $history= MoqHistory::where('moq_id', $request->id)
        ->orderBy('created_at', 'desc') // Order records by created_at in descending order
        ->pluck('remarks')
        ->first();
    }

    // dd($history);
    return response()->json([
        "data" => $history
    ]);

   }
    public function fetchDivision()
    {
        $data = Division::select('*');
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn  = '<a id="edit_uom" title="edit"  class="edit btn btn-primary btn-sm mr-2" style="margin-right:2px" onclick="edit_form(' . $row->id . ')" ><i class="fas fa-edit"></i></a>';
            // $btn .= '<a class="delete btn btn-danger btn-sm delete_id" title="delete" id="del_id" onclick="open_confirm(' . $row->id . ');" ><i class="fas fa-trash"></i></a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function findDivision(Request $request,$id)
    {
        $data = Division::find($id);
        // dd($data);
        return response()->json([
            "status" => "Division fetched successfully",
            "data" => $data
        ]);
    }
    public function saveDivision(Request $request)
    {
        Division::create(['division' => $request->division_name,'description' => $request->description]);
        return response()->json([
            "status" => "Division saved successfully"
        ]);
    }

    public function deleteDivision(Request $request,$id)
    {
        Division::find($id)->delete();
        return response()->json([
            "status" => "Division deleted successfully"
        ]);
    }

    public function updateDivision(Request $request)
    {
       $id = $request->update_id_name;
       Division::find($id)->update(['division' => $request->edit_division_name,'description' => $request->edit_description]);
        return response()->json([
            "status" => "Division updated successfully"
        ]);
    }

}
