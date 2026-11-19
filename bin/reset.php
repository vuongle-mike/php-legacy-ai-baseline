<?php
@mkdir(__DIR__ . '/../var', 0777, true);
$file = __DIR__ . '/../var/app.sqlite';
if (file_exists($file)) { unlink($file); }
$db = new PDO('sqlite:' . $file);
$db->exec('CREATE TABLE users (id INTEGER PRIMARY KEY, username TEXT UNIQUE, password TEXT)');
$db->exec('CREATE TABLE notes (id INTEGER PRIMARY KEY, user_id INTEGER, title TEXT, body TEXT)');
$stmt = $db->prepare('INSERT INTO users VALUES (?, ?, ?)');
$stmt->execute(array(1, 'alice', md5('alice-demo')));
$stmt->execute(array(2, 'bob', md5('bob-demo')));
$db->exec("INSERT INTO notes VALUES (1, 1, 'Alice note', 'Synthetic Alice content'), (2, 2, 'Bob note', 'Synthetic Bob content')");
echo "Reset complete (synthetic data only).\n";
