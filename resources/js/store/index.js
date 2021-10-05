import { createStore } from "vuex";

import marvel from "./modules/marvel";
const store = createStore({
    state: {},
    getters: {},
    mutations: {},
    actions: {},
    modules: {
        marvel,
    },
});

export default store;
