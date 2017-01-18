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
include '../includes/epitopedb_conn.php';	  // make db connection      


?>
	
	<title>Epitode  </title>


<body>
<div class="right_col" role="main">
<br>

Epitope
<?php
//var_dump($_POST);
if (isset($_POST['entry'])){

$sql_query = "SELECT * FROM bio.epitope where Description like '%".$_POST['entry']."%';";
//    echo $sql_query;
}
?>

<form action="index.php" method="post">



<br>
<strong>Title :</strong> <input type="text" name="entry"/>
​
<input type="submit">
</form>


 
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
    if (isset($_POST['entry']))
    {

		echo "<table id=\"datatable\" class=\"table table-striped table-bordered dataTable no-footer\"
                                   role=\"grid\"
                                   aria-describedby=\"datatable_info\">";
								echo "<tr role=\"row\">";
echo "<th>Epitope_ID</th>";
echo "<th>Object_Type</th>";
echo "<th>Description</th>";
echo "<th>Starting_Position</th>";
echo "<th>Ending_Position</th>";
echo "<th>`Non-peptidic_epitope_ChEBI_ID`</th>";
echo "<th>Epitope_Synonyms</th>";
echo "<th>Antigen_Name</th>";
echo "<th>Antigen_ID</th>";
echo "<th>Organism_Name</th>";
echo "<th>Organism_ID</th>";
echo "<th>Epitope_Comments</th>";
								echo "</tr>";

		//Execute Query						
		$result = mysqli_query($con,$sql_query) or die(mysqli_error($con));
		

		 if(mysqli_num_rows($result)>0)
		 {
		 		while ($row = mysqli_fetch_array($result)) 
		 		{
					echo "<tr>";
							echo "<td>".$row["Epitope_ID"]."</td>";
echo "<td>".$row["Object_Type"]."</td>";
echo "<td>".$row["Description"]."</td>";
echo "<td>".$row["Starting_Position"]."</td>";
echo "<td>".$row["Ending_Position"]."</td>";
echo "<td>".$row["Non-peptidic_epitope_ChEBI_ID"]."</td>";
echo "<td>".$row["Epitope_Synonyms"]."</td>";
echo "<td>".$row["Antigen_Name"]."</td>";
echo "<td>".$row["Antigen_ID"]."</td>";
echo "<td>".$row["Organism_Name"]."</td>";
echo "<td>".$row["Organism_ID"]."</td>";
echo "<td>".$row["Epitope_Comments"]."</td>";
					echo "</tr>";

				}
                    
          }
          else
          {
          	echo "<tr><td colspan='6'>No Results</td></tr>";
          }
		//Close table generated on top.
		echo "</table>";
			
	}
    else{

    }
?>
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