<?php
require_once __DIR__ . '/config.php';
unset($_SESSION['paciente_id'], $_SESSION['paciente_nome'], $_SESSION['paciente_email']);
header('Location: paciente_login.php'); exit;
