import { createRouter, createWebHistory } from 'vue-router'

export default createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('./views/Russian.vue'),
    },
    {
      path: '/ru',
      name: 'russian',
      component: () => import('./views/Russian.vue'),
    },
    {
      path: '/ru/api',
      name: 'apiRussian',
      component: () => import('./views/ApiRussian.vue')
    },
    {
      path: '/es',
      name: 'spanish',
      component: () => import('./views/Spanish.vue')
    },
    {
      path: '/es/api',
      name: 'apiSpanish',
      component: () => import('./views/ApiSpanish.vue')
    },
  ],
})
