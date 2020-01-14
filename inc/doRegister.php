<?php
require_once __DIR__ . '/bootstrap.php';

$username = request()->get('username');
$password = request()->get('password');
$confirmPassword = request()->get('confirm_password');

if ($password != $confirmPassword) {
    $session->getFlashBag()->add('error', 'Passwords do not match');
    redirect('/register.php');
}

$user = findUserByUsername($username);
if (!empty($user)) {
    $session->getFlashBag()->add('error', 'User already exists');
    redirect('/register.php');
}

$hashed = password_hash($password, PASSWORD_DEFAULT);
$user = createUser($username, $hashed);
saveUserSession($user);
$session->getFlashBag()->add('success', 'Successfully registered');
redirect('/');
