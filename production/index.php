<?php //session_start()?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sample</title>

        <!-- Bootstrap core CSS -->

        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <link href="../fonts/css/font-awesome.min.css" rel="stylesheet">
        <link href="../css/animate.min.css" rel="stylesheet">

        <!-- Custom styling plus plugins -->
        <link href="../css/custom.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/maps/jquery-jvectormap-2.0.3.css"/>
        <link href="../css/icheck/flat/green.css" rel="stylesheet"/>
        <link href="../css/floatexamples.css" rel="stylesheet" type="text/css"/>

        <script src="../js/jquery.min.js"></script>
        <script src="../js/nprogress.js"></script>

        <!--[if lt IE 9]>
        <!--<script src="/production/assets/js/ie8-responsive-file-warning.js"></script>-->
        <!--    <![endif]-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>-->
        <!--    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->
        <!--    <![endif]-->

    </head>
    <body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="" class="site_title"><i class="fa fa-home"></i>
                            <span>Sample</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="../images/logo.jpg" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>Admin</h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br/>

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-home"></i> Sample <span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="">Sample</a>
                                        </li>
                                        <li><a href="">Sample</a>
                                        </li>
                                        <li><a href="">Sample</a>
                                        </li>
                                        <!--                                    <li><a href="../production/report-chart.php">Report-Chart[On Hold]</a>-->
                                        <!--                                    </li>-->
                                        <!--                                    <li><a href="../production/report-bi.php">Report-BI[On Hold]</a>-->
                                        <!--                                    </li>-->
                                    </ul>
                                </li>

                                <li><a><i class="fa fa-home"></i> Sample <span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href=".">Sample</a>
                                        </li>

                                    </ul>
                                </li>
                                <li><a><i class="fa fa-edit"></i>Sample <span
                                                class="fa fa-chevron-down"></span></a>

                                </li>

                                <li><a><i class="fa fa-edit"></i> Sample <span class="fa fa-chevron-down"></span></a>

                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="">Sample</a>
                                        </li>

                                    </ul>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>
            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->
            <?php
            //Include required resources.
            include '../includes/epitopedb_conn.php';      // make db connection


            ?>

            <title>Epitode</title>


            <body style="font-size: small">
            <div class="right_col" role="main">
                <br>

                Epitope
                <?php
                //var_dump($_POST);
                if (isset($_POST['entry'])) {

                    $sql_query = "SELECT * FROM bio.epitope WHERE Description LIKE '%" . $_POST['entry'] . "%';";
//    echo $sql_query;
                }
                ?>

                <form action="index.php" method="post">


                    <br>
                    <strong>Input :</strong> <input type="text" name="entry"/>
                    ​<br>


                    <strong>Peptide length:</strong>
                    <select id="id_hla_len" name="hla_len">
                        <option value="" selected="selected">--choose--</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                    </select>

                    <select id="id_allele_list" name="allele_list">
                        <option></option>
                        <option value="HLA-A*01:01">HLA-A*01:01</option>
                        <option value="HLA-A*02:01">HLA-A*02:01</option>
                        <option value="HLA-A*02:06">HLA-A*02:06</option>
                        <option value="HLA-A*03:01">HLA-A*03:01</option>
                        <option value="HLA-A*11:01">HLA-A*11:01</option>
                        <option value="HLA-A*23:01">HLA-A*23:01</option>
                        <option value="HLA-A*24:02">HLA-A*24:02</option>
                        <option value="HLA-A*25:01">HLA-A*25:01</option>
                        <option value="HLA-A*26:01">HLA-A*26:01</option>
                        <option value="HLA-A*29:02">HLA-A*29:02</option>
                        <option value="HLA-A*30:01">HLA-A*30:01</option>
                        <option value="HLA-A*30:02">HLA-A*30:02</option>
                        <option value="HLA-A*31:01">HLA-A*31:01</option>
                        <option value="HLA-A*32:01">HLA-A*32:01</option>
                        <option value="HLA-A*33:03">HLA-A*33:03</option>
                        <option value="HLA-A*68:01">HLA-A*68:01</option>
                        <option value="HLA-A*68:02">HLA-A*68:02</option>
                        <option value="HLA-A*74:01">HLA-A*74:01</option>
                        <option value="HLA-B*07:02">HLA-B*07:02</option>
                        <option value="HLA-B*08:01">HLA-B*08:01</option>
                        <option value="HLA-B*13:01">HLA-B*13:01</option>
                        <option value="HLA-B*13:02">HLA-B*13:02</option>
                        <option value="HLA-B*14:02">HLA-B*14:02</option>
                        <option value="HLA-B*15:01">HLA-B*15:01</option>
                        <option value="HLA-B*15:02">HLA-B*15:02</option>
                        <option value="HLA-B*15:25">HLA-B*15:25</option>
                        <option value="HLA-B*18:01">HLA-B*18:01</option>
                        <option value="HLA-B*27:02">HLA-B*27:02</option>
                        <option value="HLA-B*27:05">HLA-B*27:05</option>
                        <option value="HLA-B*35:01">HLA-B*35:01</option>
                        <option value="HLA-B*35:03">HLA-B*35:03</option>
                        <option value="HLA-B*37:01">HLA-B*37:01</option>
                        <option value="HLA-B*38:01">HLA-B*38:01</option>
                        <option value="HLA-B*39:01">HLA-B*39:01</option>
                        <option value="HLA-B*40:01">HLA-B*40:01</option>
                        <option value="HLA-B*40:02">HLA-B*40:02</option>
                        <option value="HLA-B*44:02">HLA-B*44:02</option>
                        <option value="HLA-B*44:03">HLA-B*44:03</option>
                        <option value="HLA-B*46:01">HLA-B*46:01</option>
                        <option value="HLA-B*48:01">HLA-B*48:01</option>
                        <option value="HLA-B*49:01">HLA-B*49:01</option>
                        <option value="HLA-B*50:01">HLA-B*50:01</option>
                        <option value="HLA-B*51:01">HLA-B*51:01</option>
                        <option value="HLA-B*52:01">HLA-B*52:01</option>
                        <option value="HLA-B*53:01">HLA-B*53:01</option>
                        <option value="HLA-B*55:01">HLA-B*55:01</option>
                        <option value="HLA-B*56:01">HLA-B*56:01</option>
                        <option value="HLA-B*57:01">HLA-B*57:01</option>
                        <option value="HLA-B*58:01">HLA-B*58:01</option>
                        <option value="HLA-B*58:02">HLA-B*58:02</option>
                        <option value="HLA-C*01:02">HLA-C*01:02</option>
                        <option value="HLA-C*02:02">HLA-C*02:02</option>
                        <option value="HLA-C*02:09">HLA-C*02:09</option>
                        <option value="HLA-C*03:02">HLA-C*03:02</option>
                        <option value="HLA-C*03:03">HLA-C*03:03</option>
                        <option value="HLA-C*03:04">HLA-C*03:04</option>
                        <option value="HLA-C*04:01">HLA-C*04:01</option>
                        <option value="HLA-C*05:01">HLA-C*05:01</option>
                        <option value="HLA-C*06:02">HLA-C*06:02</option>
                        <option value="HLA-C*07:01">HLA-C*07:01</option>
                        <option value="HLA-C*07:02">HLA-C*07:02</option>
                        <option value="HLA-C*07:04">HLA-C*07:04</option>
                        <option value="HLA-C*08:01">HLA-C*08:01</option>
                        <option value="HLA-C*08:02">HLA-C*08:02</option>
                        <option value="HLA-C*12:02">HLA-C*12:02</option>
                        <option value="HLA-C*12:03">HLA-C*12:03</option>
                        <option value="HLA-C*14:02">HLA-C*14:02</option>
                        <option value="HLA-C*15:02">HLA-C*15:02</option>
                        <option value="HLA-C*16:01">HLA-C*16:01</option>
                        <option value="HLA-C*17:01">HLA-C*17:01</option>
                        <option value="HLA-E*01:01">HLA-E*01:01</option>
                        <option value="HLA-E*01:03">HLA-E*01:03</option>
                        <option value="HLA-G*01:01">HLA-G*01:01</option>
                        <option value="HLA-G*01:02">HLA-G*01:02</option>
                        <option value="HLA-G*01:03">HLA-G*01:03</option>
                        <option value="HLA-G*01:04">HLA-G*01:04</option>
                        <option value="HLA-G*01:06">HLA-G*01:06</option>
                    </select>


