
<?php
// Replace 'YOUR_BOT_TOKEN' with your actual Telegram bot token
$botToken = '6436756389:AAFHfb-KgoWbpvj7YC_eQlIHgwJvHyeeUjY';

// Replace 'YOUR_CHAT_ID' with your actual Telegram chat ID
$chatId = 'ReceiveWebMessage1Bot';

// Check if the form has been submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'message' field is set in the POST data
    if (isset($_POST['message'])) {
        $message = $_POST['message'];

        // Send message to Telegram bot
        $url = "https://api.telegram.org/bot$botToken/sendMessage";
        $data = [
            'chat_id' => $chatId,
            'text' => $message,
        ];

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query($data),
            ],
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        // Handle the result as needed
        if ($result === false) {
            echo "Error sending message to Telegram bot.";
        } else {
            echo "Message sent successfully!";
        }
    } else {
        echo "Error: 'message' field is not set in the POST data.";
    }
} else {
    echo "Error: Form not submitted using POST method.";
}
?>
