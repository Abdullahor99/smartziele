<?php

function CreateGoal($db, $user_id, $name, $startDate, $endDate)
{
  $sql = "INSERT INTO ziel(user_id, name, startDate, endDate)
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