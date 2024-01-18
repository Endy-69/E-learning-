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
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/jquery.min.js"></script>

        <link href="../css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="../left/bootstrap.min1.css" rel="stylesheet" type="text/css"/>
        <script src="../left/bootstrap.min1.js" type="text/javascript"></script>
        <link href="../left/custom1.css" rel="stylesheet" type="text/css"/>
        <script src="../left/jquery.min1.js" type="text/javascript"></script>
        <script src="../js/register.js" type="text/javascript"></script>
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

        <div class="container-fluid">  
            <div class="jumbotron"> 
                <div class="row"> 
                    <div class="card border-info">
                        <div class="card-header bg-info">
                            <h5 class="card-title">User Account Creation</h5>
                        </div>
                        <div class="card-body"> 
                            <form class="row form-horizontal" role="form" action="create.php"method="POST" onSubmit="return validates();" name="create">
                                <div class="form-group col-md-4 col-sm-12">
                                    <label class="control-label" for="firstname">First Name:</label>
                                    <input type="text" class="form-control"name="firstname"placeholder="Enter first name">
                                    <div class=""><p id="firstname1"></p> </div>
                                </div>
                                <div class="form-group col-md-4 col-sm-12">
                                    <label class="control-label" for="lastname">Middle Name:</label> 
                                        <input type="text" class="form-control" name="middlename" placeholder="Enter middle name">
                                        <div class=""><p id="middlename1"></p></div>
                                </div> 
                                <div class="form-group col-md-4 col-sm-12">
                                    <label class="control-label" for="lastname">Last Name:</label> 
                                    <input type="text" class="form-control" name="lastname" placeholder="Enter last name">
                                    <div class=""><p id="lastname1"></p></div>
                                </div> 
                                <div class="form-group col-md-4 col-sm-12">
                                    <label class="control-label" for="username">Username:</label> 
                                    <input type="text" class="form-control" name="username" placeholder="Enter Username">
                                    <div class=""><p id="username1"></p></div>
                                </div> 
                                <div class="form-group col-md-4 col-sm-12">
                                    <label class="control-label " for="password">Password:</label> 
                                    <TD width="59%" class=secondalt align=left>
                                    <input class="form-control" name="password" type="password"  id="password" minlength="8"&& maxlength="40" size="39" tabindex="2"name="password" placeholder="Enter  password">
                                    </TD> 
                                    <div class=""><p id="password1"></p></div> 
                                </div>
                                <div class="form-group col-md-4 col-sm-12">
                                    <label class="control-label" for="confirmpassword">Confirm Password:</label> 
                                    <input type="password" class="form-control"  name="confirmpassword" placeholder="Enter confirm password"></div><div class=""><p id="confirmpassword1"></p> 
                                </div>      

                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="control-label" for="usertype">Usertype:</label> 
                                    <select name="usertype" class="form-control">
                                        <option selected >..select..</option>
                                        <option value="Department head">Department head</option>
                                        <option value="Registrar">Registrar</option>
                                        <option value="Instructor">Instructor</option>
                                        <option value="Admin">admin</option>
                                        <option value="Student">Student</option>
                                    </select> 
                                    <div class=""><p id="usertype1"></p></div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 float-right">         
                                    <button type="reset" class="btn btn-danger"value="back" name="back">
                                        <i class="fa fa-1x fa-times"></i> Reset
                                    </button>
                                    <button type="submit" class="btn btn-success" value="create" name="create" onchange="clickon validates();">
                                        <i class="fa fa-1x fa-save"></i> Create Account
                                    </button> 
                                </div>
                            </form> 
                            <?php
                            //session_start();
                            include("../learn/database.php");
                            if (isset($_POST['create'])) {
                                $firstname = strtolower($_POST['firstname']);
                                $middlename = strtoupper($_POST['middlename']);
                                $lastname = strtolower($_POST['lastname']);
                                $username = strtolower($_POST['username']);
                                $password = $_POST['password'];
                                $encrypted_password =md5($password);
                                $usertype = $_POST['usertype'];
                                $status = ('on');
                                $confirm = rand(100, 100000);
                                $selectconfirm = mysqli_query($conn,"select * from user where conformation_code='$confirm'");
                                if (mysqli_num_rows($selectconfirm) >= 1) {
                                    
                                } else {

                                    $sql = "select username from user where username='$username'";
                                    $result = mysqli_query($conn,$sql);
                                    if (mysqli_num_rows($result) <= 0) {
                                        if ($usertype == 'Instructor') {
                                            $ins = mysqli_query($conn,"select * from instructor where firstname='$firstname' AND middlename='$middlename' AND lastname='$lastname'");
                                            if (mysqli_num_rows($ins) >= 1) {

                                                while ($row = mysqli_fetch_array($ins)) {
                                                    $insid = $row['instructorid'];
                                                    $email = $row['email'];
                                                    $select = mysqli_query($conn,"select * from user where instructorid='$insid'");
                                                    if (mysqli_num_rows($select) >= 1) {
                                                        
                                                    } else {
                                                        $username1 = $username;
                                                        $instructor = mysqli_query($conn,"insert into user values('$confirm','','','$insid','','','$username1','$encrypted_password','$usertype','$status')");
                                                        if ($instructor) {
                                                            echo '<lable id="lable">' . 'The User Account is Successfully Created!!!' . '</lable>';
                                                        } else {

                                                            echo '<lable id="lable">' . 'The User Account is not Created!! Try again ????' . '</lable>';
                                                        }
                                                    }
                                                }
                                            } elseif (mysqli_num_rows($ins) <= 0) {
                                                echo '<lable id="lable">' . 'The Instructor is not register to the system??' . '</lable>';
                                            }
                                        } else if ($usertype == 'Department head') {
                                            $dept = mysqli_query($conn,"select * from departmenthead where firstname='$firstname' AND middlename ='$middlename' AND lastname='$lastname'");
                                            if (mysqli_num_rows($dept) >= 1) {
                                                while ($row1 = mysqli_fetch_array($dept)) {
                                                    $deptid = $row1['departmentheadid'];
                                                    $email = $row1['email'];
                                                    $select1 = mysqli_query($conn,"select * from user where departmentheadid='$deptid'");
                                                    if (mysqli_num_rows($select1) >= 1) {
                                                        
                                                    } else {
                                                        $username1 = $username;
                                                        $depthead = mysqli_query($conn,"insert into user values('$confirm','','','','$deptid','','$username1','$encrypted_password','$usertype','$status')");
                                                        if ($depthead) {
                                                            echo '<lable id="lable">' . 'The User Account is Successfully Created!!!' . '</lable>';
                                                        } else {

                                                            echo '<lable id="lable">' . 'The User Account is not Created!! Try again ????' . '</lable>';
                                                        }
                                                    }
                                                }
                                            } elseif (mysqli_num_rows($dept) <= 0) {
                                                echo '<lable id="lable">' . 'The Department head is not register to the system??' . '</lable>';
                                            }
                                        } else if ($usertype == 'Registrar') {
                                            $registrar = mysqli_query($conn,"select * from registrar where firstname='$firstname' AND middlename='$middlename' AND lastname='$lastname'");
                                            if (mysqli_num_rows($registrar) >= 1) {
                                                while ($row2 = mysqli_fetch_array($registrar)) {
                                                    $registrarid = $row2['registrarid'];
                                                    $email = $row2['email'];
                                                    $select2 = mysqli_query($conn,"select * from user where registrarid='$registrarid'");
                                                    if (mysqli_num_rows($select2) >= 1) {
                                                        
                                                    } else {
                                                        $username2 =  $username;
                                                        $reg = mysqli_query($conn,"insert into user values('$confirm','','','','','$registrarid','$username2','$encrypted_password','$usertype','$status')");
                                                        if ($reg) {
                                                            echo '<lable id="lable">' . 'The User Account is Successfully Created!!!' . '</lable>';
                                                        } else {

                                                            echo '<lable id="lable">' . 'The User Account is not Created!! Try again ????' . '</lable>';
                                                        }
                                                    }
                                                }
                                            } elseif (mysqli_num_rows($registrar) <= 0) {
                                                echo '<lable id="lable">' . 'The registrar is not register to the system???' . '</lable>';
                                            }
                                        }else if ($usertype == 'Student') {
                                            $student = mysqli_query($conn,"select * from student where firstname='$firstname' AND middlename='$middlename' AND lastname='$lastname'");
                                            if (mysqli_num_rows($student) >= 1) {
                                                while ($row2 = mysqli_fetch_array($student)) {
                                                    $studentid = $row2['studentid'];
                                                    $email = $row2['email'];
                                                    $select2 = mysqli_query($conn,"select * from user where studentid='$studentid'");
                                                    if (mysqli_num_rows($select2) >= 1) {
                                                        
                                                    } else {
                                                        $username2 =  $username;
                                                        $reg = mysqli_query($conn,"insert into user values('$confirm','','','','','$studentid','$username2','$encrypted_password','$usertype','$status')");
                                                        if ($reg) {
                                                            echo '<lable id="lable">' . 'The User Account is Successfully Created!!!' . '</lable>';
                                                        } else {

                                                            echo '<lable id="lable">' . 'The User Account is not Created!! Try again ????' . '</lable>';
                                                        }
                                                    }
                                                }
                                            } elseif (mysqli_num_rows($student) <= 0) {
                                                echo '<lable id="lable">' . 'The student is not register to the system???' . '</lable>';
                                            }
                                        }  else if ($usertype == 'Admin') {
                                            $admin = mysqli_query($conn,"select * from admin where firstname='$firstname' AND lastname='$lastname'");
                                            if (mysqli_num_rows($admin) >= 1) {
                                                $row2 = mysqli_fetch_array($admin);
                                                $id = $row2['id'];
                                                $email = $row2['email'];

                                                $reg = mysqli_query($conn,"insert into user values('$confirm','$id','','','','','$username','$encrypted_password','$usertype','$status')");
                                                if ($reg) {
                                                    echo '<lable id="lable">' . 'The User Account is Successfully Created!!!' . '</lable>';
                                                } else {

                                                    echo '<lable id="lable">' . 'The User Account is not Created!! Try again ????' . '</lable>';
                                                }
                                            } elseif (mysqli_num_rows($admin) <= 0) {
                                                echo '<lable id="lable">' . 'The admin is not register to the system???' . '</lable>';
                                            }
                                        }
                                    } elseif (mysqli_num_rows($result) >= 1) {
                                        echo '<lable id="lable">' . 'The Username is Allready Exist Select Other Username??? Try again ????' . '</lable>';
                                    }
                                }
                            }
                            ?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </body>
    <?php include '../shared/footer.php'; ?>
</html>




