<?php
session_start();
if(session_destroy()) // Menghapus Sessions
{
header("Location: admin/index.php"); 
}
?>