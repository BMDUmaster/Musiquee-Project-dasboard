
@extends('include.master')

@section('styles')

<link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
<style>
    .container {
        max-width: 100%;
        padding: 20px;
    }
    .table-container {
        width: 100%;
        overflow-x: auto;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        background: #fff;
        padding: 15px;
        border-radius: 10px;
    }
    .modal-content {
        border-radius: 10px;
    }
    .btn-add {
        margin-bottom: 10px;
    }

    .table th, .table td {
        vertical-align: middle;
    }
    .table img {
        border-radius: 5px;
    }
</style>
@endsection



@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show text-center p-2 mb-2"
         role="alert" style="max-width: 600px; margin: auto; font-size: 14px; padding: 8px 15px;">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<script>
    setTimeout(function() {
        let alertBox = document.querySelector('.alert');
        if (alertBox) {
            alertBox.style.display = 'none';
        }
    }, 3000);
</script>


<div class="container mt-4">

   <span>
    <button class="btn btn-add text-white float-end" style="background-color: #FF0004;" data-bs-toggle="modal" data-bs-target="#categoryModal">
        Add New Category
    </button>

    <h4 class="text-dark text-center px-3 py-2 float-right "
      style=" display: inline-block;">
    Category List...
    </h4>
</span>

    <!-- Category Table DATA -->
    <div class="table-container mt-3">

        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>Sr.No.</th>
                    <th>Category Name</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $key => $category)
                <tr>
                    <td>{{ $categories->firstItem()+$key+1 }}</td>

                    <td>{{ $category->name }}</td>
                    <td><img src="{{ asset('category_images/' . $category->categaury_image) }}" width="50"></td>
                    <td>{{ $category->status }}</td>
                    <td class="d-flex justify-content-center align-items-center gap-3">
                        <!-- Edit Button -->
                        <button class="btn btn-primary d-flex align-items-center justify-content-center edit-btn"
                            data-id="{{ $category->id }}"
                            data-name="{{ $category->name }}"
                            {{-- data-image="{{ Storage::url($category->categaury_image) }}" width="50"> --}}

                             data-image="{{ asset('category_images/' . $category->categaury_image) }}"
                            data-status="{{ $category->status }}"
                            data-bs-toggle="modal" data-bs-target="#categoryModal"
                            style="width: 42px; height: 42px; border-radius: 6px; padding: 0;">
                            <i class="fa-solid fa-pen-to-square" style="font-size: 18px;"></i>
                        </button>

                        <!-- Delete Button -->
                        <form action="{{ route('music.delete', $category->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn d-flex align-items-center justify-content-center"
                                style="width: 42px; height: 42px; border-radius: 6px; padding: 0; background-color: white; border: 1px solid #FF0004;">
                                <i class="fa-solid fa-trash" style="font-size: 18px; color: #FF0004;"></i>
                            </button>
                        </form>
                    </td>

                                        </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-end">
    {{ $categories->links('pagination::bootstrap-5') }}
</div>

<!-- Modal for Add/Edit Category -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color: #FF0004; display: flex; align-items: center;">
                <h4 id="form-title" class="m-0 flex-grow-1 text-center">Add New Category</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body">
                <form id="category-form" action="{{route('post.data') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="category_id" name="category_id">

                    <div class="mb-3">
                        <label for="category_name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" >
                         <span class="text-danger">
                         @error('category_name')
                         {{$message}}
                         @enderror
                         </span>
                    </div>

                    <div class="mb-3">
                        <label for="category_image" class="form-label">Category Image</label>
                        <input type="file" class="form-control" id="category_image" name="category_image">

                        <div id="image-preview" class="mt-2"></div>
                        <span class="text-danger">
                          @error('category_image')
                          {{$message}}
                          @enderror
                        </span>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="Active" class="text-success">Active</option>
                            <option value="Inactive" class="text-danger">Inactive</option>
                        </select>
                         <span class="text-danger">
                              @error('status')
                              {{$message}}
                              @enderror
                         </span>
                    </div>

                    <button type="submit" id="submit-btn" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let editButtons = document.querySelectorAll(".edit-btn");
        let form = document.getElementById("category-form");
        let formTitle = document.getElementById("form-title");
        let submitButton = document.getElementById("submit-btn");

        editButtons.forEach(button => {
            button.addEventListener("click", function () {
                let id = this.getAttribute("data-id");
                let name = this.getAttribute("data-name");
                let image = this.getAttribute("data-image");
                let status = this.getAttribute("data-status");

                document.getElementById("category_id").value = id;
                document.getElementById("category_name").value = name;
                document.getElementById("status").value = status;

                document.getElementById("image-preview").innerHTML = `<img src="${image}" width="100" class="img-thumbnail">`;

                form.setAttribute("action", `/music/update/${id}`);
                submitButton.textContent = "Update";
                formTitle.textContent = "Edit Category";
            });
        });
    });
</script>
@endsection


