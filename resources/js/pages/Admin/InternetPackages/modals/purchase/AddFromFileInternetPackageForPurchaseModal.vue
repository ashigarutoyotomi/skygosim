<template>
    <modal
        :name="modalId"
        height="auto"
        :shiftY="0.1"
    >
        <div class="container p-4">
            <div class="row mb-4">
                <div class="col-11">
                    <h5 class="modal-title">Upload internet packages</h5>
                </div>
                <div class="col-1">
                    <button type="button" class="btn-close" @click="closeModal()"></button>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <label for="fileInput" class="form-label">Select internet packages file</label>
                    <input
                        class="form-control form-control-sm"
                        :class="{'is-invalid': errors.file}"
                        ref="fileInput"
                        id="fileInput"
                        @change="handlePackagesFileUpload()"
                        type="file"
                        accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                    >
                    <div
                        v-if="errors.file"
                        class="invalid-feedback"
                    >
                        {{ errors.file[0] }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-end">
                        <template v-if="!loading">
                            <button
                                type="button"
                                class="btn btn-light btn-sm"
                                @click="closeModal()"
                            >
                                Cancel
                            </button>
                            <button
                                type="button"
                                class="btn btn-success btn-sm ms-2"
                                @click="addInternetPackages"
                            >
                                Upload
                            </button>
                        </template>
                        <template v-if="loading">
                            <button
                                type="button"
                                class="btn btn-success btn-sm"
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
    </modal>
</template>

<script>
    import readXlsxFile from 'read-excel-file';

    export default {
        name: "AddFromFileInternetPackageForPurchaseModal",

        data() {
            return {
                modalId: 'AddFromFileInternetPackageForPurchaseModal',
                form: {
                    file: null
                },
                data: [],

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
                readXlsxFile(this.form.file).then(rows => {
                    rows.forEach((row, key) => {
                        if (key > 0) {
                            this.data.push({
                                iccid: row[0],
                                packageId: row[1],
                            });
                        }
                    });
                });
            },

            addInternetPackages() {
                this.$root.$emit('internet-packages-purchase.add-internet-packages', this.data);

                this.closeModal();
            }
        }
    }
</script>

<style lang="scss">

</style>
