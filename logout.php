<?
session_start();

unset($_SESSION["id"]);
unset($_SESSION["nick"]);
die("<script>location.href='index.php';</script>");
?>