<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/timetable.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare teacher object
$timeTable = new TimeTable($db);

$leaveDate = $_POST['leaveDate'];
$leaveDay = $_POST['leaveDay'];

// query teacher
$stmt = $timeTable->getTeacherTimeTableOnLeave($leaveDate, $leaveDay);
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){

    // Time Table Array
    $timeTable_arr=array();
    $timeTable_arr["timetable"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $timetable_item=array(
            "tid" => $TID,
            "tname" => $TNAME,
            "designation" => $DESIGNATION,
            'daynum' => $DAYNUM,
            "day" => $DAY,
            "pone" => $PONE,
            "ptwo" => $PTWO,
            "pthree" => $PTHREE,
            "pfour" => $PFOUR,
            "pfive" => $PFIVE,
            "psix" => $PSIX,
            "pseven" => $PSEVEN,
            "peight" => $PEIGHT,
            "pnine" => $PNINE
        );
        array_push($timeTable_arr["timetable"], $timetable_item);
    }
    echo json_encode($timeTable_arr["timetable"]);
    //echo json_encode(array("Sorry No data - ".$num));
}
else{
    echo json_encode(array("Sorry No data - ".$num));
}
?>