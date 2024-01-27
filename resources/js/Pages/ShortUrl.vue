<script setup>
    import MainLayout from '@/Layouts/MainLayout.vue';
    import {Link,Head, useForm, router} from '@inertiajs/vue3'
    import {ref, reactive, watch} from 'vue';
    import {debounce} from 'lodash';
    import { HSOverlay } from 'preline';
    import axios from 'axios';

    defineProps({
        urls : {Object}
    });

    const searchInput = reactive({
        input : '',
        select : 20,
    });

    watch(searchInput, debounce(()=> router.get(route('url.index'),searchInput,{
        preserveScroll:true,
        preserveState:true
    },
    ),500));

    const form = useForm({
        'main_url' : ''
    });

    const modalFunction = () => {
        HSOverlay.close('#hs-slide-down-animation-modal');
    }

    const formSubmit = () => {
        form.post(route('url.store'), {
            preserveScroll: true,
            preserveState: true, 
            onSuccess: ()=> {
                modalFunction(),
                form.reset('main_url')
            }
        });
    }


</script>

<template>
    <Head title="Url List" />
    <MainLayout>
        <!-- Breadcrumb -->
        <div class="flex items-center justify-between">

            <div>
                <!-- <h3 class="dark:text-gray-100">Short Url</h3> -->
            </div>

            <ol class="flex items-center justify-end whitespace-nowrap" aria-label="Breadcrumb">
                <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200"
                    aria-current="page">
                    Short url
                </li>
            </ol>
        </div>
        <!-- Breadcrumb -->

        <div class="card space-y-6">
            <div class="flex justify-between items-center">
                <h3>Url List</h3>
                <button type="button" class="btn-primary" data-hs-overlay="#hs-slide-down-animation-modal">
                    Add New
                </button>
            </div>

            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
                            <div class="py-3 px-4 flex justify-between">
                                <div class="inputDropdown">
                                    <select id="select" v-model="searchInput.select" class="input w-32 py-2 rounded-sm">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                    </select>
                                </div>


                                <div class="relative max-w-xs">
                                    <label class="sr-only">Search</label>
                                    <input type="text" name="hs-table-with-pagination-search" v-model="searchInput.input"
                                        id="hs-table-with-pagination-search"
                                        class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-sm text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                                        placeholder="Search for items">
                                    <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                                        <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="11" cy="11" r="8" />
                                            <path d="m21 21-4.3-4.3" /></svg>
                                    </div>
                                </div>
                            </div>
                            <div class="overflow-hidden">

                                <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-700">

                                    <thead class="bg-gray-200 dark:bg-gray-700 ">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">
                                                Sl</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">
                                                Short Url</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">
                                                Main Url</th>
                                            <th scope="col" width="10%"
                                                class="px-6 py-3 text-center text-sm font-medium text-gray-500 dark:text-gray-400 uppercase ">
                                                Action</th>
                                        </tr>
                                    </thead>

                                    <tbody class="divide-y divide-gray-300 dark:divide-gray-700">
                                        <tr v-for="(url, index) in urls.data" :key="index">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-400"> {{ index+1 }}</td>
                                            
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                <a target="__blank" :href="route('url.show', url.short_url)">{{ route('url.show', url.short_url) }}</a></td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                {{ url.main_url }}</td>

                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-3">
                                               <Link :href="route('url.destroy', url.id)" method="delete" preserve-scroll preserve-state type="button" as="button" class="py-2 px-3 bg-red-600 text-white rounded-md dark:outline-danger">Delete</Link>
                                            </td>
                                        </tr>

                                        <tr v-if="!urls.data.length > 0">
                                            <td class="text-gray-600 dark:text-gray-100 text-center text-sm py-3" colspan="8">No data found</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="py-3 px-4 " v-if="urls.data.length > 0">
                                <nav class="flex items-center space-x-2">
                                    <Link :href="link.url" :class="{'bg-gray-300 dark:bg-[#141b2b] dark:text-blue-800':link.active == true}" v-for="(link, index) in urls.links" :key="index"
                                        class="py-2 px-3 inline-flex items-center text-sm rounded-full text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white dark:hover:text-blue-900 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                        <span aria-hidden="true" v-html="link.label"></span>
                                    </Link>
                                </nav>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            </div>




            <div id="hs-slide-down-animation-modal" class="hs-overlay hidden w-full h-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none">
            <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                <div class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-gray-800 dark:border-gray-700 dark:shadow-slate-700/[.7]">
                <div class="flex justify-between items-center py-3 px-4 border-b dark:border-gray-700">
                    <h3 class="font-bold text-gray-800 dark:text-white">
                    Url Create
                    </h3>
                    <button type="button" class="flex justify-center items-center w-7 h-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-gray-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" data-hs-overlay="#hs-slide-down-animation-modal">
                    <span class="sr-only">Close</span>
                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                </div>
                <form @submit.prevent="formSubmit">
                    <div class="p-4 overflow-y-auto">
                    <div class="input-group">
                        <label for="url" class="label">Url :</label>
                        <input type="text" class="input" v-model="form.main_url" placeholder="Enter url here">
                        <p v-if="form.errors.main_url" class="text-sm text-red-600">{{ form.errors.main_url }}</p>
                    </div>
                    </div>
                    <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-gray-700">
                        <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" data-hs-overlay="#hs-slide-down-animation-modal">
                        Close
                        </button>
                        <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                        Submit
                        </button>
                    </div>
                </form>
                </div>
            </div>
            </div>
    </MainLayout>
</template>

<style scoped>

</style>
