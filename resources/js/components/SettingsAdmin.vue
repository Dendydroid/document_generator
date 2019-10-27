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
                        Дополнительные Настройки
                    </div>
                    <div class="md-subhead">
                        Настройки администратора
                    </div>
                </md-card-header>
                <md-card-content>
                    <div class="md-layout md-gutter">
                        <div class="md-layout-item" v-if="user.isAdmin">
                            <form class="md-layout" method="POST" enctype='multipart/form-data' action="/uploadCsv">
                                <input type="hidden" name="_token" value="YzXAnwBñC7qPK9kg7MGGIUzznEOCi2dTnG9h9çpB" v-model="token">
                                <md-card class="md-layout-item md-small-size-100">
                                    <md-card-header>
                                        <div class="md-title">Заполнить БД</div>
                                    </md-card-header>

                                    <md-card-content>
                                        <md-field>
                                            <label for="fileDepartment">Кафедра</label>
                                            <md-select v-model="chosen_department" name="chosen_department" id="chosen_department">
                                                <md-option v-for="department in departmentList" :value="department.id">{{department.fullName}}</md-option>
                                            </md-select>
                                            <span class="md-helper-text">Кафедра специальности, которая заполняется</span>
                                        </md-field>
                                        <md-field>
                                            <label for="csvFiles">Файлы для заполнения</label>
                                             <input name="upload[]" type="file" multiple="multiple" />
                                            <span class="md-helper-text">.csv файлы для заполнения Групп и Студентов</span>
                                        </md-field>
                                    </md-card-content>

                                    <md-progress-bar md-mode="indeterminate" v-if="sendingCsvFiles" />

                                    <md-card-actions>
                                        <md-button type="submit" class="md-primary" :disabled="sendingCsvFiles" @click="sendCsvFiles()">Заполнить базу</md-button>
                                    </md-card-actions>
                                </md-card>
                            </form>

                                <md-card class="md-layout-item md-small-size-100">
                                    <md-card-header>
                                        <div class="md-title">Заполнить Предметы</div>
                                    </md-card-header>

                                    <md-card-content>
                                        <md-field>
                                            <label for="subjects_opp">ОПП</label>
                                            <md-select v-model="subjects_opp" name="subjects_opp" id="subjects_opp" multiple>
                                                <md-option v-for="opp in oppList" :value="opp">{{opp}}</md-option>
                                            </md-select>
                                        </md-field>
                                        <md-field>
                                            <label for="subjects_list">Предметы</label>
                                            <md-select v-model="subjects_list" name="subjects_list" id="subjects_list" multiple>
                                                <md-option v-for="subject in subjectList" :value="subject.name">{{subject.name}}</md-option>
                                            </md-select>
                                        </md-field>
                                        
                                    </md-card-content>

                                    <md-progress-bar md-mode="indeterminate" v-if="sendingSubjects" />
                                    <md-snackbar :md-active.sync="savedSubjects">Предметы успешно добавлены!</md-snackbar>
                                    <md-card-actions>
                                        <md-button type="button" class="md-primary" :disabled="sendingSubjects" @click="sendSubjects()">Добавить предметы</md-button>
                                    </md-card-actions>
                                </md-card>

                                <md-card class="md-layout-item md-small-size-100">
                                    <md-card-header>
                                        <div class="md-title">Очистить БД</div>
                                    </md-card-header>

                                    <md-card-content>
                                        <md-switch v-model="dontClear">Запретить очистку базы</md-switch>
                                        <md-switch v-model="clearSubjects">Удалить предметы</md-switch>
                                        <md-switch v-model="clearDepartments">Удалить кафедры</md-switch>
                                        <div class="row p-c-row">
                                            <md-button type="button" class="md-raised md-accent" :disabled="clearingDB || dontClear" @click="clearDB()">ОЧИСТИТЬ БАЗУ ДАННЫХ</md-button>
                                        </div>
                                    </md-card-content>
                                    <md-progress-bar md-mode="indeterminate" v-if="clearingDB" />
                                    <md-snackbar :md-active.sync="clearedDB">База данных успешно очищена!</md-snackbar>
                                </md-card>
                        </div>
                    </div>
                </md-card-content>
            </md-card>
        </div>
    </div>
</template>

<style>
    .md-menu-content.md-select-menu {
  width: auto;
  max-width: none;
}
    .p-c-row{
        padding:16px;
    }
    input[type=file]
    {
        width:100%;
        position:absolute;
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
</style>

<script>


    import axios from 'axios';

    axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };

    export default {
        name: 'SettingsAdmin',
        data () {
            return {
                user:{},
                csvFiles:null,
                sendingCsvFiles:false,
                savedCsvFiles:false,
                clearingDB:false,
                clearedDB:false,
                sendingSubjects:false,
                savedSubjects:false,
                sendingClearSessions:false,
                clearedSessions:false,
                clearSubjects:false,
                clearDepartments:false,
                token:document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                snackbar: {
                    showSnackbar: false,
                    position: 'center',
                    duration: 4000,
                    bg: 'background-color:rgba(33, 33, 33, 0.6)'
                },
                errorMessage:'',
                errors:[],
                departmentList:[],
                dontClear:true,
                subjects_opp:'',
                subjects_list:'',
                oppList:[],
                subjectList:[],
            }
        },
        methods:{
            sendSubjects() {
                this.sendingSubjects = true;
                axios
                    .post('/specialitySubjects', {
                        subjectOpps:this.subjects_opp,
                        subjects:this.subjects_list,
                    })
                    .then(response => {

                        this.sendingSubjects = false;
                        this.savedSubjects = true;

                    }).catch(e => {
                        this.sendingSubjects = false;
                        this.savedSubjects = false;
                        console.log(e);
                    this.errors.push(e.data);
                });
            },
            loadSpecialities() {
                axios
                    .get('/getSpecialities')
                    .then(response => (this.specialityList = response.data))
                    .catch(e => {
                        this.errors.push(e)
                    });
            },
            loadSubjects() {
                axios
                    .get('/getSubjects')
                    .then(response => (this.subjectList = response.data))
                    .catch(e => {
                        this.errors.push(e)
                    });
            },
            loadOpp() {
                axios
                    .get('/getOpp')
                    .then(response => (this.oppList = response.data))
                    .catch(e => {
                        this.errors.push(e)
                    });
            },
            loadDepartments() {
                axios
                    .get('/getDepartments')
                    .then(response => (this.departmentList = response.data))
                    .catch(e => {
                        this.errors.push(e)
                    });
            },
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
            clearDB(){
                this.clearingDB = true;
                axios
                    .post('/clearDB', {
                        departments:this.clearDepartments,
                        subjects:this.clearSubjects,
                    })
                    .then(response => {
                        this.clearingDB = false;
                        this.clearedDB = true;

                    }).catch(e => {
                        this.clearingDB = false;
                        this.clearedDB = false;
                        this.errors = [];
                        this.errors.push(e.response.data.errors);
                    this.errors.push(e.data);
                });
            },
            sendCsvFiles(){
                console.log($("#csvFiles"));
                this.sendingCsvFiles = true;
                axios
                    .post('/sendCsvFiles', {
                        csvFiles: this.csvFiles,
                    })
                    .then(response => {
                        this.sendingCsvFiles = false;
                        this.savedCsvFiles = true;
                    }).catch(e => {
                        this.sendingCsvFiles = false;
                        this.savedCsvFiles = false;
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
            this.loadDepartments();
            this.loadSpecialities();
            this.loadOpp();
            this.loadSubjects();
        }
    }
</script>
