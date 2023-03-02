<template>
  <div>
    <v-progress-linear v-if="loading" color="success" indeterminate></v-progress-linear>

    <v-btn @click="addProduct = true" class="mb-3" color="primary">add product</v-btn>
    <v-card v-if="addProduct">
      <v-card-text>
        <v-form @submit.prevent="createProduct">
          <v-text-field variant="underlined" v-model="product.name" label="Name"></v-text-field>
          <v-text-field variant="underlined" v-model="product.description" label="Description" textarea></v-text-field>
          <v-btn type="submit" color="info">Submit</v-btn>
          <v-btn @click="addProduct = false" variant="tonal" class="ml-2">Cancel</v-btn>
        </v-form>
      </v-card-text>
    </v-card>
    <v-divider class="my-2" />
    <div v-if="products.length">
      <v-card class="mb-4" v-for="product in products" :key="product.id">
        <v-card-title>{{ product.id }}. {{ product.name }}</v-card-title>
        <v-card-text>{{ product.description }}</v-card-text>
        <v-card-actions>
          <v-btn @click="deleteProduct(product.id)" color="error">delete</v-btn>
          <v-btn color="edit">info</v-btn>
        </v-card-actions>
      </v-card>
    </div>
    <p v-else-if="!loading">There are no products</p>
  </div>
</template>

<script setup>
import axios from '@/plugin/axios'
import { onMounted, ref } from 'vue'

const loading = ref()
const addProduct = ref()
const products = ref([])
const product = ref({
  name: '',
  description: '',
})

onMounted(async () => {
  loading.value = true

  const { data } = await axios.get('products')

  products.value = data.products
  loading.value = false
})

const deleteProduct = async (id) => {
  loading.value = true
  try {
    const { data } = await axios.delete(`products/${id}`)
    console.log(data)

    products.value = products.value.filter((item) => item.id !== id)
  } catch (ex) {
    console.error(ex)
  } finally {
    loading.value = false
  }
};

const createProduct = async (form) => {
  loading.value = true
  try {
    const { data } = await axios.post('products', {
      name: product.value.name,
      description: product.value.description,
    })
    products.value.unshift(data.product)
    form.target.reset()
  } catch (ex) {
    console.error(ex)
  } finally {
    loading.value = false
  }
};
</script>
