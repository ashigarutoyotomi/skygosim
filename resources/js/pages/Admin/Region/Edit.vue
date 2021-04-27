<template>
    <div id="regions-edit">
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
        </template>
    </div>
</template>

<script>
    export default {
        name: "RegionsEdit",

        components: {

        },

        props: {
            regionId: {
                type: String,
                default: () => null
            }
        },

        data() {
            return {
                form: {
                    name: '',
                    tag: '',
                },
                errors: {},
                loading: false,
            }
        },

        created() {
            this.loadData();
        },

        methods: {
            loadData() {
                this.loading = true;

                axios.get(`/regions/${this.regionId}/edit`)
                    .then(res => {
                        this.form = res.data;
                        this.loading = false;
                    })
                    .catch(e => {
                        this.loading = false;
                    });
            },

            submit() {
                let formData = new FormData();

                for ( let key in this.form ) {
                    formData.append(key, this.form[key]);
                }

                axios.post(`/regions/${this.regionId}/update`, formData)
                    .then(res => {
                        if (res) {
                            this.$router.push('/regions');
                            this.$root.$emit('regions.load');
                        }
                    })
                    .catch(e => {
                        this.errors = e.response.data.errors;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
