<template>
  <form @submit.prevent="submit">
    <v-text-field
        v-model="name.value.value"
        v-maska:[optionsName]
        :counter="10"
        :error-messages="name.errorMessage.value"
        :label='$t("name")'
        :class="{ 'success': success_name }"
    ></v-text-field>

    <v-text-field
        v-model="phone.value.value"
        :counter="7"
        v-maska:[optionsPhone]
        :error-messages="phone.errorMessage.value"
        :label='$t("phone_number")'
        :class="{ 'success': success_phone }"
    ></v-text-field>

    <v-text-field
        v-model="email.value.value"
        :error-messages="email.errorMessage.value"
        :label='$t("email")'
        :class="{ 'success': success_email }"
    ></v-text-field>

    <v-select
        v-model="select.value.value"
        :items="items"
        :error-messages="select.errorMessage.value"
        :label='$t("Selects")'
        :class="{ 'success': success_select }"
    ></v-select>

    <v-checkbox
        v-model="checkbox.value.value"
        :error-messages="checkbox.errorMessage.value"
        value="1"
        :label='$t("option")'
        :class="{ 'success': success_checkbox }"
        type="checkbox"
        class="options"
    ></v-checkbox>

    <v-btn
        class="me-4"
        type="submit"
    >
      {{ $t("submit") }}
    </v-btn>

    <v-btn @click="handleReset">
      {{ $t("clear") }}
    </v-btn>
  </form>

</template>

<script setup>
import { ref } from 'vue'
import { useField, useForm } from 'vee-validate'

import { vMaska } from "maska";

import { useI18n } from 'vue-i18n'
const { t } = useI18n()

const optionsPhone = { mask: '###-###-#####' };
const optionsName = { mask: '@@@@@@@@@@@@@@@@@' };

const success_name = ref(1);
const success_phone = ref(1);
const success_email = ref(1);
const success_select = ref(1);
const success_checkbox = ref(1);
const { handleSubmit, handleReset } = useForm({
  validationSchema: {
    name (value) {
      if (value?.length >= 2) {
        success_name.value = true
        return true
      }
      success_name.value = false
      return t('min_name_message')
    },
    phone (value) {
      if (value?.length > 9 && /[0-9-]+/.test(value)) {
        success_phone.value = true
        return true
      }
      success_phone.value = false
      return t('min_phone_message')
    },
    email (value) {
      if (/^[a-z.-]+@[a-z.-]+\.[a-z]+$/i.test(value)) {
        success_email.value = true
        return true
      }
      success_email.value = false
      return t('email_validation_message')
    },
    select (value) {
      if (value) {
        success_select.value = true;
        return true
      }
      success_select.value = false;
      return t('require_choose_message')
    },
    checkbox (value) {
      if (value === '1') {
        success_checkbox.value = true;
        return true
      }
      success_checkbox.value = false;
      return t('checkbox_require_message')
    },
  },
})
const name = useField('name')
const phone = useField('phone')
const email = useField('email')
const select = useField('select')
const checkbox = useField('checkbox')

const items = ref([
  t('option1'),
  t('option2'),
  t('option3'),
  t('option4'),
])


const submit = handleSubmit(values => {
  alert(JSON.stringify(values, null, 2))
})
</script>
<style scoped>
input:valid {
  border-color: green;
}

input:invalid {
  border-color: yellow;
}
</style>
