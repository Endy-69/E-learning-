<?php
error_reporting(0);
session_start();
include("../learn/database.php");
if (isset($_SESSION['userid']) && ($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $userid = $_SESSION['userid'];
} else {
    header("Location: ../learn/login.php");
}
?><html>
    <head>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <link href="register.css" rel="stylesheet" type="text/css"/>
        <link href="../css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/> 
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
                        <a class="navbar-link" href="registrar.php" title="This Registrar Home Page">
                            <i class="fa fa-1x fa">Home</i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href=""title="This Upload Resource Page To The Department">
                            <i class="fa fa-1x fa">Upload</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../updownload/uploadannualcalendar.php" title="This Upload Annual Calendar To The Department">Annual Calendar</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href=""title="This Registrar Information Page"><i class="fa fa-1x fa">Register</i></a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="registercourse.php" title="This Register Course For Each Department">Course</a>
                            <a href="registerdepartment.php" title="This Register Department For Each Faculity">Department</a>
                            <a href="registerinstructor.php" title="This Register Instructor For Each Department">Instructor</a>
                            <a href="registerstudent.php" title="This Register student For Each Department">Student</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href=""title="This Registrar capacity Page"><i class="fa fa-1x fa">Capacity</i></a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="coursecapacity.php" title="This Register Course For Each Department">Course Capacity</a>
                            <a href="instructorcapacity.php" title="This Register Department For Each Faculity">Inctructor Capacity</a> 
                        </div>
                    </li> 
                    <li class="tab">
                        <a class="navbar-link" href="viewresult.php" title="This View Student Result For Each Department">
                            <i class="fa fa-1x fa"> View Student Result</i>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right"> 
                    <li class="dropdown">
                        <a class="navbar-link unstyled" href="" title="profile">  
                            <?php echo  $username?>
                            <i class="fa fa-sm fa-1x fa-chevron-down"></i>
                        </a>
                        <div class="dropdown-content dropdown-menu dropdown-menu-right">
                            <a class="navbar-link" href="changepassword1.php" title="">
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
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-2"> 
                    <div class="scroll-view"> 
                        <div id="sidebar-menu" class="hidden-print">
                            <div class="card border-success"> 
                                <div class="card-header bg-success">
                                    <h5 class="card-title">Faculity</h5>
                                </div>
                                <?php
                                include '../learn/database.php';
                                $select = mysqli_query($conn,"select DISTINCT faculity from department");
                                while ($row3 = mysqli_fetch_array($select)) {
                                    $faculity = $row3['faculity'];
                                    ?>
                                    
                                    <ul class="nav side-menu">
                                        <?php echo'<li><a href="registerdepartment.php?department=' . $faculity . '">
                                        <i class="fa fa-book text-info"></i>  ' .  $faculity . '</a>   
                                            </li>'; ?>
                                    </ul>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-10"> 
                    <?php
                    error_reporting(0);
                    include '../learn/database.php';

                    if (isset($_GET['department'])) {
                        $departmentid = $_GET['department'];
                        $query = mysqli_query($conn,"select * from department where faculity='$departmentid'");
                        while ($row = mysqli_fetch_array($query)) {
                            $departmentid1 = $row['departmentid'];
                            $departmentname = $row['departmentname'];
                            ?>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12"> 
                                    <h5 class="card-header bg-info">List of Instructor In <?php echo $departmentname . '     '; ?>Department</h5> 
                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="info">
                                                <th>#</th>
                                                <th>First Name</th>
                                                <th>Middle Name</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $select = mysqli_query($conn,"select * from instructor where departmentid='$departmentid1'");
                                            $i = 1;
                                            while ($row1 = mysqli_fetch_array($select)) {
                                                echo '<tr>';
                                                echo '<td>' . $i . '</td>
                                                    <td>' . $row1['firstname'] . '</td>
                                                    <td>' . $row1['middlename'] . '</td>
                                                    <td>' . $row1['email'] . '</td>
                                                </tr>';
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table> 
                                </div>


                                <div class="col-md-6 col-sm-12 col-xs-12"> 
                                    <h5 class="card-header bg-warning">List of Course In <?php echo $departmentname . '     '; ?>Department</h5>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="danger">
                                                    <th>#</th>
                                                    <th>Course_Code</th>
                                                    <th>Course_Name</th>
                                                    <th>Credit_Hour</th>
                                                    <th>Year</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query1 = mysqli_query($conn,"select * from course where departmentid='$departmentid1' ORDER BY year ASC");
                                            $i = 1;
                                            while ($row2 = mysqli_fetch_array($query1)) {
                                                echo '<tr>';
                                                echo '<td>' . $i . '</td><td>' . $row2['coursecode'] . '</td><td>' . $row2['coursename'] . '</td><td>' . $row2['credithour'] . '</td><td>' . $row2['year'] . '</td></tr>';
                                                $i++;
                                            }
                                            ?>

                                        </tbody>
                                    </table> 
                                </div>
                                <div class="col-md-12 col-sm-12"><br><br></div>
                            </div>
                                <?php
                                }
                            ?> 
                            <?php
                        }
                        ?>
                        <div class="jumbotron">
                            <div class="card-body"> 
                                <form class="form-horizontal" role="form" method="post" action="" name="addnew1" onsubmit="return addnew();">
                                    <div class="form-group">
                                        <label class="control-label" for="email">Department_Name</label>
                                        <input type="text" class="form-control" name="departmentnamenew" placeholder="Enter department name">
                                        <div>
                                            <p id="departmentname1"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="pwd">Faculity:</label>
                                        <!-- <input type="text" class="form-control" name="faculitynamenew" placeholder="Enter faculity"> -->
                                        <select class = "form-control" name="faculitynamenew">
                                            <?php
                                                include '../learn/database.php';
                                                $select = mysqli_query($conn,"select DISTINCT faculity from department");
                                                while ($row3 = mysqli_fetch_array($select)) {
                                                    $faculity = $row3['faculity'];
                                                    ?>  
                                                    <option value="<?php echo $faculity; ?>"><?php echo $faculity; ?></option>
                                                    <?php
                                            }
                                            ?>
                                        </select>
                                        <div> 
                                            <p id="faculityname1"></p>
                                        </div>
                                    </div>

                                    <?php
                                    include("../learn/database.php");
                                    if (isset($_POST['registernew'])) {
                                        $departmentid = rand(100, 100000);
                                        $value = 'dept' . $departmentid;
                                        $deptname = strtolower($_POST['departmentnamenew']);
                                        $faculity = $_POST['faculitynamenew'];

                                        if(ctype_alpha($deptname)) {
                                            if($deptname.length >=2){
                                                $sql = mysqli_query($conn,"select * from department where departmentname='$deptname'");
                                                if (mysqli_num_rows($sql) <= 0) {
                                                    $insert = mysqli_query($conn,"insert into department values('$value','$deptname','$faculity')");
                                                    if ($insert) {
                                                        echo '<p class="serif">Department Successfully added</p>';
                                                    } else {

                                                        echo '<p class="serif">Not register</p>';
                                                    }
                                                } elseif (mysqli_num_rows($sql) >= 1) {
                                                    echo '<p class="serif">The department Name  is duplicate select other</p>';
                                                }
                                            } else {
                                                echo '<p class="serif">The department Name should have at least two character</p>';
                                            }
                                        } else {
                                            echo '<p class="serif">The department Name can\'t be empty or not be number</p>';
                                        }
                                    }
                                    ?>

                                    <div class="form-group float-right"> 
                                        <button type="submit" class="btn btn-danger" name="registernew" onclick="return addnew();">
                                            Register
                                        </button>
                                    </div> 
                                </form>  
                            </div>
                        </div>
                    
                    <?php
                    include("../learn/database.php");
                    if (isset($_POST['register'])) {
                        $departmentid = rand(100, 100000);
                        $value = 'dept' . $departmentid;
                        $deptname = strtolower($_POST['departmentname']);
                        $faculity = $_POST['faculity'];
                        
                        $sql = mysqli_query($conn,"select * from department where departmentname='$deptname'");
                        if (mysqli_num_rows($sql) <= 0) {
                            $insert = mysqli_query($conn,"insert into department values('$value','$deptname','$faculity')");
                            if ($insert) {
                                echo '<p class="serif">Successfully add the department</p>';
                            } else {

                                echo '<p class="serif">Not register</p>';
                            }
                        } elseif (mysqli_num_rows($sql) >= 1) {
                            echo '<p class="serif">The department Name  is duplicate select other</p>';
                        }
                    }
                    ?>
                    
                </div> 
            </div> 
        </div>
    </body> 
    <?php include '../shared/footer.php'; ?>
</html>



