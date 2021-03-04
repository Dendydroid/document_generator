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
                    Эта операция <span class="c-r">необратима</span>, нажимая '<span class="c-p"  >подтвердить</span>' <br> вы безвозвратно удаляете запись/записи.
                </div>
                <div class="buttons pb-3 pl-2 pr-2">
                    <md-button  class="md-primary md-raised" @click="onConfirm()">Подтвердить</md-button>
                    <md-button class="md-accent md-raised" @click="onCancel()">Отмена</md-button>
                </div>
            </md-dialog>

            <md-dialog :md-active.sync="toggleModalAdd" class="pl-5 pr-5 of-auto" md-scrollbar>
                <md-dialog-title class="fb-center">Добавить кафедру</md-dialog-title>
                <div class="pl-2 pr-2 pb-3 slider-vertical">
                    <md-field>
                        <label>Наименование</label>
                        <md-input v-model="add_fullName" maxlength="255" ></md-input>
                        <span class="md-helper-text" required>Имя, Название</span>
                    </md-field>
                    <md-field>
                        <label>Аббревиатура</label>
                        <md-input v-model="add_abbreviation" maxlength="255" required></md-input>
                        <span class="md-helper-text">Сокращенное имя</span>
                    </md-field>
                    <md-field>
                        <label>Декан кафедры</label>
                        <md-input v-model="add_head" maxlength="255" required></md-input>
                        <span class="md-helper-text">ФИО декана кафедры</span>
                    </md-field>
                </div>
                <div class="buttons pb-3">
                    <md-button  class="md-primary md-raised" @click="createDepartment()">Сохранить</md-button>
                    <md-button class="md-accent md-raised" @click="toggleModalAdd=false">Отмена</md-button>
                </div>
            </md-dialog>

            <md-dialog :md-active.sync="toggleModalEdit" class="pl-5 pr-5 of-auto" md-scrollbar>
                <md-dialog-title class="fb-center">Изменить кафедру</md-dialog-title>
                <div class="pl-2 pr-2 pb-3 slider-vertical">
                    <md-field>
                        <label>Наименование</label>
                        <md-input v-model="edit_fullName" maxlength="255" required></md-input>
                        <span class="md-helper-text">Имя, Название</span>
                    </md-field>
                    <md-field>
                        <label>Аббревиатура</label>
                        <md-input v-model="edit_abbreviation" maxlength="255" required></md-input>
                        <span class="md-helper-text">Сокращенное имя</span>
                    </md-field>
                    <md-field>
                        <label>Декан кафедры</label>
                        <md-input v-model="edit_head" maxlength="255" required></md-input>
                        <span class="md-helper-text">ФИО декана кафедры</span>
                    </md-field>
                </div>
                <div class="buttons pb-3">
                    <md-button  class="md-primary md-raised" @click="editDepartment()">Сохранить</md-button>
                    <md-button class="md-accent md-raised" @click="toggleModalEdit=false">Отмена</md-button>
                </div>
            </md-dialog>




            <md-card>
                <md-card-header>
                    <div class="md-title">
                        Кафедры
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
                        <md-button  class="md-icon-button md-dense md-raised md-primary upd-icon" @click="getDepartments()">
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
                        md-label="Кафедры не найдены"
                        :md-description="'Не было найдено ни одной кафедры. Измените запрос или создайте новую кафедру.'">
                        <md-button  class="md-primary md-raised" v-on:click="toggleModalAdd=true">Добавить</md-button>
                    </md-table-empty-state>

                    <md-table-row slot="md-table-row" slot-scope="{ item }" md-selectable="multiple" md-auto-select>
                        <md-table-cell md-label="ID" md-sort-by="id" md-numeric>{{ item.id }}</md-table-cell>
                        <md-table-cell md-label="Наименование" md-sort-by="fullName">{{ item.fullName }}</md-table-cell>
                        <md-table-cell md-label="Аббревиатура" md-sort-by="abbreviation">{{ item.abbreviation }}</md-table-cell>
                        <md-table-cell md-label="Декан кафедры" md-sort-by="head">{{ item.head }}</md-table-cell>
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
        name: 'ManageDepartments',
        data () {
            return {
                snackbar: {
                    showSnackbar: false,
                    position: 'center',
                    duration: 4000,
                    bg: 'background-color:rgba(33, 33, 33, 0.6)'
                },
                searchColumn: 'fullName',
                errorMessage: '',
                editId: '',
                removeConfirm: false,
                add_fullName: '',
                add_abbreviation: '',
                add_head: '',
                edit_fullName: '',
                edit_abbreviation: '',
                edit_head: '',
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
                let plural2 = 'а';
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

                return `Выделен${plural2} ${count} кафедр${plural}`;
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
            getDepartments: function() {
                axios
                    .get('/getDepartments')
                    .then(response => (this.dataSet = response.data))
                    .catch(e => {
                        this.errors.push(e)
                    });
            },
            createDepartment: function() {
                axios
                    .post('/createDepartment', {
                        fullName: this.add_fullName,
                        abbreviation: this.add_abbreviation,
                        head: this.add_head
                    })
                    .then(response => (this.dataSet.push(response.data)))
                    .catch(e => {
                        this.errors.push(e.response.data.errors);
                    });
                this.toggleModalAdd=false;
            },
            editDepartment: function() {
                axios
                    .post('/editDepartment', {
                        id: this.editId,
                        fullName: this.edit_fullName,
                        abbreviation: this.edit_abbreviation,
                        head: this.edit_head
                    })
                    .then(response => {
                        this.dataSet.forEach(function(el,index,arr){
                            if(el.id === response.data.id)
                            {
                                arr[index].fullName = response.data.fullName;
                                arr[index].abbreviation = response.data.abbreviation;
                                arr[index].head = response.data.head;
                            }
                        });
                    })
                    .catch(e => {
                        this.errors.push(e.response.data.errors);
                    });
                this.editId = '';
                this.edit_fullName = '';
                this.edit_abbreviation = '';
                this.edit_head = '';
                this.clearSelected();
                this.toggleModalEdit=false;
            },
            deleteDepartments: function() {
                axios
                    .post('/deleteDepartments', {
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
                        this.getDepartments();
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
                    this.edit_fullName = element.fullName;
                    this.edit_abbreviation = element.abbreviation;
                    this.edit_head = element.head;
                    this.editId = element.id;
                    this.toggleModalEdit = true;
                }
            },
            onCancel: function() {
                this.toggleModalSure = false;
            },
            onConfirm: function() {
                this.deleteDepartments();
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
            this.getDepartments();
        }
    }
</script>
