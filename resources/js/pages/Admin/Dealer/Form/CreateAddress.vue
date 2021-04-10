<template>
    <div id="dealers-create-address">
        <div class="section bg-white shadow-sm rounded-lg py-4 px-4">
            <div class="row">
                <div class="col-12 mb-4">
                    <h5>Create dealer address</h5>
                </div>
                <div class="col-12">
                    <form autocomplete="off" @submit.prevent="submit">
                        <div class="mb-3">
                            <label for="state">State</label>
                            <input
                                type="text"
                                class="form-control"
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
                            <label for="city">City</label>
                            <input
                                type="text"
                                class="form-control"
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
                            <label for="street">Street</label>
                            <input
                                type="text"
                                class="form-control"
                                :class="{'is-invalid': errors.street}"
                                id="street"
                                v-model="form.street"
                            >
                            <div
                                v-if="errors.street"
                                class="invalid-feedback"
                            >
                                {{ errors.street[0] }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="zip_code">ZIP Code</label>
                            <input
                                type="text"
                                class="form-control"
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

                        <template v-if="!loading">
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </template>

                        <template v-if="loading">
                            <button
                                type="button"
                                class="btn btn-primary"
                                disabled
                            >
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Saving...
                            </button>
                        </template>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "DealerCreateAddress",

        props: {
            userId: {
                type: String,
                default: () => null,
            }
        },

        data() {
            return {
                form: {
                    user_id: null,
                    street: '',
                    state: '',
                    city: '',
                    zip_code: '',
                },

                errors: {},
                loading: false,
            }
        },

        methods: {
            submit() {
                this.loading = true;
                let formData = new FormData();

                this.form.user_id = this.userId;
                for ( let key in this.form ) {
                    formData.append(key, this.form[key]);
                }

                axios.post('/dealers/address/create', formData)
                    .then(res => {
                        this.loading = false;

                        if (res) {
                            this.$toast.open({
                                message: 'Dealer address successfully created',
                                type: 'success',
                                position: 'bottom-left'
                            });

                            this.$root.$emit('dealer.load');

                            this.$router.push(`/dealers/${this.userId}/show`);
                        }
                    })
                    .catch(e => {
                        this.loading = false;

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
        }
    }
</script>

<style lang="scss">

</style>
