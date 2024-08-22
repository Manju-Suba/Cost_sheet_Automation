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
    <link rel="shortcut icon" href="../assets/images/h_logo.png">
    <!-- plugin css -->
    <link href="../assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- datatable -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"> </script>
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>


    {{-- new cdn --}}
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"> </script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"> </script>
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet">
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
        .readonly-select {
        background-color: #f5f5f5; /* Example background color */
        pointer-events: none; /* Disable pointer events */
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

        .alert_color{
            color: #8e3333;
        }
        .deletelocation,.deletelocation_secondary{
            width:40px !important;
        }

        /* .main-tab.nav-tabs .nav-link {
            margin-bottom: -1px;
            background: 0 0;
            border: 1px solid transparent;
            border-top-left-radius: 1.75rem;
            border-top-right-radius: 1.75rem;
            border-bottom-left-radius: 1.75rem;
            border-bottom-right-radius: 1.75rem;
        } */

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
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="">
                                            <h5 class="">Product Details</h5>
                                            <!-- Extra Large modal -->
                                            <button type="button" class="btn btn-primary waves-effect waves-light float-end" data-bs-placement="top" title="add details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl">Add
                                                Product</button>


                                                <!--  Modal content for the above example -->
                                            <div class="modal fade bs-example-modal-xl" tabindex="-1" id="tycheck" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            Product Info ::
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card-content">
                                                                <!-- <div class="card-body"> -->
                                                                    <div class="col-12">
                                                                        <form id="formcheck" enctype="multipart/form-data">
                                                                            <div class="row">
                                                                                <div class="col-md-8">
                                                                                    <label>Select Type</label>
                                                                                    <select name="product_type" id="product_type" class="form-control" required>
                                                                                        <option value="" selected disabled>--Select--</option>
                                                                                        <option value="New Product">New Product</option>
                                                                                        <option value="Existing Product">Existing Product</option>
                                                                                    </select>
                                                                                    <span class="alert_color" id="pro_type"></span>
                                                                                </div>
                                                                                <div class="col-md-3 mt-3 text-center" style="margin-top: 30px !important;">
                                                                                    <button type="button" class="form-control btn btn-primary" id="fix">Done</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                <!-- </div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>


                                            <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" id="productModal" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    <div class="col-12">
                                                                        <form id="formadd" enctype="multipart/form-data">
                                                                            <div class="row">
                                                                                <h5>Basic Product Information</h5>
                                                                                <div class="col-md-6">
                                                                                    <label for="inputEmail4" class="form-label">Product Name</label>
                                                                                    <input type="text" class="form-control" placeholder="eg: cavin's milkshake" id="pname" name="product_name">
                                                                                    <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                                                                                    <span id="product_name_error"></span>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <label for="inputEmail4" class="form-label">Fill Volume</label>
                                                                                    <input type="text" class="form-control" onkeypress="return /[0-9.]/i.test(event.key)" placeholder="50" id="fVolume" name="Volume">
                                                                                    <span id="Volume_error"></span>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <label for="inputEmail4" class="form-label">uom</label>
                                                                                    <select class="form-control" name="uom" id="select_uom">
                                                                                        <option value="">---</option>
                                                                                        @foreach ($data as $item)
                                                                                        <option value="{{ $item->uom_name }}">
                                                                                            {{ $item->uom_name }}
                                                                                        </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    <span id="uom_error"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                  <div class="col-md-4">
                                                                                    <label for="inputEmail4" class="form-label">Division</label>
                                                                                    <select class="form-control" name="division" id="division">
                                                                                        <option value="">---</option>
                                                                                        @foreach ($division as $item)
                                                                                        <option value="{{ $item->id }}">
                                                                                            {{ $item->division }}
                                                                                        </option>
                                                                                        @endforeach
                                                                                    </select>                                                                                    <span id="division_error"></span>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <label for="inputEmail4" class="form-label">Case Cofiguration</label>
                                                                                    <input type="text" class="form-control" id="caseconfiguration" onkeypress="return /[0-9.]/i.test(event.key)" placeholder="eg: 12" name="case_configuration">
                                                                                    <span id="case_configuration_error"></span>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <label for="inputEmail4" class="form-label">Launch Quantity</label>
                                                                                    <input type="text" class="form-control" placeholder="eg: 500 " onkeypress="return /[0-9.]/i.test(event.key)" id="lquantity" name="quantity">
                                                                                    <span id="quantity_error"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label for="inputEmail4" class="form-label">MRP Per
                                                                                        Piece</label>
                                                                                    <input type="text" class="form-control" placeholder="eg: 1200" onkeypress="return /[0-9.]/i.test(event.key)" id="mrpprice" name="mrp_price">
                                                                                    <span id="mrp_price_error"></span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="distribution_channel" class="form-label">Distribution Channel</label>
                                                                                    <select class="form-control" name="distribution_channel" id="distribution_channel">
                                                                                        <option value="">---</option>
                                                                                        @foreach ($dist_channel as $item)
                                                                                        <option value="{{ $item->id }}">
                                                                                            {{ $item->dist_name }}
                                                                                        </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    <span id="distribution_channel_error"></span>
                                                                                </div>
                                                                            </div>

                                                                            <br>
                                                                            <h5 style="display: inline;">Primary Frieght</h5>
                                                                            <div style="display: inline;">
                                                                                <button style="float: right;background-color: #1643ac !important;" id="add_location" class="btn btn-sm text-white float-right " type="button" title='Add More...'> <i class="fa fa-plus"></i> </button>
                                                                            </div>
                                                                            <hr>
                                                                            <div id="addlocation_primary"class="addlocation_primary">
                                                                                <div class="row primary-location" id="">
                                                                                    <div class="col-md-6 from_prim_loc">
                                                                                        <label for="inputEmail4" class="form-label">From Location</label>
                                                                                        <select type="text" class="form-control from_location common_location primary_from_location" placeholder="eg: cuddalore" id="fromlocation" name="primary_from_location[]" required>
                                                                                            <option value="">---</option>
                                                                                            @foreach ($primaryfrom as $item)
                                                                                            <option value="{{ $item->id }}">
                                                                                                {{ $item->location }}
                                                                                            </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        <span id="from_location_error0" class="location-error-field alert_color"></span>
                                                                                    </div>
                                                                                    <div class="col-md-6 to_prim_loc">
                                                                                        <label for="inputEmail4" class="form-label">To Location</label>
                                                                                        <select type="text" class="form-control common_location primary_to_location npd_prim_to_0" placeholder="eg: chennai" id="tolocation" name="primary_to_location[]" required>
                                                                                            <option value="">---</option>
                                                                                            @foreach ($primaryto as $item)
                                                                                            <option value="{{ $item->id }}">
                                                                                                {{ $item->location }}
                                                                                            </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        <span id="from_location_error0" class="location-error-field alert_color"></span>
                                                                                    </div>
                                                                                    <div class="col-md-3 ret_div">
                                                                                        <label for="inputEmail4" class="form-label">Retailer
                                                                                            Margin % </label>
                                                                                        <input type="text" class="form-control common_location" placeholder="eg: 0.2" onkeypress="return /[0-9.]/i.test(event.key)" id="retailermargin" name="retailer_margin[]" value="">
                                                                                        <span class="retailer_margin_error alert_color"></span>

                                                                                    </div>
                                                                                    <div class="col-md-3 pri_div">
                                                                                        <label for="inputEmail4" class="form-label"> Primary
                                                                                            Scheme %</label>
                                                                                        <input type="text" class="form-control common_location" placeholder="eg: 2.7" onkeypress="return /[0-9.]/i.test(event.key)" id="primaryscheme" name="primary_scheme[]">
                                                                                        <span class="primary_scheme_error alert_color"></span>

                                                                                    </div>
                                                                                    <div class="col-md-3 rs_div">
                                                                                        <label for="inputEmail4" class="form-label">RS Margin %
                                                                                        </label>
                                                                                        <input type="text" class="form-control common_location" placeholder="eg: 7.0" onkeypress="return /[0-9.]/i.test(event.key)" id="rsmargin" name="rs_margin[]">
                                                                                        <span class="rs_margin_error alert_color"></span>

                                                                                    </div>
                                                                                    <div class="col-md-3 ss_div">
                                                                                        <label for="inputEmail4" class="form-label"> SS
                                                                                            Margin %</label>
                                                                                        <input type="text" class="form-control common_location" placeholder="eg: 0.6" onkeypress="return /[0-9.]/i.test(event.key)" id="ssmargin" name="ss_margin[]">
                                                                                        <span class="ss_margin_error alert_color"></span>

                                                                                    </div>
                                                                                <div id="delete"></div>
                                                                                </div>
                                                                            </div>

                                                                            <br>
                                                                            <h5 style="display: inline;">Secondary Frieght (Used Only for Data capture)</h5>
                                                                            <div style="display: inline;">
                                                                                <button style="float: right;background-color: #1643ac !important; visibility:hidden" id="add_location_secondary" class="btn btn-sm text-white float-right " type="button" title='Add More...'> <i class="fa fa-plus"></i> </button>
                                                                            </div>
                                                                            <br>
                                                                            <hr>

                                                                            <div class="addlocation_secondary" id="addlocation_secondary">
                                                                                <div class="row secondary-location ">
                                                                                    <div class="col-md-6 from_sec_loc">
                                                                                        <label for="inputEmail4" class="form-label">From Location</label>
                                                                                        <select type="text" class="form-control common_location npd_second_from_0" placeholder="eg: cuddalore" id="fromlocation" name="secondary_from_location[]" required>
                                                                                            <option value="">---</option>
                                                                                            @foreach ($primaryto as $item)
                                                                                            <option value="{{ $item->id }}">
                                                                                                {{ $item->location }}
                                                                                            </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        <span id="from_location_error0" class="location-error-field alert_color"></span>
                                                                                    </div>
                                                                                    <div class="col-md-6 to_sec_loc">
                                                                                        <label for="inputEmail4" class="form-label">To Location</label>
                                                                                        <select type="text" class="form-control common_location" placeholder="eg: chennai" id="tolocation" name="secondary_to_location[]" required>
                                                                                        <!-- <select class="form-control" name="distribution_channel" id="distribution_channel"> -->
                                                                                            <option value="">---</option>
                                                                                            @foreach ($secondaryto as $item)
                                                                                            <option value="{{ $item->id }}">
                                                                                                {{ $item->location }}
                                                                                            </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        <span id="from_location_error0" class="location-error-field alert_color"></span>
                                                                                    </div>

                                                                                    <hr class="m-3">

                                                                                </div>

                                                                            </div>


                                                                            <div class="row">
                                                                                <div class="col-md-6 p-3">
                                                                                    <button type="button" id="sub" style="margin-left:90%" class="btn btn-sm btn-primary">Submit</button>
                                                                                </div>
                                                                                <div class="col-md-6 p-3">
                                                                                    <!-- <button type="button" class="btn btn-sm btn-secondary">Close</button> -->
                                                                                    <button type="button" id="close1" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>


                                            <!--Existing Product Model-->
                                            <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" id="exist-productModal" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    <div class="col-12">
                                                                        <form id="exist-formadd" enctype="multipart/form-data">
                                                                            <div class="row">
                                                                                <h5>Existing Product Information</h5>
                                                                            </div>
                                                                            <div class="row">
                                                                                <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                                                                                <div class="col-md-3">
                                                                                    <label for="material_code" class="form-label">Material Code</label>
                                                                                    <input type="text" class="form-control" name="material_code" id="material_code" placeholder="xxx" required>
                                                                                    <span id="epd_material_code_error" class="alert_color"></span>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label for="inputEmail4" class="form-label">Division</label>
                                                                                    <select class="form-control" name="epd_division" id="epd_division" >
                                                                                        <option value="">---</option>
                                                                                        @foreach ($division as $item)
                                                                                        <option value="{{ $item->id }}">
                                                                                            {{ $item->division }}
                                                                                        </option>
                                                                                        @endforeach
                                                                                    </select>   
                                                                                    <span id="epd_epd_division_error" class="alert_color"></span>  
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label for="noofPieces" class="form-label">No of Pieces per Case</label>
                                                                                    <input type="text" class="form-control" placeholder="eg: 10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" id="pieces_per_case" name="pieces_per_case" required>
                                                                                    <span id="epd_pieces_per_case_error" class="alert_color"></span>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label for="exdistribution_channel" class="form-label">Distribution Channel</label>
                                                                                    <select class="form-control" name="exdistribution_channel" id="exdistribution_channel">
                                                                                        <option value="">---</option>
                                                                                        @foreach ($dist_channel as $item)
                                                                                        <option value="{{ $item->id }}">{{ $item->dist_name }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    <span id="epd_exdistribution_channel_error"></span>
                                                                                </div>
                                                                            </div>
                                                                            <!-- <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label for="inputEmail4" class="form-label">MRP Per Piece</label>
                                                                                    <input type="text" class="form-control" placeholder="eg: 1200" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" id="mrp_price" name="mrp_price" required>
                                                                                    <span id="mrpprice_error" class="alert_color"></span>
                                                                                </div>
                                                                            </div> -->
                                                                            <br>
                                                                            <h5 style="display: inline;">Primary Frieght & Schemes</h5>
                                                                            <div style="display: inline;">
                                                                                <button style="float: right;background-color: #1643ac !important;" id="epd_add_location" class="btn btn-sm text-white float-right" type="button" title='Add More...'> <i class="fa fa-plus"></i> </button>
                                                                            </div>
                                                                            <div id="epdPrimaryLocation" class="epdPrimaryLocation">
                                                                                <div class="row epd-primary-location" id="">
                                                                                    <hr class="mt-4">
                                                                                    <div class="col-md-6 from_prim_loc">
                                                                                        <label for="inputEmail4" class="form-label">From Location</label>
                                                                                        <select type="text" class="form-control from_location primLocation primaryfrom_location" placeholder="eg: cuddalore" id="fromlocation" name="primaryfrom_location[]" required>
                                                                                            <option value="">---</option>
                                                                                            @foreach ($primaryfrom as $item)
                                                                                            <option value="{{ $item->id }}">
                                                                                                {{ $item->location }}
                                                                                            </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        <span id="from_location_error0" class="location-error-field alert_color"></span>
                                                                                    </div>
                                                                                    <div class="col-md-6 to_prim_loc">
                                                                                        <label for="inputEmail4" class="form-label">To Location</label>
                                                                                        <select type="text" class="form-control primLocation primaryto_location epd_prim_to_0" placeholder="eg: chennai" id="tolocation" name="primaryto_location[]" required>
                                                                                            <option value="">---</option>
                                                                                            @foreach ($primaryto as $item)
                                                                                            <option value="{{ $item->id }}">
                                                                                                {{ $item->location }}
                                                                                            </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        <span id="from_location_error0" class="location-error-field alert_color"></span>
                                                                                    </div>
                                                                                    <div class="col-md-3 ret_div">
                                                                                        <label for="inputEmail4" class="form-label">Retailer Margin % </label>
                                                                                        <input type="text" class="form-control primLocation" placeholder="eg: 0.2" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" id="retailermargin" name="retailer_margin[]" required>
                                                                                        <span id="retailermargin_error" class="retailermargin_error alert_color"></span>
                                                                                    </div>
                                                                                    <div class="col-md-3 prim_div">
                                                                                        <label for="inputEmail4" class="form-label"> Primary Scheme %</label>
                                                                                        <input type="text" class="form-control primLocation" placeholder="eg: 2.7" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" id="primaryscheme" name="primary_scheme[]" required>
                                                                                        <span id="primaryscheme_error" class="primaryscheme_error alert_color"></span>
                                                                                    </div>
                                                                                    <div class="col-md-3 rs_div">
                                                                                        <label for="inputEmail4" class="form-label">RS Margin %</label>
                                                                                        <input type="text" class="form-control primLocation" placeholder="eg: 7.0" id="rsmargin" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="rs_margin[]" required>
                                                                                        <span id="rsmargin_error" class="rsmargin_error alert_color"></span>
                                                                                    </div>
                                                                                    <div class="col-md-3 ss_div">
                                                                                        <label for="inputEmail4" class="form-label">SS Margin %</label>
                                                                                        <input type="text" class="form-control primLocation" placeholder="eg: 0.6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" id="ssmargin" name="ss_margin[]" required>
                                                                                        <span id="ssmargin_error" class="ssmargin_error alert_color"></span>
                                                                                    </div>
                                                                                    <div id="delete"></div>
                                                                                </div>
                                                                            </div>
                                                                            <br>

                                                                            <h5 style="display: inline;">Secondary Frieght (Used Only for Data capture)</h5>
                                                                            <div style="display: inline;">
                                                                                <button style="float: right;background-color: #1643ac !important;visibility:hidden" id="epd_add_SecLocation" class="btn btn-sm text-white float-right " type="button" title='Add More...'> <i class="fa fa-plus"></i> </button>
                                                                            </div>
                                                                            <br>
                                                                            <hr>
                                                                            <div class="epdSecLocation" id="epdSecLocation">
                                                                                <div class="row epd-secondary-location">
                                                                                    <div class="col-md-6 from_sec_loc">
                                                                                        <label for="inputEmail4" class="form-label">From Location</label>
                                                                                        <select type="text" class="form-control primLocation epd_sec_from_0" placeholder="eg: cuddalore" id="fromlocation" name="secondaryfrom_location[]" required>
                                                                                            <option value="">---</option>
                                                                                            @foreach ($primaryto as $item)
                                                                                            <option value="{{ $item->id }}">
                                                                                                {{ $item->location }}
                                                                                            </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        <span id="from_location_error0" class="location-error-field alert_color"></span>
                                                                                    </div>
                                                                                    <div class="col-md-6 to_sec_loc">
                                                                                        <label for="inputEmail4" class="form-label">To Location</label>
                                                                                        <select type="text" class="form-control primLocation" placeholder="eg: chennai" id="tolocation" name="secondaryto_location[]" required>
                                                                                            <option value="">---</option>
                                                                                            @foreach ($secondaryto as $item)
                                                                                            <option value="{{ $item->id }}">
                                                                                                {{ $item->location }}
                                                                                            </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        <span id="from_location_error0" class="location-error-field alert_color"></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-6 p-3">
                                                                                    <button type="button" id="exist-sub" class="btn btn-md btn-primary float-end">Submit</button>
                                                                                </div>
                                                                                <div class="col-md-6 p-3">
                                                                                    <!-- <button type="button" class="btn btn-sm btn-secondary">Close</button> -->
                                                                                    <button type="button" id="close1" class="btn btn-md btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>

                                        </div>
                                        <p class="card-title-desc"></p>

                                        <!-- Nav tabs -->
                                        <ul class="col-6 nav nav-tabs nav-tabs-custom nav-justified main-tab" role="tablist" style="border-bottom:none !important;" >
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block">NPD</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block">EPD</span>
                                                </a>
                                            </li>
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content p-3 text-muted">
                                            <div class="tab-pane active" id="home1" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <ul class="col-12 nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" data-bs-toggle="tab" href="#npd_" role="tab">
                                                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                                        <span class="d-none d-sm-block">NPD Pending</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" data-bs-toggle="tab" href="#npd_rejected" role="tab">
                                                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                        <span class="d-none d-sm-block">NPD Rejected</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" data-bs-toggle="tab" href="#npd_approved" role="tab">
                                                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                        <span class="d-none d-sm-block">NPD Approved</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <div class="tab-content p-3 text-muted">
                                                                <div class="tab-pane active" id="npd_" role="tabpanel">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="table-responsive">
                                                                                <table class="table table-hover " id="product_details">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>S.no</th>
                                                                                            <th>Product Name</th>
                                                                                            <th>Fill Volume</th>
                                                                                            <th>Division</th>
                                                                                            <th>Case Cofiguration</th>
                                                                                            <th>Launch Quantity </th>
                                                                                            <th>Distribution Channel</th>
                                                                                            <th>MRP Per Piece</th>
                                                                                            <th>Primary Location</th>
                                                                                            <th>Secondary Location</th>
                                                                                            <th>Action</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane" id="npd_rejected" role="tabpanel">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="table-responsive">
                                                                                <table class="table table-hover " id="product_details1" style="width:100%">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>S.no</th>
                                                                                            <th>Product Name</th>
                                                                                            <th>Fill Volume</th>
                                                                                            <th>Division</th>
                                                                                            <th>Case Cofiguration</th>
                                                                                            <th>Launch Quantity </th>
                                                                                            <th>Distribution Channel</th>
                                                                                            <th>MRP Per Piece</th>
                                                                                            <th>Primary Location</th>
                                                                                            <th>Secondary Location</th>
                                                                                            <th>Rejected</th>
                                                                                            <th>Remarks</th>
                                                                                            <th>Action</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane" id="npd_approved" role="tabpanel">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="table-responsive">
                                                                                <table class="table table-hover " id="product_details2" style="width:100%">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>S.no</th>
                                                                                            <th>Product Name</th>
                                                                                            <th>Fill Volume</th>
                                                                                            <th>Division</th>
                                                                                            <th>Case Cofiguration</th>
                                                                                            <th>Launch Quantity </th>
                                                                                            <th>Distribution Channel</th>
                                                                                            <th>MRP Per Piece</th>
                                                                                            <th>Primary Location</th>
                                                                                            <th>Secondary Location</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal-->
                                                        <div class="col">
                                                            <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" id="edit_modal" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-xl">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="card-content">
                                                                                <div class="card-body">
                                                                                    <div class="col-12">
                                                                                        <form id="formedit" enctype="multipart/form-data">
                                                                                            <div class="row">
                                                                                                <h5>Basic Product Information</h5>
                                                                                                <div class="col-md-6">
                                                                                                    <input type="hidden" id="status_bar" name="status_bar">
                                                                                                    <label for="inputEmail4" class="form-label">Product Name</label>
                                                                                                    <input type="text" class="form-control" id="edit_pname" name="edit_product_name" disabled>
                                                                                                    <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                                                                                                </div>
                                                                                                <div class="col-md-4">
                                                                                                    <label for="inputEmail4" class="form-label">Fill Volume</label>
                                                                                                    <input type="text" class="form-control" id="edit_fVolume" name="edit_Volume" disabled>
                                                                                                    <input type="hidden" class="form-control" id="hid_id" name="hid_id">
                                                                                                </div>
                                                                                                <div class="col-md-2">
                                                                                                    <label for="inputEmail4" class="form-label">uom</label>
                                                                                                    <select class="form-control  " name="edit_uom" id="edit_select_uom" disabled>
                                                                                                        <option value="">---</option>
                                                                                                        @foreach ($data as $item)
                                                                                                        <option value="{{ $item->uom_name }}">{{ $item->uom_name }}</option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                  <div class="col-md-4">
                                                                                                    <label for="inputEmail4" class="form-label">Division</label>
                                                                                                    <select class="form-control" name="edit_division" id="edit_division" disabled>
                                                                                                        <option value="">---</option>
                                                                                                        @foreach ($division as $item)
                                                                                                        <option value="{{ $item->id }}">
                                                                                                            {{ $item->division }}
                                                                                                        </option>
                                                                                                        @endforeach
                                                                                                    </select>                                                                                    
                                                                                                    <span id="division_error"></span>
                                                                                                </div>
                                                                                                <div class="col-md-4">
                                                                                                    <label for="inputEmail4" class="form-label">Case Cofiguration</label>
                                                                                                    <input type="text" class="form-control" id="edit_caseconfiguration" name="edit_case_configuration"   onkeypress="return /[0-9.]/i.test(event.key)" disabled>
                                                                                                </div>
                                                                                                <div class="col-md-4">
                                                                                                    <label for="inputEmail4" class="form-label">Launch Quantity</label>
                                                                                                    <input type="text" class="form-control" id="edit_lquantity" name="edit_quantity" disabled  onkeypress="return /[0-9.]/i.test(event.key)">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div class="col-md-6">
                                                                                                    <label for="inputEmail4" class="form-label">MRP Per Piece</label>
                                                                                                    <input type="text" class="form-control" id="edit_mrpprice" name="edit_mrp_price" disabled  onkeypress="return /[0-9.]/i.test(event.key)">
                                                                                                </div>

                                                                                                <div class="col-md-6">
                                                                                                    <label for="distribution_channel" class="form-label">Distribution Channel</label>
                                                                                                    <select class="form-control " name="edit_distribution_channel" id="edit_distribution_channel" disabled>
                                                                                                        <option value="">---</option>
                                                                                                        @foreach ($dist_channel as $item)
                                                                                                        <option value="{{ $item->id }}">{{ $item->dist_name }}</option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>

                                                                                            <br>
                                                                                            <h5 style="display: inline;">Primary Frieght</h5>
                                                                                            <div style="display: none;">
                                                                                                <button style="float: right;background-color: #1643ac !important;" id="edit_location" class="btn btn-sm text-white float-right" type="button" title='Add More...'> <i class="fa fa-plus"></i> </button>
                                                                                            </div>
                                                                                            <hr>

                                                                                            <div  id="editlocation_primary" class="editlocation_primary">

                                                                                                <div class="row edit-primary-location" id="">
                                                                                                    {{-- <div class="col-md-6">
                                                                                                        <label for="inputEmail4" class="form-label">From Location</label>
                                                                                                        <select type="text" class="form-control from_location " placeholder="eg: cuddalore" id="editfromlocation" name="editprimary_from_location[]" required disabled>
                                                                                                            <option value="">---</option>
                                                                                                            @foreach ($primaryfrom as $item)
                                                                                                                <option value="{{ $item->location_name }}">{{ $item->location_name }}</option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                        <span id="from_location_error"></span>
                                                                                                    </div> --}}

                                                                                                    {{-- <div class="col-md-6">
                                                                                                        <label for="inputEmail4" class="form-label">To Location</label>
                                                                                                        <select type="text" class="form-control " placeholder="eg: chennai" id="edittolocation" name="editprimary_to_location[]" required disabled>
                                                                                                        <!-- <select class="form-control" name="distribution_channel" id="distribution_channel"> -->
                                                                                                            <option value="">---</option>
                                                                                                            @foreach ($primaryto as $item)
                                                                                                            <option value="{{ $item->location_name }}">
                                                                                                                {{ $item->location_name }}
                                                                                                            </option>
                                                                                                            @endforeach

                                                                                                        </select>
                                                                                                        <span id="to_location_error"></span>
                                                                                                    </div>
                                                                                                    <div id="delete"></div> --}}
                                                                                                </div>
                                                                                            </div>

                                                                                            <br>
                                                                                            <h5 style="display: inline;">Secondary Frieght (Used Only for Data capture)</h5>
                                                                                            <div style="display: none;">
                                                                                                <button style="float: right;background-color: #1643ac !important;" id="edit_location_secondary" class="btn btn-sm text-white float-right " type="button" title='Add More...'> <i class="fa fa-plus"></i> </button>
                                                                                            </div>
                                                                                            <br>
                                                                                            <hr>

                                                                                            <div class="editlocation_secondary" id="editlocation_secondary">
                                                                                                <div class="row edit-secondary-location">
                                                                                                    {{-- <div class="col-md-6 ">
                                                                                                        <label for="inputEmail4" class="form-label">From Location</label>
                                                                                                            <!-- <select class="form-control" name="distribution_channel" id="distribution_channel"> -->
                                                                                                        <select type="text" class="form-control " placeholder="eg: cuddalore" id="editsecfromlocation" name="editsecondary_from_location[]" required disabled>
                                                                                                            <option value="">---</option>
                                                                                                            @foreach ($primaryto as $item)
                                                                                                            <option value="{{ $item->location_name }}">
                                                                                                                {{ $item->location_name }}
                                                                                                            </option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                        <span id="from_location_error"></span>
                                                                                                    </div>
                                                                                                    <div class="col-md-6">
                                                                                                        <label for="inputEmail4" class="form-label">To Location</label>
                                                                                                        <select type="text" class="form-control " placeholder="eg: chennai" id="editsectolocation" name="editsecondary_to_location[]" required disabled>
                                                                                                            <option value="">---</option>
                                                                                                            @foreach ($secondaryto as $item)
                                                                                                            <option value="{{ $item->location_name }}">
                                                                                                                {{ $item->location_name }}
                                                                                                            </option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                        <span id="to_location_error"></span>
                                                                                                    </div>--}}
                                                                                                </div>
                                                                                            </div>

                                                                                            <br>
                                                                                            {{-- <h5>Margins & Schemes</h5> --}}
                                                                                            <hr>


                                                                                            <div class="row">
                                                                                                <div class="col-md-6 p-3">
                                                                                                    <button type="button" id="save_id" style="margin-left:90%" class="btn btn-sm btn-primary">Update</button>
                                                                                                </div>
                                                                                                <div class="col-md-6 p-3">
                                                                                                    <!-- <button type="button" class="btn btn-sm btn-secondary">Close</button> -->
                                                                                                    <button type="button" id="close1" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>




                                                            {{-- delete pop up  --}}
                                                            <div class="modal fade" id="confirm_modal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="exampleModalToggleLabel">Are you sure?</h4>
                                                                            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <input type="text" value="" id="hid_id" hidden>
                                                                            <p>Do you really want to delete these records? This process cannot be undone.</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                            <button type="button" class="btn btn-danger" id="delete_confirm" onclick="delete_details();">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- delete pop up  --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="profile1" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">

                                                            <ul class="col-12 nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" data-bs-toggle="tab" href="#epd_tab1" role="tab">
                                                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                                        <span class="d-none d-sm-block">EPD</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" data-bs-toggle="tab" href="#epd_tab2" role="tab">
                                                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                        <span class="d-none d-sm-block">EPD Approved</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" data-bs-toggle="tab" href="#epd_tab3" role="tab">
                                                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                        <span class="d-none d-sm-block">EPD Rejected</span>
                                                                    </a>
                                                                </li>
                                                            </ul>

                                                            <div class="tab-content p-3 text-muted">
                                                                <div class="tab-pane active" id="epd_tab1" role="tabpanel">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="table-responsive">
                                                                                <table class="table table-hover" id="exists_product" style="width: 100%;">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>S.NO</th>
                                                                                            <th>Material Code</th>
                                                                                            <th>Division</th>
                                                                                            <th>No of Pcs</th>
                                                                                            <!-- <th>MRP Per Piece</th> -->
                                                                                            <th>Primary Locations</th>
                                                                                            <th>Secondary Locations</th>
                                                                                            <th>Action</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane" id="epd_tab2" role="tabpanel">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="table-responsive">
                                                                                <table class="table table-hover" id="epd_approved" style="width: 100%;">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>S.NO</th>
                                                                                            <th>Material Code</th>
                                                                                            <th>Division</th>
                                                                                            <th>No of Pcs</th>
                                                                                            <!-- <th>MRP Per Piece</th> -->
                                                                                            <th>Primary Locations</th>
                                                                                            <th>Secondary Locations</th>
                                                                                            <th>Action</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="tab-pane" id="epd_tab3" role="tabpanel">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="table-responsive">
                                                                                <table class="table table-hover" id="epd_rejected" style="width: 100%;">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>S.NO</th>
                                                                                            <th>Material Code</th>
                                                                                            <th>Division</th>
                                                                                            <th>No of Pcs</th>
                                                                                            <!-- <th>MRP Per Piece</th> -->
                                                                                            <th>Primary Locations</th>
                                                                                            <th>Secondary Locations</th>
                                                                                            <th>Rejected Field : Remark</th>
                                                                                            <th>Action</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>



                                                                 <!-- //edit epd model -->
                                                                <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" id="edit_epdmodal" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-xl">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="card-content">
                                                                                    <div class="card-body">
                                                                                        <div class="col-12">
                                                                                            <form id="exist-formedit" enctype="multipart/form-data">
                                                                                                <div class="row">
                                                                                                    <h5>Existing Product Information</h5>
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class="col-md-3">
                                                                                                        <label for="material_code" class="form-label">Material Code</label>
                                                                                                        <input type="text" class="form-control" id="edit_mcode" name="edit_mcode" disabled>
                                                                                                        <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                                                                                                    </div>
                                                                                                     <div class="col-md-3">
                                                                                                    <label for="inputEmail4" class="form-label">Division</label>
                                                                                                    <select class="form-control" name="edit_epd_division" id="edit_epd_division" disabled>
                                                                                                        <option value="">---</option>
                                                                                                        @foreach ($division as $item)
                                                                                                        <option value="{{ $item->id }}">
                                                                                                            {{ $item->division }}
                                                                                                        </option>
                                                                                                        @endforeach
                                                                                                    </select>    
                                                                                                     </div>
                                                                                                    <div class="col-md-3">
                                                                                                        <label for="noofpiece" class="form-label">No of Pieces per Case</label>
                                                                                                        <input type="text" class="form-control" placeholder="eg: 10" onkeypress="return /[0-9.]/i.test(event.key)" id="edit_pieces_pcase" name="edit_pieces_pcase" disabled>
                                                                                                        <input type="hidden" class="form-control" id="exhid_id" name="exhid_id">
                                                                                                    </div>
                                                                                                    <div class="col-md-3">
                                                                                                        <label for="exdistribution_channel" class="form-label">Distribution Channel</label>
                                                                                                        <select class="form-control" name="edit_exdistribution_channel" id="edit_exdistribution_channel" disabled>
                                                                                                            <option value="">---</option>
                                                                                                            @foreach ($dist_channel as $item)
                                                                                                            <option value="{{ $item->id }}">{{ $item->dist_name }}</option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </div>
                                                                                                    <!-- <div class="col-md-3">
                                                                                                        <label for="" class="form-label">MRP Per Piece</label>
                                                                                                        <input type="text" class="form-control" placeholder="eg: 1200" onkeypress="return /[0-9.]/i.test(event.key)" id="edit_mrp_price" name="edit_mrp_price" disabled>
                                                                                                        <span id="mrpprice_error" class="alert_color"></span>
                                                                                                    </div> -->
                                                                                                </div>
                                                                                                <br>

                                                                                                <h5 style="display: inline;">Primary Frieght & Schemes</h5>
                                                                                                <!-- <div style="display: inline;">
                                                                                                    <button style="float: right;background-color: #1643ac !important;" id="epd_add_location" class="btn btn-sm text-white float-right" type="button" title='Add More...'> <i class="fa fa-plus"></i> </button>
                                                                                                </div> -->
                                                                                                <div id="editepdPrimaryLocation" class="editepdPrimaryLocation">
                                                                                                    <div class="row edit-epd-primary-location" id="">
                                                                                                        <hr class="mt-4">
                                                                                                        <div class="col-md-6 from_prim_loc">
                                                                                                            <label for="inputEmail4" class="form-label">From Location</label>
                                                                                                            <select type="text" class="form-control from_location primLocation" placeholder="eg: cuddalore" id="editprimfromlocation" name="edit_primaryfrom_location[]" disabled>
                                                                                                                <option value="">---</option>
                                                                                                                @foreach ($primaryfrom as $item)
                                                                                                                <option value="{{ $item->id }}">
                                                                                                                    {{ $item->location }}
                                                                                                                </option>
                                                                                                                @endforeach
                                                                                                            </select>
                                                                                                            <!-- <span id="from_location_error0" class="location-error-field alert_color"></span> -->
                                                                                                        </div>
                                                                                                        <div class="col-md-6 to_prim_loc">
                                                                                                            <label for="inputEmail4" class="form-label">To Location</label>
                                                                                                            <select type="text" class="form-control primLocation" placeholder="eg: chennai" id="editprimtolocation" name="edit_primaryto_location[]" disabled>
                                                                                                                <option value="">---</option>
                                                                                                                @foreach ($primaryto as $item)
                                                                                                                <option value="{{ $item->id }}">
                                                                                                                    {{ $item->location }}
                                                                                                                </option>
                                                                                                                @endforeach
                                                                                                            </select>
                                                                                                            <!-- <span id="from_location_error0" class="location-error-field alert_color"></span> -->
                                                                                                        </div>
                                                                                                        <div class="col-md-3 ret_div">
                                                                                                            <label for="inputEmail4" class="form-label">Retailer Margin % </label>
                                                                                                            <input type="text" class="form-control primLocation rtmargin" placeholder="eg: 0.2" onkeypress="return /[0-9.]/i.test(event.key)" id="editexretailermargin" name="editretailer_margin[]" disabled>
                                                                                                            <!-- <span id="retailermargin_error" class="retailermargin_error alert_color"></span> -->
                                                                                                        </div>
                                                                                                        <div class="col-md-3 prim_div">
                                                                                                            <label for="inputEmail4" class="form-label"> Primary Scheme %</label>
                                                                                                            <input type="text" class="form-control primLocation primScheme" placeholder="eg: 2.7" onkeypress="return /[0-9.]/i.test(event.key)" id="editexprimaryscheme" name="editprimary_scheme[]" disabled>
                                                                                                            <!-- <span id="primaryscheme_error" class="primaryscheme_error alert_color"></span> -->
                                                                                                        </div>
                                                                                                        <div class="col-md-3 rs_div">
                                                                                                            <label for="inputEmail4" class="form-label">RS Margin %</label>
                                                                                                            <input type="text" class="form-control primLocation rsmargn" placeholder="eg: 7.0" id="editexrsmargin" onkeypress="return /[0-9.]/i.test(event.key)" name="editrs_margin[]" disabled>
                                                                                                            <!-- <span id="rsmargin_error" class="rsmargin_error alert_color"></span> -->
                                                                                                        </div>
                                                                                                        <div class="col-md-3 ss_div">
                                                                                                            <label for="inputEmail4" class="form-label">SS Margin %</label>
                                                                                                            <input type="text" class="form-control primLocation ssmargn" placeholder="eg: 0.6" onkeypress="return /[0-9.]/i.test(event.key)" id="editexssmargin" name="editss_margin[]" disabled>
                                                                                                            <!-- <span id="ssmargin_error" class="ssmargin_error alert_color"></span> -->
                                                                                                        </div>
                                                                                                        <div id="delete"></div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br>

                                                                                                <h5 style="display: inline;">Secondary Frieght (Used Only for Data capturing)</h5>
                                                                                                <div style="display: inline;">
                                                                                                    <button style="float: right;background-color: #1643ac !important;" id="epd_add_SecLocation" class="btn btn-sm text-white float-right " type="button" title='Add More...'> <i class="fa fa-plus"></i> </button>
                                                                                                </div>
                                                                                                <br>
                                                                                                <hr>
                                                                                                <div class="editepdSecLocation" id="editepdSecLocation">
                                                                                                    <div class="row edit-epd-secondary-location">
                                                                                                        <div class="col-md-6 from_sec_loc">
                                                                                                            <label for="inputEmail4" class="form-label">From Location</label>
                                                                                                            <select type="text" class="form-control primLocation" placeholder="eg: cuddalore" id="editseconfromlocation" name="editsecondaryfrom_location[]" disabled>
                                                                                                                <option value="">---</option>
                                                                                                                @foreach ($primaryto as $item)
                                                                                                                <option value="{{ $item->id }}">
                                                                                                                    {{ $item->location }}
                                                                                                                </option>
                                                                                                                @endforeach
                                                                                                            </select>
                                                                                                            <!-- <span id="from_location_error0" class="location-error-field alert_color"></span> -->
                                                                                                        </div>
                                                                                                        <div class="col-md-6 to_sec_loc">
                                                                                                            <label for="inputEmail4" class="form-label">To Location</label>
                                                                                                            <select type="text" class="form-control primLocation" placeholder="eg: chennai" id="editsecontolocation" name="editsecondaryto_location[]" disabled>
                                                                                                                <option value="">---</option>
                                                                                                                @foreach ($secondaryto as $item)
                                                                                                                <option value="{{ $item->id }}">
                                                                                                                    {{ $item->location }}
                                                                                                                </option>
                                                                                                                @endforeach
                                                                                                            </select>
                                                                                                            <!-- <span id="from_location_error0" class="location-error-field alert_color"></span> -->
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="row">
                                                                                                    <div class="col-md-6 p-3">
                                                                                                        <button type="button" id="exist_save_id" hidden class="btn btn-sm btn-primary float-end">Update</button>
                                                                                                    </div>
                                                                                                    <div class="col-md-6 p-3">
                                                                                                        <button type="button" id="close1" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.modal-content -->
                                                                    </div>
                                                                    <!-- /.modal-dialog -->
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <!-- /.modal-dialog -->
            </div>

        </div>
    </div>

    <!-- <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" id="edit_exist_modal" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="col-12">
                                <form id="formedit-exist" enctype="multipart/form-data">
                                    <div class="row">
                                        <h5>Existing Product Information</h5>
                                    </div>
                                    <div class="row">
                                        <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                                        <input type="hidden" class="form-control" id="exedit_id" name="exedit_id">
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label">Material Code</label>
                                            <input type="text" class="form-control" name="edit_material_code" id="edit_material_code" placeholder="xxx" disabled>
                                            <span id="edit_epd_material_code_error" class="alert_color"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label">No of Pieces per Case</label>
                                            <input type="text" class="form-control" placeholder="eg: 10" id="edit_pieces_per_case" name="edit_pieces_per_case" disabled>
                                            <span id="edit_epd_pieces_per_case_error" class="alert_color"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label">MRP Per Piece</label>
                                            <input type="text" class="form-control" placeholder="eg: 1200" id="edit_mrp_piece" name="edit_mrp_piece" disabled>
                                            <span id="edit_mrpprice_error" class="alert_color"></span>
                                        </div>
                                    </div>

                                    <br>
                                    <h5>Margins & Schemes</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label">Retailer Margin % </label>
                                            <input type="text" class="form-control" id="edit_retailer_margin" name="edit_retailer_margin" disabled>
                                            <span id="edit_retailermargin_error" class="alert_color"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label">Primary Scheme %</label>
                                            <input type="text" class="form-control" id="edit_primary_scheme" name="edit_primary_scheme" disabled>
                                            <span id="edit_primaryscheme_error" class="alert_color"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label">RS Margin %</label>
                                            <input type="text" class="form-control" id="edit_rs_margin" name="edit_rs_margin" disabled>
                                            <span id="edit_rsmargin_error" class="alert_color"></span>
                                        </div>
                                        <div class="col-md-6 ">
                                            <label for="inputEmail4" class="form-label">SS Margin %</label>
                                            <input type="text" class="form-control" id="edit_ss_margin" name="edit_ss_margin" disabled>
                                            <span id="edit_ssmargin_error" class="alert_color"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 p-3">
                                            <button type="button" id="exist_save_id" style="margin-left:90%" class="btn btn-md btn-primary">Update</button>
                                        </div>
                                        <div class="col-md-6 p-3">
                                            <button type="button" id="close1" class="btn btn-md btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    {{-- delete pop up  --}}
    <div class="modal fade" id="exist_confirm_modal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalToggleLabel">Are you sure?</h4>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    <input type="text" value="" id="exid_id" hidden>
                    <p>Do you really want to delete these records? This process cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="delete_confirm" onclick="exdelete_details();">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="remarks_modal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalToggleLabel">Remarks</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="remarks_tab"></div>

                </div>

            </div>
        </div>
    </div>
    {{-- delete pop up  --}}


    <!-- End Page-content -->

    @extends('layout.footer')
    <!-- end container-fluid -->

    @extends('layout.right-sidebar');

    <!-- JAVASCRIPT -->
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/metismenujs/metismenujs.min.js"></script>
    <script src="../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../assets/libs/eva-icons/eva.min.js"></script>
     <!-- Vector map-->
    <script src="../assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="../assets/libs/jsvectormap/maps/world-merc.js"></script>
    <script src="../assets/js/pages/dashboard.init.js"></script>
    <script src="../assets/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        function open_remarks(id){
           $("#remarks_modal").modal('show');

            $.ajax({
                url: "{{ url('view_remarks') }}",
                type: "POST",
                data: {
                    id:id,
                    "type": "market"
                },
                success: function(data) {
                    var html='';
                    for(i=0; i<data.data.length; i++) {
                        var j=i+1;
                        html+="<p>"+j+"."+data.data[i]+"</p>";

                    }
                    $("#remarks_tab").html(html);

                }
            });
        }
        $(document).ready(function() {

            table = $('#product_details').DataTable({
                autowidth: false,
                'ajax': {
                    url: "{{ url('show') }}",
                    // type: 'POST'
                },
                'columns': [{
                        title: "S.no",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },

                    {
                        data: 'Product_Name'
                    },
                    {
                        data: 'Fill_Volume'
                    },
                    {
                        data: 'Division'
                    },
                    {
                        data: 'Cofiguration'
                    },
                    {
                        data: 'Quantity'
                    },
                    {
                        data: 'distribution_value'
                    },
                    {
                        data: 'Price'
                    },
                    {
                        data: 'primary_Location'
                    },
                    {
                        data: 'secondary_Location'
                    },
                    {
                        data: 'Action',
                    },
                ],
            });

            table1 = $('#product_details1').DataTable({
                autowidth: false,
                'ajax': {
                    url: "{{ url('show_rejected') }}",
                    // type: 'POST'
                },
                'columns': [{
                        title: "S.no",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },

                    {
                        data: 'Product_Name'
                    },
                    {
                        data: 'Fill_Volume'
                    },
                    {
                        data: 'Division'
                    },
                    {
                        data: 'Cofiguration'
                    },
                    {
                        data: 'Quantity'
                    },
                    {
                        data: 'distribution_value'
                    },
                    {
                        data: 'Price'
                    },
                    {
                        data: 'primary_Location'
                    },
                    {
                        data: 'secondary_Location'
                    },
                    {
                        data: 'rejected',
                    },
                    {
                        data: 'remarks',
                    },
                    {
                        data: 'Action',
                    },
                ],
            });

            table_app = $('#product_details2').DataTable({
                autowidth: false,
                'ajax': {
                    url: "{{ url('show_approved') }}",
                    // type: 'POST'
                    data:{
                        'app':'app'
                    }
                },
                'columns': [{
                        title: "S.no",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },

                    {
                        data: 'Product_Name'
                    },
                    {
                        data: 'Fill_Volume'
                    },
                    {
                        data: 'Division'
                    },
                    {
                        data: 'Cofiguration'
                    },
                    {
                        data: 'Quantity'
                    },
                    {
                        data: 'distribution_value'
                    },
                    {
                        data: 'Price'
                    },
                    {
                        data: 'primary_Location'
                    },
                    {
                        data: 'secondary_Location'
                    },
                ],
            });
            table2 = $('#exists_product').DataTable({
                "autoWidth": false,
                'ajax': {
                    url: "{{ url('exists_product')}}",
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'material_code',
                        name: 'material_code'
                    },
                    {
                        data: 'division',
                        name: 'division'
                    },
                    {
                        data: 'pieces_per_case',
                        name: 'pieces_per_case'
                    },
                    // {
                    //     data: 'mrp_piece',
                    //     name: 'mrp_piece'
                    // },
                    {
                        data: 'prim_location',
                        name: 'prim_location'
                    },
                    {
                        data: 'sec_location',
                        name: 'sec_location'
                    },
                    {
                        data:'action'
                    }
                ]
            });

            table3 = $('#epd_approved').DataTable({
                "autoWidth": false,
                'ajax': {
                    url: "{{ url('exists_approved')}}",
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'material_code',
                        name: 'material_code'
                    },
                    {
                        data: 'division',
                        name: 'division'
                    },
                    {
                        data: 'pieces_per_case',
                        name: 'pieces_per_case'
                    },
                    // {
                    //     data: 'mrp_piece',
                    //     name: 'mrp_piece'
                    // },
                    {
                        data: 'prim_location',
                        name: 'prim_location'
                    },
                    {
                        data: 'sec_location',
                        name: 'sec_location'
                    },
                    {
                        data:'action'
                    }
                ]
            });


            table4 = $('#epd_rejected').DataTable({
                "autoWidth": false,
                'ajax': {
                    url: "{{ url('exists_rejected')}}",
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'material_code',
                        name: 'material_code'
                    },
                     {
                        data: 'division',
                        name: 'division'
                    },
                    {
                        data: 'pieces_per_case',
                        name: 'pieces_per_case'
                    },
                    // {
                    //     data: 'mrp_piece',
                    //     name: 'mrp_piece'
                    // },
                    {
                        data: 'prim_location',
                        name: 'prim_location'
                    },
                    {
                        data: 'sec_location',
                        name: 'sec_location'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data:'action'
                    }
                ]
            });


        });

        $("#sub").click(function() {
            $("#sub").attr('disabled',true);
            $("#product_name_error").html('');
            $("#Volume_error").html('');
            $("#uom_error").html('');
            $("#case_configuration_error").html('');
            $("#quantity_error").html('');
            $("#mrp_price_error").html('');
            $("#distribution_channel_error").html('');
            $(".location-error-field").html('');
            $(".retailer_margin_error").html('');
            $(".primary_scheme_error").html('');
            $(".ss_margin_error").html('');
            $("#division_error").html('');
            $(".rs_margin_error").html('');
            $(".common_location").each(function(){
                if($(this).val()!=''){
                }else{
                    $("#sub").attr('disabled',false);
                    $(this).closest('.from_prim_loc').find('span.location-error-field').html('From Primary Location Field is Required')
                    $(this).closest('.to_prim_loc').find('span.location-error-field').html('To Primary Location Field is Required')
                    $(this).closest('.from_sec_loc').find('span.location-error-field').html('From Secondary Location Field is Required')
                    $(this).closest('.to_sec_loc').find('span.location-error-field').html('To Secondary Location Field is Required')
                    $(this).closest('.rs_div').find('span.rs_margin_error').html('RS Margin is required');
                    $(this).closest('.ss_div').find('span.ss_margin_error').html('SS Margin is required');
                    $(this).closest('.ret_div').find('span.retailer_margin_error').html('Retailer Margin is required');
                    $(this).closest('.pri_div').find('span.primary_scheme_error').html('Primary Scheme is required');
                }
            })
            var formData = new FormData($('#formadd')[0]);
            $.ajax({
                url: "{{ url('savemarket') }}",
                method: "POST",
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                if(data.error){
                    // console.log('err');
                    $("#sub").attr('disabled',false);
                    var keys=Object.keys(data.error);
                                    $.each( data.error, function( key, value ) {
                                    $("#"+key+'_error').text(value);
                                    $("#"+key+'_error').addClass('alert_color');

                                    $("#"+key+'_error').show();
                                    });
                }else{
                    // console.log('succ');

                    $("#formadd")[0].reset();
                    table.ajax.reload();
                    Swal.fire(
                        'Product Successfully Inserted!',
                        'You clicked the button!',
                        'success'
                    )
                    $('#productModal').modal('hide');
                }

                }
            });
        });

        function edit_details(id,sts) {
            // $("#editlocation_primary").load(location.href + " #editlocation_primary");
            // $("#editlocation_secondary").load(location.href + " #editlocation_secondary");
            $("#editlocation_primary").html(" ");
            $("#editlocation_secondary").html("");
            var st=sts;
            $.ajax({
                url: '{{ 'edit_details' }}',
                type: 'GET',
                data: {
                    id: id,
                },
                success: function(data) {
                    $('#save_id').prop('hidden', true);
                    $('#edit_caseconfiguration').prop('disabled', true);
                    $('#edit_lquantity').prop('disabled', true);
                    $('#edit_mrpprice').prop('disabled', true);
                    $('.edit_primaryscheme').prop('disabled', true);
                    $('.edit_rsmargin').prop('disabled', true);
                    $('.edit_ssmargin').prop('disabled', true);
                    $('.edit_retailermargin').prop('disabled', true);
                    if(data.result.b_volume_approval == 2){
                    $('#edit_fVolume').removeAttr('disabled');
                    $('#save_id').removeAttr('hidden');
                    }
                    if(data.result.b_case_approval == 2){
                    $('#save_id').removeAttr('hidden');
                        $('#edit_caseconfiguration').removeAttr('disabled');
                    }
                    if(data.result.b_quantity_approval == 2){

                    $('#save_id').removeAttr('hidden');
                    $('#edit_lquantity').removeAttr('disabled');
                    }
                    if(data.result.b_mrp_price_approval == 2){
                    $('#save_id').removeAttr('hidden');
                    $('#edit_mrpprice').removeAttr('disabled');
                    }
                    $("#status_bar").val(st);
                    $('#hid_id').val(data.result.id);
                    $('#edit_pname').val(data.result.Product_name);
                    $('#edit_fVolume').val(data.result.Volume);
                    $('#edit_caseconfiguration').val(data.result.case_configuration);
                    $('#edit_lquantity').val(data.result.quantity);
                    $('#edit_mrpprice').val(data.result.mrp_price);
                    $('#edit_distribution_channel').val(data.result.distribution_value);
                    $('#edit_division').val(data.result.division);

                    $('#edit_fromlocation').val(data.result.from_location);
                    $('#edit_tolocation').val(data.result.to_location);
                    // $('.edit_retailermargin').val(data.result.retailer_margin);
                    // $('.edit_primaryscheme').val(data.result.primary_scheme);
                    // $('.edit_rsmargin').val(data.result.rs_margin);
                    // $('.edit_ssmargin').val(data.result.ss_margin);
                    $('#edit_select_uom').val(data.result.uom);
                    $('#edit_modal').modal('show');

                    $('#editfromlocation').val(data.prim1[0].location);
                    $('#edittolocation').val(data.prim2[0].location);

                    $('#editsecfromlocation').val(data.second1[0].location);
                    $('#editsectolocation').val(data.second2[0].location);


                    for(i=0;i<data.pcount;i++){
                        var str = data.prim1[i].location;
                        var str_to = data.prim2[i].location;
                        var rs = data.prim1[i].rs_margin;
                        var ss = data.prim1[i].ss_margin;
                        var ret_margin = data.prim1[i].retailer_margin;
                        var pscheme = data.prim1[i].primary_scheme;
                       $('#editlocation_primary').append('<div class="row"><div class="col-md-6"><label for="inputEmail4" class="form-label">From Location</label><input type="text" class="form-control  from_location" placeholder="eg: cuddalore" id="editfromlocations'+i+'" name="editprimary_from_location[]" value="'+str+'" required disabled></div><div class="col-md-6"><label for="inputEmail4" class="form-label">To Location</label><input class="form-control " value="'+str_to+'" placeholder="eg: chennai" id="edittolocations'+i+'" name="editprimary_to_location[]" required disabled></div></div><div class="row mt-1"> <div class="col-md-3"> <label for="inputEmail4" class="form-label">Retailer Margin % </label><input type="text" class="form-control edit_retailermargin" id="" name="edit_retailer_margin[]"  disabled  value="'+ret_margin+'"> </div><div class="col-md-3"><label for="inputEmail4" class="form-label"> Primary Scheme %</label><input type="text" class="form-control edit_primaryscheme" id="" name="edit_primary_scheme[]" disabled  value="'+pscheme+'"></div><div class="col-md-3"><label for="inputEmail4" class="form-label">RS Margin % </label><input type="text" class="form-control edit_rsmargin" id="" name="edit_rs_margin[]" disabled  value="'+rs+'"></div> <div class="col-md-3 "><label for="inputEmail4" class="form-label">SS Margin %</label><input type="text" class="form-control edit_ssmargin" id="" name="edit_ss_margin[]" disabled  value="'+ss+'"></div> </div> <hr class="m-3">')

                    }

                    for(j=0;j<data.scount;j++){
                        var sfrom = data.second1[j].location;
                        var sto = data.second2[j].location;
                        $('#editlocation_secondary').append('<div class="row"><div class="col-md-6"><label for="inputEmail4" class="form-label">From Location</label><input  type="text" class="form-control readonly-select from_location" value="'+sfrom+'" placeholder="eg: cuddalore" id="editsecfromlocations'+j+'" name="editsecondary_from_location[]" required readonly></div><div class="col-md-6"><label for="inputEmail4" class="form-label">To Location</label><input class="form-control readonly-select" placeholder="eg: chennai" value="'+sto+'" id="editsectolocations'+j+'" name="editsecondary_to_location[]" required readonly></div></div>');

                    }
                    if(data.result.b_rs_margin_approval == 2){
                    $('#save_id').removeAttr('hidden');
                    $('.edit_rsmargin').removeAttr('disabled');
                    }
                    if(data.result.b_primary_scheme_approval == 2){

                    $('#save_id').removeAttr('hidden');
                    $('.edit_primaryscheme').removeAttr('disabled');
                    }

                    if(data.result.b_ss_margin_approval== 2){

                    $('#save_id').removeAttr('hidden');
                    $('.edit_ssmargin').removeAttr('disabled');
                    }
                    if(data.result.b_retailer_margin_approval == 2){
                    $('#save_id').removeAttr('hidden');
                    $('.edit_retailermargin').removeAttr('disabled');
                    }

                }
            });
        }

        $('#save_id').click(function() {
            var formData = new FormData($('#formedit')[0]);
            $.ajax({
                url: "{{ url('update_details') }}",
                type: 'POST',
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    $('#edit_modal').modal('hide');
                    toastr.success('updated successfully');
                    table.ajax.reload();
                    table1.ajax.reload();
                }
            });
        })



        function open_confirm(id) {
            $('#confirm_modal').modal('show');
            $('#hid_id').val(id);
        }

        function delete_details() {
            var id = $('#hid_id').val();
            $.ajax({
                url: "{{ url('delete_basic') }}",
                data: {
                    id: id
                },
                success: function(data) {
                    $('#confirm_modal').modal('hide');
                    toastr.success('deleted successfully');
                    table.ajax.reload();
                }
            });
        }


        $('#productModal').on('hidden.bs.modal', function() {
            $("#formadd")[0].reset();
        });


        function open_exconfirm(id) {
            $('#exist_confirm_modal').modal('show');
            $('#exid_id').val(id);
        }

        function exdelete_details() {
            var id = $('#exid_id').val();
            $.ajax({
                url: "{{ url('delete_ex') }}",
                data: {
                    id: id
                },
                success: function(data) {
                    $('#exist_confirm_modal').modal('hide');
                    toastr.success('deleted successfully');
                    table2.ajax.reload();
                }
            });
        }

        $("#fix").click(function() {
            var pro_ty = $('#product_type').val();
            // alert(pro_ty);
            if(pro_ty == 'New Product'){
                $('#productModal').modal('show');
            $('#tycheck').modal('hide');
                $("#formcheck")[0].reset();
            }else if(pro_ty == 'Existing Product'){
                $('#exist-productModal').modal('show');
                $('#tycheck').modal('hide');
                $("#formcheck")[0].reset();
            }else{
                $('#pro_type').text('Please select Type');
            }
            $("#sub").attr('disabled',false);

        });

        document.getElementById('edit_location').addEventListener('click', function () {
            const primaryLocationsDiv = document.getElementById('editlocation_primary');
            const newPrimaryLocation = document.querySelector('.edit-primary-location').cloneNode(true);
            addDeleteButton(newPrimaryLocation);
            primaryLocationsDiv.appendChild(newPrimaryLocation);
        });

        document.getElementById('edit_location_secondary').addEventListener('click', function () {
            const SecondaryLocationsDiv = document.getElementById('editlocation_secondary');
            const newSecondaryLocation = document.querySelector('.edit-secondary-location').cloneNode(true);
            addDeleteButton(newSecondaryLocation);
            SecondaryLocationsDiv.appendChild(newSecondaryLocation);
        });
        $(document).on('change','select[name="primary_to_location[]"]',function(){
            var primto=0;
            $('select[name="primary_to_location[]"]').each(function(){
                var secfrom=$('.npd_prim_to_'+primto).val();
                $('.npd_second_from_'+primto).val(secfrom);
                primto++;

            })

        })
         $(document).on('change','select[name="primaryto_location[]"]',function(){
            var epdprim=0;
            $('select[name="primaryto_location[]"]').each(function(){
                var epdsecfrom=$('.epd_prim_to_'+epdprim).val();
                $('.epd_sec_from_'+epdprim).val(epdsecfrom);
                epdprim++;

            })

        })
      var selectElements = document.getElementsByName('secondary_from_location[]');

        for (var i = 0; i < selectElements.length; i++) {
            selectElements[i].addEventListener('mousedown', function(event) {
                event.preventDefault();
            }, false);
        }
          var selectElements1 = document.getElementsByName('secondaryfrom_location[]');

        for (var i = 0; i < selectElements1.length; i++) {
            selectElements1[i].addEventListener('mousedown', function(event) {
                event.preventDefault();
            }, false);
        }
        var ps=1;
        document.getElementById('add_location').addEventListener('click', function () {
            $("#add_location_secondary").click();
              var selectElements = document.getElementsByName('secondary_from_location[]');

        for (var i = 0; i < selectElements.length; i++) {
            selectElements[i].addEventListener('mousedown', function(event) {
                event.preventDefault();
            }, false);
        }
            const primaryLocationsDiv = document.getElementById('addlocation_primary');
            const newPrimaryLocation = document.querySelector('.primary-location').cloneNode(true);
            
            const inputFields = newPrimaryLocation.querySelectorAll('input');
            inputFields.forEach(function (input) {
                input.value = '';
            });
             newPrimaryLocation.querySelector('select[name="primary_to_location[]"]').classList.add('npd_prim_to_' + ps);
              newPrimaryLocation.querySelector('select[name="primary_to_location[]"]').classList.remove('npd_prim_to_0');
            addDeleteButton(newPrimaryLocation,ps);
            const deleteButton = '<button id="delete_secondary" class="primeremove_'+ ps +'" onclick="removeField(this)"><i class="fa fa-trash"></i></button><span id="from_location_error' + ps + '"></span><span id="to_location_error' + ps + '"></span>';
            primaryLocationsDiv.appendChild(newPrimaryLocation);
            ps++;
        });

        var sp=1;
        document.getElementById('add_location_secondary').addEventListener('click', function () {

            const SecondaryLocationsDiv = document.getElementById('addlocation_secondary');
            const newSecondaryLocation = document.querySelector('.secondary-location').cloneNode(true);
             newSecondaryLocation.querySelector('select[name="secondary_from_location[]"]').classList.add('npd_second_from_' + sp);
              newSecondaryLocation.querySelector('select[name="secondary_from_location[]"]').classList.remove('npd_second_from_0');
            addDeleteButton1(newSecondaryLocation,sp);
            SecondaryLocationsDiv.appendChild(newSecondaryLocation);
            sp++;
        });

        // function addDeleteButton(element) {
        //     const deleteBtn = document.createElement('button');
        //     deleteBtn.type = 'button';
        //     deleteBtn.textContent = 'X';
        //     deleteBtn.style = 'width: 30px;border: 1px solid #867070;background-color: #d43131;color: white; margin-left:11px';

        //     deleteBtn.className = 'delete-btn btn btn-sm mt-1';
        //     deleteBtn.addEventListener('click', function () {
        //         element.remove();
        //     });
        //     element.appendChild(deleteBtn);
        // }


        function addDeleteButton(element,ps) {
           // Create a container div for the button
            const buttonContainer = document.createElement('div');
            buttonContainer.style = 'display: flex; justify-content: flex-end;';

            const deleteBtn = document.createElement('button');
            deleteBtn.type = 'button';
            deleteBtn.textContent = 'X';
            deleteBtn.style = 'width: 30px; border: 1px solid #867070; background-color: #d43131; color: white;';

            deleteBtn.className = 'delete-btn btn btn-sm mt-1 ps'+ps+'';
            deleteBtn.addEventListener('click', function () {
                $(".sp"+ps).click();
                element.remove();
            });

            buttonContainer.appendChild(deleteBtn);
            element.appendChild(buttonContainer);
        }
         function addDeleteButton1(element,sp) {
           // Create a container div for the button
            const buttonContainer = document.createElement('div');
            buttonContainer.style = 'display: flex; justify-content: flex-end; ';

            const deleteBtn = document.createElement('button');
            deleteBtn.type = 'button';
            deleteBtn.textContent = 'X';
            deleteBtn.style = 'width: 30px; border: 1px solid #867070; background-color: #d43131; color: white;visibility:hidden';

            deleteBtn.className = 'delete-btn btn btn-sm mt-1 sp'+sp+'';
            deleteBtn.addEventListener('click', function () {
                element.remove();
            });

            buttonContainer.appendChild(deleteBtn);
            element.appendChild(buttonContainer);
        }
        function removeField(btn) {
            const parentDiv = btn.parentElement;
            parentDiv.remove();
        }


        ///EPD Form
        var epd=1;
        document.getElementById('epd_add_location').addEventListener('click', function () {
            $("#epd_add_SecLocation").click();
                var selectElements1 = document.getElementsByName('secondaryfrom_location[]');

        for (var i = 0; i < selectElements1.length; i++) {
            selectElements1[i].addEventListener('mousedown', function(event) {
                event.preventDefault();
            }, false);
        }
            const primaryLocationsDiv = document.getElementById('epdPrimaryLocation');
            const newPrimaryLocation = document.querySelector('.epd-primary-location').cloneNode(true);

            const inputFields = newPrimaryLocation.querySelectorAll('input');
            inputFields.forEach(function (input) {
                input.value = '';
            });
                newPrimaryLocation.querySelector('select[name="primaryto_location[]"]').classList.add('epd_prim_to_' + epd);
              newPrimaryLocation.querySelector('select[name="primaryto_location[]"]').classList.remove('epd_prim_to_0');
            addDeleteButton(newPrimaryLocation,epd);
            const delete_button = '<button onclick="removeField(this)"><i class="fa fa-trash"></i></button><span id="from_location_error'+epd+'"></span><span id="to_location_error'+epd+'"></span>';

            primaryLocationsDiv.appendChild(newPrimaryLocation);
            epd++;
        });

          var epdsec=1;
        document.getElementById('epd_add_SecLocation').addEventListener('click', function () {
            const SecondaryLocationsDiv = document.getElementById('epdSecLocation');
            const newSecondaryLocation = document.querySelector('.epd-secondary-location').cloneNode(true);
              newSecondaryLocation.querySelector('select[name="secondaryfrom_location[]"]').classList.add('epd_sec_from_' + epdsec);
              newSecondaryLocation.querySelector('select[name="secondaryfrom_location[]"]').classList.remove('epd_sec_from_0');
            addDeleteButton1(newSecondaryLocation,epdsec);
            SecondaryLocationsDiv.appendChild(newSecondaryLocation);
            epdsec++;
        });


        //EPD Edit Form

        $("#exist-sub").click(function() {
            $('#exist-sub').prop('disabled', true);
            $('#exist-sub').text('Processing..');
            $('#epd_material_code_error').text('');
            $('#epd_pieces_per_case_error').text('');
            // $('#mrpprice_error').text('');
            $('#epd_exdistribution_channel_error').text('');
            $('#epd_epd_division_error').text('');

            $(".location-error-field").text('');
            $('.retailermargin_error').text('');
            $('.primaryscheme_error').text('');
            $('.rsmargin_error').text('');
            $('.ssmargin_error').text('');
            $(".primLocation").each(function(){
                if($(this).val()!=''){
                }else{
                    $(this).closest('.from_prim_loc').find('span.location-error-field').html('From Primary Location Field is Required')
                    $(this).closest('.to_prim_loc').find('span.location-error-field').html('To Primary Location Field is Required')
                    $(this).closest('.from_sec_loc').find('span.location-error-field').html('From Secondary Location Field is Required')
                    $(this).closest('.to_sec_loc').find('span.location-error-field').html('To Secondary Location Field is Required')
                    $(this).closest('.rs_div').find('span.rsmargin_error').html('RS Margin is required');
                    $(this).closest('.ss_div').find('span.ssmargin_error').html('SS Margin is required');
                    $(this).closest('.ret_div').find('span.retailermargin_error').html('Retailer Margin is required');
                    $(this).closest('.prim_div').find('span.primaryscheme_error').html('Primary Scheme is required');
                }
            })

            var formData = new FormData($('#exist-formadd')[0]);
            $.ajax({
                url: "{{ url('exist_save') }}",
                method: "POST",
                contentType: false,
                processData: false,
                data: formData,
                success: function(response) {
                    $('#exist-sub').prop('disabled', false);
                    $('#exist-sub').text('Submit');

                    if (response.success) {
                        $("#exist-formadd")[0].reset();
                        table2.ajax.reload();
                        Swal.fire(
                            'Product Successfully Inserted!',
                            'You clicked the button!',
                            'success'
                        )
                        $('#exist-productModal').modal('hide');
                    }else{
                        console.error("Unexpected response format in success");
                         var keys=Object.keys(response.error);
                                    $.each( response.error, function( key, value ) {
                                    $("#epd_"+key+'_error').text(value);
                                    $("#epd_"+key+'_error').addClass('alert_color');

                                    $("#epd_"+key+'_error').show();
                                    });
              
                    }
                },
                error: function(response) {

                    $('#epd_material_code_error').text(response.responseJSON.errors.material_code);
                    $('#epd_pieces_per_case_error').text(response.responseJSON.errors.pieces_per_case);
                    $('#epd_exdistribution_channel_error').text(response.responseJSON.errors.exdistribution_channel);
                  
                     $('#epd_epd_division_error').text(response.responseJSON.errors.division);
                }
            });
        });

        $('#exist_save_id').click(function() {

            $('#exist_save_id').prop('disabled', true);
            $('#exist_save_id').text('Processing..');
            var formData = new FormData($('#exist-formedit')[0]);
            $.ajax({
                url: "{{ url('update_exist_details') }}",
                type: 'POST',
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    $('#exist_save_id').prop('disabled', false);
                    $('#exist_save_id').text('Update');

                    if(data.status == 'success'){
                        $('#edit_epdmodal').modal('hide');
                        toastr.success('updated successfully');
                        table2.ajax.reload();
                        table3.ajax.reload();
                        table4.ajax.reload();
                    }
                },
            });
        })

        // function edit_exist_details(id) {
        //     $.ajax({
        //         url: '{{'edit_exist_details'}}',
        //         type: 'GET',
        //         data: {
        //             id: id
        //         },
        //         success: function(data) {

        //             if(data.result.noofpcs_approval == 'rejected'){
        //                 $('#edit_pieces_per_case').attr('disabled', false);
        //             }
        //             if(data.result.mrp_pcs_approval == 'rejected'){
        //                 $('#edit_mrp_piece').attr('disabled', false);
        //             }
        //             if(data.result.retailer_mapproval == 'rejected'){
        //                 $('#edit_retailer_margin').attr('disabled', false);
        //             }
        //             if(data.result.pscheme_approval == 'rejected'){
        //                 $('#edit_primary_scheme').attr('disabled', false);
        //             }
        //             if(data.result.pscheme_approval == 'rejected'){
        //                 $('#edit_rs_margin').attr('disabled', false);
        //             }
        //             if(data.result.rsmargin_approval == 'rejected'){
        //                 $('#edit_rs_margin').attr('disabled', false);
        //             }
        //             if(data.result.ssmargin_approval == 'rejected'){
        //                 $('#edit_ss_margin').attr('disabled', false);
        //             }


        //             $('#exedit_id').val(data.result.id);
        //             $('#edit_material_code').val(data.result.material_code);
        //             $('#edit_pieces_per_case').val(data.result.pieces_per_case);
        //             $('#edit_mrp_piece').val(data.result.mrp_piece);
        //             $('#edit_retailer_margin').val(data.result.retailer_margin);
        //             $('#edit_primary_scheme').val(data.result.primary_scheme);
        //             $('#edit_rs_margin').val(data.result.rs_margin);
        //             $('#edit_ss_margin').val(data.result.ss_margin);
        //             $('#edit_exist_modal').modal('show');
        //         }
        //     });
        // }


        function edit_epddetails(id) {
            $(".expremove_div").html(" ");
            $(".exremove_div").html("");
            $.ajax({
                url: '{{ 'edit_epddetails' }}',
                type: 'GET',
                data: {
                    id: id,
                },
                success: function(data) {
                    $('#edit_epdmodal').modal('show');
                    // $('#edit_mrp_price').prop('disabled', true);
                    $('#edit_pieces_pcase').prop('disabled', true);
                    $('#edit_exdistribution_channel').prop('disabled', true);
                    $('.primScheme').prop('disabled', true);
                    $('.rtmargin').prop('disabled', true);
                    $('.rsmargn').prop('disabled', true);
                    $('.ssmargn').prop('disabled', true);

                    $('#exhid_id').val(id);
                    $('#edit_mcode').val(data.result.material_code);
                    $('#edit_epd_division').val(data.result.division);
                    $('#edit_pieces_pcase').val(data.result.pieces_per_case);
                    $('#edit_exdistribution_channel').val(data.result.distribution_channel);
                    // $('#edit_mrp_price').val(data.result.mrp_piece);

                    //check reject or unreject
                    if(data.result.noofpcs_approval == 'rejected'){
                        $('#edit_pieces_pcase').removeAttr('disabled');
                        $('#exist_save_id').removeAttr('hidden');
                    }
                    // if(data.result.mrp_pcs_approval == 'rejected'){
                    //     // $('#edit_mrp_price').removeAttr('disabled');
                    //     $('#exist_save_id').removeAttr('hidden');
                    // }

                    $('#editprimfromlocation').val(data.prim1[0].from_location);
                    $('#editprimtolocation').val(data.prim2[0].to_location);
                    $('#editexretailermargin').val(data.prim1[0].retailer_margin);
                    $('#editexprimaryscheme').val(data.prim1[0].primary_scheme);
                    $('#editexrsmargin').val(data.prim1[0].rs_margin);
                    $('#editexssmargin').val(data.prim1[0].ss_margin);
                          
                    $('#editseconfromlocation').val(data.second1[0].from_location);
                    $('#editsecontolocation').val(data.second2[0].to_location);
                     
                    for(i=1;i<data.pcount;i++){
                        var frmlocate = data.prim1[i].location;
                        var tolocate = data.prim2[i].location;
                        var retailermar = data.prim1[i].retailer_margin;
                        var rsch = data.prim1[i].primary_scheme;
                        var rsmar = data.prim1[i].rs_margin;
                        var ssmar = data.prim1[i].ss_margin;
                        $('#editepdPrimaryLocation').append(' <div class="row expremove_div edit-epd-primary-location"><hr class="mt-4"><div class="col-md-6 from_prim_loc"><label class="form-label">From Location</label><input type="text" class="form-control exprimLocation" id="editprimfromlocation" name="edit_primaryfrom_location[]" value='+frmlocate+' disabled></div><div class="col-md-6 to_prim_loc"><label class="form-label">To Location</label><input type="text" class="form-control exprimLocation" id="editprimtolocation" name="edit_primaryto_location[]" value='+tolocate+' disabled></div><div class="col-md-3 exret_div"><label class="form-label">Retailer Margin % </label><input type="text" class="form-control rtmargin exprimLocation" onkeypress="return /[0-9.]/i.test(event.key)" id="editexretailermargin" name="editretailer_margin[]" value='+retailermar+' disabled></div><div class="col-md-3 exprim_div"><label class="form-label">Primary Scheme %</label><input type="text" class="form-control exprimLocation primScheme" onkeypress="return /[0-9.]/i.test(event.key)" id="editexprimaryscheme" name="editprimary_scheme[]" value='+rsch+' disabled></div><div class="col-md-3 exrs_div"><label class="form-label">RS Margin %</label><input type="text" class="form-control rsmargn exprimLocation" id="editexrsmargin" onkeypress="return /[0-9.]/i.test(event.key)" name="editrs_margin[]" value='+rsmar+' disabled></div><div class="col-md-3 ss_div"><label class="form-label">SS Margin %</label><input type="text" class="form-control exprimLocation ssmargn" onkeypress="return /[0-9.]/i.test(event.key)" id="editexssmargin" name="editss_margin[]" value='+ssmar+' disabled></div><div id="delete"></div></div>')
                    }

                    for(j=1;j<data.scount;j++){
                        var sfrom = data.second1[j].location;
                        var sto = data.second2[j].location;
                        $('#editepdSecLocation').append('<div class="row exremove_div edit-epd-secondary-location"><div class="col-md-6 from_sec_loc"><label class="form-label">From Location</label><input type="text" class="form-control exprimLocation" id="editseconfromlocation" name="editsecondaryfrom_location[]" value='+sfrom+' disabled></div><div class="col-md-6 to_sec_loc"><label class="form-label">To Location</label><input type="text" class="form-control exprimLocation" id="editsecontolocation" name="editsecondaryto_location[]" value='+sto+' disabled></div></div>');
                    }


                    if(data.prim1[0].retail_margin_approval == 2){
                        $('.rtmargin').removeAttr('disabled');
                        $('#exist_save_id').removeAttr('hidden');
                    }

                    if(data.prim1[0].prim_scheme_approval == 2){
                        $('.primScheme').removeAttr('disabled');
                        $('#exist_save_id').removeAttr('hidden');
                    }

                    if(data.prim1[0].rsm_approval == 2){
                        $('.rsmargn').removeAttr('disabled');
                        $('#exist_save_id').removeAttr('hidden');
                    }

                    if(data.prim1[0].ssmargin_approval == 2){
                        $('.ssmargn').removeAttr('disabled');
                        $('#exist_save_id').removeAttr('hidden');
                    }


                }
            });
        }
    $(document).on('change',".primary_to_location",function(){
        var to_loc=[];
        $(".primary_from_location").each(function(){
            to_loc.push($(this).val());
        });
        var val=[]
        var i=0;
        $(".primary_to_location").each(function(){

            val.push($(this).val()+","+to_loc[i]);
            i++;
        });
        if (hasDuplicates(val)) {
            toastr.error("Duplicate locations  Not allowed");
        }
    })
    $(document).on('change',".primary_from_location",function(){
        var to_loc=[];
        $(".primary_to_location").each(function(){
            to_loc.push($(this).val());
        });
        var val=[]
        var i=0;
        $(".primary_from_location").each(function(){

            val.push($(this).val()+","+to_loc[i]);
            i++;
        });
        if (hasDuplicates(val)) {
            toastr.error("Duplicate locations  Not allowed");
        }
    })
    $(document).on('change',".primaryto_location",function(){
        var to_loc=[];
        $(".primaryfrom_location").each(function(){
            to_loc.push($(this).val());
        });
        var val=[]
        var i=0;
        $(".primaryto_location").each(function(){

            val.push($(this).val()+","+to_loc[i]);
            i++;
        });
        if (hasDuplicates(val)) {
            toastr.error("Duplicate locations  Not allowed");
        }
    })
    $(document).on('change',".primaryfrom_location",function(){
        var to_loc=[];
        $(".primaryto_location").each(function(){
            to_loc.push($(this).val());
        });
        var val=[]
        var i=0;
        $(".primaryfrom_location").each(function(){

            val.push($(this).val()+","+to_loc[i]);
            i++;
        });
        if (hasDuplicates(val)) {
            toastr.error("Duplicate locations  Not allowed");
        }
    })

    function hasDuplicates(array) {
        return new Set(array).size !== array.length;
    }
    </script>

</body>
</html>
