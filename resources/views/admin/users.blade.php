<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
    <style>
        /* General Styles */
        body {
            font-family: var(--font-primary);
            margin: 0;
            padding: 0;
            background: var(--bg-gradient);
            color: var(--text-color);
        }

        /* Admin Header */
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

        /* Navigation Tabs */
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
            transition: background-color 0.3s, color 0.3s;
        }

        .nav-tabs a:hover {
            background-color: var(--secondary-color);
            color: var(--white);
        }

        .nav-tabs a.active {
            background-color: var(--secondary-color);
            color: var(--white);
        }

        /* Container */
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

        /* Search Bar */
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
            transition: border-color 0.3s;
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
            transition: background 0.3s;
        }

        .search-bar button:hover {
            background: var(--tertiary-color);
        }

        /* Table */
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
            transition: background 0.3s;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        table th:hover {
            background: var(--secondary-color);
        }

        table td {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            color: #333;
        }

        table tr:hover td {
            background-color: rgba(45, 106, 79, 0.1);
            color: var(--primary-color);
        }

        table tr:last-child td {
            border-bottom: none;
        }

        table img {
            width: 50px;
            height: 50px;
            border-radius: var(--border-radius);
            object-fit: cover;
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

        /* Buttons */
        .btn {
            padding: var(--padding-small);
            border: none;
            border-radius: var(--border-radius);
            font-size: var(--font-size-small);
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
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

        /* Modal Styles */
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
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            animation: slideIn 0.3s ease-out;
        }

        .modal-content h2 {
            font-size: var(--font-size-large);
            color: var(--primary-color);
            margin-bottom: var(--margin-medium);
            font-weight: var(--font-weight-bold);
        }

        .modal-content p {
            color: var(--primary-color)
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
            transition: background 0.3s, transform 0.3s;
            flex: 1;
        }

        .modal-actions .btn-secondary {
            background: #ddd;
            color: #333;
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

        .feedback-message {
            margin-top: var(--margin-medium);
            font-size: var(--font-size-medium);
            color: var(--danger-color);
        }

        /* Form Group Styles */
        .form-group {
            margin-bottom: var(--margin-medium);
        }

        .form-group label {
            display: block;
            font-size: var(--font-size-small);
            color: #555;
            margin-bottom: 8px;
            font-weight: var(--font-weight-regular);
            text-align: left;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: var(--padding-medium);
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: var(--font-size-small);
            outline: none;
            transition: border-color 0.3s, box-shadow 0.3s;
            background: var(--bg-light);
            box-sizing: border-box;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: var(--primary-color);
            box-shadow: var(--box-shadow-hover);
        }

        .error-message {
            color: var(--danger-color);
            font-size: var(--font-size-xsmall);
            margin-top: 4px;
        }

        /* Image Upload Styles */
        .image-upload {
            margin-top: var(--gap-medium);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: var(--gap-medium);
            color: var(--primary-color);
        }

        .image-upload input[type="file"] {
            display: none;
        }

        .image-preview {
            width: 100%;
            max-width: 200px;
            text-align: center;
            color: var(--primary-color);
        }

        .image-preview img {
            max-width: 100%;
            max-height: 150px;
            border-radius: var(--border-radius);
            border: 2px dashed var(--primary-color);
            padding: 5px;
            background: rgba(45, 106, 79, 0.1);
        }

        /* Animation for Modal */
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
            <input type="text" id="userSearch" placeholder="Search users..." onkeyup="searchUsers()">
            <button><i class="fas fa-search"></i> Search</button>
            <button id="exportPdfBtn" class="btn btn-primary">Export to PDF</button>
        </div>

        <!-- Table -->
        <table id="userTable">
            <thead>
                <tr>
                    <th class="sortable" onclick="sortTable(0)">ID</th>
                    <th class="sortable" onclick="sortTable(1)">Name</th>
                    <th class="sortable" onclick="sortTable(2)">Email</th>
                    <th>Profile Picture</th>
                    <th>Role</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr data-id="{{ $user->id }}">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <img
                                src="{{ $user->profile_picture &&
                                file_exists(storage_path('app/public/images/assigned_profile_pictures/' . $user->profile_picture))
                                    ? asset('storage/images/assigned_profile_pictures/' . $user->profile_picture)
                                    : asset('images/no_avatar.jpeg') }}">
                        </td>

                        <td>{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                        <td>{{ $user->description }}</td>
                        <td>
                            <button class="btn btn-delete" title="Delete this user"
                                onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')">
                                <i class="fas fa-trash"></i> Delete
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
            <p>Are you sure you want to delete the user "<span id="modalUserName"></span>"?</p>
            <div class="modal-actions">
                <button class="btn btn-secondary" onclick="cancelDelete()">Cancel</button>
                <button id="confirmDeleteBtn" class="btn btn-primary">Delete</button>
            </div>
            <div id="deleteFeedback" class="feedback-message"></div>
        </div>
    </div>

    <script>
        function searchUsers() {
            let input = document.getElementById("userSearch").value.toLowerCase();
            let rows = document.querySelectorAll("#userTable tbody tr");

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
            let table = document.getElementById("userTable");
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

        let userIdToDelete;

        function confirmDelete(userId, userName) {
            userIdToDelete = userId;
            document.getElementById('modalUserName').textContent = userName;
            document.getElementById('confirmModal').style.display = 'flex';
        }

        function cancelDelete() {
            document.getElementById('confirmModal').style.display = 'none';
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (userIdToDelete) {
                const deleteFeedback = document.getElementById('deleteFeedback');
                deleteFeedback.textContent = 'Deleting...';

                fetch(`/admin/users/${userIdToDelete}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            deleteFeedback.textContent = 'User deleted successfully!';
                            deleteFeedback.style.color = 'green';
                            let rowToDelete = document.querySelector(
                                `#userTable tbody tr[data-id="${userIdToDelete}"]`);
                            if (rowToDelete) {
                                rowToDelete.remove();
                            }
                        } else {
                            deleteFeedback.textContent = 'Error deleting user. Please try again.';
                            deleteFeedback.style.color = 'red';
                        }
                        setTimeout(() => {
                            deleteFeedback.textContent = '';
                            cancelDelete();
                        }, 2000);
                    })
                    .catch(error => {
                        deleteFeedback.textContent = 'Error deleting user. Please try again.';
                        deleteFeedback.style.color = 'red';
                        console.error('Error deleting user:', error);
                        setTimeout(() => {
                            deleteFeedback.textContent = '';
                            cancelDelete();
                        }, 2000);
                    });
            }
        });
    </script>
    <script>
        document.getElementById('exportPdfBtn').addEventListener('click', function() {
            const table = document.getElementById('userTable');
            const rows = Array.from(table.rows);

            // Extract table header and body, skipping the image (index 3) and actions (last column) columns
            const header = Array.from(rows[0].cells)
                .filter((_, index) => index !== 3 && index !== rows[0].cells.length -
                    1) // Skip image and last column
                .map(cell => cell.innerText);

            const body = rows.slice(1).map(row =>
                Array.from(row.cells)
                .filter((_, index) => index !== 3 && index !== row.cells.length -
                    1) // Skip image and last column
                .map(cell => cell.innerText)
            );

            // Create pdfmake table content
            const tableContent = [
                header, // Header row
                ...body // Body rows
            ];

            // Create PDF
            const docDefinition = {
                content: [{
                        text: 'My Table Export',
                        style: 'header'
                    },
                    {
                        table: {
                            headerRows: 1,
                            widths: Array(header.length).fill('auto'),
                            body: [
                                header,
                                ...body
                            ]
                        },
                        layout: 'lightHorizontalLines' // makes it look like a clean table
                    }
                ],
                styles: {
                    header: {
                        fontSize: 18,
                        bold: true,
                        margin: [0, 0, 0, 10]
                    }
                }
            };



            // Generate and download the PDF
            pdfMake.createPdf(docDefinition).download('users-table.pdf');
        });
    </script>

</body>

</html>
