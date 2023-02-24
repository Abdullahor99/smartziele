<?php 

function handleSaveGoalREQ($db)
{
  $goalName = $_POST['zielname'];
  $startDate = $_POST['startdatum'];
  $endDate = $_POST['enddatum'];

  //1 soll nicht leer sein 
  $errors = [];
  if($goalName == '')
    $errors['goal-name-error'] = "Ziel Name darf nicht leer gelassen werden";
  // soll zumindes 2 wörter beinthalten 
  $words = explode(" ", $goalName);
  if(count($words) < 2)
    $errors['goal-name-error'] = "Ein Ziel soll zumindest zwei wörter haben";

  //Start & Enddate Validation 
  //1 start & End Datum sollen nicht leer gelassen werden
  validateDate($startDate,$endDate,$errors);

  if(!$errors)
  {
    // alles ist Gut es gibt keine Validierung Fehler 
    //1 Der Ziel in der Daten Banke speichern
    CreateGoal($db, $_SESSION['user_id'], $goalName, $startDate, $endDate);

  }

  // echo "<pre>";
  // print_r($_SESSION);
  // echo "</pre>";
  
}