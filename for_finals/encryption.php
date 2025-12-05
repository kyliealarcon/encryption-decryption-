<!DOCTYPE html>
<head>
<title>Encrypt Text</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Encrypt Text</h2>

<form method="POST">
    <input type="text" name="text" placeholder="Enter text" required>
    <button type="submit" name="encrypt">Encrypt</button>
</form>

<br><a href="home.php">back to home page </a> 

<?php
include("db.php");
if(isset($_POST['encrypt'])){
    $text = $_POST['text'];

   
    $mapping = [];
    $res = mysqli_query($conn,"SELECT original_letter, assigned_value FROM unique_values ORDER BY original_letter ASC");
    while($row = mysqli_fetch_assoc($res)){
        $mapping[$row['original_letter']] = $row['assigned_value'];
    }

    function encrypt_text($text, $mapping){
        $chars = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY);
        $encrypted = '';
        foreach($chars as $c){
            $upper = strtoupper($c);
            if(isset($mapping[$upper])){
                $encrypted .= ctype_upper($c) ? $mapping[$upper] : strtolower($mapping[$upper]);
            } else {
                $encrypted .= $c;
            }
        }
        return $encrypted;
    }

    $encrypted = encrypt_text($text, $mapping);

    $stmt = $conn->prepare("INSERT INTO messages (encrypted_text, decrypted_text) VALUES (?, ?)");
    $stmt->bind_param("ss", $encrypted, $text);
    $stmt->execute();
    $stmt->close();

    echo "<p class='result'> Encrypted Text: " . htmlspecialchars($encrypted) . "</p>";
}
?>
</body>
</html>
