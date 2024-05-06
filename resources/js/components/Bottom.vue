<script setup>
import { ref } from 'vue'
import { useI18n } from 'vue-i18n'
const sheet = ref(false)
const { t } = useI18n()

</script>
<template>
  <div class="text-center">
    <v-btn
        size="x-large"
        @click="sheet = !sheet"
    >{{ $t("bottom_click_on_me") }}</v-btn>

    <v-bottom-sheet v-model="sheet">
      <v-card
          class="text-center"
          height="200"
      >
        <v-card-text>
          <v-btn
              variant="text"
              @click="sheet = !sheet"
          >
            {{ $t("close") }}
          </v-btn>

          <br>
          <br>

          <div>
            {{ $t("bottom_click_on_me_message") }}
          </div>
        </v-card-text>
      </v-card>
    </v-bottom-sheet>
  </div>
</template>


<script>
export default {
  data: () => ({
    sheet: false,
  }),
}
</script>