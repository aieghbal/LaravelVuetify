<script setup>
import { ref, onBeforeMount, onBeforeUnmount } from 'vue'
import 'jspanel4/dist/jspanel.min.css'
import { jsPanel } from 'jspanel4'


const jsPanelRef = ref(null)


const createPanel = () => {
  jsPanel.create({
    content: `
      <form>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br><br>
        <button type="submit">Submit</button>
      </form>
    `,
  })
}


const destroyPanel = () => {
  jsPanelRef.value.close()
}

onBeforeMount(() => {
  jsPanelRef.value = createPanel()
})
const openJsPanel =()=>{
  jsPanelRef.value = createPanel()
}
// Destroy the jsPanel instance when the component is unmounted
onBeforeUnmount(() => {
  destroyPanel()
})
</script>
<template>

  <button @click="openJsPanel">Create jsPanel</button>
</template>