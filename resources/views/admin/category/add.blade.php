
@extends('admin.layouts.app')

@section('content')

<style>
        body {
            background-color: #f8f9fa; 
        }

        h2 {
            font-weight: bold; 
            margin-bottom: 20px; 
        }

        .card {
            background-color: #ffffff; 
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
            padding: 20px;
        }

        table {
            width: 100%; 
            margin-top: 20px; 
        }

        th, td {
            text-align: center;
        }

        .btn-add {
            background-color: #28a745; 
            color: white; 
            padding: 10px 20px; 
            border: none; 
            border-radius: 5px; 
            font-size: 16px; 
            cursor: pointer; 
            transition: background-color 0.3s; 
        }

        .btn-add:hover {
            background-color: #218838; 
        }
        .load{
            background-color: #28a745; 
            color: white; 
            padding: 10px 20px; 
            border: none; 
            border-radius: 5px; 
            font-size: 16px; 
            cursor: pointer; 
            transition: background-color 0.3s;
        }
        .load:hover {
            background: #218838; 
            color: white; 
        }
</style>


<div class="container mt-5">
        <h2>Add Category</h2>
        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
        <form action="{{ url('/admin/category/add') }}" method="POST">
            @csrf
            <div class="card">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Name</th>
                            <th>Add</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="text" name="name" id="name" value="{{ old('name') }}">
                                @error('name')
                                    <p class="error" style="color:red">{{ $message  }}</p>
                                @enderror
                            </td>
                            <td >
                                <button type="submit" id="button" class="load">Thêm Category</button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="8">
                            <a href="{{ url('admin/category') }}" class="load">Quay lại</a>
                        </td>
                    </tr>
                </tfoot>
                </table>
            </div>
        </form>
        
    </div>



@endsection