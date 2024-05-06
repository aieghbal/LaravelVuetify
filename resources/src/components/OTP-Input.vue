<template>
  <v-card
      class="py-8 px-6 text-center mx-auto ma-4"
      elevation="12"
      max-width="400"
      width="100%"
  >
    <h3 class="text-h6 mb-4">{{ $t("account_verification") }}</h3>

    <div class="text-body-2">
      {{ $t("account_verification_message") }}<br>
      {{ $t("account_verification_message2") }}
    </div>

    <v-sheet color="surface">
      <v-otp-input
          v-model="otp"
          type="password"
          variant="solo"
      ></v-otp-input>
    </v-sheet>

    <v-btn
        class="my-4"
        color="purple"
        height="40"
        :text='$t("validation")'
        variant="flat"
        width="70%"
    ></v-btn>

    <div class="text-caption">
      {{ $t("dont_get_code") }} <a href="#" @click.prevent="otp = ''">{{ $t("resend") }}</a>
    </div>
  </v-card>
</template>

<script setup>
import { shallowRef } from 'vue'

const otp = shallowRef('')
import { useI18n } from 'vue-i18n'
const { t } = useI18n()
</script>

<script>
export default {
  data: () => ({
    otp: '',
  }),
}
</script>