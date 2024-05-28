import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../views/LoginView.vue')
    },
    {
      path: '/usuarios',
      name: 'usuarios',
      component: () => import('../views/UsuariosView.vue')
    },
    {
      path: '/reuniones',
      name: 'reuniones',
      component: () => import('../views/ReunionView.vue')
    },
    {
      path: '/asistencias',
      name: 'asistencias',
      component: () => import('../views/AsistenciaView.vue')
    },
    {
      path: '/actas',
      name: 'actas',
      component: () => import('../views/ActasView.vue')
    }
  ]
})

export default router
