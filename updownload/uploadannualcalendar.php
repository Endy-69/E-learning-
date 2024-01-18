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
                        <a class="navbar-link" href="../registrar/registrar.php" title="This Registrar Home Page">
                            <i class="fa fa-1x fa">Home</i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href=""title="This Upload Resource Page To The Department">
                            <i class="fa fa-1x fa">Upload</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="uploadannualcalendar.php" title="This Upload Annual Calendar To The Department">Annual Calendar</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href=""title="This Registrar Information Page">
                            <i class="fa fa-1x fa">Register</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="../registrar/registercourse.php" title="This Register Course For Each Department">Course</a>
                            <a href="../registrar/registerdepartment.php" title="This Register Department For Each Faculity">Department</a>
                            <a href="../registrar/registerinstructor.php" title="This Register Instructor For Each Department">Instructor</a>
                                <a href="registerstudent.php" title="This Register student For Each Department">Student</a>
                        </div>
                    </li> 
                    <li class="tab">
                        <a class="navbar-link" href="../registrar/viewresult.php" title="This View Student Result For Each Department">
                            <i class="fa fa-1x fa">View Student Result</i>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="tab">
                        <a class="navbar-link" href="../learn/logout.php" title="Logout From The Page"> 
                            <i class="fa fa-1x fa-sign-out">Logout</i>
                        </a>
                    </li>
                </ul> 
            </div>
        </nav> 
        <!-- body -->
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-4">  
                    <div class="card border-info">
                        <div class="card-header bg-info">
                            <h5 class="card-title">Uploaded Annual Calendar Lists</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="info">
                                        <th>Upload_Date</th>
                                        <th>Description</th>
                                        <th>Department</th>
                                        <th>hide</th>
                                    </tr>  
                                </thead>
                                <tbody>
                                    <?php
                                    include '../learn/database.php';
                                    $query = mysqli_query($conn,"select DISTINCT date, description from calendar");
                                    while ($row1 = mysqli_fetch_array($query)) {
                                        $date = $row1['date'];
                                        $description = $row1['description'];
                                        echo '<tr>';
                                        echo '<td>' . $date . '</td><td>' . $description . '</td>';
                                        $select = mysqli_query($conn,"select * from calendar where date='$date' AND description='$description' AND status=0");
                                        echo '<td>';
                                        $i = 1;
                                        while ($row2 = mysqli_fetch_array($select)) {
                                            $department = $row2['departmentid'];
                                            $select1 = mysqli_query($conn,"select * from department where departmentid='$department'");
                                            $row = mysqli_fetch_array($select1);
                                            $departmentname = $row['departmentname'];
                                            echo $i . ':   ';
                                            echo '  ' . $departmentname;
                                            echo '</br>';
                                            $i++;
                                        }echo '</td>';
                                        echo '<td><a href=uploadannualcalendar.php?status=' . $date . '&desc=' . $description . '>hide</a></td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                    <?php
                                    if (isset($_GET['status'])) {
                                        $status = $_GET['status'];
                                        $description = $_GET['desc'];
                                        $st = '1';
                                        $up = mysqli_query($conn,"delete from calendar where status='0'");
                                        if (!$up) {
                                            echo mysqli_error();
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-8"> 
                    <div class="card border-info">
                        <div class="card-header bg-info">
                            <h5 class="card-title">Upload The Annual calendar to Each Department</h5>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" role="form" method="POST"action="uploadannualcalendar.php"enctype="multipart/form-data"name="up"onSubmit="return upload1();">
                                <?php
                                include("../learn/database.php");
                                $sql = "select * from department";
                                $result = mysqli_query($conn,$sql);

                                echo '<div class="form-group">';
                                echo '<label class="control-label ">Department:</label>';
                                echo'<div class="">';
                                echo '<select name="departmentid[]" multiple class="form-control">';

                                while ($row = mysqli_fetch_array($result)) {
                                    $department = $row['departmentname'];
                                    $departmentid = $row['departmentid'];
                                    ?>
                                    <option value="<?php echo $departmentid; ?>"> <?php echo $department; ?></option>;<?php
                                }
                                echo '</select>';
                                echo '</div>';
                                echo'<div class="">';
                                echo'<p id="departmentid1"></p>';
                                echo'</div>';
                                echo '</div>';
                                echo'<br>';
                                ?>

                                <div class="form-group">
                                    <label class="control-label "> Description: </label>
                                    <div class="">
                                        <textarea class="form-control" rows="5" name="desc"></textarea>
                                    </div><div class=""><p id="g"></p></div></div>
                                <div class="form-group">
                                    <label class="control-label "> File Name: </label>
                                    <div class="">
                                        <input type="file" name="files"value="files"></div><div class=""><p id="fileid"></p></div>
                                </div>               
                                <div class="form-group float-right">         
                                    <button type="submit" class="btn btn-success" value="upload" name="Upload"onchange="onclick upload1();">
                                    <i class="fa fa-1x fa-upload"></i> Upload</button>
                                    <button type="reset" class="btn btn-danger" value="cancel" name="cancel">Cancel</button>
                                </div> 
                            </form>
                        </div>
                    </div>

                    <?php
                    error_reporting(0);
                    include("../learn/database.php");
                    $echo='';
                    if (isset($_POST['Upload'])) {
                        $department = ($_POST['departmentid']);
                        $description = $_POST['desc'];
                        $file = $_FILES['files']['name'];
                        $file_loc = $_FILES['files']['tmp_name'];
                        $file_size = $_FILES['files']['size'];
                        $file_type = $_FILES['files']['type'];
                        $folder = "calendar/";
                        $day = date('Y-m-d');

                        // new file size in KB
                        $new_size = $file_size / 1024;
                        // new file size in KB
                        // make file name in lower case
                        $new_file_name = strtolower($file);
                        // make file name in lower case

                        $final_file = $new_file_name;

                        move_uploaded_file($file_loc, $folder . $final_file);

                        foreach ($department as $department) {
                            $department = $department;

                            $query = mysqli_query($conn,"insert into calendar values ('','$department','$final_file','$file_type','$day','$description','')");


                            if ($query) {
                                $echo = '<script>alert("The calendar file is successful upload  to the selected department")</script>';
                            } else {
                                echo '<script>alert("The calendar file is not uploaded")</script>';
                            }
                        }
                        if($echo == '<script>alert("The calendar file is successful upload  to the selected department")</script>'){
                            echo $echo;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
    <?php include '../shared/footer.php'; ?>
</html>



