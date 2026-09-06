<?php
require_once '../auth.php';
requireAdmin();
require_once '../include/db.php';

header('Content-Type: application/json');

$action = $_POST['action'] ?? 'save';
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

try {
    if ($action === 'delete') {
        if ($id <= 0) {
            throw new Exception('Invalid post.');
        }

        $stmt = $pdo->prepare('DELETE FROM posts WHERE id = ?');
        $stmt->execute([$id]);
    } else {
        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');

        if ($title === '' || $content === '') {
            throw new Exception('Title and content are required.');
        }

        if ($id > 0) {
            $stmt = $pdo->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
            $stmt->execute([$title, $content, $id]);
        } else {
            $stmt = $pdo->prepare('INSERT INTO posts (title, content) VALUES (?, ?)');
            $stmt->execute([$title, $content]);
        }
    }

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
