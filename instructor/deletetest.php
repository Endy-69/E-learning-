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
        <script src="../left/jquery.min1.js" type="text/javascript"></script>
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
                        <a class="nav-link" href="instructor.php" title="This is Home Page Of Instructor">
                            <i class="fa fa-1x fa">Home</i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link" href="" title="This is Upload Resource To The Student"> <i class="fa fa-1x fa">Upload</i></a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/uploadcoursematerial.php" title="This is upload Resource Material To The Department Student"> Course Material</a>
                            <a href="../updownload/uploadassignmentquestion.php"title="This is Assignment Question To The Student">Assignment Question</a>
                            <a href="uploadexam.php" title="This is Evaluation Exam To The Course Student"> Exam</a>
                            <a href="uploadcourseresult.php"title="This is Upload Student Result To The Student For The Course">Course Result</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link" href="" title="This is Download Resource Material "><i class="fa fa-1x fa"> Download</i></a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/downloadannualcalendar.php" title="This is Download The Caricullem Calendar From The Registrar Officer">Annual Calendar</a>
                            <a href="../updownload/downloadstudentlist.php" title="This is Download Student List From The Department"> Student List</a>
                            <a href="../updownload/downloadassignmentanswer.php" title="This is Download Assignment Answer Upload By The Student">Assignment Answer</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link" href="" title="This is View Notice Page Release From The Department"> <i class="fa fa-1x fa">View</i></a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/viewnotice.php"> Notice</a>
                        </div>
                    </li>  
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="tab">
                        <a class="nav-link" href="../learn/logout.php" title="This is Leave From The Home Page Of Instructor"> 
                            <i class="fa fa-1x fa-sign-out">Logout</i>
                        </a>
                    </li>
                </ul>
            </div>

                </div></div>
        </nav>

        <div class="container-fluid">
            <br>
            <a href="uploadexam.php" class="btn btn-danger"> <i class="fa fa-1x fa-arrow-left"></i> Back to previous</a>    
            <br><br>
            <div class="row">
                <div class="col-sm-12 col-md-4">  
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
                                    <tr class="info">
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
                    <div class="card border-success">
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
                                    <tr class="info">
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
                    <div class="card card-warning">
                        <div class="card-header bg-info">
                            <h5 class="card-title">View All The Student To Take The Exam Questions</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="info">
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
                <div class="col-sm-7 col-md-8"> 
                    <div id="feed"> 
                        <div class="card border-info">
                            <div class="card-header bg-info">
                                <h5 class="card-title">The Selected Question is Successfully These</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                include '../learn/database.php';
                                if (isset($_GET['viewid'])) {
                                    $_SESSION['id'] = $_GET['viewid'];
                                    $viewid = $_SESSION['id'];
                                }
                                ?><?php
                                include '../learn/database.php';
                                $viewid = $_SESSION['id'];
                                $viewdelete1 = mysqli_query($conn,"select * from test where exam_id='$viewid'");
                                if (mysqli_num_rows($viewdelete1)) {
                                    ?>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th> Question #</th>
                                            <th>Question</th>
                                            <th>Choose</th>
                                            <th>Answer</th>
                                            <th>Mark</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php
                                        $i = 1;
                                        while ($row = mysqli_fetch_array($viewdelete1)) {
                                            echo '<tr>';
                                            echo'<td>' . $i . '</td>';
                                            echo '<td>' . $row['question'] . '</td><td>' . 'A:    ' . $row['a'] . '</br>' . 'B:    ' . $row['b'] . '</br>' . 'C:    ' . $row['c'] . '</br>' . 'D:     ' . $row['d'] . '</td>';
                                            echo '<td>' . $row['answer'] . '</td>';
                                            echo'<td>' . $row['mark'] . '</td>';
                                            $test_id = $row['testid'];
                                            $validate = mysqli_query($conn,"select * from test where exam_id='$viewid' AND testid='$test_id' AND userid='$userid'");
                                            
                                        }
                                        ?>
                                    </table>
                                    <?php
                                } else {
                                    echo 'THERE IS NO UPLOAD QUESTIONS IN THESE COURSE';
                                }
                                ?>
                            </div>
                        </div> 
                        <?php
                        include '../learn/database.php';
                        if (isset($_POST['update'])) {
                            $question1 = $_POST['question1'];
                            $a1 = $_POST['aanswer'];
                            $b1 = $_POST['banswer'];
                            $c1 = $_POST['canswer'];
                            $d1 = $_POST['danswer'];
                            $answer1 = $_POST['answer'];
                            $mark1 = $_POST['mark'];
                            $edit = $_SESSION['ed'];
                            $exam_id = $_SESSION['ex'];
                            if ($mark1 == 0) {
                                echo '<font color="red">Please provide the mark for these course result the value is not zero</font>';
                            } else {
                                $test = mysqli_query($conn,"update test set question ='$question1', a = '$a1', b = '$b1', c = '$c1', d='$d1', answer = '$answer1', mark= '$mark1' where testid='$edit' AND exam_id='$exam_id'");
                                if ($test) {
                                    echo '<div class="well well-sm"><strong><font color="red">Successfully The Question Is Update Press Ok button to back the exam page</span></div>';
                                } else {
                                    echo mysqli_error();
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php 
        include '../shared/footer.php'; 
    ?>
</html>




