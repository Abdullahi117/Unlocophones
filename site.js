
if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready())
} else {
    var count;
    ready()
}

function ready() {
    /*var removeItembtns = document.getElementsByClassName('btn-danger');
    console.log(removeItembtns)
    for (var i = 0; i < removeItembtns.length; i++) {
        var button = removeItembtns[i];
        button.addEventListener('click', removeCartItem);
    } */
    var quantityInputs = document.getElementById('cart-quantity-input')
    for (var i = 0; i < quantityInputs.length; i++) {
        var input = quantityInputs[i]
        input.addEventListener('change', quantityChanged)
    }
    /*
    var addBtns = document.getElementsByClassName('shop-item-button') 
    for (var i = 0; i < addBtns.length; i++) {
        var addbtn = addBtns[i]
        addbtn.addEventListener('click', addToCart)
    }
    document.getElementsByClassName('btn-purchase')[0].addEventListener('click', purchaseClicked)
    if (localStorage.getItem('products') == null) {
        var items = [];
        localStorage.setItem('products', JSON.stringify(items));
    } */
    count = 0;
}

function quantityChanged(event) {
    var input = event.target
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1
    }

    /*updateCartTotal()*/
}