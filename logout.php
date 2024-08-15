<?php
session_start();
session_unset();
session_destroy();
header("Location: form.html"); // Redirect to login page after logout
exit();
?>
