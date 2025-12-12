<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "green_army_db";

// Create connection
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
}
catch(mysqli_sql_exception){
    echo "Connection failed";
}
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the Form
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize inputs to prevent hacking
    $fullName = htmlspecialchars(trim($_POST['fullName']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $type = htmlspecialchars(trim($_POST['type']));

    // Prepare and Bind (Security Best Practice)
    $stmt = $conn->prepare("INSERT INTO volunteers (full_name, email, phone, help_type) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullName, $email, $phone, $type);

    if ($stmt->execute()) {
        // Redirect back to home page with success message (Optional) or just print success
        echo "<div style='text-align:center; padding:50px; font-family:sans-serif; background-color: #d8f3dc; 
        border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);'>
                <h1 style='color:#1b4332;'>Thank You!</h1>
                <p>Welcome to the Green Army. We will contact you shortly.</p>
                <a style='color: #1b4332; text-decoration: none; margin-left: 20px; font-weight: 600; font-size: 1rem;' 
                href='index.html'>Go Back</a>
              </div>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>