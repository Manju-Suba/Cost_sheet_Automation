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


                                        <h4 class="card-title">RM Rate</h4>
                                        <p class="card-title-desc"></p>

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                            <li class="nav-item" id="showIndex">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block">Add Rate</span>
                                                </a>
                                            </li>
                                            {{-- <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block">Pending</span>
                                                </a>
                                            </li> --}}
                                            <li class="nav-item" id="showCompleted">
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
                                                                            <table class="table table-hover" id="users">
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
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-hover " id="rmview">
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
                                                                </div>
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
                                                                                        <th>Qty</th>
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
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-hover " id="covert" style="width:100%">
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

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="col">
                        <!--  Modal content for the above example -->
                        <div class="modal fade" id="rmcostmodel" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Add Rate </h5>
                                        <h5   class="mx-2 mt-2">[Plant -<span id="plant_code" > </span>]</h5> <span id="loaders"> </span>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form id="formedit" class="p-3">
                                    <div class="modal-body">
                                        {{-- <div style="position: relative;">
                                            <button style="position: absolute; top: 0; right: 0; background-color: #e90e0e !important;" class="btn btn-sm text-white editadd_ingrediant" type="button" title="Add More..."><i class="fa fa-plus"></i></button>
                                        </div> --}}

                                            <div class="form-group col-md-12 edit-more-ingrediant ">
                                                <input type="text" class="form-control " name="editp_name" id="editp_name" hidden>
                                                <input type="text" class="form-control " name="editbid" id="editbid" hidden>
                                                <input type="text" class="form-control " name="editProduct_id" id="editProduct_id" hidden>
                                                <fieldset>
                                                    <div class="p-3">
                                                        <div class="inner row">
                                                            <div class="mb-1 col-md-4 col-4">
                                                                <label class="form-label" for="formemail">SAP Code</label>
                                                                <input type="text" class="form-control" id="sapcode" name="sapcode[]" required>

                                                            </div>
                                                            <div class="mb-1 col-md-4 col-4">
                                                                <label class="form-label" for="formemail">Ingredient</label>
                                                                <input type="text" class="form-control" id="editIngredient" name="editIngredient[]" required>

                                                            </div>
                                                            <div class="mb-1 col-md-4 col-4">
                                                                <label class="form-label" for="formemail">Rate</label>
                                                               <input type="text" class="form-control" id="editRate" name="editRate[]" oninput="validateNumericInput(this)" required>
                                                                <input type="hidden" name="_token" value="<?= csrf_token() ?>">

                                                            </div>
                                                            <div class="mb-1 col-md-3 col-3">
                                                                {{-- <label class="form-label" for="formemail">Qty</label> --}}
                                                                <input type="hidden" class="form-control" id="editcostval" name="editcostval[]" required>
                                                                <input type="hidden" class="form-control" id="editscrap" name="scrap[]">
                                                                <input type="hidden" class="form-control" id="editscrap_user" name="scrap_user[]">
                                                                <input type="hidden" class="form-control" id="editrm_user" name="rm_user[]">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id="addcost" class="btn btn-sm btn-primary">Submit</button>
                                        {{-- <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                                    </div>
                                   </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>

                        <div class="modal fade" id="rmscrapmodel" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
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
                                                <table class="table" id="rmscrapview">
                                                    <thead>
                                                        <tr>
                                                            <th>S.no</th>
                                                            <th>Ingredients</th>
                                                            <th>Rate</th>
                                                            <th>Qty</th>
                                                            <th>Scrap</th>
                                                            <!-- <th>Total Qty (Inscrap)</th>
                                                            <th>Material Cost</th> -->
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
                    $(editingrediant_wrapper).append('<br><div class="form-group col-md-12 edit-more-ingrediant "><fieldset><div class="p-3"><div class="inner row"><div class="mb-1 col-md-4 col-4"><label class="form-label" for="formemail" required>Ingredient</label><input type="test" class="form-control"    id="editIngredient"  name="editIngredient[]" required></div><div class="mb-1 col-md-4 col-4"><label class="form-label" for="formemail">Rate</label><input type="text" class="form-control" id="editRate" name="editRate[]" oninput="validateNumericInput(this)" required><input type="hidden" name="_token" value="<?= csrf_token() ?>"></div><div class="mb-1 col-md-4 col-4"> <label class="form-label" for="formemail">Qty</label><input type="test" class="form-control" id="editcostval" name="editcostval[]" required required><input type="hidden" class="form-control" id="editscrap" name="scrap[]"><input type="hidden" class="form-control" id="editscrap_user" value="0" name="scrap_user[]"><input type="hidden" class="form-control" id="editrm_user" value="0" name="rm_user[]"></div></div></fieldset><button class="btn btn-danger btn-sm editingrediantdelete mt-1" type="button"><i class="fa fa-trash"></i></button></div>'); //add input box

                } else {
                    toastr.error('You Reached the limits');
                }
            });


            $(editingrediant_wrapper).on("click", ".editingrediantdelete", function(e) {
                e.preventDefault();
                $(this).parent('div').remove();

                eo--;
            })

        });
        $(document).ready(function() {
            showindextable();
        });
         $("#showIndex").click(function() {
            showindextable();
        });
         $("#showCompleted").click(function() {
            showcompleted();
        });

        function showindextable() {
            table = $('#users').DataTable({
                "autoWidth": false,
                "bDestroy": true,
                'ajax': {
                    url: "{{ url('show_rmview_purchase')}}",
                    // type: 'POST'
                },
                'columns': [{
                        title: "S.no",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: 'Product_Name'
                    },
                    {
                        data: 'division'
                    },
                    {
                        data: 'Fill_Volume'
                    },
                    {
                        data: 'Cofiguration'
                    },
                    {
                        data: 'Quantity'
                    },
                    {
                        data: 'Action1'
                    },


                ],
            });

        }

        function showcompleted() {
            table = $('#covert').DataTable({
                "bDestroy": true,
                'ajax': {
                    url: '{{url("fetch_completed_rm")}}',
                    data:{'purchase':'purchase'}
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
                function validateNumericInput(input) {
        // Remove non-numeric characters using a regular expression
                input.value = input.value.replace(/[^0-9.]/g, '');

        // Ensure there is only one dot in the input (for decimal numbers)
            input.value = input.value.replace(/(\..*)\./g, '$1');
               }
        function edit_cost(id) {
            $("#addcost").attr('disabled',false);
            $("#editRate").prop('readonly',false);
            $.ajax({
                url: "{{ url('editcost')}}",
                data: {
                    id: id
                },
                dataType: "JSON",

                success: function(data) {
                  if(data.status=="success"){
                    $("#rmcostmodel").modal('show');
                    $('.mus').remove();
                    $("#plant_code").html(data.plant);
                    if (data.count != '') {
                        if(data.sapcode[0]!=null){
                            $("#editp_name").val(data.id[0]);
                            $("#editbid").val(data.bid);
                            $("#editProduct_id").val(data.Product_id[0]);

                            sapcode(data.sapcode[0],data.qty[0],data.scrap[0],data.scrap_user[0],data.rm_user[0],"firstrow",data.plant,0);

                        }else{
                        $("#editp_name").val(data.id[0]);
                        $("#editbid").val(data.bid);
                        $("#editProduct_id").val(data.Product_id[0]);
                        $("#sapcode").prop('readonly',true);
                        $("#sapcode").val(data.sapcode[0]);
                        $("#editIngredient").val(data.Ingredient[0]);
                        $("#editIngredient").prop('readonly',true);
                        $("#editcostval").prop('readonly',true);
                        $("#editcostval").val(data.qty[0]);
                        $("#editscrap").val(data.scrap[0]);
                        $("#editscrap_user").val(data.scrap_user[0]);
                        $("#editrm_user").val(data.rm_user[0]);
                        $("#editRate").val(data.rate[0]);
                        if(data.rate[0]!= '' && data.rate[0]>0){
                            $("#editRate").prop('readonly',true);

                        }else{
                            $("#editRate").prop('readonly',false);

                        }
                        console.log(data.rate,data.qty[0],data.scrap[0]);
                        // var i = 1;
                        }

                        var editingrediant_wrapper = $(".edit-more-ingrediant");
                        // var i = 1;
                        for (i = 1; i < data.count; i++) {
                            console.log(data.sapcode[i]);
                            if(data.sapcode[i]!=null ||data.sapcode[i]!=undefined  ){

                                console.log("***"+data.sapcode[i]);
                                sapcode(data.sapcode[i],data.qty[i],data.scrap[i],data.scrap_user[i],data.rm_user[i],'',data.plant,i);

                            }else{
                            var ingre = data.Ingredient[i];
                            if(data.rate[i] != ''){
                             var readonly="readonly"

                            }else{
                                var readonly=""
                            }
                            if(data.scrap[i]==null){
                                  var value="value=''";
                            }else{
                                var value="value='"+data.scrap[i]+"'";
                            }
                            $(editingrediant_wrapper).append('<div class="form-group pt-4 col-md-12  mus"><fieldset><div class="p-3"><div class="inner row"><div class="mb-1 col-md-4 col-4"><label class="form-label" for="formemail">SAP Code</label><input type="text" class="form-control" id="sapcode" name="sapcode[]"  readonly> </div><div class="mb-1 col-md-4 col-4"><label class="form-label" for="formemail">Ingredient</label><input type="test" class="form-control" value="'+ingre+'" id="editIngredient" name="editIngredient[]" readonly required></div><div class="mb-1 col-md-4 col-4"><label class="form-label" for="formemail">Rate</label><input type="text" class="form-control"   " value="' +  data.rate[i]+ '" name="editRate[]" oninput="validateNumericInput(this)" required '+readonly+'><input type="hidden" name="_token" value="<?= csrf_token() ?>"></div><div class="mb-1 col-md-3 col-3"><input type="hidden" value="' + data.qty[i] +'" class="form-control" id="editcostval" name="editcostval[]" readonly required><input type="hidden" '+value+' class="form-control"  name="scrap[]"><input type="hidden" value="'+data.scrap_user[i]+'" class="form-control"  name="scrap_user[]"><input type="hidden" value="'+data.rm_user[i]+'" class="form-control"  name="rm_user[]"></div></div></fieldset></div>');
                            }
 //add input box
                        }
                    }
                  }else{
                    toastr.error("plant is Not mapped");
                     $(".btn-close").trigger('click');

                  }

                }
            });
        }
            function sapcode(sap,qty,scrap,scrapuser,rmuser,firstcolumn,plant,numb){

                $.ajax({
                    url: "{{ url('get_price') }}",
                    method: "POST",
                    contentType: "application/json", // Set the content type to JSON
                    processData: false,
                    cache: false,
                     beforeSend: function(){
                       if($('.spinner-border').length > 0){
                            jQuery(".spinner-border").remove();
                        }
                        jQuery("#loaders").append('<div class="spinner-border spin'+numb+' text-muted"></div>');
                        $("#addcost").attr('disabled',true);
                    },
                    complete: function(){
                        jQuery(".spin"+numb).remove();
                        $("#addcost").attr('disabled',true);
                        if($('.spinner-border').length == 0){
                        $("#addcost").attr('disabled',false);    
                        }
                    },
                   
                    data: JSON.stringify({ 'mcode': sap ,'plantype':plant}),
                    success: function(data) {

                            var results_datas =data.result;
                            if(results_datas!= null){
                            var results = results_datas.Data
                           
                            if(firstcolumn!=""){
                            $("#sapcode").prop('readonly',true);
                            $("#sapcode").val(sap);
                            $("#editIngredient").val(results[0]['MATERIAL NAME']);
                            $("#editIngredient").prop('readonly',true);
                            $("#editcostval").prop('readonly',true);
                            $("#editcostval").val(qty);
                            $("#editscrap").val(scrap);
                            $("#editscrap_user").val(scrapuser);
                            $("#editrm_user").val(rmuser);
                            $("#editRate").val(results[0]['NET PRICE']);
                            $("#editRate").prop('readonly',true);
                            if(results[0]['NET PRICE']>0){
                                 $("#editRate").prop('readonly',false);
                            }
                            for(var i=1;i<results.length;i++){
                                console.log(scrap);
                            if(scrap==null){
                                  var value="value=''";
                            }else{
                                var value="value='"+scrap+"'";
                            }
                            if(results[i]['NET PRICE']>0){
                                 var rate_readonly="readonly"
                            }else{
                                var rate_readonly=""
                            }
                            // $(".edit-more-ingrediant").append('<p>jkj</p>');
                            $(".edit-more-ingrediant").append('<div class="form-group pt-4 col-md-12  mus"><fieldset><div class="p-3"><div class="inner row"><div class="mb-1 col-md-4 col-4"><label class="form-label" for="formemail">SAP Code</label><input type="text" class="form-control" id="sapcode" name="sapcode[]"  value="'+sap+'" readonly required> </div><div class="mb-1 col-md-4 col-4"><label class="form-label" for="formemail">Ingredient</label><input type="test" class="form-control" value="'+results[i]['MATERIAL NAME']+'" id="editIngredient" name="editIngredient[]" readonly required></div><div class="mb-1 col-md-4 col-4"><label class="form-label" for="formemail">Rate</label><input type="text" class="form-control"   " value="' +results[i]['NET PRICE']+ '" name="editRate[]" oninput="validateNumericInput(this)" required' +rate_readonly+'><input type="hidden" name="_token" value="<?= csrf_token() ?>"></div><div class="mb-1 col-md-3 col-3"><input type="hidden" value="' +qty +'" class="form-control" id="editcostval" name="editcostval[]" readonly required><input type="hidden" class="form-control"  '+value+' name="scrap[]"><input type="hidden" value="'+scrapuser+'" class="form-control"  name="scrap_user[]"><input type="hidden" value="'+rmuser+'" class="form-control"  name="rm_user[]"></div></div></fieldset></div>');

                            }

                            }
                            else{
                                for(var i=0;i<results.length;i++){
                                    console.log(scrap);
                            if(scrap==null){
                                  var value="value=''";
                            }else{
                                var value="value='"+scrap+"'";
                            }
                            if(results[i]['NET PRICE']>0){
                                 var rate_readonly="readonly"
                            }else{
                                var rate_readonly=""
                            }
                            // $(".edit-more-ingrediant").append('<p>jkj</p>');
                            $(".edit-more-ingrediant").append('<div class="form-group pt-4 col-md-12  mus"><fieldset><div class="p-3"><div class="inner row"><div class="mb-1 col-md-4 col-4"><label class="form-label" for="formemail">SAP Code</label><input type="text" class="form-control" id="sapcode" name="sapcode[]"  value="'+sap+'" readonly required> </div><div class="mb-1 col-md-4 col-4"><label class="form-label" for="formemail">Ingredient</label><input type="test" class="form-control" value="'+results[i]['MATERIAL NAME']+'" id="editIngredient" name="editIngredient[]" readonly required></div><div class="mb-1 col-md-4 col-4"><label class="form-label" for="formemail">Rate</label><input type="text" class="form-control"   " value="' +results[i]['NET PRICE']+ '" name="editRate[]" oninput="validateNumericInput(this)" required '+rate_readonly+'><input type="hidden" name="_token" value="<?= csrf_token() ?>"></div><div class="mb-1 col-md-3 col-3"><input type="hidden" value="' +qty +'" class="form-control" id="editcostval" name="editcostval[]" readonly required><input type="hidden" class="form-control"  '+value+' name="scrap[]"><input type="hidden" value="'+scrapuser+'" class="form-control"  name="scrap_user[]"><input type="hidden" value="'+rmuser+'" class="form-control"  name="rm_user[]"></div></div></fieldset></div>');

                            }

                            }


                        }else{
                            toastr.error("sap data not avaliable for this code : "+sap);
                            if(firstcolumn!=""){
                            $("#sapcode").prop('readonly',true);
                            $("#sapcode").val(sap);
                            }else{
                                if(scrap==null){
                                    var value="value=''";
                                }else{
                                    var value="value='"+scrap+"'";
                                }
                                $(".edit-more-ingrediant").append('<div class="form-group pt-4 col-md-12  mus"><fieldset><div class="p-3"><div class="inner row"><div class="mb-1 col-md-4 col-4"><label class="form-label" for="formemail">SAP Code</label><input type="text" class="form-control" id="sapcode" name="sapcode[]"  value="'+sap+'" readonly required> </div><div class="mb-1 col-md-4 col-4"><label class="form-label" for="formemail">Ingredient</label><input type="test" class="form-control"  id="editIngredient" name="editIngredient[]"  required></div><div class="mb-1 col-md-4 col-4"><label class="form-label" for="formemail">Rate</label><input type="text" class="form-control"   "  name="editRate[]" oninput="validateNumericInput(this)" required ><input type="hidden" name="_token" value="<?= csrf_token() ?>"></div><div class="mb-1 col-md-3 col-3"><input type="hidden" value="' +qty +'" class="form-control" id="editcostval" name="editcostval[]" readonly required><input type="hidden" '+value+' class="form-control"  name="scrap[]"><input type="hidden" value="'+scrapuser+'" class="form-control"  name="scrap_user[]"><input type="hidden" value="'+rmuser+'" class="form-control"  name="rm_user[]"></div></div></fieldset></div>');
                            }
                        }

                    } , error: function(data) {
                            if(firstcolumn!=""){
                            $("#sapcode").prop('readonly',true);
                            $("#sapcode").val(sap);
                            $("#editIngredient").val();
                            $("#editIngredient").prop('readonly',true);
                            $("#editcostval").prop('readonly',true);
                            $("#editcostval").val(qty);
                            $("#editscrap").val(scrap);
                            $("#editscrap_user").val(scrapuser);
                            $("#editrm_user").val(rmuser);
                            $("#editRate").val();
                            $("#editRate").prop('readonly',true);

                            }else{
                            toastr.error("sap data not avaliable for this code : "+sap);

                                if(scrap==null){
                                    var value="value=''";
                                }else{
                                    var value="value='"+scrap+"'";
                                }
                                $(".edit-more-ingrediant").append('<div class="form-group pt-4 col-md-12  mus"><fieldset><div class="p-3"><div class="inner row"><div class="mb-1 col-md-4 col-4"><label class="form-label" for="formemail">SAP Code</label><input type="text" class="form-control" id="sapcode" name="sapcode[]"  value="'+sap+'" readonly required> </div><div class="mb-1 col-md-4 col-4"><label class="form-label" for="formemail">Ingredient</label><input type="test" class="form-control"  id="editIngredient" name="editIngredient[]"  required></div><div class="mb-1 col-md-4 col-4"><label class="form-label" for="formemail">Rate</label><input type="text" class="form-control"   "  name="editRate[]" oninput="validateNumericInput(this)" required ><input type="hidden" name="_token" value="<?= csrf_token() ?>"></div><div class="mb-1 col-md-3 col-3"><input type="hidden" value="' +qty +'" class="form-control" id="editcostval" name="editcostval[]" readonly required><input type="hidden" '+value+' class="form-control"  name="scrap[]"><input type="hidden" value="'+scrapuser+'" class="form-control"  name="scrap_user[]"><input type="hidden" value="'+rmuser+'" class="form-control"  name="rm_user[]"></div></div></fieldset></div>');

                        }


                    }
            });

            }
        $('#formedit').on('submit',function(event) {
            event.preventDefault();
            var invalidValue = false;
            $('input[name="editRate[]"]').each(function() {
                var value = parseFloat($(this).val());
                if (isNaN(value) || value <= 0) {
                    console.log($(this).val());
                    invalidValue = true;
                    return false; // Exit the loop early if an invalid value is found
                }
            });

            // If an invalid value is found, display an error message and do not submit the form
            if (invalidValue) {
                toastr.error('Some Rate feilds contains zero');
                return;
            }
           var  data = $('#formedit').serialize();
            $.ajax({
                url: "{{ url('update_cost')}}",
                method: "POST",
                data: data,
                success: function() {
                    toastr.success('updated Successfully');
                    $('#rmcostmodel').modal('hide');
                    showcompleted();
                    showindextable();
                    $('#users').DataTable().ajax.reload();
                }
            });

        })

        // table = $('#rmview').DataTable({
        //     "autoWidth": false,
        //     'ajax': {
        //         url: "{{ url('show_pending')}}",
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

        function editshow(id) {
            $.ajax({
                url: "{{ url('editrm')}}",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(data) {
                    $('#viewid').val(data['basic']['id']);
                    ingredients(data['basic']['id']);
                }
            });
        }

        function ingredients(id) {
            table = $('#scrapview').DataTable({
                "autoWidth": false,
                "bDestroy": true,
                'ajax': {
                    url: "{{ url('get_Ingredients')}}",
                    data: {
                        id: id
                    },
                    type: 'get'
                },

                'columns': [{
                        title: "S.no",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: 'Ingredients'
                    },
                    {
                        data: 'rate'
                    },
                    {
                        data: 'qty'
                    }
                ],
            });

        }

        function open_modal(id) {

            $('#rmscrapmodel').modal('show');
            table = $('#rmscrapview').DataTable({
                "autoWidth": false,
                "bDestroy": true,
                'ajax': {
                    url: "{{ url('get_added_scrap')}}",
                    data: {
                        id: id,"comp":"comp"
                    },
                    type: 'get'
                },

                'columns': [{
                        title: "S.no",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: 'Ingredients'
                    },
                    {
                        data: 'rate'
                    },
                    {
                        data: 'qty'
                    },
                    {
                        data: 'Scrap'
                    },
                    // {
                    //     data: 'inscrap'
                    // },
                    //  {
                    //     data: 'mcost'
                    // },

                ],
            });
        }
    </script>

</body>

</html>
