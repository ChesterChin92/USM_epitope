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
                                <h3>General Checklist Report
                                    <small>|</small>
                                </h3>
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>


                        <!--                    Calender Drop Down here-->

                        <div class="well">

                            <form class="form-horizontal" action="order_ref.php" method="get">
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="input-prepend input-group">
                                                <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                                <input type="text" style="width: 200px" name="sort_date" id="sort_date" class="form-control" value="<?php echo date("Y-m-d")?>"/>
                                                <input value="Sort" type="submit" class="btn btn-primary"/>
                                            </div>

                                        </div>

                                    </div>
                                </fieldset>
                            </form>
                        </div>



                        <script type="text/javascript">
                            $(function() {


                                $('input[name="sort_date"]').daterangepicker({
                                    singleDatePicker: true,
                                    "startDate": <?php echo date("Y-m-d")?>,
                                    showDropdowns: true,
                                    locale: {
                                        format: 'YYYY-MM-DD'
                                    }
                                });


                                $('input[name="sort_date"]').on('apply.daterangepicker', function(ev, picker) {
//                                            $(this).val((picker.startDate.format('YYYY-MM-DD')));

                                    //Encounter problem if date is not set, default will start at year 0000
                                    $(this).val(picker.startDate.format('YYYY-MM-DD'));
                                    console.log(picker.startDate.format('DD-MM-YYYY'));
                                });
//                                        $('input[name="sort_date"]').on('apply.daterangepicker', function(ev, picker) {
//                                            $(this).val(picker.startDate.format('MM-DD-YYYY') + ' - ' + picker.endDate.format('MM-DD-YYYY'));
//                                        });
//
//                                        $('input[name="sort_date"]').on('cancel.daterangepicker', function(ev, picker) {
//                                            $(this).val('');
//                                        });

                            });
                        </script>
                        <!--                    Calender Drop Down here-->



                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <?php
                            $_SESSION['order_ref'] =null;

                            if (isset($_GET['sort_date'])){
                                $sort_date = $_GET['sort_date'];
                                $_SESSION['sort_date'] = $_GET['sort_date'];

                            }
                            else{
                                //Do not set
                            }



                            echo "</br>";
                            var_dump($_SESSION);
                            echo "</br>";

                            if (isset($_SESSION['sort_date']) and $_SESSION['sort_date'] != "0000-00-00"){
                                echo "</br><b>Summary on ". $_SESSION['sort_date']."</b></br>------------------------------------------------------------------------------------------------</br>";

                                //---------------------------------------------------------------------------------------------------
                                $count_all = "SELECT COUNT(*) FROM emico.checklst_dtl_tbl where (emico.checklst_dtl_tbl.FG_DATE = '".$_SESSION['sort_date']."' or emico.checklst_dtl_tbl.LOAD_DATE = '".$_SESSION['sort_date']."') ";
                                //echo $count_all;


                                $rsCountList = mysqli_query($con, $count_all)
                                or die(mysqli_error($con));

                                while ($row = mysqli_fetch_assoc($rsCountList)){
                                    echo "</br><b>Count on FG and LOAD:".$row['COUNT(*)']."</b></br>";
                                }
                                echo "<input class='btn btn-info' name=\"fg_loadBtn\" type=\"button\" value=\"Show Details\" onclick=\"window.open('./order_ref_sort_data_dtl_FG_LOAD.php?sort_date=".$_SESSION['sort_date']."')\"";
                                echo "<br>";
                                //echo "<br>";
                                //echo "<br>";

                                //---------------------------------------------------------------------------------------------------
                                $count_all = "SELECT COUNT(*) FROM emico.checklst_dtl_tbl where emico.checklst_dtl_tbl.FG_DATE = '".$_SESSION['sort_date']."' ";
                                //echo $count_all;

                                $rsCountList = mysqli_query($con, $count_all)
                                or die(mysqli_error($con));

                                while ($row = mysqli_fetch_assoc($rsCountList)){
                                    echo "</br><b>Count on FG:".$row['COUNT(*)']."</b></br>";
                                }
                                //---------------------------------------------------------------------------------------------------
                                echo "<input class='btn btn-info' name=\"fg_Btn\" type=\"button\" value=\"Show Details\" onclick=\"window.open('./order_ref_sort_data_dtl_FG.php?sort_date=".$_SESSION['sort_date']."')\"";
                                echo "<br>";
                                //echo "<br>";
                                //echo "<br>";
                                //---------------------------------------------------------------------------------------------------
                                $count_all = "SELECT COUNT(*) FROM emico.checklst_dtl_tbl where emico.checklst_dtl_tbl.LOAD_DATE = '".$_SESSION['sort_date']."'";
                                //echo $count_all;

                                $rsCountList = mysqli_query($con, $count_all)
                                or die(mysqli_error($con));

                                while ($row = mysqli_fetch_assoc($rsCountList)){
                                    echo "</br><b>Count on LOAD:".$row['COUNT(*)']."</b><br>";
                                }
                                //---------------------------------------------------------------------------------------------------
                                echo "<input class='btn btn-info' name=\"load_Btn\" type=\"button\" value=\"Show Details\" onclick=\"window.open('./order_ref_sort_data_dtl_LOAD.php?sort_date=".$_SESSION['sort_date']."')\"";
                                echo "<br>";
                                //echo "<br>";
                                //echo "<br>";
                                //---------------------------------------------------------------------------------------------------
                                $count_all = "SELECT SUM(QTY_CTN) FROM emico.checklst_dtl_tbl where emico.checklst_dtl_tbl.FG_DATE = '".$_SESSION['sort_date']."' ";
                                //echo $count_all;

                                $rsCountList = mysqli_query($con, $count_all)
                                or die(mysqli_error($con));

                                while ($row = mysqli_fetch_assoc($rsCountList)){
                                    echo "</br><b>Count on QTY_CTN-FG:".$row['SUM(QTY_CTN)']."</b><br>";
                                }

//                                echo "<br>";
                                //---------------------------------------------------------------------------------------------------
                                $count_all = "SELECT SUM(GROSS_WEIGHT) FROM emico.checklst_dtl_tbl where emico.checklst_dtl_tbl.FG_DATE = '".$_SESSION['sort_date']."' ";
                                //echo $count_all;

                                $rsCountList = mysqli_query($con, $count_all)
                                or die(mysqli_error($con));

                                while ($row = mysqli_fetch_assoc($rsCountList)){
                                    echo "</br><b>Count on GROSS_WEIGHT-FG:".$row['SUM(GROSS_WEIGHT)']."</b><br>";
                                }


//                                echo "<br>";
                                //---------------------------------------------------------------------------------------------------
                                $count_all = "SELECT SUM(QTY_CTN) FROM emico.checklst_dtl_tbl where emico.checklst_dtl_tbl.LOAD_DATE = '".$_SESSION['sort_date']."' ";
                                //echo $count_all;

                                $rsCountList = mysqli_query($con, $count_all)
                                or die(mysqli_error($con));

                                while ($row = mysqli_fetch_assoc($rsCountList)){
                                    echo "</br><b>Count on QTY_CTN-LOAD:".$row['SUM(QTY_CTN)']."</b><br>";
                                }

//                                echo "<br>";
                                //---------------------------------------------------------------------------------------------------
                                $count_all = "SELECT SUM(GROSS_WEIGHT) FROM emico.checklst_dtl_tbl where emico.checklst_dtl_tbl.LOAD_DATE = '".$_SESSION['sort_date']."' ";
                                //echo $count_all;

                                $rsCountList = mysqli_query($con, $count_all)
                                or die(mysqli_error($con));

                                while ($row = mysqli_fetch_assoc($rsCountList)){
                                    echo "</br><b>Count on GROSS_WEIGHT-LOAD:".$row['SUM(GROSS_WEIGHT)']."</b><br>";
                                }

                                echo "<br>------------------------------------------------------------------------------------------------<br>";
                            }

                            else{
                                //Skipping sort date.
                            }

                            ?>
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
                                        aria-label="Age: activate to sort column ascending" style="width: 46px;">CTNS NO
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                        aria-label="Start date: activate to sort column ascending" style="width: 94px;">
                                        FG
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                        aria-label="Salary: activate to sort column ascending" style="width: 72px;">LOAD
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                        aria-label="Salary: activate to sort column ascending" style="width: 72px;">Archive
                                    </th>

                                </tr>
                                </thead>


                                <tbody>


                                <?php
                                $_SESSION['sort_date'] = "0000-00-00";

                                $list_all = "SELECT status_msg, entry_id,timeStamp,ctns_no,fg,`load`,`archive`  FROM emico.checklist_entry WHERE emico.checklist_entry.archive <> 1 GROUP BY status_msg Order By entry_id DESC;";
                                $rsEventList = mysqli_query($con, $list_all)
                                or die(mysqli_error($con));

                                while ($row = mysqli_fetch_assoc($rsEventList)) {

                                    $entryid = $row['entry_id'];
                                    $status_msg = $row['status_msg'];
                                    $timeStamp = $row['timeStamp'];
                                    $ctns_no = $row['ctns_no'];
                                    $fg = $row['fg'];
                                    $load = $row['load'];
                                    $archive = $row['archive']; //Not used

                                    echo "<tr role=\"row\" class=\"odd\">";
                                    echo "<td class=\"sorting_1\">" . $entryid . "</td>";
                                    echo "<td><a href=order_ref_dtl.php?order_ref=$status_msg>" . $status_msg . "</a></td>";
                                    echo "<td>" . $timeStamp . "</td>";
                                    echo "<td>" . $ctns_no . "</td>";
                                    echo "<td>" . $fg . "</td>";
                                    echo "<td>" . $load . "</td>";
                                    echo "<td> <input class='btn btn-dark' name=\"archiveBtn\" type=\"button\" value=\"Archive\" onclick=\"window.open('./order_ref_archive.php?entry_id=".$entryid."')\"</td>";
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
