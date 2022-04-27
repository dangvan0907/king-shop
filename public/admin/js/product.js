const Product = (function () {
    let updateUrl='';
    let modules = {};
    modules.resetForm = function (element) {
        element.trigger("reset");
    };
    modules.getUrlImage = function (image) {
        return image == Constant.ImageDefault ?
            Constant.IMAGE_URL + Constant.ImageDefault :
            Constant.IMAGE_URL + image;
    }
    modules.showEditImage = function (element, img) {
        element.html(`<img id="showImage" alt="" src="${img}"
        style="width: 100%; height: 400px; border: 1px solid #000;">
        <p id="resetImage" class="btn btn-sm resetImage">x</p>`);
    }
    modules.renderEdit = function (product, modal, url) {
        let img = Product.getUrlImage(product.image);
        Product.resetForm($('#' + Constant.FORM_UPDATE));
        // $('.url', modal).val(url);
        updateUrl=url;
        $('.name', modal).val(product.name);
        $('.price', modal).val(product.price);
        $('.description', modal).val(product.description);
        Product.showEditImage($('#imageUpdateShow'), img);
        $('.image-show', modal).attr('src', img);
    };
    modules.renderShow = function (product, element) {
        let img = Product.getUrlImage(product.image);
        let categories = $("#categoriesShow", element);
        let valueRender = '';
        $.each(product.categories, (key, value) => {
            valueRender += `<span class="badge badge-success">${value.name}</span>`;
        });
        categories.html(valueRender);
        $('#nameShow', element).html(product.name);
        $('#priceShow', element).html(product.price);
        $('#descriptionShow', element).html(product.description);
        $('#imageShow', element).attr('src', img);
    }
    modules.create = function () {
        let url = $('#formCreateProduct').data('action');
        let data = new FormData(document.getElementById(Constant.FORM_CREATE));
        Base.CallProductApi(url, data, Constant.POST)
            .done(function (res) {
                $('#createProductModal').modal('hide');
                Image.resetImage($('#imageCreateShow'), $('.image'));
                Product.resetForm($('#' + Constant.FORM_CREATE));
                $('.category_ids1').html('')
                Category.getCategories([], $('#' + Constant.FORM_CREATE));
                Product.list();
                CustomAlert.alertSuccess(res.message);
            })
            .catch(function (err) {
                CustomAlert.resetError($('#formCreateProduct'));
                CustomAlert.showError(err.responseJSON.errors, '_error_create');
            })
    }
    modules.edit = function (element, modal) {
        CustomAlert.resetError($('#formUpdateProduct'));
        Base.CallProductApi(element.data('action'))
            .done(function (res) {
                Category.getCategories(res.data.categories, modal);
                Product.renderEdit(res.data, modal, element.data('action2'));
            })
    };
    modules.update = function () {
        // let url = $('#url').val();
        let data = new FormData(document.getElementById(Constant.FORM_UPDATE));
        data.append('_method', Constant.PUT)
        Base.CallProductApi(updateUrl, data, Constant.POST)
            .then(function (res) {
                $('#editProductModal').modal('hide');
                Product.resetForm($('#' + Constant.FORM_UPDATE))
                Product.list();
                CustomAlert.alertSuccess(res.message);
            })
            .catch(function (err) {
                CustomAlert.resetError($('#' + Constant.FORM_UPDATE));
                CustomAlert.showError(err.responseJSON.errors, '_error_update');
            })
    }
    modules.delete = function (element) {
        Base.deleteConfirm()
            .then(function () {
                event.preventDefault();
                let url = element.data('action');
                Base.CallProductApi(url, {}, Constant.DELETE)
                    .then(res => {
                        Product.getList($('#list').data('action'));
                        CustomAlert.alertSuccess(res.message);
                    })
            })
            .catch(function () {
            })
    }
    modules.show = function (element) {
        let url = element.data('action');
        Base.CallProductApi(url)
            .then(function (res) {
                Product.renderShow(res.data, $('#showProductModal'));
            })
    }
    modules.getList = function (url, data = {}) {
        Base.CallProductApi(url, data)
            .then(function (res) {
                $("#list").replaceWith(res);
            });
    }
    modules.list = function () {
        let data = $('#searchProduct').serialize();
        let url = $('#list').data('action');
        Product.getList(url, data);
    };
    return modules;
}(window.jQuery, window, document));

function debounce(func, timeout = Constant.TIME) {
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => {
            func.apply(this, args);
        }, timeout);
    };
}

$(document).ready(function (e) {
    Product.getList($('#list').data('action'));
    $(document).on('click', '#btn-create-product', function (e) {
        e.preventDefault();
        Product.create();
    })
    $(document).on('keyup', '.name-search', debounce(function () {
        Product.list();
    }, Constant.TIME))
    $(document).on('keyup', '.min-price-search', debounce(function () {
        Product.list();
    }, Constant.TIME))
    $(document).on('keyup', '.max-price-search', debounce(function () {
        Product.list();
    }, Constant.TIME))
    $(document).on('change', '#category_id', debounce(function () {
        Product.list();
    }, Constant.TIME))
    $(document).on('click', '.createProduct', function (e) {
        e.preventDefault();
        CustomAlert.resetError($('#formCreateProduct'));
    })
    $(document).on('click', '.show-product', function (e) {
        e.preventDefault();
        Product.show($(this));
    })
    $(document).on('click', '.btn-update-product', function (e) {
        e.preventDefault();
        Product.update();
    })
    $(document).on('click', '.edit-product', function (e) {
        e.preventDefault();
        Product.edit($(this), $('.edit-product-modal'));
    })
    $(document).on('click', '.delete-product', function (e) {
        Product.delete($(this));
    })
});
