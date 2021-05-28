<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru', 'phpmailer/language/');
	$mail->IsHTML(true);

	//От кого письмо
	if (trim(!empty($_POST['name'])) && trim(!empty($_POST['email']))){
		$mail->setFrom($_POST['email'], $_POST['name']);
	}
	//Кому отправить
	$mail->addAddress('gluk-90@list.ru');
	//Тема письма
	$mail->Subject = 'Здравствуйте, унжна консультация"';


	//Тело письма
	$body = '<h1>Здравствуйте, унжна консультация</h1>';
	
	if(trim(!empty($_POST['name']))){
		$body.='<p><strong>Имя:</strong> '.$_POST['name'].'</p>';
	}
	if(trim(!empty($_POST['email']))){
		$body.='<p><strong>E-mail:</strong> '.$_POST['email'].'</p>';
	}
	
	if(trim(!empty($_POST['message']))){
		$body.='<p><strong>Сообщение:</strong> '.$_POST['message'].'</p>';
	}
	
	

	//Отправляем
	try {
		if (!$mail->send()) {
			$message = 'Ошибка';
		} else {
			$message = 'Данные отправлены!';
		}
	} catch (\Exception $e) {
		$message = $e->getMessage();
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>
