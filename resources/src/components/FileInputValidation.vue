<template>
  <v-file-input
      :rules="rules"
      accept="image/png, image/jpeg, image/bmp"
      :placeholder='$t("choose_picture")'
      prepend-icon="mdi-camera"
      :label='$t("choose_picture")'
  ></v-file-input>
</template>

<script setup>
import { useI18n } from 'vue-i18n'
const { t } = useI18n()
const rules = [
  value => {
    return !value || !value.length || value[0].size < 2000000 || t('max_picture_size_message')
  },
]
</script>

<script>
export default {
  data: () => ({
    rules: [
      value => {
        return !value || !value.length || value[0].size < 2000000 || t('max_picture_size_message')
      },
    ],
  }),
}
</script>