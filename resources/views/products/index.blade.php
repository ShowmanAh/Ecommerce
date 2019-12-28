@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Products</div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <th>
                                Name
                            </th>
                            <th>
                                Image
                            </th>
                            <th>
                                Price
                            </th>
                            <th>
                                Description
                            </th>

                            <th>
                                Edit
                            </th>
                            <th>
                                Delete
                            </th>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                <td>{{ $product->name }}</td>
                                <td><img src="{{ $product->image_path }}" style="width: 100px" class="img-thumbnail"> </td>
                                <td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->description }}</td>
                                <td>
                                    <a href="{{ route('products.edit', ['id'=> $product->id]) }}" class="btn btn-info btn-xs">Edit</a>
                                </td>
                                <td>
                                    <form action="{{ route('products.destroy', ['id'=> $product->id]) }} " method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <button class="btn btn-danger btn-xs">Delete</button>

                                    </form>
                                </td>
                                </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
