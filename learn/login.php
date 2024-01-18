<?php
session_start();
include("database.php");
$msg = '';
$de = ''; 

if (isset($_POST['login'])) {
    $username = strtolower($_POST['username']);
    $password =md5($_POST['password']);
    // $password = $_POST['password'];

    $select = mysqli_query($conn, "select * from user WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($select) > 0) {
        $row = mysqli_fetch_array($select);
        $usertype = $row['usertype'];
        $userid = $row['studentid'];
        $registerid = $row['registrarid'];
        $instructorid = $row['instructorid'];
        $departmenthead = $row['departmentheadid'];
        $adminid = $row['adminid'];
        if ($usertype == 'Registrar') {
            $reg = mysqli_query($conn, "select * from user where registrarid='$userid'");
            if (mysqli_num_rows($reg) > 0) {
                $reg1 = mysqli_fetch_array($reg);
                $status = $reg1['status'];
                if ($status == 'on') {
                    $_SESSION['username'] = $username;
                    $_SESSION['userid'] = $registerid;
                    header("Location: ../registrar/registrar.php");
                } else {

                    $de = 'The user account is deactivated??';
                }
            }
        } if ($usertype == 'Student') {
            $st = mysqli_query($conn, "select * from user where studentid='$userid'");
            if (mysqli_num_rows($st) > 0) {
                $st1 = mysqli_fetch_array($st);
                $status = $st1['status'];
                if ($status == 'on') {
                    $_SESSION['username'] = $username;
                    $_SESSION['userid'] = $userid;

                    header("Location: ../student/student.php");
                } else {

                    $de = 'The user account is deactivated??';
                }
            }
        } if ($usertype == 'Instructor') {
            $in = mysqli_query($conn, "select * from user where instructorid='$instructorid'");
            if (mysqli_num_rows($in) > 0) {
                $in1 = mysqli_fetch_array($in);
                $status = $in1['status'];
                if ($status == 'on') {
                    $_SESSION['username'] = $username;
                    $_SESSION['userid'] = $instructorid;

                    header("Location: ../instructor/instructor.php");
                } else {

                    $de = 'The user account is deactivated??';
                }
            }
        } elseif ($usertype == 'Department head') {
            $reg = mysqli_query($conn, "select * from user where departmentheadid='$departmenthead'");
            if (mysqli_num_rows($reg) > 0) {
                $reg1 = mysqli_fetch_array($reg);
                $status = $reg1['status'];
                if ($status == 'on') {
                    $_SESSION['username'] = $username;
                    $_SESSION['userid'] = $departmenthead;
                    header("Location: ../depthead/depthead.php");
                } else {

                    $de = 'The user account is deactivated??';
                }
            }
        } elseif ($usertype == 'Admin') {
            $ad = mysqli_query($conn, "select * from user where adminid='$adminid'");
            if (mysqli_num_rows($ad) > 0) {
                $ad1 = mysqli_fetch_array($ad);
                $status = $ad1['status'];
                if ($status == 'on') {
                    $_SESSION['username'] = $username;
                    $_SESSION['userid'] = $adminid;
                    header("Location: ../admin/admin.php");
                } else {

                    $de = 'The user account is deactivated??';
                }
            }
        }
    } else {
        $msg = "notmatch";
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link href="../css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>  
        <link href="../css/main.css" rel="stylesheet" type="text/css"/> 
        <script src="../js/jquery.js" type="text/javascript"></script>  
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
                        <a class="navbar-link" href="../index.php" title="">
                            <i class="fa fa-1x fa">Home</i>
                        </a>
                    </li>
                    <li class="tab">
                        <a class="navbar-link" href="about.php">
                            <i class="fa fa-1x fa">About Us</i>
                        </a>
                    </li>
                    <li class="tab">
                        <a class="navbar-link" href="contact.php">
                            <i class="fa fa-1x fa">Contact Us</i>
                        </a>
                    </li>
                    <li class="tab">
                        <a class="navbar-link" href="help.php">
                            <i class="fa fa-1x fa">Help</i>
                        </a>
                    </li>
                    <li class="tab">
                        <a class="navbar-link" href="http://www.youtube.com">
                            <i class="fa fa-1x fa">Tutorials</i>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav ml-auto">
                    <li class="tab">
                        <a class="navbar-link" href="login.php">
                            <i class="fa fa-1x fa">Login</i>
                        </a>
                    </li>
                </ul>
            </div>     
        </nav>
        <!-- body -->
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-md-3 col-sm-3"> 
                    <?php 
                        include '../shared/sidebar.php';
                    ?>
                </div>
                <div class="col-md-9 col-sm-9 " style="background-color: rgb(175, 32, 99);"> 
                    <br>
                    <div class="jumbotron row">
                        <div class="col-md-3 d-sm-none d-sm-block"></div>
                        <div class="col-md-6 col-sm-12 login_form content-center" style="box-shadow: 0 2px 3px;"> 
                            <form class="mx-4" role="form"action="login.php"method="post"onSubmit="return validates();"name="login1">
                                <div class="form-group">
                                    <h4><label class="control-label" for="username">Username</label></h4>
                                    <input type="text" class="form-control" placeholder="Enter username"name="username" autocomplete="off"/>  
                                </div>

                                <div class="form-group">
                                    <h4><label class="control-label" for="password">Password</label></h4>
                                    <input type="password" class="form-control"placeholder="Enter password"name="password"/> 
                                    <div class="col-sm-4"><p id="password1"></p></div>
                                </div>

                                <hr style="background-color: green; height: 2px;">
                                <div class="form-group"> 
                                    <span class="control-label" style="padding-left: 18px;"> Don't remeber my password:</span>
                                    <a class="text-danger text-right;" href="forgotpassword.php"> 
                                        forgot password
                                    </a>
                                </div>
                                <hr style="background-color: yellow; height: 2px;">
                                <?php
                                    if ($msg == 'notmatch') {
                                        echo '
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Hey user!</strong> The username and password is not match. please try again.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            <hr style="background-color: red; height: 2px;">
                                        </div>
                                        ';  
                                    }
                                    if ($de == 'The user account is deactivated??') {
                                        echo '
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>Hey user!</strong> This user account is deactivated. please contact the system admin.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            <hr style="background-color: red; height: 2px;">
                                        </div>
                                        '; 
                                    }
                                ?>                                 
                                <div class="form-group text-right">  
                                    <button type="reset" class="btn btn-danger" name="cancel">Cancel</button> 
                                    <button type="submit" class="btn btn-success" name="login" onchange="onclick validates();">Login</button>
                                </div>                                                                   
                            </form>
                        </div>
                        <div class="col-md-3 d-sm-none d-sm-block"></div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function validates() {

                var username2 = document.login1.username.value;
                var password2 = document.login1.password.value;
                if (username2 == 'null' || username2 == "") {
                    document.getElementById("username1").innerHTML = "<font color='red'>The username is not empty try again</font>";
                    document.getElementById("password1").innerHTML = "";
                    document.login1.username.focus();
                    return false;
                }
                if (password2 == 'null' || password2 == "") {
                    document.getElementById("password1").innerHTML = "<font color='red'>The password is not empty try again</font>";
                    document.getElementById("username1").innerHTML = "";
                    document.login1.password.focus();
                    return false;
                } else {
                    return true;
                }
            }
        </script>
        <?php
            include '../shared/footer.php';
        ?>
    </body> 
</html> 