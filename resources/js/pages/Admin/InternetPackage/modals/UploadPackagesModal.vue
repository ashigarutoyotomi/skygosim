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
                                ref="packagesFileInput"
                                id="packagesFileInput"
                                @change="handlePackagesFileUpload()"
                            >
                            <label class="custom-file-label" for="packagesFileInput">
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
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                    >
                        Cancel
                    </button>
                    <button
                        type="button"
                        class="btn btn-primary"
                        @click="uploadPackages"
                    >
                        Import
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UploadPackagesModal",

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

                errors: {}
            }
        },

        methods: {
            handlePackagesFileUpload() {
                this.form.file = this.$refs.packagesFileInput.files[0];
            },

            uploadPackages() {
                const formData = new FormData();
                formData.append('file', this.form.file);

                axios.post('/internet-packages/upload_packages', formData)
                    .then(({data}) => {
                        $(this.modalId).modal('hide');
                    })
                    .catch(e => {
                        this.errors = e.response.data.errors
                    });
            }
        }
    }
</script>

<style scoped>

</style>
