<template>
    <div class="container grey-light page-height-default" >

        <md-snackbar v-bind:style="snackbar.bg" :md-position="snackbar.position" :md-duration="snackbar.duration" :md-active.sync="snackbar.showSnackbar" md-persistent>
            <span v-model="errorMessage" class="c-alert">{{errorMessage}}</span>
            <md-button class="md-icon-button md-accent" @click="snackbar.showSnackbar = false" title="Закрыть окно">
                <md-icon>clear</md-icon>
            </md-button>
        </md-snackbar>

        <div class="p-t">

            <md-dialog :md-active.sync="toggleModalInfo" class=" of-auto" md-scrollbar>
                <md-dialog-title class="fb-center"><p>Информация <md-icon class="mb-1 md-accent">info</md-icon></p></md-dialog-title>
                <div class="pl-3 pr-3 pb-3 larafont" v-if="activeAllowed.length!==0">
                   Список разрешенных предметов:
                </div>
                <div class="pl-3 pr-3 pb-3 larafont" v-if="activeAllowed.length===0">
                    Список разрешенных предметов пуст!
                </div>
                <ul>
                    <li v-for="item in activeAllowed">
                        {{item.name}}
                    </li>
                </ul>
                <div class="buttons pb-3 pl-2 pr-2">
                    <md-button class="md-accent md-raised" @click="closeInfo()">Закрыть</md-button>
                </div>
            </md-dialog>

            <md-dialog :md-active.sync="toggleModalSure" class=" of-auto" md-scrollbar>
                <md-dialog-title class="fb-center"><p>Вы уверены? <md-icon class="mb-1 md-accent">warning</md-icon></p></md-dialog-title>
                <div class="pl-3 pr-3 pb-3 larafont">
                    Эта операция <span class="c-r">необратима</span>, нажимая '<span class="c-p">подтвердить</span>' <br> вы безвозвратно удаляете запись/записи.
                </div>
                <div class="buttons pb-3 pl-2 pr-2">
                    <md-button  class="md-primary md-raised" @click="onConfirm()">Подтвердить</md-button>
                    <md-button class="md-accent md-raised" @click="onCancel()">Отмена</md-button>
                </div>
            </md-dialog>

            <md-dialog :md-active.sync="toggleModalAllow" class="pl-5 pr-5 of-auto" md-scrollbar>
                <md-dialog-title class="fb-center">Разрешить/Запретить заполнение ведомости</md-dialog-title>

                <div class="pl-2 pr-2 pb-3">
                    <md-checkbox v-model="allowParticular">Разрешить выборочно</md-checkbox>
                    <md-field>
                        <label>Дисциплины</label>
                        <md-select v-model="allowedSubjectsList"  multiple :disabled="!allowParticular">
                            <md-option v-for="subject in selectedTeacherSubjects" :value="subject.id">{{subject.name}}</md-option>
                        </md-select>
                    </md-field>
                </div>
                <div class="buttons pb-3">
                    <md-button  class="md-primary md-raised" @click="saveTeacherToken()">Разрешить</md-button>
                    <md-button  class="md-raised md-accent" @click="removeAllTokens()">Отменить разрешения</md-button>
                    <md-button  class="md-accent" @click="toggleModalAllow=false">Отмена</md-button>
                </div>
            </md-dialog>

            <md-card>
                <md-card-header>
                    <div class="md-title">
                        Учетные записи
                    </div>
                    <div class="md-subhead">
                        Управление данными
                    </div>
                </md-card-header>
                <md-card-content>
                    <div class="buttons">
                        <md-button  class="md-icon-button md-dense md-raised md-primary upd-icon" @click="getSubjects()">
                            <md-icon>cached</md-icon>
                        </md-button>
                    </div>
                </md-card-content>


                <md-table v-model="searched" md-card md-sort="id" md-sort-order="asc" md-fixed-header @md-selected="onSelect" :md-selected-value.sync="selected">
                    <md-table-toolbar>
                        <h1 class="md-title">
                        </h1>
                        <md-field md-clearable class="md-toolbar-section-end">
                            <md-input placeholder="Поиск по наименованию.." v-model="search" @input="searchOnTable" />
                        </md-field>
                    </md-table-toolbar>

                    <md-table-toolbar slot="md-table-alternate-header" slot-scope="{ count }">
                        <div class="md-toolbar-section-start">{{ getAlternateLabel(count) }}</div>

                        <div class="md-toolbar-section-end">
                            <md-button class="md-icon-button md-raised md-accent" title="Удалить выделенное" @click="toggleModalSure=true"><md-icon>delete</md-icon></md-button>
                            <md-button v-if="showAllowButton" class="md-icon-button md-raised btn-warn c-w" @click="allowSelected()" title="Разрешить/Отменить разрешения на заполнение ведомостей преподавателю">
                                <md-icon class="c-w">build</md-icon>
                            </md-button>
                            <md-button v-if="showAllowButton" class="md-icon-button md-raised c-w" @click="showInfo()" title="Посмотреть информацию" style="background-color: #6cb2eb">
                               <span style="font-size:1.5rem">&#8505;</span>
                            </md-button>
                            <md-button class="md-icon-button md-raised" @click="clearSelected()" title="Сбросить выделение">
                                <md-icon>clear</md-icon>
                            </md-button>
                        </div>
                    </md-table-toolbar>

                    <md-table-empty-state
                        md-label="Пользователи не найдены"
                        :md-description="'Не было найдено ни одного пользователя'">
                    </md-table-empty-state>

                    <md-table-row slot="md-table-row" slot-scope="{ item }" md-selectable="multiple" md-auto-select>
                        <md-table-cell md-label="ID" md-sort-by="id" md-numeric>{{ item.id }}</md-table-cell>
                        <md-table-cell md-label="ФИО" md-sort-by="FIO">{{ item.FIO }}</md-table-cell>
                        <md-table-cell md-label="E-mail" md-sort-by="email">{{ item.email }}</md-table-cell>
                        <md-table-cell md-label="Тип" md-sort-by="type">
                            <md-icon class='cr-theme-primary' v-if="item.isAdmin">stars</md-icon>
                            <md-icon class='cr-theme-accent' v-if="!item.isAdmin && !item.isTeacher">contact_mail</md-icon>
                            <md-icon class='cr-theme-accent' v-if="item.isTeacher">school</md-icon>
                        </md-table-cell>
                    </md-table-row>

                </md-table>


            </md-card>
        </div>
    </div>
