

<?php
session_start();
include("../learn/database.php");
if (isset($_SESSION['userid']) && ($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $userid = $_SESSION['userid'];
    $true = '';
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
        <script src="../js/innstructor.js" type="text/javascript"></script>
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
                        <a href="instructor.php" title="This is Home Page Of Instructor">
                            <i class="fa fa-1x fa">Home</i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="" title="This is Upload Resource To The Student">
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
                        <a href="" title="This is Download Resource Material "><i class="fa fa-1x fa"> Download</i></a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/downloadannualcalendar.php" title="This is Download The Caricullem Calendar From The Registrar Officer">Annual Calendar</a>
                            <a href="../updownload/downloadstudentlist.php" title="This is Download Student List From The Department"> Student List</a>
                            <a href="../updownload/downloadassignmentanswer.php" title="This is Download Assignment Answer Upload By The Student">Assignment Answer</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="" title="This is View Notice Page Release From The Department"> 
                            <i class="fa fa-1x fa">View</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/viewnotice.php"> Notice</a>
                        </div>
                    </li>  
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="tab">
                        <a href="../learn/logout.php" title="This is Leave From The Home Page Of Instructor"> 
                            <i class="fa fa-1x fa-sign-out">Logout</i>
                        </a>
                    </li>
                </ul>
            </div> 
        </nav>

       <div class="container-fluid"> 
            <br>
            <a class="navbar-link text-danger" href="uploadexam.php">  
                <i class="fa fa-1x fa-arrow-left text-danger"> <b>Back to previous</b></i>
            </a> 
            <br><br>
            <div class="row">
                <div class="col-sm-12 col-md-6 ">
                    <div class="card border">
                        <div class="card-header bg-info">Manage The Exam To Be Upload</div>
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
                                            echo '<td>' . $row2['coursename'] . '</td>'
                                                    . '<td><a href=test.php?addid=' . $row2['exam_id'] . '><button type="button" class="btn btn-success"><span class="fa fa-1x fa-plus">Question</span></button' . '              |                 '
                                            . '' . '</a> <a href=editexam.php?updateid=' . $row2['exam_id'] . '>  <button type="button" class="btn btn-warning"><span class="fa fa-1x fa-edit">editExam</span></button></a></td></tr>';
                                        }
                                    }
                                    ?>
                            </table>
                        </div>
                    </div>
                    <div class="card card-success">
                        <div class="card-header bg-info">View All The Upload Questions</div>
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
                </div>

                <div class="col-sm-12 col-md-6 ">                      
                        <div class="card card-success classes">
                            <div class="card-header bg-info">Write The Question To Be Upload</div>
                            <div class="card-body">
                                <?php
                                    if (isset($_GET['addid'])) {
                                        $as = $_GET['addid'];
                                        $_SESSION['as'] = $as;
                                        $select3 = mysqli_query($conn,"select * from examlist where exam_id='$as'");
                                        $row1 = mysqli_fetch_assoc($select3);
                                        $_SESSION['coursecode'] = $row1['coursecode'];
                                        $_SESSION['duration'] = $row1['duration'];
                                        $_SESSION['coursename'] = $row1['coursename'];
                                        $coursecode1 = $_SESSION['coursecode'];
                                        $coursename1 = $_SESSION['coursename'];
                                        $duration = $_SESSION['duration'];
                                    }
                                ?>
                                
                                <!-- information -->
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 form-group">
                                        <label class="control-label" for="pwd">examtype:</label> <br>
                                        <input class="form-control" type="text" name="examtype" value="<?php  ?>"> 
                                    </div>
                                    <div class="col-md-6 col-sm-12 form-group">
                                        <label class="control-label" for="pwd">Course Code:</label> <br> 
                                        <input class="form-control" type="text" name="coursecode" value="<?php echo $coursecode1; ?>"> 
                                    </div>
                                    <div class="col-md-6 col-sm-12 form-group">
                                        <label class="control-label" for="pwd">Course Name:</label> <br>
                                        <input class="form-control" type="text" name="coursecode" value="<?php echo $coursename1; ?>"> 
                                    </div>
                                    <div class="col-md-6 col-sm-12 form-group">
                                        <label class="control-label" for="dur">Duration:</label> <br>
                                        <input class="form-control" type="text" name="duration" value="<?php echo $duration; ?>  :Minutes"> 
                                    </div>
                                </div>
                                <hr class="row" style="height: 3px; background-color: cyan;">
                                <form class="form-horizontal" role="form"action=""method="post" name="test" onSubmit="return test1();">
                                    <div class="form-group">
                                        <label class="control-label " for="question">Question:</label> 
                                        <textarea type="text" class="form-control"name="question1"></textarea> 
                                        <div class="">
                                            <p id="question"></p>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="control-label "for="a">A:</label>
                                        <div class="">
                                            <input type="text" class="form-control" name="aanswer">
                                        </div>
                                        <div class="">
                                            <p id="aanswer1"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label "for="b">B:</label>
                                        <div class="">
                                            <input type="text"class="form-control"  name="banswer">
                                        </div>
                                        <div class="">
                                            <p id="banswer1"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label "for="c">C:</label>
                                        <div class="">
                                            <input type="text"class="form-control"name="canswer">
                                        </div>
                                        <div class="">
                                            <p id="canswer1"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label "for="d">D:</label>
                                        <div class="">
                                            <input type="text"class="form-control" name="danswer">
                                        </div>
                                        <div class="">
                                            <p id="danswer1"></p>
                                        </div>
                                    </div>
                                    <div class="row">                                        
                                        <div class="form-group col-md-6">
                                            <label class="control-label ">Answer:</label>
                                            <select class="form-control" name="answer">
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="control-label "for="d">Mark:</label> 
                                            <input class="form-control number-only" type="text"name="mark">  
                                            <div class="">
                                                <p id="mark1"></p>
                                            </div>
                                        </div>
                                    </div> 
                                    <input type="hidden" name="coursecode" value="<?php echo $coursecode1; ?>">
                                    <div class="form-group float-right">
                                        <div class="">
                                            <button type="submit" class="btn btn-lg btn-success"name="upload" onchange="onclick test1();"><i class="fa fa-1x fa-upload">Upload</i></button>
                                        </div>
                                    </div>
                                </form>
                                <?php
                                    if ($true == 'ok') {
                                        echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Successfully Upload The Test To The Selected Course..</div>';
                                        echo $as;
                                    }
                                ?>
                                <?php
                                    include '../learn/database.php';
                                    if (isset($_POST['upload'])) {
                                        $coursecode = $_POST['coursecode'];
                                        $question = $_POST['question1'];
                                        $a = $_POST['aanswer'];
                                        $b = $_POST['banswer'];
                                        $c = $_POST['canswer'];
                                        $d = $_POST['danswer'];
                                        $answer = $_POST['answer'];
                                        $mark = $_POST['mark'];
                                        if($mark == 0){
                                            echo '<font color="red">Please provide the mark for these course result the value is not zero</font>';
                                        }
                                        else{
                                        $select4 = mysqli_query($conn,"select * from test where exam_id='$as'");
                                        if (mysqli_num_rows($select4) >= 1) {
                                            while ($row2 = mysqli_fetch_array($select4)) {
                                                $_SESSION['test'] = $row2['testid'];
                                                $testid = $_SESSION['test'];
                                            }
                                            $testid = $_SESSION['test'];
                                            $insert = mysqli_query($conn,"insert into test values('','$testid'+1,'$question','$a','$b','$c','$d','$answer','$mark','$as')");
                                            if ($insert) {
                                                $true = 'ok';
                                            } else {
                                                echo mysqli_error();
                                            }
                                        } elseif (mysqli_num_rows($select4) <= 0) {
                                            $insert = mysqli_query($conn,"insert into test values('',1,'$question','$a','$b','$c','$d','$answer','$mark','$as')");
                                            if ($insert) {
                                                $true = 'ok';
                                            } else {
                                                echo mysqli_error();
                                            }
                                        }

                                        $select = mysqli_query($conn,"select * from test where exam_id='$as'");
                                        ?>
                                        <div class="card card-default">
                                            <div class="card-header bg-info">Question Added</div>
                                            <table class="table table-bordered">

                                                <tr>
                                                    <th>Number of question</th>
                                                    <th>Question</th>
                                                    
                                                </tr>
                                                <?php
                                                $i = 1;
                                                while ($row = mysqli_fetch_array($select)) {
                                                    $testid = $row['testid'];
                                                    $question1 = $row['question'];
                                                    echo'<tr>';
                                                    echo'<td> Question # : ' . $i . '</td>';
                                                    echo'<td>' . $question1 . '</td>';
                                                        echo'</tr>';
                                                    $i++;
                                                }
                                                ?>

                                            </table>
                                        </div>
                                        <?php
                                    }}
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


