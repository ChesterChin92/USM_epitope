<?php
session_start();
include '../includes/emicodb_conn.php';
require_once('../includes/helpers.php');
check_session();
render('header');
render('navigation');
?>

<!-- page content -->
<div class="right_col" role="main">

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

                <div class="row x_title">
                    <div class="col-md-6">
                        <h3><?php

                            if (isset($_GET['order_ref'])){
                                $order_ref = $_GET['order_ref'];
                                echo $order_ref;

                            }

                            else{
                                echo $_SESSION['order_ref'];
                            }

                            ?>

                            <small></small>
                        </h3>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    -
                </div>

                <!--//Table code here.-->
                <div class="col-sm-12">
                    <table id="datatable" class="table table-striped table-bordered dataTable no-footer"
                           role="grid"
                           aria-describedby="datatable_info">
                        <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1"
                                colspan="1"
                                aria-sort="ascending" aria-label="Name: activate to sort column descending"
                                style="width: 46px;">CTNS_NO_ID
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Position: activate to sort column ascending" style="width: 46px;">
                                STOCK_CODE
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Office: activate to sort column ascending" style="width: 46px;">
                                CUSTOMER_CODE
                            </th>

                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Age: activate to sort column ascending" style="width: 146px;">PRODUCT_DESC
                            </th>


                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Age: activate to sort column ascending" style="width: 146px;">COLOUR
                            </th>


                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Age: activate to sort column ascending" style="width: 146px;">QTY CTN
                            </th>

                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Age: activate to sort column ascending" style="width: 146px;">GROSS WEIGHT
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Age: activate to sort column ascending" style="width: 146px;">NET WEIGHT
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Age: activate to sort column ascending" style="width: 146px;">NO OF CTN
                            </th>


                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Start date: activate to sort column ascending" style="width: 46px;">
                                FG
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Salary: activate to sort column ascending" style="width: 46px;">LOAD
                            </th>

                        </tr>
                        </thead>


                        <tbody>



                        <?php


                        //Change to a much secure solution in future

                        if (isset($_GET['order_ref'])){
                            $order_ref = $_GET['order_ref'];
                            $_SESSION['order_ref'] = $_GET['order_ref'];

                        }
                        else{
                            $order_ref = $_SESSION['order_ref'];
                        }

                        if (isset($_GET['sort_date'])){
                            $sort_date = $_GET['sort_date'];
                            $_SESSION['sort_date'] = $_GET['sort_date'];

                        }
                        else{
                            //Do not set
                            $sort_date = "";
                        }



                        echo "</br>";
                        var_dump($_SESSION);
                        echo "</br>";


                        echo "</br>";

                        $list_all = "SELECT * FROM emico.checklst_dtl_tbl WHERE emico.checklst_dtl_tbl.FG_DATE = '".$sort_date."'  OR emico.checklst_dtl_tbl.LOAD_DATE = '".$sort_date."';;";
                        echo $list_all;
                        $rsEventList = mysqli_query($con, $list_all)
                        or die(mysqli_error($con));

                        while ($row = mysqli_fetch_assoc($rsEventList)) {

                            $ctns_no_id = $row['CTNS_NO_ID'];
                            $stock_code = $row['STOCK_CODE'];
                            $customer_code = $row['CUSTOMER_CODE'];
                            $ctns_no = $row['PRODUCT_DESC'];

                            $color = $row['COLOUR'];
                            $qty_ctn = $row['QTY_CTN'];
                            $gross_weight = $row['GROSS_WEIGHT'];
                            $net_weight = $row['NET_WEIGHT'];
                            $no_of_ctn = $row['NO_OF_CTN'];

                            $fg = $row['FG_DTL'];
                            $load = $row['LOAD_DTL'];


                            echo "<tr role=\"row\" class=\"odd\">";
//                                    echo "<td class=\"sorting_1\">" . $entryid . "</td>";
                            echo "<td>" . $ctns_no_id . "</td>";
                            echo "<td>" . $stock_code . "</td>";
                            echo "<td>" . $customer_code . "</td>";
                            echo "<td>" . $ctns_no . "</td>";

                            echo "<td>" . $color . "</td>";
                            echo "<td>" . $qty_ctn . "</td>";
                            echo "<td>" . $gross_weight . "</td>";
                            echo "<td>" . $net_weight . "</td>";
                            echo "<td>" . $no_of_ctn . "</td>";


                            echo "<td>" . $fg . "</td>";
                            echo "<td>" . $load . "</td>";
                            echo "</tr>";
                        }

                        ?>

                        <!---->
                        <!--                                <tr role="row" class="odd">-->
                        <!--                                    <td class="sorting_1">Airi Satou</td>-->
                        <!--                                    <td>Accountant</td>-->
                        <!--                                    <td>Tokyo</td>-->
                        <!--                                    <td>33</td>-->
                        <!--                                    <td>2008/11/28</td>-->
                        <!--                                    <td>$162,700</td>-->
                        <!--                                </tr>-->

                        </tbody>
                    </table>
                </div>


                <div class="clearfix"></div>
            </div>
        </div>

    </div>
    <br/>
