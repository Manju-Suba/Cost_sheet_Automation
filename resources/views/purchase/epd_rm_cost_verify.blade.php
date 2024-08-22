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
                                        <h4 class="card-title" style=" margin-bottom: 1.5rem;">EPD RM Cost Approval</h4>
                                        <p class="card-title-desc"></p>

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active p_tab" data-bs-toggle="tab" href="#home1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block">Pending Products</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link a_tab" data-bs-toggle="tab" href="#profile1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block">Approved Products</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link r_tab" data-bs-toggle="tab" href="#messages1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                    <span class="d-none d-sm-block">Rejected Products</span>
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
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- model -->
                                            <div class="modal fade bs-example-modal-xl" tabindex="-1" id="tycheck" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            Existing Product RM Cost Info ::
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card-content">
                                                                <!-- <div class="card-body"> -->
                                                                    <div class="col-12">
                                                                        <form id="api_request_rmcost" enctype="multipart/form-data">
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <label>Material Code</label>
                                                                                    <input type="text" name="material_code" id="material_code" class="form-control" readonly>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <label>Material Type</label>
                                                                                    <select name="material_type" id="material_type" class="form-control" required>
                                                                                        <option value="" selected disabled>--Select--</option>
                                                                                        <option value="ZFG">Finished Goods</option>
                                                                                        <option value="ZPAC">Packaging Material</option>
                                                                                        <option value="ZROH">Raw Materials</option>
                                                                                        <option value="ZSFG">SFG</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <label>Plant</label>
                                                                                    <select name="plant" id="plant" class="form-control" required onchange="plantSelectionChanged()">
                                                                                        <option value="" selected disabled>--Select--</option>
                                                                                        <!-- Add your options here -->
                                                                                    </select>
                                                                                </div>
                                                                                <div id="fetch_ingredients"></div>
                                                                                <input type="hidden" name="conv_cost" id="conv_cost" value="" class="form-control" required>
                                                                                <input type="hidden" name="rm_data_list" id="rm_data_list" value="" class="form-control" required>
                                                                                <input type="hidden" name="pm_data_list" id="pm_data_list" value="" class="form-control" required>
                                                                                <div class="col-md-10"></div>
                                                                                <div class="col-md-4">
                                                                                    <input type="hidden" name="pro_id" id="pro_id" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-3 mt-3 text-center" style="margin-top: 30px !important;">
                                                                                    <button type="submit" class="form-control btn btn-primary" id="save_rmcost" style="display:none" >Verify</button>
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
    <!-- Vector map-->
    <script src="../assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="../assets/libs/jsvectormap/maps/world-merc.js"></script>
    <script src="../assets/js/app.js"></script>

    <!-- toastr link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>

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
                    url: "{{url('fetch_epd_rm_view')}}"
                },
                columns: [
                    { data: 'DT_RowIndex' },
                    { data: 'material_code', name: 'material_code' },
                    { data: 'division', name: 'division' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });

        $(".a_tab").click(function() {
            table2_();
        });

        $(".r_tab").click(function() {
            table3_();
        });


        function table2_(){
            table2 = $('#csheet_approved_tb').DataTable({
                "autoWidth": false,
                "bDestroy": true,
                'ajax': {
                    url: "{{ url('overall_epd_sheet')}}",
                    // type: 'POST'
                    method: "GET",
                    data: {'app':'approved' },
                },
                columns: [
                    { data: 'DT_RowIndex' },
                    { data: 'material_code', name: 'material_code' },
                    { data: 'division', name: 'division' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        }

        function table3_(){
            table3 = $('#rejected_tb').DataTable({
                "bDestroy": true,
                'ajax': {
                    url: '{{url("overall_epd_sheet")}}',
                    method: "GET",
                    data: {'app':'rejected' },
                },
                columns: [
                    { data: 'DT_RowIndex' },
                    { data: 'material_code', name: 'material_code' },
                    { data: 'division', name: 'division' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        }

        function view_api_form(ele){
            $('#save_rmcost').attr('disabled',true);

            $('#fetch_ingredients').find('.dynamic-element').remove();

            var mcode = $(ele).attr("data-id");
            var pro_id = $(ele).attr("data-proid");
            $('#material_code').val(mcode);
            $('#pro_id').val(pro_id);
            var mtype = $('#material_type').val('');

            $('#rm_data_list').val('');
            $('#pm_data_list').val('');
            $('#conv_cost').val('');

            $("#plant option").remove();
            var html = '<option value="" selected disabled>--Select--</option>';
            $('#plant').append(html);

            $.ajax({
                url: "{{ url('get_epd_data') }}",
                method: "GET",
                data: {'pro_id':pro_id },
                success: function(data) {
                    if(data.data.rmcost_verified == "verified"){
                        $('#material_type').val(data.data.material_type);
                        $('#material_type').prop('disabled', true);

                        $("#plant option").remove();
                        var html2 = '<option value="" selected disabled>--Select--</option>';
                            html2 += '<option value='+data.data.plant+' >'+data.data.plant+'</option>';
                        $('#plant').append(html2);

                        $('#plant').val(data.data.plant);
                        $('#plant').prop('disabled', true);
                        $('#save_rmcost').css('display','none');

                        if(data.rmdetails){

                            const $container = $('#fetch_ingredients');

                            const $row = $('<div>', { class: 'row mt-4 dynamic-element' });
                            const $col11 = $('<div>', { class: 'col-md-6' }).append(
                                $('<label>Ingredient</label>')
                            );
                            const $col21 = $('<div>', { class: 'col-md-2' }).append(
                                $('<label>Rate</label>')
                            );
                            const $col31 = $('<div>', { class: 'col-md-2' }).append(
                                $('<label>Measure</label>')
                            );
                            const $col41 = $('<div>', { class: 'col-md-2' }).append(
                                $('<label>Cost</label>')
                            );

                            $row.append($col11, $col21, $col31, $col41);
                            $container.append($row);
                            
                            $.each(data.rmdetails, function(index, item) {
                                const $row = $('<div>', { class: 'row mb-4 dynamic-element' });

                                const $col1 = $('<div>', { class: 'col-md-6' }).append(
                                    $('<input>', { type: 'text', name: `rmproduct${index}`, class: 'form-control', value: item.in_mat_desc, readonly: true })
                                );
                                const $col2 = $('<div>', { class: 'col-md-2' }).append(
                                    $('<input>', { type: 'text', name: `rmrate${index}`, class: 'form-control', value: item.rate, readonly: true })
                                );
                                const $col3 = $('<div>', { class: 'col-md-2' }).append(
                                    $('<input>', { type: 'text', name: `rmmeasure${index}`, class: `form-control` , value: item.meeht, readonly: true })
                                );
                                const $col4 = $('<div>', { class: 'col-md-2' }).append(
                                    $('<input>', { type: 'text', name: `rmcost${index}`, class: 'form-control', value: item.cost, readonly: true })
                                );

                                $row.append($col1, $col2, $col3, $col4);
                                $container.append($row);
                            });
                        }

                    }else{
                        $('#save_rmcost').css('display','block');
                        $('#plant').prop('disabled', false);
                        $('#material_type').prop('disabled', false);
                    }
                }
            })

            $('#tycheck').modal('show');
        }

        $('#material_type').on('change',function(){
            var mcode = $('#material_code').val();
            var mtype = $('#material_type').val();

            // $('#rm_cost').val('');
            // $('#pm_cost').val('');
            // $('#conv_cost').val('');
            $('#fetch_ingredients').find('.dynamic-element').remove();

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

        // $("#get_api").click(function() {
        //     var mcode = $('#material_code').val();
        //     var proid = $('#pro_id').val();
        //     var mtype = $('#material_type').val();
        //     var plant = $('#plant').val();

        //     if(mtype != null && plant != null){
        //         $('#tycheck').modal('hide');

        //         var furl = "{{ route('send_apirequest') }}";
        //         const url = `${furl}?mcode=${mcode}&proid=${proid}&mtype=${mtype}&plant=${plant}`;
        //         window.location.href = url;
        //     }else{
        //         alert('Please fill all the field !');
        //     }
        // });

        function plantSelectionChanged() {
            var selectedValue = document.getElementById("plant").value;

            var mcode = $('#material_code').val();
            var mtype = $('#material_type').val();
            if(mtype != "" && selectedValue != ""){
                call_api(mcode,mtype,selectedValue);
            }
        }

        function call_api (mcode,mtype,mplant){
            $('#fetch_ingredients').find('.dynamic-element').remove();
            $('#rm_data_list').val('');
            $('#pm_data_list').val('');
            $('#conv_cost').val('');

            $.ajax({
                url: "{{ url('get_epd_rmcost') }}",
                method: "POST",
                contentType: "application/json",
                processData: false,
                data: JSON.stringify({ 'mcode': mcode ,'mtype':mtype , 'mplant':mplant}),
                success: function(data) {

                    var rm_data = data.rmdta;
                    var pm_data = data.pmdta;

                    $('#rm_data_list').val(JSON.stringify(rm_data));
                    $('#pm_data_list').val(JSON.stringify(pm_data));

                    const $container = $('#fetch_ingredients');

                    const $row = $('<div>', { class: 'row mt-4 dynamic-element' });
                    const $col11 = $('<div>', { class: 'col-md-6' }).append(
                        $('<label>Ingredient</label>')
                    );
                    const $col21 = $('<div>', { class: 'col-md-2' }).append(
                        $('<label>Rate</label>')
                    );
                    const $col31 = $('<div>', { class: 'col-md-2' }).append(
                        $('<label>Measure</label>')
                    );
                    const $col41 = $('<div>', { class: 'col-md-2' }).append(
                        $('<label>Cost</label>')
                    );

                    $row.append($col11, $col21, $col31, $col41);
                    $container.append($row);
                    
                    $.each(rm_data, function(index, item) {
                        const $row = $('<div>', { class: 'row mb-4 dynamic-element' });

                        const $col1 = $('<div>', { class: 'col-md-6' }).append(
                            $('<input>', { type: 'text', id: `rmproduct${index}`, name: 'rmproduct[]', class: 'form-control', value: item.IN_MAT_DESC, readonly: true })
                        );
                        const $col2 = $('<div>', { class: 'col-md-2' }).append(
                            $('<input>', { type: 'text', id: `rmrate${index}`, name: 'rmrate[]', class: 'form-control', value: item.RATE, readonly: true })
                        );
                        const $col3 = $('<div>', { class: 'col-md-2' }).append(
                            $('<input>', { type: 'text', id: `rmmeasure${index}`, name: 'rmmeasure[]', class: `form-control` , value: item.Meeht, readonly: true })
                        );
                        const $col4 = $('<div>', { class: 'col-md-2' }).append(
                            $('<input>', {
                                type: 'text',
                                id: `rmcost${index}`,
                                name: 'rmcost[]',
                                class: 'form-control',
                                value: item.COST,
                                onkeypress: 'return /[0-9.]/i.test(event.key)',
                                required: true
                            }).prop('readonly', item.COST > 1)
                        );

                        $row.append($col1, $col2, $col3, $col4);
                        $container.append($row);
                    });


                    // var rmcost = data.rmcost;
                    // fetch_ingredients
                    // $('#rm_cost').val(rmcost);
                    // $('#rm_cost_sap').val(rmcost);
                    // $('#pm_cost').val(data.pmcost);
                    $('#conv_cost').val(data.conv_cost);

                    // if(data.rmcost <= 1){
                        $('#save_rmcost').attr('disabled',false);
                    // }else{
                    //     $('#rm_cost').attr('readonly', 'readonly');
                    // }
                },
            });
        }

        $("#api_request_rmcost").submit(function(e){
            e.preventDefault();
            $('#save_rmcost').attr('disabled',true);
            $('#save_rmcost').html('Processing...');
            var formData = new FormData($('#api_request_rmcost')[0]);
            $.ajax({
                url: "{{ url('save_sap_rmcost') }}",
                method: "POST",
                contentType: false,
                processData: false,
                data: formData,
                success: function(response) {
                    if(response.status == "success"){
                        toastr.success('Verified Data Updated Successfully');
                    }
                    $('#tycheck').modal('hide');
                    $('#save_rmcost').attr('disabled',false);
                    $('#save_rmcost').html('Verify');
                    table.ajax.reload();
                }
            })
        })

    </script>

</body>
</html>
