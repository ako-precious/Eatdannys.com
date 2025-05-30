<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';

import CardBarChart from "@/Components/Cards/CardBarChart.vue";
</script>

<template>
    <AppLayout title="Dashboard">
       <CardBarChart></CardBarChart>
    </AppLayout>
</template>
