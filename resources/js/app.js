import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createPinia } from 'pinia'
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

// Import Ant Design Vue and its CSS
import Antd from 'ant-design-vue';
import 'ant-design-vue/dist/reset.css'; // Use reset.css for Ant Design Vue v4 (recommended) or ant-design-vue/dist/antd.css for v3

import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faUser,  faUserPlus, faRightToBracket, faBagShopping, faCartPlus, faMagnifyingGlass, faCartShopping, faXmark, faTrash, faChevronLeft, faChevronRight, faBars, faEllipsisVertical, faArrowUp, faArrowDown, faDollarSign, faUtensils, 
} from "@fortawesome/free-solid-svg-icons";
/* Add icons to the library */
library.add(
    faUser, faUserPlus, faRightToBracket, faBagShopping, faCartPlus, faMagnifyingGlass, faCartShopping, faXmark, faTrash, faChevronLeft, faChevronRight, faBars,faEllipsisVertical, faArrowUp, faArrowDown, faDollarSign, faUtensils
);

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(createPinia())
            .use(Antd) // <--- Add this line to use Ant Design Vue
            .component("font-awesome-icon", FontAwesomeIcon)

            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});