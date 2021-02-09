<?php
session_start();
session_destroy();
echo '<script type="text/javascript">'; 
echo 'alert("You have been logged out");'; 
echo 'window.location.href = "login.php";';
echo '</script>';
?>