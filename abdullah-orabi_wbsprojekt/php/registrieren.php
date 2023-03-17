<?php
session_start();
require '../db/ConnectDB.php';
require '../requests/RegisterTheUserREQ.php';
require '../DB_CRUD/TheUserCRUD.PHP';
require '../helper/helper.php';

$db = connectToDatabase();

$errors= [];
$action = $_POST["action"] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  //Register Form
  if($action === 'register')
  {
    $callback = handleRegisterRequest($db);
    if (isset($callback['user_name']) && isset($callback['user_id']))
    {
      $ok = true;
      loginUser($callback);
    }
    if ($action === 'logout')
    {
      session_unset();
      session_destroy();
    }
  }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMART Ziele Registrieren</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/allgemein.css">
  <link rel="stylesheet" href="../css/helpclasses.css">
  <link rel="stylesheet" href="../css/form.css">
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
            <a href="../index.php">Intro</a></li>
          <li class="fl-l pad-l-16 mar-r-16">
            <a href="tutorial.php">Tutorial</a></li>
          <?php if(IsUserLoggedIN()) : ?> 
            <li class="fl-l pad-l-16 mar-r-16">
              <a href="dashboard.php">Dashboard</a></li>
            <li class="fl-l pad-l-16 mar-r-16">
              <a href="goalssetting.php">Ziele Einstellung</a></li>
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
      <h1 class="h1">Registrieren</h1>
      <form action="" method="post">
        <!-- ############NAME############# -->
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" >

        <?php if (isset($callback['name_error'])) : ?>
          <div class="alert">
            <?= $callback['name_error'] ?>
          </div>
        <?php endif; ?>
        <!-- ############VORNAME############# -->
        <label for="vorname">Vorname:</label>
        <input type="text" id="vorname" name="vorname" >

        <?php if (isset($callback['vorname_error'])) : ?>
          <div class="alert">
            <?= $callback['vorname_error'] ?>
          </div>
        <?php endif; ?>
        <!-- ############E-Mail############# -->  
        <label for="email">E-Mail-Adresse:</label>
        <input type="email" id="email" name="email" >

        <?php if (isset($callback['email_error'])) : ?>
          <div class="alert">
            <?= $callback['email_error'] ?>
          </div>
        <?php endif; ?>
        <!-- ############PASSWORD############# --> 
        <label for="password">Passwort:</label>
        <input type="password" id="password" name="password" >

        <?php if (isset($callback['password_error'])) : ?>
          <div class="alert">
            <?= $callback['password_error'] ?>
          </div>
        <?php endif; ?>
        <!-- ############PASSWORDCONFIRM############# -->
        <label for="password-confirm">Passwort bestätigen:</label>
        <input type="password" id="password-confirm" name="password-confirm">

        <?php if (isset($callback['password_error'])) : ?>
          <div class="alert">
            <?= $callback['password_error'] ?>
          </div>
        <?php endif; ?>

        <!-- ############submit############# -->
        <button class="submit-button" type="submit" name="action" value="register">Registrieren</button>

        <?php if (isset($ok)) : ?>
          <div class="alert">
            Du hast dich erfolgreich registriert!
          </div>
        <?php endif; ?>

    </form>

    </main>
    <footer class="footer">
      <p class="footer_Text"> Devloped with 🖤</p>
      <a class="footer_impressum mar-r-16 center-y"href="html/impressum.html">impressum</a>
    </footer>
  </div>
</body>
</html>