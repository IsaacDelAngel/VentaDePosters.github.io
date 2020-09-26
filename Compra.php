<?php
echo<<<_END
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="Vstiles.css">
    <title>Lunar Abyss</title>
</head>
<body background="Mad.jpg">
<script src="javascript.js"></script>
    <script src="jquery-2.2.4.min.js"></script>
    <script src="jquery.mobile-1.4.5.min.js"></script>
</body>
</html>
_END;
require_once 'Funciones.php';
echo <<<_END
<script>
function checkUser(user)
{
if (user.value == '')
   {
    $('#used').hmtl('&nbsp;')
    return
   }
   $.post ('checkuser.php', { user : user.value }, 
   function(data) { 
     $('#used').html(data)
    }
  )
}
</script>
_END;
$error = $user = $pass = $pais = $postal = "";
if(isset($_SESSION['user'])) destroySession();

if (isset($_POST['user'])){
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);
    $pais = sanitizeString($_POST['pais']);
    $postal = sanitizeString($_POST['postal']);
    

    if($user == "" || $pass =="")
    $error = 'Faltan campos por llenar <br><br>';
    else{
        $result = queryMysql("SELECT * FROM Pago WHERE user='$user'");

        if ($result->num_rows)
        $error = 'No existe <br><br>';
        else{
            queryMysql("INSERT INTO Pago VALUES('$user','$pass')");
            die('<center><div class="text"><h4>Pago relaizado</h4><a href="Posters.php">Por favor haga clic aqui </a></div></center>');

        }
    }
}
echo <<<_END
<div class="text">
<form method='post' action='Compra.php'>$error
<div data-role='fieldcontain'>
<label></label>
Ingrese los datos para concretar la compra.
</div>
<div data-role='fieldcontain'>
<label>Tarjeta</label>
<input type='text' maxlength='16' name='tarjeta' value='$user'
onBlur='checkUser(this)'>
<div>&nbsp;</div>
</div>
<div data-role='fieldcontain'>
<label>Clave de tarjeta</label>
<input type='text' maxlength='16' name='clave' value='$pass'>
</div>
<div data-role='fieldcontain'>
<label>Ingrese su pais</label>
<input type='text' maxlength='16' name='pais' value='$pais'>
</div>
<div data-role='fieldcontain'>
<label>Ingrese su numero Postal</label>
<input type='text' maxlength='16' name='postal' value='$postal'>
</div>
<div data-role='fieldcontain'>
<label></label>
<input data-transition='slide' type='submit' value='Realizar compra'>
</div>
</div>
</div>
</body>
</html>
_END;
?>