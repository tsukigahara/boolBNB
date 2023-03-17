<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
// import route from 'vendor/tightenco/ziggy/src/js';

const props = defineProps({
    sponsorship: Array,
    id: String,
    endDate: String
});

const form = useForm({
    id: props.id,
    sponsorship: '',
    endDate: props.endDate ? props.endDate : null,
});

const submit = () => {
    form.post(route('dashbord.apartment.sponsorship.store'), {
        onFinish: () => form.reset(),
    });
};

const dataOfEndDate = props.endDate.split('T');
// const hourOfEndDatre = dataOfEndDate[1].split('.');


</script>

<script>


import { client, hostedFields, paypalCheckout } from 'braintree-web';
// import paypal from 'paypal-checkout';

const today = new Date();
const currentMonth = today.getMonth() + 1 < 10 ? "0" + (today.getMonth() + 1) : today.getMonth() + 1;
const currentYear = today.getFullYear();

const AUTH_KEY = "sandbox_x6d92nj4_dxm5bvfqp4vgjgxf";

export default {

    data() {
        return {
            amount: '',
            nonce: "",
            hostedFieldsInstance: false,
            error: ""
        }
    },
    computed: {
        preventPaying() {
            return !this.hostedFieldsInstance || isNaN(this.amount) || parseFloat(this.amount) <= 0 || !this.amount;
        }
    },
    methods: {
        pay() {
            if (!this.preventPaying) {
                this.error = "";
                this.nonce = "";

                let amount = parseFloat(this.amount);
                this.hostedFieldsInstance.tokenize()
                    .then(payload => {
                        console.log(payload);
                        this.nonce = payload.nonce;
                    })
                    .catch(err => {
                        console.error(err);
                        if (typeof err.message !== 'undefined') {
                            this.error = err.message;
                        }
                        else {
                            this.error = "An error occurred while processing the payment.";
                        }
                    })
            }
        },
        priceGet(value) {
            this.amount = value
        },
        initBraintree() {
            client.create({
                authorization: AUTH_KEY
            })
                .then(clientInstance => {
                    let options = {
                        client: clientInstance,
                        styles: {
                            input: {
                                'font-size': '14px',
                                'font-family': 'Open Sans'
                            }
                        },
                        fields: {
                            number: {
                                selector: '#creditCardNumber',
                                placeholder: 'Enter Credit Card'
                            },
                            cvv: {
                                selector: '#cvv',
                                placeholder: 'Enter CVV'
                            },
                            expirationDate: {
                                selector: '#expireDate',
                                placeholder: currentMonth + ' / ' + currentYear
                            }
                        }
                    }


                    let promises = [];
                    promises.push(hostedFields.create(options));
                    // promises.push(paypalCheckout.create({ client: clientInstance }));

                    return Promise.all(promises);
                })
                .then(instances => {
                    this.hostedFieldsInstance = instances[0];
                    //     const paypalInstance = instances[1];

                    //     return paypal.Button.render({
                    //         env: 'sandbox',
                    //         style: {
                    //             label: 'paypal',
                    //             size: 'responsive',
                    //             shape: 'rect'
                    //         },
                    //         payment: () => {
                    //             return paypalInstance.createPayment({
                    //                 flow: 'checkout',
                    //                 intent: 'sale',
                    //                 amount: this.amount ? this.amount : 10,
                    //                 displayName: 'Braintree Testing',
                    //                 currency: 'USD'
                    //             })
                    //         },
                    //         onAuthorize: (data, options) => {
                    //             return paypalInstance.tokenizePayment(options).then(payload => {
                    //                 console.log(payload);
                    //                 this.error = "";
                    //                 this.nonce = payload.nonce;
                    //             })
                    //         },
                    //         onCancel: (data) => {
                    //             console.log(data);
                    //             console.log("Payment Cancelled");
                    //         },
                    //         onError: (err) => {
                    //             console.error(err);
                    //             this.error = "An error occurred while processing the paypal payment.";
                    //         }
                    //     }, '#paypalButton')

                })
                .catch(err => {
                    console.error(err);
                    this.error = "An error occurred while creating the payment form.";
                })
        }
    },
    mounted() {
        this.initBraintree();

    }
}
</script>

<template>
    <Head title="Sponsorship" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sponsorship</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 shadow bg-body rounded">
                <a class="btn btn-dark mb-3 mr-3" role="button" href="javascript: history.back()">Go back</a>
                <div class="col-6 offset-3">
            <div class="card bg-light" >
                {{ endDate }}
                <div >La data di scadenza é prevista per il {{ dataOfEndDate[0] }} {{ dataOfEndDate[1] }}</div>
                <div class="card-header">Informazioni di Pagamento</div>
                <div class="card-body">
                    <div class="alert alert-danger" v-if="error">
                        {{ error }}
                    </div>
                    <div class="alert alert-success" v-if="nonce">
                        Il pagamento &egrave; andato a buon fine!
                    </div>
                <form action="/"  v-else >

                    <!-- SPONSORSHIP LIST -->
                    <table class="table">
                        <thead>
                            <tr class="table-dark">
                                <th scope="col"></th>
                                <th scope="col">Nome Abbonamento</th>
                                <th scope="col">Prezzo</th>
                                <th scope="col">Durata</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in sponsorship" :key="index">
                                <th scope="row">
                                    <input type="radio" name="sposnorship" :value="item.id" v-model="form.sponsorship" @click="priceGet(item.price)">
                                </th>

                                <td>
                                    <label :for="item.name">
                                        {{ item.name }}
                                    </label>
                                </td>
                                <td>{{ item.price }} &euro;</td>
                                <td>{{ item.duration }} ore</td>
                            </tr>

                        </tbody>
                    </table>
 

                        <div class="form-group">

                           
                            <div >Prezzo: {{ amount }} &euro;</div>
                        </div>
                        <hr />
                        <div class="form-group">
                            <label>Numero Carta di credito</label>
                            <div id="creditCardNumber" class="form-control"></div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label>Data di scadenza</label>
                                    <div id="expireDate" class="form-control"></div>
                                </div>
                                <div class="col-6">
                                    <label>CVV</label>
                                    <div id="cvv" class="form-control"></div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary btn-block mt-3" @click.prevent="pay" :disabled="preventPaying">Paga con carta di credito</button>
                        </div>
        
                    </form>
                    <button type="submit" class="btn btn-primary" @click="submit" v-if="nonce">Attiva abbonamento</button>
                </div>
            </div>
        </div>
    </div>
               
            </div>

    </AuthenticatedLayout>
</template>
<style>
.form-control{
    height: 3rem;
}
</style>