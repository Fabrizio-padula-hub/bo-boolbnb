const sponsorshipCards = document.querySelectorAll('.sponsorship');
const paymentFormContainer = document.querySelector('.payment-form-container');
const cartContainer = document.getElementById('cartContainer');
const closeCart = document.getElementById('ms-closeCart');
const form = document.getElementById('payment-form');
const prepaymentBtn = document.getElementById('prepaymentBtn');
const paymentBtn = document.getElementById('paymentBtn');
const dropinContainer = document.getElementById('dropin-container');
let cardData;
let apartmentData;

sponsorshipCards.forEach(singleCard => {
    singleCard.addEventListener('click', function () {
        apartmentData = JSON.parse(singleCard.getAttribute('data-apartment'));
        cardData = JSON.parse(singleCard.getAttribute('data-card'));
        cartContainer.innerHTML = '';
        const cartItem = document.createElement('div');
        cartItem.classList.add('rounded-lg', 'cartElements');
        cartItem.innerHTML = `
                <div class="flex justify-between items-center mb-6 rounded-lg p-6 shadow-md bg-clip-border border-solid border-2 border-indigo-800">
                    <div class="mx-4 px-3 flex w-full justify-between items-center">
                    <h1 class="text-indigo-400">${cardData.name}</h1>
                    <div class="singlePlanTotal">${cardData.price}€</div>
                    </div>
                </div>`;
        cartContainer.appendChild(cartItem);
        paymentFormContainer.classList.remove('hidden');
    });
});

closeCart.addEventListener('click', function () {
    paymentFormContainer.classList.add('hidden');
});

prepaymentBtn.addEventListener('click', function () {
    if (apartmentData.id && apartmentData.slug) {
        dropinContainer.classList.remove('hidden');
        if (!dropinContainer.classList.contains('hidden')) {
            axios.get(`${apartmentData.slug}/payment/token`)
                .then(response => {
                    const data = response.data;
                    braintree.dropin.create({
                        authorization: data.token,
                        container: '#dropin-container'
                    }, function (err, dropinInstance) {
                        if (err) {
                            console.error(err);
                            return;
                        } else {
                            form.addEventListener('submit', function (event) {
                                event.preventDefault();
                                dropinInstance.requestPaymentMethod(function (err, payload) {
                                    if (err) {
                                        console.error(err);
                                        return;
                                    }

                                    const hiddenInputNonce = document.createElement('input');
                                    hiddenInputNonce.setAttribute('type', 'hidden');
                                    hiddenInputNonce.setAttribute('name', 'payment_method_nonce');
                                    hiddenInputNonce.setAttribute('value', payload.nonce);
                                    form.appendChild(hiddenInputNonce);

                                    const hiddenInputPrice = document.createElement('input');
                                    hiddenInputPrice.setAttribute('type', 'hidden');
                                    hiddenInputPrice.setAttribute('name', 'price');
                                    hiddenInputPrice.setAttribute('value', cardData.price);
                                    form.appendChild(hiddenInputPrice);

                                    const hiddenInputApartmentId = document.createElement('input');
                                    hiddenInputApartmentId.setAttribute('type', 'hidden');
                                    hiddenInputApartmentId.setAttribute('name', 'apartment_id');
                                    hiddenInputApartmentId.setAttribute('value', apartmentData.id);
                                    form.appendChild(hiddenInputApartmentId);

                                    const hiddenInputApartmentSlug = document.createElement('input');
                                    hiddenInputApartmentSlug.setAttribute('type', 'hidden');
                                    hiddenInputApartmentSlug.setAttribute('name', 'apartment_slug');
                                    hiddenInputApartmentSlug.setAttribute('value', apartmentData.slug);
                                    form.appendChild(hiddenInputApartmentSlug);

                                    const hiddenInputSponsorshipId = document.createElement('input');
                                    hiddenInputSponsorshipId.setAttribute('type', 'hidden');
                                    hiddenInputSponsorshipId.setAttribute('name', 'sponsorship_id');
                                    hiddenInputSponsorshipId.setAttribute('value', cardData.id);
                                    form.appendChild(hiddenInputSponsorshipId);

                                    form.submit();
                                });
                            });
                        }
                    });
                })
                .catch(error => {
                    console.error('Error fetching token:', error);
                });
            prepaymentBtn.classList.add('hidden');
            paymentBtn.classList.remove('hidden');
        }
    } else {
        console.error('One or more required elements are missing.');
    }
});
