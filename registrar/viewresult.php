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
<html lang="en">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <link href="../css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/> 
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
                        <a class="navbar-link" href="registrar.php" title="This Registrar Home Page">
                            <i class="fa fa-1x fa">Home</i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href=""title="This Upload Resource Page To The Department">
                            <i class="fa fa-1x fa">Upload</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/uploadannualcalendar.php" title="This Upload Annual Calendar To The Department">Annual Calendar</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href=""title="This Registrar Information Page"><i class="fa fa-1x fa">Register</i></a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="registercourse.php" title="This Register Course For Each Department">Course</a>
                            <a href="registerdepartment.php" title="This Register Department For Each Faculity">Department</a>
                            <a href="registerinstructor.php" title="This Register Instructor For Each Department">Instructor</a>
                            <a href="registerstudent.php" title="This Register student For Each Department">Student</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href=""title="This Registrar capacity Page"><i class="fa fa-1x fa">Capacity</i></a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="coursecapacity.php" title="This Register Course For Each Department">Course Capacity</a>
                            <a href="instructorcapacity.php" title="This Register Department For Each Faculity">Inctructor Capacity</a> 
                        </div>
                    </li> 
                    <li class="tab">
                        <a class="navbar-link" href="viewresult.php" title="This View Student Result For Each Department">
                            <i class="fa fa-1x fa"> View Student Result</i>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right"> 
                    <li class="dropdown">
                        <a class="navbar-link unstyled" href="" title="profile">  
                            <?php echo  $username?>
                            <i class="fa fa-sm fa-1x fa-chevron-down"></i>
                        </a>
                        <div class="dropdown-content dropdown-menu dropdown-menu-right">
                            <a class="navbar-link" href="changepassword1.php" title="">
                                <i class="fa fa-1x fa-key text-dark">Change Password</i>
                            </a> 
                            <a class="navbar-link" href="../learn/logout.php" title="This is Leave From The Home Page Of admin"> 
                                <i class="fa fa-1x fa-sign-out text-dark">Logout</i>
                            </a>                            
                        </div>
                    </li>  
                </ul> 
            </div>
        </nav> 


        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-4" > 
                    <div id="sidebar-menu" class="hidden-print card border-info"> 
                        <h5 class="card-header bg-info">Lists of Departments</h5>
                        <div class="card-body">
                            <?php
                            include '../learn/database.php';
                            $select = mysqli_query($conn,"select DISTINCT faculity from department"); 
                            while ($row3 = mysqli_fetch_array($select)) {
                                $faculity = $row3['faculity'];
                                $select1 = mysqli_query($conn,"select * from department where faculity='$faculity' ORDER BY faculity DESC");
                                    while ($row = mysqli_fetch_array($select1)) {
                                        $departmentname = $row['departmentname'];
                                        $departmentid = $row['departmentid'];
                                    ?>
                                    <?php 
                                    echo'<a id="lists" class="text-info" href="viewresult.php?deptid=' . $departmentid . '">' . strtoupper($departmentname) . '</a> <br>';
                                }
                                ?>  
                                <?php
                            }
                            ?> 
                        </div>
                    </div> 
                </div>                            
                <div class="col-sm-12 col-md-8"> 
                    <?php
                    error_reporting(0);
                    include '../learn/database.php';

                    if (isset($_GET['deptid'])) {
                        $deptid = $_GET['deptid'];
                        $query1 = mysqli_query($conn, "select * from course where departmentid ='$deptid' ORDER BY year ASC");
                        if (mysqli_num_rows($query1) >= 1) {
                            while ($row1 = mysqli_fetch_array($query1)) {
                                $course_code = $row1['coursecode'];
                                $course_name = $row1['coursename'];
                                $year = $row1['year'];
                                $empty = '';
                                $select = mysqli_query($conn, "select * from coursestudent where coursecode='$course_code' AND approve='0'");
                                if (mysqli_num_rows($select) < 1) {
                                    $echo = 'THERE IS NO RESULT REALSE IN THESE DEPARTMENT TO APPROVE TO THE REGISTRAR OFFICER';
                                } else {
                                    ?>
                                    <div class="card border-danger">
                                        <div class="card-header bg-danger">
                                            <?php echo '   Course_Name:    <font color="">' . strtoupper($course_name) . ' </font>  AND   Year   ' . $year; ?>
                                        </div>
                                        <div class="card-body">
                                            <form class="form-horizontal" role="form" method="post" action="">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Student_Id</th>
                                                            <th>Assesment/60%</th>
                                                            <th>Final_Exam/40%</th>
                                                            <th>Grade</th>
                                                            <th>Select </th>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                    while ($row2 = mysqli_fetch_array($select)) {
                                                        $assement = $row2['assign1'] + $row2['assign2'] + $row2['quizz'] + $row2['test1'] + $row2['test2'] + $row2['test3'];
                                                        if (!empty($row2['grade'])) {
                                                            echo '<tr>';
                                                            echo'<td>' . $row2['studentid'] . '</td><td>' . $assement . '</td><td>' . $row2['final_exam'] . '</td><td>' . $row2['grade'] . '</td>';
                                                            echo'<td><input type="checkbox" value="' . $row2['studentid'] . '" name="studentresultapprove[]"></td>';
                                                            echo '<input type="hidden" value="' . $course_code . '" name="coursecode">';
                                                            echo '</tr>';
                                                        }
                                                    }
                                                    ?>
                                                </table>

                                                <div class="form-group float-right">  
                                                    <button type="submit" class="btn btn-warning" name="request">Request</button>
                                                    <button type="submit" class="btn btn-success" name="approve">Approve</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            if ($echo == 'THERE IS NO RESULT REALSE IN THESE DEPARTMENT TO APPROVE TO THE REGISTRAR OFFICER') {
                                echo '<div class="alert alert-info"><strong>Info!</strong> ' . $echo . ' FOR ALL COURSE</div>';
                            }
                        } else if (mysqli_num_rows($query1) < 1) {
                            echo '<div class="alert alert-danger"><strong>Danger!</strong> IN THESE DEPARTMENT THERE IS NO COURSE RELEASE TO GIVE REQUEST TO THE REGISTRAR OFFICER.</div>';
                        }
                    }
                    ?>
                    <?php
                    include '../learn/database.php';
                    if (isset($_POST['approve'])) {
                        $student_result_approve = $_POST['studentresultapprove'];
                        $course_code_approve = $_POST['coursecode'];
                        foreach ($student_result_approve as $value) {
                            $one = '1';
                            $update = mysqli_query($conn, "update coursestudent set approve = '$one' where studentid='$value' AND coursecode='$course_code_approve'");
                            if ($update) {
                                echo 'ok';
                                echo $value;
                                echo $course_code_approve;
                            } else {
                                echo mysqli_error();
                            }
                        }
                    }
                    ?>
                    <?php
                    include '../learn/database.php';
                    if (isset($_POST['request'])) {
                        $student_result_request = $_POST['studentresultapprove'];
                        $course_code_request = $_POST['coursecode'];
                        foreach ($student_result_request as $student_result_request1) {
                            $select1 = mysqli_query($conn, "select* from student where studentid='$student_result_request1'");
                            $fetch = mysqli_fetch_array($select1);
                            $section = $fetch['section'];
                            $one = '-1';
                            $update1 = mysqli_query($conn, "update coursestudent set approve = '$one' where studentid='$student_result_request1' AND coursecode='$course_code_request'");
                            if (!$update1) {
                                echo mysqli_error();
                            }
                        }
                    }
                    ?>

                </div> 
            </div>
        </div> 
    </body>
    <?php include '../shared/footer.php'; ?>
</html>



