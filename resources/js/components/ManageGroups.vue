<template>
    <div class="container grey-light page-height-default" :style="secondStyle">

        <md-snackbar v-bind:style="snackbar.bg" :md-position="snackbar.position" :md-duration="snackbar.duration" :md-active.sync="snackbar.showSnackbar" md-persistent>
            <span v-model="errorMessage" class="c-alert">{{errorMessage}}</span>
            <md-button class="md-icon-button md-accent" @click="snackbar.showSnackbar = false" title="Закрыть окно">
                <md-icon>clear</md-icon>
            </md-button>
        </md-snackbar>

        <div class="p-t">

            <md-dialog :md-active.sync="toggleModalSure" class=" of-auto" md-scrollbar>
                <md-dialog-title class="fb-center"><p>Вы уверены? <md-icon class="mb-1 md-accent">warning</md-icon></p></md-dialog-title>
                <div class="pl-3 pr-3 pb-3 larafont">
                    Эта операция <span class="c-r">необратима</span>, нажимая '<span class="c-p" :style="primaryTextStyle">подтвердить</span>' <br> вы безвозвратно удаляете запись/записи.
                </div>
                <div class="buttons pb-3 pl-2 pr-2">
                    <md-button :style="primaryStyle" class="md-primary md-raised" @click="onConfirm()">Подтвердить</md-button>
                    <md-button class="md-accent md-raised" @click="onCancel()">Отмена</md-button>
                </div>
            </md-dialog>

            <md-dialog :md-active.sync="toggleModalAdd" class="pl-5 pr-5 of-auto" md-scrollbar>
                <md-dialog-title class="fb-center">Добавить группу</md-dialog-title>
                <div class="pl-2 pr-2 pb-3">
                    <md-field>
                        <label>Наименование</label>
                        <md-input v-model="add_id_name" maxlength="255" ></md-input>
                        <span class="md-helper-text">Сокращенное имя группы</span>
                    </md-field>
                    <md-field>
                        <label>Специальность</label>
                        <md-select v-model="add_speciality" name="add_faculty" id="add_faculty">
                            <md-option v-for="speciality in specialityList" :value="speciality.id">{{speciality.fullName}}</md-option>
                        </md-select>
                        <span class="md-helper-text">Выберите специальность</span>
                    </md-field>
                    <md-field>
                        <label>Предметы по умолчанию</label>
                        <md-select v-model="add_default_subjects" multiple>
                            <md-option v-for="subject in subjectList" :value="subject.id">{{subject.name}}</md-option>
                        </md-select>
                    </md-field>
                    <md-field>
                        <label>Куратор</label>
                        <md-input v-model="add_curatorFIO" maxlength="255" ></md-input>
                        <span class="md-helper-text">ФИО куратора группы <small>(не обязательное)</small></span>
                    </md-field>
                    <md-field>
                        <label>Номер куратора</label>
                        <md-input v-model="add_curatorPhone" maxlength="255" ></md-input>
                        <span class="md-helper-text">Номер телефона куратора группы <small>(не обязательное)</small></span>
                    </md-field>
                    <md-field>
                        <label>Командир</label>
                        <md-input v-model="add_headmanFIO" maxlength="255" ></md-input>
                        <span class="md-helper-text">ФИО командира группы <small>(не обязательное)</small></span>
                    </md-field>
                    <md-field>
                        <label>Номер командира</label>
                        <md-input v-model="add_headmanPhone" maxlength="255" ></md-input>
                        <span class="md-helper-text">Номер телефона командира группы <small>(не обязательное)</small></span>
                    </md-field>

                </div>
                <div class="buttons pb-3">
                    <md-button :style="primaryStyle" class="md-primary md-raised" @click="createGroup()">Сохранить</md-button>
                    <md-button class="md-accent md-raised" @click="toggleModalAdd=false">Отмена</md-button>
                </div>
            </md-dialog>

            <md-dialog :md-active.sync="toggleModalEdit" class="pl-5 pr-5 of-auto" md-scrollbar>
                <md-dialog-title class="fb-center">Изменить группу</md-dialog-title>
                <div class="pl-2 pr-2 pb-3">
                    <md-field>
                        <label>Наименование</label>
                        <md-input v-model="edit_id_name" maxlength="255" ></md-input>
                        <span class="md-helper-text">Сокращенное имя группы</span>
                    </md-field>
                    <md-field>
                        <label>Специальность</label>
                        <md-select v-model="edit_speciality" name="add_faculty" id="add_faculty">
                            <md-option v-for="speciality in specialityList" :value="speciality.id">{{speciality.fullName}}</md-option>
                        </md-select>
                        <span class="md-helper-text">Выберите специальность</span>
                    </md-field>
                    <md-field>
                        <label>Предметы по умолчанию</label>
                        <md-select v-model="edit_default_subjects" multiple>
                            <md-option v-for="subject in subjectList" :value="subject.id">{{subject.name}}</md-option>
                        </md-select>
                    </md-field>
                    <md-field>
                        <label>Куратор</label>
                        <md-input v-model="edit_curatorFIO" maxlength="255" ></md-input>
                        <span class="md-helper-text">ФИО куратора группы <small>(не обязательное)</small></span>
                    </md-field>
                    <md-field>
                        <label>Номер куратора</label>
                        <md-input v-model="edit_curatorPhone" maxlength="255" ></md-input>
                        <span class="md-helper-text">Номер телефона куратора группы <small>(не обязательное)</small></span>
                    </md-field>
                    <md-field>
                        <label>Командир</label>
                        <md-input v-model="edit_headmanFIO" maxlength="255" ></md-input>
                        <span class="md-helper-text">ФИО командира группы <small>(не обязательное)</small></span>
                    </md-field>
                    <md-field>
                        <label>Номер командира</label>
                        <md-input v-model="edit_headmanPhone" maxlength="255" ></md-input>
                        <span class="md-helper-text">Номер телефона командира группы <small>(не обязательное)</small></span>
                    </md-field>
                </div>
                <div class="buttons pb-3">
                    <md-button :style="primaryStyle" class="md-primary md-raised" @click="editGroup()">Сохранить</md-button>
                    <md-button class="md-accent md-raised" @click="toggleModalEdit=false">Отмена</md-button>
                </div>
            </md-dialog>




            <md-card>
                <md-card-header>
                    <div class="md-title">
                        Группы
                    </div>
                    <div class="md-subhead">
                        Управление данными
                    </div>
                </md-card-header>
                <md-card-content>
                    <div class="buttons">
                        <md-button :style="primaryStyle" class="md-raised md-primary" v-on:click="toggleModalAdd=true">
                            Добавить
                        </md-button>
                        <md-button :style="primaryStyle" class="md-icon-button md-dense md-raised md-primary upd-icon" @click="getGroups()">
                            <md-icon>cached</md-icon>
                        </md-button>
                    </div>
                    <!--                    <div class="f-e">-->
                    <!--                        <md-field class="ml-2">-->
                    <!--                            <label for="movie">Искать по</label>-->
                    <!--                            <md-select v-model="searchColumn" class="select-material" @change="searchOnTable()">-->
                    <!--                                <md-option value="id">ID</md-option>-->
                    <!--                                <md-option value="fullName">Наименование</md-option>-->
                    <!--                                <md-option value="abbreviation">Аббревиатура</md-option>-->
                    <!--                            </md-select>-->
                    <!--                        </md-field>-->
                    <!--                    </div>-->
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
                            <md-button v-if="showEditButton" class="md-icon-button md-raised btn-warn" @click="editSelected()" title="Изменить выделенный">
                                <md-icon>create</md-icon>
                            </md-button>
                            <md-button class="md-icon-button md-raised md-accent" title="Удалить выделенное" @click="toggleModalSure=true"><md-icon>delete</md-icon></md-button>
                            <md-button class="md-icon-button md-raised" @click="clearSelected()" title="Сбросить выделение">
                                <md-icon>clear</md-icon>
                            </md-button>
                        </div>
                    </md-table-toolbar>

                    <md-table-empty-state
                        md-label="Группы не найдены"
                        :md-description="'Не было найдено ни одной группы. Измените запрос или создайте новую группу.'">
                        <md-button :style="primaryStyle" class="md-primary md-raised" v-on:click="toggleModalAdd=true">Добавить</md-button>
                    </md-table-empty-state>

                    <md-table-row slot="md-table-row" slot-scope="{ item }" md-selectable="multiple" md-auto-select>
                        <md-table-cell md-label="ID" md-sort-by="id" md-numeric>{{ item.id }}</md-table-cell>
                        <md-table-cell md-label="Предметы" md-sort-by="defaultSubjects">{{ item.defaultSubjects.map(function(elem){return elem.name;}).join(',') }}</md-table-cell>
                        <md-table-cell md-label="Наименование" md-sort-by="idName">{{ item.idName }}</md-table-cell>
                        <md-table-cell md-label="Специальность" md-sort-by="speciality.fullName">{{ item.speciality.fullName }}</md-table-cell>
                    </md-table-row>

                </md-table>

                <!--                <p @click="snackbar.showSnackbar=true">Selected:</p>-->
                <!--                {{ selected }}-->

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
    .md-primary{
        background-color:#7e57c2 !important;
        color:#448aff;
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
        name: 'ManageGroups',
        data () {
            return {
                snackbar: {
                    showSnackbar: false,
                    position: 'center',
                    duration: 4000,
                    bg: 'background-color:rgba(33, 33, 33, 0.6)'
                },
                secondStyle:'',
                primaryStyle:'',
                primaryTextStyle:'',
                searchColumn: 'idName',
                errorMessage: '',
                specialityList:'',
                subjectList:'',
                editId: '',
                removeConfirm: false,
                add_id_name: '',
                add_speciality: '',
                add_curatorFIO: '',
                add_curatorPhone: '',
                add_headmanFIO: '',
                add_headmanPhone: '',
                add_default_subjects: [],
                edit_id_name: '',
                edit_speciality: '',
                edit_curatorFIO: '',
                edit_curatorPhone: '',
                edit_headmanFIO: '',
                edit_headmanPhone: '',
                edit_default_subjects: [],
                toggleModalAdd: false,
                toggleModalEdit: false,
                toggleModalSure: false,
                showEditButton: false,
                selected: [],
                search: null,
                searched: [],
                errors: [],
                dataSet: []
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
            onSelect (items) {
                this.selected = items;
                this.toggleShowEditButton(items);
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
            getAlternateLabel (count) {
                let plural = 'а';
                let plural2 = '';
                if (parseInt(count.toString().split('').pop()) === 1) {
                    plural = 'а';
                }else if (parseInt(count.toString().split('').pop()) > 1 && parseInt(count.toString().split('').pop()) < 5){
                    plural = 'ы';
                }else{
                    plural = '';
                }

                if(count > 10 && count < 21){
                    plural = '';
                }

                if(count!==1){
                    plural2 = 'о';
                }else{
                    plural2 = 'а';
                }

                return `Выделен${plural2} ${count} групп${plural}`;
            },
            searchOnTable () {
                if(this.searchColumn){
                    this.searched = searchByColumn(this.dataSet, this.search, this.searchColumn)
                }
            },
            clearSelected() {
                this.selected = [];
            },
            toggleShowEditButton : function(items) {
                if(items.length === 1){
                    this.showEditButton = true;
                    return;
                }
                this.showEditButton = false;
            },
            getGroups: function() {
                axios
                    .get('/getGroups')
                    .then(response => (this.dataSet = response.data))
                    .catch(e => {
                        this.errors.push(e)
                    });
            },
            createGroup: function() {
                axios
                    .post('/createGroup', {
                        idName: this.add_id_name,
                        speciality: this.add_speciality,
                        defaultSubjects: this.add_default_subjects,
                        curatorFIO: this.add_curatorFIO,
                        curatorPhone: this.add_curatorPhone,
                        headmanFIO: this.add_headmanFIO,
                        headmanPhone: this.add_headmanPhone,
                    })
                    .then(response => (this.dataSet.push(response.data)))
                    .catch(e => {
                        this.errors.push(e.response.data.errors);
                    });
                this.toggleModalAdd=false;
            },
            editGroup: function() {
                axios
                    .post('/editGroup', {
                        id: this.editId,
                        idName: this.edit_id_name,
                        speciality: this.edit_speciality,
                        defaultSubjects: this.edit_default_subjects,
                        curatorFIO: this.edit_curatorFIO,
                        curatorPhone: this.edit_curatorPhone,
                        headmanFIO: this.edit_headmanFIO,
                        headmanPhone: this.edit_headmanPhone,
                    })
                    .then(response => {
                        this.dataSet.forEach(function(el,index,arr){
                            if(el.id === response.data.id)
                            {
                                arr[index].idName = response.data.idName;
                                arr[index].speciality = response.data.speciality;
                                arr[index].defaultSubjects = response.data.defaultSubjects;
                                arr[index].headmanFIO = response.data.headman.fio;
                                arr[index].headmanPhone = response.data.headman.phone;
                                arr[index].curatorFIO = response.data.curator.fio;
                                arr[index].curatorPhone = response.data.curator.phone;
                            }
                        });
                    })
                    .catch(e => {
                        this.errors.push(e.response.data.errors);
                    });
                this.editId = '';
                this.edit_id_name = '';
                this.edit_speciality = '';
                this.edit_default_subjects = [];
                this.edit_curatorFIO = '';
                this.edit_curatorPhone = '';
                this.edit_headmanFIO = '';
                this.edit_headmanPhone = '';
                this.clearSelected();
                this.toggleModalEdit=false;
            },
            deleteGroups: function() {
                let allObjects = this.selected;
                allObjects.forEach(function(value,index,array){
                    array[index].speciality = array[index].speciality.id;
                    for(let i=0;i<array[index].defaultSubjects.length;i++)
                    {
                        array[index].defaultSubjects[i] = array[index].defaultSubjects[i].id;
                    }
                });
                axios
                    .post('/deleteGroups', {
                        objects: this.selected
                    })
                    .then(response => {
                        // this.dataSet.forEach(function(el,index,arr){
                        //     for(let i=0; i<response.data.length;i++)
                        //     {
                        //         if(el.id === response.data[i].id)
                        //         {
                        //             arr.splice(index, 1);
                        //         }
                        //     }
                        // });
                        this.getGroups();
                    })
                    .catch(e => {
                        this.errors.push(e)
                    });
                this.clearSelected();
                this.toggleModalSure=false;
            },
            editSelected: function() {
                if(this.selected.length === 1){
                    let element = this.selected[0];
                    let defSubjArr = [];
                    element.defaultSubjects.forEach(function(value,index,array){
                        defSubjArr.push(Object.values(array[index])[0]);
                    });
                    this.edit_id_name = element.idName;
                    this.edit_speciality = element.speciality.id;
                    this.edit_curatorFIO = element.curator.fio;
                    this.edit_curatorPhone = element.curator.phone;
                    this.edit_headmanFIO = element.headman.fio;
                    this.edit_headmanPhone = element.headman.phone;
                    this.edit_speciality = element.speciality.id;
                    this.edit_default_subjects = defSubjArr;
                    this.editId = element.id;
                    this.toggleModalEdit = true;
                }
            },
            onCancel: function() {
                this.toggleModalSure = false;
            },
            onConfirm: function() {
                this.deleteGroups();
                this.toggleModalSure = false;
            }
        },
        watch : {
            errors: function(val) {
                if(val){
                    this.errorMessage = val[0][Object.keys(val[0])[0]][0];
                }
                this.snackbar.showSnackbar=true;
            },
            dataSet: function (val) {
                this.searched = val;
            }
        },
        created () {
            this.getUserSession();
            this.getGroups();
            this.loadSpecialities();
            this.loadSubjects();
        }
    }
</script>
