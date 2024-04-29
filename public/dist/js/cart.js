(function ($) {
    // Update Product Quantity
    $(document).on("change", ".item-quantity", function(e){
        e.preventDefault();
        let itemId = $(this).data("id");
        $.ajax({
            url: "/cart/" + itemId, //data-id
            method: "POST",
            data: {
                quantity: $(this).val(),
                _method: 'PUT',
                _token: csrf_token,
            },
            success: function(data) {
                $("#price-with-change-quantity-" + itemId).html(data.msg)
                $("#cart-menu-quantity-with-change-" + itemId).html(data.quantity+"x -")
                $("#cart-menu-amount-with-change-" + itemId).html(data.msg)
                $("#subtotal-with-change").html(data.total)
                $("#you-pay-with-change").html(data.total)
                $("#total-with-change").html(data.total)
            }
        });
    });

    // Remove Product
    $(document).on("click", ".remove-item", function (e) {
        e.preventDefault();
        let id = $(this).data("id");
        $.ajax({
            url: "/cart/" + id,
            method: "POST",
            data: {
                _method: 'DELETE',
                _token: csrf_token,
            },
            success: function(data) {
                $(`#${id}`).remove();
                $(`#cart-menu-item-${id}`).remove();
                $("#total-count-change-outside").html(data.itemCount)
                $("#total-count-change-inside").html(data.itemCount)
                $("#subtotal-with-change").html(data.total)
                $("#you-pay-with-change").html(data.total)
                $("#total-with-change").html(data.total)
            }
        });
    });

    // Add Product
    $(document).on("click", ".add-product-to-cart", function(e){
        e.preventDefault();
        let product_id = $(this).data("product_id");
        $.ajax({
            url: "/cart", //data-id
            method: "POST",
            data: {
                product_id: product_id,
                quantity: $(this).data("quantity"),
                _token: csrf_token,
            },
            success: function (res) {
                $('.cart-items').html(res);
            },
        });
    });

    // Pagination Shop - Page
    $(document).on("click", ".pagination a", function(e){
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        product(page);
    })

    function product(page){
        $.ajax({
            url: "/pagination/paginate-data?page="+page,
            success: function(res){
                $('.tab-content').html(res)
            }
        });
    }

})(jQuery);

