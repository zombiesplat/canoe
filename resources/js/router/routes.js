import NotFound from "@/pages/Error404";

import NavDrawer from "@/layouts/NavDrawer";

import ClientsBrowse from "@/components/ClientsBrowse";
import CashFlowForm from "@/components/CashFlowForm";
import ClientFundsBrowse from "@/components/ClientFundsBrowse";

export const routes = [
  {path: "/", redirect: "/clients"},
  {
    path: "/clients",
    name: "ClientsBrowse",
    components: {
      default: ClientsBrowse,
      navigation: NavDrawer,
    },
  },
  {
    path: "/client/:client_id/funds",
    name: "ClientFundsBrowse",
    components: {
      default: ClientFundsBrowse,
      navigation: NavDrawer,
    },
  },
  {
    path: "/cash-flow-form",
    name: "CashFlowForm",
    components: {
      default: CashFlowForm,
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
