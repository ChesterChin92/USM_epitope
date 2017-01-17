<html>
<head>
    <style>
        body {background-color: black;
            color: lawngreen}
    </style>
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: Chester Chin
 * Date: 12/22/2016
 * Time: 8:30 PM
 */
include '../includes/emicodb_conn.php';
ini_set('max_execution_time', 60*20); //60 Second * X = X minutes, Reconmend setting it for 20 minutes. Future implementation. Break loops based on order.
$count_all = "SELECT status_msg FROM emico.checklist_entry;";


$rsCountList = mysqli_query($con, $count_all)
or die(mysqli_error($con));

while ($row = mysqli_fetch_assoc($rsCountList)) {


    $order_ref = $row['status_msg'];
    echo $row['status_msg'] . "<br>";

    $count_all = "SELECT dates.date_ymd, COUNT(`checklst_dtl_tbl`.`ENTRY_ID`) FROM `emico`.`checklst_dtl_tbl` 
INNER JOIN checklist_entry ON checklist_entry.status_msg = checklst_dtl_tbl.ORDER_REF   AND checklst_dtl_tbl.ORDER_REF='$order_ref' AND (checklist_entry.archive=0 AND FG_DTL <> '' )
RIGHT JOIN dates AS dates ON checklst_dtl_tbl.FG_DATE =dates.date_ymd 
WHERE  (date_ymd BETWEEN '2016-12-01' AND '2017-03-30') 
 GROUP BY dates.date_ymd";

    echo $count_all;

    $rs = mysqli_query($con, $count_all)
    or die(mysqli_error($con));

    $output = '';
    //For every dates, loop to check if update or insert is needed.
    while ($row = mysqli_fetch_assoc($rs)) {

        $date_ymd = $row['date_ymd'];
        $count_entry = $row['COUNT(`checklst_dtl_tbl`.`ENTRY_ID`)'];

        echo $row['date_ymd'] . ' ' . $row['COUNT(`checklst_dtl_tbl`.`ENTRY_ID`)'] . '<br>';

        //If not empty and it is not insreted into the database before.
        if
//        ($row['COUNT(`checklst_dtl_tbl`.`ENTRY_ID`)'] <> 0)
        ($row['COUNT(`checklst_dtl_tbl`.`ENTRY_ID`)'] <> null)

        {

            $check_query = "SELECT entry_id,order_ref,date,count FROM emico.prod_schedule where order_ref='$order_ref' and date='$date_ymd' ;";

            $rs_check = mysqli_query($con, $check_query)
            or die(mysqli_error($con));

            $needs_update = FALSE;
            //Check if the entry exist before, if exist then update.
            while ($row = mysqli_fetch_assoc($rs_check)) {
                //echo "Update";
                $needs_update = TRUE;
            }

            //If it never exist before
            if ( $needs_update==FALSE){
                $query = "INSERT INTO `emico`.`prod_schedule` (`order_ref`, `date`, `count`, `state`, `comment`) VALUES ('$order_ref', '$date_ymd', '$count_entry', 'Actual', '');";
                echo $query;
                $rs2 = mysqli_query($con, $query)
                or die(mysqli_error($con));
            }
        }
    }
}

?>
</body>
</html>
