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
                                 <!-- Nav tabs -->
                                 {{-- <ul class="col-8 nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#npd_pend" role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                            <span class="d-none d-sm-block">Pending</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#npd_rej" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                            <span class="d-none d-sm-block">Rejected</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#npd_app" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                            <span class="d-none d-sm-block">Approved</span>
                                        </a>
                                    </li>
                                </ul> --}}
                                <div class="card-body">
                                    {{-- <div class="tab-content p-3 text-muted"> --}}
                                        {{-- <div class="tab-pane active" id="npd_pend" role="tabpanel"> --}}
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover" id="users" style="width:100%">
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
                                                    {{-- <div style="margin-left:5%">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label for="inputEmail4" class="form-label">Specific Gravity </label>

                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="text" class="form-control" id="empid" name="emp_id">
                                                                    <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row pt-2">
                                                                <div class="col-md-2">
                                                                    <label for="inputEmail4" class="form-label">RM Cost per Kg </label>

                                                                </div>

                                                                <div class="col-md-2">
                                                                    <input type="text" class="form-control" id="empid" name="emp_id">
                                                                    <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                                                                </div>
                                                            </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        {{-- </div> --}}
                                        {{-- <div class="tab-pane " id="npd_rej" role="tabpanel"> --}}
                                            {{-- <div class="row">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover" id="users1" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.no</th>
                                                                    <th>Product Name</th>
                                                                    <th>Fill Volume</th>
                                                                    <th>Case Configuration</th>
                                                                    <th>Launch Qty</th>
                                                                    <th>Version</th>
                                                                    <th>Rejected</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div> --}}
                                        {{-- </div> --}}
                                        {{-- <div class="tab-pane " id="npd_app" role="tabpanel"> --}}
                                            {{-- <div class="row">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover" id="users2" style="width:100%">
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
                                            </div> --}}
                                        {{-- </div> --}}
                                    {{-- </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="col">
                        <div class="modal fade" id="rdform" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">RM Formulation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover " id="formalation_tabid" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>S.no</th>
                                                            <th>SAP</th>
                                                            <th>Ingredients </th>
                                                            <th>Ingredient Composition %</th>
                                                            <th>%Wt (Ins.Scrap) </th>
                                                            <th>Qty</th>
                                                            <th>Cost</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th id="wt"></th>
                                                            <th></th>
                                                            <th id="cost"></th>
                                                            <th></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <div style="margin-top:10px">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="inputEmail4" class="form-label">Specific Gravity </label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" oninput="validateNumericInput(this)" id="spec_grav" name="spec_grav">
                                                        <span class="text-danger" id="spec-error"></span>
                                                        <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                                                    </div>
                                                </div>
                                                <div class="row pt-2">
                                                    <div class="col-md-3">
                                                        <label for="inputEmail4" class="form-label">RM Cost per Kg </label>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <span id="rm_cost">0</span>
                                                        <input type="hidden" id="hid_id" name="hid_id" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-success" id="save_id" onclick="submit()">submit</button>
                                        {{--
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button> --}}
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

    <!-- apexcharts -->
    <script src="../assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Vector map-->
    <script src="../assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="../assets/libs/jsvectormap/maps/world-merc.js"></script>

    <script src="../assets/js/pages/dashboard.init.js"></script>
    <script src="../assets/js/app.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(document).ready(function() {

            tables_();
        });
       function tables_(){
        table = $('#users').DataTable({
                "bDestroy": true,
                'autowidth': false,
                ajax: {
                    url: "{{url('fetch_basic_rd')}}"

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
            // table2 = $('#users1').DataTable({
            //     "bDestroy": true,
            //     'autowidth': false,
            //     ajax: {
            //         url: "{{url('fetch_basic_rd')}}",
            //         data:{'rej':'rej'}
            //     },
            //     columns: [{
            //             data: 'DT_RowIndex'
            //         },
            //         {
            //             data: 'Product_name',
            //             name: 'Product_name'
            //         },
            //         {
            //             data: 'Volume',
            //             name: 'Volume'
            //         },
            //         {
            //             data: 'case_configuration',
            //             name: 'case_configuration'
            //         },
            //         {
            //             data: 'quantity',
            //             name: 'quantity'
            //         },
            //         {
            //             data: 'version',
            //             name: 'version',
            //             visible: false
            //         },
            //         {
            //             data: 'rejected',
            //             name: 'rejected',
            //         },
            //         {
            //             data: 'action',
            //             name: 'action',
            //             orderable: false,
            //             searchable: false
            //         }
            //     ]

            // });
            // table3 = $('#users2').DataTable({
            //     'autowidth': false,
            //     "bDestroy": true,

            //     ajax: {
            //         url: "{{url('fetch_basic_rd')}}",
            //         data:{'app':'app'}
            //     },
            //     columns: [{
            //             data: 'DT_RowIndex'
            //         },
            //         {
            //             data: 'Product_name',
            //             name: 'Product_name'
            //         },
            //         {
            //             data: 'Volume',
            //             name: 'Volume'
            //         },
            //         {
            //             data: 'case_configuration',
            //             name: 'case_configuration'
            //         },
            //         {
            //             data: 'quantity',
            //             name: 'quantity'
            //         },
            //         {
            //             data: 'version',
            //             name: 'version',
            //             visible: false
            //         },
            //         {
            //             data: 'action',
            //             name: 'action',
            //             orderable: false,
            //             searchable: false
            //         }
            //     ]

            // });
       }
       function validateNumericInput(input) {
        // Remove non-numeric characters using a regular expression
        input.value = input.value.replace(/[^0-9.]/g, '');

// Ensure there is only one dot in the input (for decimal numbers)
       input.value = input.value.replace(/(\..*)\./g, '$1');
        }
        function openadd_modal(id) {
            $("#spec-error").html('');
            $('#hid_id').val(id);
            $('#rdform').modal('show');
            table2 = $('#formalation_tabid').DataTable({
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api(),
                        data;

                    // converting to interger to find total
                    var intVal = function(i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                    };
                    // computing column Total of the complete result
                    var scrap = api
                        .column(4)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    var cost = api
                        .column(6)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Update footer by showing the total with the reference of the column index
                    $(api.column(3).footer()).html('Total');
                    $(api.column(4).footer()).html(scrap.toFixed(2));
                    $(api.column(6).footer()).html(cost.toFixed(2));

                },
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
                    {
                        data: 'sap',
                        name: 'sap',
                        visible: false
                    },
                    {
                        data: 'Ingredient',
                        name: 'Ingredient'
                    },
                    {
                        data: 'ingredientComposition',
                        name: 'ingredientComposition'
                    },
                    {
                        data: 'scrap',
                        name: 'scrap'
                    },
                    {
                        data: 'qty',
                        name: 'qty'
                    },
                    {
                        data: 'rate',
                        name: 'rate'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
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

        //

        $(document).on('click', '#add_id', function() {
            var btn = $(this);
            var data = $(this).closest("tr").find("td:eq(2) input").val();
            var id = $(this).attr("data-id");
            if(data!=""){
                $.ajax({
                url: '{{url("add_composition")}}',
                type: 'POST',
                data: {
                    id: id,
                    data: data
                },
                success: function(data) {

                    if (data.status == "success") {
                        toastr.success('composition added');
                        btn.html('Updated');
                        table2.ajax.reload();
                        btn.prop('disabled',true);
                    }else{
                        btn.prop('disabled',false);

                    }
                },
                error: function(e) {
                    toastr.error('composition not added');
                }
            });
            }else{
                toastr.error('Ingredient Composition is Required');
                }


        });

        var timer = '';
        $('input#spec_grav').keypress(function() {
            var _this = $(this);
            var wt = $('#wt').html();
            var cost = $('#cost').html();
            clearTimeout(timer);
            timer = setTimeout(function() {
                var value = _this.val() * cost / wt
                $('#rm_cost').html(value.toFixed(2));
            }, 1000);
        });

        $('#rdform').on('hidden.bs.modal', function() {
            $('#spec_grav').val('');
            $('#rm_cost').html('');
        });

        function submit() {
            var specific = $('#spec_grav').val();
            var rm_cost = $('#rm_cost').html();
            var id = $('#hid_id').val();
            if(specific!=''){
                $.ajax({
                url: '{{"save_total_rmcost"}}',
                type: 'POST',
                data: {
                    specific: specific,
                    rm_cost: rm_cost,
                    id: id
                },
                success: function(result) {
                    toastr.success('saved successfully');
                    $('#rdform').modal('hide');
                    tables_()
                }
            });
            }else{
                $("#spec-error").html('Specific Gravity Required')
            }

        }
    </script>
</body>

</html>
