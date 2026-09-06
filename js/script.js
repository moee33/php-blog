$(document).ready(function() {
    loadPosts();

    function loadPosts() {
        $.ajax({
            url: 'src/get-posts.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var postsHtml = '';

                $.each(data.posts, function(index, post) {
                    postsHtml += '<div class="post mb-4">';
                    postsHtml += '<h2>' + escapeHtml(post.title) + '</h2>';
                    postsHtml += '<p>' + escapeHtml(post.content) + '</p>';
                    postsHtml += '</div>';
                });

                $('#posts').html(postsHtml);
            }
        });
    }

    function escapeHtml(text) {
        return $('<div>').text(text).html();
    }
});
