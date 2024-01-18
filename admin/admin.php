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
            <br>
            <div class="row">   
                <?php
                include '../learn/database.php';
                $selectregister = mysqli_query($conn,"select * from registrar");
                $totalregister = mysqli_num_rows($selectregister);
                echo '';
                $selectdepthead = mysqli_query($conn,"select * from departmenthead");
                $totaldepthead = mysqli_num_rows($selectdepthead);
                echo '';
                $selectinstructor = mysqli_query($conn,"select * from instructor");
                $totalinstructor = mysqli_num_rows($selectinstructor);
                echo '';
                $selectstudent = mysqli_query($conn,"select * from student");
                $totalstudents = mysqli_num_rows($selectstudent);
                echo '';
                ?> 
                <div class="col-sm-12 col-md-3">
                    <div class="card border-success">
                        <div class="card-header bg-success"><h5 class="card-title">Number_of_Department_Head</h5></div>
                        <div class="card-body"><span class="badge"><?php echo $totaldepthead; ?></span></div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="card border-warning">
                        <div class="card-header bg-warning" ><h5 class="card-title">Number_of_Instructor</h5></div>
                        <div class="card-body"><span class="badge"><?php echo $totalinstructor; ?></span></div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="card border-danger">
                        <div class="card-header bg-danger"><h5 class="card-title">Number_of_Registrar</h5></div>
                        <div class="card-body"><span class="badge"><?php echo $totalregister; ?></span></div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="card border-info">
                        <div class="card-header bg-info"><h5 class="card-title">Number_of_Student</h5></div>
                        <div class="card-body"><span class="badge"><?php echo $totalstudents; ?></span></div>
                    </div>
                </div>                
            </div>
            <!-- detail  -->
            <div class="row">
                <table class="table ">
                    <tr class="col-md-3 col-sm-12 ">
                        <?php
                        include '../learn/database.php';
                        $admin = 'Admin';
                        $query = mysqli_query($conn,"select DISTINCT usertype from user where usertype!='$admin' ORDER BY usertype ASC");

                        while ($row = mysqli_fetch_array($query)) {
                            $usertype = $row['usertype'];
                            $number = mysqli_query($conn,"select count(*) from user where usertype='$usertype'");
                            $numberrow = mysqli_num_rows($number);
                            echo '<td>
                                <a class="btn btn-dark" href = admin.php?usertype=' . $row['usertype'] . '>
                                    View Detail <i class="fa fa-long-arrow-down text-primary"></i>
                                </a>
                            </td>';
                        }
                        ?>
                    </tr>
                </table>
                
                <div class="col-md-12 col-sm-12">
                        <?php    
                            if(isset($_GET['usertype'])) {
                                echo '<div class="card border-primary"> 
                                <div class="card-header bg-primary">
                                    <h5 class="card-title bg-primary">Lists of '?><?php echo $_GET['usertype'];?> <?php echo '</h5>
                                </div>';
                            }
                        ?>
                        <div class="card-body">                  
                            <table class="table table-striped">
                                <?php
                                include '../learn/database.php';
                                if (isset($_GET['usertype'])) {
                                    $usertype = $_GET['usertype'];
                                    if ($usertype == 'Department') {
                                        $select = mysqli_query($conn,"select * from departmenthead");

                                        if (mysqli_num_rows($select) >= 1) {
                                            ?>
                                            <tr class="success">
                                                <th>First_Name</th>
                                                <th>Middle_Name</th>
                                                <th>Last_Name</th>
                                                <th>Sex</th> 
                                                <th>Email</th>
                                                <th>Department_head</th>
                                               
                                            </tr>
                                            <?php
                                            while ($row1 = mysqli_fetch_array($select)) {
                                                $departmenthead = $row1['departmentid'];
                                                $number = mysqli_num_rows($select);
                                                $select1 = mysqli_query($conn,"select * from department where departmentid='$departmenthead'");
                                                $rowvalue = mysqli_fetch_array($select1);

                                                echo '<tr>';

                                                echo '<td>' . $row1['firstname'] . '</td><td>' . $row1['middlename'] . '</td><td>' . $row1['lastname'] . '</td><td>' . $row1['sex'] . '</td><td>' . $row1['email'] . '</td><td>' . $rowvalue['departmentname'] . '</td>';
                                                echo '<td>';
                                                ?>
                            
                                                <?php
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            $numbertotal = mysqli_num_rows($select);
                                            if ($numbertotal >= 7) {
                                                ?>
                                                <table class="table">
                                                    <tr>
                                                        <?php
                                                        $admin = 'Admin';
                                                        $query = mysqli_query($conn,"select DISTINCT usertype from user where usertype!='$admin' ORDER BY usertype ASC");

                                                        while ($row = mysqli_fetch_array($query)) {
                                                            echo '<td> 
                                                                <a class="btn btn-outline-dark" href = admin.php?usertype=' . $row['usertype'] . '>
                                                                    View Detail <i class="fa fa-long-arrow-up text-primary"></i> 
                                                                </a> 
                                                            </td>';
                                                        }
                                                        ?>
                                                    </tr>
                                                </table>
                                                <?php
                                            }
                                        }
                                    } elseif ($usertype == 'Student') {
                                        $student = mysqli_query($conn,"select * from student ORDER BY departmentid ASC");
                                        if (mysqli_num_rows($student) >= 1) {
                                            ?>
                                            <tr class="warning">
                                                <th>First_Name</th>
                                                <th>Middle_Name</th>
                                                <th>Last_Name</th>
                                                <th>Sex</th> 
                                                <th>Email</th>
                                                <th>Department</th>
                                                <th>Year</th>
                                               
                                            </tr>
                                            <?php
                                            while ($row2 = mysqli_fetch_array($student)) {
                                                $departmentid = $row2['departmentid'];
                                                $student1 = mysqli_query($conn,"select * from department where departmentid='$departmentid'");
                                                $rowvalue1 = mysqli_fetch_array($student1);

                                                echo '<tr>';

                                                echo '<td>' . $row2['firstname'] . '</td><td>' . $row2['middlename'] . '</td><td>' . $row2['lastname'] . '</td><td>' . $row2['sex'] . '</td><td>' . $row2['email'] . '</td><td>' . $rowvalue1['departmentname'] . '</td><td>' . $row2['year'] . '</td>';
                                                echo '<td>';
                                                ?>
                                               
                                                <?php
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            $numbertotal = mysqli_num_rows($student);
                                            if ($numbertotal >= 7) {
                                                ?>
                                                <table class="table table">
                                                    <tr>
                                                        <?php
                                                        $admin = 'Admin';
                                                        $query = mysqli_query($conn,"select DISTINCT usertype from user where usertype!='$admin' ORDER BY usertype ASC");

                                                        while ($row = mysqli_fetch_array($query)) {
                                                            echo '<td> 
                                                                <a class="btn btn-outline-dark" href = admin.php?usertype=' . $row['usertype'] . '>
                                                                    View Detail <i class="fa fa-long-arrow-up text-primary"></i> 
                                                                </a> 
                                                            </td>';
                                                        }
                                                        ?>
                                                    </tr>
                                                </table>
                                                <?php
                                            }
                                        }
                                    } elseif ($usertype == 'Instructor') {
                                        $instructor = mysqli_query($conn,"select * from instructor ORDER BY firstname ASC");
                                        if (mysqli_num_rows($instructor) >= 1) {
                                            ?>
                                            <tr class="danger">
                                                <th>First_Name</th>
                                                <th>Middle_Name</th>
                                                <th>Last_Name</th>
                                                <th>Sex</th> 
                                                <th>Email</th>
                                                <th>Department_Name</th>
                                                
                                            </tr>
                                            <?php
                                            while ($row3 = mysqli_fetch_array($instructor)) {
                                                $departmentidins = $row3['departmentid'];
                                                $departmentid1 = mysqli_query($conn,"select * from department where departmentid='$departmentidins'");
                                                $rowvalue2 = mysqli_fetch_array($departmentid1);
                                                echo '<tr>';

                                                echo '<td>' . $row3['firstname'] . '</td><td>' . $row3['middlename'] . '</td><td>' . $row3['lastname'] . '</td><td>' . $row3['sex'] . '</td><td>' . $row3['email'] . '</td><td>' . $rowvalue2['departmentname'] . '</td>';
                                                echo '<td>';
                                                ?>
                                                
                                                <?php
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            $numbertotal = mysqli_num_rows($instructor);
                                            if ($numbertotal >= 7) {
                                                ?>
                                                <table class="table table">
                                                    <tr>
                                                        <?php
                                                        $admin = 'Admin';
                                                        $query = mysqli_query($conn,"select DISTINCT usertype from user where usertype!='$admin' ORDER BY usertype ASC");

                                                        while ($row = mysqli_fetch_array($query)) {
                                                            echo '<td> 
                                                                <a class="btn btn-outline-dark" href = admin.php?usertype=' . $row['usertype'] . '>
                                                                    View Detail <i class="fa fa-long-arrow-up text-primary"></i> 
                                                                </a> 
                                                            </td>';
                                                        }
                                                        ?>
                                                    </tr>
                                                </table>
                                                <?php
                                            }
                                        }
                                    } elseif ($usertype == 'Registrar') {
                                        $registrar = mysqli_query($conn,"select * from registrar");
                                        if (mysqli_num_rows($registrar)) {
                                            ?>
                                            <tr class="info">
                                                <th>First_Name</th>
                                                <th>Middle_Name</th>
                                                <th>Last_Name</th>
                                                <th>Sex</th> 
                                                <th>Email</th>
                                                
                                            </tr>
                                            <?php
                                            while ($row4 = mysqli_fetch_array($registrar)) {
                                                echo '<tr>';

                                                echo '<td>' . $row4['firstname'] . '</td><td>' . $row4['middlename'] . '</td><td>' . $row4['lastname'] . '</td><td>' . $row4['sex'] . '</td><td>' . $row4['email'] . '</td>';
                                                echo '<td>';
                                                ?>
                                                
                                                <?php
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            $numbertotal = mysqli_num_rows($registrar);
                                            if ($numbertotal >= 7) {
                                                ?>
                                                <table class="table table">
                                                    <tr>
                                                        <?php
                                                        $admin = 'Admin';
                                                        $query = mysqli_query($conn,"select DISTINCT usertype from user where usertype!='$admin' ORDER BY usertype ASC");

                                                        while ($row = mysqli_fetch_array($query)) {
                                                            echo '<td> 
                                                                <a class="btn btn-outline-dark" href = admin.php?usertype=' . $row['usertype'] . '>
                                                                    View Detail <i class="fa fa-long-arrow-up text-primary"></i> 
                                                                </a> 
                                                            </td>';
                                                        }
                                                        ?>
                                                    </tr>
                                                </table>
                                                <?php
                                            }
                                        }
                                    }
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div> 
            </div>

            <br>
            <?php
            include("../learn/database.php"); 
            $comm = mysqli_query($conn, "select * from comments");
            if(mysqli_num_rows($comm) >= 1){ ?>
                <div class="jumbotron">
                    <div class="row">
                        <div class="col-md-2 bg-warning"> 
                            <h6 class="card-title text-center">
                                <br><br><br><br><br>
                                Users  comments
                            </h6>
                        </div> 
                        <div class="col-md-10 card-body">
                            <?php
                                while ($comment_row = mysqli_fetch_array($comm)) {
                                    $name = $comment_row['name']; 
                                    $email =  $comment_row['email'];
                                    $comment = $comment_row['comment'];
                                    echo '';?>
                                    <div class="alert alert-success" role="alert">
                                        <h6 class="card-title py-2">
                                            A comment of  
                                            <?php echo '<font class="text-danger">'. $name . ' </font> is :-'. $comment; ?> 
                                            <!-- <i class="fa fa-trash float-right"></i>  -->
                                        </h6> 
                                    </div>
                                <?php }
                            ?> 
                        </div> 
                    </div>
                </div>
            <?php } ?>
        </div>
    </body>
    <?php include '../shared/footer.php';  ?>
</html>


