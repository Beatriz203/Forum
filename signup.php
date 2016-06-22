<?php
//signup.php
include 'connect.php';
include 'header.php';

echo '<h3>Criar conta</h3><br />';

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    /*the form hasn't been posted yet, display it
	  note that the action="" will cause the form to post to the same page it is on */
    echo '<form method="post" action="">
 	 	Username: <input type="text" name="user_name" /><br />
 		Password: <input type="password" name="user_pass"><br />
		Password novamente: <input type="password" name="user_pass_check"><br />
		E-mail: <input type="email" name="user_email"><br />
 		<input type="submit" value="Criar conta" />
 	 </form>';
}
else
{
    /* so, the form has been posted, we'll process the data in three steps:
		1.	Check the data
		2.	Let the user refill the wrong fields (if necessary)
		3.	Save the data 
	*/
	$errors = array(); /* declare the array for later use */
	
	if(isset($_POST['user_name']))
	{
		//the user name exists
		if(!ctype_alnum($_POST['user_name']))
		{
			$errors[] = 'O username só pode conter letras e números. Sugestão: O seu primeiro nome e último nome, sem espaços';
		}
		if(strlen($_POST['user_name']) > 30)
		{
			$errors[] = 'O username não pode ter mais de 30 caracteres';
		}
	}
	else
	{
		$errors[] = 'O campo de username não pode estar vazio.';
	}
	
	
	if(isset($_POST['user_pass']))
	{
		if($_POST['user_pass'] != $_POST['user_pass_check'])
		{
			$errors[] = 'As duas passwords não estão iguais.';
		}
	}
	else
	{
		$errors[] = 'O campo da password não pode estar vazio.';
	}
	
	if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
	{
		echo 'Oops.. alguns campos não estão preenchidos devidamente.<br /><br />';
		echo '<ul>';
		foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
		{
			echo '<li>' . $value . '</li>'; /* this generates a nice error list */
		}
		echo '</ul>';
	}
	else
	{
		//the form has been posted without, so save it
		//notice the use of mysql_real_escape_string, keep everything safe!
		//also notice the sha1 function which hashes the password
		$sql = "INSERT INTO
					users(user_name, user_pass, user_email ,user_date, user_level)
				VALUES('" . mysql_real_escape_string($_POST['user_name']) . "',
					   '" . sha1($_POST['user_pass']) . "',
					   '" . mysql_real_escape_string($_POST['user_email']) . "',
						NOW(),
						0)";
						
		$result = mysql_query($sql);
		if(!$result)
		{
			//something went wrong, display the error
			echo 'Algo correu mal com o seu registo. Por favor tente novamente.';
			//echo mysql_error(); //debugging purposes, uncomment when needed
		}
		else
		{
			echo 'Registo realizado com sucesso. Pode agora <a href="signin.php">Entrar</a> na sua conta e participar no fórum de discussão!';
		}
	}
}

include 'footer.php';
?>
