
<?php
session_start();
include 'database.php';
$conformation = $_SESSION['confirm'];
$ok = '';
$error = '';
if (isset($_POST['reset'])) {
    $new = md5($_POST['new_password']);
    $confirm1 = $_POST['confirm_password'];
    $update = mysqli_query($conn, "update user set password ='$new' where conformation_code='$conformation'");
    if ($update) {
        $ok = 'The Password Is Successfully Reset';
    } else {

        echo mysqli_error;
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
        <script src="../js/register.js" type="text/javascript"></script>
        <script type="text/javascript">
            function reset1() {
                // var pass = document.forgot.new_password.value;
                // var confirm = document.forgot.confirm_password.value;
                // var minLength = '8';
                // var maxLength = '32';
                // if (pass == 'null' || pass == '') {
                //     document.getElementById('new').innerHTML = '<font color="red">Please fill the new password??</font>';
                //     document.getElementById('confirm').innerHTML = '';
                //     document.forgot.new_password.focus();
                //     return false;
                // } else if (pass.length <= minLength || pass.length >= maxLength) {
                //     document.getElementById('new').innerHTML = '<font color="red">The password length must be  ' + minLength + 'and' + maxLength + ' characters please try again??</font>';
                //     document.getElementById('confirm').innerHTML = '';

                //     document.forgot.new_password.focus();
                //     return false;
                // } else if (pass != confirm) {
                //     document.getElementById('confirm').innerHTML = '<font color="red">The password is not match try again???</font>';
                //     document.getElementById('new').innerHTML = '';

                //     document.forgot.confirm_password.focus();
                //     return false;
                // } else {
                //     return true;
                // }
            }
        </script>
        <link href="../student/userbar.css" rel="stylesheet" type="text/css"/>
        <link href="../css/main.css" rel="stylesheet" type="text/css"/>
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
                <div class="col-sm-12 col-md-3">
                    <?php include '../shared/sidebar.php'; ?>
                </div>
                <div class="col-sm-12 col-md-9">
                    <div id="feed" class="jumbotron"> 
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-7">
                                <div class="" style="box-shadow: 0 2px 3px;">
                                    <div class="card-header text-center font-weight-bold">
                                        <i class="fa fa-2x fa-refresh text-primary"></i><br>
                                        Password Resetting
                                    </div>
                                    <div class="card-body">
                                        <form class="form-horizontal" role="form" name="forgot" method="post" action="" onsubmit="return reset1();">
                                            <div class="form-group">
                                                <label class="control-label" for="email">New Password:</label>
                                                <input type="password" class="form-control" name="new_password" placeholder="Please Enter the new password">
                                                <div><p id="new"></p></div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="pwd">Confirm_Password:</label>
                                                <input type="password" class="form-control" name="confirm_password" placeholder="Please Enter confirm password">
                                                <div><p id="confirm"></p></div>
                                            </div>

                                            <div class="form-group float-right">  
                                                <button type="submit" class="btn btn-success" name="reset" onchange="onclick reset1();">
                                                    <i class="fa fa-1x fa-refresh"></i> Change Password
                                                </button>
                                            </div> 
                                            <br><br>
                                        </form>
                                        <?php
                                        if ($ok == 'The Password Is Successfully Reset') {
                                            echo $ok . ' to be Login click here:   <a href = "login.php"><i  class = "fa fa-1x fa-sign-in"></i> Login</a>';
                                        }
                                        ?>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-2">
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div> 
    </body>
    <?php include '../shared/footer.php'; ?>
</html>






