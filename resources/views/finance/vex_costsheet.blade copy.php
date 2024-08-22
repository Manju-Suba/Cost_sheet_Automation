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
    <link href="../../assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="../../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="../../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="../../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <style>
        .page-content {
            /* padding: 20px calc(24px / 2) 60px calc(24px / 2); */
            padding: 20px calc(102px / 2) 60px calc(117px / 2);
        }

        .pstyle{
            color: #23c24e;
            font-weight: bold;

        }

        .bold{
            font-weight: bold;
        }

        .icon {
            top: 1px;
        }

    </style>
</head>
<body data-layout="detached" data-topbar="colored">

    <div class="container-fluid">
        <!-- <h4 style="padding-top:12px;padding-left:62px;" ># Cost Sheet For</h4> -->
        <div class="page-content">
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-10">
                                
                                    <div class="row">
                                        <span class="col-5" style="font-weight: bold;font-size: 21px;">CavinKare Pvt Ltd</span>
                                    </div>
                                    <div class="row">
                                        <span class="col-3" style="font-weight: bold;">Product Name</span>
                                        <span class="col-1">:</span>
                                        <span class="col-4 pstyle">{{$data['basic']->material_code}}</span>
                                    </div>
                                    <div class="row">
                                        <span class="col-3" style="font-weight: bold;">Version</span>
                                        <span class="col-1">:</span>
                                        <span class="col-4 pstyle">{{$data['basic']->version}}</span>
                                    </div>
                                    <div class="row">
                                        <span class="col-3" style="font-weight: bold;">Plant</span>
                                        <span class="col-1">:</span>
                                        <span class="col-4 pstyle">TNC6</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered table-striped" id="costsheet_tb" style="width:100%">
                                            <thead style="background-color: #cdc5c5a3;color: #021644;">
                                                <tr>
                                                    <th>Reference No</th>
                                                    <th>Particulars </th>
                                                    <th>Per piece</th>
                                                    <th>Per case</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="bold">RF001</td>
                                                    <td class="bold">Material code</td>
                                                    <td>{{$data['basic']->material_code}}</td>
                                                    <td>{{$data['basic']->material_code}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF002</td>
                                                    <td class="bold">No. of Pcs / case</td>
                                                    <td>{{$data['basic']->pieces_per_case}}</td>
                                                    <td>{{$data['basic']->pieces_per_case}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF003</td>
                                                    <td class="bold">MRP per Pcs</td>
                                                    <td>{{$data['basic']->mrp_piece}}</td>
                                                    <td>{{$data['basic']->mrp_piece}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF004</td>
                                                    <td class="bold">MRP per case</td>
                                                    <td>{{$data['mrp_per_case']}}</td>
                                                    <td>{{$data['mrp_per_case']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF005</td>
                                                    <td class="bold">Fill Volume in ML</td>
                                                    <td>50</td>
                                                    <td>50</td>
                                                    <!-- <td>---from SAP ZCKPP02---</td> -->
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF006</td>
                                                    <td class="bold">Specific gravity</td>
                                                    <td>1</td>
                                                    <td>1</td>
                                                    <!-- <td>---from SAP ZCKPP02---</td> -->
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF007</td>
                                                    <td class="bold">Average Sales Tax</td>
                                                    <td>{{$data['salesTax']}}</td>
                                                    <td>{{$data['salesTax']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF008</td>
                                                    <td class="bold">Retailers margin</td>
                                                    <td>{{$data['basic']->retailer_margin}} %</td>
                                                    <td>{{$data['basic']->retailer_margin}} %</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF009</td>
                                                    <td class="bold">Primary Scheme</td>
                                                    <td>{{$data['basic']->primary_scheme}} %</td>
                                                    <td>{{$data['basic']->primary_scheme}} %</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF010</td>
                                                    <td class="bold">RS Margin</td>
                                                    <td>{{$data['basic']->rs_margin}} %</td>
                                                    <td>{{$data['basic']->rs_margin}} %</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF011</td>
                                                    <td class="bold">SS Margin</td>
                                                    <td>{{$data['basic']->ss_margin}} %</td>
                                                    <td>{{$data['basic']->ss_margin}} %</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF012</td>
                                                    <td class="bold">Landed Cost to Retailer</td>
                                                    <td>{{$data['cost_to_retailer']}}</td>
                                                    <td>{{$data['cost_to_retailer']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF013</td>
                                                    <td class="bold">Cost after Scheme</td>
                                                    <td>{{$data['Cost_after_scheme']}}</td>
                                                    <td>{{$data['Cost_after_scheme']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF014</td>
                                                    <td class="bold">Landed Cost to RS</td>
                                                    <td>{{$data['Landed_Cost_to_RS']}}</td>
                                                    <td>{{$data['Landed_Cost_to_RS']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF015</td>
                                                    <td class="bold">NR per Case ( before Sec TPR)</td>
                                                    <td>{{$data['nr_per_case_before']}}</td>
                                                    <td>{{$data['nr_per_case_before']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF016</td>
                                                    <td class="bold">Scheme ( Sec)</td>
                                                    <td>0</td><!--secondary scheme -->
                                                    <td>0</td><!--secondary scheme -->
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF017</td>
                                                    <td class="bold">NR per Case</td>
                                                    <td>{{$data['nr_per_case']}}</td>
                                                    <td>{{$data['nr_per_case']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF018</td>
                                                    <td class="bold">RM Cost</td>
                                                    <td>{{$data['rm_cost']}}</td>
                                                    <td>{{$data['rm_cost']}}</td>
                                                    <!-- <td>---Sap T-Code ZCKPP02---</td> -->
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF019</td>
                                                    <td class="bold">PM Cost</td>
                                                    <td>{{$data['pm_cost']}}</td>
                                                    <td>{{$data['pm_cost']}}</td>
                                                    <!-- <td>---Sap T-Code ZCKPP02---</td> -->
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF020</td>
                                                    <td class="bold">Conv. Cost</td>
                                                    <td>{{$data['conv_cost']}}</td>
                                                    <td>{{$data['conv_cost']}}</td>
                                                    <!-- <td>---Sap T-Code ZCKPP02---</td> -->
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF021</td>
                                                    <td class="bold">Primary freight</td>
                                                    <td>{{$data['primary_freight']}}</td>
                                                    <td>{{$data['primary_freight']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF022</td>
                                                    <td class="bold">Total Basic Price</td>
                                                    <td>{{$data['Total_Basic_Price']}}</td>
                                                    <td>{{$data['Total_Basic_Price']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF023</td>
                                                    <td class="bold">GM per case</td>
                                                    <td>{{$data['gm_per_case']}}</td>
                                                    <td>{{$data['gm_per_case']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF024</td>
                                                    <td class="bold">GM %</td>
                                                    <td>{{$data['gm_percent']}}</td>
                                                    <td>{{$data['gm_percent']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF025</td>
                                                    <td class="bold">Freight</td>
                                                    <td>{{$data['basic']->secondary_freight}}</td>
                                                    <td>{{$data['basic']->secondary_freight}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF026</td>
                                                    <td class="bold">Damages</td>
                                                    <td>{{$data['basic']->damage}} %</td>
                                                    <td>{{$data['basic']->damage}} %</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF027</td>
                                                    <td class="bold">Logistics cost</td>
                                                    <td>{{$data['basic']->logistic}} %</td>
                                                    <td>{{$data['basic']->logistic}} %</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF028</td>
                                                    <td class="bold">Freight/case</td>
                                                    <td>{{$data['freight_case']}}</td>
                                                    <td>{{$data['freight_case']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF029</td>
                                                    <td class="bold">Damages per case</td>
                                                    <td>{{$data['damage_per_case']}}</td>
                                                    <td>{{$data['damage_per_case']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF030</td>
                                                    <td class="bold">Logistics cost per case</td>
                                                    <td>{{$data['Logistics_cost_per_case']}}</td>
                                                    <td>{{$data['Logistics_cost_per_case']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF031</td>
                                                    <td class="bold">Total Variable cost per case</td>
                                                    <td>{{$data['Total_Variable_cost_per_case']}}</td>
                                                    <td>{{$data['Total_Variable_cost_per_case']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF032</td>
                                                    <td class="bold">Estd COGS ( Inclusive of Variable cost) per case</td>
                                                    <td>{{$data['cogs']}}</td>
                                                    <td>{{$data['cogs']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF033</td>
                                                    <td class="bold">Estimated NM Per Case</td>
                                                    <td>{{$data['Estimated_NM_per_case']}}</td>
                                                    <td>{{$data['Estimated_NM_per_case']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bold">RF034</td>
                                                    <td class="bold">Estimated NM (%)</td>
                                                    <td>{{$data['Estimated_NM_percent']}}</td>
                                                    <td>{{$data['Estimated_NM_percent']}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        @if(auth()->user()->role=="Finance")
                                        <div class="col-md-6">
                                            <a href="/epd_costsheet_approval" class="btn btn-primary btn-md" style="margin-right:1px"> << Go Back</a>
                                            <!-- <button type="button" id="go_back" name="go_back" class="btn btn-md btn-primary" > >> Go Back</button> -->
                                            @if($data['basic']->excsheet_approval == 'pending')
                                            <button type="button" onclick="sheet_approve(<?php echo $data['basic']->id ?>)" class="btn btn-md btn-success" ><i class="bx bx-check icon nav-icon"></i>Approve</button>
                                            <button type="button" onclick="sheet_reject(<?php echo $data['basic']->id ?>)" class="btn btn-md btn-danger" ><i class="bx bx-x icon nav-icon"></i>Reject</button>
                                            <span id="success_message"></span>
                                            @endif

                                        </div>
                                        @endif

                                        @if(auth()->user()->role=="Marketing")
                                        <div class="col-md-6">
                                            <a href="/epd_cost_sheet" class="btn btn-primary btn-md" style="margin-right:1px"> << Go Back</a>
                                            <!-- <button type="button" id="go_back" name="go_back" class="btn btn-md btn-primary" > >> Go Back</button> -->
                                            @if($data['basic']->mt_exsheet_approval == 'pending')
                                            <button type="button" onclick="sheet_mt_approve(<?php echo $data['basic']->id ?>)" class="btn btn-md btn-success" ><i class="bx bx-check icon nav-icon"></i>Approve</button>
                                            <button type="button" onclick="sheet_mt_reject(<?php echo $data['basic']->id ?>)" class="btn btn-md btn-danger" ><i class="bx bx-x icon nav-icon"></i>Reject</button>
                                            <span id="success_message"></span>
                                            @endif

                                        </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page-content -->
    </div>
    <!-- end container-fluid -->
    
    <!-- JAVASCRIPT -->
    <script src="../../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/libs/metismenujs/metismenujs.min.js"></script>
    <script src="../../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../../assets/libs/eva-icons/eva.min.js"></script>
    <!-- apexcharts -->
    <script src="../../assets/libs/apexcharts/apexcharts.min.js"></script>
    <!-- Vector map-->
    <script src="../../assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="../../assets/libs/jsvectormap/maps/world-merc.js"></script>
    <script src="../../assets/js/pages/dashboard.init.js"></script>
    <script src="../../assets/js/app.js"></script>
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
            table = $('#costsheet_tb').DataTable({
                'autowidth': false,
                ajax: {
                    url: "{{url('fetch_basic_cost')}}"
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'version',
                        name: 'version'
                    },
                    {
                        data: 'Product_name',
                        name: 'Product_name'
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

        function openmodel() {
            $.ajax({
                url: '{{url("export")}}',
            });
        }

        function sheet_approve(id){
            $.ajax({
                url: "{{url('approve_epdsheet')}}",
                type: "post",
                data: {
                    'id': id
                },
                success: function(data) {
                    $('#success_message').css('color','green');
                    $('#success_message').html('---/ Approved Successfully /---');
                    setTimeout(function(){
                        window.location.href="/epd_costsheet_approval";
                    },2000)
                }
            });
        }

        function sheet_reject(id){
            $.ajax({
                url: "{{url('reject_epdsheet')}}",
                type: "post",
                data: {
                    'id': id
                },
                success: function(data) {
                    $('#success_message').css('color','red');
                    $('#success_message').html('---/ Rejected Successfully /---');
                    setTimeout(function(){
                        window.location.href="/epd_costsheet_approval";
                    },2000)
                }
            });
        }


        function sheet_mt_approve(id){
            $.ajax({
                url: "{{url('approve_mt_epdsheet')}}",
                type: "post",
                data: {
                    'id': id
                },
                success: function(data) {
                    $('#success_message').css('color','green');
                    $('#success_message').html('---/ Approved Successfully /---');
                    setTimeout(function(){
                        window.location.href="/epd_cost_sheet";
                    },2000)
                }
            });
        }

        function sheet_mt_reject(id){
            $.ajax({
                url: "{{url('reject_mt_epdsheet')}}",
                type: "post",
                data: {
                    'id': id
                },
                success: function(data) {
                    $('#success_message').css('color','red');
                    $('#success_message').html('---/ Rejected Successfully /---');
                    setTimeout(function(){
                        window.location.href="/epd_cost_sheet";
                    },2000)
                }
            });
        }

    </script>

</body>

</html>