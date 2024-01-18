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
<?php
include("../learn/database.php");
require'New folder/PHPExcel.php';
require 'New folder/PHPExcel/IOFactory.php';
$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
if (isset($_POST['download'])) {
    $value = $_POST['year'];
    $departmentyear = $_POST['departmentyear'];

    $row = 3;
    $exportData = mysqli_query($conn,"select * from student where year='$value' AND departmentid ='$departmentyear'");
    while ($rowvalue = mysqli_fetch_object($exportData)) {
        $objPHPExcel->getActiveSheet()
                ->setCellValue('A' . $row, $rowvalue->studentid)
                ->setCellValue('B' . $row, $rowvalue->firstname)
                ->setCellValue('C' . $row, $rowvalue->middlename)
                ->setCellValue('D' . $row, $rowvalue->lastname)
                ->setCellValue('E' . $row, $rowvalue->sex)
                ->setCellValue('F' . $row, $rowvalue->year)
                ->setCellValue('G' . $row, $rowvalue->semister);
        $row++;
    }
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
    $objPHPExcel->getActiveSheet()
            ->setCellValue('A1', 'LIST OF STUDENTS')
            ->setCellValue('A2', 'Student_Id')
            ->setCellValue('B2', 'First_Name')
            ->setCellValue('C2', 'Middle_Name')
            ->setCellValue('D2', 'Last_Name')
            ->setCellValue('E2', 'Sex')
            ->setCellValue('F2', 'Year')
            ->setCellValue('G2', 'Semister');
    $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
    $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray(
            array('font', array(
                    'size' => 24,
                )
            )
    );
    $objPHPExcel->getActiveSheet()->getStyle('A2:G2')->applyFromArray(
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
    header('Content-Type:application/vnd.openxmlformats-officedocument-spreedsheetml.sheet');
    header('Content-Disposition: attachement ;filename = "studentlist.xlsx"');
    header('Cache-Control : max-age=0');
    $file = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $file->save('php://output');
}
?>

<html>
    <head>
        <script src="../js/depthead.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/depthead.js" type="text/javascript"></script>
        <link href="../css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/> 
        <script type="text/javascript">
            function download1() {
                var yar = document.download2.year.value;
                var semi = document.download2.semister.value;
                if (yar == '..select..') {
                    document.getElementById('year1').innerHTML = '<font color="red">Please select the year??</font>';
                    document.getElementById('semister1').innerHTML = '';
                    document.download2.year.focus();
                    return false;
                } else if (semi == '..select..') {
                    document.getElementById('semister1').innerHTML = '<font color="red">Please select the semister??</font>';
                    document.getElementById('year1').innerHTML = '';
                    document.download2.semister.focus();
                    return false;
                } else {
                    return true;
                }
            }
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
                <div class="col-sm-12 col-md-4 "> 
                    <div class="card border-info">
                        <div class="card-header bg-info">
                            <h5 class="card-title">Upload Student List</h5> 
                        </div>
                        <div class="card-body">
                            <?php
                                error_reporting(0);
                            include("../learn/database.php");
                            $query1 = mysqli_query($conn,"select * from departmenthead where departmentheadid='$userid'");
                            $row = mysqli_fetch_array($query1);
                            $department = $row['departmentid'];
                            $query = mysqli_query($conn,"select DISTINCT year from student where departmentid='$department' ORDER BY year ASC");
                            if (mysqli_num_rows($query) > 1) {
                                ?>
                                <form class="form-horizontal" role="form" method="post" action="">

                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="info"><th>Total_Number_Student</th>
                                                <th>Year</th>
                                                <th>Select</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        while ($row1 = mysqli_fetch_array($query)) {
                                            $year = $row1['year'];
                                            $query2 = mysqli_query($conn,"select * from student where departmentid='$department' AND year='$year'");
                                            $number = mysqli_num_rows($query2);
                                            echo '<tr>';
                                            echo '<td>' . $number . '  :Student</td><td>' . $year . '</td>';
                                            echo'<td><input type="radio" name="optradio" value="' . $year . '" ></td></tr>';
                                        }
                                    }
                                    ?>
                                </table>
                                <div class="form-group float-right">  
                                    <button type="submit" class="btn btn-success" name="submit">Select</button>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-8"> 
                    <div class="card border-info-primary">
                        <div class="card-header bg-info">
                            <h5 class="card-title">The Selected Student List</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            error_reporting(0);
                            include("../learn/database.php");

                            if (isset($_POST['submit'])) {
                                $optradio = $_POST['optradio'];
                                if (empty($optradio)) {
                                    echo 'PLEASE SELECET THE STUDENT TO DOWNLOAD THE STUDENT INFORMATIONS';
                                } else {
                                    ?>
                                    <form action="" method="post">
                                        <div id="print">
                                            <table class="table table-hover bg-secondary">
                                                <tr>
                                                    <td>
                                                        <div class="form-group"> 
                                                            <img src="../assets/image/logo.png" width="100" height="100">
                                                        </div> 
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-group"> 
                                                            <?php
                                                            $query3 = mysqli_query($conn,"select * from department where departmentid='$department'");
                                                            $re3 = mysqli_fetch_array($query3);
                                                            echo '<p><b>Faculity of  ' . $re3['faculity'] . '</b></p>';
                                                            echo '<p><b>Department of ' . $re3['departmentname'] . '</b></p>';
                                                            echo '<p><b> Year:  ' . $optradio . '</b></p>';
                                                            ?>
                                                        </div> 
                                                    </td>
                                                    <td>
                                                        <div class="form-group"> 
                                                            <img src="../assets/image/logo.png" width="100" height="100">
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <div class="form-group"> 
                                                <table class="table table-bordered">
                                                    <tr class="success">
                                                        <th>Student Id</th>
                                                        <th>First Name</th>
                                                        <th>Middle Name</th>
                                                        <th>Last Name</th>
                                                        <th>Sex</th>
                                                        <th>Year</th>
                                                        <th>Semister</th>
                                                    </tr>
                                                    <?php
                                                    $sql = mysqli_query($conn,"select * from student where year='$optradio' AND departmentid='$department'");
                                                    if (mysqli_num_rows($sql) > 0) {
                                                        ?>

                                                        <?php
                                                        while ($row = mysqli_fetch_array($sql)) {
                                                            $student = $row['studentid'];
                                                            $firstname = $row['firstname'];
                                                            $middlename = $row['middlename'];
                                                            $lastname = $row['lastname'];
                                                            $sex = $row['sex'];
                                                            $year = $row['year'];
                                                            $semister = $row['semister'];
                                                            ?>
                                                            <tr>
                                                                <td><?php echo strtoupper($student); ?> </td>
                                                                <td><?php echo strtoupper($firstname); ?></td>
                                                                <td><?php echo strtoupper($middlename); ?></td>
                                                                <td><?php echo strtoupper($lastname); ?></td>
                                                                <td><?php echo strtoupper($sex); ?></td>
                                                                <td><?php echo $year; ?></td>
                                                                <td><?php echo $semister; ?></td>
                                                            </tr>

                                                            <?php
                                                            echo'<input type="hidden" name="year" multiple class="form-control" value="' . $optradio . '">';
                                                            echo '<input type ="hidden" name="departmentyear" value="' . $department . '">';
                                                        }
                                                    }
                                                    ?>

                                                </table> 
                                            </div>
                                        </div> 
                                        <div class="form-group float-right">  
                                            <button  class="btn btn-primary btn-flat button-loading"  onclick="return printDiv()" >
                                                <i class="fa fa-1x fa-print"></i> Print
                                            </button>
                                            <button type="submit"name="download" class="btn btn-success btn-flat button-loading">
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
    <?php include '../shared/footer.php'; ?>
</html>



