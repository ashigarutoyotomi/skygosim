<template>
    <app-layout>
        <header-comp />

        <internet-packages />
    </app-layout>
</template>

<script>
    import AppLayout from "../../layouts/AppLayout";
    import HeaderComp from "./modules/Header";
    import InternetPackages from "./modules/InternetPackages";

    export default {
        name: "InternetIndex",

        components: {
            AppLayout,
            HeaderComp,
            InternetPackages,
        }
    }
</script>

<style scoped>

</style>
