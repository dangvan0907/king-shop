const Base = (function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let modules = {};
    modules.CallProductApi = function (url='',data={},method='GET'){
        return $.ajax({
            type:method,
            data:data,
            url:url,
            processData: false,
            contentType: false
        });
    }
    modules.delete = function (element){
        let value = element.data('value');
        if (prompt(`Bạn có muốn tiếp tục delete( ${value} )? Hãy nhập yes !`) == 'yes') {
            let url = element.data('action');
            Base.CallProductApi(url, {},'DELETE')
                .then(function (res){
                    if(!url.includes('products')){
                        location.reload();
                    }else{
                        Product.getListProducts();
                        CustomAlert.alertSuccess(res.message);
                    }


                });
        }
    }
    return modules;
}(window.jQuery, window, document));
