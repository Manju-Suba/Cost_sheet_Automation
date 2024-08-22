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
                                        <div class="">
                                            <h5 class="">Approved Product Details</h5>
                                        </div>
                                        <p class="card-title-desc"></p>

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
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-hover " id="product_details" style="width:100%;">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>S.no</th>
                                                                                    <th>Product Name</th>
                                                                                    <th>Status</th>
                                                                                    <th>Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal-->
                                                        <div class="col">
                                                            <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" id="edit_modal" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">
                                                                            <div class="card-content">
                                                                                <div class="card-body">
                                                                                    <div class="col-12">
                                                                                        <form id="addform" enctype="multipart/form-data" method="post">
                                                                                            <div class="row">
                                                                                                <h5>Request Form</h5>
                                                                                                <div class="col-md-10">
                                                                                                    <label for="inputEmail4" class="form-label">Amount</label>
                                                                                                    <input type="text" class="form-control" id="amount" name="amount" required>
                                                                                                    <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                                                                                                </div>
                                                                                                <div class="col-md-10">
                                                                                                    <label for="inputEmail4" class="form-label">Remarks</label>
                                                                                                    <input type="text" class="form-control" id="remarks" name="remarks" required>
                                                                                                    <input type="hidden" class="form-control" id="hid_id" name="hid_id">
                                                                                                    <input type="hidden" class="form-control" id="pro_id" name="pro_id">
                                                                                                </div>

                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div class="col-md-6 pt-3">
                                                                                                    <button type="button" id="save_id" style="margin-left:65%" class="btn btn-sm btn-primary">Send <i class="bx bx-navigation icon nav-icon"></i></button>
                                                                                                </div>
                                                                                                <div class="col-md-6 pt-3">
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
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="profile1" role="tabpanel">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover " id="exists_product" style="width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.NO</th>
                                                                    <th>Material Code</th>
                                                                    <th>Approval Status</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>

                                                    <!-- Modal-->
                                                    <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" id="epd_modal" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <div class="card-content">
                                                                        <div class="card-body">
                                                                            <div class="col-12">
                                                                                <form id="epdform" enctype="multipart/form-data" method="post">
                                                                                    <div class="row">
                                                                                        <h5>Request Form</h5>
                                                                                        <div class="col-md-10">
                                                                                            <label for="inputEmail4" class="form-label">Amount</label>
                                                                                            <input type="text" class="form-control" id="epdamount" name="epdamount" required>
                                                                                            <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                                                                                        </div>
                                                                                        <div class="col-md-10">
                                                                                            <label for="inputEmail4" class="form-label">Remarks</label>
                                                                                            <input type="text" class="form-control" id="epdremarks" name="epdremarks" required>
                                                                                            <input type="hidden" class="form-control" id="ehid_id" name="ehid_id">
                                                                                            <input type="hidden" class="form-control" id="epro_id" name="epro_id">
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-6 pt-3">
                                                                                            <button type="button" id="esave_id" style="margin-left:65%" class="btn btn-sm btn-primary">Send <i class="bx bx-navigation icon nav-icon"></i></button>
                                                                                        </div>
                                                                                        <div class="col-md-6 pt-3">
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
        $(document).ready(function() {

            table = $('#product_details').DataTable({
                autowidth: false,
                'ajax': {
                    url: "{{ url('approved_coststs') }}",
                    // type: 'POST'
                },
                'columns': [{
                        title: "S.no",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    { data: 'Product_name' },
                    { data: 'bstatus' },
                    { data: 'action' },
                ],
            });

            table2 = $('#exists_product').DataTable({
                "autoWidth": false,
                'ajax': {
                    url: "{{ url('exists_approved_costs')}}",
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'material_code',
                        name: 'material_code'
                    },
                    {
                        data: 'bstatus',
                        name: 'bstatus'
                    },
                    {
                        data:'action'
                    }
                ]
            });
        });


        function openmodel(id) {
            $.ajax({
                url: '{{ 'fetchdetails' }}',
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    // $('#pro_id').val(data.result.pro_id);
                    $('#hid_id').val(data.result.id);
                    $('#edit_modal').modal('show');
                    $('#pro_id').val('');
                    $('#amount').val('');
                    $('#remarks').val('');

                    if(data.reqd != ''){
                        $('#pro_id').val(data.reqd.id);
                        $('#amount').val(data.reqd.amount);
                        $('#remarks').val(data.reqd.remarks);
                    }

                    $('#edit_modal').modal('show');
                }
            });
        }

        $('#save_id').click(function() {
            var formData = new FormData($('#addform')[0]);
            $.ajax({
                url: "{{ url('send_request') }}",
                type: 'POST',
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    $("#addform")[0].reset();
                    $('#edit_modal').modal('hide');
                    toastr.success('Request Send successfully');
                    table.ajax.reload();
                }
            });
        })

        function epdopenmodel(id) {
            $.ajax({
                url: '{{ 'fetchepdetails' }}',
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    // $('#pro_id').val(data.result.pro_id);
                    $('#ehid_id').val(data.result.id);
                    $('#epd_modal').modal('show');
                    $('#epro_id').val('');
                    $('#epdamount').val('');
                    $('#epdremarks').val('');

                    if(data.reqd != ''){
                        $('#epro_id').val(data.reqd.id);
                        $('#epdamount').val(data.reqd.amount);
                        $('#epdremarks').val(data.reqd.remarks);
                    }
                }
            });
        }

        $('#esave_id').click(function() {
            var formData = new FormData($('#epdform')[0]);
            $.ajax({
                url: "{{ url('send_epdrequest') }}",
                type: 'POST',
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    $("#epdform")[0].reset();
                    $('#epd_modal').modal('hide');
                    toastr.success('Request Send successfully');
                    table2.ajax.reload();
                }
            });
        })

    </script>

</body>
</html>
