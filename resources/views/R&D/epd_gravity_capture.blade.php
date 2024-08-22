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
                                        <h4 class="card-title mb-3">EPD Specific Gravity Details</h4>
                                        <p class="card-title-desc"></p>

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                            <li class="nav-item epd-tab1">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block">Pending Products</span>
                                                </a>
                                            </li>
                                            <li class="nav-item epd-tab3">
                                                <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                    <span class="d-none d-sm-block">Approved Products</span>
                                                </a>
                                            </li>
                                            <li class="nav-item epd-tab2">
                                                <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block">Rejected Products</span>
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
                                                                        <table class="table table-hover" id="gravity_pending" style="width:100%">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>S.no</th>
                                                                                    <th>Material Code</th>
                                                                                    <th>Division</th>
                                                                                    <th>No of Pcs.</th>
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
                        <div class="modal fade" id="epd_specific_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5>EPD Specific Gravity</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form id="gravity_form">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" id="hid_id" name="hid_id" hidden>
                                                    <label for="" class="form-label">Specific Gravity<span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" id="spec_gravity" name="spec_gravity" onkeypress="return /[0-9.]/i.test(event.key)" required>
                                                </div>
                                                <div class="alert_color" id="exgat_err"></div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary btn-sm" id="save_id">Save</button>
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
    <!-- Vector map-->
    <script src="../assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="../assets/libs/jsvectormap/maps/world-merc.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
    <script src="../assets/js/app.js"></script>

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
            table = $('#gravity_pending').DataTable({
                'autowidth': false,
                "bDestroy": true,
                ajax: {
                    url: "{{url('get_ex_sgravity_pending_record')}}",
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {data: 'material_code', name: 'material_code'},
                    {data: 'division', name: 'division'},
                    {data: 'pieces_per_case', name: 'pieces_per_case'},
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
                    url: "{{url('get_exist_gravity_approved')}}",
                    data:{'app':'app'},
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {data: 'material_code', name: 'material_code'},
                    {data: 'division', name: 'division'},
                    {data: 'pieces_per_case', name: 'pieces_per_case'},
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
                    url: "{{url('get_exist_gravity_approved')}}",
                    data:{'rej':'rej'},
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {data: 'material_code', name: 'material_code'},
                    {data: 'division', name: 'division'},
                    {data: 'pieces_per_case', name: 'pieces_per_case'},
                    // {data: 'mrp_piece', name: 'mrp_piece'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false }
                ],
            });
        }

        function openmodel(id) {
            $('#hid_id').val(id);
            $('#spec_gravity').removeAttr('disabled');
            $('#spec_gravity').val('');
            $('#save_id').css('display','block');
            $('#save_id').html('save');

            $.ajax({
                url: '{{'fetch_gravity'}}',
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    $('.alert_color').html('');

                    if (data.result != null) {
                        if(data.result.specific_gravity != 0){
                            $('#spec_gravity').val(data.result.specific_gravity);
                            if(data.result.gravity_approval == 'rejected'){
                                $('#save_id').html('update');
                                $('#save_id').css('display','block');
                            }else{
                                $('#spec_gravity').attr('disabled','true');
                                $('#save_id').css('display','none');
                            }
                        }
                    }
                    $('#epd_specific_modal').modal('show');
                }
            });
        }

        $('#save_id').click(function() {
            $gravity =  $('#gravity_form #spec_gravity').val();
            $("#exgat_err").text('');

            if($gravity != ""){
                $.ajax({
                    url: '{{url("save_gravity")}}',
                    type: 'POST',
                    data: $('#gravity_form').serialize(),
                    success: function() {
                        toastr.success('Saved successfully');
                        $('#gravity_form')[0].reset();
                        $('#epd_specific_modal').modal('hide');
                        tables_();
                        approvals();
                        rejected_table();
                        // table2.ajax.reload();
                        // table3.ajax.reload();
                        // table4.ajax.reload();
                    }
                })
            }else{
                if($sales_val.length != 2){
                    $("#exgat_err").text('Specific Gravity field is required');
                }
            }
        });
    </script>

</body>

</html>
