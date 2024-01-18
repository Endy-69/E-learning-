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
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/jquery.min.js"></script>

        <link href="../css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>  
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
                        <a class="navbar-link" href="../student/student.php"  title="This Is Home page Of Student"> 
                            <i class="fa fa-1x fa">Home</i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This Is Upload Resource To The Instructor">
                            <i class="fa fa-1x fa">Upload</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="uploadassignmentanswer.php" title="This Is Upload Assignment Question"> Assignment Answer</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This Is Download Resource Material">
                            <i class="fa fa-1x fa">Download</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="downloadassignmentquestion.php" title="This Is Download Assignment Questions">Assignment Question</a>
                            <a href="downloadcoursematerial.php" title="This Is Download Course_Material"> Course Materialt</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This Is View Resource Page">
                            <i class="fa fa-1x fa">View</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="viewnoticest.php" title="This Is View Notice Page From Department"> Notice</a>
                            <a href="../student/viewcourseresult.php" title="This Is View Course Result ">Course result</a>
                        </div>
                    </li>  
                    <li class="tab">
                        <a class="navbar-link" href="../student/takeexam.php" title="This Is Online Exam Page"> 
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
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-sm-5 col-md-4"> 
                    <?php 
                        include '../shared/sidebar.php';
                    ?>
                </div>

                <div class="col-sm-7 col-md-8">
                    <div class="card border-info">
                        <div class="card-header bg-info">View Notice Pages</div>
                        <div class="card-body">

                            <?php
                                error_reporting(0);
                                include("../learn/database.php");
                                $sql = mysqli_query($conn,"select * from coursestudent where studentid='$userid'");
                                $row = mysqli_fetch_array($sql);
                                $coursecode = $row['coursecode'];
                                $sql1 = mysqli_query($conn,"select * from course where coursecode='$coursecode'");
                                $row1 = mysqli_fetch_array($sql1);
                                $dept = $row1['departmentid'];
                                $departmentna = mysqli_query($conn,"select * from department where departmentid='$dept'");
                                $rowdept = mysqli_fetch_array($departmentna);
                                $deptname = $rowdept['departmentname'];

                                echo'<p>View notice for That can be realsed by the department head of  ' . '<font color="red"><b>' . $deptname . '</b></font>' . '  to give announces!!!!</p>';
                            ?>
                            <table class="table">
                                <thead>
                                    <tr class="info">
                                        <th scope="row">#</th>
                                        <th scope="row">Description</th>
                                        
                                        <th scope="row"> View</th>
                                    </tr>
                                </thead>
                                <?php
                                    error_reporting(0);
                                    include("../learn/database.php");
                                    $select = mysqli_query($conn,"select * from student where studentid='$userid'");
                                    $row4 = mysqli_fetch_array($select);

                                    $dept1 = $row4['departmentid'];
                                    $year = $row4['year'];
                                    $select2 = mysqli_query($conn,"select * from notice where departmentid='$dept1' AND year='$year'");
                                    $i = 1;
                                    while ($row3 = mysqli_fetch_array($select2)) {
                                        $date1 = $row3['created'];

                                        $date2 = date('Y-m-d');

                                        $diff = abs(strtotime($date2) - strtotime($date1));

                                        $years = floor($diff / (365 * 60 * 60 * 24));
                                        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                                        ?>
                                        <tr class="active"> 
                                            <td> <?php echo $i++ ?></td>
                                            <td>  <?php echo $row3['description'] ?></td>
                                            
                                            <td><a href="notice/<?php echo $row3['filename'] ?>" target="_self"><i class="fa fa-1x text-danger fa-eye" aria-hidden="true" style="color: red;"></i></a></td>
                                        </tr>
                                    <?php 
                                        }
                                ?>
                            </table>
                        </div>
                    </div> 
                </div>
            </div>
        </div> 
    </body>
    <?php include '../shared/footer.php'; ?>
</html>

