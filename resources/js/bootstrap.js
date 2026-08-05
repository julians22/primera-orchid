import axios from 'axios';
import Alpine from 'alpinejs'
import intersect from '@alpinejs/intersect'

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Alpine.plugin(intersect)
Alpine.start()
