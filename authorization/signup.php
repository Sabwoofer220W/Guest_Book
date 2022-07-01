<?php

	require 'db.php';

		$data = $_POST;
		 if( isset($data['do_signup']) ){

			 $errors = array();
			 if( trim($data['login']) == '' ){
				 $errors[] = 'Введите логин!';
			 }

			 if( trim($data['email']) == '' ){
				 $errors[] = 'Введите почту!';
			 }

			 if( $data['password'] == '' ){
				 $errors[] = 'Введите пароль!';
			 }

			 if( $data['password_2'] != $data['password'] ){
				 $errors[] = 'Провторный пароль введен не верно!';
			 }

			 if( R::count('user', "login = ?", array($data['login'])) > 0 ){
				 $errors[] = 'Пользователь с таким логином уже существует';
			 }

			 if( R::count('user', "email = ?", array($data['email'])) > 0 ){
				 $errors[] = 'Пользователь с такой почтой уже существует';
			 }

			 if( empty($errors) ){
				 $user = R::dispense('user');
				 $user->login = $data['login'];
				 $user->email = $data['email'];
				 $user->password = password_hash( $data['password'], PASSWORD_DEFAULT);
				 R::store($user);
				 echo '<div style="color:green;"> Вы успешно зарегистрированы </div><hr>';
			 } else {
				echo '<div style="color:red;">'.array_shift($errors). '</div><hr>';
			 }
		 }

?>
	<body style="background-color:#13111f; color:white; text-align:center;padding:10px;">
		<form style="margin: 15% auto;" action="./signup.php" method="POST">
	<p style="text-align:center;"> <h2 style="text-align:center;">Регистрация</h2> </p>
			<p> <strong>Логин:</strong><br>
				<input type="text" name="login" value="<?php echo @$data[
				'login']; ?>">
			</p>
			<p> <strong>Почта:</strong><br>
				<input type="email" name="email" value="<?php echo @$data[
				'email']; ?>">
			</p>
			<p> <strong>Пароль:</strong><br>
				<input type="password" name="password" value="<?php echo @$data[
				'password']; ?>">
			</p>
			<p> <strong>Повторите пароль:</strong><br>
				<input type="password" name="password_2" value="<?php echo @$data[
				'password_2']; ?>">
			</p>
			<button type="submit" name='do_signup'>Зарегистрироваться</button>
			<p style="text-align:center;"> <a href="/authorization/login.php">Вы уже зарегистрированы? </a> </p>
			<p style="text-align:center;"> <a href="/">На главную</a> </p>
		</form>
</body>
