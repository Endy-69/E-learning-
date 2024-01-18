<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link href="../css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>  
        <link href="../css/main.css" rel="stylesheet" type="text/css"/>
        <link href="../left/bootstrap.min1.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery.min1.js" type="text/javascript"></script> 
        <link href="../css/dashanboard111.css" rel="stylesheet" type="text/css"/>
        <link href="../student/userbar.css" rel="stylesheet" type="text/css"/> 
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
                        <a class="navbar-link" href="http://www.youtube.com">
                            <i class="fa fa-1x fa">Tutorials</i>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav ml-left">
                    <li class="tab">
                        <a class="navbar-link" href="login.php">
                            <i class="fa fa-1x fa">Login</i>
                        </a>
                    </li>
                    <li class="tab">
                        <a class="navbar-link" href="help.php">
                            <i class="fa fa-1x fa">Help</i>
                        </a>
                    </li>
                </ul>
            </div>     
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-3">
                <br><br>
                    <?php 
                        include '../shared/sidebar.php';
                    ?>
                </div>
                <div class="col-md-9 col-sm-9 ">
                    <div class="jumbotron row">
                        <div class="card bg-info col-md-6">
                            <div class="card-body">
                                <div class="text-center text-dark">  
                                    <h3><b>Get in Touch with </b></h3>
                                    <h3><b title="Mekdela Amba University">MAU</b></h3>  
                                    <hr>
                                </div>
                                <!-- form -->
                                <form role="form" action="" name="public_comment" method="post"> 
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                                    </div> 

                                    <div class="form-group">
                                        <textarea class="form-control" name="message" rows="3" placeholder="Message" required></textarea>
                                    </div> 

                                    <div class="form-group float-right">
                                        <button class="btn btn-danger" name="public_comment" type="submit">
                                            Send Message <i class="fa fa-mail"></i> 
                                        </button>
                                    </div> 
                                </form>
                                <?php 
                                include("database.php");
                                if (isset($_POST['public_comment'])) {
                                    $name = strtolower($_POST['name']);
                                    $email = strtolower($_POST['email']);
                                    $comment = $_POST['message']; 

                                    $insertstmt = mysqli_query($conn, "insert into comments values('','$name','$email','$comment')");

                                    if ($insertstmt) {
                                        echo '<font color="red">Comment successfuly submitted</font>';
                                    } else { 
                                        echo 'Please provide the comment first' . mysqli_error($conn);
                                    }
                                }
                                ?>
                            </div>                            
                        </div>
                        <div  class="col-md-6">
                            <label class="pl-2">Address<br>
                                <font class="text-info text-sm">Mekdela Amba, Amhara Ethiopia</font>
                            </label>
                            <br>
                            <label class="pl-2">Email
                                <br>
                                <font class="text-info text-sm"><a href="mailto:MAU@MAU.edu.et">MAU@MAU.edu.et</a></font>
                            </label> 
                            <br>
                            <label class="pl-2">Contact 
                                <br>
                                <font class="text-info text-sm">
                                    <span>1) Call at <a href="tel:+251 920157797">+251 914299547</a></span>
                                </font>
                            </label>	 
                            
                        </div>
                    </div> 
                </div>                
            </div>
        </div>
        <?php
            include '../shared/footer.php';
        ?>
    </body>
</html>
