<template>
    <h1 class="py-4 text-sm">Admin Users Page</h1>
    <table class="table w-full ">
        <thead>
            <tr class="hover">
                <th>#</th>
                <th>Name</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user, index in users" :key="user.id" class="hover">
                <th class="p-0">{{ index + 1 }}</th>
                <td class="p-0">{{ user.name }} </td>
                <td class="p-0" v-for="role in user.roles" :key="roles.id" >{{ role.name }}</td>
                <td class="flex gap-3 p-1">
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

<script>
import { notify } from "@kyvg/vue3-notification";
export default {
    name: 'UsersList',
    props:['users'],
    emits: ['getUsers'],
    data() {
        return {
            roles: {},
            modal: false,
            formUser: {
                name: '',
                role: null,
                id: null
            }
        }
    },
    methods: {
        handleEditForm(user) {
            this.formUser.name = user.name;
            this.formUser.role = user.roles[0]['id'];
            this.formUser.id = user.id;
        },
        deleteUser(id) {
            if (confirm("You want to delete this User")) {
                axios.delete('/api/users/' + id)
                .then(response => {
                    
                    notify({
                        title: response.data.success,
                        type: "success"
                    });
                })
            }

        },

        updateUser() {
            axios.patch('/api/users/' + this.formUser.id + '/edit', this.formUser)
                .then((response) => {
                    notify({
                        title: response.data.success,
                        type: "success"
                    });
                    this.$emit('getUsers');
                    this.modal = false;
                })
                .catch((errors) => {
                    notify({
                        title: 'user updated failed',
                        type: "error"
                    });
                    this.modal = false;
                });
        }
    },
    mounted() {
        axios.get('/api/roles')
        .then(response => {
            this.roles = response.data
        });
       
    },
}


</script>