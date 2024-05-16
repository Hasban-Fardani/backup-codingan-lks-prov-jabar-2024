import { computed } from 'vue'
import { defineStore } from 'pinia'
import axios from 'axios';

export const useUser = defineStore('user', () => {
  const token = computed(() => localStorage.getItem('token'));
  const name = computed(() => localStorage.getItem('name'));
  
  async function signin(credentials) {
    await axios
      .post('http://localhost:8000/api/v1/auth/signin', credentials)
      .then(({data}) => {
        localStorage.setItem('token', data.token)
      })
  }

  async function signout(){
    await axios
      .post('http://localhost:8000/api/v1/auth/signout', null, {
        headers: {
          Authorization: 'Bearer ' + token
        }
      })
      .finally(() => {
        localStorage.removeItem('token')
        location.reload()
      })
  }

  return { token, name, signin, signout}
})
