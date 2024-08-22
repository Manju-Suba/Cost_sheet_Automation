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

        .swal2-icon {
            /* margin:; */
            width: 2em !important;
            height: 2em !important;
            margin: 0px 0px 0px 0px !important;
            border: none !important;
        }

        .icon {
            position: relative;
            top: 1px;
            margin-left: 4px;
        }


        fieldset {
            border: 1px solid gray;
        }

        /* #product_tb th{
            background-color: ;
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

                                        <h4 class="card-title mb-4">Entered Products</h4>
                                        <p class="card-title-desc"></p>

                                        <!-- Nav tabs -->
                                        <!-- <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block"></span>
                                                </a>
                                            </li> -->
                                            <!-- <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block">Approved</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                    <span class="d-none d-sm-block">Rejected</span>
                                                </a>
                                            </li> -->

                                        </ul>

                                        <!-- Tab panes -->
                                        <!-- <div class="tab-content p-3 text-muted">
                                            <div class="tab-pane active" id="home1" role="tabpanel"> -->
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-hover table-striped" id="product_tb">
                                                                            <thead class="">
                                                                                <tr>
                                                                                    <th>S.NO</th>
                                                                                    <th>Product Name</th>
                                                                                    <th>Division</th>
                                                                                    <th>Fill Volume</th>
                                                                                    <th>Case Cofiguration</th>
                                                                                    <th>Launch Qty </th>
                                                                                    <th>MRP Per Price</th>
                                                                                    <th>Primary Location</th>
                                                                                    <th>Secondary Location</th>
                                                                                    <th>Retailer Margin</th>
                                                                                    <th>Primary Scheme</th>
                                                                                    <th>RS Margin</th>
                                                                                    <th>SS Margin</th>
                                                                                    <th>Version</th>
                                                                                    <!-- <th>Action</th> -->
                                                                                </tr>
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal-->
                                                        <!-- <div class="col">
                                                            <div class="modal fade" id="damage_modal_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5>Product Approval</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row mb-1">
                                                                                <div class="col-md-1"></div>
                                                                                <div class="col-md-5">
                                                                                    <input type="hidden" class="form-control" id="prod_id" name="prod_id">
                                                                                    <button type="button" class="btn btn-success" onclick="prod_approve()">Approve Product<i class="bx bx-check-circle icon nav-icon"></i></button>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <button type="button" class="btn btn-danger" onclick="prod_reject()">Reject Product<i class="bx bx-x-circle icon nav-icon"></i></button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            <!-- </div> -->
                                            <!-- <div class="tab-pane" id="profile1" role="tabpanel">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover " id="prod_approved" style="width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.NO</th>
                                                                    <th>Product Name</th>
                                                                    <th>Fill Volume</th>
                                                                    <th>Case Cofiguration</th>
                                                                    <th>Launch Qty </th>
                                                                    <th>MRP Per Price</th>
                                                                    <th>From Location</th>
                                                                    <th>To Location</th>
                                                                    <th>Retailer Margin</th>
                                                                    <th>Primary Scheme</th>
                                                                    <th>RS Margin</th>
                                                                    <th>SS Margin</th>
                                                                    <th>Version</th>
                                                                </tr>
                                                            </thead>

                                                        </table>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <!-- <div class="tab-pane" id="messages1" role="tabpanel">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover " id="rejected_tb" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.NO</th>
                                                                    <th>Product Name</th>
                                                                    <th>Fill Volume</th>
                                                                    <th>Case Cofiguration</th>
                                                                    <th>Launch Qty </th>
                                                                    <th>MRP Per Price</th>
                                                                    <th>From Location</th>
                                                                    <th>To Location</th>
                                                                    <th>Retailer Margin</th>
                                                                    <th>Primary Scheme</th>
                                                                    <th>RS Margin</th>
                                                                    <th>SS Margin</th>
                                                                    <th>Version</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="modal fade" id="confirm_modal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalToggleLabel">Are you sure?</h4>
                                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                            </div>
                            <div class="modal-body">
                                <input type="text" value="" id="hid_id" hidden>
                                <p>You won't be able to send this!</p>
                                <div class="mt-4">
                                    <button type="button" class="btn btn-primary p-1" id="purchase">Yes, send to Purchase Team!</button>
                                    <button type="button" class="btn btn-success p-1" id="operation">Yes, send to Operation Team!</button>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="rmscrapmodel" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" style="width:980px;">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">View RM Rate</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <input type="text" id="viewid" hidden>
                                        <table class="table" id="rmscrapview">
                                            <thead>
                                                <tr>
                                                    <th>S.no</th>
                                                    <th>Ingredients</th>
                                                    <th>Rate</th>
                                                    <th>Cost</th>
                                                    <th>Scrap</th>
                                                </tr>
                                            </thead>

                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                {{-- <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </div>
                {{-- PM MODAL --}}

                <!-- /.modal-dialog -->
            </div>

        </div>
    </div>
    <!-- End Page-content -->

    @extends('layout.footer')
    <!-- end container-fluid -->

    @extends('layout.right-sidebar');

    <!-- JAVASCRIPT -->
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/metismenujs/metismenujs.min.js"></script>
    <script src="../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../assets/libs/eva-icons/eva.min.js"></script>
    <!-- apexcharts -->
    <script src="../assets/libs/apexcharts/apexcharts.min.js"></script>
    <!-- Vector map-->
    <script src="../assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="../assets/libs/jsvectormap/maps/world-merc.js"></script>
    <script src="../assets/js/pages/dashboard.init.js"></script>
    <script src="../assets/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>

    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(document).ready(function() {

            table = $('#product_tb').DataTable({
                'autowidth': false,
                ajax: {
                    url: "{{url('fetch_basic_prod')}}"
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'Product_name',
                        name: 'Product_name'
                    },
                      {
                        data: 'division',
                        name: 'division'
                    },
                    {
                        data: 'Volume',
                        name: 'Volume'
                    },
                    {
                        data: 'case_configuration',
                        name: 'case_configuration'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'mrp_price',
                        name: 'mrp_price'
                    },
                    {
                        data: 'from_to_locate',
                        name: 'from_to_locate'
                    },
                    {
                        data: 'sec_location',
                        name: 'sec_location'
                    },
                    {
                        data: 'retailer_margins',
                        name: 'retailer_margins'
                    },
                    {
                        data: 'primary_scheme',
                        name: 'primary_scheme'
                    },
                    {
                        data: 'rs_margin',
                        name: 'rs_margin'
                    },
                    {
                        data: 'ss_margin',
                        name: 'ss_margin'
                    },
                    {
                        data: 'version',
                        name: 'version',
                        visible: false
                    },
                    // {
                    //     data: 'action',
                    //     name: 'action',
                    //     orderable: false,
                    //     searchable: false
                    // }
                ]
            });

            // table2 = $('#prod_approved').DataTable({
            //     "autoWidth": false,
            //     'ajax': {
            //         url: "{{ url('approved_product')}}",
            //         // type: 'POST'
            //     },

            //     columns: [{
            //             data: 'DT_RowIndex'
            //         },
            //         {
            //             data: 'Product_name',
            //             name: 'Product_name'
            //         },
            //         {
            //             data: 'Volume',
            //             name: 'Volume'
            //         },
            //         {
            //             data: 'case_configuration',
            //             name: 'case_configuration'
            //         },
            //         {
            //             data: 'quantity',
            //             name: 'quantity'
            //         },
            //         {
            //             data: 'mrp_price',
            //             name: 'mrp_price'
            //         },
            //         {
            //             data: 'from_location',
            //             name: 'from_location'
            //         },
            //         {
            //             data: 'to_location',
            //             name: 'to_location'
            //         },
            //         {
            //             data: 'retailer_margin',
            //             name: 'retailer_margin'
            //         },
            //         {
            //             data: 'primary_scheme',
            //             name: 'primary_scheme'
            //         },
            //         {
            //             data: 'rs_margin',
            //             name: 'rs_margin'
            //         },
            //         {
            //             data: 'ss_margin',
            //             name: 'ss_margin'
            //         },
            //         {
            //             data: 'version',
            //             name: 'version'
            //         }
            //     ]
            // });

            // table3 = $('#rejected_tb').DataTable({
            //     "bDestroy": true,
            //     'ajax': {
            //         url: '{{url("rejected_prod")}}',
            //     },
            //     columns: [{
            //             data: 'DT_RowIndex'
            //         },
            //         {
            //             data: 'Product_name',
            //             name: 'Product_name'
            //         },
            //         {
            //             data: 'Volume',
            //             name: 'Volume'
            //         },
            //         {
            //             data: 'case_configuration',
            //             name: 'case_configuration'
            //         },
            //         {
            //             data: 'quantity',
            //             name: 'quantity'
            //         },
            //         {
            //             data: 'mrp_price',
            //             name: 'mrp_price'
            //         },
            //         {
            //             data: 'from_location',
            //             name: 'from_location'
            //         },
            //         {
            //             data: 'to_location',
            //             name: 'to_location'
            //         },
            //         {
            //             data: 'retailer_margin',
            //             name: 'retailer_margin'
            //         },
            //         {
            //             data: 'primary_scheme',
            //             name: 'primary_scheme'
            //         },
            //         {
            //             data: 'rs_margin',
            //             name: 'rs_margin'
            //         },
            //         {
            //             data: 'ss_margin',
            //             name: 'ss_margin'
            //         },
            //         {
            //             data: 'version',
            //             name: 'version'
            //         }
            //     ]
            // });

        });

        function bf_approve(id){
            $('#damage_modal_id').modal('show');
            $('#prod_id').val(id);
        }

        function prod_approve(){
            $id = $('#prod_id').val();
            $.ajax({
                url: "{{url('approve_product')}}",
                type: "post",
                data: {
                    'id': $id
                },
                success: function(data) {
                    toastr.success('Approved Successfully');
                    $('#damage_modal_id').modal('hide');
                    table.ajax.reload();
                    // table2.ajax.reload();
                    // table3.ajax.reload();
                }
            });
        }

        function prod_reject(){
            $id = $('#prod_id').val();
            $.ajax({
                url: "{{url('reject_product')}}",
                type: "post",
                data: {
                    'id': $id
                },
                success: function(data) {
                    toastr.success('Rejected Successfully');
                    $('#damage_modal_id').modal('hide');
                    table.ajax.reload();
                    // table2.ajax.reload();
                    // table3.ajax.reload();

                }
            });
        }

    </script>

</body>

</html>
