<template>
    <h1>Admin Users Page</h1>
    <table class="table w-full ">
        <thead>
            <tr class="hover">
                <th>#</th>
                <th>Name</th>
                <th>Roles</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user, index in users" :key="user.id" class="hover">
                <th>{{ index + 1 }}</th>
                <td>{{ user.name }} </td>
                <td>{{ user.roles[0]['name'] }}</td>
                <td class="flex gap-3">
                    <label @click="handleEditForm(user)" for="user-edit-modal"
                        class="btn btn-success text-white">Edit</label>
                    <button @click="deleteUser(user.id)" class="btn btn-error">X</button>
                </td>
            </tr>
        </tbody>
    </table>

    <input v-model="modal" type="checkbox" class="modal-toggle" id="user-edit-modal" />
    <div class="modal">
        <div class="modal-box relative">
            <label for="user-edit-modal" class="btn btn-circle absolute right-2 top-2 bg-red-700 hover:bg-red-500">X</label>
            <h3 class="text-lg font-bold">User Edit Form</h3>
            <form @submit.prevent="updateUser" method="post">
                <div class="form-coltrol">
                    <label for="name" class="label">User Name</label>
                    <input v-model="formUser.name" type="text" id="name"
                        class="input input-bordered input-info w-full ml-2" />
                </div>
                <div class="form-coltrol">
                    <label for="role" class="label">User Role</label>
                    <select v-model="formUser.role" id="role" class="select select-info select-bordered w-full ml-2">
                        <option class="h-12 p-4 block" :value="null" selected disabled>Select User role</option>
                        <option v-for="role in roles" :key="role.id" class="h-6" :value="role.id">{{ role.name }}</option>
                    </select>
                </div>
                <button class="btn btn-block btn-success m-2 mt-4">Update</button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref, defineEmits } from 'vue';
import { notify } from "@kyvg/vue3-notification";

const { users } = defineProps(['users']);
const emit = defineEmits(['get:users']);
const roles = ref({});
const modal = ref(false);

const formUser = ref(
    {
        name: '',
        role: null,
        id: null
    }
);

const handleEditForm = (user) => {
    formUser.value.name = user.name;
    formUser.value.role = user.roles[0]['id'];
    formUser.value.id = user.id;
}
const deleteUser = (id) => {
    if (confirm("You want to delete this User")) {
        axios.delete('/api/users/' + id)
        .then(response => {
            emit('get:users');
            notify({
                title: response.data.success,
                type: "success"
            });
        })
    }

}
const updateUser = () => {
    axios.patch('/api/users/' + formUser.value.id + '/edit', formUser.value)
        .then(response => {
            emit('get:users');

            notify({
                title: response.data.success,
                type: "success"
            });
            modal.value = false;
        })
        .catch(errors => {
            notify({
                title: errors.response.data.error,
                type: "error"
            });
            modal.value = false;
        });
}
onMounted(() => {
    axios.get('/api/roles')
        .then(response => {
            roles.value = response.data
        });
})

</script>