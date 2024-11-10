
@extends('admin.layouts.app')

@section('content')

<style>

    table {
        width: 100%; 
        margin-top: 20px; 
    }
    th, td {
        padding: 10px;
        border: 1px solid #dee2e6;
        text-align: left;
    }
    th {
        background-color: #f1f1f1;
    }
    button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 5px;
    }
    button:hover {
        background-color: #0056b3;
    }
</style>

<!-- <div class="container-fluid">
    <h1>Add Blog</h1>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <form action="{{ url('admin/blog/add') }}" method="POST">
        @csrf
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Content</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" name="title" id="title" value="{{ old('title') }}">
                        @error('title')
                            <p class="error" style="color:red">{{ $message }}</p>
                        @enderror
                    </td>
                    <td>
                        <input type="image" name="image" id="image" value="{{ old('image') }}">
                        @error('image')
                            <p class="error" style="color:red">{{ $message }}</p>
                        @enderror
                    </td>
                    <td>
                        <input type="text" name="description" id="description" value="{{ old('description') }}">
                        @error('description')
                            <p class="error" style="color:red">{{ $message }}</p>
                        @enderror
                    </td>
                    <td>
                        <input type="text" name="content" id="content" value="{{ old('content') }}">
                        @error('content')
                            <p class="error" style="color:red">{{ $message }}</p>
                        @enderror
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8">
                        <button type="submit" id="button">Add Blog</button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </form>

</div> -->

<div class="container-fluid">
    <h2>Add Blog</h2>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <form action="{{ route('blog.insert') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            @error('title')
                <p class="error" style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image" value="{{ old('image') }}">
            @error('image')
                <p class="error" style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description"> {{ old('description') }}</textarea>
            @error('description')
                <p class="error" style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content" >{{ old('content') }}</textarea>
            @error('content')
                <p class="error" style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Add Blog</button>
    </form>
</div>

<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
</script>



@endsection