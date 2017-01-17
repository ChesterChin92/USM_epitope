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

                            if (isset($_GET['order_ref'])) {
                                $order_ref = $_GET['order_ref'];
                                echo $order_ref;

                            } else {
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
                                style="width: 46px;">FG COUNT
                            </th>
                            <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1"
                                colspan="1"
                                aria-sort="ascending" aria-label="Name: activate to sort column descending"
                                style="width: 46px;">Order Ref
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
                                aria-label="Age: activate to sort column ascending" style="width: 146px;">Total QTY CTN
                            </th>

                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Age: activate to sort column ascending" style="width: 146px;">Total GROSS WEIGHT
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Age: activate to sort column ascending" style="width: 146px;">Total NET WEIGHT
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Age: activate to sort column ascending" style="width: 146px;">Total NO OF CTN
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

                        if (isset($_GET['order_ref'])) {
                            $order_ref = $_GET['order_ref'];
                            $_SESSION['order_ref'] = $_GET['order_ref'];

                        } else {
                            $order_ref = $_SESSION['order_ref'];
                        }

                        if (isset($_GET['sort_date'])) {
                            $sort_date = $_GET['sort_date'];
                            $_SESSION['sort_date'] = $_GET['sort_date'];

                        } else {
                            //Do not set
                            $sort_date = "";
                        }


                        echo "</br>";
                        var_dump($_SESSION);
                        echo "</br>";


                        echo "</br>";


                        echo isset($_POST);
                        if (isset($_SESSION)) {
                            if (isset($_SESSION['time']) <> "") {


                                echo "<b>SETTING:</b><br><b>";
                                var_dump($_SESSION);
                                echo "</b><br>";


//                                $newupdate = "SELECT COUNT(`checklst_dtl_tbl`.`ENTRY_ID`), `checklst_dtl_tbl`.`CTNS_NO_ID`, `checklst_dtl_tbl`.`NO`, `checklst_dtl_tbl`.`STOCK_CODE`, `checklst_dtl_tbl`.`CUSTOMER_CODE`, `checklst_dtl_tbl`.`PRODUCT_DESC`, `checklst_dtl_tbl`.`COLOUR`, `checklst_dtl_tbl`.`FOB_COST`, `checklst_dtl_tbl`.`SO`, `checklst_dtl_tbl`.`EXT`, sum(`checklst_dtl_tbl`.`QTY_CTN`), sum(`checklst_dtl_tbl`.`GROSS_WEIGHT`), sum(`checklst_dtl_tbl`.`NET_WEIGHT`), `checklst_dtl_tbl`.`NO_OF_CTN` FROM `emico`.`checklst_dtl_tbl` INNER JOIN checklist_entry ON checklist_entry.status_msg = checklst_dtl_tbl.ORDER_REF WHERE checklist_entry.archive=0 AND FG_DTL <> '' AND `checklst_dtl_tbl`.`ORDER_REF` = 'MUN-C02(1601)' Group by STOCK_CODE";
                                $time_only = "SELECT COUNT(`checklst_dtl_tbl`.`ENTRY_ID`), `checklst_dtl_tbl`.`CTNS_NO_ID`, `checklst_dtl_tbl`.`NO`, `checklst_dtl_tbl`.`STOCK_CODE`, `checklst_dtl_tbl`.`CUSTOMER_CODE`, `checklst_dtl_tbl`.`PRODUCT_DESC`, `checklst_dtl_tbl`.`COLOUR`, `checklst_dtl_tbl`.`FOB_COST`, `checklst_dtl_tbl`.`SO`, `checklst_dtl_tbl`.`EXT`, `checklst_dtl_tbl`.`QTY_CTN`, `checklst_dtl_tbl`.`GROSS_WEIGHT`, `checklst_dtl_tbl`.`NET_WEIGHT`, `checklst_dtl_tbl`.`NO_OF_CTN`  FROM `emico`.`checklst_dtl_tbl` INNER JOIN checklist_entry ON checklist_entry.status_msg = checklst_dtl_tbl.ORDER_REF WHERE checklist_entry.archive=0 AND FG_DTL <> '' AND `checklst_dtl_tbl`.`ORDER_REF` = '$_SESSION[order_ref]'       ";
                                if ($_SESSION['time'] == "1pm") {
                                    $time_1pm = $time_only . " and FG_TIME < \"13:00:00\" ";
//                                echo $time_1pm;
                                    $final_query = $time_1pm;
                                    $_SESSION['time'] = "1pm";
                                }
                                if ($_SESSION['time'] == '4pm') {
                                    $time_4pm = $time_only . " and FG_TIME >= \"13:00:00\" and FG_TIME < \"16:00:00\" ";
//                                echo $time_4pm;
                                    $final_query = $time_4pm;
                                    $_SESSION['time'] = "4pm";
                                }
                                if ($_SESSION['time'] == '8pm') {
                                    $time_8pm = $time_only . " and FG_TIME >= \"16:00:00\" and FG_TIME <= \"18:00:00\" ";
//                                echo $time_8pm;
                                    $final_query = $time_8pm;
                                    $_SESSION['time'] = "8pm";
                                }
                                if ($_SESSION['time'] == 'ALL') {
                                    $final_query = $time_only;
                                    $_SESSION['time'] = "ALL";
                                }

                                if (isset($_SESSION['sort_date'])) {
                                    if ($_SESSION['sort_date'] <> '') {
                                        $final_query = $final_query . " AND FG_DATE = '" . $_SESSION['sort_date'] . "' ";
                                        //$_SESSION['sort_date'] = $_SESSION['sort_date'];
                                    }
                                    if ($_SESSION['sort_date'] <> '') {
                                        $final_query = $final_query . "";
                                        $_SESSION['sort_date'] = "";
                                    }

                                }

                                if (isset($_SESSION['order'])) {
                                    if ($_SESSION['order'] <> "") {
                                        if ($_SESSION['order'] == 'all') {
                                            $final_query = $final_query . "";
                                            $_SESSION['order'] = "all";
                                        } else {
                                            $final_query = $final_query . " AND ORDER_REF = '" . $_SESSION['order'] . "' ";
//                                            $_SESSION['order'] = $_POST['order'];
                                        }
                                    }
                                } else {
                                }


                                if (isset($_SESSION['user'])) {
                                    if ($_SESSION['user'] <> "") {
                                        if ($_SESSION['user'] == 'all') {
                                            $final_query = $final_query . "";
                                            $_SESSION['user'] = "all";
                                        } else {
                                            $final_query = $final_query . " AND FG_DTL LIKE('%" . $_SESSION['user'] . "%')";
//                                            $_SESSION['user'] = $_POST['user'];
                                        }

                                    }
                                } else {
                                }

                                if (isset($_SESSION['origin'])) {
                                    if ($_SESSION['origin'] <> "") {
                                        if ($_SESSION['origin'] == 'all') {
                                            $final_query = $final_query . "";
                                            $_SESSION['origin'] = "all";
                                        } else {
                                            $final_query = $final_query . "AND PROD_ORIG ='" . $_SESSION['origin'] . "'";
                                            //$_SESSION['origin'] = $_POST['origin'];
                                        }

                                    }
                                } else {
                                }


                                $final_query = $final_query . " Group by STOCK_CODE";
                                echo "<br><b>SQL</b><br>";
                                echo "<b>" . $final_query . "</b>";

                            }
                        } else {

                        }


                        $rsEventList = mysqli_query($con, $final_query)
                        or die(mysqli_error($con));

                        while ($row = mysqli_fetch_assoc($rsEventList)) {


                            $sum_of_entry = $row['COUNT(`checklst_dtl_tbl`.`ENTRY_ID`)'];
                            $ctns_no_id = $row['CTNS_NO_ID'];
                            $stock_code = $row['STOCK_CODE'];
                            $customer_code = $row['CUSTOMER_CODE'];
                            $ctns_no = $row['PRODUCT_DESC'];

                            $color = $row['COLOUR'];
                            $qty_ctn = $row['QTY_CTN'];
                            $gross_weight = $row['GROSS_WEIGHT'];
                            $net_weight = $row['NET_WEIGHT'];
                            $no_of_ctn = $row['NO_OF_CTN'];



                            echo "<tr role=\"row\" class=\"odd\">";
//                                    echo "<td class=\"sorting_1\">" . $entryid . "</td>";
                            echo "<td>" . $sum_of_entry . "</td>";
                            echo "<td>" . $ctns_no_id . "</td>";
                            echo "<td>" . $stock_code . "</td>";
                            echo "<td>" . $customer_code . "</td>";
                            echo "<td>" . $ctns_no . "</td>";

                            echo "<td>" . $color . "</td>";
                            echo "<td>" . $qty_ctn . "</td>";
                            echo "<td>" . $gross_weight . "</td>";
                            echo "<td>" . $net_weight . "</td>";
                            echo "<td>" . $no_of_ctn . "</td>";
                            echo "<td>" .  ''. "</td>";
                            echo "<td>" .  ''. "</td>";



                            echo "</tr>";
                        }

                        ?>


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

        dataTable.on('draw', function () {
            alert('Table redrawn');
        });

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
