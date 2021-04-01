<template>
    <div
        class="modal fade"
        :id="modalId"
        tabindex="-1"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="custom-file">
                            <input
                                type="file"
                                class="custom-file-input"
                                :class="{'is-invalid': errors.file}"
                                ref="fileInput"
                                id="fileInput"
                                @change="handlePackagesFileUpload()"
                            >
                            <label class="custom-file-label" for="fileInput">
                                {{ this.form.file ? 'File selected' : 'Choose file' }}
                            </label>
                            <div
                                v-if="errors.file"
                                class="invalid-feedback"
                            >
                                {{ errors.file[0] }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <template v-if="!loading">
                        <button
                            type="button"
                            class="btn btn-light"
                            data-dismiss="modal"
                        >
                            Cancel
                        </button>
                        <button
                            type="button"
                            class="btn btn-success"
                            @click="uploadPackages"
                        >
                            Upload
                        </button>
                    </template>
                    <template v-if="loading">
                        <button
                            type="button"
                            class="btn btn-success"
                            disabled
                        >
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Uploading...
                        </button>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UploadSimCardsModal",

        props: {
            modalId: {
                type: String,
                required: true
            }
        },

        data() {
            return {
                form: {
                    file: null
                },

                loading: false,
                errors: {}
            }
        },

        methods: {
            closeModal() {
                $(`#${this.modalId}`).modal('hide');
            },

            handlePackagesFileUpload() {
                this.form.file = this.$refs.fileInput.files[0];
            },

            uploadPackages() {
                this.loading = true;
                const formData = new FormData();
                formData.append('file', this.form.file);

                axios.post('/sim-cards/upload_sim_cards', formData)
                    .then(({data}) => {
                        this.loading = false;
                        this.$root.$emit('sim-cards.load');
                        this.closeModal();
                    })
                    .catch(e => {
                        this.loading = false;
                        this.errors = e.response.data.errors
                    });
            }
        }
    }
</script>

<style scoped>

</style>
