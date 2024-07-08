const cartBtn = document.getElementById('ms-cartBtn');
const shoppingCart = document.querySelector('.ms-shoppingCart');
cartBtn.addEventListener('click', function () {
    shoppingCart.classList.toggle('hidden');
});

const closeCart = document.getElementById('ms-closeCart');
closeCart.addEventListener('click', function () {
    shoppingCart.classList.add('hidden');
});

document.addEventListener('DOMContentLoaded', function () {
    const incrementButtons = document.querySelectorAll('.increment');
    const decrementButtons = document.querySelectorAll('.decrement');
    const quantities = document.querySelectorAll('.quantity');
    const cartContainer = document.getElementById('cartContainer');
    const totalElement = document.querySelector('.total');
    const cart = {};

    incrementButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            let quantity = parseInt(quantities[index].textContent, 10);
            quantities[index].textContent = quantity + 1;
            updateCart(index, 1);
        });
    });

    decrementButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            let quantity = parseInt(quantities[index].textContent, 10);
            if (quantity > 0) {
                quantities[index].textContent = quantity - 1;
                updateCart(index, -1);
            }
        });
    });

    function updateCart(index, change) {
        const price = parseFloat(document.querySelectorAll('.price')[index].textContent);
        const name = document.querySelectorAll('.text-2xl')[index].textContent;

        if (!cart[index]) {
            cart[index] = {
                quantity: 0,
                name: name,
                price: price
            };
        }

        cart[index].quantity += change;

        if (cart[index].quantity <= 0) {
            delete cart[index];
        }

        renderCart();
        updateTotal();
    }

    function renderCart() {
        cartContainer.innerHTML = '';
        for (let key in cart) {
            const cartItem = document.createElement('div');
            cartItem.classList.add('rounded-lg', 'cartElements');

            cartItem.innerHTML = `
                <div class="flex justify-between items-center mb-6 rounded-lg bg-white p-6 shadow-md">
                    <div class="numberSinglePlanSelected">x${cart[key].quantity}</div>
                    <div class="mx-4 flex w-full justify-between items-center">
                        <h2 class="text-lg font-bold text-gray-900">${cart[key].name}</h2>
                        <div class="singlePlanTotal">${(cart[key].price * cart[key].quantity).toFixed(2)}€</div>
                    </div>
                    <div class="deleteSinglePlanTotal flex items-center space-x-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-5 w-5 cursor-pointer duration-150 hover:text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
            `;

            cartItem.querySelector('.deleteSinglePlanTotal').addEventListener('click', () => {
                delete cart[key];
                renderCart();
                updateTotal();
            });

            cartContainer.appendChild(cartItem);
        }
    }

    function updateTotal() {
        let total = Object.keys(cart).reduce((sum, key) => {
            return sum + cart[key].price * cart[key].quantity;
        }, 0);

        totalElement.textContent = `${total.toFixed(2)}€`;
    }
});