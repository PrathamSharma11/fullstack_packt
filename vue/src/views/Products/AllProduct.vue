<template>
    <div>
      <div class="card">
        <div class="card-header">
          <h4>
            Products
            <RouterLink to="/products/create" class="btn btn-primary float-end" >
              Add Product
            </RouterLink>
          </h4>

        </div>
        <div class="card-body" style="background-color: beige;">
          <table class="table table-bordered" style="background-color: beige;">
            <thead>
              <tr>
          <th>Id</th>
          <th>Title</th>
          <th>Author</th>
          <th>Genre</th>
          <th>Description</th>
          <th>ISBN</th>
          <th>Image</th>
          <th>Published</th>
          <th>Publisher</th>
          <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(product,index) in this.products" :key="index">
                <td>{{ product.id }}</td>
                <td>{{ product.title }}</td>
                <td>{{ product.author }}</td>
                <td>{{ product.genre }}</td>
                <td>{{ product.description }}</td>
                <td>{{ product.isbn }}</td>
                <td>{{ product.image }}</td>
                
      
                <td>{{ product.published }}</td>
                <td>{{ product.publisher }}</td>
                <td>
                  <RouterLink :to="{path:'/products/'+product.id+'/edit' }" class = "btn btn-success">Edit</RouterLink>
                  <button type="button" @click="deleteProduct(product.id)" class="btn btn-danger">Delete</button>
                </td>

              </tr>
            </tbody>

          </table>

        </div>

      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios'
  export default {
    name:'products',
    data(){
      return{
        products:[]
      }
    },
    mounted(){
      //console.log('i am here')
      this.getProducts();
    },

    methods: {
  getProducts() {
    axios.get('http://127.0.0.1:8000/api/product/display')
      .then(res => {
        console.log('Response:', res); 
        this.products = res.data.data; 
        console.log('Products:', this.products); 
      })
      .catch(error => {
        console.error('Error fetching products:', error);
      });
  },
  

  deleteProduct(productId) {
  if (confirm('Are you sure?')) {
    axios.delete(`http://127.0.0.1:8000/api/product/delete/${productId}`)
      .then(res => {
        alert(res.data.message);
        this.getProducts();
      })
      .catch(error => {
        console.error('Error deleting product:', error);
      });
  }
},






},





  }
  </script>
  
  
  