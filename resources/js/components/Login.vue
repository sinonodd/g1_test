<template>
    <div v-if="isOpen" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-50">
      <div class="bg-white rounded-lg p-6 w-96">
        <!-- Close Button -->
        <button @click="closeModal" class="absolute top-4 right-4 text-xl font-bold text-gray-500 hover:text-gray-700">X</button>
        
        <!-- Modal Content -->
        <h2 class="text-center text-2xl font-semibold mb-4">🔐 Login</h2>
        
        <form @submit.prevent="login" class="space-y-4">
          <!-- Email Field -->
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input
              v-model="email"
              type="email"
              id="email"
              class="mt-1 p-2 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              required
              placeholder="Enter your email"
            />
          </div>
  
          <!-- Password Field -->
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input
              v-model="password"
              type="password"
              id="password"
              class="mt-1 p-2 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              required
              placeholder="Enter your password"
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
              Login 🚀
            </button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      isOpen: {
        type: Boolean,
        required: true,
      },
    },
    data() {
      return {
        email: '',
        password: '',
        errorMessage: '',
      };
    },
    methods: {
      closeModal() {
        this.$emit('close'); // Emit close event to parent
      },
      async login() {
        this.errorMessage = ''; // Reset error message
  
        try {
          // Replace with your actual login API endpoint
          const response = await axios.post('/api/login', {
            email: this.email,
            password: this.password,
          });
  
          // Store the token in localStorage
          localStorage.setItem('accessToken', response.data.accessToken);
  
          // Close the modal on successful login
          this.closeModal();  
        } catch (error) {
          this.errorMessage = error.response?.data?.message || 'An error occurred';
        }
      },
    },
    mounted() {
        console.log(this.isOpen)
    }
  };
  </script>
  
  <style scoped>
  /* Add custom styling for the modal if needed */
  </style>
  