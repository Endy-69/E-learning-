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
                            <a href="uploadstudentlistd.php" title="This Is Upload Studentlistd To The Assign Instructor">Student Listd</a>
                            <a href="uploadnotice.php" title="This Is Upload Notice To The Department Society">Notice</a>
                        </div>
                    </li>
                    <li class="tab">
                        <a class="navbar-link" href="assigninstructor.php" title="This Is Assign Instructor To The Regiter Course List">
                            <i class="fa fa-1x fa">Assign Instructor</i>
                        </a>
                    </li>
                    <li class="tab">
                        <a class="navbar-link" href="../depthead/createaccount.php" title="This Is Create Account To The Department Student">
                            <i class="fa fa-1x fa">Create Account</i>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="tab">
                        <a class="navbar-link" href="../learn/logout.php" title="This Is Leave From The Homepage"> 
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
                        <div class="card-header bg-info">Studentlist For Theses Department Are</div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="info"><th>Student_Id</th>
                                        <th>First_Name</th>
                                        <th>Middle_Name</th>
                                        <th>Last_Name</th>
                                        <th>Year</th>

                                    </tr></thead>
                                <?php
                                include("../learn/database.php");
                                $query = mysqli_query($conn,"select * from departmenthead where departmentheadid='$userid'");
                                $row = mysqli_fetch_array($query);
                                $department = $row['departmentid'];
                                $query2 = mysqli_query($conn,"select * from student where departmentid='$department' AND section=0 ORDER BY year ASC");
                                while ($row1 = mysqli_fetch_array($query2)) {
                                    $studentid = $row1['studentid'];
                                    echo '<tr>';
                                    echo '<td>' . $studentid . '</td><td>' . $row1['firstname'] . '</td><td>' . $row1['middlename'] . '</td><td>' . $row1['lastname'] . '</td><td>' . $row1['year'] . '</td></tr>';
                                }
                                ?>
                            </table>
                        </div>
                    </div> 
                    <div class="card border-info">
                        <div class="card-header bg-info">THESE STUDENT LIST CAN BE ALLREADY UPLOADED</div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="info"><th>Student_Id</th>
                                        <th>First_Name</th>
                                        <th>Middle_Name</th>
                                        <th>Last_Name</th>
                                        <th>Year</th>
                                        <th>Hide</th>
                                    </tr>
                                </thead>
                                <?php
                                $querylist = mysqli_query($conn,"select * from student where departmentid='$department' AND section!= 0 ORDER BY year ASC");
                                while ($row1list = mysqli_fetch_array($querylist)) {
                                    $studentid = $row1list['studentid'];

                                    echo '<tr>';
                                    echo '<td>' . $studentid . '</td><td>' . $row1list['firstname'] . '</td><td>' . $row1list['middlename'] . '</td><td>' . $row1list['lastname'] . '</td><td>' . $row1list['year'] . '</td>';
                                    echo'<td><a href= uploadstudentlistd.php?ids=' . $studentid . '>hide</a></td></tr>';
                                }
                                ?>
                            </table>
                        </div>
                    </div> 
                    <?php
                    if (isset($_GET['ids'])) {
                        $ids = $_GET['ids'];
                        mysqli_query($conn,"update student set status= 1 where studentid='$ids'");
                    }
                    ?>
                </div>

                <div class="col-sm-12 col-md-6"> 
                    <div class="card border-info">
                        <div class="card-header bg-info">Upload student list to each sections</div>
                        <div class="card-body">
                            <form class="form-horizontal" action="uploadstudentlistd.php" method="post" name="upload_excel" enctype="multipart/form-data" onsubmit="return studentlist();">
                                <?php
                                $select = mysqli_query($conn,"select * from departmenthead where departmentheadid='$userid'");
                                $row = mysqli_fetch_array($select);
                                $department = $row['departmentid'];
                                ?>
                                <script>
                                    $(function () {

                                        $('.number-only').keypress(function (e) {
                                            if (isNaN(this.value + "" + String.fromCharCode(e.charCode)))
                                                return false;
                                        })
                                                .on("cut copy paste", function (e) {
                                                    e.preventDefault();
                                                });

                                    });
                                </script>
                                <div class="form-group">
                                    <label class="control-label" for="section">Section:</label> 
                                    <input class="number-only"type="text" name="section" id="section1"> 
                                    <p id="section1"> </p>  
                                </div>
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
                                <div class="form-group">
                                    <label class="control-label" for="filebutton">Select Student list:</label>
                                    <input type="file" name="file" id="fileUpload"/> 
                                    <div><span id="lblError" style="color: red;"></span></div>
                                </div>
                                <input type="hidden" name="department" value="<?php echo $department; ?>">
                                <div class="form-group">
                                    <label class="control-label" for="singlebutton"></label>
                                    <button type="submit" value="import"name="import" class="btn btn-primary"id="btnUpload" onchange="return studentlist();"><i class="fa fa-1x fa-upload">Upload</i></button>
                                </div> 
                            </form>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['import'])) {
                        $dept = $_POST['department'];
                        $section = $_POST['section'];
                        $ok = '';
                        $error = '';
                        require 'New folder/PHPExcel/IOFactory.php';
                        if (empty($section)) {
                            echo '<font color="red">Please fill the Student Section??</font>';
                        } else {
                            if ($section == 0) {
                                echo 'the section is limited to greater value 0';
                            } else {
                                if (isset($_FILES["file"])) {

                                    if ($_FILES["file"]["error"] > 0) {
                                        echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
                                    } else {
                                        if (file_exists($_FILES["file"]["name"])) {
                                            unlink($_FILES["file"]["name"]);
                                        }
                                        $storagename = "studentlist/" . $_FILES["file"]["name"];
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
                                $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet


                                for ($i = 2; $i <= $arrayCount; $i++) {
                                    $studentid = strtolower(trim($allDataInSheet[$i]["A"]));
                                    $firstname = strtolower(trim($allDataInSheet[$i]["B"]));
                                    $middlename = strtolower(trim($allDataInSheet[$i]["C"]));
                                    $lastname = strtolower(trim($allDataInSheet[$i]["D"]));
                                    $sex = strtolower(trim($allDataInSheet[$i]["E"]));
                                    if (!preg_match("/^[a-zA-Z'-]+$/", $firstname)) {
                                        $error = "invalid first name";
                                    } else if (!preg_match("/^[a-zA-Z'-]+$/", $lastname)) {
                                        $error = "invalid last name";
                                    } else if ((preg_match("/^[a-zA-Z'-]+$/", $firstname) === 1) && (preg_match("/^[a-zA-Z'-]+$/", $lastname) === 1)) {
                                        $select = mysqli_query($conn,"select * from student where studentid='$studentid' AND departmentid='$dept' AND firstname = '$firstname' AND lastname='$lastname' AND middlename='$middlename'");
                                        if (mysqli_num_rows($select) >= 1) {

                                            $insert = "UPDATE student set section='$section' where studentid='$studentid' AND firstname='$firstname' AND lastname ='$lastname' AND middlename='$middlename' AND departmentid='$dept'";
                                            if (mysqli_query($conn,$insert)) {
                                                $ok = "The student is Successfully upload to the department of " . $dept;
                                            }
                                        }
                                    } else {
                                        echo mysqli_error();
                                    }
                                }
                                echo $ok;
                                echo $error;
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
    <?php include '../shared/footer.php'; ?>
</html>

