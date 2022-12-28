<?php

function isAdmin($user, $password) {
    return $user == ADMIN_NAME && password_verify($password, ADMIN_PWD);
}