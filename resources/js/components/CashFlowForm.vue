<template>
  <v-container>
    <v-row>
      <v-col cols="12" class="pa-2">
        <v-card
          class="mx-auto mt-6 elevation-2"
        >
          <v-card-title class="headline">
            Cash Flow Form
          </v-card-title>
          <v-card-text>
            <v-container>
              <v-row class="elevation-5 mx-xl-12 mx-5">
                <v-col cols="12" sm="4">
                  <v-autocomplete
                    label="Client Name*"
                    v-model="form.client_id"
                    :items="clients"
                    item-text="name"
                    item-value="id"
                    :error="!!errors['client_id']"
                    :error-messages="errors['client_id']"
                    @change="errors['client_id'] = null"
                  ></v-autocomplete>
                </v-col>
                <v-col cols="12" sm="4">
                  <v-autocomplete
                    label="Investment Type*"
                    v-model="form.fund_type"
                    :items="fund_types"
                    :error="!!errors['fund_type']"
                    :error-messages="errors['fund_type']"
                    @change="errors['fund_type'] = null"
                  ></v-autocomplete>
                </v-col>
                <v-col cols="12" sm="4">
                  <v-autocomplete
                    label="Investment Name*"
                    v-model="form.investment_id"
                    :items="investment_options"
                    item-text="name"
                    item-value="id"
                    :error="!!errors['investment_id']"
                    :error-messages="errors['investment_id']"
                    @change="errors['investment_id'] = null"
                  ></v-autocomplete>
                </v-col>
                <v-col cols="12" sm="6">
                  <v-currency-field
                    label="Current Value"
                    prefix="$"
                    :value="current_value"
                    readonly
                  ></v-currency-field>
                </v-col>
                <v-col cols="12" sm="6">
                  <v-currency-field
                    label="Updated Value"
                    prefix="$"
                    v-model="updated_value"
                    readonly
                  ></v-currency-field>
                </v-col>
                <v-col cols="12" sm="4">
                  <v-dialog
                    ref="date_dialog"
                    v-model="date_modal"
                    :return-value.sync="form.date"
                    persistent
                    width="290px"
                  >
                    <template v-slot:activator="{ on }">
                      <v-text-field
                        v-on="on"
                        v-model="form.date"
                        label="Date*"
                        prepend-icon="mdi-calendar"
                        :error="!!errors['date']"
                        :error-messages="errors['date']"
                        readonly
                        clearable
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="form.date"
                      scrollable
                      color="secondary"
                      header-color="primary"
                    >
                      <v-spacer></v-spacer>
                      <v-btn @click="date_modal = false">
                        Cancel
                      </v-btn>
                      <v-btn
                        color="primary"
                        @click="
                          errors['date'] = null;
                          $refs.date_dialog.save(
                            form.date
                          )
                        "
                      >
                        OK
                      </v-btn>
                    </v-date-picker>
                  </v-dialog>
                </v-col>
                <v-col cols="12" sm="4">
                  <v-text-field
                    label="Value*"
                    prefix="%"
                    v-model="form.return"
                    :error="!!errors['return']"
                    :error-messages="errors['return']"
                    @change="errors['return'] = null"
                  ></v-text-field>
                </v-col>
                <v-col cols="12" sm="4">
                  <v-btn
                    color="primary"
                    @click="calculateValue"
                  >
                    Calculate
                  </v-btn>
                </v-col>

              </v-row>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-btn @click="resetForm">Cancel</v-btn>
            <v-spacer></v-spacer>
            <v-btn
              color="primary"
              @click="submit"
              :loading="loading"
              :disabled="loading"
            >
              <v-icon>mdi-content-save</v-icon>
              Submit
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
    <v-snackbar
      v-model="snackbar"
      :timeout="5000"
    >
      {{ snackbar_text }}

      <template v-slot:action="{ attrs }">
        <v-btn
          color="primary"
          text
          v-bind="attrs"
          @click="snackbar = false"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>
  </v-container>
</template>
<script>
import client from "@/client";
import {clone} from "@/utils/helpers";

export default {
  computed: {
    selected_user() {
      return this.$_.find(this.clients, {id: this.form.client_id});
    },
    fund_types() {
      if (this.form.client_id && this.selected_user) {
        return this.selected_user.permission;
      }
      return [];
    },
    investment_options() {
      if (this.selected_user) {
        return this.selected_user.investments;
      }
      return [];
    },
    selected_investment() {
      if (this.form.investment_id) {
        return this.$_.find(this.investment_options, {id: this.form.investment_id});
      }
      return null;
    },
    current_value() {
      if (this.selected_user && this.selected_investment) {
        let value = this.selected_investment.amount;
        let percentages = this.$_.map(this.selected_investment.cash_flows, 'return');
        this.$_.forEach(percentages, function (percentage) {
          value = value * (1 + (percentage / 100));
        });
        return value;
      }
      return '';
    },
  },
  methods: {
    submit() {
      this.loading = true;
      client({url: '/api/cash-flow', method: 'POST', data: this.form})
        .then(
          response => {
            this.loading = false;
            this.fetchClients();
            this.resetForm();
            this.snackbar_text = 'Successfully created the cashflow';
            this.snackbar = true;
          },
          error => {
            this.loading = false;
            this.setErrors(error.response.data);
          },
        )
        .catch(
          error => {
            this.loading = false;
          },
        );
    },
    fetchClients() {
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
    calculateValue() {
      if (isNaN(Number(this.form.return))) {
        bus.$emit('error-message', `The value you specified is not a number`);
        this.updated_value = '';
        return;
      }
      this.updated_value = Number(this.current_value)
        * (1 + Number(this.form.return) / 100);
    },
    resetForm() {
      this.form = Object.assign(clone(this.default_form), {});
      this.updated_value = '';
    },
    resetErrors() {
      this.errors = [];
    },
    setErrors(errors) {
      this.errors = errors;
    },
  },
  mounted() {
    this.resetForm();
    this.fetchClients();
  },
  data() {
    return {
      loading: false,
      updated_value: "",
      form: {},
      errors: [],
      default_form: require("@/config/default_cash_flow_form"),
      date_modal: false,
      clients: [],
      snackbar: false,
      snackbar_text: '',
    }
  }
}
</script>
