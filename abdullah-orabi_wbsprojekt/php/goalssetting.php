<?php
require '../helper/helper.php';
require '../db/ConnectDB.php';
require '../requests/EditGoalREQ.php';
require '../DB_CRUD/TheGoalCRUD.php';

session_start();
$db = connectToDatabase();
$action = $_POST["action"] ?? '';
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  if ($action === 'logout')
  {
    session_unset();
    session_destroy();
  }
  if($action === 'savegoal')
  {
    $error = false;
    handleSaveGoalREQ($db, $error);
    // if($error)
    // wenn die funktion mit Fehler zurück kommt dann die Fehler anzeigen 

  }

    
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMART Ziele Einstellung </title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/f0e3796fee.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/allgemein.css">
  <link rel="stylesheet" href="../css/helpclasses.css">
    <link rel="stylesheet" href="../css/goal.css">

</head>
<body>
  <div class="goal-form-cont">
    <form class="goal-form"action=""  method="post">
      <button class="goal-close">
        <i class="fa-solid fa-circle-xmark goal-close-icon"></i>
      </button>
      <div class="goal-form-inputs-cont">
        <label class="goal-label" for="zielname">Ziel Name:</label>
        <input class="goal-input" type="text" id="zielname" name="zielname" placeholder="z.B 5kg Abnehmen">

        <label for="startdatum">Startdatum:</label>
        <input class="goal-input" type="date" id="startdatum"   name="startdatum">

        <label for="enddatum">Enddatum:</label>
        <input class="goal-input" type="date" id="enddatum"   name="enddatum">
        <button name="action" class="goal-submit" type="submit" value="savegoal" >Ziel speichern</button>
      </div>
    </form>
  </div>

  <div class="milestone-form-cont">
    <form class="milestone-form"action=""  method="post">
      <button class="milestone-close">
        <i class="fa-solid fa-circle-xmark goal-close-icon"></i>
      </button>
      <div class="milestone-form-inputs-cont">
        <label class="milestone-label" for="MeilensteinName">Meilenstein Name:</label>
        <input class="milestone-input" type="text" id="MeilensteinName" name="MeilensteinName" placeholder="z.B 5kg Abnehmen">

        <label for="startdatum">Startdatum:</label>
        <input class="milestone-input" type="date" id="startdatum"  name="startdatum">

        <label for="enddatum">Enddatum:</label>
        <input class="milestone-input" type="date" id="enddatum"   name="enddatum">

        <input class="milestone-submit" type="submit" value="Meilenstein speichern">
      </div>
    </form>
  </div>
  <div class="page">
    <header class="flex main-header"> 
      <div class="logo mar-r-16 flexitem">
        <a href="index.php"><img class="logobild" src="../img/logo.png" alt="logo"></a>
      </div>
  
      <nav class="flexitem">
        <ul class="clearfix">
          <li class="fl-l pad-l-16 mar-r-16">
            <a href="../index.php">Intro</a>
          </li>
          <li class="fl-l pad-l-16 mar-r-16">
            <a href="tutorial.php">Tutorial</a>
          </li>
          <li class="fl-l pad-l-16 mar-r-16">
            <a href="dashboard.php">Dashboard</a>
          </li>
          <li class="fl-l pad-l-16 mar-r-16 active">
            <a href="goalssetting.php">Ziele Einstellung</a>
          </li>
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
                <button class="log-icon"type="submit"   name="action" value="logout">Abmelden</button>
              </form>
            </div>
          <?php endif ?>
        </div>
      </div>

    </header>
    <main>
    
    <button class="addgoal-button">Neu Ziel
    <i class="fa-regular fa-plus"></i></button>
      <?php if(IsUserLoggedIN()) : ?>
        <div> willkomen </div>
      <?php endif ?>
      <?php if(!IsUserLoggedIN()) : ?>
        <div> nicht angemeldet </div>
      <?php endif ?>   
      <h1 class="h1">Einstellungen</h1>

      <div class="goal-cont">
        <header class="goal-header flex">
          <h3 class= "goal-name">5kg Abnehmen</h3>
          <div class="goal-flex-item flex goal-startend-date-cont">
            <p class="goal-start-date">01.01.2023</p>
            <i class="fa-solid fa-arrow-right recht-pfeil"></i>
            <p class="goal-end-date">01.01.2024</p>
          </div>
          <div class="goal-flex-item goal-logo-cont"><i class="goal-logo fa-solid fa-bullseye"></i></div>
        </header>
        <div class="goal-progress-cont">
          <p>Fortschritt</p>
          <progress max="100" value="50" class="goal-progress"></progress>
          <span>50%</span>
        </div>
        <button class="addmilestone-button">Neu Meilenstein<i class="plus fa-regular fa-plus"></i></button>

        <div class="milestone-cont">
          <p class="milestone-start-date">02.02.2023</p>
          <p class="milestone-end-date">1.03.2023</p>
          <div class="flex">
            <form class="checkbox-form"action="" method="post">
              <input class="checkbox center-xy"type="checkbox">
              <input class="hidden-ele"type="submit" valu="submit">
            </form>
            <h4 class="milestone-name">2kg Abnehmen</h4>
          </div>
          
        </div>
      </div>
    </main>
    <footer class="footer">
      <p class="footer_Text"> Devloped with 🖤</p>
      <a class="footer_impressum mar-r-16 center-y"href="html/impressum.html">impressum</a>
    </footer>
  </div>
  <script src="../js/app.js"></script>
</body>
</html>