<template>
    <div id="regions-create">
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
    </div>
</template>

<script>
    export default {
        name: "RegionsCreate",

        data() {
            return {
                form: {
                    name: '',
                    tag: '',
                },
                errors: {}
            }
        },

        methods: {
            submit() {
                let formData = new FormData();

                for ( let key in this.form ) {
                    formData.append(key, this.form[key]);
                }

                axios.post('/regions/store', formData)
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
