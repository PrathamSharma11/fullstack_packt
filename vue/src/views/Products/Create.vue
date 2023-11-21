<template>
    <div style="background-color: beige;">
      <div class="container my-5" style="background-color: beige;">
        <div class="row d-flex justify-content-center">
          <div class="col-xl-5 col-lg-5 col-md-8 col-sm-12">
            <div class="my-3">
              <router-link to="/"><button class="btn btn-secondary">Go Back</button></router-link>
            </div>
            <div class="card">
              <div class="card-header" style="background-color: beige;">
                <h3>Create Products</h3>
              </div>
              <div class="card-body">
                <form action="" @submit.prevent="submit">
                  <div class="my-2">
                    <label for=""><b>Title</b></label>
                    <input type="text" v-model="title" class="form-control" />
                  </div>
                  <div class="my-2">
                    <label for=""><b>Author</b></label>
                    <input type="text" v-model="author" class="form-control" />
                  </div>
                  <div class="my-2">
                    <label for=""><b>Genre</b></label>
                    <input type="text" v-model="genre" class="form-control" />
                  </div>
                  <div class="my-2">
                    <label for=""><b>Description</b></label>
                    <input type="text" v-model="description" class="form-control" />
                  </div>
                  <div class="my-2">
                    <label for=""><b>ISBN</b></label>
                    <input type="number" v-model="isbn" class="form-control" />
                  </div>
                  <div class="my-2">
                    <label for=""><b>Published</b></label>
                    <input type="date" v-model="published" class="form-control" />
                  </div>
                  <div class="my-2">
                    <label for=""><b>Publisher</b></label>
                    <input type="text" v-model="publisher" class="form-control" />
                  </div>
                  <div class="my-2">
                    <label for=""><b>Image</b></label>
                    <input type="file" @change="onFileChange" class="form-control" />
                    <img :src="image" alt="" />
                  </div>
                  <button class="btn btn-primary" type="submit">Save</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from "vue";
  import axios from "axios";
  import { useRouter } from "vue-router";
  
  const title = ref("");
  const author = ref("");
  const genre = ref("");
  const description = ref("");
  const isbn = ref("");
  const published = ref("");
  const publisher = ref("");
  const image = ref("");
  const router = useRouter();
  
  const onFileChange = (e) => {
    image.value = e.target.files[0];
  };
  
  const submit = async () => {
    if (!title.value || !image.value) {
      alert("Please fill all fields");
    } else {
      const formData = new FormData();
      formData.append("title", title.value);
      formData.append("author", author.value);
      formData.append("genre", genre.value);
      formData.append("description", description.value);
      formData.append("isbn", isbn.value);
      formData.append("published", published.value);
      formData.append("publisher", publisher.value);
      formData.append("image", image.value);
  
      const res = await axios.post("http://localhost:8000/api/save", formData);
      if (res.data.success) {
        alert("Image uploaded successfully");
        resetForm();
        router.push("/");
      }
    }
  };
  
  const resetForm = () => {
    title.value = "";
    author.value = "";
    genre.value = "";
    description.value = "";
    isbn.value = "";
    published.value = "";
    publisher.value = "";
    image.value = "";
  };
  </script>
  
  <script>
  export default {
    name: "CreateView",
  };
  </script>
  
  
  