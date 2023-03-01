<template>
  <div>
    <v-progress-linear
      v-if="loading"
      color="success"
      indeterminate
      rounded
      height="6"
    ></v-progress-linear>
    <v-card class="mb-4" v-for="(product, i) in products" :key="product.id">
      <v-card-title>{{ ++i }}. {{ product.name }}</v-card-title>
      <v-card-text>{{ product.description }}</v-card-text>
      <v-card-actions>
        <v-btn color="error">delete</v-btn>
        <v-btn color="edit">info</v-btn>
      </v-card-actions>
    </v-card>
  </div>
</template>

<script setup>
import axios from '@/plugin/axios'
import { onMounted, ref } from 'vue'

const loading = ref()
const products = ref([])

onMounted(async () => {
  loading.value = true

  const { data } = await axios.get('products')

  products.value = data.products
  loading.value = false
})
</script>