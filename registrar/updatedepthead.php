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
    <head> <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/jquery.min.js"></script>

        <link href="../css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/> 
        <script src="../js/register.js" type="text/javascript"></script>
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
                        <a class="navbar-link" href="registrar.php" title="This Registrar Home Page">
                            <i class="fa fa-1x fa">Home</i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href=""title="This Upload Resource Page To The Department">
                            <i class="fa fa-1x fa">Upload</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/uploadannualcalendar.php" title="This Upload Annual Calendar To The Department">Annual Calendar</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href=""title="This Registrar Information Page"><i class="fa fa-1x fa">Register</i></a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="registercourse.php" title="This Register Course For Each Department">Course</a>
                            <a href="registerdepartment.php" title="This Register Department For Each Faculity">Department</a>
                            <a href="registerinstructor.php" title="This Register Instructor For Each Department">Instructor</a>
                            <a href="registerstudent.php" title="This Register student For Each Department">Student</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href=""title="This Registrar capacity Page"><i class="fa fa-1x fa">Capacity</i></a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="coursecapacity.php" title="This Register Course For Each Department">Course Capacity</a>
                            <a href="instructorcapacity.php" title="This Register Department For Each Faculity">Inctructor Capacity</a> 
                        </div>
                    </li> 
                    <li class="tab">
                        <a class="navbar-link" href="viewresult.php" title="This View Student Result For Each Department">
                            <i class="fa fa-1x fa"> View Student Result</i>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right"> 
                    <li class="dropdown">
                        <a class="navbar-link unstyled" href="" title="profile">  
                            <?php echo  $username?>
                            <i class="fa fa-sm fa-1x fa-chevron-down"></i>
                        </a>
                        <div class="dropdown-content dropdown-menu dropdown-menu-right">
                            <a class="navbar-link" href="changepassword1.php" title="">
                                <i class="fa fa-1x fa-key text-dark">Change Password</i>
                            </a> 
                            <a class="navbar-link" href="../learn/logout.php" title="This is Leave From The Home Page Of admin"> 
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
                <div class="col-sm-12 col-md-5"> 
                        <div class="card border-info"> 
                            <div class="card-header bg-dark text-white">
                                Changing Department Head
                                <a class="text-dark font-weight-bold" data-toggle="collapse" href="#INFO" role="button" aria-expanded="false" aria-controls="INFO">
                                    <i class="float-right fa fa-2x fa-info-circle text-danger"></i>
                                </a>
                                <div class="collapse" id="INFO">
                                    <div class="card card-body text-danger">
                                        Click the update icon in front of the department name that you want to change its head of department
                                    </div>
                                </div>                               
                            </div>
                            <div class="card-body">                                 
                                <table class="table table-responsive table-striped">
                                    <thead>
                                        <tr class="info">
                                            <th>Dep'thead_Name</th>
                                            <th>Sex</th>
                                            <th>Department_Name</th>
                                            <th>Update</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    include '../learn/database.php';
                                    $query = mysqli_query($conn,"select * from departmenthead");
                                    while ($row3 = mysqli_fetch_array($query)) {
                                        $full = $row3['firstname'] . '   ' . $row3['middlename'] . '   ' . $row3['lastname'];
                                        $sex = $row3['sex'];
                                        $dept = $row3['departmentid'];
                                        $departmentheadid = $row3['departmentheadid'];

                                        $select = mysqli_query($conn,"select * from department where departmentid='$dept'");
                                        $row = mysqli_fetch_array($select);
                                        $department = $row['departmentname'];
                                        echo '<tr>';
                                        echo '<td>' . $full . '</td><td>' . $sex . '</td><td>' . $department . '</td>';
                                        echo '<td>
                                                <a href=updatedepthead.php?update=' . $departmentheadid . '>
                                                <i class = "fa fa-1x fa-edit text-primary"></i></a>
                                            </td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </table>
                            </div>
                        </div> 
                </div>
                <div class="col-sm-12 col-md-7">  
                    <div class="card border-danger">
                        <?php
                        if (isset($_GET['update'])) {
                            $dhid = $_GET['update'];
                            $msg = mysqli_query($conn,"select * from departmenthead where departmentheadid='$dhid'");
                            $row2 = mysqli_fetch_array($msg);
                            $firstname = $row2['firstname'];
                            $middlename = $row2['middlename'];
                            $lastname = $row2['lastname'];
                            $email = $row2['email'];
                            $departmentid = $row2['departmentid'];
                            $select1 = mysqli_query($conn,"select * from department where departmentid='$departmentid'");
                            $row1 = mysqli_fetch_array($select1);
                            $departmentname = $row1['departmentname'];
                        ?>
                        <div class="card-header bg-dark text-white">
                            Change the department head of <font color="red"><?php echo ucfirst($departmentname).''; ?></font> 
                            department <br>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" role="form" method="post" action="" name="assign" onSubmit="return assign1();">
                                <input type="hidden" name="dept" value="<?php echo $dhid; ?>">
                                <div class="form-group">
                                    <label class="control-label " for="fn">First_Name:</label>
                                    <div class="">
                                        <input type="text" class="form-control" name="firstname" value="<?php echo $firstname; ?>">
                                    </div>
                                    <div class=""> <p id="firstname1"></p></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label " for="ln">Middle_Name:</label>
                                    <div class=""> 
                                        <input type="text" class="form-control" name="middlename" value="<?php echo $middlename; ?>">
                                    </div>
                                    <div class=""> <p id="middlename1"></p></div>
                                </div><div class="form-group">
                                    <label class="control-label " for="ln">Last_Name:</label>
                                    <div class=""> 
                                        <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>">
                                    </div>
                                    <div class=""> <p id="lastname1"></p></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label " for="em">Email:</label>
                                    <div class=""> 
                                        <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                                    </div>
                                    <div class=""> <p id="email1"></p></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label " for="sex">Sex:</label>
                                    <div class="">
                                        <label class="radio-inline">
                                            <input type="radio" name="radio1" value="M" checked="male"/>Male
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="radio1" value="F"/>Female
                                        </label>  

                                    </div><div class="col-sm-4"><p id="sex1"></p>
                                    </div></div>
                                <div class="form-group float-right">  
                                    <button type="submit" class="btn btn-success" name="update" onclick="return assign1();">Update</button>
                                    <button type="reset" class="btn btn-danger" >Cancel</button>
                                </div> 
                            </form>
                            <?php
                                include '../learn/database.php';
                                if (isset($_POST['update'])) {
                                    $firstname1 = strtolower($_POST['firstname']);
                                    $middlename1 = strtolower($_POST['middlename']);
                                    $lastname1 = strtolower($_POST['lastname']);
                                    $email1 = strtolower($_POST['email']);
                                    $sex1 = $_POST['radio1'];
                                    $dept1 = $_POST['dept'];
                                    $update1 = mysqli_query($conn,"update departmenthead set firstname='$firstname1', middlename='$middlename1', lastname='$lastname1', email='$email1' , sex='$sex1' where departmentheadid='$dept1'");
                                    if (!$update1) {
                                        echo mysqli_error();
                                    } else {
                                        echo 'SUCCESSFULLY UPDATE THE DEPARTMENT HEAD';
                                    }
                                }
                            ?>
                        </div>
                    <?php }
                    ?>
                    </div> 
                </div>
            </div>
    </body>
    <?php include '../shared/footer.php'; ?>
</html>



