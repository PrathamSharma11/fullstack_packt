<template>
    <div class="container mt-5" style="background-color: beige;">
      <div v-if="product" class="mt-5">
        <h2>Product Details</h2>
        <div>
          <p><strong>Title:</strong> {{ product.title }}</p>
          <p><strong>Author:</strong> {{ product.author }}</p>
          <p><strong>ISBN:</strong> {{ product.isbn }}</p>
          <p><strong>Genre:</strong> {{ product.genre }}</p>
          
        </div>
      </div>
      <p v-else>No product details found.</p>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        product: null, 
      };
    },
    created() {
      
      this.fetchProductDetails(this.$route.params.id);
    },
    methods: {
      async fetchProductDetails(productId) {
        try {
          const response = await fetch(`http://127.0.0.1:8000/api/product/details/${productId}`);
          const responseData = await response.json();
          const productDetails = responseData.data; 
          console.log('Product Details:', productDetails); 
  
          
          this.product = productDetails; 
        } catch (error) {
          console.error('Error fetching product details:', error);
        }
      },
    },
  };
  </script>
  
  
  