import Vue from "vue";
import Vuex from "vuex";

import navigation from "./modules/navigation";

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {},
    modules: {
        navigation,
    }
});
