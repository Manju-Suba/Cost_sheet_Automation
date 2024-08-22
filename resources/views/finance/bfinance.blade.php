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

        /* .main-tab.nav-tabs .nav-link {
            margin-bottom: -1px;
            background: 0 0;
            border: 1px solid transparent;
            border-top-left-radius: 1.75rem;
            border-top-right-radius: 1.75rem;
            border-bottom-left-radius: 1.75rem;
            border-bottom-right-radius: 1.75rem;
        } */

        /* .main-tab.nav-tabs-custom .nav-item .nav-link::after {
            content: "";
            background: none!important;
        } */

        /* .main-tab.nav-tabs-custom .nav-item .nav-link.active {
            color: #2c883a;
            background-color: rgb(66 206 28 / 76%);
        } */
        /* .main-tab.nav-tabs-custom .nav-item .nav-link {
            background-color: #a8a8ad29;;
        } */

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
                                        <div class="my-2">
                                            <h5 class="text-muted">Damages & Logistics Details</h5>
                                        </div>

                                        <!-- Nav tabs -->
                                        <ul class="col-6 nav nav-tabs nav-tabs-custom nav-justified main-tab" role="tablist" style="border-bottom:none !important;">
                                            <li class="nav-item" id="npd_process">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block">NPD</span>
                                                </a>
                                            </li>
                                            <li class="nav-item" id="epd_process">
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
                                                        <ul class="col-12 nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                                            <li class="nav-item" id="npd_tab1">
                                                                <a class="nav-link active" data-bs-toggle="tab" href="#npd_pending" role="tab">
                                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                                    <span class="d-none d-sm-block">Pending</span>
                                                                </a>
                                                            </li>

                                                            <li class="nav-item" id="npd_tab2">
                                                                <a class="nav-link" data-bs-toggle="tab" href="#npd_rejected" role="tab">
                                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                    <span class="d-none d-sm-block">Rejected</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item" id="npd_tab3">
                                                                <a class="nav-link" data-bs-toggle="tab" href="#npd_approved" role="tab">
                                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                    <span class="d-none d-sm-block">Approved</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <div class="tab-content p-3 text-muted">
                                                            <div class="tab-pane active" id="npd_pending" role="tabpanel">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="table-responsive">
                                                                                <table class="table table-hover " id="pending_items" style="width: 100%;">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>S.no</th>
                                                                                            <th>Product Name</th>
                                                                                            <th>Division</th>
                                                                                            <th>Fill Volume</th>
                                                                                            <th>Case Configuration</th>
                                                                                            <th>Launch Qty</th>
                                                                                            <th>Action</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane " id="npd_approved" role="tabpanel">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="table-responsive">
                                                                                <table class="table table-hover " id="appr_items" style="width: 100%;">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>S.no</th>
                                                                                            <th>Product Name</th>
                                                                                            <th>Division</th>
                                                                                            <th>Fill Volume</th>
                                                                                            <th>Case Configuration</th>
                                                                                            <th>Launch Qty</th>
                                                                                            <th>Action</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane " id="npd_rejected" role="tabpanel">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="table-responsive">
                                                                                <table class="table table-hover " id="rejected_items" style="width: 100%;">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>S.no</th>
                                                                                            <th>Product Name</th>
                                                                                            <th>Division</th>
                                                                                            <th>Fill Volume</th>
                                                                                            <th>Case Configuration</th>
                                                                                            <th>Launch Qty</th>
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
                                                            </div>
                                                        </div>

                                                        <!-- Modal-->
                                                        <div class="col">
                                                            <div class="modal fade" id="damage_modal_id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5>Finnance</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <form id="finnance_form">
                                                                                <input type="hidden" name="sts" id="sts">
                                                                                <label for="" class="form-label fw-bold text-dark">DAMAGES</label>
                                                                                <div class="row mb-1">
                                                                                    <div class="col-md-4">
                                                                                        <label for="" class="form-label">Damages in %</label>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <input type="text" class="form-control" id="damage_id" name="damage_name" required oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
                                                                                        <span class="text-danger" id="damage-error"></span>

                                                                                    </div>
                                                                                </div>
                                                                                <label for="" class="form-label fw-bold text-dark">LOGISTICS</label>
                                                                                <div class="row mb-1">
                                                                                    <div class="col-md-4">
                                                                                        <label for="" class="form-label">Logistics Cost in %
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <input type="text" class="form-control" id="logistic_id" name="logistic_name" required oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
                                                                                        <input type="text" id="hid_id" name="hid_name" value="" hidden>
                                                                                        <span class="text-danger" id="logistic-error"></span>

                                                                                    </div>
                                                                                </div>

                                                                            </form>
                                                                        </div>
                                                                        <div class="modal-footer">
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

                                                    <ul class="col-12 nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                                        <li class="nav-item epd-tab1">
                                                            <a class="nav-link active" data-bs-toggle="tab" href="#tab1" role="tab">
                                                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                                <span class="d-none d-sm-block">Pending</span>
                                                            </a>
                                                        </li>

                                                        <li class="nav-item epd-tab2">
                                                            <a class="nav-link" data-bs-toggle="tab" href="#tab2" role="tab">
                                                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                <span class="d-none d-sm-block">Approved</span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item epd-tab3">
                                                            <a class="nav-link" data-bs-toggle="tab" href="#tab3" role="tab">
                                                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                <span class="d-none d-sm-block">Rejected</span>
                                                            </a>
                                                        </li>
                                                    </ul>

                                                    <div class="tab-content p-3 text-muted">
                                                        <div class="tab-pane active" id="tab1" role="tabpanel">
                                                            <div class="card">
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
                                                        </div>
                                                        <div class="tab-pane " id="tab2" role="tabpanel">
                                                            <div class="card">
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
                                                        </div>
                                                        <div class="tab-pane " id="tab3" role="tabpanel">
                                                            <div class="card">
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
                                                        <div class="modal fade" id="exgst_id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5>EPD Damages & Logistics</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form id="exfinnance_form">
                                                                            <input type="hidden" class="form-control" id="ex_id" name="ex_id">
                                                                            <label for="" class="form-label fw-bold text-dark">DAMAGES</label>
                                                                            <div class="row mb-1">
                                                                                <div class="col-md-4">
                                                                                    <label for="" class="form-label">Damages in %</label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <input type="text" class="form-control" id="exdamage_id" name="exdamage_id" required oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
                                                                                </div>
                                                                            </div>
                                                                            <label for="" class="form-label fw-bold text-dark">LOGISTICS</label>
                                                                            <div class="row mb-1">
                                                                                <div class="col-md-4">
                                                                                    <label for="" class="form-label">Logistics Cost in %</label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <input type="text" class="form-control" id="exlogistic_id" name="exlogistic_id" required oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
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
                <!-- end row -->
                <!-- /.modal-dialog -->
            </div>

        </div>
    </div>
    {{-- remarks --}}
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
                    "type": "damages"
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
            npd_process1();
            epd_process();

        });
         $('#npd_process').click(function(){
            npd_process1();
        })
        $('#npd_tab1').click(function(){
            npd_process1();
        })
        $('#npd_tab2').click(function(){
            npd_process2();
        })
        $('#npd_tab3').click(function(){
            npd_process3();
        })

        function npd_process1(){
            table = $('#pending_items').DataTable({
                "bDestroy": true,

                autowidth: false,
                ajax: {
                    url: "{{url('fetch_basic_buss')}}"
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
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        }
             function npd_process3(){
            table_appr = $('#appr_items').DataTable({
                "bDestroy": true,
                autowidth: false,
                ajax: {
                    url: "{{url('fetch_basic_buss')}}",
                    data:{'app':'app'}
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
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        }
         function npd_process2(){
            table_rej= $('#rejected_items').DataTable({
                "bDestroy": true,
                autowidth: false,
                ajax: {
                    url: "{{url('fetch_basic_buss')}}",
                    data:{'rej':'rej'}
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
        }

        $('.epd-tab1').click(function(){
            epd_process();
        })
        $('.epd-tab2').click(function(){
            epdapproved();
        })
        $('.epd-tab3').click(function(){
            epdrejected();
        })

        function epd_process(){
            table2 = $('#exists_product').DataTable({
                "bDestroy": true,
                "autoWidth": false,
                'ajax': {
                    url: "{{ url('fetch_exist_buss')}}",
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

        function epdapproved(){
            table3 = $('#exists_approved').DataTable({
                "bDestroy": true,
                "autoWidth": false,
                'ajax': {
                    url: "{{ url('fetch_exist_app_buss')}}",
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

        function epdrejected(){
            table3 = $('#exists_rejected').DataTable({
                "bDestroy": true,
                "autoWidth": false,
                'ajax': {
                    url: "{{ url('fetch_exist_rej_buss')}}",
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
                        data:'action'
                    }
                ]
            });
        }

        function openmodel(id,sts) {
            $('#damage-error').html('');
            $('#logistic-error').html('');
            $('#damage_modal_id').modal('show');
            $('#hid_id').val(id);

            $.ajax({
                url: "{{url('fetch_finance_data')}}",
                type: "GET",
                data: {
                    id: id
                },
                success: function(data) {
                    $('#damage_id').prop('disabled',true);
                    $('#logistic_id').prop('disabled',true);
                    $("#sts").val(sts);
                    $('#damage_id').val(data.result.damage);
                    $('#logistic_id').val(data.result.logistic);
                    $('#save_id').html('save');
                    $('#damage_id').removeAttr('disabled');
                    $('#logistic_id').removeAttr('disabled');
                    $('#save_id').css('display','block');

                    if (data.result.logistic != '' && data.result.damage != ''  && data.result.logistic != null && data.result.damage != null   ) {
                        $('#save_id').css('display','none');
                        $('#damage_id').prop('disabled',true);
                        $('#logistic_id').prop('disabled',true);
                        // if(data.result.b_logistic_approval == 2 || data.result.b_damage_approval ==2){
                        //     $('#save_id').css('display','block');
                        //     $('#damage_id').removeAttr('disabled');
                        //     $('#logistic_id').removeAttr('disabled');

                        // }
                        if(data.result.b_logistic_approval == 2 ){
                            $('#save_id').css('display','block');
                          $('#logistic_id').removeAttr('disabled');
                        }
                        if(data.result.b_damage_approval ==2){
                            $('#save_id').css('display','block');

                            $('#damage_id').removeAttr('disabled');

                        }

                        // $('#save_id').html('update');
                    }
                    if(data.result.logistic== null && data.result.damage== null){
                        $('#logistic_id').removeAttr('disabled');
                        $('#damage_id').removeAttr('disabled');
                    }
                }
            });
        }

        $('#save_id').click(function() {
            var damage_id=$("#damage_id").val();
            var logistic_id=$("#logistic_id").val();
            if(damage_id!=''&&logistic_id!=''){
                $.ajax({
                url: '{{url("save_finnance")}}',
                type: 'POST',
                data: $('#finnance_form').serialize(),
                success: function(data) {
                    toastr.success('Saved Successfully');
                    $('#damage_modal_id').modal('hide');
                    $('#finnance_form')[0].reset();
                    table.ajax.reload();
                    npd_process1();
                    npd_process2();
                    npd_process3();

                }
            });
            }else{
                   if(damage_id==''){
                    $('#damage-error').html('Damage Is Required ')
                   }if(logistic_id==''){
                    $('#logistic-error').html('Logistic Is Required')
                   }
            }

        });

        function exopenmodel(id) {

            $('#ex_id').val(id);
            $.ajax({
                url: "{{url('fetch_finance_exdata')}}",
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    if (data.result != null) {
                        $('#exdamage_id').val(data.result.damage);
                        $('#exlogistic_id').val(data.result.logistic);
                        $('#exist-save_id').html('update');
                        $('#exist-save_id').css('display','none');

                        $('#exdamage_id').attr('disabled',true);
                        $('#exlogistic_id').attr('disabled',true);

                        if(data.result.damage_approval == 'rejected'){
                            $('#exdamage_id').attr('disabled',false);
                            $('#exist-save_id').css('display','block');
                        }
                        if(data.result.logistic_approval == 'rejected'){
                            $('#exlogistic_id').attr('disabled',false);
                            $('#exist-save_id').css('display','block');
                        }

                    } else {
                        $('#exist-save_id').css('display','block');
                        $('#exist-save_id').html('save');
                        $('#exdamage_id').val('');
                        $('#exlogistic_id').val('');
                        $('#exlogistic_id').attr('disabled',false);
                        $('#exdamage_id').attr('disabled',false);
                    }
                    $('#exgst_id').modal('show');
                }
            });
        }


        $('#exist-save_id').click(function() {
            $.ajax({
                url: '{{url("save_exfinnance")}}',
                type: 'POST',
                data: $('#exfinnance_form').serialize(),
                success: function() {
                    toastr.success('Saved successfully');
                    $('#exfinnance_form')[0].reset();
                    $('#exgst_id').modal('hide');
                    epd_process();
                }
            })
        });

    </script>

</body>
</html>
  