
<head>
<link rel="stylesheet" href="bootstrap.min.css"/> 
<link style="text/css" href="main.css" rel="stylesheet"/>
<link href="font-awesome.css"/>  
</head>

  <?php
    include 'header_top.php';
  ?>
  <div class="header">	
      <!-- navigation -->
      <nav id="navbar_top" class="navbar navbar-default navbar-expand-sm fixed fill" data-spy="affix">
        <div class="container-fluid top_nav">
          <!-- <a id="brand" class="navbar-brand" href="/">
            <img class="float-left" src="./assets/images/logo.png" alt="">
          </a> -->
          <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <!-- <span class="fa fa-menu"></span> -->
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav mr-auto mb-2 mb-lg-0">
              <li class="nav-item"><br></li>
              <li class="nav-item active"><a href="../index.php" class="nav-link">
                <i class="fa fa-home"></i>
                Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="About.php">
                  <i class="fa fa-users"></i>
                  About US
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="register.php">
                  <i class="fa fa-share"></i>
                  Apply
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-books"></i>
                  Departments
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item nav-link" href="Accounting.php">
                    Accounting
                  </a>
                  <a class="dropdown-item nav-link" href="Management.php">
                    Management
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item nav-link" href="Marketing.php">
                    Marketing Management
                  </a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Contact.php">
                  <i class="fa fa-address-book"></i>
                  Contact US
                </a>
              </li> 
        <li class="nav-item">
                <a class="nav-link" href="new1.php">
                  <i class="fa fa-news"></i>
                  Announcement
                </a>
              </li>  
            </ul>
        <ul class="nav navbar-nav ml-auto my-2 my-lg-0"> 
              <li class="nav-item">
                <a class="nav-link" href="login.php">
                  <i class="fa fa-sign-in"></i>
                  Login
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Help.php">
                  <i class="fa fa-question"></i>
                  Help
                </a>
              </li>
            </ul>		  
          </div>
        </div>
      </nav>
  </div> 