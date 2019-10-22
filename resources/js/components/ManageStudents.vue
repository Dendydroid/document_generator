<template>
    <div class="container grey-light page-height-default">

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
                <md-dialog-title class="fb-center">Добавить студента</md-dialog-title>
                <div class="pl-2 pr-2 pb-3">
                    <md-field>
                        <label>Имя</label>
                        <md-input v-model="add_first_name" maxlength="255" ></md-input>
                        <span class="md-helper-text">Имя студента</span>
                    </md-field>
                    <md-field>
                        <label>Фимилия</label>
                        <md-input v-model="add_surname" maxlength="255" ></md-input>
                        <span class="md-helper-text">Фамилия студента</span>
                    </md-field>
                    <md-field>
                        <label>Отчество</label>
                        <md-input v-model="add_middle_name" maxlength="255" ></md-input>
                        <span class="md-helper-text">Отчество студента</span>
                    </md-field>
                    <md-field>
                        <label>Тип образования</label>
                        <md-input v-model="add_study_type" maxlength="255" ></md-input>
                        <span class="md-helper-text">Бакалавр, Магистр, ..</span>
                    </md-field>
                    <md-field>
                        <label>ИН</label>
                        <md-input v-model="add_student_id" maxlength="255" ></md-input>
                        <span class="md-helper-text">Индивидуальный номер студента</span>
                    </md-field>
                    <md-datepicker v-model="add_date_of_birth">
                        <label>Дата рождения</label>
                        <span class="md-helper-text">Дата рождения студента</span>
                    </md-datepicker>
                    <md-field>
                        <label>Пол</label>
                        <md-select v-model="add_gender" name="add_gender" id="add_gender">
                            <md-option value="Мужской">Мужской</md-option>
                            <md-option value="Женский">Женский</md-option>
                        </md-select>
                        <span class="md-helper-text">Пол студента</span>
                    </md-field>
                    <md-field>
                        <label>Гражданство</label>
                        <md-input v-model="add_citizenship" maxlength="255" ></md-input>
                        <span class="md-helper-text">Гражданство студента</span>
                    </md-field>
                    <md-field>
                        <label>Группа</label>
                        <md-select v-model="add_group">
                            <md-option v-for="group in groupList" :value="group.id">{{group.idName}}</md-option>
                        </md-select>
                    </md-field>
                    <span v-show="full_student_data">
                        <md-field>
                        <label>Семейное положение</label>
                        <md-input v-model="add_family_state" maxlength="255" ></md-input>
                        <span class="md-helper-text">Семейный положение студента</span>
                    </md-field>
                    <md-field>
                        <label>Адрес проживания семьи</label>
                        <md-input v-model="add_family_address" maxlength="255" ></md-input>
                        <span class="md-helper-text">Адрес проживания супруги/мужа, имя, год рождения детей</span>
                    </md-field>
                    <md-field>
                        <label>Адрес ПМЖ</label>
                        <md-input v-model="add_address_begin" maxlength="255" ></md-input>
                        <span class="md-helper-text">Адрес ПМЖ на момент поступления</span>
                    </md-field>
                    <md-field>
                        <label>Обучение до НАУ</label>
                        <md-input v-model="add_before_nau_edu" maxlength="255" ></md-input>
                        <span class="md-helper-text">УЗ, название, серия и № документа об образовании, иностранные языки</span>
                    </md-field>
                    <md-field>
                        <label>Работа до НАУ</label>
                        <md-input v-model="add_before_nau_job" maxlength="255" ></md-input>
                        <span class="md-helper-text">Где и кем работал(а), стаж, трудовая книга, №, когда и кем выдана</span>
                    </md-field>
                    <md-field>
                        <label>Военная служба</label>
                        <md-input v-model="add_military_service" maxlength="255" ></md-input>
                        <span class="md-helper-text">С какого по какой год</span>
                    </md-field>
                    <md-field>
                        <label>Условия поступления</label>
                        <md-input v-model="add_nau_conditions" maxlength="255" ></md-input>
                        <span class="md-helper-text">Лицей, на общих основаниях, по контракту</span>
                    </md-field>
                    <md-field>
                        <label>№ и дата договора</label>
                        <md-input v-model="add_nau_contract" maxlength="255" ></md-input>
                        <span class="md-helper-text">№ и дата договора об обучении</span>
                    </md-field>
                    <md-field>
                        <label>Льготы</label>
                        <md-input v-model="add_nau_privileges" maxlength="255" ></md-input>
                        <span class="md-helper-text">Льготы в соответствии с действующим законом</span>
                    </md-field>
                    <md-field>
                        <label>Общажитие</label>
                        <md-input v-model="add_hostel" maxlength="255" ></md-input>
                        <span class="md-helper-text">Общажитие, комната проживания</span>
                    </md-field>
                    <md-field>
                        <label>Дополнительная информация</label>
                        <md-input v-model="add_additional_info" maxlength="255" ></md-input>
                        <span class="md-helper-text">Номер телефона и т.д.</span>
                    </md-field>
                    <md-field>
                        <label>Дополнительные предметы</label>
                        <md-select v-model="add_additional_subjects" multiple>
                            <md-option v-for="subject in subjectList" :value="subject.id">{{subject.name}}</md-option>
                        </md-select>
                    </md-field>
                    </span>
                </div>
                <div class="buttons pb-3">
                    <md-button  class="md-primary md-raised" @click="createStudent()">Сохранить</md-button>
                    <md-button class="md-accent md-raised" @click="toggleModalAdd=false">Отмена</md-button>
                </div>
            </md-dialog>

            <md-dialog :md-active.sync="toggleModalEdit" class="pl-5 pr-5 of-auto" md-scrollbar>
                <md-dialog-title class="fb-center">Изменить студента</md-dialog-title>
                <div class="pl-2 pr-2 pb-3">
                    <md-field>
                        <label>Имя</label>
                        <md-input v-model="edit_first_name" maxlength="255" ></md-input>
                        <span class="md-helper-text">Имя студента</span>
                    </md-field>
                    <md-field>
                        <label>Фимилия</label>
                        <md-input v-model="edit_surname" maxlength="255" ></md-input>
                        <span class="md-helper-text">Фамилия студента</span>
                    </md-field>
                    <md-field>
                        <label>Отчество</label>
                        <md-input v-model="edit_middle_name" maxlength="255" ></md-input>
                        <span class="md-helper-text">Отчество студента</span>
                    </md-field>
                    <md-field>
                        <label>Тип образования</label>
                        <md-input v-model="edit_study_type" maxlength="255" ></md-input>
                        <span class="md-helper-text">Бакалавр, Магистр, ..</span>
                    </md-field>
                    <md-field>
                        <label>ИН</label>
                        <md-input v-model="edit_student_id" maxlength="255" ></md-input>
                        <span class="md-helper-text">Индивидуальный номер студента</span>
                    </md-field>
                    <md-datepicker v-model="edit_date_of_birth">
                        <label>Дата рождения</label>
                        <span class="md-helper-text">Дата рождения студента</span>
                    </md-datepicker>
                    <md-field>
                        <label>Пол</label>
                        <md-select v-model="edit_gender" name="add_gender" id="add_gender">
                            <md-option value="Мужской">Мужской</md-option>
                            <md-option value="Женский">Женский</md-option>
                        </md-select>
                        <span class="md-helper-text">Пол студента</span>
                    </md-field>
                    <md-field>
                        <label>Гражданство</label>
                        <md-input v-model="edit_citizenship" maxlength="255" ></md-input>
                        <span class="md-helper-text">Гражданство студента</span>
                    </md-field>
                    <md-field>
                        <label>Группа</label>
                        <md-select v-model="edit_group">
                            <md-option v-for="group in groupList" :value="group.id">{{group.idName}}</md-option>
                        </md-select>
                    </md-field>
                    <span v-show="full_student_data">
                        <md-field>
                        <label>Семейное положение</label>
                        <md-input v-model="edit_family_state" maxlength="255" ></md-input>
                        <span class="md-helper-text">Семейный положение студента</span>
                    </md-field>
                    <md-field>
                        <label>Адрес проживания семьи</label>
                        <md-input v-model="edit_family_address" maxlength="255" ></md-input>
                        <span class="md-helper-text">Адрес проживания супруги/мужа, имя, год рождения детей</span>
                    </md-field>
                    <md-field>
                        <label>Адрес ПМЖ</label>
                        <md-input v-model="edit_address_begin" maxlength="255" ></md-input>
                        <span class="md-helper-text">Адрес ПМЖ на момент поступления</span>
                    </md-field>
                    <md-field>
                        <label>Обучение до НАУ</label>
                        <md-input v-model="edit_before_nau_edu" maxlength="255" ></md-input>
                        <span class="md-helper-text">УЗ, название, серия и № документа об образовании, иностранные языки</span>
                    </md-field>
                    <md-field>
                        <label>Работа до НАУ</label>
                        <md-input v-model="edit_before_nau_job" maxlength="255" ></md-input>
                        <span class="md-helper-text">Где и кем работал(а), стаж, трудовая книга, №, когда и кем выдана</span>
                    </md-field>
                    <md-field>
                        <label>Военная служба</label>
                        <md-input v-model="edit_military_service" maxlength="255" ></md-input>
                        <span class="md-helper-text">С какого по какой год</span>
                    </md-field>
                    <md-field>
                        <label>Условия поступления</label>
                        <md-input v-model="edit_nau_conditions" maxlength="255" ></md-input>
                        <span class="md-helper-text">Лицей, на общих основаниях, по контракту</span>
                    </md-field>
                    <md-field>
                        <label>№ и дата договора</label>
                        <md-input v-model="edit_nau_contract" maxlength="255" ></md-input>
                        <span class="md-helper-text">№ и дата договора об обучении</span>
                    </md-field>
                    <md-field>
                        <label>Льготы</label>
                        <md-input v-model="edit_nau_privileges" maxlength="255" ></md-input>
                        <span class="md-helper-text">Льготы в соответствии с действующим законом</span>
                    </md-field>
                    <md-field>
                        <label>Общажитие</label>
                        <md-input v-model="edit_hostel" maxlength="255" ></md-input>
                        <span class="md-helper-text">Общажитие, комната проживания</span>
                    </md-field>
                    <md-field>
                        <label>Дополнительная информация</label>
                        <md-input v-model="edit_additional_info" maxlength="255" ></md-input>
                        <span class="md-helper-text">Номер телефона и т.д.</span>
                    </md-field>
                    <md-field>
                        <label>Дополнительные предметы</label>
                        <md-select v-model="edit_additional_subjects" multiple>
                            <md-option v-for="subject in subjectList" :value="subject.id">{{subject.name}}</md-option>
                        </md-select>
                    </md-field>
                    </span>
                </div>
                <div class="buttons pb-3">
                    <md-button  class="md-primary md-raised" @click="editStudent()">Сохранить</md-button>
                    <md-button class="md-accent md-raised" @click="toggleModalEdit=false">Отмена</md-button>
                </div>
            </md-dialog>




            <md-card>
                <md-card-header>
                    <div class="md-title">
                        Студенты
                    </div>
                    <div class="md-subhead">
                        Управление данными
                    </div>
                </md-card-header>
                <md-card-content>
                    <div class="buttons">
                        <span>
                            <md-switch v-model="full_student_data">Полное заполнение</md-switch>
                            <md-button  class="md-raised md-primary" v-on:click="toggleModalAdd=true">
                                Добавить
                            </md-button>
                        </span>
                        <md-button  class="md-icon-button md-dense md-raised md-primary upd-icon" @click="getGroups()">
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
                            <md-input placeholder="Поиск по фамилии.." v-model="search" @input="searchOnTable" />
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
                        md-label="Студенты не найдены"
                        :md-description="'Не было найдено ни одного студента. Измените запрос или создайте нового студента.'">
                        <md-button  class="md-primary md-raised" v-on:click="toggleModalAdd=true">Добавить</md-button>
                    </md-table-empty-state>

                    <md-table-row slot="md-table-row" slot-scope="{ item }" md-selectable="multiple" md-auto-select>
                        <md-table-cell md-label="ID" md-sort-by="id" md-numeric>{{ item.id }}</md-table-cell>
                        <md-table-cell md-label="ФИО" md-sort-by="surname">{{ item.surname + " " + item.firstName + " " + item.middleName }}</md-table-cell>
                        <md-table-cell md-label="ИН" md-sort-by="idNumber">{{ item.studentId }}</md-table-cell>
                        <md-table-cell md-label="Пол" md-sort-by="gender">{{ item.gender }}</md-table-cell>
                        <md-table-cell md-label="Гражданство" md-sort-by="citizenship">{{ item.citizenship }}</md-table-cell>
                        <md-table-cell md-label="Дата рождения" md-sort-by="dateOfBirth">{{ item.dateOfBirth }}</md-table-cell>
                        <md-table-cell md-label="Группа" md-sort-by="item.group.id">{{ item.group.idName }}</md-table-cell>
