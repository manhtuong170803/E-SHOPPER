
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
    .add{
        background-color: #007bff;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 5px;
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
    <h1>Blog Management</h1>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Image</th>
                <th>Description</th>
                <th>Content</th>
                <th style="width: 7%;">Edit</th>
                <th style="width: 10%;">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bloglist as $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->title }}</td>
                    <td>{{ $value->image }}</td>
                    <td>{{ $value->Description }}</td>
                    <td>{{ $value->content }}</td>
                    <td>
                        <a href="{{ url('admin/blog/edit/'.$value->id) }}" class="add">Sửa</a>
                    </td>
                    <td>
                        <a href="{{ url('admin/blog/delete/'.$value->id) }}" class="add">Xóa</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="8">
                    <a href="{{ url('admin/blog/add') }}"><button id="button">Add Blog</button></a>
                </td>
            </tr>
        </tfoot>
    </table>

</div>



@endsection