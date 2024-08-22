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
    {{-- toaster --}}
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
</head>
<style>
    .toast-success {
        background-color: #139113;
    }

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

    .input-xs {
        width: 100px;
        /* height: 22px; */
        /* padding: 2px 5px;
        font-size: 12px;
        line-height: 1.5;
        /* border-radius: 3px; */
    }
</style>

</head>

<body data-layout="detached" data-topbar="colored">

    <div class="container-fluid">
        <!-- Begin page -->
        <div id="layout-wrapper">

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
                                        <h4 class="card-title">OPERATIONS</h4>
                                        <p class="card-title-desc"></p>
                                        {{-- <from><button type="button" style="float: right" class="btn btn-sm btn-success mb-3">Add Scrap</button></from> --}}

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active r_tab" data-bs-toggle="tab" href="#home1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block">RM SCRAP</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link  p_tab" data-bs-toggle="tab" href="#profile1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block">PM SCRAP</span>
                                                </a>
                                            </li>
                                                 <li class="nav-item f_tab">
                                                <a class="nav-link " data-bs-toggle="tab" href="#fgscrap" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                    <span class="d-none d-sm-block">FG SCRAP</span>
                                                </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a class="nav-link c_tab" data-bs-toggle="tab" href="#messages1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                    <span class="d-none d-sm-block">CONVERSION COST</span>
                                                </a>
                                            </li>
                                         

                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content p-3 text-muted">
                                            <div class="tab-pane active" id="home1" role="tabpanel">
                                                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active r_tab" data-bs-toggle="tab" href="#rm_pend" role="tab" id="">
                                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                            <span class="d-none d-sm-block">RM SCRAP Pending</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link r_tab" data-bs-toggle="tab" href="#rm_approve" role="tab" id="">
                                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                            <span class="d-none d-sm-block">RM SCRAP Rejected</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item r_tab">
                                                        <a class="nav-link" data-bs-toggle="tab" href="#rm_rej" role="tab" id="">
                                                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                            <span class="d-none d-sm-block">RM SCRAP Approved</span>
                                                        </a>
                                                    </li>

                                                </ul>
                                                <div class="tab-content p-3 text-muted">
                                                    <div class="tab-pane active" id="rm_pend" role="tabpanel">
                                                        <div class="col-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover " id="rm_crap">
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
                                                    <div class="tab-pane" id="rm_approve" role="tabpanel">
                                                        <div class="col-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover " id="rm_crap1">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>S.no</th>
                                                                            <th>Product Name</th>
                                                                            <th>Division</th>
                                                                            <th>Fill Volume</th>
                                                                            <th>Case Configuration</th>
                                                                            <th>Launch Qty</th>
                                                                            <th>Remarks</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="rm_rej" role="tabpanel">
                                                        <div class="col-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover " id="rm_crap2">
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
                                            <div class="tab-pane" id="profile1" role="tabpanel">
                                                <div class="tab-content p-3 text-muted">

                                                    <div class="tab-pane active" id="pm_pending" role="tabpanel" >

                                                        <div class="col-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover " id="pm_scrap" style="width:100%">
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
                                             <div class="tab-pane" id="fgscrap" role="tabpanel">
                                                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">

                                                    <li class="nav-item">
                                                        <a class="nav-link active c_tab" data-bs-toggle="tab" href="#fg_pending" role="tab" >
                                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                            <span class="d-none d-sm-block">FG SCRAP Pending </span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link c_tab" data-bs-toggle="tab" href="#fg_rejected" role="tab" >
                                                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                            <span class="d-none d-sm-block">FG SCRAP Rejected</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item ">
                                                        <a class="nav-link c_tab" data-bs-toggle="tab" href="#fg_approved" role="tab" >
                                                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                            <span class="d-none d-sm-block">FG SCRAP Approved</span>
                                                        </a>
                                                    </li>

                                                </ul>
                                                <div class="tab-content p-3 text-muted">
                                                    <div class="tab-pane active" id="fg_pending" role="tabpanel">
                                                        <div class="col-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover" id="fgpending_table" style="width:100%">
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
                                                    <div class="tab-pane " id="fg_rejected" role="tabpanel">
                                                        <div class="col-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover" id="fgrej_table" style="width:100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>S.no</th>
                                                                            <th>Product Name</th>
                                                                            <th>Division</th>
                                                                            <th>Fill Volume</th>
                                                                            <th>Case Configuration</th>
                                                                            <th>Launch Qty</th>
                                                                            <th>Remarks</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>

                                                                </table>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane " id="fg_approved" role="tabpanel">
                                                        <div class="col-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover" id="fgapp_table" style="width:100%">
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

                                            <div class="tab-pane" id="messages1" role="tabpanel">
                                                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">

                                                    <li class="nav-item">
                                                        <a class="nav-link active c_tab" data-bs-toggle="tab" href="#conv_pending" role="tab" >
                                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                            <span class="d-none d-sm-block">Conversion Cost Pending </span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link c_tab" data-bs-toggle="tab" href="#conv_rejected" role="tab" >
                                                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                            <span class="d-none d-sm-block">Conversion Cost Rejected</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item ">
                                                        <a class="nav-link c_tab" data-bs-toggle="tab" href="#conv_approved" role="tab" >
                                                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                            <span class="d-none d-sm-block">Conversion Cost Approved</span>
                                                        </a>
                                                    </li>

                                                </ul>
                                                <div class="tab-content p-3 text-muted">
                                                    <div class="tab-pane active" id="conv_pending" role="tabpanel">
                                                        <div class="col-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover" id="covert" style="width:100%">
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
                                                    <div class="tab-pane " id="conv_rejected" role="tabpanel">
                                                        <div class="col-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover" id="conver_rej" style="width:100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>S.no</th>
                                                                            <th>Product Name</th>
                                                                            <th>Division</th>
                                                                            <th>Fill Volume</th>
                                                                            <th>Case Configuration</th>
                                                                            <th>Launch Qty</th>
                                                                            <th>Remarks</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>

                                                                </table>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane " id="conv_approved" role="tabpanel">
                                                        <div class="col-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover" id="conver_app" style="width:100%">
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

                                    <div class="modal fade" id="rmviewmodel" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Add RM Scrap</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form id="scrap_add">
                                                    <div class="modal-body">
                                                        <div class="col-12">
                                                            <div class="table-responsive">
                                                             <input type="hidden" id="stat" name="stat">
                                                                <input type="text" id="viewid" hidden>
                                                                <table class="table table-hover" id="scrapview">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>S.no</th>
                                                                            <th>Ingredients</th>
                                                                            <th>Qty</th>
                                                                            <th>Rate</th>
                                                                            <th>Scrap</th>
                                                                            <th> Total Qty(Inc.Scrap) </th>
                                                                            <th>Material cost </th>
                                                                        </tr>
                                                                    </thead>

                                                                </table>
                                                            </div>
                                                            <span id="message_shown" style="color:red;float:right"></span>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn  btn-sm btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                    </div>
                                    <div class="modal fade" id="plantmodal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
                                        <div class="modal-dialog ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Add Plant</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form  id="plant_form">
                                                        <div class="row">
                                                                <div class="col-9">
                                                                <label  class="form-label">Choose Plant
                                                                </label>
                                                            <select class="form-select" id="plant_name" name="plant_name" required>
                                                                <option value="">Choose</option>
                                                                @foreach ($plant as $item)
                                                                 <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <input type="hidden" id="bas_id" name="bas_id">
                                                            </div>
                                                            <div class="col-2 mt-4">
                                                                <button class="btn btn-sm btn-primary mt-2" type="submit" id="plant_button"> Save</button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                                <div class="modal-footer">
                                                    {{-- <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                    </div>
                                     <div class="modal fade" id="fgs_modal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
                                        <div class="modal-dialog ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Add Scrap</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form  id="fgs_form">
                                                        <div class="row">
                                                                <div class="col-9">
                                                                <label  class="form-label">Finished good Scrap
                                                                </label>
                                                            <input type="text" class="form-control" name="fgs_name" id="fgs_name" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
                                                            <input type="hidden" id="fgs_id" name="fgs_id">
                                                            <input type="hidden" id="fg_sts" name="fg_sts">
                                                            </div>
                                                            <div class="col-2 mt-4">
                                                                <button class="btn btn-sm btn-primary mt-2" type="submit" id="fgs_button"> Save</button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                                <div class="modal-footer">
                                                    {{-- <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                    </div>
                                    <!-- pm scrap modal -->
                                    <div class="modal fade pmmodal" id="pmview" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
                                        <div class="modal-dialog modal-xl">
                                            <form id="pm_scrap_add">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Add PM Scrap</h5>
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
                                                                            <th>%Wt (Inc.Scrap) </th>
                                                                        </tr>
                                                                    </thead>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-sm btn-primary" >Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- /.modal-content -->
                                        </div>
                                    </div>

                                    {{-- add convocation modal--}}
                                    <div class="modal fade" id="convModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5>Add Conversion Cost</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <!-- <form id="frm_con"> -->
                                                <form action="javascript:void(0)" id="frm_con" enctype="multipart/form-data" autocomplete="off">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="conv_cost" class="form-label">Conversion cost/kg
                                                                </label>
                                                                <input type="text" class="form-control" id="conv_cost" name="conv_cost"  onkeypress="return /[0-9.]/i.test(event.key)" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" id="hid_pid" name="hid_pid" hidden>
                                                                <label for="" class="form-label">UOM</label>
                                                                <select class="form-control" name="uom" id="select_uom" required>
                                                                    @foreach ($data as $item)
                                                                    @if( $item->uom_name == "Case")
                                                                    <option value="{{ $item->uom_name }}" selected>  {{ $item->uom_name }}</option>
                                                                    @else
                                                                    <option value="{{ $item->uom_name }}" disabled>  {{ $item->uom_name }}</option>
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                            </div><input type="hidden" id="status_bar" name="status_bar">
                                                            <div class="col-md-12 mt-2 breakupUpload">
                                                                <label for="" class="form-label">Breakup Upload</label>
                                                                <div id="upload_input">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        {{-- <button type="button" class="btn btn-secondary btn-sm"
                                                        data-bs-dismiss="modal">Close</button> --}}
                                                        <div id="btn_visible">
                                                            <button type="submit" class="btn btn-primary btn-sm" id="save_id">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end row -->

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
                    <div class="modal fade" id="remarks_modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5>Remarks</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <div id="remarks_tab1">

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

    <!-- Vector map-->
    <script src="../assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="../assets/libs/jsvectormap/maps/world-merc.js"></script>

    <script src="../assets/js/pages/dashboard.init.js"></script>

    <script src="../assets/js/app.js"></script>

    {{-- <script src="../assets/toastify/toastify.js"></script> --}}
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
         $(document).on("mousedown", "#select_uom", function(event){
           event.preventDefault();
         });
         $(document).on("input", ".scrapeditval", function(){
            var qty= parseFloat($(this).closest("tr").find(".qtyeditval").val())||0;
            var scrap=  parseFloat($(this).val())||0;
            var inscrap=  qty*(1+scrap);
            $(this).closest("tr").find(".inscrapeditval").val(inscrap.toFixed(2))
            var rate= parseFloat($(this).closest("tr").find(".rateeditval").val())||0;
            var mcost=  inscrap*rate;
            $(this).closest("tr").find(".mcosteditval").val(mcost.toFixed(2))
        });
         function open_remarks(id){
           $("#remarks_modal").modal('show');

            $.ajax({
                url: "{{ url('view_remarks') }}",
                type: "POST",
                data: {
                    id:id,
                    "type": "conv"
                },
                success: function(data) {
                    $("#remarks_tab").html("<p>"+data.data+"</p>");

                }
            });
        }
        function open_remarks1(id){
           $("#remarks_modal1").modal('show');

            $.ajax({
                url: "{{ url('view_remarks') }}",
                type: "POST",
                data: {
                    id:id,
                    "type": "scrap"
                },
                success: function(data) {
                    $("#remarks_tab1").html("<p>"+data.data+"</p>");

                }
            });
        }
          function open_remarks_scrap(id){
           $("#remarks_modal1").modal('show');

            $.ajax({
                url: "{{ url('view_remarks') }}",
                type: "POST",
                data: {
                    id:id,
                    "type": "fg_scrap"
                },
                success: function(data) {
                    $("#remarks_tab1").html("<p>"+data.data+"</p>");

                }
            });
        }
            $(".r_tab").click(function() {
                rmscrap();
            });
            $(".p_tab").click(function() {
                pmscrap();

            });
            $(".c_tab").click(function() {
                conversationCost();
            });
             $(".f_tab").click(function() {
                fgScrap();
            });
          $("#plant_form").submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{url("map_plant")}}',
                type: 'POST',
                data: $("#plant_form").serialize(),
                success: function(data) {
                    toastr.success('Plant Mapped Success fully');
                    rmscrap();
                    $('#plantmodal').modal('hide');

                },
                error: function(e) {
                    toastr.error('Plant not mapped');
                }
            });
        });
         $("#fgs_form").submit(function(e) {
            e.preventDefault();
            
            $.ajax({
                url: '{{url("add_fgscrap")}}',
                type: 'POST',
                data: $("#fgs_form").serialize(),
                success: function(data) {
                    toastr.success( 'Scrap added Success fully');
                    $('#fgs_modal').modal('hide');
                       fgScrap();
                },
                error: function(e) {
                    toastr.error('Request Failed');
                }
            });
        });
        $(document).ready(function() {
            rmscrap();
            pmscrap();
            conversationCost();
            fgScrap();
        });

        function rmscrap() {
            table = $('#rm_crap').DataTable({
                "bDestroy": true,
                "autoWidth": false,
                'ajax': {
                    url: "{{ url('get_RMopration')}}",
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
                    }
                ],
            });
            table_rm_rej = $('#rm_crap1').DataTable({
                "bDestroy": true,
                "autoWidth": false,
                'ajax': {
                    url: "{{ url('get_RMopration')}}",
                    data:{'rej':'rej'}
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
                        data: 'remarks'
                    },
                    {
                        data: 'Action1'
                    }
                ],
            });
            table_rm_app= $('#rm_crap2').DataTable({
                "bDestroy": true,
                "autoWidth": false,
                'ajax': {
                    url: "{{ url('get_RMopration')}}",
                    data:{'app':'app'}

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
                    }
                ],
            });
        }

        function pmscrap() {

            table = $('#pm_scrap').DataTable({
                "bDestroy": true,
                ajax: {
                    url: "{{ url('/fetch_pm_data') }}",
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
        function fgScrap(){
           table_fg = $('#fgpending_table').DataTable({
                'autowidth': true,
                "bDestroy": true,
                ajax: {
                    url: "{{ url('/fgScrapDatas') }}",
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
                        name: 'division'
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
           tablerej_fg = $('#fgrej_table').DataTable({
                'autowidth': true,
                "bDestroy": true,

                ajax: {
                    url: "{{ url('/fgScrapDatas') }}",
                    data:{'rej':'rej'}
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
                        name: 'division'
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
                        data: 'remarks',
                        name: 'remarks'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            }); tableapp_fg = $('#fgapp_table').DataTable({
                'autowidth': true,
                "bDestroy": true,

                ajax: {
                    url: "{{ url('/fgScrapDatas') }}",
                    data:{'app':'app'}
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
                        name: 'division'
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

        function conversationCost() {

            table = $('#covert').DataTable({
                'autowidth': true,
                "bDestroy": true,

                ajax: {
                    url: "{{ url('/conversation_details') }}",
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
            table_c_rej = $('#conver_rej').DataTable({
                'autowidth': true,
                "bDestroy": true,

                ajax: {
                    url: "{{ url('/conversation_details') }}",
                    data:{'rej':'rej'}
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
                        data: 'remarks',
                        name: 'remarks'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            table_c_app = $('#conver_app').DataTable({
                'autowidth': true,
                "bDestroy": true,

                ajax: {
                    url: "{{ url('/conversation_details') }}",
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

        $(document).on('submit', '#scrap_add', function(e) {
            e.preventDefault();
            // if(data !=""){
                $.ajax({
                    url: '{{url("add_scrap")}}',
                    data:$("#scrap_add").serialize(),
                    success: function(data) {
                        toastr.success('scrap added');
                        $('.btn-close').click();
                        rmscrap();
                    },
                    error: function(e) {
                        toastr.error('scrap not added');
                    }
                });
            // }else{
                // $('#message_shown').text('Please fill the scrap !');
                // setTimeout(function(){
                //     $('#message_shown').text('');
                // },2000);
                // toastr.error('Please fill the scrap !');

            // }

        });
        function plantmodal(id,plant) {
            $('#plantmodal').modal('show');
            $("#plant_button").prop("hidden",false)
            $("#plant_name").prop("disabled",false)
            $("#plant_name").val('');
            $("#bas_id").val(id);
            if(plant!=""){
                $("#plant_name").val(plant);
                $("#plant_name").prop("disabled",true)
                $("#plant_button").prop("hidden",true)
            }
        }
        function fgscrapmodal(id,fgs,fg_sts) {
            $('#fgs_modal').modal('show');
            $("#fgs_button").prop("hidden",false)
            $("#fgs_name").prop("disabled",false)
            $("#fgs_name").val('');
            $("#fgs_id").val(id);
            $("#fg_sts").val(fg_sts);
            if(fgs!=""&&fg_sts!=2){
                // $("#fgs_name").val(fgs);
                $("#fgs_name").prop("disabled",true)
                $("#fgs_button").prop("hidden",true)
            }
            $("#fgs_name").val(fgs);
            if(fg_sts==0){
                $("#fgs_name").val('');
            }
           
        }
        function scrapmodal(id,stat) {
            $('#rmviewmodel').modal('show');
            $("#stat").val(stat);
            table = $('#scrapview').DataTable({
                "pageLength": 100 ,
                "bDestroy": true,
                "autoWidth": false,
                'ajax': {
                    url: "{{ url('getIngredient')}}",
                    data: {
                        prd_id: id,stat:stat
                    },
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
                        data: 'qty'
                    },
                    {
                        data: 'rate'
                    },
                    {
                        data: 'Scrap'
                    },
                    {
                        data: 'inscrap'
                    },
                     {
                        data: 'mcost'
                    },

                ],
            });
        }

        function pmscrapmodal(id) {

            $('#pmview').modal('show');
            table = $('#scrapdetails').DataTable({
                "bDestroy": true,
                ajax: {
                    url: "{{ url('/getpmdetails') }}",
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
                        data: 'wtscrap',
                        name: 'wtscrap'
                    },

                ]
            });
        }

        $(document).on('submit', '#pm_scrap_add', function(e) {
           e.preventDefault();
            $.ajax({
                url: '{{url("add_pm_scrap")}}',
                type: 'POST',
                data: $("#pm_scrap_add").serialize(),
                success: function(data) {
                    toastr.success('scrap added');
                    $('.btn-close').click();
                    pmscrap();
                },
                error: function(e) {
                    toastr.error('scrap not added');
                }
            });
        });

        function openconv(id,sts) {
            $.ajax({
                url: '{{'edit_conversion_cost'}}',
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    $("#status_bar").val(sts);
                    $('#hid_pid').val(id);
                    if((data.result!=null)){
                       if((data.result.conv_cost != null && data.result.b_conv_cost_approval == 1 )||(data.result.conv_cost != null && data.result.b_conv_cost_approval == 0 )){
                        $('#conv_cost').val(data.result.conv_cost);
                        $('#select_uom').val(data.result.conv_uom);
                        $('#hid_pid').val(data.result.id);
                        $('#btn_visible').css('display','none');
                        // $('#upload_input').css('display','none');

                        $('#upload_input').html('<a href="{{asset(url('/../assets/uploads'))}}/'+data.result.breakup_excel+'" tittle="Download" class="btn btn-sm btn-info" >Download</a>');
                       }
                       else{
                        $('#upload_input').html('<input type="file" class="form-control" id="excel_upload" name="excel_upload" accept=".csv,.xlsx"  >\
                        <a href="{{asset(url('/../assets/uploads'))}}/'+data.result.breakup_excel+'" tittle="Download" class="btn btn-sm mt-2 btn-info" >Download</a>');
                        $('#save_id').html('save');
                        $('#conv_cost').val(data.result.conv_cost);
                        $('#select_uom').val(data.result.conv_uom);
                        $('#excel_upload').val('');
                        $('#btn_visible').css('display','block');
                       }
                    }
                   else{

                        $('#upload_input').html('<input type="file" class="form-control" id="excel_upload" name="excel_upload" accept=".csv,.xlsx" required >');
                        $('#save_id').html('save');
                        $('#conv_cost').val('');
                        // $('#select_uom').val('');
                        $('#excel_upload').val('');
                        $('#btn_visible').css('display','block');
                        // $('#upload_input').css('display','block');

                    }
                    $('#convModal').modal('show');
                }
            });
        }

        // $('#save_id').click(function() {
        $('#frm_con').submit(function() {

            $.ajax({
                url: '{{url("add_conv")}}',
                type: 'POST',
                data: new FormData(this),
                dataType: "JSON",
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#convModal').modal('hide');
                    $('#frm_con')[0].reset();
                    toastr.success('Added Successfully');
                    conversationCost();

                }
            });
        });
  function validateNumericInput(input) {
        // Remove non-numeric characters using a regular expression
                input.value = input.value.replace(/[^0-9.]/g, '');

        // Ensure there is only one dot in the input (for decimal numbers)
            input.value = input.value.replace(/(\..*)\./g, '$1');
               }
    </script>

</body>

</html>
