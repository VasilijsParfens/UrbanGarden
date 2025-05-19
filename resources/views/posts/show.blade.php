<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} | Plant Community</title>
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        as="style">
    <link rel="preload" href="{{ asset('css/styles.css') }}" as="style">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            margin: 0;
            padding: 0;
            background: #f5f5f5;
            color: var(--dark-text);
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: var(--spacing-large);
        }

        .post-card {
            background: white;
            border-radius: var(--border-radius-large);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            margin-bottom: var(--spacing-large);
        }

        .post-image-container {
            width: 100%;
            max-height: 450px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f0f0f0;
        }

        .post-image {
            width: 100%;
            height: auto;
            max-height: 450px;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .post-image:hover {
            transform: scale(1.02);
        }

        .post-content {
            padding: var(--spacing-large);
        }

        .post-title {
            font-size: 1.8rem;
            margin: 0 0 var(--spacing-medium) 0;
            color: var(--primary-color);
        }

        .post-meta {
            display: flex;
            gap: var(--spacing-large);
            margin-bottom: var(--spacing-medium);
            color: var(--light-text);
            font-size: var(--font-size-small);
        }

        .post-body {
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: var(--spacing-large);
            white-space: pre-line;
        }

        .author-card {
            display: flex;
            align-items: center;
            padding: var(--spacing-medium);
            background: var(--bg-light);
            border-radius: var(--border-radius);
            margin-top: var(--spacing-large);
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: var(--spacing-medium);
            border: 2px solid var(--primary-color);
        }

        .profile-pic {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: var(--spacing-medium);
            border: 2px solid var(--primary-color);
        }

        .author-info {
            flex: 1;
        }

        .author-name {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .author-role {
            color: var(--light-text);
            font-size: var(--font-size-small);
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            padding: var(--spacing-small) var(--spacing-medium);
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-weight: 500;
            transition: all var(--transition-speed);
            margin-bottom: var(--spacing-large);
        }

        .back-btn:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
        }

        .back-btn i {
            margin-right: var(--spacing-small);
        }

        /* Comments Section */
        .comments-section {
            background: white;
            border-radius: var(--border-radius-large);
            box-shadow: var(--box-shadow);
            padding: var(--spacing-large);
            margin-top: var(--spacing-large);
        }

        .section-title {
            font-size: 1.4rem;
            margin: 0 0 var(--spacing-large) 0;
            color: var(--primary-color);
            padding-bottom: var(--spacing-small);
            border-bottom: 2px solid var(--bg-light);
        }

        .comment-form {
            margin-bottom: var(--spacing-large);
            padding: 0 var(--spacing-medium);
            /* Add padding to the left and right */
        }

        .comment-textarea {
            width: 100%;
            padding: var(--spacing-medium);
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            min-height: 120px;
            font-family: inherit;
            margin-bottom: var(--spacing-medium);
            resize: vertical;
            box-sizing: border-box;
            /* Ensure padding is included in the width */
        }

        .comment-textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(74, 147, 74, 0.2);
        }

        .submit-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: var(--spacing-small) var(--spacing-medium);
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            transition: background var(--transition-speed);
            display: inline-flex;
            align-items: center;
        }

        .submit-btn:hover {
            background: var(--secondary-color);
        }

        .submit-btn i {
            margin-left: var(--spacing-small);
        }

        .comment-list {
            margin-top: var(--spacing-large);
        }

        .comment {
            padding: var(--spacing-medium);
            border-bottom: 1px solid #eee;
            margin-bottom: var(--spacing-medium);
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-small);
        }

        .comment-user {
            display: flex;
            align-items: center;
        }

        .comment-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            margin-right: var(--spacing-small);
            object-fit: cover;
        }

        .comment-meta {
            display: flex;
            flex-direction: column;
        }

        .comment-author {
            font-weight: 600;
            font-size: var(--font-size-medium);
        }

        .comment-date {
            font-size: var(--font-size-small);
            color: var(--light-text);
        }

        .comment-content {
            margin: var(--spacing-small) 0;
            line-height: 1.6;
        }

        .comment-actions {
            display: flex;
            gap: var(--spacing-medium);
        }

        .comment-action {
            background: none;
            border: none;
            color: var(--light-text);
            cursor: pointer;
            font-size: var(--font-size-small);
            transition: color var(--transition-speed);
        }

        .comment-action:hover {
            color: var(--primary-color);
        }

        /* Modal Styles */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            pointer-events: none;
            transition: opacity var(--transition-speed);
        }

        .modal.active {
            opacity: 1;
            pointer-events: all;
        }

        .modal-content {
            background: white;
            padding: var(--spacing-large);
            border-radius: var(--border-radius-large);
            width: 100%;
            max-width: 400px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .modal-title {
            margin-top: 0;
            color: var(--primary-color);
        }

        .modal-body {
            margin: var(--spacing-large) 0;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: var(--spacing-medium);
        }

        .modal-btn {
            padding: var(--spacing-small) var(--spacing-medium);
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            transition: all var(--transition-speed);
        }

        .modal-btn-cancel {
            background: #f0f0f0;
            border: 1px solid #ddd;
        }

        .modal-btn-cancel:hover {
            background: #e0e0e0;
        }

        .modal-btn-confirm {
            background: #e74c3c;
            color: white;
            border: 1px solid #e74c3c;
        }

        .modal-btn-confirm:hover {
            background: #c0392b;
        }

        .comments-section {
            background: white;
            border-radius: var(--border-radius-large);
            box-shadow: var(--box-shadow);
            padding: var(--spacing-large);
            margin-top: var(--spacing-large);
        }

        /* Edit Comment Modal Styles */
        #editCommentModal .modal-content {
            width: 100%;
            max-width: 600px;
        }

        #editCommentModal .comment-textarea {
            width: 100%;
            padding: var(--spacing-medium);
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            min-height: 120px;
            font-family: inherit;
            margin-bottom: var(--spacing-medium);
            resize: vertical;
            box-sizing: border-box;
        }

        #editCommentModal .comment-textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(74, 147, 74, 0.2);
        }

        #editCommentModal .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: var(--spacing-medium);
        }

        #editCommentModal .modal-btn-confirm {
            background: var(--primary-color);
            color: white;
            border: 1px solid var(--primary-color);
        }

        #editCommentModal .modal-btn-confirm:hover {
            background: var(--secondary-color);
        }

        .comment-action.like-comment,
        .comment-action.dislike-comment {
            color: var(--primary-color);
        }

        .comment-action.like-comment:hover,
        .comment-action.dislike-comment:hover {
            color: var(--secondary-color);
        }

        .post-action.like-post,
        .post-action.dislike-post {
            color: var(--primary-color);
        }

        .post-action.like-post:hover,
        .post-action.dislike-post:hover {
            color: var(--secondary-color);
        }

        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 12px 16px;
            border-radius: 4px;
            color: white;
            z-index: 1001;
            transition: opacity 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .toast-success {
            background: #4a934a;
        }

        .toast-error {
            background: #e74c3c;
        }

        .fade-out {
            opacity: 0;
        }

        /* Add spinner animation */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .fa-spinner {
            animation: spin 1s linear infinite;
        }

        /* Focus styles for accessibility */
        button:focus,
        textarea:focus,
        input:focus {
            outline: 2px solid #4a934a;
            outline-offset: 2px;
        }


        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                padding: var(--spacing-medium);
            }

            .post-content {
                padding: var(--spacing-medium);
            }

            .post-title {
                font-size: 1.5rem;
            }

            .post-meta {
                flex-direction: column;
                gap: var(--spacing-small);
            }
        }
    </style>
