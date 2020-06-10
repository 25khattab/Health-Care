<?php
session_start();
session_destroy();
header('Location: ../presentationLayer/welcome.php');
