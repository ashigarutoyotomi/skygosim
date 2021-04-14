
import DashboardIndex from "../pages/Admin/Dashboard/Index";

import UsersIndex from "../pages/Admin/Users/Index";
import UsersShow from "../pages/Admin/Users/Show";
import UsersCreate from "../pages/Admin/Users/Forms/Create";
import UsersEdit from "../pages/Admin/Users/Forms/Edit";

import DealerIndex from "../pages/Admin/Dealer/Index";
import DealerShow from "../pages/Admin/Dealer/Show";
import DealerCreate from "../pages/Admin/Dealer/Form/Create";
import DealerEdit from "../pages/Admin/Dealer/Form/Edit";
import DealerAddressCreate from '../pages/Admin/Dealer/Form/CreateAddress';

import InventoryInternetPackageIndex from "../pages/Admin/Inventory/InternetPackage/Index";
import InventoryPhysicalSims from "../pages/Admin/Inventory/Sims/PhysicalSims";
import InventoryESims from "../pages/Admin/Inventory/Sims/ESims";

import SimOrdersIndex from "../pages/Admin/SimOrders/Index";
import ShowPhysicalSimOrder from "../pages/Admin/SimOrders/ShowPhysicalSim";

import PurchasesInternetPackages from "../pages/Admin/Purchases/InternetPackages/InternetPackages";
import ShowPurchasesInternetPackages from "../pages/Admin/Purchases/InternetPackages/ShowInternetPackage";

import SettingsIndex from "../pages/Admin/Settings/Index";

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
        name: 'dealers_address_create',
        path: '/dealers/:userId/address/create',
        props: true,
        component: DealerAddressCreate,
    },

    {
        name: 'internet_packages',
        path: '/internet-packages',
        component: InventoryInternetPackageIndex
    },

    // Inventory
    {
        name: 'inventory_sims_physical',
        path: '/inventory/sims/physical',
        component: InventoryPhysicalSims
    },
    {
        name: 'inventory_e_sims',
        path: '/inventory/sims/e-sims',
        component: InventoryESims
    },

    // Sim Orders
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

    {
        name: 'purchases_internet_packages',
        path: '/purchases/internet-packages',
        component: PurchasesInternetPackages
    },

    {
        name: 'purchases_internet_package_show',
        path: '/purchases/internet-packages/:dataId/show',
        props: true,
        component: ShowPurchasesInternetPackages
    },

    {
        name: 'settings',
        path: '/settings',
        component: SettingsIndex
    },
];
