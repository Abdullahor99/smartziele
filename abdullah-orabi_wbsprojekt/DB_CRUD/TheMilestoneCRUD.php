<?php

function CreateMilestone($db, $goalID, $name, $startDate, $endDate)
{
  $sql = "INSERT INTO milestone (goal_id, name, startDate, endDate)
  VALUES ( :goalID, :name, :startDate, :endDate)";

  $stmt = $db->prepare($sql);

  $result = $stmt->execute([
    ':goalID' => $goalID,
    ':name' => $name,
    ':startDate' => $startDate,
    ':endDate' => $endDate
    ]);
 
    return $result;
}

function getMeilensteinFromDB($db, $goalID)
{
  $sql = "SELECT *
  FROM milestone
  WHERE goal_id = $goalID";

  $stmt = $db->query($sql);
  $milestones = $stmt->fetchall();

  return $milestones;
}

function addCheckboxStatus($db, $goalID, $milestoneID, $checked)
{
  $sql = "UPDATE milestone
  SET done = :checked
  WHERE goal_id = :goal_id AND id = :milestone_id";

  $stm = $db->prepare($sql);
  $result = $stm->execute([
    ':goal_id' => $goalID,
    ':milestone_id' => $milestoneID,
    ':checked'  => $checked,
  ]);
  return $result;
}
function getMilestone($db,$goalID)
{
  $sql = "SELECT *
  FROM milestone
  WHERE goal_id = $goalID";

  $stmt = $db->query($sql);
  $comments = $stmt->fetchall();

  return $comments;
}
function deleteMilestoneFromDB($db, $goalID, $milestoneID)
{
  // Delete the milestone
  $sql = "DELETE FROM milestone WHERE goal_id = :goal_id AND id = :milestone_id";
  $stm = $db->prepare($sql);
  $result = $stm->execute([
      ':goal_id' => $goalID,
      ':milestone_id' => $milestoneID,
  ]);

  return $result;
}

function getMilestonesFromDB($db)
{
  $sql = "SELECT * FROM milestone";
  $stmt = $db->query($sql);
  $milestones = $stmt->fetchall();

  return $milestones;
}