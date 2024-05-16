<script setup>
import { useUser } from "@/stores/user";
import axios from "axios";

const user = useUser();
const signout = async () => {
  await user.signout();
  location.reload()
};
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
         <div class="container text-center">
          <h1 class="mb-0 mt-0">Dashboard</h1>
         </div>
      </div>

      <div class="list-form py-5">
         <div class="container">
          <h5 class="alert alert-info">
            Welcome, Administrator. Don't forget to sign out when you are finished using this page
          </h5>
         </div>
      </div>
      
    </main>
</template>
