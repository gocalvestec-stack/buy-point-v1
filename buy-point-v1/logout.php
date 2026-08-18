<?php
require_once __DIR__.'/config/init.php';$_SESSION=[];session_destroy();header('Location: login.php');exit;
