<?php
session_start();

DEFINE("DB_HOST",getenv('DB_HOST'));
DEFINE("DB_USER",getenv('DB_USER'));
DEFINE("DB_PASSWORD",getenv('DB_PASSWORD'));
DEFINE("DB_DB", getenv('DB_DB'));
?>