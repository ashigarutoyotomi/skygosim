<template>
    <app-layout>
        <header-slider />

        <internet-packages />
    </app-layout>
</template>

<script>
    import AppLayout from "../../layouts/AppLayout";
    import HeaderSlider from "./modules/HeaderSlider";
    import InternetPackages from "./modules/InternetPackages";

    export default {
        name: "HomeIndex",

        components: {
            AppLayout,
            HeaderSlider,
            InternetPackages,
        }
    }
</script>

<style>

</style>
