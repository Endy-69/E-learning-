<?php
session_start();
include("../learn/database.php");
if (isset($_SESSION['userid']) && ($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $userid = $_SESSION['userid'];
} else {
    header("Location: ../learn/login.php");
}
?>
<html>
    <head>
        <script src="../js/depthead.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/innstructor.js" type="text/javascript"></script>
        <link href="../css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/> 
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
                <span class="navbar-icon"></span>
                <span class="navbar-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav mr-auto">
                    <li class="tab">
                        <a  class="navbar-link" href="../instructor/instructor.php" title="This is Home Page Of Instructor">
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
                <ul class="nav navbar-nav ml-auto" style="font-family: cursive;"> 
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="profile">
                            <i class="fa fa-1x fa-user"> Profile</i>
                            <i class="fa fa-sm fa-1x fa-chevron-down"></i>
                        </a>
                        <div class="dropdown-content dropdown-menu dropdown-menu-right">
                            <a class="navbar-link" href="../shared/changepasswordstudent.php">
                                <i class="fa fa-1x fa-key text-dark">Change Password</i>
                            </a> 
                            <a class="navbar-link" href="../learn/logout.php" title="This Is Leave From Student Page"> 
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
                <div class="col-sm-12 col-md-5">
                    <div class="card border-danger">
                        <div class="card-header bg-info">
                            <h5 class="card-title">Number Of Student Upload Assignment For These Course</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr class="danger">
                                    <th>Course_name</th>
                                    <th>Section</th>
                                    <th>Number_of_Student</th>
                                </tr>
                                <?php
                                    include("../learn/database.php");
                                    $selectr = mysqli_query($conn,"select DISTINCT section  from courseinstructor where instructorid='$userid'");
                                    while ($row = mysqli_fetch_array($selectr)) {
                                        $section = array($row['section']);
                                        $select1r = mysqli_query($conn,"select DISTINCT coursecode from courseinstructor where instructorid='$userid'");
                                        while ($row2 = mysqli_fetch_array($select1r)) {
                                            $coursecode = array($row2['coursecode']);
                                            foreach ($section as $value3) {
                                                foreach ($coursecode as $value) {
                                                    $select5r = mysqli_query($conn,"select DISTINCT coursename from course where coursecode='$value'");
                                                    $row5 = mysqli_fetch_array($select5r);
                                                    $coursename = $row5['coursename'];
                                                    $selectstude = mysqli_query($conn,"select * from assignment where coursecode='$value' AND section='$value3' AND submissiondate!='0000-00-00'");
                                                    $number = mysqli_num_rows($selectstude);
                                                    echo'<tr class="info">';
                                                    echo '<td>' . $coursename . '</td><td>' . $value3 . '</td><td>' . $number . '</td>';
                                                    echo '</tr>';
                                                }
                                            }
                                        }
                                    }
                                ?>
                            </table>
                        </div>
                    </div> 
                </div>

                <div class="col-sm-12 col-md-7">
                    <div id="feed" class="card border-info px-2 py-2"> 
                        <div class="card-header bg-info">
                            <h5 class="card-title">
                                Select The Required Field
                            </h5>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" role="form" name="assignment"onSubmit="return assignment2();" method="post"action="">
                                <div class="form-group">
                                    <label class="control-label" >Assignment Number:</label>
                                    <div class="form-group">
                                        <input class="form-control"type="text" name="assignno" placeholder="please fill the assignment number">
                                    </div>
                                    <div class=""><p id="assignno1"></p></div>
                                </div>
                                <?php
                                include("../learn/database.php");

                                $select = mysqli_query($conn,"select DISTINCT section  from courseinstructor where instructorid='$userid'");
                                echo'<div class="form-group">';
                                echo'<label class="control-label">
                            Section: </label>';
                                echo'<div class="form-group">';
                                echo'<select  name="section" class="form-control">';
                                echo'<option selected>..select..</option>';

                                while ($row = mysqli_fetch_array($select)) {
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
                                echo'<label class="contro">
                                Course Code: </label>';
                                echo'<div class="form-group">';
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
                                <div class="form-group float-right">  
                                    <button type="submit" class="btn btn-primary" value="view" name="view"onchange="onclick assignment()2;">
                                        <i class="fa fa-eye"></i> View</button>
                                    <button type="reset" class="btn btn-primary" value="cancel" name="cancel">
                                        <i class="fa fa-close"></i> Cancel</button>                                      
                                </div>    
                            </form>
                        </div> 
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title"><font color="red">List Of Assignment Answer </font></h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                            include("../learn/database.php");
                                            echo "<table  class='table table-bordered'>
                                            <tr class='success'>
                                                <th><font color='black' size='2'>Assign Number</th>
                                                <th><font color='black' size='2'>Assign Type</th>
                                                <th><font color='black' size='2'>Student Id</th>
                                                <th><font color='black' size='2'>Course Code</th>
                                                <th><font color='black' size='2'>File Name</th>
                                                <th><font color='black' size='2'>Submission Date</th>
                                                <th><font color='black' size='2'>Section</th>
                                                <th><font color='black' size='2'>Action</th></tr>";
                                            $sq = mysqli_query($conn,"select * from courseinstructor where instructorid='$userid'");
                                            $row3 = mysqli_fetch_array($sq);
                                            $coursecode1 = $row3['coursecode'];

                                            $ss = mysqli_query($conn,"select * from assignment where coursecode='$coursecode1'");
                                            while ($row = mysqli_fetch_array($ss)) {
                                                $sub1 = $row['submissiondate'];
                                                $student2 = $row['studentid'];
                                                $section3 = $row['section'];
                                                $assign = $row['assignno'];
                                                if ($sub1 != '0000-00-00') {

                                                    $s = mysqli_query($conn,"select * from assignment where coursecode='$coursecode1' AND studentid='$student2' AND section='$section3' AND assignno='$assign'");


                                                    while ($row4 = mysqli_fetch_array($s)) {
                                                        echo '<tr>';
                                                        echo"<td>";
                                                        echo $row4["assignno"];
                                                        echo"</td>";
                                                        echo"<td>";
                                                        echo $row4["assigntype"];
                                                        echo"</td>";
                                                        echo"<td>";
                                                        echo $row4["studentid"];
                                                        echo"</td>";
                                                        echo"<td>";
                                                        echo $row4["coursecode"];
                                                        echo"</td>";
                                                        echo"<td>";
                                                        echo $row4["filename"];
                                                        echo"</td>";
                                                        echo"<td>";
                                                        echo $row4["submissiondate"];
                                                        echo"</td>";
                                                        echo"<td>";
                                                        echo $row4["section"];
                                                        echo"</td>";
                                                        echo"<td>";
                                                        echo '<a href=downloadassignmentanswer.php?id=' . $row4['id'] . '> <i class="fa fa-1x fa-trash"></i></a>';
                                                        echo"</td>";
                                                        echo '</tr>';
                                                    }
                                                    //break;
                                                }
                                            }echo '</table>';
                                        ?>
                                        <?php
                                        if (isset($_GET['id'])) {
                                            $assid = $_GET['id'];
                                            $delete = mysqli_query($conn,"delete from assignment where id=$assid");
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            include("../learn/database.php");
                            if (isset($_POST['view'])) {
                                $assign = $_POST['assignno'];
                                $cc = $_POST['coursecode'];
                                $section1 = $_POST['section'];
                        ?>
                            <div class="card border-info">
                                <div class="card-header bg-info">Download  Properly</div>
                                <div class="card-body"><?php
                                    $sql = mysqli_query($conn,"select * from assignment where coursecode='$cc' AND assignno='$assign' AND section='$section1'");
                                    if (mysqli_num_rows($sql) >= 1) {
                                        echo "<table  class='table table-bordered'>
                                        <thead>
                                            <tr>
                                                <th><font color='black' size='2'>Assign Number</th>
                                                <th><font color='black' size='2'>Assign Type</th>
                                                <th><font color='black' size='2'>Student Id</th>
                                                <th><font color='black' size='2'>Course Code</th>
                                                <th><font color='black' size='2'>File Name</th>
                                                <th><font color='black' size='2'>Submission Date</th>
                                                <th><font color='black' size='2'> Click here for download </th>
                                            </tr>";
                                        while ($row2 = mysqli_fetch_array($sql)) {
                                            $student = $row2['studentid'];
                                            if (!empty($student)) {
                                                $sql1 = mysqli_query($conn,"select * from assignment where coursecode='$cc' AND assignno='$assign' AND section='$section1'AND studentid='$student'");
                                                $row1 = mysqli_fetch_array($sql1);
                                                echo '<tr>';
                                                echo"<td>";
                                                echo $row1["assignno"];
                                                echo"</td>";
                                                echo"<td>";
                                                echo $row1["assigntype"];
                                                echo"</td>";
                                                echo"<td>";
                                                echo $row1["studentid"];
                                                echo"</td>";
                                                echo"<td>";
                                                echo $row1["coursecode"];
                                                echo"</td>";
                                                echo"<td>";
                                                echo $row1["filename"];
                                                echo"</td>";
                                                echo"<td>";
                                                echo $row1["submissiondate"];
                                                echo"</td>";
                                                echo "<td align=center><a title='Click here to download in file.' 
		                           href='downloadas.php?id={$row1['filename']}'><i class='fa fa-1x fa-download text-danger'></i> </a>";
                                                echo"</td>";
                                                echo"</tr>";
                                            }
                                        }echo "</table>";
                                    } else {
                                        echo '<font color="red"><b>There is not uploaded assignment answer  for these course??</b></font>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php include '../shared/footer.php' ?>
</html>


