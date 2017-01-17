<?php session_start();
include '../includes/emicodb_conn.php'; ?>
<?php require_once('../includes/helpers.php'); ?>
<?php check_session(); ?>
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
                        <h3>Production Schedule
                            <small>|</small>
                        </h3>
                    </div>
                </div>


                <?php
                var_dump($_POST);
                if (isset($_POST['order'])) {
                    $order = $_POST['order'];
                }
                else{
                    $order = '';
                }

                if (isset($_POST['order_ref'])) {
                    $order = $_POST['order_ref'];
                }


                ?>
                <div class="col-md-12">
                    <form class="form-horizontal form-label-left" action="production_schedule.php" method="post">

                        <div class="form-group">
                            <!--                            <label class="col-md-3 col-sm-3 col-xs-12">ORDER REF</label>-->
                            <div class="col-sm-9 col-xs-12 col-md-3">
                                <select class="select2_single form-control col-md-6" tabindex="-1" name="order">
                                    <?php
                                    $all_order_ref = 'SELECT status_msg FROM emico.checklist_entry WHERE archive =0;';
                                    $rsCountList = mysqli_query($con, $all_order_ref)
                                    or die(mysqli_error($con));

                                    while ($row = mysqli_fetch_assoc($rsCountList)) {
                                        $order_ref = $row['status_msg'];
                                        echo "<option>" . $order_ref . "</option>";

                                        if ($order == '')
                                        {
                                            $order = $order_ref;
                                        }
                                    }


                                    ?>
                                </select>
                            </div>

                            <div class="controls">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i
                                                class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input disabled="disabled" type="text" style="width: 200px" name="reservation" id="reservation"
                                           class="form-control" value="09/22/2016 - 12/31/2016"/>
                                </div>
                                <div class="col-md-9">
                                    <input type="submit" value="Load" class="btn btn-success">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>


                <?php

                echo '<table id="datatable_2" class="table  table-bordered  display cell-border" cellspacing="0" width="100%">
                    <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1"
                            colspan="1"
                            aria-sort="ascending" aria-label="Name: activate to sort column descending">
                            Priotity
                        
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                            aria-label="Position: activate to sort column ascending">
                            Order Reference
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                            aria-label="Office: activate to sort column ascending">
                            M3
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                            aria-label="Age: activate to sort column ascending">Completion Date
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                            aria-label="Start date: activate to sort column ascending">
                            Status
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                            aria-label="Salary: activate to sort column ascending">P2
                        </th>';


                $query_m3 = "SELECT COUNT(`checklst_dtl_tbl`.`ENTRY_ID`), `checklst_dtl_tbl`.`ENTRY_ID`, `checklst_dtl_tbl`.`ORDER_REF`, SUM(`checklst_dtl_tbl`.`FOB_COST`), SUM( `checklst_dtl_tbl`.`QTY_CTN`), SUM(`checklst_dtl_tbl`.`GROSS_WEIGHT`), SUM(`checklst_dtl_tbl`.`NET_WEIGHT`), SUM(`checklst_dtl_tbl`.`NO_OF_CTN`), `checklst_dtl_tbl`.`USER`,`checklist_entry`.`ctns_no`,`checklist_entry`.`fg` FROM `emico`.`checklst_dtl_tbl` INNER JOIN checklist_entry ON checklist_entry.status_msg = checklst_dtl_tbl.ORDER_REF WHERE ORDER_REF = '$order'";

                $m3_result = mysqli_query($con, $query_m3)
                or die(mysqli_error($con));

                $m3_sum=0;
                while ($row = mysqli_fetch_assoc($m3_result)){
                    $m3_sum = $row['SUM(`checklst_dtl_tbl`.`NET_WEIGHT`)'];
                }



                $count_all = "SELECT dates.date_ymd, COUNT(`checklst_dtl_tbl`.`ENTRY_ID`) FROM `emico`.`checklst_dtl_tbl` 
