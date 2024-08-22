<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <title>Cost Sheet Automation</title>
    <!-- App favicon -->
    @if($data['stylesandjs'] == "1")

    <link rel="shortcut icon" href="{{ asset('/assets/images/h_logo.png')}}">
    <!-- plugin css -->
    <link href="../assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    @else
    <link rel="shortcut icon" href="../assets/images/h_logo.png">
    <!-- plugin css -->
    <link href="../../assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="../../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="../../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="../../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    @endif

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />

    <style>
        .page-content {
            /* padding: 20px calc(24px / 2) 60px calc(24px / 2); */
            padding: 20px calc(102px / 2) 60px calc(117px / 2);
        }

        .pstyle{
            color: #23c24e;
            font-weight: bold;

        }

        .bold{
            font-weight: bold;
        }

        .icon {
            top: 1px;
        }

        .form-control {
            line-height: 0.1 !important;
            padding: 0.1rem 0.1rem !important;
            border-radius: 0px !important;
            text-align: center !important;
            width: 100px !important;
        }

        .table>:not(caption)>*>* {
            padding: .25rem .25rem .25rem .25rem !important;
        }

        /* .table>:not(caption)>*>* {
            padding: 0.25rem 8rem 0.25rem 7rem !important;
        } */

        td{
            font-size: 13px !important;
            
        }


        .hidden {
            display: none;
        }

    </style>
