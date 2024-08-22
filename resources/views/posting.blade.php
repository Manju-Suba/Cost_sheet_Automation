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
         <link rel="shortcut icon" href="../assets/images/favicon.ico">
    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico">

    <!-- plugin css -->
    <link href="../assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>
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

            @extends('layout.menu')

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dt-ext table-responsive">
                                        <table class="display" id="completetable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Invoice Type</th>
                                                    <th>Service Type</th>
                                                    <th>Movement Type</th>
                                                    <th>Vendor Name</th>
                                                    <th>Invoice bill No</th>
                                                    <th>Base Amount</th>
                                                    <th>IGST</th>
                                                    {{-- <th>CGST</th> --}}
                                                    <th>SGST</th>
                                                    <th>Invoice Amount</th>
                                                    <th>Entered name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            {{-- <thead>
                                            <tr>

                                                <th>#</th>
                                                <th>Invoice Type</th>
                                                <th>Service Type</th>
                                                <th>Movement Type</th>
                                                <th>Vendor Name</th>
                                                <th>Invoice bill No</th>
                                                <th>Base Amount</th>
                                                <th>IGST</th>
                                                <th>CGST</th>
                                                <th>SGST</th>
                                                <th>Invoice Amount</th>
                                                <th>Entered name</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody id="courierdatas">
                                            </tbody> --}}
                                        </table>

                                        {{-- <button type="button" id="AdminUpdateBtn"><button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Posting</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="inner row">
                                    <div class="mb-3 col-md-6 col-6">
                                        <label class="form-label" for="formemail">Posting Document Date :</label>
                                        <input type="date" class="form-control" id="postingdocumentdate"name="postingdocumentdate">
                                    </div>
                                    <div class="mb-3 col-md-6 col-6">
                                        <label class="form-label" for="formemail">Posted name :</label>
                                        <input type="text" class="form-control" id="postedname" name="postedname">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-sm btn-primary">Submit</button>
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
        <script src="../assets/libs/apexcharts/apexcharts.min.js"></script>
        <!-- Vector map-->
        <script src="../assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
        <script src="../assets/libs/jsvectormap/maps/world-merc.js"></script>
        <script src="../assets/js/pages/dashboard.init.js"></script>
        <script src="../assets/js/app.js"></script>
        <script src="../assets/toastify/toastify.js"></script>
       <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {{-- <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        </script> --}}
<script>
$(document).ready(function(){
    $('#completetable').DataTable({

        lengthChange: true,
         dom: 'Bfrtip',
        buttons: [

            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
      lengthMenu: [[10, 50, 100, 250, 500, -1], [10, 50, 100, 250, 500, "All"]],
      processing: true,
      serverSide: true,
      bDestroy: true,

      ajax: {
          url:'CourierData',

      },
      columns:[
        {data :'DT_RowIndex', name: 'DT_RowIndex'},
        {data :'invoicetype'},
        {data :'servicestype'},
        {data :'movementtype'},
        {data :'vendorname'},
        {data :'invoicebillno'},
        {data :'baseamount'},
        {data :'igst'},
        // {data :'cgst'},
        {data :'sgst'},
        {data :'invoiceamount'},
        {data :'enteredname'},
        {data :'action','render':function(data,type,row){
            string = document.location;
            arrayOfStrings = string.toString().split('/');
            let lastElement = arrayOfStrings[arrayOfStrings.length - 1];
            if(lastElement =="data"){

                return '<button type="button" class="btn btn-sm btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fas fa-pencil-alt fa-align-center"></i></button>';
            }
            else if(lastElement =="invoiceprocessor"){

                return '<button type="button" class="btn btn-sm btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"><i class="fas fa-pencil-alt fa-align-center"></i></button>';
            }
            else if(lastElement =="posting"){
                return '<button type="button" class="btn btn-sm btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#staticBackdrop2"><i class="fas fa-pencil-alt fa-align-center"></i></button>';

            }
            else{
                return '-';
            }
        }},
        ],
    })
});
</script>

</body>

</html>
