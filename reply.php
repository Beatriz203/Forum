<?php
//create_cat.php
include 'connect.php';
include 'header.php';

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	//someone is calling the file directly, which we don't want
	echo 'Este ficheiro não pode ser executado directamente.';
}
else
{
	//check for sign in status
	if(!$_SESSION['signed_in'])
	{
		echo 'Deve clicar em Entrar para responder a um tópico.';
	}
	else
	{
		//a real user posted a real reply
		$sql = "INSERT INTO 
					posts(post_content,
						  post_date,
						  post_topic,
						  post_by) 
				VALUES ('" . $_POST['reply-content'] . "',
						NOW(),
						" . mysql_real_escape_string($_GET['id']) . ",
						" . $_SESSION['user_id'] . ")";
						
		$result = mysql_query($sql);
						
		if(!$result)
		{
			echo 'A sua resposta não foi gravada, por favor tente novamente.';
		}
		else
		{
			echo 'A sua resposta foi gravada com sucesso. Aceda <a href="topic.php?id=' . htmlentities($_GET['id']) . '">aqui ao tópico</a>.';
		}
	}
}

include 'footer.php';
?>