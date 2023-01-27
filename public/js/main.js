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
    //popup social
    $(document).on('click', '.social-list-item', function(e){     
        e.preventDefault();
        let text = "sonne/callback/sad";
        let url = $(this).attr('href');
        let popup = window.open(url, 'social', 'popup');
        setInterval(function (){
            if(popup.location.href.match('callback')){
                popup.close();
                window.location.reload();
            }
        }, 100);
        //updateCart($(this).parents('form')[0]);         
    });
});