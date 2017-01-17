<?php session_start(); include '../includes/emicodb_conn.php'; ?>
<?php require_once('../includes/helpers.php'); ?>
<?php check_session();?>
<?php render('header'); ?>

<!--<body class="nav-md">-->

<?php render('navigation'); ?>

<!-- page content -->
<div class="right_col" role="main">

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

                <div class="row x_title">
                    <div class="col-md-6">
                        <h3>General - Consolidation
                            <small>|</small>
                        </h3>
                    </div>
                    <div class="col-md-6">

                    </div>
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
                                style="width: 134px;">Entry ID
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Position: activate to sort column ascending" style="width: 222px;">
                                Order Reference
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Office: activate to sort column ascending" style="width: 98px;">Time
                                Stamp
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Age: activate to sort column ascending" style="width: 46px;">NO OF CTNS
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Start date: activate to sort column ascending" style="width: 94px;">
                                NO OF CTNS TOGO
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Salary: activate to sort column ascending" style="width: 72px;">PERCENTAGE
                            </th>


                        </tr>
                        </thead>


                        <tbody>


                        <?php
                        $_SESSION['sort_date'] = "0000-00-00";

                        $list_all = "SELECT ENTRY_ID,ORDER_REF,TIMESTAMP,NO_OF_CTNS,NO_OF_CTNS_TOGO,PERCENTAGE FROM emico.checklist_consolidation Order By entry_id DESC;";
                        $rsEventList = mysqli_query($con, $list_all)
                        or die(mysqli_error($con));

                        while ($row = mysqli_fetch_assoc($rsEventList)) {

                            $entryid = $row['ENTRY_ID'];
                            $order_ref = $row['ORDER_REF'];
                            $timeStamp = $row['TIMESTAMP'];
                            $no_of_ctns = $row['NO_OF_CTNS'];
                            $no_of_ctns_togo = $row['NO_OF_CTNS_TOGO'];
                            $percentage = $row['PERCENTAGE'];
                            //$archive = $row['archive']; //Not used

                            echo "<tr role=\"row\" class=\"odd\">";
                            echo "<td class=\"sorting_1\">" . $entryid . "</td>";
                            echo "<td><a target = '_blank' href=order_ref_consolidation_dtl.php?order_ref=$order_ref>" . $order_ref . "</a></td>";
                            echo "<td>" . $timeStamp . "</td>";
                            echo "<td>" . $no_of_ctns . "</td>";
                            echo "<td>" . $no_of_ctns_togo . "</td>";
                            echo "<td>" . $percentage . "</td>";
                            //echo "<td> <input class='btn btn-dark' name=\"archiveBtn\" type=\"button\" value=\"Archive\" onclick=\"window.open('./order_ref_archive.php?entry_id=".$entryid."')\"</td>";
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

<?php render('footer'); ?>
