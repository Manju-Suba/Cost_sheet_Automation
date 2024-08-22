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
    {{-- toaster --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
    <!-- datatable -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"> </script>
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet"> --}}

    {{-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script> --}}
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"> </script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"> </script>
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet"> --}}
</head>
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
                                        <h4 class="card-title">EPD Primary Freight Details</h4>
                                        <p class="card-title-desc"></p>

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                            <li class="nav-item epd-tab1">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block">Pending Freights</span>
                                                </a>
                                            </li>
                                            <li class="nav-item epd-tab2">
                                                <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block">Rejected Freights</span>
                                                </a>
                                            </li>
                                            <li class="nav-item epd-tab3">
                                                <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                    <span class="d-none d-sm-block">Approved Freights</span>
                                                </a>
                                            </li>

                                        </ul>

                                        <div class="tab-content p-3 text-muted">
                                            <div class="tab-pane active" id="home1" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-hover " id="freight_pending" style="width:100%">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>S.no</th>
                                                                                    <th>Material Code</th>
                                                                                    <th>No of Pcs</th>
                                                                                    <th>Division</th>
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
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="profile1" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-hover" id="approved_process" style="width:100%">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>S.no</th>
                                                                                    <th>Material Code</th>
                                                                                    <th>No of Pcs</th>
                                                                                    <th>Division</th>
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
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="messages1" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-hover " id="rejected_items" style="width:100%">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>S.no</th>
                                                                                    <th>Material Code</th>
                                                                                    <th>No of Pcs</th>
                                                                                    <th>Division</th>
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
                        <div class="modal fade" id="epd_frieght_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5>EPD Primary Freight</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form id="primary_form">
                                        <div class="modal-body">
                                            <input type="text" id="hid_id" value="" hidden>
                                            <table class="table table-hover" id="add_primary_frit" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>From Location</th>
                                                        <th>To Location</th>
                                                        <th>Primary Freight(Per Case)</th>
                                                        <th>cost</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <div id="btn_visible">
                                                <button type="button" class="btn btn-primary btn-sm" id="save_id">Save</button>
                                            </div>
                                        </div>
                                    </form>
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

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        //  $(document).on('keyup','input[name="pri_freight[]"]',function(){
        //     if($(this).val() >=100){
        //         $(this).val(100);
        //     }
        //  });
        $(document).ready(function() {
            tables_();
            // approvals();
            // rejected_table();
        });

        $('.epd-tab1').click(function(){
            tables_();
        })
        $('.epd-tab2').click(function(){
            rejected_table();
        })
        $('.epd-tab3').click(function(){
            approvals();
        })

        function tables_(){
            table = $('#freight_pending').DataTable({
                'autowidth': false,
                "bDestroy": true,
                ajax: {
                    url: "{{url('exist_logic')}}",
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {data: 'material_code', name: 'material_code'},
                    {data: 'pieces_per_case', name: 'pieces_per_case'},
                    {data: 'division', name: 'division'},
                    // {data: 'mrp_piece', name: 'mrp_piece'},
                    {data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        }

        function approvals(){
            table3 = $('#approved_process').DataTable({
                "bDestroy": true,
                'autowidth': false,
                ajax: {
                    url: "{{url('exist_logic_approved')}}",
                    data:{'app':'app'},
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {data: 'material_code', name: 'material_code'},
                    {data: 'pieces_per_case', name: 'pieces_per_case'},
                    {data: 'division', name: 'division'},
                    // {data: 'mrp_piece', name: 'mrp_piece'},
                    {data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        }

        function rejected_table(){
            table2 = $('#rejected_items').DataTable({
                "bDestroy": true,
                // 'autowidth': false,
                ajax: {
                    url: "{{url('exist_logic_approved')}}",
                    data:{'rej':'rej'},
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {data: 'material_code', name: 'material_code'},
                    {data: 'pieces_per_case', name: 'pieces_per_case'},
                    {data: 'division', name: 'division'},
                    // {data: 'mrp_piece', name: 'mrp_piece'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false }
                ],
            });
        }

        function openmodel(id) {
            $('#hid_id').val(id);
            $('#epd_frieght_modal').modal('show');

            $('#add_primary_frit').DataTable({
                "bDestroy": true,
                searching: false,
                ajax: {
                    url: "{{url('fetch_expri')}}",
                    data: {
                        id: id
                    }
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'from_location',
                        name: 'from_location'
                    },
                    {
                        data: 'to_location',
                        name: 'to_location'
                    },
                    {
                        data: 'cost_box',
                        name: 'cost_box'
                    },
                    {
                        data: 'conditions',
                        name: 'conditions',
                        visible: false
                    },
                ],
                "columnDefs": [
                    {
                    "targets" : [ 4 ],
                    render: function(data, type, row) {
                        if( data =='view') {
                            $('#btn_visible').css('display','none');
                            return 'false';
                        }else if( data == 'update'){
                            $('#save_id').html('Update');
                            $('#btn_visible').css('display','block');
                            return 'false';
                        }else{
                            $('#btn_visible').css('display','block');
                            return 'true';
                        }
                    }
                },
            ],
            });
        }

        $("#save_id").click(function() {
            var formData = new FormData($('#primary_form')[0]);
            var arr=[]
            $('input[name="pri_freight[]"]').each(function(){
                 arr.push($(this).val());
            });
            if(jQuery.inArray('',arr) == -1){
                $.ajax({
                    url: '{{url("epd_save_primary_frieght")}}',
                    method: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(data) {

                        if(data.status == 'success'){
                            $("#primary_form")[0].reset();
                            tables_();
                            approvals();
                            rejected_table();
                            toastr.success('Primary Frieght Saved Successfully!');

                            $('#epd_frieght_modal').modal('hide');
                        }else{
                            toastr.error('Error noted!');

                        }

                    }
                });
            }else{
                toastr.error('Please Fill All fields');
            }
        });
    </script>

</body>

</html>
