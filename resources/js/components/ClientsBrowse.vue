<template>
  <v-row justify="space-around">
    <v-card
      width="400"
      class="mx-auto mt-6 elevation-2"
    >
      <v-card-title class="headline">
        Clients
      </v-card-title>
      <v-card-text>
        <v-list nav>
          <v-list-item
            v-for="(item, i) in clients"
            :key="i"
            :to="{name: 'ClientFundsBrowse', params: {client_id: item.id}}"
          >
            <v-list-item-icon>
              <v-icon>
                mdi-account
              </v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title>
                {{ item.name }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-card-text>
      <v-card-actions>
        <v-btn
          color="primary"
          @click="fetchData"
          :loading="loading"
          :disabled="loading"
        >
          Refresh Clients List
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-row>
</template>
<script>
import client from "@/client";

export default {
  methods: {
    fetchData() {
      this.loading = true;
      client({url: '/api/clients', method: 'GET'})
        .then(
          response => {
            this.loading = false;
            this.clients = response.data;
          },
          error => {
            this.loading = false;
          },
        )
        .catch(
          error => {
            this.loading = false;
          },
        );
    },
  },
  mounted() {
    this.fetchData();
  },
  data() {
    return {
      loading: false,
      clients: [],
    }
  }
}
</script>
