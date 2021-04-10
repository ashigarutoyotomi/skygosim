
import DashboardIndex from "../pages/Admin/Dashboard/Index";

import UsersIndex from "../pages/Admin/Users/Index";
import UsersShow from "../pages/Admin/Users/Show";
import UsersCreate from "../pages/Admin/Users/Forms/Create";
import UsersEdit from "../pages/Admin/Users/Forms/Edit";

import DealerIndex from "../pages/Admin/Dealer/Index";
import DealerShow from "../pages/Admin/Dealer/Show";
import DealerCreate from "../pages/Admin/Dealer/Form/Create";
import DealerEdit from "../pages/Admin/Dealer/Form/Edit";

import InternetPackageIndex from "../pages/Admin/InternetPackage/Index";
import SimCardIndex from "../pages/Admin/SimCard/Index";

import SimOrdersIndex from "../pages/Admin/SimOrders/Index";
import ShowPhysicalSimOrder from "../pages/Admin/SimOrders/ShowPhysicalSim";

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
        name: 'dealers',
        path: '/dealers',
        component: DealerIndex,
    },

    {
        name: 'dealers_show',
        path: '/dealers/:userId/show',
        props: true,
        component: DealerShow,
    },

    {
        name: 'dealers_create',
        path: '/dealers/create',
        component: DealerCreate,
    },

    {
        name: 'dealers_edit',
        path: '/dealers/:userId/edit',
        props: true,
        component: DealerEdit,
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
        name: 'sim_orders_physical',
        path: '/sim-orders/physical',
        props: { default: 'all', simType: 'physical' },
        component: SimOrdersIndex
    },

    {
        name: 'sim_orders_e_sim',
        path: '/sim-orders/e-sim',
        props: { default: 'all', simType: 'e-sim' },
        component: SimOrdersIndex
    },

    {
        name: 'sim_orders_physical_show',
        path: '/sim-orders/:simOrderId/show',
        props: true,
        component: ShowPhysicalSimOrder
    },
];
