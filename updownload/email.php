<?php
include("../learn/database.php");

if (isset($_POST['download'])) {
    $studentid = $_POST['studentid'];
    header('Content-Type:text/csv; charset=utf-8');
    header('Content-Disposition: attachement; filename=data.csv');
    $output= fopen('php://output', 'w');
    fputcsv($output, array('studentid','firstname'));
  foreach ($studentid as $studentid)
     $exportData = mysql_query("select DISTINCT studentid, firstname,lastname, sex, year, semister from student where studentid='$studentid'");
     $row = mysql_fetch_array($exportData);
     fputcsv($output,$row);
  
    fclose($output);
    }
?>
