<script setup>
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();

</script>

<template>
<div id="application-sidebar" class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform hidden fixed top-0 start-0 bottom-0 z-[60] w-64 bg-white border-e border-gray-200 pt-7 pb-10 overflow-y-auto lg:block lg:translate-x-0 lg:end-auto lg:bottom-0 [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-slate-700 dark:[&::-webkit-scrollbar-thumb]:bg-slate-500 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-6 pb-[14px] border-b border-gray-200 dark:border-gray-600 text-center">
      <a class="flex-none text-lg font-semibold text-gray-700 dark:text-gray-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="#" aria-label="Brand">Welcome to UShortner</a>
    </div>

    <nav class="hs-accordion-group p-6 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
      <ul class="space-y-1.5">
        <li>
          <Link :href="route('dashboard')" class="flex items-center gap-x-3.5 py-2 px-2.5  bg-gray-100 text-sm text-slate-700 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-600 dark:text-white dark:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" :class="{'bg-gray-300 dark:bg-gray-900': $page.url === '/dashboard'}">
            <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            Dashboard
          </Link>
        </li>

        <li>
          <Link :href="route('url.index')" class="flex items-center gap-x-3.5 py-2 px-2.5  bg-gray-100 text-sm text-slate-700 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-600 dark:text-white dark:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" :class="{'bg-gray-300 dark:bg-gray-900': $page.url === '/' || $page.url.startsWith('/?')}">
            <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            Url List
          </Link>
        </li>

        <li>
          <Link :href="route('config.index')" class="flex items-center gap-x-3.5 py-2 px-2.5  bg-gray-100 text-sm text-slate-700 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-600 dark:text-white dark:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" :class="{'bg-gray-300 dark:bg-gray-900': $page.url === '/config' || $page.url.startsWith('/config?')}">
            <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            Setup
          </Link>
        </li>
      </ul>
    </nav>
  </div>
</template>
