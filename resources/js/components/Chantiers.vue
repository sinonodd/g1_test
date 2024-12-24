<template>
  <div class="p-6">
    <Login :isOpen="isOpen" @close="isOpen = false" />
    <Group :isGroup="isGroup" @close="isGroup = false" @refresh="fetchGroups"/>
    <Column :isColumn="isColumn" :group-id="currentGroup" @close="isColumn = false" @refresh="fetchGroups"/>
    <div class="flex items-center mb-4">
      <h1 class="text-2xl font-bold m-0 me-3">🚧 Suivi des chantiers</h1>
      <button
        @click="isGroup = true"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded"
      >
        Add group
      </button>

      <button
        @click="isTask = true"
        class="ms-3 bg-teal-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded"
      >
        Add record
      </button>
    </div>
    <table class="min-w-full border-collapse border border-gray-200 bg-white shadow-md">
      <thead>
        <!-- Render Groups as Column Headers -->
        <tr class="bg-gray-100">
          <th
            v-for="group in groups"
            :key="group.id"
            :colspan="group.columns.length"
            class="border text-center border-gray-300 px-4 py-2 text-lg font-semibold"
          >
            {{ group.title }}
            <button @click="currentGroup = group.id, isColumn = true" class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 rounded">
              +
            </button>
          </th>
        </tr>
        <!-- Render Column Titles -->
        <tr class="bg-gray-200">
          <th
            v-for="column in allColumns"
            :key="column.id"
            class="border border-gray-300 px-4 py-2 text-left"
          >
            {{ column.title }}
          </th>
        </tr>
      </thead>
      <tbody>
        <!-- Render Column Data -->
        <tr v-for="row in tableData" :key="row.id" class="hover:bg-gray-50">
          <td
            v-for="column in allColumns"
            :key="column.id"
            class="border border-gray-300 px-4 py-2"
          >
            <!-- Handle Select Columns -->
            <select
              v-if="column.type === 'select'"
              @change="(val) => update(row.id, column.id, val.target.value)"
              v-model="row[column.title]"
              class="rounded px-2 py-1"
              :class="resolveBg(row[column.title])"
            >
              <option
                v-for="option in column.defaultValues"
                :key="option.id"
                :value="option.value"
              >
                {{ option.value }}
              </option>
            </select>

            <!-- Handle Fixed Columns -->
            <span v-else-if="column.type === 'fixed'">{{ row[column.title] }}</span>

            <!-- Handle Progress Columns -->
            <span v-else>{{ row[column.progress] }}%</span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';
import Login from './Login.vue';
import Group from './Group.vue';
import Column from './Column.vue';

export default {
  components: {
    Login,
    Group,
    Column,
  },
  data() {
    return {
      tableData: [],
      isOpen: true,
      isGroup: false,
      isColumn: false,
      email: null,
      password: null,
      groups: [],
      currentGroup: null,
    };
  },
  computed: {
    allColumns() {
      // Flatten columns from all groups
      return this.groups.reduce(
        (columns, group) => [...columns, ...group.columns],
        []
      );
    },
  },
  mounted() {
    this.fetchGroups()
    this.fetchData()
    const token = localStorage.accessToken;
    if (token) return this.isOpen = false;
    return this.isOpen = true;
  },
  methods: {
    async fetchGroups() {
      try {
        const response = await axios.get('/api/groups')
        this.groups = response.data
      } catch (error) {
        console.error('error')        
      }
    },
    async fetchData() {
      try {
        const response = await axios.get('/api/tasks')
        this.tableData = response.data
      } catch (error) {
        console.error('error')        
      }
    },
    async update(id, column, value) {
      try {
        await axios.put(`/api/chantiers/${id}`, { column, value });
        this.fetchData()
      } catch (error) {
        console.error(error)
      }
    },
    formatDate(date) {
      const d = new Date(date);
      const day = String(d.getDate()).padStart(2, '0');
      const month = String(d.getMonth() + 1).padStart(2, '0'); // Months are zero-based
      const year = d.getFullYear();

      return `${day}/${month}/${year}`;
    },
    resolveBg(val) {
      if (val === 'OK') return 'bg-teal-300'
      if (val === 'NOK') return 'bg-red-300'
      if (val === 'En course') return 'bg-blue-300'
      return 'bg-gray-200'
    }
  }
};
</script>

<style scoped>
/* Add optional additional styling */
</style>
