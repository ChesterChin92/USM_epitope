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
                                $order_ref = null;
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



<!--          No.	Stock code	Customer Code	Product Description	Colour	FOB Cost (USD)	Qty/Ctn	Total Qty	Total Gross Weight	Total m3	Order Quantity (Pcs)	No. of Ctn	How Many More To Go	FG	Percentage

      -->
                <!--//Table code here.-->
                <div class="col-sm-12">
                    <table id="datatable" class="table table-striped table-bordered dataTable no-footer"
                           role="grid"
                           aria-describedby="datatable_info">
                        <thead>
                        <tr role="row">

                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Position: activate to sort column ascending" style="width: 46px;">
                                NO
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Office: activate to sort column ascending" style="width: 46px;">
                                CUSTOMER CODE
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Age: activate to sort column ascending" style="width: 146px;">PRODUCT_CODE
                            </th>

                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Age: activate to sort column ascending" style="width: 146px;">PRODUCT_DESC
                            </th>

                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Age: activate to sort column ascending" style="width: 146px;">COLOUR
                            </th>

                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Age: activate to sort column ascending" style="width: 146px;">FOB COST
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Age: activate to sort column ascending" style="width: 146px;">QTY CTN
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Age: activate to sort column ascending" style="width: 146px;">TOTAL QTY
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Age: activate to sort column ascending" style="width: 146px;">GROSS WEIGHT
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Age: activate to sort column ascending" style="width: 146px;">TOTAL M3
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Age: activate to sort column ascending" style="width: 146px;">ORDER Quantity (PCS)
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Age: activate to sort column ascending" style="width: 146px;">No. of Ctns
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Age: activate to sort column ascending" style="width: 146px;">How Many More To Go
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Age: activate to sort column ascending" style="width: 146px;">FG
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                          aria-label="Age: activate to sort column ascending" style="width: 146px;">Percentage
                            </th>

                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Age: activate to sort column ascending" style="width: 146px;">TOTAL FOB COST
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                aria-label="Age: activate to sort column ascending" style="width: 146px;">CURRENT_FOB_COST
                            </th>

                        </tr>
                        </thead>


                        <tbody>

                        <?php
                        echo "</br>";

                        $list_all = "SELECT 
    `checklist_consolidation_fg`.`ORDER_REF`,
    `checklist_consolidation_fg`.`NO`,
    `checklist_consolidation_fg`.`STOCK_CODE`,
    `checklist_consolidation_fg`.`CUSTOMER_CODE`,
    `checklist_consolidation_fg`.`PRODUCT_DESC`,
    `checklist_consolidation_fg`.`COLOUR`,
    `checklist_consolidation_fg`.`FOB_COST`,
    `checklist_consolidation_fg`.`QTY_CTN`,
    `checklist_consolidation_fg`.`TOTAL_QTY`,
    `checklist_consolidation_fg`.`GROSS_WEIGHT`,
    `checklist_consolidation_fg`.`NET_WEIGHT`,
    `checklist_consolidation_fg`.`ORDER_QTY`,
    `checklist_consolidation_fg`.`NO_OF_CTN`,
    `checklist_consolidation_fg`.`NO_OF_CTN_TO_GO`,
    `checklist_consolidation_fg`.`FG_COUNT`,
    `checklist_consolidation_fg`.`PERCENTAGE`,
    `checklist_consolidation_fg`.`TOTAL_FOB_COST`,
    `checklist_consolidation_fg`.`CURRENT_FOB_COST`
FROM `emico`.`checklist_consolidation_fg` WHERE emico.`checklist_consolidation_fg`.ORDER_REF = '".$order_ref."'  ORDER BY ENTRY_ID ASC;;";
                        echo $list_all;
                        $rsEventList = mysqli_query($con, $list_all)
                        or die(mysqli_error($con));

                        while ($row = mysqli_fetch_assoc($rsEventList)) {

                            $no = $row['NO'];
                            $stock_code = $row['STOCK_CODE'];
                            $customer_code = $row['CUSTOMER_CODE'];
                            $product_no = $row['PRODUCT_DESC'];
                            $color = $row['COLOUR'];
                            $fob_cost = $row['FOB_COST']; //
                            $qty_ctn = $row['QTY_CTN'];
                            $total_qty = $row['TOTAL_QTY']; //
                            $gross_weight = $row['GROSS_WEIGHT'];
                            $net_weight = $row['NET_WEIGHT'];
                            $order_qty = $row['ORDER_QTY'];
                            $no_of_ctn = $row['NO_OF_CTN'];
                            $no_of_ctn_togo = $row['NO_OF_CTN_TO_GO'];
                            $fg = $row['FG_COUNT'];
                            $percentage = $row['PERCENTAGE'];
                            $total_fob_cost = $row['TOTAL_FOB_COST']; //
                            $current_fob_cost = $row['CURRENT_FOB_COST']; //



                            echo "<tr role=\"row\" class=\"odd\">";
//                                    echo "<td class=\"sorting_1\">" . $entryid . "</td>";

                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $stock_code . "</td>";
                            echo "<td>" . $customer_code . "</td>";
                            echo "<td>" . $product_no . "</td>";

                            echo "<td>" . $color . "</td>";
                            echo "<td>" . $fob_cost . "</td>";
                            echo "<td>" . $qty_ctn . "</td>";
                            echo "<td>" . $total_qty . "</td>";
                            echo "<td>" . $gross_weight . "</td>";
                            echo "<td>" . $net_weight . "</td>";
                            echo "<td>" . $order_qty . "</td>";

                            echo "<td>" . $no_of_ctn . "</td>";
                            echo "<td>" . $no_of_ctn_togo . "</td>";

                            echo "<td>" . $fg . "</td>";
                            echo "<td>" . $percentage . "</td>";
                            echo "<td>" . $total_fob_cost . "</td>";
                            echo "<td>" . $current_fob_cost . "</td>";
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
