<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $database = "feedback";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $rating = $_POST["feedback"];
    $comments = $_POST["comments"];

   
    date_default_timezone_set('Asia/Kolkata'); 
    $created_at = date('Y-m-d H:i:sP'); 

    $sql = "INSERT INTO feedback_table (feedbackrate, expression, created_at) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $rating, $comments, $created_at);
    if ($stmt->execute()) {
        header("Location: index.html");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
