<div class="modal fade" id="createProductModal" tabindex="-1" role="dialog" aria-labelledby="createProductModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProductModalTitle">Create Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formCreateProduct" data-action="{{route('products.store')}}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <section class="content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input name="name" type="text" id="name" class="form-control">
                                        @if ($errors->has('name'))
                                            <p class="text-danger">{{ $errors->first('name') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="category_ids">Categories</label>
                                        <select style="width: 100%;" name="category_ids[]" id="category_ids"
                                                multiple="multiple"
                                                class="select2 selected">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input name="price" type="number" id="price" class="form-control">
                                        @if ($errors->has('price'))
                                            <p class="text-danger">{{ $errors->first('price') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="image"> Image :</label>
                                        <input type="file" class="form-control" name="image" placeholder="image Name"
                                               id="image">
                                        @if ($errors->has('image'))
                                            <p class="text-danger">{{ $errors->first('image') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <img id="showImage"
                                             alt=""
                                             style="width: 100%; height: 300px; border: 1px solid #000;">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description :</label>
                                        <textarea id="description" type="text" class="form-control" name="description"
                                                  value="{{ old('description ') }}">
                                        </textarea>
                                        @if($errors->has('description'))
                                            <p class="text-danger">{{$errors->first('description')}}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="btn-create-product" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
