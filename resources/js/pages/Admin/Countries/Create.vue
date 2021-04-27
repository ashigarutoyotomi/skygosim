<template>
    <div id="countries-create">
        <div class="section bg-white shadow-sm rounded-lg py-4 px-4">
            <div class="row">
                <div class="col-12">
                    <form autocomplete="off" @submit.prevent="submit">
                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <v-select
                                id="country"
                                :class="{'is-invalid': errors.region_id}"
                                :options="regions"
                                label="name"
                                :reduce="region => region.id"
                                v-model="form.region_id"
                            ></v-select>

                            <div
                                v-if="errors.region_id"
                                class="invalid-feedback"
                            >
                                {{ errors.region_id[0] }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="last_name">Name</label>
                            <input
                                type="text"
                                class="form-control"
                                :class="{'is-invalid': errors.name}"
                                id="last_name"
                                v-model="form.name"
                            >
                            <div
                                v-if="errors.name"
                                class="invalid-feedback"
                            >
                                {{ errors.name[0] }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="first_name">Tag</label>
                            <input
                                type="text"
                                class="form-control"
                                :class="{'is-invalid': errors.tag}"
                                id="first_name"
                                v-model="form.tag"
                            >
                            <div
                                v-if="errors.tag"
                                class="invalid-feedback"
                            >
                                {{ errors.tag[0] }}
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CountriesCreate",

        data() {
            return {
                form: {
                    region_id: null,
                    name: '',
                    tag: '',
                },
                regions: [],
                errors: {}
            }
        },

        created() {
            this.loadRegions();
        },

        methods: {
            submit() {
                let formData = new FormData();

                for ( let key in this.form ) {
                    formData.append(key, this.form[key]);
                }

                axios.post('/countries/store', formData)
                    .then(res => {
                        if (res) {
                            this.$router.push('/countries');
                            this.$root.$emit('countries.load');
                        }
                    })
                    .catch(e => {
                        this.errors = e.response.data.errors;
                    });
            },

            loadRegions() {
                axios.get('/regions/all')
                    .then(res => {
                        this.regions = res.data;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
