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
<html>
    <head>
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


            <div class="nav-md">
                <div class="container body">
                    <div class="main_container">

                        <div class="col-md-3 left_col menu_fixed">

                            <div class="left_col scroll-view">
                                <div class="clearfix"></div>
                                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                                    <div class="menu_section">
                                        <br> <br> <br> <br> <br>
                                        <h3>Faculity</h3>
                                        <?php
                                        include '../learn/database.php';
                                        $select = mysqli_query($conn,"select DISTINCT faculity from department");
                                        while ($row3 = mysqli_fetch_array($select)) {
                                            $faculity = $row3['faculity'];
                                            ?>
                                            <ul class="nav side-menu">
                                                <li><a><i class="fa fa-home"></i> <?php echo $faculity; ?> <span class="fa fa-chevron-down"></span></a>
                                                    <ul class="nav child_menu">
                                                        <?php
                                                        $select1 = mysqli_query($conn,"select * from department where faculity='$faculity' ORDER BY faculity DESC");
                                                        while ($row = mysqli_fetch_array($select1)) {
                                                            $departmentname = $row['departmentname'];
                                                            $departmentid = $row['departmentid'];

                                                            echo' <li><a><i class="fa fa-edit"></i>' . strtoupper($departmentname) . ' <span class="fa fa-chevron-down"></span></a>';
                                                            echo '<ul class="nav child_menu">';
                                                            $select2 = mysqli_query($conn,"select DISTINCT year from student where departmentid='$departmentid'");
                                                            while ($row4 = mysqli_fetch_array($select2)) {
                                                                echo' <li><a href="updatestudentinfo.php?deptid=' . $departmentid . '&&year=' . $row4['year'] . '">Year    ' . $row4['year'] . '</a></li>';
                                                            }
                                                            echo '</ul>';
                                                            echo'</li>';
                                                        }
                                                        ?> 
                                                    </ul>
                                                </li>
                                            </ul>
                                            <?php
                                        }
                                        ?>

                                    </div>


                                </div>

                            </div>
                        </div>
                        <div class="right_col" role="main">
                            <br> <br> <br> <br> <br>

                            <?php
                            if (isset($_GET['deptid'])) {
                                $departmentid1 = $_GET['deptid'];
                                $year = $_GET['year'];
                                $query = mysqli_query($conn,"select * from student where departmentid='$departmentid1' AND year ='$year'");
                                $number = mysqli_num_rows($query);
                                ?>
                                <div class="col-md-11 col-sm-1 col-xs-12">
                                    <div class="x_panel">

                                        <div class="x_content">

                                            <form action="" method="post">
                                                <table class="table table-striped">
                                                    <tr class="danger">
                                                        <td>Student_Id</td>
                                                        <td>First_Name</td>
                                                        <td>Middle_Name</td>
                                                        <td>Last_Name</td>
                                                        <td>Sex</td>
                                                        <td>Year</td>
                                                        <td>Semister</td>
                                                    </tr>

                                                    <?php
                                                    error_reporting(0);
                                                    $select3 = mysqli_query($conn,"select * from student where departmentid='$departmentid1' AND year='$year'");
                                                    $i = 1;
                                                    while ($row1 = mysqli_fetch_array($select3)) {
                                                        $i <= $number;
                                                        $studentid = $row1['studentid'];
                                                        $firstname = $row1['firstname'];
                                                        $middlename = $row1['middlename'];
                                                        $lastname = $row1['lastname'];
                                                        $sex = $row1['sex'];
                                                        $year = $row1['year'];
                                                        $semister = $row1['semister'];
                                                        ?>

                                                        <tr>

                                                            <td size="2%"><?php echo $studentid; ?> </td>
                                                        <input type="hidden"name="studentid<?php echo $i; ?>" value="<?php echo $studentid; ?>" >
                                                        <td size="2%"> <input name="firstname<?php echo $i; ?>" value="<?php echo $firstname; ?>"size="5%"></td>
                                                        <td size="2%"> <input name="middlename<?php echo $i; ?>" value="<?php echo $middlename; ?>"size="5%"></td>
                                                        <td size="2%"> <input name="lastname<?php echo $i; ?>" value="<?php echo $lastname; ?>"size="5%"></td>
                                                        <td size="2%"> <input name="sex<?php echo $i; ?>" value="<?php echo $sex; ?>"size="5%"></td>
                                                        <td size="2%"> <input name="year<?php echo $i; ?>" value="<?php echo $year; ?>"size="5%"></td>
                                                        <td size="2%"> <input name="semister<?php echo $i; ?>" value="<?php echo $semister; ?>"size="5%"></td>
                                                        </tr>
                                                        <input type="hidden" name="number" value="<?php echo $number; ?>">
                                                        <input type="hidden" name="department" value="<?php echo $departmentid1; ?>">
                                                        <?php
                                                    }
                                                    ?>
                                                </table>
                                                <div class="form-group">        
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <button type="submit" class="btn btn-default btn-warning" name="update" >Update</button>

                                                    </div>
                                                </div>
                                            </form>   </div>
                                    </div>
                                </div><?php }
                                                ?>

                            <?php
                            if (isset($_POST['update'])) {
                                $total_number = $_POST['number'];
                                $departmentid2 = $_POST['department'];
                                for ($i = 1; $i <= $total_number; $i++) {
                                    $studentid1 = $_POST["studentid$i"];
                                    $firstname1 = $_POST["firstname$i"];
                                    $middlename1 = $_POST["middlename$i"];
                                    $lastname1 = $_POST["lastname$i"];
                                    $sex = $_POST["sex$i"];
                                    $year = $_POST["year$i"];
                                    $semister = $_POST["semister$i"];
                                    $up = mysqli_query($conn,"update student set firstname = '$firstname1' , middlename='$middlename1', lastname='$lastname1', sex='$sex' ,year='$year',semister='$semister' where departmentid='$departmentid2' AND studentid='$studentid1'");
                                    if (!$up) {
                                        echo mysqli_error();
                                    } else {
                                        echo 'ok';
                                    }
                                }
                            }
                            ?>

                        </div>

                    </div>
                </div></div> 









    </body>
    <?php include '../shared/footer.php'; ?>
</html>



