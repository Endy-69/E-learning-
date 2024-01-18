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
                        <a class="navbae-link" href="../depthead/depthead.php" title="This Is Department Head Page">
                            <i class="fa fa-1x fa">Home</i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="navbae-link" href="" title="This Is Download information from Registrar Officer">
                            <i class="fa fa-1x fa">Download</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="downloadstudentlistins.php" title="This Is Download Student List From Registrar Officer"> Student List</a>
                            <a href="annualcalendar.php" title="This Is Download The Carruiculm Calendar">Annual Calendar</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbae-link" href="" title="This Is Upload Information To The Department Society">
                            <i class="fa fa-1x fa">Upload</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="uploadnotice.php" title="This Is Upload Notice To The Department Society">Notice</a>
                        </div>
                    </li>
                    <li class="tab">
                        <a class="navbae-link" href="assigninstructor.php" title="This Is Assign Instructor To The Regiter Course List">
                            <i class="fa fa-1x fa">Assign Instructor</i>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="tab">
                        <a class="navbae-link" href="../learn/logout.php" title="This Is Leave From The Homepage">
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
                <div class="col-sm-12 col-md-6"> 
                        <div class="card border-info">
                            <div class="card-header bg-info">
                                <h5 class="card-title bg-info">Notice Board</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                include("../learn/database.php");
                                $query = mysqli_query($conn,"select * from departmenthead where departmentheadid='$userid'");
                                $row = mysqli_fetch_array($query);
                                $department = $row['departmentid'];
                                $select = mysqli_query($conn,"select * from notice where departmentid='$department' ORDER BY year ASC");
                                if (mysqli_num_rows($select) > 1) { ?>
                                    <table class="table table-striped">
                                            <thead>
                                                <tr class="info"><th>Year</th>
                                                    <th>Posted_date</th>
                                                    <th>Description</th>
                                                    <th>Hide</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            while ($row1 = mysqli_fetch_array($select)) {
                                                echo '<tr>';
                                                echo'<td>' . $row1['year'] . '</td><td>' . $row1['created'] . '</td><td>' . $row1['description'] . '</td><td><a href = uploadnotice.php?id=' . $row1['id'] . '>hide</a></td></tr>';
                                            }
                                        } else {

                                            echo 'THERE IS NOT UPLOAD NOTICE FOR EACH YEAR';
                                        }
                                        ?>
                                    </table>
                            </div>
                        </div>
                        <?php
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            mysqli_query($conn,"delete from notice  where id='$id'");
                        }
                        ?>
                </div>
                <div class="col-sm-12 col-md-6"> 
                    <div class="card border-info">
                        <div class="card-header bg-info">
                            <h5 class="card-title">Upload The Notice Information To The User</h5>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" role="form" method="POST"action="uploadnotice.php"enctype="multipart/form-data"name="form1" onSubmit="return form2();">
                                <div class="form-group">
                                    <label class="control-label">Year:</label>
                                    <div class="">
                                        <select multiple class="form-control"name="year[]">
                                            <option>I</option>
                                            <option>II</option>
                                            <option>III</option>
                                            <option>IV</option>
                                            <option>V</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Notice file:</label>
                                    <div class="">
                                        <input type="file" name="files" value="files" />
                                    </div>
                                    <div class="">
                                        <p id="fileid"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Description:</label>
                                    <div class="">
                                        <textarea class="form-control" rows="5" name="comment"></textarea>
                                    </div>
                                    <div class="">
                                        <p id="desc"></p>
                                    </div>
                                </div>
                                <div class="form-group float-right">  
                                        <button type="submit" name="upload" value="Upload" class="btn btn-info" onchange="onclick form2();">
                                            <i class="fa fa-1x fa-upload"></i> Upload
                                        </button>
                                        <button type="reset" name="cancel" value="Cancel" class="btn btn-danger"> 
                                            <i class="fa fa-1x fa-times"></i> Reset 
                                        </button>
                                    </div>
                                </div>       
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include("../learn/database.php");
        $select1 = mysqli_query($conn,"select * from departmenthead where departmentheadid='$userid'");
        $row1 = mysqli_fetch_array($select1);
        $dept = $row1['departmentid'];
        if (isset($_POST['upload'])) {
            $year1 = $_POST['year'];
            $comment = $_POST['comment'];
            $file = $_FILES['files']['name'];
            $file_loc = $_FILES['files']['tmp_name'];
            $file_size = $_FILES['files']['size'];
            $file_type = $_FILES['files']['type'];
            $folder = "notice/";

            // new file size in KB
            $new_size = $file_size / 1024;
            // new file size in KB
            // make file name in lower case
            $new_file_name = strtolower($file);
            // make file name in lower case

            $final_file = $new_file_name;

            move_uploaded_file($file_loc, $folder . $final_file);
            $day = date('y-m-d H:i:S');

            foreach ($year1 as $year1) {
                $year1 = $year1;

                $sql = mysqli_query($conn,"INSERT INTO notice VALUES('','$year1','$dept','$comment', '$final_file','$file_type','$new_size','$day','')");
                if ($sql) {
                    echo '<script>alert("Successfully upload the notice to user.")</script>';
                } else {
                    echo '<script>alert("not upload the notice file")<script>';
                }
            }
        }
        ?> 
    </body>
    <?php include '../shared/footer.php'; ?>
</html>





