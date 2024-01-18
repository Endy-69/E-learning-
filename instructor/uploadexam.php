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
                <div class="col-sm-6 col-md-6">  
                    <div class="card border-info">
                        <div class="card-header bg-info">Manage The Upload Exam Course</div>
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
                                        $select2 = mysqli_query($conn,"select * from examlist where coursecode='$coursecoder'");
                                        while ($row2 = mysqli_fetch_array($select2)) {
                                            echo '<tr>';
                                            echo '<td>' . $row2['coursename'] . '</td><td>' . $row2['duration'] . '</td><td>' . $row2['status'] . '</td>'
                                            . '<td><a href=test.php?addid=' . $row2['exam_id'] . '><button type="button" class="btn btn-success"><span class="fa fa-1x fa-plus">Question</span></button>' . '              |                 '
                                            . '' . '</a> <a href=editexam.php?updateid=' . $row2['exam_id'] . '> <button type="button" class="btn btn-warning"> <span class="fa fa-1x fa-edit">editExam</span></button></a></td></tr>';
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

                <div class="col-sm-6 col-sm-offset-6 col-md-6 col-md-offset-6 main">
                    <div class="card border-info classes">
                        <div class="card-header bg-info">Select The Course Code For Upload Exam</div>
                        <div class="card-body">
                            <form class="form-horizontal" role="form"action=""method="post" name="exam1" onSubmit="return exam();">
                                <?php
                                include '../learn/database.php';
                                $select = mysqli_query($conn,"select DISTINCT coursecode from courseinstructor where instructorid='$userid'");
                                ?>
                                <div class="form-group">
                                    <label class="control-label" for="cc">Course Code</label>
                                    <br>
                                    <select class="form-control" name="coursecode">
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
                                <div class="form-group">
                                    <label class="control-label" for="test">Duration</label><br>
                                    <input class="form-control number-only" input type="text"  name="duration" placeholder="Minute Value">
                                    <div class="">
                                        <p id="duration1"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label ">Status </label>
                                    <div class="checkbox float-left">
                                        <input type="checkbox" name="status" id="active1" checked>
                                        Active
                                    </div>
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-lg btn-success" name="add" onclick="return exam()">
                                            <i class="fa fa-1x fa">Add</i>
                                        </button>  
                                    </div>
                                </div>
                            </form>
                            <?php
                            include '../learn/database.php';
                            if (isset($_POST['add'])) {
                                $exam_id = rand(10, 10000);
                                $coursecode = $_POST['coursecode'];
                                $duration = $_POST['duration'];
                                if ($duration == 0) {
                                    echo 'Please provide the time duration value for these course';
                                } else {
                                    $duration1 = floor($duration / 60) . ":" . ($duration % 60) . ":" . '00';

                                    $status = isset($_POST['status']) ? 'active' : 'inactive';
                                    $select1 = mysqli_query($conn,"select * from courseinstructor where coursecode='$coursecode'");
                                    $select2 = mysqli_query($conn,"select * from course where coursecode='$coursecode'");
                                    $row = mysqli_fetch_array($select2);
                                    $coursename = $row['coursename'];
                                    if (mysqli_num_rows($select1) <= 0) {
                                        echo' <div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Danger!</strong> This alert box could indicate a dangerous or potentially negative action.</div>';
                                    } elseif (mysqli_num_rows($select1) >= 1) {

                                        $select2 = mysqli_query($conn,"select * from examlist where coursecode='$coursecode'");
                                        if (mysqli_num_rows($select2) <= 0) {
                                            $insert = mysqli_query($conn,"insert into examlist values('$exam_id','$coursecode','$coursename','$duration1','$status','$userid')");
                                            if ($insert) {
                                                echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> The Course Is Add to The Exam List.</div>';
                                            }
                                        } else {
                                            echo ' <div class="alert alert-warning"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning!</strong> The Course is Allready Exist to be Edit click on the edit tabs belown. </div>';
                                            $_SESSION['coursecode'] = $coursecode;
                                            $_SESSION['duration'] = $duration;
                                            $_SESSION['status'] = $status;
                                        }
                                        ?></div></div>
                                <div class="card border-info">
                                    <div class="card-header bg-info">The Exam Course List</div>
                                    <div class="card-body">
                                        <?php
                                        $select = mysqli_query($conn,"select * from examlist where instructorid='$userid'");
                                        ?>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Course Code</th>
                                                    <th>Duration</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            while ($row = mysqli_fetch_array($select)) {
                                                $_SESSION['coursecode'] = $row['coursecode'];
                                                $_SESSION['duration'] = $row['duration'];
                                                $_SESSION['status'] = $row['status'];
                                                ?>
                                                <tr>
                                                    <td> <?php echo $row['coursecode']; ?></td>
                                                    <td> <?php echo $row['duration']; ?>  :Minutes</td>
                                                    <td> <?php echo $row['status']; ?></td>
                                                    <td> <?php
                                                        echo '<a href=test.php?addid=' . $row['exam_id'] . '><span class="fa fa-1x fa-plus"></span> Question' . '              |                 '
                                                        . '' . '</a> <a href=editexam.php?updateid=' . $row['exam_id'] . '>  <span class="fa fa-1x fa-edit"></span> Exam</a>';
                                                        ?></td>
                                                </tr>
                                            <?php }
                                            ?>
                                        </table><?php
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


