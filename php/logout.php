<?php
$content = new TemplatePower("../html/logout.tpl");
$content->prepare();

$_SESSION['accountid'] = "";
$_SESSION['username'] = "";
$_SESSION['roleid'] = "";

unset($_SESSION['accountid']);
unset($_SESSION['username']);
unset($_SESSION['roleid']);