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
         <script src="../js/depthead.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/depthead.js" type="text/javascript"></script>
        <link href="../css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/> 
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
                        <a class="navbar-link" href="" title="This Is Upload Information To The Department Society">
                            <i class="fa fa-1x fa">Upload</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">                                   
                            <a href="../updownload/uploadnotice.php" title="This Is Upload Notice To The Department Society">Notice</a>
                        </div>
                    </li>
                    <li class="tab">
                        <a href="assigninstructor.php" title="This Is Assign Instructor To The Regiter Course List">
                            <i class="fa fa-1x fa">Assign Instructor</i>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a class="navbar-link unstyled" href="" title="profile">  
                            Profile
                            <i class="fa fa-sm fa-1x fa-chevron-down"></i>
                        </a>
                        <div class="dropdown-content dropdown-menu dropdown-menu-right">
                            <a class="navbar-link" href="changepassword2.php" title="">
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
                    <div id="feed"> 
                        <div class="card-header bg-danger">
                            Change password form
                        </div> 
                        <form class="form-horizontal" role="form" name="change2"onSubmit="return changepassword();"action="changepassword2.php"method="post">
                            <div class="form-group">
                                <label class="control-label" for="pass">Old Password:</label>
                                <div class="">
                                    <input type="password" class="form-control" name="old" placeholder="Enter the old password">
                                </div><div class=""><p id="old1"></p></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="new"> New Password:</label>
                                <div class="">          
                                    <input type="password" class="form-control" name="new" placeholder="Enter the new password ">
                                </div><div class=""><p id="new1"></p></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="new"> Confirm Password:</label>
                                <div class="">          
                                    <input type="password" class="form-control" name="confirm" placeholder="Enter the confirm password ">
                                </div><div class=""><p id="confirm1"></p></div>
                            </div>
                            <div class="form-group float-right">        
                                <div class="">
                                    <button type="submit" class="btn btn-success"name="change" value="change"onchange="onclick changepassword();">
                                        <i class="fa fa-1x fa-edit"></i> Change
                                    </button>
                                    <button type="reset" class="btn btn-warning"name="cancel" value="cancel">
                                        <i class="fa fa-1x fa-times"></i> Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                        <?php
                        include("../learn/database.php");
                        if (isset($_POST['change'])) {
                            $old = $_POST['old'];
                            $old1 = md5($old);
                            // $old1 = $old;
                            $new = $_POST['new'];
                            $new1 = md5($new);
                            $confirm = $_POST['confirm'];
                            $confirm1 = md5($confirm);
                            $select = mysqli_query($conn,"select * from user where password='$old1' AND username='$username'");
                            if (mysqli_num_rows($select) == 1) {

                                $up = "update user set password='$confirm1' where password='$old1' AND departmentheadid='$userid' AND username='$username'";
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
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </body>
</html>












