<template>
  <div class="edit-product">
    <h1>Edit Product</h1>
    <label for="field-select">Select Field to Update:</label>
    <select v-model="selectedField" id="field-select">
      <option value="">Select Field</option>
      <option value="title">Title</option>
      <option value="author">Author</option>
      <option value="description">Description</option>
      <option value="isbn">ISBN</option>
      <option value="genre">Genre</option>
      <option value="image">Image URL</option>
      <option value="published">Published Date</option>
      <option value="publisher">Publisher</option>
      
    </select>
    <div v-if="selectedField" class="form-group">
      <label :for="selectedField">{{ selectedField | capitalize }}:</label>
      <input v-if="getInputType(selectedField) !== 'textarea' && selectedField !== 'image'"
             v-model="editedProduct[selectedField]"
             :type="getInputType(selectedField)"
             :id="selectedField"
      />
      <input v-else-if="selectedField === 'image'"
             type="file"
             accept="image/*"
             @change="handleImageUpload"
             :id="selectedField"
      />
      <textarea v-else
                v-model="editedProduct[selectedField]"
                :id="selectedField"
      ></textarea>
      <button @click="updateProduct(selectedField)">Update {{ selectedField | capitalize }}</button>
    </div>
    <div v-if="updateSuccess" class="success-message">
      Product updated successfully!
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      editedProduct: {
        title: '',
        author: '',
        description: '',
        isbn: '',
        genre: '',
        image: '',
        published: '',
        publisher: '',
       
      },
      selectedField: '',
      updateSuccess: false,
    };
  },
  methods: {
    async updateProduct(fieldToUpdate) {
      const productId = this.$route.params.id;
      try {
        let formData = new FormData();
        if (fieldToUpdate === 'image') {
          formData.append('image', this.editedProduct.image);
        } else {
          formData.append(fieldToUpdate, this.editedProduct[fieldToUpdate]);
        }
        const response = await fetch(`http://127.0.0.1:8000/api/product/update/${productId}`, {
          method: 'PUT',
          body: formData,
        });

        const responseData = await response.json();
        if (response.ok) {
          console.log(`${fieldToUpdate} updated successfully:`, responseData.message);
          this.fetchProductData(productId);
          this.updateSuccess = true;

          setTimeout(() => {
            this.updateSuccess = false;
          }, 5000);
        } else {
          console.error(`Failed to update ${fieldToUpdate}:`, responseData.error);
        }
      } catch (error) {
        console.error(`Error updating ${fieldToUpdate}:`, error);
      }
    },
  

    async fetchProductData(productId) {
      try {
        const response = await fetch(`http://127.0.0.1:8000/api/product/${productId}`);
        const data = await response.json();
        this.editedProduct = data;
        console.log('Fetched updated product data:', data);
      } catch (error) {
        console.error('Error fetching updated product data:', error);
      }
    },
  



  

    capitalize(value) {
      return value.charAt(0).toUpperCase() + value.slice(1);
    },
    getInputType(field) {
      if (field === 'published') {
        return 'date';
      } else if (field === 'description') {
        return 'textarea';
      }
      return 'text';
    },
    handleImageUpload(event) {
      const file = event.target.files[0];
      this.editedProduct['image'] = file;
    },
  },
  mounted() {
    const productId = this.$route.params.id;
    this.fetchProductData(productId);
  },
};
</script>

<style scoped>
.edit-product {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
}

.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="text"],
input[type="date"],
textarea {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 5px;
}

button {
  padding: 10px;
  border: none;
  border-radius: 4px;
  background-color: #007bff;
  color: #fff;
  cursor: pointer;
  width: 100%;
  margin-top: 10px;
}

select {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 5px;
}

.success-message {
  background-color: #d4edda;
  color: #155724;
  border: 1px solid #c3e6cb;
  padding: 10px;
  margin-top: 10px;
  border-radius: 4px;
}
</style>
