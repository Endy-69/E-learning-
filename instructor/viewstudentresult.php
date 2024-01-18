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
                            <i class="fa fa-1x fa"> Home</i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This is Upload Resource To The Student"> <i class="fa fa-1x fa"> Upload</i></a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/uploadcoursematerial.php" title="This is upload Resource Material To The Department Student"> Course Material</a>
                            <a href="../updownload/uploadassignmentquestion.php"title="This is Assignment Question To The Student">Assignment Question</a>
                            <a href="uploadexam.php" title="This is Evaluation Exam To The Course Student"> Exam</a>
                            <a href="uploadcourseresult.php"title="This is Upload Student Result To The Student For The Course">Course Result</a>

                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This is Download Resource Material "><i class="fa fa-1x fa">  Download</i></a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/downloadannualcalendar.php" title="This is Download The Caricullem Calendar From The Registrar Officer">Annual Calendar</a>
                            <a href="../updownload/downloadstudentlist.php" title="This is Download Student List From The Department"> Student List</a>
                            <a href="../updownload/downloadassignmentanswer.php" title="This is Download Assignment Answer Upload By The Student">Assignment Answer</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This is View Notice Page Release From The Department"> <i class="fa fa-1x fa"> View</i></a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/viewnotice.php"> Notice</a>
                        </div>
                    </li>  
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="tab">
                        <a class="navbar-link" href="../learn/logout.php" title="This is Leave From The Home Page Of Instructor"> 
                            <i class="fa fa-1x fa-sign-out"> Logout</i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid">
            <br>
            <a href="uploadcourseresult.php" class="btn btn-danger"> 
                <i class="fa fa-1x fa-arrow-left"> Back to previous</i>
            </a>
            <br><br>
            <div class="row">
                <div class="col-sm-12 col-md-4">  
                    <div class="card border-info">
                        <div class="card-header bg-info">
                            <h5 class="card-title">Number Of Student Upload course_result For These Course</h5>
                        </div>
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
                <div class="col-sm-12 col-md-8">  
                    <div class="card border-info">
                        <?php
                            include '../learn/database.php';
                            if (isset($_GET['coursecode']) && ($_GET['viewst'])) {
                                $_SESSION['id'] = $_GET['viewst'];
                                $viewst = $_SESSION['id'];
                                $_SESSION['cs'] = $_GET['coursecode'];
                                $coursecode = $_SESSION['cs'];
                            }
                            ?>

                            <?php
                            include '../learn/database.php';
                            $select = mysqli_query($conn,"select * from coursestudent where studentid='$viewst' AND coursecode='$coursecode'");
                            $row3 = mysqli_fetch_array($select);
                            $final_exam = $row3['final_exam'];
                            if (empty($final_exam)) {
                                echo '
                                    <div class="card border-info">
                                    <div class="card-header bg-info">
                                        <h5 class"card-title">The Student Result Is From 60%</h5>
                                    </div>
                                    <div class="card-body">';

                                    echo "<table  class='table table-striped'>
                                        <thead>
                                    <tr class='success'>
                                    <th><font color='black'>C_Code</th>
                                
                                    <th><font color='black'>Assign 1</th>
                                <th><font color='black'>Assign 2</th>
                                <th><font color='black'>Test 1</th>
                                <th><font color='black'>Test 2</th>
                                <th><font color='black'> Test 3</th>
                                <th><font color='black'> Quizz </th>
                                    
                                <th><font color='black'> 60% </th>
                                <th><font color='black'> Action </th>";

                                $coursecode = $row3['coursecode'];
                                $assign1 = $row3['assign1'];
                                $assign2 = $row3['assign2'];
                                $test1 = $row3['test1'];
                                $test2 = $row3['test2'];
                                $test3 = $row3['test3'];
                                $quizz = $row3['quizz'];

                                $total = $row3['total'];

                                echo '<tr>';
                                echo '<td>';
                                echo $coursecode;
                                echo '</td>';
                                echo '<td>';
                                echo $assign1;
                                echo '</td>';
                                echo '<td>';
                                echo $assign2;
                                echo '</td>';
                                echo '<td>';
                                echo $test1;
                                echo '</td>';
                                echo '<td>';
                                echo $test2;
                                echo '</td>';
                                echo '<td>';
                                echo $test3;
                                echo '</td>';
                                echo '<td>';
                                echo $quizz;
                                echo '</td>';

                                echo '<td>';
                                echo $total;
                                echo '</td>';
                                if(empty($total)){
                                    echo '<td>';
                                
                                echo '</td>';    
                                }
                                else{
                                echo '<td><a href=updateresult.php?updaters=' . $viewst . '&coursecodest=' . $coursecode . '>  <button type="button" class="btn btn-danger"><span class="fa fa-1x fa-edit"></span> Update</button></a></td>';
                                }echo '</tr>';
                                echo '</table>';
                                echo '</div>
                                    </div>';
                            } else {
                                echo ' 
                                    <div class="card-header bg-info">
                                        <h5 class="card-title">The Student Result Out of 100%</h5>
                                    </div>
                                    <div class="card-body">';
                                    echo "<table  class='table table-striped'>
                                        <thead>
                                    <tr class='success'>
                                        <th><font color='black'>C_Code</th>                                
                                        <th><font color='black'>Assign 1</th>
                                        <th><font color='black'>Assign 2</th>
                                        <th><font color='black'>Test 1</th>
                                        <th><font color='black'>Test 2</th>
                                        <th><font color='black'> Test 3</th>
                                        <th><font color='black'> Quizz </th>
                                        <th><font color='black'> 40% </th>
                                        <th><font color='black'> 60% </th>
                                        <th><font color='black'> 100% </th>
                                        <th><font color='black'> Grade </th>
                                    </tr>";
                                    $coursecode = $row3['coursecode'];
                                    $assign1 = $row3['assign1'];
                                    $assign2 = $row3['assign2'];
                                    $test1 = $row3['test1'];
                                    $test2 = $row3['test2'];
                                    $test3 = $row3['test3'];
                                    $quizz = $row3['quizz'];
                                    $final_exam = $row3['final_exam'];
                                    $total = $row3['total'];
                                    $grade = $row3['grade'];
                                    echo '<tr>';
                                    echo '<td>';
                                    echo $coursecode;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $assign1;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $assign2;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $test1;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $test2;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $test3;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $quizz;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $final_exam;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $total-$final_exam;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $total;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $grade;
                                    echo '</td>';
                                        echo '</tr>';

                                    echo '</table>';
                                echo '</div>';
                            }
                            ?>
                                <?php
                            include '../learn/database.php';
                            if (isset($_POST['update'])) {

                                $assign1 = $_POST['ass1'];
                                $assign2 = $_POST['ass2'];
                                $test1 = $_POST['tes1'];
                                $test2 = $_POST['tes2'];
                                $test3 = $_POST['tes3'];
                                $quizz = $_POST['quizz'];
                                $updaters = $_SESSION['st'];

                                $coursecodest = $_SESSION['cs2'];
                                $select = mysqli_query($conn,"select * from coursestudent where studentid ='$updaters' AND coursecode='$coursecodest'");
                                $row3 = mysqli_fetch_array($select);
                                $final_exam = $row3['final_exam'];
                                if (empty($final_exam)) {
                                    $total2 = $assign1 + $assign2 + $test1 + $test2 + $test3 + $quizz;
                                    $update = mysqli_query($conn,"update coursestudent set assign1='$assign1',assign2='$assign2',test1='$test1',test2='$test2',test3='$test3',quizz='$quizz',total='$total2' where studentid='$updaters' AND coursecode='$coursecodest'");
                                    if ($update) {
                                        echo '<font color="red">Successfully update the result for student id:  ' . $updaters . '</font>';
                                    } else {
                                        echo 'not';
                                    }
                                } else {
                                    $final_total = $assign1 + $assign2 + $test1 + $test2 + $test3 + $quizz + $final_exam;
                                    if(!empty($assign1) && !empty($assign2) && !empty($test1) && !empty($test2) && !empty($test3) && !empty($quizz)){
                                        
                                    if ($final_total <= 100 && $final_total >= 90) {
                                        $grade = 'A+';
                                    } else if ($final_total <= 89 && $final_total >= 85) {
                                        $grade = 'A';
                                    } else if ($final_total <= 84 && $final_total >= 80) {
                                        $grade = 'A-';
                                    } else if ($final_total <= 79 && $final_total >= 75) {
                                        $grade = 'B+';
                                    } else if ($final_total <= 74 && $final_total >= 70) {
                                        $grade = 'B';
                                    } else if ($final_total <= 69 && $final_total >= 65) {
                                        $grade = 'B-';
                                    } else if ($final_total <= 64 && $final_total >= 61) {
                                        $grade = 'C+';
                                    } else if ($final_total <= 60 && $final_total >= 51) {
                                        $grade = 'C';
                                    } else if ($final_total <= 50 && $final_total >= 45) {
                                        $grade = 'C-';
                                    } else if ($final_total <= 44 && $final_total >= 40) {
                                        $grade = 'D';
                                    } else if ($final_total <= 39 && $final_total >= 0) {
                                        $grade = 'F';
                                    } else {
                                        $grade = 'F';
                                    }
                                }
                                    else{
                                        $grade = 'NG';
                                    }
                                    $update1 = mysqli_query($conn,"update coursestudent set assign1='$assign1',assign2='$assign2',test1='$test1',test2='$test2',test3='$test3',quizz='$quizz',total='$final_total', grade='$grade' where studentid='$updaters' AND coursecode='$coursecodest'");
                                    if ($update1) {
                                        echo '<font color="red">Successfully update the result for student id:  ' . $updaters . '</font>';
                                    } else {
                                        echo 'not';
                                    }
                                }
                            }
                        ?>
                    </div>  
                </div>
            </div>
        </div>
    </body>
    <?php include '../shared/footer.php'; ?>
</html>



