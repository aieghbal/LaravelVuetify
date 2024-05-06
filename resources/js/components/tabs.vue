<script setup>
import Bottom from './Bottom.vue'
import FileInputValidation from './FileInputValidation.vue'
import FormValidation from './FormValidation.vue'
import OTP_Input from './OTP-Input.vue'
import Selects from './Selects.vue'
import DataTable from './DataTable.vue'
import ServerSideDataTable from './ServerSideDataTable.vue'
import Carousel from './Carousel.vue'
import Steppers from './Steppers.vue'
import LocaleSelect from "./LocaleSelect.vue";
import FormDialog from "./FormDialog.vue";
//import jsPanelComponent from "./jsPanel.vue";
import customPanel from "./customPanel.vue";
import { useI18n } from 'vue-i18n'
import CustomPanel from "./customPanel.vue";
const { t } = useI18n()
</script>
<template>
  <br>
  <div style="padding-bottom: 5%;">
    <LocaleSelect />
  </div>

  <v-card >
    <v-tabs
        v-model="tab"
        bg-color="primary"
    >
<!--      <v-tab value="one">{{ $t("bottom") }}</v-tab>-->
      <v-tab value="two">{{ $t("input_validation") }}</v-tab>
      <v-tab value="three">{{ $t("form_validation") }}</v-tab>
      <v-tab value="next1">{{ $t("confirm_code") }}</v-tab>
<!--      <v-tab value="next2">{{ $t("Selects") }}</v-tab>-->
      <v-tab value="next3">{{ $t("datatable") }}</v-tab>
      <v-tab value="next4">{{ $t("server_datatable") }}</v-tab>
      <v-tab value="next5">{{ $t("slider") }}</v-tab>
      <v-tab value="next6">{{ $t("level") }}</v-tab>
<!--      <v-tab value="next7">{{ $t("formDialog") }}</v-tab>-->
<!--      <v-tab value="next8">{{ $t("jsPanelDatatable") }}</v-tab>-->
<!--      <v-tab value="next7">{{ $t("jsPanelDatatable") }}</v-tab>-->
      <v-tab value="next8">customPanel</v-tab>
    </v-tabs>

    <v-card-text>
      <v-window v-model="tab">
<!--        <v-window-item value="one">
          <Bottom/><br>
        </v-window-item>-->

        <v-window-item value="two">
          <FileInputValidation/>
        </v-window-item>

        <v-window-item value="three">
          <FormValidation/><br>
        </v-window-item>

        <v-window-item value="next1">
          <OTP_Input/><br>
        </v-window-item>

<!--        <v-window-item value="next2">
          <Selects/><br>
        </v-window-item>-->

        <v-window-item value="next3">
          <DataTable/><br>
        </v-window-item>

        <v-window-item value="next4">
          <ServerSideDataTable/><br>
        </v-window-item>

        <v-window-item value="next5">
          <Carousel/><br>
        </v-window-item>

        <v-window-item value="next6">
          <Steppers/><br>
        </v-window-item>

<!--          <v-window-item value="next7">
              <FormDialog/><br>
          </v-window-item>-->
<!--          <v-window-item value="next7">
              <jsPanelComponent/><br>
          </v-window-item>-->
          <v-window-item value="next8">
              <CustomPanel/><br>
          </v-window-item>
      </v-window>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  data: () => ({
    tab: null,
  }),
}
</script>
