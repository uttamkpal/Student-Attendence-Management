<script setup>
import { onMounted, ref } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';

const sidebar = ref(false);

const sideBarHandler = () => {
    if (innerWidth > 780) {
        sidebar.value = true;
    } else {
        sidebar.value = false;
    }
}
addEventListener("resize", sideBarHandler);
onMounted(() => {
    if (innerWidth > 780) {
        sidebar.value = true;
    } else {
        sidebar.value = false;
    }
})
</script>

<template>
    <notifications class="mt-4 text-4xl" />
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <!-- <div class="shrink-0 flex items-center">
                                            <Link :href="route('dashboard')">
                                            <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800" />
                                            </Link>
                                        </div> -->

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    Dashboard
                                </NavLink>
                            </div>
                            <div>
                                <!-- Page content here -->
                                <div @click="sidebar = !sidebar"
                                    class="mt-2 px-2 block  drawer-button opacity-75 hover:opacity-50"><img
                                        src="/image/apps_black.png" alt=""></div>
                            </div>
                        </div>

                        <div class="sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                <div class="avatar">
                                                    <div class="w-8 rounded-full">
                                                        <img
                                                            src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                                    </div>
                                                </div>


                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>


                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex min-h-screen">
                <div class="min-h-screen">
                    <div class="w-48 min-h-screen dropdown" :class="sidebar ? 'flex' : 'hidden'">
                        <label tabindex="0" class="btn btn-ghost hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h8m-8 6h16" />
                            </svg>
                        </label>
                        <ul class="w-48 bg-base-100 text-base-content">
                            <!-- Sidebar content here --> 
                            <li>
                                 <label class="pl-4 py-2 mt-4 flex justify-between hover:bg-gray-400 hover:text-white w-full"
                                    tabindex="0"><span>Student</span>
                                    <svg class="fill-current inline" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/></svg>
                                </label> 
                                <ul tabindex="0" class="dropdown-content menu block bg-white text-black  w-full">
                                    <li><Link :href="route('admin.users.index')" class="pl-4 py-2 block  w-full"
                                    >All Student</Link></li>
                                    <li><Link :href="route('admin.users.create')" class="pl-4 py-2 block  w-full"
                                    >Create New</Link></li>
                                </ul>
                            </li>
                            
                            <!-- <li>
                                <Link :href="route('dashboard')" class="pl-4 py-2 block hover:bg-gray-400 hover:text-white">
                                Sidebar Item 2</link>
                            </li>
                            <li><a class="pl-4 py-2 block hover:bg-gray-400 hover:text-white">Sidebar Item 1</a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="w-full p-4 shadow ">
                    <slot />
                </div>
            </main>
            <footer class="footer p-10 bg-base-200 text-base-content">
                <div>
                    <svg width="50" height="50" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                        clip-rule="evenodd" class="fill-current">
                        <path
                            d="M22.672 15.226l-2.432.811.841 2.515c.33 1.019-.209 2.127-1.23 2.456-1.15.325-2.148-.321-2.463-1.226l-.84-2.518-5.013 1.677.84 2.517c.391 1.203-.434 2.542-1.831 2.542-.88 0-1.601-.564-1.86-1.314l-.842-2.516-2.431.809c-1.135.328-2.145-.317-2.463-1.229-.329-1.018.211-2.127 1.231-2.456l2.432-.809-1.621-4.823-2.432.808c-1.355.384-2.558-.59-2.558-1.839 0-.817.509-1.582 1.327-1.846l2.433-.809-.842-2.515c-.33-1.02.211-2.129 1.232-2.458 1.02-.329 2.13.209 2.461 1.229l.842 2.515 5.011-1.677-.839-2.517c-.403-1.238.484-2.553 1.843-2.553.819 0 1.585.509 1.85 1.326l.841 2.517 2.431-.81c1.02-.33 2.131.211 2.461 1.229.332 1.018-.21 2.126-1.23 2.456l-2.433.809 1.622 4.823 2.433-.809c1.242-.401 2.557.484 2.557 1.838 0 .819-.51 1.583-1.328 1.847m-8.992-6.428l-5.01 1.675 1.619 4.828 5.011-1.674-1.62-4.829z">
                        </path>
                    </svg>
                    <p>ACME Industries Ltd.<br />Providing reliable tech since 1992</p>
                </div>
                <div>
                    <span class="footer-title">Services</span>
                    <a class="link link-hover">Branding</a>
                    <a class="link link-hover">Design</a>
                    <a class="link link-hover">Marketing</a>
                    <a class="link link-hover">Advertisement</a>
                </div>
                <div>
                    <span class="footer-title">Company</span>
                    <a class="link link-hover">About us</a>
                    <a class="link link-hover">Contact</a>
                    <a class="link link-hover">Jobs</a>
                    <a class="link link-hover">Press kit</a>
                </div>
                <div>
                    <span class="footer-title">Legal</span>
                    <a class="link link-hover">Terms of use</a>
                    <a class="link link-hover">Privacy policy</a>
                    <a class="link link-hover">Cookie policy</a>
                </div>
            </footer>
        </div>
    </div>
</template>

<style>.drawer {
    height: inherit;
}</style>