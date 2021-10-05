require("./bootstrap");

import { createApp } from "vue";

import App from "./components/App";
import store from "./store";
const app = createApp({
    components: {
        App,
    },
});
app.mixin({
    methods: {
        route,
    },
});
app.use(store);
app.mount("#app");
