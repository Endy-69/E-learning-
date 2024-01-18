<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="../css/bootstrap.min.css"> 
        <link href="../css/main.css" rel="stylesheet" type="text/css"/>
        <link href="../left/bootstrap.min1.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery.min1.js" type="text/javascript"></script>  
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
        <link href="../css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/> 
        <!-- <link rel="stylesheet" href="../css/bootstrap.css"> -->
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
            <br><br>
            <div class="row">
                <div class="col-sm-3 col-md-3">
                    <?php 
                        include '../shared/sidebar.php';
                    ?>
                </div>
                <div class="col-md-9 col-sm-9 ">
                    <div class="row">
                    <div class="col-md-7">
                        <div class="card"> 
                        <div class="card-body">
                            <h3><b>About Mekdela Amba University</b></h3>
                            <hr>
                            <b class="text-italic">
                            <i class="fa fa-quote-left text-danger"></i>
                            We have a Historical Responsibility to Answer Tewodros’s Quest for Knowledge!
                            <i class="fa fa-quote-right text-danger"></i>
                            </b>
                            <p class="text-justify">
                            Mekdela Amba University is a comprehensive higher educational institution established near the Gafat Industrial Village, 
                            the birthplace of the first industry in Africa under Emperor Tewodros II. Therefore, it has entrusted the historical task of redeeming the generation with an interdisciplinary
                            approach by considering the technological potential of the world, which is at the core of globalization in a manner that
                            respects modern academic behavior.
                            </p>
                            <!-- <br>  -->
                            <p class="text-justify">
                            Mekdela Amba University also established seven research centers that will benefit farmers in South Gondar Zone. Apple Development Research Center in Hagere Genet, Guna Tana 
                            Integrated Field Research and Development Center in Awuzet, Ebnat Research Center, Kuhar Fish Livestock Project, Semada Research Center, Poultry farm and free law and psychosocial 
                            aid center in Guna begemider district were the most important and successful research centers.
                            </p>
                            
                        </div>
                        </div>       
                    </div>
                    <!-- next row -->
                    <div class="col-md-5">
                        <div class="card bg-info" style="padding: 5px 10px;">
                            <div class="card-body">
                                <h3>Mission</h3>
                                <p>The mission of Mekdela Amba University is to contribute to the overall development of the 
                                country through producing competent graduates in all programs and excelling in agriculture and environmental science, health sciences and technology, and solving societal 
                                problems by conjugating scientific researches with indigenous 
                                knowledge.
                                </p>
                            </div>
                        </div>
                        <br>
                        <div class="card bg-warning" style="padding: 5px 10px;">
                            <div class="card-body">
                                <h3>Vision</h3>
                                <p>
                                To become the leading comprehensive university in Ethiopia by 2030 G.C.
                                </p>
                            </div>
                        </div>
                        <br>
                        <div class="card bg-danger" style="padding: 5px 10px;">
                            <div class="card-body">
                                <h3>Value</h3>
                                <p>
                                Mekdela Amba University maintains, encourages, and directs the following values to achieve its vision and mission.
                                </p>
                            </div>
                        </div> 
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
