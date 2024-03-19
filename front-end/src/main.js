import { createApp } from 'vue'
import './style.css'
import MainLayout  from './layouts/MainLayout.vue'
import '@fortawesome/fontawesome-free/css/all.css'

// import App from './App.vue'


import { router } from './router';


const app = createApp(MainLayout)

app.use(router)
app.mount('#app')