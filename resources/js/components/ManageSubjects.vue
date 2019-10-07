<template>
    <div class="container grey-light page-height-default" >

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
                    Эта операция <span class="c-r">необратима</span>, нажимая '<span class="c-p">подтвердить</span>' <br> вы безвозвратно удаляете запись/записи.
                </div>
                <div class="buttons pb-3 pl-2 pr-2">
                    <md-button  class="md-primary md-raised" @click="onConfirm()">Подтвердить</md-button>
                    <md-button class="md-accent md-raised" @click="onCancel()">Отмена</md-button>
                </div>
            </md-dialog>

            <md-dialog :md-active.sync="toggleModalAdd" class="pl-5 pr-5 of-auto" md-scrollbar>
                <md-dialog-title class="fb-center">Добавить предмет</md-dialog-title>
                <div class="pl-2 pr-2 pb-3">
                    <md-field>
                        <label>Наименование</label>
                        <md-input v-model="add_name" maxlength="255" required></md-input>
                        <span class="md-helper-text">Имя, Название</span>
                    </md-field>
                    <md-field>
                        <label>Преподователь</label>
                        <md-input v-model="add_professor" maxlength="255" required></md-input>
                        <span class="md-helper-text">Имя преподавателя</span>
                    </md-field>
                    <md-field>
                        <label>Заведующий кафедры</label>
                        <md-input v-model="add_head_of_department" maxlength="255" required></md-input>
                        <span class="md-helper-text">Имя заведующего кафедры</span>
                    </md-field>
                    <md-field>
                        <label>Модули</label>
                        <md-input v-model="add_module_count" type="number" min="1" required></md-input>
                        <span class="md-helper-text">Количество модулей</span>
                    </md-field>
                    <md-field>
                        <label>Часы</label>
                        <md-input v-model="add_hours_count" type="number" min="1" required></md-input>
                        <span class="md-helper-text">Количество часов</span>
                    </md-field>
                    <md-field>
                        <label>Кредиты</label>
                        <md-input v-model="add_credits_count" type="number" min="1" required></md-input>
                        <span class="md-helper-text">Количество кредитов</span>
                    </md-field>

                    <md-datepicker v-model="add_begin_date">
                        <label>От</label>
                        <span class="md-helper-text">Дата начала обучения</span>
                    </md-datepicker>
                </div>
                <div class="buttons pb-3">
                    <md-button  class="md-primary md-raised" @click="createSubject()">Сохранить</md-button>
                    <md-button class="md-accent md-raised" @click="toggleModalAdd=false">Отмена</md-button>
                </div>
            </md-dialog>

            <md-dialog :md-active.sync="toggleModalEdit" class="pl-5 pr-5 of-auto" md-scrollbar>
                <md-dialog-title class="fb-center">Изменить предмет</md-dialog-title>
                <div class="pl-2 pr-2 pb-3">
                    <md-field>
                        <label>Наименование</label>
                        <md-input v-model="edit_name" maxlength="255" required></md-input>
                        <span class="md-helper-text">Имя, Название</span>
                    </md-field>
                    <md-field>
                        <label>Преподователь</label>
                        <md-input v-model="edit_professor" maxlength="255" required></md-input>
                        <span class="md-helper-text">Имя преподавателя</span>
                    </md-field>
                    <md-field>
                        <label>Заведующий кафедры</label>
                        <md-input v-model="edit_head_of_department" maxlength="255" required></md-input>
                        <span class="md-helper-text">Имя заведующего кафедры</span>
                    </md-field>
                    <md-field>
                        <label>Модули</label>
                        <md-input v-model="edit_module_count" type="number" min="1" required></md-input>
                        <span class="md-helper-text">Количество модулей</span>
                    </md-field>
                    <md-field>
                        <label>Часы</label>
                        <md-input v-model="edit_hours_count" type="number" min="1" required></md-input>
                        <span class="md-helper-text">Количество часов</span>
                    </md-field>
                    <md-field>
                        <label>Кредиты</label>
                        <md-input v-model="edit_credits_count" type="number" min="1" required></md-input>
                        <span class="md-helper-text">Количество кредитов</span>
                    </md-field>
                    <md-datepicker v-model="edit_begin_date" required>
                        <label>От</label>
                        <span class="md-helper-text">Дата начала обучения</span>
                    </md-datepicker>
                </div>
                <div class="buttons pb-3">
                    <md-button  class="md-primary md-raised" @click="editSubject()">Сохранить</md-button>
                    <md-button class="md-accent md-raised" @click="toggleModalEdit=false">Отмена</md-button>
                </div>
            </md-dialog>




            <md-card>
                <md-card-header>
                    <div class="md-title">
                        Предметы
                    </div>
                    <div class="md-subhead">
                        Управление данными
                    </div>
                </md-card-header>
                <md-card-content>
                    <div class="buttons">
                        <md-button  class="md-raised md-primary" v-on:click="toggleModalAdd=true">
                            Добавить
                        </md-button>
                        <md-button  class="md-icon-button md-dense md-raised md-primary upd-icon" @click="getSubjects()">
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
                        md-label="Предметы не найдены"
                        :md-description="'Не было найдено ни одного предмета. Измените запрос или создайте новый предмет.'">
                        <md-button  class="md-primary md-raised" v-on:click="toggleModalAdd=true">Добавить</md-button>
                    </md-table-empty-state>

                    <md-table-row slot="md-table-row" slot-scope="{ item }" md-selectable="multiple" md-auto-select>
                        <md-table-cell md-label="ID" md-sort-by="id" md-numeric>{{ item.id }}</md-table-cell>
                        <md-table-cell md-label="Наименование" md-sort-by="name">{{ item.name }}</md-table-cell>
                        <md-table-cell md-label="Преподователь" md-sort-by="professor">{{ item.professor }}</md-table-cell>
                        <md-table-cell md-label="Зав. кафедры" md-sort-by="headOfDepartment">{{ item.headOfDepartment }}</md-table-cell>
                        <md-table-cell md-label="Кол-во модулей" md-sort-by="moduleCount">{{ item.moduleCount }}</md-table-cell>
                        <md-table-cell md-label="Кол-во часов" md-sort-by="hoursCount">{{ item.hoursCount }}</md-table-cell>
                        <md-table-cell md-label="Кол-во кредитов" md-sort-by="creditsCount">{{ item.creditsCount }}</md-table-cell>
                        <md-table-cell md-label="Дата начала" md-sort-by="dateBegin">{{ item.dateBegin }}</md-table-cell>
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
        name: 'ManageSubjects',
        data () {
            return {
                snackbar: {
                    showSnackbar: false,
                    position: 'center',
                    duration: 4000,
                    bg: 'background-color:rgba(33, 33, 33, 0.6)'
                },
                searchColumn: 'name',
                errorMessage: '',
                facultyList:'',
                editId: '',
                removeConfirm: false,
                add_name: '',
                add_professor: '',
                add_head_of_department: '',
                add_module_count: '',
                add_hours_count: '',
                add_credits_count: '',
                add_begin_date: '',
                edit_name: '',
                edit_professor: '',
                edit_head_of_department: '',
                edit_module_count: '',
                edit_hours_count: '',
                edit_credits_count: '',
                edit_begin_date: '',
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
            onSelect (items) {
                this.selected = items;
                this.toggleShowEditButton(items);
            },
            getAlternateLabel (count) {
                let plural = '';
                let plural2 = '';
                if (parseInt(count.toString().split('').pop()) === 1) {
                    plural = '';
                }else if (parseInt(count.toString().split('').pop()) > 1 && parseInt(count.toString().split('').pop()) < 5){
                    plural = 'а';
                }else{
                    plural = 'ов';
                }

                if(count > 10 && count < 21){
                    plural = 'ов';
                }

                if(count!==1){
                    plural2 = 'о';
                }else{
                    plural2 = '';
                }

                return `Выделен${plural2} ${count} предмет${plural}`;
            },
            searchOnTable () {
                if(this.searchColumn){
                    this.searched = searchByColumn(this.dataSet, this.search, this.searchColumn)
                }
            },
            clearSelected() {
                this.selected = [];
            },
            // editSelected() {},
            toggleShowEditButton : function(items) {
                if(items.length === 1){
                    this.showEditButton = true;
                    return;
                }
                this.showEditButton = false;
            },
            getSubjects: function() {
                axios
                    .get('/getSubjects')
                    .then(response => (this.dataSet = response.data))
                    .catch(e => {
                        this.errors.push(e)
                    });
            },
            createSubject: function() {
                axios
                    .post('/createSubject', {
                        name: this.add_name,
                        professor: this.add_professor,
                        headOfDepartment: this.add_head_of_department,
                        moduleCount: this.add_module_count,
                        hoursCount: this.add_hours_count,
                        creditsCount: this.add_credits_count,
                        date: this.add_begin_date,
                    })
                    .then(response => (this.dataSet.push(response.data)))
                    .catch(e => {
                        this.errors.push(e.response.data.errors);
                    });
                this.toggleModalAdd=false;
            },
            editSubject: function() {
                axios
                    .post('/editSubject', {
                        id: this.editId,
                        name: this.edit_name,
                        professor: this.edit_professor,
                        headOfDepartment: this.edit_head_of_department,
                        moduleCount: this.edit_module_count,
                        hoursCount: this.edit_hours_count,
                        creditsCount: this.edit_credits_count,
                        date: this.edit_begin_date,
                    })
                    .then(response => {
                        this.dataSet.forEach(function(el,index,arr){
                            if(el.id === response.data.id)
                            {
                                arr[index].name = response.data.name;
                                arr[index].professor = response.data.professor;
                                arr[index].headOfDepartment = response.data.headOfDepartment;
                                arr[index].moduleCount = response.data.moduleCount;
                                arr[index].hoursCount = response.data.hoursCount;
                                arr[index].creditsCount = response.data.creditsCount;
                                arr[index].dateBegin = response.data.dateBegin;
                            }
                        });
                    })
                    .catch(e => {
                        this.errors.push(e.response.data.errors);
                    });
                this.editId = '';
                this.edit_name = '';
                this.edit_professor = '';
                this.edit_head_of_department = '';
                this.edit_module_count = '';
                this.edit_hours_count = '';
                this.edit_credits_count = '';
                this.edit_begin_date = '';
                this.clearSelected();
                this.toggleModalEdit=false;
            },
            deleteSubjects: function() {
                axios
                    .post('/deleteSubjects', {
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
                        this.getSubjects();
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
                    this.edit_name = element.name;
                    this.edit_professor = element.professor;
                    this.edit_head_of_department = element.headOfDepartment;
                    this.edit_module_count = element.moduleCount;
                    this.edit_hours_count = element.hoursCount;
                    this.edit_credits_count = element.creditsCount;
                    this.edit_begin_date = element.dateBegin;
                    this.editId = element.id;
                    this.toggleModalEdit = true;
                }
            },
            onCancel: function() {
                this.toggleModalSure = false;
            },
            onConfirm: function() {
                this.deleteSubjects();
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
            this.getSubjects();
        }
    }
</script>
