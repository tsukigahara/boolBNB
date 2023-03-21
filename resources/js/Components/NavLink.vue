<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps(['href', 'active', 'class']);


</script>

<template>
    <Link :href="href" :class="class">
    <slot />
    </Link>
</template>
