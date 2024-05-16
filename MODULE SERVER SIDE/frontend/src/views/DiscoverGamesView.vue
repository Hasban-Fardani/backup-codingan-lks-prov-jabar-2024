<script setup>
import { useUser } from "@/stores/user";
import axios from "axios";
import { onMounted, ref } from "vue";

const games = ref([])
const user = useUser()
const shortDir = ref('asc');
onMounted(async () => {
    await getData()
});

const getData = async () => {
    await axios.get('http://localhost:8000/api/v1/games?sortDir=' + shortDir.value, {
        headers: {
            Authorization: 'Bearer ' + user.token 
        }
    }).then(({data}) => {
        games.value = data.content
    });
}

const changeSortDir = async (to) => {
    shortDir.value = to
    await getData()
}
</script>
<template>
 <main>
      <div class="hero py-5 bg-light">
         <div class="container text-center">
          <h1>Discover Games</h1>
         </div>
      </div>

      <div class="list-form py-5">
        <div class="container">
          <div class="row">
            <div class="col">
              <h2 class="mb-3">300 Game Avaliable</h2>
            </div>

            <div class="col-lg-8" style="text-align: right;">
              <div class="mb-3">
                <div class="btn-group" role="group">
                  <button type="button" class="btn btn-secondary">Popularity</button>
                  <button type="button" class="btn btn-outline-primary">Recently Updated</button>
                  <button type="button" class="btn btn-outline-primary">Alphabetically</button>
                </div>
                
                <div class="btn-group" role="group">
                  <button type="button" class="btn" :class="{'btn-secondary': shortDir == 'asc', 'btn-outline-primary': shortDir != 'asc'}" @click="changeSortDir('asc')">ASC</button>
                  <button type="button" class="btn" :class="{'btn-secondary': shortDir == 'desc', 'btn-outline-primary': shortDir != 'desc'}" @click="changeSortDir('desc')">DESC</button>
                </div>
             </div>
            </div>
          </div>
           

           <div class="row">
            <div class="col-md-6" v-for="game in games" :key="game.slug">
              <a :href="`/game/${game.slug}`" class="card card-default mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-4">
                      <img src="" alt="Demo Game 1 Logo" style="width: 100%">
                    </div>
                    <div class="col">
                      <h5 class="mb-1">{{ game.title }}<small class="text-muted">By {{ game.created_by }}</small></h5>
                      <div>{{ game.description }}</div>
                      <hr class="mt-1 mb-1">
                      <div class="text-muted">#scores submitted : 203</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
           </div>

        </div>
     </div>
      
    </main>    
</template>