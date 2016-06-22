<?php
//signout.php
include 'connect.php';
include 'header.php';

echo '<h2>Sair</h2>';

//check if user if signed in
if($_SESSION['signed_in'] == true)
{
	//unset all variables
	$_SESSION['signed_in'] = NULL;
	$_SESSION['user_name'] = NULL;
	$_SESSION['user_id']   = NULL;

	echo 'Saiu com sucesso. Obrigada pela sua contribuição.';
}
else
{
	echo 'Ainda não entrou na sua conta. Gostaria de o <a href="signin.php">fazer</a>?';
}

include 'footer.php';
?>