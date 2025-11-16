<?php
// Test password hashing compatibility
require_once 'api/config.php';

$conn = get_db_connection();

// Test password
$test_password = "hero123";
$test_username = "hero";

// Get the stored hash from database
$stmt = $conn->prepare("SELECT password_hash FROM players WHERE username = ?");
$stmt->execute([$test_username]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    echo "Username: $test_username\n";
    echo "Stored hash: " . $result['password_hash'] . "\n";
    echo "Hash length: " . strlen($result['password_hash']) . "\n";
    echo "Hash starts with: " . substr($result['password_hash'], 0, 7) . "\n\n";
    
    // Test verification
    if (password_verify($test_password, $result['password_hash'])) {
        echo "✓ Password verification SUCCESSFUL\n";
    } else {
        echo "✗ Password verification FAILED\n";
    }
    
    // Create a new hash for comparison
    $new_hash = password_hash($test_password, PASSWORD_BCRYPT);
    echo "\nNew PHP bcrypt hash: $new_hash\n";
    echo "New hash length: " . strlen($new_hash) . "\n";
    
} else {
    echo "User '$test_username' not found in database\n";
}
?>
