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
                <ul class="nav navbar-nav ml-auto" style="font-family: cursive;"> 
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="profile">
                            <i class="fa fa-1x fa-user"> Profile</i>
                            <i class="fa fa-sm fa-1x fa-chevron-down"></i>
                        </a>
                        <div class="dropdown-content dropdown-menu dropdown-menu-right">
                            <a class="navbar-link" href="../student/changepasswordstudent.php">
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
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-3"> 
                    <?php 
                        include '../shared/sidebar.php';
                    ?>
                </div>
                <div class="col-sm-12 col-md-9"> 
                    <?php
                    include("../learn/database.php");
                    $sql = mysqli_query($conn, "select * from instructor where instructorid='$userid'");
                    $row = mysqli_fetch_array($sql);
                    $dept = $row['departmentid'];
                    $sql1 = mysqli_query($conn,"select * from department where departmentid='$dept'");
                    $row1 = mysqli_fetch_array($sql1);
                    $dept1 = $row1['departmentname'];
                    echo'<p>Download the annual calendar that is uploaded by the registrar to the   ' . '<font color="red"><b>' . $dept1 . '</b></font>' . '  department!!!!</p>';
                    ?>
                    <div class="card border-info">
                        <div class="card-header bg-info">
                            <h5 class="card-title">Download The Annual Calendar File</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            include("../learn/database.php");
                            $sql = mysqli_query($conn,"select * from instructor where instructorid='$userid'");
                            $row1 = mysqli_fetch_array($sql);
                            $deptid = $row1['departmentid'];
                            $sql1 = mysqli_query($conn,"select * from calendar where departmentid='$deptid'");
                            if (mysqli_num_rows($sql1) >= 1) {

                                echo "<table  class='table table-striped'>
                                    <thead>
                                <tr class='info'>
                                <th><font color='black' size='2'>Calendar id</th>
                                <th><font color='black' size='2'>Description</th>
                                <th><font color='black' size='2'>File_type</th>

                                <th><font color='black' size='2'>Download</th></tr>";
                                while ($row2 = mysqli_fetch_array($sql1)) {
                                    echo '<tr class="active">';
                                    echo"<td>";
                                    echo $row2["calendarid"];
                                    echo"</td>";
                                    echo"<td>";
                                    echo $row2["description"];
                                    echo"</td>";
                                    echo"<td>";
                                    echo $row2["filetype"];
                                    echo"</td>";
                                    echo "<td align=center><a title='Click here to download in file.' 
                                href='download.php?id={$row2['filename']}'><i class='fa fa-1x fa-download' style=\"color: red;\"></i></a>";
                                    echo"</td>";
                                    echo"</tr>";
                                }
                                echo "</table>";
                            }
                            ?>     
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </body>
    <?php include '../shared/footer.php';?>
</html>



