<?php
//Подключение к бд
	session_start();
//	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$host = 'localhost';
	$user = 'mysql';
	$pass = 'mysql';
	$name = 'GuestBook';

	$link = mysqli_connect($host, $user, $pass, $name);
	mysqli_query($link, "SET NAMES 'utf8'");

//Проверка на выход
	if(!empty($_POST['CheckExit'])){
		$_SESSION['auth'] = false;
	}

//вход
if (!empty($_POST['loginAuth']) and !empty($_POST['passwordAuth'])) {
		$loginAuth = $_POST['loginAuth'];
		$passwordAuth = md5($_POST['passwordAuth']);

		$query = "SELECT * FROM rank WHERE login='$loginAuth' AND password='$passwordAuth'";
		$result = mysqli_query($link, $query);
		$user = mysqli_fetch_assoc($result);

		$ErrorInputAuth = '';


		if (!empty($user)) {
			$_SESSION['auth'] = true;
			$_SESSION['id'] = $user['id'];
		} else {
			$ErrorInputAuth ='Неверный логин или пароль ';
		}
	}

//Регистрация
	if (!empty($_POST['login']) and !empty($_POST['password']) and !empty($_POST['email'])) {
		if($_POST['password'] == $_POST['password_2'] ){

		$login = $_POST['login'];
		$password = md5($_POST['password']);
		$email = $_POST['email'];

		$ErrorInput ='';

		$query = "SELECT * FROM rank WHERE login='$login'";
		$user = mysqli_fetch_assoc(mysqli_query($link, $query));

		if (empty($user)) {
			$query = "INSERT INTO rank SET login='$login', password='$password',mail='$email'";
			mysqli_query($link, $query);

			$_SESSION['auth'] = true;

			$id = mysqli_insert_id($link);
			$_SESSION['id'] = $id;

		} else {
		$ErrorInput ='Логин занят';
		}
	} else {
		$ErrorInput ='Пароль не совпадает';
	}

} else {
	$ErrorInput ='Заполните все поля!';
}

?>

<?php
//Добавление отзыва анонимно
if ($_SESSION['auth'] != true) {
		if (!empty($_POST['textAdd'])) {
			$textAdd = $_POST['textAdd'];
		}
		if ($textAdd != null) {
		$query2 = "INSERT INTO post SET username='Anonymous', text='$textAdd'";
		mysqli_query($link, $query2) or die(mysqli_error($link));
	}
	//Добавление отзыва пользователем
} else if($_SESSION['auth'] = true) {

	$query4 = "SELECT * FROM rank WHERE id='".$_SESSION['id']."'";
	$username2 = mysqli_query($link, $query4) or die(mysqli_error($link));
	$row2 = mysqli_fetch_array($username2);

	if (!empty($_POST['textAdd'])) {
		$textAdd = $_POST['textAdd'];
	}
	if ($textAdd != null) {
	$query2 = "INSERT INTO post SET username='$row2[1]', text='$textAdd'";
	mysqli_query($link, $query2) or die(mysqli_error($link));
	}
}
?>

<?php
//Изменение поста

if (!empty($_POST['FormEdittext']) and !empty($_POST['FormEditId']) and !empty($_POST['DateFormEdit'])) {
	$FormEdittext = $_POST['FormEdittext'];
	$FormEditId = $_POST['FormEditId'];
	$DateFormEdit = $_POST['DateFormEdit'];

	if( time() - strtotime($date_added) >= 2*60*60 ){
		$query5 = "UPDATE post SET text='$FormEdittext', date=CURRENT_TIMESTAMP() WHERE id=$FormEditId";
		mysqli_query($link, $query5) or die(mysqli_error($link));
	} else {

	}
} else if (!empty($_POST['FormEdittext']) and !empty($_POST['FormEditId'])) {
	$FormEdittext = $_POST['FormEdittext'];
	$FormEditId = $_POST['FormEditId'];

	$query5 = "UPDATE post SET text='$FormEdittext', date=CURRENT_TIMESTAMP() WHERE id=$FormEditId";

	mysqli_query($link, $query5) or die(mysqli_error($link));
}
?>

<?php
//Удаление поста
if (!empty($_POST['DelPost'])) {
	$DelPost = $_POST['DelPost'];
	$DelId = $_POST['DelId'];

	$query6 = "DELETE FROM post WHERE id=$DelId";

	mysqli_query($link, $query6) or die(mysqli_error($link));
}
?>

<?php
$_SESSION['idPage'] = 0;
//Перелистывание страницы в перед
if (!empty($_POST['NextPage'])) {
	$NextPage = $_POST['NextPage'];
	$_SESSION['idPage'] = $NextPage;
}
?>



