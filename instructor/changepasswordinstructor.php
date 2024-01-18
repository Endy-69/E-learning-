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
        <script src="../js/depthead.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/innstructor.js" type="text/javascript"></script>
        <link href="../css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/> 
        <link href="../css/main.css" rel="stylesheet" type="text/css"/>
        <link href="../student/userbar.css" rel="stylesheet" type="text/css"/> 

    </head>
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
                        <a class="navbar-link" href="instructor.php" title="This is Home Page Of Instructor">
                            <i class="fa fa-1x fa">Home</i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This is Upload Resource To The Student"> <i class="fa fa-1x fa">Upload</i></a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/uploadcoursematerial.php" title="This is upload Resource Material To The Department Student"> Course Material</a>
                            <a href="../updownload/uploadassignmentquestion.php"title="This is Assignment Question To The Student">Assignment Question</a>
                            <a href="uploadexam.php" title="This is Evaluation Exam To The Course Student"> Exam</a>
                            <a href="uploadcourseresult.php"title="This is Upload Student Result To The Student For The Course">Course Result</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This is Download Resource Material "><i class="fa fa-1x fa"> Download</i></a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/downloadannualcalendar.php" title="This is Download The Caricullem Calendar From The Registrar Officer">Annual Calendar</a>
                            <a href="../updownload/downloadstudentlist.php" title="This is Download Student List From The Department"> Student List</a>
                            <a href="../updownload/downloadassignmentanswer.php" title="This is Download Assignment Answer Upload By The Student">Assignment Answer</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This is View Notice Page Release From The Department"> <i class="fa fa-1x fa">View</i></a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/viewnotice.php"> Notice</a>
                        </div>
                    </li>  
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="tab">
                        <a class="navbar-link" href="../learn/logout.php" title="This is Leave From The Home Page Of Instructor"> 
                            <i class="fa fa-1x fa-sign-out">Logout</i>
                        </a>
                    </li>
                </ul> 
            </div>
        </nav>        
        <div class="container-fluid">
            <div class="jumbotron row">
                <div class="col-sm-4 col-md-3">  
                    <?php include '../shared/sidebar.php'; ?>
                </div>

                <div class="col-sm-8 col-md-9">
                    <div id="feed">
                        <div class="card border-info">
                            <div class="card-header bg-info">
                                <h5 class="card-title">Change the password for instructor</h5>
                            </div>
                            <div class="card-body">
                                <div class="container-fluid">
                                    <form class="form-horizontal" role="form" name="change2"onSubmit="return changepassword();"action="changepasswordinstructor.php"method="post">
                                        <div class="form-group">
                                            <label class="control-label" for="pass">Old Password:</label> 
                                            <input type="password" class="form-control" name="old" placeholder="Enter the old password">
                                            <div class=""><p id="old1"></p></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="new"> New Password:</label>       
                                            <input type="password" class="form-control" name="new" placeholder="Enter the new password ">
                                            <div class=""><p id="new1"></p></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="new"> Confirm Password:</label>       
                                            <input type="password" class="form-control" name="confirm" placeholder="Enter the confirm password ">
                                            <div class=""><p id="confirm1"></p></div>
                                        </div>
                                        <div class="form-group">        
                                            <button type="submit" class="btn btn-success"name="change" value="change"onchange="onclick changepassword();">
                                                <i class="fa fa-save"><i> Save change
                                            </button>
                                            <button type="reset" class="btn btn-warning"name="cancel" value="cancel">
                                                <i class="fa fa-times"><i> Cancel
                                            </button>
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

                                            $up = "update user set password='$confirm1' where password='$old1' AND instructorid='$userid' AND username='$username'";
                                            $upd = mysqli_query($conn,$up);
                                            if ($upd) {
                                                echo '<font color ="red">The password is successfully changes';
                                            } else {
                                                echo 'not';
                                            }
                                        } else {
                                            echo '<font color="red">The old password is not match try again???';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php 
        include '../shared/footer.php'; 
    ?>
</html>












