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
            <section class="bg-white shadow-sm rounded-3 py-4 mb-4">
                <div class="container-fluid">
                    <dl class="row">
                        <h6 class="mb-2">
                            <u><small>
                                Main
                            </small></u>
                        </h6>

                        <dt class="col-sm-4">
                            Coming soon
                        </dt>
                    </dl>
                </div>
            </section>
        </template>
    </div>
</template>

<script>
import {SETTING_SECTIONS, SETTINGS} from "./constants";

    export default {
        name: "SettingsIndex",

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