INNER JOIN checklist_entry ON checklist_entry.status_msg = checklst_dtl_tbl.ORDER_REF   AND checklst_dtl_tbl.ORDER_REF='" . $order . "' AND (checklist_entry.archive=0 AND FG_DTL <> '' )
RIGHT JOIN dates AS dates ON checklst_dtl_tbl.FG_DATE =dates.date_ymd 
WHERE  (date_ymd BETWEEN '2016-09-22' AND '2016-12-31') 
 GROUP BY dates.date_ymd";
//                echo $count_all;

                $rsCountList = mysqli_query($con, $count_all)
                or die(mysqli_error($con));


                while ($row = mysqli_fetch_assoc($rsCountList)) {


                    $dates = '<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                            aria-label="Salary: activate to sort column ascending">' . substr($row['date_ymd'], -5) . '</th>';

                    echo $dates;

                }

                echo '<tbody>
                    <tr role=\"row\" class=\"odd\">
                        <td>-</td>
                        <td>' . $order . '</td>

                        <td>'.$m3_sum.'</td>
                        <td><button class="btn btn-info btn-lg">Not Set</button></td>
                        <td>Actual</td>
                        <td>-</td>';

                $count_all = "SELECT dates.date_ymd, COUNT(`checklst_dtl_tbl`.`ENTRY_ID`) FROM `emico`.`checklst_dtl_tbl` 
INNER JOIN checklist_entry ON checklist_entry.status_msg = checklst_dtl_tbl.ORDER_REF   AND checklst_dtl_tbl.ORDER_REF='$order' AND (checklist_entry.archive=0 AND FG_DTL <> '' )
RIGHT JOIN dates AS dates ON checklst_dtl_tbl.FG_DATE =dates.date_ymd 
WHERE  (date_ymd BETWEEN '2016-09-22' AND '2016-12-31') 
 GROUP BY dates.date_ymd";
                $count_all_actual = "SELECT entry_id,order_ref,date,count,edited_count,state FROM emico.prod_schedule WHERE order_ref='$order' and date BETWEEN '2016-09-22' AND '2016-12-31'";
                echo $count_all_actual;

                $rsCountList = mysqli_query($con, $count_all_actual)
                or die(mysqli_error($con));
                $current_count = 0;

                while ($row = mysqli_fetch_assoc($rsCountList)) {


                    $current_count = $current_count + $row['count'];

                    $query = '<td><button name="view" class="btn btn-info btn-lg view_data"  id=' . $row['entry_id'] . '>' . $current_count . '</button></td>';
                    echo $query;
                }
                echo '</tr>';
                echo '<tbody>
                    <tr role=\"row\" class=\"odd\">
                        <td>-</td>
                        <td>' . $order . '</td>
                        <td>'.$m3_sum.'</td>
                        <td><button class="btn btn-info btn-lg">Not Set</button></td>
                        <td>Planned</td>
                        <td>-</td>';

                $count_all = "SELECT dates.date_ymd, COUNT(`checklst_dtl_tbl`.`ENTRY_ID`) FROM `emico`.`checklst_dtl_tbl` 
