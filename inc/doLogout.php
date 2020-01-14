<?php
require_once __DIR__ . '/bootstrap.php';
requireAuth();

$session->remove('auth_logged_in');
$session->remove('auth_user_id');

$session->getFlashBag()->add('success', 'Sucessfully logged out');
redirect('/login.php');
