import { internetPackageRoutes } from "./internet-packages";

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
import PurchasedInternetPackagesFromWeb from "../pages/Admin/Purchases/InternetPackages/PurchasedInternetPackagesFromWeb";
import PurchasedInternetPackagesFromDashboard from "../pages/Admin/Purchases/InternetPackages/PurchasedInternetPackagesFromDashboard";
import ShowPurchasesInternetPackages from "../pages/Admin/Purchases/InternetPackages/ShowInternetPackage";

import PagesApnIndex from "../pages/Admin/Pages/Apn/Index";
import PagesApnShow from "../pages/Admin/Pages/Apn/Show";
import PagesApnCreate from "../pages/Admin/Pages/Apn/Create";
import PagesApnEdit from "../pages/Admin/Pages/Apn/Edit";

import RegionsIndex from "../pages/Admin/Region/Index";
import RegionsCreate from "../pages/Admin/Region/Create";
import RegionsShow from "../pages/Admin/Region/Show";
import RegionsEdit from "../pages/Admin/Region/Edit";

import CountriesIndex from "../pages/Admin/Countries/Index";
import CountriesCreate from "../pages/Admin/Countries/Create";
import CountriesShow from "../pages/Admin/Countries/Show";
import CountriesEdit from "../pages/Admin/Countries/Edit";

import SettingsIndex from "../pages/Admin/Settings/Index";
import SettingsPrices from "../pages/Admin/Settings/Prices";

const allRoutes = [
    {
        name: 'home',
        path: '/',
        component: DashboardIndex
    },

    // Users
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

    // Dealers
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

    // Purchases
    {
        name: 'purchases_internet_packages_from_web',
        path: '/purchases/internet-packages-from-web',
        component: PurchasedInternetPackagesFromWeb
    },

    {
        name: 'purchases_internet_packages_from_dashboard',
        path: '/purchases/internet-packages-from-dashboard',
        component: PurchasedInternetPackagesFromDashboard
    },

    {
        name: 'purchases_internet_package_show',
        path: '/purchases/internet-packages/:dataId/show',
        props: true,
        component: ShowPurchasesInternetPackages
    },

    // Pages APNs
    {
        name: 'pages_apns',
        path: '/pages/apns',
        component: PagesApnIndex
    },

    {
        name: 'pages_apns_create',
        path: '/pages/apns/create',
        component: PagesApnCreate
    },

    {
        name: 'pages_apns_edit',
        path: '/pages/apns/:apnId/edit',
        props: true,
        component: PagesApnEdit
    },

    {
        name: 'pages_apns_show',
        path: '/pages/apns/:apnId/show',
        props: true,
        component: PagesApnShow
    },

    //Regions
    {
        name: 'regions',
        path: '/regions',
        component: RegionsIndex
    },

    {
        name: 'regions_create',
        path: '/regions/create',
        component: RegionsCreate
    },

    {
        name: 'regions_show',
        path: '/regions/:regionId/show',
        props: true,
        component: RegionsShow
    },

    {
        name: 'regions_edit',
        path: '/regions/:regionId/edit',
        props: true,
        component: RegionsEdit
    },

    //Countries
    {
        name: 'countries',
        path: '/countries',
        component: CountriesIndex
    },

    {
        name: 'countries_create',
        path: '/countries/create',
        component: CountriesCreate
    },

    {
        name: 'countries_show',
        path: '/countries/:countryId/show',
        props: true,
        component: CountriesShow
    },

    {
        name: 'countries_edit',
        path: '/countries/:countryId/edit',
        props: true,
        component: CountriesEdit
    },

    //Settings
    {
        name: 'settings_main',
        path: '/settings/main',
        component: SettingsIndex
    },
    {
        name: 'settings_prices',
        path: '/settings/prices',
        component: SettingsPrices
    },
];

export const routes = [...allRoutes, ...internetPackageRoutes];
