const Image = (function () {
    let modules = {};
    modules.loadImage = function (event, element) {
        let reader = new FileReader();
        reader.onload = function (event) {
            element.html(`
                <img id="showImage" alt="" src="${event.target.result}"
                    style="width: 100%; height: 400px; border: 1px solid #000;">
                <p id="resetImage" class="btn btn-sm resetImage">x</p>`);
        }
        reader.readAsDataURL(event.target.files['0']);
    };
    modules.resetImage = function (element, img) {
        element.html(null);
        img.val(null);
    };
    return modules;
}(window.jQuery, window, document));

$(document).ready(function (e) {
    $('#imageUpdate').change(function (e) {
        Image.loadImage(e, $('#imageUpdateShow'));
    });
    $(document).on('click', '#resetImage', function () {
        Image.resetImage($('#imageUpdateShow'), $('.image'));
    })


    $('#imageCreate').change(function (e) {
        Image.loadImage(e, $('#imageCreateShow'));
    });
    $(document).on('click', '#resetImage', function () {
        Image.resetImage($('#imageCreateShow'), $('.image'));
    })
});
