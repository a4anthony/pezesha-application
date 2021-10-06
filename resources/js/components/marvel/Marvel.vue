<template>
    <div>
        <div>
            <span class="text-xl sm:text-4xl font-bold text-white">
                <span class="text-red-600">Marvel</span> Characters</span
            >
        </div>
        <div class="mt-8">
            <marvel-filters @get-data="getData" ref="marvelFilters" />
        </div>
        <div
            :class="
                !loading && characters && characters.length > 0
                    ? 'justify-between'
                    : 'justify-end'
            "
            class="my-4 flex w-full items-center"
        >
            <span
                v-show="!loading && characters && characters.length > 0"
                class="text-sm text-gray-400 font-semibold"
                >{{ resultString }}
            </span>
            <button
                type="button"
                @click="$refs.marvelFilters.reset()"
                class="
                    inline-flex
                    items-center
                    px-2
                    py-1
                    border border-transparent
                    text-xs
                    font-medium
                    rounded-full
                    shadow-sm
                    text-white
                    bg-red-600
                    hover:bg-red-700
                    focus:outline-none
                    focus:ring-2
                    focus:ring-offset-2
                    focus:ring-red-500
                "
            >
                &times; reset
            </button>
        </div>
        <div class="mt-4">
            <marvel-characters />
        </div>
        <div class="mt-8">
            <pagination
                @set-page="setPage"
                :current-page="currentPage"
                :last-page="lastPage"
            />
        </div>
    </div>
</template>

<script>
import MarvelCharacters from "./MarvelCharacters";
import MarvelFilters from "./MarvelFilters";
import Pagination from "../shared/Pagination";
export default {
    name: "Marvel",
    components: { Pagination, MarvelFilters, MarvelCharacters },
    computed: {
        loading() {
            return this.$store.state.marvel.loading;
        },
        characters() {
            return this.$store.state.marvel.characters;
        },
        resultString() {
            return this.$store.state.marvel.resultString;
        },
        currentPage() {
            return this.$store.state.marvel.currentPage;
        },
        lastPage() {
            return this.$store.state.marvel.lastPage;
        },
    },
    mounted() {
        console.log(this.$store);
        console.log(this.$refs.marvelFilters.filters);
    },
    methods: {
        getData(val) {
            console.log(val);
            this.$store
                .dispatch("marvel/getCharacters", val)
                .then(() => {
                    if (history.pushState) {
                        const newUrl =
                            window.location.protocol +
                            "//" +
                            window.location.host +
                            window.location.pathname +
                            `?page=${val.page}&length=${val.length}&orderBy=${val.orderBy}&query=${val.query}`;
                        window.history.pushState({ path: newUrl }, "", newUrl);
                    }
                })
                .catch(() => {});
        },
        setPage(val) {
            window.scrollTo({
                top: 0,
                left: 0,
                behavior: "smooth",
            });
            setTimeout(() => {
                this.$refs.marvelFilters.filters.page = val;
            }, 300);
        },
    },
};
</script>

<style scoped>
/* (1366x768) WXGA Display */

@media screen and (min-width: 1366px) and (max-width: 1919px) {
}

@media (min-width: 1198px) and (max-width: 1365.9px) {
}

/* Normal desktop :992px. */

@media (min-width: 992px) and (max-width: 1197px) {
}

/* Normal desktop :991px. */

@media (min-width: 768px) and (max-width: 991px) {
}

/* small mobile :576px. */

@media (min-width: 576px) and (max-width: 767px) {
}

/* extra small mobile 320px. */

@media (max-width: 575px) {
}

/* Large Mobile :480px. */

@media only screen and (min-width: 480px) and (max-width: 575px) {
}

@media only screen and (max-width: 575px) and (min-width: 480px) {
}
</style>
