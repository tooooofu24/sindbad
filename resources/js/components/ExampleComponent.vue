<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">I'm an example component.</div>
                    <div class="text-center m-2">
                        <button class="btn btn-primary" @click="login">
                            ログイン
                        </button>
                    </div>
                    <div class="text-center m-2">
                        <button class="btn btn-primary" @click="api">
                            APIテスト
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
        login: function () {
            console.log("test");
            axios.get("/sanctum/csrf-cookie").then((res) => {
                axios.post("/api/web-login", {});
            });
        },
        api: function () {
            axios.get("/api/v0/spots").then((res) => {
                console.log(res);
            });
        },
    },
    mounted() {
        console.log("Component mounted.");
    },
};
</script>
