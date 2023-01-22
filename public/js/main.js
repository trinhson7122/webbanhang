$(document).ready(function () {
    $(document).on('click', '.btn-edit-product', function(e){      
        getProduct($(this).parents('form')[0]);         
    });
    //
    $(document).on('click', '.btn-edit-coupon', function(e){      
        getCoupon($(this).parents('form')[0]);         
    });
    //
    $(document).on('click', '.btn-add-to-cart', function(e){      
        addToCart($(this).parents('form')[0]);         
    });
    //
    $(document).on('change', '.input-update-cart', function(e){      
        updateCart($(this).parents('form')[0]);         
    });
});