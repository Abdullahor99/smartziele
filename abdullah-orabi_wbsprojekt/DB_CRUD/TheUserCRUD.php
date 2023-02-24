<?php
function createUser($db, $vorname,$name, $email, $password)
{
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (vorname, name, email, password) VALUES ( :user_vorname, :user_name, :user_email, :user_password)";

    $stmt = $db->prepare($sql);

    $result = $stmt->execute([
        ':user_vorname' => $vorname,
        ':user_name' => $name,
        ':user_email' => $email,
        ':user_password' => $password_hash
    ]);

    return $result;
}

function deleteUser($db, $id)
{
    $sql = 'DELETE FROM user WHERE id = :user_id';
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':user_id' => $id,
    ]);
}


function getUserByEmail($db, $user_email) {
    $sql = 'SELECT * FROM user WHERE email = :user_email';
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':user_email' => $user_email,
    ]);
    $user = $stmt->fetch();

    return $user;
}

function getUserByID($db, $user_id) 
{
    $sql = 'SELECT * FROM user WHERE id = :user_id';
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':user_id' => $user_id,
    ]);
    $user = $stmt->fetch();
  
    return $user;
}


function loginUser($callback)
{
  // session_start();
  $_SESSION['user_id'] = $callback['user_id'];
  $_SESSION['user_name'] =  $callback['user_name'];
  $_SESSION['user_email'] = $callback['user_email'];

  Redirect('../php/goalssetting.php', false);
}
