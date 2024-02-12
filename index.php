<?php
session_start();
require('function.php');

if ($db->checkSession()) {
    $db->redirect('pages');
} else {
    $db->redirect('login.php');
}
