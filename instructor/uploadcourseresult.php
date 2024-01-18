<?php
session_start();
include("../learn/database.php");
if (isset($_SESSION['userid']) && ($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $userid = $_SESSION['userid'];
} else {
    header("Location: ../learn/login.php");
}
?><html>
    <head>
     <script src="../js/depthead.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/innstructor.js" type="text/javascript"></script>
        <link href="../css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="../left/bootstrap.min1.css" rel="stylesheet" type="text/css"/>
        <script src="../left/bootstrap.min1.js" type="text/javascript"></script>
        <link href="../left/custom1.css" rel="stylesheet" type="text/css"/>
        <script src="../left/jquery.min1.js" type="text/javascript"></script> 
        <script>
            $(function () {

                $('.number-only').keypress(function (e) {
                    if (isNaN(this.value + "" + String.fromCharCode(e.charCode)))
                        return false;
                })
                        .on("cut copy paste", function (e) {
                            e.preventDefault();
                        });

            });
        </script>
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
                        <a class="navbar-link" href="instructor.php" title="This is Home Page Of Instructor">
                            <i class="fa fa-1x fa">Home</i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This is Upload Resource To The Student"> 
                            <i class="fa fa-1x fa">Upload</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/uploadcoursematerial.php" title="This is upload Resource Material To The Department Student"> Course Material</a>
                            <a href="../updownload/uploadassignmentquestion.php"title="This is Assignment Question To The Student">Assignment Question</a>
                            <a href="uploadexam.php" title="This is Evaluation Exam To The Course Student"> Exam</a>
                            <a href="uploadcourseresult.php"title="This is Upload Student Result To The Student For The Course">Course Result</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This is Download Resource Material "><i class="fa fa-1x fa"> Download</i></a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/downloadannualcalendar.php" title="This is Download The Caricullem Calendar From The Registrar Officer">Annual Calendar</a>
                            <a href="../updownload/downloadstudentlist.php" title="This is Download Student List From The Department"> Student List</a>
                            <a href="../updownload/downloadassignmentanswer.php" title="This is Download Assignment Answer Upload By The Student">Assignment Answer</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This is View Notice Page Release From The Department"> 
                            <i class="fa fa-1x fa">View</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/viewnotice.php"> Notice</a>
                        </div>
                    </li>  
                </ul>
                <ul class="nav navbar-nav ml-auto" style="font-family: cursive;"> 
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="profile">
                            <i class="fa fa-1x fa-user"> Profile</i>
                            <i class="fa fa-sm fa-1x fa-chevron-down"></i>
                        </a>
                        <div class="dropdown-content dropdown-menu dropdown-menu-right">
                            <a class="navbar-link" href="changepasswordinstructor.php" title="">
                                <i class="fa fa-1x fa-key text-dark">Change Password</i>
                            </a> 
                            <a class="navbar-link" href="../learn/logout.php" title="This is Leave From The Home Page Of Instructor"> 
                                <?php echo  $username?> <i class="fa fa-1x fa-sign-out text-dark">Logout</i>
                            </a>                            
                        </div>
                    </li> 
                </ul> 
            </div> 
        </nav> 


        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-5"> 
                    <div class="card border-info">
                        <div class="card-header bg-info">list of Student Upload course_result For These Course</div>
                        <div class="card-body">
                            <table class="table table-bordered">

                                <tr class="info">
                                    <th>C_code</th>
                                    <th>Sec</th>
                                    <th>Student_id</th>
                                    <th>View</th>
                                </tr>
                                <?php
                                include '../learn/database.php';
                                $selectr = mysqli_query($conn,"select * from courseinstructor where instructorid='$userid'");
                                while ($row = mysqli_fetch_array($selectr)) {
                                    $coursecode = $row['coursecode'];
                                    $section = $row['section'];
                                    $rightcs = mysqli_query($conn,"select *  from student where section='$section'");
                                    while ($row2 = mysqli_fetch_array($rightcs)) {
                                        $studentid = $row2['studentid'];
                                        
                                            $selectsql = mysqli_query($conn,"select * from coursestudent where studentid='$studentid' AND coursecode='$coursecode'");
                                            while ($row1 = mysqli_fetch_array($selectsql)) {
                                                echo '<tr>';
                                                echo '<td>' . $coursecode . '</td><td>' . $section . '</td><td>' . $row1['studentid'] . '</td><td><a href=viewstudentresult.php?viewst=' . $row2['studentid'] . '&coursecode=' . $coursecode . '>  <button type="button" class="btn btn-warning"><span class="fa fa-1x fa">View</span></button></a></td></tr>';
                                            }
                                        }
                                    }
                                
                                ?>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-7">
                    <div class="card border-info">
                        <div class="card-header bg-info">SELECT THE COURSE NAME FOR UPLOAD STUDENT RESULT</div>
                        <div class="card-body">
                            <form class="form-horizontal" role="form"method="post"action="uploadcourseresult.php">
                                <?php
                                include '../learn/database.php';
                                $select = mysqli_query($conn,"select DISTINCT coursecode from courseinstructor where instructorid='$userid'");
                                ?>
                                <div class="form-group">
                                    <label class="control-label" for="cc">Course Name:</label> 
                                    <select class="form-control" name="coursecodevalue">
                                        <?php
                                            while ($row4 = mysqli_fetch_array($select)) {
                                            $value = $row4['coursecode'];


                                            $select5 = mysqli_query($conn,"select DISTINCT coursename from course where coursecode='$value'");
                                            $row5 = mysqli_fetch_array($select5);
                                            $coursename = $row5['coursename'];
                                        ?>
                                            <option value="<?php echo $value; ?>"><?php echo $coursename; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select> 
                                </div>
                                <div class="form-group float-right">         
                                    <button type="submit" class="btn btn-lg btn-danger"name="select"><i class="fa fa-1x fa">Select</i></button> 
                                </div>
                            </form>
                            <br><br>
                            <hr style="height: 5px; color: brown;"/>
                            <div class="row content">
                                <div class="col-sm-2 sidenav"></div>
                                <div class="col-sm-8 text-left">

                                <?php
                                    include("../learn/database.php");
                                    if (isset($_POST['select'])) {
                                        echo'<div class="card border-info">
                                            <div class="card-body">';
                                        $band = '';
                                        $coursecode1 = $_POST['coursecodevalue'];
                                        echo $coursecode1;
                                        $selectcoursename = mysqli_query($conn,"select * from course where coursecode='$coursecode1'");
                                        $rowcoursename = mysqli_fetch_array($selectcoursename);
                                        $coursename = $rowcoursename['coursename'];
                                        $selectsection = mysqli_query($conn,"select DISTINCT section from courseinstructor where coursecode='$coursecode1' AND instructorid='$userid'");
                                        while ($row3 = mysqli_fetch_array($selectsection)) {
                                            $sectionvalue = $row3['section'];

                                            $selectstudent = mysqli_query($conn,"select * from student where section ='$sectionvalue'");
                                            while ($row6 = mysqli_fetch_array($selectstudent)) {
                                                $studentidvalue = $row6['studentid'];

                                                $selectfinal = mysqli_query($conn,"select * from coursestudent where coursecode='$coursecode1' AND studentid='$studentidvalue'");
                                                if (mysqli_num_rows($selectfinal) >= 1) {
                                                    $number = mysqli_num_rows($selectfinal);
                                                    $band = $band + $number;
                                                }
                                            }
                                        }

                                        echo '<font color="blue"><b><center>';
                                        echo 'Course_Name:  ' . $coursename;
                                        ;
                                        echo '<br>';
                                        echo '<br>';
                                        echo 'Course_Code:   ' . $coursecode1;
                                        echo '<br>';
                                        echo '<br>';
                                        echo 'Total_Number Of Student::  ' . $band;
                                        echo '<br>';
                                        echo '<br>';
                                        echo'<a href="uploadcourseresultscreen.php?coursecode=' . $coursecode1 . '"><button type="button" class="btn btn-success"><i class="fa fa-1x fa-arrow-long-right"></i> Continue</button></a>';
                                        echo '</center></b></font>';
                                        echo '</div></div>';
                                    }
                                ?> 
                            </div>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
    </body>
    <?php include '../shared/footer.php'; ?>
</html>



