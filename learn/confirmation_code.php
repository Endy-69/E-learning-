
<?php
session_start();
include 'database.php';
$conformation = $_SESSION['confirm'];
$ok = '';
$error = '';
echo "The confirmation code is " . $_SESSION['confirm'].'';

if (isset($_POST['confirmation'])) {
    $confirmation_c = $_POST['confirm'];
    $_SESSION['confirmation'] = $confirmation_c;
    $confirmation_code = $_SESSION['confirmation'];
    if (empty($confirmation_code)) {
        $ok = 'Please enter the correct confirmation code';
    } else {
        if($confirmation_code == $conformation){
            header("Location: resetpassword.php");
        }
        elseif ($confirmation_code != $conformation) {
            $error ='The confirmation code you entered is not macthed';
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
        <script src="../js/register.js" type="text/javascript"></script>
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
                                        <i class="fa fa-2x fa-check-square text-success"></i><br>
                                        Code Confirmation
                                    </div>
                                    <div class="card-body">
                                        <form class="form-horizontal" role="form" action=""method="post">
                                            <div class="form-group">
                                                <label class="control-label" for="confirm">Confirmation_Code:</label>
                                                <input type="text" class="form-control" name="confirm" placeholder="Enter The Confiramation_code">
                                            </div> 

                                            <div class="form-group float-right"> 
                                                <button type="submit" class="btn btn-danger classes" name="confirmation">
                                                    <i class="fa fa-1x fa-check-circle-o"></i> Confirm Code
                                                </button>
                                            </div> 
                                            <br><br><br> 
                                        </form>
                                        <?php
                                        if ($ok == 'Please enter the correct confirmation code') {
                                            echo $ok;
                                        }
                                        if($error == 'The confirmation code you entered is not macthed'){
                                            echo $error;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php include '../shared/footer.php'; ?>
</html>




