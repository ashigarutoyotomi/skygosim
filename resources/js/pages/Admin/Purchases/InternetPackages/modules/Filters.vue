<template>
    <div class="filters">
        <div class="filters-bg"
             @click="close"
        ></div>

        <div class="filters__container">
            <div class="filters__title">
                <h5>Filters</h5>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PurchasesInternetPackagesFilters",

        methods: {
            close() {
                this.$emit('close');
            }
        }
    }
</script>

<style lang="scss">
    .filters {
        position: fixed;
        width: 100%;
        height: 100vh;
        z-index: 100;
        left: 0;
        top: 0;
        display: flex;
        justify-content: flex-end;

        &-bg {
            background: rgba(0,0,0,0.1);
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        &__container {
            position: relative;
            z-index: 1;
            background: #fff;
            height: 100%;
            width: 400px;
            padding: .7rem 1.5rem;
        }
    }
</style>
