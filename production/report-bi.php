<?php
/**
 * Created by PhpStorm.
 * User: Chester Chin
 * Date: 8/6/2016
 * Time: 4:46 PM
 */


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
                        <h3>
                            <small></small>
                        </h3>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    -
                </div>
                <iframe width="933" height="700" src="https://msit.powerbi.com/view?r=eyJrIjoiZjA4MDE3MTAtMjVkYy00NTQ0LTk3OGMtYjFkNGE3YmQxNTRhIiwidCI6IjcyZjk4OGJmLTg2ZjEtNDFhZi05MWFiLTJkN2NkMDExZGI0NyIsImMiOjV9" frameborder="0" allowFullScreen="true"></iframe>
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


</body>

</html>
