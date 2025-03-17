
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>


    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">🎵 Music Dashboard</a>
            </div>
        </nav>
    </header>

    <main class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4">
                    <h3 class="text-center mb-4">Upload Your Music</h3>
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="songName" class="form-label">Song Name</label>
                            <input type="text" class="form-control" id="songName" name="song_name" placeholder="Enter song name" required>
                        </div>

                        <div class="mb-3">
                            <label for="userId" class="form-label">User ID</label>
                            <input type="text" class="form-control" id="userId" name="user_id" placeholder="Enter your User ID" required>
                        </div>

                        <div class="mb-3">
                            <label for="musicFile" class="form-label">Upload Music File</label>
                            <input type="file" class="form-control" id="musicFile" name="music_file" accept="audio/*" required>
                        </div>

                        <div class="mb-3">
                            <label for="categoryId" class="form-label">Category ID</label>
                            <select class="form-select" id="categoryId" name="category_id" required>
                                <option value="">Select Category</option>
                                <option value="1">Pop</option>
                                <option value="2">Rock</option>
                                <option value="3">Hip-Hop</option>
                                <option value="4">Classical</option>
                            </select>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Upload Song</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer class="text-center py-3 bg-dark text-light">
        &copy; 2025 Music Upload System | All Rights Reserved
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
