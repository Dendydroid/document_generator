<template>
    <div class="container grey-light page-height-default" :style="primaryStyle">

        <md-snackbar v-bind:style="snackbar.bg" :md-position="snackbar.position" :md-duration="snackbar.duration" :md-active.sync="snackbar.showSnackbar" md-persistent>
            <span v-model="errorMessage" class="c-alert">{{errorMessage}}</span>
            <md-button class="md-icon-button md-accent" @click="snackbar.showSnackbar = false" title="Закрыть окно">
                <md-icon>clear</md-icon>
            </md-button>
        </md-snackbar>

        <div class="pt-5 pb-2 f-s-c">

            <md-card class="md-layout-item md-size-50 md-small-size-100">
                <md-card-header>
                    <div class="md-title text-center">
                        Вход
                    </div>
                </md-card-header>
                <md-card-content>
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
                        <span class="md-helper-text">Введите пароль</span>
                    </md-field>
                    <span class="f-s-c">
                        <md-button :style="primaryStyle" class="md-primary md-raised" @click="loginAttempt()">Сохранить</md-button>
                    </span>
                </md-card-content>
            </md-card>
        </div>
    </div>
</template>

<style>
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
    .c-p{
        color:#7e57c2;
        font-weight: 600 !important;
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
        name: 'Login',
        data () {
            return {
                primaryStyle:'',
                secondStyle:'',
                userEmail:'',
                userPassword:'',
                errors:[],
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
        methods: {
            convertHex(hex,opacity){
                hex = hex.replace('#','');
                let r = parseInt(hex.substring(0,2), 16);
                let g = parseInt(hex.substring(2,4), 16);
                let b = parseInt(hex.substring(4,6), 16);

                let result = 'rgba('+r+','+g+','+b+','+opacity+')';
                return result;
            },
            getUserSession(){
                axios
                    .post('/getUserSession', {
                    })
                    .then(response => {
                        if(this.user.theme!=='')
                        {
                            this.primaryStyle="background-color:"+this.convertHex(this.user.theme.primaryBG.color,this.user.theme.primaryBG.transparency)+' !important;';
                            this.secondStyle="background-color:"+this.convertHex(this.user.theme.secondBG.color,this.user.theme.secondBG.transparency)+' !important;';
                        }
                        if(response.data.logged)
                        {
                            window.location='/';
                        }

                    }).catch(e => {
                    console.log(e);
                    this.errors.push(e.data);
                });
            },
            loginAttempt() {
                axios
                    .post('/loginUser', {
                        email: this.userEmail,
                        password: this.userPassword
                    })
                    .then(response => (window.location='/'))
                    .catch(e => {
                        this.errors=[];
                        this.errors=[{Password:["Неверный E-mail или Пароль"]}];
                    });
            },
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
