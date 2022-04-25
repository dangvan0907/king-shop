<div class="modal fade" id="createProductModal" tabindex="-1" role="dialog" aria-labelledby="createProductModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="inputName">Name</label>
                    <input name="name" type="text" id="inputName" class="form-control">
                    @if ($errors->has('name'))
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="inputStatus">Categorier</label>
                    <select name="category_ids[]" id="inputStatus" multiple="multiple" class="form-control custom-select select2">
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input name="price" type="number" id="Price" class="form-control">
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
                         style="width: 300px; height: 300px; border: 1px solid #000;">
                </div>
                <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea type="text" class="form-control" name="description"
                              value="{{ old('description ') }}">

                                </textarea>
                    @if($errors->has('description'))
                    <p class="text-danger">{{$errors->first('description')}}</p>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
