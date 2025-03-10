

@extends('include.master')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/Artist.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background-color: #f8f9fa;
    }
</style>
@endsection

@section('content')
<main class="main-content">
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <!-- Add Artist Name Button -->
        {{-- <button type="button " style="background-color: #FF0004"  class="btn btn-danger mb-3 float-end" data-bs-toggle="modal" data-bs-target="#artistModal">
            Add Artist Name
        </button> --}}
               <!-- #region-->



               <div class="container mt-4">

                <span>
                    <button type="button " style="background-color: #FF0004"  class="btn btn-danger mb-3 float-end" data-bs-toggle="modal" data-bs-target="#artistModal">
                        Add Artist Name
                    </button>

                 <h4 class="text-dark text-center px-3 py-2 float-right "
                   style=" display: inline-block;">
                 Artist List...
                 </h4>
             </span>

                 <!-- Category Table DATA -->
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

        <!-- Bootstrap Modal -->
        <div class="modal fade" id="artistModal" tabindex="-1" aria-labelledby="artistModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="artistModalLabel">Add Artist</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('post') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" name="date" class="form-control" id="date">
                                @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" id="username" placeholder="Enter username">
                                @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea class="form-control" name="bio" id="bio" rows="3" placeholder="Write something about yourself"></textarea>
                                @error('bio') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Select Social Media</label>
                                <select class="form-control" name="links[]" id="socialSelect">
                                    <option value="">-- Select --</option>
                                    <option value="LinkedIn">LinkedIn ID</option>
                                    <option value="Instagram">Instagram ID</option>
                                    <option value="Facebook">Facebook ID</option>
                                    <option value="Twitter">Twitter ID</option>
                                    <option value="Other">Other ID</option>
                                </select>
                                @error('links[]') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection

