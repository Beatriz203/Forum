<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
<head>
 	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 	<meta name="description" content="A short description." />
 	<meta name="keywords" content="put, keywords, here" />
 	<title>Fórum de Discussão</title>
	<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<h1>Método de Delphi - Resistência Antibiótica</h1>
	<div id="wrapper">
	<div id="menu">
		<a class="item" href="/ist173150/index.php">Página Inicial</a> -
		<a class="item" href="/ist173150/create_topic.php">Criar um Tópico Novo</a> -
		<a class="item" href="/ist173150/create_cat.php">Criar uma Categoria Nova</a>
		
		<div id="userbar">
		<?php
		if($_SESSION['signed_in'])
		{
			echo 'Bem-vindo <b>' . htmlentities($_SESSION['user_name']) . '</b>. Não é? <a class="item" href="signout.php">Sair</a>';
		}
		else
		{
			echo '<a class="item" href="signin.php">Entrar</a> ou <a class="item" href="signup.php">Criar uma Conta</a>';
		}
		?>
		</div>
	</div>
		<div id="content">