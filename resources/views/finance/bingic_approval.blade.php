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
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"> </script>
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
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

                                        <h4 class="card-title">RM Formulation </h4>
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
                                                                        <table class="table table-hover " id="ingi_comp">
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
                                                            </div>
                                                        </div>
                                                        <!-- Modal-->

                                                        <div class="modal fade" id="rdform" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="staticBackdropLabel">* RM Formulation Details</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="col-12">
                                                                            <div class="table-responsive">
                                                                                <table class="table table-hover " id="formalation_tabid" style="width:100%">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>S.no</th>
                                                                                            <th>Ingredients </th>
                                                                                            <th>Ingredient Composition %</th>
                                                                                            <th>%Wt (Ins.Scrap) </th>
                                                                                            <th>Qty</th>
                                                                                            <th>Cost</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                </table>
                                                                            </div>
                                                                            <!-- <div class="row mt-3 mb-3">
                                                                                <label><h6>* RM Formulation Approval Action</h6></label>
                                                                                <div class="col-md-1"></div>
                                                                                <div class="col-md-4">
                                                                                    <input type="hidden" class="form-control" id="prod_id" name="prod_id">
                                                                                    <button type="button" class="btn btn-success" onclick="rmformu_approve()">RM Formulation Approve</button>
                                                                                </div>
                                                                                <div class="col-md-6 mr-4">
                                                                                    <button type="button" class="btn btn-danger" onclick="rmformu_reject()">RM Formulation Reject</button>
                                                                                </div>
                                                                            </div> -->
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-2 mt-2 mb-3 mx-4">
                                                                            <b>Specific Gravity:</b> <span id="spec_grav">23</span><br>
                                                                            <b>RM Cost:</b> <span id="rm_cost">232</span>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!-- </div> -->
                                            <!-- <div class="tab-pane" id="profile1" role="tabpanel">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover " id="rm_approved_tb" style="width: 100%;">
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


                                            </div>
                                            <div class="tab-pane" id="messages1" role="tabpanel">
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

    <div class="modal fade" id="rdformulate" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">RM Formulation Details With Approval Process</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-hover " id="formalate_tabid" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Ingredients </th>
                                        <th>Ingredient Composition %</th>
                                        <th>%Wt (Ins.Scrap) </th>
                                        <th>Me2L Rate </th>
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

            table = $('#ingi_comp').DataTable({
                "autoWidth": false,
                'ajax': {
                    url: "{{ url('get_ingre_comp')}}",
                    // type: 'POST'
                },
                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'Product_name', name: 'Product_name'},
                    {data: 'Volume', name: 'Volume'},
                    {data: 'case_configuration', name: 'case_configuration'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'version', name: 'version', visible: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });

            table2 = $('#rm_approved_tb').DataTable({
                "autoWidth": false,
                'ajax': {
                    url: "{{ url('approved_rmform')}}",
                    // type: 'POST'
                },
                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'Product_name', name: 'Product_name'},
                    {data: 'Volume', name: 'Volume'},
                    {data: 'case_configuration', name: 'case_configuration'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'version', name: 'version'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });

            table3 = $('#rejected_tb').DataTable({
                "bDestroy": true,
                'ajax': {
                    url: '{{url("rejected_rmform")}}',
                },
                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'Product_name', name: 'Product_name'},
                    {data: 'Volume', name: 'Volume'},
                    {data: 'case_configuration', name: 'case_configuration'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'version', name: 'version'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });

        });


        function openmodel(id) {

            $('#hid_id').val(id);
            $('#prod_id').val(id);

            $('#rdform').modal('show');
            table22 = $('#formalation_tabid').DataTable({
                // 'autowidth': false,
                "bDestroy": true,
                "searching": false,
                ajax: {
                    url: "{{url('fetch_rmcalc')}}",
                    data: {
                        id: id
                    }
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    { data: 'Ingredient',name: 'Ingredient' },
                    { data: 'ingredientComposition',name: 'ingredientComposition'},
                    { data: 'scrap',name: 'scrap' },
                    { data: 'qty',name: 'qty' },
                    { data: 'rate',name: 'rate' },
                ]
            });
            $.ajax({
                url: '{{url("get_gravity")}}',
                type: 'GET',
                data: {
                    id: id,
                },
                success: function(data) {
                    $('#spec_grav').val(data.res.specific_gravity);
                    $('#rm_cost').html(data.res.total_rm_cost);
                },
            });
        }


        function openmodel2(id) {
            $('#hid_id').val(id);
            $('#prod_id').val(id);

            $('#rdformulate').modal('show');
            table222 = $('#formalate_tabid').DataTable({
                // 'autowidth': false,
                "bDestroy": true,
                ajax: {
                    url: "{{url('fetch_rmcalc')}}",
                    data: {
                        id: id
                    }
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    { data: 'Ingredient',name: 'Ingredient' },
                    { data: 'ingredientComposition',name: 'ingredientComposition'},
                    { data: 'scrap',name: 'scrap' },
                    { data: 'rate',name: 'rate' },
                    { data: 'cost',name: 'cost' },
                ]
            });
        }


        function rmformu_approve(){
            $id = $('#prod_id').val();
            $.ajax({
                url: "{{url('approve_rmformu_cost')}}",
                type: "post",
                data: {
                    'id': $id
                },
                success: function(data) {
                    toastr.success('Approved Successfully');
                    $('#rdform').modal('hide');
                    table.ajax.reload();
                    table2.ajax.reload();
                    table3.ajax.reload();
                }
            });
        }

        function rmformu_reject(){
            $id = $('#prod_id').val();
            $.ajax({
                url: "{{url('reject_rmformu_cost')}}",
                type: "post",
                data: {
                    'id': $id
                },
                success: function(data) {
                    toastr.success('Rejected Successfully');
                    $('#rdform').modal('hide');
                    table.ajax.reload();
                    table2.ajax.reload();
                    table3.ajax.reload();
                }
            });
        }

    </script>

</body>

</html>
