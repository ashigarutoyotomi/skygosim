import InventoryInternetPackageIndex from "../pages/Admin/Inventory/InternetPackage/Index";

import InternetPackagePurchaseIndex from "../pages/Admin/InternetPackages/purchase/Index";
import InternetPackagePurchaseCheckout from "../pages/Admin/InternetPackages/purchase/Checkout";

export const internetPackageRoutes = [
    // Internet packages
    {
        name: 'internet_packages',
        path: '/internet-packages',
        component: InventoryInternetPackageIndex
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
