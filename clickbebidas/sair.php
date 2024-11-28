<?php
session_start(); //Toda vez que usamos variavel globar precisamos usar o session_start//
session_destroy();
header('Location: login.php');