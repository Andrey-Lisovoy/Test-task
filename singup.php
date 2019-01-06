<?php
	require "db.php";

	$data = $_POST;

	if( isset($data['do_singup']) )
	{
		$errors = array();
		if( trim($data['login']) == '' )
		{
			$errors[] = 'Введите логин';
		}
		if( trim($data['email']) == '' )
		{
			$errors[] = 'Введите email';
		}
		if( $data['password'] == '' )
		{
			$errors[] = 'Введите пароль';
		}
		if( $data['password_2'] != $data['password'])
		{
			$errors[] = 'Повторный пароль введен неверно';
		}
		if( R::count('users', "login = ?", array($data['login'])) > 0 )
		{
			$errors[] = 'Пользователь с таким логином уже существует';
		}
		if( R::count('users', "email = ?", array($data['email'])) > 0 )
		{
			$errors[] = 'Данный email уже существует';
		}		
		if( empty($errors) )
		{
			$user = R::dispense('users');
			$user->login = $data['login'];
			$user->email = $data['email'];
			$user->password = password_hash($data['password'], PASSWORD_DEFAULT);
			R::store($user);
			$_SESSION['logged_user'] = $user;
			header('Location: /');
		} else
		{
			echo '<div style="color: red; text-align: center;">'.array_shift($errors).'</div><hr>';
		}
	}
?>	

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Тестовое задание</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link rel="stylesheet" href="main.css">
</head>
<body>
	<h2>Регистрация</h2>
	<form action="singup.php" method="POST">
		<div>
			<input type="text" name="login" placeholder="Придумайте логин" value="<?php echo @$data['login']; ?>">
			<input type="email" name="email" placeholder="Введите свой email" value="<?php echo @$data['email']; ?>">
			<input type="password" name="password" placeholder="Придумайте пароль">
			<input type="password" name="password_2" placeholder="Введите ваш пароль еще раз">
			<input class="button" type="submit" name="do_singup" value="Зарегистрироваться"></input>
		</div>
	</form>
</body>
</html>
