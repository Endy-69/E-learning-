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
                        <ul class="nav navbar-nav navbar-right">
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
                </div>
            </div>     
        </nav>
        <div class="container-fluid">
            <br>
            <div class="row"> 
                <div class="col-sm-12 col-md-3">
                    <?php
                        include '../shared/sidebar.php';
                    ?>
                </div>
                <div class="col-sm-12 col-md-9"> 
                    <div class="alert alert-primary" role="alert">
                        <h4 class="card-title font-weight-bold">FAQs</h4>
                        Can't find the answer you're looking for? We've shared some of our most frequently asked questions to help you out!
                    </div>


                    <!-- questions -->
                    <div class="card-body text-justify" style="box-shadow: 1px 2px 2px rgb(248, 69, 108);">
                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#FAQ" role="button" aria-expanded="false" aria-controls="FAQ">
                            Where Does Mekdela Amba  University Located?                             
                            <i class="fa fa-1x fa-chevron-down text-info float-right"></i>                          
                        </a>  
                        <div class="collapse" id="FAQ">
                            <div class="card card-body">
                                Mekdela Amba  University is one of the comprehensive universities (Mekaneselam and TuluAwlia) launched at a historically valuable town – Mekdela Amba . it has two campus which are Tulu Awlia And Mekanesealm
                                This town is one of the ancient towns of Ethiopia which is located at the foot of Mount Mekdela. Mekdela is the third highest mountain called “the water tower of Ethiopia” whose wet breathing helped the town much to take advantage point in keeping its surrounding conducive to live in.
                            </div>
                        </div>
                    </div> 

                    <!-- first questions -->
                    <br><br>
                    <div class="card-body text-justify" style="box-shadow: 1px 2px 2px rgb(248, 69, 108);">
                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#FAQ1" role="button" aria-expanded="false" aria-controls="FAQ1">
                            Is Mekdela Amba  University a Governmental University?                             
                            <i class="fa fa-1x fa-chevron-down text-info float-right"></i>                          
                        </a>  
                        <div class="collapse" id="FAQ1">
                            <div class="card card-body">
                                Mekdela Amba  University is a governmental comprehensive higher educational institution established near the Borena Sayint 
                                Industrial Village, the birthplace of the first industry in Africa under Emperor Tewodros II. Therefore, it has 
                                entrusted the historical task of redeeming the generation with an interdisciplinary approach by considering the 
                                technological potential of the world, which is at the core of globalization in a manner that respects modern academic behavior.
                            </div>
                        </div>
                    </div> 

                    <!-- second questions -->
                    <br><br>
                    <div class="card-body text-justify" style="box-shadow: 1px 2px 2px rgb(248, 69, 108);">
                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#FAQ2" role="button" aria-expanded="false" aria-controls="FAQ2">
                            Does Mekdela Amba  University Provides Social Studies?                             
                            <i class="fa fa-1x fa-chevron-down text-info float-right"></i>                          
                        </a>  
                        <div class="collapse" id="FAQ2">
                            <div class="card card-body">
                                Mekdela Amba  University gives students the chance to select their Best fit academic programs 
                                through different colleges like College of Business and Economics offers programs in business 
                                administration, accounting, and economics, among others. 
                            </div>
                        </div>
                    </div>

                    <!-- third questions -->
                    <br><br>                    
                    <div class="card-body text-justify" style="box-shadow: 1px 2px 2px rgb(248, 69, 108);">
                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#FAQ3" role="button" aria-expanded="false" aria-controls="FAQ3">
                            Does Mekdela Amba  University Establish Research Centers?                             
                            <i class="fa fa-1x fa-chevron-down text-info float-right"></i>                          
                        </a>  
                        <div class="collapse" id="FAQ3">
                            <div class="card card-body">
                                Mekdela Amba  University also established seven research centers that will benefit farmers in South Wollo Zone. Apple Development Research Center in Widg,
                                Mekdela AMba Integrated Field Research and Development Center in Mekaneselam, Sayint Research Center, Borena Fish Livestock Project, Wereilu Research Center, Poultry farm 
                                and free law and psychosocial aid center in Mekdela Wollo district were the most important and successful research centers.
                            </div>
                        </div>
                    </div>

                    <!-- fourtht questions -->
                    <br><br>                     
                    <div class="card-body text-justify" style="box-shadow: 1px 2px 2px rgb(248, 69, 108);">
                        <a class="text-dark font-weight-bold" data-toggle="collapse" href="#FAQ4" role="button" aria-expanded="false" aria-controls="FAQ4">
                            Why I Should Select Mekdela Amba  University Over Others?                             
                            <i class="fa fa-1x fa-chevron-down text-info float-right"></i>                          
                        </a>  
                        <div class="collapse" id="FAQ4">
                            <div class="card card-body">
                                Mekdela Amba  University also established seven research centers that will benefit farmers in South Wollo Zone. Apple Development Research Center in Hagere Genet,
                                Mekdela Tana Integrated Field Research and Development Center in Awuzet, Ebnat Research Center, Kuhar Fish Livestock Project, Semada Research Center, Poultry farm 
                                and free law and psychosocial aid center in Mekdela begemider district were the most important and successful research centers.
                                <br>
                                Students can use the opportunity to live their dream life through these research centers.
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
