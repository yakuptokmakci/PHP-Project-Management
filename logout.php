<?php
session_start();
session_destroy();

header("Location: signup.htm");
exit;
?>