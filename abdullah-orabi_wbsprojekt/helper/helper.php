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
function validateDate($startDate, $endDate, &$error)
{
  // Der Start sowie der End Datum sollen nicht im Vergangenheit legen
  $startDateUnix = strtotime($startDate);
  $endDateUnix = strtotime($endDate);
  $currentTime = time();

  if($currentTime > $startDateUnix ||
    $currentTime > $endDateUnix)
      $error = true;

  // End Datum darf niht vor StartDatum sein
  if($startDateUnix > $endDateUnix)
    $error = true;
}