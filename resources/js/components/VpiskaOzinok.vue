<template>
    <div class="container grey-light page-height-default">
        <div class="p-t-b">
            <p class="display-4 text-center">Виписки оцiнок</p>
            <div class="row pl-3 pr-3 pt-3">
                <div class="col-4">
                    <md-field>
                        <label>Выберите&nbsp;группу</label>
                        <md-select v-model="chosenGroup" name="chosenGroup" id="chosenGroup">
                            <md-option v-for="group in groupList" :value="group.id">{{group.idName}}</md-option>
                        </md-select>
                    </md-field>
                </div>
                <div class="col-4" v-show="groupIsChosen">
                    <md-field>
                        <label>Выберите&nbsp;предмет</label>
                        <md-select v-model="chosenSubject" name="chosenSubject" id="chosenSubject">
                            <md-option v-for="subject in groupSubjects" :value="subject.id">{{subject.name}}</md-option>
                        </md-select>
                    </md-field>
                </div>
                <div class="col-4 center-button" v-show="subjectIsChosen">
                    <form action="http://127.0.0.1:5000/html2Excel" method="POST"><!-- "<style>"+$("style:last").html()+"</style>"+" "+$("#tableWrapper").html() -->
                        <input type="text" name="html" v-model="requestTable" style="display:none">
                        <md-button type="submit" class="md-dense md-raised md-primary" @click='prepareTable()'>Генерировать</md-button>
                    </form>

                </div>
            </div>

            <md-card id="tableWrapper">
                <table lang="uk-UK" id="documentTable">
                    <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <!--                        tr.tr-doc*45>td*13>{&nbsp;} -->
                    <tr>
                        <td colspan="13" class="cntr bold italic" style="font-size: 20px;">МІНІСТЕРСТВО ОСВІТИ І НАУКИ УКРАЇНИ</td>
                    </tr>
                    <tr>
                        <td colspan="13" class="cntr bold italic" style="font-size: 18px;">Національний авіайійний університет</td>
                    </tr>
                    <tr>
                        <td colspan="13" class="cntr bold italic" style="font-size: 18px;">Факультет кібербезпеки, комп'ютерної та програмної інженерії</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="13" class="cntr bold italic" style="font-size: 18px;">Витяг з навчальної картки</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="6" class="bold italic">студентки 2-го <!-- номер курса --> курсу 217 <!-- номер группы --> групи</td>
                        <td colspan="6" class="bold cntr italic">Іваненко Івани Іванівни <!-- ФИО студента --></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="6"></td>
                        <td colspan="6" class="cntr italic">(П.І.Б)</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="3" class="bold italic">яка навчається за спеціальністю</td>
                        <td colspan="3" class="bold italic">125 Кібербезпека <!-- Номер специальности --></td>
                        <td colspan="6" class="bold italic cntr italic">Адміністративний менеджмент у сфері захисту інформації <!-- Название специальности --></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="3"></td>
                        <td colspan="3" class="italic">(назва спеціальності)</td>
                        <td colspan="6" class="italic cntr italic">(назва спеціальності)</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>

                    <tr style="border = 1px;">
                        <td rotate rowspan="2" colspan="1" class="italic cntr border-3-black rotate">Навчальний рік</td>
                        <td rotate rowspan="2" colspan="1" class="italic cntr border-3-black rotate">Семестр</td>
                        <td rotate rowspan="2" colspan="1" class="italic cntr border-3-black rotate">№ п/п</td>
                        <td rowspan="2" colspan="3" class="cntr italic border-3-black">Назва навчальної дисципліни, практики</td>
                        <td colspan="2" class="cntr italic border-3-black">обсяг</td>
                        <td colspan="5" class="cntr italic border-3-black">оцінка</td>
                    </tr>
                    <tr>
                        <td colspan="1" class="cntr italic border-3-black">Години</td>
                        <td colspan="1" class="cntr italic border-3-black">Кредити ECES</td>
                        <td colspan="1" class="cntr italic border-3-black">Бали</td>
                        <td colspan="2" class="cntr italic border-3-black">Національна</td>
                        <td colspan="2" class="cntr italic border-3-black">Шкала ECTS</td>
                    </tr>
                    <tr>
                        <td rotate rowspan="3" colspan="1" class="cntr italic border-3-black">2018-2019 <!-- год обучения --></td>  <!-- rowspan="number of subjects" -->
                        <td rotate rowspan="3" colspan="1" class="cntr italic border-3-black">перший <!-- семестр--></td>  <!-- rowspan="number of subjects" -->
                        <td colspan="1" class="cntr italic border-3-black">1<!-- порядковый номер предмета --></td>
                        <td colspan="3" class="cntr italic border-3-black">Іноземна мова<!-- название предмета --></td>
                        <td colspan="1" class="cntr italic border-3-black">60<!-- кол-во часов --></td>
                        <td colspan="1" class="cntr italic border-3-black">1.5<!-- кол-во кредитов --></td>
                        <td colspan="1" class="cntr italic border-3-black">91<!-- баллы --></td>
                        <td colspan="2" class="cntr italic border-3-black">Відмін<!-- нац шкала --></td>
                        <td colspan="2" class="cntr italic border-3-black">А<!-- шкала естс --></td>
                    </tr>
                    <tr>
                        <td colspan="1" class="cntr italic border-3-black">2<!-- порядковый номер предмета --></td>
                        <td colspan="3" class="cntr italic border-3-black">Математика<!-- название предмета --></td>
                        <td colspan="1" class="cntr italic border-3-black">60<!-- кол-во часов --></td>
                        <td colspan="1" class="cntr italic border-3-black">1.5<!-- кол-во кредитов --></td>
                        <td colspan="1" class="cntr italic border-3-black">91<!-- баллы --></td>
                        <td colspan="2" class="cntr italic border-3-black">Відмін<!-- нац шкала --></td>
                        <td colspan="2" class="cntr italic border-3-black">А<!-- шкала естс --></td>
                    </tr>
                    <tr>
                        <td colspan="1" class="cntr italic border-3-black">3<!-- порядковый номер предмета --></td>
                        <td colspan="3" class="cntr italic border-3-black">Українська література<!-- название предмета --></td>
                        <td colspan="1" class="cntr italic border-3-black">60<!-- кол-во часов --></td>
                        <td colspan="1" class="cntr italic border-3-black">1.5<!-- кол-во кредитов --></td>
                        <td colspan="1" class="cntr italic border-3-black">91<!-- баллы --></td>
                        <td colspan="2" class="cntr italic border-3-black">Відмін<!-- нац шкала --></td>
                        <td colspan="2" class="cntr italic border-3-black">А<!-- шкала естс --></td>
                    </tr>
                    <tr>
                        <td rotate rowspan="3" colspan="1" class="cntr italic border-3-black">2018-2019 <!-- год обучения --></td>  <!-- rowspan="number of subjects" -->
                        <td rotate rowspan="3" colspan="1" class="cntr italic border-3-black">другий <!-- семестр--></td>  <!-- rowspan="number of subjects" -->
                        <td colspan="1" class="cntr italic border-3-black">1<!-- порядковый номер предмета --></td>
                        <td colspan="3" class="cntr italic border-3-black">Іноземна мова<!-- название предмета --></td>
                        <td colspan="1" class="cntr italic border-3-black">60<!-- кол-во часов --></td>
                        <td colspan="1" class="cntr italic border-3-black">1.5<!-- кол-во кредитов --></td>
                        <td colspan="1" class="cntr italic border-3-black">91<!-- баллы --></td>
                        <td colspan="2" class="cntr italic border-3-black">Відмін<!-- нац шкала --></td>
                        <td colspan="2" class="cntr italic border-3-black">А<!-- шкала естс --></td>
                    </tr>
                    <tr>
                        <td colspan="1" class="cntr italic border-3-black">2<!-- порядковый номер предмета --></td>
                        <td colspan="3" class="cntr italic border-3-black">Математика<!-- название предмета --></td>
                        <td colspan="1" class="cntr italic border-3-black">60<!-- кол-во часов --></td>
                        <td colspan="1" class="cntr italic border-3-black">1.5<!-- кол-во кредитов --></td>
                        <td colspan="1" class="cntr italic border-3-black">91<!-- баллы --></td>
                        <td colspan="2" class="cntr italic border-3-black">Відмін<!-- нац шкала --></td>
                        <td colspan="2" class="cntr italic border-3-black">А<!-- шкала естс --></td>
                    </tr>
                    <tr>
                        <td colspan="1" class="cntr italic border-3-black">3<!-- порядковый номер предмета --></td>
                        <td colspan="3" class="cntr italic border-3-black">Українська література<!-- название предмета --></td>
                        <td colspan="1" class="cntr italic border-3-black">60<!-- кол-во часов --></td>
                        <td colspan="1" class="cntr italic border-3-black">1.5<!-- кол-во кредитов --></td>
                        <td colspan="1" class="cntr italic border-3-black">91<!-- баллы --></td>
                        <td colspan="2" class="cntr italic border-3-black">Відмін<!-- нац шкала --></td>
                        <td colspan="2" class="cntr italic border-3-black">А<!-- шкала естс --></td>
                    </tr>
                    <tr>
                        <td rotate rowspan="3" colspan="1" class="cntr italic border-3-black">2019-2020 <!-- год обучения --></td>  <!-- rowspan="number of subjects" -->
                        <td rotate rowspan="3" colspan="1" class="cntr italic border-3-black">третій <!-- семестр--></td>  <!-- rowspan="number of subjects" -->
                        <td colspan="1" class="cntr italic border-3-black">1<!-- порядковый номер предмета --></td>
                        <td colspan="3" class="cntr italic border-3-black">Іноземна мова<!-- название предмета --></td>
                        <td colspan="1" class="cntr italic border-3-black">60<!-- кол-во часов --></td>
                        <td colspan="1" class="cntr italic border-3-black">1.5<!-- кол-во кредитов --></td>
                        <td colspan="1" class="cntr italic border-3-black">91<!-- баллы --></td>
                        <td colspan="2" class="cntr italic border-3-black">Відмін<!-- нац шкала --></td>
                        <td colspan="2" class="cntr italic border-3-black">А<!-- шкала естс --></td>
                    </tr>
                    <tr>
                        <td colspan="1" class="cntr italic border-3-black">2<!-- порядковый номер предмета --></td>
                        <td colspan="3" class="cntr italic border-3-black">Математика<!-- название предмета --></td>
                        <td colspan="1" class="cntr italic border-3-black">60<!-- кол-во часов --></td>
                        <td colspan="1" class="cntr italic border-3-black">1.5<!-- кол-во кредитов --></td>
                        <td colspan="1" class="cntr italic border-3-black">91<!-- баллы --></td>
                        <td colspan="2" class="cntr italic border-3-black">Відмін<!-- нац шкала --></td>
                        <td colspan="2" class="cntr italic border-3-black">А<!-- шкала естс --></td>
                    </tr>
                    <tr>
                        <td colspan="1" class="cntr italic border-3-black">3<!-- порядковый номер предмета --></td>
                        <td colspan="3" class="cntr italic border-3-black">Українська література<!-- название предмета --></td>
                        <td colspan="1" class="cntr italic border-3-black">60<!-- кол-во часов --></td>
                        <td colspan="1" class="cntr italic border-3-black">1.5<!-- кол-во кредитов --></td>
                        <td colspan="1" class="cntr italic border-3-black">91<!-- баллы --></td>
                        <td colspan="2" class="cntr italic border-3-black">Відмін<!-- нац шкала --></td>
                        <td colspan="2" class="cntr italic border-3-black">А<!-- шкала естс --></td>
                    </tr>
                    <tr>
                        <td rotate rowspan="3" colspan="1" class="cntr italic border-3-black">2019-2020 <!-- год обучения --></td>  <!-- rowspan="number of subjects" -->
                        <td rotate rowspan="3" colspan="1" class="cntr italic border-3-black">четвертий <!-- семестр--></td>  <!-- rowspan="number of subjects" -->
                        <td colspan="1" class="cntr italic border-3-black">1<!-- порядковый номер предмета --></td>
                        <td colspan="3" class="cntr italic border-3-black">Іноземна мова<!-- название предмета --></td>
                        <td colspan="1" class="cntr italic border-3-black">60<!-- кол-во часов --></td>
                        <td colspan="1" class="cntr italic border-3-black">1.5<!-- кол-во кредитов --></td>
                        <td colspan="1" class="cntr italic border-3-black">91<!-- баллы --></td>
                        <td colspan="2" class="cntr italic border-3-black">Відмін<!-- нац шкала --></td>
                        <td colspan="2" class="cntr italic border-3-black">А<!-- шкала естс --></td>
                    </tr>
                    <tr>
                        <td colspan="1" class="cntr italic border-3-black">2<!-- порядковый номер предмета --></td>
                        <td colspan="3" class="cntr italic border-3-black">Математика<!-- название предмета --></td>
                        <td colspan="1" class="cntr italic border-3-black">60<!-- кол-во часов --></td>
                        <td colspan="1" class="cntr italic border-3-black">1.5<!-- кол-во кредитов --></td>
                        <td colspan="1" class="cntr italic border-3-black">91<!-- баллы --></td>
                        <td colspan="2" class="cntr italic border-3-black">Відмін<!-- нац шкала --></td>
                        <td colspan="2" class="cntr italic border-3-black">А<!-- шкала естс --></td>
                    </tr>
                    <tr>
                        <td colspan="1" class="cntr italic border-3-black">3<!-- порядковый номер предмета --></td>
                        <td colspan="3" class="cntr italic border-3-black">Українська література<!-- название предмета --></td>
                        <td colspan="1" class="cntr italic border-3-black">60<!-- кол-во часов --></td>
                        <td colspan="1" class="cntr italic border-3-black">1.5<!-- кол-во кредитов --></td>
                        <td colspan="1" class="cntr italic border-3-black">91<!-- баллы --></td>
                        <td colspan="2" class="cntr italic border-3-black">Відмін<!-- нац шкала --></td>
                        <td colspan="2" class="cntr italic border-3-black">А<!-- шкала естс --></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="cntr italic">Заступник декана ФККПІ</td>
                        <td></td>
                        <td colspan="6" class="cntr italic">В. Лукашенко</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>

            </md-card>
        </div>
    </div>
