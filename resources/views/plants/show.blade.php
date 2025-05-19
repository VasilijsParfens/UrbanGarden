<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Details</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Improved General Styles */
        body {
            font-family: 'DM Sans', sans-serif;
            margin: 0;
            padding: 0;
            background: var(--bg-gradient);
            color: var(--text-color);
            line-height: 1.6;
        }

        h2,
        h3 {
            color: var(--primary-color);
            margin: 0 0 var(--spacing-small) 0;
            letter-spacing: 0.5px;
        }

        h2 {
            font-size: var(--font-size-large);
        }

        h3 {
            font-size: 1.8rem;
        }

        p {
            margin: 0 0 var(--spacing-small) 0;
            font-size: var(--font-size-medium);
            color: var(--dark-text);
        }

        a {
            text-decoration: none;
            color: var(--dark-text);
        }

        .button:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Improved Container Styles */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: var(--spacing-large);
        }

        /* Improved Plant Info Section */
        .plant-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--spacing-large);
            background-color: var(--bg-light);
            border-radius: var(--border-radius-large);
            box-shadow: var(--box-shadow-medium);
            overflow: hidden;
            padding: var(--spacing-large);
        }

        .plant-info img {
            max-width: 100%;
            object-fit: cover;
            height: auto;
            border-radius: var(--border-radius);
            transition: transform 0.3s ease-in-out;
        }

        .plant-info img:hover {
            transform: scale(1.05);
        }

        .plant-image {
            position: relative;
            width: 100%;
            padding-top: 75%;
            /* 4:3 aspect ratio */
        }

        .plant-image img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: var(--border-radius);
        }

        .info-text {
            padding: var(--spacing-medium);
        }

        .info-text h2 {
            margin-bottom: var(--spacing-medium);
        }

        .info-text p {
            font-size: var(--font-size-medium);
            margin-bottom: var(--spacing-small);
            color: var(--dark-text);
        }

        .info-text i {
            color: var(--secondary-color);
            margin-right: var(--spacing-small);
        }

        /* Improved Comment Section */
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
            color: var(--dark-text);
        }

        .comment-actions {
            display: flex;
            gap: var(--spacing-medium);
        }

        .comment-action {
            background: none;
            border: none;
            color: var(--dark-text);
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
            color: var(--dark-text);
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
            color: var(--dark-text);
            border: 1px solid var(--primary-color);
        }

        #editCommentModal .modal-btn-confirm:hover {
            background: var(--secondary-color);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                padding: var(--spacing-medium);
            }

            .plant-info {
                grid-template-columns: 1fr;
            }

            .info-text {
                padding: var(--spacing-medium);
            }

            .comment-form {
                padding: 0;
            }
        }

        /* Collection Button Styles */
        .collection-options {
            display: flex;
            flex-direction: row;
            gap: var(--spacing-small);
            margin-top: var(--spacing-medium);
            align-items: center;
            justify-content: center;
        }

        .collection-options label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: var(--spacing-small);
            cursor: pointer;
            font-size: var(--font-size-medium);
            color: var(--dark-text);
        }

        .collection-options input[type="radio"] {
            display: none;
        }

        .collection-options input[type="radio"]:checked+span {
            background-color: var(--primary-color);
            color: var(--text-light);
        }

        .collection-options span {
            padding: var(--padding-small) var(--padding-medium);
            border: 1px solid var(--primary-color);
            border-radius: var(--border-radius);
            transition: background-color 0.3s, color 0.3s;
            align-items: center;
            justify-content: center;
        }

        .collection-options span:hover {
            background-color: var(--secondary-color);
            color: var(--text-light);
        }

        .collection-options .button {
            padding: var(--padding-medium);
            background-color: var(--secondary-color);
            color: var(--text-light);
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: var(--font-size-medium);
            transition: background-color var(--transition-speed);
            align-items: center;
            justify-content: center;
        }

        .collection-options .button:hover {
            background-color: var(--tertiary-color);
        }

        .collection-options .button.remove {
            background-color: #f44336;
            color: white;
        }

        .collection-options .button.remove:hover {
            background-color: #d32f2f;
        }
    </style>
</head>

