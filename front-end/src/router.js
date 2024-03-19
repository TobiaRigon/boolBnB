// IMPORTIAMO LE FUNZIONI NECESSARIE 
import { createRouter , createWebHashHistory} from 'vue-router'


// IMPORTIAMO PAGINE O COMPONENTI NECESSARI 
import HomePage from './pages/HomePage.vue'
import AdvancedSearch from './pages/AdvancedSearch.vue'
import Apartments from './pages/Apartments.vue'
import ApartmentDetail from './pages/ApartmentDetail.vue'

// IMPORTIAMO IL COMPONENTE PER LA GESTIONE DEI MESSAGGI 
import MessageFormApi from './components/MessageFormApi.vue'



// DEFINIAMO L'ARRAY DI ROTTE
const routes = [
    {path: '/', component: HomePage} ,
    {path: '/search', component: AdvancedSearch}  ,
    {path: '/apartments', component: Apartments}  ,
    {path: '/apartments/:id' , component: ApartmentDetail} ,

    // AGGIUNGI LA NUOVA ROTTA PER IL FORM DEI MESSAGGI
    {path: '/messages', component: MessageFormApi}  // Imposta il percorso desiderato per il form dei messaggi

 ]

 const router = createRouter({
    history: createWebHashHistory(),
    routes,
})





export { router };