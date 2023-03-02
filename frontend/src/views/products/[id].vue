<template>
  <v-container>
    <div v-for="product in products" :key="product.id">
      <span>{{ product.id }}. {{ product.name }}</span>
    </div>
  </v-container>
</template>

<script setup>
import { onMounted, ref, watch } from 'vue'
import axios from '@/plugin/axios'

const props = defineProps(['id'])

const products = ref([])

onMounted(async () => {
  const { data } = await axios.get(`products`)
  products.value = data
})
</script>
