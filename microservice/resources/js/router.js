import { createWebHistory, createRouter, } from "vue-router"
import List from './pages/List.vue'
import Item from './pages/Item.vue'
import Create from './pages/Create.vue'

const routes = [
  { path: '/', name: 'list', component: List },
  { path: '/:id', name: 'item', component: Item },
  { path: '/create', name: 'create', component: Create },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
