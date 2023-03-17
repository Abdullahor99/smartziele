<?php 

function handleSaveGoalREQ($db)
{
  $goalName = $_POST['zielname'] ?? '';
  $startDate = $_POST['startdatum'] ?? '';
  $endDate = $_POST['enddatum'] ?? ''; 

  //1 soll nicht leer sein
  $words = explode(" ", $goalName);
  if($goalName == '' || count($words) < 2)
  {
    $error = true;
    return $error;
  }
    

  //Start & Enddate Validation 
  //1 start & End Datum sollen nicht leer gelassen werden
  validateDate($startDate,$endDate,$error);
  if($error)
    return $error;

  
  if(!$error)
  {
    // alles ist Gut es gibt keine Validierung Fehler 
    //1 Der Ziel in der Daten Banke speichern

    CreateGoal($db, $_SESSION['user_id'], $goalName, $startDate, $endDate);

  }

  echo "<pre>";
  print_r($_SESSION);
  echo "</pre>";
  return $error;
}