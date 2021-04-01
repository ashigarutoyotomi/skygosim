
import DashboardIndex from "../pages/Admin/Dashboard/Index";

import UsersIndex from "../pages/Admin/Users/Index";
import UsersCreate from "../pages/Admin/Users/Forms/Create";

import InternetPackageIndex from "../pages/Admin/InternetPackage/Index";
import SimCardIndex from "../pages/Admin/SimCard/Index";

export const routes = [
    {
        name: 'home',
        path: '/',
        component: DashboardIndex
    },

    {
        name: 'users',
        path: '/users',
        component: UsersIndex,
    },
    {
        name: 'users_create',
        path: '/users/create',
        component: UsersCreate,
    },

    {
        name: 'internet_packages',
        path: '/internet-packages',
        component: InternetPackageIndex
    },
    {
        name: 'sim_cards',
        path: '/sim-cards',
        component: SimCardIndex
    },
];
