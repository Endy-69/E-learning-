<?php
session_start();
include("../learn/database.php");
if (isset($_SESSION['userid']) && ($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $userid = $_SESSION['userid'];
} else {
    header("Location: ../learn/login.php");
}
?>
<?php
    include '../learn/database.php';
    $number = $_SESSION['number'];
    $duration1 = $_SESSION['duration'];
    $exam_id = $_SESSION['exam_id'];
    $continue = $_SESSION['time'];
    $limit = 1;

    if (isset($_GET['testid'])) {
        $testid = $_GET['testid'];
        $start = ($testid - 1) * $limit;
    }
    $continue = $_SESSION['time'];
    $starttime = date('Y-m-d H:i:s');
    $diff = abs(strtotime($starttime) - strtotime($continue));
    $years = floor($diff / (365 * 60 * 60 * 24));
    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    $hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
    $minuts = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
    $seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
    if ($seconds > 9 && $minuts <= 9 && $hours <= 9) {
        $total_time = '0' . $hours . ':0' . $minuts . ':' . $seconds;
    } elseif ($minuts > 9 && $seconds <= 9 && $hours <= 9) {
        $total_time = '0' . $hours . '  :' . $minuts . ' : 0' . $seconds;
    } elseif ($hours > 9 && $seconds <= 9 && $minuts <= 9) {
        $total_time = '' . $hours . ':0' . $minuts . ' : 0' . $seconds;
    } elseif ($seconds > 9 && $minuts > 9 && $hours <= 9) {
        $total_time = '0' . $hours . ':' . $minuts . ' : ' . $seconds;
    } elseif ($seconds > 9 && $hours > 9 && $minuts <= 9) {
        $total_time = '' . $hours . ':0' . $minuts . ' : ' . $seconds;
    } elseif ($minuts > 9 && $hours > 9 && $seconds <= 9) {
        $total_time = '' . $hours . ':' . $minuts . ':0' . $seconds;
    } elseif ($seconds > 9 && $minuts > 9 && $hours > 9) {
        $total_time = '' . $hours . ': ' . $minuts . ':' . $seconds;
    } else {
        $total_time = '0' . $hours . ':0' . $minuts . ':0' . $seconds;
    }
?>
<?php
    if (isset($_POST['previous'])) {
        header("Location: takeexamscreen.php?testid=" . ($testid - 1) . "");
        $testidd = $testid - 1;
        mysqli_query($conn, "delete from resultrecovery where testid = '$testidd' AND exam_id ='$exam_id' AND studentid= '$userid'");
    }
?>
<?php
    if (isset($_POST['next'])) {
        header("Location: takeexamscreen.php?testid=" . ($testid + 1) . "");
        $choose = $_POST['optradio'];
        $correct = 1;
        $incorrect = 1;
        $duration1 = $_SESSION['duration'];
        $date = date('Y-m-d');
        $testidn = $testid;
        if ($duration1 >= $total_time) {

            $select1 = mysqli_query($conn, "select * from test where testid='$testidn' AND answer='$choose' AND exam_id='$exam_id'");

            if (mysqli_num_rows($select1) >= 1) {
                $row = mysqli_fetch_array($select1);
                $mark = $row['mark'];
                $select10 = mysqli_query($conn, "select * from resultrecovery where studentid='$userid' AND testid='$testidn' AND exam_id='$exam_id'");
                if (mysqli_num_rows($select10) >= 1) {
                    
                } else if (mysqli_num_rows($select10) <= 0) {

                    $query = mysqli_query($conn, "insert into resultrecovery values('','$testidn','$userid','$exam_id','$mark','$correct','','$date')");
                }
            } else if (mysqli_num_rows($select1) <= 0) {

                $mark2 = 0;
                $select11 = mysqli_query($conn, "select * from resultrecovery where studentid='$userid' AND testid='$testidn' AND exam_id='$exam_id'");
                if (mysqli_num_rows($select11) >= 1) {
                    
                } else if (mysqli_num_rows($select11) <= 0) {

                    $query1 = mysqli_query($conn, "insert into resultrecovery values('','$testidn','$userid','$exam_id','$mark2','','$incorrect','$date')");
                }
            }
        } else {
            
        }
    }
?>
<?php
    include '../learn/database.php';
    if (isset($_POST['finish'])) {
        header("Location: takeexamscreen.php?testid=" . ($testid + 1) . "");
        $choose1 = $_POST['optradio1'];
        $duration1 = $_SESSION['duration'];
        $date = date('Y-m-d');
        $testidn = $testid;
        if ($duration1 >= $total_time) {
            $fetch = mysqli_query($conn, "select * from resultrecovery where studentid='$userid' AND exam_id='$exam_id'");
            while ($row2 = mysqli_fetch_array($fetch)) {
                $result = $row2['result'];
                $correct = $row2['correct'];
                $incorrect = $row2['incorrect'];
                $finish_result = $finish_result + $result;
                $finish_correct = $finish_correct + $correct;
                $finish_incorrect = $finish_incorrect + $incorrect;
            }
            $finish_test = mysqli_query($conn, "select * from test where testid='$testidn' AND exam_id='$exam_id' AND answer='$choose1'");
            if (mysqli_num_rows($finish_test) >= 1) {
                $fetch1 = mysqli_fetch_array($finish_test);
                $mark1 = $fetch1['mark'];
                $finish_result1 = $finish_result + $mark1;
                $finish_correct1 = $finish_correct + 1;
                mysqli_query($conn, "insert into examresult values('','$userid','$exam_id','$finish_result1','$finish_correct1','$finish_incorrect','$date','')");
            } else {
                $finish_incorrect1 = $finish_incorrect + 1;
                mysqli_query($conn, "insert into examresult values('','$userid','$exam_id','$finish_result','$finish_correct','$finish_incorrect1','$date','')");
            }
        } else {
            
        }
    }
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/jquery.min.js"></script>

        <link href="../css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="../left/bootstrap.min1.css" rel="stylesheet" type="text/css"/>
        <script src="../left/bootstrap.min1.js" type="text/javascript"></script>
        <link href="../left/custom1.css" rel="stylesheet" type="text/css"/>
        <script src="../left/jquery.min1.js" type="text/javascript"></script>
        <script src="../js/student.js" type="text/javascript"></script>
        <link href="../css/main.css" rel="stylesheet" type="text/css"/>
        <link href="../student/userbar.css" rel="stylesheet" type="text/css"/>
    </head>

    <!-- body -->
    <body data-spy="scroll" data-target=".navbar" data-offset="50">
        <?php
            include '../shared/header_top.php';
        ?>  
        <nav class="navbar navbar-default navbar-expand-md navbar-fixed-top">           
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar" aria-controls="myNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav mr-auto">
                    <li class="tab"> 
                        <a class="navbar-link" href="student.php"  title="This Is Home page Of Student">
                            <i class="fa fa-1x fa">Home</i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This Is Upload Resource To The Instructor">
                            <i class="fa fa-1x fa">Upload</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/uploadassignmentanswer.php" title="This Is Upload Assignment Question"> Assignment Answer</a>
                        </div>
                    </li> 
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This Is Download Resource Material">
                            <i class="fa fa-1x fa">Download</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/downloadassignmentquestion.php" title="This Is Download Assignment Questions">Assignment Question</a>
                            <a href="../updownload/downloadcoursematerial.php" title="This Is Download Course_Material"> Course Materialt</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This Is View Resource Page">
                            <i class="fa fa-1x fa">View</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/viewnoticest.php" title="This Is View Notice Page From Department"> Notice</a>
                            <a href="viewcourseresult.php" title="This Is View Course Result ">Course result</a>
                        </div>
                    </li>  
                    <li class="tab">
                        <a class="navbar-link" href="takeexam.php" title="This Is Online Exam Page"> 
                            <i class="fa fa-1x fa">Take Exam</i>
                        </a>
                    </li>
                </ul>  
                <ul class="nav navbar-nav ml-auto" style="font-family: cursive;"> 
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="profile">
                            <i class="fa fa-1x fa-user"> Profile</i> 
                        </a>
                        <div class="dropdown-content dropdown-menu dropdown-menu-right">
                            <!-- <a class="navbar-link" href="../student/changepasswordstudent.php">
                                <i class="fa fa-1x fa-key text-dark">Change Password</i>
                            </a>  -->
                            <a class="navbar-link" href="../learn/logout.php" title="This Is Leave From Student Page"> 
                                <i class="fa fa-1x fa-sign-out text-dark">Logout</i>
                            </a>                            
                        </div>
                    </li> 
                </ul> 
            </div> 
        </nav>
        <!-- body -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2 col-md-1 sidebar">
                    <br><br><br><br><br><br>
                    <p>Web Camera</p>
                </div>
                <div class="col-sm-10 col-sm-offset-2 col-md-11 col-md-offset-1 main">

<?php
include '../learn/database.php';
$start = $testid - 1;
$select = mysqli_query($conn, "select * from test where exam_id='$exam_id' LIMIT $start, $limit");
$row = mysqli_fetch_array($select);
$_SESSION['question'] = $row['question'];
$_SESSION['a'] = $row['a'];
$_SESSION['b'] = $row['b'];
$_SESSION['c'] = $row['c'];
$_SESSION['d'] = $row['d'];
$question = $_SESSION['question'];
$a = $_SESSION['a'];
$b = $_SESSION['b'];
$c = $_SESSION['c'];
$d = $_SESSION['d'];
$total = ceil($number / $limit);

echo '<div class="row">';
echo '<div class ="col-sm-4">';
echo '<div class="panel panel-default"><div class="panel-body"><center> <font color ="green"><b>The Total_Time Are : ' . $duration1 . '</b></font></center></div></div>';

echo '</div>';
echo '<div class ="col-sm-4">';

echo '<div class="panel panel-default"><div class="panel-body"><center> <font color ="blue"><b>You Can Take The Time : ' . $total_time . '</b></font></center></div></div>';
echo '</div>';
if ($duration1 >= $total_time) {


    echo '<div class ="col-sm-4">';
    $start_time = date('Y-m-d' . $duration1);
    $end_time = date('Y-m-d' . $total_time);
    $difference = abs(strtotime($start_time) - strtotime($end_time));
    $year = floor($difference / (365 * 60 * 60 * 24));
    $month = floor(($difference - $year * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $day = floor(($difference - $year * 365 * 60 * 60 * 24 - $month * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    $hour = floor(($difference - $year * 365 * 60 * 60 * 24 - $month * 30 * 60 * 60 * 24 - $day * 60 * 60 * 24) / (60 * 60));
    $minute = floor(($difference - $year * 365 * 60 * 60 * 24 - $month * 30 * 60 * 60 * 24 - $day * 60 * 60 * 24 - $hour * 60 * 60) / 60);
    $second = floor(($difference - $year * 365 * 60 * 60 * 24 - $month * 30 * 60 * 60 * 24 - $day * 60 * 60 * 24 - $hour * 60 * 60 - $minute * 60));
    if ($second > 9 && $minute <= 9 && $hour <= 9) {
        $remian_time = '0' . $hour . ':0' . $minute . ':' . $second;
    } elseif ($minute > 9 && $second <= 9 && $hour <= 9) {
        $remian_time = '0' . $hour . '  :' . $minute . ' : 0' . $second;
    } elseif ($hour > 9 && $second <= 9 && $minute <= 9) {
        $remian_time = '' . $hour . ':0' . $minut . ' : 0' . $second;
    } elseif ($second > 9 && $minute > 9 && $hour <= 9) {
        $remian_time = '0' . $hour . ':' . $minute . ' : ' . $second;
    } elseif ($second > 9 && $hour > 9 && $minute <= 9) {
        $remian_time = '' . $hour . ':0' . $minute . ' : ' . $second;
    } elseif ($minute > 9 && $hour > 9 && $second <= 9) {
        $remian_time = '' . $hour . ':' . $minute . ':0' . $second;
    } elseif ($second > 9 && $minute > 9 && $hour > 9) {
        $remian_time = '' . $hour . ': ' . $minute . ':' . $second;
    } else {
        $remian_time = '0' . $hour . ':0' . $minute . ':0' . $second;
    }
    echo '<div class="panel panel-default"><div class="panel-body"><center> <font color ="red"><b>The Remain Time Are : ' . $remian_time . '</b></font></center></div></div>';

    echo '</div>';
    echo '</div>';
    if ($testid <= $total) {

        echo'<div class="panel panel-default classes">';
        echo'<div class="panel-heading"><center><p>ONLINE EXAM SYSTEM </p><p><font color="red"><b>Question   ' . $testid . '  of  ' . $number . '</b></font></p></center></div>';
        echo'<div class="panel-body">';
        echo'<div class="row content">';

        echo'<div class="col-sm-12 main">';
        if ($testid != $total && $testid <= 1) {
            echo "<form action='' method = 'POST'>";
            ?>



                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label col-sm-offset-8 col-sm-4" for="question">Question:</label>
                                            <label class="control-label col-sm-offset-8 col-sm-4" for="question">A:</label>
                                            <label class="control-label col-sm-offset-8 col-sm-4" for="question">B:</label>
                                            <label class="control-label col-sm-offset-8 col-sm-4" for="question">C:</label>
                                            <label class="control-label col-sm-offset-8 col-sm-4" for="question">D:</label>
                                        </div>

                                    </div>
                                    <div class="col-sm-9">
                                        <label class="control-lable col-sm-10" for="ques"><?php echo $question; ?></label><br>
                                        <div class="radio">
                                            <label><input type="radio" name="optradio"value="A"><?php echo $a ?></label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="optradio"value="B"><?php echo $b; ?></label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="optradio"value="C"><?php echo $c ?></label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="optradio"value="D"><?php echo $d; ?></label>
                                        </div></div></div>


            <?php
            echo '<div class="form-group right1"> 
                                            <div class="col-sm-offset-2 col-sm-10">';

            echo '<button type="button" class="btn btn-primary disabled"><i class = "fa fa-1x fa-backward">PREVIOUS</i></button>' . '             ';
            echo"<button class = 'btn btn-danger' name ='next'><i class = 'fa fa-1x fa-forward'>NEXT</i></button>";
            echo '</div></div></form>';
        }
        ///testid above two 
        else if ($testid != $total && $testid >= 2 && $testid < $total) {

            echo "<form action='' method = 'POST'>";
            ?>



                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label col-sm-offset-8 col-sm-4" for="question">Question:</label>
                                            <label class="control-label col-sm-offset-8 col-sm-4" for="question">A:</label>
                                            <label class="control-label col-sm-offset-8 col-sm-4" for="question">B:</label>
                                            <label class="control-label col-sm-offset-8 col-sm-4" for="question">C:</label>
                                            <label class="control-label col-sm-offset-8 col-sm-4" for="question">D:</label>
                                        </div>

                                    </div>
                                    <div class="col-sm-9">
                                        <label class="control-lable col-sm-10" for="ques"><?php echo $question; ?></label><br>
                                        <div class="radio">
                                            <label><input type="radio" name="optradio"value="A"><?php echo $a ?></label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="optradio"value="B"><?php echo $b; ?></label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="optradio"value="C"><?php echo $c ?></label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="optradio"value="D"><?php echo $d; ?></label>
                                        </div></div></div>


            <?php
            echo '<div class="form-group right1"> 
                                            <div class="col-sm-offset-2 col-sm-10">';

            echo '<button  class="btn btn-primary " name="previous"><i class = "fa fa-1x fa-backward">PREVIOUS</i></button>' . '             ';
            echo"<button class = 'btn btn-danger' name ='next' type='submit'><i class = 'fa fa-1x fa-forward'>NEXT</i></button>";
            echo '</div></div></form>';
        }

        /// testid is allready total 
        else if ($testid == $total) {
            echo "<form action='' method = 'POST'>";
            echo '<script>alert("dear student the exam questions are allready finish back to the other question first press the finish button")</script>';
            ?>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label col-sm-offset-8 col-sm-4" for="question">Question:</label>
                                            <label class="control-label col-sm-offset-8 col-sm-4" for="question">A:</label>
                                            <label class="control-label col-sm-offset-8 col-sm-4" for="question">B:</label>
                                            <label class="control-label col-sm-offset-8 col-sm-4" for="question">C:</label>
                                            <label class="control-label col-sm-offset-8 col-sm-4" for="question">D:</label>
                                        </div>

                                    </div>
                                    <div class="col-sm-9">
                                        <label class="control-lable col-sm-10" for="ques"><?php echo $question; ?></label><br>
                                        <div class="radio">
                                            <label><input type="radio" name="optradio1"value="A"><?php echo $a ?></label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="optradio1"value="B"><?php echo $b; ?></label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="optradio1"value="C"><?php echo $c ?></label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="optradio1"value="D"><?php echo $d; ?></label>
                                        </div></div></div>


            <?php
            echo '<div class="form-group right1"> 
                                            <div class="col-sm-offset-2 col-sm-10">';
            echo '<button  class="btn btn-primary " name="previous"><i class = "fa fa-1x fa-backward">PREVIOUS</i></button>' . '             ';
            echo"<button type='submit' name ='finish' class = 'btn btn-success'><i class='fa fa-1x fa'>FINISH</i></button>";
            echo '</div></div></form>';

            echo '</div></div>';
        }
    } else
    if ($testid > $total) {

        echo'<div class="panel panel-primary classes">';
        echo'<div class="panel-heading">We Can Answer The Question Below With Result:</div>';
        echo'<div class="panel-body">';
        echo "<form action='takeexamscreen.php?testid=" . ($testid + 1 - 1) . "' method = 'POST'>";
        echo"We Can View The Exam Result Click Here:  <button type='submit' name ='view' class = 'btn btn-success' value='view'><i class='fa fa-1x fa-search'>VIEW</i></button></form>";

        include '../learn/database.php';
        $totalmark = '';
        if (isset($_POST['view'])) {
            $delete = mysqli_query($conn, "delete from resultrecovery where studentid='$userid' AND exam_id='$exam_id'");
            $selectresult = mysqli_query($conn, "select * from examresult where studentid='$userid' AND exam_id='$exam_id'");
            $show = mysqli_fetch_array($selectresult);
            $result = $show['result'];
            $correctr = $show['correct'];
            $incorrectr = $show['incorrect'];
            $exam_id1 = $show['exam_id'];
            $coursecode = mysqli_query($conn, "select * from examlist where exam_id='$exam_id1'");
            $showc = mysqli_fetch_array($coursecode);
            $ccode = $showc['coursecode'];
            $ccode1 = mysqli_query($conn, "select * from course where coursecode='$ccode'");
            $fetch = mysqli_fetch_array($ccode1);
            $coursename = $fetch['coursename'];
            $selectmark = mysqli_query($conn, "select mark from test where exam_id='$exam_id1'");
            while ($row1 = mysqli_fetch_array($selectmark)) {
                $mark = $row1['mark'];
                $totalmark = $totalmark + $mark;
            }
            $percentage = ($result * 100) / ($totalmark);
            $selectcourse = mysqli_query($conn, "select * from coursestudent where studentid='$userid' AND coursecode='$ccode'");
            $course = mysqli_fetch_array($selectcourse);
            $assign1 = $course['assign1'];
            $assign2 = $course['assign2'];
            $quizz = $course['quizz'];
            $test1 = $course['test1'];
            $test2 = $course['test2'];
            $test3 = $course['test3'];

            $final_total = $assign1 + $assign2 + $test1 + $test2 + $test3 + $quizz + $result;
            if (!empty($assign1) && !empty($assign2) && !empty($test1) && !empty($test2) && !empty($test3) && !empty($quizz)) {

                if ($final_total <= 100 && $final_total >= 90) {
                    $grade = 'A+';
                } elseif ($final_total <= 89 && $final_total >= 85) {
                    $grade = 'A';
                } elseif ($final_total <= 84 && $final_total >= 80) {
                    $grade = 'A-';
                } elseif ($final_total <= 79 && $final_total >= 75) {
                    $grade = 'B+';
                } elseif ($final_total <= 74 && $final_total >= 70) {
                    $grade = 'B';
                } elseif ($final_total <= 69 && $final_total >= 65) {
                    $grade = 'B-';
                } elseif ($final_total <= 64 && $final_total >= 61) {
                    $grade = 'C+';
                } elseif ($final_total <= 60 && $final_total >= 51) {
                    $grade = 'C';
                } elseif ($final_total <= 50 && $final_total >= 45) {
                    $grade = 'C-';
                } elseif ($final_total <= 44 && $final_total >= 40) {
                    $grade = 'D';
                } elseif ($final_total <= 39 && $final_total >= 30) {
                    $grade = 'Fx';
                } elseif ($final_total < 30 && $final_total >= 0) {
                    $grade = 'F';
                } else {
                    
                }
            } else {
                $grade = 'NG';
            }
            $coursestudent = mysqli_query($conn, "update coursestudent set final_exam='$result',total='$final_total',grade='$grade' where coursecode='$ccode' AND studentid='$userid'");
            ?>


                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="danger">
                                            <th>Course_Name</th>
                                            <th>Total_Result</th>
                                            <th>Percentage</th>
                                            <th>Correct_Attempt</th>
                                            <th>Incorrect_Attempt</th>
                                        </tr>
                                        <tr class="info"> <td><?php echo $coursename; ?></td>
                                            <td><?php echo $result . '/' . ($totalmark); ?></td>
                                            <td><?php echo $percentage . '%'; ?></td>
                                            <td><?php echo $correctr . '/' . $number; ?></td>
                                            <td><?php echo $incorrectr . '/' . $number; ?></td>
                                        </tr></thead></table>
            <?php
        }
        echo'</div></div>';
    }
}

/////// time is allready up to exam part      
else if ($total_time > $duration1) {
    echo '<div class="alert alert-danger"><strong>TIME UP!</strong> Indicates the duration time is up good lack??</div>';
    include '../learn/database.php';
    $date = date('Y-m-d');
    error_reporting();
    $total_result = '';
    $total_correct = '';
    $total_incorrect = '';
    $select_result = mysqli_query($conn, "select * from resultrecovery where studentid='$userid' AND exam_id='$exam_id'");
    while ($rowfinal = mysqli_fetch_array($select_result)) {
        $total_result_ok = $rowfinal['result'];
        $correct_result = $rowfinal['correct'];
        $incorrect_result = $rowfinal['incorrect'];
        $total_number_row = mysqli_num_rows($select_result);
        $i = 1;
        $i <= $total_number_row;
        $i++;
        $total_result = $total_result + $total_result_ok;
        $total_correct = $total_correct + $correct_result;
        $total_incorrect = $total_incorrect + $incorrect_result;
    }
    $view_table = mysqli_query($conn, "select * from examresult where studentid='$userid' AND exam_id='$exam_id'");
    if (mysqli_num_rows($view_table) >= 1) {

        $select_code = mysqli_query($conn, "select * from examlist where exam_id='$exam_id'");
        $select_code_row = mysqli_fetch_array($select_code);
        $ccoderesult = $select_code_row['coursecode'];
        $time_limit_result = mysqli_query($conn, "select * from coursestudent where studentid='$userid' AND coursecode='$ccoderesult'");
        $time_limit_row = mysqli_fetch_array($time_limit_result);
        $time_assign1 = $time_limit_row['assign1'];
        $time_assign2 = $time_limit_row['assign2'];
        $time_quizz = $time_limit_row['quizz'];
        $time_test1 = $time_limit_row['test1'];
        $time_test2 = $time_limit_row['test2'];
        $time_test3 = $time_limit_row['test3'];
        $time_final_total = $time_assign1 + $time_assign2 + $time_test1 + $time_test2 + $time_test3 + $time_quizz + $total_result;
        if (!empty($time_assign1) && !empty($time_assign2) && !empty($time_test1) && !empty($time_test2) && !empty($time_test3) && !empty($time_quizz)) {
            if ($time_final_total <= 100 && $time_final_total >= 90) {
                $time_grade = 'A+';
            } elseif ($time_final_total <= 89 && $time_final_total >= 85) {
                $time_grade = 'A';
            } elseif ($time_final_total <= 84 && $time_final_total >= 80) {
                $time_grade = 'A-';
            } elseif ($time_final_total <= 79 && $time_final_total >= 75) {
                $time_grade = 'B+';
            } elseif ($time_final_total <= 74 && $time_final_total >= 70) {
                $time_grade = 'B';
            } elseif ($time_final_total <= 69 && $time_final_total >= 65) {
                $time_grade = 'B-';
            } elseif ($time_final_total <= 64 && $time_final_total >= 61) {
                $time_grade = 'C+';
            } elseif ($time_final_total <= 60 && $time_final_total >= 51) {
                $time_grade = 'C';
            } elseif ($time_final_total <= 50 && $time_final_total >= 45) {
                $time_grade = 'C-';
            } elseif ($time_final_total <= 44 && $time_final_total >= 40) {
                $time_grade = 'D';
            } elseif ($time_final_total <= 39 && $time_final_total >= 30) {
                $time_grade = 'Fx';
            } elseif ($time_final_total < 30 && $time_final_total >= 0) {
                $time_grade = 'F';
            } else {
                
            }
        } else {
            $time_grade = 'NG';
        }
        mysqli_query($conn, "update coursestudent set final_exam='$total_result',total='$time_final_total',grade='$time_grade' where coursecode='$ccoderesult' AND studentid='$userid'");
        ?>

                            <div class="panel panel-primary">
                                <div class="panel-heading">The Result For The Exam</div>
                                <div class="panel-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Total_Result</th>
                                                <th>Correct_Attempt</th>
                                                <th>Incorrect_Attempt</th>
                                                <th>Time_take</th>
                                            </tr>
                                        </thead>
        <?php
        echo '<tr>';
        echo '<td>' . $total_result . '</td><td>' . $total_correct . '</td><td>' . $total_incorrect . '</td><td>' . $total_time . '</td></tr>';
    } else {
        $time_up_result = mysqli_query($conn, "insert into examresult values('','$userid','$exam_id','$total_result','$total_correct','$total_incorrect','$date','')");

        // mysqli_query($conn, "delete from resultrecovery where exam_id='$exam_id' AND studentid='$userid'");
    }
}
?>
                            </table>
                        </div></div>
                </div>


            </div>   
        </div>
    </body>
    <?php include '../shared/footer.php'; ?>
</html>

