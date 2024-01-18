<?php
session_start();
include("../learn/database.php");
if (isset($_SESSION['userid']) && ($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $userid = $_SESSION['userid'];
    $true1 = '';
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
        <script src="../js/innstructor.js" type="text/javascript"></script>
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
                        <a class="navbar-link" href="" title="This is Upload Resource To The Student ">
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
                        <a class="navbar-link" href="" title="This is Download Resource Material ">
                            <i class="fa fa-1x fa">Download</i>
                        </a>
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
            <a href="uploadexam.php" class="btn btn-danger"> 
                <i class="fa fa-1x fa-arrow-left"> Back to previous</i> 
            </a>
            <br><br>
            <div class="row"> 
                <div class="col-sm-12 col-md-4">  
                    <div class="card border-info">
                        <div class="card border-info">
                            <div class="card-header bg-info">
                                <h5 class="card-title">Manage The Exam To Be Upload</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                include '../learn/database.php';
                                $select = mysqli_query($conn,"select DISTINCT coursecode from courseinstructor where instructorid='$userid'");
                                ?>
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="">
                                            <th>Course_name</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php
                                        while ($row1 = mysqli_fetch_array($select)) {
                                            $coursecoder = $row1['coursecode'];
                                            $select2 = mysqli_query($conn,"select * from examlist where coursecode='$coursecoder'");
                                            while ($row2 = mysqli_fetch_array($select2)) {
                                                echo '<tr>';
                                                echo '<td>' . $row2['coursename'] . '</td><td><a href=test.php?addid=' . $row2['exam_id'] . '><button type="button" class="btn btn-success"><span class="fa fa-1x fa-plus">Question</span></button>' . '              |                 '
                                                . '' . '</a> <a href=editexam.php?updateid=' . $row2['exam_id'] . '>  <button type="button" class="btn btn-warning"><span class="fa fa-1x fa-edit">Exam</span></button></a></td></tr>';
                                            }
                                        }
                                        ?>
                                </table>
                            </div>
                        </div>
                        <div class="card border-info">
                            <div class="card-header bg-info">
                                <h5 class="card-title">View All The Upload Questions</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                include '../learn/database.php';
                                $select = mysqli_query($conn,"select DISTINCT coursecode from courseinstructor where instructorid='$userid'");
                                ?>
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="">
                                            <th>Course_name</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php
                                        while ($row1 = mysqli_fetch_array($select)) {
                                            $coursecoder = $row1['coursecode'];
                                            $select2 = mysqli_query($conn,"select * from examlist where coursecode='$coursecoder'");
                                            while ($row2 = mysqli_fetch_array($select2)) {
                                                echo '<tr>';
                                                echo '<td>' . $row2['coursename'] . '</td><td><a href=deletetest.php?viewid=' . $row2['exam_id'] . '><button type="button" class="btn btn-info"><span class="fa fa-1x fa">View_Ques</span></button></a> </td></tr>';
                                            }
                                        }
                                        ?>
                                </table>
                            </div>
                        </div>
                        <div class="card border-info">
                            <div class="card-header bg-info">
                                <h5 class="card-title">View All The Student To Take The Exam Questions</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="">
                                            <th>Course_name</th>
                                            <th>Number_of_Student_Take</th>
                                        </tr>
                                        <?php
                                        include '../learn/database.php';
                                        $selects = mysqli_query($conn,"select DISTINCT coursecode from courseinstructor where instructorid='$userid'");
                                        while ($row1 = mysqli_fetch_array($selects)) {
                                            $coursecoder = $row1['coursecode'];
                                            $select2 = mysqli_query($conn,"select * from examlist where coursecode='$coursecoder'");
                                            $row3 = mysqli_fetch_array($select2);
                                            $exam_id = $row3['exam_id'];
                                            $selectn = mysqli_query($conn,"select * from examresult where exam_id='$exam_id'");
                                            $number = mysqli_num_rows($selectn);
                                            echo'<tr>';
                                            echo '<td>' . $row3['coursename'] . '</td><td>' . $number . '</td></tr>';
                                        }
                                        ?>
                                </table>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="col-sm-12 col-md-8"> 
                    <div class="card border-danger">
                        <div class="card-header bg-info">
                            <h5 class="card-title">Write The Question To Be Update</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            include '../learn/database.php';
                            if (isset($_GET['edit'])) {
                                $_SESSION['ed'] = $_GET['edit'];
                                $edit = $_SESSION['ed'];
                                $_SESSION['ex'] = $_GET['exam_id'];
                                $exam_id = $_SESSION['ex'];
                                $select1 = mysqli_query($conn,"select * from test where testid='$edit' AND exam_id='$exam_id'");
                                $row1 = mysqli_fetch_array($select1);

                                $question2 = $row1['question'];
                                $a = $row1['a'];
                                $b = $row1['b'];
                                $c = $row1['c'];
                                $d = $row1['d'];
                                $answer = $row1['answer'];
                                $mark = $row1['mark'];
                            }


                            echo'<form class="form-horizontal" role="form"action="deletetest.php?viewid=' . $exam_id . '" method="post"name="test" onsubmit="return test1();">';?>
                                <div class="form-group">
                                    <label class="control-label" for="question">Question:</label> 
                                    <input type="text" class="form-control" name="question1"value="<?php echo $question2; ?>"> 
                                    <div class="">
                                        <p id="question"></p>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="control-label col-sm-1"for="a">A:</label> 
                                    <input type="text" class="form-control"  name="aanswer" value="<?php echo $a; ?>"> 
                                    <div class="">
                                        <p id="aanswer1"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-1"for="b">B:</label> 
                                    <input type="text" class="form-control" name="banswer"value="<?php echo $b; ?>"> 
                                    <div class="">
                                        <p id="banswer1"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-1"for="c">C:</label> 
                                    <input type="text" class="form-control"  name="canswer"value="<?php echo $c; ?>"> 
                                    <div class="">
                                        <p id="canswer1"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-1"for="d">D:</label> 
                                    <input type="text" class="form-control"name="danswer"value="<?php echo $d; ?>"> 
                                    <div class="">
                                        <p id="danswer1"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2">Answer:</label> 
                                    <select class="form-control" name="answer">
                                        <option value="<?php echo $answer; ?>"><?php echo $answer; ?></option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="d">Mark:</label> 
                                    <input class="number-only"type="text"name="mark"value="<?php echo $mark; ?>">  
                                    <div class="">
                                        <p id="mark1"></p>
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <button type="submit" class="btn btn-warning"name="update"value="update"onchange="onclick test1();"> Update</button>
                                </div>
                            <?php echo'</form>'; ?>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </body> 
    <?php 
        include '../shared/footer.php'; 
    ?>
</html>