INNER JOIN checklist_entry ON checklist_entry.status_msg = checklst_dtl_tbl.ORDER_REF   AND checklst_dtl_tbl.ORDER_REF='$order' AND (checklist_entry.archive=0 AND FG_DTL <> '' )
RIGHT JOIN dates AS dates ON checklst_dtl_tbl.FG_DATE =dates.date_ymd 
WHERE  (date_ymd BETWEEN '2016-09-22' AND '2016-12-31') 
 GROUP BY dates.date_ymd";

                $count_all_planned = "SELECT entry_id,order_ref,date,count,edited_count,state FROM emico.prod_schedule WHERE order_ref='$order' and date BETWEEN '2016-09-22' AND '2016-12-31'";
                echo $count_all;

                $rsCountList = mysqli_query($con, $count_all_planned)
                or die(mysqli_error($con));
                $current_count_edited = 0;

                $is_shipped = FALSE;
                while ($row = mysqli_fetch_assoc($rsCountList)) {
                    $current_count_edited = $current_count_edited + $row['edited_count'];

                    if ($row['edited_count'] == 0){
                        $query = '<td><button name="edit" class="btn btn-info btn-lg edit_data" id=' . $row['entry_id'] . '>' . $current_count_edited . '</button></td>';

                    }
                    else{
                        $query = '<td><button name="edit" class="btn btn-success btn-lg edit_data" id=' . $row['entry_id'] . '>' . $current_count_edited . '</button></td>';
                    }


                    //The one which is edited with shipped
                    if ($row['state']=='s' or $row['state']=='S' or $row['state'] <> 'Actual' or $is_shipped==TRUE){
                        $is_shipped = TRUE;
                        $query = '<td><button name="edit" class="btn btn-success btn-lg edit_data" id=' . $row['entry_id'] . '>' . 'SHIPPED' . '</button></td>';
                    }

                    //The one which is not edited as shipped but shown as shipped.
                    if ($row['state'] == 'Actual' and $is_shipped==TRUE){

                        $query = '<td><button name="edit" class="btn btn-info btn-lg edit_data" id=' . $row['entry_id'] . '>' . 'SHIPPED' . '</button></td>';
                    }
                    echo $query;
                }
                echo '</tr></tbody></table>';
                ?>

                <br>


                <?php

                echo '<table id="datatable_3" class="table  table-bordered  display cell-border" cellspacing="0" width="100%">
                    <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1"
                            colspan="1"
                            aria-sort="ascending" aria-label="Name: activate to sort column descending">
                            Priotity
                        
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                            aria-label="Position: activate to sort column ascending">
                            Order Reference
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                            aria-label="Office: activate to sort column ascending">
                            M3 SUM
                        </th>
                
                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                            aria-label="Age: activate to sort column ascending">Completion Date
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                            aria-label="Start date: activate to sort column ascending">
                            Status
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                            aria-label="Salary: activate to sort column ascending">P2
                        </th>';

                $count_all = "SELECT dates.date_ymd, COUNT(`checklst_dtl_tbl`.`ENTRY_ID`) FROM `emico`.`checklst_dtl_tbl` 
INNER JOIN checklist_entry ON checklist_entry.status_msg = checklst_dtl_tbl.ORDER_REF   AND checklst_dtl_tbl.ORDER_REF='" . $order . "' AND (checklist_entry.archive=0 AND FG_DTL <> '' )
RIGHT JOIN dates AS dates ON checklst_dtl_tbl.FG_DATE =dates.date_ymd 
WHERE  (date_ymd BETWEEN '2016-09-22' AND '2016-12-31') 
 GROUP BY dates.date_ymd";
                //                echo $count_all;

                $rsCountList = mysqli_query($con, $count_all)
                or die(mysqli_error($con));


                while ($row = mysqli_fetch_assoc($rsCountList)) {


                    $dates = '<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                            aria-label="Salary: activate to sort column ascending">' . substr($row['date_ymd'], -5) . '</th>';

                    echo $dates;

                }

                echo '<tbody>
                    <tr role=\"row\" class=\"odd\">
                        <td>-</td>
                        <td>' . $order . '</td>

                        <td>'.$m3_sum.'</td>
                        <td><button class="btn btn-info btn-lg">Not Set</button></td>
                        <td>Actual</td>
                        <td>-</td>';

                $count_all = "SELECT dates.date_ymd, COUNT(`checklst_dtl_tbl`.`ENTRY_ID`) FROM `emico`.`checklst_dtl_tbl` 
