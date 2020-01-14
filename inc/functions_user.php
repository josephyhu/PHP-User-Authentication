<?php
function findUserByUsername($username)
{
    global $db;

    try {
        $sql = 'SELECT * FROM users WHERE username = ?';
        $results = $db->prepare($sql);
        $results->bindParam(1, $username);
        $results->execute();
        return $results->fetch();
    } catch (\Exception $e) {
        throw $e;
    }
}

function findUserById($userId)
{
    global $db;

    try {
        $sql = 'SELECT * FROM users WHERE id = ?';
        $results = $db->prepare($sql);
        $results->bindParam(1, $userId);
        $results->execute();
        return $results->fetch();
    } catch (\Exception $e) {
        throw $e;
    }
}

function createUser($username, $password)
{
    global $db;

    try {
        $sql = 'INSERT INTO users (username, password) VALUES (?, ?)';
        $results = $db->prepare($sql);
        $results->bindParam(1, $username);
        $results->bindParam(2, $password);
        $results->execute();
        return findUserByUsername($username);
    } catch (\exception $e) {
        throw $e;
    }
}

function updatePassword($password, $userId)
{
    global $db;

    try {
        $sql = 'UPDATE users SET password = ? WHERE id = ?';
        $results = $db->prepare($sql);
        $results->bindParam(1, $password);
        $results->bindParam(2, $userId);
        $results->execute();
        if ($results->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    } catch (\Exception $e) {
        throw $e;
    }
    return true;
}
