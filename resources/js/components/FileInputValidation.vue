<!--
<template>
  <v-file-input
      :rules="rules"
      accept="image/png, image/jpeg, image/bmp"
      :placeholder='$t("choose_picture")'
      prepend-icon="mdi-camera"
      :label='$t("choose_picture")'
  ></v-file-input>
    <div style="height: 500px; width: 500px; border: 1px solid red; position: relative;">
        <vue-draggable-resizable style="background-color: aqua">
            <p>Hello! I'm a flexible component. You can drag me around and you can resize me.</p>
        </vue-draggable-resizable>
    </div>
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
import VueDraggableResizable from 'vue-draggable-resizable'
export default {
    components: {VueDraggableResizable},
  data: () => ({
    rules: [
      value => {
        return !value || !value.length || value[0].size < 2000000 || t('max_picture_size_message')
      },
    ],
  }),
}
</script>
<style>
@import "vue-draggable-resizable/style.css";
</style>
-->
<template>
    <div style="height: 500px; width: 500px; border: 1px solid red; position: relative;">
        <vue-draggable-resizable :w="100" :h="100">
            <p>Hello! I'm a flexible component. You can drag me around and you can resize me.</p>
        </vue-draggable-resizable>
    </div>
</template>


<script>
import VueDraggableResizable from 'vue-draggable-resizable'

export default {
    name: 'app',

    components: {
        VueDraggableResizable
    },
}
</script>
<style>
@import "vue-draggable-resizable/style.css";
</style>
