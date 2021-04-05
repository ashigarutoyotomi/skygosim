
import DashboardIndex from "../pages/Admin/Dashboard/Index";

import UsersIndex from "../pages/Admin/Users/Index";
import UsersShow from "../pages/Admin/Users/Show";
import UsersCreate from "../pages/Admin/Users/Forms/Create";
import UsersEdit from "../pages/Admin/Users/Forms/Edit";

import InternetPackageIndex from "../pages/Admin/InternetPackage/Index";
import SimCardIndex from "../pages/Admin/SimCard/Index";

import SimOrdersIndex from "../pages/Admin/SimOrders/Index";

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
        name: 'users_show',
        path: '/users/:userId/show',
        props: true,
        component: UsersShow,
    },

    {
        name: 'users_create',
        path: '/users/create',
        component: UsersCreate,
    },

    {
        name: 'users_edit',
        path: '/users/:userId/edit',
        props: true,
        component: UsersEdit,
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

    {
        name: 'sim_orders',
        path: '/sim-orders',
        component: SimOrdersIndex
    },
];
