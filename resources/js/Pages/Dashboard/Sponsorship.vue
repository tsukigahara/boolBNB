<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { store } from '@/store';
import { Head, useForm } from '@inertiajs/vue3';
const props = defineProps({
    sponsorship: Array,
    id: String,
    date: Object,
    sponsorshipBool: Boolean
});
const form = useForm({
    id: props.id,
    sponsorship: '',
});
const storeSponsorship = () => {

    form.post(route('dashbord.apartment.sponsorship.store'), {
        onFinish: () => form.reset(),
    });



};
</script>

<script>
export default {

    data() {
        return {
            instance: null,
            paymentMethod: null,
            showPayment: false,
            payment: null,
            paymentShow: true
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
                this.paymentShow = false;
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
        showPAy() {

            this.showPayment = true

        }

    },
    mounted() {
        this.createDropIn();
        console.log(this.id);
    },
}
</script>

<template>
    <Head title="Sponsorship" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sponsorship</h2>
        </template>
        
        <div >
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 shadow bg-body rounded">
                    <a class="btn btn-dark mb-3 mr-3" role="button" href="javascript: history.back()">Go back</a>
                    <div v-if="!sponsorshipBool">
                        <h3>L'abbonamento {{ sponsorship.name }} per questo appartamento &egrave; gi&aacute; attivo</h3>
                    </div>
                    <form action="/" @submit.prevent="submit" v-else >
                        <div v-if="paymentShow">

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
                                            <input type="radio" name="sposnorship" :checked="index == 0" :value="item.id" v-model="form.sponsorship">
                                        </th>
                                        
                                        <td>
                                            <label :for="item.name">
                                                {{ item.name }}
                                            </label>
                                        </td>
                                        <td>{{ item.price }} &euro;</td>
                                        <td>{{ item.duration }}</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>

                            <div v-else>

                                <h1>Il pagamento é andato a buon fine, concludi l'operazione </h1>
                                <button type="submit" class="btn btn-primary" @click="storeSponsorship()">Concludi</button>
                            </div>
                    </form>
                    <button class="btn btn-primary"  v-if="paymentShow" @click="showPAy">Add</button>
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 shadow bg-body rounded" v-show="showPayment" v-if="paymentShow">
                        <div id="dropin-container">
                        </div>
                        <button class="btn btn-primary" @click="requestPaymentMethod">Paga</button>
                        <!-- <button @click="verifyPaymentMethod">Verifica metodo di pagamento</button> -->
                    </div>
                        
                        
                </div>
            </div>

        </div>
    </AuthenticatedLayout>
</template>
