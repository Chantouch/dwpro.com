/**
 * Created by Chantouch on 2/28/2017.
 */

import Home from './components/Admin.vue';
import BusinessType from  './components/modules/BusinessType.vue';
import CityProvince from  './components/modules/CityProvince.vue';
import Department from './components/modules/Department.vue';
import Function from './components/modules/Function.vue';
import Industry from './components/modules/Industry.vue';
import Qualification from './components/modules/Qualification.vue';
import Level from './components/modules/Level.vue';
import Language from './components/modules/Language.vue';
import Position from './components/modules/Position.vue';

export const routes = [
    {path: '/', component: Home},
    {path: '/admin/home', component: Home},
    {path: '/admin/modules/business-types', component: BusinessType},
    {path: '/admin/modules/city-provinces', component: CityProvince},
    {path: '/admin/modules/departments', component: Department},
    {path: '/admin/modules/functions', component: Function},
    {path: '/admin/modules/industries', component: Industry},
    {path: '/admin/modules/qualifications', component: Qualification},
    {path: '/admin/modules/levels', component: Level},
    {path: '/admin/modules/languages', component: Language},
    {path: '/admin/modules/positions', component: Position},
];