<!--                        <md-table-cell md-label="Предметы" md-sort-by="defaultSubjects">{{ item.additionalSubjects.map(function(elem){return elem.name;}).join(',') }}</md-table-cell>-->
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
        name: 'ManageStudents',
        data () {
            return {
                snackbar: {
                    showSnackbar: false,
                    position: 'center',
                    duration: 4000,
                    bg: 'background-color:rgba(33, 33, 33, 0.6)'
                },
                full_student_data: false,
                searchColumn: 'idName',
                errorMessage: '',
                groupList:'',
                subjectList:'',
                editId: '',
                removeConfirm: false,
                add_first_name: '',
                add_surname: '',
                add_middle_name: '',
                add_student_id: '',
                add_date_of_birth: '',
                add_gender: '',
                add_citizenship: '',
                add_group: '',
                add_family_state: '',
                add_family_address: '',
                add_address_begin: '',
                add_before_nau_edu: '',
                add_before_nau_job: '',
                add_military_service: '',
                add_nau_conditions: '',
                add_nau_contract: '',
                add_nau_privileges: '',
                add_hostel: '',
                add_additional_info: '',
                add_additional_subjects: [],
                add_study_type:'',
                edit_study_type:'',
                edit_first_name: '',
                edit_surname: '',
                edit_middle_name: '',
                edit_student_id: '',
                edit_date_of_birth: '',
                edit_gender: '',
                edit_citizenship: '',
                edit_group: '',
                edit_family_state: '',
                edit_family_address: '',
                edit_address_begin: '',
                edit_before_nau_edu: '',
                edit_before_nau_job: '',
                edit_military_service: '',
                edit_nau_conditions: '',
                edit_nau_contract: '',
                edit_nau_privileges: '',
                edit_hostel: '',
                edit_additional_info: '',
                edit_additional_subjects: [],
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
            loadGroups() {
                axios
                    .get('/getGroups')
                    .then(response => (this.groupList = response.data))
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

                return `Выделен${plural2} ${count} студент${plural}`;
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
            getStudents: function() {
                axios
                    .get('/getStudents')
                    .then(response => (this.dataSet = response.data))
                    .catch(e => {
                        this.errors.push(e)
                    });
            },
            createStudent: function() {
                axios
                    .post('/createStudent', {
                        firstName: this.add_first_name,
                        surname: this.add_surname,
                        middleName: this.add_middle_name,
                        studentId: this.add_student_id,
                        dateOfBirth: this.add_date_of_birth,
                        gender: this.add_gender,
                        citizenship: this.add_citizenship,
                        group: this.add_group,
                        familyState: this.add_family_state,
                        familyAddress: this.add_family_address,
                        addressBegin: this.add_address_begin,
                        beforeNauEdu: this.add_before_nau_edu,
                        beforeNauJob: this.add_before_nau_job,
                        militaryService: this.add_military_service,
                        nauConditions: this.add_nau_conditions,
                        nauContract: this.add_nau_contract,
                        nauPrivileges: this.add_nau_privileges,
                        hostel: this.add_hostel,
                        additionalInfo: this.add_additional_info,
                        additionalSubjects: this.add_additional_subjects,
                        studyType:this.add_study_type
                    })
                    .then(response => (this.dataSet.push(response.data)))
                    .catch(e => {
                        this.errors.push(e.response.data.errors);
                    });
                this.toggleModalAdd=false;
            },
            editStudent: function() {
                axios
                    .post('/editStudent', {
                        id: this.editId,
                        firstName: this.edit_first_name,
                        surname: this.edit_surname,
                        middleName: this.edit_middle_name,
                        studentId: this.edit_student_id,
                        dateOfBirth: this.edit_date_of_birth,
                        gender: this.edit_gender,
                        citizenship: this.edit_citizenship,
                        group: this.edit_group,
                        familyState: this.edit_family_state,
                        familyAddress: this.edit_family_address,
                        addressBegin: this.edit_address_begin,
                        beforeNauEdu: this.edit_before_nau_edu,
                        beforeNauJob: this.edit_before_nau_job,
                        militaryService: this.edit_military_service,
                        nauConditions: this.edit_nau_conditions,
                        nauContract: this.edit_nau_contract,
                        nauPrivileges: this.edit_nau_privileges,
                        hostel: this.edit_hostel,
                        additionalInfo: this.edit_additional_info,
                        additionalSubjects: this.edit_additional_subjects,
                        studyType: this.edit_study_type,
                    })
                    .then(response => {
                        // this.dataSet.forEach(function(el,index,arr){
                        //     if(el.id === response.data.id)
                        //     {
                        //         arr[index].idName = response.data.idName;
                        //         arr[index].speciality = response.data.speciality;
                        //         arr[index].defaultSubjects = response.data.defaultSubjects;
                        //     }
                        // });
                        this.getStudents();
                    })
                    .catch(e => {
                        this.errors.push(e.response.data.errors);
                    });
                this.editId = '';
                this.edit_first_name = '';
                this.edit_surname = '';
                this.edit_middle_name = '';
                this.edit_student_id = '';
                this.edit_date_of_birth = '';
                this.edit_gender = '';
                this.edit_citizenship = '';
                this.edit_group = '';
                this.edit_family_state = '';
                this.edit_family_address = '';
                this.edit_address_begin = '';
                this.edit_before_nau_edu = '';
                this.edit_before_nau_job = '';
                this.edit_military_service = '';
                this.edit_nau_conditions = '';
                this.edit_nau_contract = '';
                this.edit_nau_privileges = '';
                this.edit_hostel = '';
                this.edit_additional_info = '';
                this.edit_additional_subjects = '';
                this.edit_study_type = '';
                this.clearSelected();
                this.toggleModalEdit=false;
            },
            deleteStudents: function() {
                let allObjects = this.selected;
                allObjects.forEach(function(value,index,array){
                    array[index].group = array[index].group.id;
                    for(let i=0;i<array[index].additionalSubjects.length;i++)
                    {
                        array[index].additionalSubjects[i] = array[index].additionalSubjects[i].id;
                    }
                });
                axios
                    .post('/deleteStudents', {
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
                        this.getStudents();
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
                    element.additionalSubjects.forEach(function(value,index,array){
                        defSubjArr.push(Object.values(array[index])[0]);
                    });
                    this.edit_additional_subjects = defSubjArr;
                    this.editId = element.id;
                    this.edit_first_name = element.firstName;
                    this.edit_surname = element.surname;
                    this.edit_middle_name = element.middleName;
                    this.edit_student_id = element.studentId;
                    this.edit_date_of_birth = element.dateOfBirth;
                    this.edit_gender = element.gender;
                    this.edit_citizenship = element.citizenship;
                    this.edit_group = element.group.id;
                    this.edit_family_state = element.familyState;
                    this.edit_family_address = element.familyAddress;
                    this.edit_address_begin = element.addressBegin;
                    this.edit_before_nau_edu = element.beforeNauEdu;
                    this.edit_before_nau_job = element.beforeNauJob;
                    this.edit_military_service = element.militaryService;
                    this.edit_nau_conditions = element.nauConditions;
                    this.edit_nau_contract = element.nauContract;
                    this.edit_nau_privileges = element.nauPrivileges;
                    this.edit_hostel = element.hostel;
                    this.edit_additional_info = element.additionalInfo;
                    this.edit_study_type = element.studyType;
                    this.toggleModalEdit = true;
                }
            },
            onCancel: function() {
                this.toggleModalSure = false;
            },
            onConfirm: function() {
                this.deleteStudents();
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
            this.getStudents();
            this.loadGroups();
            this.loadSubjects();
        }
    }
</script>
