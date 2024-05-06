<?php
require 'helpers.php';
session_start();
session_destroy();
logout();
redirect('login.php');