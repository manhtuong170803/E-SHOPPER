
@extends('admin.layouts.app')

@section('content')

<!-- <table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Actions</th>
    </tr>
    @foreach ($countries as $country)
        <tr>
            <td>{{ $country->id }}</td>
            <td>{{ $country->name }}</td>
            <td>
                <form action="{{ url('admin/country', $country->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Xóa</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
<a href="{{ url('admin/country') }}">Thêm Country</a> -->
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

        .danger {
            background: #dc3545; 
            border-color: #dc3545; 
            padding: 10px;
            color: white;
            border-radius: 5px;
        }

        .danger:hover {
            background: #c82333;
            color: white;
            border-color: #bd2130; 
        }

        .btn-primary {
            background-color: #007bff; 
            border-color: #007bff; 
            margin-bottom: 20px; 
        }

        .btn-primary:hover {
            background-color: #0069d9; 
            border-color: #0062cc; 
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
</style>


<div class="container mt-5">
        <h2>Country</h2>
        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
        <div class="card">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($countries as $country)
                        <tr>
                            <td>{{ $country->id }}</td>
                            <td>{{ $country->name }}</td>
                            <td>
                                <a href="{{ url('admin/country/delete', $country->id) }}" class="danger">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="8">
                        <a href="{{ url('admin/country/add') }}"><button id="button" class="btn-add">Thêm Country</button></a>
                    </td>
                </tr>
            </tfoot>
            </table>
        </div>
</div>



@endsection