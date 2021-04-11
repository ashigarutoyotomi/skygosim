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
            <template v-for="(section) in sections">
                <section class="bg-white shadow-sm rounded-3 py-4 mb-4">
                    <div class="container-fluid">
                        <dl class="row">
                            <h6 class="mb-2">
                                <u><small>
                                    {{section.label}}
                                </small></u>
                            </h6>

                            <template v-for="item in data[section.tag]">
                                <dt class="col-sm-4">
                                    {{ item.title }}
                                </dt>
                                <dd class="col-sm-8 d-flex">
                                    {{ item.value }}
                                </dd>
                            </template>
                        </dl>

                        <div class="row">
                            <div class="col-1">
                                <button
                                    type="button"
                                    class="btn btn-outline-info btn-sm"
                                >
                                    Edit
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
            </template>
        </template>
    </div>
</template>

<script>
    import { SECTIONS, SETTING_TYPES } from "./constants";

    export default {
        name: "SettingsIndex",

        data() {
            return {
                data: null,
                loading: false,
                sections: SECTIONS,
                settingTypes: SETTING_TYPES,
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
