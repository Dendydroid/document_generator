<template>
    <div class="container grey-light page-height-default">

        <md-snackbar v-bind:style="snackbar.bg" :md-position="snackbar.position" :md-duration="snackbar.duration" :md-active.sync="snackbar.showSnackbar" md-persistent>
            <span v-model="errorMessage" class="c-alert">{{errorMessage}}</span>
            <md-button class="md-icon-button md-accent" @click="snackbar.showSnackbar = false" title="Закрыть окно">
                <md-icon>clear</md-icon>
            </md-button>
        </md-snackbar>

        <div class="p-t">

            <md-card>
                <md-card-header>
                    <div class="md-title">
                        Профиль
                    </div>
                    <div class="md-subhead">
                        Изменить данные учетной записи
                    </div>
                </md-card-header>
                <md-card-content>
                    <div class="md-layout md-gutter">
                        <div class="md-layout-item">
                            <form class="md-layout" >
                                <md-card class="md-layout-item md-small-size-100">
                                    <md-card-header>
                                        <div class="md-title">Изменить данные</div>
                                    </md-card-header>

                                    <md-card-content>
                                        <md-field>
                                            <md-icon>person</md-icon>
                                            <label>Имя</label>
                                            <md-input v-model="user.firstName" maxlength="255" :disabled="sendingProfileData"></md-input>
                                            <span class="md-helper-text">Имя нового пользователя</span>
                                        </md-field>
                                        <md-field>
                                            <md-icon>fingerprint</md-icon>
                                            <label>Фамилия</label>
                                            <md-input v-model="user.surname" maxlength="255" :disabled="sendingProfileData"></md-input>
                                            <span class="md-helper-text">Фамилия нового пользователя</span>
                                        </md-field>
                                        <md-field>
                                            <md-icon>person</md-icon>
                                            <label>Отчество</label>
                                            <md-input v-model="user.middleName" maxlength="255" :disabled="sendingProfileData"></md-input>
                                            <span class="md-helper-text">Отчество нового пользователя</span>
                                        </md-field>
                                        <md-field>
                                            <md-icon>email</md-icon>
                                            <label>E-mail</label>
                                            <md-input v-model="user.email" maxlength="255" type="email" :disabled="sendingProfileData"></md-input>
                                            <span class="md-helper-text">Введите e-mail</span>
                                        </md-field>
                                        <md-field>
                                            <md-icon>lock</md-icon>
                                            <label>Текущий пароль</label>
                                            <md-input v-model="userPassword" maxlength="255" type="password" required></md-input>
                                            <span class="md-helper-text">Ваш пароль</span>
                                        </md-field>
                                    </md-card-content>

                                    <md-progress-bar md-mode="indeterminate" v-if="sendingProfileData" />

                                    <md-card-actions>
                                        <md-button type="button" class="md-primary" :disabled="sendingProfileData" @click="updateProfileData()">Сохранить</md-button>
                                    </md-card-actions>
                                </md-card>

                                <md-snackbar :md-active.sync="savedProfileData">Информация учетной записи успешно обновлена!</md-snackbar>
                            </form>
                        </div>
                        <div class="md-layout-item">
                            <form class="md-layout" >
                                <md-card class="md-layout-item md-small-size-100">
                                    <md-card-header>
                                        <div class="md-title">Изменить пароль</div>
                                    </md-card-header>

                                    <md-card-content>
                                        <md-field>
                                            <md-icon>lock</md-icon>
                                            <label>Текущий пароль</label>
                                            <md-input v-model="userPassword" maxlength="255" type="password" required></md-input>
                                            <span class="md-helper-text">Ваш пароль</span>
                                        </md-field>
                                        <md-field>
                                            <md-icon>lock</md-icon>
                                            <label>Новый пароль</label>
                                            <md-input v-model="newPassword" maxlength="255" type="password"></md-input>
                                            <span class="md-helper-text">Придумайте пароль</span>
                                        </md-field>
                                        <md-field>
                                            <md-icon>lock</md-icon>
                                            <label>Подтверждение</label>
                                            <md-input v-model="passwordConfirm" maxlength="255" type="password"></md-input>
                                            <span class="md-helper-text">Подтвердите пароль</span>
                                        </md-field>
                                    </md-card-content>

                                    <md-progress-bar md-mode="indeterminate" v-if="sendingProfilePassword" />

                                    <md-card-actions>
                                        <md-button type="button" class="md-primary" :disabled="sendingProfilePassword" @click="updateProfilePassword()">Сохранить</md-button>
                                    </md-card-actions>
                                </md-card>

                                <md-snackbar :md-active.sync="savedProfilePassword">Новый пароль успешно сохранен!</md-snackbar>
                            </form>
                        </div>
                    </div>
                </md-card-content>
            </md-card>
        </div>
    </div>
