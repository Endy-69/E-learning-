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
                <div class="col-md-2"></div>
                <div class="col-sm-12 col-md-8 jumbotron"> 
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 col-sm-12" style="box-shadow: 0 2px 3px;"> 
                            <br>                            
                            <h5 class="card-title text-center font-weight-bold">
                                <i class="fa fa-2x fa-key text-danger"></i><br>
                                Changing the password
                            </h5>
                            <form class="form-horizontal" role="form" name="change2"onSubmit="return changepassword();"action="changepassword.php"method="post">                                
                                <div class="form-group">
                                    <label class="control-label" for="pass">Old Password:</label> 
                                    <input type="password" class="form-control" name="old" placeholder="Enter the old password">
                                    <div><p id="old1"></p></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="new"> New Password:</label>
                                    <input type="password" class="form-control" name="new" placeholder="Enter the new password ">
                                    <div class=""><p id="new1"></p></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="new"> Confirm Password:</label>
                                    <input type="password" class="form-control" name="confirm" placeholder="Enter the confirm password ">
                                    <div><p id="confirm1"></p></div>
                                </div>
                                <div class="form-group float-right">         
                                    <button type="submit" class="btn btn-success"name="change" value="change"onchange="onclick changepassword();">Change Password</button>
                                    <button type="reset" class="btn btn-danger"name="cancel" value="cancel">Cancel</button> 
                                </div>
                            </form> 
                            <?php
                            include("../learn/database.php");
                            if (isset($_POST['change'])) {
                                $old = $_POST['old'];
                                $old1 =md5($old);
                                // $old1 = $old;
                                $new = $_POST['new'];
                                $new1 = md5($new);
                                $confirm = $_POST['confirm'];
                                $confirm1 = md5($confirm);
                                $select = mysqli_query($conn,"select * from user where password='$old1' AND username='$username'");
                                if (mysqli_num_rows($select) == 1) {

                                    $up = "update user set password='$confirm1' where password='$old1' AND username='$username' and adminid='$userid'";
                                    $upd = mysqli_query($conn,$up);
                                    if ($upd) {
                                        echo '<font color ="red">The password is successfully changes</font>';
                                    } else {
                                        echo 'not';
                                    }
                                } else {
                                    echo '<font color="red">The old password is not match try again???</font>';
                                }
                            }
                            ?>
                            <br><br><br>
                        </div>
                        <div class="col-md-2"></div>
                    </div>  
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </body>
    <?php include '../shared/footer.php'; ?>
</html>








