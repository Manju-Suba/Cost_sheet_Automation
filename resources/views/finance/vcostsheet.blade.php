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
    <link rel="shortcut icon" href="../../assets/images/h_logo.png">
    <!-- plugin css -->
    <link href="../../assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="../../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="../../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="../../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- datatable -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <style>
        button:disabled {
            cursor: not-allowed;
            pointer-events: all !important;
        }

        .swal2-x-mark {
            display: inline !important;
            justify-content: flex-end !important;
        }

        .swal-wide {
            width: 550px;
        }

        .form-control {
            padding: 0.1rem 0.1rem !important;
            color: black !important;
            border-radius: 0px !important;
            text-align: center !important;
            width: 100px !important;

        }

        td {
            color: black !important;
        }

        .table>:not(caption)>*>* {
            padding: .25rem .25rem .25rem .25rem !important;

        }

        .swal2-icon {
            /* margin:; */
            width: 2em !important;
            height: 2em !important;
            margin: 0px 0px 0px 0px !important;
            border: none !important;
        }

        fieldset {
            border: 1px solid gray;
        }

        .select2-selection__choice__remove {
            border: none;
        }

        .select2-search__field {
            width: 100% !important;
            border: 1px solid #ced4da !important;
            border-radius: 0px;
            display: none;
        }

        .select2-container--open {
            z-index: 10000;
            width: 100% !important;
        }

        .select2 {
            width: 30% !important;
        }

        [readonly] {
            background-color: #b7bdb7 !important;
        }

        .table-container {
            height: 500px;
            /* Set the height of the scrollable area */
            overflow: auto;
            /* Enable vertical scrolling */
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }


        td {
            padding: 8px;
            text-align: left;
        }

        th {
            padding: 8px;
            text-align: center;
        }

        .fixed-header {
            position: sticky;
            top: 0;
            background-color: #dad3d3;
            z-index: 1;
            /* Ensure header is above the body */
        }
    </style>

</head>

