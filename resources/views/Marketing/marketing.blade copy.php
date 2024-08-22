<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Cost Sheet Automation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/h_logo.png">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- toaster -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
    <!-- datatable -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <style>
        .modal-header {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-negative: 0;
            flex-shrink: 0;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            padding: 1rem 1rem 0rem 1rem;
            border-bottom: 1px solid #eff2f7;
            border-top-left-radius: calc(0.4rem - 1px);
            border-top-right-radius: calc(0.4rem - 1px);
        }
    </style>
</head>



<body data-layout="detached" data-topbar="colored">

    <div class="container-fluid">
        <!-- Begin page -->
        <div id="layout-wrapper">

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
                                        <div class="col">
                                            <div class="my-4 text-center">
                                                <h5 class="text-muted">Product Details</h5>
                                                <!-- Extra Large modal -->
                                                <button type="button" class="btn btn-primary waves-effect waves-light float-end mb-3" data-bs-placement="top" title="add details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl">Add
                                                    Product</button>
                                            </div>

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
                                                                <div class="card-body">
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
                                                                                </div>
                                                                            <!-- </div> -->
                                                                            <!-- <div class="row"> -->
                                                                                <!-- <div class="col-md-7"></div> -->
                                                                                <div class="col-md-3 mt-3 text-center" style="margin-top: 30px !important;">
                                                                                    <button type="button" class="form-control btn btn-primary" id="fix">Done</button>
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
                                                                                    <label for="inputEmail4" class="form-label">Product
                                                                                        Name</label>
                                                                                    <input type="text" class="form-control" placeholder="eg: cavin's milkshake" id="pname" name="product_name">
                                                                                    <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <label for="inputEmail4" class="form-label">Fill
                                                                                        Volume</label>
                                                                                    <input type="text" class="form-control" placeholder="50" id="fVolume" name="Volume">
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <label for="inputEmail4" class="form-label">uom</label>
                                                                                    <select class="form-control" name="uom" id="select_uom">
                                                                                        <option value="options">---
                                                                                        </option>
                                                                                        @foreach ($data as $item)
                                                                                        <option value="{{ $item->uom_name }}">
                                                                                            {{ $item->uom_name }}
                                                                                        </option>
                                                                                        @endforeach

                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label for="inputEmail4" class="form-label">Case
                                                                                        Cofiguration</label>
                                                                                    <input type="text" class="form-control" id="caseconfiguration" placeholder="eg: 12" name="case_configuration">
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="inputEmail4" class="form-label">Launch
                                                                                        Quantity</label>
                                                                                    <input type="text" class="form-control" placeholder="eg: 500 " id="lquantity" name="quantity">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label for="inputEmail4" class="form-label">MRP Per
                                                                                        Price</label>
                                                                                    <input type="text" class="form-control" placeholder="eg: 1200" id="mrpprice" name="mrp_price">
                                                                                </div>

                                                                            </div>
                                                                            <br>
                                                                            <h5>Primary Frieght</h5>
                                                                            <hr>

                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label for="inputEmail4" class="form-label">From
                                                                                        Location</label>
                                                                                    <input type="text" class="form-control" placeholder="eg: cuddalore" id="fromlocation" name="from_location">
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="inputEmail4" class="form-label">To
                                                                                        Location</label>
                                                                                    <input type="text" class="form-control" placeholder="eg: chennai" id="tolocation" name="to_location">
                                                                                </div>
                                                                            </div>
                                                                            <br>
                                                                            <h5>Margins & Schemes</h5>
                                                                            <hr>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label for="inputEmail4" class="form-label">Retailer
                                                                                        Margin % </label>
                                                                                    <input type="text" class="form-control" placeholder="eg: 0.2" id="retailermargin" name="retailer_margin" value="">
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="inputEmail4" class="form-label"> Primary
                                                                                        Scheme %</label>
                                                                                    <input type="text" class="form-control" placeholder="eg: 2.7" id="primaryscheme" name="primary_scheme">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label for="inputEmail4" class="form-label">RS Margin %
                                                                                    </label>
                                                                                    <input type="text" class="form-control" placeholder="eg: 7.0" id="rsmargin" name="rs_margin">
                                                                                </div>
                                                                                <div class="col-md-6 ">
                                                                                    <label for="inputEmail4" class="form-label"> SS
                                                                                        Margin %</label>
                                                                                    <input type="text" class="form-control" placeholder="eg: 0.6" id="ssmargin" name="ss_margin">
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
                                                                                <div class="col-md-6">
                                                                                    <label for="inputEmail4" class="form-label">Material Code</label>
                                                                                    <input type="text" class="form-control" name="material_code" id="material_code" placeholder="xxx">
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="inputEmail4" class="form-label">No of Pieces per Case</label>
                                                                                    <input type="text" class="form-control" placeholder="eg: 10" id="pieces_per_case" name="pieces_per_case">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label for="inputEmail4" class="form-label">MRP Per Price</label>
                                                                                    <input type="text" class="form-control" placeholder="eg: 1200" id="mrpprice" name="mrp_price">
                                                                                </div>
                                                                            </div>
                                                                            <br>
                                                                            <h5>Margins & Schemes</h5>
                                                                            <hr>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label for="inputEmail4" class="form-label">Retailer Margin % </label>
                                                                                    <input type="text" class="form-control" placeholder="eg: 0.2" id="retailermargin" name="retailer_margin" value="">
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="inputEmail4" class="form-label"> Primary Scheme %</label>
                                                                                    <input type="text" class="form-control" placeholder="eg: 2.7" id="primaryscheme" name="primary_scheme">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label for="inputEmail4" class="form-label">RS Margin %</label>
                                                                                    <input type="text" class="form-control" placeholder="eg: 7.0" id="rsmargin" name="rs_margin">
                                                                                </div>
                                                                                <div class="col-md-6 ">
                                                                                    <label for="inputEmail4" class="form-label">SS Margin %</label>
                                                                                    <input type="text" class="form-control" placeholder="eg: 0.6" id="ssmargin" name="ss_margin">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6 p-3">
                                                                                    <button type="button" id="exist-sub" style="margin-left:90%" class="btn btn-sm btn-primary">Submit</button>
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

                                            <!-- /.modal -->
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-hover " id="product_details">
                                                <thead>
                                                    <tr>
                                                        <th>S.no</th>
                                                        <th>Product Name</th>
                                                        <th>Fill Volume</th>
                                                        <th>Case Cofiguration</th>
                                                        <th>Launch Quantity </th>
                                                        <th>MRP Per Price</th>
                                                        <th>From Location</th>
                                                        <th>To Location</th>
                                                        <th>Retailer Margin</th>
                                                        <th>Primary Scheme</th>
                                                        <th>RS Margin</th>
                                                        <th>SS Margin</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

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
                                                                <label for="inputEmail4" class="form-label">Product
                                                                    Name</label>
                                                                <input type="text" class="form-control" id="edit_pname" name="edit_product_name">
                                                                <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="inputEmail4" class="form-label">Fill
                                                                    Volume</label>
                                                                <input type="text" class="form-control" id="edit_fVolume" name="edit_Volume">
                                                                <input type="hidden" class="form-control" id="hid_id" name="hid_id">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label for="inputEmail4" class="form-label">uom</label>
                                                                <select class="form-control" name="edit_uom" id="edit_select_uom">
                                                                    <option value="options">---
                                                                    </option>
                                                                    @foreach ($data as $item)
                                                                    <option value="{{ $item->uom_name }}">
                                                                        {{ $item->uom_name }}
                                                                    </option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="inputEmail4" class="form-label">Case
                                                                    Cofiguration</label>
                                                                <input type="text" class="form-control" id="edit_caseconfiguration" name="edit_case_configuration">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="inputEmail4" class="form-label">Launch
                                                                    Quantity</label>
                                                                <input type="text" class="form-control" id="edit_lquantity" name="edit_quantity">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="inputEmail4" class="form-label">MRP Per
                                                                    Price</label>
                                                                <input type="text" class="form-control" id="edit_mrpprice" name="edit_mrp_price">
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <h5>Primary Frieght</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="inputEmail4" class="form-label">From
                                                                    Location</label>
                                                                <input type="text" class="form-control" id="edit_fromlocation" name="edit_from_location">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="inputEmail4" class="form-label">To
                                                                    Location</label>
                                                                <input type="text" class="form-control" id="edit_tolocation" name="edit_to_location">
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <h5>Margins & Schemes</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="inputEmail4" class="form-label">Retailer
                                                                    Margin % </label>
                                                                <input type="text" class="form-control" id="edit_retailermargin" name="edit_retailer_margin" value="">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="inputEmail4" class="form-label"> Primary
                                                                    Scheme %</label>
                                                                <input type="text" class="form-control" id="edit_primaryscheme" name="edit_primary_scheme">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="inputEmail4" class="form-label">RS Margin
                                                                    %
                                                                </label>
                                                                <input type="text" class="form-control" id="edit_rsmargin" name="edit_rs_margin">
                                                            </div>
                                                            <div class="col-md-6 ">
                                                                <label for="inputEmail4" class="form-label"> SS
                                                                    Margin %</label>
                                                                <input type="text" class="form-control" id="edit_ssmargin" name="edit_ss_margin">
                                                            </div>
                                                        </div>
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
                <!-- End Page-content -->

                @extends('layout.footer')
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

    </div>
    <!-- end container-fluid -->

    @extends('layout.right-sidebar');

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenujs/metismenujs.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/eva-icons/eva.min.js"></script>

    <script src="assets/js/app.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>

    {{-- <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            </script> --}}
    <script>
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
                        data: 'Cofiguration'
                    },
                    {
                        data: 'Quantity'
                    },
                    {
                        data: 'Price'
                    },
                    {
                        data: 'From_Location'
                    },
                    {
                        data: 'to_Location'
                    },
                    {
                        data: 'Margin'
                    },
                    {
                        data: 'Primary_Scheme',
                    },
                    {
                        data: 'RS_Margin',
                    },
                    {
                        data: 'ss_Margin',
                    },
                    {
                        data: 'bstatus',
                    },
                    {
                        data: 'Action',
                    },
                ],
            });
        });


        $("#sub").click(function() {
            var formData = new FormData($('#formadd')[0]);
            $.ajax({
                url: "{{ url('savemarket') }}",
                method: "POST",
                contentType: false,
                processData: false,
                data: formData,
                success: function() {
                    $("#formadd")[0].reset();
                    table.ajax.reload();
                    Swal.fire(
                        'Product Successfully Inserted!',
                        'You clicked the button!',
                        'success'
                    )
                    $('#productModal').modal('hide');
                }

            });
        });

        function edit_details(id) {
            $.ajax({
                url: '{{ 'edit_details' }}',
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#hid_id').val(data.result.id);
                    $('#edit_pname').val(data.result.Product_name);
                    $('#edit_fVolume').val(data.result.Volume);
                    $('#edit_caseconfiguration').val(data.result.case_configuration);
                    $('#edit_lquantity').val(data.result.quantity);
                    $('#edit_mrpprice').val(data.result.mrp_price);
                    $('#edit_fromlocation').val(data.result.from_location);
                    $('#edit_tolocation').val(data.result.to_location);
                    $('#edit_retailermargin').val(data.result.retailer_margin);
                    $('#edit_primaryscheme').val(data.result.primary_scheme);
                    $('#edit_rsmargin').val(data.result.rs_margin);
                    $('#edit_ssmargin').val(data.result.ss_margin);
                    $('#edit_select_uom').val(data.result.uom);
                    $('#edit_modal').modal('show');
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


        $("#fix").click(function() {
            $("#formcheck")[0].reset();
            $('#tycheck').modal('hide');

            var pro_ty = $('#product_type').val();
            if(pro_ty == 'New Product'){
                $('#productModal').modal('show');
            }else{
                $('#exist-productModal').modal('show');
            }
        });

        $("#exist-sub").click(function() {
            var formData = new FormData($('#exist-formadd')[0]);
            $.ajax({
                url: "{{ url('exist_save') }}",
                method: "POST",
                contentType: false,
                processData: false,
                data: formData,
                success: function() {
                    $("#exist-formadd")[0].reset();
                    table.ajax.reload();
                    Swal.fire(
                        'Product Successfully Inserted!',
                        'You clicked the button!',
                        'success'
                    )
                    $('#exist-productModal').modal('hide');
                }

            });
        });

    </script>

</body>

</html>