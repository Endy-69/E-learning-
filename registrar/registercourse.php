<?php
error_reporting(0);
session_start();
include("../learn/database.php");
if (isset($_SESSION['userid']) && ($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $userid = $_SESSION['userid'];
} else {
    header("Location: ../learn/login.php");
}
?>
<html>
    <head>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/jquery.min.js"></script>

        <link href="../css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="../left/bootstrap.min1.css" rel="stylesheet" type="text/css"/>
        <script src="../left/bootstrap.min1.js" type="text/javascript"></script>
        <link href="../left/custom1.css" rel="stylesheet" type="text/css"/>
        <script src="../left/jquery.min1.js" type="text/javascript"></script>
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
                                    echo'<a id="lists" class="text-info" href="registercourse.php?deptid=' . $departmentid . '">' . strtoupper($departmentname) . '</a> <br>';
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
                    include("../learn/database.php");
                    if (isset($_GET['deptid'])) {
                        $departmentid = $_GET['deptid'];
                        $query1 = mysqli_query($conn,"select * from department where departmentid='$departmentid'");
                        while ($row = mysqli_fetch_array($query1)) {
                            $departmentid = $row['departmentid'];
                            $department = $row['departmentname'];
                            ?>
                            <div class="card border-info">
                                <div class="card-header bg-info">Lists of courses in Department of  <font color="red"><?php echo strtoupper($department); ?></font></div>
                                <div class="card-body">
                                    <div class=" text-right">  
                                        <?php echo'<a class="btn btn-danger" href="registercourse1.php?add=' . $departmentid . '">
                                        <i class="fa fa-1x fa-plus-square-o text-dark"></i> Add new course</a>'; ?>
                                    </div>
                                    <?php
                                    $select = mysqli_query($conn,"select * from course where departmentid='$departmentid' ORDER BY year ASC");
                                    if (mysqli_num_rows($select) >= 1) {
                                        ?>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="info">
                                                    <th>Course_Code</th>
                                                    <th>Course_Name</th>
                                                    <th>Credit_Hour</th>
                                                    <th>Year</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($row2 = mysqli_fetch_array($select)) {
                                                    echo '<tr>';
                                                    echo '<td>' . $row2['coursecode'] . '</td><td>' . $row2['coursename'] . '</td><td>' . $row2['credithour'] . '</td><td>' . $row2['year'] . '</td></tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php
                            } else {
                                echo '<div class="alert alert-danger" role="alert">
                                    There is no any registered course the department
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
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























































































































































































































































































