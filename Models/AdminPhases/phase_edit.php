<?php
require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';

$projID = $_GET['id'];
$redirectAfter = "Location: ../../Pages/Admin/ProjectDetails/projectpage.php?id=".$projID;
$formFilled = isset($_POST['phasetitle']) && isset($_POST['phasedescription']) && isset($_POST['expectedfinishdate']) && isset($_POST['actualfinishdate'] );
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"] == "POST" && $formFilled) {
    $projID = $_GET['id'];
    $phaseId = $_GET['phaseid'];
    $phasetitle = $_POST['phasetitle'];
    $phasedescription = $_POST['phasedescription'];
    $expectedfinishdate = nullChecker($_POST['expectedfinishdate']);
    $actualfinishdate = nullChecker($_POST['actualfinishdate']);
    $isFinished = ($actualfinishdate == NULL) ? 0 : 1;


    $save = $conn->prepare("UPDATE phase SET phasetitle = ?, phasedescription = ?, expectedfinishdate = ?, isFinished = ?, actualfinishdate = ? WHERE phaseId = ?");
    $save->bind_param("sssisi", $phasetitle, $phasedescription, $expectedfinishdate, $isFinished, $actualfinishdate, $phaseId);

    if ($save->execute()) {
        $save->close();
        $conn->close();
        header($redirectAfter);
        exit();
    } else {
        echo "Error updating phase: " . $conn->error;
        exit();
    }
}

function nullChecker($var){
    if(empty($var) || $var == ''){
        return NULL;
    }else{
        return $var;
    }

}

?>
