<script setup>

import { Head } from '@inertiajs/vue3';
import dashboardSidebar from './dashboardSidebar.vue';
import dashboardNavbar from './dashboardNavbar.vue';
import dashboardMain from './dashboardMain.vue'


const props = defineProps({

});

</script>


<template>
    <Head title="Dashboard" />

    <div class="contenitore">
        <div>
            <dashboardNavbar />
        </div>
        <div class="d-flex">
            <div>
                <dashboardSidebar />
            </div>
            <div>
                <dashboardMain />
            </div>
        </div>
    </div>
</template>

<style lang="scss">
@use "../../../scss/app.scss" as *;
@use "../../../scss/general.scss" as *;

.contenitore {
    height: 100vh;
}
</style>
