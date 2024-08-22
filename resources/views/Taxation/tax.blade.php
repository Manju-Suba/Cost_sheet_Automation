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
        .alert_color{
            color: #8e3333;
        }


        fieldset {
            border: 1px solid gray;
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
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="my-4 text-center">
                                            <h5 class="text-muted">Taxation Details</h5>
                                        </div>

                                        <!-- Nav tabs -->
                                        <ul class="col-8 nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
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
                                                                    <a class="nav-link active" data-bs-toggle="tab" href="#npd_pending" role="tab">
                                                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                                        <span class="d-none d-sm-block">NPD Pending</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" data-bs-toggle="tab" href="#npd_reject" role="tab">
                                                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                        <span class="d-none d-sm-block">NPD Rejected </span>
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
                                                                <div class="tab-pane active" id="npd_pending" role="tabpanel">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="table-responsive">
                                                                                <table class="table table-hover" id="product_details" style="width: 100%;">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>S.no</th>
                                                                                            <th>Product Name</th>
                                                                                            <th>Division</th>
                                                                                            <th>Fill Volume</th>
                                                                                            <th>Case Configuration</th>
                                                                                            <th>Launch Qty</th>
                                                                                            <th>Status</th>
                                                                                            <th>Action</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane " id="npd_reject" role="tabpanel">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="table-responsive">
                                                                                <table class="table table-hover" id="product_details1" style="width: 100%;">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>S.no</th>
                                                                                            <th>Product Name</th>
                                                                                            <th>Division</th>
                                                                                            <th>Fill Volume</th>
                                                                                            <th>Case Configuration</th>
                                                                                            <th>Launch Qty</th>
                                                                                            <th>Status</th>
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
                                                                <div class="tab-pane " id="npd_approved" role="tabpanel">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="table-responsive">
                                                                                <table class="table table-hover " id="product_details2" style="width: 100%;">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>S.no</th>
                                                                                            <th>Product Name</th>
                                                                                            <th>Division</th>
                                                                                            <th>Fill Volume</th>
                                                                                            <th>Case Configuration</th>
                                                                                            <th>Launch Qty</th>
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
                                                        <!-- Modal-->
                                                        <div class="col">
                                                            <div class="modal fade" id="gst_id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5>GST</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form id="frm_gst">
                                                                                <div class="row">
                                                                                    <input type="hidden" id="sts" name="sts">
                                                                                    <div class="col-md-6">
                                                                                        <label for="" class="form-label">Sales Tax/ GST % <span class="text-danger">*</span>
                                                                                        </label>
                                                                                        <input type="text" class="form-control" id="sales" name="sales" onkeypress="return /[0-9.]/i.test(event.key)">
                                                                                        <div class="alert_color" id="sales_err"></div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <input type="text" class="form-control" id="hid_id" name="hid_id" hidden>
                                                                                        <label for="" class="form-label">HSN Code </label>
                                                                                        <input type="text" class="form-control" id="hsn_code" min="8" max="8" name="hsn_code">
                                                                                        <div class="alert_color" id="hsn_err"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <!-- <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button> -->
                                                                            <button type="button" class="btn btn-primary btn-sm" id="save_id">Save</button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="profile1" role="tabpanel">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <ul class="col-12 nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                                            <li class="nav-item epd_tab1">
                                                                <a class="nav-link active" data-bs-toggle="tab" href="#epd_tab1" role="tab">
                                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                                    <span class="d-none d-sm-block">EPD Pending</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item epd_tab2">
                                                                <a class="nav-link" data-bs-toggle="tab" href="#epd_tab2" role="tab">
                                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                    <span class="d-none d-sm-block">EPD Approved </span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item epd_tab3">
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
                                                                                        <th>Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="tab-pane " id="epd_tab2" role="tabpanel">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-hover" id="exists_approved" style="width: 100%;">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>S.NO</th>
                                                                                        <th>Material Code</th>
                                                                                        <th>Division</th>
                                                                                        <th>No of Pcs</th>
                                                                                        <!-- <th>MRP Per Piece</th> -->
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
                                                                            <table class="table table-hover" id="exists_rejected" style="width: 100%;">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>S.NO</th>
                                                                                        <th>Material Code</th>
                                                                                        <th>Division</th>
                                                                                        <th>No of Pcs</th>
                                                                                        <!-- <th>MRP Per Piece</th> -->
                                                                                        <th>Rejected Status</th>
                                                                                        <th>Rejected Remarks</th>
                                                                                        <th>Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="modal fade" id="exgst_id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5>GST</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form id="frm_exgst">
                                                                                    <div class="row">
                                                                                        <div class="col-md-6">
                                                                                            <label for="" class="form-label">Sales Tax/ GST % <span class="text-danger">*</span>
                                                                                            </label>
                                                                                            <input type="text" class="form-control" id="exist_sales" name="exist_sales"  minlength="2" maxlength="2" onkeypress="return /[0-9.]/i.test(event.key)">
                                                                                            <div class="alert_color" id="exsales_err"></div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <input type="text" class="form-control" id="ex_id" name="ex_id" hidden>
                                                                                            <label for="" class="form-label">HSN Code </label>
                                                                                            <input type="text" class="form-control" id="exist_hsn_code" minlength="8" maxlength="8" name="exist_hsn_code">
                                                                                            <div class="alert_color" id="exhsn_err"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <!-- <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button> -->
                                                                                <button type="button" class="btn btn-primary btn-sm" id="exist-save_id">Save</button>
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
                        </div>
                    </div>
                </div>
                {{-- remarks tab --}}
                <div class="modal fade" id="remarks_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Remarks</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div id="remarks_tab">

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
    <!-- End Page-content -->

    @extends('layout.footer')
    <!-- end container-fluid -->

    @extends('layout.right-sidebar');

    <!-- JAVASCRIPT -->
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/metismenujs/metismenujs.min.js"></script>
    <script src="../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../assets/libs/eva-icons/eva.min.js"></script>
    <script src="../assets/js/app.js"></script>

    <!-- Vector map-->
    <script src="../assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="../assets/libs/jsvectormap/maps/world-merc.js"></script>
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
                    "type": "tax"
                },
                success: function(data) {
                    $("#remarks_tab").html("<p>"+data.data+"</p>");

                }
            });
        }

        $(".epd_tab1").click(function() {
            extable_();
        });
        $(".epd_tab2").click(function() {
            extable3_();
        });
        $(".epd_tab3").click(function() {
            extable4_();
        });

        $(document).ready(function() {
            table_();
            extable_();
        });
        function table_(){
            table = $('#product_details').DataTable({
                "bDestroy": true,

                autowidth: false,
                ajax: {
                    url: "{{url('fetch_basic_tax')}}"
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
                        data: 'status',
                        name: 'status',
                        visible: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            table_rej = $('#product_details1').DataTable({
                "bDestroy": true,

                autowidth: false,
                ajax: {
                    url: "{{url('fetch_basic_tax')}}",
                    data:{
                        'rej':'rej'
                    }
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
                        data: 'status',
                        name: 'status',
                        visible: false
                    },
                    {
                        data: 'rejected',
                        name: 'rejected',
                    },
                    {
                        data: 'remarks',
                        name: 'remarks',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            table_app = $('#product_details2').DataTable({
                "bDestroy": true,

                autowidth: false,

                ajax: {
                    url: "{{url('fetch_basic_tax')}}",
                    data:{
                        'app':'app'
                    }
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
                        data: 'status',
                        name: 'status',
                        visible: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        }

        function extable_(){
            table2 = $('#exists_product').DataTable({
                "bDestroy": true,
                "autoWidth": false,
                'ajax': {
                    url: "{{ url('existp_tax')}}",
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
                        data:'action'
                    }
                ]
            });

            
        }

        function extable3_(){
            table3 = $('#exists_approved').DataTable({
                "bDestroy": true,
                "autoWidth": false,
                'ajax': {
                    url: "{{ url('exists_tax_approved')}}",
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
                        data:'action'
                    }
                ]
            });
        }
 
        function extable4_(){
            table4 = $('#exists_rejected').DataTable({
                "bDestroy": true,
                "autoWidth": false,
                'ajax': {
                    url: "{{ url('exists_tax_rejected')}}",
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
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'remark',
                        name: 'remark'
                    },
                    {
                        data:'action'
                    }
                ]
            });
        }


        function openmodel(id,sts) {
            $('#hid_id').val(id);
            $.ajax({
                url: '{{'fetch_gst'}}',
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    $("#sts").val(sts);
                    $('#sales').removeAttr('readonly');

                    if (data.result != null) {
                            if((data.result.salesTax != null && data.result.b_salesTax_approval == 2 )||(data.result.salesTax == null && data.result.b_salesTax_approval == 0 )){
                                $('#sales').val(data.result.salesTax);
                                $('#hsn_code').val(data.result.hsnCode);
                                $('#hsn_code').prop('readonly',true);
                                $('#save_id').css('display','block');
                            }
                            else{
                                $('#save_id').css('display','none');
                                $('#save_id').html('save');
                                $('#sales').val(data.result.salesTax);
                                $('#hsn_code').val(data.result.hsnCode);
                                $('#hsn_code').prop('readonly',true);
                                $('#sales').prop('readonly',true);
                        }

                    } else {
                        $('#save_id').css('display','block');
                        $('#save_id').html('save');
                        $('#sales').val('');
                        $('#hsn_code').val('');
                        $('#hsn_code').removeAttr('readonly');
                    }
                    $('.alert_color').text('');
                    $('#gst_id').modal('show');
                }
            });
        }

        $('#save_id').click(function() {
           $sales_val =  $('#frm_gst #sales').val();
           $hsn_code =  $('#frm_gst #hsn_code').val();
            //    console.log($sales_val.length);
            if(($sales_val.length == 2 && $hsn_code.length == 8) ||($sales_val.length == 2 && $hsn_code.length==0)){
                $.ajax({
                    url: '{{url("save_gst")}}',
                    type: 'POST',
                    data: $('#frm_gst').serialize(),
                    success: function() {
                        toastr.success('saved successfully');
                        $('#frm_gst')[0].reset();
                        $('#gst_id').modal('hide');
                        // table.ajax.reload();
                        table_();
                    }
                });
            }
            else{
                if(hsn_code.length != 8){
                    if( $hsn_code.length!=0)
                    $("#hsn_err").text('HSN Code must be 8 characters long');
                }
                if($sales_val.length != 2){
                    $("#sales_err").text('Sales Tax/ GST be a 2 digit value');
                }
            }

        });

        function exopenmodel(id) {
            $('#ex_id').val(id);
            $('#exist_sales').removeAttr('disabled');
            $('#exist_hsn_code').removeAttr('disabled');

            $.ajax({
                url: '{{'fetch_exgst'}}',
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    $('.alert_color').html('');

                    if (data.result != null) {
                        $('#exist_sales').val(data.result.salesTax);
                        $('#exist_hsn_code').val(data.result.hsnCode);

                        if(data.result.tax_approval == 'rejected'){
                            $('#exist-save_id').html('update');
                            $('#exist-save_id').css('display','block');
                        }else{
                            $('#exist_hsn_code').attr('disabled','true');
                            $('#exist_sales').attr('disabled','true');
                            $('#exist-save_id').css('display','none');
                        }
                    } else {
                        $('#exist-save_id').css('display','block');
                        $('#exist-save_id').html('save');
                        $('#exist_sales').val('');
                        $('#exist_hsn_code').val('');
                    }
                    $('#exgst_id').modal('show');
                }
            });
        }

        $('#exist-save_id').click(function() {
            $sales_val =  $('#frm_exgst #exist_sales').val();
            $hsn_code =  $('#frm_exgst #exist_hsn_code').val();
            $("#exhsn_err").text('');
            $("#exsales_err").text('');

            if($sales_val.length == 2){
                $.ajax({
                    url: '{{url("save_expgst")}}',
                    type: 'POST',
                    data: $('#frm_exgst').serialize(),
                    success: function() {
                        toastr.success('Saved successfully');
                        $('#frm_exgst')[0].reset();
                        $('#exgst_id').modal('hide');
                        extable_();
                        // table2.ajax.reload();
                        // table3.ajax.reload();
                        // table4.ajax.reload();
                    }
                })
            }else{
                // if(hsn_code.length != ''){
                //     $("#exhsn_err").text('HSN Code must be 8 characters long');
                // }
                if($sales_val.length != 2){
                    $("#exsales_err").text('Sales Tax/ GST be a 2 digit value');
                }
            }
        });

    </script>

</body>
</html>
