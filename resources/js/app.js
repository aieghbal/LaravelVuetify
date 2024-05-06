import '../src/assets/main.css'

import { createApp } from 'vue'
import { createI18n } from 'vue-i18n'

import App from './App.vue'
const app = createApp(App)
import { aliases, mdi } from 'vuetify/iconsets/mdi'
import messages from "@intlify/unplugin-vue-i18n/messages";

import 'vuetify/styles'
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'


const i18n = createI18n({
    legacy: false,
    globalInjection: true,
    locale: "fa",
    fallbackLocale: "fa",
    availableLocales: ["fa", "en"],
    messages: messages,
});

const vuetify = createVuetify({
    components,
    directives,
    icons: {
        defaultSet: 'mdi',
        aliases,
        sets: {
            mdi,
        },
    },
})

app.use(i18n)
app.use(vuetify)
app.mount('#app')
