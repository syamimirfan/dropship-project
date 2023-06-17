<?php
  include('../dropship-project/backend/function.php');

  $_SESSION = [];
  session_unset();
  session_destroy();

  header("Location:".SITEURL.'elhaurah.php');
?>