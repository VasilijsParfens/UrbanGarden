<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Comment Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        :root {
            --primary-color: #2d6a4f;
            --secondary-color: #388e3c;
            --tertiary-color: #1b5e20;
            --text-color: #ffffff;
            --dark-text: #333;
            --danger-color: #d32f2f;
            --hover-color: #b71c1c;
            --bg-light: rgba(255, 255, 255, 0.95);
            --font-primary: "Inter", sans-serif;
            --border-radius: 8px;
            --border-radius-large: 12px;
            --box-shadow-light: 0 4px 15px rgba(0, 0, 0, 0.1);
            --box-shadow-medium: 0 10px 30px rgba(0, 0, 0, 0.15);
            --box-shadow-hover: 0 0 5px rgba(45, 106, 79, 0.3);
            --transition-speed: 0.3s;
            --gradient-bg: linear-gradient(135deg, #f0f4f8, #d9e2ec);
            --spacing-small: 10px;
            --spacing-medium: 20px;
            --spacing-large: 40px;
            --font-size-large: 2rem;
            --font-size-medium: 1rem;
            --font-size-small: 0.875rem;
            --font-size-xsmall: 0.75rem;
            --font-weight-bold: bold;
            --font-weight-regular: 500;
            --margin-medium: 16px;
            --margin-large: 24px;
            --padding-small: 6px 10px;
            --padding-medium: 10px 16px;
            --padding-large: 12px;
            --gap-medium: 8px;
            --gap-large: 16px;
            --bg-light-transparent: rgba(255, 255, 255, 0.8);
            --white: #fff;
            --light-gray: #f0f0f0;
        }

        body {
            font-family: var(--font-primary);
            margin: 0;
            padding: 0;
            background: var(--gradient-bg);
            color: var(--text-color);
        }

        .admin-header {
            background: var(--bg-light);
            backdrop-filter: blur(10px);
            padding: var(--margin-medium);
            text-align: center;
            font-size: var(--font-size-large);
            font-weight: var(--font-weight-bold);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: var(--gap-medium);
            box-shadow: var(--box-shadow-light);
            position: relative;
            top: 0;
            z-index: 100;
            color: var(--primary-color);
        }

        .admin-header i {
            font-size: var(--font-size-large);
        }

        .nav-tabs {
            display: flex;
            justify-content: center;
            gap: var(--gap-large);
            margin: var(--margin-medium) 0;
            background-color: var(--primary-color);
            padding: var(--padding-small);
            border-radius: var(--border-radius);
        }

        .nav-tabs a {
            text-decoration: none;
            color: var(--text-color);
            font-weight: var(--font-weight-bold);
            font-size: var(--font-size-medium);
            padding: var(--padding-small);
            border-radius: var(--border-radius);
            transition: background-color var(--transition-speed), color var(--transition-speed);
        }

        .nav-tabs a:hover {
            background-color: var(--secondary-color);
            color: var(--white);
        }

        .nav-tabs a.active {
            background-color: var(--secondary-color);
            color: var(--white);
        }

        .container {
            max-width: 1200px;
            margin: var(--margin-medium) auto;
            padding: var(--margin-large);
            background: var(--bg-light-transparent);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius-large);
            box-shadow: var(--box-shadow-medium);
            background: linear-gradient(135deg, var(--white), #F1FAEE);
        }

        .search-bar {
            margin-bottom: var(--margin-medium);
            display: flex;
            justify-content: space-between;
            gap: var(--gap-medium);
        }

        .search-bar input {
            flex: 1;
            padding: var(--padding-medium);
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: var(--font-size-medium);
            outline: none;
            transition: border-color var(--transition-speed);
            background: var(--bg-light);
        }

        .search-bar input:focus {
            border-color: var(--primary-color);
        }

        .search-bar button {
            background: var(--primary-color);
            color: var(--white);
            padding: var(--padding-medium);
            border: none;
            border-radius: var(--border-radius);
            font-size: var(--font-size-medium);
            cursor: pointer;
            transition: background var(--transition-speed);
        }

        .search-bar button:hover {
            background: var(--tertiary-color);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: var(--bg-light-transparent);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius-large);
            overflow: hidden;
            box-shadow: var(--box-shadow-light);
        }

        table th,
        table td {
            padding: var(--padding-large);
            text-align: left;
            color: var(--primary-color);
        }

        table th {
            background: var(--primary-color);
            color: var(--white);
            font-weight: var(--font-weight-regular);
            cursor: pointer;
            transition: background var(--transition-speed);
            position: sticky;
            top: 0;
            z-index: 1;
        }

        table th:hover {
            background: var(--secondary-color);
        }

        table td {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            color: var(--dark-text);
        }

        table tr:hover td {
            background-color: rgba(45, 106, 79, 0.1);
            color: var(--primary-color);
        }

        table tr:last-child td {
            border-bottom: none;
        }

        table th.sortable::after {
            content: "▲▼";
            font-size: var(--font-size-xsmall);
            margin-left: var(--gap-medium);
            opacity: 0.6;
        }

        table th.sorted-asc::after {
            content: "▲";
            opacity: 1;
        }

        table th.sorted-desc::after {
            content: "▼";
            opacity: 1;
        }

        .btn {
            padding: var(--padding-small);
            border: none;
            border-radius: var(--border-radius);
            font-size: var(--font-size-small);
            cursor: pointer;
            transition: background var(--transition-speed), transform var(--transition-speed);
            display: flex;
            align-items: center;
            gap: var(--gap-medium);
            margin: 5px;
        }

        .btn-delete {
            background: var(--danger-color);
            color: var(--white);
        }

        .btn-delete:hover {
            background: var(--hover-color);
            transform: translateY(-2px);
        }

        .btn-view {
            background: #1976D2;
            color: var(--white);
        }

        .btn-view:hover {
            background: #1565C0;
            transform: translateY(-2px);
        }

        .btn:hover {
            transform: scale(1.05);
            transition: transform 0.2s ease;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 200;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(8px);
        }

        .modal-content {
            background: var(--bg-light);
            padding: var(--margin-large);
            border-radius: var(--border-radius-large);
            box-shadow: var(--box-shadow-medium);
            text-align: center;
            font-family: var(--font-primary);
            max-width: 500px;
            width: 90%;
            color: var(--dark-text);
            animation: slideIn 0.3s ease-out;
            overflow-y: auto;
            max-height: 90vh;
        }

        .modal-content h2 {
            font-size: var(--font-size-large);
            color: var(--primary-color);
            margin-bottom: var(--margin-medium);
            font-weight: var(--font-weight-bold);
        }

        .modal-actions {
            display: flex;
            justify-content: space-evenly;
            margin-top: var(--margin-large);
            gap: var(--gap-medium);
        }

        .modal-actions button {
            font-size: var(--font-size-medium);
            padding: var(--padding-medium);
            border-radius: var(--border-radius);
            border: none;
            cursor: pointer;
            transition: background var(--transition-speed), transform var(--transition-speed);
            flex: 1;
        }

        .modal-actions .btn-secondary {
            background: #ddd;
            color: var(--dark-text);
        }

        .modal-actions .btn-secondary:hover {
            background: #ccc;
            transform: translateY(-2px);
        }

        .modal-actions .btn-primary {
            background: var(--primary-color);
            color: var(--white);
        }

        .modal-actions .btn-primary:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <x-navbar />

    <!-- Navigation Tabs -->
    <div class="nav-tabs">
        <a href="{{ route('admin.plants.index')}}">Plants</a>
        <a href="{{ route('admin.users.index')}}">Users</a>
        <a href="{{ route('admin.posts.index')}}">Posts</a>
        <a href="{{ route('admin.post_comments') }}">Post Comments</a>
        <a href="{{ route('admin.plant_comments') }}">Plant Comments</a>
        <a href="{{ route('admin.dashboard.stats')}}">Statistics</a>
    </div>

    <!-- Main Content -->
    <div class="container">

        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" id="commentSearch" placeholder="Search plant comments..." onkeyup="searchComments()">
            <button><i class="fas fa-search"></i> Search</button>
        </div>

        <!-- Table -->
        <table id="commentTable">
            <thead>
                <tr>
                    <th class="sortable" onclick="sortTable(0)">ID</th>
                    <th class="sortable" onclick="sortTable(1)">Content</th>
                    <th class="sortable" onclick="sortTable(2)">User</th>
                    <th class="sortable" onclick="sortTable(3)">Plant</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->content }}</td>
                        <td>{{ $comment->user->name }}</td>
                        <td>{{ $comment->plant->name }}</td>
                        <td>
                            <button class="btn btn-delete" title="Delete this comment"
                                onclick="confirmDelete('{{ $comment->id }}', '{{ $comment->content }}')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                            <button class="btn btn-view" title="View this comment">
                                <a href="#" style="color: white; text-decoration: none;">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Custom Delete Confirmation Modal -->
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete the comment "<span id="modalCommentContent"></span>"?</p>
            <div class="modal-actions">
                <button class="btn btn-secondary" onclick="cancelDelete()">Cancel</button>
                <button id="confirmDeleteBtn" class="btn btn-primary">Delete</button>
            </div>
            <div id="deleteFeedback" class="feedback-message"></div>
        </div>
    </div>

    <script>
        function searchComments() {
            let input = document.getElementById("commentSearch").value.toLowerCase();
            let rows = document.querySelectorAll("#commentTable tbody tr");

            rows.forEach(row => {
                let matches = row.innerText.toLowerCase().includes(input);
                if (matches) {
                    row.style.display = "";
                    row.animate([{
                        opacity: 0
                    }, {
                        opacity: 1
                    }], {
                        duration: 300,
                        easing: "ease-in-out"
                    });
                } else {
                    row.animate([{
                        opacity: 1
                    }, {
                        opacity: 0
                    }], {
                        duration: 300,
                        easing: "ease-in-out"
                    }).onfinish = () => {
                        row.style.display = "none";
                    };
                }
            });
        }

        let sortDirection = 1;
        let lastSortedColumn = -1;

        function sortTable(columnIndex) {
            let table = document.getElementById("commentTable");
            let tbody = table.querySelector("tbody");
            let rows = Array.from(tbody.rows);
            let header = table.querySelectorAll("th");

            if (lastSortedColumn !== -1) {
                header[lastSortedColumn].classList.remove("sorted-asc", "sorted-desc");
            }

            sortDirection = (columnIndex === lastSortedColumn) ? -sortDirection : 1;

            rows.sort((a, b) => {
                let aValue = a.cells[columnIndex].innerText.trim();
                let bValue = b.cells[columnIndex].innerText.trim();

                if (columnIndex === 0) {
                    return (parseInt(aValue, 10) - parseInt(bValue, 10)) * sortDirection;
                }
                return aValue.localeCompare(bValue) * sortDirection;
            });

            header[columnIndex].classList.add(sortDirection === 1 ? "sorted-asc" : "sorted-desc");

            rows.forEach(row => tbody.appendChild(row));

            lastSortedColumn = columnIndex;
        }

        let commentIdToDelete;

        function confirmDelete(commentId, commentContent) {
            commentIdToDelete = commentId;
            document.getElementById('modalCommentContent').textContent = commentContent;
            document.getElementById('confirmModal').style.display = 'flex';
        }

        function cancelDelete() {
            document.getElementById('confirmModal').style.display = 'none';
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (commentIdToDelete) {
                const deleteFeedback = document.getElementById('deleteFeedback');
                deleteFeedback.textContent = 'Deleting...';

                fetch(`/admin/plant-comments/${commentIdToDelete}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            deleteFeedback.textContent = 'Comment deleted successfully!';
                            deleteFeedback.style.color = 'green';
                            let rowToDelete = document.querySelector(
                                `#commentTable tbody tr[data-id="${commentIdToDelete}"]`);
                            if (rowToDelete) {
                                rowToDelete.remove();
                            }
                        } else {
                            deleteFeedback.textContent = 'Error deleting comment. Please try again.';
                            deleteFeedback.style.color = 'red';
                        }
                        setTimeout(() => {
                            deleteFeedback.textContent = '';
                            cancelDelete();
                        }, 2000);
                    })
                    .catch(error => {
                        deleteFeedback.textContent = 'Error deleting comment. Please try again.';
                        deleteFeedback.style.color = 'red';
                        console.error('Error deleting comment:', error);
                        setTimeout(() => {
                            deleteFeedback.textContent = '';
                            cancelDelete();
                        }, 2000);
                    });
            }
        });
    </script>

</body>

</html>
