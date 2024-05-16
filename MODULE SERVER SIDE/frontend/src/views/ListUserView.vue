<script setup>
import { useUser } from "@/stores/user";
import axios from "axios";
import { onMounted, ref } from "vue";

const user = useUser();
const signout = async () => {
  await user.signout();
  location.reload()
};

const users = ref()
onMounted(async () => {
    await axios.get('http://localhost:8000/api/v1/users', {
        headers: {
            Authorization: 'Bearer ' + user.token
        }
    }).then(({data}) => {
        console.log(data.content)
        users.value = data.content
    })
});
</script>

<template>
<nav class="navbar navbar-expand-lg sticky-top bg-primary navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="/">Administrator Portal</a>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          
         <li><a href="/admin/list" class="nav-link px-2 text-white">List Admins</a></li>
         <li><a href="/user/list" class="nav-link px-2 text-white">List Users</a></li>
         <li class="nav-item">
           <a class="nav-link active bg-dark" href="#">Welcome, Administrator</a>
         </li> 
         <li class="nav-item">
          <button class="btn bg-white text-primary ms-4" @click="signout()">Sign Out</button>
         </li>
       </ul> 
      </div>
    </nav>
    <main>

      <div class="hero py-5 bg-light">
         <div class="container">
            <a href="/user/add" class="btn btn-primary">
               Add User
            </a>
         </div>
      </div>

      <div class="list-form py-5">
         <div class="container">
            <h6 class="mb-3">List Users</h6>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Created at</th>
                        <th>Last login</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  <tr v-for="user in users" :key="user.username">
                      <td><a href="" target="_blank">{{ user.username }}</a></td>
                      <td>{{ user.created_at }}</td>
                      <td>{{ user.last_login_at }}</td>
                      <td v-if="user.deleted_at"><span class="bg-danger text-white p-1 d-inline-block">Blocked</span></td>
                      <td v-else><span class="bg-success text-white p-1 d-inline-block">Active</span></td>
                      <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Lock
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <button type="submit" class="dropdown-item" name="reason" value="spamming">Spamming</button>
                                    </li>
                                    <li>
                                        <button type="submit" class="dropdown-item" name="reason" value="cheating">Cheating</button>
                                    </li>
                                    <li>
                                        <button type="submit" class="dropdown-item" name="reason" value="other">Other</button>
                                    </li>
                                </ul>
                            </div>
                            <a href="users-form.html" class="btn btn-sm btn-secondary">Update</a>
                            <a href="#" class="btn btn-sm btn-danger">Delete</a>
                      </td>
                  </tr>
                </tbody>
            </table>

         </div>
      </div>
      
    </main>
</template>