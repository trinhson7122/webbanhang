
function setInput(selectorParent, response) {
    $(selectorParent + " input[name='name']").val(response.name);
    $(selectorParent + " input[name='image']").val(response.image);
    $(selectorParent + " input[name='price']").val(response.price);
    $(selectorParent + " input[name='amount']").val(response.amount);
    let form = $(selectorParent + " form");
    let arr = form.attr('action').split('/');
    let url = '';
    for(let i = 0; i < arr.length - 1; i++)
    {
        url += arr[i] + '/';
    }
    url += response.id;
    form.attr('action', url);
}
function setInputCoupon(selectorParent, response) {
    $(selectorParent + " input[name='name']").val(response.name);
    $(selectorParent + " input[name='discount']").val(response.discount);
    $(selectorParent + " input[name='amount']").val(response.amount);
    let form = $(selectorParent + " form");
    let arr = form.attr('action').split('/');
    let url = '';
    for(let i = 0; i < arr.length - 1; i++)
    {
        url += arr[i] + '/';
    }
    url += response.id;
    form.attr('action', url);
}
function fillOrderDetails(selectorModal, response){
    let table = $(selectorModal + ' tbody');
    let sum = 0;
    table.html('');
    response.orderDetails.forEach(item => {
        sum += item.amount * item.product.price;
        var content = `
        <tr>
            <td>
                <img src="${item.product.image}" alt="contact-img" title="contact-img" class="rounded mr-2" height="48">
                <p class="m-0 d-inline-block align-middle">
                    <span class="text-body font-weight-semibold">${item.product.name}</span>
                    <br>
                    <small>${item.amount} x ${item.product.price} đ</small>
                </p>
            </td>
            <td class="text-right">
            ${item.amount * item.product.price} đ
            </td>
        </tr>
        `;
        table.append(content);
    });
    content = `
    <tr class="text-right">
        <tr class="text-right">
            <td colspan="2">
                <span class="bold">
                    Tổng tiền: 
                </span>
                <span class="sum_order">
                    ${sum} đ
                </span>
            </td>
        </tr>
    </tr>
    `;
    table.append(content);
    if(response.coupon){
        content = `
        <tr class="text-right">
            <tr class="text-right">
                <td colspan="2">
                    <span class="bold">
                        Mã giảm giá: (${response.coupon.name})
                    </span>
                    <span class="sum_order">
                       - ${response.coupon.discount / 100 * sum} đ
                    </span>
                </td>
            </tr>
        </tr>
        `;
        table.append(content);
    }
    content = `
    <tr class="text-right">
        <tr class="text-right">
            <td colspan="2">
                <span class="bold">
                    Thành tiền: 
                </span>
                <span class="sum_order">
                    ${response.order.sum_price} đ
                </span>
            </td>
        </tr>
    </tr>
    `;
    table.append(content);
}
