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

                                        <h4 class="card-title">PM Cost </h4>
                                        <p class="card-title-desc"></p>

                                        <!-- Nav tabs -->
                                        <!-- <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block">Pending</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
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
                                            </li>

                                        </ul> -->

                                        <!-- Tab panes -->
                                        <!-- <div class="tab-content p-3 text-muted">
                                            <div class="tab-pane active" id="home1" role="tabpanel"> -->
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-hover " id="pm_cost">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>S.no</th>
                                                                                    <th>Product Name</th>
                                                                                    <th>Division</th>
                                                                                    <th>Fill Volume</th>
                                                                                    <th>Case Configuration</th>
                                                                                    <th>Launch Qty</th>
                                                                                    <th>Version</th>
                                                                                    <th>Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal-->

                                                        <!--<div class="modal fade pmmodal" id="pmdetails_modal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="staticBackdropLabel">View PM Details with approve process</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="col-12">
                                                                            <div class="table-responsive">
                                                                                <input type="text" id="viewid" hidden>
                                                                                <table class="table table-hover " id="pmdetails" style="width: 100%;">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>S.no</th>
                                                                                            <th>PM</th>
                                                                                            <th>PM Details</th>
                                                                                            <th>PM Specification</th>
                                                                                            <th>Qty</th>
                                                                                            <th>MOQ</th>
                                                                                            <th>Vendor</th>
                                                                                            <th>Basic</th>
                                                                                            <th>Freight</th>
                                                                                        </tr>
                                                                                    </thead>

                                                                                </table>
                                                                            </div>
                                                                            <div class="row mt-3 mb-1">
                                                                                <label>Approval Action</label>
                                                                                <div class="col-md-3">
                                                                                    <input type="hidden" class="form-control" id="prod_id" name="prod_id">
                                                                                    <button type="button" class="btn btn-success" onclick="pm_approve()">PM Label Approve</button>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <button type="button" class="btn btn-danger" onclick="pm_reject()">PM Label Reject</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> -->
                                                                <!-- /.modal-content -->
                                                            <!-- </div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="tab-pane" id="profile1" role="tabpanel">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover " id="pm_cost_approved_tb" style="width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.no</th>
                                                                    <th>Product Name</th>
                                                                    <th>Fill Volume</th>
                                                                    <th>Case Configuration</th>
                                                                    <th>Launch Qty</th>
                                                                    <th>Version</th>
                                                                    <th>Action</th>
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
                                                                    <th>S.no</th>
                                                                    <th>Product Name</th>
                                                                    <th>Fill Volume</th>
                                                                    <th>Case Configuration</th>
                                                                    <th>Launch Qty</th>
                                                                    <th>Version</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div> -->
                                        <!-- </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="rmview" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">View RM Rate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <div class="table-responsive">
                            <!-- <input type="text" id="viewid" hidden> -->
                            <input type="hidden" class="form-control" id="prod_id" name="prod_id">
                            <table class="table table-hover " id="rmcostview">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Ingredients</th>
                                        <th>Rate</th>
                                        <th>Cost</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>


    <div class="modal fade pmmodal" id="arpmdetails_modal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">View PM Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-hover " id="arpmdetails" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>PM</th>
                                        <th>PM Details</th>
                                        <th>PM Specification</th>
                                        <th>Qty</th>
                                        <th>Vendor</th>
                                        <th>Basic</th>
                                        <th>Freight</th>
                                        <th>MOQ</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
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

            table = $('#pm_cost').DataTable({
                "autoWidth": false,
                'ajax': {
                    url: "{{ url('get_PMcost')}}",
                    // type: 'POST'
                },
                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'Product_name', name: 'Product_name'},
                    {data: 'division', name: 'division'},
                    {data: 'volume', name: 'volume'},
                    {data: 'case_configuration', name: 'case_configuration'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'version', name: 'version',visible: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });

            table2 = $('#pm_cost_approved_tb').DataTable({
                "autoWidth": false,
                'ajax': {
                    url: "{{ url('approved_pm_cost')}}",
                    // type: 'POST'
                },
                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'Product_name', name: 'Product_name'},
                    {data: 'volume', name: 'volume'},
                    {data: 'case_configuration', name: 'case_configuration'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'version', name: 'version'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });

            table3 = $('#rejected_tb').DataTable({
                "bDestroy": true,
                'ajax': {
                    url: '{{url("rejected_pmcost")}}',
                },
                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'Product_name', name: 'Product_name'},
                    {data: 'volume', name: 'volume'},
                    {data: 'case_configuration', name: 'case_configuration'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'version', name: 'version'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });

        });


        function open_pmview(id){
            $('#pmdetails_modal').modal('show');
            $('#prod_id').val(id);

            mtable = $('#pmdetails').DataTable({
                "bDestroy": true,
                ajax:  {
                url: "{{ url('/getpmdetails_scrap') }}",
                data:{prd_id:id}
                },
                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'material', name: 'material'},
                    {data: 'product_details', name: 'product_details'},
                    {data: 'specification', name: 'specification'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'MOQ', name: 'MOQ'},
                    {data: 'vendor', name: 'vendor'},
                    {data: 'basic', name: 'basic'},
                    {data: 'freight', name: 'freight'},
                ]
            });
        }


        function openpmview(id){
            $('#arpmdetails_modal').modal('show');
            $('#prod_id').val(id);

            armtable = $('#arpmdetails').DataTable({
                "bDestroy": true,
                ajax:  {
                url: "{{ url('/getpmdetails_scrap') }}",
                data:{prd_id:id}
                },
                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'material', name: 'material'},
                    {data: 'product_details', name: 'product_details'},
                    {data: 'specification', name: 'specification'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'vendor_array', name: 'vendor_array'},
                    {data: 'basic_array', name: 'basic_array'},
                    {data: 'freight_array', name: 'freight_array'},
                    {data: 'moq_array', name: 'moq_array'},
                ]
            });
        }

        function pm_approve(){
            $id = $('#prod_id').val();
            $.ajax({
                url: "{{url('approve_pmcost')}}",
                type: "post",
                data: {
                    'id': $id
                },
                success: function(data) {
                    toastr.success('Approved Successfully');
                    $('#pmdetails_modal').modal('hide');
                    table.ajax.reload();
                    table2.ajax.reload();
                    table3.ajax.reload();
                }
            });
        }

        function pm_reject(){
            $id = $('#prod_id').val();
            $.ajax({
                url: "{{url('reject_pmcost')}}",
                type: "post",
                data: {
                    'id': $id
                },
                success: function(data) {
                    toastr.success('Rejected Successfully');
                    $('#pmdetails_modal').modal('hide');
                    table.ajax.reload();
                    table2.ajax.reload();
                    table3.ajax.reload();
                }
            });
        }

    </script>

</body>

</html>
