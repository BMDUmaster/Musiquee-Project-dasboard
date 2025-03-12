
{{--
 @extends('include.master')

@section('styles')
<title>Admin Panel - User Form</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>


   @endif

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
        margin: 0;
    }
    .admin-container {
        width: 100%;
        min-height: 100vh;
        display: flex;
        align-items: stretch; /* Stretch to full height */
        justify-content: center;
        padding: 20px;
    }
    .admin-panel {
        width: 100%;
        max-width: 1200px;
        background: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .form-label {
        font-weight: bold;
    }
    .form-control {
        padding: 12px;
    }
    .mb-4 {
        margin-bottom: 2rem !important;
    }
</style>
@endsection

@section('content')
<div class="admin-container">
    <div class="admin-panel">
        <h2 class="text-center mb-1">Admin Panel - User Form</h2>
        <form action="{{route("User.post")}}" method="POST" enctype="multipart/form-data" style="flex-grow: 1;">
              @csrf
            <div class="row">
                <div class="col-md-6 mb-5">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"  value="{{old('name')}}">
                     <span style="color: #FF0004">
                       @error('name')
                       {{$message}}
                       @enderror
                     </span>
                </div>
                <div class="col-md-6 mb-5">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror " value="{{old('username')}}" name="username" >
                    <span style="color: #FF0004">
                        @error('username')
                        {{$message}}
                        @enderror
                      </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-5">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror " value="{{old('phone')}}" name="phone" >
                    <span style="color: #FF0004">
                        @error('phone')
                        {{$message}}
                        @enderror
                      </span>
                </div>
                <div class="col-md-6 mb-5">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror " value="{{old('email')}}" name="email" >
                    <span style="color: #FF0004">
                        @error('email')
                        {{$message}}
                        @enderror
                      </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-5">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror " value="{{old('password')}}" name="password" >
                    <span style="color: #FF0004">
                        @error('password')
                        {{$message}}
                        @enderror

                </div>
                <div class="col-md-6 mb-5">
                    <label class="form-label">Profile Image</label>
                    <input type="file" class="form-control @error('profile_image') is-invalid @enderror " value="{{old('profile_image')}}" name="profile_image">
                    <span style="color: #FF0004">
                        @error('profile_image')
                        {{$message}}
                        @enderror
                      </span>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn w-100" style="background-color: #FF0004; padding: 12px; font-size: 16px;">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection

 --}}



 {{-- @extends('include.master')

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
 </style>
 @endsection

 @section('content')
 <div class="admin-container">
     <div class="admin-panel">
         <h2 class="text-center mb-3">Admin Panel - User Form</h2>
         <button class="btn btn-primary mb-3" onclick="toggleForm()">Add User</button>
         <div class="form-container" id="userForm">
             <form action="{{route('User.post')}}" method="POST" enctype="multipart/form-data">
                 @csrf
                 <div class="row">
                     <div class="col-md-6 mb-3">
                         <label class="form-label">Name</label>
                         <input type="text" class="form-control" name="name" value="{{old('name')}}">
                     </div>
                     <div class="col-md-6 mb-3">
                         <label class="form-label">Username</label>
                         <input type="text" class="form-control" name="username" value="{{old('username')}}">
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-md-6 mb-3">
                         <label class="form-label">Phone</label>
                         <input type="text" class="form-control" name="phone" value="{{old('phone')}}">
                     </div>
                     <div class="col-md-6 mb-3">
                         <label class="form-label">Email</label>
                         <input type="email" class="form-control" name="email" value="{{old('email')}}">
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-md-6 mb-3">
                         <label class="form-label">Password</label>
                         <input type="password" class="form-control" name="password">
                     </div>
                     <div class="col-md-6 mb-3">
                         <label class="form-label">Profile Image</label>
                         <input type="file" class="form-control" name="profile_image">
                     </div>
                 </div>
                 <div class="text-center">
                     <button type="submit" class="btn btn-danger w-100">Submit</button>
                 </div>
             </form>
         </div>
         <h3 class="text-center mt-5">User List</h3>
         <table class="table table-striped">
             <thead>
                 <tr>
                     <th>Name</th>
                     <th>Username</th>
                     <th>Phone</th>
                     <th>Email</th>
                     <th>Profile Image</th>
                 </tr>
             </thead>
             <tbody>
                 @foreach($getUser as $user)
                 <tr>
                     <td>{{ $user->Name }}</td>
                     <td>{{ $user->UserName }}</td>
                     <td>{{ $user->Phone }}</td>
                     <td>{{ $user->email  }}</td>
                     <td><img src="{{ asset('uploads/' . $user->profile_image) }}" width="50" height="50"></td>
                 </tr>
                 @endforeach
             </tbody>
         </table>
     </div>
 </div>

 <script>
     function toggleForm() {
         var form = document.getElementById('userForm');
         if (form.style.display === 'none' || form.style.display === '') {
             form.style.display = 'block';
         } else {
             form.style.display = 'none';
         }
     }
 </script>
 @endsection --}}

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
@endsection

@section('content')
<div class="admin-container">
    <div class="admin-panel">
        <h2 class=" mb-3 "> User Profile... </h2>
        <button class="btn  mb-3 add-user-btn" style="background-color: #FF0004" onclick="toggleForm()">Add User</button>
        <div class="form-container" id="userForm">
            <form action="{{route('User.post')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" value="{{old('username')}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{old('phone')}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{old('email')}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Profile Image</label>
                        <input type="file" class="form-control" name="profile_image">
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-danger w-100">Submit</button>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach($getUser as $user)
                    <tr>
                        <td>{{ $user->Name }}</td>
                        <td>{{ $user->Username }}</td>
                        <td>{{ $user->Phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td><img src="{{ asset('uploads/' . $user->profile_image) }}" width="50" height="50"></td>
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

