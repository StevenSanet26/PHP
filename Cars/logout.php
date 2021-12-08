<?php
session_start();
session_unset();
session_destroy();
setcookie(session_name(),"",0);

require 'views/logout.view.php';