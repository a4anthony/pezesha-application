<template>
    <div>
        <div>
            <span class="text-xl sm:text-4xl font-bold text-white">
                <span class="text-red-600">Marvel</span> Characters</span
            >
        </div>
        <div class="mt-8">
            <marvel-filters />
        </div>
        <div v-show="!loading" class="my-4">
            <span class="text-sm text-gray-400 font-semibold">{{
                resultString
            }}</span>
        </div>
        <div class="mt-4">
            <marvel-characters />
        </div>
    </div>
</template>

<script>
import MarvelCharacters from "./MarvelCharacters";
import MarvelFilters from "./MarvelFilters";
export default {
    name: "Marvel",
    components: { MarvelFilters, MarvelCharacters },
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
    },
    mounted() {
        console.log(this.$store);
        this.$store.dispatch("marvel/getCharacters");
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
