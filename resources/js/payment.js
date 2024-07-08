document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('payment-form');
    const prepaymentBtn = document.getElementById('prepaymentBtn');
    const paymentBtn = document.getElementById('paymentBtn');
    const dropinContainer = document.getElementById('dropin-container');
    const cartContainer = document.getElementById('cartContainer');
    const totalPriceElement = document.getElementById('totalPrice');

    prepaymentBtn.addEventListener('click', function () {
        const cartItems = cartContainer.querySelectorAll('.cartElements');
        const totalPrice = parseFloat(totalPriceElement.textContent);
        if (cartItems.length === 0) {
            alert('Il carrello è vuoto. Aggiungi almeno un elemento prima di procedere al pagamento.');
            return;
        }
        // Esegui la richiesta per ottenere il token di Braintree
        else {
            dropinContainer.classList.remove('hidden');
            if (!dropinContainer.classList.contains('hidden')) {
                axios.get('{{ $apartment->slug }}/payment/token')
                    .then(response => {
                        const data = response.data;
                        braintree.dropin.create({
                            authorization: data.token,
                            container: '#dropin-container'
                        }, function (err, dropinInstance) {
                            if (err) {
                                console.error(err);
                                return;
                            }

                            // Mostra il container del Drop-in UI
                            else {

                                // Event listener per l'invio del form
                                form.addEventListener('submit', function (event) {
                                    event.preventDefault();

                                    // Verifica se il carrello è popolato
                                    if (cartItems.length === 0) {
                                        alert('Il carrello è vuoto. Aggiungi almeno un elemento prima di procedere al pagamento.');
                                        return;
                                    }
                                    else {
                                        dropinInstance.requestPaymentMethod(function (err, payload) {
                                            if (err) {
                                                console.error(err);
                                                return;
                                            }

                                            // Aggiungi i dati del pagamento al form
                                            const hiddenInputNonce = document.createElement('input');
                                            hiddenInputNonce.setAttribute('type', 'hidden');
                                            hiddenInputNonce.setAttribute('name', 'payment_method_nonce');
                                            hiddenInputNonce.setAttribute('value', payload.nonce);
                                            form.appendChild(hiddenInputNonce);

                                            const hiddenInputSponsorshipId = document.createElement('input');
                                            hiddenInputSponsorshipId.setAttribute('type', 'hidden');
                                            hiddenInputSponsorshipId.setAttribute('name', 'sponsorship_id');
                                            hiddenInputSponsorshipId.setAttribute('value', '{{$sponsorship->id}}');
                                            form.appendChild(hiddenInputSponsorshipId);

                                            const hiddenInputTotalPrice = document.createElement('input');
                                            hiddenInputTotalPrice.setAttribute('type', 'hidden');
                                            hiddenInputTotalPrice.setAttribute('name', 'total_price');
                                            hiddenInputTotalPrice.setAttribute('value', totalPrice);
                                            form.appendChild(hiddenInputTotalPrice);

                                            // Invia il form
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
        }
    });
});