<?php

//! a very lazy way to logout, possibly
// untested 

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    session_destroy();

    header("location:./../model6.html");
}