INNER JOIN checklist_entry ON checklist_entry.status_msg = checklst_dtl_tbl.ORDER_REF   AND checklst_dtl_tbl.ORDER_REF='$order' AND (checklist_entry.archive=0 AND FG_DTL <> '' )
RIGHT JOIN dates AS dates ON checklst_dtl_tbl.FG_DATE =dates.date_ymd 
WHERE  (date_ymd BETWEEN '2016-09-22' AND '2016-12-31') 
 GROUP BY dates.date_ymd";
                $count_all_actual = "SELECT entry_id,order_ref,date,count,edited_count,state FROM emico.prod_schedule WHERE order_ref='$order' and date BETWEEN '2016-09-22' AND '2016-12-31'";
                echo $count_all_actual;

                $rsCountList = mysqli_query($con, $count_all_actual)
                or die(mysqli_error($con));
                $current_count = 0;

                while ($row = mysqli_fetch_assoc($rsCountList)) {


                    $current_count = $current_count + $row['count'];

                    $query = '<td><button name="view" class="btn btn-info btn-lg view_data"  id=' . $row['entry_id'] . '>' . $current_count . '</button></td>';
                    echo $query;
                }




                echo '</tr>';
                echo '<tbody>
                    <tr role=\"row\" class=\"odd\">
                        <td>-</td>
                        <td>' . $order . '</td>
                    
                        <td>'.$m3_sum.'</td>
                        <td><button class="btn btn-info btn-lg">Not Set</button></td>
                        <td>Planned</td>
                        <td>-</td>';

                $count_all = "SELECT dates.date_ymd, COUNT(`checklst_dtl_tbl`.`ENTRY_ID`) FROM `emico`.`checklst_dtl_tbl` 
INNER JOIN checklist_entry ON checklist_entry.status_msg = checklst_dtl_tbl.ORDER_REF   AND checklst_dtl_tbl.ORDER_REF='$order' AND (checklist_entry.archive=0 AND FG_DTL <> '' )
RIGHT JOIN dates AS dates ON checklst_dtl_tbl.FG_DATE =dates.date_ymd 
WHERE  (date_ymd BETWEEN '2016-09-22' AND '2016-12-31') 
 GROUP BY dates.date_ymd";

                $count_all_planned = "SELECT entry_id,order_ref,date,count,edited_count,state FROM emico.prod_schedule WHERE order_ref='$order' and date BETWEEN '2016-09-22' AND '2016-12-31'";
                echo $count_all;

                $rsCountList = mysqli_query($con, $count_all_planned)
                or die(mysqli_error($con));
                $current_count_edited = 0;

                $is_shipped = FALSE;
                while ($row = mysqli_fetch_assoc($rsCountList)) {
                    $current_count_edited = $current_count_edited + $row['edited_count'];

                    if ($row['edited_count'] == 0){
                        $query = '<td><button name="edit" class="btn btn-info btn-lg edit_data" id=' . $row['entry_id'] . '>' . $current_count_edited . '</button></td>';

                    }
                    else{
                        $query = '<td><button name="edit" class="btn btn-success btn-lg edit_data" id=' . $row['entry_id'] . '>' . $current_count_edited . '</button></td>';
                    }


                    //The one which is edited with shipped
                    if ($row['state']=='s' or $row['state']=='S' or $row['state'] <> 'Actual' or $is_shipped==TRUE){
                        $is_shipped = TRUE;
                        $query = '<td><button name="edit" class="btn btn-success btn-lg edit_data" id=' . $row['entry_id'] . '>' . 'SHIPPED' . '</button></td>';
                    }

                    //The one which is not edited as shipped but shown as shipped.
                    if ($row['state'] == 'Actual' and $is_shipped==TRUE){

                        $query = '<td><button name="edit" class="btn btn-info btn-lg edit_data" id=' . $row['entry_id'] . '>' . 'SHIPPED' . '</button></td>';
                    }
                    echo $query;
                }
                echo '</tr></tbody></table>';
                ?>


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



        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Progress</h4>
                    </div>
                    <div class="modal-body">
                        <input type="text" style="width: 200px" name="progress" id="progress" class="form-control""/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Model       -->


        <div id="dataModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Order Details</h4>
                    </div>
                    <div class="modal-body" id="order_details">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



