<template>
    <div id="settings">
        <template v-if="loading">
            <div class="row">
                <div class="spinner-border mx-auto" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>
        </template>

        <template v-if="!loading">
            <template v-for="(item, section) in data">
                <section
                    v-if="section === 'main'"
                    class="bg-white shadow-sm rounded-3 py-4 mb-4"
                >
                    <div class="container-fluid">
                        <dl class="row">
                            <h6 class="mb-2">
                                <u><small>
                                    Main
                                </small></u>
                            </h6>

                            <template v-for="setting in item">
                                <dt class="col-sm-4 lead fs-6 fw-normal">
                                    {{ setting.title }}
                                </dt>
                                <dd class="col-sm-8 d-flex align-items-center">
                                    <input-toggle
                                        v-model="setting.value"
                                    />
                                </dd>
                            </template>
                        </dl>
                    </div>

                    <div class="container-fluid">
                        <button
                            v-if="!loading"
                            type="button"
                            class="btn btn-success btn-sm"
                            @click="save"
                        >
                            Save settings
                        </button>

                        <template v-if="loading">
                            <button
                                type="button"
                                class="btn btn-success btn-sm"
                                disabled
                            >
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Saving...
                            </button>
                        </template>
                    </div>
                </section>
            </template>
        </template>
    </div>
</template>

<script>
import InputToggle from "../../../components/forms/input-toggle";
import {SETTING_SECTIONS, SETTINGS} from "./constants";

    export default {
        name: "SettingsIndex",
        components: {InputToggle},


        data() {
            return {
                data: null,
                loading: false,
                sections: SETTING_SECTIONS,
                settings: SETTINGS,
            }
        },

        created() {
            this.loadData();
        },

        methods: {
            loadData() {
                this.loading = true;

                axios.get('/settings')
                    .then(res => {
                        this.data = res.data;
                        this.loading = false;
                    });
            },

            save() {
                let data = [];
                for (let key in this.data) {
                    this.data[key].forEach(setting => {
                        data.push(setting);
                    });
                }

                axios.post('/settings/update', data)
                    .then(res => {
                        console.log(res.data);
                    });
            }
        }
    }
</script>

<style lang="scss">
    #settings {
        dt {
            font-weight: normal;
        }
    }
</style>
