<?php
include('constants.php');

function khipu_do_call_json($endpoint, $data)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, KHIPU_URL . $endpoint );
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	$output = curl_exec($ch);
	curl_close($ch);
	return $output;
}

function khipu_do_call($endpoint, $data) {
	$json = khipu_do_call_json($endpoint, $data);
	return json_decode($json, true);
}

function khipu_get_banks()
{
	$receiver_id = RECEIVER_ID;
	$secret = SECRET;
	$concatenated = "receiver_id=" . $receiver_id;
	$hash = hash_hmac('sha256', $concatenated, $secret);
	$data = array(
		'receiver_id' => $receiver_id,
		'hash' => $hash
	);

	$json = khipu_do_call('receiverBanks', $data);
	return $json['banks'];
}

function khipu_get_new_payment($email, $bankId) {
	$receiver_id = RECEIVER_ID;
	$secret = SECRET;

	$subject = 'Ejemplo de pago usando biblioteca Javascript de khipu';
	$body = 'Este es un pago de pruebas para usar la biblioteca khipu.';
	$bank_id = $bankId;
	$amount = '1';
	$payer_email = $email;
	$notify_url = NOTIFY_URL;
	$return_url = RETURN_URL;
	$cancel_url = '';
	$picture_url = '';
	$transaction_id = 'demo-js-transaction-1';
	$custom = $email;

	$concatenated = "receiver_id=" . $receiver_id;
	$concatenated .= "&subject=" . $subject;
	$concatenated .= "&body=" . $body;
	$concatenated .= "&amount=" . $amount;
	$concatenated .= "&payer_email=" . $payer_email;
	$concatenated .= "&bank_id=" . $bank_id;
	$concatenated .= "&transaction_id=" . $transaction_id;
	$concatenated .= "&custom=" . $custom;
	$concatenated .= "&notify_url=" . $notify_url;
	$concatenated .= "&return_url=" . $return_url;
	$concatenated .= "&cancel_url=" . $cancel_url;
	$concatenated .= "&picture_url=" . $picture_url;

	$hash = hash_hmac('sha256', $concatenated, $secret);

	$data = array('receiver_id' => $receiver_id,
		'subject' => $subject,
		'body' => $body,
		'amount' => $amount,
		'payer_email' => $payer_email,
		'bank_id' => $bank_id,
		'transaction_id' => $transaction_id,
		'custom' => $custom,
		'notify_url' => $notify_url,
		'return_url' => $return_url,
		'cancel_url' => $cancel_url,
		'picture_url' => $picture_url,
		'hash' => $hash
	);

	return khipu_do_call_json('createPaymentURL', $data);
}
