<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import UsersList from '@/Components/Users/UsersList.vue';

import { Head } from '@inertiajs/vue3';

export default {
    components : { AdminLayout, UsersList, Head },
    layout: AdminLayout,
    props: {
        users: {}
    },
    methods: {
        getUsers() {
            setTimeout(() => {
                window.location.reload();
            }, 300);
        }
    },
   
}
</script>
<template>

    <Head title="Admin Dashboard" />

   
    <div class="overflow-x-auto">
        <UsersList :users ="users" @getUsers = "getUsers" />
    </div>
</template>
