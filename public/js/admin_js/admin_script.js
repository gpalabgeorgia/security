$(document).ready(function() {
    // Check Admin Password is correct or not
    $("#current_pwd").keyup(function() {
        let current_pwd = $("#current_pwd").val();
        // alert(current_pwd);
        $.ajax({
            type: 'post',
            url: '/admin/check-current-pwd',
            data: {current_pwd:current_pwd},
            success: function(resp) {
                // alert(resp);
                if(resp=="false") {
                    $("#chkCurrentPwd").html("<font color='red'>Текущий пароль неверный!</font>");
                }else if(resp=="true") {
                    $("#chkCurrentPwd").html("<font color='green'>Текущий пароль верный!</font>");
                }
            }, error: function() {
                alert("Произошла Ошибка!");
            }
        });
    });

    $(".updateSectionStatus").click(function() {
        let status = $(this).text();
        let section_id = $(this).attr("section_id");
        $.ajax({
            type: 'post',
            url: '/admin/update-section-status',
            data: {status:status,section_id:section_id},
            success: function(resp) {
                if(resp['status']==0) {
                    $('#section-'+section_id).html('<a class="updateSectionStatus" href="javascript:void(0)">Inactive</a>');
                }else if(resp['status']==1) {
                    $('#section-'+section_id).html('<a class="updateSectionStatus" href="javascript:void(0)">Active</a>');
                }
            },error: function() {
                alert('წარმოიშვა შეცდომა!');
            }
        });
    });

    $(".updateBrandStatus").click(function() {
        let status = $(this).children("i").attr("status");
        let brand_id = $(this).attr("brand_id");
        $.ajax({
            type: 'post',
            url: '/admin/update-brand-status',
            data: {status:status,brand_id:brand_id},
            success: function(resp) {
                if(resp['status']==0) {
                    $('#brand-'+brand_id).html('<i class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i>');
                }else if(resp['status']==1) {
                    $('#brand-'+brand_id).html('<i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i>');
                }
            },error: function() {
                alert('წარმოიშვა შეცდომა!');
            }
        });
    });

    $(".updateCategoryStatus").click(function() {
        let status = $(this).text();
        let category_id = $(this).attr("category_id");
        $.ajax({
            type: 'post',
            url: '/admin/update-category-status',
            data: {status:status,category_id:category_id},
            success: function(resp) {
                if(resp['status']==0) {
                    $('#category-'+category_id).html('<a class="updateCategoryStatus" href="javascript:void(0)">Inactive</a>');
                }else if(resp['status']==1) {
                    $('#category-'+category_id).html('<a class="updateCategoryStatus" href="javascript:void(0)">Active</a>');
                }
            },error: function() {
                alert('წარმოიშვა შეცდომა!');
            }
        });
    });

    $(".updateProductStatus").click(function() {
        let status = $(this).text();
        let product_id = $(this).attr("product_id");
        $.ajax({
            type: 'post',
            url: '/admin/update-product-status',
            data: {status:status,product_id:product_id},
            success: function(resp) {
                if(resp['status']==0) {
                    $('#product-'+product_id).html('<a class="updateProductStatus" href="javascript:void(0)">Inactive</a>');
                }else if(resp['status']==1) {
                    $('#product-'+product_id).html('<a class="updateProductStatus" href="javascript:void(0)">Active</a>');
                }
            },error: function() {
                alert('წარმოიშვა შეცდომა!');
            }
        });
    });

    $(".updateAttributeStatus").click(function() {
        let status = $(this).text();
        let attribute_id = $(this).attr("attribute_id");
        $.ajax({
            type: 'post',
            url: '/admin/update-attribute-status',
            data: {status:status,attribute_id:attribute_id},
            success: function(resp) {
                if(resp['status']==0) {
                    $('#attribute-'+attribute_id).html('Inactive');
                }else if(resp['status']==1) {
                    $('#attribute-'+attribute_id).html('Active');
                }
            },error: function() {
                alert('წარმოიშვა შეცდომა!');
            }
        });
    });

    $(".updateImageStatus").click(function() {
        let status = $(this).text();
        let image_id = $(this).attr("image_id");
        $.ajax({
            type: 'post',
            url: '/admin/update-image-status',
            data: {status:status,image_id:image_id},
            success: function(resp) {
                if(resp['status']==0) {
                    $('#image-'+image_id).html('Inactive');
                }else if(resp['status']==1) {
                    $('#image-'+image_id).html('Active');
                }
            },error: function() {
                alert('წარმოიშვა შეცდომა!');
            }
        });
    });

    // Append Categories Level
    $('#section_id').change(function() {
        let section_id = $(this).val();
        $.ajax({
            type: 'post',
            url: '/admin/append-categories-level',
            data: {section_id:section_id},
            success:function(resp) {
                $('#appendCategoriesLevel').html(resp);
            },error: function() {
                alert('წარმოიშვა შეცდომა!');
            }
        });
    });

    $('.confirmDelete').click(function() {
        let record = $(this).attr('record');
        let recordid = $(this).attr('recordid');
        Swal.fire({
            title: "გსურთ წაშლა?",
            text: "მოქმედებას ვეღარ გააუქმებთ!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "დიახ, წაშალე!"
        }).then((result) => {
            if (result.value) {
                window.location.href="/admin/delete-"+record+"/"+recordid;
            }
        });
    });

    // Products Attributes  Add/Remove Script
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><div style="height: 10px;"></div><input type="text" name="size[]" style="width: 120px;" placeholder="ზომა" required=""/>&nbsp;<input type="text" name="sku[]" style="width: 120px;" placeholder="SKU" required=""/>&nbsp;<input type="number" name="price[]" style="width: 120px;" placeholder="ფასი" required=""/>&nbsp;<input type="number" name="stock[]" style="width: 120px;" placeholder="რაოდენობა" required=""/><a href="javascript:void(0);" class="remove_button">წაშლა</a></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    // Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increase field counter
            $(wrapper).append(fieldHTML); //Add field html
        }else{
            alert('A maximum of '+maxField+' fields are allowed to be added. ');
        }
    });

    // Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
});
