<script setup>
import { useUser } from "@/stores/user";
import axios from "axios";
import { onMounted, ref } from "vue";

const user = useUser();
const signout = async () => {
  await user.signout();
  location.reload()
};

const admins = ref()
onMounted(async () => {
    await axios.get('http://localhost:8000/api/v1/admins', {
        headers: {
            Authorization: 'Bearer ' + user.token
        }
    }).then(({data}) => {
        console.log(data.content)
        admins.value = data.content
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

      <div class="list-form py-5">
         <div class="container">
            <h6 class="mb-3">List Admin Users</h6>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Created at</th>
                        <th>Last login</th>
                    </tr>
                </thead>
                <tbody>
                  <tr v-for="admin in admins" :key="admin.username">
                      <td>{{ admin.username }}</td>
                      <td>{{ admin.created_at}}</td>
                      <td>{{ admin.last_login_at}}</td>
                  </tr>
                </tbody>
            </table>

         </div>
      </div>
      
    </main>
</template>