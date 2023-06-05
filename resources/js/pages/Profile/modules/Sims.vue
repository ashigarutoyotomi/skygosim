<template>
    <div class="woocommerce-MyAccount-content">
        <h5>SIMs</h5>

        <template v-if="!user.sims.length">
            <div class="woocommerce-Message woocommerce-Message--info woocommerce-info">
                <a class="woocommerce-Button btn btn-maincolor btn-small" href="/add-sim">
                    <span>Add SIM</span>
                </a>
                No SIMs available yet.
            </div>
        </template>

        <template v-if="user.sims.length">
            <table class="woocommerce-MyAccount-downloads shop_table shop_table_responsive">
                <thead>
                    <tr>
                        <th class="download-product">
                            <span class="nobr">ICCID</span>
                        </th>
                        <th class="download-remaining">
                            <span class="nobr">Type</span>
                        </th>
                        <th class="download-expires">
                            <span class="nobr">PIN 2</span>
                        </th>
                        <th class="download-file">
                            <span class="nobr">PUK 1</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in user.sims">
                        <td class="download-product" data-title="Product">
                            {{item.sim.iccid}}
                        </td>
                        <td class="download-remaining" data-title="Downloads remaining">
                            {{simTypes[item.sim.sim_type].label}}
                        </td>
                        <td class="download-expires" data-title="Expires">
                            {{item.sim.pin_2}}
                        </td>
                        <td class="download-file" data-title="File">
                            {{item.sim.puk_1}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </template>

    </div>
</template>

<script>
    import {SIM_TYPES} from "../../Admin/Inventory/Sims/constants";

    export default {
        name: "ProfileSims",

        props: ['user'],

        data() {
            return {
                simTypes: SIM_TYPES,
            }
        }
    }
</script>

<style scoped>

</style>
