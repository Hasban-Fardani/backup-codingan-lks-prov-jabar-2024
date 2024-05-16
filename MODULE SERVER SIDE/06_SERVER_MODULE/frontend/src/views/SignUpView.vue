<script setup>
import router from "@/router";
import { useUser } from "@/stores/user";
import axios from "axios";
import { ref } from "vue";

const user = useUser();
const formData = ref({
   username: '',
   password: ''
})

const signup = async () => {
   axios.post('http://localhost:8000/api/v1/auth/signup', formData.value)
      .then(({data}) => {
      localStorage.setItem('token', data.token)
   }).finally(() => {
      router.push('/')
   })
};
</script>
<template>
     <main>
      <div class="hero py-5 bg-light">
         <div class="container text-center"> 
            <h2 class="mb-3">
               Sign Up - Gaming Portal
            </h2> 
            <div class="text-muted">
               Lorem ipsum, dolor sit amet consectetur adipisicing elit.
            </div>
         </div>
      </div>

      <div class="py-5">
         <div class="container"> 

            <div class="row justify-content-center ">
               <div class="col-lg-5 col-md-6"> 
                  
                  <form @submit.prevent="signup()">
                     <div class="form-item card card-default my-4">
                        <div class="card-body">
                           <div class="form-group">
                              <label for="username" class="mb-1 text-muted">Username <span class="text-danger">*</span></label>
                              <input id="username" type="text" placeholder="Username" class="form-control" name="username" v-model="formData.username"/>
                           </div>  
                        </div>
                     </div>
                     <div class="form-item card card-default my-4">
                        <div class="card-body">
                           <div class="form-group">
                              <label for="password" class="mb-1 text-muted">Password <span class="text-danger">*</span></label>
                              <input id="password" type="password" placeholder="Password" class="form-control" name="userpasswordname" v-model="formData.password"/>
                           </div>  
                        </div>
                     </div>
   
                     <div class="mt-4 row">
                        <div class="col">
                           <button class="btn btn-primary w-100">Sign Up</button>
                        </div>
                        <div class="col">
                           <a href="/signin" class="btn btn-danger w-100">Sign In</a>
                        </div>
                     </div>
                  </form>

               </div>
             </div>  
            
         </div>
      </div>
    </main>
</template>