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
//for Bursar Info
$bursarArray = ""; //array of name, rin, and amount due
$stmt = "SELECT firstName,lastName,rin,outstandingBalance FROM users GROUP BY rin ASC";
make_query($conn,$stmt,$bursarArray,"Row");
//=====================================================================
//get date time for name convention
date_default_timezone_set('America/New_York');
$current_date = date('m-d-Y');
//=================================================================================================
//generate Spreadsheet based for Bursar
$inputFileName = 'assets/Forge_Accounts_Receivable_Template.xlsx';

// Load $inputFileName to a Spreadsheet object
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

//parse generated array
$titleDate = "Generated ";
$titleDate .= date('m-d-Y');

//point spreadsheet at new location
$spreadsheet->getActiveSheet()->setCellValue('A2', $titleDate);

$count = 5;
foreach($bursarArray as $row) {
    //formatting
    $fullName = $row['firstName'];
    $fullName .= " ";
    $fullName .= $row['lastName'];

    $cell_A = "A";
    $cell_A .= $count;
    $cell_B = "B";
    $cell_B .= $count;
    $cell_C = "C";
    $cell_C .= $count;

    $spreadsheet->getActiveSheet()->setCellValue($cell_A, $fullName);
    $spreadsheet->getActiveSheet()->setCellValue($cell_B, $row['rin']);
    $spreadsheet->getActiveSheet()->setCellValue($cell_C, $row['outstandingBalance']);

    $count++;
    $cell_A = "";
    $cell_B = "";
    $cell_C = "";
}

//print new document
$fileName = "Forge_Accounts_Receivable";
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
