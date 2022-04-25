@php
    $stt = (($_GET['page']?? 1)-1)*5;
@endphp
<div class="card-body p-0 list-product" id="list" data-action="{{route('products.list')}}">
    <div class="table-responsive">
        <table class="table m-0 table table-bordered table-hover">
            <thead>
            <tr class="text-center">
                <th>ID</th>
                <th>image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Categories</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr id="id{{$product->id}}">
                    <td class="text-center">{{++$stt}}</td>
                    <td class="text-center"><img height="50px" width="50px"
                             src="{{ $product->image == 'default.jpg' ? url('images/default.jpg') : url('images/'.$product->image)}}">
                    </td>

                    <td class="text-center">{{$product->name}}</td>
                    <td style="overflow: auto">{{\Illuminate\Support\Str::limit($product->description,30)}}</td>
                    <td>{{$product->price}}</td>
                    <td>
                        @foreach($product->categories as $category)
                            <span class="badge badge-success">{{$category->name}}</span>
                        @endforeach
                    </td>
                    <td class="text-center">
                        <button class="btn btn-secondary" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @hasPermission('show-product')
                            <a type="button" class="dropdown-item show-product" data-toggle="modal"
                               data-target="#showProductModal" id="showProductModal"
                               data-action="{{route('products.show',$product->id)}}"
                               onclick="Product.getShow($(this))"
                            ><i
                                    class="fas fa-folder">
                                </i>
                                View</a>
                            @endhasPermission
                            @hasPermission('edit-product')
                            <a class="dropdown-item edit-product" type="button"
                               data-toggle="modal" data-target="#editProductModal"
                               data-action2="{{route('products.update',$product->id)}}"
                               id="editProduct" data-action="{{route('products.show',$product->id)}}"
                            ><i
                                    class="fas fa-pencil-alt"></i>Edit</a>
                            @endhasPermission
                            @hasPermission('delete-product')
                            <a type="button" class="dropdown-item delete-product"
                               data-action="{{route('products.destroy',$product->id)}}"
                            ><i
                                    class="fas fa-trash">
                                </i>
                                Delete</a>
                            @endhasPermission
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$products->appends(request()->all())->links()}}
    </div>
</div>


