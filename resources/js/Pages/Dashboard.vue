<script setup>
    import MainLayout from '@/Layouts/MainLayout.vue';
    import { Head } from '@inertiajs/vue3';
    defineProps({
        totalUrl : Object
    });
</script>

<template>
    <Head title="Dashbaord" />
    
    <MainLayout>
        <!-- Breadcrumb -->
        <div class="flex items-center justify-between">
            <div>
                <h3 class="dark:text-gray-100">Dashboard</h3>
            </div>

            <ol class="flex items-center justify-end whitespace-nowrap" aria-label="Breadcrumb">
                <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200"
                    aria-current="page">
                    Dashboard
                </li>
            </ol>
        </div>
        <!-- Breadcrumb -->

        <div class="card">
            <div class="flex">
                <div class="space-y-3 w-2/12 dar:text-white p-3 border border-gray-500 dark:border-gray-200">
                    <div class="left-text text-center">
                        <h2>Total Url</h2>
                    </div>

                    <div class="right-text text-center">
                        <h1>{{ totalUrl }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<style scoped>

</style>