<br>
                    <strong>Sort peptides by</strong>
                        <select size="1" name="sort_output" id="sort_output"><option value="percentile_rank" selected="">Percentile Rank</option><option value="position_in_sequence">Position in sequence</option></select>


                    <br>
                    <strong>Prediction Type</strong>
                                    <select size="1" name="cutoff_type" id="cutoff_type">
                                        <option value="none" selected="">All predictions</option>
                                        <option value="MHC_IC50" disabled="disabled">IC50 below [cutoff] nM</option>
                                        <option value="percent">Percent rank below [cutoff]</option>
                                    </select>

                                <div style="float: left; display: none;" id="cutoff">
                                    cutoff <input type="text" name="cutoff_value" size="4" maxlength="6" title="This field is ignored if the option 'All predictions' is chosen on the left">
                                </div>





                    <input type="submit">
                </form>


                <div class="col-sm-12">
                    <?php


                    // echo "<td>".$row["Epitope_ID"]."</td>";
                    // echo "<td>".$row["Object_Type"]."</td>";
                    // echo "<td>".$row["Description"]."</td>";
                    // echo "<td>".$row["Starting_Position"]."</td>";
                    // echo "<td>".$row["Ending_Position"]."</td>";
                    // echo "<td>".$row["`Non-peptidic_epitope_ChEBI_ID`"]."</td>";
                    // echo "<td>".$row["Epitope_Synonyms"]."</td>";
                    // echo "<td>".$row["Antigen_Name"]."</td>";
                    // echo "<td>".$row["Antigen_ID"]."</td>";
                    // echo "<td>".$row["Organism_Name"]."</td>";
                    // echo "<td>".$row["Organism_ID"]."</td>";
                    // echo "<td>".$row["Epitope_Comments"]."</td>";

                    //Check all fields before SQL Query Execution
                    if (isset($_POST['entry'])) {

                        echo "<table id=\"datatable\" class=\"table table-striped table-bordered dataTable no-footer\"
                                   role=\"grid\"
                                   aria-describedby=\"datatable_info\" style='max-width: 800px'>";
                        echo "<tr role=\"row\">";
                        echo "<th class=\"sorting_asc\" tabindex=\"0\" aria-controls=\"datatable\" rowspan=\"1\"
                                        colspan=\"1\"
                                        aria-sort=\"ascending\" aria-label=\"Name: activate to sort column descending\"
                                        style=\"width: 134px;\">Epitope_ID</th>";
                        echo "<th class=\"sorting_asc\" tabindex=\"0\" aria-controls=\"datatable\" rowspan=\"1\"
                                        colspan=\"1\"
                                        aria-sort=\"ascending\" aria-label=\"Name: activate to sort column descending\"
                                        style=\"width: 134px;\">Object_Type</th>";
                        echo "<th class=\"sorting_asc\" tabindex=\"0\" aria-controls=\"datatable\" rowspan=\"1\"
                                        colspan=\"1\"
                                        aria-sort=\"ascending\" aria-label=\"Name: activate to sort column descending\"
                                        style=\"width: 134px;\">Description</th>";
                        echo "<th class=\"sorting_asc\" tabindex=\"0\" aria-controls=\"datatable\" rowspan=\"1\"
                                        colspan=\"1\"
                                        aria-sort=\"ascending\" aria-label=\"Name: activate to sort column descending\"
                                        style=\"width: 134px;\">Starting_Position</th>";
                        echo "<th class=\"sorting_asc\" tabindex=\"0\" aria-controls=\"datatable\" rowspan=\"1\"
                                        colspan=\"1\"
                                        aria-sort=\"ascending\" aria-label=\"Name: activate to sort column descending\"
                                        style=\"width: 134px;\">Ending_Position</th>";
                        echo "<th class=\"sorting_asc\" tabindex=\"0\" aria-controls=\"datatable\" rowspan=\"1\"
                                        colspan=\"1\"
                                        aria-sort=\"ascending\" aria-label=\"Name: activate to sort column descending\"
                                        style=\"width: 134px;\">`Non-peptidic_epitope_ChEBI_ID`</th>";
                        echo "<th class=\"sorting_asc\" tabindex=\"0\" aria-controls=\"datatable\" rowspan=\"1\"
                                        colspan=\"1\"
                                        aria-sort=\"ascending\" aria-label=\"Name: activate to sort column descending\"
                                        style=\"width: 134px;\">Epitope_Synonyms</th>";
                        echo "<th class=\"sorting_asc\" tabindex=\"0\" aria-controls=\"datatable\" rowspan=\"1\"
                                        colspan=\"1\"
                                        aria-sort=\"ascending\" aria-label=\"Name: activate to sort column descending\"
                                        style=\"width: 134px;\">Antigen_Name</th>";
                        echo "<th class=\"sorting_asc\" tabindex=\"0\" aria-controls=\"datatable\" rowspan=\"1\"
                                        colspan=\"1\"
                                        aria-sort=\"ascending\" aria-label=\"Name: activate to sort column descending\"
                                        style=\"width: 134px;\">Antigen_ID</th>";
                        echo "<th class=\"sorting_asc\" tabindex=\"0\" aria-controls=\"datatable\" rowspan=\"1\"
                                        colspan=\"1\"
                                        aria-sort=\"ascending\" aria-label=\"Name: activate to sort column descending\"
                                        style=\"width: 134px;\">Organism_Name</th>";
                        echo "<th class=\"sorting_asc\" tabindex=\"0\" aria-controls=\"datatable\" rowspan=\"1\"
                                        colspan=\"1\"
                                        aria-sort=\"ascending\" aria-label=\"Name: activate to sort column descending\"
                                        style=\"width: 134px;\">Organism_ID</th>";
                        echo "<th class=\"sorting_asc\" tabindex=\"0\" aria-controls=\"datatable\" rowspan=\"1\"
                                        colspan=\"1\"
                                        aria-sort=\"ascending\" aria-label=\"Name: activate to sort column descending\"
                                        style=\"width: 134px;\">Epitope_Comments</th>";
                        echo "</tr>";

                        //Execute Query
                        $result = mysqli_query($con, $sql_query) or die(mysqli_error($con));


                        if (mysqli_num_rows($result) > 0) {
                            echo "<tbody>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["Epitope_ID"] . "</td>";
                                echo "<td>" . $row["Object_Type"] . "</td>";
                                echo "<td>" . $row["Description"] . "</td>";
                                echo "<td>" . $row["Starting_Position"] . "</td>";
                                echo "<td>" . $row["Ending_Position"] . "</td>";
                                echo "<td>" . $row["Non-peptidic_epitope_ChEBI_ID"] . "</td>";
                                echo "<td>" . $row["Epitope_Synonyms"] . "</td>";
                                echo "<td>" . $row["Antigen_Name"] . "</td>";
                                echo "<td>" . $row["Antigen_ID"] . "</td>";
                                echo "<td>" . $row["Organism_Name"] . "</td>";
                                echo "<td>" . $row["Organism_ID"] . "</td>";
                                echo "<td>" . $row["Epitope_Comments"] . "</td>";
                                echo "</tr>";

                            }
                            echo "</tbody>";

                        } else {
                            echo "<tr><td colspan='6'>No Results</td></tr>";
                        }
                        //Close table generated on top.

                        echo "</table>";

                    } else {

                    }
                    ?>
                </div>
            </div>


            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    <a href=""></a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->


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

            <!-- /datepicker -->
            <!-- /footer content -->
            </body>

    </html>

<?PHP
//mysqli_free_result($result); 
mysqli_close($con);
?>