<script>
if ( window.history.replaceState ) {
       window.history.replaceState( null, null, window.location.href );
   }
	 </script>



	<html>

		<head>
			<meta charset="UTF-8">
		<title>Гостевая книга</title>
		<link rel="stylesheet" type="text/css" href="css/index.css">

		</head>

		<body class="body">

    <div class="Header">
			<?php
			//Вывод кнопки выхода
			if($_SESSION['auth'] == true){

				$result2 .= '<form style="width:200px; margin: 0; padding:0;" action="/index.php" method="POST">';
				$result2 .= '<input style="display:none;" class="Header_TextEntrance2" type="text" name="CheckExit" value="true">';
				$result2 .= '<input style="position:relative; margin:13px; background: #4a4a4a;" class="Header_TextEntrance2" type="submit" value="Выйти">';
				$result2 .= '</form>';
				echo $result2;
			}
			?>
			<a class="Header_UserBlock" >
    <img class="Header_User" src="picture/user.png">
      <p class="Header_TextEntrance">

<?php
//Проверка авторизации
if (	$_SESSION['auth'] == true){
	$query3 = "SELECT * FROM rank WHERE id='".$_SESSION['id']."'";
	$username = mysqli_query($link, $query3) or die(mysqli_error($link));
	$row = mysqli_fetch_array($username);
	echo $row[1];
} else {
	echo 'Войти';
}
?>
	</p>
      </a>
			<div id="FormAuthorization" style="display:none;">
				<form style='background-color:#13111f; width:250px; color:white;  margin: 15% 40%; position:fixed;font-family: "GraphikLC",Helvetica,sans-serif;'
				action="/index.php" method="POST">

					<p style="text-align:center;"> <h2 style="text-align:center;font-size:30px;">Авторизация</h2> </p>

					<p style="text-align:center; padding:10px; font-size:20px;"> <strong>Логин:</strong><br>
							<input style="width:200px; height:30px; font-size:20px;" type="text" name="loginAuth" >
					</p>

					<p style="text-align:center;font-size:20px;"> <strong>Пароль:</strong><br>
							<input style="width:200px;height:30px;font-size:20px;" type="password" name="passwordAuth" >
						</p>
						<div style="color:red; text-align:center;" id="MessageToTheUserAuth" ></div>
						<button style="position:relative; left:78px;margin:10px; font-size:20px;" type="submit" name='do_login'>Войти</button>

							<p style="text-align:center; color:white; cursor:pointer;"> <a id="FormAuthorization_Reg">Зарегистрироваться</a> </p>
							<p style="text-align:center; color:white; cursor:pointer;"> <a id="FormAuthorization_Exit">Закрыть</a> </p>
				</form>
			</div>

			<div id="FormAuthorizationReg" style="display:none;">
			<form id="FormRegister" style='margin: 15% 40%; position:fixed;background-color:#13111f;color:white; width:250px; display:flex;flex-direction: column;align-items: center; font-family: "GraphikLC",Helvetica,sans-serif;' action="/index.php" method="POST">
		<p style="text-align:center;"> <h2 style="text-align:center;">Регистрация</h2> </p>
				<p> <strong>Логин:</strong><br>
					<input id="registerInputLogin" type="text" name="login" value='<?php echo $login ?>'>
				</p>
				<p> <strong>Почта:</strong><br>
					<input id="registerInputEmail" type="email" name="email" value='<?php echo $email ?>'>
				</p>
				<p> <strong>Пароль:</strong><br>
					<input id="registerInputPassword" type="password" name="password" value='<?php echo $password ?>'>
				</p>
				<p> <strong>Повторите пароль:</strong><br>
					<input id="registerInputPassword_2" type="password" name="password_2" >
				</p>
				<div style="color:red;" id="MessageToTheUser"></div>
				<input class="Content_submit" type="submit" name='do_signup' value="Зарегистрироваться">
				<p style="text-align:center; color:white; cursor:pointer;"> <a id="FormAuthorizationReg_Entrance">Вы уже зарегистрированы? </a> </p>
				<p style="text-align:center; color:white; cursor:pointer;"> <a id="FormAuthorizationReg_Exit">Закрыть</a> </p>
			</form>
		</div>

    </div>
<!--===========================================================================-->
  <div class="Heading">
  <h2 class="Heading_Text">Гостевая книга</h2>
  </div>
<!--===========================================================================-->
    <div></div>
