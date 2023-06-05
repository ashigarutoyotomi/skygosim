<template>
    <div class="apns">
        <header-comp
            title="APNs"
        />

        <section
            class="ls s-pt-50 s-pb-50 s-pt-lg-120 s-pb-lg-90 s-pt-xl-160 s-pb-xl-130 c-gutter-30 c-mb-30 service-page"
        >
            <div class="container">
                <template v-for="region in regions">
                    <div class="row mt-4">
                        <div class="col-lg-8 offset-lg-2" id="price">
                            <h5 class="special-heading text-center">{{ region.name }}</h5>
                        </div>
                    </div>

                    <div class="row">
                        <template v-for="country in region.countries">
                            <template v-for="apn in country.apns">
                                <div class="col-lg-3 col-sm-6">
                                    <div class="vertical-item rounded rounded-image-top hero-bg content-padding padding-small text-center h-full">
                                        <div class="item-content">
                                            <h5>{{apn.country.name}}</h5>

                                            <h6 class="mt-1 mb-1">Operator</h6>

                                            <p class="mt-1">{{ apn.operator }}</p>

                                            <h6 class="mt-1 mb-1">APN</h6>

                                            <p class="mt-1">{{ apn.apn }}</p>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </template>
                    </div>
                </template>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        name: "ApnIndex",

        props: {
            regions: {
                type: Array,
                default: () => [],
            }
        }
    }
</script>

<style scoped>

</style>
