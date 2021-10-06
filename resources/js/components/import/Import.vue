<template>
    <div>
        <div class="flex flex-col justify-center py-12 sm:px-6 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-md">
                <h2 class="mt-6 text-center text-3xl font-extrabold text-white">
                    <span class="text-red-600">Invoice</span> Import
                </h2>
            </div>
            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="bg-white py-8 px-4 shadow rounded-lg sm:px-10">
                    <form
                        @submit.prevent="submitForm"
                        class="space-y-6"
                        action="#"
                        method="POST"
                    >
                        <div>
                            <label
                                for="file"
                                class="block text-sm font-medium text-gray-700"
                            >
                                File (*.csv)
                            </label>
                            <div class="mt-1">
                                <input
                                    id="file"
                                    type="file"
                                    accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                    required
                                    ref="file"
                                    class="
                                        appearance-none
                                        block
                                        w-full
                                        rounded-md
                                        placeholder-gray-400
                                        focus:outline-none
                                        focus:ring-blue-500
                                        focus:border-blue-500
                                        sm:text-sm
                                    "
                                    @change="setChange"
                                />
                            </div>
                            <span
                                v-if="file"
                                class="block my-1 text-gray-600"
                                >{{ file.name }}</span
                            >
                        </div>
                        <div>
                            <button
                                :disabled="!file"
                                type="submit"
                                class="
                                    w-full
                                    flex
                                    justify-center
                                    items-center
                                    py-2
                                    px-4
                                    border border-transparent
                                    rounded-md
                                    shadow-sm
                                    text-sm
                                    font-medium
                                    text-white
                                    bg-blue-600
                                    hover:bg-blue-700
                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-offset-2
                                    focus:ring-blue-500
                                "
                                :class="[
                                    loading && 'bg-opacity-70',
                                    !file && 'bg-opacity-70',
                                ]"
                            >
                                <span v-if="loading" class="mr-2">
                                    <loading-icon size="w-4 h-4" />
                                </span>
                                Upload and Import
                            </button>
                        </div>
                    </form>
                </div>
                <span v-if="errorMsg" class="block text-sm mt-2 text-red-600">
                    {{ errorMsg }}
                </span>
                <span
                    v-if="successMsg"
                    class="block text-sm mt-2 text-green-600"
                >
                    {{ successMsg }}
                </span>
            </div>
        </div>
    </div>
</template>

<script>
import LoadingIcon from "../shared/LoadingIcon";
export default {
    name: "Import",
    components: { LoadingIcon },
    data() {
        return {
            file: null,
            errorMsg: "",
            successMsg: "",
        };
    },
    computed: {
        loading() {
            return this.$store.state.invoice.loading;
        },
    },
    methods: {
        setChange(e) {
            console.log(e);
            this.file = this.$refs.file.files[0];
            console.log(this.file);
        },
        submitForm() {
            let formData = new FormData();
            formData.append("file", this.file);
            this.errorMsg = "";
            this.successMsg = "";
            this.$store
                .dispatch("invoice/import", formData)
                .then((res) => {
                    if (res.data && res.data.message) {
                        this.successMsg = res.data.message;
                    }
                })
                .catch((err) => {
                    if (
                        err.response &&
                        err.response.data &&
                        err.response.data.error
                    ) {
                        this.errorMsg = err.response.data.error;
                    } else {
                        this.errorMsg = "An error occurred";
                    }
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
