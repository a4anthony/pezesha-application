<template>
    <div>
        <div class="bg-black flex justify-center space-x-6 py-8">
            <button
                v-for="(btn, index) in tasks"
                :key="`btn${index}`"
                type="submit"
                @click="setTab(btn.key)"
                :class="[
                    btn.current
                        ? `bg-red-600 text-white`
                        : 'text-gray-500 hover:text-gray-700',
                    ' px-3 py-2 font-medium text-sm rounded-md w-20 flex-none text-center',
                ]"
            >
                {{ btn.name }}
            </button>
        </div>
        <div class="mx-auto container py-12">
            <marvel v-if="tasks.find((x) => x.current).key === 'task_1'" />
            <import v-if="tasks.find((x) => x.current).key === 'task_2'" />
        </div>
    </div>
</template>

<script>
import Marvel from "./marvel/Marvel";
import Import from "./import/Import";
export default {
    name: "App",
    components: { Import, Marvel },
    data() {
        return {
            tasks: [
                {
                    name: "Task 1",
                    key: "task_1",
                    current: true,
                },
                {
                    name: "Task 2",
                    key: "task_2",
                    current: false,
                },
            ],
        };
    },
    methods: {
        setTab(tabKey) {
            console.log(tabKey);
            console.log(this.tasks);
            // this.tasks[0].current = false;
            // this.tasks[1].current = true;
            console.log(this.tasks);
            this.tasks.forEach((tab) => {
                tab.current = tab.key === tabKey;
            });
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