</head>
<body data-layout="detached" data-topbar="colored">

    <div class="container-fluid">
        <div id="layout-wrapper">
        {{-- @extends('layout.menu') --}}
            @include('layout.navbar')
            <div class="main-content">

                <!-- <h4 style="padding-top:12px;padding-left:62px;" ># Cost Sheet For</h4> -->
                <div class="page-content" style="padding-top: 87px;">
                    <div class="row">
                        <div class="col-8" style="margin-bottom: -14px;">
                            <div class="card">
                                <div class="card-body" style="padding: 0.5rem 1.5rem;">
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-10">

                                            <div class="row">
                                                <span class="col-12" style="font-weight: bold;font-size: 21px;">CavinKare Pvt Ltd </span>
                                            </div>
                                            <div class="row">
                                                <span class="col-12" style="font-weight: bold;font-size: 16px;color: rebeccapurple;"> --Tentative Cost sheet-- </span>
                                            </div>
                                            <div class="row" style="padding-top: 12px;">
                                                <span class="col-4" style="font-weight: bold;">Product Name</span>
                                                <span class="col-1">:</span>
                                                <span class="col-7 pstyle">{{$data['material_name']}}</span>
                                                <input type="hidden" name="material_name" id="material_name" value="{{$data['material_name']}}" >

                                            </div>
                                            <div class="row">
                                                <span class="col-4" style="font-weight: bold;">Type</span>
                                                <span class="col-1">:</span>
                                                <span class="col-7 pstyle">{{$data['type']}}</span>
                                                <input type="hidden" name="sap_type" id="sap_type" value="{{$data['type']}}" >
                                            </div>
                                            <div class="row">
                                                <span class="col-4" style="font-weight: bold;">Plant</span>
                                                <span class="col-1">:</span>
                                                <span class="col-7 pstyle">{{$data['plant']}}</span>
                                                <input type="hidden" name="sap_plant" id="sap_plant" value="{{$data['plant']}}" >
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4" style="padding:10px;">
                            <button type="button" id="epd_export" class="btn btn-primary btn-sm" >Export</a>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <form id="epd_form">
                                            <div class="col-12">
                                                <input type="hidden" name="prmcount" value="{{$data['pcount']}}" >
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-bordered table-striped" id="costsheet_tb" style="width:100%">
                                                        <thead style="background-color: #cdc5c5a3;color: #021644;">
                                                            <tr>
                                                                <!-- <th>Reference No</th> -->
                                                                <th>PARTICULARS</th>
                                                                @foreach ($data['location'] as $k=> $loc)
                                                                <th class="text-center">PER CASE</th>
                                                                @endforeach
                                                                <th class="text-center epdapproved actionextend">ACTION</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="bold">Material code</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td class="text-center">{{$data['basic']->material_code}}
                                                                    <input type="hidden" name="material_code" value="{{$data['basic']->material_code}}" >
                                                                    <input type="hidden" id="epro_id" name="epro_id" value="{{$data['basic']->id}}" >
                                                                    <input type="hidden" name="plant" value="{{$data['plant']}}" >
                                                                    <input type="hidden" id="dist_channel" name="dist_channel" value="{{$data['dist_channel']}}" >

                                                                </td>
                                                                @endforeach
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">Location</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td class="text-center">{{$data['p_loc'][$k]}}
                                                                    <input type="hidden" name="plocation[]" value="{{$data['p_loc'][$k]}}">
                                                                </td>
                                                                @endforeach
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">No. of Pcs / case</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" class="form-control piecespercase getVal" id="pieces_per_case" name="pieces_per_case" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" value="{{$data['basic']->pieces_per_case}}" readonly >
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                                <td class="hidebtn epdapproved"><div style="display: inline-flex;width: 15px;">
                                                                    <button type="button" @if ($data['basic']->noofpcs_approval != 'pending') hidden @endif class="btn btn-primary btn-sm editbtn" onclick="edit_piecespercase(event)" ><i class="bx bx-pencil icon nav-icon"></i></button>
                                                                    <button type="button" @if ($data['basic']->noofpcs_approval == 'approved' ) disabled @elseif($data['basic']->noofpcs_approval != 'pending') hidden @endif attr="pieces_per_case" class="btn btn-success btn-sm approveBtn" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                    <button type="button" @if ($data['basic']->noofpcs_approval == 'rejected' ) disabled @elseif($data['basic']->noofpcs_approval != 'pending') hidden @endif class="btn btn-danger btn-sm rejectBtn" ><i class="bx bx-x icon nav-icon"></i></button></div>
                                                                </td>
                                                                <td class="showRemarkBox hidden" style="width: 15px;">
                                                                    <textarea style="height: 30px;" type="text" class="getRemark" placeholder="enter reason for rejection" name="rejRemark" required></textarea>
                                                                    <div style="display: inline-flex; align-items: baseline;">
                                                                        <button type="button" attr="pieces_per_case" class="btn btn-danger btn-sm rejectedBtn">Reject</button>
                                                                        <button type="button" class="btn btn-secondary btn-sm" onclick="rclose(this)">Cancel</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">MRP per Pcs</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" class="form-control mrppiece getVal" id="mrp_piece" name="mrp_piece" value="{{$data['mrp_piece']}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" readonly >
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                                <!-- <td class="hidebtn epdapproved">
                                                                    <div style="display: inline-flex;width: 15px;">
                                                                        <button type="button" @if ($data['basic']->mrp_pcs_approval != 'pending') hidden @endif class="btn btn-primary btn-sm editbtn" onclick="edit_mrppiece(event)" ><i class="bx bx-pencil icon nav-icon"></i></button>
                                                                        <button type="button" @if ($data['basic']->mrp_pcs_approval == 'approved' ) disabled @elseif($data['basic']->mrp_pcs_approval != 'pending') hidden @endif attr="mrp_piece" class="btn btn-success btn-sm approveBtn" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                        <button type="button" @if ($data['basic']->mrp_pcs_approval == 'rejected' ) disabled @elseif($data['basic']->mrp_pcs_approval != 'pending') hidden @endif class="btn btn-danger btn-sm rejectBtn" ><i class="bx bx-x icon nav-icon"></i></button></div>
                                                                    </div>
                                                                </td> -->
                                                                <!-- <td class="showRemarkBox hidden" style="width: 15px;">
                                                                    <textarea style="height: 30px;" type="text" class="getRemark" placeholder="enter reason for rejection" name="rejRemark" required></textarea>
                                                                    <div style="display: inline-flex; align-items: baseline;">
                                                                        <button type="button" attr="mrp_piece" class="btn btn-danger btn-sm rejectedBtn">Reject</button>
                                                                        <button type="button" class="btn btn-secondary btn-sm" onclick="rclose(this)">Cancel</button>
                                                                    </div>
                                                                </td> -->
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">MRP per case</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" class="form-control mrpPerCase" id="mrp_per_case" name="mrp_per_case" value="{{$data['mrp_per_case']}}" readonly >
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">Fill Volume</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" class="form-control" id="fill_volume" name="fill_volume" value="{{$data['fill_volume']}}" readonly>
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                                <!-- <td>---from SAP ZCKPP02---</td> -->
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">Specific gravity</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" class="form-control specificgrav getVal" id="specific_gravity" name="specific_gravity" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" value="{{$data['basic']->specific_gravity}}" readonly>
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                                <td class="hidebtn epdapproved">
                                                                    <div style="display: inline-flex;">
                                                                        <button type="button" @if ($data['basic']->gravity_approval != 'pending') hidden @endif class="btn btn-primary btn-sm editbtn" onclick="edit_specificgravt(event)" ><i class="bx bx-pencil icon nav-icon"></i></button>
                                                                        <button type="button" @if ($data['basic']->gravity_approval == 'approved' ) disabled @elseif($data['basic']->gravity_approval != 'pending') hidden @endif attr="specific_gravity" class="btn btn-success btn-sm approveBtn" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                        <button type="button" @if ($data['basic']->gravity_approval == 'rejected' ) disabled @elseif($data['basic']->gravity_approval != 'pending') hidden @endif class="btn btn-danger btn-sm rejectBtn" ><i class="bx bx-x icon nav-icon"></i></button></div>
                                                                    </div>
                                                                </td>
                                                                <td class="showRemarkBox hidden" style="width: 15px;">
                                                                    <textarea style="height: 30px;" type="text" class="getRemark" placeholder="enter reason for rejection" name="rejRemark" required></textarea>
                                                                    <div style="display: inline-flex; align-items: baseline;">
                                                                        <button type="button" attr="specific_gravity" class="btn btn-danger btn-sm rejectedBtn">Reject</button>
                                                                        <button type="button" class="btn btn-secondary btn-sm" onclick="rclose(this)">Cancel</button>
                                                                    </div>
                                                                </td>
                                                                <!-- <td class="epdapproved">
                                                                    <div style="display: inline-flex;">
                                                                        <button type="button" class="btn btn-primary btn-sm editbtnhide" onclick="edit_specificgravt(event)" ><i class="bx bx-pencil icon nav-icon"></i></button>
                                                                        <button type="button" class="btn btn-success btn-sm updatebtnhide" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                    </div>
                                                                </td> -->
                                                                <!-- <td>---from SAP ZCKPP02---</td> -->
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">Average Sales Tax (%)</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" attr="{{ $k }}" class="form-control getVal salestax salestax_{{$k}}" id="sales_tax" name="sales_tax" value="{{$data['salesTax']}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" readonly >
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                                <td class="hidebtn epdapproved">
                                                                    <div style="display: inline-flex;">
                                                                        <button type="button" @if ($data['basic']->tax_approval != 'pending') hidden @endif class="btn btn-primary btn-sm editbtn" onclick="edit_salestax(event)" ><i class="bx bx-pencil icon nav-icon"></i></button>
                                                                        <button type="button" @if ($data['basic']->tax_approval == 'approved' ) disabled @elseif($data['basic']->tax_approval != 'pending') hidden @endif attr="salesTax" class="btn btn-success btn-sm approveBtn" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                        <button type="button" @if ($data['basic']->tax_approval == 'rejected' ) disabled @elseif($data['basic']->tax_approval != 'pending') hidden @endif class="btn btn-danger btn-sm rejectBtn" ><i class="bx bx-x icon nav-icon"></i></button></div>
                                                                        
                                                                        <!-- <button type="button" class="btn btn-success btn-sm rsalestax asalestax_btn" onclick="approve_salestax(<?php echo $data['basic']->id ?>)" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                        <button type="button" class="btn btn-danger btn-sm asalestax rsalestax_btn" onclick="reject_salestax(<?php echo $data['basic']->id ?>)" ><i class="bx bx-x icon nav-icon"></i></button> -->
                                                                    </div>
                                                                </td>
                                                                <td class="showRemarkBox hidden" style="width: 15px;">
                                                                    <textarea style="height: 30px;" type="text" class="getRemark" placeholder="enter reason for rejection" name="rejRemark" required></textarea>
                                                                    <div style="display: inline-flex; align-items: baseline;">
                                                                        <button type="button" attr="salesTax" class="btn btn-danger btn-sm rejectedBtn">Reject</button>
                                                                        <button type="button" class="btn btn-secondary btn-sm" onclick="rclose(this)">Cancel</button>
                                                                    </div>
                                                                </td>
                                                                <!-- <td>{{$data['salesTax']}}</td> -->
                                                            </tr>
                                                            <!-- <tr>
                                                                <td class="bold">RF008</td>
                                                                <td class="bold">Excise Duty</td>
                                                                <td>0 %</td>
                                                            </tr> -->
                                                            <tr>
                                                                <td class="bold">Retailers Margin (%)</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" attr="{{ $k }}" class="form-control getVal retailermargin retailmargin_{{ $k }}" id="retailer_margin" name="retailer_margin[]" value="{{$loc->retailer_margin}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" readonly >
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                                <td class="hidebtn epdapproved">
                                                                    <div style="display: inline-flex;">
                                                                        <button type="button" @if ($data['rm_approval'] != null ) hidden @endif class="btn btn-primary btn-sm editbtn" onclick="edit_retailermargin(event)" ><i class="bx bx-pencil icon nav-icon"></i></button>
                                                                        <button type="button" @if ($data['rm_approval'] == '1' ) disabled @elseif($data['rm_approval'] != null ) hidden @endif attr="retailer_margin" class="btn btn-success btn-sm approveBtn" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                        <button type="button" @if ($data['rm_approval'] == '2' ) disabled @elseif($data['rm_approval'] != null ) hidden @endif class="btn btn-danger btn-sm rejectBtn" ><i class="bx bx-x icon nav-icon"></i></button></div>
                                                                       
                                                                        <!-- <button type="button" class="btn btn-success btn-sm rretailer aretailer_btn" onclick="approve_retailermargin(<?php echo $data['basic']->id ?>)" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                        <button type="button" class="btn btn-danger btn-sm aretailer rretailer_btn" onclick="reject_retailermargin(<?php echo $data['basic']->id ?>)" ><i class="bx bx-x icon nav-icon"></i></button> -->
                                                                    </div>
                                                                </td>
                                                                <td class="showRemarkBox hidden" style="width: 15px;">
                                                                    <textarea style="height: 30px;" type="text" class="getRemark" placeholder="enter reason for rejection" name="rejRemark" required></textarea>
                                                                    <div style="display: inline-flex; align-items: baseline;">
                                                                        <button type="button" attr="retailer_margin" class="btn btn-danger btn-sm rejectedBtn">Reject</button>
                                                                        <button type="button" class="btn btn-secondary btn-sm" onclick="rclose(this)">Cancel</button>
                                                                    </div>
                                                                </td>
                                                                <!-- <td>{{$data['basic']->retailer_margin}} %</td> -->
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">Primary Scheme (%)</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" attr="{{ $k }}" class="form-control getVal primaryscheme primscheme_{{$k}}" id="primary_scheme" name="primary_scheme[]" value="{{$loc->primary_scheme}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" readonly>
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                                <td class="hidebtn epdapproved">
                                                                    <div style="display: inline-flex;">
                                                                        <button type="button" @if ($data['ps_approval'] != null ) hidden @endif class="btn btn-primary btn-sm editbtn" onclick="edit_primaryscheme(event)" ><i class="bx bx-pencil icon nav-icon"></i></button>
                                                                        <button type="button" @if ($data['ps_approval'] == '1' ) disabled @elseif($data['ps_approval'] != null ) hidden @endif attr="primary_scheme" class="btn btn-success btn-sm approveBtn" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                        <button type="button" @if ($data['ps_approval'] == '2' ) disabled @elseif($data['ps_approval'] != null ) hidden @endif class="btn btn-danger btn-sm rejectBtn" ><i class="bx bx-x icon nav-icon"></i></button></div>
                                                                       
                                                                        <!-- <button type="button" class="btn btn-success btn-sm rpscheme apscheme_btn" onclick="approve_primaryscheme(<?php echo $data['basic']->id ?>)" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                        <button type="button" class="btn btn-danger btn-sm apscheme rpscheme_btn" onclick="reject_primaryscheme(<?php echo $data['basic']->id ?>)" ><i class="bx bx-x icon nav-icon"></i></button> -->
                                                                    </div>
                                                                </td>
                                                                <td class="showRemarkBox hidden" style="width: 15px;">
                                                                    <textarea style="height: 30px;" type="text" class="getRemark" placeholder="enter reason for rejection" name="rejRemark" required></textarea>
                                                                    <div style="display: inline-flex; align-items: baseline;">
                                                                        <button type="button" attr="primary_scheme" class="btn btn-danger btn-sm rejectedBtn">Reject</button>
                                                                        <button type="button" class="btn btn-secondary btn-sm" onclick="rclose(this)">Cancel</button>
                                                                    </div>
                                                                </td>
                                                                <!-- <td>{{$data['basic']->primary_scheme}} %</td> -->
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">RS Margin (%)</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" attr="{{ $k }}" class="form-control getVal rsmargin rsmargn_{{$k}}" id="rs_margin" name="rs_margin[]" value="{{$loc->rs_margin}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" readonly >
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                                <td class="hidebtn epdapproved">
                                                                    <div style="display: inline-flex;">
                                                                        <button type="button" @if ($data['rsm_approval'] != null ) hidden @endif class="btn btn-primary btn-sm editbtn" onclick="edit_rsmargin(event)" ><i class="bx bx-pencil icon nav-icon"></i></button>
                                                                        <button type="button" @if ($data['rsm_approval'] == '1' ) disabled @elseif($data['rsm_approval'] != null ) hidden @endif attr="rs_margin" class="btn btn-success btn-sm approveBtn" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                        <button type="button" @if ($data['rsm_approval'] == '2' ) disabled @elseif($data['rsm_approval'] != null ) hidden @endif class="btn btn-danger btn-sm rejectBtn" ><i class="bx bx-x icon nav-icon"></i></button></div>
                                                                       
                                                                        <!-- <button type="button" class="btn btn-success btn-sm rrsmargin arsmargin_btn" onclick="approve_rsmargin(<?php echo $data['basic']->id ?>)" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                        <button type="button" class="btn btn-danger btn-sm arsmargin rrsmargin_btn" onclick="reject_rsmargin(<?php echo $data['basic']->id ?>)" ><i class="bx bx-x icon nav-icon"></i></button> -->
                                                                    </div>
                                                                </td>
                                                                <td class="showRemarkBox hidden" style="width: 15px;">
                                                                    <textarea style="height: 30px;" type="text" class="getRemark" placeholder="enter reason for rejection" name="rejRemark" required></textarea>
                                                                    <div style="display: inline-flex; align-items: baseline;">
                                                                        <button type="button" attr="rs_margin" class="btn btn-danger btn-sm rejectedBtn">Reject</button>
                                                                        <button type="button" class="btn btn-secondary btn-sm" onclick="rclose(this)">Cancel</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">Super Margin (%)</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" attr="{{ $k }}" class="form-control getVal ssmargin ssmargn_{{$k}}" id="ss_margin" name="ss_margin[]" value="{{$loc->ss_margin}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" readonly >
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                                <td class="hidebtn epdapproved">
                                                                    <div style="display: inline-flex;">
                                                                        <button type="button" @if ($data['ssm_approval'] != null ) hidden @endif class="btn btn-primary btn-sm editbtn" onclick="edit_ssmargin()" ><i class="bx bx-pencil icon nav-icon"></i></button>
                                                                        <button type="button" @if ($data['ssm_approval'] == '1' ) disabled @elseif($data['ssm_approval'] != null ) hidden @endif attr="ss_margin" class="btn btn-success btn-sm approveBtn" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                        <button type="button" @if ($data['ssm_approval'] == '2' ) disabled @elseif($data['ssm_approval'] != null ) hidden @endif class="btn btn-danger btn-sm rejectBtn" ><i class="bx bx-x icon nav-icon"></i></button></div>
                                                                       
                                                                        <!-- <button type="button" class="btn btn-success btn-sm rssmargin assmargin_btn" onclick="approve_ssmargin(<?php echo $data['basic']->id ?>)" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                        <button type="button" class="btn btn-danger btn-sm assmargin rssmargin_btn" onclick="reject_ssmargin(<?php echo $data['basic']->id ?>)" ><i class="bx bx-x icon nav-icon"></i></button> -->
                                                                    </div>
                                                                </td>
                                                                <td class="showRemarkBox hidden" style="width: 15px;">
                                                                    <textarea style="height: 30px;" type="text" class="getRemark" placeholder="enter reason for rejection" name="rejRemark" required></textarea>
                                                                    <div style="display: inline-flex; align-items: baseline;">
                                                                        <button type="button" attr="ss_margin" class="btn btn-danger btn-sm rejectedBtn">Reject</button>
                                                                        <button type="button" class="btn btn-secondary btn-sm" onclick="rclose(this)">Cancel</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">Landed Cost to Retailer</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" attr="{{ $k }}" title="MRP per case / (1 + Retailers margin %)" class="form-control costToRetailer costToRetailer_{{$k}}" id="cost_to_retailer" name="cost_to_retailer[]" value="{{$data['cost_to_retailer'][$k]}}" readonly>
                                                                    </div>
                                                                    <br>
                                                                    <table style="display:none;width:auto!important;" class="table table-bordered landed_cost_subtable">
                                                                        <tr><!--C9/(1+C15) -->
                                                                            <td>MRP per case</td>
                                                                            <td><input type="text" class="form-control mrpPerCase" id="landed_cost_sublabel1" value="{{$data['mrp_per_case']}}" readonly></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Retailers margin %</td>
                                                                            <td><input type="text" disabled attr="{{ $k }}" class="form-control retailermargin retailmargin_{{ $k }}" id="landed_cost_sublabel2" value="{{$loc->retailer_margin}}"></td>
                                                                            <!-- <td>
                                                                                <button type="button" class="btn btn-success btn-sm rretailer aretailer_btn" onclick="approve_retailermargin(<?php echo $data['basic']->id ?>)" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                                <button type="button" class="btn btn-danger btn-sm aretailer rretailer_btn" onclick="reject_retailermargin(<?php echo $data['basic']->id ?>)" ><i class="bx bx-x icon nav-icon"></i></button>
                                                                            </td> -->
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                @endforeach
                                                                <td class="epdapproved"><a class="btn btn-primary btn-sm" onclick="edit_landedcosttoretailer(event)" ><i class="bx bx-pencil icon nav-icon"></i></a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">Cost after Scheme</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" class="form-control costAfterScheme_{{$k}}" title="Landed Cost to Retailer / (1 + Primary Scheme (%))" id="cost_after_scheme" name="cost_after_scheme[]" value="{{$data['Cost_after_scheme'][$k]}}" readonly>
                                                                    </div><br>
                                                                    <table style="display:none;width:auto!important;" class="table table-bordered cost_scheme_subtable">
                                                                        <tr><!--C19/(1+C16) -->
                                                                            <td>Landed Cost to Retailer</td>
                                                                            <td><input type="text" class="form-control costToRetailer_{{$k}}" id="cost_scheme_sublabel1" value="{{$data['cost_to_retailer'][$k]}}" readonly></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Primary Scheme (%)</td>
                                                                            <td><input type="text" attr="{{ $k }}" disabled class="form-control primaryscheme primscheme_{{$k}}" id="cost_scheme_sublabel2" value="{{$loc->primary_scheme}}"></td>
                                                                            <!-- <td>
                                                                                <button type="button" class="btn btn-success btn-sm rpscheme apscheme_btn" onclick="approve_primaryscheme(<?php echo $data['basic']->id ?>)" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                                <button type="button" class="btn btn-danger btn-sm apscheme rpscheme_btn" onclick="reject_primaryscheme(<?php echo $data['basic']->id ?>)" ><i class="bx bx-x icon nav-icon"></i></button>
                                                                            </td> -->
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                @endforeach
                                                                <td class="epdapproved"><a class="btn btn-primary btn-sm" onclick="edit_costafterscheme(event)" ><i class="bx bx-pencil icon nav-icon"></i></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">Landed Cost to RS</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" class="form-control landedCostRs landedCostRs_{{$k}}" title="Cost after Scheme/ (1 + RS Margin (%))/ (1 + Super Margin (%))" id="landed_cost_to_rs" name="landed_cost_to_rs[]" value="{{$data['Landed_Cost_to_RS'][$k]}}" readonly>
                                                                    </div><br>
                                                                    <table style="display:none;width:auto!important;" class="table table-bordered landed_rscost_subtable">
                                                                        <tr><!--C20/(1+C17)/(1+C18) -->
                                                                            <td>Cost after Scheme</td>
                                                                            <td><input type="text" class="form-control costAfterScheme_{{$k}}" id="landed_rscost_sublabel1" value="{{$data['Cost_after_scheme'][$k]}}" readonly></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>RS Margin (%)</td>
                                                                            <td><input type="text" attr="{{ $k }}" disabled class="form-control rsmargin rsmargn_{{$k}}" id="landed_rscost_sublabel2" value="{{$loc->rs_margin}}"></td>
                                                                            <!-- <td>
                                                                                <button type="button" class="btn btn-success btn-sm rrsmargin arsmargin_btn" onclick="approve_rsmargin(<?php echo $data['basic']->id ?>)" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                                <button type="button" class="btn btn-danger btn-sm arsmargin rrsmargin_btn" onclick="reject_rsmargin(<?php echo $data['basic']->id ?>)" ><i class="bx bx-x icon nav-icon"></i></button>
                                                                            </td> -->
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Super Margin (%)</td>
                                                                            <td><input type="text" attr="{{ $k }}" disabled class="form-control ssmargin ssmargn_{{$k}}" id="landed_rscost_sublabel3" value="{{$loc->ss_margin}}"></td>
                                                                            <!-- <td>
                                                                                <button type="button" class="btn btn-success btn-sm rssmargin assmargin_btn" onclick="approve_ssmargin(<?php echo $data['basic']->id ?>)" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                                <button type="button" class="btn btn-danger btn-sm assmargin rssmargin_btn" onclick="reject_ssmargin(<?php echo $data['basic']->id ?>)" ><i class="bx bx-x icon nav-icon"></i></button>
                                                                            </td> -->
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                @endforeach
                                                                <td class="epdapproved"><a class="btn btn-primary btn-sm" onclick="edit_landedcosttors(event)" ><i class="bx bx-pencil icon nav-icon"></i></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">NR per Case ( before Sec TPR)</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" class="form-control nrPerCaseBefore nrPerCaseBefore_{{$k}}" title="{{$data['nr_percase_title']}}" id="nr_per_case_before" name="nr_per_case_before[]" value="{{$data['nr_per_case_before'][$k]}}" readonly>
                                                                    </div><br>
                                                                    <table style="display:none;width:auto!important;" class="table table-bordered nrpercase_beforetpr_subtable">
                                                                        <tr><!--C9/(1+C15) -->
                                                                            <td>MRP per case</td>
                                                                            <td><input type="text" class="form-control mrpPerCase" id="landed_cost_sublabel1" value="{{$data['mrp_per_case']}}" disabled></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Retailers margin %</td>
                                                                            <td><input type="text" disabled attr="{{ $k }}" class="form-control retailermargin retailmargin_{{ $k }}" id="landed_cost_sublabel2" value="{{$loc->retailer_margin}}"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Primary Scheme (%)</td>
                                                                            <td><input type="text" attr="{{ $k }}" disabled class="form-control primaryscheme primscheme_{{$k}}" id="cost_scheme_sublabel2" value="{{$loc->primary_scheme}}"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>RS Margin (%)</td>
                                                                            <td><input type="text" attr="{{ $k }}" disabled class="form-control rsmargin rsmargn_{{$k}}" id="landed_rscost_sublabel2" value="{{$loc->rs_margin}}"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Super Margin (%)</td>
                                                                            <td><input type="text" attr="{{ $k }}" disabled class="form-control ssmargin ssmargn_{{$k}}" id="landed_rscost_sublabel3" value="{{$loc->ss_margin}}"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Average Sales Tax (%)</td>
                                                                            <td><input type="text" disabled attr="{{ $k }}" class="form-control salestax salestax_{{$k}}" value="{{$data['salesTax']}}"></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                @endforeach
                                                                <td class="epdapproved"><button type="button" class="btn btn-primary btn-sm" onclick="edit_nrpercasebeforetpr(event)" ><i class="bx bx-pencil icon nav-icon"></i></button>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">Scheme ( Sec)</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" class="form-control" id="sec_scheme" name="sec_scheme" value="0" readonly>
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">Net Realisation per Case</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" class="form-control netReliancePCase_{{$k}}" title="NR per Case ( before Sec TPR) - Scheme ( Sec)" id="nr_per_case" name="nr_per_case[]" value="{{$data['nr_per_case'][$k]}}" readonly>
                                                                    </div><br>
                                                                    <table style="display:none;width:auto!important;" class="table table-bordered netreliance_percase_subtable">
                                                                        <tr><!--C22-C23 -->
                                                                            <td>NR per Case ( before Sec TPR)</td>
                                                                            <td><input type="text" class="form-control nrPerCaseBefore_{{$k}}" id="netreliance_percase_sublabel1" value="{{$data['nr_per_case_before'][$k]}}" readonly></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Scheme ( Sec)</td>
                                                                            <td><input type="text" class="form-control" id="netreliance_percase_sublabel2" value="0" readonly></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                @endforeach
                                                                <td class="epdapproved"><a class="btn btn-primary btn-sm" onclick="edit_netreliancepercase(event)" ><i class="bx bx-pencil icon nav-icon"></i></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">RM Cost</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" class="form-control" id="rm_cost" name="rm_cost" value="{{$data['rm_cost']}}" readonly>
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                                <!-- <td>---Sap T-Code ZCKPP02---</td> -->
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">RM Scrap % </td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" class="form-control" id="rm_scrap_cost" name="rm_scrap_cost" value="{{$data['rm_scrap_cost']}}" readonly>
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                                <!-- <td>---Sap T-Code ZCKPP02---</td> -->
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">PM Cost</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" class="form-control" id="pm_cost" name="pm_cost" value="{{$data['pm_cost']}}" readonly>
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                                <!-- <td>---Sap T-Code ZCKPP02---</td> -->
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">PM Scrap %</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" class="form-control" id="pm_scrap_cost" name="pm_scrap_cost" value="{{$data['pm_scrap_cost']}}" readonly>
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                                <!-- <td>---Sap T-Code ZCKPP02---</td> -->
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">Conv. Cost</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" class="form-control" id="conv_cost" name="conv_cost" value="{{$data['conv_cost']}}" readonly>
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                                <!-- <td>---Sap T-Code ZCKPP02---</td> -->
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">Primary freight</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" attr="{{ $k }}" class="form-control getVal primary_freight primfreit_{{$k}}" id="primary_freight" name="primary_freight[]" value="{{$data['primary_freight'][$k]}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" readonly>
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                                <td class="hidebtn epdapproved">
                                                                    <div style="display: inline-flex;">
                                                                        <button type="button" @if ($data['p_cost_approval'] != '0') hidden @endif class="btn btn-primary btn-sm editbtn" onclick="edit_primaryfreight(event)" ><i class="bx bx-pencil icon nav-icon"></i></button>
                                                                        <button type="button" @if ($data['p_cost_approval'] == '1' ) disabled @elseif($data['p_cost_approval'] != '0') hidden @endif attr="primary_freight" class="btn btn-success btn-sm approveBtn" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                        <button type="button" @if ($data['p_cost_approval'] == '2' ) disabled @elseif($data['p_cost_approval'] != '0') hidden @endif class="btn btn-danger btn-sm rejectBtn" ><i class="bx bx-x icon nav-icon"></i></button></div>
                                                                       
                                                                    </div>
                                                                </td>
                                                                <td class="showRemarkBox hidden" style="width: 15px;">
                                                                    <textarea style="height: 30px;" type="text" class="getRemark" placeholder="enter reason for rejection" name="rejRemark" required></textarea>
                                                                    <div style="display: inline-flex; align-items: baseline;">
                                                                        <button type="button" attr="primary_freight" class="btn btn-danger btn-sm rejectedBtn">Reject</button>
                                                                        <button type="button" class="btn btn-secondary btn-sm" onclick="rclose(this)">Cancel</button>
                                                                    </div>
                                                                </td>
                                                                <!-- <td class="epdapproved"><div style="display: inline-flex;"><button type="button" class="btn btn-primary btn-sm aprifright rprifright" onclick="edit_primaryfreight(event)" ><i class="bx bx-pencil icon nav-icon"></i></button>
                                                                    <button type="button" class="btn btn-success btn-sm rprifright appprimfright_btn" onclick="approve_primaryfreight(<?php echo $data['basic']->id ?>)" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                    <button type="button" class="btn btn-danger btn-sm aprifright reprimfright_btn" onclick="reject_primaryfreight(<?php echo $data['basic']->id ?>)" ><i class="bx bx-x icon nav-icon"></i></button></div>
                                                                </td> -->
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">Total Basic Price</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" title="RM Cost + RM Scrap % + PM Cost + PM Scrap % + Conv. Cost + Primary freight" class="form-control totlBscPrs_{{$k}}" id="total_basic_price" name="total_basic_price[]" value="{{$data['Total_Basic_Price'][$k]}}" readonly>
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">GM per case</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" title="NR per Case ( before Sec TPR) - Total Basic Price" class="form-control gmprcase_{{$k}}" id="gm_per_case" name="gm_per_case[]" value="{{$data['gm_per_case'][$k]}}" readonly>
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">GM (%)</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" class="form-control gmPerct_{{$k}}" title="GM per case / NR per Case ( before Sec TPR)" id="gm_percent" name="gm_percent[]" value="{{$data['gm_percent'][$k]}}" readonly>
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">GM per case (Ex-Factory)</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" class="form-control gmPCaseExFactory_{{$k}}" title="GM per case + Primary freight" id="gm_per_case_ex_fact" name="gm_per_case_ex_fact[]" value="{{$data['gm_per_case_ex_fact'][$k]}}" readonly>
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">GM % (Ex-Factory)</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" class="form-control gmExPerct_{{$k}}" title="GM per case (Ex-Factory) / Net Realisation per Case" id="gm_percent_ex_fact" name="gm_percent_ex_fact[]" value="{{$data['gm_percent_ex_fact'][$k]}}" readonly>
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">Secondary Freight</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" attr="{{ $k }}" class="form-control getVal secondaryFreight secFreit_{{$k}}" id="secondary_freight" name="secondary_freight[]" value="{{$data['sfreight'][$k]}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" readonly>
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                                <td class="hidebtn epdapproved">
                                                                    <div style="display: inline-flex;">
                                                                        <button type="button" @if ($data['s_cost_approval'] != '0') hidden @endif class="btn btn-primary btn-sm editbtn" onclick="edit_secfreight(event)" ><i class="bx bx-pencil icon nav-icon"></i></button>
                                                                        <button type="button" @if ($data['s_cost_approval'] == '1' ) disabled @elseif($data['s_cost_approval'] != '0') hidden @endif attr="secondary_freight" class="btn btn-success btn-sm approveBtn" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                        <button type="button" @if ($data['s_cost_approval'] == '2' ) disabled @elseif($data['s_cost_approval'] != '0') hidden @endif class="btn btn-danger btn-sm rejectBtn" ><i class="bx bx-x icon nav-icon"></i></button></div>
                                                                       
                                                                        <!-- <button type="button" class="btn btn-success btn-sm rfreight afrit_btn" onclick="approve_freight(<?php echo $data['basic']->id ?>)" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                        <button type="button" class="btn btn-danger btn-sm afreight rfrit_btn" onclick="reject_freight(<?php echo $data['basic']->id ?>)" ><i class="bx bx-x icon nav-icon"></i></button> -->
                                                                    </div>
                                                                </td>
                                                                <td class="showRemarkBox hidden" style="width: 15px;">
                                                                    <textarea style="height: 30px;" type="text" class="getRemark" placeholder="enter reason for rejection" name="rejRemark" required></textarea>
                                                                    <div style="display: inline-flex; align-items: baseline;">
                                                                        <button type="button" attr="secondary_freight" class="btn btn-danger btn-sm rejectedBtn">Reject</button>
                                                                        <button type="button" class="btn btn-secondary btn-sm" onclick="rclose(this)">Cancel</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td class="bold">Damages (%)</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" attr="{{ $k }}" class="form-control getVal damage damge_{{$k}}" id="damage" name="damage" value="{{$data['basic']->damage}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" readonly>
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                                <td class="hidebtn epdapproved">
                                                                    <div style="display: inline-flex;">
                                                                        <button type="button" @if ($data['basic']->damage_approval != 'pending') hidden @endif class="btn btn-primary btn-sm editbtn" onclick="edit_damages(event)" ><i class="bx bx-pencil icon nav-icon"></i></button>
                                                                        <button type="button" @if ($data['basic']->damage_approval == 'approved' ) disabled @elseif($data['basic']->damage_approval != 'pending') hidden @endif attr="damage" class="btn btn-success btn-sm approveBtn" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                        <button type="button" @if ($data['basic']->damage_approval == 'rejected' ) disabled @elseif($data['basic']->damage_approval != 'pending') hidden @endif class="btn btn-danger btn-sm rejectBtn" ><i class="bx bx-x icon nav-icon"></i></button></div>
                                                                       
                                                                        <!-- <button type="button" class="btn btn-success btn-sm rdamages apdamage_btn" onclick="approve_damages(<?php echo $data['basic']->id ?>)" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                        <button type="button" class="btn btn-danger btn-sm adamages redamage_btn" onclick="reject_damages(<?php echo $data['basic']->id ?>)" ><i class="bx bx-x icon nav-icon"></i></button> -->
                                                                    </div>
                                                                </td>
                                                                <td class="showRemarkBox hidden" style="width: 15px;">
                                                                    <textarea style="height: 30px;" type="text" class="getRemark" placeholder="enter reason for rejection" name="rejRemark" required></textarea>
                                                                    <div style="display: inline-flex; align-items: baseline;">
                                                                        <button type="button" attr="damage" class="btn btn-danger btn-sm rejectedBtn">Reject</button>
                                                                        <button type="button" class="btn btn-secondary btn-sm" onclick="rclose(this)">Cancel</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">Logistics cost (%)</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" attr="{{ $k }}" class="form-control getVal logistic logistc_{{$k}}" id="logistic" name="logistic" value="{{$data['basic']->logistic}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" readonly>
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                                <td class="hidebtn epdapproved">
                                                                    <div style="display: inline-flex;">
                                                                        <button type="button" @if ($data['basic']->logistic_approval != 'pending') hidden @endif class="btn btn-primary btn-sm editbtn" onclick="edit_logisticscost(event)" ><i class="bx bx-pencil icon nav-icon"></i></button>
                                                                        <button type="button" @if ($data['basic']->logistic_approval == 'approved' ) disabled @elseif($data['basic']->logistic_approval != 'pending') hidden @endif attr="logistic" class="btn btn-success btn-sm approveBtn" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                        <button type="button" @if ($data['basic']->logistic_approval == 'rejected' ) disabled @elseif($data['basic']->logistic_approval != 'pending') hidden @endif class="btn btn-danger btn-sm rejectBtn" ><i class="bx bx-x icon nav-icon"></i></button></div>
                                                                       
                                                                        
                                                                        <!-- <button type="button" class="btn btn-success btn-sm rlcost alcost_btn" onclick="approve_logisticcost(<?php echo $data['basic']->id ?>)" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                        <button type="button" class="btn btn-danger btn-sm alcost rlcost_btn" onclick="reject_logisticcost(<?php echo $data['basic']->id ?>)" ><i class="bx bx-x icon nav-icon"></i></button> -->
                                                                    </div>
                                                                </td>
                                                                <td class="showRemarkBox hidden" style="width: 15px;">
                                                                    <textarea style="height: 30px;" type="text" class="getRemark" placeholder="enter reason for rejection" name="rejRemark" required></textarea>
                                                                    <div style="display: inline-flex; align-items: baseline;">
                                                                        <button type="button" attr="logistic" class="btn btn-danger btn-sm rejectedBtn">Reject</button>
                                                                        <button type="button" class="btn btn-secondary btn-sm" onclick="rclose(this)">Cancel</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">Secondary Freight per case %</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                    <td>
                                                                        <div class="d-flex justify-content-center">
                                                                            <input type="text" title="Secondary Freight / Net Realisation per Case" class="form-control secFreitPerCase_{{$k}}" id="freight_case" name="freight_case[]" value="{{$data['freight_case'][$k]}}" readonly>
                                                                        </div><br>
                                                                        <table style="display:none;width:auto!important;" class="table table-bordered freightcase_subtable">
                                                                            <tr>
                                                                                <td>Net Realisation per Case</td>
                                                                                <td><input type="text" class="form-control" id="freightcase_sublabel1" value="{{$data['nr_per_case'][$k]}}" readonly></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Secondary Freight</td>
                                                                                <td><input type="text" attr="{{ $k }}" readonly disabled class="form-control secondaryFreight secFreit_{{$k}}" id="freightcase_sublabel2" value="{{$data['sfreight'][$k]}}" ></td>
                                                                                <!-- <td>
                                                                                    <button type="button" class="btn btn-success btn-sm rfreight afrit_btn" onclick="approve_freight(<?php echo $data['basic']->id ?>)" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                                    <button type="button" class="btn btn-danger btn-sm afreight rfrit_btn" onclick="reject_freight(<?php echo $data['basic']->id ?>)" ><i class="bx bx-x icon nav-icon"></i></button>
                                                                                </td> -->
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                @endforeach
                                                                <td class="epdapproved"><a class="btn btn-primary btn-sm" onclick="edit_freightcase(event)" ><i class="bx bx-pencil icon nav-icon"></i></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">Damages per case</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" class="form-control damgePerCase_{{$k}}" title="Net Realisation per Case * Damages (%)" id="damage_per_case" name="damage_per_case[]" value="{{$data['damage_per_case'][$k]}}" readonly>
                                                                    </div><br>
                                                                    <table style="display:none;width:auto!important;" class="table table-bordered damages_percase_subtable">
                                                                        <tr>
                                                                            <td>Net Realisation per Case</td>
                                                                            <td><input type="text" class="form-control" id="damages_percase_sublabel1" value="{{$data['nr_per_case'][$k]}}" readonly></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Damages (%)</td>
                                                                            <td><input type="text" readonly class="form-control damage" id="damages_percase_sublabel2" value="{{$data['basic']->damage}}" ></td>
                                                                            <!-- <td>
                                                                                <button type="button" class="btn btn-success btn-sm rdamages apdamage_btn" onclick="approve_damages(<?php echo $data['basic']->id ?>)" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                                <button type="button" class="btn btn-danger btn-sm adamages redamage_btn" onclick="reject_damages(<?php echo $data['basic']->id ?>)" ><i class="bx bx-x icon nav-icon"></i></button>
                                                                            </td> -->
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                @endforeach
                                                                <td class="epdapproved"><a class="btn btn-primary btn-sm" onclick="edit_damagespercase(event)" ><i class="bx bx-pencil icon nav-icon"></i></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">Logistics cost per case</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" class="form-control logisPerCase_{{$k}}" title="Net Realisation per Case * Logistic Cost (%)" id="logistics_cost_per_case" name="logistics_cost_per_case[]" value="{{$data['Logistics_cost_per_case'][$k]}}" readonly>
                                                                    </div><br>
                                                                    <table style="display:none;width:auto!important;" class="table table-bordered logisticscost_percase_subtable">
                                                                        <tr>
                                                                            <td>Net Realisation per Case</td>
                                                                            <td><input type="text" class="form-control" id="logisticscost_percase_sublabel1" value="{{$data['nr_per_case'][$k]}}" readonly></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Logistics cost (%)</td>
                                                                            <td><input type="text" readonly class="form-control logistic" id="logisticscost_percase_sublabel2" value="{{$data['basic']->logistic}}" ></td>
                                                                            <!-- <td>
                                                                                <button type="button" class="btn btn-success btn-sm rlcost alcost_btn" onclick="approve_logisticcost(<?php echo $data['basic']->id ?>)" ><i class="bx bx-check icon nav-icon"></i></button>
                                                                                <button type="button" class="btn btn-danger btn-sm alcost rlcost_btn" onclick="reject_logisticcost(<?php echo $data['basic']->id ?>)" ><i class="bx bx-x icon nav-icon"></i></button></td>
                                                                            </tr> -->
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                @endforeach
                                                                <td class="epdapproved"><a class="btn btn-primary btn-sm" onclick="edit_logisticscostpercase(event)" ><i class="bx bx-pencil icon nav-icon"></i></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">Total Variable Cost per case</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" attr="{{ $k }}" title="Secondary Freight per case % + Damages per case + Logistics cost per case" class="form-control totalVarCostPCase_{{$k}}" id="total_variable_cost_per_case" name="total_variable_cost_per_case[]" value="{{$data['Total_Variable_cost_per_case'][$k]}}" readonly>
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">Estd COGS ( Inclusive of Variable cost) per case</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" title="Total Basic Price + Total Variable Cost per case" class="form-control estdCogs_{{$k}}" id="cogs" name="cogs[]" value="{{$data['cogs'][$k]}}" readonly>
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">NR per Case</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" title="Net Realisation per Case" class="form-control nRPCase_{{$k}}" id="nr_per_case2" name="nr_per_case2[]" value="{{$data['nr_per_case'][$k]}}" readonly>
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">COGS per case</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" title="Total Basic Price + Total Variable Cost per case" class="form-control cogsPCase_{{$k}}" id="cogs2" name="cogs2[]" value="{{$data['cogs'][$k]}}" readonly>
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">Estimated NM Per Case</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" title="NR per Case - COGS per case" class="form-control estimatedNmPerCase_{{$k}}" id="estimated_nm_per_case" name="estimated_nm_per_case[]" value="{{$data['Estimated_NM_per_case'][$k]}}" readonly>
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">Estimated NM (%)</td>
                                                                @foreach ($data['location'] as $k => $loc)
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <input type="text" title="(Estimated NM Per Case / NR per Case)* 100" class="form-control estimatedNmPert_{{$k}}" id="estimated_nm_percent" name="estimated_nm_percent[]" value="{{$data['Estimated_NM_percent'][$k]}}" readonly>
                                                                    </div>
                                                                </td>
                                                                @endforeach
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="row">
                                                    @if(auth()->user()->role=="Finance")
                                                    <div class="col-md-6">
                                                        <!-- <a href="/epd_cs_approve_mt" class="mtappshow btn btn-info btn-md" style="margin-right:1px"> << Go Back</a> -->
                                                        <!-- <a href="/epd_costsheet_approval" class="finshow btn btn-primary btn-md" style="margin-right:1px"> << Go Back</a> -->
                                                        <!-- <button type="button" id="go_back" name="go_back" class="btn btn-md btn-primary" > >> Go Back</button> -->
                                                        @if($data['basic']->excsheet_approval == 'pending')
                                                        <button type="button" onclick="sheet_approve(<?php echo $data['basic']->id ?>)" class="btn btn-md btn-success sheet_approve" ><i class="bx bx-check icon nav-icon"></i>Approve</button>
                                                        <button type="button" onclick="sheet_reject(<?php echo $data['basic']->id ?>)" class="btn btn-md btn-danger " ><i class="bx bx-x icon nav-icon"></i>Reject</button>
                                                        <span id="success_message"></span>
                                                        @endif

                                                    </div>
                                                    @endif

                                                    @if(auth()->user()->role=="Marketing")
                                                    <div class="col-md-6">
                                                        <a href="{{ route('epd_cost_sheet') }}" class="btn btn-primary btn-md" style="margin-right:1px"> << Go Back</a>
                                                        <!-- <button type="button" id="go_back" name="go_back" class="btn btn-md btn-primary" > >> Go Back</button> -->
                                                        @if($data['basic']->mt_exsheet_approval == 'pending')
                                                        <button type="button" onclick="sheet_mt_approve(<?php echo $data['basic']->id ?>)" class="btn btn-md btn-success" ><i class="bx bx-check icon nav-icon"></i>Approve</button>
                                                        <button type="button" onclick="sheet_mt_reject(<?php echo $data['basic']->id ?>)" class="btn btn-md btn-danger" ><i class="bx bx-x icon nav-icon"></i>Reject</button>
                                                        <span id="success_message"></span>
                                                        @endif

                                                    </div>
                                                    @endif

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page-content -->
    </div>
    <!-- end container-fluid -->

    <!-- JAVASCRIPT -->
    @if($data['stylesandjs'] == "1")
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/metismenujs/metismenujs.min.js"></script>
    <script src="../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../assets/libs/eva-icons/eva.min.js"></script>
    <!-- Vector map-->
    <script src="../assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="../assets/libs/jsvectormap/maps/world-merc.js"></script>
    <script src="../assets/js/pages/dashboard.init.js"></script>
    <script src="../assets/js/app.js"></script>
    @else
    <script src="../../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/libs/metismenujs/metismenujs.min.js"></script>
    <script src="../../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../../assets/libs/eva-icons/eva.min.js"></script>
    <!-- Vector map-->
    <script src="../../assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="../../assets/libs/jsvectormap/maps/world-merc.js"></script>
    <script src="../../assets/js/pages/dashboard.init.js"></script>
    <script src="../../assets/js/app.js"></script>
    @endif

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){
            // Initially hide the check button
            $('.updatebtnhide').hide();
            
            $('.editbtnhide').click(function(){
                $('.editbtnhide').hide(); 
                $('.updatebtnhide').toggle();
                $('#specific_gravity').attr("readonly", false);

            });
            $('.updatebtnhide').click(function(){
                $('.editbtnhide').toggle();
                $('.updatebtnhide').hide();
                $('#specific_gravity').attr("readonly", true);

                var spg = $('#specific_gravity').val();
                var id = $("#epro_id").val();
                $.ajax({
                    url: "{{url('update_specific_gravity')}}",
                    type: "post",
                    data: {
                        'id': id,
                        'spg':spg
                    },
                    success: function(data) {
                        if (data.code == 200) {
                            toastr.success(data.message);
                        }
                    }
                });

            });
        });

    </script>
    <script>

        $(document).ready(function() {
            $('.sheet_approve').prop('disabled',true);
            overAllApproveBtn();
        });

        function overAllApproveBtn(){
            var basic = {!! json_encode($data['basic']) !!};
            var freight_approval = {!! json_encode($data['p_cost_approval']) !!};
            var rm_approval = {!! json_encode($data['rm_approval']) !!};
            var ps_approval = {!! json_encode($data['ps_approval']) !!};
            var rsm_approval = {!! json_encode($data['rsm_approval']) !!};
            var ssm_approval = {!! json_encode($data['ssm_approval']) !!};

            if(basic['excsheet_approval'] == "approved" || basic['excsheet_approval'] == "rejected"){
                $('.epdapproved').css('display', 'none');
            }

            if(basic['noofpcs_approval'] == "approved" && basic['tax_approval'] == "approved" && basic['damage_approval'] == "approved" && basic['logistic_approval'] == "approved" && freight_approval == '1' && rm_approval == '1' && ps_approval == '1' && rsm_approval == '1' && ssm_approval == '1'){
                $('.sheet_approve').prop('disabled',false);
            }else{
                $('.sheet_approve').prop('disabled',true);
            }
        }

        // function openmodel() {
        //     $.ajax({
        //         url: '{{url("export")}}',
        //     });
        // }

        function sheet_approve(id){
            var type = $('#sap_type').val();
            var material_name = $('#material_name').val();
            var fill_volume = $('#fill_volume').val();
            var sap_plant = $('#sap_plant').val();
            var rmcost = $('#rm_cost').val();
            var rmscrap = $('#rm_scrap_cost').val();
            var pmcost = $('#pm_cost').val();
            var pmscrap = $('#pm_scrap_cost').val();
            var convcost = $('#conv_cost').val();
            var mrp = $('#mrp_per_case').val();
            var mrppiece = $('#mrp_piece').val();

            $.ajax({
                url: "{{url('approve_epdsheet')}}",
                type: "post",
                data: {
                    'id': id,'sap_plant': sap_plant,'type':type,'rmcost':rmcost,'rmscrap':rmscrap,'pmcost':pmcost,'pmscrap':pmscrap,'convcost':convcost,'mrp':mrp,'mrppiece':mrppiece,'material_name':material_name,'fill_volume':fill_volume
                },
                success: function(data) {
                    $('#success_message').css('color','green');
                    $('#success_message').html('---/ Approved Successfully /---');
                    setTimeout(function(){
                        window.location.href="{{ route('epd_costsheet_approval') }}";
                    },2000)
                }
            });
        }

        function sheet_reject(id){
            var type = $('#sap_type').val();
            var sap_plant = $('#sap_plant').val();
            var material_name = $('#material_name').val();
            var fill_volume = $('#fill_volume').val();
            var rmcost = $('#rm_cost').val();
            var rmscrap = $('#rm_scrap_cost').val();
            var pmcost = $('#pm_cost').val();
            var pmscrap = $('#pm_scrap_cost').val();
            var convcost = $('#conv_cost').val();
            var mrp = $('#mrp_per_case').val();
            var mrppiece = $('#mrp_piece').val();


            $.ajax({
                url: "{{url('reject_epdsheet')}}",
                type: "post",
                data: {
                    'id': id,'sap_plant': sap_plant,'type':type,'rmcost':rmcost,'rmscrap':rmscrap,'pmcost':pmcost,'pmscrap':pmscrap,'convcost':convcost,'mrp':mrp,'mrppiece':mrppiece,'material_name':material_name,'fill_volume':fill_volume
                },
                success: function(data) {
                    $('#success_message').css('color','red');
                    $('#success_message').html('---/ Rejected Successfully /---');
                    setTimeout(function(){
                        window.location.href="{{ route('epd_costsheet_approval') }}";
                    },2000)
                }
            });
        }


        function sheet_mt_approve(id){
            $.ajax({
                url: "{{url('approve_mt_epdsheet')}}",
                type: "post",
                data: {
                    'id': id
                },
                success: function(data) {
                    $('#success_message').css('color','green');
                    $('#success_message').html('---/ Approved Successfully /---');
                    setTimeout(function(){
                        window.location.href="{{ route('epd_cost_sheet') }}";
                    },2000)
                }
            });
        }

        function sheet_mt_reject(id){
            $.ajax({
                url: "{{url('reject_mt_epdsheet')}}",
                type: "post",
                data: {
                    'id': id
                },
                success: function(data) {
                    $('#success_message').css('color','red');
                    $('#success_message').html('---/ Rejected Successfully /---');
                    setTimeout(function(){
                        window.location.href="{{ route('epd_cost_sheet') }}";
                    },2000)
                }
            });
        }

        function edit_piecespercase(){
            $('#pieces_per_case').attr("readonly", false);
        }
        // function edit_mrppiece(){
        //     $('#mrp_piece').attr("readonly", false);
        // }
        function edit_salestax(){
            $('#sales_tax').attr("readonly", false);
        }
        function edit_specificgravt(){
            $('#specific_gravity').attr("readonly", false);
        }
        function edit_retailermargin(){
            $('.retailermargin').attr("readonly", false);
        }
        function edit_primaryscheme(){
            $('.primaryscheme').attr("readonly", false);
        }
        function edit_rsmargin(){
            $('.rsmargin').attr("readonly", false);
        }
        function edit_ssmargin(){
            $('.ssmargin').attr("readonly", false);
        }
        function edit_secfreight(){
            $('.secondaryFreight').attr("readonly", false);
        }
        function edit_damages(){
            $('#damage').attr("readonly", false);
        }
        function edit_logisticscost(){
            $('#logistic').attr("readonly", false);
        }
        function edit_primaryfreight(){
            $('.primary_freight').attr("readonly", false);
        }
        function edit_landedcosttoretailer(){
            $('.landed_cost_subtable').toggle();
        }
        function edit_costafterscheme(){
            $('.cost_scheme_subtable').toggle();
        }
        function edit_landedcosttors(){
            $('.landed_rscost_subtable').toggle();
        }
        function edit_nrpercasebeforetpr() {
            $('.nrpercase_beforetpr_subtable').toggle();
        }

        function edit_netreliancepercase(){
            $('.netreliance_percase_subtable').toggle();
        }

        function edit_freightcase(){
            $('.freightcase_subtable').toggle();
        }
        function edit_damagespercase(){
            $('.damages_percase_subtable').toggle();
        }
        function edit_logisticscostpercase(){
            $('.logisticscost_percase_subtable').toggle();
        }

        //excel download update 17-11-2023
        $('#epd_export').click(function(){
            $.ajax({
                url:"{{url('exportepdcs')}}" ,
                type: "post",
                data: $('#epd_form').serialize(),
                xhrFields: {
                    responseType: 'blob'
                },
                //    dataType: 'json',

                // responseType: 'arraybuffer', // Set the response type to arraybuffer
                success: function(response) {
                    const blob = new Blob([response], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
                    const link = document.createElement('a');
                    link.href = URL.createObjectURL(blob);
                    link.download = 'EPD Cost Sheet.xlsx';
                    link.click();
                }
            })
        })


        //new input flow 07-11-2023
        $(document).on("keyup", ".piecespercase", function() {
            var picePerCase = $(".piecespercase").val($(this).val());
            var value = $(this).val();
            var mrpPiece = $(".mrppiece").val();

            var mrpPerCase = value * mrpPiece;
            $('.mrpPerCase').val(mrpPerCase);
            var pcount = {!! json_encode($data['pcount']) !!};
            for(var i=0; i< pcount; i++){
                costToRetal(i);
            }
        })

        $(document).on("keyup", ".specificgrav", function() {
            var specific_gravity = $(".specificgrav").val($(this).val());
        })

        // $(document).on("keyup",".mrppiece", function(){
        //     $(".mrppiece").val($(this).val());
        // })

        $(document).on("keyup", ".retailermargin", function() {
            var val = $(this).attr('attr');
            var retailmargin_ =  $(".retailmargin_" + val).val($(this).val());
            var value = $(this).val();
            costToRetal(val);
        })

        function costToRetal(val){
            var retailmargin_ =  $(".retailmargin_" + val).val();
            var mrpPerCase_val = $('.mrpPerCase').val();
             var dist_channel = $("#dist_channel").val();
             if(dist_channel == "GT"){
            var landedCostToRetailer = (mrpPerCase_val / (1 + (retailmargin_ / 100) )).toFixed(2);
             }else{
                var landedCostToRetailer = (mrpPerCase_val * (1 - (retailmargin_ / 100) )).toFixed(2);
             }
            $(".costToRetailer_" + val).val(landedCostToRetailer);
            costAftSchem(val);
            landedCostToRS(val);
            nrPrCaseBfore(val);
            netReliancePerCase(val);
        }

        $(document).on("keyup", ".primaryscheme", function() {
            var val = $(this).attr('attr');
            var pmscheme =  $(".primscheme_" + val).val($(this).val());
            // $(".primscheme_" + val).val(pmscheme.toFixed(2));
            costAftSchem(val);
            landedCostToRS(val);
            nrPrCaseBfore(val);
        })

        function costAftSchem(val){
            var pmscheme =  $(".primscheme_" + val).val();
            var costToRetailer = $('.costToRetailer_' + val).val();
            var costAfterScheme = (costToRetailer / (1 + (pmscheme / 100) )).toFixed(2);
            $(".costAfterScheme_" + val).val(costAfterScheme);
        }

        $(document).on("keyup", ".rsmargin", function() {
            var val = $(this).attr('attr');
            var rsmargn =  $(".rsmargn_" + val).val($(this).val());
            // $(".rsmargn_" + val).val(rsmargn.toFixed(2));
            landedCostToRS(val);
            nrPrCaseBfore(val);
        })

        $(document).on("keyup", ".ssmargin", function() {
            var val = $(this).attr('attr');
            var ssmargn =  $(".ssmargn_" + val).val($(this).val());
            // $(".ssmargn_" + val).val(ssmargn.toFixed(2));
            landedCostToRS(val);
            nrPrCaseBfore(val);
        })

        function landedCostToRS(val){
            var cAfterScheme = $(".costAfterScheme_" + val).val();
            var rsmrgn = $(".rsmargn_" + val).val();
            var ssmrgn = $(".ssmargn_" + val).val();
            var lCostToRS = (cAfterScheme / (1 + (rsmrgn / 100)) / (1 + (ssmrgn / 100)) ).toFixed(2);
            $(".landedCostRs_" + val).val(lCostToRS);
            // nrPrCaseBfore(val);
        }

        function netReliancePerCase(val){
            var nr_per_case_before_trp = $('.nrPerCaseBefore_' + val).val();
            var sec_scheme = $('#sec_scheme').val();
            var net_nr_per_case = nr_per_case_before_trp - sec_scheme;
            $(".netReliancePCase_" + val).val(net_nr_per_case);
            $(".nRPCase_" + val).val(net_nr_per_case);
            estimatedNMPerCase(val);
            primaryFreit(val);
            secondFreit(val);
            damgePCase(val);
            logisPerCase(val);
        }

        function secondFreit(val){
            var netRelianCase_ = $(".netReliancePCase_" + val).val();
            var secFret = $('.secFreit_'+ val).val();
            var freitpCase = (secFret / netRelianCase_).toFixed(3);
            // var freitpCase = (netRelianCase_ * (secFret/100)).toFixed(2);
            $('.secFreitPerCase_'+ val).val(freitpCase * 100);
            calTotalVarCostPCase(val);  
        }

        $(document).on("keyup", ".primary_freight", function() {
            var val = $(this).attr('attr');
            var priFreight =  $(".primfreit_" + val).val($(this).val());
            // $(".ssmargn_" + val).val(ssmargn.toFixed(2));
            primaryFreit(val)
        })

        function primaryFreit(val){
            var prmfret = $('.primfreit_'+ val).val();
            $('.primfreit_'+ val).val(prmfret);
            totalBasicPrice(val);
        }

        function totalBasicPrice(val){
            var prmfret = $('.primfreit_'+ val).val();
            var convCst = $('#conv_cost').val();
            var pmScrapCst = $('#pm_scrap_cost').val();
            var pmCst = $('#pm_cost').val();
            var rmScrapCst = $('#rm_scrap_cost').val();
            var rmCst = $('#rm_cost').val();
            var totlprice = ((+prmfret) + (+convCst) + (+pmScrapCst) + (+pmCst) + (+rmScrapCst) + (+rmCst)).toFixed(2);
            $('.totlBscPrs_'+val).val(totlprice);
            gmPerCase(val);
            estdCogs_(val);
        }

        function gmPerCase(val){
            var nr_pcase_before_trp = $('.nrPerCaseBefore_' + val).val();
            var totlBscPris_ = $('.totlBscPrs_'+val).val();
            var gmpcase = (nr_pcase_before_trp - totlBscPris_ ).toFixed(2);
            $('.gmprcase_'+ val).val(gmpcase);
            gmPercentage(val);
            gmExFactory(val);
        }

        function gmPercentage(val){
            var gmprcase = $('.gmprcase_'+ val).val();
            var nr_pcase_before_trp = $('.nrPerCaseBefore_' + val).val();
            var gmPerctag_ = ((gmprcase / nr_pcase_before_trp)*100).toFixed(2);
            // var gmPerctag_= (gmprcase / nr_pcase_before_trp).toFixed(2);
            $('.gmPerct_'+val).val(gmPerctag_);
        }

        function gmExFactory(val){
            var gmprcase = $('.gmprcase_'+ val).val();
            var prmfret = $('.primfreit_'+ val).val();
            var gmexfat = ((+gmprcase) + (+prmfret)).toFixed(2);
            $('.gmPCaseExFactory_'+val).val(gmexfat);
            gmExPercent(val);
        }

        function gmExPercent(val){
            var gmprcxFact = $('.gmPCaseExFactory_'+ val).val();
            var netRelianCase_ = $(".netReliancePCase_" + val).val();
            var gmExPerctag_= ((gmprcxFact / netRelianCase_)*100).toFixed(2);
            $('.gmExPerct_'+val).val(gmExPerctag_);
        }

        $(document).on("keyup",".salestax", function(){
            var val = $(this).attr('attr');
            $(".salestax").val($(this).val());

            var pcount = {!! json_encode($data['pcount']) !!};
            for(var i=0; i< pcount; i++){
                nrPrCaseBfore(i);
                netReliancePerCase(i);
            }
            // estimatednmpercase();
        });

        function nrPrCaseBfore(i){
            var mrppercase = $(".mrpPerCase").val();
            var stax = $(".salestax_"+i).val();
            var retmargin = $(".retailmargin_"+i).val();
            var prscheme = $(".primscheme_"+i).val();
            var rsmargin = $(".rsmargn_"+i).val();
            var ssmargin = $(".ssmargn_"+i).val();
            var dist_channel = $("#dist_channel").val();

            //convert percentage and add plus 1
            var retmargin1 = 1 + (retmargin / 100);
            var prscheme1 = 1 + (prscheme / 100);
            var rsmargin1 = 1 + (rsmargin / 100);
            var ssmargin1 = 1 + (ssmargin / 100);
            var stax1 = 1 + (stax / 100);
             var costRetail = $(".costToRetailer_" + i).val();

            // if(dist_channel == "GT"){
                // NR Per Case = a/ (1+b %)( 1+c %)/(1+d%)/(1+e%)/(1+f%) – If Markup 
                 // A -MRP 
                // B -Retailer Margin 
                // C -Primary Scheme 
                // D -RS Margin 
                // E -SS Margin 
                // F -Tax 

                var nrpercasebefore = (costRetail / stax1 ).toFixed(2);
            // }else{
            //     // NR Per Case = (a-(a*b%))/(1+c%)/(1+d%)/(1+e%)/(1+f%) – If Markdown 

            //     var nrpercasebefore = ( (mrppercase - (mrppercase * retmargin1) )/prscheme1 / rsmargin1 / ssmargin1 / stax1 ).toFixed(2);
            //     // var nrpercasebefore = (landed_cost_to_rs / (1 + (stax / 100) )).toFixed(2);
            // }

            // var landed_cost_to_rs =  $(".landedCostRs_" + i).val();
            $(".nrPerCaseBefore_"+i).val(nrpercasebefore);
            netReliancePerCase(i);
        }
        
        $(document).on("keyup",".damage", function(){
            $(".damage").val($(this).val());
            
            var pcount = {!! json_encode($data['pcount']) !!};
            for(var i=0; i< pcount; i++){
                damgePCase(i);
            }
        })

        function damgePCase(i){
            var damg = $(".damge_"+i).val();
            var netRelianCase_ = $(".netReliancePCase_" + i).val();
            var dPercent = (netRelianCase_ * (damg/100)).toFixed(2);
            $(".damgePerCase_"+i).val(dPercent);
            calTotalVarCostPCase(i);
        }

        
        $(document).on("keyup",".logistic", function(){
            $(".logistic").val($(this).val());

            var pcount = {!! json_encode($data['pcount']) !!};
            for(var i=0; i< pcount; i++){
                logisPerCase(i);
            }
        })

        function logisPerCase(i){
            var logis = $(".logistc_"+i).val();
            var netRelianCase_ = $(".netReliancePCase_" + i).val();
            var logPCase = (netRelianCase_ * (logis/100)).toFixed(2);
            $(".logisPerCase_"+i).val(logPCase);
            calTotalVarCostPCase(i);
        }
        
        $(document).on("keyup", ".secondaryFreight", function() {
            var val = $(this).attr('attr');
            var secFreight =  $(".secFreit_" + val).val($(this).val());
            // $(".ssmargn_" + val).val(ssmargn.toFixed(2));
            secondFreit(val);
        })

        function calTotalVarCostPCase(val){
            var freitPCase_ = $('.secFreitPerCase_'+ val).val();
            var dPerCase = $(".damgePerCase_"+ val).val();
            var logPCase = $(".logisPerCase_"+ val).val();
            var totlVariCost = ((+freitPCase_) + (+dPerCase) + (+logPCase)).toFixed(2);
            $('.totalVarCostPCase_'+ val).val(totlVariCost);
            estdCogs_(val);
        }

        function estdCogs_(val){
            var totalBacPris = $('.totlBscPrs_'+val).val();
            var totalVariableCst = $('.totalVarCostPCase_'+ val).val();
            var estCog = ((+totalBacPris) + (+totalVariableCst)).toFixed(2);
            $('.estdCogs_'+ val).val(estCog);
            $('.cogsPCase_'+ val).val(estCog);
            estimatedNMPerCase(val);
        }

        function estimatedNMPerCase(val){
            var nrperCase = $(".nRPCase_" + val).val();
            var cogsperCase = $('.cogsPCase_'+ val).val();
            var estimatNMPerCase = (nrperCase - cogsperCase).toFixed(2);
            $('.estimatedNmPerCase_'+ val).val(estimatNMPerCase);
            estimatedNmPercent(val);

        }

        function estimatedNmPercent(val){
            var nrperCase = $(".nRPCase_" + val).val();
            var estimNmPerCase_ = $('.estimatedNmPerCase_'+ val).val();
            var estimatNMPerct = ((estimNmPerCase_ / nrperCase)*100).toFixed(2);
            $('.estimatedNmPert_'+ val).val(estimatNMPerct);
        }

        $(document).on('click','.approveBtn',function(){
            var value = $(this).closest('tr').find(".getVal").val();
            var colum = $(this).attr('attr');
            var remarks = '';
            epdCostSheetApproval("approved", colum, value, remarks);

            $(this).closest('tr').find(".rejectBtn").remove();
            $(this).closest('tr').find(".approveBtn").attr('disabled', true);
            $(this).closest('tr').find(".editbtn").remove();
            $(this).closest('tr').find(".getVal").attr('readonly', true);

        })

        $(document).on('click','.rejectBtn',function(){
            $(this).closest('tr').find(".showRemarkBox").toggleClass('hidden');

            var showRemarkBox = $(this).closest('tr').find(".showRemarkBox");
            if (showRemarkBox.hasClass('hidden')) {
                // $(this).closest('tr').find(".approveBtn").removeAttr('hidden');
                // $(this).closest('tr').find(".editbtn").removeAttr('hidden');
                $(this).closest('tr').find(".hidebtn").removeAttr('hidden');
            } else {
                $(this).closest('tr').find(".hidebtn").attr('hidden', 'hidden');
                // $(this).closest('tr').find(".editbtn").attr('hidden', 'hidden');
            }
        })
        // $('.actionextend').attr('colspan','2');

        function rclose(element){
            $(element).closest('tr').find(".hidebtn").removeAttr('hidden');
            $(element).closest('tr').find(".showRemarkBox").toggleClass('hidden');
        }

        $(document).on('click','.rejectedBtn',function(){
            $(this).closest('tr').find(".hidebtn").removeAttr('hidden');
            $(this).closest('tr').find(".showRemarkBox").toggleClass('hidden');
            
            var colum = $(this).attr('attr');
            if(colum == 'primary_freight' || colum == 'secondary_freight' || colum == 'retailer_margin' || colum == 'primary_scheme' || colum == 'rs_margin' || colum == 'ss_margin'){
                var value = $(this).closest('tr').find(".getVal").map(function() {
                    return $(this).val();
                }).get();
            }else{
                var value = $(this).closest('tr').find(".getVal").val();
            }
            var remarks = $(this).closest('tr').find(".getRemark").val();

            epdCostSheetApproval("rejected", colum, value, remarks);

            $(this).closest('tr').find(".approveBtn").attr('hidden', 'hidden');
            $(this).closest('tr').find(".rejectBtn").attr('disabled', true);
            $(this).closest('tr').find(".getVal").attr('readonly', true);
            $(this).closest('tr').find(".editbtn").attr('hidden', 'hidden');

        })

        function epdCostSheetApproval(type, colum, value, remarks){
            var id = $("#epro_id").val();
            $.ajax({
                url: "{{url('approve_epd_svalue')}}",
                type: "post",
                data: {
                    id: id,
                    type: type,
                    colum: colum,
                    value: value,
                    remarks: remarks
                },
                success: function(data) {
                    if (data.code == 200) {
                        toastr.success(data.message);
                    }
                    approve_btn_enable(id);
                }
            });
        }


        function approve_btn_enable(id){
            $.ajax({
                url: "{{url('get_approval_details')}}",
                type: "get",
                data: {
                    'id': id
                },
                success: function(data) {

                    if(data.result.existing.noofpcs_approval == "approved" && data.result.existing.tax_approval == "approved" && data.result.existing.damage_approval == "approved" && data.result.existing.logistic_approval == "approved" && data.result.location.retail_margin_approval == "1" && data.result.location.prim_scheme_approval == "1" && data.result.location.rsm_approval == "1" && data.result.location.ssmargin_approval == "1" && data.result.location.p_cost_approval == "1" ){
                        $('.sheet_approve').prop('disabled',false);
                    }
                }
            });
        }

      

    </script>

</body>

</html>
