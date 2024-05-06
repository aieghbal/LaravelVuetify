<template>
  <v-select
      chips
      v-model="favorites"
      :items="states"
      label="انتخابگر"
      multiple
      :hint='$t("favorite_province")'
      persistent-hint
      rounded
  ></v-select>
</template>

<script setup>
import { ref } from 'vue'

const favorites = ref([])
import { useI18n } from 'vue-i18n'
const { t } = useI18n()
const states = [
  t('khorasan_razavi'),
  t('tehran'),
  t('fars'),
  t('khorasan_jonobi'),
  t('shiraz'),
  t('esfahan'),
]
</script>

<script>
export default {
  data () {
    return {
      favorites: [],
      states: [
        'Alabama', 'Alaska', 'American Samoa', 'Arizona',
        'Arkansas', 'California', 'Colorado', 'Connecticut',
        'Delaware', 'District of Columbia', 'Federated States of Micronesia',
        'Florida', 'Georgia', 'Guam', 'Hawaii', 'Idaho',
        'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky',
        'Louisiana', 'Maine', 'Marshall Islands', 'Maryland',
        'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi',
        'Missouri', 'Montana', 'Nebraska', 'Nevada',
        'New Hampshire', 'New Jersey', 'New Mexico', 'New York',
        'North Carolina', 'North Dakota', 'Northern Mariana Islands', 'Ohio',
        'Oklahoma', 'Oregon', 'Palau', 'Pennsylvania', 'Puerto Rico',
        'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee',
        'Texas', 'Utah', 'Vermont', 'Virgin Island', 'Virginia',
        'Washington', 'West Virginia', 'Wisconsin', 'Wyoming',
      ],
    }
  },
}
</script>