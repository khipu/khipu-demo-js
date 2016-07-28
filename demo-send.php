<?php
require __DIR__ . '/vendor/autoload.php';
include('constants.php');
if (!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
	header('Location: index.php?invalid=true');
	return;
}

$configuration = new Khipu\Configuration();
$configuration->setReceiverId(RECEIVER_ID);
$configuration->setSecret(SECRET);
// $configuration->setDebug(true);

$client = new Khipu\ApiClient($configuration);
$payments = new Khipu\Client\PaymentsApi($client);


try {
    $opts = array(
        "body" => "Este es un pago de pruebas para usar la biblioteca khipu.",
        "bank_id" => $_REQUEST['bankId'],
        "payer_email" => $_REQUEST['email'],
        "return_url" => RETURN_URL,
        "notify_url" => NOTIFY_URL,
        "notify_api_version" => "1.3"
    );
    $response = $payments->paymentsPost("Ejemplo de pago usando biblioteca Javascript de khipu" //Motivo de la compra
        , "CLP" //Moneda
        , 100.0 //Monto
        , $opts );

    header('Location: process.php?id='. $response->getPaymentId().'&url='.$response->getPaymentUrl().'&ready_for_terminal='.$response->getReadyForTerminal());
} catch (\Khipu\ApiException $e) {
    echo print_r($e->getResponseBody(), TRUE);
}