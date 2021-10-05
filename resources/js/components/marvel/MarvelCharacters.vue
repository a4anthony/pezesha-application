<template>
    <div>
        <div
            v-if="!loading && characters && characters.length === 0"
            class="flex w-full justify-center items-center"
            style="min-height: 55vh"
        >
            <span>No search results</span>
        </div>
        <div
            v-if="loading"
            class="flex w-full justify-center items-center"
            style="min-height: 55vh"
        >
            <loading-icon />
        </div>
        <div
            v-else
            class="
                grid grid-cols-2
                md:grid-cols-4
                lg:grid-cols-6
                gap-4
                sm:gap-6
            "
        >
            <div
                v-for="(char, index) in characters"
                :key="`char${index}`"
                class="relative character-card"
            >
                <div>
                    <div
                        :style="{
                            height: `${imgWidth}px`,
                        }"
                        class="rounded-md"
                    >
                        <img
                            :src="`${char.thumbnail.path}.${char.thumbnail.extension}`"
                            :alt="`character_${char.id}`"
                            class="h-full w-full rounded-md"
                        />
                    </div>
                    <div class="mt-2">
                        <span
                            class="
                                text-sm
                                sm:text-base
                                text-gray-50
                                font-semibold
                                block
                                truncate
                            "
                            >{{ char.name }}
                        </span>
                        <div class="mt-2">
                            <span class="text-gray-300 text-sm block"
                                >Series: {{ char.series.available }}</span
                            >
                            <span class="text-gray-300 text-sm block"
                                >Comics: {{ char.comics.available }}</span
                            >
                            <span class="text-gray-300 text-sm block"
                                >Stories: {{ char.stories.available }}</span
                            >
                            <span class="text-gray-300 text-sm block"
                                >Events: {{ char.events.available }}</span
                            >
                        </div>
                    </div>
                </div>
                <!--<span-->
                <!--    class="w-3 h-3 block bg-black absolute top-0 right-0"-->
                <!--&gt;</span>-->
            </div>
        </div>
    </div>
</template>

<script>
import VClamp from "vue-clamp";
import LoadingIcon from "../shared/LoadingIcon";

export default {
    name: "MarvelCharacters",
    components: {
        LoadingIcon,
        VClamp,
    },
    computed: {
        loading() {
            return this.$store.state.marvel.loading;
        },
        characters() {
            return this.$store.state.marvel.characters;
        },
    },
    data() {
        return {
            imgWidth: 0,
            showCharacters: false,
        };
    },
    watch: {
        loading: {
            handler(val) {
                if (!val) {
                    setTimeout(() => {
                        if (document.querySelector(".character-card")) {
                            this.imgWidth =
                                document.querySelector(
                                    ".character-card"
                                ).clientWidth;
                        }
                    }, 200);
                    setTimeout(() => {
                        this.showCharacters = true;
                    }, 300);
                } else {
                    this.showCharacters = false;
                }
            },
            deep: true,
        },
    },
    mounted() {},
    created() {
        window.addEventListener("resize", () => {
            if (document.querySelector(".character-card")) {
                this.imgWidth =
                    document.querySelector(".character-card").clientWidth;
            }
        });
    },
    unmounted() {
        window.removeEventListener("resize", () => {});
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
