import { createRouter , createWebHashHistory} from 'vue-router'



import HomePage from './pages/HomePage.vue'
import AdvancedSearch from './pages/AdvancedSearch.vue'
import Apartments from './pages/Apartments.vue'




const routes = [
    {path: '/', component: HomePage} ,
    {path: '/search', component: AdvancedSearch}  ,
    {path: '/apartments', component: Apartments}  ,

 ]

 const router = createRouter({
    history: createWebHashHistory(),
    routes,
})





export { router };