<?php include '../includes/emicodb_conn.php'; ?>
<?php require_once('../includes/helpers.php'); ?>
<?php render('header'); ?>

<body class="nav-md">

<div class="container body">
    
    <?php render('navigation'); ?>


        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>
                            Report - FG & LOAD
                            <small>
                            </small>
                        </h3>
                    </div>

                    <!--            <div class="title_right">-->
                    <!--              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">-->
                    <!--                <div class="input-group">-->
                    <!--                  <input type="text" class="form-control" placeholder="Search for...">-->
                    <!--                  <span class="input-group-btn">-->
                    <!--                            <button class="btn btn-default" type="button">Go!</button>-->
                    <!--                        </span>-->
                    <!--                </div>-->
                    <!--              </div>-->
                    <!--            </div>-->
                    <!--          </div>-->
                    <div class="clearfix"></div>


<!--                    Calender Drop Down here-->

                    <div class="well">

                        <form class="form-horizontal" action="report-chart.php" method="get">
                            <fieldset>
                                <div class="control-group">
                                    <div class="controls">
                                        <div class="input-prepend input-group">
                                            <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                            <input type="text" style="width: 200px" name="reservation" id="reservation" class="form-control" value="05-01-2016 - 05-30-2016" />
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-primary"/>
                                </div>
                            </fieldset>
                        </form>
                    </div>


                    <script type="text/javascript">
                        $(function() {

                            $('input[name="reservation"]').daterangepicker({
                                autoUpdateInput: false,
                                locale: {
                                    cancelLabel: 'Clear'
                                }
                            });

                            $('input[name="reservation"]').on('apply.daterangepicker', function(ev, picker) {
                                $(this).val(picker.startDate.format('MM-DD-YYYY') + ' - ' + picker.endDate.format('MM-DD-YYYY'));
                            });

                            $('input[name="reservation"]').on('cancel.daterangepicker', function(ev, picker) {
                                $(this).val('');
                            });

                        });
                    </script>





<!--                    FG CHART REPORT-->
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div class="x_panel">
                                <div class="">
                                        <h2>FG Graph
                                        <small></small>
                                    </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                               aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Settings 1</a>
                                                </li>
                                                <li><a href="#">Settings 2</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <canvas id="lineChart_FG"></canvas>
                                </div>
                            </div>
                        </div>

                        <br/>
                    </div>
                </div>

                <!--                    FG CHART REPORT-->
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="x_panel">
                            <div class="">
                                <h2>LOAD Graph
                                    <small></small>
                                </h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                           aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Settings 1</a>
                                            </li>
                                            <li><a href="#">Settings 2</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <canvas id="lineChart_LOAD"></canvas>
                            </div>
                        </div>
                    </div>

                    <br/>
                </div>
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
        <script src="../js/moment/moment.min.js"></script>
        <script src="../js/chartjs/chart.min.js"></script>
        <script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
        <script src="../js/icheck/icheck.min.js"></script>
        <script src="../js/custom.js"></script>
        <script src="../js/pace/pace.min.js"></script>

<script type="text/javascript" src="../js/moment/moment.min.js"></script>
<script type="text/javascript" src="../js/datepicker/daterangepicker.js"></script>


        <?php
        $sql_string = "SELECT FG_DATE AS datetime, count(*) AS Entries FROM emico.checklst_dtl_tbl WHERE FG_DATE BETWEEN '2016-05-23 00:00:00' AND '2016-05-31 00:00:00' GROUP BY FG_DATE;";
        $sql_string2 = "SELECT FG_DATE AS datetime, count(*) AS Entries FROM emico.checklst_dtl_tbl WHERE (FG_DATE BETWEEN '2016-05-23 00:00:00' AND '2016-05-31 00:00:00') AND ORDER_REF = 'ITD-SO1501' GROUP BY FG_DATE";
        ?>


        <?php
        $list_all = "SELECT FG_DATE AS date, count(*) AS Entries FROM emico.checklst_dtl_tbl WHERE (FG_DATE BETWEEN '2016-05-23 00:00:00' AND '2016-05-31 00:00:00') AND ORDER_REF = 'ITD-SO1501' GROUP BY FG_DATE";

        $rsEventList = mysqli_query($con, $list_all)
        or die(mysqli_error($con));

        while ($row = mysqli_fetch_assoc($rsEventList)) {

            $date[] = $row['date'];
            $entries[] = $row['Entries'];

        }


//        $list_all = "SELECT LOAD_DATE AS date, count(*) AS Entries FROM emico.checklst_dtl_tbl WHERE (LOAD_DATE BETWEEN '2016-05-23 00:00:00' AND '2016-05-31 00:00:00') AND ORDER_REF = 'ITD-SO1501' GROUP BY LOAD_DATE";
//
//        $rsEventList = mysqli_query($con, $list_all)
//        or die(mysqli_error($con));
//
//        while ($row = mysqli_fetch_assoc($rsEventList)) {
//
//            $date_load[] = $row['date'];
//            $entries_load[] = $row['Entries'];
//
//        }
//
//        //    print_r(json_encode($date));
//            print_r(json_encode($entries_load));

        ?>


        <script>
            Chart.defaults.global.legend = {
                enabled: false
            };

            // Line chart FG
            var ctx_fg = document.getElementById("lineChart_FG");
            var lineChart_fg = new Chart(ctx_fg, {
                type: 'line',
                data: {
                    labels: <?php     print_r(json_encode($date)); ?>,
                    datasets: [{
                        label: "FG",
                        backgroundColor: "rgba(38, 185, 154, 0.31)",
                        borderColor: "rgba(38, 185, 154, 0.7)",
                        pointBorderColor: "rgba(38, 185, 154, 0.7)",
                        pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "rgba(220,220,220,1)",
                        pointBorderWidth: 1,
                        data: <?php  print_r(json_encode($entries));?>

                        }]
                },
            });


            // Line chart LOAD
            var ctx_load = document.getElementById("lineChart_LOAD");
            var lineChart_load = new Chart(ctx_load, {
                type: 'line',
                data: {
                    labels: <?php     print_r(json_encode($date)); ?>,
                    datasets: [{
                        label: "LOAD",
                        backgroundColor: "rgba(220, 185, 200, 0.31)",
                        borderColor: "rgba(220, 185, 154, 0.7)",
                        pointBorderColor: "rgba(220, 185, 154, 0.7)",
                        pointBackgroundColor: "rgba(220, 185, 154, 0.7)",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "rgba(220,220,100,1)",
                        pointBorderWidth: 1,
                        data: <?php  print_r(json_encode($entries));?>

                    }]
                },
            });

        </script>

</body>

</html>
