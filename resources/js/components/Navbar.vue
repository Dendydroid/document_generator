<template>
    <nav id="navbar_element" class="navbar navbar-expand-lg navbar-light fixed-top orange-stress-transparent">
        <a class="navbar-brand larafont-nav ml-2" href="/">Generator</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul :class="'navbar-nav w-100'+(!noUser && user.logged ? ' fb-around-align-center': '')">
                    <li class="nav-item dropdown li-stretch" v-if="!noUser && user.logged">
                        <a class="nav-link dropdown-toggle larafont-navlink" href="#" id="generateDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Генерировать
                        </a>
                        <div class="dropdown-menu" aria-labelledby="generateDropdown">
                            <a class="dropdown-item larafont-navlink-dropdown" href="/generate/zajavaIspit">Заява - Іспит</a>
                            <a class="dropdown-item larafont-navlink-dropdown" href="/generate/zvedenaVidomist">Зведена відомість</a>
                            <a class="dropdown-item larafont-navlink-dropdown" href="/generate/vpiskaOzinok">Виписка оцінок</a>
                            <a class="dropdown-item larafont-navlink-dropdown" href="/generate/vidomistMod1">Відомість (модуль 1)</a>
                            <a class="dropdown-item larafont-navlink-dropdown" href="/generate/vidomistMod2">Відомість (модуль 2)</a>
                            <a class="dropdown-item larafont-navlink-dropdown" href="/generate/vidomistKr">Відомість КР</a>
                        </div>

                    </li>
                    <li class="nav-item li-stretch" v-if="!noUser && user.logged">
                        <a class="nav-link larafont-navlink" href="/manage">База данных</a>
                    </li>
                    <li class="nav-item li-stretch" v-if="!noUser && user.logged">
                        <a class="nav-link larafont-navlink" href="/profile">Профиль</a>
                    </li>
                    <li class="nav-item dropdown li-stretch" v-if="!noUser && user.logged">
                        <a class="nav-link dropdown-toggle larafont-navlink" href="#" id="settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Настройки
                        </a>
                        <div class="dropdown-menu" aria-labelledby="settings">
                            <a class="dropdown-item larafont-navlink-dropdown" href="/settings">Основные</a>
                            <a v-if="user.isAdmin" class="dropdown-item larafont-navlink-dropdown" href="/settingsAdmin">Дополнительные настройки</a>
                            <a v-if="user.isAdmin" class="dropdown-item larafont-navlink-dropdown" href="/settingsUsers">Учетные записи</a>
                        </div>
                    </li>
                    <li class="nav-item li-stretch" v-if="noUser || user.isAdmin">
                        <a class="nav-link larafont-navlink" href="/register">Регистрация</a>
                    </li>
                    <li class="nav-item li-stretch" v-if="!user.logged && !noUser">
                        <a class="nav-link larafont-navlink" href="/login">Вход</a>
                    </li>
                    <li class="nav-item li-stretch" v-if="user.logged">
                        <a class="nav-link larafont-navlink" href="/logout">Выйти</a>
                    </li>
            </ul>
        </div>
    </nav>
</template>
<script>
    import axios from 'axios';

    axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };

    export default {
        name: 'Navbar',
        data () {
            return {
                noUser:false,
                user: {
                    firstName:'',
                    surname:'',
                    middleName:'',
                    email:'',
                    theme:'',
                    logged:false,
                    isAdmin:false,
                },
                snackbar: {
                    showSnackbar: false,
                    position: 'center',
                    duration: 4000,
                    bg: 'background-color:rgba(33, 33, 33, 0.6)'
                },
                errorMessage:''
            }
        },
        methods:{
            getUserSession(){
                axios
                    .post('/getUserSession', {
                    })
                    .then(response => {
                        this.user = response.data;
                    }).catch(e => {
                        this.errors.push(e.response.data.errors);
                    });
            },
            hasNoUsers() {
                axios
                    .post('/hasNoUsers', {
                    })
                    .then(response => (this.noUser = true))
                    .catch(e => {
                    });
            },
        },
        created() {
            this.getUserSession();
            this.hasNoUsers();
        }
    }
</script>
