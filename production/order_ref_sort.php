<?php session_start();
include '../includes/emicodb_conn.php'; ?>
<?php require_once('../includes/helpers.php'); ?>
<?php check_session(); ?>
<?php render('header'); ?>


<?php render('navigation'); ?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>General Sorting</h3>
            </div>


            <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Order Ref
                            <small></small>
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br/>
                        <form class="form-horizontal form-label-left" action="order_ref_sort.php" method="post">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 ">Date</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="input-prepend input-group">
                                        <span class="add-on input-group-addon"><i
                                                    class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                        <input type="text" style="width: 200px" name="sort_date" id="sort_date"
                                               class="form-control" value="<?php echo date("Y-m-d") ?>"/>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 ">TIME</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select class="form-control" name="time">
                                        <option>ALL</option>
                                        <option>1pm</option>
                                        <option>4pm</option>
                                        <option>8pm</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">ORDER</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select class="select2_single form-control" tabindex="-1" name="order">
                                        <option value="all">ALL</option>
                                        <?php
                                        $all_order_ref = 'SELECT status_msg FROM emico.checklist_entry WHERE archive =0;';
                                        $rsCountList = mysqli_query($con, $all_order_ref)
                                        or die(mysqli_error($con));

                                        while ($row = mysqli_fetch_assoc($rsCountList)) {
                                            $order_ref = $row['status_msg'];
                                            echo "<option>" . $order_ref . "</option>";
                                        }

                                        ?>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">USER</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select class="select2_group form-control" name="user">
                                        <option value="all">ALL</option>
                                        <option value="operation1">OPERATION 1</option>
                                        <option value="operation2">OPERATION 2</option>
                                        <option value="operations">OPERATION S</option>
                                        <option value="WHS">WHS</option>
                                        <option value="Emico">EMICO</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Origin</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select class="form-control" name="origin">
                                        <option>ALL</option>
                                        <option>STK</option>
                                        <option>PROD</option>
                                    </select>
                                </div>
                            </div>


                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                    <input type="submit" class="btn btn-success">
                                </div>
                            </div>
                        </form>
                        <?php

                        echo isset($_POST);
                        $final_query = "";
                        if (isset($_POST)) {
                            if (isset($_POST['time']) <> "") {


                                echo "<b>SETTING:</b><br><b>";
                                var_dump($_POST);
                                echo "</b><br>";

                                $time_only = "SELECT COUNT(`checklst_dtl_tbl`.`ENTRY_ID`),
`checklst_dtl_tbl`.`ENTRY_ID`, 
`checklst_dtl_tbl`.`ORDER_REF`, 
SUM(`checklst_dtl_tbl`.`FOB_COST`),
SUM( `checklst_dtl_tbl`.`QTY_CTN`), 
SUM(`checklst_dtl_tbl`.`GROSS_WEIGHT`), 
SUM(`checklst_dtl_tbl`.`NET_WEIGHT`), 
SUM(`checklst_dtl_tbl`.`NO_OF_CTN`), 
`checklst_dtl_tbl`.`USER`,`checklist_entry`.`ctns_no`,`checklist_entry`.`fg` FROM `emico`.`checklst_dtl_tbl` INNER JOIN checklist_entry ON checklist_entry.status_msg = checklst_dtl_tbl.ORDER_REF WHERE checklist_entry.archive=0 AND FG_DTL <> '' ";
                                if ($_POST['time'] == "1pm") {
                                    $time_1pm = $time_only . " and FG_TIME < \"13:00:00\" ";
//                                echo $time_1pm;
                                    $final_query = $time_1pm;
                                    $_SESSION['time'] = "1pm";
                                }
                                if ($_POST['time'] == '4pm') {
                                    $time_4pm = $time_only . " and FG_TIME >= \"13:00:00\" and FG_TIME < \"16:00:00\" ";
//                                echo $time_4pm;
                                    $final_query = $time_4pm;
                                    $_SESSION['time'] = "4pm";
                                }
                                if ($_POST['time'] == '8pm') {
                                    $time_8pm = $time_only . " and FG_TIME >= \"16:00:00\" and FG_TIME <= \"18:00:00\" ";
//                                echo $time_8pm;
                                    $final_query = $time_8pm;
                                    $_SESSION['time'] = "8pm";
                                }
                                if ($_POST['time'] == 'ALL') {
                                    $final_query = $time_only;
                                    $_SESSION['time'] = "ALL";
                                }

                                if (isset($_POST['sort_date'])) {
                                    if ($_POST['sort_date'] <> '') {
                                        $final_query = $final_query . " AND FG_DATE = '" . $_POST['sort_date'] . "' ";
                                        $_SESSION['sort_date'] = $_POST['sort_date'];
                                    }
                                    if ($_POST['sort_date'] == '') {
                                        $final_query = $final_query . "";
                                        $_SESSION['sort_date'] = "";
                                    }

                                }

                                if (isset($_POST['order'])) {
                                    if ($_POST['order'] <> "") {
                                        if ($_POST['order'] == 'all') {
                                            $final_query = $final_query . "";
                                            $_SESSION['order'] = "all";
                                        } else {
                                            $final_query = $final_query . " AND ORDER_REF = '" . $_POST['order'] . "' ";
                                            $_SESSION['order'] = $_POST['order'];
                                        }
                                    }
                                } else {
                                }


                                if (isset($_POST['user'])) {
                                    if ($_POST['user'] <> "") {
                                        if ($_POST['user'] == 'all') {
                                            $final_query = $final_query . "";
                                            $_SESSION['user'] = "all";
                                        } else {
                                            $final_query = $final_query . " AND FG_DTL LIKE('%" . $_POST['user'] . "%')";
                                            $_SESSION['user'] = $_POST['user'];
                                        }

                                    }
                                } else {
                                }

                                if (isset($_POST['origin'])) {
                                    if ($_POST['origin'] <> "") {
                                        if ($_POST['origin'] == 'ALL') {
                                            $final_query = $final_query . "";
                                            $_SESSION['origin'] = "all";
                                        } else {
                                            $final_query = $final_query . "AND PROD_ORIG ='" . $_POST['origin'] . "'";
                                            $_SESSION['origin'] = $_POST['origin'];
                                        }

                                    }
                                } else {
                                }


                                $final_query = $final_query . " Group by ORDER_REF";
                                echo "<br><b>SQL</b><br>";
                                echo "<b>" . $final_query . "</b>";

                            }
                        } else {

                        }

                        ?>

                    </div>
                </div>
            </div>

        </div>

        <?php

        ?>
        <div class="clearfix"></div>


    </div>
    <div class="col-md-12 col-xs-12">
        <div class="x_panel">
            <!--//Table code here.-->

            <table id="datatable" class="table table-striped table-bordered dataTable no-footer"
                   role="grid"
                   aria-describedby="datatable_info">
                <thead>
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1"
                        colspan="1"
                        aria-sort="ascending" aria-label="Name: activate to sort column descending"
                        style="width: 134px;"> FG Count
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                        aria-label="Position: activate to sort column ascending" style="width: 180px;">
                        Order Reference
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                        aria-label="Office: activate to sort column ascending" style="width: 98px;">
                        Total FOB
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                        aria-label="Age: activate to sort column ascending" style="width: 46px;">
                        Total Quantity
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                        aria-label="Start date: activate to sort column ascending" style="width: 94px;">
                        Total Gross Weight
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                        aria-label="Salary: activate to sort column ascending" style="width: 72px;">
                        Total M3
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                        aria-label="Salary: activate to sort column ascending" style="width: 72px;">
                        TOTAL Order Carton
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                        aria-label="Salary: activate to sort column ascending" style="width: 72px;">
                        <?php
                        if (isset($_POST['sort_date'])) {
                            if ($_POST['sort_date'] <> '') {
                                echo "(" . $_POST['sort_date'] . ")";
                            }
                            if ($_POST['sort_date'] == '') {
                                echo "";
                            }

                        }
                        ?>
                        TODAY'S PROGRESS
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                        aria-label="Salary: activate to sort column ascending" style="width: 72px;">
                        OVERALL PROGRESS
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                        aria-label="Salary: activate to sort column ascending" style="width: 72px;">
                        _

                </tr>
                </thead>


                <tbody>


                <?php

                if (isset($_POST)) {
                    if (isset($_POST['time']) <> "") {
                        echo "<br>" . "Time : " . $_POST['time'] . "<br>";
                        $rsCountList = mysqli_query($con, $final_query)
                        or die(mysqli_error($con));

                        while ($row = mysqli_fetch_assoc($rsCountList)) {
                            $count = $row['COUNT(`checklst_dtl_tbl`.`ENTRY_ID`)'];
                            $order_ref = $row['ORDER_REF'];
                            $count_fob = $row['SUM(`checklst_dtl_tbl`.`FOB_COST`)'];
                            $count_qty_ctn = $row['SUM( `checklst_dtl_tbl`.`QTY_CTN`)'];
                            $count_gross_weight = $row['SUM(`checklst_dtl_tbl`.`GROSS_WEIGHT`)'];
                            $count_net_weight = $row['SUM(`checklst_dtl_tbl`.`NET_WEIGHT`)'];
                            $count_no_of_ctn = $row['ctns_no'];
                            $progress = ($row['COUNT(`checklst_dtl_tbl`.`ENTRY_ID`)'] / $row['ctns_no']) * 100;
                            $overall_progress = ($row['fg'] / $row['ctns_no']) * 100;


//            $ctns_no_id = $row['CTNS_NO_ID'];
//            $stock_code = $row['STOCK_CODE'];
//            $customer_code = $row['CUSTOMER_CODE'];
//            $ctns_no = $row['PRODUCT_DESC'];
//
//            $color = $row['COLOUR'];
//            $qty_ctn = $row['QTY_CTN'];
//            $gross_weight = $row['GROSS_WEIGHT'];
//            $net_weight = $row['NET_WEIGHT'];
//            $no_of_ctn = $row['NO_OF_CTN'];
//
//            $fg = $row['FG_DTL'];
//            $load = $row['LOAD_DTL'];


                            echo "<tr role=\"row\" class=\"odd\">";
//                                    echo "<td class=\"sorting_1\">" . $entryid . "</td>";


//            <a href="http://en.wikipedia.org/">Wikipedia</a><div class="box"><iframe src="http://en.wikipedia.org/" width = "800px" height = "500px"></iframe></div>

                            echo "<td>" . $count . "</td>>";
                            echo "<td><a target = '_blank' href=order_ref_sort_data_dtl_FG.php?order_ref=$order_ref>" . $order_ref . "</a>" . "</td>";
                            echo "<td>" . round($count_fob, 2) . "</td>";
                            echo "<td>" . $count_qty_ctn . "</td>";
                            echo "<td>" . round($count_gross_weight, 2) . "</td>";
                            echo "<td>" . round($count_net_weight, 2) . "</td>";

                            echo "<td>" . $count_no_of_ctn . "</td>";
                            echo "<td>" . round($progress, 2) . "</td>";


//                            Calculate color for percentage
                            $var = round($overall_progress, 2);
                            $color = '';
                            if ($var < 40) $color = '#e74c3c';
                            elseif ($var < 60) $color = '#e67e22';
                            elseif ($var >= 60) $color = '#2ecc71';

                            echo "<td bgcolor='$color'> <b style=\"color:white\">" . round($overall_progress, 2) . "</b></td>";
                            echo "<td>" . "-" . "</td>";


//            echo "<td>" . $ctns_no_id . "</td>";
//            echo "<td>" . $stock_code . "</td>";
//            echo "<td>" . $customer_code . "</td>";
//            echo "<td>" . $ctns_no . "</td>";
//
//            echo "<td>" . $color . "</td>";
//            echo "<td>" . $qty_ctn . "</td>";
//            echo "<td>" . $gross_weight . "</td>";
//            echo "<td>" . $net_weight . "</td>";
//            echo "<td>" . $no_of_ctn . "</td>";
//
//
//            echo "<td>" . $fg . "</td>";
//            echo "<td>" . $load . "</td>";
                            echo "</tr>";
                        }
                    }
                } else {

                }

                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- /page content -->
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


<!-- /footer content -->

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>

<script src="../js/custom.js"></script>


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
        $('#datatable').dataTable();
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

</body>
</html>

<?php //render('footer'); ?>


