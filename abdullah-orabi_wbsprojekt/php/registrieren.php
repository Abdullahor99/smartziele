

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
    <header class="flex"> 
      <div class="logo mar-r-16 flexitem">
        <a href="index.php"><img class="logobild" src="../img/logo.png" alt="logo"></a>
      </div>
  
      <nav class="flexitem">
        <ul class="clearfix">
          <li class="fl-l pad-l-16 mar-r-16">
            <a href="../index.php">Intro</a></li>
          <li class="fl-l pad-l-16 mar-r-16">
            <a href="tutorial.php">Tutorial</a></li>
          <li class="fl-l pad-l-16 mar-r-16">
            <a href="dashboard.php">Dashboard</a></li>
          <li class="fl-l pad-l-16 mar-r-16">
            <a href="goalssetting.php">Ziele Einstellung</a></li>
        </ul>
      </nav>
      <div class="flexitem reg-log">
        <div class="reg-log-con">
          <a class="reg mar-r-16" href="registrieren.php">Registrieren</a>
          <a class="log mar-r-16 " href="login.php">Login</a>
        </div>
      </div>

    </header>
    <main>
      <h1 class="h1">Registrieren</h1>
      <form>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
  
        <label for="vorname">Vorname:</label>
        <input type="text" id="vorname" name="vorname" required>
  
        <label for="email">E-Mail-Adresse:</label>
        <input type="email" id="email" name="email" required>
  
        <label for="password">Passwort:</label>
        <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}" required>
        <label for="password-confirm">Passwort bestätigen:</label>
        <input type="password" id="password-confirm" name="password-confirm" required>
        <button type="submit">Registrieren</button>
    </form>

    </main>
    <footer class="footer">
      <p class="footer_Text"> Devloped with 🖤</p>
      <a class="footer_impressum mar-r-16 center-y"href="html/impressum.html">impressum</a>
    </footer>
  </div>
</body>
</html>