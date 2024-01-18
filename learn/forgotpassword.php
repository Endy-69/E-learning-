<?php
session_start();
include 'database.php';
//error_reporting(0);
$ok = '';
$error = '';
require 'email.php';
if (isset($_POST['forgot'])) {
    $email1 = $_POST['emailt'];
    $_SESSION['email'] = $email1;
    $email = $_SESSION['email'];
    $random = rand(100000, 99999999);
    $selectuser = mysqli_query($conn, "select * from user");
    while ($row = mysqli_fetch_array($selectuser)) {
        $confirmation_code_random = $row['conformation_code'];
        if ($random != $confirmation_code_random) {
            $check = mysqli_query($conn, "select * from student where email='$email'");
            $check1 = mysqli_query($conn, "select * from instructor where email='$email'");
            $check2 = mysqli_query($conn, "select * from registrar where email='$email'");
            $check3 = mysqli_query($conn, "select * from admin where email='$email'");
            $check4 = mysqli_query($conn, "select * from departmenthead where email='$email'");
            if (mysqli_num_rows($check) >= 1) {
                $row = mysqli_fetch_array($check);
                $student = $row['studentid'];
                $select = mysqli_query($conn, "select * from user where studentid='$student'");
                $row1 = mysqli_fetch_array($select);
                $_SESSION['confirm'] = $row1['conformation_code'];
                $conformation = $_SESSION['confirm'];
                mysqli_query($conn, "update user set conformation_code = '$random' where conformation_code ='$conformation'");
                $feed = 'Please copy and paste the confirmation code to reset the password';
                $mail->setFrom('eshetie674@gmail.com', 'DTU E-learning System');
                $mail->addAddress($email, 'DTU E-learning System');
                $mail->isHTML(true);
                $msg = $feed;
                $mail->Subject = 'E-learning System Password Resetting Confirmation Code ' . $random;
                $mail->Body = $msg;
                $mail->AltBody = 'Debre Tabor University';

                if (!$mail->send()) {
                    echo '';
                } else {
                    echo'<script type="text/javascript">alert("Confirm by pressing the OK button and visit your email");window:location=\'confirmation_code.php\';</script>';
                }
            } else if (mysqli_num_rows($check1) >= 1) {
                $row3 = mysqli_fetch_array($check1);
                $instructorid = $row3['instructorid'];
                $select1 = mysqli_query($conn, "select * from user where instructorid='$instructorid'");
                $row4 = mysqli_fetch_array($select1);
                $_SESSION['confirm'] = $row4['conformation_code'];
                $conformation = $_SESSION['confirm'];
                mysqli_query($conn, "update user set conformation_code = '$random' where conformation_code ='$conformation'")or die(mysqli_error());
                $feed = 'Please copy and paste the confirmation code to reset the password';
                $mail->setFrom('eshetie674@gmail.com', 'DTU E-learning System');
                $mail->addAddress($email, 'DTU E-learning System');
                $mail->isHTML(true);
                $msg = $feed;
                $mail->Subject = 'E-learning System Password Resetting Confirmation Code ' . $random;
                $mail->Body = $msg;
                $mail->AltBody = 'Debre Tabor University';

                if (!$mail->send()) {
                    echo '';
                    // $mail->ErrorInfo;
                } else {
                    echo'<script type="text/javascript">alert("Confirm by pressing the OK button and visit your email");window:location=\'confirmation_code.php\';</script>';
                }
            } else if (mysqli_num_rows($check2) >= 1) {
                $row5 = mysqli_fetch_array($check2);
                $registrarid = $row5['registrarid'];
                $select2 = mysqli_query($conn, "select * from user where registrarid='$registrarid'");
                $row6 = mysqli_fetch_array($select2);
                $_SESSION['confirm'] = $row6['conformation_code'];
                $conformation = $_SESSION['confirm'];
                mysqli_query($conn, "update user set conformation_code = '$random' where conformation_code ='$conformation'");

                $feed = 'Please copy and paste the confirmation code to reset the password';
                $mail->setFrom('eshetie674@gmail.com', 'DTU E-learning System');
                $mail->addAddress($email, 'DTU E-learning System');
                $mail->isHTML(true);
                $msg = $feed;
                $mail->Subject = 'E-learning System Password Resetting Confirmation Code ' . $random;
                $mail->Body = $msg;
                $mail->AltBody = 'Debre Tabor University';

                if (!$mail->send()) {
                    echo ''; 
                    // $mail->ErrorInfo;
                } else {
                    echo'<script type="text/javascript">alert("Confirm by pressing the OK button and visit your email");window:location=\'confirmation_code.php\';</script>';
                }
            } else if (mysqli_num_rows($check3) >= 1) {
                $row7 = mysqli_fetch_array($check3);
                $admin = $row7['adminid'];
                $select3 = mysqli_query($conn, "select * from user where adminid='$admin'");
                $row8 = mysqli_fetch_array($select3);
                $_SESSION['confirm'] = $row8['conformation_code'];
                $conformation = $_SESSION['confirm'];
                mysqli_query($conn, "update user set conformation_code = '$random' where conformation_code ='$conformation'");

                $feed = 'Please copy and paste the confirmation code to reset the password';
                $mail->setFrom('eshetie674@gmail.com', 'DTU E-learning System');
                $mail->addAddress($email, 'DTU E-learning System');
                $mail->isHTML(true);
                $msg = $feed;
                $mail->Subject = 'E-learning System Password Resetting Confirmation Code ' . $random;
                $mail->Body = $msg;
                $mail->AltBody = 'Debre Tabor University';

                if (!$mail->send()) {
                    echo ''; 
                    // $mail->ErrorInfo;
                } else {
                    echo'<script type="text/javascript">alert("Confirm by pressing the OK button and visit your email");window:location=\'confirmation_code.php\';</script>';
                }
            } else if (mysqli_num_rows($check4) >= 1) {
                $row9 = mysqli_fetch_array($check4);
                $departmenthead = $row9['departmentheadid'];
                $select4 = mysqli_query($conn, "select * from user where departmentheadid='$departmenthead'");
                $row10 = mysqli_fetch_array($select4);
                $_SESSION['confirm'] = $row10['conformation_code'];
                $conformation = $_SESSION['confirm'];
                mysqli_query($conn, "update user set conformation_code = '$random' where conformation_code ='$conformation'");

                $feed = 'Please copy and paste the confirmation code to reset the password';
                $mail->setFrom('eshetie674@gmail.com', 'DTU E-learning System');
                $mail->addAddress($email, 'DTU E-learning System');
                $mail->isHTML(true);
                $msg = $feed;
                $mail->Subject = 'E-learning System Password Resetting Confirmation Code ' . $random;
                $mail->Body = $msg;
                $mail->AltBody = 'Debre Tabor University';

                if (!$mail->send()) {
                    echo '';
                    // $mail->ErrorInfo;
                } else {
                    echo'<script type="text/javascript">alert("Confirm by pressing the OK button and visit your email");window:location=\'confirmation_code.php\';</script>';
                }
            } else {
                $ok = 'OK';
            }
        }
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/jquery.min.js"></script>

        <link href="../css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap.min1.css" rel="stylesheet" type="text/css"/>
        <script src="../js/bootstrap.min1.js" type="text/javascript"></script> 
        <script src="../js/register.js" type="text/javascript"></script>
        <link href="../student/userbar.css" rel="stylesheet" type="text/css"/>
        <link href="../css/main.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript">
            function passwordreset1() {
                var email2 = document.passwordreset.emailt.value;
                var validate = /^\w+([\.-]?\ w+)*@\w+([\.-]?\ w+)*(\.\w{2,3})+$/;
                if (email2 == '' || email2 == 'null') {
                    document.getElementById('email1').innerHTML = '<font color="red">Please fill the email address';
                    document.passwordreset.emailt.focus();
                    return false;
                } else if (!validate.test(email2)) {
                    document.getElementById('email1').innerHTML = '<font color="red">Please fill the email address';
                    document.passwordrest.emailt.focus();
                    return false;
                } else {
                    return true;
                }
            }
        </script>  
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
                        <a class="navbar-link" href="../index.php">
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
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="tab">
                        <a class="navbar-link" href="login.php">
                            <i class="fa fa-1x fa-sign-in">Login</i>
                        </a>
                    </li> 
                </ul>
            </div>   
        </nav>
       
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <?php include '../shared/sidebar.php'; ?>
                </div>
                <div class="col-sm-12 col-md-8"> 
                    <br>
                    <div id="feed" class="jumbotron"> 
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <div class="" style="box-shadow: 0 2px 3px;">
                                    <div class="card-header text-center font-weight-bold">
                                        <i class="fa fa-2x fa-refresh text-danger"></i><br>
                                        Password Reset
                                    </div>
                                    <div class="card-body">
                                        <form class="form-horizontal" role="form" name="passwordreset" onsubmit="return passwordreset1();" method="post"action="" >
                                            <div class="form-group">
                                                <label class="control-label" for="email">Email:</label> 
                                                <input type="text" class="form-control" name="emailt" placeholder="Please Enter the email address"> 
                                                <p id="email1"></p> 
                                            </div>

                                            <div class="form-group float-right"> 
                                                <button type="submit" class="btn btn-danger" name="forgot" value="forgot" onchange="onclick passwordreset1();">
                                                    <i class="fa fa-1x fa-send"></i> Submit
                                                </button>
                                            </div> 
                                            <br><br>
                                        </form>
                                        <?php
                                        if ($ok == 'OK') {
                                            echo 'OK please contact the system the enter email address is not exist??';
                                        }
                                        if ($error == 'Please enter the e-mail address') {
                                            echo $error;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </body>
    <?php include '../shared/footer.php'; ?>
</html>


