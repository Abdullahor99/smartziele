<?php
require '../helper/helper.php';
session_start();
$action = $_POST["action"] ?? '';
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
  <title>SMART Ziele Tutorial</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/allgemein.css">
  <link rel="stylesheet" href="../css/helpclasses.css">
  <link rel="stylesheet" href="../css/tutorial.css">
</head>
<body>
  <div class="page">
    <header class="flex main-header"> 
      <div class="logo mar-r-16 flexitem">
        <a href="../index.php""><img class="logobild" src="../img/logo.png" alt="logo"></a>
      </div>
  
      <nav class="flexitem">
        <ul class="clearfix">
          <li class="fl-l pad-l-16 mar-r-16"><a href="../index.php">Intro</a></li>
          <li class="fl-l pad-l-16 mar-r-16 active"><a href="tutorial.php">Tutorial</a></li>
          <?php if(IsUserLoggedIN()) : ?>
            <li class="fl-l pad-l-16 mar-r-16"><a href="dashboard.php">Dashboard</a></li>
            <li class="fl-l pad-l-16 mar-r-16"><a href="goalssetting.php">Ziele Einstellung</a></li>
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
      <h1 class="h1">Tutorial</h1>
      <section class="tutorial-section">
        <h2 class="tutorial-h2">Erste Schritt: Registrieren Sie sich</h2>
        <p class="tutorial-p">Regstrieren sie sich oder melden Sie sich an</p>
      </section>
          
      <section class="tutorial-section">
        <h2 class="tutorial-h2">Zweite Schritt: Zieleinstellungen</h2>
        <p class="tutorial-p">Klicken Sie auf "Neues Ziel" und füllen Sie das Formular aus.</p>
      </section>
          
      <section class="tutorial-section">
        <h2 class="tutorial-h2" >Dritte Schritt: Meilensteine erstellen</h2>
        <p class="tutorial-p">Für jedes Ziel können Sie verschiedene Meilensteine erstellen und immer den Fortschritt im Blick haben.</p>
      </section>
    </main>
    <footer class="footer">
      <p class="footer_Text"> Devloped with 🖤</p>
      <a class="footer_impressum mar-r-16 center-y"href="html/impressum.html">impressum</a>
    </footer>
  </div>
</body>
</html>