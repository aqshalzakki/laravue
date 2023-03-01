import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import axios from '@/plugin/axios'

export const useAuthStore = defineStore('auth', () => {
  // states
  const user = ref(JSON.parse(localStorage.getItem('user') || '{}'))
  const token = ref(localStorage.getItem('token'))
  const isLoggedIn = computed(() => Object.keys(user).length && !!token.value)

  // actions

  const setUser = payload => {
    user.value = payload
  }

  const setToken = payload => {
    token.value = payload
  }

  const logout = async () => {
    const { data } = await axios.post('logout')

    localStorage.removeItem('user')
    localStorage.removeItem('token')

    user.value = {}
    token.value = ''

    console.log(data);
  }

  return { user, token, isLoggedIn, logout, setUser, setToken }
})
