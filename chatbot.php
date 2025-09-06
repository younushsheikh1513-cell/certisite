<?php
// chatbot.php
header("Content-Type: application/json");

// Get input message from frontend
$data = json_decode(file_get_contents("php://input"), true);
$userMessage = strtolower(trim($data["message"] ?? ""));

$reply = "Sorry, I could not understand your question.";

// Simple rules for replies
if(strpos($userMessage, "hello") !== false || strpos($userMessage, "hi") !== false){
    $reply = "Hello! How can I assist you regarding certificates?";
}
else if(strpos($userMessage, "certificate") !== false){
    $reply = "You can apply for certificate from the Application Form button on the left.";
}
else if(strpos($userMessage, "transcript") !== false){
    $reply = "Transcript application is also available from the Application Form button.";
}
else if(strpos($userMessage, "help") !== false){
    $reply = "Sure! I can help you with certificate application, transcript process, and login issues.";
}
else if(strpos($userMessage, "bye") !== false){
    $reply = "Goodbye! Have a nice day.";
}

echo json_encode(["reply" => $reply]);
?>
