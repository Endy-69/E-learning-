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
        <meta charset="UTF-8">
        <title></title>
     <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/jquery.min.js"></script>

        <link href="../css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="../left/bootstrap.min1.css" rel="stylesheet" type="text/css"/>
        <script src="../left/bootstrap.min1.js" type="text/javascript"></script>
        <link href="../left/custom1.css" rel="stylesheet" type="text/css"/>
        <script src="../left/jquery.min1.js" type="text/javascript"></script>
        <script src="../js/student.js" type="text/javascript"></script>
        <link href="../css/main.css" rel="stylesheet" type="text/css"/>
        <style>
             .main{
                background-color: white;
            }
            #nav{
                background-color: rgb(137, 21, 65);
                color: white;
                font-family: monospace;
                font-size: large;
            }
            .fa {
                color: white;
            }
            .tab {
                position: relative;
                display: inline-block;
                padding: 10px 15px 10px 15px;                
            }
            .dropdown {
                position: relative;
                display: inline-block;
                padding: 10px 15px 10px 15px;
               
            }
            .dropdown-content {
                display: none;
                position: absolute;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            }
            .dropdown-content a {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
            } 
            #button:hover {
                background-color: #f2f2f2;
            }

            .dropdown-content a:hover {
                background-color: #80dfff;
            }

            .dropdown-content a:active {
                background-color: #FF0084;
            }
            .dropdown:hover .dropdown-content {
                display: block;
                background-color: #ffffff;
            }
            .icon-bar{
                background-color: black;
            }
            #image{
                width: 100%;
                height: 100px;
            }
        </style>
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
                        <a class="navbar-link" href="student.php"  title="This Is Home page Of Student">
                            <i class="fa fa-1x fa">Home</i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This Is Upload Resource To The Instructor">
                            <i class="fa fa-1x fa">Upload</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/uploadassignmentanswer.php" title="This Is Upload Assignment Question"> Assignment Answer</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This Is Download Resource Material">
                            <i class="fa fa-1x fa">Download</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/downloadassignmentquestion.php" title="This Is Download Assignment Questions">Assignment Question</a>
                            <a href="../updownload/downloadcoursematerial.php" title="This Is Download Course_Material"> Course Materialt</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This Is View Resource Page">
                            <i class="fa fa-1x fa">View</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/viewnoticest.php" title="This Is View Notice Page From Department"> Notice</a>
                            <a href="viewcourseresult.php" title="This Is View Course Result ">Course result</a>
                        </div>
                    </li>  
                    <li class="tab">
                        <a class="navbar-link" href="takeexam.php" title="This Is Online Exam Page"> 
                            <i class="fa fa-1x fa">Take Exam</i>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right" style="font-family: cursive;"> 
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="profile">
                            <i class="fa fa-1x fa-user"> Profile</i>
                            <i class="fa fa-sm fa-1x fa-chevron-down"></i>
                        </a>
                        <div class="dropdown-content dropdown-menu dropdown-menu-right"> 
                            <a href="../learn/logout.php" title="This Is Leave From Student Page"> 
                                <i class="fa fa-1x fa-sign-out text-dark">Logout</i>
                            </a>                            
                        </div>
                    </li> 
                </ul>
            </div> 
        </nav>
        <!-- body -->
        <div class="jumbotron">
            <div class="row"> 
                <div class="col-md-4">
                    <?php include '../shared/sidebar.php'; ?>
                </div>

                <div class="col-sm-9 col-sm-offset-3 col-md-6 col-md-offset-2"> 
                    <div class="card">
                        <div class="card-header bg-info">
                            <h4 class="card-title">Change the password for student</h4> 
                        </div>
                        <div class="card-body"> 
                            <div class="container-fluid">
                                <form class="form-horizontal" role="form" name="change2"onSubmit="return changepassword();"action="changepasswordstudent.php"method="post">
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
                                    <div class="form-group">        
                                        <button type="submit" class="btn btn-success" name="change" value="change"onchange="onclick changepassword();">
                                            Change Password
                                        </button>
                                        <button type="reset" class="btn btn-warning"name="cancel" value="cancel">Cancel</button>
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
                                        $select = mysqli_query($conn, "select * from user where password='$old1' AND username='$username'");
                                        if (mysqli_num_rows($select) == 1) {

                                            $up = "update user set password='$confirm1' where password='$old1' AND username='$username' AND studentid='$userid'";
                                            $upd = mysqli_query($conn, $up);
                                            if ($upd) {
                                                echo '<font color ="red">The password is successfully changed</font>';
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
                    </div>
                </div>
            </div>  
        </div> 
    </body>
    <?php include '../shared/footer.php'; ?>
</html>










