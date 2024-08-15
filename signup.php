<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Database connection
    $conn = new mysqli('localhost', 'id22077459_sagarali', 'Sagarali@4520', 'id22077459_capstone');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO appusers (firstname, email, phone, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $firstname, $email, $phone, $password);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "User registered successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "User registration failed"]);
    }

    $stmt->close();
    $conn->close();
}
?>
