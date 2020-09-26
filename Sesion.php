<?php
require_once 'Index.php';
$error = $user = $pass = "";

if (isset($_POST['user']))
{
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);

    if($user == "" || $pass == "")
     $error = 'No se han llenado todos los campos';
    else
    {
        $result= queryMySQL("SELECT user, pass FROM members
        WHERE user='$user' AND pass='$pass'");

        if($result->num_rows == 0)
        {
            $error = "Intento de registro invalido";
        }
        else
        {
         $_SESSION['user'] = $user;
         $_SESSION['pass'] = $pass;
         die("<div class='text'>Ahora estas en linea. Porfavor
            <a data-transition='slide' href='Posters.php'?view='$user'> Da clic
            aqui para continuar.
            </div></div></body></html>");

        }
    }

}
echo<<<_END
<form method='post' action='Sesion.php' class='form'>
<div data-role='fieldcontain'>
   <label></label>
   <span class='error'>$error</span>
</div>
<div data-role='fieldcontain'>
   <label></label>
   Escriba los datos para entrar a su cuenta.
</div>
<div data-role='fieldcontain'>
   <label>Nombre de usuario</label>
   <input type='text' maxlength='16' name='user' value='$user'>
</div>
<div data-role='fieldcontain'>
   <label>Contraseña</label>
   <input type='password' maxlength='16' name='pass' value='$pass'>
</div>
<div data-role='fieldcontain'>
<label></label>
<input data-transition='slide' type='submit' value='login' class='boton'>
</div>
</form>
</div>
</body>
</hmtl>
_END;
?>