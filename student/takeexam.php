<?php
session_start();
include("../learn/database.php");
if (isset($_SESSION['userid']) && ($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $userid = ($_SESSION['userid']);
} else {
    header("Location: ../learn/login.php");
}
?>
<html>
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
                <div class="col-sm-12 col-md-6">
                    <div class="card border-info">
                        <div class="card-header bg-info">Select the Course Name to Take Exam</div>
                        <div class="card-body">
                            <?php
                            error_reporting();
                            include '../learn/database.php';
                            $statusa = 'active';
                            $select = mysqli_query($conn, "select * from coursestudent where studentid='$userid'");
                            ?>
                            <form role="form" action=""method="post"class="form-horizontal">
                                <div class="form-group" >
                                    <label class="control-label"for="exam">Select Course Name:</label>
                                    <div class="form-group">
                                        <select class="form-control" name="coursecode">
                                            <?php
                                            while ($row = mysqli_fetch_array($select)) {
                                                $coursecode = array($row['coursecode']);

                                                foreach ($coursecode as $value) {
                                                    $selects = mysqli_query($conn, "select DISTINCT coursecode from examlist where coursecode='$value' AND status='$statusa'");
                                                    while ($row2 = mysqli_fetch_array($selects)) {

                                                        $coursecodes = array($row2['coursecode']);
                                                        foreach ($coursecodes as $value1) {
                                                            $selectc = mysqli_query($conn, "select DISTINCT coursename from course where coursecode='$value'");
                                                            $rowc = mysqli_fetch_array($selectc);
                                                            $coursename = $rowc['coursename'];
                                                            ?>

                                                            <option value="<?php echo $value; ?>"><?php echo $coursename; ?></option>;<?php
                                                        }
                                                    }
                                                }
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group float-right"> 
                                    <button type="submit" class="btn btn-lg btn-danger"name="select"value="select">
                                        <i class="fa fa-1x fa">Select</i>
                                    </button>
                                </div>

                                <br><br><br>
                                <?php
                                    include '../learn/database.php';
                                    error_reporting(0);
                                    if (isset($_POST['select'])) {
                                        $coursecode1 = $_POST['coursecode'];
                                        $status = 'active';
                                        if (empty($coursecode1)) {
                                            echo 'TO SELECT THE COURSE NAME THERE IS NOT ACTIVE EXAM';
                                        } else {
                                            $select1 = mysqli_query($conn, "select * from examlist where coursecode='$coursecode1'");
                                            if (mysqli_num_rows($select1) >= 1) {
                                                $select2 = mysqli_query($conn, "select * from examlist where status='$status' AND coursecode='$coursecode1'");
                                                if (mysqli_num_rows($select2) >= 1) {
                                                    $row = mysqli_fetch_array($select2);
                                                    $coursecode2 = $row['coursecode'];
                                                    $coursename = $row['coursename'];
                                                    $_SESSION['duration'] = $row['duration'];
                                                    $_SESSION['exam_id'] = $row['exam_id'];
                                                    $duration1 = $_SESSION['duration'];
                                                    $exam_id = $_SESSION['exam_id'];
                                                    $select3 = mysqli_query($conn, "select * from examresult where studentid='$userid' AND exam_id='$exam_id'");
                                                    if (mysqli_num_rows($select3) >= 1) {
                                                        $row1 = mysqli_fetch_array($select3);
                                                        $date = $row1['date'];
                                                        echo'<div class="alert alert-info"><strong>Information To You??  </strong> Thank You The Exam is allready taken  On The Date:     <font color="red"><b>' . $date . '</b></font></div>';
                                                    } elseif (mysqli_num_rows($select3) <= 0) {
                                                        ?>
                                                        <div class="panel panel-success classes">
                                                            <div class="panel-body">
                                                                <div class="row">
                                                                    <div class="col-sm-8">
                                                                        <center><font color="blue">
                                                                            <p>Time Duration: <?php echo $duration1; ?>    :Minutes</p><br>
                                                                            <p> Course Code:  <?php echo $coursecode2; ?></p><br>
                                                                            <p> Course Name:  <?php echo $coursename; ?></p><br></font>

                                                                            <?php
                                                                            $select3 = mysqli_query($conn, "select * from test where exam_id='$exam_id'");
                                                                            $row1 = mysqli_fetch_array($select3);
                                                                            $_SESSION['number'] = mysqli_num_rows($select3);
                                                                            $number = $_SESSION['number'];
                                                                            $_SESSION['time'] = date('Y-m-d H:i:s');
                                                                            $continue = $_SESSION['time'];
                                                                            echo '<a class="btn btn-danger" href="takeexamscreen.php?testid=' . $row1['testid'] . '"><i class ="fa fa-1x fa-forward">Continue</i></a>';
                                                                            ?></center>
                                                                    </div><div class="col-sm-4">
                                                                        <i class="fa fa-5x  fa-question-circle-o"></i>
                                                                        <i class="fa fa-5x fa-quote-right"></i>
                                                                    </div>
                                                                </div>
                                                                <?php echo'<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Be carafull To Start The Exam Be Wise Use Of Time.</div>';
                                                                ?>
                                                            </div></div>  


                                                        <?php
                                                    }
                                                } else {

                                                    echo'<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> The Course for these exam inactive be wait a time.</div>';
                                                }
                                            } else {

                                                echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> There is no added exam in thes course .</div>';
                                            }
                                        }
                                    }
                                ?>
                            </form>
                        </div>
                    </div>                   
                </div>

                 <div class="col-sm-12 col-md-5 ml-5"> 
                    <div class="card border-info">    
                        <div class="card-header bg-info">List of Courses can be added to the exam with number of questions</div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr class="info">
                                        <th>C_code</th>
                                        <th>Total_No_Ques</th>
                                        <th>Time_Duration</th>
                                    </tr>
                                    <?php
                                        $query2 = mysqli_query($conn, "select * from coursestudent where studentid = '$userid'");
                                        while ($row3 = mysqli_fetch_array($query2)) {
                                            $coursecode = $row3['coursecode'];
                                            $query3 = mysqli_query($conn, "select * from examlist where coursecode = '$coursecode'");
                                            if (mysqli_num_rows($query3) >= 1) {
                                                ?>

                                                <?php
                                                $row5 = mysqli_fetch_array($query3);
                                                $exam_id = $row5['exam_id'];
                                                $duration = $row5['duration'];
                                                $coursecode1 = $row5['coursecode'];
                                                $query4 = mysqli_query($conn, "select * from test where exam_id='$exam_id'");
                                                $number = mysqli_num_rows($query4);
                                                echo '<tr>';
                                                echo '<td>' . $coursecode1 . '</td><td>' . $number . '    Questions' . '</td><td>' . $duration . '     :Minutes' . '</td></tr>';
                                            }
                                        }

                                        //                                    $selectquery = mysqli_query($conn, "select * from examlist where to_date <= '$day'");
                                        //                                    if(mysqli_num_rows($selectquery) >= 1){
                                        //                                    while ($row6 = mysqli_fetch_array($selectquery)) {
                                        //                                        $exam_id1 = $row6['exam_id'];
                                        //                                        $hide = 'hidden';
                                        //                                        $update = mysqli_query($conn, "update examlist set status= '$hide' where exam_id='$exam_id1'");
                                        //                                        if(!$update){
                                        //                                            echo mysqli_error();
                                        //                                    }}
                                        //                                   }
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

