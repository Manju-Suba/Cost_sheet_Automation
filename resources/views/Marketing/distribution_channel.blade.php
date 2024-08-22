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

    <!-- datatable -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
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
                                        <div class="col">
                                            <div class="my-4 text-center">
                                                <h5 class="text-muted">Distribution Channel Details</h5>
                                                <!-- Extra Large modal -->
                                                <button type="button"
                                                    class="btn btn-primary waves-effect waves-light float-end mb-3"
                                                    data-bs-toggle="modal" id= "insert_modal" data-bs-target="#uomModal">Add
                                                    Distribution Channel</button>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="uomModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5>Distribution Channel Information</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="frm_uom" enctype="multipart/form-data">
                                                                <div class="row">

                                                                    <div class="col-md-6">
                                                                        <label for="pname" class="form-label">Distribution Channel
                                                                            Name</label>
                                                                        <input type="text" class="form-control"
                                                                            id="lname" name="dist_name">
                                                                            <span class="dist-error text-danger" ></span>

                                                                        <input type="hidden" name="_token"
                                                                            value="<?= csrf_token() ?>">
                                                                    </div>

                                                                </div>
                                                                {{-- <div class="row">
                                                                    <div class="col-md-6">
                                                                        <button type="button" id="sub" style="margin-left:90%" class="btn btn-sm btn-secondary">Submit</button>
                                                                        <button type="button" id="close1" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                                                    </div>
                                                                </div> --}}
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary"
                                                                id="save_id">Save</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="uomeditModal" tabindex="-2"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5>Distribution Channel Information</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="edit_form_uom" enctype="multipart/form-data">
                                                                <div class="row">
                                                                    <input type="text" name="update_id_name" id="hidden_update_id" hidden>
                                                                    <div class="col-md-6">
                                                                        <label for="pname" class="form-label">Distribution Channel
                                                                            Name</label>
                                                                        <input type="text" class="form-control uname_class"
                                                                            id="edit_lname" name="edit_dist_name">
                                                                            <span class="dist-error text-danger" ></span>
                                                                        <input type="hidden" name="_token"
                                                                            value="<?= csrf_token() ?>">
                                                                    </div>

                                                                </div>

                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                id="update_id">Update</button>
                                                        </div>

                                                    </div>
                                                </div>
                                        </div>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table" id="table" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>S.no</th>
                                                        <th>Distribution Channel Name</th>
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
                    <!-- end row -->

                    {{-- delete pop up  --}}
                    <div class="modal fade" id="confirm_modal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="exampleModalToggleLabel">Are you sure?</h4>
                              {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                            </div>
                            <div class="modal-body">
                                <input type="text" value="" id="hid_id" hidden>
                                <p>Do you really want to delete these records? This process cannot be undone.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" id="delete_confirm" onclick= "delete_uom();">Delete</button>
                            </div>
                          </div>
                        </div>
                    </div>
                    {{-- delete pop up  --}}
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

 <script src="../assets/js/app.js"></script>
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    {{-- <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        </script> --}}
    <script>
        $(function () {
            table = $('#table').DataTable({
                // processing: true,
                // serverSide: true,
                ajax:  {
                url: "{{ url('/fetch_dist_ch') }}",
                },
                columns: [
                    {data: 'DT_RowIndex'},
                    // {data: 'id'},
                    {data: 'dist_name', name: 'dist_name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });

        $('#save_id').click(function(){
            var val=$("#lname").val();
            if(val!=''){
             var formData = new FormData($('#frm_uom')[0]);
            console.log(formData);
            $.ajax({
                url:"{{ url('add_dist_ch')}}",
                method:'POST',
                contentType: false,
                processData: false,
                data:formData,
                success:function(data){
                    $('#frm_uom')[0].reset();
                    table.ajax.reload();
                    $('#uomModal').modal('hide');
                    Swal.fire(
                        'Distribution Channel successfully added!',
                    )
                },
                 error:function(response){
                    if (response.responseJSON.message.includes("Duplicate entry")) {
                     toastr.error("Distribution Channel  already exists")
                    }
                 }
            });
            }else{
             $(".dist-error").html('Distribution Channel field is required')
            }

        });

        $("#insert_modal").click(function(){
            $(".dist-error").html('');
        })

        function open_confirm(id){
            $('#confirm_modal').modal('show');
            $('#hid_id').val(id);
        }


        function delete_uom(){
            id = $('#hid_id').val();
            $.ajax({
                url:"{{ url('delete_dist_ch')}}"+'/'+id,
                type:"GET",
                success:function(data){
                    Swal.fire(
                        'Deleted Successfully!',
                    )
                    table.ajax.reload();
                  $('#confirm_modal').modal('hide');
                }
            });
        }

        function edit_form(id){
            $('#uomeditModal').modal('show');
            $(".dist-error").html('');

            $.ajax({
                url:"{{ url('get_dist_ch')}}"+'/'+id,
                type:"GET",
                success:function(data){
                    $('#hidden_update_id').val(data.data.id);
                    $('.uname_class').val(data.data.dist_name);
                }
            });
        }

        $('#update_id').click(function(){
            var val=$('#edit_lname').val();
            if(val!=''){
                var formData = new FormData($('#edit_form_uom')[0]);
                $.ajax({
                    url:"{{ url('update_dist_ch')}}",
                    method:'POST',
                    contentType: false,
                    processData: false,
                    data:formData,
                    success:function(data){
                        $('#frm_uom')[0].reset();
                        table.ajax.reload();
                        $('#uomeditModal').modal('hide');
                        Swal.fire(
                            'Distribution Channel successfully updated!',
                        )
                    },
                    error:function(response){
                    if (response.responseJSON.message.includes("Duplicate entry")) {
                     toastr.error("Distribution Channel  already exists")
                    }
                    }
                });
            }else{
                $(".dist-error").html('Distribution Channel field is required')
            }
        });

    </script>

</body>

</html>
