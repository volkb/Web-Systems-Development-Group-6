<?php require_once 'controllers/auth_controller.php';?>
<?php
require_once 'vendor/autoload.php';
require_once 'controllers/functions.php';
require_once "controllers/db_connector.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/*
 * =========================================================
 * example spreadsheet creation and useage
 * Credit: https://phpspreadsheet.readthedocs.io/en/develop/
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');

$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');
 * ==========================================================
*/

//Pull All needed info from the database
$conn = dbConnect();

//=============Set Variables Needed================================
$stmt = "";
//for machine stats
$machineUses = ""; //array of MachineName,Count
$stmt = "SELECT machine,COUNT(machine) AS numUses FROM projects GROUP BY machine ORDER BY pid DESC";
make_query($conn,$stmt,$machineUses,"Row");

//for space usage
$mostPopularMachine = "";
$stmt = "SELECT machine FROM projects GROUP BY machine ORDER BY pid DESC LIMIT 1";
make_query($conn,$stmt,$mostPopularMachine,"Column");

$leastPopularMachine = "";
$stmt = "SELECT machine FROM projects GROUP BY machine ORDER BY pid ASC LIMIT 1";
make_query($conn,$stmt,$leastPopularMachine,"Column");

$mostPopularFilament = "";
$stmt = "SELECT `plasticBrand`,COUNT(`plasticBrand`) FROM `projects` GROUP BY `plasticBrand` ORDER BY `machine` DESC LIMIT 1";
make_query($conn,$stmt,$mostPopularFilament,"Column");

$leastPopularFilament = "";
$stmt = "SELECT `plasticBrand`,COUNT(`plasticBrand`) FROM `projects` GROUP BY `plasticBrand` ORDER BY `machine` ASC LIMIT 1";
make_query($conn,$stmt,$leastPopularFilament,"Column");

$mostPopularColor = "";
$stmt = "SELECT `plasticColor`,COUNT(`plasticColor`) FROM `projects` GROUP BY `plasticColor` ORDER BY `plasticColor` ASC LIMIT 1";
make_query($conn,$stmt,$mostPopularColor,"Column");

$leastPopularColor = "";
$stmt = "SELECT `plasticColor`,COUNT(`plasticColor`) FROM `projects` GROUP BY `plasticColor` ORDER BY `plasticColor` DESC LIMIT 1";
make_query($conn,$stmt,$leastPopularColor,"Column");

$numPrints = "";
$stmt = "SELECT COUNT(pid) FROM projects";
make_query($conn,$stmt,$numPrints,"Column");

$totalVolume = "";
$stmt = "SELECT SUM(amount) FROM projects";
make_query($conn,$stmt,$totalVolume,"Column");
$totalVolume .= "g/ml";

//for Leaderboards
$topBrands = "";//array of brand names[5]
$stmt = "SELECT `plasticBrand`,COUNT(`plasticBrand`) AS pCount FROM `projects` GROUP BY `plasticBrand` ORDER BY `machine` DESC LIMIT 5";
make_query($conn,$stmt,$topBrands,"Row");

$topColor = "";
$stmt = "SELECT `plasticColor`,COUNT(`plasticColor`) AS pCount FROM `projects` GROUP BY `plasticColor` ORDER BY `plasticColor` ASC LIMIT 5";
make_query($conn,$stmt,$topColor,"Row");

$topMachines = "";
$stmt = "SELECT machine,COUNT(machine) AS pCount FROM projects GROUP BY machine ORDER BY pid DESC LIMIT 5";
make_query($conn,$stmt,$topMachines,"Row");

//for user stats
$totalMembers = "";
$stmt = "SELECT COUNT(rin) FROM users";
make_query($conn,$stmt,$totalMembers,"Column");

$totalVolunteers = "";
$stmt = "SELECT COUNT(rin) FROM users WHERE type = \"volunteer\" OR type = \"admin\" OR type = \"TA\"";
make_query($conn,$stmt,$totalVolunteers,"Column");

$numMales = "";
$stmt = "SELECT COUNT(gender) FROM users WHERE gender = \"male\" OR gender = \"m\"";
make_query($conn,$stmt,$numMales,"Column");
$numFemales = "";
$stmt = "SELECT COUNT(gender) FROM users WHERE gender = \"female\" OR gender = \"f\" OR gender = \"femail\"";
make_query($conn,$stmt,$numFemales,"Column");
$numOther = "";
$stmt = "SELECT COUNT(gender) FROM users WHERE gender != \"male\" AND gender != \"m\" AND gender != \"female\" AND gender != \"femail\" AND gender != \"f\""; //also handles null case
make_query($conn,$stmt,$numOther,"Column");

$MajorArray = ""; //array of Major,Count
$stmt = "SELECT major, COUNT(major) AS mCount from users GROUP BY major DESC";
make_query($conn,$stmt,$MajorArray,"Row");

//for Bursar Info
$bursarArray = ""; //array of name, rin, and amount due
$stmt = "SELECT firstName,lastName,rin,outstandingBalance FROM users GROUP BY rin ASC";
make_query($conn,$stmt,$bursarArray,"Row");
//=====================================================================

//get date time for name convention
date_default_timezone_set('America/New_York');
$current_date = date('m-d-Y__H_i_s');

