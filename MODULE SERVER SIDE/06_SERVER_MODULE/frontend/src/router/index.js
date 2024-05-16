import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import { useUser } from '@/stores/user'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      meta: {
        guard: 'auth'
      }
    },
    {
      path: '/signin',
      name: 'signin',
      component: () => import('@/views/SignInView.vue'),
    },
    {
      path: '/signup',
      name: 'signup',
      component: () => import('@/views/SignUpView.vue')
    },
    {
      path: '/admin/list',
      name: 'admin-list',
      component: () => import('@/views/ListAdminView.vue'),
      meta: {
        guard: 'auth'
      }
    },
    {
      path: '/user/list',
      name: 'user-list',
      component: () => import('@/views/ListUserView.vue'),
      meta: {
        guard: 'auth'
      }
    },
    {
      path: '/user/add',
      name: 'user-add',
      component: () => import('@/views/AddUserView.vue'),
      meta: {
        guard: 'auth'
      }
    },
    {
      path: '/games',
      name: 'games',
      component: () => import('@/views/DashboardGamesView.vue'),
      meta: {
        guard: 'auth'
      }
    },
    {
      path: '/discover-games',
      name: 'discover-games',
      component: () => import('@/views/DiscoverGamesView.vue'),
      meta: {
        guard: 'auth'
      }
    },
    {
      path: '/game/:slug',
      name: 'game',
      component: () => import('@/views/GameDetailView.vue'),
      meta: {
        guard: 'auth'
      }
    },
    {
      path: '/profile',
      name: 'profile',
      component: () => import('@/views/ProfileView.vue'),
      meta: {
        guard: 'auth'
      }
    },
    {
      path: '/:pathMatch(.*)*',
      name: 'not-found',
      component: () => import('@/views/NotFoundView.vue')
    }
  ]
})

router.beforeResolve((from, to) => {
  const user = useUser()
  if (to.meta.guard == 'auth' || from.meta.guard == 'auth' && !user.token) {
    router.push('/signin')
  }
})
export default router
