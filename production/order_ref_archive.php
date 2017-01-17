<?php
/**
 * Created by PhpStorm.
 * User: Chester Chin
 * Date: 9/22/2016
 * Time: 2:51 PM
 */
include '../includes/emicodb_conn.php';
//Change to a much secure solution in future

if (isset($_GET['entry_id'])) {
    $entryid = $_GET['entry_id'];
    echo "Archive : " . $entryid;
    $sql_update_archive = "UPDATE `emico`.`checklist_entry` SET `archive`=1 WHERE `entry_id`='" . $entryid . "' ;";

    $rsEventList = mysqli_query($con, $sql_update_archive)
    or die(mysqli_error($con));

    while ($row = mysqli_fetch_assoc($rsEventList)) {
        echo "Update Successful.";

    }


    $sql_audit ="INSERT INTO emico.audit_log(user,action,id)VALUES('admin_level','ID: ".$entryid." Changed to Archive',$entryid);";
    echo $sql_audit;
    $rsEventList = mysqli_query($con, $sql_audit)
    or die(mysqli_error($con));

    while ($row = mysqli_fetch_assoc($rsEventList)) {
        echo "Audit Successful.";

    }

} else {
    $entryid = null;
    echo "No Entry ID.";
}


?>