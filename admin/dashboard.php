<?php
require_once '../auth.php';

if (!isAdmin()) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Simple Blog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
            <h1>Manage Posts</h1>
            <div>
                <a href="../index.html" class="btn btn-secondary">View Blog</a>
                <a href="change-password.php" class="btn btn-link">Change Password</a>
                <a href="logout.php" class="btn btn-link">Log Out</a>
            </div>
        </div>

        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#postModal" onclick="newPost()">Add Post</button>
        <div id="posts"></div>
    </div>

    <div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="postModalLabel">Add Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="postForm">
                        <input type="hidden" id="postId">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" required>
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control" id="content" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="admin.js"></script>
</body>
</html>
