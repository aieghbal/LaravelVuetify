<script setup>
import { ref } from 'vue'
const greeting = ref('Hello World!')
</script>

<template>
    <p class="greeting">{{ greeting }}</p>
    <p>Message is: {{ message }}</p>
    <input v-model="message" placeholder="edit me" />

    <span>Multiline message is:</span>
    <p style="white-space: pre-line;">{{ message }}</p>
    <textarea v-model="message" placeholder="add multiple lines"></textarea>
</template>

<style>
.greeting {
    color: red;
    font-weight: bold;
}
</style>
