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
        <script type="text/javascript">
            function updateresult1() {
                if (document.updateresult2.studentid.value == '..select..') {
                    document.getElementById('studentid1').innerHTML = '<font color="red">Please select the student id??</font>';
                    document.updateresult2.studentid.focus();
                    return false;
                } else {
                    return true;
                }
            }

        </script>  
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
                            <i class="fa fa-1x fa">Home</i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This is Upload Resource To The Student"> <i class="fa fa-1x fa">Upload</i></a>
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
                        <a class="navbar-link" href="" title="This is View Notice Page Release From The Department"> <i class="fa fa-1x fa">View</i></a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/viewnotice.php"> Notice</a>
                        </div>
                    </li>  
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="tab">
                        <a class="navbar-link" href="../learn/logout.php" title="This is Leave From The Home Page Of Instructor"> 
                            <i class="fa fa-1x fa-sign-out">Logout</i>
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
                    <div id="feed">
                        <?php
                        if (isset($_GET['updaters'])) {
                            $_SESSION['st'] = $_GET['updaters'];
                            $updaters = $_SESSION['st'];
                            $_SESSION['cs2'] = $_GET['coursecodest'];
                            $coursecodest = $_SESSION['cs2'];
                            include("../learn/database.php");
                            $select4 = mysqli_query($conn,"select * from coursestudent where coursecode='$coursecodest' AND studentid='$updaters'");
                            $row = mysqli_fetch_array($select4);
                            $final_exam = $row['final_exam'];
                            $viewst = $_SESSION['id'];
                            $coursecode = $_SESSION['cs'];
                            ?>
                            <div class="card border-info">
                                <div class="card-header bg-info">
                                    <h5 class="card-title">Update Student Results</h5> 
                                </div>
                                <div class="card-body">
                                    <?php echo'<form method="post" action="viewstudentresult.php?viewst=' . $viewst . '&coursecode=' . $coursecode . '">'; ?>
                                    <table class="table table-striped">
                                        <tr class="bg-success">
                                            <td>Studentid</td>
                                            <td>Assign1</td>
                                            <td>Assign2</td>
                                            <td>Test1</td>
                                            <td>Test2</td>
                                            <td>Test3</td>
                                            <td>Quiz</td>
                                        </tr>
                                        <tr>
                                            <td size="2%"><?php echo $row['studentid']; ?></td>
                                            <td size="2%"> <input class="number-only"name="ass1" value="<?php echo $row['assign1']; ?>" size="5%"></td>
                                            <td size="2%"> <input class="number-only"name="ass2" value="<?php echo $row['assign2']; ?>"size="5%"></td>
                                            <td size="2%"> <input class="number-only"name="tes1" value="<?php echo $row['test1']; ?>"size="5%"></td>
                                            <td size="2%"> <input class="number-only"name="tes2" value="<?php echo $row['test2']; ?>"size="5%"></td>
                                            <td size="2%"> <input class="number-only"name="tes3" value="<?php echo $row['test3']; ?>"size="5%"></td>
                                            <td size="2%"> <input class="number-only"name="quizz" value="<?php echo $row['quizz']; ?>"size="5%"></td>
                                        </tr>
                                    </table>
                                    <div class="form-group float-right">    
                                        <button type="submit" class="btn btn-danger" name="update" value="update"> <i class="fa fa-edit"></i> Update</button>                                    
                                    </div>
                                    <?php echo'</form>'; ?>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php include '../shared/footer.php'; ?>
</html>



