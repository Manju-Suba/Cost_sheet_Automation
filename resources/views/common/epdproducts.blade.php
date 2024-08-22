<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8" />
    <title>Cost Sheet Automation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/h_logo.png">

    <!-- Bootstrap Css -->
    <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <!-- datatable -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

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
                                        <div class="col">
                                            <div class="my-4 text-center">
                                                <h5 class="text-muted">EPD details</h5>
                                            </div>

                                            <!-- Modal -->
                                             <!-- //edit epd model -->
                                             <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" id="edit_epdmodal" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    <div class="col-12">
                                                                        <form id="exist-formedit" enctype="multipart/form-data">
                                                                            <div class="row">
                                                                                <h5>Existing Product Information</h5>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label for="material_code" class="form-label">Material Code</label>
                                                                                    <input type="text" class="form-control" id="edit_mcode" disabled>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label for="noofpiece" class="form-label">No of Pieces per Case</label>
                                                                                    <input type="text" class="form-control" id="edit_pieces_pcase" disabled>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label for="exdistribution_channel" class="form-label">Distribution Channel</label>
                                                                                    <select class="form-control" name="edit_exdistribution_channel" id="edit_exdistribution_channel" disabled>
                                                                                        <option value="">---</option>
                                                                                        @foreach ($dist_channel as $item)
                                                                                        <option value="{{ $item->id }}">{{ $item->dist_name }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <!-- <div class="col-md-3">
                                                                                    <label for="" class="form-label">MRP Per Piece</label>
                                                                                    <input type="text" class="form-control" id="edit_mrp_price" disabled>
                                                                                </div> --> 
                                                                            </div>
                                                                            <br>

                                                                            <h5 style="display: inline;">Primary Frieght & Schemes</h5>
                                                                            <div id="editepdPrimaryLocation" class="editepdPrimaryLocation">
                                                                                <div class="row edit-epd-primary-location" id="">
                                                                                    <hr class="mt-4">
                                                                                    <div class="col-md-6 from_prim_loc">
                                                                                        <label for="inputEmail4" class="form-label">From Location</label>
                                                                                        <input type="text" class="form-control" id="editprimfromlocation" name="edit_primaryfrom_location[]" disabled>
                                                                                    </div>
                                                                                    <div class="col-md-6 to_prim_loc">
                                                                                        <label for="inputEmail4" class="form-label">To Location</label>
                                                                                        <input type="text" class="form-control primLocation" id="editprimtolocation" name="edit_primaryto_location[]" disabled>
                                                                                    </div>
                                                                                    <div class="col-md-3 ret_div">
                                                                                        <label for="inputEmail4" class="form-label">Retailer Margin % </label>
                                                                                        <input type="text" class="form-control primLocation" id="editexretailermargin" name="editretailer_margin[]" disabled>
                                                                                    </div>
                                                                                    <div class="col-md-3 prim_div">
                                                                                        <label for="inputEmail4" class="form-label"> Primary Scheme %</label>
                                                                                        <input type="text" class="form-control primLocation" id="editexprimaryscheme" name="editprimary_scheme[]" disabled>
                                                                                    </div>
                                                                                    <div class="col-md-3 rs_div">
                                                                                        <label for="inputEmail4" class="form-label">RS Margin %</label>
                                                                                        <input type="text" class="form-control primLocation" id="editexrsmargin" name="editrs_margin[]" disabled>
                                                                                    </div>
                                                                                    <div class="col-md-3 ss_div">
                                                                                        <label for="inputEmail4" class="form-label">SS Margin %</label>
                                                                                        <input type="text" class="form-control primLocation" id="editexssmargin" name="editss_margin[]" disabled>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <br>

                                                                            <h5 style="display: inline;">Secondary Frieght (Used Only for Data capturing)</h5>
                                                                            <br>
                                                                            <hr>
                                                                            <div class="editepdSecLocation" id="editepdSecLocation">
                                                                                <div class="row edit-epd-secondary-location">
                                                                                    <div class="col-md-6 from_sec_loc">
                                                                                        <label for="inputEmail4" class="form-label">From Location</label>
                                                                                        <input type="text" class="form-control primLocation" id="editseconfromlocation" name="editsecondaryfrom_location[]" disabled>
                                                                                    </div>
                                                                                    <div class="col-md-6 to_sec_loc">
                                                                                        <label for="inputEmail4" class="form-label">To Location</label>
                                                                                        <input type="text" class="form-control primLocation" id="editsecontolocation" name="editsecondaryto_location[]" disabled>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-6 p-3">
                                                                                    <button type="button" id="close1" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
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

                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-hover" id="epd_approved" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>S.NO</th>
                                                        <th>Material Code</th>
                                                        <th>Division</th>
                                                        <th>No of Pcs</th>
                                                        <!-- <th>MRP Per Piece</th> -->
                                                        <th>Primary Locations</th>
                                                        <th>Secondary Locations</th>
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
                    <!-- end row -->

                    {{-- delete pop up  --}}
                    <div class="modal fade" id="confirm_modal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="exampleModalToggleLabel">Are you sure?</h4>
                              {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                            </div>
                            <div class="modal-body">
                                <input type="text" value="" id="hid_id" hidden>
                                <p>Do you really want to delete these records? This process cannot be undone.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" id="delete_confirm" onclick= "delete_uom();">Delete</button>
                            </div>
                          </div>
                        </div>
                    </div>
                    {{-- delete pop up  --}}
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

 <script src="../assets/js/app.js"></script>
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(function () {
        table = $('#epd_approved').DataTable({
            "autoWidth": false,
            'ajax': {
                url: "{{ url('exists_product')}}",
            },
            columns: [{
                    data: 'DT_RowIndex'
                },
                {
                    data: 'material_code',
                    name: 'material_code'
                },
                {
                    data: 'division',
                    name: 'division'
                },
                {
                    data: 'pieces_per_case',
                    name: 'pieces_per_case'
                },
                // {
                //     data: 'mrp_piece',
                //     name: 'mrp_piece'
                // },
                {
                    data: 'prim_location',
                    name: 'prim_location'
                },
                {
                    data: 'sec_location',
                    name: 'sec_location'
                },
                {
                    data:'action'
                }
            ]
        });
    });


    function edit_epddetails(id) {
        $(".expremove_div").html(" ");
        $(".exremove_div").html("");
        $.ajax({
            url: '{{ 'edit_epddetails' }}',
            type: 'GET',
            data: {
                id: id,
            },
            success: function(data) {
                $('#edit_epdmodal').modal('show');

                $('#hid_id').val(data.result.id);
                $('#edit_mcode').val(data.result.material_code);
                $('#edit_pieces_pcase').val(data.result.pieces_per_case);
                $('#edit_exdistribution_channel').val(data.result.distribution_channel);
                // $('#edit_mrp_price').val(data.result.mrp_piece);

                $('#editprimfromlocation').val(data.prim1[0].location);
                $('#editprimtolocation').val(data.prim2[0].location);
                $('#editexretailermargin').val(data.prim1[0].retailer_margin);
                $('#editexprimaryscheme').val(data.prim1[0].primary_scheme);
                $('#editexrsmargin').val(data.prim1[0].rs_margin);
                $('#editexssmargin').val(data.prim1[0].ss_margin);

                $('#editseconfromlocation').val(data.second1[0].location);
                $('#editsecontolocation').val(data.second2[0].location);

                for(i=1;i<data.pcount;i++){
                    var frmlocate = data.prim1[i].location;
                    var tolocate = data.prim2[i].location;
                    var retailermar = data.prim1[i].retailer_margin;
                    var rsch = data.prim1[i].primary_scheme;
                    var rsmar = data.prim1[i].rs_margin;
                    var ssmar = data.prim1[i].ss_margin;
                    $('#editepdPrimaryLocation').append(' <div class="row expremove_div edit-epd-primary-location"><hr class="mt-4"><div class="col-md-6 from_prim_loc"><label class="form-label">From Location</label><input type="text" class="form-control exprimLocation" id="editprimfromlocation" name="edit_primaryfrom_location[]" value='+frmlocate+' disabled></div><div class="col-md-6 to_prim_loc"><label class="form-label">To Location</label><input type="text" class="form-control exprimLocation" id="editprimtolocation" name="edit_primaryto_location[]" value='+tolocate+' disabled></div><div class="col-md-3 exret_div"><label class="form-label">Retailer Margin % </label><input type="text" class="form-control exprimLocation" onkeypress="return /[0-9.]/i.test(event.key)" id="editexretailermargin" name="editretailer_margin[]" value='+retailermar+' disabled></div><div class="col-md-3 exprim_div"><label class="form-label">Primary Scheme %</label><input type="text" class="form-control exprimLocation" onkeypress="return /[0-9.]/i.test(event.key)" id="editexprimaryscheme" name="editprimary_scheme[]" value='+rsch+' disabled></div><div class="col-md-3 exrs_div"><label class="form-label">RS Margin %</label><input type="text" class="form-control exprimLocation" id="editexrsmargin" onkeypress="return /[0-9.]/i.test(event.key)" name="editrs_margin[]" value='+rsmar+' disabled></div><div class="col-md-3 ss_div"><label class="form-label">SS Margin %</label><input type="text" class="form-control exprimLocation"  onkeypress="return /[0-9.]/i.test(event.key)" id="editexssmargin" name="editss_margin[]" value='+ssmar+' disabled></div><div id="delete"></div></div>')
                }

                for(j=1;j<data.scount;j++){
                    var sfrom = data.second1[j].location;
                    var sto = data.second2[j].location;
                    $('#editepdSecLocation').append('<div class="row exremove_div edit-epd-secondary-location"><div class="col-md-6 from_sec_loc"><label class="form-label">From Location</label><input type="text" class="form-control exprimLocation" id="editseconfromlocation" name="editsecondaryfrom_location[]" value='+sfrom+' disabled></div><div class="col-md-6 to_sec_loc"><label class="form-label">To Location</label><input type="text" class="form-control exprimLocation" id="editsecontolocation" name="editsecondaryto_location[]" value='+sto+' disabled></div></div>');
                }

            }
        });
    }

</script>

</body>

</html>
