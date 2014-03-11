<?php

$my_receiver_id = 8484;

// Leer los parametros enviados por khipu
$api_version = $_POST['api_version'];
$receiver_id = $_POST['receiver_id'];
$notification_id = $_POST['notification_id'];
$subject = $_POST['subject'];
$amount = $_POST['amount'];
$currency = $_POST['currency'];
$custom = $_POST['custom'];
$transaction_id = $_POST['transaction_id'];
$payer_email = $_POST['payer_email'];
$notification_signature = $_POST['notification_signature'];

// Creamos el string para enviar
$to_send = 'api_version=' . urlencode($api_version) .
	'&receiver_id=' . urlencode($receiver_id) .
	'&notification_id=' . urlencode($notification_id) .
	'&subject=' . urlencode($subject) .
	'&amount=' . urlencode($amount) .
	'&currency=' . urlencode($currency) .
	'&transaction_id=' . urlencode($transaction_id) .
	'&payer_email=' . urlencode($payer_email) .
	'&custom=' . urlencode($custom);


$ch = curl_init("https://khipu.com/api/1.2/verifyPaymentNotification");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $to_send . "&notification_signature=" . urlencode($notification_signature));
$response = curl_exec($ch);
curl_close($ch);

$line = "Validacion remota [Message: $to_send, Signature: $notification_signature, Valid: $response]\n";

$myFile = 'demo-khipu-js.log';
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, print_r($_REQUEST, true));
fwrite($fh, $line);

if ($transaction_id == 'demo-js-transaction-1' && $response == 'VERIFIED' && $receiver_id == $my_receiver_id) {
	$headers = 'From: "Vyreal" <no-responder@khipu.com>' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$subject = 'La compra de prueba funciona';
	$body = <<<EOF
Hola<br/>
<br/>
<p>
Recibes este correo pues el pago de prueba fue conciliado por khipu
</p>

EOF;
	mail($custom, $subject, $body, $headers);
	fwrite($fh, "Enviado $subject a $custom");
}
fclose($fh);
