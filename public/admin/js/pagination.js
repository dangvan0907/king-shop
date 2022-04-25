$(document).on('click', '.pagination a', function (e) {
    e.preventDefault();
    let url = $(this).attr('href');
    console.log(url);
    Product.getList(url);
})
