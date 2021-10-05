<template>
    <div
        class="
            flex
            space-x-0
            sm:space-x-4
            justify-start
            text-gray-700
            flex-wrap
        "
    >
        <div class="mr-4 sm:mr-0">
            <label
                for="length"
                class="block text-xs capitalize font-medium text-gray-200"
                >Length</label
            >
            <select
                id="length"
                name="length"
                v-model.number="filters.length"
                class="
                    mt-1
                    block
                    w-full
                    pl-3
                    pr-10
                    py-2
                    text-base
                    border-gray-300
                    focus:outline-none focus:ring-red-500 focus:border-red-500
                    sm:text-sm
                    rounded-md
                "
            >
                <option v-for="length in [5, 10, 15, 20, 30]" :value="length">
                    {{ length }}
                </option>
            </select>
        </div>
        <div>
            <label
                for="orderBy"
                class="block text-xs capitalize font-medium text-gray-200"
                >Order By</label
            >
            <select
                id="orderBy"
                name="orderBy"
                v-model="filters.orderBy"
                class="
                    mt-1
                    block
                    w-full
                    pl-3
                    pr-10
                    py-2
                    text-base
                    border-gray-300
                    focus:outline-none focus:ring-red-500 focus:border-red-500
                    sm:text-sm
                    rounded-md
                "
            >
                <option v-for="length in ['name', 'modified']" :value="length">
                    {{ length }}
                </option>
            </select>
        </div>
        <div class="flex-none w-full sm:w-60 mt-2 sm:mt-0">
            <label
                for="search"
                class="block text-xs capitalize font-medium text-gray-200"
                >Search</label
            >
            <input
                type="text"
                name="search"
                id="search"
                class="
                    mt-1
                    shadow-sm
                    focus:ring-red-500 focus:border-red-500
                    block
                    w-full
                    sm:text-sm
                    border-gray-300
                    rounded-md
                "
                placeholder="search character by name"
            />
        </div>
    </div>
</template>

<script>
export default {
    name: "MarvelFilters",
    data() {
        return {
            filters: {
                length: 20,
                orderBy: "name",
                query: "",
            },
        };
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
