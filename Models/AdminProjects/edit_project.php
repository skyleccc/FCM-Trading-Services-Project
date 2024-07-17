<?php
require '../../Controllers/accessDatabase.php';
require '../../Controllers/loginCheck.php';


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {

    function nullChecker($var){
        if(empty($var) || $var == ''){
            return NULL;
        }else{
            return $var;
        }
    
    }

    // PROJECT ID
    $projectId = $_POST['id'];
    // POST VARIABLES
    $projectname = $_POST['projectname'];
    $projectScope = $_POST['projectScope'];
    $projecttype = $_POST['servicetype'];
    $workarea = $_POST['workarea'];
    $projectDetails = $_POST['projectDetails'];
    $specialRequests = $_POST['specialRequests'];
    $deadlineDate = nullChecker($_POST['deadlineDate']);
    $startdate = nullChecker($_POST['startdate']);
    $completiondate = nullChecker($_POST['completiondate']);
    $budgetConstraint = isset($_POST['budgetConstraint']) ? $_POST['budgetConstraint'] : null;
    $isComplete = 0;

    if(empty($completiondate) || $completiondate == null){
        $isComplete = 0;
    }else{
        $isComplete = 1;
    }

    $sqlUpdateProj = "UPDATE project SET projectName = ?, projectType = ?, projectDetails = ?, startDate = ?, deadlineDate = ?, budgetConstraint = ?, workArea = ?, isComplete = ?, completionDate = ?, projectScope = ? WHERE projectID = ?";

    $updateProjQuery = $conn->prepare($sqlUpdateProj);
    $updateProjQuery->bind_param("sssssiiissi", $projectname, $projecttype, $projectDetails, $startdate, $deadlineDate, $budgetConstraint, $workArea, $isComplete, $completiondate, $projectScope, $projectId);
    if($updateProjQuery->execute()){
        echo '<script>console.log("Update Success.")</script>';
    }else{
        echo '<script>console.log("Failed to update.")</script>';
    }

}
?>
