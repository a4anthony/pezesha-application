import { createStore } from "vuex";

import marvel from "./modules/marvel";
import invoice from "./modules/invoice";
const store = createStore({
    state: {},
    getters: {},
    mutations: {},
    actions: {},
    modules: {
        marvel,
        invoice,
    },
});

export default store;
