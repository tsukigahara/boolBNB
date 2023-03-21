<script>
import Jumbotron from './Jumbotron.vue';


export default {
    components: {
        Jumbotron,
    },

    props: {
        jumbo: Boolean,
    },


}
</script>

<template>
    <nav class="p-3">
        <div class="d-flex justify-content-between align-items-center">
            <a :href="route('welcome')">
                <img class="logo" src="./img//bool.png" alt="">
            </a>

            <div class="dropdown">
                <button class="btn_user" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    menu
                </button>
                <ul class="dropdown-menu">
                    <div v-if="$page.props.auth.user">
                        <li>
                            <a class="dropdown-item" :href="route('dashboard')">
                                Dashboard</a>
                        </li>
                    </div>
                    <template v-else>
                        <li>
                            <a class="dropdown-item" :href="route('register')">
                                Register</a>
                        </li>
                        <li>
                            <a class="dropdown-item" :href="route('login')">
                                Login</a>
                        </li>
                    </template>
                </ul>
            </div>
        </div>

        <Jumbotron v-if="jumbo" />
    </nav>
</template>

<style scoped lang="scss">
.logo {
    width: 20%;
}

.btn_user {
    padding: 5px;
    border-radius: 40px;
    border: 1px solid grey;
}
</style>


