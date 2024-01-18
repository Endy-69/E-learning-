<?php
session_start();
include("../learn/database.php");
if (isset($_SESSION['userid']) && ($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $userid = $_SESSION['userid'];
} else {
    header("Location: ../learn/login.php");
}
?>html>
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
                <div class="col-sm-12 col-md-3"> 
                    <?php
                    include '../learn/database.php';
                    $total_number = '';
                    if (isset($_GET['course_code']) && $_GET['section']) {
                        $course_code = $_GET['course_code'];
                        $section = $_GET['section'];
                        $select = mysqli_query($conn,"select * from student where section='$section'");
                        while ($row1 = mysqli_fetch_array($select)) {
                            $studentid = $row1['studentid'];
                            $query = mysqli_query($conn,"select * from coursestudent where coursecode='$course_code' AND studentid='$studentid' AND approve='-1'");
                            if (mysqli_num_rows($query) >= 1) {
                                $total = mysqli_num_rows($query);
                                $total_number = $total_number + $total;
                            }
                        }
                    }
                    ?>
                </div>
                <div class="col-sm-12 col-md-9">
                    <table class="table table-striped">
                        <tr class="bg-info">
                            <td>Studentid</td>
                            <td>Assign1</td>
                            <td>Assign2</td>
                            <td>Test1</td>
                            <td>Test2</td>
                            <td>Test3</td>
                            <td>Quizz</td>
                            <td>Final_exam</td>
                            <td>Grade</td>
                        </tr>
                        <?php
                        include '../learn/database.php';
                        $query = mysqli_query($conn,"select * from instructor where instructorid='$userid'");
                        $fetch = mysqli_fetch_array($query);
                        $full = $fetch['firstname'] . '  ' . $fetch['middlename'] . '   ' . $fetch['lastname'];
                        $department = $fetch['departmentid'];
                        $rightcs = mysqli_query($conn,"select DISTINCT studentid from student where section='$section' AND departmentid='$department'");
                        $i = 1;
                        while ($row2 = mysqli_fetch_array($rightcs)) {
                            $studentid = $row2['studentid'];
                            $zero = '-1';
                            $i <= $total_number;
                            $selectsql = mysqli_query($conn,"select * from coursestudent where studentid='$studentid' AND coursecode='$course_code' AND approve='$zero'");
                            if (mysqli_num_rows($selectsql) >= 1) {
                                $row = mysqli_fetch_array($selectsql);
                                echo'<form method="post" action="">';
                                ?>

                                <tr>
                                    <td size="2%"><?php echo $row['studentid']; ?></td>
                                <input type="hidden" name="studentid<?php echo $i; ?>" value="<?php echo $row['studentid']; ?>">
                                <input type="hidden" name="number" value="<?php echo $total_number; ?>">
                                <td size="2%"> <input class="number-only"name="ass1<?php echo $i; ?>" value="<?php echo $row['assign1']; ?>" size="5%"></td>
                                <td size="2%"> <input class="number-only"name="ass2<?php echo $i; ?>" value="<?php echo $row['assign2']; ?>"size="5%"></td>
                                <td size="2%"> <input class="number-only"name="tes1<?php echo $i; ?>" value="<?php echo $row['test1']; ?>"size="5%"></td>
                                <td size="2%"> <input class="number-only"name="tes2<?php echo $i; ?>" value="<?php echo $row['test2']; ?>"size="5%"></td>
                                <td size="2%"> <input class="number-only"name="tes3<?php echo $i; ?>" value="<?php echo $row['test3']; ?>"size="5%"></td>
                                <td size="2%"> <input class="number-only"name="quizz<?php echo $i; ?>" value="<?php echo $row['quizz']; ?>"size="5%"></td>
                                <td size="2%"> <input class="number-only"name="final_exam<?php echo $i; ?>" value="<?php echo $row['final_exam']; ?>"size="5%"></td>
                                <td size="2%"> <?php echo $row['grade']; ?></td>
                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                    </table>
                    <div class="form-group">         
                        <button type="submit" class="btn btn-danger btn-warning" name="response"> Response</button> 
                    </div>
                    <?php
                    echo'</form>';
                    ?>


                    <?php
                    include '../learn/database.php';
                    $grade = '';
                    $echo ='';
                    if (isset($_POST['response'])) {
                        $number = $_POST['number'];
                        for ($i = 1; $i <= $number; $i++) {
                            echo $number;
                            $studentid = $_POST["studentid$i"];
                            $assignment1 = $_POST["ass1$i"];
                            $assignment2 = $_POST["ass2$i"];
                            $test1 = $_POST["tes1$i"];
                            $test2 = $_POST["tes2$i"];
                            $test3 = $_POST["tes3$i"];
                            $quizz = $_POST["quizz$i"];
                            $final_exam = $_POST["final_exam$i"];
                            $final_total = $assignment1 + $assignment2 + $test1 + $test2 + $test3 + $quizz + $final_exam;
                            if ($final_total > 100) {
                                $final_total = 100;
                            }
                            else if($final_total < 0){
                                $final_total = 0;
                            }
                            if(!empty($assignment1) && !empty($assignment2) && !empty($test1) && !empty($test2) && !empty($test3) && !empty($quizz)){
                            
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
                            } elseif ($final_total <= 39 && $final_total >= 0) { 
                                $grade = 'F'; 
                            }
                        }else{
                                $grade = 'NG';
                            }
                            $response = mysqli_query($conn,"update coursestudent set assign1='$assignment1',assign2='$assignment2' , test1='$test1',test2='$test2',test3='$test3',quizz='$quizz', total='$final_total', final_exam='$final_exam' , grade='$grade',approve='0' where studentid='$studentid' AND coursecode='$course_code'");

                            if ($response) {
                                $echo = 'SUCCESSFULLY RESPONSE THE STUDENT RESULT TO THE REGISTRAR OFFICER';
                            } else {
                                echo mysqli_error();
                            }
                        }
                    if($echo == 'SUCCESSFULLY RESPONSE THE STUDENT RESULT TO THE REGISTRAR OFFICER'){
                    echo $echo; 
                    }}
                    ?>
                </div>
            </div>
        </div>
    </body>
    <?php include '../shared/footer.php'; ?>
</html>

