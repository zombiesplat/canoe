import Vue from "vue";
import Router from "vue-router";
import {routes} from "./routes";
import goTo from "vuetify/es5/services/goto";

Vue.use(Router);

export default new Router({
    routes,
    mode: "history",
    base: "/",
    scrollBehavior(to, from, savedPosition) {
        let scrollTo = 0;

        if (to.hash) {
            scrollTo = to.hash;
        } else if (savedPosition) {
            scrollTo = savedPosition.y;
        }

        return goTo(scrollTo);
    }
});