</div>
<!-- /page content -->

<!-- footer content -->
<footer>
    <div class="pull-right">
        Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>

<script src="../js/bootstrap.min.js"></script>

<!-- bootstrap progress js -->
<script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
<!-- icheck -->
<script src="../js/icheck/icheck.min.js"></script>

<script src="../js/custom.js"></script>


<!-- Datatables -->
<!-- <script src="js/datatables/js/jquery.dataTables.js"></script>
<script src="js/datatables/tools/js/dataTables.tableTools.js"></script> -->

<!-- Datatables-->
<script src="../js/datatables/jquery.dataTables.min.js"></script>
<script src="../js/datatables/dataTables.bootstrap.js"></script>
<script src="../js/datatables/dataTables.buttons.min.js"></script>
<script src="../js/datatables/buttons.bootstrap.min.js"></script>
<script src="../js/datatables/jszip.min.js"></script>
<script src="../js/datatables/pdfmake.min.js"></script>
<script src="../js/datatables/vfs_fonts.js"></script>
<script src="../js/datatables/buttons.html5.min.js"></script>
<script src="../js/datatables/buttons.print.min.js"></script>
<script src="../js/datatables/dataTables.fixedHeader.min.js"></script>
<script src="../js/datatables/dataTables.keyTable.min.js"></script>
<script src="../js/datatables/dataTables.responsive.min.js"></script>
<script src="../js/datatables/responsive.bootstrap.min.js"></script>
<script src="../js/datatables/dataTables.scroller.min.js"></script>

<script src="../js/moment/moment.min.js"></script>
<script src="../js/datepicker/daterangepicker.js"></script>


<!-- pace -->
<script src="../js/pace/pace.min.js"></script>
<script>
    var handleDataTableButtons = function () {
            "use strict";
            0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
                dom: "Bfrtip",
                buttons: [{
                    extend: "copy",
                    className: "btn-sm"
                }, {
                    extend: "csv",
                    className: "btn-sm"
                }, {
                    extend: "excel",
                    className: "btn-sm"
                }, {
                    extend: "pdf",
                    className: "btn-sm"
                }, {
                    extend: "print",
                    className: "btn-sm"
                }],
                responsive: !0
            })
        },
        TableManageButtons = function () {
            "use strict";
            return {
                init: function () {
                    handleDataTableButtons()
                }
            }
        }();
</script>
<script type="text/javascript">
    $(document).ready(function () {

        $('#datatable').dataTable({"order": []});

        dataTable.on( 'draw', function () {
            alert( 'Table redrawn' );
        } );

        $('#datatable-keytable').DataTable({
            keys: true
        });
        $('#datatable-responsive').DataTable();
        $('#datatable-scroller').DataTable({
            ajax: "js/datatables/json/scroller-demo.json",
            deferRender: true,
            scrollY: 380,
            scrollCollapse: true,
            scroller: true
        });
        var table = $('#datatable-fixed-header').DataTable({
            fixedHeader: true
        });
    });
    TableManageButtons.init();
</script>

<!-- /datepicker -->
<!-- /footer content -->
</body>

</html>
