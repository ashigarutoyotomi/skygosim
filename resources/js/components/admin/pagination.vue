<template>
    <nav class="row">
        <ul class="pagination pagination-sm justify-content-end">
            <template v-if="data.prev_page_url">
                <li
                    class="page-item"
                >
                    <a
                        class="page-link"
                        aria-label="Previous"
                        @click="changePageTo(data.current_page - 1)"
                    >
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            </template>
            <template v-if="!data.prev_page_url">
                <li
                    class="page-item disabled"
                >
                    <a
                        class="page-link"
                        aria-label="Previous"
                        aria-disabled="true"
                    >
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            </template>

            <template v-for="page in data.last_page">
                <li
                    v-if="page >= (data.current_page - 3)
                        && (page <= (data.current_page + 3) && page <= data.last_page)"
                    class="page-item"
                    :class="{'active' : page === data.current_page}"
                >
                    <a
                        class="page-link"
                        @click="changePageTo(page)"
                    >
                        {{ page }}
                    </a>
                </li>
            </template>

            <template v-if="data.next_page_url">
                <li
                    class="page-item"
                >
                    <a
                        class="page-link"
                        aria-label="Next"
                        @click="changePageTo(data.current_page + 1)"
                    >
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </template>
            <template v-if="!data.next_page_url">
                <li
                    class="page-item disabled"
                >
                    <a
                        class="page-link"
                        aria-label="Next"
                        aria-disabled="true"
                    >
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </template>
        </ul>
    </nav>
</template>

<script>
    export default {
        name: "pagination",

        props: {
            data: {
                type: Object,
                required: true
            },

            loadEvent: {
                type: String,
                required: true
            }
        },

        methods: {
            changePageTo(page) {
                this.$root.$emit(this.loadEvent, {
                    params: {
                        page: page
                    }
                });
            },
        }
    }
</script>

<style lang="scss">

</style>
