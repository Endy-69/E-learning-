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
        <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/jquery.min.js"></script>

        <link href="../css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="../left/bootstrap.min1.css" rel="stylesheet" type="text/css"/>
        <script src="../left/bootstrap.min1.js" type="text/javascript"></script>
        <link href="../left/custom1.css" rel="stylesheet" type="text/css"/>
        <script src="../left/jquery.min1.js" type="text/javascript"></script>
        <script src="../js/student.js" type="text/javascript"></script>
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
                        <a class="navbar-link" href="student.php"  title="This Is Home page Of Student">
                            <i class="fa fa-1x fa">Home</i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This Is Upload Resource To The Instructor">
                            <i class="fa fa-1x fa">Upload</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/uploadassignmentanswer.php" title="This Is Upload Assignment Question"> Assignment Answer</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This Is Download Resource Material">
                            <i class="fa fa-1x fa">Download</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/downloadassignmentquestion.php" title="This Is Download Assignment Questions">Assignment Question</a>
                            <a href="../updownload/downloadcoursematerial.php" title="This Is Download Course_Material"> Course Materialt</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This Is View Resource Page">
                            <i class="fa fa-1x fa">View</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/viewnoticest.php" title="This Is View Notice Page From Department"> Notice</a>
                            <a href="viewcourseresult.php" title="This Is View Course Result ">Course result</a>
                        </div>
                    </li>  
                    <li class="tab">
                        <a class="navbar-link" href="takeexam.php" title="This Is Online Exam Page"> 
                            <i class="fa fa-1x fa">Take Exam</i>
                        </a>
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
        <div class="container-fluid">
            <br>
            <div class="row"> 
                <div class="col-sm-12 col-md-9"> 
                    <div class="card border-info">
                        <div class="card-header bg-info">
                            <b>Welcome To View course result for each course</b> 
                        </div>
                        <?php
                            include("../learn/database.php");
                            if (isset($_GET['ccode'])) {
                                    $ccode = $_GET['ccode'];
                                    $select2 = mysqli_query($conn, "select * from coursestudent where coursecode='$ccode' AND studentid='$userid'");
                                    $row3 = mysqli_fetch_array($select2);
                                    $final_exam = $row3['final_exam'];
                                    $grade = $row3['grade'];
                                    if (empty($final_exam) && empty($grade)) {
                                        $select = mysqli_query($conn, "select * from coursestudent where coursecode='$ccode' AND studentid='$userid'");
                                        echo '<font color="blue"><br><b>The course result for course code ' . $ccode . ' as follow as from 60%</b></font>';
                                        echo "<table  class='table table-bordered'>
                                        <thead>
                                    <tr class='success'>
                                <th><font color='black'>Course Code</th>
                            
                                <th><font color='black'>Assign 1</th>
                                <th><font color='black'>Assign 2</th>
                                <th><font color='black'>Test 1</th>
                                <th><font color='black'>Test 2</th>
                                <th><font color='black'> Test 3</th>
                                <th><font color='black'> Quizz </th>
                                
                                <th><font color='black'> Total </th>";

                                while ($row2 = mysqli_fetch_array($select)) {
                                            $coursecode = $row2['coursecode'];
                                            $assign1 = $row2['assign1'];
                                            $assign2 = $row2['assign2'];
                                            $test1 = $row2['test1'];
                                            $test2 = $row2['test2'];
                                            $test3 = $row2['test3'];
                                            $quizz = $row2['quizz'];

                                            $total = $row2['total'];

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

                                            echo '</tr>';
                                        }
                                        echo '</table>';
                                    } else {
                                        $select4 = mysqli_query($conn, "select * from coursestudent where coursecode='$ccode' AND studentid='$userid'");
                                        echo '<font color="blue"><b>The course result for course code ' . $ccode . ' as follow as from 100%</b></font>';
                                        echo "<table  class='table table-bordered'>
                                        <thead>
                                    <tr class='success'>
                                <th><font color='black'>Course Code</th>
                            
                                <th><font color='black'>Assign 1</th>
                                <th><font color='black'>Assign 2</th>
                                <th><font color='black'>Test 1</th>
                                <th><font color='black'>Test 2</th>
                                <th><font color='black'> Test 3</th>
                                <th><font color='black'> Quizz </th>
                                <th><font color='black'> Final_exam </th>
                                <th><font color='black'> Total </th>
                                <th><font color='black'> Grade </th></tr>";
                                        while ($row4 = mysqli_fetch_array($select4)) {
                                            $coursecode = $row4['coursecode'];
                                            $assign1 = $row4['assign1'];
                                            $assign2 = $row4['assign2'];
                                            $test1 = $row4['test1'];
                                            $test2 = $row4['test2'];
                                            $test3 = $row4['test3'];
                                            $quizz = $row4['quizz'];
                                            $final_exam = $row4['final_exam'];
                                            $total = $row4['total'];
                                            $grade = $row4['grade'];
                                            $approve= $row4['approve'];
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
                                            echo $total;
                                            echo '</td>';
                                            if($approve == '1'){
                                            echo '<td>';
                                            echo $grade;
                                            echo '</td>';}
                                            else{
                                            echo '<td>';
                                            
                                            echo '</td>';    
                                            }
                                            echo '</tr>';
                                        }
                                        echo '</table>';
                                    }

                                    echo '<hr style="background-color: cyan; height: 2px;">';
                                    echo'<div class="panel-group col-md-offset-2 col-md-8 col-md-offset-2">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title">Report Any Mistake    
                                                        <a data-toggle="instructor" href="#instructor">
                                                            Now
                                                        </a>
                                                    </5>
                                                </div>
                                                <div id="instructor" class="panel-instructor instructor">
                                                    <div class="panel-body">';
                                                        echo'<form role="form" action="" method="post">';
                                                        echo'<div class="form-group">';
                                                        echo'<label class="control-label" for="coursecode">Course Code</label>';
                                                        echo '</div>';
                                                        echo'<div class="form-group">';
                                                        echo'<div class="">';
                                                        echo'<select class="form-control" name="coursecode"> ';
                                                        ?>
                                                        <option value = "<?php echo $ccode; ?>"> <?php echo $ccode;
                                                        ?></option>; <?php
                                                        echo'</select>';
                                                        echo'</div>';
                                                        echo'</div>';


                                                        echo'<div class="form-group">';
                                                        echo'<label class="control-label" for="comment">Comment</label>';
                                                        echo'<div class="">';
                                                        echo'<textarea class="form-control" rows="3" name="comment" required="required"></textarea>';
                                                        echo'</div></div>';
                                                        echo'<div class="form-group float-right">'; 
                                                        echo'<button type="submit" class="btn btn-lg btn-success"name="send" value="send"><i class = "fa fa-1x fa"></i>Send</i></button>';
                                                        echo'</div> ';
                                                        echo'</form>';
                                                        echo'</div>

                                                                    </div>
                                                                </div>
                                                            </div>';
                                }
                                if (isset($_POST['send'])) {
                                    $coursecode2 = $_POST['coursecode'];
                                    $comment = $_POST['comment'];

                                    // getting the students section
                                    $select_student = mysqli_query($conn, "select * from student where studentid='$userid' LIMIT 1");
                                    $stu_row1 = mysqli_fetch_array($select_student);
                                    $stu_section = $stu_row1['section'];

                                    // getting the course instrcutor id
                                    $select = mysqli_query($conn, "select * from courseinstructor where coursecode='$coursecode2' AND section='$stu_section' LIMIT 1");
                                    $inst_row1 = mysqli_fetch_array($select);
                                    $instid = $inst_row1['instructorid']; 
 
                                    // comment 
                                    $insert = mysqli_query($conn, "insert into here values('','$coursecode2','$instid','$userid','$comment')")or die(mysqli_error());
                                    if ($insert) {
                                        echo '<font color="red">Comment successfuly given to the instructor</font>';
                                    } else {
                                        echo 'Please provide the comment first';
                                    }
                                }
                        ?>
                    </div>
                </div>

                <div class="col-sm-12 col-md-3"> 
                    <div class="card border-info">
                        <div class="card-header bg-info">View Course Result</div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <tr class="info">
                                        <th>Course_name</th>
                                        <th>View</th>
                                    </tr>
                                    <?php
                                        include("../learn/database.php");
                                        $select = mysqli_query($conn, "select * from coursestudent where studentid='$userid'");
                                        while ($row = mysqli_fetch_array($select)) {
                                            $coursecode = $row['coursecode'];
                                            $select1 = mysqli_query($conn, "select * from course where coursecode='$coursecode'");

                                            while ($row1 = mysqli_fetch_array($select1)) {
                                                $coursename = $row1['coursename'];
                                                echo '<tr>';
                                                echo '<td>' . $coursename . '</td><td><a href=viewcourseresult.php?ccode=' . $coursecode . '&studentid=' . $userid . '><i class ="fa fa-1x fa-eye" style="color: red;"></i></a></td></tr>';
                                            }
                                        }
                                    ?>
                                </table>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div> 
    </body>
    <?php include '../shared/footer.php'; ?>
</html>

