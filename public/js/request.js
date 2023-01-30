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

function getProductSaledPerMonth(url, element)
{
    $.ajax({
        type: "get",
        url: url,
        dataType: "json",
        success: function (response) {
            let months = [];
            let arrData = [];
            $.map(response, function (elementOrValue, indexOrKey) {
                months.push(indexOrKey);
                arrData.push(elementOrValue);
            });
            let series = [{
                name : 'Sản phẩm',
                data : arrData,
            }];
            showChart('Sản phẩm bán trong năm', element, series, months);
        }
    });
}

function getOrderPerMonth(url, element)
{
    $.ajax({
        type: "get",
        url: url,
        dataType: "json",
        success: function (response) {
            let months = [];
            let arrDataSuccess = [];
            let arrDataCance = [];
            $.map(response.shipped, function (elementOrValue, indexOrKey) {
                months.push(indexOrKey);
                arrDataSuccess.push(elementOrValue);
            });
            $.map(response.cancelled, function (elementOrValue, indexOrKey) {
                arrDataCance.push(elementOrValue);
            });
            let series = [
                {
                    name : 'Thành công',
                    data : arrDataSuccess,
                },
                {
                    name : 'Hủy',
                    data : arrDataCance,
                },
            ];
            showChart('Đơn hàng trong năm', element, series, months);
        }
    });
}