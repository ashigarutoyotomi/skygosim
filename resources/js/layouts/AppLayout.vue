<template>
    <div id="canvas">
        <div id="box_wrapper">
            <navbar />

            <slot></slot>

            <foot />
            <section class="page_copyright ds s-py-10 copyright-bg">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="divider-15 d-none d-lg-block"></div>
                        <div class="col-md-12 text-center">
                            <p>&copy; Copyright <span class="copyright_year">2019</span> All Rights Reserved</p>
                        </div>
                        <div class="divider-15 d-none d-lg-block"></div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
    import Navbar from "../components/Navbar";
    import Foot from "../components/Foot";

    export default {
        name: "AppLayout",

        components: {
            Navbar,
            Foot,
        }
    }
</script>

<style>

</style>
