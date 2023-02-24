<?php
// session_start();
function Redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);
    exit();
}
function IsUserLoggedIN()
{
  // print_r($_SESSION["user_id"]);
  return isset($_SESSION["user_id"]) ? true : false;
}

//Date validation 
function validateDate($startDate, $endDate, &$errors)
{
  // Darf nicht leer gelasssen werden
  if($startDate == '')
    $errors['startdate-error'] = "Start Datum darf nicht leer gelassen werden";

  if($endDate == '')
    $errors['enddate-error'] = "End Datum darf nicht leer gelassen werden";

  // Der Start sowie der End Datum sollen nicht im Vergangenheit legen

  $startDateUnix = strtotime($startDate);
  $endDateUnix = strtotime($endDate);
  $currentTime = time();

  if($currentTime > $startDateUnix)
    $errors['startdate-error'] = "Start Datum kann nicht im Vergangenheit legen";
  if($currentTime > $endDateUnix)
    $errors['enddate-error'] = "End Datum kann nicht im Vergangenheit legen";

  // End Datum darf niht vor StartDatum sein
  if($startDateUnix > $endDateUnix)
    $errors['enddate-error'] = "End Datum liegt vor das Start Datum";
}