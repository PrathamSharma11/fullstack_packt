<template>
  <div class="container mt-5" style="background-color: beige;">
    <h2 class="text-center">Search Products</h2>
    <form @submit.prevent="searchProducts">
      <div class="input-group mb-3">
        <input v-model="searchQuery" type="text" class="form-control" placeholder="Search...">
        <button type="submit" class="btn btn-primary">Search</button>
      </div>
    </form>

    <div v-if="products.length > 0" class="row">
      <div v-for="product in products" :key="product.id" class="col-md-4 mb-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{ product.title }}</h5>
            <p class="card-text">Author: {{ product.author }}</p>
            <p class="card-text">ISBN: {{ product.isbn }}</p>
            <p class="card-text">Genre: {{ product.genre }}</p>
            <button @click="viewDetails(product.id)" class="btn btn-primary">View Details</button>
          </div>
        </div>
      </div>
    </div>

    <p v-else>No products found.</p>

    <router-view></router-view> 
  </div>
</template>

<script>
export default {
  data() {
    return {
      products: [],
      searchQuery: '',
    };
  },
  methods: {
    async searchProducts() {
      try {
        const response = await fetch(`http://127.0.0.1:8000/api/products?search=${this.searchQuery}`);
        const data = await response.json();
        this.products = data.products;
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    },
    viewDetails(productId) {
      this.$router.push({ name: 'ProductDetails', params: { id: productId } });
    },
  },
};
</script>


