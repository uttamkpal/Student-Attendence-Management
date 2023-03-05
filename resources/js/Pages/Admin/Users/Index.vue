<script setup>
import { defineProps } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import UsersList from '@/Components/Users/UsersList.vue';
import { Head } from '@inertiajs/vue3';
const props = defineProps(['users']);
const users = props.users;
</script>

<template>

    <Head title="Admin Dashboard" />

    <AdminLayout>
        <div class="overflow-x-auto">
            <UsersList :users = "users" />
        </div>
    </AdminLayout>
</template>
