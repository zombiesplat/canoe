<template>
  <v-navigation-drawer
    v-model="drawer"
    app
  >
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title class="title">
          Application
        </v-list-item-title>
      </v-list-item-content>
    </v-list-item>

    <v-divider></v-divider>

    <v-list
      dense
      nav
    >
      <v-list-item
        link
        :to="{name: 'ClientsBrowse'}"
      >
        <v-list-item-icon>
          <v-icon>
            mdi-account-multiple
          </v-icon>
        </v-list-item-icon>

        <v-list-item-content>
          <v-list-item-title>
            Clients
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-list-item
        link
        :to="{name: 'CashFlowForm'}"
      >
        <v-list-item-icon>
          <v-icon>
            mdi-pencil
          </v-icon>
        </v-list-item-icon>

        <v-list-item-content>
          <v-list-item-title>
            Cash Flow Form
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>
<script>
import {mapGetters} from "vuex";

export default {
  computed: {
    ...mapGetters({
      showNavigation: "showNavigation",
    }),
    drawer: {
      get() {
        return this.showNavigation;
      },
      set(value) {
        this.$store.dispatch("toggleNavDrawer", value);
      }
    },
  },
  data() {
    return {}
  },
}
</script>