<!--===========================================================================-->
    <div class="Content">
			<div class="blackout"></div>
			<div class="Content_Sort">
				<form action="/index.php" method="POST" style='margin: 10px; display:flex;justify-content: center;font-family: "GraphikLC",Helvetica,sans-serif;flex-direction: column;align-items: center;'>
					<div>
				<input type="radio" onclick="this.checked=!this.isChecked;" onmousedown="this.isChecked=this.checked;" name="Sort" value="Дата↑">Дата↑
				<input type="radio" onclick="this.checked=!this.isChecked;" onmousedown="this.isChecked=this.checked;" name="Sort" value="Дата↓">Дата↓
				</div>
				<div>
				<input type="submit" class="Content_submit" value="Сортировать">
				</div>
				</form>
			 </div>
			<div style="display:flex;flex-direction: row;justify-content: space-between;align-items: center;flex-wrap: nowrap;"> <p class="Content_PageText">Страница 1</p>
				<form action="/index.php" method="POST" style="margin: 0;">
					<input class="Content_submit" type="text" name='NextPage' value="" id="NextPage_Count" style="display:none;">
					<input class="Content_submit" type="submit" value="Показать далее -->" id="NextPage_But" >
				</form>
			</div>
			<div align="center" class="Content_FormEdit">

				<form action="/index.php" method="POST">
				Изменить текст:<textarea rows="10" cols="45" name="FormEdittext" id="Content_FormEdit_textarea"></textarea>
				<textarea id="FormEditId" type="text" style="display:none;" name="FormEditId"></textarea>
				<textarea id="DateFormEdit" type="text" style="display:none;" name="DateFormEdit"></textarea>

				<button type="submit" class="Content_submit" id="Content_FormEdit_ButEdit">Изменить</button>
				<span class="Content_submit" id="Content_FormEdit_ButBack">Отмена</span>
				</form>

			 </div>
			<img class="Content_AddIMG" src="picture/Add.png">
			<form class="Content_FormAnonimUser" action="/index.php" method="POST">
				<?php
				if ($_SESSION['auth'] == true) {
					$FormAddName .='<div>Имя:<input class="Content_FormAnonimUser_input" name="NameAdd" value=' .$row[1]. ' readonly> </div>';
					echo $FormAddName;
				}
				?>
				Текст<textarea rows="5" cols="45" name="textAdd"></textarea>
				<input class="Content_submit" type="submit">
				<div id="CancelButForm" class="Content_submit">Отмена</div>
			</form>

			<?php
			if (!empty($_POST['Sort'])){
				$Sort = $_POST['Sort'];
				if ($Sort == 'Дата↑'){
				$query = 'SELECT * FROM post ORDER BY id DESC LIMIT 10 OFFSET '.$_SESSION['idPage'];
			} else if ($Sort == 'Дата↓'){
				$query = 'SELECT * FROM post LIMIT 10 OFFSET '.$_SESSION['idPage'];
			} else {
				$query = 'SELECT * FROM post ORDER BY id DESC LIMIT 10 OFFSET '.$_SESSION['idPage'];
			}
		} else {
			$query = 'SELECT * FROM post ORDER BY id DESC LIMIT 10 OFFSET '.$_SESSION['idPage'];
		}

				$result = mysqli_query($link, $query) or die(mysqli_error($link));

				for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
				$result = '';?>

				<?php
				//Проверка авторизации
				if ($_SESSION['auth'] == true){
					$query3 = "SELECT * FROM rank WHERE id='".$_SESSION['id']."'";
					$username = mysqli_query($link, $query3) or die(mysqli_error($link));
					$row = mysqli_fetch_array($username);
				}
				?>

				<?php

					foreach ($data as $elem) {
						$result .= '<div class="Content_comments">';

						$result .='<div class="Content_comments_logo">';
						$result .='<img class="Content_comments_logo_img" src="picture/userBlack.png">';
						$result .= '</div>';

						$result .= '<div class="Content_comments_content">';

						$result .= '<div class="Content_comments_content_Data">';
						$result .= '<div>' . $elem['username'] . '</div>' . '<div id="DataPost">' . $elem['date'] . '</div>';

						//редактирование для админа
						if ($row[1] == 'Admin'){
						$result .= '<div> <a class="Content_comments_content_Data_edit" ><b>Редактировать</b><b style="font-size:1px">|'. $elem['id'].'/</b> </a> </div>';
						$result .= '<form action="/index.php" method="POST">';
						$result .= '<input type="text" style="display:none;" value="'. $elem['id'] .'" name="DelId" ></input>';
						$result .= '<input type="submit" class="Content_comments_content_Data_Delete" value="Удалить" name="DelPost" ></input> ';
						$result .= '</form>';
						$WhoCameIn = true;
						}
						//редактирование для пользователя
							if ($elem['username'] == $row[1]){
								$result .= '<div> <a class="Content_comments_content_Data_edit" ><b>Редактировать</b><b style="font-size:1px">|'. $elem['id'].'/</b> </a> </div>';
								$result .= '<form action="/index.php" method="POST">';
								$result .= '<input type="text" style="display:none;" value="'. $elem['id'] .'" name="DelId" ></input>';
								$result .= '<input type="submit" class="Content_comments_content_Data_Delete" value="Удалить" name="DelPost" ></input> ';
								$result .= '</form>';
							}

						$result .= '</div>';

						$result .= '<div class="Content_comments_content_feedback">';

						$result .= $elem['text'];

						$result .= '</div>';
						$result .= '</div>';
						$result .= '</div>';


					}
					echo $result;

				?>

    </div>
<!--===========================================================================-->
    <div class="Footer">

    </div>
<!--===========================================================================-->
<script src="js/index.js"></script>
<script>
UserVerification('<?php echo $ErrorInput; ?>');
UserVerificationAuth('<?php echo $ErrorInputAuth; ?>');
AddEditPanel('<?php echo $row[1]; ?>');
NextPage(<?php echo $_SESSION['idPage']; ?>,'<?php echo $result; ?>');
</script>
		</body>

</html>
