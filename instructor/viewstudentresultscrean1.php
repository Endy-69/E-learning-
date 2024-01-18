<?php
session_start();
include("../learn/database.php");
if (isset($_SESSION['userid']) && ($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $userid = $_SESSION['userid'];
    $t = '';
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
                        <a class="navbar-link" href="" title="This is Upload Resource To The Student"> 
                            <i class="fa fa-1x fa"> Upload</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/uploadcoursematerial.php" title="This is upload Resource Material To The Department Student"> Course Material</a>
                            <a href="../updownload/uploadassignmentquestion.php"title="This is Assignment Question To The Student">Assignment Question</a>
                            <a href="uploadexam.php" title="This is Evaluation Exam To The Course Student"> Exam</a>
                            <a href="uploadcourseresult.php"title="This is Upload Student Result To The Student For The Course">Course Result</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This is Download Resource Material "><i class="fa fa-1x fa">  Download</i></a>
                        <div class="dropdown-content dropdwon-menu">
                            <a href="../updownload/downloadannualcalendar.php" title="This is Download The Caricullem Calendar From The Registrar Officer">Annual Calendar</a>
                            <a href="../updownload/downloadstudentlist.php" title="This is Download Student List From The Department"> Student List</a>
                            <a href="../updownload/downloadassignmentanswer.php" title="This is Download Assignment Answer Upload By The Student">Assignment Answer</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navabr-link" href="" title="This is View Notice Page Release From The Department"> <i class="fa fa-1x fa"> View</i></a>
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
            <a href="uploadcourseresult.php" class="btn btn-danger"><i class="fa fa-1x fa-arrow-left"> Back to previous</i></a>
            <br><br>
            <div class="row">
                <div class="col-sm-5 col-md-4 "> 
                    <div class="card border-info">
                        <div class="card-header">
                            <h5 class="card-title">Number Of Student Upload Assignment For These Course</h5>
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
                                $selectr = mysqli_query($conn, "select * from courseinstructor where instructorid='$userid'");
                                while ($row = mysqli_fetch_array($selectr)) {
                                    $coursecode = $row['coursecode'];
                                    $section = $row['section'];
                                    $rightcs = mysqli_query($conn, "select *  from student where section='$section'");
                                    while ($row2 = mysqli_fetch_array($rightcs)) {
                                        $studentid = $row2['studentid'];
                                        
                                            $selectsql = mysqli_query($conn, "select * from coursestudent where studentid='$studentid' AND coursecode='$coursecode'");
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
                <div class="col-sm-7 col-md-8">
                    <div class="card border-info">
                        <div class="card-header">
                            <h5 class="card-title bg-info">Select The Student ID to Upload Result</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            include("../learn/database.php");
                            if (isset($_GET['coursecode'])) {

                                $coursecode1 = $_GET['coursecode'];
                                $select = mysqli_query($conn, "select * from courseinstructor where coursecode='$coursecode1' AND instructorid = '$userid'");
                                if (mysqli_num_rows($select) <= 0) {
                                    echo 'The entering course code in not your course';
                                } else if (mysqli_num_rows($select) >= 1) {
                                    $number = mysqli_num_rows($select);
                                    //echo $number;
                                    ?>
                                    <form method="post" action=""name="onload" class="form-horizontal" >
                                        <div class="form-group">
                                            <label class="control-label">Student Id:</label> 
                                            <select class = "form-control"name="student">
                                                <?php
                                                while ($row = mysqli_fetch_array($select)) {
                                                    $x = array($row['section']);
                                                    foreach ($x as $value) {
                                                        $select2 = mysqli_query($conn, "select * from student where section='$value'");
                                                        while ($row2 = mysqli_fetch_array($select2)) {
                                                            $student = array($row2['studentid']);
                                                            foreach ($student as $value1) {
                                                                $select3 = mysqli_query($conn, "select * from coursestudent where studentid='$value1' AND coursecode='$coursecode1'");
                                                                while ($row3 = mysqli_fetch_array($select3)) {
                                                                    $student1 = $row3['studentid'];
                                                                    
                                                                    echo '<br>';
                                                                    ?>


                                                                    <option value="<?php echo $student1; ?>"><?php echo $student1; ?></option>


                                                                    <?php
                                                                }
                                                            }
                                                            
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select> 
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" >Coursecode:</label>
                                            <input  type="text" class="form-control"name="coursecode" value="<?php echo $coursecode1; ?>">
                                            <div class=""><p id="assign11"></p></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  " for="assign1">Assign 1:</label>
                                            <input class="number-only" type="text" class="form-control"name="assign1">
                                            <div class=""><p id="assign11"></p></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  " for="assign2">Assign 2:</label>
                                            <input class="number-only" type="text" class="form-control"name="assign2">
                                            <div class=""><p id="assign22"></p></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  " for="assign2">Quizz:</label>
                                            <input class="number-only" type="text" class="form-control"name="quizz">
                                            <div class=""><p id="quizz1"></p></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  " for="test1">Test 1:</label>
                                            <input class="number-only" type="text" class="form-control"name="test1">
                                            <div class=""><p id="test11"></p></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  " for="test2">Test 2:</label>
                                            <input class="number-only" type="text" class="form-control"name="test2">
                                            <div class=""><p id="test22"></p></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label  " for="test3">Test 3:</label>
                                            <input class="number-only" type="text" class="form-control"name="test3">
                                            <div class=""><p id="test33"></p></div>
                                        </div>                
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success"name="upload"value="upload"> Upload</button>
                                        </div>
                                    </form>
                                    <?php
                                }
                            }
                            ?>
                            <?php
                            include("../learn/database.php");
                            if (isset($_POST['upload'])) {

                                $assign1 = $_POST['assign1'];
                                $assign2 = $_POST['assign2'];
                                $test1 = $_POST['test1'];
                                $test2 = $_POST['test2'];
                                $test3 = $_POST['test3'];
                                $quizz = $_POST['quizz'];
                                $student1 = $_POST['student'];
                                $coursecode = $_POST['coursecode'];
                                $_SESSION['studentid'] = $student1;
                                if ($assign1 == '' && $assign2 == '' && $test1 == '' && $test2 == '' && $test3 == '' && $quizz == '') {
                                    echo '<font color="red"><b>Plese Fill One Of The Result From The Choose??</b></font>';
                                } else {
                                    $select2 = mysqli_query($conn, "select * from coursestudent where studentid='$student1' AND coursecode='$coursecode'");
                                    while ($row1 = mysqli_fetch_array($select2)) {
                                        $ass1 = $row1['assign1'];
                                        $ass2 = $row1['assign2'];
                                        $tes1 = $row1['test1'];
                                        $tes2 = $row1['test2'];
                                        $tes3 = $row1['test3'];
                                        $quizz1 = $row1['quizz'];
                                        $final_exam = $row1['final_exam'];
                                        $total2 = $row1['total'];

                                        
                                            $total2 = $assign1 + $assign2 + $test1 + $test2 + $test3 + $total2 + $quizz + $final_exam;
                                            $select3 = mysqli_query($conn, "update coursestudent set assign1=$assign1,assign2='$assign2',test1='$test1',test2='$test2',test3='$test3',quizz='$quizz', total='$total2' where studentid='$student1' AND coursecode='$coursecode'");
                                            if ($select3) {
                                                echo '<font color="red">Successfully upload the student result</font>';
                                            }
                                        else {
                                            echo '<font color="red">The student result for these student will be upload we can change press:::</font>';
                                            echo'<a href="updateresult.php"><font color="blue">Update Course Result</font></a>';
                                        }
                                    }
                                }
                            }
                            ?>
                        </div> 
                    </div>
                </div>
            </div>
        </div> 
    </body>
    <?php include '../shared/footer.php'; ?>
</html>



