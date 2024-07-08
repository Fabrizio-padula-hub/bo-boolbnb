const cartBtn = document.getElementById('ms-cartBtn');
const shoppingCart = document.getElementById('ms-shoppingCart');
cartBtn.addEventListener('click', function () {
    shoppingCart.classList.toggle('hidden');
});
const closeCart = document.getElementById('ms-closeCart');
closeCart.addEventListener('click', function () {
    shoppingCart.classList.add('hidden');
});