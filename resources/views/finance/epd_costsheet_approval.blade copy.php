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
    <!-- datatable -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"> </script>
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"> </script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"> </script>
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        button:disabled {
            cursor: not-allowed;
            pointer-events: all !important;
        }

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
            border: 1px solid gray;
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
                                        <h4 class="card-title" style=" margin-bottom: 1.5rem;">EPD Cost Sheet Approval</h4>
                                        <p class="card-title-desc"></p>

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block">Pending Sheets</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block">Approved Sheets</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                    <span class="d-none d-sm-block">Rejected Sheets</span>
                                                </a>
                                            </li>

                                        </ul>



                                        <!-- Tab panes -->
                                        <div class="tab-content p-3 text-muted">
                                            <div class="tab-pane active" id="home1" role="tabpanel">
                                                <div class="row">
                                                    <!-- <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body"> -->
                                                                <div class="row">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-hover" id="costsheet_tb" style="width:100%">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>S.no</th>
                                                                                    <th>Material Code</th>
                                                                                    <th>Division</th>
                                                                                    <th>Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            <!-- </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>


                                            <!-- model -->
                                        <div class="modal fade bs-example-modal-xl" tabindex="-1" id="tycheck" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        Existing Product Info ::
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-content">
                                                            <!-- <div class="card-body"> -->
                                                                <div class="col-12">
                                                                    <form id="api_requestform" enctype="multipart/form-data">
                                                                        <div class="row">
                                                                            <div class="col-md-8" style="margin-left: 74px;">
                                                                                <label>Material Code</label>
                                                                                <input type="text" name="material_code" id="material_code" class="form-control" readonly>
                                                                            </div>
                                                                            <div class="col-md-8" style="margin-left: 74px;">
                                                                                <label>Material Type</label>
                                                                                <select name="material_type" id="material_type" class="form-control" required>
                                                                                    <option value="" selected disabled>--Select--</option>
                                                                                    <option value="ZFG">Finished Goods</option>
                                                                                    <option value="ZPAC">Packaging Material</option>
                                                                                    <option value="ZROH">Raw Materials</option>
                                                                                    <option value="ZSFG">SFG</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-8" style="margin-left: 74px;">
                                                                                <label>Plant</label>
                                                                                <select name="plant" id="plant" class="form-control" required>
                                                                                    <option value="" selected disabled>--Select--</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-10"></div>
                                                                            <div class="col-md-4">
                                                                                <input type="hidden" name="pro_id" id="pro_id" class="form-control">
                                                                            </div>
                                                                            <div class="col-md-3 mt-3 text-center" style="margin-top: 30px !important;">
                                                                                <button type="button" class="form-control btn btn-primary" id="get_api">open</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            <!-- </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>


                                            <div class="tab-pane" id="profile1" role="tabpanel">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover" id="csheet_approved_tb" style="width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.no</th>
                                                                    <th>Material Code</th>
                                                                    <th>Division</th>
                                                                    {{-- <th>Retailer Margin</th>
                                                                    <th>Primary Scheme</th> --}}
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="messages1" role="tabpanel">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover" id="rejected_tb" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.no</th>
                                                                    <th>Material Code</th>
                                                                    <th>Division</th>
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

    <!-- End Page-content -->

    @extends('layout.footer')
    <!-- end container-fluid -->

    @extends('layout.right-sidebar');

    <!-- JAVASCRIPT -->
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/metismenujs/metismenujs.min.js"></script>
    <script src="../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../assets/libs/eva-icons/eva.min.js"></script>
    <!-- apexcharts -->
    <!-- <script src="../assets/libs/apexcharts/apexcharts.min.js"></script> -->
    <!-- Vector map-->
    <script src="../assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="../assets/libs/jsvectormap/maps/world-merc.js"></script>
    <script src="../assets/js/pages/dashboard.init.js"></script>
    <script src="../assets/js/app.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {

            table = $('#costsheet_tb').DataTable({
                'autowidth': false,
                ajax: {
                    url: "{{url('fetch_ex_cost')}}"
                },
                columns: [
                    { data: 'DT_RowIndex' },
                    { data: 'material_code', name: 'material_code' },
                    { data: 'division', name: 'division' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            table2 = $('#csheet_approved_tb').DataTable({
                "autoWidth": false,
                'ajax': {
                    url: "{{ url('approved_epdsheet')}}",
                    // type: 'POST'
                },
                columns: [
                    { data: 'DT_RowIndex' },
                    { data: 'material_code', name: 'material_code' },
                    { data: 'division', name: 'division' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            table3 = $('#rejected_tb').DataTable({
                "bDestroy": true,
                'ajax': {
                    url: '{{url("rejected_epdsheet")}}',
                },
                columns: [
                    { data: 'DT_RowIndex' },
                    { data: 'material_code', name: 'material_code' },
                    { data: 'division', name: 'division' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });


        function view_api_form(ele){
            var mcode = $(ele).attr("data-id");
            var pro_id = $(ele).attr("data-proid");
            $('#material_code').val(mcode);
            $('#pro_id').val(pro_id);
            var mtype = $('#material_type').val('');

            $("#plant option").remove();
            var html = '<option value="" selected disabled>--Select--</option>';
            $('#plant').append(html);

            $('#tycheck').modal('show');
            
        }

        $('#material_type').on('change',function(){
            var mcode = $('#material_code').val();
            var mtype = $('#material_type').val();
            $.ajax({
                url: "{{ url('get_plant') }}",
                method: "POST",
                contentType: "application/json",
                processData: false,
                data: JSON.stringify({ 'mcode': mcode ,'mtype':mtype }),
                success: function(data) {
                    var plantValues = data.result.Data.map(function(item) {
                        return item.PLANT;
                    });
                    var plantCount = plantValues.length;
                    $("#plant option").remove();
                    var html = '<option value="" selected disabled>--Select--</option>';
                    for(var i=0; i<plantCount ;i++){
                        html += '<option value='+plantValues[i]+' >'+plantValues[i]+'</option>';
                    }
                    $('#plant').append(html);
                },
            });
        })

        $("#get_api").click(function() {

            var mcode = $('#material_code').val();
            var proid = $('#pro_id').val();
            var mtype = $('#material_type').val();
            var plant = $('#plant').val();

            if(mtype != null && plant != null){
                $('#tycheck').modal('hide');

                var furl = "{{ route('send_apirequest') }}";
                const url = `${furl}?mcode=${mcode}&proid=${proid}&mtype=${mtype}&plant=${plant}`;
                window.location.href = url;

                // var formData = new FormData($('#api_requestform')[0]);
                // $.ajax({
                //     url: "{{ url('send_apirequest') }}",
                //     method: "POST",
                //     contentType: false,
                //     processData: false,
                //     data: formData,
                //     success: function(response) {

                //         // var num = data.result.Data[0]['COMPONENT'];
                //         // var component = data.result.Data.map(function(item) {
                //         //     return item.COMPONENT;
                //         // });

                //         // var totalComponent = component.length;

                //         // var addrm_scrap = '';
                //         // var addpm_scrap = '';
                //         // for(var i=0; i<totalComponent ;i++){
                //         //     var check_lastnumber = '';

                //         //     var num = data.result.Data[i]['COMPONENT'];
                //         //     var check_lastnumber = String(num)[0];

                //         //     if(check_lastnumber == '5'){
                //         //         var rm_scrap = data.result.Data[i]['COMP_SCRAP'];
                //         //         var addrm_scrap = (+addrm_scrap) + (+rm_scrap);
                //         //     }
                //         //     if(check_lastnumber == '6'){
                //         //         var pm_scrap = data.result.Data[i]['COMP_SCRAP'];
                //         //         var addpm_scrap = (+addpm_scrap) + (+pm_scrap);
                //         //     }
                //         // }

                //         // var amount = data.data2.Data[0]['Amount'];


                //         // var costlist = data.result3.Data.map(function(item) {
                //         //     return item.PLANT;
                //         // });

                //         // var totalArray = costlist.length;

                //         // var addrm_cost = '';
                //         // var addpm_cost = '';
                //         // var addconv_cost = '';
                //         // for(var i=0; i<totalArray ;i++){

                //         //     var mat = data.result3.Data[0]['IN_MAT'];
                //         //     var check_center_number = String(mat)[11];
                //         //     alert(check_center_number);
                //         //     if(check_center_number == '5'){
                //         //         var rm_cost = data.result3.Data[i]['COST'];
                //         //         var addrm_cost = (+addrm_scrap) + (+rm_cost);
                //         //     }else if(check_center_number == '6'){
                //         //         var pm_cost = data.result3.Data[i]['COST'];
                //         //         var addpm_cost = (+addpm_scrap) + (+pm_cost);
                //         //     }else{
                //         //         var conv_cost = data.result3.Data[i]['COST'];
                //         //         var addconv_cost = (+addconv_cost) + (+conv_cost);
                //         //     }
                //         // }
                //         // alert(addrm_cost);
                //         // alert(addpm_cost);
                //         // alert(addconv_cost);

                //         // $("#api_requestform")[0].reset();
                //         // table2.ajax.reload();
                //         // $('#tycheck').modal('hide');
                //     },
                // });
            }else{
                alert('Please fill all the field !');
            }
        });

    </script>

</body>
</html>
