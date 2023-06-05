<template>
    <h1 class="py-4 text-3xl">Add New Users</h1>
    <form @submit.prevent="handleSubmitForm" method="post" class="w-3/4">
        <div class="form-coltrol">
            <label for="name" class="label">User Name</label>
            <input v-model="formUser.name" type="text" id="name" class="input input-bordered input-info w-full ml-2" />
        </div>
        <div class="form-coltrol">
            <label for="email" class="label">User Email</label>
            <input v-model="formUser.email" type="email" id="email" class="input input-bordered input-info w-full ml-2" />
        </div>
        <div class="form-coltrol">
            <label for="password" class="label">User password</label>
            <input v-model="formUser.password" type="password" id="password"
                class="input input-bordered input-info w-full ml-2" />
        </div>
        <div class="form-coltrol">
            <label for="role" class="label">User Role</label>
            <select v-model="formUser.role" id="role" class="select select-info select-bordered w-full ml-2">
                <option class="h-12 p-4 block" :value="null" selected disabled>Select User role</option>
                <option v-for="role in roles" :key="role.name" class="h-6" :value="role.name">{{ role.name }}</option>
            </select>
        </div>
        <div v-if="formUser.role === 'student'" class="form-coltrol">
            <label for="roll_no" class="label">User Roll No</label>
            <input v-model="formUser.roll_no" type="number" id="roll_no"
                class="input input-bordered input-info w-full ml-2" />
        </div>
        <div v-if="formUser.role === 'student'" class="form-coltrol">
            <label for="registration_no" class="label">User Registration No</label>
            <input v-model="formUser.registration_no" type="number" id="registration_no"
                class="input input-bordered input-info w-full ml-2" />
        </div>
       
        <button class="btn btn-success m-2 mt-4">Create</button>
    </form>
</template>
<script setup>
import { onMounted, ref } from 'vue';
import { notify } from "@kyvg/vue3-notification";

const roles = ref({});
const formUser = ref(
    {
        name: '',
        email: '',
        password: 'password',
        role: null,
        roll_no: '',
        registration_no: '',

    }
);

const handleSubmitForm = () => {
    axios.post('/api/users/store', formUser.value).then(response => {
        notify({
            title: response.data,
            type: "success"
        });
        setTimeout(() => {
            window.location.reload();
        }, 2000)
    })
        .catch(errors => {

            if (errors.response.status === 400) {
                notify({
                    title: errors.response.data,
                    type: "error",
                    duration: 5000,
                });
            } else {
                notify({
                    title: errors.response.data.message,
                    type: "error",
                    duration: 5000,
                });
            }
            console.log(errors.response.data);
        })
}

onMounted(() => {
    axios.get('/api/roles')
        .then(response => {
            roles.value = response.data
        });
})
</script>