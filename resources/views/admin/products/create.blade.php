<div class="modal bd-example-modal-lg fade" id="createProductModal" tabindex="-1" role="dialog"
     aria-labelledby="createProductModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProductModalTitle">Create</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formCreateProduct" data-action="{{route('products.store')}}" method="POST"
                  enctype="multipart/form-data">
                <div class="modal-body">
                    <section class="content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input name="name" type="text" id="name" class="form-control name">
                                        <span class="text-danger name_error_create"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_ids">Categories</label>
                                        <select style="width: 100%;" name="category_ids[]"
                                                data-action="{{route('categories.children')}}"
                                                multiple="multiple"
                                                class="form-control select2 categories category_ids">
                                            @foreach($categoryChildren as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger category_ids_error_create"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input name="price" type="number" id="price" class="form-control price">
                                        <span class="text-danger price_error_create"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="imageCreate"> Image :</label>
                                        <input type="file" class="form-control image" name="image"
                                               placeholder="image Name"
                                               id="imageCreate">
                                        <span class="text-danger image_error_create"></span>
                                    </div>
                                    <div class="form-group container" id="imageCreateShow">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description :</label>
                                        <textarea id="description" type="text" class="form-control description"
                                                  name="description"
                                                  value="{{ old('description ') }}">
                                        </textarea>
                                        <span class="text-danger description_error_create"></span>
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
