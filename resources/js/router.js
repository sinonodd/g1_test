import { createRouter, createWebHistory } from 'vue-router';
import Chantiers from './components/Chantiers.vue';
import Login from './components/Login.vue';

const routes = [
  {
    path: '/',
    name: 'chantiers',
    component: Chantiers,
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
