const invoice = {
    state: () => ({
        loading: false,
    }),
    mutations: {
        setLoading(state, data) {
            state.loading = data;
        },
    },
    actions: {
        import({ commit }, form) {
            const url = route("invoice.import");
            console.log(url);
            commit("setLoading", true);
            return new Promise((resolve, reject) => {
                axios
                    .post(url, form)
                    .then((response) => {
                        console.log(response.data);
                        commit("setLoading", false);
                        resolve(response);
                    })
                    .catch((err) => {
                        commit("setLoading", false);
                        reject(err);
                    });
            });
        },
    },
    getters: {},
    namespaced: true,
};

export default invoice;
