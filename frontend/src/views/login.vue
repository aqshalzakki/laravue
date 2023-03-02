<script setup>
import { ref, watch } from 'vue'
import axios from '@/plugin/axios'
import { useAuthStore } from '../stores/auth'
import { useRouter } from 'vue-router'

const authStore = useAuthStore()
const router = useRouter()
const email = ref()
const pass = ref()
const error = ref()
const loading = ref(false)

const login = async () => {
  loading.value = true
  error.value = ''
  try {
    const { data } = await axios.post('login', { email: email.value, password: pass.value })
    localStorage.setItem('token', data.token)
    localStorage.setItem('user', JSON.stringify(data.user))
    authStore.setUser(data.user)
    authStore.setToken(data.token)

    router.push('/products/123')
  } catch (ex) {
    console.log(ex)
    error.value = ex.response.data.message
  } finally {
    loading.value = false
  }
}
</script>

<template>
  <VCard>
    <VCardText>
      <v-progress-linear v-if="loading" color="info" indeterminate></v-progress-linear>
      <VForm @submit.prevent="login">
        <VAlert v-if="error" class="mb-2" color="error">{{ error }}</VAlert>
        <VTextField v-model="email" label="Email" />
        <VTextField v-model="pass" label="Password" type="password" />
        <VBtn :disabled="loading" :loading="loading" type="submit" color="info">Login</VBtn>
      </VForm>
    </VCardText>
  </VCard>
</template>
