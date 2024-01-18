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
                <span class="navbar-icon"></span>
                <span class="navbar-icon"></span>
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
                            <a href="../shared/changepasswordstudent.php">
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
                <div class="col-sm-12 col-md-5 card border-danger p-3 m-3">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h6 class="crd-title">Download Assignment</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>C_code</th>
                                    <th>A_num</th>
                                    <th>A_description</th>
                                    <th>Expire</th>
                                    <th>Work</th>

                                </tr>

                                <?php
                                    $day = date('Y-m-d');
                                    include("../learn/database.php");
                                    $data = date('Y-m-d');
                                    $selectlists = mysqli_query($conn,"select * from student where studentid='$userid'");
                                    $lists = mysqli_fetch_array($selectlists);
                                    $sections = $lists['section'];
                                    $selectcodes = mysqli_query($conn,"select * from coursestudent where studentid='$userid'");
                                    while ($row2s = mysqli_fetch_array($selectcodes)) {
                                        $codes = $row2s['coursecode'];
                                        $checks = mysqli_query($conn,"select * from assignment where section='$sections' AND coursecode='$codes' AND studentid='$userid' AND deadline >= '$data'");
                                        if (mysqli_num_rows($checks) >= 1) {
                                            while ($rows = mysqli_fetch_array($checks)) {
                                                $coursecodes = $rows['coursecode'];
                                                $deadline = $rows['deadline'];
                                                $date1 = $deadline;

                                                $date2 = date('Y-m-d');

                                                $diff = abs(strtotime($date2) - strtotime($date1));

                                                $years = floor($diff / (365 * 60 * 60 * 24));
                                                $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                                $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                                                echo '<tr class ="info">';
                                                $course_code = $rows['coursecode'];
                                                $assign_no = $rows['assignno'];
                                                echo '<td>' . $rows['coursecode'] . '</td><td>' . $rows['assignno'] . '</td><td>' . $rows['description'] . '</td><td>LFET:  +' . $days . '   day</td>';
                                                $selectquestionall = mysqli_query($conn,"select * from assignment where coursecode='$course_code' AND assignno ='$assign_no' AND studentid='$userid'");
                                                
                                                
                                                if (mysqli_num_rows($selectquestionall) >= 1) {
                                                    echo '<td> <i class="fa fa-1x fa-check-square"></i> </td>';
                                                } elseif (mysqli_num_rows($selectquestionall) <= 0) {
                                                    echo '<td> <i class="fa fa-1x fa"><font color="red">Please wait</font></i></td>';
                                                }
                                                echo'</tr>';
                                            }
                                        } 
                                    }

                                    if (mysqli_num_rows($checks) < 1) {
                                        echo '<font class="text-danger">All the assignment given to your section are a head of the deadline, so you can\'t download them. </font> ';
                                    }
                                ?>
                            </table>
                        </div>
                    </div> 
                </div>

                <div class="col-sm-12 col-md-6 card border-danger p-3 m-3">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h6 class="card-title">
                                To download the assignment question first we have select the corsecode
                            </h6>
                        </div>
                        <div class="card-body">
                           <form action=""method="post" onsubmit="return validate();" name="group">
                                <div class="form-group">
                                    <label class="control-label" for="department">Course code</label>
                                    <?php
                                        include("../learn/database.php");
                                        $selectlist = mysqli_query($conn,"select section from student where studentid='$userid'");
                                        $list = mysqli_fetch_array($selectlist);
                                        $section = $list['section'];
                                        $selectcode = mysqli_query($conn,"select coursecode from coursestudent where studentid='$userid'");
                                        if (mysqli_num_rows($selectcode) >= 1) {
                                            ?>
                                            <div class="">
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
                                                </select></div><div class="">
                                                <p id="coursecode1"></p>
                                            </div>
                                            <input type="hidden" name="section" value="<?php echo $section; ?>">
                                            <?php
                                        }
                                        //  else {
                                        //     echo '<font class="text-danger">All the assignment given to your section are a head of the deadline, so you can\'t download them. </font> ';
                                        // }
                                    ?>
                                </div> 
                                <div class="form-group float-right"> 
                                    <button type="submit" class="btn btn-lg btn-success" name="select" onclick="return validate();">
                                        <i class="fa fa-1x fa">Select</i>
                                    </button> 
                                </div>

                                <?php
                                include("../learn/database.php");
                                if (isset($_POST['select'])) {
                                    $coursecode = $_POST['coursecode'];
                                    $section1 = $_POST['section'];
                                    $abcd = 0000 - 00 - 00;
                                    $day = date('Y-m-d');

                                    $sql = mysqli_query($conn,"select * from assignment where coursecode='$coursecode' AND section='$section1' AND deadline >= '$day'");
                                    if (mysqli_num_rows($sql) >= 1) {
                                        echo "<table  class='table table-striped'>
                                        <thead>
                                            <tr class='danger'>
                                            <th><font color='black' size='2'>Assign No</th>
                                            <th><font color='black' size='2'>Assign Type</th>
                                            <th><font color='black' size='2'>Course Code</th>
                                            <th><font color='black' size='2'>Description of Assignment </th>
                                            <th><font color='black' size='2'>Deade line</th>
                                            <th><font color='black' size='2'>Download</th></tr>";
                                            while ($row1 = mysqli_fetch_array($sql)) {
                                                $assign_no1 = $row1['assignno'];

                                                echo '<tr class="info">';
                                                echo"<td>";
                                                echo $row1["assignno"];
                                                echo"</td>";
                                                echo"<td>";
                                                echo $row1["assigntype"];
                                                echo"</td>";
                                                echo"<td>";
                                                echo $row1["coursecode"];
                                                echo"</td>";
                                                echo"<td>";
                                                echo $row1["description"];
                                                echo"</td>";
                                                echo"<td>";
                                                echo $row1["deadline"];
                                                echo"</td>";
                                                $validate = mysqli_query($conn,"select * from assignment where assignno='$assign_no1' AND coursecode ='$coursecode' and studentid='$userid' and studentid=''");
                                                if (mysqli_num_rows($validate) >= 1) {
                                                    echo '<td align=center><a title="THESE  ASSIGNMENT QUESTION IS ALLREADY DOWNLOAD"><i class="fa fa-1x fa-check-square"></i></a>';
                                                    echo"</td>";
                                                } elseif (mysqli_num_rows($validate) < 1) {
                                                    echo "<td align=center><a title='CLICK HERE TO DOWNLOAD THE ASSIGNMENT QUESTIONS.' 
                                                    href='downloadas.php?id={$row1['filename']}'><i class='fa fa-1x fa-download'></i> </a>";
                                                    echo"</td>";
                                                }

                                                echo"</tr>";
                                            }
                                        echo "</table>";
                                    } else {
                                        echo '<p class="text-danger"><b>There is not uploaded Assignment question for these course or the assignment deadline is over</b></p>';
                                    }
                                }
                                ?>
						    </form>
                        </div>
                    </div>
                    </div>
                </div> 
            </div>
        </div>
    </body>
    <?php include '../shared/footer.php' ?>
</html>



