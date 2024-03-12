import { createApp } from 'vue'
import './style.css'
import MainLayout  from './layouts/MainLayout.vue'
// import App from './App.vue'


import { router } from './router';


const app = createApp(MainLayout)

app.use(router)
app.mount('#app')