<?php
$dbhost = 'localhost';
$dbname = 'AlbaHamer';
$dbuser = 'root';
$dbpass = '';
$connection = new mysqli ($dbhost, $dbuser, $dbpass, $dbname);
if ($connection-> connect_error) die("Fatal Error");

function createTable($name, $query)
{
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or alredy exists.<br>";
}

function queryMysql($query)
{
    global $connection;
    $result = $connection->query($query);
    if (!$result) die ("Fatal Error");
    return $result;
}

function destroySession()
{
  $_SESSION=array();

  if(session_id() != "" || isset($_COOKIE[session_name()]))
  setcookie(session_name(), '', time()-2592000, '/');

  session_destroy(); 
}

function sanitizeString($var)
{
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    if (get_magic_quotes_gpc())
    $var = stripslashes($var);
    return $connection->real_escape_string($var);
}

 if (isset($_POST['user']))
   {
       $user = sanitizeString($_POST ['user']);
       $result =queryMysql("SELECT * FROM members WHERE user='$user'");

       if ($result->num_rows)
       echo "<span class= 'error' >&nbspx2718;" .
       "El usuario '$user' es incorrecto</span> ";

       else
         echo "<center><span>&nbsp;&#x2714; ". 
         "El nombre '$user' correcto</span></center>";

   }
   ?>