</head>

<body>
    <x-navbar />

    <div class="container">
        <div class="post-card">
            @if ($post->image)
                <div class="post-image-container">
                    <img src="{{ $post->image ? asset('storage/images/posts/' . $post->image) : asset('images/placeholder.jpg') }}"
                        class="post-image" alt="{{ $post->title }}" loading="lazy" decoding="async"
                        onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                </div>
            @endif

            <div class="post-content">
                <h1 class="post-title">{{ $post->title }}</h1>

                <div class="post-meta">
                    <span>
                        @switch($post->type)
                            @case('question')
                                Asked by
                            @break

                            @case('tip')
                                Tip by
                            @break

                            @case('post')
                                Shared by
                            @break

                            @case('plant_identification')
                                Posted by
                            @break

                            @default
                                Posted by
                        @endswitch
                        {{ $post->user->name }}
                    </span>
                    <span>
                        @switch($post->type)
                            @case('question')
                                Asked on
                            @break

                            @case('tip')
                                Tipped on
                            @break

                            @case('post')
                                Shared on
                            @break

                            @case('plant_identification')
                                Posted on
                            @break

                            @default
                                Posted on
                        @endswitch
                        {{ $post->created_at->format('F j, Y') }}
                    </span>
                </div>

                <div class="post-body">
                    {{ $post->content }}
                </div>

                <div class="author-card">
                    <a href="{{ route('profile.show', ['user' => $post->user->id]) }}" class="author-link">
                        <img class="profile-pic"
                            src="{{ asset('storage/images/assigned_profile_pictures/' . ($post->user->profile_picture ?? 'no_avatar.png')) }}"
                            alt="User Avatar">
                        <div class="author-info">
                            <div class="author-name">{{ $post->user->name }}</div>
                        </div>
                    </a>
                </div>

                <div class="post-actions">
                    @if (auth()->check() && auth()->user()->id === $post->user_id)
                        <button class="post-action edit-post" data-post-id="{{ $post->id }}"
                            aria-label="Edit post">
                            <i class="fas fa-edit" aria-hidden="true"></i> Edit
                        </button>
                        <button class="post-action delete-post" data-post-id="{{ $post->id }}"
                            aria-label="Delete post">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    @endif
                    <button class="post-action like-post" data-post-id="{{ $post->id }}"
                        aria-label="Like this post">
                        <i class="fas fa-thumbs-up"></i> Like ({{ $post->likes() }})
                    </button>
                    <button class="post-action dislike-post" data-post-id="{{ $post->id }}"
                        aria-label="Dislike this post">
                        <i class="fas fa-thumbs-down"></i> Dislike ({{ $post->dislikes() }})
                    </button>
                </div>
            </div>
        </div>

        <div class="comments-section">
            <h2 class="section-title">Comments</h2>

            @auth
                <form id="comment-form" class="comment-form" action="{{ route('post_comments.store', $post->id) }}"
                    method="POST">
                    @csrf
                    <textarea name="content" class="comment-textarea" placeholder="Share your thoughts..." required></textarea>
                    <button type="submit" class="submit-btn">
                        Post Comment <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            @else
                <p>Please <a href="{{ route('login') }}">login</a> to leave a comment.</p>
            @endauth

            <div class="comment-list">
                @foreach ($post->comments as $comment)
                    <div class="comment" data-comment-id="{{ $comment->id }}">
                        <div class="comment-header">
                            <div class="comment-user">
                                <img src="{{ asset('storage/images/assigned_profile_pictures/' . $comment->user->profile_picture) }}"
                                    class="comment-avatar" alt="{{ $comment->user->name }}">
                                <div class="comment-meta">
                                    <span class="comment-author">{{ $comment->user->name }}</span>
                                    <span
                                        class="comment-date">{{ $comment->created_at->format('M j, Y \a\t g:i a') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="comment-content">
                            {{ $comment->content }}
                        </div>
                        <div class="comment-actions">
                            <button class="comment-action like-comment" data-comment-id="{{ $comment->id }}">
                                <i class="fas fa-thumbs-up"></i> Like ({{ $comment->likes() }})
                            </button>
                            <button class="comment-action dislike-comment" data-comment-id="{{ $comment->id }}">
                                <i class="fas fa-thumbs-down"></i> Dislike ({{ $comment->dislikes() }})
                            </button>
                            @if (auth()->check() && auth()->user()->id === $comment->user_id)
                                <button class="comment-action edit-comment" data-comment-id="{{ $comment->id }}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="comment-action delete-comment" data-comment-id="{{ $comment->id }}">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="deleteConfirmationModal">
        <div class="modal-content">
            <h3 class="modal-title">Delete Post</h3>
            <div class="modal-body">
                Are you sure you want to delete this post? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button class="modal-btn modal-btn-cancel" id="cancelDelete">Cancel</button>
                <button class="modal-btn modal-btn-confirm" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>

    <!-- Edit Post Modal -->
    <div class="modal" id="editPostModal">
        <div class="modal-content">
            <h3 class="modal-title">Edit Post</h3>
            <div class="modal-body">
                <form id="edit-post-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <label for="edit-title">Title:</label>
                    <input type="text" id="edit-title" name="title" class="form-control" required>
                    <label for="edit-content">Content:</label>
                    <textarea id="edit-content" name="content" class="form-control" required></textarea>
                    <label for="edit-image">Image:</label>
                    <input type="file" id="edit-image" name="image" class="form-control">
                    <div class="modal-footer">
                        <button type="button" class="modal-btn modal-btn-cancel" id="cancelEditPost">Cancel</button>
                        <button type="submit" class="modal-btn modal-btn-confirm">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Comment Confirmation Modal -->
    <div class="modal" id="deleteCommentConfirmationModal">
        <div class="modal-content">
            <h3 class="modal-title">Delete Comment</h3>
            <div class="modal-body">
                Are you sure you want to delete this comment? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button class="modal-btn modal-btn-cancel" id="cancelDeleteComment">Cancel</button>
                <button class="modal-btn modal-btn-confirm" id="confirmDeleteComment">Delete</button>
            </div>
        </div>
    </div>

    <!-- Edit Comment Modal -->
    <div class="modal" id="editCommentModal">
        <div class="modal-content">
            <h3 class="modal-title">Edit Comment</h3>
            <div class="modal-body">
                <form id="edit-comment-form" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <textarea name="content" class="comment-textarea" required></textarea>
                    <div class="modal-footer">
                        <button type="button" class="modal-btn modal-btn-cancel"
                            id="cancelEditComment">Cancel</button>
                        <button type="submit" class="modal-btn modal-btn-confirm">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Toast notification function
            function showToast(message, type = 'success') {
                const toast = document.createElement('div');
                toast.className = `toast toast-${type}`;
                toast.textContent = message;
                document.body.appendChild(toast);

                setTimeout(() => {
                    toast.classList.add('fade-out');
                    setTimeout(() => toast.remove(), 300);
                }, 3000);
            }

            // Debounce function to prevent rapid firing of actions
            function debounce(func, wait) {
                let timeout;
                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), wait);
                };
            }

            // Comment form submission with validation
            const commentForm = document.getElementById('comment-form');
            if (commentForm) {
                commentForm.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    const formData = new FormData(commentForm);
                    const content = formData.get('content').trim();

                    if (!content) {
                        showToast('Please enter your comment', 'error');
                        return;
                    }

                    const submitBtn = commentForm.querySelector('button');
                    const originalBtnText = submitBtn.innerHTML;

                    // Show loading state
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = 'Posting... <i class="fas fa-spinner fa-spin"></i>';

                    try {
                        const response = await fetch(commentForm.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            }
                        });

                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }

                        const data = await response.json();

                        if (data.success) {
                            commentForm.reset();
                            showToast('Comment posted successfully');

                            // Add new comment to the list
                            const commentList = document.querySelector('.comment-list');
                            const newComment = createCommentElement(data.comment);
                            commentList.prepend(newComment);
                        } else {
                            showToast(data.message || 'Failed to post comment', 'error');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        showToast('An error occurred while posting your comment', 'error');
                    } finally {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalBtnText;
                    }
                });
            }

            // Delete post functionality
            const deletePostModal = document.getElementById('deleteConfirmationModal');
            let postIdToDelete = null;

            // Event delegation for delete post buttons
            document.addEventListener('click', function(e) {
                if (e.target.closest('.delete-post')) {
                    e.preventDefault();
                    postIdToDelete = e.target.closest('.delete-post').dataset.postId;
                    deletePostModal.classList.add('active');
                }

                if (e.target.id === 'cancelDelete') {
                    deletePostModal.classList.remove('active');
                    postIdToDelete = null;
                }

                if (e.target.id === 'confirmDelete' && postIdToDelete) {
                    deletePost(postIdToDelete);
                    deletePostModal.classList.remove('active');
                    postIdToDelete = null;
                }
            });

            // Delete post with loading state
            async function deletePost(postId) {
                const deleteBtn = document.getElementById('confirmDelete');
                const originalBtnText = deleteBtn.innerHTML;

                deleteBtn.disabled = true;
                deleteBtn.innerHTML = 'Deleting... <i class="fas fa-spinner fa-spin"></i>';

                try {
                    const response = await fetch(`/posts/${postId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const data = await response.json();

                    if (data.success) {
                        showToast('Post deleted successfully');
                        setTimeout(() => {
                            window.location.href = '/posts';
                        }, 1000);
                    } else {
                        showToast(data.message || 'Failed to delete post', 'error');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showToast('An error occurred while deleting the post', 'error');
                } finally {
                    deleteBtn.disabled = false;
                    deleteBtn.innerHTML = originalBtnText;
                }
            }

            // Edit post functionality
            const editPostModal = document.getElementById('editPostModal');
            const editPostForm = document.getElementById('edit-post-form');
            const editTitle = editPostForm.querySelector('#edit-title');
            const editContent = editPostForm.querySelector('#edit-content');

            // Event delegation for edit post buttons
            document.addEventListener('click', function(e) {
                if (e.target.closest('.edit-post')) {
                    e.preventDefault();
                    const postId = e.target.closest('.edit-post').dataset.postId;
                    const postTitle = document.querySelector('.post-title').innerText;
                    const postContent = document.querySelector('.post-body').innerText;
                    editTitle.value = postTitle;
                    editContent.value = postContent;
                    editPostForm.action = `/posts/${postId}`;
                    editPostModal.classList.add('active');
                }

                if (e.target.id === 'cancelEditPost') {
                    editPostModal.classList.remove('active');
                }
            });

            // Handle edit post form submission
            editPostForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                const formData = new FormData(editPostForm);
                const submitBtn = editPostForm.querySelector('button[type="submit"]');
                const originalBtnText = submitBtn.innerHTML;

                // Show loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'Updating... <i class="fas fa-spinner fa-spin"></i>';

                try {
                    const response = await fetch(editPostForm.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .content,
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        // Update the post content in the DOM
                        document.querySelector('.post-title').innerText = data.post.title;
                        document.querySelector('.post-body').innerText = data.post.content;

                        // Hide the edit modal
                        editPostModal.classList.remove('active');
                    } else {
                        alert(data.message || 'Failed to update post');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('An error occurred while updating your post');
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                }
            });

            // Delete comment functionality
            const deleteCommentModal = document.getElementById('deleteCommentConfirmationModal');
            let commentIdToDelete = null;

            // Event delegation for delete comment buttons
            document.addEventListener('click', function(e) {
                if (e.target.closest('.delete-comment')) {
                    e.preventDefault();
                    commentIdToDelete = e.target.closest('.delete-comment').dataset.commentId;
                    deleteCommentModal.classList.add('active');
                }

                if (e.target.id === 'cancelDeleteComment') {
                    deleteCommentModal.classList.remove('active');
                    commentIdToDelete = null;
                }

                if (e.target.id === 'confirmDeleteComment' && commentIdToDelete) {
                    deleteComment(commentIdToDelete);
                    deleteCommentModal.classList.remove('active');
                    commentIdToDelete = null;
                }
            });

            async function deleteComment(commentId) {
                try {
                    const response = await fetch(`/comments/${commentId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        document.querySelector(`.comment[data-comment-id="${commentId}"]`).remove();
                    } else {
                        alert(data.message || 'Failed to delete comment');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the comment');
                }
            }

            // Edit comment functionality
            const editCommentModal = document.getElementById('editCommentModal');
            const editCommentForm = document.getElementById('edit-comment-form');
            const commentTextarea = editCommentForm.querySelector('textarea[name="content"]');

            // Event delegation for edit comment buttons
            document.addEventListener('click', function(e) {
                if (e.target.closest('.edit-comment')) {
                    e.preventDefault();
                    const commentId = e.target.closest('.edit-comment').dataset.commentId;
                    const commentContent = document.querySelector(
                        `.comment[data-comment-id="${commentId}"] .comment-content`).innerText;
                    commentTextarea.value = commentContent;
                    editCommentForm.action = `/comments/${commentId}`;
                    editCommentModal.classList.add('active');
                }

                if (e.target.id === 'cancelEditComment') {
                    editCommentModal.classList.remove('active');
                }
            });

            // Handle edit comment form submission
            editCommentForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                const formData = new FormData(editCommentForm);
                const submitBtn = editCommentForm.querySelector('button[type="submit"]');
                const originalBtnText = submitBtn.innerHTML;

                // Show loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'Updating... <i class="fas fa-spinner fa-spin"></i>';

                try {
                    const response = await fetch(editCommentForm.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .content,
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        // Update the comment content in the DOM
                        const commentElement = document.querySelector(
                            `.comment[data-comment-id="${data.comment.id}"] .comment-content`);
                        commentElement.innerText = data.comment.content;

                        // Hide the edit modal
                        editCommentModal.classList.remove('active');
                    } else {
                        alert(data.message || 'Failed to update comment');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('An error occurred while updating your comment');
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                }
            });

            // Like and Dislike comment functionality
            document.addEventListener('click', function(e) {
                if (e.target.closest('.like-comment') || e.target.closest('.dislike-comment')) {
                    e.preventDefault();
                    const commentId = e.target.closest('.comment-action').dataset.commentId;
                    const action = e.target.closest('.comment-action').classList.contains('like-comment') ?
                        'like' : 'dislike';
                    handleLikeDislikeComment(commentId, action);
                }
            });

            // Like and Dislike comment with debounce and loading states
            const handleLikeDislikeComment = debounce(async function(commentId, action) {
                const likeButton = document.querySelector(
                    `.like-comment[data-comment-id="${commentId}"]`);
                const dislikeButton = document.querySelector(
                    `.dislike-comment[data-comment-id="${commentId}"]`);

                const originalLikeText = likeButton.innerHTML;
                const originalDislikeText = dislikeButton.innerHTML;

                likeButton.innerHTML = `<i class="fas fa-spinner fa-spin"></i>`;
                dislikeButton.innerHTML = `<i class="fas fa-spinner fa-spin"></i>`;
                likeButton.disabled = true;
                dislikeButton.disabled = true;

                try {
                    const response = await fetch(`/comments/${commentId}/${action}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .content,
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const data = await response.json();

                    if (data.success) {
                        likeButton.innerHTML = `<i class="fas fa-thumbs-up"></i> Like (${data.likes})`;
                        dislikeButton.innerHTML =
                            `<i class="fas fa-thumbs-down"></i> Dislike (${data.dislikes})`;
                    } else {
                        showToast(data.message || 'Failed to vote', 'error');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showToast('An error occurred while voting', 'error');
                } finally {
                    likeButton.disabled = false;
                    dislikeButton.disabled = false;
                    likeButton.innerHTML = originalLikeText;
                    dislikeButton.innerHTML = originalDislikeText;
                }
            }, 300);

            // Like and Dislike post functionality
            document.addEventListener('click', function(e) {
                if (e.target.closest('.like-post') || e.target.closest('.dislike-post')) {
                    e.preventDefault();
                    const postId = e.target.closest('.post-action').dataset.postId;
                    const action = e.target.closest('.post-action').classList.contains('like-post') ?
                        'like' : 'dislike';
                    handleLikeDislikePost(postId, action);
                }
            });

            // Like and Dislike post with debounce and loading states
            const handleLikeDislikePost = debounce(async function(postId, action) {
                const likeButton = document.querySelector(`.like-post[data-post-id="${postId}"]`);
                const dislikeButton = document.querySelector(`.dislike-post[data-post-id="${postId}"]`);

                const originalLikeText = likeButton.innerHTML;
                const originalDislikeText = dislikeButton.innerHTML;

                likeButton.innerHTML = `<i class="fas fa-spinner fa-spin"></i>`;
                dislikeButton.innerHTML = `<i class="fas fa-spinner fa-spin"></i>`;
                likeButton.disabled = true;
                dislikeButton.disabled = true;

                try {
                    const response = await fetch(`/posts/${postId}/${action}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .content,
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const data = await response.json();

                    if (data.success) {
                        likeButton.innerHTML = `<i class="fas fa-thumbs-up"></i> Like (${data.likes})`;
                        dislikeButton.innerHTML =
                            `<i class="fas fa-thumbs-down"></i> Dislike (${data.dislikes})`;
                    } else {
                        showToast(data.message || 'Failed to vote', 'error');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showToast('An error occurred while voting', 'error');
                } finally {
                    likeButton.disabled = false;
                    dislikeButton.disabled = false;
                    likeButton.innerHTML = originalLikeText;
                    dislikeButton.innerHTML = originalDislikeText;
                }
            }, 300);

            // Event listeners for like/dislike buttons
            document.addEventListener('click', function(e) {
                if (e.target.closest('.like-post') || e.target.closest('.dislike-post')) {
                    e.preventDefault();
                    const postId = e.target.closest('.post-action').dataset.postId;
                    const action = e.target.closest('.post-action').classList.contains('like-post') ?
                        'like' : 'dislike';
                    handleLikeDislikePost(postId, action);
                }

                if (e.target.closest('.like-comment') || e.target.closest('.dislike-comment')) {
                    e.preventDefault();
                    const commentId = e.target.closest('.comment-action').dataset.commentId;
                    const action = e.target.closest('.comment-action').classList.contains('like-comment') ?
                        'like' : 'dislike';
                    handleLikeDislikeComment(commentId, action);
                }
            });
        });
    </script>

</body>

</html>
