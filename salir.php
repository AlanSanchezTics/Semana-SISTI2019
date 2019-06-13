<?php
session_name("webSession");
session_start();
session_destroy();
header("Location: ./");
?>