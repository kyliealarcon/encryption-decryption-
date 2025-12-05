<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dynamic Key</title>
<link rel="stylesheet" href="style.css">
<script>
function fillAssignedValue() {
    var select = document.getElementById("keySelect");
    var input = document.getElementById("newAssigned");
    var selectedOption = select.options[select.selectedIndex].text.split("→");
    if (selectedOption.length == 2) {
        input.value = selectedOption[1].trim();
    } else {
        input.value = "";
    }
}
</script>
</head>
<body>
<div class="hero">
<div class="container box">

<h2>Dynamic Key</h2>

<?php
session_start();
include("db.php");

// Functions
function getMapping($conn) {
    $map = [];
    $res = mysqli_query($conn, "SELECT original_letter, assigned_value FROM unique_values ORDER BY id ASC");
    while ($row = mysqli_fetch_assoc($res)) {
        $map[$row['original_letter']] = $row['assigned_value'];
    }
    return $map;
}

function recalcMessages($conn) {
    $mapping = getMapping($conn);
    $messages = mysqli_query($conn, "SELECT * FROM messages");
    while ($row = mysqli_fetch_assoc($messages)) {
        $text = $row['decrypted_text'];
        $encrypted = "";
        foreach (str_split($text) as $c) {
            $upper = strtoupper($c);
            $encrypted .= isset($mapping[$upper])
                ? (ctype_upper($c) ? $mapping[$upper] : strtolower($mapping[$upper]))
                : $c;
        }
        $stmt = $conn->prepare("UPDATE messages SET encrypted_text=? WHERE id=?");
        $stmt->bind_param("si", $encrypted, $row['id']);
        $stmt->execute();
    }
}

// Display message
if(isset($_SESSION['message'])) {
    echo "<p class='result'>" . htmlspecialchars($_SESSION['message']) . "</p>";
    unset($_SESSION['message']);
}

// Reset Keys
if(isset($_POST['reset'])) {
    mysqli_query($conn, "TRUNCATE TABLE unique_values");
    $originals = [
        ['A','Q'], ['B','8'], ['C','T'], ['D','2'], ['E','R'], ['F','-'], ['G','J'], ['H','4'],
        ['I','M'], ['J','9'], ['K','E'], ['L','!'], ['M','P'], ['N','$'], ['O','3'], ['P','Z'],
        ['Q','S'], ['R','H'], ['S','A'], ['T','C'], ['U','K'], ['V','X'], ['W','7'], ['X','Y'],
        ['Y','N'], ['Z','6'], ['0','L'], ['1','O'], ['2','5'], ['3','U'], ['4','F'], ['5','D'],
        ['6','W'], ['7','V'], ['8','I'], ['9','B']
    ];
    $stmt = $conn->prepare("INSERT INTO unique_values (original_letter, assigned_value, created_at) VALUES (?, ?, NOW())");
    foreach($originals as $pair) {
        $stmt->bind_param("ss", $pair[0], $pair[1]);
        $stmt->execute();
    }
    recalcMessages($conn);
    unset($_SESSION['recent_updates']);
    $_SESSION['message'] = "All keys have been reset!";
    header("Location: ".$_SERVER['PHP_SELF']); exit;
}

// Update Key
if(isset($_POST['update'])) {
    $id = $_POST['id'] ?? "";
    $new_assigned = trim($_POST['new_assigned'] ?? "");

    if($id == "" || $new_assigned == "") {
        $_SESSION['message'] = "Please select a key and enter a new value.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM unique_values WHERE assigned_value=? AND id != ?");
        $stmt->bind_param("si", $new_assigned, $id);
        $stmt->execute();
        $check = $stmt->get_result();
        if($check->num_rows > 0) {
            $_SESSION['message'] = "This value already exists!";
        } else {
            $stmt2 = $conn->prepare("SELECT original_letter FROM unique_values WHERE id=?");
            $stmt2->bind_param("i", $id);
            $stmt2->execute();
            $res2 = $stmt2->get_result();
            $row2 = $res2->fetch_assoc();
            $original_letter = $row2['original_letter'];

            $stmt = $conn->prepare("UPDATE unique_values SET assigned_value=? WHERE id=?");
            $stmt->bind_param("si", $new_assigned, $id);
            $stmt->execute();

            if(!isset($_SESSION['recent_updates'])) $_SESSION['recent_updates'] = [];
            $_SESSION['recent_updates'][] = "$original_letter → $new_assigned";

            recalcMessages($conn);
            $_SESSION['message'] = "Key updated successfully!";
        }
    }
    header("Location: ".$_SERVER['PHP_SELF']); exit;
}
?>

<!-- Update Key Form -->
<form method="POST">
    <label>Select Key to Update:</label>
    <div class="select-reset-wrapper">
        <select name="id" id="keySelect" onchange="fillAssignedValue()" required>
            <option value="">-- Select Key --</option>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM unique_values ORDER BY id ASC");
            while($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['id']}'>"
                     . htmlspecialchars($row['original_letter']) . " → "
                     . htmlspecialchars($row['assigned_value']) . "</option>";
            }
            ?>
        </select>
    </div>

    <label>New Assigned Value:</label>
    <input type="text" name="new_assigned" id="newAssigned" maxlength="10" required>

    <button type="submit" name="update">Update</button>
</form>

<!-- Reset Form -->
<form method="POST" style="margin-top:20px;">
    <button type="submit" name="reset" onclick="return confirm('Are you sure? Reset all keys?');">
        Reset All Keys
    </button>
</form>

<!-- Recent Updates -->
<?php
if(isset($_SESSION['recent_updates']) && count($_SESSION['recent_updates']) > 0) {
    echo "<div class='recent-updates'><h3>Recent Updates:</h3><ul>";
    foreach($_SESSION['recent_updates'] as $update){
        echo "<li>".htmlspecialchars($update)."</li>";
    }
    echo "</ul></div>";
}
?>

<br><a href="home.php">Back to HomePage</a>

</div>
</div>
</body>
</html>
