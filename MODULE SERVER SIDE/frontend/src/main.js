import '@/assets/css/style.css'
import '@/assets/css/bootstrap.css'
import '@/assets/js/bootstrap.js'
import '@/assets/js/popper.js'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

import axios from 'axios'
axios.defaults.url = 'http://localhost:8000/api/v1'

const app = createApp(App)

app.use(createPinia())
app.use(router)

app.mount('#app')
