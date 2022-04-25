const Category = (function () {
    let modules = {};
    modules.renderCategories = function (categories, element, categories_id) {
        let categoriesRender = $('.categories', element).html('');
        let html = '';
        for (const categoriesKey in categories) {
            if (categories_id.includes(categories[categoriesKey].id)) {
                html += '<option value="' + categories[categoriesKey].id + '" selected>' + categories[categoriesKey].name + '</option>'
            } else {
                html += '<option value="' + categories[categoriesKey].id + '">' + categories[categoriesKey].name + '</option>'
            }
        }
        categoriesRender.append(html);
    };
    modules.getCategories = function (data, element) {
        event.preventDefault();
        let categories_id = [];
        data.map(value => {
            categories_id.push(value.id??'');
        })
        Base.CallProductApi(Constant.URL_CATEGORY).then(function (res) {
            Category.renderCategories(res.data.data, element, categories_id);
        })
    };
    modules.delete = function (element) {
        Base.deleteConfirm(element)
            .then((result) => {
                if (result) {
                    event.preventDefault();
                    $("#delete-" + element.data('id')).submit();
                }
            })
    }
    return modules;
}(window.jQuery, window, document))

$(document).ready(function (e) {
    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        Category.delete($(this));
    })
});
