// IMPORTIAMO LE FUNZIONI NECESSARIE 
import { createRouter , createWebHashHistory} from 'vue-router'



import HomePage from './pages/HomePage.vue'
import AdvancedSearch from './pages/AdvancedSearch.vue'
import Apartments from './pages/Apartments.vue'
import ApartmentDetail from './pages/ApartmentDetail.vue'



// DEFINIAMO L'ARRAY DI ROTTE
const routes = [
    {path: '/', component: HomePage} ,
    {path: '/search', component: AdvancedSearch}  ,
    {path: '/apartments', component: Apartments}  ,
    {path: '/apartments/:id/:title' , component: ApartmentDetail} ,

 ]

 const router = createRouter({
    history: createWebHashHistory(),
    routes,
})





export { router };