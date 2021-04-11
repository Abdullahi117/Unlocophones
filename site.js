if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready())
} else {
    ready()
}

function ready() {
    var removeItembtns = document.getElementsByClassName('btn-danger');
    console.log(removeItembtns)
    for (var i = 0; i < removeItembtns.length; i++) {
        var button = removeItembtns[i];
        button.addEventListener('click', removeCartItem);
    }
    var quantityInputs = document.getElementsByClassName('cart-quantity-input')
    for (var i = 0; i < quantityInputs.length; i++) {
        var input = quantityInputs[i]
        input.addEventListener('change', quantityChanged)
    }
    var addBtns = document.getElementsByClassName('shop-item-button') 
    for (var i = 0; i < addBtns.length; i++) {
        var addbtn = addBtns[i]
        addbtn.addEventListener('click', addToCart)
    }
    document.getElementsByClassName('btn-purchase')[0].addEventListener('click', purchaseClicked)
}
function purchaseClicked() {
    var cartItems = document.getElementsByClassName('cart-items')[0]
    while (cartItems.hasChildNodes()) {
        cartItems.removeChild(cartItems.firstChild)
    }
    updateCartTotal()
    addProduct()
}

function addProduct(){
    let products = [];
    if(localStorage.getItem('products')){
        products = JSON.parse(localStorage.getItem('products'));
    }
    var cartItems = document.getElementsByClassName('cart-items')
    for (var i = 0; i < cartItems.length; i++) {
        var item = cartItems[i]
        var title = item.getElementsByClassName('cart-item-title').innerHTML
        var price = item.getElementsByClassName('cart-price').innerHTML
        var imageSrc = item.getElementsByClassName('cart-item-image').src
        products.push([title, price, imageSrc]);
        localStorage.setItem('products', JSON.stringify(products));
    }
}

function removeCartItem(event) {
    var btnclicked = event.target
    btnclicked.parentNode.parentNode.remove()
    updateCartTotal()
}
function quantityChanged(event) {
    var input = event.target
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1
    }
    updateCartTotal()
}
function addToCart(event) {
    var button = event.target
    var shopItem = button.parentNode
    var title = shopItem.getElementsByClassName('phonename')[0].innerText
    var price = shopItem.getElementsByClassName('phoneprice')[0].innerText
    var imageSrc = shopItem.getElementsByClassName('phoneimg')[0].src
    addItemToCart(title, price, imageSrc)
}
function addItemToCart(title, price, imageSrc) {
    var cartRow = document.createElement('div')
    cartRow.classList.add('cart-row')
    var cartItems = document.getElementsByClassName('cart-items')[0]
    var cartItemNames = document.getElementsByClassName('phonename')
    for (var i = 0; i < cartItemNames.length; i++) {
        if (cartItemNames.innerHTML == title) {
            alert('This Item Already Exists in your cart')
            return
        }
    }
    
    var cartRowContents = `
        <div class="cart-item cart-column">
            <img class="cart-item-image" src="${imageSrc}" width="100" height="100">
            <span class="cart-item-title">${title}</span>
        </div>
        <span class="cart-price cart-column">${price}</span>
        <div class="cart-quantity cart-column">
            <input class="cart-quantity-input" type="number" value= 1>
            <button class="btn btn-danger" type="button">REMOVE</button>
        </div>
    `
    cartRow.innerHTML = cartRowContents
    cartItems.append(cartRow);
    cartRow.getElementsByClassName('btn-danger')[0].addEventListener('click', removeCartItem)
    cartRow.getElementsByClassName('cart-quantity-input')[0].addEventListener('change', quantityChanged)
    updateCartTotal()
}


function updateCartTotal() {
    var cartItemContainer = document.getElementsByClassName('cart-items')[0]
    var cartRows = document.getElementsByClassName('cart-row')
    var total = 0
    for (var i = 1; i < cartRows.length; i++) {
        var cartRow = cartRows[i]
        var priceElement = cartRow.getElementsByClassName('cart-price')[0]
        quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0]
        var price = parseFloat(priceElement.innerText.replace('$', ''))
        quantity = quantityElement.value
        total = total + (price * quantity)
    }
    total = Math.round(total * 100) / 100
    document.getElementsByClassName('cart-total-price')[0].innerText = '$' + total
}