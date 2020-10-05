import NotFound from "@/pages/Error404";

import NavDrawer from "@/layouts/NavDrawer";

import Clients from "@/components/Clients";

export const routes = [
    {path: "/", redirect: "/clients"},
    {
        path: "/clients",
        name: "clients",
        components: {
            default: Clients,
            navigation: NavDrawer,
        },
    },
    {
        path: "*",
        components: {
            default: NotFound,
            navigation: NavDrawer,
        }
    }
];
