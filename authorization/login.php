<?php

	require 'db.php';
	$data = $_POST;
	if ( isset($data['do_login'])){
		$errors = array();
		$user = R::findOne('user', 'login = ?', array($data['login']));
		if ($user) {
			if(password_verify($data['password'], $user->password)){
				$_SESSION['logged_user'] = $user;
				 echo '<div style="color:green;"> Вы вошли! <br> Можете перейти на <a href="/">главную</a> страницу! </div><hr>';
			} else {
				$errors[] = 'Не верно введен пароль';
			}
		} else {
			$errors[] = 'Пользователь с таким логином не найден!';
		}
		if( ! empty($errors) ){
				 echo '<div style="color:red;">'.array_shift($errors). '</div><hr>';
			 }

	}
	?>
<body style="background-color:#13111f;">
	
</body>
