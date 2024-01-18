<?php
session_start();
include("../learn/database.php");
if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
} else {
    header("Location: ../learn/login.php");
}
?><html>
    <head>
        <script src="../js/depthead.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/depthead.js" type="text/javascript"></script>
        <link href="../css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/> 
     
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
                        <a class="navbar-link" href="depthead.php" title="This Is Department Head Page">
                            <i class="fa fa-1x fa">Home</i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This Is Download information from Registrar Officer">
                            <i class="fa fa-1x fa">Download</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/downloadstudentlistins.php" title="This Is Download Student List From Registrar Officer"> Student List</a>
                            <a href="../updownload/annualcalendar.php" title="This Is Download The Carruiculm Calendar">Annual Calendar</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" class="navbar-link" href="" title="This Is Upload Information To The Department Society">
                            <i class="fa fa-1x fa">Upload</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/uploadnotice.php" title="This Is Upload Notice To The Department Society">Notice</a>
                        </div>
                    </li>
                    <li class="tab">
                        <a class="navbar-link" href="assigninstructor.php" title="This Is Assign Instructor To The Regiter Course List">
                            <i class="fa fa-1x fa">Assign Instructor</i>
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

        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-6"> 
                    <div class="card border-info">
                        <div class="card-header bg-info">List of Course For Each Batchs</div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="info"><th>Course_Name</th>
                                        <th>Credit_Hour</th>
                                        <th>Year</th>
                                    </tr>
                                </thead>
                                <?php
                                include("../learn/database.php");
                                $query = mysqli_query($conn, "select * from departmenthead where departmentheadid='$userid'");
                                $row = mysqli_fetch_array($query);
                                $department = $row['departmentid'];
                                $query1 = mysqli_query($conn, "select * from course where departmentid ='$department' ORDER BY credithour ASC");
                                while ($row3 = mysqli_fetch_array($query1)) {
                                    echo '<tr>';
                                    echo '<td>' . $row3['coursename'] . '</td><td>' . $row3['credithour'] . '</td><td>' . $row3['year'] . '</td></tr>';
                                }
                                ?> 
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="card border-info">
                        <div class="card-header bg-warning">Instructor List in this Department</div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="info">
                                        <th>Instructor_Name</th>
                                        <th>Status</th>
                                        <th>Section</th>
                                        <th>Assign</th>
                                        <th>See_more</th>
                                    </tr>
                                </thead>
                                <?php
                                include("../learn/database.php");
                                $query2 = mysqli_query($conn, "select * from departmenthead where departmentheadid='$userid'");
                                $row = mysqli_fetch_array($query2);
                                $departments = $row['departmentid'];
                                $query3 = mysqli_query($conn, "select * from instructor where departmentid ='$departments'");
                                while ($row3 = mysqli_fetch_array($query3)) {
                                    $full = $row3['firstname'] . '   ' . $row3['lastname'];
                                    $instructorid = $row3['instructorid'];
                                    echo '<tr>';
                                    echo '<td>' . $full . '</td><td>' . $row3['status'] . '</td>';
                                    $select = mysqli_query($conn, "select DISTINCT section from courseinstructor where instructorid='$instructorid'");

                                    if (mysqli_num_rows($select) >= 1) {
                                        echo '<td>';
                                        while ($row4 = mysqli_fetch_array($select)) {
                                            $section = $row4['section'];
                                            echo'<span class="badge">' . $section . '</span>';
                                        }echo'</td>';
                                        echo'<td> <i class="fa fa-1x fa-check-square text-warning"></i></td>';
                                        echo '<td><a href=assigninstructor.php?id=' . $department . '&ins=' . $instructorid . '>
                                            <i class="fa fa-1x fa-eye text-danger" aria-hidden="true"></i></a>
                                            </td>';
                                    } else if (mysqli_num_rows($select) <= 1) {
                                        echo '<td>';
                                        echo '</td>';
                                        echo'<td></td>';
                                    }
                                    echo'</tr>';
                                }
                                ?> 
                            </table>
                            <?php
                            if (isset($_GET['ins'])) {
                                $ins = $_GET['ins'];
                                $dept = $_GET['id'];
                                ?>
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="danger">
                                            <th>Course_Name</th>
                                            <th>Credit_Hour</th>
                                            <th>Section</th>
                                        </tr></thead>
                                    <?php
                                    $query6 = mysqli_query($conn, "select * from courseinstructor where instructorid='$ins'");
                                    while ($row5 = mysqli_fetch_array($query6)) {
                                        $coursecodeins = $row5['coursecode'];
                                        $section1 = $row5['section'];
                                        $selectcourse = mysqli_query($conn, "select * from course where coursecode='$coursecodeins' AND departmentid='$dept'");
                                        $row7 = mysqli_fetch_array($selectcourse);
                                        echo '<tr class="info">';
                                        echo '<td>' . $row7['coursename'] . '</td><td>' . $row7['credithour'] . '</td><td>' . $section1 . '</td>';

                                        echo'</tr>';
                                    }
                                }
                                ?>
                            </table>

                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6"> 
                    <div class="card border-info">
                        <div class="card-header bg-info">Assign Instructor to Course</div>
                        <div class="card-body">
                            <form name="assign"action="assigninstructor.php"method="POST" onSubmit="return assign1();">
                                    <?php
                                    include("../learn/database.php");
                                    $sql = "select * from departmenthead where departmentheadid='$userid'";
                                    $result2 = mysqli_query($conn, $sql);
                                    $cols = mysqli_fetch_array($result2);
                                    $departmenthead = $cols['departmentid'];
                                    $sql1 = "select * from instructor where departmentid='$departmenthead'";
                                    $result1 = mysqli_query($conn, $sql1);
                                    echo'<div class="form-group">';
                                    echo'<label class="control-label">
                                        Instructor Name: </label>';
                                    echo'<div class="">';
                                    echo'<select  name="instructorname" class="form-control">';
                                    echo'<option selected>..select..</option>';

                                    while ($row1 = mysqli_fetch_array($result1)) {
                                        $instructorid = $row1['instructorid'];
                                        $instructorname = $row1['firstname'] . '  ' . $row1['lastname'];
                                        ?>       

                                        <option value="<?php echo $instructorid; ?>"><?php echo $instructorname; ?></option>;

                                        <?php
                                    }
                                    echo'</select>';
                                    echo'</div>';
                                    echo'<div class="">';
                                    echo'<p id="instructorid"></p></div>';
                                    echo'</div>'; 
                                    ?>
                                    <?php
                                    include("../learn/database.php");
                                    $sql3 = "select * from departmenthead where departmentheadid='$userid'";
                                    $r2 = mysqli_query($conn, $sql3);
                                    $col = mysqli_fetch_array($r2);
                                    $departmentheadco = $col['departmentid'];
                                    $sql4 = "select * from course where departmentid='$departmentheadco'";
                                    $re3 = mysqli_query($conn, $sql4);
                                    echo ' <div class="form-group">';
                                    echo '<label class="control-label">Course Name: </label>';
                                    echo'<div class="">';
                                    echo '<select name="coursecode" class="form-control">';
                                    echo '<option selected>..select..</option>';
                                    while ($row2 = mysqli_fetch_array($re3)) {
                                        $coursecode = $row2['coursecode'];
                                        $coursename = $row2['coursename'];
                                        $credithour = $row2['credithour'];
                                        $year = $row2['year'];
                                        $semister = $row2['semister'];
                                        ?>
                                        <option value="<?php echo $coursecode; ?>"> <?php echo $coursename; ?></option>;
                                        <?php
                                    }
                                    echo '</select>';
                                    echo '</div>';
                                    echo '<div class="col=sm-4">';
                                    echo '<p id="coursecode1"></p>';
                                    echo '</div>';
                                    echo '</div>'; 
                                    ?> 
                                <div class="form-group">
                                    <label class="control-label" class="form-control">Section:</label> 
                                    <input class="form-control number-only" type="text" name="section1"/>
                                    <p id="section1"></p> 
                                </div> 
                                <div class="form-group float-right">    
                                    <button type="submit" class="btn btn-primary"  name="assign"onchange="onclick assign1();">
                                        <i class="fa fa-1x fa-arrow-up"></i> Assign
                                    </button>
                                    <button type="reset" class="btn btn-danger" value="cancel" name="cancel">Cancel</button>
                                </div> 
                            </form>
                            <?php
                            $total = '';
                            $bbctrue = '';
                            include("../learn/database.php");
                            if (isset($_POST['assign'])) {
                                $coursecode1 = $_POST['coursecode'];
                                $instructorid1 = $_POST['instructorname'];
                                $section1 = $_POST['section1'];
                                
                                $bbc = '';
                                if (empty($section1)) {
                                    echo 'PLEASE FILL THE SECTION FOR THESE INSTRUCTOR';
                                } else {
                                    if ($section1 == 0) {
                                        echo '<font color="red">The Section is not Zero value section please fill the section??</font>';
                                    } else {
                                        $capacity = mysqli_query($conn, "select * from ca");
                                        $rowca = mysqli_fetch_array($capacity);
                                        $small = $rowca['instructor_capacity_bsc'];
                                        $middle = $rowca['instructor_capacity_msc'];
                                        $large = $rowca['instructor_capacity_phd'];
                                        $select1 = mysqli_query($conn, "select DISTINCT status from instructor where instructorid='$instructorid1'");
                                        $rowins = mysqli_fetch_array($select1);
                                        $status = $rowins['status'];
                                        $select2 = mysqli_query($conn, "select DISTINCT credithour from course where coursecode ='$coursecode1'");
                                        $rowcode = mysqli_fetch_array($select2);
                                        $credithourcode = $rowcode['credithour'];
                                        $select4 = mysqli_query($conn, "select * from courseinstructor where instructorid='$instructorid1'");
                                        if (mysqli_num_rows($select4) > 1) {
                                            while ($row6 = mysqli_fetch_array($select4)) {
                                                $credithourvalue = $row6['credithour'];
                                                $total = $total + $credithourvalue;
                                            }
                                            $eqlevalue = $total + $credithourcode;
                                            if ($status == 'BSC' && $eqlevalue <= $small) {
                                                if (empty($section1))
                                                    

                                                    $select3 = mysqli_query($conn, "select * from courseinstructor where coursecode='$coursecode1' AND section='$section1'");
                                                    if (mysqli_num_rows($select3) >= 1) {
                                                        $bbc = 'the course is assign to other these section ';
                                                    } else {
                                                        $insert1 = mysqli_query($conn, "insert into courseinstructor values('','$coursecode1','$instructorid1','$section1','$credithourcode')");
                                                        if ($insert1) {
                                                            $bbctrue = 'The Instructor Is Successfully Assign to The Course:';
                                                        } else {

                                                            echo mysqli_error();
                                                        }
                                                    }
                                                //else   
                                            } elseif ($status == 'MSC' && $eqlevalue <= $middle) {
                                                if (empty($section1))
                                        
                                                
                                                    $select3 = mysqli_query($conn, "select * from courseinstructor where coursecode='$coursecode1' AND section='$section1'");
                                                    if (mysqli_num_rows($select3) >= 1) {
                                                        $bbc = 'the course is assign to other these section ';
                                                    } else {



                                                        $insert1 = mysqli_query($conn, "insert into courseinstructor values('','$coursecode1','$instructorid1','$section1','$credithourcode')");
                                                        if ($insert1) {
                                                            $bbctrue = 'The Instructor Is Successfully Assign to The Course:';
                                                        } else {

                                                            echo mysqli_error();
                                                        }
                                                    }
                                                //else
                                            } elseif ($status == 'PHD' && $eqlevalue <= $large) {
                                                if (empty($section1))
                                                
                                                    $select3 = mysqli_query($conn, "select * from courseinstructor where coursecode='$coursecode1' AND section='$section1'");
                                                    if (mysqli_num_rows($select3) >= 1) {
                                                        $bbc = 'the course is assign to other these section ';
                                                    } else {



                                                        $insert1 = mysqli_query($conn, "insert into courseinstructor values('','$coursecode1','$instructorid1','$section1','$credithourcode')");
                                                        if ($insert1) {
                                                            $bbctrue = 'The Instructor Is Successfully Assign to The Course:';
                                                        } else {

                                                            echo mysqli_error();
                                                        }
                                                    }
                                                //else
                                            } else {

                                                echo 'THE CREDIT HOUR IS HIGH FOR THESE INSTRUCTOR';
                                            }
                                        } else if (mysqli_num_rows($select4) < 1) {
                                            if (empty($section1))
                                                
                                            
                                                $select3 = mysqli_query($conn, "select * from courseinstructor where coursecode='$coursecode1' AND section='$section1'");
                                                // if (mysqli_num_rows($select3) >= 1) {
                                                    // $bbc = 'the course is assign to other these section ';
                                                //}
                                                else {



                                                    $insert1 = mysqli_query($conn, "insert into courseinstructor values('','$coursecode1','$instructorid1','$section1','$credithourcode')");
                                                    if ($insert1) {
                                                        $bbctrue = 'The Instructor Is Successfully Assign to The Course:';
                                                    } else {

                                                        echo mysqli_error();
                                                    }
                                                }
                                            //else 
                                        }
                                        if ($bbc == 'the course is assign to other these section ') {
                                            echo $bbc;
                                        }
                                        if ($bbctrue == 'The Instructor Is Successfully Assign to The Course:') {
                                            echo $bbctrue;
                                        }
                                    }
                                }
                            } //for loop
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </body>
    <?php include '../shared/footer.php'; ?>
</html>
