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

$sql = "DELETE FROM users ";
$sql .= "WHERE id = '" . $data->id . "'";

$stmt = $pdo->prepare($sql);
$stmt->execute();

echo "User has been deleted.";

$pdo=null;
exit;

?>
