<?php
session_start();
include("../learn/database.php");
if (isset($_SESSION['userid']) && ($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $userid = $_SESSION['userid'];
    $select = mysqli_query($conn,"select * from instructor where instructorid='$userid'");
    $row = mysqli_fetch_array($select);
    $email = $row['email'];
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $status = $row['status'];
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
                        <a class="navbar-link" href="../instructor/instructor.php" title="This is Home Page Of Instructor">
                            <i class="fa fa-1x fa">Home</i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This is Upload Resource To The Student"> 
                            <i class="fa fa-1x fa">Upload</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="uploadcoursematerial.php" title="This is upload Resource Material To The Department Student"> Course Material</a>
                            <a href="uploadassignmentquestion.php"title="This is Assignment Question To The Student">Assignment Question</a>
                            <a href="../instructor/uploadexam.php" title="This is Evaluation Exam To The Course Student"> Exam</a>
                            <a href="../instructor/uploadcourseresult.php"title="This is Upload Student Result To The Student For The Course">Course Result</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This is Download Resource Material ">
                            <i class="fa fa-1x fa"> Download</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="downloadannualcalendar.php" title="This is Download The Caricullem Calendar From The Registrar Officer">Annual Calendar</a>
                            <a href="downloadstudentlist.php" title="This is Download Student List From The Department"> Student List</a>
                            <a href="downloadassignmentanswer.php" title="This is Download Assignment Answer Upload By The Student">Assignment Answer</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This is View Notice Page Release From The Department"> 
                            <i class="fa fa-1x fa">View</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="viewnotice.php"> Notice</a>
                        </div>
                    </li>  
                </ul>
                <ul class="nav navbar-nav ml-left">
                    <li class="tab">
                        <a class="navbar-link" href="../learn/logout.php" title="This is Leave From The Home Page Of Instructor">
                            <i class="fa fa-1x fa-sign-out">Logout</i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- body -->
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-6 ">
                    <div class="card border-info">
                        <div class="card-header bg-info"> The Uploaded Assignment Question</div>
                        <div class="card-body">
                            <table class="table table-bordered">

                                <tr class="danger">
                                    <th>C_Code</th>
                                    <th>Assign_nu</th>
                                    <th>Sec</th>
                                    <th>Assign_type</th>
                                    

                                </tr>
                                <?php
                                include '../learn/database.php';
                                $date = date('Y-m-d');
                                $selectr = mysqli_query($conn,"select * from assignment where instructorid='$userid'  AND studentid='' AND submissiondate='0000-00-00' AND deadline >= '$date'");
                                while ($row4 = mysqli_fetch_array($selectr)) {
                                    echo '<tr>';
                                    echo '<td>' . $row4['coursecode'] . '</td><td>' . $row4['assignno'] . '</td><td>' . $row4['section'] . '</td><td>' . $row4['assigntype'] . '</td></tr>';
                                }
                                ?></table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12  col-md-6">
                    <div id="feed">
                        <?php
                        include("../learn/database.php");
                        $sql = mysqli_query($conn,"select * from instructor where instructorid='$userid'");
                        $row = mysqli_fetch_array($sql);
                        $dept = $row['departmentid'];
                        $sql1 = mysqli_query($conn,"select * from department where departmentid='$dept'");
                        $row1 = mysqli_fetch_array($sql1);
                        $dept1 = $row1['departmentname'];
                        ?>
                        <div class="card border-info ">
                            <div class="card-header bg-info"><?php
                                echo'<p>Upload the assignment question for   ' . '<font color="red"><b>' . $dept1 . '</b></font>' . '  department student taken for these course!!!!</p>';
                                ?></div>
                            <div class="card-body">
                                <form  action="uploadassignmentquestion.php"method="post"class="form-horizontal" role="form" name="assign1"onSubmit="return assignment();"enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label class=" control-label">Assignment Number:</label>
                                        <div class="">
                                            <input class="form-control" type="text" name="assignno">
                                        </div><div class=""><p id="assignno1"></p></div>
                                    </div> </br>
                                    <div class="form-group">
                                        <label class=" control-label">Assignment Type:</label>
                                        <div class="">
                                            <select class="form-control" name="assigntype">
                                                <option selected>..select..</option>
                                                <option>Individual</option>
                                                <option>Group</option>

                                            </select>
                                            </div>
                                            <div class="">
                                            <p id="assigntype1">
                                            </p>
                                        </div>
                                        </div>
                                        </br>
                                    <?php
                                    include("../learn/database.php");
                                    $select1 = mysqli_query($conn,"select DISTINCT section from courseinstructor where instructorid='$userid'");

                                    echo'<div class="form-group">';
                                    echo'<label class="control-label ">
                             Section: </label>';
                                    echo'<div class="">';
                                    echo'<select  name="section" class="form-control">';
                                    echo'<option selected>..select..</option>';

                                    while ($row = mysqli_fetch_array($select1)) {
                                        $section = $row['section'];
                                        ?>       

                                        <option value="<?php echo $section; ?>"><?php echo $section; ?></option>;

                                        <?php
                                    }
                                    echo'</select>';
                                    echo'</div>';
                                    echo'<div class="">';
                                    echo'<p id="section1"></p></div>';
                                    echo'</div>';
                                    echo '</br>';

                                    $select1 = mysqli_query($conn,"select DISTINCT coursecode from courseinstructor where instructorid='$userid'");
                                    echo'<div class="form-group">';
                                    echo'<label class="control-label ">
                               Course Name: </label>';
                                    echo'<div class="">';
                                    echo'<select  name="coursecode" class="form-control">';
                                    echo'<option selected>..select..</option>';
                                    while ($row2 = mysqli_fetch_array($select1)) {
                                        $coursecode = array($row2['coursecode']);
                                        foreach ($coursecode as $value) {
                                            $select5 = mysqli_query($conn,"select DISTINCT coursename from course where coursecode='$value'");
                                            $row5 = mysqli_fetch_array($select5);
                                            $coursename = $row5['coursename'];
                                            ?>
                                            <option value="<?php echo $value; ?>"><?php echo $coursename; ?></option>

                                            <?php
                                        }
                                    }
                                    echo'</select>';
                                    echo'</div>';
                                    echo'<div class="">';
                                    echo'<p id="coursecode1"></p></div>';
                                    echo'</div>';
                                    echo '</br>';
                                    ?> 
                                    <div class="form-group">
                                        <label class="control-label ">Dead Line: </label>
                                        <div class="">
                                            <input type="date" name="date"/>
                                        </div>
                                    </div>

                                    <div class="form-group">        
                                        <label class="control-label ">Assignment Question: </label>
                                        <div class="">
                                            <input type="file" name="files"/>
                                        </div>
                                        <div class=""><p id="lblError"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">        
                                        <label class="control-label ">Description of Assignment Question: </label>
                                        <div class="">
                                            <textarea class="form-control" rows="5" name="description"></textarea>
                                        </div>
                                        <div class=""><p id="desc"></p>
                                        </div>
                                    </div>
                                    <div class="form-group float-right">        
                                        <div class="">
                                            <button type="submit" class="btn btn-danger" value="upload" name="upload"onchange="onclick assignment();">
                                                <i class="fa fa-1x fa-send"></i> Upload
                                            </button>
                                            <button type="reset" class="btn btn-danger" value="cancel" name="cancel">
                                                <i class="fa fa-1x fa-times"></i> Cancel
                                            </button>
                                        </div>
                                    </div> 
                                </form></div>
                        </div>
                        <?php
                        include("../learn/database.php");
                        if (isset($_POST['upload'])) {
                            $coursecode1 = $_POST['coursecode'];
                            $assign = $_POST['assignno'];
                            $group = $_POST['assigntype'];
                            $description = $_POST['description'];
                            $weath = $status . '   ' . $firstname . '   ' . $lastname . '  ' . $description;

                            $day = $_POST['date'];
                            $section1 = $_POST['section'];
                            $day1 = date('Y-m-d');
                            $select1 = mysqli_query($conn,"select * from coursestudent where coursecode='$coursecode1'");
                            while ($row1 = mysqli_fetch_array($select1)) {
                                $student = $row1['studentid'];
                                $select2 = mysqli_query($conn,"select * from student where section='$section1' AND studentid='$student'");
                                while ($row2 = mysqli_fetch_array($select2)) {
                                    $student1 = $row2['studentid'];
                                    $select3 = mysqli_query($conn,"select * from student where studentid='$student1'");
                                    while ($row3 = mysqli_fetch_array($select3)) {
//                                        
                                    }
                                }
                            }


                            if ($day >= $day1) {

                                $file = $_FILES['files']['name'];
                                $file_loc = $_FILES['files']['tmp_name'];
                                $file_size = $_FILES['files']['size'];
                                $file_type = $_FILES['files']['type'];
                                $folder = "assignment/";

                                // new file size in KB
                                $new_size = $file_size / 1024;
                                // new file size in KB
                                // make file name in lower case
                                $new_file_name = strtolower($file);
                                // make file name in lower case

                                $final_file = $new_file_name;

                                move_uploaded_file($file_loc, $folder . $final_file);
                                $select2 = mysqli_query($conn,"select * from assignment where assignno='$assign' AND coursecode='$coursecode1' AND section='$section1' AND studentid='' AND instructorid='$userid'");
                                if (mysqli_num_rows($select2) <= 0) {
                                    $query = mysqli_query($conn,"INSERT INTO assignment VALUES ('','$assign','$group','','$coursecode1','$final_file','$file_type','$day','','$section1','$weath','$userid','')");
                                    if ($query) {

                                        echo "<font color='red'>Successfully upload the assignment to the student</font>";
                                    } else {
                                        echo '<font color ="red">Not upload the assignment to the student</font>';
                                    }
                                } else {

                                    echo 'the assignment number is duplicate try anther assignment numbers';
                                }
                            } else {

                                echo '<font color="red">The deadline is not Approprate for these assignment??</font>';
                            }
                        }
                        ?>    
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php include '../shared/footer.php'; ?>
</html>


