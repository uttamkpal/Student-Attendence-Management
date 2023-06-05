<script setup>
import ProfessorLayout from '@/Layouts/ProfessorLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>
<script>
export default {
    layout:ProfessorLayout,
    data () {
        return {
            user: this.$page.props.auth.user,
        }
    },
     mounted() {
        console.log();
    }
}
</script>

<template>

    <Head title="Professor Dashboard" />

        <div class="overflow-x-auto">
            <h2 class="py-4">Professor Home page </h2>
            <div class=" w-full flex flex-row">
            <figure><img src="/image/male-avator.jpg" :alt="user.name" /></figure>
            <div class="px-4">
                <h2 class="card-title">Name: {{ user.name }}</h2>
                <p><div class="">Email: {{ user.email }}</div></p>
                <p v-if="user.roll_no" >Roll No: {{ user.roll_no }}</p>
                <p v-if="user.registration_no">Registration No: {{ user.registration_no }} </p>
                <div v-for="role in user.roles" :key="role.id" class="justify-start">User Role: {{ role.name }}</div>
            </div>
            </div>
        </div>
 
</template>
