document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('payment-form');

    if (form) {
        axios.get('{$apartment->slug}/payment/token')
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

                    form.addEventListener('submit', function (event) {
                        event.preventDefault();

                        const sponsorshipId = document.querySelector('input[name="sponsorship_id"]:checked');
                        if (!sponsorshipId) {
                            alert('Seleziona una sponsorizzazione');
                            return;
                        }

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

                            const hiddenInputSponsorshipId = document.createElement('input');
                            hiddenInputSponsorshipId.setAttribute('type', 'hidden');
                            hiddenInputSponsorshipId.setAttribute('name', 'sponsorship_id');
                            hiddenInputSponsorshipId.setAttribute('value', sponsorshipId.value);
                            form.appendChild(hiddenInputSponsorshipId);

                            form.submit();
                        });
                    });
                });
            })
            .catch(error => {
                console.error('Error fetching token:', error);
            });
    }
});
