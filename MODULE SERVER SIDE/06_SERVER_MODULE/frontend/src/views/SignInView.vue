
<script setup>
import router from "@/router";
import { useUser } from "@/stores/user";
import { ref } from "vue";

const user = useUser();

const formData = ref({
   username: '',
   password: ''
});

const login = async () => {
   user.signin(formData.value)
   .then(()=>{
      router.push('/')
   }).catch(() => {
      alert('Wrong username / password')
   });
};
</script>
<template>
   <main>
      <section class="login">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-lg-5 col-md-6">
                  <h1 class="text-center mb-4">Gaming Portal</h1>
                  <div class="card card-default">
                     <div class="card-body">
                        <h3 class="mb-3">Sign In</h3>
                        
                        <form @submit.prevent="login()"> 
                           <!-- s: input -->
                           <div class="form-group my-3">
                              <label for="username" class="mb-1 text-muted">Username</label>
                              <input type="text" id="username" name="username" value="" class="form-control" autofocus v-model="formData.username"/>
                           </div> 

                           <!-- s: input -->
                           <div class="form-group my-3">
                              <label for="password" class="mb-1 text-muted">Password</label>
                              <input type="password" id="password" name="password" value="" class="form-control" v-model="formData.password"/>
                           </div>
                           
                           <div class="mt-4 row">
                              <div class="col">
                                 <button type="submit" class="btn btn-primary w-100">Sign In</button>
                              </div>
                              <div class="col">
                                 <a href="/signup" class="btn btn-danger w-100">Sign up</a>
                              </div>
                              
                           </div>
                        </form>

                     </div>
                  </div> 
               </div>
            </div>
         </div>
      </section>
   </main>
</template>

<style>

</style>
