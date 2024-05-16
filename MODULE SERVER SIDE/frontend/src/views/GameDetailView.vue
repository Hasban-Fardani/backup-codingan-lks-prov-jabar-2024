<script setup>
import { useUser } from "@/stores/user";
import axios from "axios";
import { onMounted } from "vue";
import { useRoute } from "vue-router";

const route = useRoute()
const user = useUser()
const { slug } = route.params
onMounted(() => {
    axios.get('http://localhost:8000/api/v1/games' + slug, {
        headers: {
            Authorization: 'Bearer ' + user.token 
        }
    })
        .then((res) => {
            console.log(res);
    });
});
</script>
<template>
    
</template>