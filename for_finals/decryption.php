<!DOCTYPE html>
<head>
    <title>Decrypt Text</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Decrypt Text</h2>

<form method="POST">
    <input type="text" name="text" placeholder="Enter encrypted text" required>
    <button type="submit" name="decrypt">Decrypt</button>
</form>
<br>
    <a href="home.php"> back to home page </a> 
<?php
    include("db.php");
    if(isset($_POST['decrypt'])){
    $text = $_POST['text'];
   
    $mapping = [];
    $res = mysqli_query($conn,"SELECT original_letter, assigned_value FROM unique_values ORDER BY original_letter ASC");
    while($row = mysqli_fetch_assoc($res)){
        $mapping[$row['original_letter']] = $row['assigned_value'];
    }

   
    function decrypt_text($text, $mapping){
        $reverse = array_flip($mapping);
        $chars = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY);
        $decrypted = '';
        foreach($chars as $c){
            $upper = strtoupper($c);
            if(isset($reverse[$upper])){
                $decrypted .= ctype_upper($c) ? $reverse[$upper] : strtolower($reverse[$upper]);
            } else {
                $decrypted .= $c;
            }
        }
        return $decrypted;
    }

    $decrypted = decrypt_text($text, $mapping);

    $stmt = $conn->prepare("INSERT INTO messages (encrypted_text, decrypted_text) VALUES (?, ?)");
    $stmt->bind_param("ss", $text, $decrypted);
    $stmt->execute();
    $stmt->close();

    echo "<p class='result'> Decrypted Text: " . htmlspecialchars($decrypted) . "</p>";
}
?>
</body>
</html>