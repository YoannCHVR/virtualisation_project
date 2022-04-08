<?php
// I assume that you've created a new username 'user' with password 'user' for a demo purpose
$host = 'mysql';
$user = 'user';
$pass = 'root';
$db = 'db';

try {
    $pdo = new PDO('mysql:host=mysql;dbname=db', $user, $pass);

} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>

<?php

$data = json_decode(file_get_contents("php://input"));

$name = $data->name;
$email = $data->email;
$pwd = $data->pwd;

$sql = "INSERT INTO users (name, email, pwd) VALUES (:name, :email, :pwd)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    'name' => $name,
    'email' => $email,
    'pwd' => $pwd,
]);

echo "User has been added.";

$pdo=null;
exit;

?>
