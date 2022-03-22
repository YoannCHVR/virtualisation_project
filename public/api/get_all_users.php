<?php
// I assume that you've created a new username 'user' with password 'user' for a demo purpose
$host = 'mysql';
$user = 'user';
$pass = 'root';
$db = "db";

try {
    $pdo = new PDO('mysql:host=mysql;dbname=db', $user, $pass);

} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>

<?php

$sql = "SELECT * FROM users";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($users);

$pdo=null;

?>