</template>
<style>
    .input-auto{
        width: 100%;
        padding: 10px;
        margin: 0px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
    }
    .input-sm{
        width:2rem;
    }
    .input-md{
        width:5.5rem;
    }
    .border-3-black{
        border-left-color:black;
        border-right-color:black;
        border-top-color:black;
        border-bottom-color:black;

        border-left-style:solid;
        border-right-style:solid;
        border-top-style:solid;
        border-bottom-style:solid;

        border-left-width:3px;
        border-right-width:3px;
        border-top-width:3px;
        border-bottom-width:3px;
    }
    .cntr{
        text-align:center;
    }
    .rght{
        text-align:right;
    }
    .bold{
        font-weight:800;
    }
    #tableWrapper{
        min-height:100vh;
    }
    #documentTable{
        width:100%;
    }
    .center-button{
        display:flex;
        align-items: center;
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
    .rotate {
        -webkit-writing-mode: vertical-lr;
        -ms-writing-mode: tb-lr;
        writing-mode: sideways-lr;
    }
</style>
<script>

    import axios from 'axios';

    axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };

    export default {
        name: 'VpiskaOzinok.vue',
        data () {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                groupList:[],
                groupSubjects:[],
                groupStudents: [],
                chosenSubject:'',
                chosenGroup:'',
                groupIsChosen:false,
                subjectIsChosen:false,
                responseXLSX:[],
                requestTable:'',
                termNumber:1,
                termYears:new Date().getFullYear()+"/"+(new Date().getFullYear()+1)
            }
        },
        methods: {
            loadGroups() {
                axios
                    .get('/getGroups')
                    .then(response => (this.groupList = response.data))
                    .catch(e => {
                        this.errors.push(e)
                    });
            },
            getStudentsByGroup() {
                axios
                    .get(`/getStudentsByGroup/${this.chosenGroup}`)
                    .then(response => (this.groupStudents = response.data))
                    .catch(e => {
                        this.errors.push(e)
                    });
            },
            getSubjectsByGroup() {
                axios
                    .get(`/getSubjectsByGroup/${this.chosenGroup}`)
                    .then(response => (this.groupSubjects = response.data.defaultSubjects))
                    .catch(e => {
                        this.errors.push(e)
                    });
            },
            getAllData(){
                this.getStudentsByGroup();
                this.getSubjectsByGroup();
            },
            sendHtml()
            {
                axios
                    .post('http://127.0.0.1:5000/html2Excel', {
                        html: $("#tableWrapper").html()
                    })
                    .then(response => (this.responseXLSX.push(response.data)))
                    .catch(e => {
                        this.errors.push(e.response.data.errors);
                    });
            },
            prepareTable()
            {
                $('.input-auto').each(function(index, elem){
                    elem.parentElement.innerHTML = elem.value;
                });
                $("#termYears").html(this.termYears);
                $("#termNumber").html(this.termNumber);
                this.requestTable=$("#tableWrapper").html();
            },
            getInlineStyles()
            {

            }
        },
        watch: {
            chosenGroup: function(val)
            {
                if(val!='')
                {
                    this.getAllData();
                    this.groupIsChosen = true;
                    let groupIdName = this.groupList.filter(el => el.id == val)[0].idName;
                    $("#groupName").text(groupIdName);
                }

            },
            chosenSubject: function(val)
            {
                if(val!='')
                {
                    this.subjectIsChosen = true;
                    this.requestTable = $("#tableWrapper").html();
                    let subject = this.groupSubjects.filter(el => el.id == val)[0];
                    $("#subjectHeadOfDepartment").text(subject.headOfDepartment);
                    $("#subjectTeacher").text(subject.professor);
                    $("#moduleCount").text(subject.moduleCount);
                    $("#subjectName").text(subject.name)
                }
            }
        },
        created () {

            console.log("CREATED");
            this.loadGroups();
            this.getInlineStyles();
        }
    }

</script>