//generate reports
$inputFileName = 'assets/StatsTemplate.xlsx';

// Load $inputFileName to a Spreadsheet object
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

//write values to template
//for $machineUses
$count = 2;
foreach($machineUses as $row) {
    $cell_A = "A";
    $cell_A .= $count;
    $cell_B = "B";
    $cell_B .= $count;
    $spreadsheet->getActiveSheet()->setCellValue($cell_A, $row['machine']);
    $spreadsheet->getActiveSheet()->setCellValue($cell_B, $row['numUses']);
    $count++;
    $cell_A = "";
    $cell_B = "";
}

//for Space Usage
$spreadsheet->getActiveSheet()->setCellValue('D2', $mostPopularMachine);
$spreadsheet->getActiveSheet()->setCellValue('D3', $leastPopularMachine);

$spreadsheet->getActiveSheet()->setCellValue('D5', $mostPopularFilament);
$spreadsheet->getActiveSheet()->setCellValue('D6', $leastPopularFilament);

$spreadsheet->getActiveSheet()->setCellValue('D8', $mostPopularColor);
$spreadsheet->getActiveSheet()->setCellValue('D9', $leastPopularColor);

$spreadsheet->getActiveSheet()->setCellValue('D11', $numPrints);
$spreadsheet->getActiveSheet()->setCellValue('D12', $totalVolume);

//for Leaderboards
$count = 3;
foreach($topBrands as $row) {
    $cell_F = "F";
    $cell_F .= $count;
    $spreadsheet->getActiveSheet()->setCellValue($cell_F, $row['plasticBrand']);
    $count++;
    $cell_F = "";
}

$count = 9;
foreach($topColor as $row) {
    $cell_F = "F";
    $cell_F .= $count;
    $spreadsheet->getActiveSheet()->setCellValue($cell_F, $row['plasticColor']);
    $count++;
    $cell_F = "";
}

$count = 15;
foreach($topMachines as $row) {
    $cell_F = "F";
    $cell_F .= $count;
    $spreadsheet->getActiveSheet()->setCellValue($cell_F, $row['machine']);
    $count++;
    $cell_F = "";
}

//for Users
$spreadsheet->getActiveSheet()->setCellValue('I2', $totalMembers);
$spreadsheet->getActiveSheet()->setCellValue('I3', $totalVolunteers);
$spreadsheet->getActiveSheet()->setCellValue('I7', $numMales);
$spreadsheet->getActiveSheet()->setCellValue('I8', $numFemales);
$spreadsheet->getActiveSheet()->setCellValue('I9', $numOther);

//for Majors
$count = 2;
foreach($MajorArray as $row) {
    $cell_J = "J";
    $cell_J .= $count;
    $cell_K = "K";
    $cell_K .= $count;
    $spreadsheet->getActiveSheet()->setCellValue($cell_J, $row['major']);
    $spreadsheet->getActiveSheet()->setCellValue($cell_K, $row['mCount']);
    $count++;
    $cell_A = "";
    $cell_B = "";
}

//save the file
$fileName = "Forge Stats";
write_log($fileName);
$fileName .= $current_date.".xlsx";
$writer = new Xlsx($spreadsheet);
$writer->save($fileName);


function make_query($conn,$stmt,&$result, $rowOrColumn){//passing by reference is need to avoid Scope Drop Errors
    $temp = $conn->prepare($stmt);
    $temp->execute();
    if($rowOrColumn == "Row"){//array result
        $result = $temp->fetchAll(PDO::FETCH_ASSOC);
    }else{//Column Result
        $result = $temp->fetchColumn();
    }
    return;
}
?>
<?php
?>

<!-- Now we simply download the newly created file -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    setTimeout(function() {

        url = "<?php echo $fileName ?>";
        downloadFile(url);
        document.location.href = "scripts/delete.php";

    }, 2000);


    window.downloadFile = function (sUrl) {

        //iOS devices do not support downloading. We have to inform user about this.
        if (/(iP)/g.test(navigator.userAgent)) {
            alert('Your device does not support files downloading. Please try again in desktop browser.');
            window.open(sUrl, '_blank');
            return false;
        }

        //If in Chrome or Safari - download via virtual link click
        if (window.downloadFile.isChrome || window.downloadFile.isSafari) {
            //Creating new link node.
            var link = document.createElement('a');
            link.href = sUrl;
            link.setAttribute('target','_blank');

            if (link.download !== undefined) {
                //Set HTML5 download attribute. This will prevent file from opening if supported.
                var fileName = sUrl.substring(sUrl.lastIndexOf('/') + 1, sUrl.length);
                link.download = fileName;
            }

            //Dispatching click event.
            if (document.createEvent) {
                var e = document.createEvent('MouseEvents');
                e.initEvent('click', true, true);
                link.dispatchEvent(e);
                return true;
            }
        }

        // Force file download (whether supported by server).
        if (sUrl.indexOf('?') === -1) {
            sUrl += '?download';
        }

        window.open(sUrl, '_blank');
        return true;
    };

    window.downloadFile.isChrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
    window.downloadFile.isSafari = navigator.userAgent.toLowerCase().indexOf('safari') > -1;
</script>
