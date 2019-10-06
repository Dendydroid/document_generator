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
                        Настройки
                    </div>
                    <div class="md-subhead">
                        Основные настройки
                    </div>
                </md-card-header>
                <md-card-content>
                    <div class="md-layout md-gutter">
                        <div class="md-layout-item" v-if="user.isAdmin">
                            <form class="md-layout" >
                                <md-card class="md-layout-item md-small-size-100">
                                    <md-card-header>
                                        <div class="md-title">Факультет</div>
                                    </md-card-header>

                                    <md-card-content>
                                        <md-field>
                                            <label for="facultyFullName">Название</label>
                                            <md-input type="text" id="facultyFullName" v-model="facultyFullName" :disabled="sendingFacultyInfo" maxlength="255" />
                                            <span class="md-helper-text">Полное название факультета</span>
                                        </md-field>
                                        <md-field>
                                            <label for="facultyAbbreviation">Аббревиатура</label>
                                            <md-input type="text" id="facultyAbbreviation" v-model="facultyAbbreviation" :disabled="sendingFacultyInfo" maxlength="255" />
                                            <span class="md-helper-text">Аббревиатура названия факультета</span>
                                        </md-field>
                                        <md-field>
                                            <label for="facultyRectorFIO">Ректор</label>
                                            <md-input type="text" id="facultyRectorFIO" v-model="facultyRectorFIO" :disabled="sendingFacultyInfo" maxlength="255" />
                                            <span class="md-helper-text">ФИО ректора</span>
                                        </md-field>
                                    </md-card-content>

                                    <md-progress-bar md-mode="indeterminate" v-if="sendingFacultyInfo" />

                                    <md-card-actions>
                                        <md-button type="button" class="md-primary" :disabled="sendingFacultyInfo" @click="updateFacultyInfo()">Сохранить</md-button>
                                    </md-card-actions>
                                </md-card>

                                <md-snackbar :md-active.sync="savedFacultyInfo">Информация о факультете успешно сохранена!</md-snackbar>
                            </form>
                        </div>
                        <div class="md-layout-item">
                            <form class="md-layout" >
                                <md-card class="md-layout-item md-small-size-100">
                                    <md-card-header>
                                        <div class="md-title">Персонализация</div>
                                    </md-card-header>

                                    <md-card-content>
                                        <div class="row">
                                            <div class="col-md-6 p-custom">
                                                <label class="color-input-label" for="mainBGcolor">Цвет главного фона</label>
                                            </div>
                                            <div class="col-md-6 p-custom">
                                                <div class="input-color-wrapper" :style="'background-color:'+mainBGcolor">
                                                    <input type="color" id="mainBGcolor" v-model="mainBGcolor">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 p-custom">
                                                <label class="color-input-label" for="secondBGcolor">Цвет вторичного фона</label>
                                            </div>
                                            <div class="col-md-3 p-custom text-left">
                                                <div class="input-color-wrapper" :style="'background-color:'+secondBGcolor">
                                                    <input type="color" id="secondBGcolor" v-model="secondBGcolor">
                                                </div>
                                            </div>
                                            <div class="col-md-3 p-custom text-left">
                                                <input class="input-color-transparency" v-model="secondBGcolorTransparency" step="0.01" type="number" min="0" max="1">
                                                <span class="md-helper-text helper-text-custom">Непрозрачность</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 p-custom">
                                                <label class="color-input-label" for="secondBGcolor">Цвет навигационной панели</label>
                                            </div>
                                            <div class="col-md-3 p-custom text-left">
                                                <div class="input-color-wrapper" :style="'background-color:'+navbarBGcolor">
                                                    <input type="color" id="navbarBGcolor" v-model="navbarBGcolor">
                                                </div>
                                            </div>
                                            <div class="col-md-3 p-custom text-left">
                                                <input class="input-color-transparency" v-model="navbarBGcolorTransparency" step="0.01" type="number" min="0" max="1">
                                                <span class="md-helper-text helper-text-custom">Непрозрачность</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 p-custom">
                                                <label class="color-input-label" for="secondBGcolor">Цвет действий</label>
                                            </div>
                                            <div class="col-md-3 p-custom text-left">
                                                <div class="input-color-wrapper" :style="'background-color:'+primaryBGcolor">
                                                    <input type="color" id="primaryBGcolor" v-model="primaryBGcolor">
                                                </div>
                                            </div>
                                            <div class="col-md-3 p-custom text-left">
                                                <input class="input-color-transparency" v-model="primaryBGcolorTransparency" step="0.01" type="number" min="0" max="1">
                                                <span class="md-helper-text helper-text-custom">Непрозрачность</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 p-custom">
                                                <label class="color-input-label" for="accentBGcolor">Акцентирующий цвет</label>
                                            </div>
                                            <div class="col-md-3 p-custom text-left">
                                                <div class="input-color-wrapper" :style="'background-color:'+accentBGcolor">
                                                    <input type="color" id="accentBGcolor" v-model="accentBGcolor">
                                                </div>
                                            </div>
                                            <div class="col-md-3 p-custom text-left">
                                                <input class="input-color-transparency" v-model="accentBGcolorTransparency" step="0.01" type="number" min="0.2" max="1">
                                                <span class="md-helper-text helper-text-custom">Непрозрачность</span>
                                            </div>
                                        </div>
                                    </md-card-content>

                                    <md-progress-bar md-mode="indeterminate" v-if="sendingTheme" />

                                    <md-card-actions>
                                        <md-button type="button" class="md-primary" :disabled="sendingTheme" @click="updateTheme()">Сохранить</md-button>
                                    </md-card-actions>
                                </md-card>

                                <md-snackbar :md-active.sync="savedTheme">Персонализация сохранена!</md-snackbar>
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
        name: 'Settings',
        data () {
            return {
                primaryStyle:'',
                secondStyle:'',
                user:{},
                facultyFullName:'',
                facultyAbbreviation:'',
                facultyRectorFIO:'',
                mainBGcolor:'',
                secondBGcolor:'',
                secondBGcolorTransparency:'',
                navbarBGcolor:'',
                navbarBGcolorTransparency:'',
                primaryBGcolor:'',
                primaryBGcolorTransparency:'',
                accentBGcolor:'',
                accentBGcolorTransparency:'',
                sendingFacultyInfo:false,
                savedFacultyInfo:false,
                sendingTheme:false,
                savedTheme:false,
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
                        this.user = response.data;
                        this.mainBGcolor = this.user.theme.mainBG.color;
                        this.secondBGcolor = this.user.theme.secondBG.color;
                        this.secondBGcolorTransparency = this.user.theme.secondBG.transparency;
                        this.navbarBGcolor = this.user.theme.navbarBG.color;
                        this.navbarBGcolorTransparency = this.user.theme.navbarBG.transparency;
                        this.primaryBGcolor = this.user.theme.primaryBG.color;
                        this.primaryBGcolorTransparency = this.user.theme.primaryBG.transparency;
                        this.accentBGcolor = this.user.theme.accentBG.color;
                        this.accentBGcolorTransparency = this.user.theme.accentBG.transparency;

                    }).catch(e => {
                        console.log(e);
                    this.errors.push(e.data);
                });
            },
            updateTheme(){
                this.sendingTheme = true;
                axios
                    .post('/updateTheme', {
                        mainBGcolor: this.mainBGcolor,
                        secondBGcolor: this.secondBGcolor,
                        navbarBGcolor: this.navbarBGcolor,
                        primaryBGcolor: this.primaryBGcolor,
                        accentBGcolor: this.accentBGcolor,
                        secondBGcolorTransparency: this.secondBGcolorTransparency,
                        navbarBGcolorTransparency: this.navbarBGcolorTransparency,
                        primaryBGcolorTransparency: this.primaryBGcolorTransparency,
                        accentBGcolorTransparency: this.accentBGcolorTransparency,
                    })
                    .then(response => {
                        this.sendingTheme = false;
                        this.savedTheme = true;
                    }).catch(e => {
                    this.sendingTheme = false;
                    this.savedTheme = false;
                    this.errors = [];
                    this.errors.push(e.response.data);
                });
            },
            updateFacultyInfo(){
                this.sendingFacultyInfo = true;
                axios
                    .post('/updateFacultyInfo', {
                        fullName: this.facultyFullName,
                        abbreviation: this.facultyAbbreviation,
                        rectorFIO: this.facultyRectorFIO,
                    })
                    .then(response => {
                        this.sendingFacultyInfo = false;
                        this.savedFacultyInfo = true;
                    }).catch(e => {
                        this.sendingFacultyInfo = false;
                        this.savedFacultyInfo = false;
                        this.errors = [];
                        this.errors.push(e.response.data.errors);
                    });
            },
            getFacultyInfo(){
                axios
                    .post('/getFacultyInfo', {
                    })
                    .then(response => {
                        this.facultyFullName = response.data.fullName;
                        this.facultyAbbreviation = response.data.abbreviation;
                        this.facultyRectorFIO = response.data.rectorFIO;
                    }).catch(e => {
                    this.errors = [];
                    this.errors.push(e.response.data.errors);
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
            this.getFacultyInfo();
        }
    }
</script>
