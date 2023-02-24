<?php

function handleRegisterRequest($db)
{
  $errors = [];

  $user_name = $_POST['name'];
  $user_vorname = $_POST['vorname'];
  $user_email = $_POST['email'];
  $user_password  = $_POST['password'];
  $user_password_confirm = $_POST['password-confirm'];

  //validate name 
  if($user_name === '')
    $errors['name_error'] = "Bitte gebe einen gültigen Name ein";
  if($user_vorname === '')
    $errors['vorname_error'] = "Bitte gebe einen gültigen Vorname ein";
  if(!filter_var($user_email, FILTER_VALIDATE_EMAIL))
    $errors['email_error'] = "Bitte gebe einen gültigen Email an!";

  //validate password
    if (mb_strlen($user_password) < 8)
        $errors['password_error'] = 'Das Passwort muss mindestens 8 Zeichen enthalten';

    if ($user_password !== $user_password_confirm)
        $errors['password_error'] = 'Deine Passwörter stimmen nicht überein!';

    if ($user_password === '') 
        $errors['password_error'] = 'Bitte gebe ein Password an';

    $user = getUserByEmail($db, $user_email);

    if($user && $user_email === $user['email'])
        $errors['email_error'] =
        'Es existiert bereits ein Account mit dieser E-Mail';


    if(!$errors)
    {
      createUser($db, $user_vorname,$user_name, $user_email, $user_password);

      $user = getUserByEmail($db, $user_email);

      $callback = [
        "user_id" => $user['id'],
        "user_name" => $user_name,
        "user_email" => $user_email,
      ];

        return $callback;
    }
    return $errors;
}