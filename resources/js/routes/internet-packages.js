import InternetPackagesFromApiIndex from "../pages/Admin/Inventory/InternetPackage/InternetPackagesFromApiIndex";
import InternetPackagesFromFileIndex from "../pages/Admin/Inventory/InternetPackage/InternetPackagesFromFileIndex";

import InternetPackagePurchaseIndex from "../pages/Admin/InternetPackages/purchase/Index";
import InternetPackagePurchaseCheckout from "../pages/Admin/InternetPackages/purchase/Checkout";

export const internetPackageRoutes = [
    // Internet packages
    {
        name: 'internet_packages_from_api',
        path: '/internet-packages-from-api',
        component: InternetPackagesFromApiIndex
    },

    {
        name: 'internet_packages_from_file',
        path: '/internet-packages-from-file',
        component: InternetPackagesFromFileIndex
    },

    {
        name: 'internet_packages_purchase',
        path: '/internet-packages/purchase',
        component: InternetPackagePurchaseIndex
    },

    {
        name: 'internet_packages_purchase_checkout',
        path: '/internet-packages/purchase/checkout',
        component: InternetPackagePurchaseCheckout
    },
];
