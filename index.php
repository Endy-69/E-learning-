<html>
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>MAU E-Learning System</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="assets/imgage/logo.png" rel="icon">

        <!--  -->
        <link href="assets/vendor/aos/aos.css" rel="stylesheet">
        <link rel="stylesheet" href="css/owl.carousel.min.css">
        <link rel="stylesheet" href="css/animate.css">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link href="css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
        <link href="student/userbar.css" rel="stylesheet" type="text/css"/>
        <link href="style.css"/>
        <style>
            @media (min-width: 768px) and (max-width: 991px) {
                /* Show 4th slide on md if col-md-4*/
                .carousel-inner .active.col-md-4.carousel-item + .carousel-item + .carousel-item + .carousel-item {
                    position: absolute;
                    top: 0;
                    right: -33.3333%;  /*change this with javascript in the future*/
                    z-index: -1;
                    display: block;
                    visibility: visible;
                }
            }
            @media (min-width: 576px) and (max-width: 768px) {
                /* Show 3rd slide on sm if col-sm-6*/
                .carousel-inner .active.col-sm-6.carousel-item + .carousel-item + .carousel-item {
                    position: absolute;
                    top: 0;
                    right: -50%;  /*change this with javascript in the future*/
                    z-index: -1;
                    display: block;
                    visibility: visible;
                }
            }
            @media (min-width: 576px) {
                .carousel-item {
                    margin-right: 0;
                }
                /* show 2 items */
                .carousel-inner .active + .carousel-item {
                    display: block;
                }
                .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left),
                .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item {
                    transition: none;
                }
                .carousel-inner .carousel-item-next {
                    position: relative;
                    transform: translate3d(0, 0, 0);
                }
                /* left or forward direction */
                .active.carousel-item-left + .carousel-item-next.carousel-item-left,
                .carousel-item-next.carousel-item-left + .carousel-item,
                .carousel-item-next.carousel-item-left + .carousel-item + .carousel-item {
                    position: relative;
                    transform: translate3d(-100%, 0, 0);
                    visibility: visible;
                }
                /* farthest right hidden item must be also positioned for animations */
                .carousel-inner .carousel-item-prev.carousel-item-right {
                    position: absolute;
                    top: 0;
                    left: 0;
                    z-index: -1;
                    display: block;
                    visibility: visible;
                }
                /* right or prev direction */
                .active.carousel-item-right + .carousel-item-prev.carousel-item-right,
                .carousel-item-prev.carousel-item-right + .carousel-item,
                .carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item {
                    position: relative;
                    transform: translate3d(100%, 0, 0);
                    visibility: visible;
                    display: block;
                    visibility: visible;
                }
            }
            /* MD */
            @media (min-width: 768px) {
                /* show 3rd of 3 item slide */
                .carousel-inner .active + .carousel-item + .carousel-item {
                    display: block;
                }
                .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item + .carousel-item {
                    transition: none;
                }
                .carousel-inner .carousel-item-next {
                    position: relative;
                    transform: translate3d(0, 0, 0);
                }
                /* left or forward direction */
                .carousel-item-next.carousel-item-left + .carousel-item + .carousel-item + .carousel-item {
                    position: relative;
                    transform: translate3d(-100%, 0, 0);
                    visibility: visible;
                }
                /* right or prev direction */
                .carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item + .carousel-item {
                    position: relative;
                    transform: translate3d(100%, 0, 0);
                    visibility: visible;
                    display: block;
                    visibility: visible;
                }
            }
            /* LG */
            @media (min-width: 991px) {
                /* show 4th item */
                .carousel-inner .active + .carousel-item + .carousel-item + .carousel-item {
                    display: block;
                }
                .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item + .carousel-item + .carousel-item {
                    transition: none;
                }
                /* Show 5th slide on lg if col-lg-3 */
                .carousel-inner .active.col-lg-3.carousel-item + .carousel-item + .carousel-item + .carousel-item + .carousel-item {
                    position: absolute;
                    top: 0;
                    right: -25%;  /*change this with javascript in the future*/
                    z-index: -1;
                    display: block;
                    visibility: visible;
                }
                /* left or forward direction */
                .carousel-item-next.carousel-item-left + .carousel-item + .carousel-item + .carousel-item + .carousel-item {
                    position: relative;
                    transform: translate3d(-100%, 0, 0);
                    visibility: visible;
                }
                /* right or prev direction //t - previous slide direction last item animation fix */
                .carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item + .carousel-item + .carousel-item {
                    position: relative;
                    transform: translate3d(100%, 0, 0);
                    visibility: visible;
                    display: block;
                    visibility: visible;
                }
            }
        </style>
    </head>
    <!-- body -->
    <body>
        <?php
            include 'shared/header_top.php';
        ?>
        <nav class="navbar navbar-default navbar-expand-lg navbar-fixed-top">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar" aria-controls="myNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

             <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav mr-auto">
                    <li class="tab">
                        <a class="navbar-link" href="index.php" title="">
                            <i class="fa fa-1x fa">Home</i>
                        </a>
                    </li>
                    <li class="tab">
                        <a class="navbar-link" href="learn/about.php">
                            <i class="fa fa-1x fa">About Us</i>
                        </a>
                    </li>
                    <li class="tab">
                        <a class="navbar-link" href="learn/contact.php">
                            <i class="fa fa-1x fa">Contact Us</i>
                        </a>
                    </li>
                    <li class="tab">
                        <a class="navbar-link" href="learn/help.php">
                            <i class="fa fa-1x fa">Help</i>
                        </a>
                    </li>
                    <li class="tab">
                        <a class="navbar-link" href="http://www.youtube.com">
                            <i class="fa fa-1x fa">Tutorials</i>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav ml-auto">
                    <li class="tab">
                        <a class="navbar-link" href="learn/login.php">
                            <i class="fa fa-1x fa">Login</i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="jumbotron">
            <!-- about -->
            <div class="container" data-aos="fade-up">
                <div class="row bg-dark ">
                    <div class="col-md-3 align-items-center pt-2" data-aos="zoom-out" data-aos-delay="200">
                        <img src="assets/image/logo.png" class="img-fluid"  alt="">
                    </div>

                    <div class="col-md-9 d-flex flex-column justify-content-center text-white py-3 px-5" data-aos="fade-up" data-aos-delay="200">
                        <div class="content">
                            <h4 class="text-danger font-weight-bold">Who We Are?</h4>
                            <p class="text-justify">
                                <b>We Are Mekdela Amba University, </b><br>


                              Mekdela Amba University (MaU) is a university in South Wollo Zone, Amhara Region, Ethiopia. The main campus is at Tulu Awulia, 80km west of Dessie, and another campus is at Mekane Selam, 100km from the main campus.  <br>The main campus is 58km south from the historical place Mekdela Amba.

                                The university was established in 2015, one of 11 universities set up to expand higher education and distribute it across the country.
                                As of 2023 the university website states that it has 63 academic staff and 1500 students.<hr>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-12 flex-column justify-content-center text-white py-3 px-5">
                        <h5 class="text-warning">What We Offer?</h5>
                        <p class="text-justify">
                            The university  offers a range of degree programmes within the fields of technology, agriculture, medicine and health
                            sciences, business and economics, social science and humanities, natural and computational sciences,
                            law, information communication technology, and biotechnology. There are both Undergraduate and Graduate
                            courses available for students to study.
                        </p>
                        <div data-aos="fade-up" data-aos-delay="600">
                            <a href="learn/about.php" class="btn btn-lg btn-danger">
                                <button class="btn btn-danger">
                                    Read more
                                    <i class="fa fa-arrow-right"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- space -->
            <div class="container"><br><hr><br></div>

            <!-- more -->
            <div class="container" data-aos="flip-up-right">
                <div class="row">
                    <div class="col-md-7 bg-dark d-flex flex-column justify-content-center">
                        <div class="card-body text-white bg-dark pt-2">
                            <h4 data-aos="fade-up">Mekdela Amba University, E-Learning System</h4>
                            <h6 style="font-family: cursive;">
                                <i class="fa fa-quote-left text-danger"></i>
                                We have a Historical Responsibility to Answer Tewodros’s Quest for Knowledge!
                                <i class="fa fa-quote-right text-danger"></i>
                            </h6>
                            <hr class="text-danger">
                            <p class=" text-justify" data-aos="fade-up" data-aos-delay="400"><b>The main concept (message) of the motto:</b> Mekdela Amba University is a comprehensive higher educational
                                institution established near the Tulu Awlia Industrial Village, the birthplace of the first industry in. Therefore, it has entrusted the historical task of redeeming the
                                generation with an interdisciplinary approach by considering the technological potential of the world,
                                which is at the core of globalization in a manner that respects modern academic behavior.
                            </p>
                            <a href="learn/login.php" class="btn btn-danger" data-aos="fade-up" data-aos-delay="600">
                                <button class="btn btn-danger">
                                    Get Started
                                    <i class="fa fa-arrow-right"></i>
                                </button>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-5" data-aos="zoom-out" data-aos-delay="200">
                        <img src="assets/image/eight.jpg" class="img-fluid" height="450" alt="">
                    </div>
                    <!-- <div class="col-md-1"></div> -->
                </div>
            </div>

            <!-- space -->
            <div class="container"><br><hr><br></div>

             <!-- features -->
             <div class="container">
                <div class="row feature-icons" data-aos="fade-up">
                    <h3 class="col-md-12 pl-5 font-weight-bold">Academic Programs</h3>
                    <div class="col-md-4 text-center" data-aos="fade-right" data-aos-delay="100">
                        <img src="assets/image/logo.png" class="img-fluid p-4" alt="">

                        <div data-aos="fade-up" data-aos-delay="600">
                            <a href="learn/login.php" class="btn btn-lg btn-info">
                                <button class="btn btn-info">
                                    Join Now
                                    <i class="fa fa-arrow-right"></i>
                                </button>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-8 d-flex content">
                        <div class="row align-self-center">
                            <div class="col-md-6 py-2" data-aos="fade-up">
                                <h5><i class="fa fa-medkit text-danger"></i> College of Health Science</h5>
                                <p class="text-justify">
                                    This college at Mekdela Amba University offers undergraduate and graduate programs in health-related fields such as nursing, medicine, and public health.
                                </p>
                            </div>

                            <div class="col-md-6 py-2" data-aos="fade-up">
                                <h5><i class="fa fa-flask text-danger"></i> College of Natrual Science</h5>
                                <p class="text-justify">
                                    The College of Natural Science focuses on scientific research and education in areas such as physics, biology, and chemistry.
                                </p>
                            </div>

                            <div class="col-md-6 py-2" data-aos="fade-up">
                                <h5><i class="fa fa-money text-danger"></i> College of Business and Economics </h5>
                                <p class="text-justify">
                                    The College of Business and Economics offers programs in business administration, accounting, and economics, among others.
                                </p>
                            </div>

                            <div class="col-md-6 py-2" data-aos="fade-up">
                                <h5><i class="fa fa-newspaper-o text-danger"></i> College of Social Sciences and Humanities </h5>
                                <p class="text-justify">
                                    This college offers programs in areas such as journalism, psychology, and sociology.
                                </p>
                            </div>

                            <div class="col-md-6 py-2" data-aos="fade-up">
                                <h5><i class="fa fa-cutlery text-danger"></i> College of Agriculture and Environmental Sciences </h5>
                                <p class="text-justify">
                                    This college focuses on sustainable agriculture practices, environment conservation, and natural resource management.
                                </p>
                            </div>

                            <div class="col-md-6 py-2" data-aos="fade-up">
                                <h5><i class="fa fa-cogs text-danger"></i>Others</h5>
                                <p class="text-justify">
                                    New Colleges will be emerged to achieve our goals, and to get updated on new academic programs.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- space -->
            <div class="container"><br><hr><br></div>

            <!-- counter -->
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-md-2 card pt-2 mx-2 bg-success text-white" style=" border-radius: 2em; text-align: center; box-shadow: 0 5px 10px rgba(0,0,0,.2);">
                        <!-- <img src="assets/image/cover.jpg" class="card-img-top" alt="..." style="width: 65%; border-radius: 50%; margin: 0 auto;  box-shadow: 0 0 10px rgba(0,0,0,.2);"> -->
                        <i class="fa fa-4x text-dark fa-users py-3"></i>
                        <div>
                            <h4 class="purecounter" data-purecounter-start="0" data-purecounter-end="932" data-purecounter-duration="3"></h4>
                            <h5 class="font-weight-bold">Staffs</h5>
                        </div>
                    </div>

                    <div class="col-md-2 card pt-2 mx-2 bg-warning text-white" style=" border-radius: 2em; text-align: center; box-shadow: 0 5px 10px rgba(0,0,0,.2);">
                        <!-- <img src="assets/image/cover.jpg" class="card-img-top" alt="..." style="width: 65%; border-radius: 50%; margin: 0 auto;  box-shadow: 0 0 10px rgba(0,0,0,.2);"> -->
                        <i class="fa fa-4x text-dark fa-book py-3"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="1393" data-purecounter-duration="3" class="purecounter"></span>
                            <p>Undergraduate Students</p>
                        </div>
                    </div>

                    <div class="col-md-3 card pt-2 mx-2 bg-danger text-white" style=" border-radius: 2em; text-align: center; box-shadow: 0 5px 10px rgba(0,0,0,.2);">
                        <!-- <img src="assets/image/cover.jpg" class="card-img-top" alt="..." style="width: 65%; border-radius: 50%; margin: 0 auto;  box-shadow: 0 0 10px rgba(0,0,0,.2);"> -->
                        <i class="fa fa-4x text-dark fa-graduation-cap py-3"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="100" data-purecounter-duration="3" class="purecounter"></span>
                            <p>Postgraduate Students</p>
                        </div>
                    </div>

                    <div class="col-md-2 card pt-2 mx-2 bg-info text-white" style=" border-radius: 2em; text-align: center; box-shadow: 0 5px 10px rgba(0,0,0,.2);">
                        <!-- <img src="assets/image/cover.jpg" class="card-img-top" alt="..." style="width: 65%; border-radius: 50%; margin: 0 auto;  box-shadow: 0 0 10px rgba(0,0,0,.2);"> -->
                        <i class="fa fa-4x text-dark fa-university py-3"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="47" data-purecounter-duration="3" class="purecounter"></span>
                            <p>Undergraduate Programs</p>
                        </div>
                    </div>

                    <div class="col-md-2 card pt-2 mx-2 bg-secondary text-white" style=" border-radius: 2em; text-align: center; box-shadow: 0 5px 10px rgba(0,0,0,.2);">
                        <!-- <img src="assets/image/cover.jpg" class="card-img-top" alt="..." style="width: 65%; border-radius: 50%; margin: 0 auto;  box-shadow: 0 0 10px rgba(0,0,0,.2);"> -->
                        <i class="fa fa-4x text-dark fa-rocket py-3"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="11" data-purecounter-duration="3" class="purecounter"></span>
                            <p>Postgraduate Programs</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- space -->
            <div class="container"><br><hr><br></div>

            <!-- contact us -->
            <div class="container" data-aos="fade-up">
                <h4 class="text-danger font-weight-bold">Contact Us</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row text-white">
                            <div class="col-md-5 card mx-3 mb-3 bg-success">
                                <div class="card-body">
                                    <h4><i class="fa fa-map-marker text-dark"></i> Address</h4>
                                    <font class="py-2">Mekdela Amba,<br>Mekdela Amba, Ethiopia</font>
                                </div>
                            </div>

                            <div class="col-md-5 card mx-3 mb-3 bg-warning">
                                <div class="card-body">
                                    <h4><i class="fa fa-phone text-primary"></i> Call Us</h4>
                                    <font class="py-2">
                                        <a href="tel: +251581410495" >+251 581 41 0495</a><br>
                                        <a href="tel: +251581412260"> +251 581 41 2260</a>
                                    </font>
                                </div>
                            </div>

                            <div class="col-md-5 card mx-3 mb-3 bg-danger">
                                <div class="card-body">
                                    <h4><i class="fa fa-envelope"></i> Email Us</h4>
                                    <font class="py-2">
                                        <a href="mailto: MAU@MAU.edu.et" class="text-white">MAU@MAU.edu.et</a><br>
                                        <a href="https://www.MAU.edu.et" class="text-white">visit us at www.MAU.edu.et</a>
                                    </font>
                                </div>
                            </div>

                            <div class="col-md-5 card mx-3 mb-3 bg-info">
                                <div class="card-body">
                                    <h4><i class="fa fa-clock-o"></i> Open Hours</h4>
                                    <font class="py-2">Monday - Friday<br>9:00AM - 05:00PM</font>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <form class="form-horizontal" role="form" action="" method="post" name="public_comment">
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
                    </div>
                </div>

                <?php
                include("learn/database.php");
                if (isset($_POST['public_comment'])) {
                    $name = strtolower($_POST['name']);
                    $email = strtolower($_POST['email']);
                    $comment = $_POST['message'];

                    $insert = mysqli_query($conn, "insert into comments values('','$name','$email','$comment')");

                    if ($insert) {
                        echo '<font color="red">Comment successfuly submitted</font>';
                    } else {
                        echo 'Please provide the comment first';
                    }
                }
                ?>
                <br>
            </div>
        </div>

        <!-- beautiiful places  -->
        <div data-aos="zoom-in-down">
            <h4 class="text-center font-weight-bold pb-3">Some Beautful Places of MAU </h4>
            <div id="carousel-example" class="carousel slide" data-ride="carousel" data-aos="zoom-out">
                <div class="carousel-inner row w-100" role="listbox">
                    <div class="carousel-item image_gallery col-12 col-sm-6 col-md-4 col-lg-3 active">
                        <img src="assets/image/1.JPG" class="mx-2 d-block" height="250" alt="img1">
                    </div>
                    <div class="carousel-item image_gallery col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="assets/image/two.JPG" class="mx-2 d-block" height="250" alt="img2">
                    </div>
                    <div class="carousel-item image_gallery col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="assets/image/three.JPG" class="mx-2 d-block" height="250" alt="img3">
                    </div>
                    <div class="carousel-item image_gallery col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="assets/image/four.JPG" class="mx-2 d-block" height="250" alt="img4">
                    </div>
                    <div class="carousel-item image_gallery col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="assets/image/five.JPG" class="mx-2 d-block" height="250" alt="img5">
                    </div>
                    <div class="carousel-item image_gallery col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="assets/image/six.JPG" class="mx-2 d-block" height="250" alt="img6">
                    </div>
                    <div class="carousel-item image_gallery col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="assets/image/seven.JPG" class="mx-2 d-block" height="250" alt="img7">
                    </div>
                    <div class="carousel-item image_gallery col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="assets/image/eight.jpg" class="mx-2 d-block" height="250" alt="img8">
                    </div>
                    <div class="carousel-item image_gallery col-12 col-sm-6 col-md-4 col-lg-3">
                        <img src="assets/image/ten.JPG" class="mx-2 d-block" height="250" alt="img9">
                    </div>
                </div>

                <a class="carousel-control-prev" href="#carousel-example" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-example" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </body>
    <button class="btn btn-lg btn-info btn-rounded position-fixed d-none" onclick="scrollToTop()" id="back-to-up" style="bottom: 25px; right: 25px; height: 45px; z-index: 1;">
        <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
    </button>
    <footer class=" mainfooter" role="contentinfo" style="padding-top: 30px; margin-top: 60px; background-color: rgb(207, 224, 235);" >
        <!--  -->
        <div class="footer-middle">
        <div class="container-fluid main-footer">
            <div class="row footer-first">
            <div class="col-md-4 col-sm-12 col-xs-12">
                <!--Column1-->
                <div class="">
                <h3 class="font-weight-bold">Mekdela Amba University</h3>
                <hr style="background-color: green; height: 2px;">
                <p style="text-align: justify;">
                    <b>Mekdela Amba University</b> is one of the comprehensive universities launched at a historically
                    valuable town – Mekdela Amba. This town is one of the ancient towns of Ethiopia which is located at
                    the foot of Mount Guna. Mt. Guna is the third highest mountain called “the water tower of Ethiopia”
                    whose wet breathing helped the town much to take advantage point in keeping its surrounding conducive
                    to live in.
                </p>
                </div>
            </div>
            <!-- Our services -->
            <div class="col-md-4 col-sm-6 col-xs-6">
                <!--Column1-->
                <div class="useful-links" >
                <h4 class="text-center font-weight-bold">Useful Links</h4>
                <hr style=" height: 2px; background-color: yellow;">
                <div class="row">
                    <div class="col-md-6">
                    <h3 class="font-weight-bold" style="padding-left: 40px;">Academics</h3>
                    <ul style="list-style: none; color: red;">
                        <li class="nav-item nav-foot">
                        <a style="background-color: transparent;" href="https://MAU.edu.et/our-history/#">
                            Colleges
                        </a>
                        </li>
                        <li class="nav-item nav-foot">
                        <a style="background-color: transparent;" href="https://MAU.edu.et/our-history/#">
                            Technology Faculty
                        </a>
                        </li>
                        <li class="nav-item nav-foot">
                        <a style="background-color: transparent;" href="https://MAU.edu.et/our-history/#">
                            Schools
                        </a>
                        </li>
                    </ul>
                    </div>
                    <div class="col-md-6">
                    <h3 class="font-weight-bold" style="padding-left: 40px;">Services</h3>
                    <ul style="list-style: none;">
                    <li class="nav-item nav-foot">
                        <a style="background-color: transparent;" href="https://MAU.edu.et/our-history/#">
                            Events
                        </a>
                        </li>
                        <li class="nav-item nav-foot">
                        <a style="background-color: transparent;" href="https://MAU.edu.et/registrar/">
                            Registrar
                        </a>
                        </li>
                        <li class="nav-item nav-foot">
                        <a style="background-color: transparent;" href="https://MAU.edu.et/library/">
                            Library
                        </a>
                        </li>
                        <li class="nav-item nav-foot">
                        <a style="background-color: transparent;" href="https://MAU.edu.et/our-history/#">
                            Administration
                        </a>
                        </li>
                    </ul>
                    </div>
                </div>
                </div>
            </div>
            <!-- map -->
            <div class="col-md-4 col-sm-6 col-xs-6">
                <!--more for helpers-->
                <h3 class="font-weight-bold">Find Out Our Location</h3>
                <hr style=" height: 2px; background-color: rgb(247, 97, 97);" />
             <div class="map"> <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3948.383680672914!2d38.37926241461324!3d11.082884791886881!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x164d4ca191f7f28b%3A0x6a42d8a6bf22c20!2sMekdela%20Amba%20University!5e0!3m2!1sen!2set!4v1678461290687!5m2!1sen!2set" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> </div>
                <!-- place_id:ChIJ72lzjsOaSxYRkquYdntV-wk -->
            </div>
            </div>
        </div>
        </div>
        <!-- Fotter bottom {{curYear}} -->
        <div class="container-fluid" style="background-color: #4e4c4c; margin-top: 12px; padding: 10px;">
        <p class="text-center" style="font-family: cursive; color: white">Copyright
            <i class="fa fa-copyright" style="margin: 3px; padding-top: -30px;"></i> 2015/2023,
            By Mekdela Amba University. All Rights Reserved.</p>
        </div>
    </footer>
    <script src="js/jquery.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script>
        function aos_init() {
            AOS.init({
            duration: 1000,
            easing: "ease-in-out",
            once: true,
            mirror: false
            });
        }
        window.addEventListener('load', () => {
            aos_init();
            new PureCounter();
        });

        $('#carousel-example').on('slide.bs.carousel', function (e) {
            var $e = $(e.relatedTarget);
            var idx = $e.index();
            var itemsPerSlide = 5;
            var totalItems = $('.image_gallery').length;

            if (idx >= totalItems-(itemsPerSlide-1)) {
                var it = itemsPerSlide - (totalItems - idx);
                for (var i=0; i<it; i++) {
                    // append slides to end
                    if (e.direction=="left") {
                        $('.carousel-item').eq(i).appendTo('.carousel-inner');
                    }
                    else {
                        $('.carousel-item').eq(0).appendTo('.carousel-inner');
                    }
                }
            }
        });

        window.onscroll = () => {
            toggleTopButton();
        }
        function scrollToTop(){
            window.scrollTo({top: 0, behavior: 'smooth'});
        }

        function toggleTopButton() {
            if (document.body.scrollTop > 20 ||document.documentElement.scrollTop > 20) {
                document.getElementById('back-to-up').classList.remove('d-none');
            } else {
                document.getElementById('back-to-up').classList.add('d-none');
            }
        }
    </script>
</html>
