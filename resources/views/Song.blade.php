
 @extends('include.master')

@section('styles')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

<style>
    body {
        background-color: white;
        color: white;
    }
    .music-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(255, 255, 255, 0.1);
        transition: transform 0.3s ease-in-out;
        overflow: hidden;
        position: relative;
        padding: 20px;
        background-color: red;
    }
    .music-card:hover {
        transform: scale(1.02);
    }
    .play-btn, .stop-btn {
        background: black;
        border: none;
        padding: 15px;
        border-radius: 50%;
        color: white;
        cursor: pointer;
        font-size: 20px;
    }
    .play-btn:hover, .stop-btn:hover {
        background: #333;
    }
    .controls {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 10px;
    }
    .hidden {
        display: none;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
<script>
document.addEventListener("DOMContentLoaded", function () {
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: "{{ session('success') }}",
        confirmButtonText: 'OK'
    });
});
</script>
@endif
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
        <div class="row mt-4 g-4" id="musicList">
            @foreach ($getdata as $song)
                <div class="col-md-4">
                    <div class="card music-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h5>{{$song->songname}}</h5>
                                <p class="mb-1">{{$song->categeryID}}</p>
                                <p class="mb-1">{{$song->User_ID}}</p>
                            </div>
                            <button class="play-btn" onclick="togglePlay(this)" data-src="{{ asset('SongFile/' . $song->UploadFile) }}">
                                <i class="fas fa-play"></i>
                            </button>
                            <button class="stop-btn" onclick="stopAudio()">
                                <i class="fas fa-stop"></i>
                            </button>
                        </div>
                        <div class="controls">
                            <input type="range" min="0" max="1" step="0.1" value="1" class="volume-control" onchange="changeVolume(this)">
                            <select class="speed-control" onchange="changeSpeed(this)">
                                <option value="1">1x</option>
                                <option value="1.5">1.5x</option>
                                <option value="2">2x</option>
                            </select>
                            <a href="{{ asset('SongFile/' . $song->UploadFile) }}" download class="btn btn-success">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</header>

<footer class="text-center py-3 bg-dark text-light">
    &copy; 2025 Music Upload System | All Rights Reserved
</footer>

<script>
    let currentAudio = null;
    let currentButton = null;

    function togglePlay(button) {
        const audioSrc = button.getAttribute("data-src");

        if (currentAudio && currentAudio.src === audioSrc) {
            if (currentAudio.paused) {
                currentAudio.play();
                button.innerHTML = '<i class="fas fa-pause"></i>';
            } else {
                currentAudio.pause();
                button.innerHTML = '<i class="fas fa-play"></i>';
            }
        } else {
            if (currentAudio) {
                currentAudio.pause();
                currentAudio.currentTime = 0;
                if (currentButton) {
                    currentButton.innerHTML = '<i class="fas fa-play"></i>';
                }
            }

            currentAudio = new Audio(audioSrc);
            currentAudio.play();
            button.innerHTML = '<i class="fas fa-pause"></i>';
            currentButton = button;
        }
    }

    function stopAudio() {
        if (currentAudio) {
            currentAudio.pause();
            currentAudio.currentTime = 0;
            if (currentButton) {
                currentButton.innerHTML = '<i class="fas fa-play"></i>';
            }
            currentAudio = null;
        }
    }

    function changeVolume(input) {
        if (currentAudio) {
            currentAudio.volume = input.value;
        }
    }

    function changeSpeed(select) {
        if (currentAudio) {
            currentAudio.playbackRate = select.value;
        }
    }
</script>
@endsection
