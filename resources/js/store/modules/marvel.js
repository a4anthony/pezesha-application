const marvel = {
    state: () => ({
        characters: null,
        from: 0,
        to: 0,
        total: 0,
        resultString: "",
        loading: false,
        currentPage: 0,
        lastPage: 0,
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
        setFrom(state, data) {
            state.from = data;
        },
        setTo(state, data) {
            state.to = data;
        },
        setTotal(state, data) {
            state.total = data;
        },
        setCurrentPage(state, data) {
            state.currentPage = data;
        },
        setLastPage(state, data) {
            state.lastPage = data;
        },
    },
    actions: {
        getCharacters({ commit }, filters) {
            const url = route("get.marvel");
            commit("setLoading", true);
            return new Promise((resolve, reject) => {
                axios
                    .get(
                        `${url}?page=${filters.page}&length=${filters.length}&orderBy=${filters.orderBy}&query=${filters.query}`
                    )
                    .then((response) => {
                        localStorage.setItem(
                            "filters",
                            JSON.stringify(filters)
                        );
                        console.log(response.data);
                        commit("setLoading", false);
                        commit("setCharacters", response.data.data);
                        commit("setTotal", response.data.total);
                        commit("setFrom", response.data.from);
                        commit("setTo", response.data.to);
                        commit("setCurrentPage", response.data.current_page);
                        commit("setLastPage", response.data.last_page);
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
