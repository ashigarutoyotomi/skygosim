<template>
    <div id="pages-apns-edit">
        <template v-if="loading">
            <div class="row">
                <div class="spinner-border mx-auto" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>
        </template>

        <template
            v-if="!loading"
        >
            <div class="section bg-white shadow-sm rounded-lg py-4 px-4">
                <div class="row">
                    <div class="col-12">
                        <form autocomplete="off" @submit.prevent="submit">
                            <div class="mb-3">
                                <label for="country" class="form-label">Country</label>
                                <v-select
                                    id="country"
                                    :class="{'is-invalid': errors.country_id}"
                                    :options="countries"
                                    label="name"
                                    :reduce="country => country.id"
                                    v-model="form.country_id"
                                ></v-select>

                                <div
                                    v-if="errors.country_id"
                                    class="invalid-feedback"
                                >
                                    {{ errors.country_id[0] }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="operator">Operator</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    :class="{'is-invalid': errors.operator}"
                                    id="operator"
                                    v-model="form.operator"
                                >
                                <div
                                    v-if="errors.operator"
                                    class="invalid-feedback"
                                >
                                    {{ errors.operator[0] }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="apn">APN</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    :class="{'is-invalid': errors.apn}"
                                    id="apn"
                                    v-model="form.apn"
                                >
                                <div
                                    v-if="errors.apn"
                                    class="invalid-feedback"
                                >
                                    {{ errors.apn[0] }}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
    export default {
        name: "PagesApnEdit",

        props: {
            apnId: {
                type: String,
                default: () => null
            }
        },

        data() {
            return {
                form: {
                    country_id: null,
                    operator: '',
                    apn: '',
                },
                countries: [],
                errors: {},
                loading: false,
            }
        },

        created() {
            this.loadData();
            this.loadCountries();
        },

        methods: {
            loadData() {
                this.loading = true;

                axios.get(`/pages/apns/${this.apnId}/edit`)
                    .then(res => {
                        this.form = res.data;
                        this.loading = false;
                    })
                    .catch(e => {
                        console.log(e);
                        this.loading = false;
                    });
            },

            submit() {
                let formData = new FormData();

                for ( let key in this.form ) {
                    formData.append(key, this.form[key]);
                }

                axios.post(`/pages/apns/${this.apnId}/update`, formData)
                    .then(res => {
                        if (res) {
                            this.$router.push('/pages/apns');
                            this.$root.$emit('pages-apns.load');
                        }
                    })
                    .catch(e => {
                        this.errors = e.response.data.errors;
                    });
            },

            loadCountries() {
                axios.get('/countries/all')
                    .then(res => {
                        this.countries = res.data;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
