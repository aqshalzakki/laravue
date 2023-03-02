<script setup>
import { RouterLink, RouterView, useRouter } from 'vue-router'
import HelloWorld from '../components/HelloWorld.vue'
import { useAuthStore } from '../stores/auth'

const authStore = useAuthStore()
const router = useRouter()

const logout = () => {
  authStore.logout().then(() => router.push('/login'))
};
</script>

<template>
  <div class="flexed">
    <header class="mb-5">
      <img alt="Vue logo" class="logo" src="@/assets/logo.svg" width="125" height="125" />

      <div class="wrapper">
        <HelloWorld msg="Hello world!" />

        <nav>
          <div>
            <RouterLink to="/">Home</RouterLink>
            <RouterLink to="/about">About</RouterLink>
            <RouterLink v-if="authStore.isLoggedIn" to="/products">Products</RouterLink>
          </div>
          <div>
            <VBtn variant="tonal" v-if="authStore.isLoggedIn" @click.prevent="logout">Logout</VBtn>
            <VBtn v-else>
              <RouterLink class="login-link" to="/login">Login</RouterLink>
            </VBtn>
          </div>
        </nav>
      </div>
    </header>

    <router-view v-slot="{ Component, route }">
      <transition name="slide">
        <component :is="Component" :key="route" />
      </transition>
    </router-view>
  </div>
</template>

<style scoped>
header {
  line-height: 1.5;
  max-height: 100vh;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

nav {
  width: 100%;
  text-align: center;
  margin-top: 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

nav a.router-link-exact-active {
  color: var(--color-text);
}

nav a.router-link-exact-active:hover {
  background-color: transparent;
}

nav a {
  display: inline-block;
  padding: 0 1rem;
  border-left: 1px solid var(--color-border);
}

nav a:first-of-type {
  border: 0;
}
.login-link {
  color: #000 !important;
}
</style>
