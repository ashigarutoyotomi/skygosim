
import DashboardIndex from "../pages/Admin/Dashboard/Index";
import InternetPackageIndex from "../pages/Admin/InternetPackage/Index";

export const routes = [
    {
        path: '/',
        component: DashboardIndex
    },
    {
        path: '/internet-packages',
        component: InternetPackageIndex
    },
];
