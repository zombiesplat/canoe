<template>
  <v-app id="inspire">
    <router-view name="navigation"></router-view>

    <v-app-bar app>
      <v-app-bar-nav-icon @click="toggleNavDrawer(!showNavigation)"></v-app-bar-nav-icon>

      <v-toolbar-title v-if="!showNavigation">Application</v-toolbar-title>
    </v-app-bar>

    <v-main>
      <router-view name="default"></router-view>
    </v-main>
    <v-dialog
      v-model="error_dialog"
      persistent
      width="80%"
    >
      <v-card>
        <v-card-title class="headline">
          Error
        </v-card-title>
        <v-card-text>
          {{ error_message }}
        </v-card-text>
        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary"
                 @click.native="error_dialog = false"
          >
            OK
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-app>
</template>

<script>
import {mapGetters} from "vuex";

export default {
  computed: {
    ...mapGetters({
      showNavigation: "showNavigation",
    }),
  },
  methods: {
    toggleNavDrawer(value) {
      this.$store.dispatch("toggleNavDrawer", value);
    }
  },
  mounted() {
    let self = this;
    bus.$on('error-alert', function (message) {
      self.error_message = message;
      self.error_dialog = true;
    });
  },
  data: () => ({
    drawer: null,
    error_message: null,
    error_dialog: false,
  }),
}
</script>
