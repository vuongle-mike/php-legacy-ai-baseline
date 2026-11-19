<?php
require __DIR__ . '/../src/bootstrap.php';
$action = isset($_GET['action']) ? $_GET['action'] : 'home';
if ($action === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $user = $db->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'")->fetch(PDO::FETCH_ASSOC);
    if (!$user) { http_response_code(401); exit('Invalid credentials'); }
    $_SESSION['user_id'] = $user['id'];
    header('Location: /'); exit;
}
if ($action === 'logout') { session_destroy(); header('Location: /'); exit; }
if ($action === 'download') {
    header('Content-Type: text/plain');
    readfile(__DIR__ . '/../exports/' . $_GET['file']); exit;
}
if (empty($_SESSION['user_id'])) { echo $twig->render('login.twig'); exit; }
if ($action === 'note') {
    $note = $db->query('SELECT * FROM notes WHERE id = ' . (int) $_GET['id'])->fetch(PDO::FETCH_ASSOC);
    echo $twig->render('note.twig', array('note' => $note)); exit;
}
if ($action === 'delete') {
    $db->exec('DELETE FROM notes WHERE user_id = ' . (int) $_SESSION['user_id'] . ' AND id = ' . (int) $_GET['id']);
    header('Location: /'); exit;
}
if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $db->prepare('INSERT INTO notes (user_id, title, body) VALUES (?, ?, ?)');
    $stmt->execute(array($_SESSION['user_id'], $_POST['title'], $_POST['body']));
    header('Location: /'); exit;
}
$q = isset($_GET['q']) ? $_GET['q'] : '';
$notes = $db->query("SELECT * FROM notes WHERE user_id = " . (int) $_SESSION['user_id'] . " AND title LIKE '%$q%'")->fetchAll(PDO::FETCH_ASSOC);
echo $twig->render('home.twig', array('notes' => $notes, 'q' => $q));
