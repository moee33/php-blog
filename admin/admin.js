$(document).ready(function() {
    loadPosts();

    $('#postForm').submit(function(event) {
        event.preventDefault();

        $.ajax({
            url: '../src/post-handler.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'save',
                id: $('#postId').val(),
                title: $('#title').val(),
                content: $('#content').val()
            },
            success: function(response) {
                if (response.success) {
                    $('#postModal').modal('hide');
                    loadPosts();
                } else {
                    alert('Error: ' + response.message);
                }
            }
        });
    });
});

function loadPosts() {
    $.ajax({
        url: '../src/get-posts.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var postsHtml = '';

            $.each(data.posts, function(index, post) {
                postsHtml += '<div class="post mb-4">';
                postsHtml += '<h2>' + escapeHtml(post.title) + '</h2>';
                postsHtml += '<p>' + escapeHtml(post.content) + '</p>';
                postsHtml += '<button class="btn btn-sm btn-primary mr-2" onclick="editPost(' + post.id + ', this)">Edit</button>';
                postsHtml += '<button class="btn btn-sm btn-danger" onclick="deletePost(' + post.id + ')">Delete</button>';
                postsHtml += '</div>';
            });

            $('#posts').html(postsHtml);
        }
    });
}

function newPost() {
    $('#postForm')[0].reset();
    $('#postId').val('');
    $('#postModalLabel').text('Add Post');
}

function editPost(id, button) {
    var post = $(button).closest('.post');
    $('#postId').val(id);
    $('#title').val(post.find('h2').text());
    $('#content').val(post.find('p').text());
    $('#postModalLabel').text('Edit Post');
    $('#postModal').modal('show');
}

function deletePost(id) {
    if (!confirm('Are you sure you want to delete this post?')) {
        return;
    }

    $.ajax({
        url: '../src/post-handler.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'delete',
            id: id
        },
        success: function(response) {
            if (response.success) {
                loadPosts();
            } else {
                alert('Error: ' + response.message);
            }
        }
    });
}

function escapeHtml(text) {
    return $('<div>').text(text).html();
}
