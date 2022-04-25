<div class="modal fade bd-example-modal-lg show-product-modal" id="showProductModal" tabindex="-1" role="dialog" aria-labelledby="showProductModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="btn-edit-product-title">Show</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <section class="content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="form-group">
                                        <label for="nameShow">Name :</label>
                                        <p id="nameShow"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="categoriesShow">Categories :</label>
                                        <div id="categoriesShow">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="priceShow">Price :</label>
                                        <p id="priceShow"></p>
                                    </div>
                                    <div class="form-group">
                                        <img id="imageShow" width="100%" height="300px" src="" alt="show img product">
                                    </div>
                                    <div class="form-group">
                                        <label for="descriptionShow">Description :</label>
                                        <textarea id="descriptionShow" disabled type="text" class="form-control">
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>
