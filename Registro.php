<?php
require_once 'Index.php';
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
$error = $user = $pass = "";
if(isset($_SESSION['user'])) destroySession();

if (isset($_POST['user'])){
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);

    if($user == "" || $pass =="")
    $error = 'Faltan campos por llenar <br><br>';
    else{
        $result = queryMysql("SELECT * FROM members WHERE user='$user'");

        if ($result->num_rows)
        $error = 'El nombre ya esta en uso <br><br>';
        else{
            queryMysql("INSERT INTO members VALUES('$user','$pass')");
            die('<center><div class="text"><h4>Cuenta creada</h4><a href="Posters.php">Por favor haga clic aqui </a></div></center>');

        }
    }
}
echo <<<_END
<div class="text">
<form method='post' action='Registro.php'>$error
<div data-role='fieldcontain'>
<label></label>
Ingrese los datos para crear su cuenta.
</div>
<div data-role='fieldcontain'>
<label>Nombre de Usuario</label>
<input type='text' maxlength='16' name='user' value='$user'
onBlur='checkUser(this)'>
<label></label><div>&nbsp;</div>
</div>
<div data-role='fieldcontain'>
<label>Contraseña</label>
<input type='text' maxlength='16' name='pass' value='$pass'>
</div>
<div data-role='fieldcontain'>
<label></label>
<input data-transition='slide' type='submit' value='Sign Up'>
</div>
</div>
</div>
</body>
</html>
_END;
?>