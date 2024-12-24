<template>
    <div v-if="isGroup" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-50">
      <div class="relative bg-white rounded-lg p-6 w-96">
        <!-- Close Button -->
        <button @click="closeModal" class="absolute top-4 right-4 text-xl font-bold text-gray-500 hover:text-gray-700">X</button>
        
        <!-- Modal Content -->
        <h2 class="text-center text-2xl font-semibold mb-4">Add group</h2>
        
        <form @submit.prevent="addGroup" class="space-y-4">
          <!-- Title Field -->
          <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input
              v-model="title"
              type="text"
              id="title"
              class="mt-1 p-2 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              required
              placeholder="Group title"
            />
          </div>
           <!-- Error Message -->
           <p v-if="errorMessage" class="text-sm text-red-500">{{ errorMessage }}</p>

          <!-- Submit Button -->
          <div>
            <button
              type="submit"
              class="w-full py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
              Add group
            </button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script>

  export default {
    props: {
      isGroup: {
        type: Boolean,
        required: true,
      },
      id: {
        type: Number,
        required: false,
      },
    },
    data() {
      return {
        title: '',
        errorMessage: '',
      };
    },
    methods: {
      closeModal(refresh) {
        if (refresh) this.$emit('refresh');
        this.$emit('close');
      },
      async addGroup() {
        this.errorMessage = '';
  
        try {
          await axios.post('/api/groups', {
            title: this.title,
          });
          
          this.closeModal(true); 
        } catch (error) {
          this.errorMessage = error.response?.data?.message || 'An error occurred';
        }
      },
    },
  };
  </script>
  
  <style scoped>
  /* Add custom styling for the modal if needed */
  </style>
  