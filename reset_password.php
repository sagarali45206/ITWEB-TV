// reset_password.php
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $token = $_POST['token'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($token) && !empty($new_password)) {
         $conn = new mysqli('localhost', 'id22077459_sagarali', 'Sagarali@4520', 'id22077459_capstone');

        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        // Check if the token is valid
        $stmt = $conn->prepare('SELECT * FROM password_resets WHERE email = ? AND token = ?');
        $stmt->bind_param('ss', $email, $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Update the user's password
            $stmt = $conn->prepare('UPDATE appusers SET password = ? WHERE email = ?');
            $stmt->bind_param('ss', $new_password, $email);
            $stmt->execute();

            // Delete the used token
            $stmt = $conn->prepare('DELETE FROM password_resets WHERE email = ? AND token = ?');
            $stmt->bind_param('ss', $email, $token);
            $stmt->execute();

            echo 'Your password has been reset successfully.';
        } else {
            echo 'Invalid reset token.';
        }

        $stmt->close();
        $conn->close();
    } else {
        echo 'Invalid email address, token, or password.';
    }
} else {
    echo 'Invalid request method.';
}
?>
