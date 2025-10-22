<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"] ?? "";
    $email = $_POST["email"] ?? "";
    $message = $_POST["message"] ?? "";

    if (!empty($name) && !empty($email) && !empty($message)) {
        $data = [
            "name" => $name,
            "email" => $email,
            "message" => $message,
            "timestamp" => date("Y-m-d H:i:s")
        ];

        $file = __DIR__ . '/messages.json'; // store in same folder
        $existingData = [];

        if (file_exists($file)) {
            $json = file_get_contents($file);
            $existingData = json_decode($json, true) ?? [];
        }

        $existingData[] = $data;

        file_put_contents($file, json_encode($existingData, JSON_PRETTY_PRINT));

        echo "<script>alert('✅ Message sent successfully!'); window.location.href='index.html#contact';</script>";
        exit;
    } else {
        echo "<script>alert('❌ Please fill out all fields!'); window.location.href='index.html#contact';</script>";
    }
} else {
    http_response_code(405);
    echo "❌ Method Not Allowed. Use POST only.";
}
?>
