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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
{{-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"> </script>
<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />



<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"> </script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"> </script>
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<style>

    /* .swal2-popup{


} */
    button:disabled {
        cursor: not-allowed;
        pointer-events: all !important;
    }
    .swal2-x-mark {
        display: inline !important;
        justify-content: flex-end !important;
    }
    fieldset {
    border: 1px solid rgb(243, 238, 238) !important;
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
        border:1px solid gray;
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
                                            <li class="nav-item" id="add_rate_tab">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block">Add Rate</span>
                                                </a>
                                            </li>
                                            <li class="nav-item" id="pending_tab">
                                                <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block">Pending</span>
                                                </a>
                                            </li>
                                            <li class="nav-item" id="comp_tab">
                                                <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                    <span class="d-none d-sm-block">Completed</span>
                                                </a>
                                            </li>
                                            <li class="nav-item" id="rej_tab">
                                                <a class="nav-link" data-bs-toggle="tab" href="#rejected_tab" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                    <span class="d-none d-sm-block">Rejected</span>
                                                </a>
                                            </li>
                                            <li class="nav-item" id="app_tab">
                                                <a class="nav-link" data-bs-toggle="tab" href="#approved_tab" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                    <span class="d-none d-sm-block">Approved</span>
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
                                                                            <table class="table table-hover " id="users">
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
                                                        {{-- bulk upload --}}
                                                        <div class="modal fade" id="bulk_upload" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                           <form id="frm_upload" enctype="multipart/form-data">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5>Bulk Upload</h5>
                                                                            <a href="../assets/csv/rmrate_sample.xlsx" tittle="Download" class="btn btn-sm btn-info m-3 float-end" >Sample File Download </a>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                                <div class="row">
                                                                                      <input type="hidden" id="pname1" name="pname1">
                                                                                      <input type="hidden" id="pro_id1" name="pro_id1">
                                                                                      <input type="hidden" id="pid1" name="pid1">
                                                                                    <div class="col-md-6">
                                                                                        <label>Upload File</label>
                                                                                        <input type="file" class="form-control" id="excel_upload"  name="excel_upload" accept=".csv,.xlsx" required>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label>Specific Gravity</label>
                                                                                        <input type="text" class="form-control" id="spec_grav"  onkeypress="return /[0-9.]/i.test(event.key)" name="spec_grav" required>
                                                                                    </div>
                                                                                    <input type="hidden" name="_token"
                                                                                    value="<?= csrf_token() ?>">
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary"
                                                                                id="save_upload">Save</button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="col">
                                                            <!--  Modal content for the above example -->
                                                            <div class="modal fade" id="rmratemodel" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
                                                                <div class="modal-dialog modal-xl">
                                                                    <form id="formadd" class="p-3 needs-validation">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="staticBackdropLabel">Add RM Rate</h5>
                                                                                <button type="button"
                                                                                    class="btn btn-primary btn-sm mx-4 waves-effect waves-light float-end mb-1"
                                                                                    data-bs-toggle="modal" data-bs-target="#bulk_upload">Bulk Upload
                                                                                </button>
                                                                                <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div>
                                                                                    <button style="float: right;background-color: rgb(70, 72, 221) !important;" class="btn btn-sm text-white add_ingrediant float-right" type="button" title='Add More...'> <i class="fa fa-plus"></i> </button>
                                                                                </div>

                                                                                    <div class="form-group col-md-12 ">

                                                                                        <input type="text" class="form-control " name="p_name" id="pname" hidden>
                                                                                        <input type="text" class="form-control " name="pro_id" id="pro_id" hidden>
                                                                                        <input type="text" class="form-control " name="Product_id" id="pid" hidden>
                                                                                        <fieldset>
                                                                                            <div class="p-3">
                                                                                                <div class="inner row">
                                                                                                    <div class="mb-1 col-md-2 ">
                                                                                                        <label class="form-label" for="formemail">SAP Code</label>
                                                                                                        <input type="text" class="form-control sapcode  getValue" id="" name="sapcode[]" required>
                                                                                                        <div class="invalid-feedback">please enter the Sapcode</div>
                                                                                                    </div>
                                                                                                    <div class="mb-1 col-md-2 ">
                                                                                                        <label class="form-label" for="formemail">Ingredient</label>
                                                                                                        <input type="text" class="form-control ingre getValue" id="postingdocumentdate0" name="Ingredient[]" required>
                                                                                                        <div class="invalid-feedback">please enter the ingredient</div>
                                                                                                    </div>
                                                                                                    <div class="mb-1 col-md-2">
                                                                                                        <label class="form-label" for="formemail">Rate</label>
                                                                                                        <input type="text" class="form-control rate_s getValue" id="postedname0" name="Rate[]" onkeypress="return /[0-9.]/i.test(event.key)">
                                                                                                        <input type="hidden" name="_token" value="<?= csrf_token() ?>">

                                                                                                    </div>
                                                                                                    <div class="mb-1 col-md-1">
                                                                                                        <label class="form-label" for="formemail">Qty</label>
                                                                                                        <input type="text" class="form-control qtyval" id="postingdocumentcost0" name="Cost[]" onkeypress="return /[0-9.]/i.test(event.key)" required>
                                                                                                    </div>
                                                                                                    <div class="mb-1 col-md-1">
                                                                                                        <label class="form-label" for="formemail">Scrap %</label>
                                                                                                        <input type="text" class="form-control getValue scrappercent" id="scrap0" name="scrap[]" onkeypress="return /[0-9.]/i.test(event.key)">
                                                                                                    </div>
                                                                                                    <div class="mb-1 col-md-2">
                                                                                                        <label class="form-label" for="formemail">Total Qty (Inc. Scrap)</label>
                                                                                                        <input type="text" class="form-control  inscrap" id="inscrap0" name="inscrap[]" readonly>
                                                                                                    </div>
                                                                                                     <div class="mb-1 col-md-2">
                                                                                                        <label class="form-label" for="formemail">Material Cost</label>
                                                                                                        <input type="text" class="form-control  mcost" id="mcost0" name="mcost[]" readonly>
                                                                                                    </div>

                                                                                                </div>
                                                                                            </div>
                                                                                        <fieldset>
                                                                                        <div class="add-more-ingrediant">

                                                                                        </div>
                                                                                        <div class="row  m-2">
                                                                                                <div class="col-md-1">
                                                                                                    <label for="inputEmail4">Specific gravity:</label>

                                                                                                </div>
                                                                                            <div class="col-md-4 ">
                                                                                                <input type="text" class="form-control mx-1 specificgravity" id="specificgravity"  onkeypress="return /[0-9.]/i.test(event.key)" name="specific_gravity" required>
                                                                                            </div>
                                                                                        </div>
                                                                                        {{-- <button type="submit" id="rmcost" class="btn btn-sm btn-primary">Submit</button> --}}
                                                                                </form>

                                                                            </div>


                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit" id="rmcost" class="btn btn-sm btn-primary">Submit</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>


                                                        <div class="modal fade bs-example-modal-xl" tabindex="-1" id="rmratemodel" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        SAP information
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" id="clsbutton" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="card-content">
                                                                            <!-- <div class="card-body"> -->
                                                                                <div class="col-12">
                                                                                    <form id="formcheck" enctype="multipart/form-data">
                                                                                        <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                                                                                        <div class="row">

                                                                                            <div class="col-md-5">
                                                                                                <label>SAP Code</label>
                                                                                                <input type="text" class="form-control" id="mtcode" >
                                                                                                <span id="mtcode-error"  class="text-danger"></span>
                                                                                            </div>
                                                                                            <div class="col-md-5">
                                                                                                <label>Material Type</label>
                                                                                                <select name="mtype" id="mtype" class="form-control" required>

                                                                                                    <option value="">Choose</option>
                                                                                                    <option value="ZFG">Finished Goods</option>
                                                                                                    <option value="ZPAC">Packaging Material</option>
                                                                                                    <option value="ZROH">Raw Materials</option>
                                                                                                    <option value="ZSFG">SFG</option>

                                                                                                </select>
                                                                                                <span id="mtype-error"  class="text-danger"></span>

                                                                                            </div>
                                                                                            <div class="col-md-2 text-center mt-2" >
                                                                                                <button type="button" class="form-control btn btn-sm btn-primary mt-4" id="mtcode_submit">Done</button>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-1">
                                                                                            <div class="col-md-7">
                                                                                                <label>Plant</label>
                                                                                                <select name="plant_type" id="plant_type" class="form-control" required>
                                                                                                    <option value="" selected >Choose</option>

                                                                                                </select>
                                                                                                <span id="plant-error"  class="text-danger"></span>

                                                                                            </div>
                                                                                            <div class="col-md-3 mt-3 text-center" >
                                                                                                <button type="button" class="form-control mt-3 btn btn-sm btn-primary" id="submitplant">Submit</button>
                                                                                            </div>

                                                                                        <!-- </div> -->

                                                                                        </div>
                                                                                        {{-- <div class="row">
                                                                                             <div class="col-md-9"></div>
                                                                                            <div class="col-md-3 mt-3 text-center" >
                                                                                                <button type="button" class="form-control btn btn-sm btn-primary" id="submitplant">Submit</button>
                                                                                            </div>
                                                                                        </div> --}}
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
                                                        <!-- /.modal -->

                                                        <!-- /.modal -->
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane" id="profile1" role="tabpanel">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table table-hover " id="tbrmview">
                                                        <thead>
                                                            <tr>
                                                                <th>S.no</th>
                                                                <th>Product Name</th>
                                                                <th>Division</th>
                                                                <th>Fill Volume</th>
                                                                <th>Case Configuration</th>
                                                                <th>Launch Qty</th>
                                                                <th>Version</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>

                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <!--  Modal content for the above example -->
                                                <div class="modal fade" id="rmviewmodel" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
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
                                                                        <table class="table" id="scrapview">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>S.no</th>
                                                                                    <th>Ingredients</th>
                                                                                    <th>Rate</th>
                                                                                    <th>Qty</th>
                                                                                    <th>Scrap</th>
                                                                                    <th>Total Qty(Inscrap)</th>
                                                                                    <th>Material Cost</th>
                                                                                </tr>
                                                                            </thead>

                                                                        </table>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
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
                                                                <th>Version</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>

                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="rejected_tab" role="tabpanel">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table table-hover " id="rejected_items" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>S.no</th>
                                                                <th>Product Name</th>
                                                                <th>Division</th>
                                                                <th>Fill Volume</th>
                                                                <th>Case Configuration</th>
                                                                <th>Launch Qty</th>
                                                                <th>Version</th>
                                                                <th>Rejected</th>
                                                                <th>Remarks</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>

                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="approved_tab" role="tabpanel">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table table-hover" id="approved_items" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>S.no</th>
                                                                <th>Product Name</th>
                                                                <th>Division</th>
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
                    </div>
                </div>
                <!-- end row -->
                <div class="modal fade" id="confirm_modal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="exampleModalToggleLabel">Are you sure?</h4>
                          {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                        </div>
                        <div class="modal-body">
                            <input type="text" value="" id="hid_id" hidden>
                            <p>You won't be able to send this!</p>
                            <div class="mt-4">
                                <button type="button" class="btn btn-primary p-1" id="purchase" >Yes, send to Purchase Team!</button>
                                <button type="button" class="btn btn-success p-1" id="operation" >Yes, send to Operation Team!</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                        </div>
                      </div>
                    </div>
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
                                                    <th>Qty.</th>
                                                    <th>Scrap %</th>
                                                    <th>Total Qty (Inscrap)</th>
                                                    <th>Material Cost</th>
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
                {{-- PM MODAL --}}
        {{-- update modal --}}
        <div class="modal fade" id="rejectedmodal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="width:980px;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">View RM Rate</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formupdate" class="p-3 needs-validation">
                            <div class="form-group col-md-12  ">
                                <input type="text" class="form-control " name="edit_pro_id" id="edit_pro_id" hidden>
                                <fieldset>
                                    <div class="p-3">
                                        <div class="inner row" id="rejected_values">


                                        </div>

                                    </div>
                                <fieldset>
                            <div>
                                <button style="float: right;background-color: #0e12eb !important;" id="update_rm" class="btn btn-sm text-white  float-right" type="button" title='Add More...'> Save  </button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
                <!-- /.modal-dialog -->
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
        <!-- End Page-content -->

        @extends('layout.footer')
    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    </div>
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

    {{-- <script src="../assets/js/pages/dashboard.init.js"></script> --}}

    <script src="../assets/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>

    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                            "type": "scrap"
                        },
                        success: function(data) {
                            $("#remarks_tab").html("<p>"+data.data+"</p>");

                        }
                    });
                }
        $('#frm_upload').submit(function(e){
            e.preventDefault();
            var formData = new FormData($('#frm_upload')[0]);
            // console.log(formData);
            $.ajax({
                url:"{{ url('bulkupload_rm')}}",
                method:'POST',
                data:formData,
                dataType: "JSON",
                cache: false,
                processData: false,
                contentType: false,
                success:function(response){

                    console.log(response.message );
                    if(response.status !="success"){
                        toastr.error(response.status.excel_upload[0]);
                    }else{
                        Swal.fire(
                            response.message
                        )
                        $('#frm_upload')[0].reset();
                        addrate();
                        showtable();
                        showcompleted();
                        showrejected();
                        showApproved();
                        $(".btn-close").click();
                        $("#plantModal").modal('hide');
                    }
                    // $('#confirm_modal').modal('hide' );

                },
                error:function(response){
                    if(response.responseJSON){
                         var errors = response.responseJSON.errors;

                if(errors!=''||errors!=undefined){
                $.each(errors, function(fieldName, errorMessages) {
                // Split the fieldName to extract the index and field name
                var parts = fieldName.split('.');
                var index = parts[0];
                var name = parts[1];

                // Loop through the error messages for this field
                $.each(errorMessages, function(index, errorMessage) {
                    // Use index and errorMessage as needed
                    toastr.error(errorMessage);
                    });
                });
                }
                    }

            }
            });
        });
        $(document).on("input", ".sapcode", function(){

            $(this).closest(".inner").find(".ingre").attr('readonly', true);
            $(this).closest(".inner").find(".ingre").attr('required', false);
            $(this).closest(".inner").find(".rate_s").attr('readonly', true);
           if($(this).val()==""){
            $(this).closest(".inner").find(".ingre").attr('readonly', false);
            $(this).closest(".inner").find(".rate_s").attr('readonly', false);
            $(this).closest(".inner").find(".ingre").attr('required', true);
           }
        });
        $(document).on("input", ".scrappercent", function(){
            var qty= parseFloat($(this).closest(".inner").find(".qtyval").val())||0;
            var scrap=  parseFloat($(this).val())||0;
            var inscrap=  qty*(1+scrap);
            $(this).closest(".inner").find(".inscrap").val(inscrap.toFixed(2))
            var rate= parseFloat($(this).closest(".inner").find(".rate_s").val())||0;
            var mcost=  inscrap*rate;
            $(this).closest(".inner").find(".mcost").val(mcost.toFixed(2))
        });
        $(document).on("input", ".scrappercent1", function(){
            var qty= parseFloat($(this).closest(".edit_inner_row").find(".qtyval1").val())||0;
            var scrap=  parseFloat($(this).val())||0;
            var inscrap=  qty*(1+scrap);
            $(this).closest(".edit_inner_row").find(".inscrap1").val(inscrap.toFixed(2))
            var rate= parseFloat($(this).closest(".edit_inner_row").find(".rate_s1").val())||0;
            var mcost=  inscrap*rate;
            $(this).closest(".edit_inner_row").find(".mcost1").val(mcost.toFixed(2))
        });
        $(document).on("input", ".qtyval", function(){
            var scrap= parseFloat($(this).closest(".inner").find(".scrappercent").val())||0;
            var qty=  parseFloat($(this).val())||0;
            var inscrap=  qty*(1+scrap);
            $(this).closest(".inner").find(".inscrap").val(inscrap.toFixed(2))
            var rate= parseFloat($(this).closest(".inner").find(".rate_s").val())||0;
            var mcost=  inscrap*rate;
            $(this).closest(".inner").find(".mcost").val(mcost.toFixed(2))
        });
         $(document).on("input", ".rate_s", function(){
            var scrap= parseFloat($(this).closest(".inner").find(".inscrap").val())||0;
            var rate=  parseFloat($(this).val())||0;
            var mcost=  scrap*rate;
            $(this).closest(".inner").find(".mcost").val(mcost.toFixed(2))
        });
           
        $(document).on("input", ".ingre", function(){

            $(this).closest(".inner").find(".sapcode").attr('readonly', true);
            $(this).closest(".inner").find(".sapcode").attr('required', false);
            if($(this).val()==""){
            $(this).closest(".inner").find(".sapcode").attr('readonly', false);
            $(this).closest(".inner").find(".sapcode").attr('required', true);

            }
        });
        $(document).ready(function() {
            var add_ingrediant = $(".add_ingrediant");
            var o = 0;
            var max_fi_in = 25;
            var owner_wrapper = $(".add-more-ingrediant");
            $(add_ingrediant).click(function(e) {
                e.preventDefault();

                if (o < max_fi_in ) {
                    o++;

                    $(owner_wrapper).append('<div class="form-group col-md-12 add-more-ingrediant remove_div"> <br><fieldset ><div class="p-3"> <div class="inner row"> <div class="mb-1 col-md-2  "><label class="form-label" for="formemail">SAP Code</label><input type="text" class="form-control sapcode getValue" id="" name="sapcode[]" required><div class="invalid-feedback">please enter Sap code</div></div><div class="mb-1 col-md-2  ingredient_id"> <label class="form-label" for="formemail">Ingredient</label><input type="text" class="form-control ingre" id="postingdocumentdate' + o + '" name="Ingredient[]" required><div class="invalid-feedback">please enter the ingredient</div></div><div class="mb-1 col-md-2 "><label class="form-label" for="formemail">Rate</label><input type="text" class="form-control rate_s getValue" onkeypress="return /[0-9.]/i.test(event.key)" id="postedname' + o + '" name="Rate[]"><input type="hidden" name="_token" value="<?= csrf_token() ?>"></div><div class="mb-1 col-md-1 "> <label class="form-label" for="formemail">Qty</label><input type="text" class="form-control qtyval" onkeypress="return /[0-9.]/i.test(event.key)" id="postingdocumentcost' + o + '" name="Cost[]" required></div><div class="mb-1 col-md-1 "><label class="form-label" for="formemail">Scrap %</label><input type="text" class="form-control scrappercent  getValue" id="scrap' + o + '" name="scrap[]" onkeypress="return /[0-9.]/i.test(event.key)"></div><div class="mb-1 col-md-2 "><label class="form-label" for="formemail">Total Qty (Inc. Scrap)</label><input type="text" class="form-control getValue inscrap" id="inscrap' + o + '" name="inscrap[]" readonly></div><div class="mb-1 col-md-2 "><label class="form-label" for="formemail">Material Cost</label><input type="text" class="form-control getValue mcost" id="mcost' + o + '" name="mcost[]" readonly></div><div class="mb-1 col-md-12 col-1 text-center"><button class="btn btn-danger btn-sm ownerdelete mt-1" style="float:right" type="button"><i class="fa fa-trash"></i></button></div></div></div></fieldset></div>'); //add
                }
                else {
                    alert('You Reached the limits');
                }

            });
            $(owner_wrapper).on("click", ".ownerdelete", function(e) {
    e.preventDefault();
    $(this).closest('.add-more-ingrediant').remove();
    o--;
});

        });

        $(document).ready(function() {
        //    showcompleted()
             showtable()
            //   addrate()
            //   showrejected();
            //     showApproved();
        });
         $("#add_rate_tab").click(function() {
           showtable()
        });
         $("#pending_tab").click(function() {
            addrate()
        });
         $("#comp_tab").click(function() {
           showcompleted();
        });
         $("#rej_tab").click(function() {
            showrejected();
        });
          $("#app_tab").click(function() {
            showApproved();
        });

        function showtable(){
            table = $('#users').DataTable({
                "autoWidth": false,
                "bDestroy": true,

                'ajax': {
                    url: "{{ url('show_basics')}}",
                    // type: 'POST'
                },
                autowidth: false,

                'columns': [{
                        title: "S.no",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    { data: 'Product_Name' },
                    { data: 'division' },
                    { data: 'Fill_Volume' },
                    { data: 'Cofiguration' },
                    { data: 'Quantity' },
                    { data: 'Action' },
                ],
            });

        }

        function addrate(){
            table2 = $('#tbrmview').DataTable({
                "autoWidth": false,
                "bDestroy": true,

                'ajax': {
                    url: "{{ url('show_rmview')}}",
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
                        data: 'version',
                        visible: false
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'Action'
                    },
                ],
            });
        }
        $("#mtcode_submit").click(function(){
            var mcode=$("#mtcode").val();
            var mtype=$("#mtype").val();
            if(mcode!=""&&mtype!=""){
             $("#mtcode_submit").html("Loading...");

             $.ajax({
                 url: "{{ url('get_plant') }}",
                method: "POST",
                contentType: "application/json", // Set the content type to JSON
                processData: false,
                data: JSON.stringify({ 'mcode': mcode ,'mtype':mtype}),
                success: function(data) {
                    var results =data.result.Data;
                    console.log(results);
                    selops="<option value='' >choose</option>";
                    for(i=0;i<results.length;i++){
                        selops+='<option value="'+results[i].PLANT
                        +'">'+results[i].PLANT
                        +'</option>';
                    }
                    $("#plant_type").html(selops)
                    $("#mtcode_submit").html("Done");


                }
                });
            }else{

                 if(mcode=="")
                    $("#mtcode-error").html("Sap code is required");
                 if(mtype=="")
                    $("#mtype-error").html("Material Type  is required");
            }

        });
        $("#clsbutton").click(function(){
            $('#rmratemodel1').modal('show');
            $('#postedname0').val('');
            // $('#postingdocumentcost0').val('');
            $('#postingdocumentdate0').val('');
            $(".getValue").removeAttr('readonly');
            $(".mcost").attr('readonly');
            $(".inscrap").attr('readonly');
            $('.ownerdelete').css('display', 'block');
            // $('.add_ingrediant').prop('hidden', false);

            $(".add-more-ingrediant").html('');
        });
        $("#submitplant").click(function(){
            $(".add-more-ingrediant").html('');
            var mcode=$("#mtcode").val();
            var plantype=$("#plant_type").val();
            if(mcode!=""&&plantype!=""){
            $("#submitplant").html("loading..");

                $.ajax({
                 url: "{{ url('get_price') }}",
                method: "POST",
                contentType: "application/json", // Set the content type to JSON
                processData: false,
                data: JSON.stringify({ 'mcode': mcode ,'plantype':plantype}),
                success: function(data) {
                    $("#submitplant").html("Submit");
                    $('#rmratemodel1').modal('show');
                    $('#rmratemodel').modal('hide');
                    // $('.add_ingrediant').prop('hidden', true);
                    var results =data.result.Data;
                    // console.log(results[0].QUANTITY);
                    console.log(results);
                    $('#postedname0').val(results[0]['NET PRICE']);
                    $('#postingdocumentdate0').val(results[0]['MATERIAL NAME']);
                    // $('#postingdocumentcost0').val(results[0].QUANTITY);

                    $('#postingdocumentdate0').prop('readonly',true);
                    $('#postedname0').prop('readonly',true);
                    // $('#postingdocumentcost0').attr('readonly',true);
                        var addingrediant_wrapper = $(".add-more-ingrediant");

                    for(i=1;i<results.length;i++){
                        $(addingrediant_wrapper).append('<div class="form-group col-md-12 add-more-ingrediant remove_div"> <br><fieldset style="width:720px"><div class="p-3"> <div class="inner row"><div class="mb-1 col-md-3 col-3 ingredient_id"> <label class="form-label" for="formemail">Ingredient</label><input type="text" class="form-control ingre getValue"  id="postingdocumentdate'+i+'"   name="Ingredient[]" value="'+results[i]['MATERIAL NAME']+'" readonly required><div class="invalid-feedback">please enter the ingredient</div></div><div class="mb-1 col-md-3 col-3"><label class="form-label" for="formemail">Rate</label><input type="text" class="form-control getValue" onkeypress="return /[0-9.]/i.test(event.key)" id="postedname'+i+'" name="Rate[]" value="'+results[i]['NET PRICE']+'" readonly><input type="hidden" name="_token" value="<?= csrf_token() ?>"></div><div class="mb-1 col-md-3 col-3"> <label class="form-label" for="formemail">Qty</label><input type="text" class="form-control " onkeypress="return /[0-9.]/i.test(event.key)" id="postingdocumentcost'+i+'"  name="Cost[]" required></div><div class="mb-1 col-md-3 col-3"><label class="form-label" for="formemail">Scrap %</label><input type="text" class="form-control getValue" id="scrap'+i+'" name="scrap[]" onkeypress="return /[0-9.]/i.test(event.key)"></div></div></div></fieldset><button  class="btn btn-danger ownerdelete mt-1" type="button"><i class="fa fa-trash"></i></button></div>')

                    }
                    $('.ownerdelete').css('display', 'none');

                }

                });
            }else{

                    if(mcode=="")
                        $("#mtcode-error").html("Sap code is required");
                    if(plantype=="")
                        $("#plant-error").html("Plant Type  is required");
                }
                });

        function edit(t1) {
            $("#mtcode-error").html(" ");
            $("#plant-error").html(" ");
            $('#postedname0').val('');
            $('#postingdocumentdate0').val('');
            $('#formcheck')[0].reset();
            // $('#postingdocumentcost0').val('');
            $(".getValue").removeAttr('readonly');
            $(".mcost").attr('readonly');
            $(".inscrap").attr('readonly');
            $('.ownerdelete').css('display', 'block');
            $(".add-more-ingrediant").html('');
            // $('.add_ingrediant').prop('hidden', false);
            $.ajax({
                url: "{{ url('editrm')}}",
                // method: "POST",
                data: {
                    id: t1
                },
                dataType: "JSON",
                success: function(data) {
                    $('#pname').val(data['basic']['Product_name']);
                    $('#pro_id').val(data['basic']['pro_id']);
                    $('#pid').val(data['basic']['id']);
                    $('#pname1').val(data['basic']['Product_name']);
                    $('#pro_id1').val(data['basic']['pro_id']);
                    $('#pid1').val(data['basic']['id']);

                    // $('.previous_v').css('display','none');

                    if(data.get_rm_cost[0] !=""){

                        // $('.previous_v').css('display','block');

                        // $('#postingdocumentdate0').val(data['get_rm_cost'][0]['Ingredient']);
                        // $('#postedname0').val(data['get_rm_cost'][0]['rate']);
                        // $('#postingdocumentcost0').val(data['get_rm_cost'][0]['cost']);

                        // var addingrediant_wrapper = $(".add-more-ingrediant");
                        // var i = 1;
                        // for (i = 1; i < data['count']; i++) {
                        //     $(addingrediant_wrapper).append('<div class="form-group pt-4 col-md-12 add-more-ingrediant mus"><fieldset><div class="p-3"><div class="inner row"><div class="mb-1 col-md-6 col-6"><label class="form-label" for="formemail">Ingredient</label><input type="test" class="form-control"  value=' + data['get_rm_cost'][i]['Ingredient'] + '  id="editIngredient"  name="Ingredient[]"></div><div class="mb-1 col-md-3 col-3"><label class="form-label" for="formemail">Rate</label><input type="text" class="form-control" id="editRate"   value=' + data['get_rm_cost'][i]['rate'] + ' name="Rate[]"><input type="hidden" name="_token" value="<?= csrf_token() ?>"></div><div class="mb-1 col-md-3 col-3"><label class="form-label" for="formemail">Cost</label><input type="test" value=' + data['get_rm_cost'][i]['cost'] + ' class="form-control" id="editcostval" name="costval[]"></div></div></fieldset><button class="btn btn-danger ownerdelete mt-1" type="button"><i class="fa fa-trash"></i></button></div>'); //add input box
                        // }
                    }
                }
            });
        }

        function editshow(id) {
            $.ajax({
                url: "{{ url('editrm')}}",
                // method: "POST",
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
            table3 = $('#scrapview').DataTable({
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
                    },
                     {
                        data: 'scrap'
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

        function showcompleted(){
            table4 = $('#covert').DataTable({
                "bDestroy": true,
                'ajax':{
                    url:'{{url("fetch_completed_rm")}}',
                },
                'columns':[
                    {data: 'DT_RowIndex'},
                    {data: 'Product_name', name: 'Product_name'},
                    {data: 'division', name: 'division'},
                    {data: 'volume', name: 'volume'},
                    {data: 'case_configuration', name: 'case_configuration'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'version', name: 'version',visible: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        }
        function showApproved(){
            table7 = $('#approved_items').DataTable({
                "bDestroy": true,
                'ajax':{
                    url:'{{url("fetch_completed_rm_rejected")}}',
                    data:{
                    'app':'app'
                },
                },

                'columns':[
                    {data: 'DT_RowIndex'},
                    {data: 'Product_name', name: 'Product_name'},
                    {data: 'division', name: 'division'},
                    {data: 'volume', name: 'volume'},
                    {data: 'case_configuration', name: 'case_configuration'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'version', name: 'version',visible: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        }
        function showrejected(){
            table4 = $('#rejected_items').DataTable({
                "bDestroy": true,
                'ajax':{
                    url:'{{url("fetch_completed_rm_rejected")}}',
                },
                'columns':[
                    {data: 'DT_RowIndex'},
                    {data: 'Product_name', name: 'Product_name'},
                    {data: 'division', name: 'division'},
                    {data: 'volume', name: 'volume'},
                    {data: 'case_configuration', name: 'case_configuration'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'version', name: 'version',visible: false},
                    {data: 'Rejected', name: 'Rejected'},
                    {data: 'remarks', name: 'remarks'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        }


        $('#confirm_modal').on('hidden.bs.modal', function() {
            $("#purchase").prop("disabled",false);
            $("#operation").prop("disabled",false);

            // $('#myModal').removeData('bs.modal')
        });
        $("#update_rm").click(function() {
            var formData = new FormData($('#formupdate')[0]);
            $.ajax({
                method: "POST",
                url: "{{ url('update_rm_cost')}}",
                contentType: false,
                processData: false,
                data: formData,
                success: function() {
                    $("#formupdate")[0].reset();
                    $('#rejectedmodal').modal('hide');
                    // $('#confirm_modal').modal('hide');
                    Swal.fire(
                        'Success!',
                        " <p style='color:green'>Updated Successfully</p>",
                    )
                    addrate();
                    showtable();
                    showcompleted();
                    showrejected();
                    showApproved();
                },
            });
        });


        function isArrayUnique(arr) {
    var seen = {};

    for (var i = 0; i < arr.length; i++) {
        var item = arr[i];
        if (item === null || item === undefined || item === "") {
            continue; // Skip empty values
        }
        if (seen[item]) {
            return false; // Duplicate found
        } else {
            seen[item] = true;
        }
    }

    return true; // Array is unique
}


        $("#formadd").submit(function(e) {
            e.preventDefault();
            $("#operation").html('Yes,Send to Operation Team');
            var input_field =  $("input[name='Ingredient[]']").length;
            var ingredient_array = [];
            var sap= [];
               $("input[name='sapcode[]']").each(function() {
                var value=$(this).val();
                sap.push(value);
               });
               var rate= [];
               $("input[name='Rate[]']").each(function() {
                var value=$(this).val();
                rate.push(value);
               });
               var ingredient= [];
               $("input[name='Ingredient[]']").each(function() {
                var value=$(this).val();
                ingredient.push(value);
               });
               var qnty= [];
               $("input[name='Cost[]']").each(function() {
                var value=$(this).val();
                qnty.push(value);
               });
               var scrap= [];
               $("input[name='scrap[]']").each(function() {
                var value1=$(this).val();
                scrap.push(value1);
               });
                var count =rate.length;

                var isUnique = isArrayUnique(sap);

            if (isUnique) {
                if((jQuery.inArray('',scrap) == -1) && (jQuery.inArray('',rate) == -1)){
                    $("#operation").html('Yes,Save Ingredients Details');
                 }
                 if((jQuery.inArray('',rate) == -1)){
                    //   $("#purchase").prop("disabled",true);
                        // $("#operation").prop("disabled",false);
                                if (Math.min(...rate) <= 0) {
                                    $("#purchase").click();
                                } else {
                                    $("#operation").click();
                                }
                                $("#operation").html('Yes, Save Ingredients Details');
                        // $("#operation").click();
                 }else if((jQuery.inArray('',scrap) == -1) && (jQuery.inArray('',rate) == -1)|| (jQuery.inArray('',scrap) == -1)||(jQuery.inArray('',scrap) != -1)){
                    // $("#purchase").prop("disabled",false);
                    //     $("#operation").prop("disabled",true);
                    $("#purchase").click();
                 }
            } else {
                toastr.error("Duplicate Sapcode Entered");
            }



        });


        $("#purchase").click(function() {
            $("#rmcost").attr("disabled",true);
            var formData = new FormData($('#formadd')[0]);
            $.ajax({
                    method: "POST",
                    url: "{{ url('save_rmcost')}}",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(data) {
                        $('#rmratemodel').modal('hide');
                        $("#formadd")[0].reset();
                        $('#confirm_modal').modal('hide');
                        $("#rmcost").attr("disabled",false);
                        // table.ajax.reload();
                        // Swal.fire('Success!',
                        //     " <p style='color:green'>Data Successfully Sent to Purchase Team</p>"
                        // )
                        console.log(data.message);
                        Swal.fire('Success!',
                            " <p style='color:green'>"+data.message+" </p>"
                        )
                        addrate();
                        showtable();
                        showcompleted();
                        showrejected();
                        showApproved();
                    }
            })
        });

        $("#operation").click(function() {
            $("#rmcost").attr("disabled",true);
            var formData = new FormData($('#formadd')[0]);
            $.ajax({
                method: "POST",
                url: "{{ url('send_operation_team')}}",
                contentType: false,
                processData: false,
                data: formData,
                success: function() {
                    $("#rmcost").attr("disabled",false);
                    $("#formadd")[0].reset();
                    $('#rmratemodel').modal('hide');
                    $('#confirm_modal').modal('hide');
                    var html_c=$("#operation").html();

                        Swal.fire(
                        'Success!',
                        " <p style='color:green'>Data Successfully Sent to Operation Team</p>",
                    )


                    addrate();
                    showtable();
                    showcompleted();
                    showrejected();
                    showApproved();
                },
            })
        });
        function rejected_modal(id,st){
            $("#update_rm").removeAttr('hidden');
            if(st==1){
              $("#update_rm").prop('hidden', true);
            }
            $.ajax({
                        method: "GET",
                        url: "{{ url('get_added_scrap')}}",
                        data:{id:id},
                        success: function(response) {
                            var arr= JSON.parse(response);
                            console.log(arr.data);
                            var opt='';
                           for(i=0;i<arr.data.length;i++) {
                            var scrap=arr.data[i].Scrap;
                            if(arr.data[i].p_scrap_approval == 2){
                             var readonly="";
                            }else{
                                var readonly="readonly";

                            }

                           opt+=' <div class="edit_inner_row row"><div class="mb-1 col-md-2  ">\
                            <input type="hidden" name="edit_pro_id" value="'+arr.data[i].pro_id+'">\
                            <input type="hidden" name="edit_rm_id[]" value="'+arr.data[i].id+'">\
                                <label class="form-label" for="formemail">Ingredient</label>\
                                <input type="text" class="form-control ingre" id="" name="edit_ingredient[]" value="'+arr.data[i].Ingredients+'" required readonly>\
                                <div class="invalid-feedback">please enter the ingredient</div>\
                            </div>\
                            <div class="mb-1 col-md-2 ">\
                                <label class="form-label" for="formemail">Rate</label>\
                                <input type="text" class="form-control getValue rate_s1" id="" name="edit_rate[]" value="'+arr.data[i].rate+'" onkeypress="return /[0-9.]/i.test(event.key)" readonly>\
                                <input type="hidden" name="_token" value="<?= csrf_token() ?>" >\
                            </div>\
                            <div class="mb-1 col-md-2 ">\
                                <label class="form-label" for="formemail">Qty (ml/ gm)</label>\
                                <input type="text" class="form-control getValue qtyval1" id="" name="edit_qty[]"  required value="'+arr.data[i].qty+'" onkeypress="return /[0-9.]/i.test(event.key)" readonly>\
                            </div>\
                            <div class="mb-1 col-md-1 ">\
                                <label class="form-label" for="formemail">Scrap%</label>\
                                <input type="text" class="form-control getValue scrappercent1" id="" value="'+scrap+'" name="edit_scrap[]" '+readonly+' onkeypress="return /[0-9.]/i.test(event.key)">\
                            </div>\
                               <div class="mb-1 col-md-3">\
                                <label class="form-label" for="formemail">Total Qty (Inc. Scrap)</label>\
                                <input type="text" class="form-control  inscrap1"  name="edit_inscrap[]"  value="'+arr.data[i].inscrap+'" readonly>\
                            </div>\
                            <div class="mb-1 col-md-2">\
                            <label class="form-label" for="formemail">Material Cost</label>\
                            <input type="text" class="form-control  mcost1" name="edit_mcost[]" value="'+arr.data[i].mcost+'" readonly>\
                            </div></div>';
                            $("#rejected_values").html(opt);
                           }
                        },
                    })
        }
        function open_modal(id){
            $('#rmscrapmodel').modal('show');
            table5 = $('#rmscrapview').DataTable({
                "autoWidth": false,
                "bDestroy": true,
                'ajax': {
                    url: "{{ url('get_added_scrap')}}",
                    data: {
                        id: id,'comp':'comp',
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
                     {
                        data: 'inscrap'
                    },
                     {
                        data: 'mcost'
                    },

                ],
            });
        }

        // $('#capture').click(function(){

        //     var t11 = $('#pid').val();
        //     $.ajax({
        //         url: "{{ url('editrm')}}",
        //         data: {
        //             id: t11
        //         },
        //         dataType: "JSON",
        //         success: function(data) {

        //             if(data.get_rm_cost[0] !=""){

        //                 $('.previous_v').css('display','block');

        //                 $('#postingdocumentdate0').val(data['get_rm_cost'][0]['Ingredient']);
        //                 $('#postedname0').val(data['get_rm_cost'][0]['rate']);
        //                 $('#postingdocumentcost0').val(data['get_rm_cost'][0]['cost']);

        //                 var addingrediant_wrapper = $(".add-more-ingrediant");
        //                 var i = 1;
        //                 for (i = 1; i < data['count']; i++) {
        //                     $(addingrediant_wrapper).append('<div class="form-group pt-4 col-md-12 add-more-ingrediant mus"><fieldset><div class="p-3"><div class="inner row"><div class="mb-1 col-md-6 col-6"><label class="form-label" for="formemail">Ingredient</label><input type="test" class="form-control"  value=' + data['get_rm_cost'][i]['Ingredient'] + '  id="editIngredient"  name="Ingredient[]"></div><div class="mb-1 col-md-3 col-3"><label class="form-label" for="formemail">Rate</label><input type="text" class="form-control" id="editRate"   value=' + data['get_rm_cost'][i]['rate'] + ' name="Rate[]"><input type="hidden" name="_token" value="<?= csrf_token() ?>"></div><div class="mb-1 col-md-3 col-3"><label class="form-label" for="formemail">Cost</label><input type="test" value=' + data['get_rm_cost'][i]['cost'] + ' class="form-control" id="editcostval" name="cost[]"></div></div></fieldset><button class="btn btn-danger ownerdelete mt-1" type="button"><i class="fa fa-trash"></i></button></div>'); //add input box
        //                 }
        //             }
        //         }
        //     });
        // })
    </script>

</body>

</html>
