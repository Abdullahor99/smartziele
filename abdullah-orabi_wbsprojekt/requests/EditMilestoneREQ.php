<?php 

function handleSaveMilestoneREQ($db, $goalID)
{
  $MilestoneName = $_POST['MeilensteinName'] ?? '';
  $startDate = $_POST['startdatum'] ?? '';
  $endDate = $_POST['enddatum'] ?? ''; 
  

  //1 soll nicht leer sein
  $words = explode(" ", $MilestoneName);
  if($MilestoneName == '' || count($words) < 2)
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
    CreateMilestone($db, $goalID, $MilestoneName, $startDate, $endDate);
  }
  return $error;
}