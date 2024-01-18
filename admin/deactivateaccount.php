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
            <div class="row"> 
                <div class="col-md-12 col-sm-12"> 
                    <?php
                        error_reporting(0);
                        include '../learn/database.php';
                        $statusf = 'on';
                        $usertype1 = 'Admin';
                        $usertype = 'Student';
                        $select = mysqli_query($conn,"select * from user where status='$statusf' AND usertype!='$usertype1' AND usertype!='$usertype' ORDER BY usertype ASC");
                        if (mysqli_num_rows($select) >= 1) {
                            ?>
                            <div class="card border-info">
                                <div class="card-header bg-info">These User Can Be Activate From The System To Deactivate Select IT</div>
                                <div class="card-body"> 
                                    <div class=" text-center">
                                        <form class="form-horizontal" role="form" method="post" action="">
                                            <table class="table table-striped">
                                                <tr class="success">
                                                    <th>User Id</th>
                                                    <th>Full_Name</th>
                                                    <th>User Name</th>
                                                    <th>User Type</th>
                                                    <th>Select</th>

                                                </tr> 
                                                <?php
                                                while ($row = mysqli_fetch_array($select)) {
                                                    $usertype = $row['usertype'];
                                                    $userid1 = $row['registrarid'];
                                                    $userid2 = $row['departmentheadid'];
                                                    $userid3 = $row['instructorid'];
                                                    $selectname = mysqli_query($conn,"select * from instructor where instructorid='$userid3'");
                                                    $fetch = mysqli_fetch_array($selectname);
                                                    $full = $fetch['firstname'] . '  ' . $fetch['middlename'] . '   ' . $fetch['lastname'];

                                                    $selectname1 = mysqli_query($conn,"select * from departmenthead where departmentheadid='$userid2'");
                                                    $fetch1 = mysqli_fetch_array($selectname1);
                                                    $full1 = $fetch1['firstname'] . '  ' . $fetch1['middlename'] . '   ' . $fetch1['lastname'];
                                                    $selectname2 = mysqli_query($conn,"select * from registrar where registrarid='$userid1'");
                                                    $fetch2 = mysqli_fetch_array($selectname2);
                                                    $full2 = $fetch2['firstname'] . '  ' . $fetch2['middlename'] . '   ' . $fetch2['lastname'];

                                                    echo '<tr>';
                                                    if ($usertype == 'Instructor') {
                                                        echo '<td>' . $userid3 . '</td>';

                                                        echo'<td>' .
                                                        $full . '</td>';
                                                    }
                                                    if ($usertype == 'Department head') {
                                                        echo '<td>' . $userid2 . '</td>';
                                                        echo'<td>' .
                                                        $full1 . '</td>';
                                                    }
                                                    if ($usertype == 'Registrar') {
                                                        echo '<td>' . $userid1 . '</td>';
                                                        echo'<td>' .
                                                        $full2 . '</td>';
                                                    }
                                                    echo'<td>' .
                                                    $row['username'] . '</td><td>' .
                                                    $row['usertype'] . '</td>';
                                                    echo'<td><input type="checkbox" value="' . $row['conformation_code'] . '" name="conformation_code[]"></td></tr>';

                                                    echo '</tr>';
                                                }
                                                ?>
                                            </table><div class="form-group"> 
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-warning" name="active">DEACTIVATE</button>
                                                </div>
                                            </div></form></div></div></div>
                            <?php
                        } else {
                            echo '<div class="alert alert-danger"><strong>Danger!</strong> THERE IS NOT ACTIVATE USER ACCOUNT FROM USERS!!!</div>';
                        }
                    ?>
                </div>
                <?php
                    if (isset($_POST['active'])) {
                        error_reporting(0);
                        $assid = $_POST['conformation_code'];
                        $statuso = 'off';
                        foreach ($assid as $assid1) {
                            $active = mysqli_query($conn,"update user set status='$statuso' where conformation_code='$assid1'");
                        }
                    }
                ?>

                <div class="col-md-12 col-sm-12">
                    <?php
                        include '../learn/database.php';
                        $off = 'on';
                        $usertype = 'Student';
                        $query = mysqli_query($conn,"select * from user where status='$off' AND usertype= '$usertype' ORDER BY studentid ASC");
                        if (mysqli_num_rows($query)) {
                            ?>  
                            <div class="card border-info">
                                <div class="card-header bg-info">Create Account Student List</div>
                                <div class="card-body"> 
                                    <div class="text-center">
                                        <form class="form-horizontal" role="form" method="post" action="">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr class="info">
                                                        <th>Student_Id</th>
                                                        <th>Full_Name</th>
                                                        <th>Department</th>
                                                        <th>Year</th>
                                                        <th>Select</th>
                                                    </tr></thead>
                                                <?php
                                                while ($row2 = mysqli_fetch_array($query)) {
                                                    $studentid = $row2['studentid'];
                                                    $select1 = mysqli_query($conn,"select * from student where studentid='$studentid' ORDER BY year DESC");
                                                    $row1 = mysqli_fetch_array($select1);
                                                    $departmentid = $row1['departmentid'];
                                                    $fullname = $row1['firstname'] . '  ' . $row1['middlename'] . '  ' . $row1['lastname'];
                                                    $select10 = mysqli_query($conn,"select * from department where departmentid='$departmentid'");
                                                    $row10 = mysqli_fetch_array($select10);
                                                    $departmentname = $row10['departmentname'];
                                                    echo '<tr>';
                                                    echo '<td>' . $studentid . '</td><td>' . $fullname . '</td><td>' . $departmentname . '</td><td>' . $row1['year'] . '</td>';
                                                    echo'<td><input type="checkbox" value="' . $studentid . '" name="studentid[]"></td></tr>';
                                                }
                                                ?>
                                            </table>
                                            <div class="form-group">  
                                                <button type="submit" class="btn btn-warning" name="submit">DEACTIVATE</button> 
                                            </div>
                                        </form>
                                    </div>
                                <?php
                                    } 
                                ?>

                                <?php
                                    include '../learn/database.php';
                                    error_reporting(0);
                                    if (isset($_POST['submit'])) {
                                        $useridactivate = $_POST['studentid'];
                                        $statuson = 'off';
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



