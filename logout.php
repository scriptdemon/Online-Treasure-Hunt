<?php
session_start();
unset($_SESSION['id']);
unset($_SESSION['name']);
unset($_SESSION['email']);
unset($_SESSION['profile_url']);
session_destroy();
echo "successful";
exit;
?>