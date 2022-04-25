const CheckBox = (function () {
    let modules = {};
    modules.getSelectedItems = function (listCheckItems){
        let getCheckedValues = [];
        getCheckedValues = [];
        listCheckItems.filter(":checked").each(function() {
            getCheckedValues.push($(this).val());
        });
        $("#selected-values").html(JSON.stringify(getCheckedValues));
    }
    modules.checkAll = function (listCheckItems, element){
        let isMasterChecked = element.is(":checked");
        listCheckItems.prop("checked", isMasterChecked);
        CheckBox.getSelectedItems(listCheckItems);
    }
    modules.checkListItem = function (listCheckItems, masterCheck){
        let totalItems = listCheckItems.length;
        let checkedItems = listCheckItems.filter(":checked").length;
        if (totalItems == checkedItems) {
            masterCheck.prop("checked", true);
        }
        else {
            masterCheck.prop("checked", false);
        }
        CheckBox.getSelectedItems(listCheckItems);
    }
    return modules;
}(window.jQuery, window, document));
$(document).ready(function (e){
    let masterCheck = $("#checkAll");
    let listCheckItems = $("#list-wrapper :checkbox");

    let userCheck = $('.user-parent');
    let listCheckUserItems = $(".user-item :checkbox");

    let productCheck = $('.product-parent');
    let listCheckProductItems = $(".product-item :checkbox");

    let categoryCheck = $('.category-parent');
    let listCheckCategoryItems = $(".category-item :checkbox");

    let roleCheck = $('.role-parent');
    let listCheckRoleItems = $(".role-item :checkbox");



    userCheck.on( "change click", function() {
        CheckBox.checkAll(listCheckUserItems,userCheck);
    });
    listCheckUserItems.on("change", function() {
        CheckBox.checkListItem(listCheckUserItems, userCheck);
    });

    roleCheck.on( "change click", function() {
        CheckBox.checkAll(listCheckRoleItems,roleCheck);
    });
    listCheckRoleItems.on("change", function() {
        CheckBox.checkListItem(listCheckRoleItems, roleCheck);
    });

    productCheck.on( "change click", function() {
        CheckBox.checkAll(listCheckProductItems,productCheck);
    });
    listCheckProductItems.on("change", function() {
        CheckBox.checkListItem(listCheckProductItems, productCheck);
    });

    categoryCheck.on( "change click", function() {
        CheckBox.checkAll(listCheckCategoryItems,categoryCheck);
    });
    listCheckCategoryItems.on("change", function() {
        CheckBox.checkListItem(listCheckCategoryItems, categoryCheck);
    });

    masterCheck.on("click", function() {
        CheckBox.checkAll(listCheckItems,$(this));
    });
    listCheckItems.on("change", function() {
        CheckBox.checkListItem(listCheckItems, masterCheck);
    });

});