</template>

<style>
    .c-w{
        color:#fff !important;
    }
    .icon-table{

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

    .md-numeric{
        text-align: center !important;
    }
    button.btn-warn{
        background-color:#feca57 !important;
    }
    .md-field.md-select{
        max-width:30%;
    }
</style>

<script>
    import axios from 'axios';

    axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };

    const toLower = text => {
        return text.toString().toLowerCase();
    };

    const searchByColumn = (items, term, column) => {
        if (term) {
            return items.filter(item => toLower(item[column]).includes(toLower(term)));
        }

        return items;
    };

    export default {
        name: 'SettingsUsers',
        data () {
            return {
                snackbar: {
                    showSnackbar: false,
                    position: 'center',
                    duration: 4000,
                    bg: 'background-color:rgba(33, 33, 33, 0.6)'
                },
                showAllowButton:false,
                toggleModalInfo:false,
                activeAllowed:[],
                searchColumn: 'name',
                errorMessage: '',
                facultyList:'',
                editId: '',
                removeConfirm: false,
                toggleModalSure: false,
                toggleModalAllow: false,
                selectedTeacher:null,
                selectedTeacherSubjects: [],
                allowedSubjectsList:[],
                selected: [],
                search: null,
                searched: [],
                errors: [],
                dataSet: [],
                allowParticular:true
            }
        },
        methods: {
            getAllowedSubjects(){
                axios
                    .post('/getAllowedSubjectsAdmin', {
                        id:this.selected[0].id
                    })
                    .then(response => {
                        this.activeAllowed = response.data;
                    }).catch(e => {
                    this.errors.push(e.response.data.errors);
                });
            },
            showInfo () {
                this.getAllowedSubjects();
                this.toggleModalInfo = true;
            },
            closeInfo () {
                this.toggleModalInfo = false;
            },
            onSelect (items) {
                this.selected = items;
                this.toggleShowAllowButton(items);
            },
            toggleShowAllowButton : function (items){
                if(items.length === 1 && items[0].isTeacher){
                    this.showAllowButton = true;
                    return;
                }
                this.showAllowButton = false;
            },
            allowSelected(){
                this.toggleModalAllow = true;
                this.selectedTeacher = this.selected[0];
                this.getTeacherSubjects();
            },
            saveTeacherToken(){

                let allowedSubjects = this.selectedTeacherSubjects.filter(el => this.allowedSubjectsList.includes(el.id));

                axios
                    .post('/saveTeacherToken', {
                        id:this.selectedTeacher.id,
                        particular: this.allowParticular,
                        subjects: allowedSubjects,
                    })
                    .then(response => {
                    })
                    .catch(e => {
                        this.errors.push(e)
                    });
                this.toggleModalAllow = false;
            },
            removeAllTokens(){
                axios
                    .post('/removeAllTokens', {
                        id:this.selectedTeacher.id,
                    })
                    .then(response => {
                    })
                    .catch(e => {
                        this.errors.push(e)
                    });
                this.toggleModalAllow = false;
            },
            getAlternateLabel (count) {
                let plural = 'ь';
                let plural2 = 'а';
                if (parseInt(count.toString().split('').pop()) === 1) {
                    plural = '';
                }else if (parseInt(count.toString().split('').pop()) > 1 && parseInt(count.toString().split('').pop()) < 5){
                    plural = 'и';
                }else{
                    plural = 'ей';
                }

                if(count > 10 && count < 21){
                    plural = 'ей';
                }

                if(count!==1){
                    plural2 = 'а';
                }else{
                    plural2 = 'о';
                }

                return `Выделен${plural2} ${count} запис${plural}`;
            },
            searchOnTable () {
                if(this.searchColumn){
                    this.searched = searchByColumn(this.dataSet, this.search, this.searchColumn)
                }
            },
            getTeacherSubjects(){
                axios
                    .post('/getTeacherSubjectsList', {
                        id: this.selectedTeacher.id
                    })
                    .then(response => {
                        this.selectedTeacherSubjects = response.data;
                    })
                    .catch(e => {
                        this.errors.push(e)
                    });
            },
            clearSelected() {
                this.selected = [];
            },
            getUsers: function() {
                axios
                    .get('/getUsers')
                    .then(response => (this.dataSet = response.data))
                    .catch(e => {
                        this.errors.push(e)
                    });
            },
            deleteUsers: function() {
                axios
                    .post('/deleteUsers', {
                        objects: this.selected
                    })
                    .then(response => {
                        this.getUsers();
                    })
                    .catch(e => {
                        this.errors.push(e)
                    });
                this.clearSelected();
                this.toggleModalSure=false;
            },
            onCancel: function() {
                this.toggleModalSure = false;
            },
            onConfirm: function() {
                this.deleteUsers();
                this.toggleModalSure = false;
            }
        },
        watch : {
            errors: function(val) {
                this.errorMessage = val[0][Object.keys(val[0])[0]][0];
                this.snackbar.showSnackbar=true;
            },
            dataSet: function (val) {
                this.searched = val;
            }
        },
        created () {
            this.getUsers();
        }
    }
</script>
