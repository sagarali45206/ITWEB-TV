<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Generate a unique token
        $token = bin2hex(random_bytes(16));

        // Store the token in the database
        $conn = new mysqli('localhost', 'id22077459_sagarali', 'Sagarali@4520', 'id22077459_capstone');

        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        // Check if email exists in the users table
        $stmt = $conn->prepare('SELECT * FROM appusers WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Insert the reset token into the password_resets table
            $stmt = $conn->prepare('INSERT INTO password_resets (email, token) VALUES (?, ?)');
            $stmt->bind_param('ss', $email, $token);
            $stmt->execute();
            $stmt->close();
            echo 'Your password reset token is: ' . $token;
        } else {
            echo 'Email address not found.';
        }

        $conn->close();
    } else {
        echo 'Invalid email address.';
    }
} else {
    echo 'Invalid request method.';
}
?>
