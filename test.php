<?php

$password = 'hello';

$hashe = password_hash($password, PASSWORD_DEFAULT);

echo "hash = $hashe";
?>