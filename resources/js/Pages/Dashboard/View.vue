
<script setup>
// import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
import DashboardLayout from '@/Layouts/DashboardLayout.vue';

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
    <Head title="Messages" />

    <DashboardLayout>

        <div class="container my-4 shadow p-3 rounded overflow-scroll">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary mb-3 mr-3" role="button" href="javascript: history.back()">Indietro</a>
            </div>
            <Bar :data="chartData" :options="chartOptions" class="my_chart" />
        </div>
    </DashboardLayout>
</template>

<style>
.my_chart {
    height: 100px;
}
</style>