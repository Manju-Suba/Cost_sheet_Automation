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
    <link rel="shortcut icon" href="assets/images/h_logo.png">
    <!-- plugin css -->
    <link href="assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />

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
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"> </script>
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">

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

                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover " id="finance_tb" style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>S.no</th>
                                                            <th>Product Name</th>
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
                        </div>
                    </div>
                    <!-- end row -->
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
                                            <label for="" class="form-label fw-bold text-dark">DAMAGES</label>
                                            <div class="row mb-1">
                                                <div class="col-md-4">
                                                    <label for="" class="form-label">Damages in %</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="damage_id" name="damage_name">
                                                </div>
                                            </div>
                                            <label for="" class="form-label fw-bold text-dark">LOGISTICS</label>
                                            <div class="row mb-1">
                                                <div class="col-md-4">
                                                    <label for="" class="form-label">Logistics Cost in %
                                                    </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="logistic_id" name="logistic_name">
                                                    <input type="text" id="hid_id" name="hid_name" value="" hidden>
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
    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <!-- Vector map-->
    <script src="assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="assets/libs/jsvectormap/maps/world-merc.js"></script>
    <script src="assets/js/pages/dashboard.init.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="../assets/toastify/toastify.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            table = $('#finance_tb').DataTable({
                'autowidth': false,
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
        });

        function openmodel(id) {
            $('#damage_modal_id').modal('show');
            $('#hid_id').val(id);

            $.ajax({
                url: "{{url('fetch_finance_data')}}",
                type: "GET",
                data: {
                    id: id
                },
                success: function(data) {
                    $('#damage_id').val(data.result.damage);
                    $('#logistic_id').val(data.result.logistic);
                    $('#save_id').html('save');

                    if (data.result.logistic != "" && data.result.logistic != null) {
                        $('#save_id').html('update');
                    }
                }
            });
        }

        $('#save_id').click(function() {
            $.ajax({
                url: '{{url("save_finnance")}}',
                type: 'POST',
                data: $('#finnance_form').serialize(),
                success: function(data) {
                    toastr.success('Saved Successfully');
                    $('#damage_modal_id').modal('hide');
                    $('#finnance_form')[0].reset();
                }
            });
        });
    </script>

</body>

</html>