<template>
    <div id="internet-package-purchase-checkout">
        <template v-if="loading">
            <div class="row">
                <div class="spinner-border mx-auto" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>
        </template>

        <template v-if="!loading">
            <div class="bg-white shadow-sm rounded-3 py-4 px-4">
                <div class="row">
                    <div class="col-12">
                        <h6 class="text-muted">Checkout internet packages</h6>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <table class="table table-sm bg-light rounded-3">
                            <tbody>
                                <tr>
                                    <td>Packages count:</td>
                                    <td>{{ data.internetPackagesCount }}</td>
                                </tr>
                                <tr>
                                    <td>Total price:</td>
                                    <td>{{ data.totalPrice }} $</td>
                                </tr>
                                <tr>
                                    <td>Dealer discount:</td>
                                    <td>{{ data.dealerDiscount }} %</td>
                                </tr>
                                <tr>
                                    <td>Price with discount:</td>
                                    <td>{{ data.discountPrice }} $</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <h6 class="text-muted">Payment info</h6>
                    </div>

                    <div class="col-12">
                        <form autocomplete="off" @submit.prevent="processPayment">
                            <div class="mb-3">
                                <label class="fw-bold text-black-50" for="first_name">First Name</label>
                                <input
                                    type="text"
                                    class="form-control form-control-sm"
                                    :class="{'is-invalid': errors.first_name}"
                                    id="first_name"
                                    v-model="form.first_name"
                                >
                                <div
                                    v-if="errors.first_name"
                                    class="invalid-feedback"
                                >
                                    {{ errors.first_name[0] }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="fw-bold text-black-50" for="last_name">Last Name</label>
                                <input
                                    type="text"
                                    class="form-control form-control-sm"
                                    :class="{'is-invalid': errors.last_name}"
                                    id="last_name"
                                    v-model="form.last_name"
                                >
                                <div
                                    v-if="errors.last_name"
                                    class="invalid-feedback"
                                >
                                    {{ errors.last_name[0] }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="fw-bold text-black-50" for="email">Email</label>
                                <input
                                    type="email"
                                    class="form-control form-control-sm"
                                    :class="{'is-invalid': errors.email}"
                                    id="email"
                                    v-model="form.email"
                                >
                                <div
                                    v-if="errors.email"
                                    class="invalid-feedback"
                                >
                                    {{ errors.email[0] }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="fw-bold text-black-50" for="street_address">Street Address</label>
                                <input
                                    type="text"
                                    class="form-control form-control-sm"
                                    :class="{'is-invalid': errors.street_address}"
                                    id="street_address"
                                    v-model="form.street_address"
                                >
                                <div
                                    v-if="errors.street_address"
                                    class="invalid-feedback"
                                >
                                    {{ errors.street_address[0] }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="fw-bold text-black-50" for="city">City</label>
                                <input
                                    type="text"
                                    class="form-control form-control-sm"
                                    :class="{'is-invalid': errors.city}"
                                    id="city"
                                    v-model="form.city"
                                >
                                <div
                                    v-if="errors.city"
                                    class="invalid-feedback"
                                >
                                    {{ errors.city[0] }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="fw-bold text-black-50" for="state">State</label>
                                <input
                                    type="text"
                                    class="form-control form-control-sm"
                                    :class="{'is-invalid': errors.state}"
                                    id="state"
                                    v-model="form.state"
                                >
                                <div
                                    v-if="errors.state"
                                    class="invalid-feedback"
                                >
                                    {{ errors.state[0] }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="fw-bold text-black-50" for="zip_code">ZIP Code</label>
                                <input
                                    type="text"
                                    class="form-control form-control-sm"
                                    :class="{'is-invalid': errors.zip_code}"
                                    id="zip_code"
                                    v-model="form.zip_code"
                                >
                                <div
                                    v-if="errors.zip_code"
                                    class="invalid-feedback"
                                >
                                    {{ errors.zip_code[0] }}
                                </div>
                            </div>

                            <div class="md-3">
                                <label class="fw-bold text-black-50">Card Information</label>
                                <div id="checkout-card-element"></div>

                                <div
                                    v-if="stripeCardError.message"
                                    class="invalid-feedback d-block"
                                >
                                    {{ stripeCardError.message }}
                                </div>
                            </div>

                            <div class="mt-3">
                                <button
                                    v-if="!buttonsLoading"
                                    type="submit"
                                    class="btn btn-success btn-sm"
                                >
                                    Checkout
                                </button>
                                <button
                                    v-if="buttonsLoading"
                                    type="button"
                                    class="btn btn-success btn-sm"
                                    disabled
                                >
                                    Checkouting...
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    import {loadStripe} from "@stripe/stripe-js";

    export default {
        name: "InternetPackagePurchaseCheckout",

        data() {
            return {
                stripe: {},
                cardElement: {},
                data: {
                    internetPackagesCount: 0,
                    totalPrice: 0,
                    dealerDiscount: 0,
                    discountPrice: 0,
                },
                stripeKey: process.env.MIX_STRIPE_KEY,
                form: {
                    payment_method_id: null,
                    amount: 0,
                    cart: '',
                    first_name: '',
                    last_name: '',
                    state: '',
                    street_address: '',
                    city: '',
                    email_address: '',
                    zip_code: '',
                    order_id: null,
                },
                errors: {},
                stripeCardError: {},
                loading: false,
                buttonsLoading: false,
            }
        },

        created() {
            this.loadData();
        },

        computed: {
            ...mapGetters({
                user: 'getUser'
            }),
        },

        methods: {
            loadData() {
                this.loading = true;

                axios.get(`/dealers/${this.user.id}/cart/internet-packages`)
                    .then(({data}) => {
                        this.form.cart = data.cart;

                        data.cart.forEach(item => {
                            this.data.totalPrice += item.price;
                        });

                        this.data.internetPackagesCount = data.cart.length;
                        this.data.dealerDiscount = data.dealerDiscount;

                        let percentPrice = (this.data.totalPrice * this.data.dealerDiscount) / 100;
                        this.data.discountPrice = Math.round((this.data.totalPrice - percentPrice) * 100) / 100;

                        this.loading = false;

                        Vue.nextTick(() => {
                            this.initStripe();
                        });
                    });
            },

            async processPayment() {
                this.buttonsLoading = true;
                const {paymentMethod, error} = await this.stripe.createPaymentMethod(
                    'card', this.cardElement, {
                        billing_details: {
                            name: this.form.first_name + ' ' + this.form.last_name,
                            email: this.form.email,
                            address: {
                                line1: this.form.street_address,
                                city: this.form.city,
                                state: this.form.state,
                                postal_code: this.form.zip_code,
                            }
                        }
                    }
                );

                if (error) {
                    this.stripeCardError = error;
                    this.buttonsLoading = false;
                } else {
                    this.form.payment_method_id = paymentMethod.id;
                    this.form.amount = this.data.discountPrice;

                    axios.post('/internet-packages/purchase-packages', this.form)
                        .then(response => {
                            if (response) {
                                this.buttonsLoading = false;

                                this.$toast.open({
                                    message: 'Packages successfully activated',
                                    type: 'success',
                                    position: 'bottom-left'
                                });

                                this.$router.push({name: 'home'})
                            }
                        })
                        .catch(e => {
                            this.buttonsLoading = false;

                            if (e.response) {
                                if (e.response.status === 422) {
                                    this.errors = e.response.data.errors;
                                } else {
                                    this.$toast.open({
                                        message: e.response.data.message,
                                        type: 'error',
                                        position: 'bottom-left'
                                    });
                                }
                            }
                        });
                }
            },

            initStripe() {
                this.stripeLoading = true;

                loadStripe(this.stripeKey)
                    .then(response => {
                        this.stripe = response;
                        const elements = this.stripe.elements();

                        this.cardElement = elements.create('card', {
                            classes: {
                                base: 'form-control form-control-sm',
                            }
                        });

                        this.cardElement.mount('#checkout-card-element');

                        Vue.nextTick(() => {
                            this.stripeLoading = false;
                        });
                    });
            },
        }
    }
</script>

<style lang="scss">
    #internet-package-purchase-checkout {
        label {
            font-size: .8rem;
        }
    }
</style>
