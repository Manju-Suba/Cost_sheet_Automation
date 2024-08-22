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
    <!-- toastr-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />

    <link href="../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- datatable -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

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

                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table" id="users" style="width: 100%;">
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

                    <!-- end row -->
                    <div class="col">
                        <div class="modal fade bs-example-modal-xl" id="packmodel" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="myExtraLargeModalLabel">
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
                                                    @csrf
                                                    <input type="text" id="product_id" name="product_id" hidden>

                                                    <table class="table table-hover " id="pack_tab_id" style="width: 100%;">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>PM</th>
                                                                <th>PM Details</th>
                                                                <th>PM Specification</th>
                                                                <th>Qty</th>
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
                                                                    <td><input type="text" class="form-control input-xs" id="id_pm" name="pm_name[]" value="" size="100"></td>
                                                                    <td><textarea id="id_pmdetail" class="form-control input-xs" name="pmdetail_name[]" rows="1" cols="50"></textarea></td>
                                                                    <td><textarea id="id_pmspec" class="form-control input-xs" name="pmspec_name[]" rows="1" cols="50"></textarea></td>
                                                                    <td><input type="text" class="form-control input-xs" id="id_qty" name="qty_name[]" value="" size="30"></td>
                                                                    <!-- <td><input type="text" class="form-control input-xs" id="id_moq" name="moq_name[]" value=""></td>
                                                                    <td><input type="text" class="form-control input-xs" id="id_vendor" name="vendor_name[]" value="" size="100"></td>
                                                                    <td><input type="text" class="form-control input-xs" id="id_basic" name="basic_name[]" value=""></td>
                                                                    <td><input type="text" class="form-control input-xs" id="id_freight" name="freight_name[]" value=""></td> -->
                                                                    <td><input type="text" class="form-control input-xs" id="scrap" name="scrap[]" value=""></td>

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
                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
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
    <!-- end container-fluid -->

    @extends('layout.right-sidebar');


    <!-- JAVASCRIPT -->
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/metismenujs/metismenujs.min.js"></script>
    <script src="../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../assets/libs/eva-icons/eva.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>

    <!-- apexcharts -->
    <script src="../assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Vector map-->
    <script src="../assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="../assets/libs/jsvectormap/maps/world-merc.js"></script>

    <script src="../assets/js/pages/dashboard.init.js"></script>

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
        
        $(document).ready(function() {
            table = $('#users').DataTable({
                'autowidth': false,
                ajax: {
                    url: "{{url('fetch_basic_pack')}}"
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
        });

        function openmodel(id) {
            $('#packmodel').modal('show');
            $('#product_id').val(id);
            // $('#pack_tab_id').DataTable({
            //     "bDestroy": true,
            //     ajax: {
            //         url: "{{url('show_pack')}}",
            //         data: {
            //             id: id
            //         }
            //     },
                // columns: [{
                //         data: 'DT_RowIndex'
                //     },
                //     {
                //         data: 'material',
                //         name: 'material'
                //     },
                //     {
                //         data: 'product_details',
                //         name: 'product_details'
                //     },
                //     {
                //         data: 'specification',
                //         name: 'specification'
                //     },
                //     {
                //         data: 'quantity',
                //         name: 'quantity'
                //     },
                //     {
                //         data: 'scrap',
                //         name: 'scrap'
                //     },
                // ]
            // });

        }

        $("#plus").on({ click: function() {
                var counter =1;
                counter++;id_pm
                $("#table_body").append(`
                <tr>
                <td><input type="text" class="form-control input-xs"id="" name="pm_name[]" value="" ></td>
                <td><textarea id="id_pmdetail" class="form-control input-xs" name="pmdetail_name[]" rows="1" cols="50"></textarea></td>
                <td><textarea id="id_pmspec" class="form-control input-xs" name="pmspec_name[]" rows="1" cols="50"></textarea></td>
                <td><input type="text" class="form-control input-xs" id="id_qty" name="qty_name[]" value="" size="30"></td>
                <td><input type="text" class="form-control input-xs" id="id_scrap" name="scrap[]" value="" ></td>
                <td><div class="action_container"><button class="btn-danger danger dlt" type="button"><i class="fa fa-times"></i></button></div></td></tr>
                `);

            }
        });

        // document.getElementById('plus').addEventListener('click', function () {
        //     const primaryLocationsDiv = document.getElementById('table_body');
        //     const newPrimaryLocation = document.querySelector('.details').cloneNode(true);
        //     alert(newPrimaryLocation);
        //     addDeleteButton(newPrimaryLocation);
        //     // const delete_button = '<button id="delete_secondary" onclick="removeField(this)"><i class="fa fa-trash"></i></button>';

        //     primaryLocationsDiv.appendChild(newPrimaryLocation);


        // });

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

        $("#save_value").on("click", function(event) {
            data = $('#clone_form').serialize();
            $.ajax({
                'url': '{{url("save_prodmaterial_packageing")}}',
                'type': 'POST',
                'data': data,
                'success': function(data) {
                    // let text = data.error;
                    // const myArray = data.error.split(".");
                    // console.log(myArray);

                    toastr.success('saved successfully');
                    $('#packmodel').modal('hide');
                    table.ajax.reload();
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

        $("input[name='pm_name[]']").each(function() {
                var value = $(this).val();
                ingredient_array.push(value);
                if (value === '') {
                    $(".id_pm").addClass('was-validated');
                    ingredient_array.push(value);
                }
            });
            $("input[name='pmdetail_name[]']").each(function() {
                var value = $(this).val();
                ingredient_array.push(value);
                if (value === '') {
                    $(".id_pmdetail").addClass('was-validated');
                    ingredient_array.push(value);
                }
            });
            $("input[name='pmspec_name[]']").each(function() {
                var value = $(this).val();
                ingredient_array.push(value);
                if (value === '') {
                    $(".id_pmspec").addClass('was-validated');
                    ingredient_array.push(value);
                }
            });

            $("input[name='qty_name[]']").each(function() {
                alert(1);
                var value = $(this).val();
                ingredient_array.push(value);
                if (value === '') {
                    $(".id_qty").addClass('was-validated');
                    ingredient_array.push(value);
                }
            });
    </script>

</body>

</html>