<body>
    <x-navbar />
    <!-- Container for the plant details -->
    <div class="container">
        <!-- Plant Info Section -->
        <div class="plant-info">
            <div class="plant-image">
                <img src="{{ asset('storage/images/plants/' . ($plant->image && file_exists(storage_path('app/public/images/plants/' . $plant->image)) ? $plant->image : 'no_image.jpg')) }}"
                    alt="{{ $plant->name }}" loading="lazy">
            </div>
            <div class="info-text">
                <h2>{{ $plant->name }}</h2>
                <h3>Scientific Name: {{ $plant->scientific_name }}</h3>
                <p><i class="fas fa-tint"></i> Watering Frequency: {{ $plant->watering_frequency }}</p>
                <p><i class="fas fa-sun"></i> Sunlight: {{ $plant->sunlight }}</p>
                <p><i class="fas fa-leaf"></i> Soil Type: {{ $plant->soil_type }}</p>
                <p><i class="fas fa-seedling"></i> Fertilizing: {{ $plant->fertilizing }}</p>
                <p><i class="fas fa-info-circle"></i> Additional Info: {{ $plant->additional_info }}</p>

                <!-- Collection Type Section -->
                <form id="collection-form" action="{{ route('user_plant_collection.store', $plant->id) }}"
                    method="POST">
                    @csrf
                    <div class="collection-options">
                        <label for="have">
                            <input type="radio" name="collection_type" id="have" value="have"
                                {{ $userCollectionType == 'have' ? 'checked' : '' }}>
                            <span>Have</span>
                        </label>
                        <label for="had">
                            <input type="radio" name="collection_type" id="had" value="had"
                                {{ $userCollectionType == 'had' ? 'checked' : '' }}>
                            <span>Had</span>
                        </label>
                        <label for="want">
                            <input type="radio" name="collection_type" id="want" value="want"
                                {{ $userCollectionType == 'want' ? 'checked' : '' }}>
                            <span>Want</span>
                        </label>
                        <button type="submit" class="button">Save to Collection</button>
                        <button type="button" id="remove-collection" class="button remove"
                            style="display: {{ $userCollectionType ? 'inline-block' : 'none' }};">Remove from
                            Collection</button>
                    </div>
                </form>

            </div>
        </div>

        <!-- Comments Section -->
        <div class="comments-section">
            <h2 class="section-title">Comments</h2>

            @auth
                <form id="comment-form" class="comment-form" action="{{ route('plant_comments.store', $plant->id) }}"
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
                @foreach ($plant->comments as $comment)
                    <div class="comment" data-comment-id="{{ $comment->id }}">
                        <div class="comment-header">
                            <div class="comment-user">
                                <a href="{{ route('profile.show', ['user' => $comment->user->id]) }}"
                                    class="author-link">
                                    <img src="{{ asset('storage/images/assigned_profile_pictures/' . $comment->user->profile_picture) }}"
                                        class="comment-avatar" alt="{{ $comment->user->name }}">
                                    <div class="comment-meta">
                                        <span class="comment-author">{{ $comment->user->name }}</span>
                                        <span
                                            class="comment-date">{{ $comment->created_at->format('M j, Y \a\t g:i a') }}</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="comment-content">
                            {{ $comment->content }}
                        </div>
                        @if (auth()->check() && auth()->user()->id === $comment->user_id)
                            <div class="comment-actions">
                                <button class="comment-action edit-comment" data-comment-id="{{ $comment->id }}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="comment-action delete-comment" data-comment-id="{{ $comment->id }}">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="deleteConfirmationModal">
        <div class="modal-content">
            <h3 class="modal-title">Delete Comment</h3>
            <div class="modal-body">
                Are you sure you want to delete this comment? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button class="modal-btn modal-btn-cancel" id="cancelDelete">Cancel</button>
                <button class="modal-btn modal-btn-confirm" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>

    <!-- Edit Comment Modal -->
    <div class="modal" id="editCommentModal">
        <div class="modal-content">
            <h3 class="modal-title">Edit Comment</h3>
            <div class="modal-body">
                <form id="edit-form" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <textarea name="content" class="comment-textarea" required></textarea>
                    <div class="modal-footer">
                        <button type="button" class="modal-btn modal-btn-cancel" id="cancelEdit">Cancel</button>
                        <button type="submit" class="modal-btn modal-btn-confirm">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Comment form submission
            const commentForm = document.getElementById('comment-form');
            if (commentForm) {
                commentForm.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    const formData = new FormData(commentForm);
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

                        const data = await response.json();

                        if (data.success) {
                            // Clear form
                            commentForm.reset();

                            // Add new comment to the list
                            const commentList = document.querySelector('.comment-list');
                            const newComment = createCommentElement(data.comment);
                            commentList.prepend(newComment);

                            // Show success message (you could add a toast notification here)
                        } else {
                            alert(data.message || 'Failed to post comment');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('An error occurred while posting your comment');
                    } finally {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalBtnText;
                    }
                });
            }

            // Delete comment functionality
            const deleteModal = document.getElementById('deleteConfirmationModal');
            let commentIdToDelete = null;

            // Event delegation for delete buttons
            document.addEventListener('click', function(e) {
                if (e.target.closest('.delete-comment')) {
                    e.preventDefault();
                    commentIdToDelete = e.target.closest('.delete-comment').dataset.commentId;
                    deleteModal.classList.add('active');
                }

                if (e.target.id === 'cancelDelete') {
                    deleteModal.classList.remove('active');
                    commentIdToDelete = null;
                }

                if (e.target.id === 'confirmDelete' && commentIdToDelete) {
                    deleteComment(commentIdToDelete);
                    deleteModal.classList.remove('active');
                    commentIdToDelete = null;
                }
            });

            async function deleteComment(commentId) {
                try {
                    const response = await fetch(`/plant-comments/${commentId}`, {
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

            function createCommentElement(commentData) {
                const comment = document.createElement('div');
                comment.className = 'comment';
                comment.dataset.commentId = commentData.id;

                const date = new Date(commentData.created_at);
                const formattedDate = date.toLocaleString('en-US', {
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric',
                    hour: 'numeric',
                    minute: 'numeric',
                    hour12: true
                });

                comment.innerHTML = `
            <div class="comment-header">
                <div class="comment-user">
                    <img src="${commentData.user.profile_picture ? '/storage/' + commentData.user.profile_picture : '/images/default-avatar.jpg'}"
                         class="comment-avatar"
                         alt="${commentData.user.name}">
                    <div class="comment-meta">
                        <span class="comment-author">${commentData.user.name}</span>
                        <span class="comment-date">${formattedDate}</span>
                    </div>
                </div>
            </div>
            <div class="comment-content">
                ${commentData.content}
            </div>
            <div class="comment-actions">
                <button class="comment-action edit-comment" data-comment-id="${commentData.id}">
                    <i class="fas fa-edit"></i> Edit
                </button>
                <button class="comment-action delete-comment" data-comment-id="${commentData.id}">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </div>
        `;

                return comment;
            }

            // Edit comment functionality
            const editModal = document.getElementById('editCommentModal');
            const editForm = document.getElementById('edit-form');
            const commentTextarea = editForm.querySelector('textarea[name="content"]');

            // Event delegation for edit buttons
            document.addEventListener('click', function(e) {
                if (e.target.closest('.edit-comment')) {
                    e.preventDefault();
                    const commentId = e.target.closest('.edit-comment').dataset.commentId;
                    const commentContent = document.querySelector(
                        `.comment[data-comment-id="${commentId}"] .comment-content`).innerText;
                    commentTextarea.value = commentContent;
                    editForm.action = `/plant-comments/${commentId}`;
                    editModal.classList.add('active');
                }

                if (e.target.id === 'cancelEdit') {
                    editModal.classList.remove('active');
                }
            });

            // Handle edit form submission
            editForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                const formData = new FormData(editForm);
                const submitBtn = editForm.querySelector('button[type="submit"]');
                const originalBtnText = submitBtn.innerHTML;

                // Show loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'Updating... <i class="fas fa-spinner fa-spin"></i>';

                try {
                    const response = await fetch(editForm.action, {
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
                        editModal.classList.remove('active');
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

            // Collection form handling
            const removeCollectionBtn = document.getElementById('remove-collection');
            if (removeCollectionBtn) {
                removeCollectionBtn.addEventListener('click', function() {
                    if (confirm('Are you sure you want to remove this plant from your collection?')) {
                        const form = document.createElement('form');
                        form.action = "{{ route('user_plant_collection.remove', $plant->id) }}";
                        form.method = 'POST';
                        form.innerHTML = '@csrf <input type="hidden" name="_method" value="DELETE">';
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            }
        });
    </script>
</body>

</html>
