document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('payment-form');
    const prepaymentBtn = document.getElementById('prepaymentBtn');
    const paymentBtn = document.getElementById('paymentBtn');
    const dropinContainer = document.getElementById('dropin-container');
    const cartContainer = document.getElementById('cartContainer');
    const totalPriceElement = document.getElementById('totalPrice');

    const apartmentId = document.getElementById('apartmentId') ? document.getElementById('apartmentId').value : null;
    const apartmentSlug = document.getElementById('apartmentSlug') ? document.getElementById('apartmentSlug').value : null;

    prepaymentBtn.addEventListener('click', function () {
        const cartItems = cartContainer.querySelectorAll('.cartElements');
        const totalPrice = parseFloat(totalPriceElement.textContent);
        if (cartItems.length === 0) {
            alert('Il carrello è vuoto. Aggiungi almeno un elemento prima di procedere al pagamento.');
            return;
        }

        if (apartmentId && apartmentSlug) {
            dropinContainer.classList.remove('hidden');
            if (!dropinContainer.classList.contains('hidden')) {
                axios.get(`${apartmentSlug}/payment/token`)
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
                                    if (cartItems.length === 0) {
                                        alert('Il carrello è vuoto. Aggiungi almeno un elemento prima di procedere al pagamento.');
                                        return;
                                    } else {
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

                                            cartItems.forEach(item => {
                                                const sponsorshipId = item.getAttribute('data-id');
                                                console.log('Sponsorship ID:', sponsorshipId);
                                                const quantity = parseInt(item.querySelector('.numberSinglePlanSelected').textContent.replace('x', ''));
                                                for (let i = 0; i < quantity; i++) {
                                                    sponsorshipIds.push(parseInt(sponsorshipId));
                                                }
                                            });
                                            console.log('Sponsorship IDs:', sponsorshipIds);

                                            const hiddenInputSponsorshipIds = document.createElement('input');
                                            hiddenInputSponsorshipIds.setAttribute('type', 'hidden');
                                            hiddenInputSponsorshipIds.setAttribute('name', 'sponsorship_ids');
                                            hiddenInputSponsorshipIds.setAttribute('value', JSON.stringify(sponsorshipIds));
                                            form.appendChild(hiddenInputSponsorshipIds);

                                            const hiddenInputTotalPrice = document.createElement('input');
                                            hiddenInputTotalPrice.setAttribute('type', 'hidden');
                                            hiddenInputTotalPrice.setAttribute('name', 'total_price');
                                            hiddenInputTotalPrice.setAttribute('value', totalPrice);
                                            form.appendChild(hiddenInputTotalPrice);

                                            const hiddenInputApartmentId = document.createElement('input');
                                            hiddenInputApartmentId.setAttribute('type', 'hidden');
                                            hiddenInputApartmentId.setAttribute('name', 'apartment_id');
                                            hiddenInputApartmentId.setAttribute('value', apartmentId);
                                            form.appendChild(hiddenInputApartmentId);

                                            const hiddenInputApartmentSlug = document.createElement('input');
                                            hiddenInputApartmentSlug.setAttribute('type', 'hidden');
                                            hiddenInputApartmentSlug.setAttribute('name', 'apartment_slug');
                                            hiddenInputApartmentSlug.setAttribute('value', apartmentSlug);
                                            form.appendChild(hiddenInputApartmentSlug);

                                            form.submit();
                                        });
                                    }
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
});
