import { createWebHistory, createRouter } from "vue-router"
import Home from './pages/Home.vue'
import Login from './pages/Login.vue'
import Dashboard from './pages/Dashboard.vue'
import CrearCita from './pages/CrearCita.vue'
import ConfirmacionCitaBuscada from './pages/ConfirmacionCitaBuscada.vue'
import CentrosAtencion from './pages/CentrosAtencion.vue'
import confwhats from './pages/confwhats.vue'
import ReporteGraf from './pages/ReporteGraf.vue'
import Reportes from './pages/Reportes.vue'
import ConfirmacionCita from './pages/ConfirmacionCita.vue'

import store from './store'
import CatalogoRequisitos from './pages/CatalogoRequisitos.vue'
import CatalogoUsuarios from './pages/CatalogoUsuarios.vue'
import CatalogoTramites from './pages/CatalogoTramites.vue'
import CatalogoNotas from './pages/CatalogoNotas.vue'

import AgregarHorario from './pages/AgregarHorario.vue'
import EditarHorario from './pages/EditarHorarios.vue'
import CitasDelDia from './pages/CitasDelDia.vue'
import DatosCita from './pages/DatosCita.vue'


const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/login',
        name: 'Login',
        component: Login,
        meta: {
            requiresAuth: false
        }
    },
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: Dashboard,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/crear-cita',
        name: 'CrearCita',
        component: CrearCita,
    },
    {
        path: '/confirmacion-cita-buscada',
        name: 'ConfirmacionCitaBuscada',
        component: ConfirmacionCitaBuscada,
    },
    {
        path: '/centros-atencion',
        name: 'CentrosAtencion',
        component: CentrosAtencion,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/conf-whats',
        name: 'confwhats',
        component: confwhats,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/reporte-graficas',
        name: 'ReporteGraf',
        component: ReporteGraf,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/reportes',
        name: 'Reportes',
        component: Reportes,
        meta: {
            requiresAuth: true
        }
    },
    {        
        path: '/catalogo-requisitos',
        name: 'CatalogoRequisitos',
        component: CatalogoRequisitos,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/catalogo-usuarios',
        name: 'CatalogoUsuarios',
        component: CatalogoUsuarios,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/catalogo-tramites',
        name: 'CatalogoTramites',
        component: CatalogoTramites,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/confirmacion-cita',
        name: 'ConfirmacionCita',
        component: ConfirmacionCita,
    },
    {
        path: '/catalogo-notas',
        name: 'CatalogoNotas',
        component: CatalogoNotas,
    },
    {
        path: '/agregar-horario',
        name: 'AgregarHorario',
        component: AgregarHorario,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/confirmacion-cita',
        name: 'ConfirmacionCita',
        component: ConfirmacionCita,
    },
    {
        path: '/editar-horario',
        name: 'EditarHorario',
        component: EditarHorario,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/citas-del-dia',
        name: 'CitasDelDia',
        component: CitasDelDia,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/datos-cita',
        name: 'DatosCita',
        component: DatosCita
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth)
    const currentUser = store.state.user

    if (requiresAuth && !currentUser) {
        next('/login')
    } else if (to.path == '/login' && currentUser) {
        next('/citas-del-dia')
    } else {
        next()
    }
})

export default router