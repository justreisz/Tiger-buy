function inserirProduto() {
    var newProductName = inserir_produto.nome.value;
    var newProductPrice = inserir_produto.preco.value;
    var newProductImage = '/img/default-product-image.png';


    var productList = JSON.parse(localStorage.getItem('productList'));
    if (!productList) {
        productList = [];
    }

    // Lista de produtos
    productList.push({
        name: newProductName,
        price: newProductPrice,
        image: newProductImage,
    });

    localStorage.setItem('productList', JSON.stringify(productList));

    alert("Produto adicionado com sucesso! ");
}




let cartIcon = document.querySelector('#cart-icon');
let cart = document.querySelector('.cart-menu');
let closeCart = document.querySelector('#close-cart');

//Abrir carrinho     . = () =>  Event listener
cartIcon.onclick = () =>{
    cart.classList.add("active");
}

//Fechar carrinho
closeCart.onclick = () =>{
    cart.classList.remove("active");
}

if(document.readyState == 'loading'){
    document.addEventListener('DOMContentLoaded',ready);
} else{
    ready();
}



function ready(){
    document.getElementsByClassName('quantity')[0].innerText = 0;

    //Remover itens do carrinho
    var removeCartButtons = document.getElementsByClassName('cart-remove');
    for(var i= 0; i< removeCartButtons.length; i++){
        var button=removeCartButtons[i];
        button.addEventListener('click', removeCartItem);
    }

    //Alterar quantidade
    var quantityInputs = document.getElementsByClassName('cart-quantity');
    for (var i = 0; i < quantityInputs.length; i++){
        var input = quantityInputs[i];
        input.addEventListener('change',quantityChanged);
    }

    //Adicionar itens no carrinho
    var addCart = document.getElementsByClassName('add-cart');
    for (var i = 0; i < addCart.length; i++){
        var button = addCart[i];
        button.addEventListener('click',addCartClicked);
    }


    var productList = JSON.parse(localStorage.getItem('productList'));
    if (!productList) {
        productList = [];
    }
    var newItems = document.getElementsByClassName('newItems-content')[0];
    newItems.innerHTML = '';

    productList.forEach(function(product) {
        var newItemsBox = document.createElement('div');
        newItemsBox.classList.add('newItems-box');

        var newItemsBoxContent = `
            <div class="box">
                <img class="product-img" src="${product.image}">
                <h4 class="product-title">${product.name}</h4>
                <h5 class="product-price">${product.price}$</h5>
                <i class='bx bx-shopping-bag add-cart'></i>
            </div>`;

        newItemsBox.innerHTML = newItemsBoxContent;
        newItems.append(newItemsBox);
    });

    document.getElementsByClassName('btn-buy')[0].addEventListener('click', buyButtonClicked);
}

function buyButtonClicked() {
    alert('A tua encomenda foi realizada com sucesso!!');
    var cartContent = document.getElementsByClassName('cart-content')[0];
    while (cartContent.hasChildNodes()) {
    cartContent.removeChild(cartContent.firstChild);
    }
    updateTotal();
    document.getElementsByClassName('quantity')[0].innerText = 0;
}


//Remover itens do carrinho
function removeCartItem(event){
    var quantity = document.getElementsByClassName('quantity')[0].innerText;
    quantity = parseInt(quantity);
    quantity -= 1;
    document.getElementsByClassName('quantity')[0].innerText = quantity;
    var buttonClicked = event.target;
    buttonClicked.parentElement.remove();
    updateTotal()
}

function quantityChanged(event){
    var input = event.target;
    if (isNaN(input.value) || input.value <= 0){
        input.value = 1;
    }
    updateTotal();
}

function addCartClicked(event){
    var button = event.target;
    var products = button.parentElement;
    var title = products.getElementsByClassName('product-title')[0].innerText;
    var price = products.getElementsByClassName('product-price')[0].innerText;
    var productImg = products.getElementsByClassName('product-img')[0].src;
    var quantity = document.getElementsByClassName('quantity')[0].innerText;
    quantity = parseInt(quantity);
    quantity += 1;
    document.getElementsByClassName('quantity')[0].innerText = quantity;
    addProductToCart(title, price, productImg);
    updateTotal();
}

function addProductToCart(title, price, productImg){
    var cartShopBox = document.createElement('div');
    cartShopBox.classList.add('cart-box');
    var cartItems = document.getElementsByClassName('cart-content')[0];
    var cartItemsNames = cartItems.getElementsByClassName('cart-product-title');
    for (var i = 0; i < cartItemsNames.length; i++){
        if (cartItemsNames[i].textContent === title) {
            alert("Desculpe, mas já tem esse item no seu carrinho");
            var quantity = document.getElementsByClassName('quantity')[0].innerText;
            quantity = parseInt(quantity);
            quantity -= 1;
            document.getElementsByClassName('quantity')[0].innerText = quantity;
            return;
        }
    }
    var cartBoxContent = `
                            <img src="${productImg}" class="cart-img">
                            <div class="detail-box">
                                <div class="cart-product-title">${title}</div>
                                <div class="cart-price">${price}</div>
                                <input type="number" value="1" class="cart-quantity">
                            </div>
                            <i class='bx bxs-trash-alt cart-remove'></i>`;

    cartShopBox.innerHTML = cartBoxContent;
    cartItems.append(cartShopBox);
    cartShopBox.getElementsByClassName('cart-remove')[0].addEventListener('click', removeCartItem);
    cartShopBox.getElementsByClassName('cart-quantity')[0].addEventListener('change', quantityChanged);
}


function updateTotal(){
    var cartContent = document.getElementsByClassName('cart-content')[0];
    var cartBoxes = document.getElementsByClassName('cart-box');
    var total = 0;
    for (var i = 0; i < cartBoxes.length ; i++){
        var cartBox = cartBoxes[i];
        var priceElement = cartBox.getElementsByClassName('cart-price')[0];
        var quantityElement = cartBox.getElementsByClassName('cart-quantity')[0];
        var price = parseFloat(priceElement.innerText.replace("$",""));
        var quantity = quantityElement.value;
        total += price * quantity;
    }
        total = Math.round(total * 100)/ 100;

        document.getElementsByClassName('total-price')[0].innerText = "$" + total;
    
}