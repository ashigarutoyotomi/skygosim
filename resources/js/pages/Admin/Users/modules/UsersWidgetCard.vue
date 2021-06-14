<template>
    <div class="dashboard-article-card bg-white shadow-sm rounded-3 py-3 px-3">
        <div class="dashboard-article-card__title">
            <h6 class="text-secondary">
                Users
            </h6>
        </div>

        <div class="dashboard-article-card__body">
            <ul class="dashboard-article-card__info-list">
                <li>
                    <span class="text-secondary">
                        Users count
                    </span>
                    <span>
                        {{ usersCount }}
                    </span>
                </li>
                <li>
                    <span class="text-secondary">
                        Sims
                    </span>
                    <span>
                        {{ usersSimsCount }}
                    </span>
                </li>
                <li>
                    <span class="text-secondary">
                        Internet packages
                    </span>
                    <span>
                        {{ usersInternetPackagesCount }}
                    </span>
                </li>
            </ul>
        </div>

        <div class="dashboard-article-card__actions">
            <button
                type="submit"
                class="btn btn-light btn-sm"
                @click="$router.push('/users/create')"
            >
                Add new
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UsersWidgetCard",

        data() {
            return {
                usersCount: 0,
                usersSimsCount: 0,
                usersInternetPackagesCount: 0
            }
        },

        created() {
            this.loadData();
        },

        methods: {
            loadData() {
                axios.get('/users/widget-load-data')
                    .then(res => {
                        this.usersCount = res.data.usersCount;
                        this.usersSimsCount = res.data.usersSimsCount;
                        this.usersInternetPackagesCount = res.data.usersInternetPackagesCount;
                    });
            }
        }
    }
</script>

<style lang="scss">

</style>