<body data-layout="detached" data-topbar="colored">

    <div class="container-fluid">
        <!-- Begin page -->
        <div id="layout-wrapper">

            {{-- @extends('layout.menu') --}}
            @include('layout.navbar')

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    <div class="page-title-box align-self-center d-none d-md-block">
                        <h4 class="page-title mb-0">View NPD CostSheet</h4>
                    </div>
                    <form id="npd_exports" action="{{ url('exporttempdetails') }}" method="GET">
                        <div class="row">
                            <div class="col-8" hidden>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-1"></div>
                                            <div class="col-10">
                                                <div class="row">
                                                    <span class="col-3" style="font-weight: bold;">Product Name</span>
                                                    <span class="col-1">:</span>
                                                    <span class="col-4 pstyle">{{ $data['basic']->Product_name }}</span>
                                                </div>
                                                <div class="row">
                                                    <span class="col-3" style="font-weight: bold;">Launch Qty</span>
                                                    <span class="col-1">:</span>
                                                    <span class="col-4 pstyle">{{ $data['basic']->quantity }}</span>
                                                </div>
                                                <div class="row">
                                                    <span class="col-3" style="font-weight: bold;">Location</span>
                                                    <span class="col-1">:</span>
                                                    <span
                                                        class="col-4 pstyle">{{ $data['basic']->from_location }}</span>
                                                </div>
                                                <div class="row">
                                                    <span class="col-3" style="font-weight: bold;">Specific
                                                        Gravity</span>
                                                    <span class="col-1">:</span>
                                                    <span
                                                        class="col-4 pstyle">{{ $data['basic']->specific_gravity }}</span>
                                                </div>
                                                <div class="row">
                                                    <span class="col-3" style="font-weight: bold;">
                                                        <pre>Fill Volume
                                                            (ml or grams)</pre>
                                                    </span>
                                                    <span class="col-1">:</span>
                                                    <span class="col-4 pstyle">{{ $data['basic']->Volume }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-10"></div>
                            <div class="col-2  mb-2">
                                {{-- <a href="../../export/{{ $data['basic']->id }}" id="add_id"
                                    class="btn btn-primary btn-sm">Download</a> --}}
                                <button type="submit" id="npd_id"
                                    class="btn float-right btn-primary btn-sm">Export</a>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive  table-container">
                                                    <table class="table table-hover  table-striped " id="costsheet_tb"
                                                        style="width:100%;">
                                                        <thead class="fixed-header">
                                                            <tr>
                                                                {{-- <th>Reference No</th> --}}
                                                                <th width="20%">Description</th>
                                                                <input type="hidden" class="columnOne"
                                                                    name="columnOne[]" value="Description">

                                                                @foreach ($data['location'] as $loc)
                                                                    <th>%</th>
                                                                    </th>
                                                                    <th>Per Case</th>
                                                                    <th>Per Unit</th>
                                                                @endforeach

                                                                <th @if (auth()->user()->role == 'Marketing') hidden="true" @endif
                                                                    width="12%">Action</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="bold">Product Name</td>
                                                                <input type="hidden" class="columnOne"
                                                                    name="columnOne[]" value="Product Name">

                                                                @foreach ($data['product'] as $loc)
                                                                    <td></td>
                                                                    <td colspan="2" class="text-center"> <input
                                                                            type="hidden" name="productname[]"
                                                                            value=" {{ $loc }}">
                                                                        {{ $loc }}</td>
                                                                @endforeach

                                                            </tr>
                                                            <tr>
                                                                <td class="bold">Launch Qty</td>
                                                                <input type="hidden" class="columnOne"
                                                                    name="columnOne[]" value="Launch Qty">
                                                                @foreach ($data['location'] as $loc)
                                                                    <td></td>

                                                                    <td colspan="2" class="text-center">
                                                                        <input type="hidden" name="quantity[]"
                                                                            value="{{ $data['basic']->quantity }}">
                                                                        {{ $data['basic']->quantity }} Units
                                                                    </td>
                                                                @endforeach
                                                            </tr>
                                                            <tr>
                                                                <td class="bold">Location</td>
                                                                <input type="hidden" class="columnOne"
                                                                    name="columnOne[]" value="Location">

                                                                @foreach ($data['location'] as $op=>$loc)
                                                                        <td></td>
                                                                    <input type="hidden" name="location[]"
                                                                        value="{{ $data['from_location'][$op] }} to {{$data['to_location'][$op] }}">
                                                                    <td colspan="2" class="text-center">
                                                                        {{ $data['from_location'][$op]}} to {{$data['to_location'][$op] }}
                                                                    </td>
                                                                @endforeach
                                                            </tr>

                                                            <tr>
                                                                {{-- <td class="bold">RF002</td> --}}
                                                                <td class="bold">Specific Gravity </td>
                                                                <input type="hidden" class="columnOne"
                                                                    name="columnOne[]" value="Specific Gravity">

                                                                <input id="viewId"
                                                                    value="{{ $data['basic']->id }}" type="hidden">

                                                                @foreach ($data['location'] as $loc)
                                                                    <td>
                                                                    </td>
                                                                    <td colspan="2"><input name="sp_gravity[]"
                                                                            readonly type="text"
                                                                            class="form-control spGravity"
                                                                            value="{{ $data['basic']->specific_gravity }}">
                                                                    </td>
                                                                @endforeach
                                                            </tr>

                                                            <tr>
                                                                {{-- <td class="bold">RF004</td> --}}
                                                                <td class="bold">Fill Volume (ml)</td>
                                                                <input type="hidden" class="columnOne"
                                                                    name="columnOne[]" value="Fill Volume (ml)">
                                                                @php $fill = 0; @endphp
                                                                @foreach ($data['location'] as $loc)
                                                                    <td><input type="hidden" value="0" name="dyn_val_{{ $fill }}[]">
                                                                    </td>

                                                                    <td><input type="text"
                                                                            class="form-control fillVolumeCase"
                                                                            value="{{ $data['fillvolume'] }}"
                                                                            title="PCS per CAS measure(Per Case) * Fill Volume  (ml) (Per Unit)"
                                                                             name="dyn_val_{{ $fill }}[]" readonly></td>
                                                                    <td><input type="text"
                                                                            class="form-control fillVolumeUnit approveOrReject"
                                                                            required attr="{{ $fill }}"
                                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                            value="{{ $data['basic']->Volume }}"
                                                                             name="dyn_val_{{ $fill }}[]"></td>
                                                                    @php $fill++; @endphp
                                                                @endforeach
                                                                <td class="parent_container">
                                                                    @if ($data['basic']->b_volume_approval == 0 || $data['basic']->b_volume_approval == 1)
                                                                        <button type="button"
                                                                            class="btn btn-success mr-2 btn-sm rowApproval"
                                                                            @if ($data['basic']->b_volume_approval != 0) disabled @endif><i
                                                                                class="bx bx-check icon nav-icon "
                                                                                aria-hidden="true"></i></button>
                                                                    @endif
                                                                    @if ($data['basic']->b_volume_approval == 0 || $data['basic']->b_volume_approval == 2)
                                                                        <button type="button"
                                                                            @if ($data['basic']->b_volume_approval != 0) disabled @endif
                                                                            class="btn btn-danger mr-2 btn-sm rowsrej"><i
                                                                                class="bx bx-x icon nav-icon"
                                                                                aria-hidden="true"></i></button>
                                                                    @endif
                                                                    <div class="hidden_div" hidden>
                                                                        <textarea name="volume_remarks" id="volume_remarks" class="form-control my-1" rows="1"></textarea> <button type="button"
                                                                        class="btn btn-danger mr-2 btn-sm rowReject">reject</button>
                                                                    </div>

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                {{-- <td class="bold">RF003</td> --}}
                                                                <td class="bold">Weight (kg)</td>
                                                                <input type="hidden" class="columnOne"
                                                                    name="columnOne[]" value="Weight (kg)">
                                                                @foreach ($data['location'] as $wt=>$loc)
                                                                    <td><input type="hidden" value="0" name="dyn_val_{{ $wt }}[]"></td>

                                                                    <td><input type="text" readonly name="dyn_val_{{ $wt }}[]"
                                                                            title="Fill Volume  (ml) (Per Case) / 1000"
                                                                            class="form-control weightCase"
                                                                            value="{{ $data['fillvolume'] / 1000 }}">
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control weightUnit" readonly
                                                                            title="Fill Volume  (ml) (Per Unit) / 1000"
                                                                            value="{{ $data['basic']->Volume / 1000 }}"
                                                                            name="dyn_val_{{ $wt }}[]"></td>
                                                                @endforeach
                                                            </tr>
                                                            <tr>
                                                                {{-- <td class="bold">RF005</td> --}}
                                                                <td class="bold">PCS per CAS measure</td>
                                                                <input type="hidden" class="columnOne"
                                                                    name="columnOne[]" value="PCS per CAS measure">

                                                                @php
                                                                    $a = 0;
                                                                @endphp
                                                                @foreach ($data['location'] as $loc)
                                                                    <td><input type="hidden" value="0" name="dyn_val_{{ $a }}[]"></td>

                                                                    <td><input type="text" required
                                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                            name="dyn_val_{{ $a }}[]" class="form-control pcsCase approveOrReject"
                                                                            attr="{{ $a }}"
                                                                            value="{{ $data['basic']->case_configuration }}">
                                                                    </td>
                                                                    <td><input type="text" name="dyn_val_{{ $a }}[]"
                                                                             class="form-control pcsUnit" readonly
                                                                            value="{{ $data['basic']->case_configuration/$data['basic']->case_configuration  }}">
                                                                    </td>
                                                                    @php
                                                                        $a++;
                                                                    @endphp
                                                                @endforeach
                                                                <td class="parent_container">
                                                                    @if ($data['basic']->b_case_approval == 0 || $data['basic']->b_case_approval == 1)
                                                                        <button type="button"
                                                                            @if ($data['basic']->b_case_approval != 0) disabled @endif
                                                                            class="btn btn-success mr-2 btn-sm rowApproval"><i
                                                                                class="bx bx-check icon nav-icon "
                                                                                aria-hidden="true"></i></button>
                                                                    @endif
                                                                    @if ($data['basic']->b_case_approval == 0 || $data['basic']->b_case_approval == 2)
                                                                        <button type="button"
                                                                            @if ($data['basic']->b_case_approval != 0) disabled @endif
                                                                            class="btn btn-danger mr-2 btn-sm rowsrej"><i
                                                                                class="bx bx-x icon nav-icon"
                                                                                aria-hidden="true"></i></button>
                                                                    @endif
                                                                    <div class="hidden_div" hidden>
                                                                        <textarea name="case_remarks" id="case_remarks" class="form-control my-1" rows="1"></textarea> <button type="button"
                                                                        class="btn btn-danger mr-2 btn-sm rowReject">reject</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                {{-- <td class="bold">RF006</td> --}}
                                                                <td class="bold">MRP</td>
                                                                <input type="hidden" class="columnOne"
                                                                    name="columnOne[]" value="MRP">

                                                                @php
                                                                    $b = 0;
                                                                @endphp
                                                                @foreach ($data['location'] as $loc)
                                                                    <td><input type="hidden"  value="0" name="dyn_val_{{ $b }}[]"></td>

                                                                    <td><input type="text"
                                                                            class="form-control mrpCase" readonly
                                                                            title="MRP (Per Unit) * PCS per CAS measure(Per Case)"
                                                                            value="{{ $data['mrp'] }}"
                                                                             name="dyn_val_{{ $b }}[]"></td>
                                                                    <td><input type="text"
                                                                            class="form-control mrpUnit approveOrReject"
                                                                            required attr="{{ $b }}"
                                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                             name="dyn_val_{{ $b }}[]"
                                                                            value="{{ $data['basic']->mrp_price }}">
                                                                    </td>
                                                                    @php
                                                                        $b++;
                                                                    @endphp
                                                                @endforeach
                                                                <td class="parent_container">
                                                                    @if ($data['basic']->b_mrp_price_approval == 0 || $data['basic']->b_mrp_price_approval == 1)
                                                                        <button type="button"
                                                                            @if ($data['basic']->b_mrp_price_approval != 0) disabled @endif
                                                                            class="btn btn-success mr-2 btn-sm rowApproval"><i
                                                                                class="bx bx-check icon nav-icon "
                                                                                aria-hidden="true"></i></button>
                                                                    @endif
                                                                    @if ($data['basic']->b_mrp_price_approval == 0 || $data['basic']->b_mrp_price_approval == 2)
                                                                        <button type="button"
                                                                            @if ($data['basic']->b_mrp_price_approval != 0) disabled @endif
                                                                            class="btn btn-danger mr-2 btn-sm rowsrej"><i
                                                                                class="bx bx-x icon nav-icon"
                                                                                aria-hidden="true"></i></button>
                                                                    @endif
                                                                    <div class="hidden_div" hidden>
                                                                        <textarea name="mrp_remarks" id="mrp_remarks" class="form-control my-1" rows="1"></textarea> <button type="button"
                                                                        class="btn btn-danger mr-2 btn-sm rowReject">reject</button>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                {{-- <td class="bold">RF007</td> --}}
                                                                <td class="bold">Retailer Margin %</td>
                                                                <input type="hidden" class="columnOne"
                                                                    name="columnOne[]" value="Retailer Margin %">



                                                                @php
                                                                    $c = 0;
                                                                @endphp
                                                                @foreach ($data['location'] as $loc)
                                                                    <td><input type="hidden" value="0"  name="dyn_val_{{ $c }}[]" name="re_margin[]"></td>

                                                                    <td><input type="text"
                                                                            class="form-control retailMarginCase retailMarginCase_{{ $c }} approveOrReject"
                                                                            attr="{{ $c }}"
                                                                            name="dyn_val_{{ $c }}[]"
                                                                            required
                                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                            value="{{ $loc->retailer_margin }}">
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control retailMarginUnit retailMarginUnit_{{ $c }} "
                                                                            readonly title="Retailer Margin(Per Case)"
                                                                            value="{{ $loc->retailer_margin }}"
                                                                            name="dyn_val_{{ $c }}[]">
                                                                    </td>
                                                                    @php
                                                                        $c++;
                                                                    @endphp
                                                                @endforeach
                                                                <td class="parent_container">
                                                                    @if ($data['basic']->b_retailer_margin_approval == 0 || $data['basic']->b_retailer_margin_approval == 1)
                                                                        <button type="button"
                                                                            @if ($data['basic']->b_retailer_margin_approval != 0) disabled @endif
                                                                            class="btn btn-success mr-2 btn-sm rowApproval"><i
                                                                                class="bx bx-check icon nav-icon "
                                                                                aria-hidden="true"></i></button>
                                                                    @endif
                                                                    @if ($data['basic']->b_retailer_margin_approval == 0 || $data['basic']->b_retailer_margin_approval == 2)
                                                                        <button type="button"
                                                                            @if ($data['basic']->b_retailer_margin_approval != 0) disabled @endif
                                                                            class="btn btn-danger mr-2 btn-sm rowsrej"><i
                                                                                class="bx bx-x icon nav-icon"
                                                                                aria-hidden="true"></i></button>
                                                                    @endif
                                                                    <div class="hidden_div" hidden>
                                                                        <textarea name="retailer_remarks" id="retailer_remarks"  class="form-control my-1" rows="1"></textarea> <button type="button"
                                                                        class="btn btn-danger mr-2 btn-sm rowReject">reject</button>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                {{-- <td class="bold">RF007</td> --}}
                                                                <td class="bold">Primary scheme (inbuilt) %</td>
                                                                <input type="hidden" class="columnOne"
                                                                    name="columnOne[]"
                                                                    value="Primary scheme (inbuilt) %">



                                                                @php
                                                                    $d = 0;
                                                                @endphp
                                                                @foreach ($data['location'] as $loc)
                                                                    <td><input type="hidden" value="0" name="dyn_val_{{ $d }}[]">
                                                                    </td>

                                                                    <td><input type="text"
                                                                            class="form-control primarySchemeCase primarySchemeCase_{{ $d }} approveOrReject"
                                                                            required attr={{ $d }}
                                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                            value="{{ $loc->primary_scheme }}"
                                                                            name="dyn_val_{{ $d }}[]">
                                                                    </td>
                                                                    <td><input type="text" readonly
                                                                            title="Primary scheme (inbuilt) (Per Case)"
                                                                            class="form-control primarySchemeUnit primarySchemeUnit_{{ $d }}"
                                                                            value="{{ $loc->primary_scheme }}"
                                                                            name="dyn_val_{{ $d }}[]">
                                                                    </td>
                                                                    @php
                                                                        $d++;
                                                                    @endphp
                                                                @endforeach
                                                                <td class="parent_container">
                                                                    @if ($data['basic']->b_primary_scheme_approval == 0 || $data['basic']->b_primary_scheme_approval == 1)
                                                                        <button type="button"
                                                                            @if ($data['basic']->b_primary_scheme_approval != 0) disabled @endif
                                                                            class="btn btn-success mr-2 btn-sm rowApproval"><i
                                                                                class="bx bx-check icon nav-icon "
                                                                                aria-hidden="true"></i></button>
                                                                    @endif
                                                                    @if ($data['basic']->b_primary_scheme_approval == 0 || $data['basic']->b_primary_scheme_approval == 2)
                                                                        <button type="button"
                                                                            @if ($data['basic']->b_primary_scheme_approval != 0) disabled @endif
                                                                            class="btn btn-danger mr-2 btn-sm rowsrej"><i
                                                                                class="bx bx-x icon nav-icon"
                                                                                aria-hidden="true"></i></button>
                                                                    @endif
                                                                    <div class="hidden_div" hidden>
                                                                        <textarea  name="scheme_remarks" id="scheme_remarks" class="form-control my-1" rows="1"></textarea> <button type="button"
                                                                        class="btn btn-danger mr-2 btn-sm rowReject">reject</button>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                {{-- <td class="bold">RF007</td> --}}
                                                                <td class="bold">Landed cost to retailer</td>
                                                                <input type="hidden" class="columnOne"
                                                                    name="columnOne[]"
                                                                    value="Landed cost to retailer">


                                                                @foreach ($data['location'] as $k_ => $loc)
                                                                    <td><input type="hidden" value="0" name="dyn_val_{{ $k_}}[]">
                                                                    </td>

                                                                    <td><input type="text"
                                                                            class="form-control landedCostCase landedCostCase_{{ $k_ }}"
                                                                            title="{{ $data['rsTitle'] }}" readonly
                                                                            value="{{ $data['rs'][$k_] }}"
                                                                            name="dyn_val_{{ $k_}}[]">
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control landedCostUnit landedCostUnit_{{ $k_ }}"
                                                                            title="{{ $data['rsTitle1'] }}" readonly
                                                                            value="{{ $data['rs1'][$k_] }}"
                                                                            name="dyn_val_{{ $k_}}[]">
                                                                    </td>
                                                                @endforeach

                                                            </tr>
                                                            <tr>
                                                                {{-- <td class="bold">RF007</td> --}}
                                                                <td class="bold">RS Margin %</td>
                                                                <input type="hidden" class="columnOne"
                                                                    name="columnOne[]" value="RS Margin %">



                                                                @php
                                                                    $e = 0;
                                                                @endphp
                                                                @foreach ($data['location'] as $gh => $loc)
                                                                    <td><input type="hidden"  value="0" name="dyn_val_{{ $e}}[]"></td>

                                                                    <td><input type="text"
                                                                            class="form-control rsCase rsCase_{{ $gh }} approveOrReject"
                                                                            required
                                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                            value="{{ $loc->rs_margin }}"
                                                                            attr="{{ $e }}"
                                                                             name="dyn_val_{{ $e}}[]">
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control rsUnit rsUnit_{{ $gh }}"
                                                                            readonly
                                                                            title="RS Margin ( wtd avg) (Per Case)"
                                                                            value="{{ $loc->rs_margin }}"
                                                                             name="dyn_val_{{ $e}}[]">
                                                                    </td>
                                                                    @php
                                                                        $e++;
                                                                    @endphp
                                                                @endforeach
                                                                <td class="parent_container">
                                                                    @if ($data['basic']->b_rs_margin_approval == 0 || $data['basic']->b_rs_margin_approval == 1)
                                                                        <button type="button"
                                                                            @if ($data['basic']->b_rs_margin_approval != 0) disabled @endif
                                                                            class="btn btn-success mr-2 btn-sm rowApproval"><i
                                                                                class="bx bx-check icon nav-icon "
                                                                                aria-hidden="true"></i></button>
                                                                    @endif
                                                                    @if ($data['basic']->b_rs_margin_approval == 0 || $data['basic']->b_rs_margin_approval == 2)
                                                                        <button type="button"
                                                                            @if ($data['basic']->b_rs_margin_approval != 0) disabled @endif
                                                                            class="btn btn-danger mr-2 btn-sm rowsrej"><i
                                                                                class="bx bx-x icon nav-icon"
                                                                                aria-hidden="true"></i></button>
                                                                    @endif
                                                                    <div class="hidden_div" hidden>
                                                                        <textarea name="rs_remarks" id="rs_remarks" class="form-control my-1" rows="1"></textarea> <button type="button"
                                                                        class="btn btn-danger mr-2 btn-sm rowReject">reject</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                {{-- <td class="bold">RF007</td> --}}
                                                                <td class="bold">SS Margin %</td>
                                                                <input type="hidden" class="columnOne"
                                                                    name="columnOne[]" value="SS Margin %">



                                                                @php
                                                                    $mc = 0;
                                                                @endphp
                                                                @foreach ($data['location'] as $loc)
                                                                    <td><input type="hidden"   name="dyn_val_{{ $mc}}[]" value="0"></td>

                                                                    <td><input type="text"
                                                                            class="form-control sscase sscase_{{ $mc }} approveOrReject"
                                                                            required
                                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                            value="{{ $loc->ss_margin }}"
                                                                            attr="{{ $mc }}"
                                                                              name="dyn_val_{{ $mc}}[]" >
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control ssunit ssunit_{{ $mc }}"
                                                                            readonly
                                                                            title="RS Margin ( wtd avg) (Per Case)"
                                                                            value="{{ $loc->ss_margin }}"
                                                                              name="dyn_val_{{ $mc}}[]" >
                                                                    </td>
                                                                    @php
                                                                        $mc++;
                                                                    @endphp
                                                                @endforeach
                                                                <td class="parent_container">
                                                                    @if ($data['basic']->b_ss_margin_approval == 0 || $data['basic']->b_ss_margin_approval == 1)
                                                                        <button type="button"
                                                                            @if ($data['basic']->b_ss_margin_approval != 0) disabled @endif
                                                                            class="btn btn-success mr-2 btn-sm rowApproval"><i
                                                                                class="bx bx-check icon nav-icon "
                                                                                aria-hidden="true"></i></button>
                                                                    @endif
                                                                    @if ($data['basic']->b_ss_margin_approval == 0 || $data['basic']->b_ss_margin_approval == 2)
                                                                        <button type="button"
                                                                            @if ($data['basic']->b_ss_margin_approval != 0) disabled @endif
                                                                            class="btn btn-danger mr-2 btn-sm rowsrej"><i
                                                                                class="bx bx-x icon nav-icon"
                                                                                aria-hidden="true"></i></button>
                                                                    @endif
                                                                    <div class="hidden_div" hidden>
                                                                        <textarea name="ss_remarks" id="ss_remarks" class="form-control my-1" rows="1"></textarea> <button type="button"
                                                                        class="btn btn-danger mr-2 btn-sm rowReject">reject</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                {{-- <td class="bold">RF008</td> --}}
                                                                <td class="bold">Landed Cost to Distributor </td>
                                                                <input type="hidden" class="columnOne"
                                                                    name="columnOne[]"
                                                                    value="Landed Cost to Distributor">



                                                                @foreach ($data['location'] as $ab => $loc)
                                                                    <td><input type="hidden"  value="0" name="dyn_val_{{ $ab}}[]">
                                                                    </td>

                                                                    <td><input type="text"
                                                                            class="form-control landedCostRsCase landedCostRsCase_{{ $ab }}"
                                                                            title="Landed cost to retailer(Per Case)/(1+RS Margin ( wtd avg)(Per Case)/(1+SS Margin ( wtd avg)(Per Case))"
                                                                            readonly value="{{ $data['rsDis'][$ab] }}"
                                                                              name="dyn_val_{{ $ab}}[]">
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control landedCostRsUnit landedCostRsUnit_{{ $ab }}"
                                                                            readonly
                                                                            title="Landed cost to retailer(Per Unit)/(1+RS Margin ( wtd avg)(Per Unit)/(1+SS Margin ( wtd avg)(Per Unit))"
                                                                            value="{{ $data['rsDis1'][$ab] }}"
                                                                              name="dyn_val_{{ $ab}}[]">
                                                                    </td>
                                                                @endforeach

                                                            </tr>


                                                            <tr>
                                                                <td class="bold">NR </td>
                                                                <input type="hidden" class="columnOne"
                                                                    name="columnOne[]" value="NR">

                                                                @foreach ($data['location'] as $bc => $loc1)
                                                                    <td><input type="hidden"  value="0" name="dyn_val_{{ $bc}}[]">
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control nrCase nrCase_{{ $bc }}"
                                                                            title="Landed Cost to Distributor(Per Case)/(1+Sales Tax/ GST(Per Case))"
                                                                            readonly value="{{ $data['nr'][$bc] }}"
                                                                             name="dyn_val_{{ $bc}}[]">
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control nrUnit nrUnit_{{ $bc }}"
                                                                            title="Landed Cost to Distributor(Per Unit)/(1+Sales Tax/ GST(Per Unit))"
                                                                            readonly value="{{ $data['nr1'][$bc] }}"
                                                                             name="dyn_val_{{ $bc}}[]">
                                                                    </td>
                                                                @endforeach
                                                            </tr>

                                                            <tr>
                                                                {{-- <td class="bold">RF009</td> --}}
                                                                <td class="bold">Sales Tax/ GST %</td>
                                                                <input type="hidden" class="columnOne"
                                                                    name="columnOne[]" value="Sales Tax/ GST %">


                                                                @php
                                                                    $f = 0;
                                                                @endphp
                                                                @foreach ($data['location'] as $loc)
                                                                    <td><input type="hidden"  value="0" name="dyn_val_{{ $f}}[]" ></td>

                                                                    <td><input type="text"
                                                                            class="form-control salesTaxCase salestaxcs approveOrReject"
                                                                            required attr="{{ $f }}"
                                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                              name="dyn_val_{{ $f}}[]"
                                                                            value="{{ $data['basic']->salesTax }}">
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control salesTaxUnit salestaxuni" readonly
                                                                              name="dyn_val_{{ $f}}[]"
                                                                            title="Sales tax/GST (Per Unit)"
                                                                            value="{{ $data['basic']->salesTax }}">
                                                                    </td>
                                                                    @php
                                                                        $f++;
                                                                    @endphp
                                                                @endforeach
                                                                <td class="parent_container">
                                                                    @if ($data['basic']->b_salesTax_approval == 0 || $data['basic']->b_salesTax_approval == 1)
                                                                        <button type="button"
                                                                            @if ($data['basic']->b_salesTax_approval != 0) disabled @endif
                                                                            class="btn btn-success mr-2 btn-sm rowApproval"><i
                                                                                class="bx bx-check icon nav-icon "
                                                                                aria-hidden="true"></i></button>
                                                                    @endif
                                                                    @if ($data['basic']->b_salesTax_approval == 0 || $data['basic']->b_salesTax_approval == 2)
                                                                        <button type="button"
                                                                            @if ($data['basic']->b_salesTax_approval != 0) disabled @endif
                                                                            class="btn btn-danger mr-2 btn-sm rowsrej"><i
                                                                                class="bx bx-x icon nav-icon"
                                                                                aria-hidden="true"></i></button>
                                                                    @endif
                                                                    <div class="hidden_div" hidden>
                                                                        <textarea name="tax_remarks" id="tax_remarks"  class="form-control my-1" rows="1"></textarea> <button type="button"
                                                                        class="btn btn-danger mr-2 btn-sm rowReject">reject</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                {{-- <td class="bold">RF010</td> --}}
                                                                <td class="bold">Net Sales</td>
                                                                <input type="hidden" class="columnOne"
                                                                    name="columnOne[]" value="Net Sales">



                                                                @foreach ($data['location'] as $cd => $loc)
                                                                    <td><input type="hidden" value="0" name="dyn_val_{{ $cd}}[]"></td>
                                                                    <td><input type="text"
                                                                            title="Landed Cost to Distributor(Per Case)/(1+Sales tax/GST(Per Case))"
                                                                            class="form-control netSalesCase netSalesCase_{{ $cd }}"
                                                                            readonly
                                                                            value="{{ round($data['netsales'][$cd], 2) }}"
                                                                             name="dyn_val_{{ $cd}}[]">
                                                                    </td>
                                                                    <td><input type="text"
                                                                            title="Landed Cost to Distributor(Per Unit)/(1+Sales tax/GST(Per Unit))"
                                                                            class="form-control netSalesUnit netSalesUnit_{{ $cd }}"
                                                                            readonly
                                                                            value="{{ round($data['netsales1'][$cd], 2) }}"
                                                                             name="dyn_val_{{ $cd}}[]">
                                                                    </td>
                                                                @endforeach

                                                            </tr>
                                                            <tr>
                                                                {{-- <td class="bold">RF011</td> --}}
                                                                <td class="bold">RM Scrap factor</td>
                                                                <input type="hidden" class="columnOne"
                                                                    name="columnOne[]" value="RM Scrap factor">


                                                                @php $gm = 0; @endphp
                                                                @foreach ($data['location'] as $loc)
                                                                <td><input type="hidden" value="0"
                                                                    name="dyn_val_{{ $gm}}[]"></td>
                                                                    <td><input type="text"
                                                                            class="form-control rmScrapCase"
                                                                            value="{{ $data['rm_scrap'] }}" readonly
                                                                             name="dyn_val_{{ $gm}}[]"
                                                                            attr="{{ $gm }}">

                                                                        @if ($gm == 0)
                                                                            @foreach ($data['rmCostValue'] as $rate)
                                                                                <label hidden="true"
                                                                                    class="mt-2  rmScrapHide">{{ $rate->Ingredient }}</label>
                                                                                <input type="text" hidden="true"
                                                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                                    class="form-control  rmScrapValue rmScrapHide approveOrReject"
                                                                                    value="{{ $rate->scrap }}"
                                                                                    title="Sum of Ingredients"
                                                                                    attr="{{ $rate->id }}"
                                                                                    name="rmScrapValue[]">
                                                                            @endforeach
                                                                        @endif


                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control rmScrapUnit" readonly
                                                                            value="{{ $data['rm_scrap'] }}"
                                                                             name="dyn_val_{{ $gm}}[]"></td>
                                                                    @php
                                                                        $gm++;
                                                                    @endphp
                                                                @endforeach
                                                                <td class="parent_container">
                                                                    @if ($data['rmCost']->p_scrap_approval == 0)
                                                                        <button type="button"
                                                                            class="btn btn-primary mr-2 btn-sm editRmScrap"><i
                                                                                class="bx bx-edit icon nav-icon"
                                                                                aria-hidden="true"></i></button>
                                                                    @endif
                                                                    @if ($data['rmCost']->p_scrap_approval == 0 || $data['rmCost']->p_scrap_approval == 1)
                                                                        <button type="button" value="scrap"
                                                                            @if ($data['rmCost']->p_scrap_approval != 0) disabled @endif
                                                                            class="btn btn-success mr-2 btn-sm rowApproval"><i
                                                                                class="bx bx-check icon nav-icon "
                                                                                aria-hidden="true"></i></button>
                                                                    @endif
                                                                    @if ($data['rmCost']->p_scrap_approval == 0 || $data['rmCost']->p_scrap_approval == 2)
                                                                        <button type="button"
                                                                            @if ($data['rmCost']->p_scrap_approval != 0) disabled @endif
                                                                            class="btn btn-danger mr-2 btn-sm rowsrej"><i
                                                                                class="bx bx-x icon nav-icon"
                                                                                aria-hidden="true"></i></button>
                                                                    @endif
                                                                    <div class="hidden_div" hidden>
                                                                        <textarea name="scrap_remarks" id="scrap_remarks" class="form-control my-1" rows="1"></textarea> <button type="button"
                                                                        class="btn btn-danger mr-2 btn-sm rowReject" value="scrap">reject</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                {{-- <td class="bold">RF012</td> --}}
                                                                <td class="bold">Formulation cost</td>
                                                                <input type="hidden" class="columnOne"
                                                                    name="columnOne[]" value="Formulation cost">

                                                                @php
                                                                    $i = 0;
                                                                @endphp
                                                                @foreach ($data['location'] as $loc)
                                                                    <td><input type="hidden" value="0" name="dyn_val_{{ $i }}[]">
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control formulationCostCase"
                                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                            value="{{ round($data['basic']->total_rm_cost, 2) }}"
                                                                            attr="{{ $i }}" readonly
                                                                            name="dyn_val_{{ $i }}[]"></td>
                                                                    <td><input type="text"
                                                                            class="form-control formulationCostUnit"
                                                                            readonly
                                                                            value="{{ round($data['basic']->total_rm_cost, 2) }}"
                                                                            name="dyn_val_{{ $i }}[]"></td>
                                                                    @php
                                                                        $i++;
                                                                    @endphp
                                                                @endforeach
                                                            </tr>
                                                            <tr>
                                                                {{-- <td class="bold">RF013</td> --}}
                                                                <td class="bold">Total RM Cost</td>
                                                                <input type="hidden" class="columnOne"
                                                                    name="columnOne[]" value="Total RM Cost">


                                                                @foreach ($data['location'] as $rm=>$loc)
                                                                    <td><input type="hidden" value="0" name="dyn_val_{{ $rm}}[]"></td>
                                                                    <td><input type="text"
                                                                            class="form-control rmCostCase" readonly
                                                                            title="Formulation cost/kg(Per Case) * Weight (kg)(Per Case) * (1+RM Scrap Factor(Per Case))"
                                                                            value="{{ round($data['rmcost'], 2) }}"
                                                                            name="dyn_val_{{ $rm}}[]"></td>
                                                                    <td><input type="text"
                                                                            class="form-control rmCostUnit" readonly
                                                                            title="Formulation cost/kg(Per Unit) * Weight (kg)(Per Unit) * (1+RM Scrap Factor(Per Unit))"
                                                                            value="{{ round($data['rmcost1'], 2) }}"
                                                                            name="dyn_val_{{ $rm}}[]"></td>
                                                                @endforeach

                                                            </tr>
                                                               <tr>
                                                                {{-- <td class="bold">RF013</td> --}}
                                                                <td class="bold">FG Scrap</td>
                                                                <input type="hidden" class="columnOne"
                                                                    name="columnOne[]" value="FG Scrap">


                                                                @foreach ($data['location'] as $fgscrap => $fgs)
                                                                  <td><input type="text"
                                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                               name="dyn_val_{{ $fgscrap}}[]"
                                                                attr="{{ $fgscrap }}"
                                                                class="form-control fgPer columnTwo approveOrReject"
                                                                value="{{ $data['basic']->fg_scrap }}">
                                                        </td>
                                                        <td><input type="text"
                                                               name="dyn_val_{{ $fgscrap}}[]"
                                                                class="form-control fgCase fgCase_{{ $fgscrap }}"
                                                                readonly title="Formulation Cost * FG Scrap"
                                                                value="{{ $data['basic']->fg_scrap *$data['basic']->total_rm_cost }}">
                                                        </td>
                                                        <td><input type="text"
                                                               name="dyn_val_{{ $fgscrap}}[]"
                                                                class="form-control fgUnit fgUnit_{{ $fgscrap }}"
                                                                readonly title="Formulation Cost * FG Scrap"
                                                                value="{{ $data['basic']->fg_scrap *$data['basic']->total_rm_cost }}">
                                                        </td>
                                                        @endforeach
                                                         <td class="parent_container">
                                                        @if ($data['basic']->fg_scrap_approval == 0 || $data['basic']->fg_scrap_approval == 1)
                                                            <button type="button"
                                                                @if ($data['basic']->fg_scrap_approval != 0) disabled @endif
                                                                class="btn btn-success mr-2 btn-sm rowApproval"><i
                                                                    class="bx bx-check icon nav-icon "
                                                                    aria-hidden="true"></i></button>
                                                        @endif
                                                        @if ($data['basic']->fg_scrap_approval == 0 || $data['basic']->fg_scrap_approval == 2)
                                                            <button type="button"
                                                                @if ($data['basic']->fg_scrap_approval != 0) disabled @endif
                                                                class="btn btn-danger mr-2 btn-sm rowsrej"><i
                                                                    class="bx bx-x icon nav-icon"
                                                                    aria-hidden="true"></i></button>
                                                        @endif
                                                        <div class="hidden_div" hidden>
                                                            <textarea name="fg_remarks" id="fg_remarks" class="form-control my-1" rows="1"></textarea> <button type="button"
                                                            class="btn btn-danger mr-2 btn-sm rowReject">reject</button>
                                                        </div>
                                                    </td>
                                                             </tr>
                                                            @php $kk=0; @endphp
                                                            <input type="hidden" name="locationCount"
                                                                id="locationCount"
                                                                value="{{ count($data['location']) }}">
                                                            <input type="hidden" name="distributionChannel"
                                                                id="distributionChannel"
                                                                value="{{ $data['dist_channel'] }}">
                                                            <input type="hidden" name="ssMargin" id="ssMargin"
                                                                value="{{ $data['basic']->ss_margin }}">

                                                            <input type="hidden" name="rsMargin" id="rsMargin"
                                                                value="{{ $data['basic']->rs_margin }}">

                                                            <input type="hidden" name="labelCount" id="labelCount"
                                                                value="{{ count($data['material']) }}">

                                                            @foreach ($data['material'] as $item)
                                                                <tr>
                                                                    <td colspan="1">
                                                                        {{ $item }}
                                                                    </td>
                                                                    <input type="hidden" class="labelId"
                                                                        name="labelId"
                                                                        value="{{ $data['labelId'][$kk] }}">


                                                </div>
                                                <input type="hidden" class="Dynamic" name="columnOne[]"
                                                    value="Dynamic">
                                                <input type="hidden" class="labelDropdown" name="columnOne[]"
                                                    value="">
                                                <input type="hidden" class="columnOne" name="columnOne[]"
                                                    value="{{ $item }}">
                                                <input type="hidden" class="labels" name="labels[]"
                                                    value="{{ $data['materialId'][$kk] }}">
                                                <td colspan="{{ count($data['location']) * 3 + 1 }}">
                                                    <select
                                                        class="form-select select2 moqMultiple moqMultiple_{{ $kk }}"
                                                        multiple required name="label_{{ $kk }}[]">
                                                        @php $m = 0; @endphp
                                                        @foreach ($data['moq'][$kk] as $moq)
                                                            <option @if ($data['moqStatus'][$kk][$m] != 0) selected @endif
                                                                value="{{ $data['total'][$kk][$m] . ',' . $moq . ',' . $data['moqStatus'][$kk][$m] }}">
                                                                {{ $moq }}</option>
                                                            @php $m++; @endphp
                                                        @endforeach
                                                    </select>
                                                </td>
                                                </tr>
                                                @php $kk++; @endphp
                                                @endforeach


                                                <tr>
                                                    {{-- <td class="bold">RF015</td> --}}
                                                    <td class="bold">Total PM Cost</td>
                                                    <input type="hidden" class="columnOne" name="columnOne[]"
                                                        value="Total PM Cost">


                                                    @foreach ($data['location'] as $pq=>$loc)
                                                        <td><input type="hidden" value="0"
                                                         name="dynamicVal_{{ $pq }}[]">
                                                        <td><input type="text" class="form-control pmCostCase"
                                                                readonly value="0" title="Sum(MOQ (Per Case))"
                                                                 name="dynamicVal_{{ $pq }}[]"></td>
                                                        <td><input type="text" class="form-control pmCostUnit"
                                                                readonly value="0" title="Sum(MOQ (Per Unit))"
                                                                 name="dynamicVal_{{ $pq }}[]"></td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    {{-- <td class="bold">RF015</td> --}}
                                                    <td class="bold">Covo.cost</td>
                                                    <input type="hidden" class="columnOne" name="columnOne[]"
                                                        value="Covo.cost">

                                                    @php $l=0; @endphp
                                                    @foreach ($data['location'] as $loc)
                                                       <td><input type="hidden" value="0"
                                                          name="dynamicVal_{{ $l }}[]">
                                                        <td><input type="text" class="form-control convCostCase approveOrReject"
                                                                 value="{{ $data['basic']->conv_cost }}"
                                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                  name="dynamicVal_{{ $l }}[]" ></td>
                                                        <td><input type="text"
                                                                class="form-control convCostUnit "
                                                                attr="{{ $l }}"
                                                                title="Conv. Cost(Per Case) / PCS per CAS measure(Per Case)"

                                                                 value="{{ $data['conv_cost'] }}"
                                                                  name="dynamicVal_{{ $l }}[]" readonly></td>
                                                        @php
                                                            $l++;
                                                        @endphp
                                                    @endforeach
                                                    <td class="parent_container">
                                                        @if ($data['basic']->b_conv_cost_approval == 0 || $data['basic']->b_conv_cost_approval == 1)
                                                            <button type="button"
                                                                @if ($data['basic']->b_conv_cost_approval != 0) disabled @endif
                                                                class="btn btn-success mr-2 btn-sm rowApproval"><i
                                                                    class="bx bx-check icon nav-icon "
                                                                    aria-hidden="true"></i></button>
                                                        @endif
                                                        @if ($data['basic']->b_conv_cost_approval == 0 || $data['basic']->b_conv_cost_approval == 2)
                                                            <button type="button"
                                                                @if ($data['basic']->b_conv_cost_approval != 0) disabled @endif
                                                                class="btn btn-danger mr-2 btn-sm rowsrej"><i
                                                                    class="bx bx-x icon nav-icon"
                                                                    aria-hidden="true"></i></button>
                                                        @endif
                                                        <div class="hidden_div" hidden>
                                                            <textarea name="convo_remarks" id="convo_remarks" class="form-control my-1" rows="1"></textarea> <button type="button"
                                                            class="btn btn-danger mr-2 btn-sm rowReject">reject</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    {{-- <td class="bold">RF016</td> --}}
                                                    <td class="bold">Total Basic</td>
                                                    <input type="hidden" class="columnOne" name="columnOne[]"
                                                        value="Total Basic">
                                                    @foreach ($data['location'] as $cp=>$loc)
                                                         <td><input type="hidden" value="0"
                                                        name="dynamicVal_{{ $cp }}[]">
                                                        </td>
                                                        <td><input type="text" class="form-control totalBasicCase"
                                                                readonly
                                                                title="Conv. Cost(Per Case) + Total PM Cost(Per Case) + Total RM Cost(Per Case)"
                                                                value="{{ $data['totalbasic'] }}"
                                                                name="dynamicVal_{{ $cp }}[]"></td>
                                                        <td><input type="text" class="form-control totalBasicUnit"
                                                                readonly
                                                                title="Conv. Cost(Per Unit) + Total PM Cost(Per Unit) + Total RM Cost(Per Unit)"
                                                                value="{{ $data['totalbasic1'] }}"
                                                                name="dynamicVal_{{ $cp }}[]"></td>
                                                    @endforeach

                                                </tr>


                                                <tr>
                                                    {{-- <td class="bold">RF017</td> --}}
                                                    <td class="bold">Primary Freight</td>
                                                    <input type="hidden" class="columnOne" name="columnOne[]"
                                                        value="Primary Freight">

                                                    @foreach ($data['cost_location'] as $k => $cost)
                                                        <td><input type="hidden" value="0"
                                                                name="dynamicVal_{{ $k }}[]">
                                                        </td>
                                                        <td><input type="text"
                                                                class="form-control pFrightCase pFrightCase_{{ $k }}"
                                                                 name="dynamicVal_{{ $k }}[]"
                                                                title="Primary Frieght * Weight (kg)(Per Case)"
                                                                value="{{ $data['primary_f'][$k] }}" 
                                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                                        </td>
                                                        <td><input type="text"
                                                                name="dynamicVal_{{ $k }}[]"
                                                                class="form-control pFrightUnit  pFrightUnit_{{ $k }}"
                                                                readonly
                                                                title="Primary Freight(Per Case)/PCS per CAS measure(Per Case)"
                                                                value="{{ $data['primary_f1'][$k] }}">
                                                        </td>
                                                    @endforeach
                                                    <td class="parent_container">
                                                        @if ($data['location'][0]->p_cost_approval == 0 || $data['location'][0]->p_cost_approval == 1)
                                                            <button type="button" value="loc"
                                                                @if ($data['location'][0]->p_cost_approval != 0) disabled @endif
                                                                class="btn btn-success mr-2 btn-sm rowApproval"><i
                                                                    class="bx bx-check icon nav-icon "
                                                                    aria-hidden="true"></i></button>
                                                        @endif
                                                        @if ($data['location'][0]->p_cost_approval == 0 || $data['location'][0]->p_cost_approval == 2)
                                                            <button type="button"
                                                                @if ($data['location'][0]->p_cost_approval != 0) disabled @endif
                                                                class="btn btn-danger mr-2 btn-sm rowsrej"><i
                                                                    class="bx bx-x icon nav-icon"
                                                                    aria-hidden="true"></i></button>
                                                        @endif
                                                        <div class="hidden_div" hidden>
                                                            <textarea name="freight_remarks" id="freight_remarks" class="form-control my-1" rows="1"></textarea> <button value="loc" type="button"
                                                            class="btn btn-danger mr-2 btn-sm rowReject">reject</button>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    {{-- <td class="bold">RF018</td> --}}
                                                    <td class="bold">COGS</td>
                                                    <input type="hidden" class="columnOne" name="columnOne[]"
                                                        value="COGS">

                                                    @foreach ($data['location'] as $key => $loc)
                                                        <td><input type="hidden" value="0"
                                                                name="dynamicVal_{{ $key }}[]"></td>
                                                        <td><input type="text"
                                                                class="form-control cogsCase cogsCase_{{ $key }}"
                                                                title="Primary Freight(Per Case) + Total Basic(Per Case)"
                                                                readonly value="{{ $data['cogs'][$key] }}"
                                                                name="dynamicVal_{{ $key }}[]">
                                                        </td>
                                                        <td><input type="text"
                                                                class="form-control cogsUnit_{{ $key }}"
                                                                title="Primary Freight(Per Unit) + Total Basic(Per Unit)"
                                                                readonly value="{{ $data['cogs1'][$key] }}"
                                                                name="dynamicVal_{{ $key }}[]">
                                                        </td>
                                                    @endforeach



                                                </tr>
                                                <tr>
                                                    {{-- <td class="bold">RF019</td> --}}
                                                    <td class="bold">GM in Value</td>
                                                    <input type="hidden" class="columnOne" name="columnOne[]"
                                                        value="GM in Value">

                                                    @foreach ($data['location'] as $gm => $loc)
                                                        <td><input type="hidden"
                                                                name="dynamicVal_{{ $gm }}[]"
                                                                value="0"></td>
                                                        <td><input type="text"
                                                                class="form-control gmValCase gmValCase_{{ $gm }}"
                                                                readonly value="{{ $data['gmval'][$gm] }}"
                                                                title=" Net Sales (Per Case) - COGS(Per Case)"
                                                                name="dynamicVal_{{ $gm }}[]"></td>
                                                        <td><input type="text"
                                                                class="form-control gmValUnit gmValUnit_{{ $gm }}"
                                                                title=" Net Sales (Per Unit) - COGS(Per Unit)" readonly
                                                                value="{{ $data['gmval1'][$gm] }}"
                                                                name="dynamicVal_{{ $gm }}[]"></td>
                                                    @endforeach

                                                </tr>
                                                <tr>
                                                    {{-- <td class="bold">RF020</td> --}}
                                                    <td class="bold">GM %</td>
                                                    <input type="hidden" class="columnOne" name="columnOne[]"
                                                        value="GM %">
                                                    @foreach ($data['location'] as $gmp => $loc)
                                                        <td><input type="hidden" value="0"
                                                                name="dynamicVal_{{ $gmp }}[]">
                                                        </td>
                                                        <td><input type="text"
                                                                class="form-control gmPerCase gmPerCase_{{ $gmp }}"
                                                                title="GM in Value(Per Case)/Net Sales (Per Case)"
                                                                readonly value="{{ $data['gmpercents'][$gmp] }}"
                                                                name="dynamicVal_{{ $gmp }}[]"></td>
                                                        <td><input type="text"
                                                                class="form-control gmPerUnit gmPerUnit_{{ $gmp }}"
                                                                title="GM in Value(Per Unit)/Net Sales (Per Unit)"
                                                                readonly value="{{ $data['gmpercents1'][$gmp] }}"
                                                                name="dynamicVal_{{ $gmp }}[]"></td>
                                                    @endforeach

                                                </tr>
                                                <tr>
                                                    {{-- <td class="bold">RF021</td> --}}
                                                    <td class="bold">Secondary Freight %</td>
                                                    <input type="hidden" class="columnOne" name="columnOne[]"
                                                        value="Secondary Freight %">
                                                    @php $fri = 0; @endphp
                                                    @foreach ($data['cost_location'] as $cost)
                                                        <td><input type="text"
                                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                name="dynamicVal_{{ $fri }}[]"
                                                                class="form-control freightPer freightPer_{{ $fri }} columnTwo"
                                                                attr="{{ $fri }}"
                                                                value="{{ $data['secfreight'][$fri] }}" hidden></td>
                                                        <td><input type="text"
                                                                class="form-control freightCase freightCase_{{ $fri }}"
                                                                 title="Freight"
                                                                value="{{ $data['secfreight'][$fri] }}"
                                                                name="dynamicVal_{{ $fri }}[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"></td>
                                                        <td><input type="text"
                                                                class="form-control freightUnit freightUnit_{{ $fri }}"
                                                                readonly title="Freight/PCS per CAS measure(Per Case)"
                                                                value="{{ round($data['secfreight'][$fri]/$data['basic']->case_configuration,2)  }}"
                                                                name="dynamicVal_{{ $fri }}[]"></td>
                                                        @php $fri++; @endphp
                                                    @endforeach

                                                   <td class="parent_container">
                                                        @if ($data['sec_location'][0]->s_cost_approval == 0 || $data['sec_location'][0]->s_cost_approval == 1)
                                                            <button type="button" value="secloc"
                                                                @if ($data['sec_location'][0]->s_cost_approval != 0) disabled @endif
                                                                class="btn btn-success mr-2 btn-sm rowApproval"><i
                                                                    class="bx bx-check icon nav-icon "
                                                                    aria-hidden="true"></i></button>
                                                        @endif
                                                        @if ($data['sec_location'][0]->s_cost_approval == 0 || $data['sec_location'][0]->s_cost_approval == 2)
                                                            <button type="button"
                                                                @if ($data['sec_location'][0]->s_cost_approval != 0) disabled @endif
                                                                class="btn btn-danger mr-2 btn-sm rowsrej"><i
                                                                    class="bx bx-x icon nav-icon"
                                                                    aria-hidden="true"></i></button>
                                                        @endif
                                                        <div class="hidden_div" hidden>
                                                            <textarea name="sec_freight_remarks" id="sec_freight_remarks" class="form-control my-1" rows="1"></textarea> <button value="loc" type="button"
                                                            class="btn btn-danger mr-2 btn-sm rowReject">reject</button>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="bold">Damages %</td>
                                                    <input type="hidden" class="columnOne" name="columnOne[]"
                                                        value="Damages %">
                                                    @php $g=0; @endphp
                                                    @foreach ($data['location'] as $loc)
                                                        <td><input type="text"
                                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                name="dynamicVal_{{ $g }}[]"
                                                                attr="{{ $g }}"
                                                                class="form-control damagePer columnTwo approveOrReject"
                                                                value="{{ $data['basic']->damage }}">
                                                        </td>
                                                        <td><input type="text"
                                                                name="dynamicVal_{{ $g }}[]"
                                                                class="form-control damageCase damageCase_{{ $g }}"
                                                                readonly title="Net Sales (Per Case) * Damages(%)/100"
                                                                value="{{ round(($data['basic']->damage / 100) * $data['netsales'][$g], 2) }}">
                                                        </td>
                                                        <td><input type="text"
                                                                name="dynamicVal_{{ $g }}[]"
                                                                class="form-control damageUnit damageUnit_{{ $g }}"
                                                                readonly title="Net Sales (Per Unit) * Damages(%)/100"
                                                                value="{{ round(($data['basic']->damage / 100) * $data['netsales1'][$g], 2) }}">
                                                        </td>
                                                        @php $g++; @endphp
                                                    @endforeach

                                                    <td class="parent_container">
                                                        @if ($data['basic']->b_damage_approval == 0 || $data['basic']->b_damage_approval == 1)
                                                            <button type="button"
                                                                @if ($data['basic']->b_damage_approval != 0) disabled @endif
                                                                class="btn btn-success mr-2 btn-sm rowApproval"><i
                                                                    class="bx bx-check icon nav-icon "
                                                                    aria-hidden="true"></i></button>
                                                        @endif
                                                        @if ($data['basic']->b_damage_approval == 0 || $data['basic']->b_damage_approval == 2)
                                                            <button type="button"
                                                                @if ($data['basic']->b_damage_approval != 0) disabled @endif
                                                                class="btn btn-danger mr-2 btn-sm rowsrej"><i
                                                                    class="bx bx-x icon nav-icon"
                                                                    aria-hidden="true"></i></button>
                                                        @endif
                                                        <div class="hidden_div" hidden>
                                                            <textarea name="damages_remarks" id="damages_remarks" class="form-control my-1" rows="1"></textarea> <button type="button"
                                                            class="btn btn-danger mr-2 btn-sm rowReject">reject</button>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr >
                                                    <td class="bold">Logistics %</td>
                                                    <input type="hidden" class="columnOne" name="columnOne[]"
                                                        value="Logistics %">
                                                    @php $h=0; @endphp
                                                    @foreach ($data['location'] as $loc)
                                                        <td><input type="text"
                                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                name="dynamicVal_{{ $h }}[]"
                                                                attr="{{ $h }}"
                                                                class="form-control logisticsPer columnTwo approveOrReject"
                                                                value="{{ $data['basic']->logistic }}">
                                                        </td>
                                                        <td><input type="text"
                                                                class="form-control logisticsCase logisticsCase_{{ $h }}"
                                                                readonly
                                                                title="Net Sales (Per Case) * Logistics(%)/100"
                                                                value="{{ round(($data['basic']->logistic / 100) * $data['netsales'][$h], 2) }}"
                                                                name="dynamicVal_{{ $h }}[]"></td>
                                                        <td><input type="text"
                                                                class="form-control logisticsUnit logisticsUnit_{{ $h }}"
                                                                readonly
                                                                title="Net Sales (Per Unit) * Logistics(%)/100"
                                                                value="{{ round(($data['basic']->logistic / 100) * $data['netsales1'][$h], 2) }}"
                                                                name="dynamicVal_{{ $h }}[]"></td>
                                                        @php $h++; @endphp
                                                    @endforeach
                                                    <td class="parent_container">
                                                        @if ($data['basic']->b_logistic_approval == 0 || $data['basic']->b_logistic_approval == 1)
                                                            <button type="button"
                                                                @if ($data['basic']->b_logistic_approval != 0) disabled @endif
                                                                class="btn btn-success mr-2 btn-sm rowApproval"><i
                                                                    class="bx bx-check icon nav-icon "
                                                                    aria-hidden="true"></i></button>
                                                        @endif
                                                        @if ($data['basic']->b_logistic_approval == 0 || $data['basic']->b_logistic_approval == 2)
                                                            <button type="button"
                                                                @if ($data['basic']->b_logistic_approval != 0) disabled @endif
                                                                class="btn btn-danger mr-2 btn-sm rowsrej"><i
                                                                    class="bx bx-x icon nav-icon"
                                                                    aria-hidden="true"></i></button>
                                                        @endif
                                                        <div class="hidden_div" hidden>
                                                            <textarea name="logistic_remarks" id="logistic_remarks" class="form-control my-1" rows="1"></textarea> <button type="button"
                                                            class="btn btn-danger mr-2 btn-sm rowReject">reject</button>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="bold">NM in Value</td>
                                                    <input type="hidden" class="columnOne" name="columnOne[]"
                                                        value="NM in Value">
                                                    @php
                                                        $nm_v = 0;
                                                    @endphp
                                                    @foreach ($data['nm_val'] as $nm)
                                                        <td><input type="hidden" value="0"
                                                                name="dynamicVal_{{ $nm_v }}[]"></td>
                                                        <td><input type="text"
                                                                class="form-control nmValCase nmValCase_{{ $nm_v }}"
                                                                readonly value=" {{ round($nm, 2) }}"
                                                                title="GM in Value(Per Case) - (Freight(Per Case) + Damages(Per Case) + Logistics(Per Case))"
                                                                name="dynamicVal_{{ $nm_v }}[]"> </td>
                                                        <td><input type="text"
                                                                class="form-control nmValUnit nmValUnit_{{ $nm_v }}"
                                                                title="GM in Value(Per Unit) - (Freight(Per Unit) + Damages(Per Unit) + Logistics(Per Unit))"
                                                                readonly
                                                                value="{{ round($data['nm_val1'][$nm_v], 2) }}"
                                                                name="dynamicVal_{{ $nm_v }}[]"></td>
                                                        @php
                                                            $nm_v++;
                                                        @endphp
                                                    @endforeach


                                                </tr>
                                                <tr>
                                                    <td class="bold">NM %</td>
                                                    <input type="hidden" class="columnOne" name="columnOne[]"
                                                        value="NM %">
                                                    @php
                                                        $n = 0;
                                                    @endphp
                                                    @foreach ($data['nm_perc'] as $nm)
                                                        <td><input type="hidden" value="0"
                                                                name="dynamicVal_{{ $n }}[]"></td>
                                                        <td><input type="text"
                                                                class="form-control nmCase nmCase_{{ $n }}"
                                                                readonly value="{{ round($nm, 2) }}"
                                                                title="NM(Per Case)/Net Sales (Per Case)"
                                                                name="dynamicVal_{{ $n }}[]"></td>
                                                        <td><input type="text"
                                                                class="form-control nmUnit nmUnit_{{ $n }}"
                                                                readonly title="NM(Per Unit)/Net Sales (Per Unit)"
                                                                value="{{ round($data['nm_perc1'][$n], 2) }}"
                                                                name="dynamicVal_{{ $n }}[]"></td>
                                                        @php
                                                            $n++;
                                                        @endphp
                                                    @endforeach

                                                </tr>
                                                </tbody>
                                                </table>
                                            </div>
                                            <div class="row mt-3">
                                                @if (auth()->user()->role == 'Finance')
                                                    <div class="col-md-6">
                                                        <a href="{{ route('costsheet_approval') }}"
                                                            class="btn btn-primary btn-sm" style="margin-right:1px">
                                                            << Go Back</a>
                                                                @if ($data['basic']->csheet_approval == 'Pending')
                                                                    @if (
                                                                        $data['basic']->b_volume_approval == 1 &&
                                                                            $data['basic']->b_case_approval == 1 &&
                                                                            $data['basic']->b_mrp_price_approval == 1 &&
                                                                            $data['basic']->b_retailer_margin_approval == 1 &&
                                                                            $data['basic']->b_ss_margin_approval == 1 &&
                                                                            $data['basic']->b_primary_scheme_approval == 1 &&
                                                                            $data['basic']->b_rs_margin_approval == 1 &&
                                                                            $data['basic']->b_salesTax_approval == 1 &&
                                                                            $data['basic']->b_conv_cost_approval == 1 &&
                                                                            $data['basic']->b_damage_approval == 1 &&
                                                                            $data['basic']->b_logistic_approval == 1 &&
                                                                            $data['location'][0]->p_cost_approval == 1 &&
                                                                            $data['sec_location'][0]->s_cost_approval == 1 &&
                                                                            $data['rmCost']->p_scrap_approval == 1)
                                                                        @php $styles = "" @endphp
                                                                    @else
                                                                        @php $styles = "style=display:none" @endphp
                                                                    @endif

                                                                    <button type="button" id="overAllApprove"
                                                                        onclick="sheet_approve(<?php echo $data['basic']->id; ?>)"
                                                                        class="btn btn-sm btn-success"
                                                                        {{ $styles }}><i
                                                                            class="bx bx-check icon nav-icon"></i>Approve</button>
                                                                    <button type="button" id="overAllReject"
                                                                        onclick="sheet_reject(<?php echo $data['basic']->id; ?>)"
                                                                        class="btn btn-sm btn-danger"><i
                                                                            class="bx bx-x icon nav-icon"></i>Reject</button>
                                                                    <span id="success_message"></span>
                                                                @endif

                                                    </div>
                                                @endif

                                                @if (auth()->user()->role == 'Marketing')
                                                    <div class="col-md-6">
                                                        <a href="{{ route('costsheet_approval') }}"
                                                            class="btn btn-primary btn-sm" style="margin-right:1px">
                                                            << Go Back</a>
                                                                @if ($data['basic']->mt_csheet_approval == 'Pending')
                                                                    <button type="button"
                                                                        onclick="sheet_approve(<?php echo $data['basic']->id; ?>)"
                                                                        class="btn btn-sm btn-success"><i
                                                                            class="bx bx-check icon nav-icon"></i>Approve</button>
                                                                    <button type="button"
                                                                        onclick="sheet_reject(<?php echo $data['basic']->id; ?>)"
                                                                        class="btn btn-sm btn-danger"><i
                                                                            class="bx bx-x icon nav-icon"></i>Reject</button>
                                                                    <span id="success_message"></span>
                                                                @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <input type="hidden" id="role" value="{{ auth()->user()->role }}">
    <!-- End Page-content -->

    @extends('layout.footer')
    <!-- end container-fluid -->

    @extends('layout.right-sidebar');

    <!-- JAVASCRIPT -->
    <script src="../../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/libs/metismenujs/metismenujs.min.js"></script>
    <script src="../../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../../assets/libs/eva-icons/eva.min.js"></script>
    <!-- apexcharts -->
    {{-- <script src="../../assets/libs/apexcharts/apexcharts.min.js"></script> --}}
    <!-- Vector map-->
    <script src="../../assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="../../assets/libs/jsvectormap/maps/world-merc.js"></script>
    <script src="../../assets/js/pages/dashboard.init.js"></script>
    <script src="../../assets/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            if ($("#role").val() == "Marketing") {
                $(".rowApproval,.rowReject,.moqApproval,.moqReject").attr("hidden", true)
            }
            // each function
            var labelCount = $('#labelCount').val();
            for (let index = 0; index < labelCount; index++) {
                $(".moqMultiple_" + index).each(function() {
                    $(this).closest('tr').find(".remove_label").remove();
                    $(this).closest('tr').find(".removeAll").remove();
                    var value = $(this).val();
                    var locationCount = $('#locationCount').val();
                    $(this).closest('tr').find(".labelDropdown").val(value.length);
                    var count = $(this).closest('tr').find(".labelDropdown").val();
                    var labelId = $(this).closest('tr').find(".labelId").val();
                    var i = 0;
                    for (i = 0; i < value.length; i++) {
                        var text = value[i].split(',');
                        var moqStatus = text[2];
                        html =
                            '<tr><td class="remove_label"><input type="text" name="moqPercentage[]" class="form-control moqValue mt-2 columnTwo" value="' +
                            text[1] +
                            '" ></td>';
                        var label = $(this).closest('tr').find(".labels").val();
                        for (var j = 0; j < locationCount; j++) {
                            var unit = text[0] / $(".pcsCase").val();
                            html +=
                                '<td class="remove_label"><input type="text" attr="' + j +
                                '"  class="form-control mt-2 moqCase" name="moqCase_' +
                                j + label +
                                '[]" value="' +
                                text[0] +
                                '" ></td><td class="remove_label"><input title="MOQ (Per Case)/ PCS per CAS measure(Per Case)" type="text" oninput="validateNumericInput(this)" class="form-control mt-2 moqUnit" readonly name="moqUnit_' +
                                j + label + '[]" value="' +
                                unit.toFixed(2) +
                                '" ></td> <td class="remove_label"><input title="MOQ (Per Case)/ PCS per CAS measure(Per Case)" type="text" class="form-control mt-2 moqUnit" readonly name="moqUnit_' +
                                j + label + '[]" value="' +
                                unit.toFixed(2) +
                                '" ></td>';
                            if (j != locationCount - 1) {
                                html += '<td class="remove_label"></td>';
                            }
                        }
                        html += '<td class="remove_label parent_container">';
                        if (moqStatus == 0 || moqStatus == 1) {
                            var check = "";
                            if (moqStatus == 1) {
                                check = "disabled";
                            }
                            html += '<button iVal="' + i +
                                '" type="button" ' + check + ' count="' + count +
                                '" labelId="' + labelId +
                                '" class="btn btn-sm btn-success mt-2 Approve moqApproval"><i class="bx bx-check icon nav-icon" aria-hidden="true"></i></button>';
                        }
                        if (moqStatus == 0 || moqStatus == 2) {
                            var check = "";
                            if (moqStatus == 2) {
                                check = "disabled";
                            }
                            html += '<button type="button"  ' + check + '  class="btn btn-sm btn-danger mt-2  rowsrej"><i class="bx bx-x icon nav-icon" aria-hidden="true"></i></button> <div class="hidden_div" hidden><textarea name="moq_remarks" id="moq_remarks" class="form-control my-1" rows="1"></textarea> <button type="button" iVal="' +
                                i +
                                '" count="' + count +
                                '" labelId="' + labelId +
                                '" class="btn btn-danger mr-2 btn-sm moqReject">reject</button> </div>';
                        }
                        html += '</td></tr>';
                        $(this).closest("td").append(html);
                    }
                    pmCostCase();
                    pmCostUnit();
                    // gmCases();
                    // nmValCase();
                    // nmValUnit();
                    // nmCase();
                    // nmUnit();


                    if ($("#role").val() == "Marketing") {
                        $(".moqApproval,.moqReject").attr("hidden", true)
                    }
                });
            }

            $(".select2 > option").prop("selected", true);
            $(".select2").trigger("change");
            var locss = $('#locationCount').val()


            for (var location = 0; location < locss; location++) {
                gmCases(location);
                nmValCase(location);
                nmValUnit(location);
                nmCase(location);
                nmUnit(location);
            }


        });

        $('.select2').each(function() {
            var $p = $(this).parent();
            $(this).select2({
                dropdownParent: $p,
                placeholder: 'Select MOQ',
            });
        });


        function weightCase() {
            var weightCase = $(".fillVolumeCase").val() / 1000;
            $(".weightCase").val(weightCase.toFixed(2));
        }



        function weightUnit() {
            var weightUnit = $(".fillVolumeUnit").val() / 1000;
            $(".weightUnit").val(weightUnit.toFixed(2));
        }

        function fillVolumeCase() {
            var fillVolumeUnit = $(".fillVolumeUnit").val();
            var pcsCase = $(".pcsCase").val();
            $(".fillVolumeCase").val((fillVolumeUnit * pcsCase).toFixed(2));
        }

        function mrpCase() {
            var pcsCase = $(".pcsCase").val();
            var mrpUnit = $(".mrpUnit").val();
            $('.mrpCase').val((mrpUnit * pcsCase).toFixed(2));
        }

        function landedCostCase(val) {
            var retailMarginCase = $(".retailMarginCase_" + val).val();
            var primarySchemeCase = $(".primarySchemeCase_" + val).val();
            var mrpCase = $(".mrpCase").val();
            if ($('#distributionChannel').val() == "GT") {
                var landedCostCase = mrpCase / ((1 + (retailMarginCase / 100)) * (1 + (
                    primarySchemeCase / 100)));
            } else {
                var landedCostCase = (mrpCase - (mrpCase * (retailMarginCase / 100))) / (1 + (
                    primarySchemeCase / 100));
            }
            $(".landedCostCase_" + val).val(landedCostCase.toFixed(2));
        }

        function totalBasicCase() {
            var convCostCase = $(".convCostCase").val();
            var pmCostCase = $(".pmCostCase").val();
            var rmCostCase = $(".rmCostCase").val();

            var totalBasicCase = parseFloat(rmCostCase) + parseFloat(pmCostCase) + parseFloat(convCostCase);
            $(".totalBasicCase").val(totalBasicCase.toFixed(2));
        }

        function totalBasicUnit() {
            var convCostUnit = $(".convCostUnit").val();
            var pmCostUnit = $(".pmCostUnit").val();
            var rmCostUnit = $(".rmCostUnit").val();
            var totalBasicUnit = parseFloat(rmCostUnit) + parseFloat(pmCostUnit) + parseFloat(convCostUnit);
            $(".totalBasicUnit").val(totalBasicUnit.toFixed(2));
        }

        function rmCostUnit() {
            var formulationCostUnit = $(".formulationCostUnit").val();
            var rmScrapUnit = $(".rmScrapUnit").val();
            var weightUnit = $(".weightUnit").val();
            var rmCostUnit = formulationCostUnit * weightUnit * (1 + parseFloat(rmScrapUnit/100));
            $(".rmCostUnit").val(rmCostUnit.toFixed(2));
        }

        function rmCostCase() {
            var formulationCostCase = $(".formulationCostCase").val();
            var rmScrapCase = $(".rmScrapCase").val();
            var weightCase = $(".weightCase").val();
            var rmCostCase = formulationCostCase * weightCase * (1 + parseFloat(rmScrapCase/100));
            $(".rmCostCase").val(rmCostCase.toFixed(2));
        }

        function landedCostUnit(val) {
            var mrpUnit = $(".mrpUnit").val();
            var retailMarginUnit = $(".retailMarginUnit_" + val).val();
            var primarySchemeUnit = $(".primarySchemeUnit_" + val).val();
            if ($('#distributionChannel').val() == "GT") {
                var landedCostUnit = mrpUnit / (((1 + retailMarginUnit / 100)) * ((1 + primarySchemeUnit / 100)));
            } else {
                var landedCostUnit = (mrpUnit - (mrpUnit * (retailMarginUnit / 100))) / (1 + (primarySchemeUnit / 100));
            }
            $(".landedCostUnit_" + val).val(landedCostUnit.toFixed(2));
        }

        function landedCostRsCase(val) {
            var landedCostCase = $(".landedCostCase_" + val).val();
            var rsMargin = $(".rsCase_" + val).val();
            var ssMargin = $(".sscase_" + val).val();
            // if ($('#distributionChannel').val() == "GT") {
            var landedCostRsCase = landedCostCase / (1 + (rsMargin / 100)) / (1 + (ssMargin / 100));

            // } else {
            // var landedCostRsCase = landedCostCase / (1 +(rsMargin/100)) / (1 + (ssMargin/100));
            // }
            $(".landedCostRsCase_" + val).val(landedCostRsCase.toFixed(2));
        }

        function landedCostRsUnit(val) {
            var landedCostUnit = $(".landedCostUnit_" + val).val();
            var rsMargin = $(".rsUnit_" + val).val();
            var ssMargin = $(".sscase_" + val).val();
            var landedCostRsUnit = landedCostUnit / (1 + (rsMargin / 100)) / (1 + (ssMargin / 100));
            $(".landedCostRsUnit_" + val).val(landedCostRsUnit.toFixed(2));
        }

        function nrCase(val) {
            var val=0;
            $('.salestaxcs').each(function() {
                var landedCostRsCase = $(".landedCostRsCase_" + val).val();
                var salesTaxCase = $(".salesTaxCase").val();
                var nrCase = landedCostRsCase / (1 + (salesTaxCase / 100));
                $(".nrCase_" + val).val(nrCase.toFixed(2));
            val++;
            })
        }

        function nrUnit(val) {
            var val=0;
            $('.salestaxuni').each(function() {
            var landedCostRsUnit = $(".landedCostRsUnit_" + val).val();
            var salesTaxUnit = $(".salesTaxUnit").val();
            var nrUnit = landedCostRsUnit / (1 + (salesTaxUnit / 100));
            $(".nrUnit_" + val).val(nrUnit.toFixed(2));
            val++;
            });
        }

        function netSalesCase(val) {
            var val=0;
            $('.salestaxcs').each(function() {
                var landedCostRsCase = $(".landedCostRsCase_" + val).val();
                var salesTaxCase = $(".salesTaxCase").val();
                var netSalesCase = landedCostRsCase / (1 + (salesTaxCase / 100));
                $(".netSalesCase_" + val).val(netSalesCase.toFixed(2));
                val++;
            });

        }

        function netSalesUnit(val) {
            var val=0;
            $('.salestaxuni').each(function() {
            var landedCostRsUnit = $(".landedCostRsUnit_" + val).val();
            var salesTaxUnit = $(".salesTaxUnit").val();
            var netSalesUnit = landedCostRsUnit / (1 + (salesTaxUnit / 100));
            $(".netSalesUnit_" + val).val(netSalesUnit.toFixed(2));
            val++;
            });

        }

        function convCostCase() {
            var pcsCase = $(".pcsCase").val();
            var convCostUnit = $(".convCostCase").val();
            if(pcsCase!=0)
            $(".convCostUnit").val((convCostUnit/pcsCase).toFixed(2) );
            else
            $(".convCostUnit").val(0);

        }

        function pmCostCase() {
            var locationCount = $('#locationCount').val();
            var pmCostCase = 0;
            $('.moqCase').each(function() {
                pmCostCase += parseFloat($(this).val());
            });
            if(locationCount!=0)
            $('.pmCostCase').val((pmCostCase / locationCount).toFixed(2));
            else
            $('.pmCostCase').val(0);
        }

        function pmCostUnit() {
            var locationCount = $('#locationCount').val();
            var pmCostUnit = 0;
            $('.moqUnit').each(function() {
                pmCostUnit += parseFloat($(this).val());
            });
            if(locationCount!=0)
            $('.pmCostUnit').val((pmCostUnit / locationCount).toFixed(2));
            else
            $('.pmCostUnit').val(0);
        }
        function moqfuncUnit(){
            var pcscase = $(".pcsCase" ).val();
            var moqpcsval=[]
            $('.moqCase').each(function() {
                moqpcsval.push($(this).val());
            });
            console.log(moqpcsval);
            $mqs=0;
            $('.moqUnit').each(function() {
            if(pcscase!=0)
               $(this).val((moqpcsval[$mqs]/pcscase).toFixed(2));
            else
                $(this).val(0);
               $mqs++;
            });


        }

        function pFrightCase(val) {
            var val=0;
            $('.salestaxuni').each(function() {
            var fright = $(".pFrightCase_" + val).val();
            // var pFrightCase = (fright ) * $(".weightCase").val();
            $(".pFrightCase_" + val).val(fright);
            val++;
            });
        }

        function pFrightUnit(val) {
            var val=0;
            $('.salestaxuni').each(function() {
            var pFrightCase = $(".pFrightCase_" + val).val();
            var pcsCase = $(".pcsCase").val();
            if(pcsCase!=0)
            var pFrightUnit = pFrightCase / pcsCase;
            else
            var pFrightUnit=0;
            $(".pFrightUnit_" + val).val(pFrightUnit.toFixed(2));
            val++;
            });
        }

        function cogsCase(val) {
            var val=0;
            $('.salestaxuni').each(function() {
            var pFrightCase = $(".pFrightCase_" + val).val();
            var totalBasicCase = $(".totalBasicCase").val();
            var cogsCase = parseFloat(pFrightCase) + parseFloat(totalBasicCase);
            $(".cogsCase_" + val).val(cogsCase.toFixed(2));
            val++;
            });

        }

        function cogsUnit(val) {
            var val=0;
            $('.salestaxuni').each(function() {
            var pFrightUnit = $(".pFrightUnit_" + val).val();
            var totalBasicUnit = $(".totalBasicUnit").val();
            var cogsUnit = parseFloat(pFrightUnit) + parseFloat(totalBasicUnit);
            $(".cogsUnit_" + val).val(cogsUnit.toFixed(2));
            val++;
            });
        }

        function gmValCase(val) {
            var val=0;
            $('.salestaxuni').each(function() {
            var netSalesCase = $(".netSalesCase_" + val).val();
            var cogsCase = $(".cogsCase_" + val).val();
            $(".gmValCase_" + val).val((netSalesCase - cogsCase).toFixed(2));
            val++;
            });
        }

        function gmValUnit(val) {
            var val=0;
            $('.salestaxuni').each(function() {
            var netSalesUnit = $(".netSalesUnit_" + val).val();
            var cogsUnit = $(".cogsUnit_" + val).val();
            $(".gmValUnit_" + val).val((netSalesUnit - cogsUnit).toFixed(2));
            val++;
            });
        }

        function gmPerCase(val) {
            var val=0;
            $('.salestaxuni').each(function() {
            var gmValCase = $(".gmValCase_" + val).val();
            var netSalesCase = $(".netSalesCase_" + val).val();
            if(netSalesCase!=0)
            var gmper=gmValCase / netSalesCase;
            else
            var gmper=0;
            $(".gmPerCase_" + val).val((gmper * 100).toFixed(2))
            val++;
            });
        }

        function gmPerUnit(val) {
            var val=0;
            $('.salestaxuni').each(function() {
            var gmValUnit = $(".gmValUnit_" + val).val();
            var netSalesUnit = $(".netSalesUnit_" + val).val();
            if(netSalesUnit!=0)
            $(".gmPerUnit_" + val).val((gmValUnit / netSalesUnit).toFixed(2))
            else
            $(".gmPerUnit_" + val).val(0)

            val++;
            });
        }

        function freightCase(val) {
            var val=0;
            $('.salestaxuni').each(function() {
            var netSalesCase = $(".netSalesCase_" + val).val();
            var freightPer = $(".freightCase_" + val).val();
            // var freightCase = (netSalesCase * (freightPer / 100));
            $(".freightCase_" + val).val(freightPer);
            val++;
            });
        }

        function freightUnit(val) {
            var val=0;
            $('.salestaxuni').each(function() {
            var netSalesUnit = $(".netSalesUnit_" + val).val();
            var pcsCase = $(".pcsCase").val();
            // var freightUnit = (netSalesUnit * (freightPer / 100));
            var freightPer = $(".freightCase_" + val).val();
            if(pcsCase!=0)
            $(".freightUnit_" + val).val((freightPer/pcsCase).toFixed(2));
            else
            $(".freightUnit_" + val).val(0);
            val++;
            });
        }

        function damageCase(val) {
            var val=0;
            $('.salestaxuni').each(function() {
            var netSalesCase = $(".netSalesCase_" + val).val();
            var damagePer = $(".damagePer").val();
            var damageCase = (netSalesCase * (damagePer / 100));
            $(".damageCase_" + val).val(damageCase.toFixed(2));
            val++;
            });

        }

        function damageUnit(val) {
            var val=0;
            $('.salestaxuni').each(function() {
            var netSalesUnit = $(".netSalesUnit_" + val).val();
            var damagePer = $(".damagePer").val();
            var damageUnit = (netSalesUnit * (damagePer / 100));
            $(".damageUnit_" + val).val(damageUnit.toFixed(2));
            val++;
            });

        }

        function logisticsCase(val) {
            var val=0;
            $('.salestaxuni').each(function() {
            var netSalesCase = $(".netSalesCase_" + val).val();
            var logisticsPer = $(".logisticsPer").val();
            var logisticsCase = (netSalesCase * (logisticsPer / 100));
            $(".logisticsCase_" + val).val(logisticsCase.toFixed(2));
            val++;
            });
        }

        function logisticsUnit(val) {
            var val=0;
            $('.salestaxuni').each(function() {
            var netSalesUnit = $(".netSalesUnit_" + val).val();
            var logisticsPer = $(".logisticsPer").val();
            var logisticsUnit = (netSalesUnit * (logisticsPer / 100));
            $(".logisticsUnit_" + val).val(logisticsUnit.toFixed(2));
            val++;
            });
        }

        function nmValCase(val) {
            var val=0;
            $('.salestaxuni').each(function() {
            var gmValCase = $(".gmValCase_" + val).val();
            var freightCase = $(".freightCase_" + val).val();
            var damageCase = $(".damageCase_" + val).val();
            var logisticsCase = $(".logisticsCase_" + val).val();
            var nmValCase = parseFloat(gmValCase) - (parseFloat(freightCase) + parseFloat(damageCase) + parseFloat(
                logisticsCase));
            $(".nmValCase_" + val).val(nmValCase.toFixed(2));
            val++;
            });
        }

        function nmValUnit(val) {
            var val=0;
            $('.salestaxuni').each(function() {
            var gmValUnit = $(".gmValUnit_" + val).val();
            var freightUnit = $(".freightUnit_" + val).val();
            var damageUnit = $(".damageUnit_" + val).val();
            var logisticsUnit = $(".logisticsUnit_" + val).val();
            var nmValUnit = parseFloat(gmValUnit) - (parseFloat(freightUnit) + parseFloat(damageUnit) + parseFloat(
                logisticsUnit));
            $(".nmValUnit_" + val).val(nmValUnit.toFixed(2));
            val++;
            });
        }

        function nmCase(val) {
            var val=0;
            $('.salestaxuni').each(function() {
            var nmValCase = $(".nmValCase_" + val).val();
            var netSalesCase = $(".netSalesCase_" + val).val();
            if(netSalesCase!=0)
            var nmCase = (nmValCase / netSalesCase);
        else
        var nmCase =0;
            $(".nmCase_" + val).val((nmCase*100).toFixed(2));
            val++;
            });
        }

        function nmUnit(val) {
            var val=0;
            $('.salestaxuni').each(function() {
            var nmValUnit = $(".nmValUnit_" + val).val();
            var netSalesUnit = $(".netSalesUnit_" + val).val();
            if(netSalesUnit!=0)
            var nmUnit = (nmValUnit / netSalesUnit);
            else
            var nmUnit =0;
            $(".nmUnit_" + val).val((nmUnit*100).toFixed(2));
            val++;
            });
        }

        $(document).on("keyup", ".spGravity", function() {
            if($(this).val()==''){
                $(this).val(0)
            }
            $(".spGravity").val($(this).val());
        })


        function landedCases(val) {
            landedCostCase(val);
            landedCostUnit(val);
            landedCostRsCase(val);
            landedCostRsUnit(val);
            nrCase(val);
            nrUnit(val);
        }

        function nmCases(val) {
            freightCase(val);
            freightUnit(val);
            nmValCase(val);
            nmValUnit(val);
            nmCase(val);
            nmUnit(val);
        }

        function gmCases(val) {
            totalBasicCase();
            totalBasicUnit();
            cogsCase(val);
            cogsUnit(val);
            gmValCase(val);
            gmValUnit(val);
            gmPerCase(val);
            gmPerUnit(val);
        }

        function volumeUnitCases(val) {
            fillVolumeCase();
            weightCase();
            weightUnit();
            rmCostCase();
            rmCostUnit();
            pFrightCase(val);
            pFrightUnit(val);
            fgCase(val);
        }

        $(document).on("keyup", ".fillVolumeUnit", function() {
            if($(this).val()==''){
                $(this).val(0)
            }
            $(".fillVolumeUnit").val($(this).val());
            var val = $(this).attr('attr');
            weightUnit();
            volumeUnitCases(val) ;
            totalBasicCase();
            totalBasicUnit();
        })

        $(document).on("keyup", ".pcsCase", function() {
            if($(this).val()==''){
                $(this).val(0)
            }
            $(".pcsCase").val($(this).val());
            $(".pcsUnit").val(1);
            var val = $(this).attr('attr');
            fillVolumeCase();
            weightCase();
            weightUnit();
            mrpCase();
            landedCases(val);
            netSalesCase(val);
            moqfuncUnit();
            pmCostCase();
            pmCostUnit();
            rmCostCase();
            convCostCase();
            pFrightCase(val);
            pFrightUnit(val);
            gmCases(val);
            damageCase(val);
            damageUnit(val);
            logisticsCase(val);
            logisticsUnit(val);
            nmCases(val);
            fgCase(val);


        })

        $(document).on("keyup", ".mrpUnit", function() {
            if($(this).val()==''){
                $(this).val(0)
            }
            $(".mrpUnit").val($(this).val());
            var val = $(this).attr('attr');
            mrpCase();
            landedCases(val);
            netSalesCase(val);
            netSalesUnit(val);
            gmCases(val);
            damageCase(val);
            damageUnit(val);
            logisticsCase(val);
            logisticsUnit(val);
            nmCases(val);
        })
        $(document).on("keyup", ".retailMarginCase", function() {
            if($(this).val()==''){
                $(this).val(0)
            }
            var val = $(this).attr('attr');
            $(".retailMarginUnit_" + val + ",.retailMarginCase_" + val + "").val($(this).val());

            landedCases(val);
            netSalesCase(val);
            netSalesUnit(val);
            gmCases(val);
            damageCase(val);
            damageUnit(val);
            logisticsCase(val);
            logisticsUnit(val);
            nmCases(val);
        })
        $(document).on("keyup", ".primarySchemeCase", function() {
            if($(this).val()==''){
                $(this).val(0)
            }
            var val = $(this).attr('attr');
            $(".primarySchemeUnit_" + val + ",.primarySchemeCase_" + val + "").val($(this).val());
            landedCases(val);
            netSalesCase(val);
            netSalesUnit(val);
            gmCases(val);
            damageCase(val);
            damageUnit(val);
            logisticsCase(val);
            logisticsUnit(val);
            nmCases(val);
        })
        $(document).on("keyup", ".rsCase", function() {
            if($(this).val()==''){
                $(this).val(0)
            }
            var val = $(this).attr('attr');
            $(".rsUnit_" + val + ",.rsCase_" + val + "").val($(this).val());
            landedCases(val);
            netSalesCase(val);
            netSalesUnit(val);
            gmCases(val);
            damageCase(val);
            damageUnit(val);
            logisticsCase(val);
            logisticsUnit(val);
            nmCases(val);
        })
        $(document).on("keyup", ".sscase", function() {
            if($(this).val()==''){
                $(this).val(0)
            }
            var val = $(this).attr('attr');
            $(".ssunit_" + val + ",.sscase_" + val + "").val($(this).val());
            landedCases(val);
            netSalesCase(val);
            netSalesUnit(val);
            gmCases(val);
            damageCase(val);
            damageUnit(val);
            logisticsCase(val);
            logisticsUnit(val);
            nmCases(val);
        })
        $(document).on("keyup", ".salesTaxCase", function() {
            if($(this).val()==''){
                $(this).val(0)
            }
            $(".salesTaxUnit,.salesTaxCase").val($(this).val());
            var val = $(this).attr('attr');
            netSalesCase(val);
            netSalesUnit(val);
            gmCases(val);
            damageCase(val);
            landedCases(val)
            damageUnit(val);
            logisticsCase(val);
            logisticsUnit(val);
            nmCases(val);
        })
        $(document).on("keyup", ".formulationCostCase", function() {
            if($(this).val()==''){
                $(this).val(0)
            }
            $(".formulationCostUnit,.formulationCostCase").val($(this).val());
            var val = $(this).attr('attr');
            rmCostCase();
            rmCostUnit();
            gmCases(val);
            nmCases(val);
            fgCase(val);
        })

        $(document).on("keyup", ".moqCase", function() {
            if($(this).val()==''){
                $(this).val(0)
            }
            var moqs=$(this).closest('tr').find(".moqCase").val($(this).val());
            if($(".pcsCase").val() == 0)
            var moqUnit =0;
            else
            var moqUnit = $(this).val() / $(".pcsCase").val();
            $(this).closest('tr').find(".moqUnit").val(moqUnit.toFixed(2));
            var val = $(this).attr('attr');
            pmCostCase();
            pmCostUnit();
            gmCases(val);
            nmCases(val);
        })
        $(document).on("keyup", ".moqUnit", function() {
            if($(this).val()==''){
                $(this).val(0)
            }
            $(this).closest('tr').find(".moqUnit").val($(this).val());
            var val = $(this).attr('attr');
            pmCostUnit();
            totalBasicUnit();
            cogsUnit(val);
            gmCases(val);
            nmCases(val);
        })
        $(document).on("keyup", ".convCostCase", function() {
            if($(this).val()==''){
                $(this).val(0)
            }
            $(".convCostCase").val($(this).val());
            var val = $(this).attr('attr');
            convCostCase();
            gmCases(val);
            nmCases(val);
        })

        $(document).on("keyup", ".freightCase", function() {
            if($(this).val()==''){
                $(this).val(0)
            }
            var val = $(this).attr('attr');
            freightCase(val);
            freightUnit(val);
            nmCases(val);
            // pFrightCase(val);
            // pFrightUnit(val);
            gmCases(val);
        })
         $(document).on("keyup", ".pFrightCase", function() {
            if($(this).val()==''){
                $(this).val(0)
            }
            var val = $(this).attr('attr');
        //    var pfrightunit=$(this).val() / $(".pcsCase").val();
        //    $(".pFrightUnit").val(pfrightunit);
            freightCase(val);
            freightUnit(val);
            nmCases(val);
            pFrightCase(val);
            pFrightUnit(val);
            gmCases(val);
        })

        $(document).on("keyup", ".damagePer", function() {
            if($(this).val()==''){
                $(this).val(0)
            }
            $(".damagePer").val($(this).val());
            var val = $(this).attr('attr');
            damageCase(val);
            damageUnit(val);
            nmCases(val);
        })

        $(document).on("keyup", ".logisticsPer", function() {
            if($(this).val()==''){
                $(this).val(0)
            }
            $(".logisticsPer").val($(this).val());
            var val = $(this).attr('attr');
            logisticsCase();
            logisticsUnit();
            nmCases(val);
        })

        // While select moq append the row in middle of the table
        $('.moqMultiple').on('change', function() {
            $(this).closest('tr').find(".remove_label").remove();
            $(this).closest('tr').find(".removeAll").remove();
            var value = $(this).val();
            var locationCount = $('#locationCount').val();
            $(this).closest('tr').find(".labelDropdown").val(value.length);
            var count = $(this).closest('tr').find(".labelDropdown").val();
            var labelId = $(this).closest('tr').find(".labelId").val();
            var i = 0;
            for (i = 0; i < value.length; i++) {
                var text = value[i].split(',');
                var moqStatus = text[2];
                html =
                    '<tr><td class="remove_label"><input type="text" name="moqPercentage[]" class="form-control moqValue mt-2 columnTwo" value="' +
                    text[1] +
                    '" ></td>';
                var label = $(this).closest('tr').find(".labels").val();
                for (var j = 0; j < locationCount; j++) {
                    if($(".pcsCase").val()!=0)
                    var unit = text[0] / $(".pcsCase").val();
                    else
                    var unit = 0;
                    html +=
                        '<td class="remove_label"><input type="text" attr="' + j +
                        '"  class="form-control  mt-2 moqCase" oninput="validateNumericInput(this)"  name="moqCase_' +
                        j + label +
                        '[]" value="' +
                        text[0] +
                        '" ></td><td class="remove_label"><input title="MOQ (Per Case)/ PCS per CAS measure(Per Case)" type="text" class="form-control mt-2 moqUnit" readonly name="moqUnit_' +
                        j + label + '[]" value="' +
                        unit.toFixed(2) +
                        '" ></td>';
                    if (j != locationCount - 1) {
                        html += '<td class="remove_label"></td>';
                    }
                }
                html += '<td class="remove_label parent_container ">';
                if (moqStatus == 0 || moqStatus == 1) {
                    var check = "";
                    if (moqStatus == 1) {
                        check = "disabled";
                    }
                    html += '<button iVal="' + i +
                        '" type="button" ' + check + ' count="' + count +
                        '" labelId="' + labelId +
                        '" class="btn btn-sm btn-success mt-2 Approve moqApproval"><i class="bx bx-check icon nav-icon" aria-hidden="true"></i></button>';
                }
                if (moqStatus == 0 || moqStatus == 2) {
                    var check = "";
                    if (moqStatus == 2) {
                        check = "disabled";
                    }
                    html += '<button type="button"  ' + check + ' class="btn btn-sm btn-danger mt-2  rowsrej"><i class="bx bx-x icon nav-icon" aria-hidden="true"></i></button><div class="hidden_div" hidden><textarea name="moq_remarks" id="moq_remarks" class="form-control my-1" rows="1"></textarea> <button type="button"  iVal="' +
                        i +
                        '"  count="' + count +
                        '" labelId="' + labelId +
                        '"  class="btn btn-danger mr-2 btn-sm moqReject">reject</button> </div>';
                }
                html += '</td></tr>';
                $(this).closest("td").append(html);
            }
            pmCostCase();
            pmCostUnit();
            var locss = $('#locationCount').val()
            for (var location = 0; location < locss; location++) {
                gmCases(location);
                nmValCase(location);
                nmValUnit(location);
                nmCase(location);
                nmUnit(location);
            }

            // gmCases();
            // nmValCase();
            // nmValUnit();
            // nmCase();
            // nmUnit();


            if ($("#role").val() == "Marketing") {
                $(".moqApproval,.moqReject").attr("hidden", true)
            }
        });



        function npdCostSheetApproval(type, value, colValue,remarks) {
            $(".rmScrapHide").attr("hidden", true);
            var id = $("#viewId").val();
            $.ajax({
                type: "POST",
                url: "{{ route('npdCostSheetApproval') }}",
                data: {
                    type: type,
                    value: value,
                    id: id,
                    colValue: colValue,
                    remarks:remarks
                },
                success: function(data) {
                    if (data.code == 200) {
                        toastr.success(data.message);
                        
                        if (data.check == 0) {
                            $("#overAllApprove").attr("style", "");
                        }
                    }
                }
            });
        }

        // Approve the row
        $(document).on("click", ".rowApproval", function() {
            var value = $(this).closest('tr').find(".columnOne").val();
            if ($(this).val() == "scrap") {
                var colValue = [];
                $('.rmScrapValue').each(function(i, v) {
                    if($(this).val()!=''){
                        colValue[i] = $(this).val() + ',' + $(this).attr('attr');
                    }else{
                        colValue[i] ='';
                    }
                });
                if (!(jQuery.inArray('',colValue) == -1)) {
                    toastr.error('Inputs should not be empty');

                }else{
                    npdCostSheetApproval("Approved", value, colValue);
                     $(this).closest('tr').find(".rowApproval").attr('disabled', true);
                    $(this).closest('tr').find(".rowsrej").remove();
                    $(this).closest('tr').find(".hidden_div").attr('hidden', true);
                    $(this).closest('tr').find(".editRmScrap").remove();
                }
            } else if ($(this).val() == "secloc") {
                var colValue = [];
                $('.freightCase').each(function(i, v) {
                    colValue[i] = $(this).val();
                });
                if (!(jQuery.inArray('',colValue) == -1)) {
                    toastr.error('Inputs should not be empty');

                }else{
                    npdCostSheetApproval("Approved", value, colValue);
                     $(this).closest('tr').find(".rowApproval").attr('disabled', true);
                    $(this).closest('tr').find(".rowsrej").remove();
                    $(this).closest('tr').find(".hidden_div").attr('hidden', true);
                    $(this).closest('tr').find(".editRmScrap").remove();
                }
            }
             else if ($(this).val() == "loc") {
                var colValue = [];
                $('.pFrightCase').each(function(i, v) {
                    colValue[i] = $(this).val();
                });
                if (!(jQuery.inArray('',colValue) == -1)) {
                    toastr.error('Inputs should not be empty');

                }else{
                    npdCostSheetApproval("Approved", value, colValue);
                     $(this).closest('tr').find(".rowApproval").attr('disabled', true);
                    $(this).closest('tr').find(".rowsrej").remove();
                    $(this).closest('tr').find(".hidden_div").attr('hidden', true);
                    $(this).closest('tr').find(".editRmScrap").remove();
                }
            } else {
                var colValue = $(this).closest('tr').find(".approveOrReject").val();
                if(colValue!=''){
                    npdCostSheetApproval("Approved", value, colValue);
                    $(this).closest('tr').find(".rowApproval").attr('disabled', true);
                    $(this).closest('tr').find(".rowsrej").remove();
                    $(this).closest('tr').find(".hidden_div").attr('hidden', true);
                    $(this).closest('tr').find(".editRmScrap").remove();

                }else{
                    toastr.error('Inputs should not be empty');
                }


            }

        });

        // Reject the row
        $(document).on("click", ".rowReject", function() {
            var value = $(this).closest('tr').find(".columnOne").val();
            if ($(this).val() == "scrap") {
                var colValue = [];
                $('.rmScrapValue').each(function(i, v) {
                    colValue[i] = $(this).val() + ',' + $(this).attr('attr');
                });
            } else if ($(this).val() == "loc") {
                var colValue = [];
                $('.pFrightCase').each(function(i, v) {
                    colValue[i] = $(this).val();
                });
            
             } else if ($(this).val() == "secloc") {
                var colValue = [];
                $('.freightCase').each(function(i, v) {
                    colValue[i] = $(this).val();
                });
            } else {
                var colValue = $(this).closest('tr').find(".approveOrReject").val();
            }
            var remarks = $(this).closest('tr').find("textarea").val();


            npdCostSheetApproval("Reject", value, colValue,remarks);

            $(this).closest('tr').find(".rowApproval").remove();
            $(this).closest('tr').find(".hidden_div").attr('hidden', true);
            $(this).closest('tr').find(".rowReject").attr('disabled', true);
            $(this).closest('tr').find(".rowsrej").attr('disabled', true);
            $(this).closest('tr').find(".editRmScrap").remove();
        });

        $(document).on("click", ".editRmScrap", function() {
            if ($(".rmScrapHide").is(":hidden")) {
                $(".rmScrapHide").attr("hidden", false);
            } else {
                $(".rmScrapHide").attr("hidden", true);
            }
        })

        // Approve the MOQ
        $(document).on("click", ".moqApproval", function() {
            var count = $(this).attr('count');
            var iVal = $(this).attr('iVal');
            labelId = $(this).attr('labelId');

            var moqValue = $(this).closest("tr").find(".moqValue").val();
            var moqCase = $(this).closest("tr").find(".moqCase").val();
            if(moqCase!=''){
                approveRejectMoq(1, count, iVal, labelId, moqValue, moqCase);
            $(this).closest('tr').find(".moqApproval").attr("disabled", true);
            $(this).closest('tr').find(".moqReject").remove();
            $(this).closest('tr').find(".rowsrej").attr("disabled", true);
            }else{
                toastr.error("Inputs should not be empty");
            }

        });

        // Reject the MOQ
        $(document).on("click", ".moqReject", function() {
            var count = $(this).attr('count');
            var iVal = $(this).attr('iVal');
            labelId = $(this).attr('labelId');
            $(this).closest('tr').find(".moqReject").attr("disabled", true);
            $(this).closest('tr').find(".moqApproval").remove();
            var moqValue = $(this).closest("tr").find(".moqValue").val();
            var moqCase = $(this).closest("tr").find(".moqCase").val();
            var remarks = $(this).closest("tr").find("textarea").val();

            approveRejectMoq(2, count, iVal, labelId, moqValue, moqCase,remarks);
            $(this).closest("tr").find(".hidden_div").attr('hidden', true);
            $(this).closest('tr').find(".rowsrej").attr("disabled", true);

            $("#overAllApprove").attr("hidden", true);
        });

        function approveRejectMoq(type, count, iVal, labelId, moqValue, moqCase,remarks) {
            $.ajax({
                type: "POST",
                url: "{{ route('approveRejectMoq') }}",
                data: {
                    type: type,
                    count: count,
                    iVal: iVal,
                    labelId: labelId,
                    moqValue: moqValue,
                    moqCase: moqCase,
                    remarks:remarks
                },
                success: function(data) {
                    if (data.code == 200) {
                        toastr.success(data.message);
                    }remarks
                }
            });
        }

        function sheet_approve(id) {
            sheetOverallApproval(id, 'Approved');
        }


        function sheetOverallApproval(id, type) {
            $.ajax({
                type: "POST",
                url: "{{ route('sheetOverallApproval') }}",
                data: {
                    id: id,
                    type: type,
                },
                success: function(data) {
                    if (data.code == 200) {
                        toastr.success(data.message);
                        window.location.href = "{{ route('costsheet_approval') }}";
                    }
                }
            });
        }

        function sheet_reject(id) {
            sheetOverallApproval(id, 'Rejected');
        }

        $(document).on("keyup", ".rmScrapValue", function() {
            if($(this).val()==''){
                $(this).val(0)
            }
            var sum = 0;
            $('.rmScrapValue').each(function() {
                if($(this).val() !=''){
                    var vals=$(this).val();
                }else{
                    var vals=0;
                }
                sum += parseFloat(vals);
            });
            $(".rmScrapCase,.rmScrapUnit").val(sum.toFixed(2));

            var val = $(".rmScrapCase").attr('attr');

            rmCostCase();
            rmCostUnit();
            gmCases(val)
            nmCases(val);
            fgCase(val);

        });
         $(document).on("keyup", ".fgPer", function() {
              if($(this).val()==''){
                $(this).val(0)
            }
            $(".fgPer").val($(this).val());
            var val = $(this).attr('attr');
            fgCase(val);
         });
         function fgCase(val){
            var val=0;
            var fgPer=$(".fgPer").val();
            $('.salestaxuni').each(function() {
            var formulationcost=$(".formulationCostCase").val() * fgPer;
            $(".fgCase").val(formulationcost.toFixed(2));
            $(".fgUnit").val(formulationcost.toFixed(2));
            val++;
            });
         }
        $(document).on('click','.rowsrej',function () {
                // Find the closest common ancestor and then find the hidden div within it
                var hiddenDiv = $(this).closest('.parent_container').find('.hidden_div');
                if (hiddenDiv.is(':visible')) {
                    hiddenDiv.attr('hidden', true);
                } else {
                    hiddenDiv.removeAttr('hidden');
                }
            });

            function validateNumericInput(input) {
        // Remove non-numeric characters using a regular expression
                input.value = input.value.replace(/[^0-9.]/g, '');

        // Ensure there is only one dot in the input (for decimal numbers)
            input.value = input.value.replace(/(\..*)\./g, '$1');
               }

    </script>
</body>

</html>
