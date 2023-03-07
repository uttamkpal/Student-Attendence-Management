<script setup>
import { defineProps, ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import UsersList from '@/Components/Users/UsersList.vue';
import { Head } from '@inertiajs/vue3';
const props = defineProps(['users']);
var users = ref(props.users);
const getUsers = () => {
    console.log("emit worked III");
    axios.get('/api/users').then(response => {
        users.value = response.data;
        console.log(response.data);
    })
}
</script>

<template>

    <Head title="Admin Dashboard" />

    <AdminLayout>
        <div class="overflow-x-auto">
            <UsersList :users = "users" @get:users ="getUsers" />
        </div>
    </AdminLayout>
</template>
