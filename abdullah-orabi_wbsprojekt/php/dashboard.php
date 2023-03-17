<?php
require '../db/ConnectDB.php';
require '../helper/helper.php';
require '../DB_CRUD/TheGoalCRUD.php';
require '../DB_CRUD/TheMilestoneCRUD.php';

session_start();
$db = connectToDatabase();
$action = $_POST["action"] ?? '';

$totalGoals = getGoalsFromDB($db);
$doneGoals = 0;
if(count($totalGoals) >= 1)
{
  foreach($totalGoals as $goal)
  if($goal['progress'] >= 100)
    $doneGoals++;
}

$totalMilestones = getMilestonesFromDB($db);
$doneMilestones = 0;
if(count($totalMilestones) >= 1)
{
  foreach($totalMilestones as $Milestone)
  if($Milestone['done'] == 1)
    $doneMilestones++;
}

  
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  if ($action === 'logout')
  {
    session_unset();
    session_destroy();
  }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMART Ziele Dashboard</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/allgemein.css">
  <link rel="stylesheet" href="../css/helpclasses.css">
  <link rel="stylesheet" href="../css/dashbord.css">

</head>
<body>
  <div class="page">
    <header class="flex main-header"> 
      <div class="logo mar-r-16 flexitem">
        <a href="../index.php""><img class="logobild" src="../img/logo.png" alt="logo"></a>
      </div>
  
      <nav class="flexitem">
        <ul class="clearfix">
          <li class="fl-l pad-l-16 mar-r-16">
            <a href="../index.php">Intro</a>
          </li>
          <li class="fl-l pad-l-16 mar-r-16">
            <a href="tutorial.php">Tutorial</a>
          </li>
          <?php if(IsUserLoggedIN()) : ?>
            <li class="fl-l pad-l-16 mar-r-16 active">
              <a href="dashboard.php">Dashboard</a>
            </li>
            <li class="fl-l pad-l-16 mar-r-16">
              <a href="goalssetting.php">Ziele Einstellung</a>
            </li>
          <?php endif ?>
        </ul>
      </nav>
      <div class="flexitem reg-log">
        <div class="log-con">
          <?php if(!IsUserLoggedIN()) : ?>
            <a class="log-icon mar-r-16" href="registrieren.php">Registrieren</a>
            <a class="log-icon mar-r-16 " href="login.php">Login</a>
          <?php endif ?>
          <?php if(IsUserLoggedIN()) : ?>
            <div>
              <form action="" method="post">
                <button class="log-icon"type="submit" name="action" value="logout">Abmelden</button>
              </form>
            </div>
          <?php endif ?>
        </div>
      </div>

    </header>
    <main>
      <h1 class="h1">Dashboard</h1>
      <div class="container">
        <div class="box">
          <h2>Ziele Anzahl</h2>
          <p><?= isset($totalGoals) ? count($totalGoals) : 0 ?></p>
        </div>
        <div class="box">
          <h2>Fertige Ziele</h2>
          <p><?=  $doneGoals ?></p>
        </div>
        <div class="box">
          <h2>Meilensteine Anzahl</h2>
          <p><?= isset($totalMilestones) ? count($totalMilestones) : 0 ?></p>
        </div>
        <div class="box">
          <h2>Fertige Meilensteine</h2>
          <p><?=  $doneMilestones ?></p>
        </div>
      </div>

    </main>
    <footer class="footer">
      <p class="footer_Text"> Devloped with 🖤</p>
      <a class="footer_impressum mar-r-16 center-y"href="html/impressum.html">impressum</a>
    </footer>
  </div>
</body>
</html>