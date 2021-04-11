<template>
    <modal
        :name="modalId"
        height="auto"
        :shiftY="0.1"
    >
        <div class="container p-4">
            <div class="row mb-4">
                <div class="col-11">
                    <h5 class="modal-title">Upload physical SIMs</h5>
                </div>
                <div class="col-1">
                    <button type="button" class="btn-close" @click="closeModal()"></button>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <label for="fileInput" class="form-label">Select physical SIMs file</label>
                    <input
                        class="form-control form-control-sm"
                        :class="{'is-invalid': errors.file}"
                        ref="fileInput"
                        id="fileInput"
                        @change="handlePackagesFileUpload()"
                        type="file"
                    >
                    <div
                        v-if="errors.file"
                        class="invalid-feedback"
                    >
                        {{ errors.file[0] }}
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-4">
                    <template v-if="!loading">
                        <button
                            type="button"
                            class="btn btn-light"
                            @click="closeModal()"
                        >
                            Cancel
                        </button>
                        <button
                            type="button"
                            class="btn btn-success"
                            @click="save"
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
    </modal>
</template>

<script>
    export default {
        name: "UploadPhysicalSimsModal",

        data() {
            return {
                modalId: 'UploadPhysicalSimsModal',
                form: {
                    file: null
                },
                loading: false,
                errors: {}
            }
        },

        created() {
            this.$root.$on('modal::show::' + this.modalId, this.showModal);
        },

        beforeDestroy() {
            this.$root.$off('modal::show::' + this.modalId, this.showModal);
        },

        methods: {
            showModal(){
                this.$modal.show(this.modalId);
            },

            closeModal() {
                this.$modal.hide(this.modalId);
            },

            handlePackagesFileUpload() {
                this.form.file = this.$refs.fileInput.files[0];
            },

            save() {
                this.loading = true;
                const formData = new FormData();
                formData.append('file', this.form.file);

                axios.post('/sims/upload-file', formData)
                    .then(({data}) => {
                        this.loading = false;

                        this.$root.$emit('inventory-physical-sims.load');

                        this.$toast.open({
                            message: 'Physical SIMs uploaded',
                            type: 'success',
                            position: 'bottom-left'
                        });

                        this.closeModal();
                    })
                    .catch(e => {
                        this.loading = false;

                        if (e.response ) {
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

<style scoped>

</style>