<!--Start of notification model-->
        <div id="notification_Modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Notification</h4>
                    </div>
                    <div class="modal-body" id="employee_detail">
                        <h4 class='text-success'>Update Succcessful</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--End of notification model-->

        <div id="add_data_Modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Progress Details</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="insert_form">

                            <label for="entry_id">Entry ID</label>
                            <input type="text" name="entry_id" id="entry_id" class="form-control"/>
                            <br/>

                            <label for="order_ref">Order Ref</label>
                            <input type="text" name="order_ref" id="order_ref" class="form-control"/>
                            <br/>

                            <label for="date">Date</label>
                            <input type="text" name="date" id="date" class="form-control"/>
                            <br/>

                            <label for="this_day">This Day</label>
                            <input name="this_day" id="this_day" class="form-control"/>
                            <br/>

                            <label for="edited_count">Planned</label>
                            <input name="edited_count" id="edited_count" class="form-control"/>
                            <br/>

                            <label for="state">State</label>
                            <input type="text" name="state" id="state" class="form-control"/>
                            <br/>

<!--                            <input type="hidden" name="entry_id" id="entry_id"/>-->
                            <input type="submit" name="insert" id="insert" value="Update"
                                   class="btn btn-success"
                                   onclick="return confirm('Are you sure you want to Proceed?');"/>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <script type="text/javascript">


            $(document).on('click', '.view_data', function () {
                var entry_id = $(this).attr("id");
                $.ajax({
                    url: "./ajax/select.php",
                    method: "get",
                    data: {entry_id: entry_id},
                    success: function (data) {
                        $('#order_details').html(data);
                        $('#dataModal').modal("show");
                    },
                    fail: console.log('Failed to load data, ENTRY_ID : ' + entry_id)
                });
            });


//            $(document).on('click', '.edit_data', function () {
//                var entry_id = $(this).attr("id");
//                $.ajax({
//                    url: "./ajax/select.php",
//                    method: "get",
//                    data: {entry_id: entry_id},
//                    success: function (data) {
//                        $('#user_detail').html(data);
//                        $('#dataModal').modal("show");
//                    }
//                });
//            });


            $(document).ready(function () {
                $('#datatable').DataTable({
                    "scrollX": true,
                    bFilter: false,
                    "bLengthChange": false,
                    bInfo: false
                });
            });

            $(document).ready(function () {
                $('#datatable_2').DataTable({
                    "scrollX": true,
                    bFilter: false,
                    "bLengthChange": false,
                    bInfo: false
                });
            });

            $(document).ready(function () {
                $('#datatable_3').DataTable({
                    "scrollX": true,
                    bFilter: false,
                    "bLengthChange": false,
                    bInfo: false
                });
            });


        </script>


<!--Script for Edit Model-->
        <script>


            $(document).ready(function () {


                $(document).on('click', '.edit_data', function () {
                    var entry_id = $(this).attr("id");
                    $.ajax({
                        url: "./ajax/fetch.php",
                        method: "get",
                        data: {entry_id: entry_id},
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            $('#entry_id').val(data.entry_id);
                            $('#date').val(data.date);
                            $('#this_day').val(data.count);
                            $('#order_ref').val(data.order_ref);
                            $('#edited_count').val(data.edited_count);
                            $('#state').val(data.state);
                            $('#add_data_Modal').modal('show');
                        },
                        fail: console.log('Failed to retrive data.')
                    });
                });


                $('#insert_form').on("submit", function (event) {

                        $.ajax({
                            url: "./ajax/insert.php",
                            method: "GET",
                            data: $('#insert_form').serialize(),
                            beforeSend: function () {
                                $('#insert').val("Updating...");

                            },
                            success: function (data) {

                                $('#add_data_Modal').modal('hide');
                                $('#notification_Modal').modal('show');
                            },
                            fail: console.log('Update Failed')
                        });

                });

            });
        </script>


        <?php render('footer'); ?>
