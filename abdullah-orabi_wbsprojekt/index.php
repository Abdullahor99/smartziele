<?php
require 'helper/helper.php';
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
  <title>SMART Ziele</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/allgemein.css">
  <link rel="stylesheet" href="css/helpclasses.css">
  <link rel="stylesheet" href="css/index.css">
</head>
<body>
  <div class="page">
    <header class="flex main-header"> 
      <div class="logo mar-r-16 flexitem">
      <a href="index.php"><img class="logobild" src="img/logo.png" alt="logo"></a>
      </div>
      <nav class="flexitem">
        <ul class="clearfix">
          <li class="fl-l pad-l-16 mar-r-16 active"><a href="index.php">Intro</a></li>
          <li class="fl-l pad-l-16 mar-r-16"><a href="php/tutorial.php">Tutorial</a></li>
          <?php if(IsUserLoggedIN()) : ?>
            <li class="fl-l pad-l-16"><a href="php/dashboard.php">Dashboard</a></li>
            <li class="fl-l pad-l-16"><a href="php/goalssetting.php">Ziele Einstellung</a></li>
          <?php endif ?>
        </ul>
      </nav>
      <div class="flexitem reg-log">
        <div class="log-con">
          <?php if(!IsUserLoggedIN()) : ?>
            <a class="log-icon mar-r-16" href="php/registrieren.php">Registrieren</a>
            <a class="log-icon mar-r-16 " href="php/login.php">Login</a>
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
    <div class="ziele">
      <h2 class="ziele_h2"> Die Ziele</h2>
      <img src="img/goal.avif" alt="Ziel" class="ziele_bild clearfix fl-l mar-l-16 mar-r-16 ">
      <p class="ziele_text mar-r-16">Ziele sind wichtig, weil sie Orientierung und Fokus bieten. Indem man sich klare und spezifische Ziele setzt, kann man sich auf das konzentrieren, was wirklich wichtig ist und seine Energie und Ressourcen gezielt einsetzen, um diese Ziele zu erreichen. Ziele können auch motivierend sein und einem ein Gefühl von Erfüllung und Zufriedenheit geben, wenn sie erreicht werden. Ohne Ziele kann man leicht den Überblick verlieren und sich in der Routine des Alltags verfangen, ohne jemals das Gefühl zu haben, wirklich Fortschritte zu machen oder etwas Bedeutungsvolles zu erreichen. Kurz gesagt, Ziele können Sehr motvierend sein vorallem wenn man die Fortschritte sieht, die geben uns einen Zweck und eine Richtung im Leben.
    </p>
    </div>

    <div class="smartziele">
      <h2 class="smartziele_h2">Was ist mit SMART Ziele gemeint?</h2>
      <div class="smartziele_content flex">
        <img class="smartziele_bild"src="img/SMART.png" alt="SMART Ziele">
        <p class="smartziele_text">
        SMART ist eine Abkürzung für ein Akronym, das für spezifisch (specific), messbar (measurable), erreichbar (attainable), relevant (relevant), und zeitgebunden (time-bound) steht. SMART-Ziele beziehen sich auf Ziele, die diese Kriterien erfüllen, um sicherzustellen, dass sie klar definiert, quantifizierbar, erreichbar, relevant und zeitgebunden sind. Durch die Verwendung von SMART-Zielen kann ein Ziel effektiver geplant, verfolgt und erreicht werden.
      </p>
      </div>
      
    </div>
    <div class="anleitung flex">
      <div class="col-50 anleitung_cont">
        <p class="anleitung-text mar-l-16 center-y">Erstelle jetzt dein erste Ziel </p>
        <a class="anleitung__button" href="#">Ziel alegen</a>
      </div>
      <div class="col-50 anleitung_cont">
        <p class="anleitung-text mar-l-16 center-y">Oder Siehe unser Tutorial</p>
        <a class="anleitung__button" href="#">Tutorial</a>
      </div>
    </div>
    <footer class="footer">
      <p class="footer_Text"> Devloped with 🖤</p>
      <a class="footer_impressum mar-r-16 center-y"href="html/impressum.html">impressum</a>
    </footer>
  </main>
