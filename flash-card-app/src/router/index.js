/* eslint-disable no-unused-vars */
import { createRouter, createWebHistory } from 'vue-router';
import Connexion from '@/views/connexionVue.vue';
import NotFound from '@/views/notFound.vue';
import Inscription from '@/views/formulaireInscription.vue';
import Accueil from '@/views/AccueilVue.vue';
import { tsExternalModuleReference } from '@babel/types';
import Test from '@/views/PageTest.vue';



const routes = [
    {
        name: 'Connexion',
        path: '/',
        component: Connexion,
        meta: {
            title: 'Connexion',
        }
    },
    {
        name: 'Accueil',
        path: '/Accueil/', // :name == product(name), c'est un paramètre
        component: Accueil,
        props: true,        // On autorise le passage de données
        meta: {
            title: 'Accueil ',
        }
    },
    {
        name: 'NotFound',
        component: NotFound,
        path: '/:pathMatch(.*)', // Syntaxe pour récupérer tous les autres chemins "non définis dans l'URL"
        meta: {
            title: "404 not found",
        },


    },
    {
        name: 'Inscription',
        component: Inscription,
        path: '/Inscription',
        meta: {
            title: 'Inscription ',
        }

    },
    {
        name: 'Page de Test',
        component: Test,
        path: '/PageTest',
        meta: {
            title: 'Page de Test ',
        }
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
    linkActiveClass: "active",
    linkExactActiveClass: "exact-active", // Ceci Permet d'autoriser à styliser les liens <router-link></router-link>
})

export default router;


// From = vue de départ
// To = vue d'arrivée
router.afterEach((to, from) => {
    document.title = to.meta.title;

})
