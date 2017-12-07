<?php
session_start();
session_regenerate_id(true);
session_cache_expire();
session_destroy();
header('location: login.html');
?>