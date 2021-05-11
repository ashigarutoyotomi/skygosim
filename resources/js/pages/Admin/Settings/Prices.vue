<template>
    <div id="settings-prices">
        <template v-if="loading">
            <div class="row">
                <div class="spinner-border mx-auto" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>
        </template>

        <template v-if="!loading">
            <section class="bg-white shadow-sm rounded-3 py-4 mb-4">
                <div class="container-fluid">
                    <dl class="row">
                        <h6 class="mb-2">
                            <u><small>
                                {{ sections['prices'].label }}
                            </small></u>
                        </h6>

                        <template v-for="item in data">
                            <template v-if="editedSettingsIds.includes(item.id)">
                                <dt class="col-sm-4 lead">
                                    {{ settings[item.id].label }}
                                </dt>
                                <dd class="row col-sm-8">
                                    <div class="col-2">
                                        <input
                                            class="form-control form-control-sm"
                                            type="number"
                                            v-model="item.value"
                                        >
                                    </div>
                                    <div class="col-4">
                                        <button
                                            type="button"
                                            class="btn btn-success btn-sm"
                                            @click="save(item)"
                                        >
                                            Save
                                        </button>
                                    </div>
                                </dd>
                            </template>
                            <template v-else>
                                <dt class="col-sm-4 lead">
                                    {{ settings[item.id].label }}
                                </dt>
                                <dd class="col-sm-8 d-flex align-items-center">
                                <span>
                                    {{ item.value }}
                                </span>
                                    <button
                                        type="button"
                                        class="btn btn-link btn-sm"
                                        @click="addToEdit(item.id)"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </dd>
                            </template>
                        </template>
                    </dl>
                </div>
            </section>
        </template>
    </div>
</template>

<script>
    import {SETTING_SECTIONS, SETTINGS} from "./constants";

    export default {
        name: "SettingsPrices",

        data() {
            return {
                data: null,
                loading: false,
                sections: SETTING_SECTIONS,
                settings: SETTINGS,
                editedSettingsIds: [],
            }
        },

        created() {
            this.loadData();
        },

        methods: {
            loadData() {
                this.loading = true;

                axios.get('/settings/prices')
                    .then(res => {
                        this.data = res.data;
                        this.loading = false;
                    });
            },

            addToEdit(id) {
                if (!this.editedSettingsIds.includes(id)) {
                    this.editedSettingsIds.push(id);
                }
            },

            removeFromEdit(id) {
                if (this.editedSettingsIds.includes(id)) {
                    this.editedSettingsIds = this.editedSettingsIds.filter(settingId => settingId !== id);
                }
            },

            save(setting) {
                this.loading = true;
                let formData = new FormData();

                for ( let key in setting ) {
                    formData.append(key, setting[key]);
                }

                axios.post('/settings/prices/store', formData)
                    .then(res => {
                        this.loading = false;

                        if (res) {
                            this.$toast.open({
                                message: 'Settings saved successfully',
                                type: 'success',
                                position: 'bottom-left'
                            });

                            this.removeFromEdit(res.data.id);
                        }
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
