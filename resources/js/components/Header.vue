<template>
    <div class="header header_absolute header_layout_1">
<!--        <div id="particles-js"></div>-->

        <section class="header__section page_title cs s-pt-60 s-pb-10 s-pt-lg-130 s-pb-lg-60 page_title text-center">
            <div class="container-fluid">
                <div class="row">
                    <div class="divider-60"></div>

                    <div class="col-md-12 text-center">
                        <h1>{{ title }}</h1>
                    </div>

                    <div class="divider-50"></div>
                </div>
            </div>
            <ol class="breadcrumb full-width">
                <li class="breadcrumb-item">
                    <router-link to="/">Home</router-link>
                </li>
                <li class="breadcrumb-item active">
                    {{ title }}
                </li>
            </ol>
        </section>
    </div>
</template>

<script>
    export default {
        name: "Header",

        props: {
            title: {
                type: String,
                default() {
                    return '';
                }
            }
        }
    }
</script>

<style lang="scss">
    .header {
        &__section {
            background-color: #434ae0;
            background-image: linear-gradient(43deg, #434ae0 23%, #d46f35 59%, #d46f35 100%);
        }
    }
</style>
