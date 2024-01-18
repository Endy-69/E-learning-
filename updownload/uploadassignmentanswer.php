<?php
session_start();
include("../learn/database.php");
if (isset($_SESSION['userid']) && ($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $userid = $_SESSION['userid'];
    $select = mysqli_query($conn,"select * from student where studentid='$userid'");
    $row = mysqli_fetch_array($select);
    $emailaddress = $row['email'];
} else {
    header("Location: ../learn/login.php");
}
?>
<html>
    <head>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/jquery.min.js"></script>

        <link href="../css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/> 
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
                        <a class="navbar-link" href="../student/student.php"  title="This Is Home page Of Student"> 
                            <i class="fa fa-1x fa">Home</i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This Is Upload Resource To The Instructor">
                            <i class="fa fa-1x fa">Upload</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="uploadassignmentanswer.php" title="This Is Upload Assignment Question"> Assignment Answer</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This Is Download Resource Material">
                            <i class="fa fa-1x fa">Download</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="downloadassignmentquestion.php" title="This Is Download Assignment Questions">Assignment Question</a>
                            <a href="downloadcoursematerial.php" title="This Is Download Course_Material"> Course Materialt</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This Is View Resource Page">
                            <i class="fa fa-1x fa">View</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="viewnoticest.php" title="This Is View Notice Page From Department"> Notice</a>
                            <a href="../student/viewcourseresult.php" title="This Is View Course Result ">Course result</a>
                        </div>
                    </li>  
                    <li class="tab">
                        <a class="navbar-link" href="../student/takeexam.php" title="This Is Online Exam Page"> 
                            <i class="fa fa-1x fa">Take Exam</i>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right" style="font-family: cursive;"> 
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="profile">
                            <i class="fa fa-1x fa-user"> Profile</i>
                            <i class="fa fa-sm fa-1x fa-chevron-down"></i>
                        </a>
                        <div class="dropdown-content dropdown-menu dropdown-menu-right">
                            <a href="../student/changepasswordstudent.php">
                                <i class="fa fa-1x fa-key text-dark">Change Password</i>
                            </a> 
                            <a href="../learn/logout.php" title="This Is Leave From Student Page"> 
                                <i class="fa fa-1x fa-sign-out text-dark">Logout</i>
                            </a>                            
                        </div>
                    </li> 
                </ul>
            </div> 
        </nav>
        <!-- body -->
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-sm-5 col-md-5 m-2"> 
                    <div class="card border-info">
                        <div class="card-header bg-info p-2 font-weight-bold">Student Assignment List</div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr bgcolor="#99ffbb">
                                        <th>Course_Name</th>
                                        <th>Assign_No</th>
                                        <th>Upload_Date</th>
                                        <th>Hide</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include("../learn/database.php");
                                    $selectr = mysqli_query($conn,"select * from student where studentid='$userid'");
                                    $row = mysqli_fetch_array($selectr);
                                    $sectionr = $row['section'];
                                    $query = mysqli_query($conn,"select * from coursestudent where studentid='$userid'");
                                    while ($row1 = mysqli_fetch_array($query)) {
                                        $coursecode = $row1['coursecode'];
                                        $query1 = mysqli_query($conn,"select DISTINCT coursename from course where coursecode='$coursecode'");
                                        $row2 = mysqli_fetch_array($query1);
                                        $coursename = $row2['coursename'];
                                        $selectassign = mysqli_query($conn,"select * from assignment where coursecode='$coursecode' AND studentid='$userid' AND status=1");
                                        while ($row5 = mysqli_fetch_array($selectassign)) {
                                            echo '<tr class="info">';
                                            echo '<td>' . $coursename . '</td><td>' . $row5['assignno'] . '</td><td>' . $row5['submissiondate'] . '</td><td><a href =uploadassignmentanswer.php?hide=' . $coursecode . '&studentid=' . $userid . '&id=' . $row5['id'] . '>hide</a></td>';
                                            echo'</tr>';
                                        }
                                    }
                                    ?>  </tbody></table></div>
                        <?php
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $hide = $_GET['hide'];
                            $studentid = $_GET['studentid'];
                            mysqli_query($conn,"update assignment set status=0 where id='$id' AND studentid='$studentid' AND coursecode='$hide'");
                        }
                        ?>
                    </div> 
                </div>

                <div class="col-sm-6 col-md-6 m-2">
                    <br>
                    <div class="card border-info">
                        <div class="card-header bg-info">
                            <h5 class="card-title">Upload assignment answer to the instructor </h5>   
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" role="form"name="group"method="post"action="uploadassignmentanswer.php"enctype="multipart/form-data"onsubmit="return group1();">
                                <div class="form-group">
                                    <label class="control-label " for="ass"><p class="serif">Assignment Number:</p></label>
                                    <div class="">
                                        <input type="text" class="form-control"  placeholder="Enter enter the assign number"name="assignno">
                                    </div><div class=""> <p id="assignno1"></p></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label " for="ass"><p class="serif">Assignment Type:</p></label>
                                    <div class="">
                                        <select class="form-control"  name="group">
                                            <option selected>..select..</option>
                                            <option> Group</option>
                                            <option>Individual</option></select></div><div class=""><p id="group2"></p></div>
                                </div>
                                <?php
                                    include("../learn/database.php");
                                    $select2 = mysqli_query($conn,"select * from student where studentid='$userid'");
                                    $row = mysqli_fetch_array($select2);
                                    $section = $row['section'];
                                    $select = mysqli_query($conn,"select * from coursestudent where studentid='$userid'");
                                    echo'<div class="form-group">';
                                    echo'<label class="control-label ">
                                    <p class="serif"> Course Code: </p></label>';
                                    echo'<div class="">';
                                    echo'<select  name="coursecode" class="form-control">';
                                    echo'<option selected>..select..</option>';

                                    while ($row = mysqli_fetch_array($select)) {
                                        $coursecode = $row['coursecode'];
                                    ?>       

                                    <option value="<?php echo $coursecode; ?>"><?php echo $coursecode; ?></option>;

                                <?php
                                    }
                                    echo'</select>';
                                    echo'</div>';
                                    echo'<div class="">';
                                    echo'<p id="coursecode1"></p></div>';
                                    echo'</div>';
                                    echo '</br>';
                                ?> 
                                <input type="hidden" name="section" value="<?php echo $section; ?>">
                                <div class="form-group">        
                                    <label class="control-label "><p class="serif">Assignment File:</p> </label>
                                    <div class="">
                                        <input type="file" name="files" value="files"/>
                                    </div><div class=""><p id="fileid"></p>
                                    </div>
                                </div>               
                                <div class="form-group float-right">        
                                    <button type="reset" class="btn btn-danger" value="cancel" name="cancel">Cancel</button>
                                    <button type="submit" class="btn btn-lg btn-success" value="upload" name="upload"onchange="onclick group1();"><i class="fa fa-1x fa-upload">Upload</i></button>
                                </div>  
                            </form> 
                            <?php
                                include("../learn/database.php");
                                if (isset($_POST['upload'])) {
                                    $assign = $_POST['assignno'];
                                    $group = $_POST['group'];
                                    $coursecode1 = $_POST['coursecode'];
                                    $section1 = $_POST['section'];
                                    $selectins = mysqli_query($conn,"select * from courseinstructor where coursecode='$coursecode1' AND section = '$section1'");
                                    $row2 = mysqli_fetch_array($selectins);
                                    $instructorid = $row2['instructorid'];
                                    $select4 = mysqli_query($conn,"select * from instructor where instructorid='$instructorid'");
                                    $row4 = mysqli_fetch_array($select4);
                                    $emailinstructor = $row4['email'];
                                    //                            $feed = 'hi';
                                    //                                require 'PHPmailer/PHPMailerAutoload.php';
                                    //                                $mail = new PHPMailer;
                                    //                                $mail->isSMTP();
                                    //                                $mail->Host = 'smtp.gmail.com';
                                    //                                $mail->SMTPAuth = true;
                                    //                                $mail->Username =  $emailaddress;
                                    //                                $mail->Password = 'ayeleatlawmulat';
                                    //                                $mail->SMTPSecure = 'tls';
                                    //                                $mail->Port = 587;
                                    //                                $mail->setFrom($emailaddress, 'ELS');
                                    //
                                    //                                $mail->addAddress($emailinstructor, 'ELS');
                                    //
                                    //                                $mail->isHTML(true);
                                    //                                $msg = $feed;
                                    //                                $mail->Subject = 'ELS FOR ASSIGNMENT';
                                    //                                $mail->Body = $msg;
                                    //                                $mail->AltBody = 'els for asu';
                                    //
                                    //                                if (!$mail->send()) {
                                    //                                    echo $mail->ErrorInfo;
                                    //                                      } else {
                                    //                                    echo'<script type="text/javascript">alert("Succsfuly You Upload!! ");window:location=\'uploadassignmentanswer.php\';</script>';
                                    //                                }
                                    $file = $_FILES['files']['name'];
                                    $file_loc = $_FILES['files']['tmp_name'];
                                    $file_size = $_FILES['files']['size'];
                                    $file_type = $_FILES['files']['type'];
                                    $folder = "assignment/";

                                    $new_size = $file_size / 1024;
                                    $new_file_name = strtolower($file);
                                    $final_file = $new_file_name;
                                    move_uploaded_file($file_loc, $folder . $final_file);
                                    $day = date('y-m-d');
                                    $select3 = mysqli_query($conn,"select * from assignment where studentid='$userid' AND coursecode='$coursecode1' AND assignno='$assign'");
                                    $row3 = mysqli_fetch_array($select3);
                                    $date = $row3['submissiondate'];
                                    if (mysqli_num_rows($select3) <= 0) {

                                        $query = "INSERT INTO assignment VALUES ('','$assign','$group','$userid','$coursecode1','$final_file','$file_type','','$day','$section1','','',1)";

                                        $query1 = mysqli_query($conn,$query);
                                        if ($query1) {
                                            echo '<p class="serif">Successfully upload The assignment</p>';
                                        } else {
                                            echo 'not';
                                        }
                                    } else {
                                        echo '<p class="serif">The assignment of these course for assignment number= ' . '<h4>' . $assign . '   for date  ' . $date . '</h4>' . '<p class="serif">  to be upload try anther assignment??</p>';
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



