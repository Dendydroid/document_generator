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
                        <div class="md-layout-item">
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
                                    </md-card-content>

                                    <md-progress-bar md-mode="indeterminate" v-if="sendingFacultyInfo" />

                                    <md-card-actions>
                                        <md-button type="submit" class="md-primary" :disabled="sendingFacultyInfo">Сохранить</md-button>
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
                                        <md-field>
                                            <label for="mainBGcolor">Цвет главного фона</label>
                                            <span class="md-helper-text">По умолчанию серый</span>
                                        </md-field>
                                        <md-field>
                                            <label for="secondBGcolor">Цвет вторичного фона</label>
                                            <span class="md-helper-text">По умолчанию темно-серый</span>
                                        </md-field>
                                    </md-card-content>

                                    <md-progress-bar md-mode="indeterminate" v-if="sendingTheme" />

                                    <md-card-actions>
                                        <md-button type="submit" class="md-primary" :disabled="sendingTheme">Сохранить</md-button>
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
                facultyFullName:'',
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
                errorMessage:''
            }
        },

    }
</script>
