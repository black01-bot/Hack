<?php

header("Content-Type: application/json");

// بيانات البوت
$token = "8784939544:AAEiZBaMRV7TdG-qdbWIfKuKBsuqnHETxi8";
$chat_id = "7535564997";

// استقبال البيانات
$phone = isset($_POST['phone']) ? $_POST['phone'] : 'لا يوجد';
$amount = isset($_POST['amount']) ? $_POST['amount'] : 'لا يوجد';

// رسالة التليجرام
$message = "
📥 طلب جديد من الموقع

📞 الرقم: $phone
💰 المبلغ: $amount

🕒 الوقت: " . date("Y-m-d H:i:s");

// رابط API
$url = "https://api.telegram.org/bot".$token."/sendMessage";

// البيانات
$data = [
    'chat_id' => $chat_id,
    'text' => $message
];

// إعدادات الإرسال
$options = [
    'http' => [
        'method'  => 'POST',
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'content' => http_build_query($data),
    ]
];

// تنفيذ الطلب
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

// فحص النتيجة
if ($result === FALSE) {

    echo json_encode([
        "status" => false,
        "message" => "فشل الإرسال"
    ]);

} else {

    echo json_encode([
        "status" => true,
        "message" => "تم الإرسال"
    ]);
}

?>