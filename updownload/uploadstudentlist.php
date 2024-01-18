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
        <script type="text/javascript">
            function uploadlist() {
                var departmentid = document.upload_excel.departmentid.value;
                if (departmentid == "") {
                    document.getElementById('departmentid1').innerHTML = "<font color='red'>Please select the department</font>";
                    document.upload_excel.departmentid.focus();
                    return false;
                } else {

                    return true;
                }
            }
        </script>
        <link href="../css/main.css" rel="stylesheet" type="text/css"/>
        <link href="../student/userbar.css" rel="stylesheet" type="text/css"/>
    </head>
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
                            <a href="uploadstudentlist.php" title="This Upload Student List The Department"> Student List</a>
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
                            <i class="fa fa-1x fa"> View Student Result</i>
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
                    <?php
                    include '../learn/database.php';
                    $query = mysqli_query($conn,"select DISTINCT departmentid from student");
                    while ($row1 = mysqli_fetch_array($query)) {
                        $department = $row1['departmentid'];
                        $select = mysqli_query($conn,"select * from department where departmentid='$department'");
                        $row10 = mysqli_fetch_array($select);
                        $departmentid = $row10['departmentid'];
                        $departmentname = $row10['departmentname'];
                        ?>
                        <div class="card border-info">
                            <div class="card-header bg-info">For Department of  <font color="red"><b><?php echo strtoupper($departmentname); ?></b></font></div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="info">
                                            <th>Student_Id</th>
                                            <th>Student_Name</th>
                                            <th>Sex</th>
                                            <th>Year</th>
                                        </tr>
                                    </thead>
                                    <tbody><?php
                                        $select1 = mysqli_query($conn,"select * from student where departmentid='$departmentid' ORDER BY year ASC");
                                        while ($row2 = mysqli_fetch_array($select1)) {
                                            $full = $row2['firstname'] . '   ' . $row2['middlename'] . '   ' . $row2['lastname'];
                                            echo '<tr>';
                                            echo'<td>' . $row2['studentid'] . '</td><td>' . $full . '</td><td>' . $row2['sex'] . '</td><td>' . $row2['year'] . '</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-sm-12 col-md-8"> 
                    <div class="card border-info">
                        <div class="card-header bg-info">
                            <h5 class="card-title">Select The faculity to upload the student list for each department</h5>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" role="form" method="post"action="">
                                <div class="form-group">
                                    <label class="control-label" for="department">Faculity:</label>                                    
                                    <select class="form-control" name="faculity">
                                        <?php
                                        include '../learn/database.php';
                                        $query2 = mysqli_query($conn,"select DISTINCT faculity from department");
                                        while ($row3 = mysqli_fetch_array($query2)) {
                                            ?>
                                            <option value="<?php echo $row3['faculity']; ?>"><?php echo $row3['faculity']; ?></option>
                                            <?php
                                        }
                                        ?>


                                    </select> 
                                </div>
                                <div class="form-group float-right">  
                                    <button type="submit" class="btn btn-success" name="select"value="select">
                                        <i class="fa fa-1x fa-check"></i> Select
                                    </button> 
                                </div>

                            </form> 
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <?php
                                    include("../learn/database.php");
                                    if (isset($_POST['select'])) {
                                        echo' <div class="card border-success">';
                                        echo' <div class="card-body success">';
                                        $faculity = $_POST['faculity'];
                                        echo'<form class="form-horizontal" action="uploadstudentlist.php" method="post" name="upload_excel" enctype="multipart/form-data" onSubmit="return uploadlist();">';
                                        ?>
                                        <fieldset>
                                            <legend>Select The Department To Upload Student Data List</legend>
                                            <?php
                                            $select = mysqli_query($conn,"select * from department where faculity='$faculity'");
                                            echo'<div class="form-group">';
                                            echo'<label class="control-label" for="department">Department:</label>';
                                            echo'<div class="">';
                                            echo'<select type="dropdown"  name="departmentid">';
                                            echo'<option selected>..select..</option>';
                                            while ($row = mysqli_fetch_array($select)) {
                                                $department = $row['departmentname'];
                                                $departmentid = $row['departmentid'];
                                                ?>
                                                <option value="<?php echo $departmentid; ?>"><?php echo $department; ?></option>;<?php
                                            }
                                            echo '</select>';
                                            echo '</div>';
                                            echo '<div class="">';
                                            echo '<p id="departmentid1"></p>';
                                            echo '</div>';
                                            echo '</div>';
                                            ?>

                                            <div class="form-group">
                                                <label class=" control-label" for="filebutton">Select Student list:</label>
                                                <script type="text/javascript">
                                                    $("body").on("click", "#btnUpload", function () {
                                                        var allowedFiles = [".xls", ".xlsx"];
                                                        var fileUpload = $("#fileUpload");
                                                        var lblError = $("#lblError");
                                                        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
                                                        if (!regex.test(fileUpload.val().toLowerCase())) {
                                                            lblError.html("Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.");
                                                            return false;
                                                        }
                                                        lblError.html('');
                                                        return true;
                                                    });
                                                </script>
                                                <div class="">
                                                    <input type="file" name="file" id="fileUpload"/>
                                                </div>
                                                <div class=""><span id="lblError" style="color: red;"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class=" control-label" for="singlebutton"></label>
                                                <div class="">
                                                    <button type="submit" value="import"name="import" class="btn btn- success" onclick="return uploadlist();" id="btnUpload">
                                                        <i class="fa fa-1x fa-upload"></i> Upload
                                                    </button>
                                                </div>
                                            </div>

                                        </fieldset>
                                        <?php
                                        echo'</form>';
                                        echo '</div></div>';
                                    }
                                    ?>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                        </div>
                    </div>
                    <?php 
                    include("../learn/database.php");
                    if (isset($_POST["import"])) {
                        $ok = '';
                        $error = '';
                        require 'New folder/PHPExcel/IOFactory.php';
                        if (isset($_FILES["file"])) {

                            if ($_FILES["file"]["error"] > 0) {
                                echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
                            } else {
                                if (file_exists($_FILES["file"]["name"])) {
                                    unlink($_FILES["file"]["name"]);
                                }
                                $storagename = "student/" . $_FILES["file"]["name"];
                                move_uploaded_file($_FILES["file"]["tmp_name"], $storagename);
                                $uploadedStatus = 1;
                            }
                        } else {
                            echo "No file selected <br />";
                        }
                        $exceldata = array();
                        try {
                            $objPHPExcel = PHPExcel_IOFactory::load($storagename);
                        } catch (Exception $e) {
                            die('Error loading file "' . pathinfo($storagename, PATHINFO_BASENAME) . '": ' . $e->getMessage());
                        }
                        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                        $arrayCount = count($allDataInSheet);

                        $dept = $_POST['departmentid'];
                        for ($i = 2; $i <= $arrayCount; $i++) {
                            $studentid = strtolower(trim($allDataInSheet[$i]["A"]));
                            $firstname = strtolower(trim($allDataInSheet[$i]["B"]));
                            $middlename = strtolower(trim($allDataInSheet[$i]["C"]));
                            $lastname = strtolower(trim($allDataInSheet[$i]["D"]));
                            $sex = strtolower(trim($allDataInSheet[$i]["E"]));
                            $email = strtolower(trim($allDataInSheet[$i]["F"]));
                            $year = trim($allDataInSheet[$i]["G"]);
                            $semister = trim($allDataInSheet[$i]["H"]);

                            $query = "SELECT studentid FROM student WHERE studentid = '" . $studentid . "'";
                            $sql1 = mysqli_query($conn,$query);
                            $recResult = mysqli_fetch_array($sql1);
                            $existName = $recResult["studentid"];

                            if ($existName == $studentid) {
                                $error = 'The studentid is duplicate Slect other student files';
                            } else if (!preg_match("/^[a-zA-Z'-]+$/", $firstname)) {
                                $error = "invalid first name";
                            } else if (!preg_match("/^[a-zA-Z'-]+$/", $middlename)) {
                                $error = "invalid middle name";
                            } else if (!preg_match("/^[a-zA-Z'-]+$/", $lastname)) {
                                $error = "invalid last name";
                            } else if (!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email)) {
                                $error = "invalid email Address";
                            } else if ($existName == "" && (preg_match("/^[a-zA-Z'-]+$/", $firstname) === 1) && (preg_match("/^[a-zA-Z'-]+$/", $middlename) === 1) && (preg_match("/^[a-zA-Z'-]+$/", $lastname) === 1)) {

                                $insert = "INSERT INTO student(studentid, firstname, middlename, lastname, sex, email, year, semister, departmentid, section, profile, enroll, status)"
                                        . " VALUES ('" . $studentid . "', '" . $firstname . "', '" . $middlename . "', '" . $lastname . "','" . $sex . "', '" . $email . "', '" . $year . "',  '" . $semister . "','" . $dept . "', '', '','','')";

                                if (mysqli_query($conn,$insert)) {
                                    $ok = "The student is Successfully upload to the department of " . $dept;
                                }
                            } else {
                                echo mysqli_error();
                            }
                        }
                        echo $ok;
                        echo $error;
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
    <?php include '../shared/footer.php'; ?>
</html>


