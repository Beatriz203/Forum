<?php
//create_cat.php
include 'connect.php';
include 'header.php';

echo '<h2>Criar Categoria</h2>';
if($_SESSION['signed_in'] == false | $_SESSION['user_level'] != 1 )
{
	//the user is not an admin
	echo 'Desculpe, mas não tem permissões para aceder a esta página.';
}
else
{
	//the user has admin rights
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		//the form hasn't been posted yet, display it
		echo '<form method="post" action="">
			Nome da categoria: <input type="text" name="cat_name" /><br />
			Descrição da Categoria:<br /> <textarea name="cat_description" /></textarea><br /><br />
			<input type="submit" value="Adicionar Categoria" />
		 </form>';
	}
	else
	{
		//the form has been posted, so save it
		$sql = "INSERT INTO categories(cat_name, cat_description)
		   VALUES('" . mysql_real_escape_string($_POST['cat_name']) . "',
				 '" . mysql_real_escape_string($_POST['cat_description']) . "')";
		$result = mysql_query($sql);
		if(!$result)
		{
			//something went wrong, display the error
			echo 'Error' . mysql_error();
		}
		else
		{
			echo 'Nova Categoria adicionada com sucesso.';
		}
	}
}

include 'footer.php';
?>
