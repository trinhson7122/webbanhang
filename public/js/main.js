$(document).ready(function () {
    $(document).on('click', '.btn-edit-product', function(e){      
        getProduct($(this).parents('form')[0]);         
    });
    //
    $(document).on('click', '.btn-edit-coupon', function(e){      
        getCoupon($(this).parents('form')[0]);         
    });
    //
    $(document).on('click', '.btn-view-order', function(e){      
        getOrderDetails($(this).parents('form')[0]);         
    });
    //
    $(document).on('click', '.btn-view-order1', function(e){      
        getOrderDetailsClient($(this).parents('form')[0]);         
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
    $(document).on('click', '.social-list-item1', function(e){     
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
    //
    // $(document).on('click', '.confirm-submit', function(e){  
    //     $(this).parent().submit(function (e) { 
    //         e.preventDefault();
    //         console.log($(this));     
    //     });    
    // });
    $('.confirm-submit').click(function (e) { 
        e.preventDefault();
        let result = confirm('Bạn có chắc chắn muốn xóa không?');
        if(result){
            $(this).parent().submit();
        }
    });
    //
    // $('#view-order-modal').on('show.bs.modal', function(e){      
    //     alert(1);    
    //     $.each(collection, function (indexInArray, valueOfElement) { 
             
    //     });     
    // });
    $(document).on('click', '.btn-show-status', function(e){
        let action = $(this).parent('form')[0].action;
        $('#update-status-order-modal form').attr('action', action);
    });
    //
    // $(document).on('change', '.submit-show-slide', function(e){
    //     $(this).parent('form').submit();
    // });
    //
    

    let chartProductPerMonth = $('#sanphamdaban')[0];
    getProductSaledPerMonth(chartProductPerMonth.dataset.url, chartProductPerMonth);
    let chartOrderPerMonth = $('#yeucau')[0];
    getOrderPerMonth(chartOrderPerMonth.dataset.url, chartOrderPerMonth);
});