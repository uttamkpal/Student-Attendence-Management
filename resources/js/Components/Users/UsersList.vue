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
                <td>{{ user.roles[0].name }}</td>
                <td class="flex gap-3">
                    <label for="user-edit-modal" class="btn btn-success text-white">Edit</label>
                    <button class="btn btn-error">X</button>
                </td>
            </tr>
        </tbody>
    </table>

    <input type="checkbox" class="modal-toggle" id="user-edit-modal" />
    <div class="modal">
        <div class="modal-box relative">
            <label for="user-edit-modal" class="btn btn-circle absolute right-2 top-2 bg-red-700 hover:bg-red-500">X</label>
            <h3 class="text-lg font-bold">User Edit Form</h3>
            <form action="" method="post">
                <div class="form-coltrol">
                    <label for="name" class="label">User Name</label>
                    <input v-model="formUser.name" type="text" id="name" class="input input-bordered input-info w-full ml-2" />
                </div>
                <div class="form-coltrol">
                    <label for="role" class="label">User Role</label>
                    <select v-model="formUser.role" id="role" class="select select-info select-bordered w-full ml-2">
                        <option class="h-12 p-4 block" :value="null" selected disabled>Select User role</option>
                        <option v-for="role in roles" :key="role.id" class="h-6" :value="role.id" :selected="role.id == formUser.role">{{ role.name }}</option>
                    </select>
                </div>
                <button class="btn btn-block btn-success m-2 mt-4">Update</button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import  axios  from 'axios';

const props = defineProps(['users']);
const users = props.users;
const roles = ref({});

const formUser = ref(
    {
        name: '',
        role: null
    }
)
console.log(users);

const handleEditForm = (user) =>{
    formUser.value.name = user.name;
    formUser.value.role = user.roles[0].name;
    formUser.value.id = user.id;

}
onMounted(() => {
    axios.get('/api/roles')
    .then(response => {
        roles.value = response.data
    });
})

</script>