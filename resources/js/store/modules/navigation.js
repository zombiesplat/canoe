import {TOGGLE_NAVIGATION_DRAWER} from "@/store/actions/navigation";

const state = {
  show_navigation: true,
}

const getters = {
  showNavigation: state => state.show_navigation,
};

const actions = {
  toggleNavDrawer: ({commit}, payload) => {
    commit(TOGGLE_NAVIGATION_DRAWER, payload);
  },
};

const mutations = {
  [TOGGLE_NAVIGATION_DRAWER](state, payload) {
    state.show_navigation = !!payload;
  }
};

export default {
  state,
  getters,
  actions,
  mutations
};
