<div class="modal fade bd-example-modal-lg edit-product-modal" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="btn-edit-product-title">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formUpdateProduct" method="POST"
                  enctype="multipart/form-data">
                @csrf
            <div class="modal-body">
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <input type="hidden" id="url" class="url">
                                <div class="form-group">
                                    <label for="nameUpdate">Name</label>
                                    <input name="name" type="text" id="nameUpdate" class="form-control name">
                                    <span class="text-danger name_error_update"></span>
                                </div>
                                <div class="form-group">
                                    <label for="categoryIdUpdate">Categories</label>
                                    <select style="width: 100%;" name="category_ids[]"
                                            multiple="multiple"
                                            class="form-control select2 categories_edit categories">

                                    </select>
                                    <span class="text-danger category_ids_error_update"></span>
                                    <input type="hidden" class="curren" value="" id="currenChildrentId">
                                </div>
                                <div class="form-group">
                                    <label for="priceUpdate">Price</label>
                                    <input name="price" type="number" id="priceUpdate" class="form-control price" >
                                    <span class="text-danger price_error_update"></span>

                                </div>
                                <div class="form-group">
                                    <label for="imageUpdate"> Image :</label>
                                    <input type="file" class="form-control image" name="image" placeholder="image Name"
                                           id="imageUpdate" value="">
                                    <span class="text-danger image_error_update"></span>
                                </div>
                                <div class="form-group container" id="imageUpdateShow">
                                </div>
                                <div class="form-group">
                                    <label for="descriptionUpdate">Description :</label>
                                    <textarea id="descriptionUpdate" type="text" class="form-control description"
                                              name="description">
                                    </textarea>
                                    <span class="text-danger description_error_update"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="btn-update-product" type="button" class="btn btn-primary btn-update-product">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
