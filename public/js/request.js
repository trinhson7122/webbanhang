function getProduct(form)
{
    $.ajax({
        type: "get",
        url: form.action,
        dataType: "json",
        success: function (response) {
            setInput('#edit-product-modal', response);
        },
    });
}

function getCoupon(form)
{
    $.ajax({
        type: "get",
        url: form.action,
        dataType: "json",
        success: function (response) {
            setInputCoupon('#edit-coupon-modal', response);
        },
    });
}

function getOrderDetails(form)
{
    $.ajax({
        type: "get",
        url: form.action,
        dataType: "json",
        success: function (response) {
            fillOrderDetails('#view-order-modal', response);
        },
    });
}

function getOrderDetailsClient(form)
{
    $.ajax({
        type: "get",
        url: form.action,
        dataType: "json",
        success: function (response) {
            fillOrderDetails('#view-order-modal', response);
        },
    });
}

function addToCart(form)
{
    let data = new FormData(form);
    $.ajax({
        type: "post",
        processData: false,
        contentType: false,
        url: form.action,
        data: data,
        dataType: "json",
        success: function (response) {
            $.NotificationApp.send("Thông báo","Thêm sản phẩm vào giỏ hàng thành công","bottom-right","success","success");
        },
    });
}

function updateCart(form)
{
    let data = new FormData(form);
    $.ajax({
        type: "post",
        processData: false,
        contentType: false,
        url: form.action,
        data: data,
        dataType: "json",
        success: function (response) {
            loadPage('.load-page', '#load-page');
            //$.NotificationApp.send("Thông báo","Thêm sản phẩm vào giỏ hàng thành công","top-right","success","success");
        },
    });
}
function loadPage(find, idfill)
{
    $(find).load(location.href + " " + idfill);
}