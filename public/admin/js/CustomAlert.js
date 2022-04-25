const CustomAlert = (function () {
    let modules = {};
    modules.showError = function (errors, name) {
        let arrayErrors = [];
        for (const errorsKey in errors) {
            arrayErrors.push({'className': `${errorsKey}${name}`, 'error': errors[errorsKey], 'name': errorsKey})
        }
        arrayErrors.forEach(function (value) {
            $('.' + value.className).html(value.error);
        });
        CustomAlert.focusValidateError(arrayErrors[0]);
    };
    modules.resetError = function (element) {
        let listErrorItems = $('.text-danger', element);
        listErrorItems.each(function () {
            $(this).html('');
        })
    };
    modules.focusValidateError = function (value) {
        $('.' + value.name).focus();
    }
    modules.alertSuccess = function (message) {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: message,
            button: {
                text: "Ok",
            },
            timer: 1500
        })
    }
    return modules;
}(window.jQuery, window, document));
