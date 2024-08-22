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
    {{-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    {{-- new cdn --}}
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

                                        <h4 class="card-title">PM Rate</h4>
                                        <p class="card-title-desc"></p>
                                        <ul class="col-12 nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                            <li class="nav-item" id="pending_tab">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#pending" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block">Pending</span>
                                                </a>
                                            </li>
                                            <li class="nav-item" id="rejected_tab">
                                                <a class="nav-link" data-bs-toggle="tab" href="#rejected" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block">Rejected</span>
                                                </a>
                                            </li>
                                            <li class="nav-item" id="app_tab">
                                                <a class="nav-link" data-bs-toggle="tab" href="#approvd" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block">Approved</span>
                                                </a>
                                            </li>

                                        </ul>
                                        <div class="tab-content p-3 text-muted">
                                            <div class="tab-pane active" id="pending" role="tabpanel">

                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table" id="product_list" style="width: 100%;">
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
                                            <div class="tab-pane " id="rejected" role="tabpanel">

                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table" id="product_list1" style="width: 100%;">
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
                                            <div class="tab-pane " id="approvd" role="tabpanel">

                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table" id="product_list2" style="width: 100%;">
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
                                            <h5 class="modal-title" id="staticBackdropLabel">Calculate PM Cost</h5>
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
                                                                <th>#</th>
                                                                <th>PM</th>
                                                                <th>PM Details</th>
                                                                <th>PM Specification</th>
                                                                <th>Qty</th>
                                                                <th>Scrap</th>
                                                                <th>Vendor</th>
                                                                <th>Basic</th>
                                                                <th>Freight</th>
                                                                <th>MOQ</th>
                                                                <th>Action</th>
                                                                <th id="remaks_header">Remarks</th>
                                                                <th>PM Cost</th>
                                                                {{-- <th>Action</th> --}}
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <!-- <input type="button" id="save_value" class="btn btn-sm btn-primary" value="Save">  -->
                                            <button type="submit" class="btn btn-sm btn-primary" id="submit_btn" >Save</button>
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </form>

                                </div>
                                <!-- /.modal-content -->
                            </div>
                        </div>
                    </div>
                    {{-- remarks --}}
                    <div class="modal fade" id="remarks_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5>Remarks</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <div id="remarks_tab">

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
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/metismenujs/metismenujs.min.js"></script>
    <script src="../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../assets/libs/eva-icons/eva.min.js"></script>
    <!-- apexcharts -->
    {{-- <script src="../assets/libs/apexcharts/apexcharts.min.js"></script> --}}

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
        function open_remarks(id){
        $("#remarks_modal").modal('show');

            $.ajax({
                url: "{{ url('view_remarks') }}",
                type: "POST",
                data: {
                    id:id,
                    "type": "pmcost"
                },
                success: function(data) {
                    $("#remarks_tab").html("<p>"+data.data+"</p>");

                }
            });
        }
        function validateNumericInput(input) {
        // Remove non-numeric characters using a regular expression
            input.value = input.value.replace(/[^0-9.]/g, '');

        // Ensure there is only one dot in the input (for decimal numbers)
            input.value = input.value.replace(/(\..*)\./g, '$1');
        }
        $(document).ready(function() {
            tables_();
        });
        $("#pending_tab").click(function() {
            tables_();
        });
        $("#rejected_tab").click(function() {
            tables_rej();
        });
        $("#app_tab").click(function() {
            tables_app();
        });
        function tables_(){
            table = $('#product_list').DataTable({
                'autowidth': false,
                "bDestroy": true,
                ajax: {
                    url: "{{url('fetch_completed_pm')}}"
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'Product_name',
                        name: 'Product_name'
                    },
                    {
                        data: 'division',
                        name: 'division',
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
        function tables_rej(){
            table_rej = $('#product_list1').DataTable({
                "bDestroy": true,
                'autowidth': false,
                ajax: {
                    url: "{{url('fetch_completed_pm')}}",
                    data:{"rej":"rej"}
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'Product_name',
                        name: 'Product_name'
                    },
                    {
                        data: 'division',
                        name: 'division',
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
        function tables_app(){
            table_app = $('#product_list2').DataTable({
                "bDestroy": true,
                'autowidth': false,
                ajax: {
                    url: "{{url('fetch_completed_pm')}}",
                    data:{"app":"app"}
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'Product_name',
                        name: 'Product_name'
                    },
                    {
                        data: 'division',
                        name: 'division',
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

        function open_modal(id,sts_bar) {
            if(sts_bar ==2 ||sts_bar == 4){
              $("#submit_btn").prop('hidden',false);
            }else{
              $("#submit_btn").prop('hidden',true);

            }

            $('#packmodel').modal('show');
            $('#product_id').val(id);
               tableshowpack=  $('#pack_tab_id').DataTable({
                "bDestroy": true,
                "searching": false,
                "ordering": false,
                ajax: {
                    url: "{{url('show_pack')}}",
                    data: {
                        id: id,sts_bar:sts_bar,
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
                        data: 'moq',
                        name: 'moq'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },

                    {
                        data: 'remarks',
                        name: 'remarks',
                        visible: (sts_bar == 3 || sts_bar == 4) ? false : true,
                    },

                    {
                        data: 'pmcost',
                        name: 'pmcost',
                    },

                ],

            });

        }

        j=2;
        function moqplus(id){

            // var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            var characters = 'abcdefghijklmnopqrstuvwxyz';
            var otpLength = 4; // Change this to the desired OTP length
            var otp = '';

            for (var i = 0; i < otpLength; i++) {
                var randomIndex = Math.floor(Math.random() * characters.length);
                otp += characters.charAt(randomIndex);
            }

            var find = '.moq_input'+id;
            $(find).closest('div').append('<div class="'+otp+'" style="display: inline-flex;padding-top:3px; width: 100px;"><input type="text" class="form-control input-xs" id="id_moq" name="moq_name'+id+'[]" value=""><button class="btn btn-danger" id='+otp+' onclick="removeField(this)"><i class="fa fa-trash"></i></button></div>');

            var vendor = '.vendor_input'+id;
            $(vendor).closest('div').append('<div class="'+otp+'" style="display: inline-flex;padding-top:3px;"><input type="text" class="form-control input-xs" id="id_vendor" name="vendor_name'+id+'[]" value=""></div>');

            var basic = '.basic_input'+id;
            $(basic).closest('div').append('<div class="'+otp+'" style="display: inline-flex;padding-top:3px;"><input type="text" class="form-control input-xs" id="id_basic'+otp+'" name="basic_name'+id+'[]" value="" oninput="validateNumericInput(this)"></div>');

            var freight = '.freight_input'+id;
            $(freight).closest('div').append('<div class="'+otp+'" style="display: inline-flex;padding-top:3px;"><input type="text" class="form-control input-xs" id='+otp+' name="freight_name'+id+'[]" onkeyup="catchEnter('+id+')" oninput="validateNumericInput(this)"></div>');

            var pm = '.pm_input'+id;
            $(pm).closest('div').append('<div class="'+otp+'" style="display: inline-flex;padding-top:3px;"><input type="text" style="width: auto;max-width: 115px!important;" class="form-control input-xs" id="id_pmcost'+otp+'" name="pm_cost'+id+'[]" value="" readonly ></div>');
          j++;
        }

        function removeField(btn) {
            event.preventDefault();

            var id = $(btn).attr("id");
            $('.'+id).remove();
        }

        function catchEnter(id) {

            if (event.key != "") {
                var inputId = document.activeElement.id;
                var inputValue = parseFloat(event.target.value);


                var get_basic_val =  parseFloat($('#id_basic'+inputId).val());
                var quantity =  parseFloat($('#quantity'+id).val());
                var scrap =  parseFloat($('#pmscrap'+id).val());

                console.log(get_basic_val);
                console.log(inputId);
                console.log(quantity);
                console.log(scrap);
                console.log(inputValue);
                var fetch_cal_pm =(quantity*(inputValue+get_basic_val))+((quantity*(inputValue+get_basic_val))* (scrap/100))
                // (Basic + Freight) *(Qty)*(1+Scrap%)  formula for pm cost calculation
                // var fetch_cal_pm = (get_basic_val + inputValue) * quantity * (1 + scrap);

                var set_pm_val = $('#id_pmcost'+inputId).val((fetch_cal_pm).toFixed(2));
            }
        }

        function catchval(event){
            if (event.key != "") {
                var get_freight_val = parseFloat(event.target.value);
                var inputId = document.activeElement.id;

                var get_basic_val = parseFloat($('#id_basic'+inputId).val());
                var quantity = parseFloat($('#quantity'+inputId).val());
                var scrap =  parseFloat($('#pmscrap'+inputId).val());

                // (Basic + Freight) *(Qty)*(1+Scrap%) formula for pm cost calculation
                var fetch_cal_pm = (quantity*(get_freight_val+get_basic_val))+((quantity*(get_freight_val+get_basic_val))* (scrap/100))
                // var fetch_cal_pm = (get_basic_val + get_freight_val) * quantity * (1 + scrap);

                var set_pm_val = $('#id_pmcost'+inputId).val((fetch_cal_pm).toFixed(2));

            }
        }


        $(document).on('submit', '#clone_form', function(e) {
              e.preventDefault();
                $.ajax({
                url: '{{url("save_moq")}}',
                type: 'POST',
                data: $("#clone_form").serialize(),
                success: function(data) {
                    if(data.status=="success"){
                        toastr.success('Saved Successfully');
                        $('#packmodel').modal('hide');
                        table.ajax.reload();
                        table_app.ajax.reload();
                        table_rej.ajax.reload();
                    }else{
                        toastr.error('Please fill All fields');
                    }

                }
            });


        })

    </script>

</body>

</html>
