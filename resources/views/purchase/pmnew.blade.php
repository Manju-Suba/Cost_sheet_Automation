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
    <!-- toastr-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />

    <!-- datatable -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"> </script>
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

</head>
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



    /* .modal-header {
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
    } */

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


                                        <h4 class="card-title">Packaging Material</h4>
                                        <p class="card-title-desc"></p>

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block">Add PM</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block">Pending</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
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
                                                                            <table class="table table-hover " id="users" style="width:100%">
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
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="profile1" role="tabpanel">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover " id="pending_table" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.no</th>
                                                                    <th>Product Name</th>
                                                                    <th>Fill Volume</th>
                                                                    <th>Case Configuration</th>
                                                                    <th>Launch Qty</th>
                                                                    <th>Status</th>
                                                                    <th>Version</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>

                                                <!-- /.modal -->
                                            </div>
                                            <div class="tab-pane" id="messages1" role="tabpanel">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover" id="completed_table" style="width:100%">
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
                                        <div class="col">
                                            <!--  Modal content for the above example -->
                                            <div class="modal fade" id="rmviewmodel" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
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
                                                                                <th>S.no</th>
                                                                                <th>Ingredients</th>
                                                                                <th>Rate</th>
                                                                                <th>Cost</th>
                                                                                <th>%Wt (Inc.Scrap) </th>

                                                                            </tr>
                                                                        </thead>

                                                                    </table>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                            </div>
                                            <!-- /.modal-dialog -->

                                            {{-- pm modal --}}

                                            <!-- pm scrap modal -->
                                            <div class="modal fade pmmodal" id="pmview" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Scrap Add</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-12">
                                                                <div class="table-responsive">
                                                                    <input type="text" id="viewid" hidden>
                                                                    <table class="table table-hover " id="scrapdetails" style="width: 100%;">
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
                                                                                <th>%Wt (Inc.Scrap) </th>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="col">
                        <!--  Modal content for the above example -->
                        <div class="modal fade pmmodal" id="pmdetails_modal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Scrap Add</h5>
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
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        {{-- <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                        </div>
                        <div class="modal fade bs-example-modal-xl" id="pmviewmodel" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">View RM Rate</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <form id="clone_form">
                                                    <input type="text" id="product_id" name="product_id" hidden>

                                                    <table class="table table-hover " id="pmscrapview">
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
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="" id="table_body">
                                                            <div class="row">
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td><input type="text" class="form-control input-xs" id="id_pm" name="pm_name[]" value="" size="100"></td>
                                                                    <td><textarea id="id_pmdetail" class="form-control input-xs" name="pmdetail_name[]" rows="1" cols="50"></textarea></td>
                                                                    <td><textarea id="id_pmspec" class="form-control input-xs" name="pmspec_name[]" rows="1" cols="50"></textarea></td>
                                                                    <td><input type="text" class="form-control input-xs" id="id_qty" name="qty_name[]" value="" size="30"></td>
                                                                    <td><input type="text" class="form-control input-xs" id="id_moq" name="moq_name[]" value=""></td>
                                                                    <td><input type="text" class="form-control input-xs" id="id_vendor" name="vendor_name[]" value="" size="100"></td>
                                                                    <td><input type="text" class="form-control input-xs" id="id_basic" name="basic_name[]" value=""></td>
                                                                    <td><input type="text" class="form-control input-xs" id="id_freight" name="freight_name[]" value=""></td>
                                                                    <td>
                                                                        <div class="action_container">
                                                                            <button type="button" class="btn-success" id="plus"><i class="fa fa-plus"></i></button>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </div>
                                                        </tbody>
                                                    </table>
                                                </form>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <input type="button" id="save_value" class="btn btn-sm btn-primary" value="Save">
                                        {{-- <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                                    </div>
                                </div>
                                <!-- /.modal-content -->
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

            var editingrediant_wrapper = $(".edit-more-ingrediant ");
            var editadd_ingrediant = $(".editadd_ingrediant");
            var max_fi_in = 20;
            var eo = 0;
            $(editadd_ingrediant).click(function(e) {
                e.preventDefault();
                if (eo < max_fi_in) {
                    eo++;
                    $(editingrediant_wrapper).append('<br><div class="form-group col-md-12 edit-more-ingrediant "><fieldset><div class="p-3"><div class="inner row"><div class="mb-1 col-md-4 col-4"><label class="form-label" for="formemail">Ingredient</label><input type="test" class="form-control" id="editIngredient"  name="editIngredient[]"></div><div class="mb-1 col-md-4 col-4"><label class="form-label" for="formemail">Rate</label><input type="text" class="form-control" id="editRate" name="editRate[]"><input type="hidden" name="_token" value="<?= csrf_token() ?>"></div><div class="mb-1 col-md-4 col-4"><label class="form-label" for="formemail">Cost</label><input type="test"   class="form-control" id="editcostval" name="editcostval[]"></div></div></fieldset><button class="btn btn-danger editingrediantdelete mt-1" type="button"><i class="fa fa-trash"></i></button></div>'); //add input box

                } else {
                    alert('You Reached the limits');
                }
            });


            $(editingrediant_wrapper).on("click", ".editingrediantdelete", function(e) {
                e.preventDefault();
                $(this).parent('div').remove();

                eo--;
            })

        });

        $(function() {
            showbasic();
            showpending();
            showcompleted();
        });

        function showbasic() {
            table1 = $('#users').DataTable({
                // processing: true,
                // serverSide: true,
                ajax: {
                    url: "{{ url('/fetch_basic') }}",
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'Product_name',
                        name: 'Product_name'
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
                        data: 'version',
                        name: 'version',
                        visible: false
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

        function showpending() {
            table = $('#pending_table').DataTable({
                // processing: true,
                // serverSide: true,
                ajax: {
                    url: "{{ url('/fetch_pending_details') }}",
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
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'version',
                        name: 'version'
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

        function showcompleted() {
            table = $('#completed_table').DataTable({
                ajax: {
                    url: "{{ url('/fetch_pmcompleted_data') }}",
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
        }

        var counter = $("#table_body").closest('tr').index() + 2;

        $("#plus").on({
            click: function() {
                counter++;
                $("#table_body").append(' <tr><td>' + counter + '</td><td><input type="text" class="form-control input-xs"id="id_pm" name="pm_name[]" value="" ></td><td><textarea id="id_pmdetail" class="form-control input-xs" name="pmdetail_name[]" rows="1" cols="50"></textarea></td><td><textarea id="id_pmspec" class="form-control input-xs" name="pmspec_name[]" rows="1" cols="50"></textarea></td><td><input type="text" class="form-control input-xs" id="id_qty" name="qty_name[]" value="" size="30"></td><td><input type="text" class="form-control input-xs" id="id_moq" name="moq_name[]" value="" ></td><td><input type="text" class="form-control input-xs" id="id_vendor" name="vendor_name[]" value="" size="100"></td><td><input type="text" class="form-control input-xs" id="id_basic" name="basic_name[]" value="" ></td><td><input type="text" class="form-control input-xs" id="id_freight" name="freight_name[]" value="" ></td><td><div class="action_container"><button class="btn-danger danger dlt" type="button"><i class="fa fa-times"></i></button></div></td></tr>');

            }
        });

        function clean_first_tr(firstTr) {
            let children = firstTr.children;

            children = Array.isArray(children) ? children : Object.values(children);
            children.forEach(x => {
                if (x !== firstTr.lastElementChild) {
                    x.firstElementChild.value = '';
                }
            });
        }

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

        $("#save_value").on("click", function(event) {
            data = $('#clone_form').serialize();
            console.log(data);
            $.ajax({
                'url': '{{url("save_prodmaterial")}}',
                'type': 'POST',
                'data': data,
                'success': function(data) {
                    toastr.success('saved successfully');
                    $('#pmviewmodel').modal('hide');
                    table1.ajax.reload();
                }
            });
        });

        function open_pm(id) {
            $('#product_id').val(id);

        }

        function open_view(id) {
            $('#pmview').modal('show');
            table = $('#scrapdetails').DataTable({
                "bDestroy": true,
                ajax: {
                    url: "{{ url('/getpmdetails_scrap') }}",
                    data: {
                        prd_id: id
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
                        data: 'MOQ',
                        name: 'MOQ'
                    },
                    {
                        data: 'vendor',
                        name: 'vendor'
                    },
                    {
                        data: 'basic',
                        name: 'basic'
                    },
                    {
                        data: 'freight',
                        name: 'freight'
                    },
                    {
                        data: 'scrap',
                        name: 'scrap'
                    },
                ]
            });
        }

        function open_pmview(id) {
            $('#pmdetails_modal').modal('show');
            table = $('#pmdetails').DataTable({
                "bDestroy": true,
                ajax: {
                    url: "{{ url('/getpmdetails_scrap') }}",
                    data: {
                        prd_id: id
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
                        data: 'MOQ',
                        name: 'MOQ'
                    },
                    {
                        data: 'vendor',
                        name: 'vendor'
                    },
                    {
                        data: 'basic',
                        name: 'basic'
                    },
                    {
                        data: 'freight',
                        name: 'freight'
                    },
                ]
            });
        }
    </script>

</body>

</html>