<script setup>
import { ref, watch } from 'vue'
import axios from '@/plugin/axios'

const email = ref()
const pass = ref()
const error = ref()
const loading = ref(true)

const login = async () => {
  loading.value = true
  error.value = ''
  try {
    const { data } = await axios.post('login', { email: email.value, password: pass.value })
    localStorage.setItem('token', data.token)
    localStorage.setItem('user', JSON.stringify(data.user))
  } catch (ex) {
    console.log(ex);
    error.value = ex.response.data.message
  } finally {
    loading.value = false
  }

}
</script>

<template>
  <VCard>
    <VCardText>
      <v-progress-linear v-if="loading" color="primary" indeterminate></v-progress-linear>
      <VForm @submit.prevent="login">
        <VAlert v-if="error" class="mb-2" color="error">{{ error }}</VAlert>
        <VTextField v-model="email" label="Email" />
        <VTextField v-model="pass" label="Password" type="password" />
        <VBtn type="submit" color="info">Login</VBtn>
      </VForm>
    </VCardText>
  </VCard>
</template>
