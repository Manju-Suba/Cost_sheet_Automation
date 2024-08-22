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
    <!-- App favicon -->

    <!-- plugin css -->

        <!-- plugin css -->
        <link href="../assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Css -->
        <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <!-- datatable -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        {{-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"> </script>
        <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
        {{-- new cdn --}}

        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"> </script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"> </script>
        <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    </head>

    <style>

        /* .set-body-padding{
            background-color:#ebeef4;
            box-shadow: 2px 3px #00000038;
        } */

        @media only screen and (max-width: 1199px) {
            .set-col {
                /* addcolumn = col-5; */
            }
        }

    </style>

<body>
    <!-- <div class="container-fluid"> -->
        <!-- Begin page -->
        <div id="layout-wrapper">
            @include('layout.navbar')

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="card-title mb-4 ">CostSheet Overview</h5>
                                <div class="row">
                                    <div class="set-col">
                                        <div class="card" title="NPD Pending Count">
                                            <!-- <div class="card-body set-body-padding" style="padding: 0.5rem 1.5rem !important;border-radius: 9px;"> -->
                                            <div class="card-body set-body-padding" style="padding: 0.5rem 1.5rem !important;background-color: rgb(236 198 28 / 40%);border-radius: 9px;">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <i class='fa fa-spinner text-warning' style="font-size: 33px;padding:11px 3px 3px;"></i>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <b>NPD Pending</b>
                                                        <p>>> <span id="epd_pending_count">{{$npd_pending_count}}</span> </p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="set-col">
                                        <div class="card" title="NPD Completed Count">
                                            <!-- <div class="card-body set-body-padding" style="padding: 0.5rem 1.5rem !important;border-radius: 9px;"> -->
                                            <div class="card-body set-body-padding" style="padding: 0.5rem 1.5rem !important;background-color: rgb(11 82 212 / 30%);border-radius: 9px;">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <i class='fa fa-certificate text-primary' style="font-size: 33px;padding: 10px 3px 3px"></i>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <b>NPD Approved</b>
                                                        <p>>> <span id="epd_completed_count">{{$npd_completed_count}}</span> </p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="set-col">
                                        <div class="card" title="NPD Rejected Count">
                                            <!-- <div class="card-body set-body-padding" style="padding: 0.5rem 1.5rem !important;border-radius: 9px;"> -->
                                            <div class="card-body set-body-padding" style="padding: 0.5rem 1.5rem !important;background-color: rgb(226 36 9 / 37%);border-radius: 9px;">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <i class='fa fa-times text-danger' style="font-size: 37px;padding: 8px 3px 3px;"></i>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <b>NPD Rejected</b>
                                                        <p>>> <span id="npd_rejected_count">{{$npd_rejected_count}}</span> </p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    @if(auth()->user()->role == "Marketing" || auth()->user()->role == "Tax" || auth()->user()->role == "R&D" || auth()->user()->role == "RM Purchase" || auth()->user()->role == "PM Purchase" || auth()->user()->role =="Logistic" || auth()->user()->role == "Finance")
                                    <div class="set-col">
                                        <div class="card" title="EPD Pending Count">
                                            <!-- <div class="card-body set-body-padding" style="padding: 0.5rem 1.5rem !important;border-radius: 9px;"> -->
                                            <div class="card-body set-body-padding" style="padding: 0.5rem 1.5rem !important;background-color: #ade5f796;border-radius: 9px;">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <i class='bx bxs-analyse text-info' style="font-size: 43px;padding-top:3px;"></i>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <b>EPD Pending</b>
                                                        <p>>> <span id="epd_pending_count">{{$epd_pending_count}}</span> </p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="set-col">
                                        <div class="card" title="EPD Completed Count">
                                            <!-- <div class="card-body set-body-padding" style="padding: 0.5rem 1.5rem !important;border-radius: 9px;"> -->
                                            <div class="card-body set-body-padding" style="padding: 0.5rem 1.5rem !important;background-color: #7cf98f96;border-radius: 9px;">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <i class='fa fa-check text-success' style="font-size: 42px;padding: 8px 3px 3px"></i>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <b>EPD Approved</b>
                                                        <p>>> <span id="epd_completed_count">{{$epd_completed_count}}</span> </p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="set-col">
                                        <div class="card" title="EPD Rejected Count">
                                            <!-- <div class="card-body set-body-padding" style="padding: 0.5rem 1.5rem !important;border-radius: 9px;"> -->
                                            <div class="card-body set-body-padding" style="padding: 0.5rem 1.5rem !important;background-color: rgb(192 26 154 / 34%);border-radius: 9px;">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <i class='fa fa-ban' style="font-size: 37px;padding-top: 10px;color: #a60fbed6;"></i>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <b>EPD Rejected</b>
                                                        <p>>> <span id="epd_rejected_count">{{$epd_rejected_count}}</span> </p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="set-table-view col-sm-12 col-md-7 col-xl-8">
                                        <h6 class="card-title mb-4 ">NPD CostSheet Details</h6>
                                        @endif

                                        <div class="card py-4">
                                            <div class="card-body" style="font-size: 13px;">
                                                @if(auth()->user()->role == "Marketing")
                                                    <table class="table" id="dashdata1">
                                                        <thead>
                                                            <th class="text-secondary">S.no</th>
                                                            <th class="text-secondary">Product Name</th>
                                                            <th class="text-secondary">Initiated Date</th>
                                                        </thead>
                                                    </table>

                                                @elseif(auth()->user()->role == "R&D" || auth()->user()->role == "Tax" || auth()->user()->role == "Packaging" )
                                                <table class="table" id="datadash2">
                                                    <thead>
                                                        <th class="text-secondary">S.no</th>
                                                        <th class="text-secondary">Product Name</th>
                                                        <th class="text-secondary">Status</th>
                                                        <th class="text-secondary">Initiated Date</th>
                                                        <th class="text-secondary">Due Date</th>
                                                    </thead>
                                                </table>
                                                @elseif( auth()->user()->role =="PM Purchase" ||auth()->user()->role =="RM Purchase")
                                                <table class="table" id="datadash4">
                                                    <thead>
                                                        <th class="text-secondary">S.no</th>
                                                        <th class="text-secondary">Product Name</th>
                                                        <th class="text-secondary">Status</th>
                                                        <th class="text-secondary">Initiated Date</th>
                                                        <th class="text-secondary">Due Date</th>
                                                    </thead>
                                                    {{-- <tbody>
                                                        @foreach ( $pm_costs_ids as $val=>$basic)
                                                        <tr>
                                                        <td>{{$val +1}}</td>
                                                        <td>{{ $prod_name[$val]}}</td>
                                                        <td> @if( $status[$val] == "Completed" ) <i class='bx bxs-circle text-success'></i> @else <i class='bx bxs-circle text-danger'></i> @endif {{ $status[$val] }} </td>
                                                        <td>{{ $basic->created_at}}</td>
                                                        <td @if(new DateTime()>$basic->created_at->addDays(1) &&  $status[$val] == "Pending") class="text-danger" @else @endif > {{ $basic->created_at->addDays(1)}} </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody> --}}
                                                </table>

                                                @elseif( auth()->user()->role == "Finance" ||auth()->user()->role =="operations"|| auth()->user()->role =="Logistic")
                                                <table class="table" id="dashdata3">
                                                    <thead>
                                                        <th class="text-secondary">S.no</th>
                                                        <th class="text-secondary">Product Name</th>

                                                        <th class="text-secondary">Inputs Pending</th>
                                                        <th class="text-secondary">status</th>
                                                        <th class="text-secondary">Initiated Date</th>
                                                        @if(auth()->user()->role != "Finance")
                                                        <th class="text-secondary">Due Date</th>
                                                        @endif

                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    @if(auth()->user()->role == "Marketing" || auth()->user()->role == "Tax" || auth()->user()->role == "R&D" || auth()->user()->role == "RM Purchase" || auth()->user()->role == "PM Purchase" || auth()->user()->role =="Logistic" || auth()->user()->role == "Finance")
                                    <div class="set-table-view col-sm-12 col-md-5 col-xl-4">
                                        <h6 class="card-title mb-4 ">EPD CostSheet Details</h6>

                                        <!-- <div class="col-md-6"> -->
                                            <div class="card">
                                                <div class="card-body" style="font-size: 13px;">
                                                    <table class="table" id="epdDashboardTb3">
                                                        <thead>
                                                            <th class="text-secondary">S.no</th>
                                                            <th class="text-secondary">Material Code</th>

                                                            @if( auth()->user()->role == "Finance" || auth()->user()->role =="Logistic")
                                                            <th class="text-secondary">Inputs Pending</th>
                                                            @endif

                                                            @if(auth()->user()->role != "Marketing")
                                                            <th class="text-secondary">status</th>
                                                            @endif

                                                            <th class="text-secondary">Initiated Date</th>

                                                            @if(auth()->user()->role != "Marketing" && auth()->user()->role != "RM Purchase" && auth()->user()->role != "PM Purchase")
                                                            <th class="text-secondary">Due Date</th>
                                                            @endif
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        <!-- </div> -->
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>


                         <!-- end row -->


                        <!-- end row -->



                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                @extends('layout.footer')

            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

    <!-- </div> -->
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

    <script src="../assets/js/pages/dashboard.init.js"></script>

    <script src="../assets/js/app.js"></script>

        <!-- <script src="../assets/toastify/toastify.js"></script> -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $(document).ready(function () {
            var xs = window.matchMedia("(max-width: 1099px)");
            var x = window.matchMedia("(max-width: 1599px)");
            var y = window.matchMedia("(max-width: 2600px)");

            myFunction(x);
            x.addListener(function (x) {
                myFunction(x);
            });

            function myFunction(x) {
                var setColElement = $('.set-col');
                var setPaddingElement = $('.set-body-padding');

                if (xs.matches) {
                    // Screen width is between 1600px and 2000px
                    setColElement.removeClass('col-4 col-2').addClass('col-6');
                    setPaddingElement.css('padding', '0.5rem 1.5rem');

                } else if (x.matches) {
                    // Screen width is less than 1600px
                    setColElement.removeClass('col-2 col-6').addClass('col-4');
                    setPaddingElement.css('padding', '0.5rem 1.5rem');

                } else if (y.matches) {
                    // Screen width is between 1600px and 2000px
                    setColElement.removeClass('col-4 col-6').addClass('col-2');
                    setPaddingElement.css('padding', '0.3rem 0.5rem');

                } else {
                    // Screen width is greater than 2000px
                    setColElement.removeClass('col-4 col-2').addClass('col-6');
                    setPaddingElement.css('padding', '0.5rem 1.5rem');
                }
            }


            var role = {!! json_encode($role) !!};

            if(role == 'Tax' || role =="Logistic" || role == 'Finance' || role == 'R&D' || role == 'RM Purchase' || role =='PM Purchase'){
                $('.set-table-view').removeClass('col-md-5 col-xl-4').addClass('col-md-12 col-xl-12');

            }

        });




    </script>

    <script>

        $('#dashdata3').DataTable({
            "autoWidth": false,
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 100],
            'ajax': {
                url: "{{ url('dashBoardData')}}",
            },
            columns: [{
                    data: 'DT_RowIndex'
                },
                {
                    data: 'Product_name',
                    name: 'Product_name'
                },
                {
                    data: 'pendinginputs',
                    name: 'pendinginputs'
                },

                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'initiated_date',
                    name: 'initiated_date'
                },
                @if(auth()->user()->role != "Finance")

                {
                    data: 'duedate',
                    name: 'duedate'
                },
                @endif


            ]
        });
        $('#dashdata1').DataTable({
            "autoWidth": false,
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 100],
            'ajax': {
                url: "{{ url('dashBoardData')}}",
            },
            columns: [{
                    data: 'DT_RowIndex'
                },
                {
                    data: 'Product_name',
                    name: 'Product_name'
                },


                {
                    data: 'initiated_date',
                    name: 'initiated_date'
                },


            ]
        });
        $('#datadash2').DataTable({
            "autoWidth": false,
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 100],
            'ajax': {
                url: "{{ url('dashBoardData')}}",
            },
            columns: [{
                    data: 'DT_RowIndex'
                },
                {
                    data: 'Product_name',
                    name: 'Product_name'
                },
                {
                    data: 'status',
                    name: 'status'
                },

                {
                    data: 'initiated_date',
                    name: 'initiated_date'
                },
                {
                    data: 'duedate',
                    name: 'duedate'
                },


            ]
        });
        $('#datadash4').DataTable({
            "autoWidth": false,
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 100],
            'ajax': {
                url: "{{ url('dashBoardData')}}",
            },
            columns: [{
                    data: 'DT_RowIndex'
                },
                {
                    data: 'Product_name',
                    name: 'Product_name'
                },
                {
                    data: 'status',
                    name: 'status'
                },

                {
                    data: 'initiated_date',
                    name: 'initiated_date'
                },
                {
                    data: 'duedate',
                    name: 'duedate'
                },


            ]
        });




        ///EPD STrt

        // $('#epdDashboardTb').DataTable({
        //     "autoWidth": false,
        //         "pageLength": 5,
        //         "lengthMenu": [5, 10, 25, 50],
        //         searching: false,
        //     'ajax': {
        //         url: "{{ url('epdDashboardData')}}",
        //     },
        //     columns: [
        //         { data: 'DT_RowIndex' },
        //         { data: 'material_code', name: 'material_code' },
        //         { data: 'initiated_date', name: 'initiated_date' },
        //     ]
        // });

        // $('#epdDashboardTb2').DataTable({
        //     "autoWidth": false,
        //         "pageLength": 5,
        //         "lengthMenu": [5, 10, 25, 50],
        //         searching: false,
        //     'ajax': {
        //         url: "{{ url('epdDashboardData')}}",
        //     },
        //     columns: [
        //         { data: 'DT_RowIndex' },
        //         { data: 'material_code', name: 'material_code' },
        //         { data: 'status', name: 'status' },
        //         { data: 'initiated_date', name: 'initiated_date' },
        //         { data: 'duedate', name: 'duedate' },
        //     ]
        // });

        // $('#epdDashboardTb3').DataTable({
        //     "autoWidth": false,
        //         "pageLength": 5,
        //         "lengthMenu": [5, 10, 25, 50],
        //         searching: false,
        //     'ajax': {
        //         url: "{{ url('epdDashboardData')}}",
        //     },
        //     columns: [
        //         { data: 'DT_RowIndex' },
        //         { data: 'material_code', name: 'material_code' },
        //         { data: 'pending_data', name: 'pending_data' },
        //         { data: 'status', name: 'status' },
        //         { data: 'initiated_date', name: 'initiated_date' },
        //         { data: 'duedate', name: 'duedate' },
        //     ]
        // });

        var columns = [
            { data: 'DT_RowIndex' },
            { data: 'material_code', name: 'material_code' },
        ];

        @if(auth()->user()->role == "Finance" || auth()->user()->role == "Logistic")
            columns.push({ data: 'pending_data', name: 'pending_data' });
        @endif

        @if(auth()->user()->role != "Marketing")
            columns.push({ data: 'status', name: 'status' });
        @endif

        columns.push(
            { data: 'initiated_date', name: 'initiated_date' }
        );

        @if(auth()->user()->role != "Marketing" && auth()->user()->role != "RM Purchase" && auth()->user()->role != "PM Purchase")
            columns.push({ data: 'duedate', name: 'duedate' });
        @endif

        $('#epdDashboardTb3').DataTable({
            "autoWidth": false,
            "pageLength": 5,
            "lengthMenu": [5, 10, 25, 50],
            // searching: false,
            'ajax': {
                url: "{{ url('epdDashboardData')}}",
            },
            columns: columns
        });



    </script>

</body>

</html>
