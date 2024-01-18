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
        <script src="../js/bootstrap.min.js"></script>

        <link href="../css/dashanboard111.css" rel="stylesheet" type="text/css"/>
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



        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar">

                    <li class="active"><a href="admin.php"><i class="fa fa-2x fa-home"></i></a></li>
                    <li ><a href="activateaccount.php">Activate Account</a></li>
                    <li><a href="create.php">Create Account<span class="sr-only">(current)</span></a></li>
                    <li><a href="deactivateaccount.php">Deactivate Account</a></li>
                    <li><a href="updateaccount.php">Update Account</a></li>
                    <li><a href="changepassword.php">Change Password</a></li>
                </ul>

            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <div id="feed">
                    <?php
                    include '../learn/database.php';
                    $query = mysqli_query($conn,"select DISTINCT usertype from user");
                    while ($row = mysqli_fetch_array($query)) {
                     ?>
                    <table >
                    <?php
                                         echo '<tr>';
                                         echo '<td>'.$row['usertype'].'</td></tr>';
                    }
                    ?>
                    </table>

                </div>



            </div>

        </div>


        <?php
        // put your code here
        ?>
    </body>
</html>


