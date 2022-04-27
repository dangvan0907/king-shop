$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
const Constant = {
    DELETE:'DELETE',
    PUT:'put',
    POST:'POST',
    GET:'get',
    ImageDefault:'default.jpg',
    URL_CATEGORY:'categories/children',
    TIME:2000,
    IMAGE_URL:'images/',
    FORM_CREATE:'formCreateProduct',
    FORM_UPDATE:'formUpdateProduct',
};
const Base = (function () {
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
    modules.deleteConfirm = function (){
        return new Promise((resolve,reject)=>{
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    resolve(true)
                }
                reject(false)
            })
        })

    }
    modules.message = function (){
        $('#messageSession').html()?CustomAlert.alertSuccess($('#messageSession').html()):null;
    }
    return modules;
}(window.jQuery, window, document));
$( document ).ready(function() {
    $('input').attr('autocomplete','off');
    Base.message();
});
