<script>
export default {
}
</script>

<template>
    <nav class="p-3">
        <div class="d-flex justify-content-between">
            <a href="#">
                <img class="logo" src="./img/580b57fcd9996e24bc43c513.png" alt="">
            </a>

            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

            <div class="dropdown">
                <button id="btn_user" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    menu
                </button>
                <ul class="dropdown-menu">
                    <div v-if="$page.props.auth.user">
                        <li>
                            <Link class="dropdown-item" :href="route('dashboard')">
                            Dashboard</Link>
                        </li>
                    </div>
                    <template v-else>
                        <li>
                            <Link class="dropdown-item" :href="route('register')">
                            Register</Link>
                        </li>
                        <li>
                            <Link class="dropdown-item" :href="route('login')">
                            Login</Link>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </nav>
</template>

<style scoped lang="scss">
.logo {
    width: 100px;
}

#btn_user {
    padding: 5px;
    border-radius: 40px;
    border: 1px solid grey;
}
</style>




