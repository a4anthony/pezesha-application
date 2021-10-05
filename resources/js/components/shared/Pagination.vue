<template>
    <nav
        class="
            border-t border-gray-200
            px-4
            flex
            items-center
            justify-between
            sm:px-0
        "
    >
        <div class="-mt-px w-0 flex-1 flex">
            <button
                @click="setPage(currentPage - 1)"
                type="button"
                class="
                    border-t-2 border-transparent
                    pt-4
                    pr-1
                    inline-flex
                    items-center
                    text-sm
                    font-medium
                    text-gray-500
                    hover:text-red-700 hover:border-gray-300
                "
            >
                <ArrowNarrowLeftIcon
                    class="mr-3 h-5 w-5 text-gray-400"
                    aria-hidden="true"
                />
                <span>Previous</span>
            </button>
        </div>
        <div class="hidden md:-mt-px md:flex">
            <button
                v-for="page in pages"
                @click="setPage(page)"
                type="button"
                class="
                    border-t-2
                    pt-4
                    px-4
                    inline-flex
                    items-center
                    text-sm
                    font-medium
                "
                :class="
                    page === currentPage
                        ? 'border-red-500 text-red-600'
                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                "
                :disabled="page === currentPage"
            >
                {{ page }}
            </button>
        </div>
        <div class="-mt-px w-0 flex-1 flex justify-end">
            <button
                @click="setPage(currentPage + 1)"
                type="button"
                class="
                    border-t-2 border-transparent
                    pt-4
                    pl-1
                    inline-flex
                    items-center
                    text-sm
                    font-medium
                    text-gray-500
                    hover:text-gray-700 hover:border-gray-300
                "
            >
                <span>Next</span>
                <ArrowNarrowRightIcon
                    class="ml-3 h-5 w-5 text-gray-400"
                    aria-hidden="true"
                />
            </button>
        </div>
    </nav>
</template>

<script>
import {
    ArrowNarrowLeftIcon,
    ArrowNarrowRightIcon,
} from "@heroicons/vue/solid";
export default {
    name: "Pagination",
    components: {
        ArrowNarrowLeftIcon,
        ArrowNarrowRightIcon,
    },
    props: {
        currentPage: {
            type: Number,
            required: true,
        },
        lastPage: {
            type: Number,
            required: true,
        },
        json: {
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            pages: [1, 2, 3, 4, 5, 6, 7],
            postPages: [],
        };
    },
    watch: {
        currentPage: {
            handler(val) {
                this.getPageNumbers();
            },
            deep: true,
        },
        lastPage: {
            handler(val) {
                this.getPageNumbers();
            },
            deep: true,
        },
    },
    mounted() {
        this.getPageNumbers();
    },
    methods: {
        setPage(page) {
            this.$emit("set-page", page);
        },
        getPageNumbers() {
            this.pages = [1, 2, 3, 4, 5, 6, 7];
            this.postPages = [];
            if (this.lastPage <= 7) {
                this.pages = [];
                for (let i = 1; i <= this.lastPage; i++) {
                    this.pages.push(i);
                }
                return;
            }
            if (
                this.currentPage !== 1 &&
                this.currentPage !== 2 &&
                this.currentPage !== 3
            ) {
                this.pages = [
                    this.currentPage - 3,
                    this.currentPage - 2,
                    this.currentPage - 1,
                    this.currentPage,
                    this.currentPage + 1,
                    this.currentPage + 2,
                    this.currentPage + 3,
                ];
            }
            if (this.currentPage === this.lastPage) {
                this.pages = [
                    this.currentPage - 6,
                    this.currentPage - 4,
                    this.currentPage - 4,
                    this.currentPage - 3,
                    this.currentPage - 2,
                    this.currentPage - 1,
                    this.currentPage,
                ];
            }
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
