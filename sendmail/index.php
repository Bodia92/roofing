<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Налаштування відправки
require './config.php';
$name = $_POST['name'] ?? '';
$phone = $_POST['phone'] ?? '';
$messageText = $_POST['message'] ?? '';
//Від кого лист
$mail->setFrom('roofing@gmail.com', 'Сайт ROOFING'); // Вказати потрібний E-mail
//Кому відправити
$mail->addAddress('bodiakpi1992@gmail.com'); // Вказати потрібний E-mail
//Тема листа
$mail->Subject = 'Нове звернення з сайту';

//Тіло листа
$body = "
<h2>Нове звернення з форми ROOFING</h2>
<p><strong>Ім’я:</strong> {$name}</p>
<p><strong>Телефон:</strong> {$phone}</p>
<p><strong>Повідомлення:</strong><br>{$messageText}</p>
";

//if(trim(!empty($_POST['email']))){
//$body.=$_POST['email'];
//}

/*
 //Прикріпити файл
 if (!empty($_FILES['image']['tmp_name'])) {
  //шлях завантаження файлу
  $filePath = __DIR__ . "/files/sendmail/attachments/" . $_FILES['image']['name'];
  //грузимо файл
  if (copy($_FILES['image']['tmp_name'], $filePath)){
   $fileAttach = $filePath;
   $body.='<p><strong>Фото у додатку</strong>';
   $mail->addAttachment($fileAttach);
  }
 }
 */

$mail->Body = $body;

//Відправляємо
try {
    $mail->send();
    $response = ['message' => 'Дані надіслані!'];
} catch (Exception $e) {
    $response = ['message' => 'Помилка: ' . $mail->ErrorInfo];
}

header('Content-type: application/json');
echo json_encode($response);