</template>

<style>
    .p-custom{
        padding:16px;
    }
    .color-input-label{
        color:rgba(0,0,0,0.54);
        font-size:1rem;
    }
    .input-color-transparency{
        border-radius: 0.5rem;
        border:1px solid grey;
        max-width:100%;
    }
    .helper-text-custom{
        color:rgba(0,0,0,0.54);
    }
    .input-color-wrapper{
        border:1px solid grey;
        border-radius:0.5rem;
    }
    input[type="color"] {
        opacity: 0;
        display: block;
        border: none;
        cursor:pointer;
        width:100%;
    }
    .f-e{
        display: flex;
        justify-content: flex-end;
    }
    .of-auto{
        overflow-y:auto;
    }
    .buttons{
        display:flex;
        justify-content:space-between;
    }
    .upd-icon{
        margin-top:0.5rem;
    }

    .c-r{
        color:#ff5252;
        font-weight: 600 !important;
    }
    .c-alert{
        font-family: 'Nunito', sans-serif !important;
        color:white;
        font-weight: 600 !important;
        font-size: 1rem;
    }

    .md-button.md-theme-default.md-primary {
        color: white;
    }
    .md-numeric{
        text-align: center !important;
    }
    button.btn-warn{
        background-color:#feca57 !important;
    }
    .md-field.md-select{
        max-width:30%;
    }
    .f-s-a{
        display:flex;
        justify-content: space-around;
    }
</style>

<script>
    import axios from 'axios';

    axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };

    export default {
        name: 'Profile',
        data () {
            return {
                userPassword:'',
                newPassword:'',
                passwordConfirm:'',
                user:{
                    id:'',
                    firstName:'',
                    surname:'',
                    middleName:'',
                    email:''
                },
                sendingProfileData:false,
                savedProfileData:false,
                sendingProfilePassword:false,
                savedProfilePassword:false,
                snackbar: {
                    showSnackbar: false,
                    position: 'center',
                    duration: 4000,
                    bg: 'background-color:rgba(33, 33, 33, 0.6)'
                },
                errorMessage:'',
                errors:[]
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
                    console.log(e);
                    this.errors.push(e.data);
                });
            },
            updateProfileData(){
                this.sendingProfileData = true;
                axios
                    .post('/updateProfileData', {
                        id:this.user.id,
                        email:this.user.email,
                        firstName:this.user.firstName,
                        surname:this.user.surname,
                        middleName:this.user.middleName,
                        password:this.userPassword
                    })
                    .then(response => {
                        this.sendingProfileData = false;
                        this.savedProfileData = true;
                    }).catch(e => {
                    this.sendingProfileData = false;
                    this.savedProfileData = false;
                    this.errors = [];
                    this.errors.push(e.response.data.errors);
                });
            },
            updateProfilePassword(){
                if(this.user.newPassword !== this.user.passwordConfirm)
                {
                    this.errors = [];
                    this.errors.push({Password:["Пароли не совпадают!"]});
                    return;
                }
                this.sendingProfilePassword = true;
                axios
                    .post('/updatePassword', {
                        oldPassword:this.userPassword,
                        password:this.newPassword
                    })
                    .then(response => {
                        this.sendingProfilePassword = false;
                        this.savedProfilePassword = true;
                    }).catch(e => {
                        console.log(e.response);
                    this.sendingProfilePassword = false;
                    this.savedProfilePassword = false;
                    this.errors = [];
                    this.errors.push(e.response.data.errors);
                });
            }
        },
        watch:{
            errors: function(val) {
                if(val){
                    this.errorMessage = val[0][Object.keys(val[0])[0]][0];
                }
                this.snackbar.showSnackbar=true;
            }
        },
        created() {
            this.getUserSession();
        }
    }
</script>
