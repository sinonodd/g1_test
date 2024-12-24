<template>
    <div v-if="isColumn" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-50">
      <div class="relative bg-white rounded-lg p-6 w-96">
        <!-- Close Button -->
        <button @click="closeModal" class="absolute top-4 right-4 text-xl font-bold text-gray-500 hover:text-gray-700">X</button>
        
        <!-- Modal Content -->
        <h2 class="text-center text-2xl font-semibold mb-4">Add column</h2>
        
        <form @submit.prevent="addColumn" class="space-y-4">
          <!-- Title Field -->
          <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input
              v-model="title"
              type="text"
              id="title"
              class="mt-1 p-2 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              required
              placeholder="Column title"
            />
          </div>
          <div>
            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
            <select
                v-model="type"
                class="rounded px-2 py-1 border w-full"
            >
                <option value="select">Select</option>
                <option value="fix">Fixed value</option>
                <option value="composable">Composable</option>
            </select>
          </div>
           <!-- Error Message -->
           <p v-if="errorMessage" class="text-sm text-red-500">{{ errorMessage }}</p>

          <!-- Submit Button -->
          <div>
            <button
              type="submit"
              class="w-full py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
              Add column
            </button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script>

  export default {
    props: {
      isColumn: {
        type: Boolean,
        required: true,
      },
      groupId: {
        type: Number,
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
        type: null,
        errorMessage: '',
      };
    },
    methods: {
      closeModal(refresh) {
        if (refresh) this.$emit('refresh');
        this.$emit('close');
      },
      async addColumn() {
        this.errorMessage = '';
        try {
          await axios.post('/api/columns', {
            title: this.title,
            groupe_id: this.groupId,
            type: this.type,
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
  