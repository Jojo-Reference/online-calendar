$sql = "CREATE INDEX idx_username ON users (username)";
$conn->query($sql);

$sql = "CREATE INDEX idx_email ON users (email)";
$conn->query($sql);

$username = "example_user";
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

$email = "example@example.com";
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql)