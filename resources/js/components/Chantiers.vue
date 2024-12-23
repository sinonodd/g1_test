<template>
  <div class="p-6">
    <Login :isOpen="isOpen" @close="isOpen = false" />
    <h1 class="text-2xl font-bold mb-4">🚧 Suivi des chantiers</h1>
    <table class="min-w-full border-collapse border border-gray-200 bg-white shadow-md">
      <!-- Column Groups -->
      <thead>
        <tr class="bg-gray-100">
          <th colspan="4" class="border text-center border-gray-300 px-4 py-2 text-left text-lg font-semibold">
            Information
          </th>
          <th colspan="9" class="border text-center bg-red-400 border-orange-300 px-4 py-2 text-left text-lg font-semibold">
            Checklist Preparation
          </th>
          <th colspan="5" class="border text-center bg-orange-300 border-orange-300 px-4 py-2 text-left text-lg font-semibold">
            Checklist Closure
          </th>
          <th class="border text-center border-gray-300 px-4 py-2 text-left text-lg font-semibold">
            Global
          </th>
        </tr>
        <tr class="bg-gray-200">
          <!-- Information Columns -->
          <th class="border border-gray-300 px-4 py-2 text-left">CLIENT</th>
          <th class="border border-gray-300 px-4 py-2 text-left">LIEU</th>
          <th class="border border-gray-300 px-4 py-2 text-left">AGENCE</th>
          <th class="border border-gray-300 px-4 py-2 text-left">DATE D'INTERVENTION</th>
          <!-- Checklist Preparation Columns -->
          <th class="border border-gray-300 px-4 py-2 text-left">BON DE COMMAND</th>
          <th class="border border-gray-300 px-4 py-2 text-left">FICH TRAVAUX</th>
          <th class="border border-gray-300 px-4 py-2 text-left">VISITE</th>
          <th class="border border-gray-300 px-4 py-2 text-left">MATÉRIEL DISPO</th>
          <th class="border border-gray-300 px-4 py-2 text-left">AFFECTATION TECHNICIEN</th>
          <th class="border border-gray-300 px-4 py-2 text-left">RESERVATION NACELLE</th>
          <th class="border border-gray-300 px-4 py-2 text-left">PLAN DE PREVENTION</th>
          <th class="border border-gray-300 px-4 py-2 text-left">RDV CONFIRME</th>
          <th class="border border-gray-300 px-4 py-2 text-left">AVANCEMENT</th>
          <!-- Checklist Closure Columns -->
          <th class="border border-gray-300 px-4 py-2 text-left">BON DE RECEPTION</th>
          <th class="border border-gray-300 px-4 py-2 text-left">RENTABILITÉ</th>
          <th class="border border-gray-300 px-4 py-2 text-left">DOE FAIT ET ENVOYÉ</th>
          <th class="border border-gray-300 px-4 py-2 text-left">FACTURATION ENVOYÉE</th>
          <th class="border border-gray-300 px-4 py-2 text-left">AVANCEMENT</th>
          <!-- Global -->
          <th class="border border-gray-300 px-4 py-2 text-left">AVANCEMENT GLOBAL</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="row in tableData" :key="row.id" class="hover:bg-gray-50">
          <!-- Information Data -->
          <td class="border border-gray-300 px-4 py-2 text-blue-600">🗣️ {{ row.client }}</td>
          <td class="border border-gray-300 px-4 py-2">📍 {{ row.lieu }}</td>
          <td class="border border-gray-300 px-4 py-2">⚒️ {{ row.agence }}</td>
          <td class="border border-gray-300 px-4 py-2">🗓️ {{ row.date_intervention && formatDate(row.date_intervention) }} - {{ row.date_fin && formatDate(row.date_fin) }}</td>
          <!-- Checklist Preparation Data -->
          <td class="border border-gray-300 px-4 py-2" :class="resolveBg(row.bon_command)">
            <select @change=" val => update(row.id, 'bon_command', val.target.value)" v-model="row.bon_command" class="rounded px-2 py-1" :class="resolveBg(row.bon_command)">
              <option value="OK">OK</option>
              <option value="NOK">NOK</option>
              <option value="En course">En course</option>
            </select>
          </td>
          <td class="border border-gray-300 px-4 py-2" :class="resolveBg(row.fiche_traveaux)">
            <select @change="val => update(row.id, 'fiche_traveaux', val.target.value)" v-model="row.fiche_traveaux" class="rounded px-2 py-1" :class="resolveBg(row.fiche_traveaux)">
              <option value="OK">OK</option>
              <option value="NOK">NOK</option>
              <option value="En course">En course</option>
            </select>
          </td>
          <td class="border border-gray-300 px-4 py-2" :class="resolveBg(row.visite)">
            <select @change="val => update(row.id, 'visite', val.target.value)" v-model="row.visite" class="rounded px-2 py-1" :class="resolveBg(row.visite)">
              <option value="OK">OK</option>
              <option value="NOK">NOK</option>
              <option value="N/A">N/A</option>
            </select>
          </td>
          <td class="border border-gray-300 px-4 py-2" :class="resolveBg(row.materiel_dispo)">
            <select @change="val => update(row.id, 'materiel_dispo', val.target.value)" v-model="row.materiel_dispo" class="rounded px-2 py-1" :class="resolveBg(row.materiel_dispo)">
              <option value="OK">OK</option>
              <option value="NOK">NOK</option>
              <option value="En course">En course</option>
            </select>
          </td>
          <td class="border border-gray-300 px-4 py-2" :class="resolveBg(row.affectation_technique)">
            <select @change="val => update(row.id, 'affectation_technique', val.target.value)" v-model="row.affectation_technique" class="rounded px-2 py-1" :class="resolveBg(row.affectation_technique)">
              <option value="OK">OK</option>
              <option value="NOK">NOK</option>
              <option value="En course">En course</option>
            </select>
          </td>
          <td class="border border-gray-300 px-4 py-2" :class="resolveBg(row.reservation_nacelle)">
            <select @change="val => update(row.id, 'reservation_nacelle', val.target.value)" v-model="row.reservation_nacelle" class="rounded px-2 py-1" :class="resolveBg(row.reservation_nacelle)">
              <option value="OK">OK</option>
              <option value="NOK">NOK</option>
              <option value="En course">En course</option>
            </select>
          </td>
          <td class="border border-gray-300 px-4 py-2" :class="resolveBg(row.plan_prevention)">
            <select @change="val => update(row.id, 'plan_prevention', val.target.value)" v-model="row.plan_prevention" class="rounded px-2 py-1" :class="resolveBg(row.plan_prevention)">
              <option value="OK">OK</option>
              <option value="NOK">NOK</option>
              <option value="En course">En course</option>
            </select>
          </td>
          <td class="border border-gray-300 px-4 py-2" :class="resolveBg(row.rdv_confirme)">
            <select @change="val => update(row.id, 'rdv_confirme', val.target.value)" v-model="row.rdv_confirme" class="rounded px-2 py-1" :class="resolveBg(row.rdv_confirme)">
              <option value="OK">OK</option>
              <option value="NOK">NOK</option>
              <option value="En course">En course</option>
            </select>
          </td>
          <td class="border border-gray-300 px-4 py-2">{{ row.prep_avancement }}%</td>
          <!-- Checklist Closure Data -->
          <td class="border border-gray-300 px-4 py-2" :class="resolveBg(row.bon_reception)">
            <select @change="val => update(row.id, 'bon_reception', val.target.value)" v-model="row.bon_reception" class="rounded px-2 py-1" :class="resolveBg(row.bon_reception)">
              <option value="OK">OK</option>
              <option value="NOK">NOK</option>
              <option value="En course">En course</option>
            </select>
          </td>
          <td class="border border-gray-300 px-4 py-2" :class="resolveBg(row.rentabilite)">
            <select @change="val => update(row.id, 'rentabilite', val.target.value)" v-model="row.rentabilite" class="rounded px-2 py-1" :class="resolveBg(row.rentabilite)">
              <option value="OK">OK</option>
              <option value="NOK">NOK</option>
              <option value="En course">En course</option>
            </select>
          </td>
          <td class="border border-gray-300 px-4 py-2" :class="resolveBg(row.doe_envoye)">
            <select @change="val => update(row.id, 'doe_envoye', val.target.value)" v-model="row.doe_envoye" class="rounded px-2 py-1" :class="resolveBg(row.doe_envoye)">
              <option value="OK">OK</option>
              <option value="NOK">NOK</option>
              <option value="En course">En course</option>
            </select>
          </td>
          <td class="border border-gray-300 px-4 py-2" :class="resolveBg(row.facturation_envoyee)">
            <select @change="val => update(row.id, 'facturation_envoyee', val.target.value)" v-model="row.facturation_envoyee" class="rounded px-2 py-1" :class="resolveBg(row.facturation_envoyee)">
              <option value="OK">OK</option>
              <option value="NOK">NOK</option>
              <option value="En course">En course</option>
            </select>
          </td>
          <td class="border border-gray-300 px-4 py-2">{{ row.cloture_avancement }}%</td>
          <!-- Global -->
          <td class="border border-gray-300 px-4 py-2">{{ row.avancement }}%</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';
import Login from './Login.vue';

export default {
  components: {
    Login,
  },
  data() {
    return {
      tableData: [],
      isOpen: true,
      email: null,
      password: null,
    };
  },
  mounted() {
    this.fetchData()
    const token = localStorage.accessToken;
    console.log(token)
    if (token) return this.isOpen = false;
    return this.isOpen = true;
  },
  methods: {
    async fetchData() {
      try {
        const response = await axios.get('/api/chantiers')
        this.tableData = response.data
        console.log(response)
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
