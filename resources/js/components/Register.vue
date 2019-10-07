<template>
    <div class="container grey-light page-height-default reg-wrapper" >

        <md-snackbar v-bind:style="snackbar.bg" :md-position="snackbar.position" :md-duration="snackbar.duration" :md-active.sync="snackbar.showSnackbar" md-persistent>
            <span v-model="errorMessage" class="c-alert">{{errorMessage}}</span>
            <md-button class="md-icon-button md-accent" @click="snackbar.showSnackbar = false" title="Закрыть окно">
                <md-icon>clear</md-icon>
            </md-button>
        </md-snackbar>

        <div class="pt-5 pb-2 text-center">
            <md-card class="md-layout-item md-accent md-size-50 md-small-size-100 mc-auto" md-with-hover v-if="noUser">
                <md-ripple>
                    <md-card-header>
                        <div class="md-title"><b>Внимание!</b></div>
                        <div class="md-subhead">Необходимо создать главную учетную запись</div>
                    </md-card-header>

                    <md-card-content>
                        На данный момент в системе нету ни одной учетной записи.
                        <br>Пожалуйста, <b>создайте</b> главную учетную запись и <b>запишите</b> учетные данные
                        <br><br>После этого только главная учетная запись будет иметь возможность регистрировать новые учетные записи
                    </md-card-content>

                </md-ripple>
            </md-card>

            <md-card class="md-layout-item md-size-50 md-small-size-100 mc-auto">
                <md-card-header>
                    <div class="md-title text-center">
                        Регистрация
                    </div>
                </md-card-header>
                <md-card-content>
                    <md-field>
                        <md-icon>person</md-icon>
                        <label>Имя</label>
                        <md-input v-model="userFirstName" maxlength="255" ></md-input>
                        <span class="md-helper-text">Имя нового пользователя</span>
                    </md-field>
                    <md-field>
                        <md-icon>fingerprint</md-icon>
                        <label>Фамилия</label>
                        <md-input v-model="userSurname" maxlength="255" ></md-input>
                        <span class="md-helper-text">Фамилия нового пользователя</span>
                    </md-field>
                    <md-field>
                        <md-icon>person</md-icon>
                        <label>Отчество</label>
                        <md-input v-model="userMiddleName" maxlength="255" ></md-input>
                        <span class="md-helper-text">Отчество нового пользователя</span>
                    </md-field>
                    <md-field>
                        <md-icon>email</md-icon>
                        <label>E-mail</label>
                        <md-input v-model="userEmail" maxlength="255" type="email"></md-input>
                        <span class="md-helper-text">Введите e-mail</span>
                    </md-field>
                    <md-field>
                        <md-icon>lock</md-icon>
                        <label>Пароль</label>
                        <md-input v-model="userPassword" maxlength="255" type="password"></md-input>
                        <span class="md-helper-text">Придумайте пароль</span>
                    </md-field>
                    <md-field>
                        <md-icon>lock</md-icon>
                        <label>Подтверждение</label>
                        <md-input v-model="userPasswordConfirm" maxlength="255" type="password"></md-input>
                        <span class="md-helper-text">Подтвердите пароль</span>
                    </md-field>
                    <span class="f-s-c">
                        <md-button class="md-primary md-raised" @click="registerAttempt()">Сохранить</md-button>
                    </span>
                </md-card-content>
            </md-card>
        </div>
    </div>
</template>

<style>
    .mc-auto{
        margin:0 auto;
    }
    .form-content{
        padding-top:1rem;
        padding-bottom:1rem;
        padding-left:3rem;
        padding-right:3rem;
    }

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
    .f-s-c{
        display:flex;
        justify-content: center;
    }
</style>

<script>
    import axios from 'axios';

    axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };

    export default {
        name: 'Register',
        data () {
            return {
                userPassword:'',
                userPasswordConfirm:'',
                userEmail:'',
                userFirstName:'',
                userSurname:'',
                userMiddleName:'',
                noUser:false,
                errors:[],
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
                        if(response.data.theme!=='')
                        {
                            this.secondStyle="background-color:"+this.convertHex(response.data.theme.secondBG.color,response.data.theme.secondBG.transparency)+' !important;';
                            this.primaryStyle="background-color:"+this.convertHex(response.data.theme.primaryBG.color,response.data.theme.primaryBG.transparency)+' !important;';
                            this.primaryTextStyle = "color:"+this.convertHex(response.data.theme.primaryBG.color,response.data.theme.primaryBG.transparency)+' !important;';
                        }

                    }).catch(e => {
                    console.log(e);
                    this.errors.push(e.data);
                });
            },
            registerAttempt() {
                if(this.userPassword !== this.userPasswordConfirm){
                    this.errors = [];
                    this.errors.push({Password:["Пароли не совпадают!"]});
                    return;
                }
                axios
                    .post('/registerUser', {
                        email: this.userEmail,
                        firstName: this.userFirstName,
                        surname: this.userSurname,
                        middleName: this.userMiddleName,
                        password: this.userPassword,
                    })
                    .then(response => (window.location='/'))
                    .catch(e => {
                        this.errors=[];
                        this.errors.push(e.response.data);
                    });
            },
            hasNoUsers() {
                axios
                    .post('/hasNoUsers', {
                    })
                    .then(response => (this.noUser = true))
                    .catch(e => {
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
            this.hasNoUsers();
            if(!this.noUser && !this.user.isAdmin){
                window.location='/';
            }
        }
    }
</script>
