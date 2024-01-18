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
        <link href="../left/bootstrap.min1.css" rel="stylesheet" type="text/css"/>
        <script src="../left/bootstrap.min1.js" type="text/javascript"></script>
        <link href="../left/custom1.css" rel="stylesheet" type="text/css"/>
        <script src="../left/jquery.min1.js" type="text/javascript"></script>
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
                        <a class="navbar-link" href="admin.php" title="This admin Home Page">
                            <i class="fa fa-1x fa">Home</i>
                        </a>
                    </li>
                    <li class="tab">
                        <a class="navbar-link" href="activateaccount.php" >
                            <i class="fa fa-1x fa"> Activate Account</i>
                        </a>
                    </li>
                    <li class="tab">
                        <a class="navbar-link" href="create.php" >
                            <i class="fa fa-1x fa"> Create Account</i>
                        </a>
                    </li>
                    <li class="tab">
                        <a class="navbar-link" href="deactivateaccount.php" >
                            <i class="fa fa-1x fa"> Deactivate Account</i>
                        </a>
                    </li> 
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="profile"> 
                            <?php echo  $username?>
                            <i class="fa fa-sm fa-1x fa-chevron-down"></i>
                        </a>
                        <div class="dropdown-content dropdown-menu dropdown-menu-right">
                            <a class="navbar-link" href="changepassword.php" title="">
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
            <div class="card-header">
                <h5 class="card-title text-danger">Accounts that needs to be activated</h5>
            </div>

            <div class="row">
                <?php
                    include '../learn/database.php';
                    $statuson = 'on';
                    $selectregister = mysqli_query($conn,"select * from user where usertype='Registrar' AND status='$statuson'");
                    $totalregister = mysqli_num_rows($selectregister);
                    echo '';
                    $selectdepthead = mysqli_query($conn,"select * from user where usertype='Department head' AND status='$statuson'");
                    $totaldepthead = mysqli_num_rows($selectdepthead);
                    echo '';
                    $selectinstructor = mysqli_query($conn,"select * from user where usertype='Instructor' AND status='$statuson'");
                    $totalinstructor = mysqli_num_rows($selectinstructor);
                    echo '';
                    $selectstudent = mysqli_query($conn,"select * from user where usertype='Student' AND status = '$statuson'");
                    $totalstudents = mysqli_num_rows($selectstudent);
                    echo '';
                ?>
                <div class="col-md-3 col-sm-12">
                    <div class="card border-danger">
                        <div class="card-header bg-success">
                            <h5 class="card-title">No_Registrar</h5>
                        </div>
                        <div class="card-body"><span class="badge"><?php echo $totalregister; ?></span></div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="card border-danger">
                        <div class="card-header bg-warning">
                            <h5 class="card-title">No_Department_Head</h5>
                        </div>
                        <div class="card-body"><span class="badge"><?php echo $totaldepthead; ?></span></div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="card border-danger">
                        <div class="card-header bg-danger">
                            <h5 class="card-title">No_Instructor</h5>
                        </div>
                        <div class="card-body"><span class="badge"><?php echo $totalinstructor; ?></span></div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="card border-danger">
                        <div class="card-header bg-info">
                            <h5 class="card-title">No_Student</h5>
                        </div>
                        <div class="card-body"><span class="badge"><?php echo $totalstudents; ?></span></div>
                    </div>
                </div>
            </div>
            <!-- details -->
            <br><br>
            <div class="row">  
                <?php
                include '../learn/database.php';
                $statusf = 'off';
                $usertype1 = 'Admin';
                $usertype = 'Student';
                $select = mysqli_query($conn,"select * from user where status='$statusf' AND usertype!='$usertype1' AND usertype!='$usertype'");
                if (mysqli_num_rows($select) >= 1) {
                    ?>
                    <div class="col-md-12 col-sm-12  border-info">
                        <div class="card-header bg-info">Select The Deactivate User Account to Activate IT</div>
                            <div class="card-body"> 
                                <div class="text-center">
                                    <form class="form-horizontal" role="form" method="post" action="">
                                        <table class="table table-striped">
                                            <tr class="success">
                                                <th>User Id</th>
                                                <th>User Name</th>
                                                <th>User Type</th>
                                                <th>Select</th>
                                            </tr> 
                                            <?php
                                                while ($row = mysqli_fetch_array($select)) {
                                                    $usertype = $row['usertype'];
                                                    echo '<tr>';
                                                    if ($usertype == 'Registrar') {
                                                        echo '<td>' . $row['registrarid'] . '</td>';
                                                    } else if ($usertype == 'Instructor') {
                                                        echo '<td>' . $row['instructorid'] . '</td>';
                                                    } else if ($usertype == 'Department head') {
                                                        echo '<td>' . $row['departmentheadid'] . '</td>';
                                                    }
                                                    echo'<td>' .
                                                    $row['username'] . '</td><td>' .
                                                    $row['usertype'] . '</td>';
                                                    echo'<td><input type="checkbox" value="' . $row['conformation_code'] . '" name="conformation_code[]"></td>';
                                                    echo '</tr>';
                                                }
                                            ?>
                                        </table>

                                        <div class="form-group">  
                                            <button type="submit" class="btn btn-success" name="active">ACTIVATE</button> 
                                        </div>
                                    </form>
                                </div>  
                            <?php
                                } else {
                                    echo '<div class="alert alert-danger"><strong>Info!</strong> THERE IS NOT DEACTIVATE USER ACCOUNT FROM USERS!!!</div>';
                                }
                            ?> 
                            <?php
                                if (isset($_POST['active'])) {
                                    $assid = $_POST['conformation_code'];
                                    $statuso = 'on';
                                    foreach ($assid as $assid1) {
                                        $active = mysqli_query($conn,"update user set status='$statuso' where conformation_code='$assid1'");
                                    }
                                }
                            ?>

                        <?php
                            include '../learn/database.php';
                            $off = 'off';
                            $usertype = 'Student';
                            $query = mysqli_query($conn,"select * from user where status='$off' AND usertype= '$usertype'");
                            if (mysqli_num_rows($query)) {
                                ?>  
                                <div class="col-md-12 col-sm-12 t">
                                    <div class="card-header">CREATE ACCOUNT STUDENT LIST </div>
                                        <div class="card-body"> 
                                            <div class="text-center">
                                                <form class="form-horizontal" role="form" method="post" action="">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr class="info"><th>Department</th>
                                                                <th>Student_Id</th>
                                                                <th>Year</th>
                                                                <th>Select</th>
                                                            </tr>
                                                        </thead>
                                                        <?php                                                            
                                                            while ($row2 = mysqli_fetch_array($query)) {                                                               
                                                                $studentid = $row2['studentid'];
                                                                $select1 = mysqli_query($conn,"select * from student where studentid='$studentid' ORDER BY year DESC");
                                                                $row1 = mysqli_fetch_array($select1);
                                                                $departmentid = $row1['departmentid'];
                                                                $select10 = mysqli_query($conn,"select * from department where departmentid='$departmentid'");
                                                                $row10 = mysqli_fetch_array($select10);
                                                                $departmentname = $row10['departmentname'];
                                                                echo '<tr>'; 
                                                                echo '<td>' . $departmentname . '</td><td>' . $studentid . '</td><td>' . $row1['year'] . '</td>';
                                                                echo '<td><input type="checkbox" value="' . $studentid . '" name="studentid[]"></td></tr>';
                                                            }
                                                        ?>
                                                    </table>
                                                    <div class="form-group"> 
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" class="btn btn-success" name="submit">ACTIVATE</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                    <?php } ?>
                                    <?php
                                        include '../learn/database.php';
                                        if (isset($_POST['submit'])) {
                                            $useridactivate = $_POST['studentid'];
                                            $statuson = 'on';
                                            foreach ($useridactivate as $useridactivate1) {
                                                $update = mysqli_query($conn,"update user set status='$statuson' where studentid='$useridactivate1'");
                                                if (!$update) {
                                                    echo mysqli_error();
                                                }
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
    <?php include '../shared/footer.php'; ?>
</html>






