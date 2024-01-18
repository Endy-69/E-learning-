

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
                            <i class="fa fa-1x fa">Home
                            </i>
                     </a>
                    </li>

                    <li class="dropdown">
                        <a href="" title="This is Upload Resource To The Student"> <i class="fa fa-1x fa">Upload</i></a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/uploadcoursematerial.php" title="This is upload Resource Material To The Department Student"> Course Material</a>
                            <a href="../updownload/uploadassignmentquestion.php"title="This is Assignment Question To The Student">Assignment Question</a>
                            <a href="uploadexam.php" title="This is Evaluation Exam To The Course Student"> Exam</a>
                            <a href="uploadcourseresult.php"title="This is Upload Student Result To The Student For The Course">Course Result</a>

                        </div></li>
                    <li class="dropdown">
                        <a href="" title="This is Download Resource Material ">
                        <i class="fa fa-1x fa"> Download</i></a>
                        <div class="dropdown-content dropdown-menu">

                            <a href="../updownload/downloadannualcalendar.php" title="This is Download The Caricullem Calendar From The Registrar Officer">Annual Calendar</a>
                            <a href="../updownload/downloadstudentlist.php" title="This is Download Student List From The Department"> Student List</a>
                            <a href="../updownload/downloadassignmentanswer.php" title="This is Download Assignment Answer Upload By The Student">Assignment Answer</a>

                        </div>
                    </li>

                    <li class="dropdown">
                        <a href="" title="This is View Notice Page Release From The Department"> <i class="fa fa-1x fa">View</i></a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/viewnotice.php"> Notice</a>


                        </div>
                    </li>  
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="tab"><a href="../learn/logout.php" title="This is Leave From The Home Page Of Instructor"> <i class="fa fa-1x fa-sign-out">Logout</i></a></li>
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
                    <div class="card border-info">
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
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                    <?php
                                    while ($row1 = mysqli_fetch_array($select)) {
                                        $coursecoder = $row1['coursecode'];
                                        $select1 = mysqli_query($conn,"select * from examlist where coursecode='$coursecoder'");
                                        while ($row1 = mysqli_fetch_array($select1)) {
                                            echo '<tr>';
                                            echo '<td>' . $row1['coursename'] . '</td><td>'.$row1['duration'].'</td><td>'.$row1['status'].'</td>'
                                                    . '<td><a href=test.php?addid=' . $row1['exam_id'] . '><button type="button" class="btn btn-success"><span class="fa fa-1x fa-plus">Question</span></button' . '              |                 '
                                            . '' . '</a> <a href=editexam.php?updateid=' . $row1['exam_id'] . '>  <button type="button" class="btn btn-warning"><span class="fa fa-1x fa-edit">editExam</span></button></a></td></tr>';
                                        }
                                    }
                                    ?>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="card border-success">
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
                                        $select1 = mysqli_query($conn,"select * from examlist where coursecode='$coursecoder'");
                                        while ($row1 = mysqli_fetch_array($select1)) {
                                            echo '<tr>';
                                            echo '<td>' . $row1['coursename'] . '</td><td><a href=deletetest.php?viewid=' . $row1['exam_id'] . '><button type="button" class="btn btn-info"><span class="fa fa-1x fa">View_Ques</span></button></a> </td></tr>';
                                        }
                                    }
                                    ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="card border classes">
                        <div class="card-header bg-info">Update The Exam List</div>
                        <div class="card-body">
                            <?php
                                include '../learn/database.php';
                                if (isset($_GET['updateid'])) {
                                    $_SESSION['es'] = $_GET['updateid'];
                                    $exam_id = $_SESSION['es'];
                                    $select3 = mysqli_query($conn,"select * from examlist where exam_id='$exam_id'");
                                    $row1 = mysqli_fetch_array($select3);
                                    $coursecode1 = $row1['coursecode'];
                                    $duration = $row1['duration'];
                                    $coursename = $row1['coursename'];
                                    $status = $row1['status'];
                                    $instructorid = $row1['instructorid'];
                                    $selectname = mysqli_query($conn,"select * from instructor where instructorid='$instructorid'");
                                    $row3 = mysqli_fetch_array($selectname);
                                    $firstname = $row3['firstname'];
                                    $lastname = $row3['lastname'];
                                    $statusi = $row3['status'];
                                }
                            ?>
                            <div class="alert alert-warning">
                                <strong>The course is added by instructor: <?php echo $statusi.'   '.$firstname.'   '.$lastname; ?></strong> 
                            </div>
                            <form class="form-horizontal" role="form"action=""method="post">
                                <div class="form-group">
                                    <label class="control-label " for="pwd">Course Code:</label> <br> 
                                    <input class="form-control" type="text"class="from-control" name="coursecode" value="<?php echo $coursecode1; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="control-label " for="pwd">Course Name:</label> <br>
                                    <input class="form-control" type="text"class="from-control" name="coursename" value="<?php echo $coursename; ?>"> 
                                </div>
                                <div class="form-group">
                                    <label class="control-label " for="dur">Duration:</label> 
                                    <input class="form-control" type="text"name="duration" value="<?php echo $duration; ?>">
                                </div>
                                <div class="form-group">
                                    <label class=" control-label ">Status: </label> 
                                    <?php
                                        if ($status == 'active') {
                                            echo'<input type="checkbox" checked name="status">  Active';
                                        } else {
                                            echo'<input type="checkbox" name="status">  Active';
                                        }
                                    ?> 
                                </div> 
                                <!-- button -->
                                <div class="form-group float-right"> 
                                    <button type="submit" class="btn btn-lg btn-danger"name="update"value="update">
                                        <i class="fa fa-1x fa-edit">Update</i>
                                    </button>
                                </div>
                            </form>
                        <?php 
                            if(isset($_POST['update'])){
                                $coursecode = $_POST['coursecode'];
                                $coursename1 = $_POST['coursename'];
                                $duration1 = $_POST['duration'];
                                $status1 = isset($_POST['status']) ? 'active' : 'inactive';
                            mysqli_query($conn,"update examlist set coursecode='$coursecode' , coursename='$coursename1',duration='$duration1', status='$status1' where exam_id='$exam_id'");
                            }
                        ?>
                    </div>
                </div> 
            </div>
        </div>
    </body>
    <?php include '../shared/footer.php'; ?>
</html>


