import { createApp } from 'vue'
import './style.css'
// import App from './App.vue'
import { createRouter , createWebHashHistory} from 'vue-router'


import MainLayout  from './layouts/MainLayout.vue'
import HomePage from './pages/HomePage.vue'
import AdvancedSearch from './pages/AdvancedSearch.vue'




const routes = [
    {path: '/', component: HomePage} ,
    {path: '/search', component: AdvancedSearch}  ,
 ]

 const router = createRouter({
    history: createWebHashHistory(),
    routes,
})



const app = createApp(MainLayout)

app.use(router)
app.mount('#app')
