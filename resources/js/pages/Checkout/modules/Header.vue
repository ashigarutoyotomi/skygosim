<template>
    <div class="header_absolute header_layout_1">
        <div id="particles-js"></div>

        <section class="page_title cs s-pt-60 s-pb-10 s-pt-lg-130 s-pb-lg-60 page_title text-center">
            <div class="container-fluid">
                <div class="row">
                    <div class="divider-60"></div>

                    <div class="col-md-12 text-center">
                        <h1>Checkout</h1>
                    </div>

                    <div class="divider-50"></div>
                </div>
            </div>
            <ol class="breadcrumb full-width">
                <li class="breadcrumb-item">
                    <router-link to="/">Home</router-link>
                </li>
                <li class="breadcrumb-item">
                    <router-link to="/internet">Internet</router-link>
                </li>
                <li class="breadcrumb-item active">
                    Checkout
                </li>
            </ol>
        </section>
    </div>
</template>

<script>
    export default {
        name: "CheckoutHeader"
    }
</script>

<style scoped>

</style>
