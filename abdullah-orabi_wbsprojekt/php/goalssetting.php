<?php
require '../helper/helper.php';
require '../db/ConnectDB.php';
require '../requests/EditGoalREQ.php';
require '../requests/EditMilestoneREQ.php';
require '../DB_CRUD/TheGoalCRUD.php';
require '../DB_CRUD/TheMilestoneCRUD.php';


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
    $error = handleSaveGoalREQ($db);
    if(!$error)
      Redirect("goalssetting.php", false);
  }
  
  if($action === 'savemilestone')
  {
    $goalID = $_POST['goalid'];
    if($goalID != '')
    {
      echo $goalID;
      $error = handleSaveMilestoneREQ($db, $goalID);
      updateTheProgress($db,$goalID,$_SESSION['user_id']);
      if(!$error)
        Redirect("goalssetting.php", false);
    }
  }

  if($action === 'milestoneCheckbox')
  {
    $CheckboxGoalID = $_POST['checkbox-goalid'] ?? '';
    $CheckboxMilestoneID = $_POST['checkbox-milestoneid'] ?? '';
    $checked = $_POST['checkbox'] ?? 0;

    addCheckboxStatus($db, $CheckboxGoalID,$CheckboxMilestoneID,$checked);
    updateTheProgress($db,$CheckboxGoalID,$_SESSION['user_id']);
  }

  if($action === 'delete_goal')
  {
    $goalID = $_POST['goal_id'] ?? '';
    if($goalID != '')
      deleteGoalFromDB($db, $goalID);
  }

  if($action === 'delete_milestone')
  {
    $goalID = $_POST['goal_id'] ?? '';
    $milestoneID = $_POST['milestone_id'] ?? '';
    if($goalID != '' && $milestoneID)
    {
      deleteMilestoneFromDB($db, $goalID, $milestoneID);
      updateTheProgress($db,$goalID,$_SESSION['user_id']);
    }
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
        <input type="hidden" id="goalid-input" name="goalid" value="">
        <label class="milestone-label" for="MeilensteinName">Meilenstein Name:</label>
        <input class="milestone-input" type="text" id="MeilensteinName" name="MeilensteinName" placeholder="z.B 5kg Abnehmen">

        <label for="startdatum">Startdatum:</label>
        <input class="milestone-input" type="date" id="startdatum"  name="startdatum">

        <label for="enddatum">Enddatum:</label>
        <input class="milestone-input" type="date" id="enddatum"   name="enddatum">
        <button name="action" class="milestone-submit" type="submit" value="savemilestone" >Meilenstein speichern</button>
      </div>
    </form>
  </div>
  <div class="page">
    <header class="flex main-header"> 
      <div class="logo mar-r-16 flexitem">
        <a href="../index.php"><img class="logobild" src="../img/logo.png" alt="logo"></a>
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
            <li class="fl-l pad-l-16 mar-r-16">
              <a href="dashboard.php">Dashboard</a>
            </li>
            <li class="fl-l pad-l-16 mar-r-16 active">
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

      <h1 class="h1">Einstellungen</h1>
      <?php $goals = getGoalsFromDB($db);
          if (isset($goals)) : ?>
            <div class="goals-cont flex ">
              <?php foreach ($goals as $goal) : ?>
                <div class="goal-cont">
                  <header class="goal-header flex">
        
                    <h3 class= "goal-name">
                      <?= htmlspecialchars($goal['name']) ?>
                    </h3>

                    <div class="goal-flex-item flex goal-startend-date-cont">
                      <p class="goal-start-date">
                        <?= htmlspecialchars($goal['startDate']) ?>
                      </p>
                      <i class="fa-solid fa-arrow-right recht-pfeil"></i>
                      <p class="goal-end-date">
                        <?= htmlspecialchars($goal['endDate']) ?>
                      </p>
                    </div>

                    <div class="goal-flex-item goal-logo-cont"><i class="goal-logo fa-solid fa-bullseye"></i></div>

                  </header>

                  <div class="goal-progress-cont">
                    <p>Fortschritt</p>
                    <progress max="100" value="<?php echo isset($goal['progress']) ? $goal['progress'] : 0; ?>" class="class="goal-progress">
                    </progress>
                    <span>
                      <?php echo isset($goal['progress']) ? $goal['progress'] . '%': 0 . '%'; ?>
                    </span>
                  </div>
                  <div class="flex">
                    <button class="addmilestone-button" data-goalid="<?= htmlspecialchars($goal['id']) ?>">Neu Meilenstein
                      <i class="plus fa-regular fa-plus"></i>
                    </button>

                    <!-- delete Button -->
                    <form class="delete-form" method="POST">
                      <input type="hidden" name="goal_id" value="<?= $goal['id']; ?>">
                      <input type="hidden" name="user_id" value="<?= $goal['user_id']; ?>">
                      <button type="submit" name="action" class="delete-button" value="delete_goal">
                        <i class="fa fa-trash"></i>
                      </button>
                    </form>
                  </div>

                  <?php $milestones = getMeilensteinFromDB($db, $goal['id']);
                  if (isset($milestones)) : 
                    foreach ($milestones as $milestone) : ?>

                    <div class="milestone-cont">
                      <p class="milestone-start-date">
                        <?= htmlspecialchars($milestone['startDate']) ?>
                      </p>
                      <p class="milestone-end-date">
                        <?= htmlspecialchars($milestone['endDate']) ?>
                      </p>

                      <div class="flex">
                        <form class="checkbox-form"action="" method="post">
                          <input type="hidden"  name="checkbox-goalid" value="<?= $goal['id']?>">
                          <input type="hidden"  name="checkbox-milestoneid" value="<?= $milestone['id']?>">
                          <input class="checkbox" type="checkbox" name ="checkbox" value="1" <?php echo ($milestone['done'] == 1 ? 'checked' : ''); ?>>
                          <button name="action" class="hidden-ele" type="submit" value="milestoneCheckbox" ></button>
                          
                        </form>
                        <h4 class="milestone-name">
                          <?= htmlspecialchars($milestone['name']) ?>
                        </h4>

                        <form class="delete-form" method="POST">
                          <input type="hidden" name="goal_id" value="<?= $goal['id']; ?>">
                          <input type="hidden" name="milestone_id" value="<?= $milestone['id']; ?>">
                          <button type="submit" name="action" class="milestone-delete-button" value="delete_milestone">
                            <i class="fa fa-trash"></i>
                          </button>
                        </form>

                      </div>
                    </div>

                    <?php endforeach; ?>      
                  <?php endif; ?>
                  </div>
              <?php endforeach; ?> 
            </div>
          <?php endif; ?>
    </main>
    <footer class="footer">
      <p class="footer_Text"> Devloped with 🖤</p>
      <a class="footer_impressum mar-r-16 center-y"href="html/impressum.html">impressum</a>
    </footer>
  </div>
  <script src="../js/app.js"></script>
  <script src="../js/validation.js"></script>
  <script src="../js/helper.js"></script>
</body>
</html>