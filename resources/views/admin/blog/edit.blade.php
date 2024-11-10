
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


<div class="container-fluid">
    <h2>Edit Blog</h2>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <form action="{{ url('admin/blog/edit/'. $editblog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $editblog->title) }}" required>
            @error('title')
                <p class="error" style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
            @if($editblog->image)
                <img src="{{ asset('/images/' . $editblog->image) }}" alt="Current Image" width="100">
            @endif
            @error('image')
                <p class="error" style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" >{{ old('description', $editblog->Description) }}</textarea>
            @error('Description')
                <p class="error" style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content"> {{ old('content', $editblog->content) }}</textarea>
            @error('content')
                <p class="error" style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update Blog</button>
    </form>
</div>

<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
</script>



@endsection