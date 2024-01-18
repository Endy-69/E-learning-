<?php
session_start();
include("../learn/database.php");
if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
} else {
    header("Location: ../learn/login.php");
}
?><html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <script src="../js/depthead.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/innstructor.js" type="text/javascript"></script>
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
                        <a class="navbar-link" href="../instructor/instructor.php" title="This is Home Page Of Instructor">
                            <i class="fa fa-1x fa">Home</i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This is Upload Resource To The Student"> 
                            <i class="fa fa-1x fa">Upload</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="uploadcoursematerial.php" title="This is upload Resource Material To The Department Student"> Course Material</a>
                            <a href="uploadassignmentquestion.php"title="This is Assignment Question To The Student">Assignment Question</a>
                            <a href="../instructor/uploadexam.php" title="This is Evaluation Exam To The Course Student"> Exam</a>
                            <a href="../instructor/uploadcourseresult.php"title="This is Upload Student Result To The Student For The Course">Course Result</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This is Download Resource Material ">
                            <i class="fa fa-1x fa"> Download</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="downloadannualcalendar.php" title="This is Download The Caricullem Calendar From The Registrar Officer">Annual Calendar</a>
                            <a href="downloadstudentlist.php" title="This is Download Student List From The Department"> Student List</a>
                            <a href="downloadassignmentanswer.php" title="This is Download Assignment Answer Upload By The Student">Assignment Answer</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This is View Notice Page Release From The Department"> 
                            <i class="fa fa-1x fa">View</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="viewnotice.php"> Notice</a>
                        </div>
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
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <?php include '../shared/sidebar.php'; ?>
                </div>
                <div class="col-sm-12 col-md-9"> 
                    <div class="card border-info">
                        <div class="card-header bg-info">
                            <h5 class="card-title">View The Notice Upload Pages</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            include("../learn/database.php");
                            $sql = mysqli_query($conn,"select * from courseinstructor where instructorid='$userid'");
                            $row = mysqli_fetch_array($sql);
                            $coursecode = $row['coursecode'];
                            $sql1 = mysqli_query($conn,"select * from course where coursecode='$coursecode'");
                            $row1 = mysqli_fetch_array($sql1);
                            $dept = $row1['departmentid'];
                            $select = mysqli_query($conn,"select * from departmenthead where departmentid='$dept'");
                            $row2 = mysqli_fetch_array($select);
                            $name = $row2['firstname'] . '   ' . $row2['lastname'];
                            $select5 = mysqli_query($conn,"select * from department where departmentid='$dept'");
                            $row5 = mysqli_fetch_array($select5);
                            $deptname = $row5['departmentname'];

                            echo'<p>View notice for That can be realsed by the department head of  ' . '<font color="red"><b>' . $deptname . ' ATO  ' . $name . '</b></font>' . '  to give announces!!!!</p>';
                            ?>
                            <table class="table">
                                <thead>
                                    <tr class="info">
                                        <th>#</th>
                                        <th>Description</th>
                                        <th>File_type</th>
                                        <th> View</th>
                                    </tr>
                                </thead>
                                <?php
                                include("../learn/database.php");
                                $select3 = mysqli_query($conn,"select * from courseinstructor where instructorid='$userid'");
                                $row3 = mysqli_fetch_array($select3);
                                $coursecode1 = $row3['coursecode'];
                                $select1 = mysqli_query($conn,"select * from course where coursecode='$coursecode1'");
                                $row4 = mysqli_fetch_array($select1);
                                $dept1 = $row4['departmentid'];
                                $year = $row4['year'];
                                $select2 = mysqli_query($conn,"select * from notice where departmentid='$dept1' AND year='$year'");
                                $i = 1;
                                while ($row3 = mysqli_fetch_array($select2)) {
                                    $select4 = mysqli_query($conn,"select * from department where departmentid='$dept1'");
                                    $fetch = mysqli_fetch_array($select4);
                                    $departmentname = $fetch['departmentname'];
                                    ?>
                                    <tr class="active"> 
                                        <td> <?php echo $i++ ?></td>
                                        <td> <?php echo $row3['description'] ?></td>
                                        <td> <?php echo $row3['filetype'] ?></td>
                                        <td><a href="notice/<?php echo $row3['filename'] ?>" target="_self" data-toggle="tooltip" data-placement="left" 
                                                title="NOTICE
                                                <?php
                                                echo 'FOR DEPARTMENT OF ' . strtoupper($departmentname);

                                                echo 'FOR YEAR ' . $row3['year'];
                                                ?>">view file</button></a></td>
                                    </tr>
                                <?php }
                                ?>
                            </table>
                        </div>

                    </div>               
                    <script>
                        $(document).ready(function () {
                            $('[data-toggle="tooltip"]').tooltip();
                        });
                    </script> 
                </div>
            </div>
        </div>  
    </body>
    <?php include '../shared/footer.php'; ?>
</html>


