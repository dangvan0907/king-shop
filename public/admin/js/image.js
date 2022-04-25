const Image = (function (){
    let modules = {};
    modules.loadImage = function (event, element){
        let reader = new FileReader();
        reader.onload = function (event) {
            element.attr('src', event.target.result);
        }
        reader.readAsDataURL(event.target.files['0']);
    };
    modules.resetImage = function (element,img){
        element.attr('src',null);
        img.attr('src',null);
    };
    return modules;
}(window.jQuery, window, document));

$(document).ready(function (e){
   $('#resetImageUpdate').click(function (){
       Image.resetImage($('#showImageUpdate'),$('#imageUpdate'));
   }) ;
    $('#resetImageCreate').click(function (){
        Image.resetImage($('#showImage'),$('.image'));
    }) ;
    $('#imageUpdate').change(function (e){
        Image.loadImage(e,$('#showImageUpdate'));
    }) ;
    $('#imageCreate').change(function (e){
        Image.loadImage(e,$('#showImage'));
    }) ;
});
