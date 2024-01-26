<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import {Head, useForm, router} from '@inertiajs/vue3';

const props = defineProps({
    config : "Object"
});

const form = useForm({
    'click_limit' : props.config.click_limit,
    'block_duration' : props.config.block_duration
});

const formSubmit = ()=>{
    form.post(route('config.store'),{
        preserveScroll : true,
        preserveState : true
    });
}


</script>

<template>
    <Head title="Config" />
    <MainLayout>
        <!-- Breadcrumb -->
        <div class="flex items-center justify-between">

            <div>
                <h3 class="dark:text-gray-100">Setup</h3>
            </div>

            <ol class="flex items-center justify-end whitespace-nowrap" aria-label="Breadcrumb">
                <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200"
                    aria-current="page">
                    Setup
                </li>
            </ol>
        </div>
        <!-- Breadcrumb -->


        <div class="card">
            <div class="card">
                <form @submit.prevent="formSubmit">
                    <div class="form-wrapper space-y-4">
                        <div class="input-row flex gap-3 flex-col md:flex-row">
                            <div class="group shrink md:w-6/12">
                                <label for="click_limit" class="label flex">Click Limit <p class="text-sm ml-1 text-red-400">(min)</p></label>
                                <input type="number" id="click_limit" v-model="form.click_limit" class="input w-full" placeholder="Enter Amount">
                                <p v-if="form.errors.click_limit" class="text-sm text-red-600">{{ form.errors.click_limit }}</p>
                            </div>

                            <div class="group shrink md:w-6/12">
                                <label for="block_duration" class="label flex">Block Duration <p class="text-sm ml-1 text-red-400">(min)</p></label>
                                <input type="number" id="block_duration" v-model="form.block_duration" class="input w-full">
                                <p v-if="form.errors.block_duration" class="text-sm text-red-600">{{ form.errors.block_duration }}</p>
                            </div>

                        </div>

                        <div class="group">
                            <button type="submit" class="btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </MainLayout>
</template>

<style scoped>

</style>
