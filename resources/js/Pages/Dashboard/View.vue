
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

const props = defineProps({
    views: Array,
});

const chartData = ({
    labels: ['January', 'February', 'March'],
    datasets: [
        {
            label: 'Views',
            backgroundColor: '#f87979',
            data: [props.views[0], props.views[1], props.views[2]]
        }
    ]
})
const chartOptions = ({
    responsive: true,
    maintainAspectRatio: true,
})

</script>


<template>
    <Head title="Messagies" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Views</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 shadow bg-body rounded">
                <a class="btn btn-dark mb-3 mr-3" role="button" href="javascript: history.back()">Go back</a>
                <div>
                    NUMBER OF VIEW : {{ views }}
                </div>
                <Bar :data="chartData" :options="chartOptions"  class="my_chart"/>



            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
.my_chart{
    height: 100px;
}
</style>