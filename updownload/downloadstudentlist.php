<?php
session_start();
include("../learn/database.php");
if (isset($_SESSION['userid']) && ($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $userid = $_SESSION['userid'];
    $select = mysqli_query($conn,"select * from instructor where instructorid='$userid'");
    $row = mysqli_fetch_array($select);
    $department = $row['departmentid'];
} else {
    header("Location: ../learn/login.php");
}
?>


<?php
include '../learn/database.php'; 
require 'New folder/PHPExcel.php';
require 'New folder/PHPExcel/IOFactory.php';
$excel = new PHPExcel();
$excel->setActiveSheetIndex(0); 
if (isset($_POST['download'])) {
    $section = $_POST['section'];
    $rowtab = 3;
    $selectc_code = mysqli_query($conn,"select coursecode from courseinstructor where instructorid='$userid' AND section='$section'");
    while ($row4 = mysqli_fetch_array($selectc_code)) {
        $c_code = $row4['coursecode'];
        $select_student = mysqli_query($conn,"select studentid from coursestudent where coursecode='$c_code'");
        while ($row5 = mysqli_fetch_array($select_student)) {
            $studentid = $row5['studentid'];
            $exportData = mysqli_query($conn,"select * from student where departmentid='$department' AND studentid='$studentid' AND section='$section'");
            $rowvalue = mysqli_fetch_array($exportData);

            $excel->getActiveSheet()
                    ->setCellValue('A' . $rowtab, $rowvalue['studentid'])
                    ->setCellValue('B' . $rowtab, $rowvalue['firstname'])
                    ->setCellValue('C' . $rowtab, $rowvalue['middlename'])
                    ->setCellValue('D' . $rowtab, $rowvalue['lastname'])
                    ->setCellValue('E' . $rowtab, $rowvalue['sex']);
            $rowtab++;
        }
    }
    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $excel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
    $excel->getActiveSheet()
            ->setCellValue('A1', 'LIST OF STUDENTS')
            ->setCellValue('A2', 'Student_Id')
            ->setCellValue('B2', 'First_Name')
            ->setCellValue('C2', 'Middle_Name')
            ->setCellValue('D2', 'Last_Name')
            ->setCellValue('E2', 'Sex');
    $excel->getActiveSheet()->mergeCells('A1:E1');
    $excel->getActiveSheet()->getStyle('A1')->applyFromArray(
            array('font', array(
                    'size' => 24,
                )
            )
    );
    $excel->getActiveSheet()->getStyle('A2:E2')->applyFromArray(
            array(
                'font' => array(
                    'bold' => true
                ),
                'border' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
    );
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="studentlistforinstructor.xlsx"');
    header('Cache-Control: max-age=0');
    $file = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $file->save('php://output');
    exit;
}
?>

<html>
    <head>
        <script src="../js/depthead.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/innstructor.js" type="text/javascript"></script>
        <link href="../css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/> 
        <script type="text/javascript">
            function printDiv() {
                var printContents = document.getElementById("print").innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
                return true;
            }
        </script>
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
                        <a class="navbar-link" href="../instructor/instructor.php" title="This is Home Page Of Instructor">
                            <i class="fa fa-1x fa">Home</i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This is Upload Resource To The Student"> 
                            <i class="fa fa-1x fa">Upload</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="uploadcoursematerial.php" title="This is upload Resource Material To The Department Student"> Course Material</a>
                            <a href="uploadassignmentquestion.php"title="This is Assignment Question To The Student">Assignment Question</a>
                            <a href="../instructor/uploadexam.php" title="This is Evaluation Exam To The Course Student"> Exam</a>
                            <a href="../instructor/uploadcourseresult.php"title="This is Upload Student Result To The Student For The Course">Course Result</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This is Download Resource Material ">
                            <i class="fa fa-1x fa"> Download</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="downloadannualcalendar.php" title="This is Download The Caricullem Calendar From The Registrar Officer">Annual Calendar</a>
                            <a href="downloadstudentlist.php" title="This is Download Student List From The Department"> Student List</a>
                            <a href="downloadassignmentanswer.php" title="This is Download Assignment Answer Upload By The Student">Assignment Answer</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="navbar-link" href="" title="This is View Notice Page Release From The Department"> 
                            <i class="fa fa-1x fa">View</i>
                        </a>
                        <div class="dropdown-content dropdown-menu">
                            <a href="viewnotice.php"> Notice</a>
                        </div>
                    </li>  
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="tab">
                        <a class="navbar-link" href="../learn/logout.php" title="This is Leave From The Home Page Of Instructor"> 
                            <i class="fa fa-1x fa-sign-out">Logout</i>
                        </a>
                    </li>
                </ul>
            </div> 
        </nav>
         <!--body  -->
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-4"> 
                    <div class="card border-info">
                        <div class="card-header bg-info">
                            <h5 class="card-title">Please select the select bouton</h5>
                        </div>
                        <div class="card-body">
                            <form action=""method="post">
                                <table class="table table-bordered">

                                    <tr class="success"><th>Total_no_Student</th>
                                        <th>Section</th>
                                        <th>Select</th>
                                    </tr>
                                    <?php
                                    error_reporting(0);
                                    include '../learn/database.php';
                                    $select = mysqli_query($conn,"select * from courseinstructor where instructorid='$userid'");
                                    while ($row = mysqli_fetch_array($select)) {
                                        $coursecode = $row['coursecode'];
                                        $section = $row['section'];
                                        $query = mysqli_query($conn,"select * from student where section='$section' AND departmentid='$department'");
                                        if (mysqli_num_rows($query) >= 1) {
                                            $total = 0;
                                            while ($row2 = mysqli_fetch_array($query)) {
                                                $studentid = $row2['studentid'];

                                                $select1 = mysqli_query($conn,"select * from coursestudent where coursecode='$coursecode' AND studentid='$studentid'");
                                                if (mysqli_num_rows($select1) >= 1) {
                                                    $number = mysqli_num_rows($select1);
                                                    $total = $total + $number;
                                                }
                                            }
                                            echo'<tr>';
                                            echo'<td>' . $total . '</td><td>' . $section . '</td>';
                                            echo'<td><input type="radio" name="optradio" value="' . $section . '" ></td></tr>';
                                        }continue;
                                    }
                                    ?>  
                                </table>
                                <div class="form-group"> 
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-success" name="submit">Select</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> 
                </div>
                <div class="col-sm-12 col-md-8">
                    <div class="card border-info">
                        <div class="card-header bg-info">The selected student list are listed below; you can download and print it.</div>
                        <div class="card-body">
                            <?php 
                                include("../learn/database.php");
                                if (isset($_POST['submit'])) {
                                    $section1 = $_POST['optradio'];
                                    if (empty($section1)) {
                                        echo 'Please select the student to download the student informations';
                                    } else {
                                        ?>
                                        <form action="" method="post">
                                            <div id="print">
                                                <table class="table table-striped">
                                                    <tr>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="col-sm-12">
                                                                    <img src="../assets/image/logo.png" width="100" height="90">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="col-sm-12 text-center">
                                                                    <?php
                                                                    $query3 = mysqli_query($conn,"select * from department where departmentid='$department'");
                                                                    $re3 = mysqli_fetch_array($query3);
                                                                    echo '<p><b>Faculity of : ' . strtoupper($re3['faculity']) . '</b></p>';
                                                                    echo '<p><b>Department of : ' . strtoupper($re3['departmentname']) . '</b></p>';
                                                                    echo '<p><b> Section :  ' . $section1 . '</b></p>';
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="col-sm-12">
                                                                    <img src="../assets/image/logo.png" width="100" height="90">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table class="table table-bordered">
                                                    <tr class="success">
                                                        <th>Student Id</th>
                                                        <th>Full_name</th>
                                                        <th>Sex</th>
                                                    </tr>
                                                    <?php
                                                        $select10 = mysqli_query($conn,"select DISTINCT  coursecode from courseinstructor where instructorid='$userid' AND section='$section1'");
                                                        while ($row1 = mysqli_fetch_array($select10)) {
                                                            $coursecode2 = $row1['coursecode'];

                                                            $select2 = mysqli_query($conn,"select DISTINCT studentid from coursestudent where coursecode='$coursecode2'");
                                                            while ($row3 = mysqli_fetch_array($select2)) {
                                                                $student = $row3['studentid'];
                                                                $sql = mysqli_query($conn,"select * from student where section = '$section1' AND departmentid='$department' AND studentid='$student'");

                                                                $row10 = mysqli_fetch_array($sql);
                                                                $full = $row10['firstname'] . '   ' . $row10['middlename'] . '   ' . $row10['lastname'];
                                                                echo '<tr>';
                                                                echo '<td>' . strtoupper($row10['studentid']) . '</td> <td>' . strtoupper($full) . '</td><td>' . strtoupper($row10['sex']) . '</td>';
                                                            }
                                                        }
                                                    ?>
                                                </table>
                                            </div>
                                            <div class="float-right">
                                                <input type="hidden" name="section" value="<?php echo $section1; ?>">
                                                <button  class="btn btn-success btn-flat button-loading" onclick="return printDiv()">
                                                    <i class="fa fa-1x fa-print"></i> Print
                                                </button>
                                                <button type="submit" name="download" class="btn btn-default btn-flat button-loading">
                                                    <i class="fa fa-1x fa-download"></i> Download
                                                </button>
                                            </div> 
                                        </form>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
    </body>
    <?php include '../shared/footer.php';?>
</html>


