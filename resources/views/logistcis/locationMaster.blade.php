<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8" />
    <title>Cost Sheet Automation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/h_logo.png">

    <!-- Bootstrap Css -->
    <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />

    <!-- datatable -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"> </script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"> </script>
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet">
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

        @media (min-width: 769px){
            body[data-sidebar-size=sm] {
               min-height: 200px;
            }
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
                                            <div class=" text-center">
                                                <h5 class="text-muted">Location Master</h5>
                                                <!-- Extra Large modal -->
                                                <button type="button" class="btn btn-primary mb-4 waves-effect waves-light float-end mb-3" data-bs-toggle="modal" data-bs-target="#uploadModal">
                                                    <i class="bx bx-upload icon nav-icon"></i>  Location upload
                                                </button>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5>Location Master Upload</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" style="padding: 1rem 3rem;">
                                                            <form id="frm_upload" enctype="multipart/form-data">
                                                                <div class="row ml-4">
                                                                    <div style="color:red;"> [ Sample Format Download <a href="../assets/csv/location-master-sample.xlsx" title="click me!">here.....!</a> ] </div>
                                                                    <div class="col-md-11 mt-4">
                                                                        <label for="" class="form-label">Location Type</label>
                                                                        <select name="location_type" id="location_type" class="form-control" required>
                                                                            <option value="" selected disabled>--Select--</option>
                                                                            <option value="primary_from">Primary From</option>
                                                                            <option value="primary_to">Primary To</option>
                                                                            <option value="secondary_to">Secondary To</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-11 mt-2">
                                                                        <label for="pname" class="form-label">Master Upload</label>
                                                                        <input type="file" class="form-control" id="location_upload" name="location_upload" accept=".csv,.xlsx" required>
                                                                        <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary"
                                                                id="save_id">Upload</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                            <div class="modal fade" id="editModal" tabindex="-2" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5>Location Master Upload</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="edit_form" enctype="multipart/form-data">
                                                                <div class="row">
                                                                    <input type="text" name="location_id" id="location_id" hidden>
                                                                    <div class="col-md-10">
                                                                        <label for="pname" class="form-label">Location </label>
                                                                        <input type="text" class="form-control" id="edit_location" name="edit_location">
                                                                        <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                                                id="update_id">Update</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-8">
                                            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="primfromlocation" data-bs-toggle="tab" href="#tab1" role="tab">
                                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                        <span class="d-none d-sm-block">Primary From Location</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="primtolocation" data-bs-toggle="tab" href="#tab2" role="tab">
                                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                        <span class="d-none d-sm-block">Primary To Location</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="sectolocation" data-bs-toggle="tab" href="#tab3" role="tab">
                                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                        <span class="d-none d-sm-block">Secondary To Location</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="tab-content p-3 text-muted">
                                            <div class="tab-pane active" id="tab1" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card mt-4">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-striped" id="locationtable" style="width: 100%">
                                                                            <thead style="">
                                                                                <tr>
                                                                                    <th>S.no</th>
                                                                                    <th>Primary From Location</th>
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
                                            <div class="tab-pane" id="tab2" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card mt-3">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-striped" id="tolocationtable">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>S.no</th>
                                                                                    <th>Primary To Location</th>
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
                                            <div class="tab-pane" id="tab3" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card mt-3">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-striped" id="sec_totable">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>S.no</th>
                                                                                    <th>Sec. To Location</th>
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
 <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
 <script src="../assets/libs/metismenujs/metismenujs.min.js"></script>
 <script src="../assets/libs/simplebar/simplebar.min.js"></script>
 <script src="../assets/libs/eva-icons/eva.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
 <script src="../assets/js/app.js"></script>

    {{-- <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        </script> --}}

    <script>
        var table2;
        var table3;

        $('#primfromlocation').click( function(){
            if (table) {
                table.destroy(); // Destroy the existing DataTable
            }
            trigger_table();
        })

        trigger_table();
        function trigger_table() {
            $type = 'primary_from';
            table = $('#locationtable').DataTable({
                processing: true,
                ajax:  {
                    url: "{{ url('/location_fetch') }}",
                    data: { 'type': $type },
                },
                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'location', name: 'location'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        };

        $('#primtolocation').click( function(){
            if (table2) {
                table2.destroy(); // Destroy the existing DataTable
            }
            trigger_totable();
        })

        function trigger_totable() {
            $type = 'primary_to';
            table2 = $('#tolocationtable').DataTable({
                processing: true,
                ajax:  {
                    url: "{{ url('/location_fetch') }}",
                    data: { 'type': $type },
                },
                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'location', name: 'location'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        };

        $('#sectolocation').click( function(){
            if (table3) {
                table3.destroy(); // Destroy the existing DataTable
            }
            sec_totable();
        })

        function sec_totable(type) {
            $type = 'secondary_to';
            table3 = $('#sec_totable').DataTable({
                processing: true,
                ajax:  {
                    url: "{{ url('/location_fetch') }}",
                    data: { 'type': $type },
                },
                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'location', name: 'location'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        };

        $('#save_id').click(function(){
            var formData = new FormData($('#frm_upload')[0]);
            $.ajax({
                url:"{{ url('upload_location')}}",
                method:'POST',
                dataType: "JSON",
                contentType: false,
                processData: false,
                data:formData,
                success:function(data){
                    if(data.response == 'error'){
                        toastr.error(data.message.location_upload[0]);
                    }
                    else if(data.response == 'success'){
                        $('#frm_upload')[0].reset();
                        $('#uploadModal').modal('hide');
                        table.destroy();
                        trigger_table();
                        trigger_totable();
                        sec_totable();
                        toastr.success('Location Uploaded successfully!');
                    }
                    else {
                        if (data.errors) {
                            for (var key in data.errors) {
                                if (key.endsWith('.location')) {
                                toastr.error(data.errors[key][0]);
                                }
                            }
                        }
                    }
                }
            });
        });


        function open_confirm(id){

            $('#confirm_modal').modal('show');
            $('#hid_id').val(id);
        }


        function edit_form(id){
            $('#editModal').modal('show');
            $.ajax({
                url:"{{ url('get_location')}}"+'/'+id,
                type:"GET",
                success:function(data){
                    $('#location_id').val(data.data.id);
                    $('#edit_location').val(data.data.location);
                }
            });
        }

        $('#update_id').click(function(){
            var formData = new FormData($('#edit_form')[0]);
            $.ajax({
                url:"{{ url('update_location')}}",
                method:'POST',
                contentType: false,
                processData: false,
                data:formData,
                success:function(data){
                    if(data.response == 'success'){
                        $('#frm_upload')[0].reset();
                        table.destroy();
                        trigger_table();

                        table2.destroy();
                        trigger_totable();

                        table3.destroy();
                        sec_totable();

                        toastr.success('Location successfully updated!');
                    }else{
                        toastr.error('Something Error!');
                    }
                }
            });
        });

    </script>

</body>

</html>
