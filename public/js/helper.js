
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

