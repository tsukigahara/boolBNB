<script>
// import braintree from 'braintree-web';


export default {
    props: {

        clientToken: 'k33qkpjhfkmmgv6c',
    },
    data() {
        return {
            instance: null,
            paymentMethod: null,
        };
    },
    methods: {
        createDropIn() {
            braintree.dropin.create(
                {
                    authorization: 'sandbox_x6d92nj4_dxm5bvfqp4vgjgxf',
                    container: "#dropin-container",
                },
                (createErr, instance) => {
                    if (createErr) {
                        console.error(createErr);
                        return;
                    }

                    this.instance = instance;
                }
            );
        },
        requestPaymentMethod() {
            this.instance.requestPaymentMethod((err, payload) => {
                if (err) {
                    console.error(err);
                    return;
                }

                this.paymentMethod = payload.nonce;
            });
        },
        verifyPaymentMethod() {
            const response = this.$inertia.post("/payment-methods/verify", {
                paymentMethodNonce: this.paymentMethod,
            });

            if (response.success) {
                console.log("Il metodo di pagamento è stato verificato con successo");
            } else {
                console.error("La verifica del metodo di pagamento ha fallito");
            }
        },

    },
    mounted() {
        this.createDropIn();
    },
};
</script>

<template>
    <div>

        <div>
            <div id="dropin-container">
            </div>
            <button @click="requestPaymentMethod">Paga ad</button>
            <button @click="verifyPaymentMethod">Verifica metodo di pagamento</button>
        </div>

    </div>
</template>