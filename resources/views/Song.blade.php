@extends('include.master')

@section('styles')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

<style>
    /* */
    body {
        background-color:  #f8f9fa ;
    }
    .music-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
        overflow: hidden;
        position: relative;
    }
    .music-card:hover {
        transform: scale(1.02);
    }
    .music-logo {
        width: 50px;
        height: 50px;
    }
    .play-btn {
        background: #007bff;
        border: none;
        padding: 10px 15px;
        border-radius: 50%;
        color: white;
        cursor: pointer;
    }
    .play-btn:hover {
        background: #0056b3;
    }
    .hidden {
        display: none;
    }
    .form-overlay {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        background: rgba(244, 242, 242, 0.95);
        padding: 20px;
        border-radius: 12px;
        display: none;
        z-index: 1050;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
</style>
@endsection

@section('content')
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">🎵 Music Upload</a>
            <button class="btn btn-primary" onclick="toggleUploadForm()">Upload Music</button>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row mt-4 g-4" id="musicList">  <!-- Added 'g-4' for gap between cards -->
            @foreach ($getdata as $song)
                <div class="col-md-4">
                    <div class="card music-card p-3" style="background-color: #FF0004">
                        <div class="d-flex align-items-center">
                            <img src="https://cdn-icons-png.flaticon.com/512/727/727245.png" class="music-logo me-3" alt="Music">
                            <div>
                                <h5>{{$song->songname}}</h5>
                                <p class="mb-1">{{$song->categeryID}}</p>
                                <p class="mb-1">{{$song->User_ID}}</p>
                                <audio controls class="w-100">
                                    <source src="#" type="audio/mp3">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</header>




<div class="form-overlay" id="uploadForm">
    <h3 class="text-center mb-4">Upload Your Music</h3>
    <form id="musicForm" action="{{route('sendSong')}}" method="post" enctype="multipart/form-data">
       @csrf
        <div class="mb-3">
            <label for="songName" class="form-label">Song Name</label>
            <input type="text" name="song_name" class="form-control" id="songName" placeholder="Enter song name" >
            <span class="text-danger">
                @error('song_name')
                {{$message}}
                @enderror
            </span>
        </div>
        <div class="mb-3">
            <label for="userId" class="form-label">User ID</label>
            <input type="text" name="user_id" class="form-control" id="userId" placeholder="Enter your User ID" >
            <span class="text-danger">
                @error('song_name')
                {{$message}}
                @enderror
            </span>
        </div>
        <div class="mb-3">
            <label for="musicFile" class="form-label">Upload Music File</label>
            <input type="file" name="music_file" class="form-control" id="musicFile" accept="audio/*" >
            <span class="text-danger">
                @error('music_file')
                {{$message}}
                @enderror
            </span>
        </div>
        <div class="mb-3">
            <label for="categoryId" class="form-label">Category</label>
            <select class="form-select" name="category_id" id="categoryId" >
                <option value="">Select Category</option>
                <option value="Pop">Pop</option>
                <option value="Rock">Rock</option>
                <option value="Hip-Hop">Hip-Hop</option>
                <option value="Classical">Classical</option>
            </select>
            <span class="text-danger">
                @error('category_id')
                {{$message}}
                @enderror
            </span>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn " style="background-color: #FF0004" >Upload Song</button>
        </div>

    </form>
</div>

<footer class="text-center py-3 bg-dark text-light">
    &copy; 2025 Music Upload System | All Rights Reserved
</footer>

<script>
    function toggleUploadForm() {
        let uploadForm = document.getElementById("uploadForm");
        if (uploadForm.style.display === "none" || uploadForm.style.display === "") {
            uploadForm.style.display = "block";
        } else {
            uploadForm.style.display = "none";
        }
    }

    function uploadMusic() {
        let songName = document.getElementById("songName").value;
        let userId = document.getElementById("userId").value;
        let category = document.getElementById("categoryId").value;
        let fileInput = document.getElementById("musicFile");
        let file = fileInput.files[0];

        if (!songName || !userId || !category || !file) {
            alert("Please fill in all fields!");
            return;
        }

        let fileURL = URL.createObjectURL(file);
        let categoryText = document.getElementById("categoryId").options[document.getElementById("categoryId").selectedIndex].text;

        let musicList = document.getElementById("musicList");
        let musicCard = `
            <div class="col-md-4">
                <div class="card music-card p-3">
                    <div class="d-flex align-items-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/727/727245.png" class="music-logo me-3" alt="Music">
                        <div>
                            <h5>${songName}</h5>
                            <p class="mb-1">Category: ${categoryText}</p>
                            <p class="mb-1">User ID: ${userId}</p>
                            <audio controls class="w-100">
                                <source src="${fileURL}" type="audio/mp3">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                </div>
            </div>`;
        musicList.innerHTML += musicCard;

        document.getElementById("musicForm").reset();
        toggleUploadForm();
    }
</script>
@endsection



