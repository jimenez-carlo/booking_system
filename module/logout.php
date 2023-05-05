<?php
require_once('../database/connection.php');
session_destroy();
header('location:../index.php');
