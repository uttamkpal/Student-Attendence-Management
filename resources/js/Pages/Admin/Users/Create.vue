<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import UsersCreateForm from '@/Components/Users/UsersCreateForm.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>

    <Head title="Admin Dashboard" />

    <AdminLayout>
        <div class="overflow-x-auto">
            <UsersCreateForm />
        </div>
    </AdminLayout>
</template>
