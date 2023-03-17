<?php

function CreateGoal($db, $user_id, $name, $startDate, $endDate)
{
  $sql = "INSERT INTO goal(user_id, name, startDate, endDate)
  VALUES ( :user_id, :name, :startDate, :endDate)";

  $stmt = $db->prepare($sql);

  $result = $stmt->execute([
    ':user_id' => $user_id,
    ':name' => $name,
    ':startDate' => $startDate,
    ':endDate' => $endDate
    ]);

    return $result;
}
function getGoalsFromDB($db)
{
  $sql = "SELECT * FROM goal";
  $stmt = $db->query($sql);
  $goals = $stmt->fetchall();

  return $goals;
}

function deleteGoalFromDB($db, $goalID)
{
   // Delete all associated milestones
  $sql = "DELETE FROM milestone WHERE goal_id = :goal_id";
  $stm = $db->prepare($sql);
  $result = $stm->execute([
      ':goal_id' => $goalID,
  ]);

  // Delete the goal
  $sql = "DELETE FROM goal WHERE id = :goal_id";
  $stm = $db->prepare($sql);
  $result = $stm->execute([
      ':goal_id' => $goalID,
  ]);

  return $result;
}
function updateTheProgress($db,$goalID,$userID)
{
  // der updtet mir der Progress
  // ich brauche der anzahl der fertigen Meilensteine
  // der Anzahl der gesamt Meilensteine
  // Anzhl der fertigen / gesamt * 100 = Progress

  $Milestones = getMilestone($db,$goalID);
  if(count($Milestones) >= 1)
  {
    $doneMilestone = 0;
    foreach($Milestones as $Milestone)
      if($Milestone['done'] === 1)
        $doneMilestone++;

    $progress = $doneMilestone / count($Milestones) * 100;

    $sql = " UPDATE goal 
    SET progress = :progress
    WHERE id = :goal_id AND user_id = :user_id";

    $stm = $db->prepare($sql);

    $result = $stm->execute([
      ':goal_id' => $goalID,
      ':user_id' => $userID,
      ':progress'  => $progress,

    ]);
    return $result;
  }
  
}