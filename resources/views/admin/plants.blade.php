<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
    <style>
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
            overflow: visible;
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
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        table img:hover {
            transform: scale(2);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            z-index: 10;
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

        .btn-edit {
            background: var(--secondary-color);
            color: var(--white);
        }

        .btn-edit:hover {
            background: var(--tertiary-color);
            transform: translateY(-2px);
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
            margin-top: 60px;
        }

        .modal-content {
            background: var(--bg-light);
            padding: var(--margin-large);
            border-radius: var(--border-radius-large);
            box-shadow: var(--box-shadow-medium);
            text-align: center;
            font-family: var(--font-primary);
            max-width: 500px;
            max-height: 80vh;
            width: 90%;
            color: var(--dark-text);
            animation: slideIn 0.3s ease-out;
            overflow-y: auto;
            max-height: 70vh;
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

        .form-group {
            margin-bottom: var(--margin-medium);
            width: 100%;
        }

        .form-group label {
            display: block;
            font-size: var(--font-size-small);
            color: var(--dark-text);
            margin-bottom: 8px;
            font-weight: var(--font-weight-regular);
            text-align: left;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: var(--padding-medium);
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: var(--font-size-small);
            outline: none;
            transition: border-color var(--transition-speed), box-shadow var(--transition-speed);
            background: var(--bg-light);
            box-sizing: border-box;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--primary-color);
            box-shadow: var(--box-shadow-hover);
        }

        .image-upload {
            margin-top: var(--gap-medium);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: var(--gap-medium);
        }

        .image-upload input[type="file"] {
            display: none;
        }

        .image-preview {
            width: 100%;
            max-width: 200px;
            text-align: center;
        }

        .image-preview img {
            max-width: 100%;
            max-height: 150px;
            border-radius: var(--border-radius);
            border: 2px dashed var(--primary-color);
            padding: 5px;
            background: rgba(45, 106, 79, 0.1);
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
            <input type="text" id="plantSearch" placeholder="Search plants..." onkeyup="searchPlants()">
            <button><i class="fas fa-search"></i> Search</button>
            <button id="exportPdfBtn" class="btn btn-primary">Export to PDF</button>
            <button id="createPlantBtn" class="btn btn-primary" onclick="window.location.href='/admin/plants/create'">Create Plant</button>
        </div>

        <!-- Table -->
        <table id="plantTable">
            <thead>
                <tr>
                    <th class="sortable" onclick="sortTable(0)">ID</th>
                    <th class="sortable" onclick="sortTable(1)">Name</th>
                    <th class="sortable" onclick="sortTable(2)">Scientific Name</th>
                    <th>Image</th>
                    <th class="sortable" onclick="sortTable(4)">Watering</th>
                    <th class="sortable" onclick="sortTable(5)">Sunlight</th>
                    <th class="sortable" onclick="sortTable(6)">Soil Type</th>
                    <th class="sortable" onclick="sortTable(7)">Fertilizing</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plants as $plant)
                    <tr>
                        <td>{{ $plant->id }}</td>
                        <td>{{ $plant->name }}</td>
                        <td>{{ $plant->scientific_name }}</td>
                        <td><img src="{{ asset('storage/images/plants/' . ($plant->image && file_exists(storage_path('app/public/images/plants/' . $plant->image)) ? $plant->image : 'no_image.jpg')) }}"
                                alt="{{ $plant->name }}" loading="lazy"></td>
                        <td>{{ $plant->watering_frequency }}</td>
                        <td>{{ $plant->sunlight }}</td>
                        <td>{{ $plant->soil_type }}</td>
                        <td>{{ $plant->fertilizing }}</td>
                        <td>
                            <button class="btn btn-edit" title="Edit this plant"
                                onclick="openEditModal('{{ $plant->id }}', '{{ $plant->name }}', '{{ $plant->scientific_name }}', '{{ $plant->watering_frequency }}', '{{ $plant->sunlight }}', '{{ $plant->soil_type }}', '{{ $plant->fertilizing }}', '{{ $plant->image }}')">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-delete" title="Delete this plant"
                                onclick="confirmDelete('{{ $plant->id }}', '{{ $plant->name }}')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                            <button class="btn btn-view" title="View this plant">
                                <a href="{{ route('plants.show', $plant->id) }}"
                                    style="color: white; text-decoration: none;">
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
            <p>Are you sure you want to delete the plant "<span id="modalPlantName"></span>"?</p>
            <div class="modal-actions">
                <button class="btn btn-secondary" onclick="cancelDelete()">Cancel</button>
                <button id="confirmDeleteBtn" class="btn btn-primary">Delete</button>
            </div>
            <div id="deleteFeedback" class="feedback-message"></div>
        </div>
    </div>

    <!-- Edit Plant Modal -->
    <!-- Edit Plant Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <h2>Edit Plant</h2>
            <form id="editPlantForm" enctype="multipart/form-data">
                <input type="hidden" id="editPlantId" name="id"> <!-- Add this line -->
                <div class="form-group">
                    <label for="editPlantName">Plant Name</label>
                    <input type="text" id="editPlantName" name="name" required>
                    <span class="error-message" id="nameError"></span>
                </div>
                <div class="form-group">
                    <label for="editPlantScientificName">Scientific Name</label>
                    <input type="text" id="editPlantScientificName" name="scientific_name" required>
                    <span class="error-message" id="scientificNameError"></span>
                </div>
                <div class="form-group">
                    <label for="editPlantWatering">Watering Frequency</label>
                    <select id="editPlantWatering" name="watering_frequency" required>
                        <option value="Daily">Daily</option>
                        <option value="Weekly">Weekly</option>
                        <option value="Bi-Weekly">Bi-Weekly</option>
                        <option value="Monthly">Monthly</option>
                    </select>
                    <span class="error-message" id="wateringError"></span>
                </div>
                <div class="form-group">
                    <label for="editPlantSunlight">Sunlight</label>
                    <select id="editPlantSunlight" name="sunlight" required>
                        <option value="Full Sun">Full Sun</option>
                        <option value="Partial Sun">Partial Sun</option>
                        <option value="Shade">Shade</option>
                        <option value="Indirect Light">Indirect Light</option>
                    </select>
                    <span class="error-message" id="sunlightError"></span>
                </div>
                <div class="form-group">
                    <label for="editPlantSoilType">Soil Type</label>
                    <select id="editPlantSoilType" name="soil_type" required>
                        <option value="Sandy">Sandy</option>
                        <option value="Clay">Clay</option>
                        <option value="Loamy">Loamy</option>
                        <option value="Peaty">Peaty</option>
                        <option value="Chalky">Chalky</option>
                        <option value="Silty">Silty</option>
                    </select>
                    <span class="error-message" id="soilTypeError"></span>
                </div>
                <div class="form-group">
                    <label for="editPlantFertilizing">Fertilizing Frequency</label>
                    <select id="editPlantFertilizing" name="fertilizing" required>
                        <option value="Weekly">Weekly</option>
                        <option value="Bi-Weekly">Bi-Weekly</option>
                        <option value="Monthly">Monthly</option>
                        <option value="Quarterly">Quarterly</option>
                        <option value="Rarely">Rarely</option>
                    </select>
                    <span class="error-message" id="fertilizingError"></span>
                </div>
                <div class="image-upload">
                    <label for="editPlantImage" class="btn btn-secondary">Upload Plant Image</label>
                    <input type="file" id="editPlantImage" name="image" accept="image/*">
                    <div class="image-preview">
                        <img id="imagePreview" src="" alt="Plant preview">
                    </div>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="cancelEdit()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        function searchPlants() {
            let input = document.getElementById("plantSearch").value.toLowerCase();
            let rows = document.querySelectorAll("#plantTable tbody tr");

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
            let table = document.getElementById("plantTable");
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

        let plantIdToDelete;

        function confirmDelete(plantId, plantName) {
            plantIdToDelete = plantId;
            document.getElementById('modalPlantName').textContent = plantName;
            document.getElementById('confirmModal').style.display = 'flex';
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (plantIdToDelete) {
                const deleteFeedback = document.getElementById('deleteFeedback');
                deleteFeedback.textContent = 'Deleting...';

                fetch(`/admin/plants/${plantIdToDelete}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            deleteFeedback.textContent = 'Plant deleted successfully!';
                            deleteFeedback.style.color = 'green';
                            let rowToDelete = document.querySelector(
                                `#plantTable tbody tr[data-id="${plantIdToDelete}"]`);
                            if (rowToDelete) {
                                rowToDelete.remove();
                            }
                        } else {
                            deleteFeedback.textContent = 'Error deleting plant. Please try again.';
                            deleteFeedback.style.color = 'red';
                        }
                        setTimeout(() => {
                            deleteFeedback.textContent = '';
                            cancelDelete();
                        }, 2000);
                    })
                    .catch(error => {
                        deleteFeedback.textContent = 'Error deleting plant. Please try again.';
                        deleteFeedback.style.color = 'red';
                        console.error('Error deleting plant:', error);
                        setTimeout(() => {
                            deleteFeedback.textContent = '';
                            cancelDelete();
                        }, 2000);
                    });
            }
        });


        function openEditModal(id, name, scientificName, watering, sunlight, soilType, fertilizing, imageUrl) {
            document.getElementById('editPlantId').value = id; // Add this line to set the plant ID
            document.getElementById('editPlantName').value = name;
            document.getElementById('editPlantScientificName').value = scientificName;
            document.getElementById('editPlantWatering').value = watering;
            document.getElementById('editPlantSunlight').value = sunlight;
            document.getElementById('editPlantSoilType').value = soilType;
            document.getElementById('editPlantFertilizing').value = fertilizing;
            document.getElementById('imagePreview').src = imageUrl;
            document.getElementById('editModal').style.display = 'flex';
        }

        function cancelEdit() {
            document.getElementById('editModal').style.display = 'none';
        }

        document.getElementById('editPlantImage').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('editPlantForm').addEventListener('submit', function(event) {
            event.preventDefault();

            document.getElementById('nameError').textContent = '';
            document.getElementById('scientificNameError').textContent = '';
            document.getElementById('wateringError').textContent = '';
            document.getElementById('sunlightError').textContent = '';
            document.getElementById('soilTypeError').textContent = '';
            document.getElementById('fertilizingError').textContent = '';

            const id = document.getElementById('editPlantId').value; // Get the plant ID
            const name = document.getElementById('editPlantName').value.trim();
            const scientificName = document.getElementById('editPlantScientificName').value.trim();
            const watering = document.getElementById('editPlantWatering').value.trim();
            const sunlight = document.getElementById('editPlantSunlight').value.trim();
            const soilType = document.getElementById('editPlantSoilType').value.trim();
            const fertilizing = document.getElementById('editPlantFertilizing').value.trim();
            const image = document.getElementById('editPlantImage').files[0];

            let isValid = true;

            if (!name) {
                document.getElementById('nameError').textContent = 'Name is required.';
                isValid = false;
            }

            if (!scientificName) {
                document.getElementById('scientificNameError').textContent = 'Scientific Name is required.';
                isValid = false;
            }

            if (!watering) {
                document.getElementById('wateringError').textContent = 'Watering Frequency is required.';
                isValid = false;
            }

            if (!sunlight) {
                document.getElementById('sunlightError').textContent = 'Sunlight is required.';
                isValid = false;
            }

            if (!soilType) {
                document.getElementById('soilTypeError').textContent = 'Soil Type is required.';
                isValid = false;
            }

            if (!fertilizing) {
                document.getElementById('fertilizingError').textContent = 'Fertilizing Frequency is required.';
                isValid = false;
            }

            if (isValid) {
                const formData = new FormData();
                formData.append('_method', 'PUT'); // Add this line to specify the PUT method
                formData.append('id', id);
                formData.append('name', name);
                formData.append('scientific_name', scientificName);
                formData.append('watering_frequency', watering);
                formData.append('sunlight', sunlight);
                formData.append('soil_type', soilType);
                formData.append('fertilizing', fertilizing);
                if (image) {
                    formData.append('image', image);
                }

                fetch(`/admin/plants/${id}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: formData,
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            alert('Plant updated successfully!');
                            cancelEdit();
                            location.reload(); // Reload the page to reflect changes
                        } else {
                            alert('Error updating plant. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error('Error updating plant:', error);
                        alert('Error updating plant. Please try again.');
                    });
            }
        });
    </script>
    <script>
        document.getElementById('exportPdfBtn').addEventListener('click', function() {
            const table = document.getElementById('plantTable');
            const rows = Array.from(table.rows);

            // Extract table header and body, skipping the image column (index 3) and actions column (last column)
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
                        text: 'Plants Table',
                        style: 'header'
                    },
                    {
                        table: {
                            headerRows: 1,
                            widths: ['auto', '*', '*', 'auto', 'auto', 'auto',
                                'auto'
                            ], // Adjust widths for remaining columns
                            body: tableContent
                        },
                        layout: 'lightHorizontalLines'
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
            pdfMake.createPdf(docDefinition).download('plants-table.pdf');
        });
    </script>

</body>

</html>
