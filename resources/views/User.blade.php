
 @extends('include.master')
@section('styles')
<title>Admin Panel - User Form</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
<style>
    body {
        background-color: #f8f9fa;
    }
    .admin-container {
        width: 100%;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
    }
    .admin-panel {
        width: 100%;
        max-width: 1200px;
        background: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .form-container {
        display: none;
    }
    .table th {
        background-color: black;
        color: white;
    }
    .add-user-btn {
        float: right;
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
<div class="admin-container">



    <div class="admin-panel">
        <span
        <button class="btn   btn-add  text-white  float-end " style="background-color: #FF0004" onclick="toggleForm()">Add User</button>
        </span>
        <h2 class=" mb-3 "> User Profile... </h2>

        <div class="form-container" id="userForm">
            <form action="{{route('User.post')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}">
                        <span style="color: #FF0004;">
                         @error('name')
                         {{$message}}
                         @enderror
                        </span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" value="{{old('username')}}">
                        <span style="color: #FF0004;">
                            @error('username')
                            {{$message}}
                            @enderror
                           </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{old('phone')}}">
                        <span style="color: #FF0004;">
                            @error('phone')
                            {{$message}}
                            @enderror
                           </span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{old('email')}}">
                        <span style="color: #FF0004;">
                            @error('email')
                            {{$message}}
                            @enderror
                           </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password">
                        <span style="color: #FF0004;">
                            @error('password')
                            {{$message}}
                            @enderror
                           </span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Profile Image</label>
                        <input type="file" class="form-control" name="profile_image">
                        <span style="color: #FF0004;">
                            @error('profile_image')
                            {{$message}}
                            @enderror
                           </span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <input type="text" class="form-control" name="status">
                        <span style="color: #FF0004;">
                            @error('status')
                            {{$message}}
                            @enderror
                           </span>
                    </div>

                </div>
                <div class="text-center">
                    <button type="submit" style="background-color: #FF0004" class="btn  w-100">Submit</button>
                </div>
            </form>
        </div>
        <div id="userTable">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Profile Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($getUser as $user)
                    <tr>
                        <td>{{ $user->Name }}</td>
                        <td>{{ $user->Username }}</td>
                        <td>{{ $user->Phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td><img src="{{ asset('UserProfile/'.$user->file) }}" width="50" height="50"></td>
                        <td><span data-bs-toggle="modal" data-bs-target="#exampleModal">{{ $user->status }}</span></td>
                        <td>
                            <button class="btn btn-success">Edit</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function toggleForm() {
        var form = document.getElementById('userForm');
        var table = document.getElementById('userTable');
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
            table.style.display = 'none';
        } else {
            form.style.display = 'none';
            table.style.display = 'block';
        }
    }
</script>
@endsection



<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <label for="status"  class="form-label">Status</label>
            <select class="form-control"id="status" name="status">
                <option value="Active"style="color: #FF0004">Pending</option>
                <option value="Inactive"class="text-warning">In Process</option>
                <option value="Inactive"class="text-success">Completed</option>
            </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="">Save changes</button>
        </div>
      </div>
    </div>
  </div>




