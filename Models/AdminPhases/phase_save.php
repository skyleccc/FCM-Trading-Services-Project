<?php
require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';

// File Redirect
$redirectAfter = "/../../Pages/Admin/ProjectDetails/projectpage.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $projectid = $_GET['projectid'];
    $phasetitle = $_POST['phasetitle'];
    $phasedescription = $_POST['phasedescription'];
    $expectedfinishdate = nullChecker($_POST['expectedfinishdate']);
    $actualfinishdate = nullChecker($_POST['actualfinishdate']);

        $temp = $conn->prepare("INSERT INTO phase (phasetitle, phasedescription, expectedfinishdate, actualfinishdate, projectid) VALUES (?, ?, ?, ?,?)");
        $temp->bind_param("ssssi", $phasetitle, $phasedescription, $expectedfinishdate, $actualfinishdate, $projectid);

        if ($temp->execute()) {
            header('Location:'.$redirectAfter.'?id='.$projectid);
            exit;
        } else {
            $temp->error;
        }

    $temp->close();
    $conn->close();
}


function nullChecker($var){
    if(empty($var) || $var == ''){
        return NULL;
    }else{
        return $var;
    }

}
?>
