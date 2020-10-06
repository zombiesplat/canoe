<template>
  <v-container>
    <v-row class="px-xl-12 px-4">
      <v-col cols="12" class="elevation-2">
        <v-sheet>
          <v-row>
            <v-col class="headline ma-2">
              Funds
            </v-col>
          </v-row>
        </v-sheet>
        <v-sheet>
          <v-data-table
            :headers="headers"
            :loading="loading"
            :items="items"
            item-key="id"
          ></v-data-table>
        </v-sheet>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
import client from "@/client";

export default {
  methods: {
    fetchFunds() {
      this.loading = true;
      const client_id = this.$route.params.client_id;
      client({url: `/api/client/${client_id}/funds`, method: 'GET'})
        .then(
          response => {
            this.loading = false;
            this.items = response.data;
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
    this.fetchFunds();
  },
  data() {
    return {
      loading: false,
      items: [],
      serverItemsLength: 0,
      table_options: {
        "page": 1,
        "itemsPerPage": 10,
        "sortBy": [],
        "sortDesc": [],
        "groupBy": [],
        "groupDesc": [],
        "multiSort": false,
        "mustSort": false,
        "totalItems": 0,
        "footerProps": {
          "itemsPerPageOptions": [10, 25, 50]
        }
      },
      headers: [
        {
          text: "Fund Name",
          value: "name",
          sortable: true,
        },
        {
          text: "Type",
          value: "type",
          sortable: true,
        },
        {
          text: "Inception Date",
          value: "inception_date",
          sortable: true,
        },
        {
          text: "Description",
          value: "description",
          sortable: true,
        },
      ],
    };
  },
}
</script>
