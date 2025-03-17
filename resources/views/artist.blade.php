
@extends('include.master')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/Artist.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { background-color: #f8f9fa; }
    .social-links-container { margin-top: 10px; }
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
<main class="main-content">
    <div class="container">


        <div class="container mt-4">
            <span>
                <button type="button"  style="background-color: #FF0004"class=" text-white btn mb-3 float-end" data-bs-toggle="modal" data-bs-target="#artistModal">
                    Add Artist Name
                </button>
                <h4 class="text-dark text-center px-3 py-2 float-right" style="display: inline-block;">
                    Artist List...
                </h4>
            </span>

            <div class="table-container mt-3">
                <table class="table table-bordered table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Sr.No.</th>
                            <th>Date</th>
                            <th>Artist Name</th>
                            <th>Artist Email</th>
                            <th>Social Media Link</th>
                            <th>Bio Graph</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($getArtist as  $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->Date }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->Username }}</td>
                            <td>{{ $category->Socialmedia }}</td>
                            <td>{{ $category->BioGraph }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="artistModal" tabindex="-1" aria-labelledby="artistModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Artist</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('post') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" name="date" class="form-control">
                                <span style="color: #FF0004">
                                    @error('date')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Enter username">
                                <span style="color: #FF0004">
                                    @error('username')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter name">
                                <span style="color: #FF0004">
                                    @error('name')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Bio</label>
                                <textarea name="bio" class="form-control" rows="3" placeholder="Write something about yourself"></textarea>
                                <span style="color: #FF0004">
                                    @error('bio')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Select Social Media</label>
                                <select class="form-control" name="links" id="socialSelect">
                                    <option value="">-- Select --</option>
                                    <option value="LinkedIn">LinkedIn</option>
                                    <option value="Instagram">Instagram</option>
                                    <option value="Facebook">Facebook</option>
                                    <option value="Twitter">Twitter</option>
                                    <option value="Other">Other</option>
                                </select>

                                <span style="color: #FF0004">
                                    @error('links')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                            <div class="social-links-container" id="socialLinksContainer"></div>

                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script>
    document.getElementById('socialSelect').addEventListener('change', function() {
        let container = document.getElementById('socialLinksContainer');
        let selectedType = this.value;

        if (selectedType) {
            let div = document.createElement('div');
            div.classList.add('input-group', 'mb-2');

            if (selectedType === 'Other') {
                div.innerHTML = `
                    <input type="text" class="form-control" placeholder="Enter link type" required>
                    <input type="text" class="form-control" placeholder="Enter link" required>
                    <button type="button" class="btn btn-success" onclick="addLink(this)">Upload</button>
                `;
            } else {
                div.innerHTML = `
                    <input type="text" class="form-control" placeholder="Enter ${selectedType} link" required>
                    <button type="button" class="btn btn-success" onclick="addLink(this)">Upload</button>
                `;
            }
            container.appendChild(div);
        }
    });

    function addLink(button) {
        let inputGroup = button.parentElement;
        let inputs = inputGroup.querySelectorAll('input');
        let container = document.getElementById('socialLinksContainer');
        let linkType = inputs.length > 1 ? inputs[0].value : button.previousElementSibling.placeholder.replace('Enter ', '').replace(' link', '');
        let linkValue = inputs[inputs.length - 1].value;

        if (linkValue.trim() !== '') {
            let p = document.createElement('p');
            p.innerHTML = `<strong>${linkType}:</strong> ${linkValue}`;
            container.appendChild(p);
            inputGroup.remove();
        }
    }
</script>
@endsection
