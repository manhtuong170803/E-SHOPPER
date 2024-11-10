@extends('frontend.layouts.app')

@section('content')
    <style>
        .table-header {
            background-color: #FF9A1A;
            color: white;
            text-align: center;
        }
        .add-new-btn {
            float: left; 
            margin-top: 20px;
            background-color: #FF9A1A;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
        }
    </style>
<section>

    <div class="col-sm-9">
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="table-header">
                        <th>Id</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(session('success'))
                            <p style="color: green;">{{ session('success') }}</p>
                    @endif
               
                    @forelse ($products as $product)
                        @php
                            $images = json_decode($product->image, true);
                            $firstImage = isset($images[0]) ? $images[0] : null;
                        @endphp
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>
                                @if($firstImage)
                                    <img src="{{ asset('upload/products/' . $firstImage) }}" alt="Product Image" style="width: 100px;">
                                @else
                                    No Image Available
                                @endif
                            </td>
                            <td>${{ number_format($product->price) }}</td>
                            <td class="cart_total">
                                <a href="{{ url('/member/account/edit-product/' . $product->id) }}" style="margin-right: 30px;"><i class="fas fa-edit"></i></a>
                                <a href="{{ url('/member/account/delete-product/' . $product->id) }}"><i class="fas fa-times"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center" style="color:red;">Không có mặt hàng nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <a href="{{ url('/member/account/add-product') }}"><button class="add-new-btn">Add New</button></a>
        </div>
    </div>
            
</section>
@endsection