<template>
    <v-app id="inspire">
        <router-view name="navigation"></router-view>

        <v-app-bar app>
            <v-app-bar-nav-icon @click="toggleNavDrawer(!showNavigation)"></v-app-bar-nav-icon>

            <v-toolbar-title>Application</v-toolbar-title>
        </v-app-bar>

        <v-main>
            <router-view name="default"></router-view>
        </v-main>
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
    data: () => ({ drawer: null }),
}
</script>
