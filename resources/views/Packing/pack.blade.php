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
    {{-- toastr --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />

    <!-- datatable -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"> </script>
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>


    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"> </script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"> </script>
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
        /* .swal2-popup{


} */
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
            border: 1px solid #e53f37;
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
                                        <h4 class="card-title">PM Details</h4>
                                        <p class="card-title-desc"></p>

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                            <li class="nav-item" id="add_pack">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block">Add PM</span>
                                                </a>
                                            </li>
                                            {{-- <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block">Pending</span>
                                                </a>
                                            </li> --}}
                                            <li class="nav-item" id="comp_pack">
                                                <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                    <span class="d-none d-sm-block">Completed</span>
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
                                                                    <div class="col-12">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-hover " id="users">
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

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="profile1" role="tabpanel">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover " id="pmview">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.no</th>
                                                                    <th>Product Name</th>
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
                                                <div class="col">
                                                    <!--  Modal content for the above example -->
                                                    <div class="modal fade" id="pmviewmodel" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">View RM Rate</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-12">
                                                                        <div class="table-responsive">
                                                                            <input type="text" id="viewid" hidden>
                                                                            <table class="table table-hover " id="scrapview">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>#</th>
                                                                                        <th>PM</th>
                                                                                        <th>PM Details<span class="text-danger">*</span></th>
                                                                                        <th>PM Specification<span class="text-danger">*</span></th>
                                                                                        <th>Qty<span class="text-danger">*</span></th>
                                                                                        <th>Scrap<span class="text-danger">*</span></th>
                                                                                    </tr>
                                                                                </thead>
                                                                            </table>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    {{-- <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- /.modal -->
                                            </div>
                                            <div class="tab-pane" id="messages1" role="tabpanel">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover " id="pack_completed_data" style="width:100%">
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="col">
                        <div class="modal fade bs-example-modal-xl" id="packmodel" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="myExtraLargeModalLabel">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <form id="clone_form">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Add PM Details</h5>
                                        <button type="button"
                                        class="btn btn-primary btn-sm mx-4 waves-effect waves-light float-end mb-1"
                                        data-bs-toggle="modal" data-bs-target="#bulk_upload" id="bulk">Bulk Upload
                                        </button>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-12">
                                            <div class="table-responsive">

                                                    @csrf
                                                    <input type="text" id="product_id" name="product_id" hidden>

                                                    <table class="table table-hover " id="pack_tab_id" style="width: 100%;">
                                                        <thead>
                                                            <tr>
                                                                <!-- <th>#</th> -->
                                                                <th>PM <span class="text-danger">*</span></th>
                                                                <th>PM Details <span class="text-danger">*</span></th>
                                                                <th>PM Specification <span class="text-danger">*</span></th>
                                                                <th>Qty <span class="text-danger">*</span></th>
                                                                <th>Uom </th>
                                                                <!-- <th>MOQ</th>
                                                                <th>Vendor</th>
                                                                <th>Basic</th>
                                                                <th>Freight</th> -->
                                                                <th>Scrap</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table_body">
                                                        <div class="row ">
                                                                <tr class="details">
                                                                    <!-- <td>1</td> -->
                                                                    <td><input type="text" class="form-control input-xs" id="id_pm" name="pm_name[]" value="" size="100" required></td>
                                                                    <td><textarea id="id_pmdetail" class="form-control input-xs" name="pmdetail_name[]" rows="1" cols="50" required></textarea></td>
                                                                    <td><textarea id="id_pmspec" class="form-control input-xs" name="pmspec_name[]" rows="1" cols="50" required></textarea></td>
                                                                    <td><input type="text" class="form-control input-xs" id="id_qty" name="qty_name[]" value="" size="30" required  onkeypress="return /[0-9.]/i.test(event.key)"></td>
                                                                    <td><select name="uom[]" id="" class="form-select input-xs" >
                                                                        <option value="">choose</option>
                                                                        @foreach ($uom as $uoms )
                                                                        <option value="{{$uoms->uom_name}}">{{$uoms->uom_name}}</option>
                                                                        @endforeach
                                                                    </select></td>
                                                                    <!-- <td><input type="text" class="form-control input-xs" id="id_moq" name="moq_name[]" value=""></td>
                                                                    <td><input type="text" class="form-control input-xs" id="id_vendor" name="vendor_name[]" value="" size="100"></td>
                                                                    <td><input type="text" class="form-control input-xs" id="id_basic" name="basic_name[]" value=""></td>
                                                                    <td><input type="text" class="form-control input-xs" id="id_freight" name="freight_name[]" value=""></td> -->
                                                                    <td><input type="text" class="form-control input-xs" id="scrap" name="scrap[]" value=""   onkeypress="return /[0-9.]/i.test(event.key)" ></td>

                                                                    <td>
                                                                        <div class="action_container">
                                                                            <button type="button" class="btn-success" id="plus"><i class="fa fa-plus"></i></button>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </div>
                                                        </tbody>
                                                    </table>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" id="save_value" class="btn btn-sm btn-primary" value="Save">
                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                        </div>

                        <div class="modal fade" id="pmscrapmodel" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content" style="width:980px;">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">View RM Rate</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <input type="text" id="viewid" hidden>
                                                <table class="table" id="pmscrapview">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>PM</th>
                                                            <th>PM Details</th>
                                                            <th>PM Specification</th>
                                                            <th>Qty</th>
                                                            <th>Scrap</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        {{-- <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="bulk_upload" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                       <form id="frm_upload" enctype="multipart/form-data">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5>Bulk Upload</h5>
                                        <a href="../assets/csv/pm_sample.xlsx" title="Download" class="btn btn-sm btn-info m-3 float-end" >Sample File Download </a>
                                        <button type="button" class="btn-close"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                            <div class="row">
                                                  <input type="hidden" id="pro_id1" name="pro_id1">
                                                <div class="col-md-12">
                                                    <label>Upload File</label>
                                                    <input type="file" class="form-control" id="excel_upload"  name="excel_upload" accept=".csv,.xlsx" required>
                                                </div>
                                                <input type="hidden" name="_token"
                                                value="<?= csrf_token() ?>">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary"
                                            id="save_upload">Save</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Page-content -->
            @extends('layout.footer')
        </div>
        <!-- end main content-->
    </div>
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

    <script src="../assets/toastify/toastify.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>


    {{-- <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        </script> --}}
    <script>
$("#bulk").click(function(){
    $("#save_upload").attr('disabled', false);
});
$('#frm_upload').submit(function(e){
    $("#save_upload").attr('disabled', true);
            e.preventDefault();
            var formData = new FormData($('#frm_upload')[0]);
            // console.log(formData);
            $.ajax({
                url:"{{ url('bulkupload_pm')}}",
                method:'POST',
                data:formData,
                dataType: "JSON",
                cache: false,
                processData: false,
                contentType: false,
                success:function(response){

                    console.log(response.message );
                    if(response.status !="success"){
                        toastr.error(response.status.excel_upload[0]);
                    }else{
                        Swal.fire(
                            response.message
                        )
                        $('#frm_upload')[0].reset();
                        showcompleted();
                        showindextable();
                        $(".btn-close").click();
                        $("#plantModal").modal('hide');
                    }
                    // $('#confirm_modal').modal('hide' );

                },
                error:function(response){
                    $("#save_upload").attr('disabled', false);
                    if(response.responseJSON){
                         var errors = response.responseJSON.errors;

                if(errors!=''||errors!=undefined){
                $.each(errors, function(fieldName, errorMessages) {
                // Split the fieldName to extract the index and field name
                var parts = fieldName.split('.');
                var index = parts[0];
                var name = parts[1];

                // Loop through the error messages for this field
                $.each(errorMessages, function(index, errorMessage) {
                    // Use index and errorMessage as needed
                    toastr.error(errorMessage);
                    });
                });
                }
                    }

            }
            });
        });
        $(document).ready(function() {
            // showcompleted();
            showindextable();
        });
        $("#add_pack").click(function(){
            showindextable();
        })
        $("#comp_pack").click(function(){
showcompleted();
        })

        function showindextable() {
            table1 = $('#users').DataTable({
                "autoWidth": false,
                "bDestroy": true,
                'ajax': {
                    url: "{{ url('fetch_basic_pack')}}",
                    // type: 'POST'
                },
                'columns': [{
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
                ],
            });

        }

        function showcompleted() {
            table3 = $('#pack_completed_data').DataTable({
                "bDestroy": true,
                'ajax': {
                    url: '{{url("fetch_completed_pm")}}',
                    data:{
                         'label':'label'
                    }
                },
                'columns': [{
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
                        data: 'volume',
                        name: 'volume'
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

        function openmodel(id) {
            $("#save_value").attr('disabled',false);
            $("#clone_form")[0].reset();
            $('#packmodel').modal('show');
            $('#product_id').val(id);
            $('#pro_id1').val(id);
        }

        // table = $('#pmview').DataTable({
        //     "autoWidth": false,
        //     'ajax': {
        //         url: "{{ url('show_packpending')}}",
        //         // type: 'POST'

        //     },

        //     'columns': [{
        //             title: "S.no",
        //             render: function(data, type, row, meta) {
        //                 return meta.row + meta.settings._iDisplayStart + 1;
        //             },
        //         },
        //         {
        //             data: 'Product_Name'
        //         },
        //         {
        //             data: 'Fill_Volume'
        //         },
        //         {
        //             data: 'Cofiguration'
        //         },
        //         {
        //             data: 'Quantity'
        //         },
        //         {
        //             data: 'status'
        //         },
        //         {
        //             data: 'Action'
        //         },


        //     ],
        // });

        $("#plus").on({ click: function() {
                var counter =1;
                counter++;id_pm
                $("#table_body").append(`
                <tr>
                <td><input type="text" class="form-control input-xs"id="" name="pm_name[]" value="" required></td>
                <td><textarea id="id_pmdetail" class="form-control input-xs" name="pmdetail_name[]" rows="1" cols="50" required></textarea></td>
                <td><textarea id="id_pmspec" class="form-control input-xs" name="pmspec_name[]" rows="1" cols="50" required></textarea></td>
                <td><input type="text" class="form-control input-xs" id="id_qty" name="qty_name[]" value="" size="30" required  onkeypress="return /[0-9.]/i.test(event.key)"></td>   <td><select name="uom[]" id="" class="form-select input-xs" ><option value="">choose</option>@foreach ($uom as $uoms )<option value="{{$uoms->uom_name}}">{{$uoms->uom_name}}</option>@endforeach</select></td>
                <td><input type="text" class="form-control input-xs" id="id_scrap" name="scrap[]" value="" ></td>
                <td><div class="action_container"><button class="btn-danger danger dlt" type="button"><i class="fa fa-times"></i></button></div></td></tr>
                `);

            }
        });


        function addDeleteButton(element) {
            const deleteBtn = document.createElement('button');
            deleteBtn.type = 'button';
            deleteBtn.textContent = 'Delete';
            deleteBtn.style = 'width: 60px;border: 1px solid #867070;background-color: #d43131;color: white;';

            deleteBtn.className = 'delete-btn btn btn-sm mt-1';
            deleteBtn.addEventListener('click', function () {
                element.remove();
            });
            element.appendChild(deleteBtn);
        }

        function removeField(btn) {
            const parentDiv = btn.parentElement;
            parentDiv.remove();
        }

        $("#clone_form").on("submit", function(event) {
            $("#save_value").attr('disabled',true);
           event.preventDefault();
            data = $('#clone_form').serialize();
            $.ajax({
                'url': '{{url("save_prodmaterial_packageing")}}',
                'type': 'POST',
                'data': data,
                dataType:'json',
                'beforeSend': function() {},
                error: function(e) {
                   console.log( e.responseJSON.errors);

                },
                success: function(e) {

                  if(!e.error ){
                    toastr.success('saved successfully');
                    $('#packmodel').modal('hide');
                    // table.ajax.reload();
                    showcompleted();
                    showindextable();

                  }

                }
            });
        });

        $("#table_body").on('click', '.dlt', function() {
            if ($(this).closest('tr').index() == 0) {
                swal("You Don't have Permission to Delete This ?", {
                    icon: 'error'
                });
            } else {
                $(this).closest('tr').remove();
                counter--;

            }
        });



        function editshow(id) {
           $('#scrapview').DataTable({
                "bDestroy": true,
                ajax: {
                    url: "{{url('show_pack')}}",
                    data: {
                        id: id,"label":"label"
                    }
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'material',
                        name: 'material'
                    },
                    {
                        data: 'product_details',
                        name: 'product_details'
                    },
                    {
                        data: 'specification',
                        name: 'specification'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'scrap',
                        name: 'scrap'
                    },
                ]
            });
        }

        function open_modal(id) {

            $('#pmscrapmodel').modal('show');
            table4 = $('#pmscrapview').DataTable({
                "autoWidth": false,
                "bDestroy": true,
                'ajax': {
                    url: "{{ url('show_pack')}}",
                    data: {
                        id: id,"label":"label"
                    },
                    type: 'get'
                },

                'columns': [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'material',
                        name: 'material'
                    },
                    {
                        data: 'product_details',
                        name: 'product_details'
                    },
                    {
                        data: 'specification',
                        name: 'specification'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'scrap',
                        name: 'scrap'
                    },

                ],
            });
        }
    </script>

</body>

</html>
