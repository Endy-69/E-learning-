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
        <!-- body -->
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-6"> 
                    <div class="card">
                        <div class="card-header bg-info">Download course material </div>
                        <table class="table table-responsive table-bordered">
                            <tr>
                                <th scope="col">C_code</th>
                                <th scope="col">Material_description</th>
                                <th scope="col">Uploaddate</th>
                            </tr>
                            <?php
                                $day = date('Y-m-d');
                                include("../learn/database.php");
                                $selectlists = mysqli_query($conn,"select * from student where studentid='$userid'");
                                $lists = mysqli_fetch_array($selectlists);
                                
                                $selectcodes = mysqli_query($conn,"select * from coursestudent where studentid='$userid'");
                                while ($row2s = mysqli_fetch_array($selectcodes)) {
                                    $codes = array($row2s['coursecode']);
                                    foreach ($codes as $values) {
                                        $checks = mysqli_query($conn,"select * from coursematerial where section='$sections' AND coursecode='$values'");
                                        if (mysqli_num_rows($checks) >= 1) {
                                            while ($rows = mysqli_fetch_array($checks)) {
                                                $coursecodes = $rows['coursecode'];

                                                echo '<tr class ="info">';
                                                echo '<td>' . $rows['coursecode'] . '</td><td>' . $rows['description'] . '</td><td>' . $rows['uploaddate'] . '</td></tr>';
                                            }
                                        }
                                    }
                                }
                            ?>
                        </table>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div class="card"> 
                        <div class="card-header bg-info">
                            Download the course material that are forward by the instructor
                        </div>
                        <div class="card-body">
                            <form action=""method="post" onsubmit="return validate();" name="group">
                                <div class="form-group">
                                    <label class="control-label" for="department">
                                        Course code
                                    </label>
                                    <?php
                                        include("../learn/database.php");
                                        $selectlist = mysqli_query($conn,"select section from student where studentid='$userid'");
                                        $list = mysqli_fetch_array($selectlist);
                                        $section = $list['section'];
                                        $selectcode = mysqli_query($conn,"select coursecode from coursestudent where studentid='$userid'");
                                        if (mysqli_num_rows($selectcode) >= 1) {
                                            ?>
                                            <div class="form-group">
                                                <select class="form-control" name="coursecode">
                                                    <option value="select">..select..</option>
                                                    <?php
                                                    while ($row1 = mysqli_fetch_array($selectcode)) {
                                                        $codevalue = $row1['coursecode'];
                                                        $selectall = mysqli_query($conn,"select * from coursematerial where coursecode='$codevalue' AND section='$section'");
                                                        if (mysqli_num_rows($selectall) >= 1) {
                                                            $fetch = mysqli_fetch_array($selectall);
                                                            echo $fetch['coursecode'];
                                                            ?>
                                                            <option value="<?php echo $fetch['coursecode']; ?>"><?php echo $fetch['coursecode']; ?>    </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select></div><div class="col-sm-4">
                                                <p id="coursecode1"></p>
                                            </div>
                                            <input type="hidden" name="section" value="<?php echo $section; ?>">
                                            <?php
                                        } else {
                                            
                                        }
                                    ?>
                                </div> 
                                <div class="form-group float-right">
                                    <button type="submit" class="btn btn-lg btn-success" name="select" onclick="return validate();">
                                        <i class="fa fa-1x fa">Select</i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                        <?php
                            include("../learn/database.php");
                            if (isset($_POST['select'])) {

                                $coursecode = $_POST['coursecode'];
                                $section = $_POST['section'];
                                $sql = mysqli_query($conn,"select * from coursematerial where coursecode='$coursecode' AND section='$section'");

                                echo "<table  class='table table-responsive table-striped'>
                                <thead>
                                    <tr class='danger'>
                                    <th><font color='black' size='2'>cmid</th>
                                    <th><font color='black' size='2'>Course code</th>
                                    <th><font color='black' size='2'>Description of Course_Material </th>
                                        <th><font color='black' size='2'>File type</th>
                                        <th><font color='black' size='2'>  Download       </th></tr>";
                                while ($row = mysqli_fetch_array($sql)) {

                                    echo '<tr class="info">';
                                    echo"<td>";
                                    echo $row["cmid"];
                                    echo"</td>";
                                    echo"<td>";
                                    echo $row["coursecode"];
                                    echo"</td>";
                                    echo"<td>";
                                    echo $row["description"];
                                    echo"</td>";
                                    echo"<td>";
                                    echo $row["filetype"];
                                    echo"</td>";
                                    echo "<td align=center><a title='Click here to download in file.' 
                                        href='downloadm.php?id={$row['filename']}'><i class='fa fa-1x fa-download' style=\"color: red;\"> Download</i></a>";
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
    </body>
    <?php include '../shared/footer.php'; ?>
</html>



