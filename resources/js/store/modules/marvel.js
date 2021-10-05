const marvel = {
    state: () => ({
        characters: null,
        from: null,
        to: null,
        total: null,
        resultString: "",
        loading: false,
    }),
    mutations: {
        setLoading(state, data) {
            state.loading = data;
        },
        setCharacters(state, data) {
            state.characters = data;
        },
        setResultString(state, data) {
            state.resultString = data;
        },
    },
    actions: {
        getCharacters({ commit }) {
            const url = route("get.marvel");
            commit("setLoading", true);
            return new Promise((resolve, reject) => {
                axios
                    .get(url)
                    .then((response) => {
                        console.log(response.data);
                        commit("setLoading", false);
                        commit("setCharacters", response.data.data);
                        commit(
                            "setResultString",
                            `Showing ${response.data.from} to  ${response.data.to} of  ${response.data.total}`
                        );
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

export default marvel;
