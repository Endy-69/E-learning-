<?php
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
        <script src="../js/depthead.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/depthead.js" type="text/javascript"></script>
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
                        <a class="navbar-link" href="../depthead/depthead.php" title="This Is Department Head Page">
                            <i class="fa fa-1x fa">Home</i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This Is Download information from Registrar Officer">
                            <i class="fa fa-1x fa">Download</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="downloadstudentlistins.php" title="This Is Download Student List From Registrar Officer"> Student List</a>
                            <a href="annualcalendar.php" title="This Is Download The Carruiculm Calendar">Annual Calendar</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This Is Upload Information To The Department Society">
                            <i class="fa fa-1x fa">Upload</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="uploadnotice.php" title="This Is Upload Notice To The Department Society">Notice</a>
                        </div>
                    </li>
                    <li class="tab">
                        <a class="navbar-link" href="assigninstructor.php" title="This Is Assign Instructor To The Regiter Course List">
                            <i class="fa fa-1x fa">Assign Instructor</i>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav ml-auto" style="font-family: cursive;"> 
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="profile">
                            <i class="fa fa-1x fa-user"> Profile</i> 
                        </a>
                        <div class="dropdown-content dropdown-menu dropdown-menu-right">
                            <a href="../student/changepasswordstudent.php">
                                <i class="fa fa-1x fa-key text-dark">Change Password</i>
                            </a> 
                            <a href="../learn/logout.php" title="This Is Leave From Student Page"> 
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
                <div class="col-sm-12 col-md-3">
                    <?php include '../shared/sidebar.php'; ?> 
                </div>

                <div class="col-sm-12 col-md-9"> 
                    <div class="card border-info">
                        <div class="card-header bg-info">Download The Annual Calendar Form That Are Uploaded By The Registrar Offices</div>
                        <div class="card-body">
                            <form name="form" >
                                <?php
                                error_reporting(0);
                                include("../learn/database.php");
                                $sql = mysqli_query($conn,"select * from departmenthead where departmentheadid='$userid'");
                                $row1 = mysqli_fetch_array($sql);
                                $deptid = $row1['departmentid'];
                                $sql1 = mysqli_query($conn,"select * from calendar where departmentid='$deptid'");
                                if (mysqli_num_rows($sql1) >= 1) {
                                    echo "<table  class='table table-striped'>
                                            <thead>
                                        <tr class ='success'>
                                        <th><font color='black' size='2'>Calendar id</th>
                                        <th><font color='black' size='2'>Description</th>
                                        <th><font color='black' size='2'>File type</th>
                                        <th><font color='black' size='2'>Download</th></tr>";
                                    while ($row = mysqli_fetch_array($sql1)) {
                                        echo '<tr class="info">';
                                        echo"<td>";
                                        echo $row["calendarid"];
                                        echo"</td>";
                                        echo"<td>";
                                        echo $row["description"];
                                        echo"</td>";
                                        echo"<td>";
                                        echo $row["filetype"];
                                        echo"</td>";
                                        echo "<td align=center><a title='Click here to download in file.' 
		                           href='download.php?id={$row['filename']}'><i class='fa fa-1x fa-download text-danger'></i></a>";
                                        echo"</td>";
                                        echo"</tr>";
                                    }
                                    echo "</table>";
                                }
                                ?>
                            </form></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php include '../shared/footer.php'; ?>
</html>





