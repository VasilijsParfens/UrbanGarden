<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a Plant</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            font-family: var(--font-primary);
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            padding: 2rem;
            margin: 2rem auto;
            background: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        h1 {
            font-size: 2rem;
            color: #2e7d5b;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-size: 0.9rem;
            font-weight: 500;
            color: #34495e;
            margin-bottom: 0.5rem;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 90%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 0.5rem;
            font-size: 0.9rem;
            background: #fafafa;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #2e7d5b;
            outline: none;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .image-upload {
            text-align: center;
        }

        .image-upload label {
            display: inline-block;
            background: #f0f0f0;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            cursor: pointer;
            color: #333;
            font-weight: 500;
            border: 1px solid #ccc;
            transition: all 0.3s ease;
            width: auto;
            /* add this line */
        }

        .image-upload label:hover {
            background: #e0e0e0;
        }

        .image-upload input[type="file"] {
            display: none;
        }

        .image-preview img {
            margin-top: 1rem;
            max-width: 100%;
            max-height: 150px;
            border-radius: 0.5rem;
            border: 2px dashed #2e7d5b;
            padding: 5px;
            display: none;
        }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 0.9rem;
            font-size: 1rem;
            font-weight: 600;
            text-align: center;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .btn-primary {
            background: #2e7d5b;
            color: #fff;
        }

        .btn-primary:hover {
            background: #27664b;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #ecf0f1;
            color: #2c3e50;
        }

        .btn-secondary:hover {
            background: #dcdfe1;
            transform: translateY(-2px);
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .form-row .form-group {
            flex: 1 1 45%;
            /* allow wrapping */
            min-width: 0;
            /* allow shrinking inside flex */
        }

        @media (max-width: 400px) {
            h1 {
                font-size: 1.5rem;
            }

            .form-group input,
            .form-group select,
            .form-group textarea {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <x-navbar />
    <div class="container">
        <h1>Add a New Plant</h1>
        <form action="{{ route('admin.plants.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label for="plant-name">Plant Name</label>
                    <input type="text" name="name" id="plant-name" placeholder="Enter the plant name" required>
                    @error('name')
                        <small style="color: red;">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="scientific-name">Scientific Name</label>
                    <input type="text" name="scientific_name" id="scientific-name"
                        placeholder="Enter the scientific name" required>
                    @error('scientific_name')
                        <small style="color: red;">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="watering-frequency">Watering Frequency</label>
                    <select name="watering_frequency" id="watering-frequency" required>
                        <option value="">Select frequency</option>
                        <option value="Daily">Daily</option>
                        <option value="Weekly">Weekly</option>
                        <option value="Bi-Weekly">Bi-Weekly</option>
                        <option value="Monthly">Monthly</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sunlight">Sunlight Requirement</label>
                    <select name="sunlight" id="sunlight" required>
                        <option value="">Select sunlight</option>
                        <option value="Full Sun">Full Sun</option>
                        <option value="Partial Sun">Partial Sun</option>
                        <option value="Shade">Shade</option>
                        <option value="Indirect Light">Indirect Light</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="soil-type">Soil Type</label>
                    <select name="soil_type" id="soil-type" required>
                        <option value="">Select soil type</option>
                        <option value="Sandy">Sandy</option>
                        <option value="Clay">Clay</option>
                        <option value="Loamy">Loamy</option>
                        <option value="Peaty">Peaty</option>
                        <option value="Chalky">Chalky</option>
                        <option value="Silty">Silty</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fertilizing-frequency">Fertilizing Frequency</label>
                    <select name="fertilizing" id="fertilizing-frequency" required>
                        <option value="">Select frequency</option>
                        <option value="Weekly">Weekly</option>
                        <option value="Bi-Weekly">Bi-Weekly</option>
                        <option value="Monthly">Monthly</option>
                        <option value="Quarterly">Quarterly</option>
                        <option value="Rarely">Rarely</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="additional-info">Additional Information</label>
                <textarea name="additional_info" id="additional-info" placeholder="Any extra care tips or details"></textarea>
            </div>
            <div class="form-group">
                <div class="image-upload">
                    <label for="plant-image" class="btn btn-secondary">
                        <i class="fas fa-upload"></i> Upload Image
                    </label>
                    <input type="file" name="image" id="plant-image" accept="image/*" required>
                    <div class="image-preview">
                        <img id="imagePreview" src="" alt="Plant preview">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Plant</button>
        </form>
    </div>

</body>
<script>
    document.getElementById('plant-image').addEventListener('change', function(e) {
        const reader = new FileReader();
        reader.onload = function(event) {
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.src = event.target.result;
            imagePreview.style.display = 'block'; // show image preview
        };
        reader.readAsDataURL(e.target.files[0]);
    });
</script>

</html>
