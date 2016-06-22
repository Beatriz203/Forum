<?php
//create_topic.php
include 'connect.php';
include 'header.php';

echo '<h2>Criar Tópico</h2>';
if($_SESSION['signed_in'] == false)
{
	//the user is not signed in
	echo 'Desculpe, mas tem de criar uma conta ou clicar em <a href="/forum/signin.php">Entrar</a> para criar um tópico.';
}
else
{
	//the user is signed in
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{	
		//the form hasn't been posted yet, display it
		//retrieve the categories from the database for use in the dropdown
		$sql = "SELECT
					cat_id,
					cat_name,
					cat_description
				FROM
					categories";
		
		$result = mysql_query($sql);
		
		if(!$result)
		{
			//the query failed, uh-oh :-(
			echo 'Error while selecting from database. Please try again later.';
		}
		else
		{
			if(mysql_num_rows($result) == 0)
			{
				//there are no categories, so a topic can't be posted
				if($_SESSION['user_level'] == 1)
				{
					echo 'Ainda não há categorias criadas.';
				}
				else
				{
					echo 'Antes de criar um tópico deve esperar pela criação de categorias por parte do administrador.';
				}
			}
			else
			{
		
				echo '<form method="post" action="">
					Assunto: <input type="text" name="topic_subject" /><br />
					Categoria:'; 
				
				echo '<select name="topic_cat">';
					while($row = mysql_fetch_assoc($result))
					{
						echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
					}
				echo '</select><br />';	
					
				echo 'Mensagem: <br /><textarea name="post_content" /></textarea><br /><br />
					<input type="submit" value="Criar tópico" />
				 </form>';
			}
		}
	}
	else
	{
		//start the transaction
		$query  = "BEGIN WORK;";
		$result = mysql_query($query);
		
		if(!$result)
		{
			//Damn! the query failed, quit
			echo 'Ocorreu um erro na criação do tópico. Por favor tente mais tarde.';
		}
		else
		{
	
			//the form has been posted, so save it
			//insert the topic into the topics table first, then we'll save the post into the posts table
			$sql = "INSERT INTO 
						topics(topic_subject,
							   topic_date,
							   topic_cat,
							   topic_by)
				   VALUES('" . mysql_real_escape_string($_POST['topic_subject']) . "',
							   NOW(),
							   " . mysql_real_escape_string($_POST['topic_cat']) . ",
							   " . $_SESSION['user_id'] . "
							   )";
					 
			$result = mysql_query($sql);
			if(!$result)
			{
				//something went wrong, display the error
				echo 'Ocorreu um erro ao adicionar os seus dados. Por favor, tente mais tarde.<br /><br />' . mysql_error();
				$sql = "ROLLBACK;";
				$result = mysql_query($sql);
			}
			else
			{
				//the first query worked, now start the second, posts query
				//retrieve the id of the freshly created topic for usage in the posts query
				$topicid = mysql_insert_id();
				
				$sql = "INSERT INTO
							posts(post_content,
								  post_date,
								  post_topic,
								  post_by)
						VALUES
							('" . mysql_real_escape_string($_POST['post_content']) . "',
								  NOW(),
								  " . $topicid . ",
								  " . $_SESSION['user_id'] . "
							)";
				$result = mysql_query($sql);
				
				if(!$result)
				{
					//something went wrong, display the error
					echo 'Ocorreu um erro ao inserir o seu tópico, por favor tente mais tarde.<br /><br />' . mysql_error();
					$sql = "ROLLBACK;";
					$result = mysql_query($sql);
				}
				else
				{
					$sql = "COMMIT;";
					$result = mysql_query($sql);
					
					//after a lot of work, the query succeeded!
					echo 'O tópico foi criado com sucesso. <a href="topic.php?id='. $topicid . '">Clique aqui para poder vê-lo.</a>.';
				}
			}
		}
	}
}

include 'footer.php';
?>
