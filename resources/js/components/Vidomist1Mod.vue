<template>
    <div class="container grey-light page-height-default" :style="secondStyle">
        <div class="p-t-b">
            <p class="display-4 text-center">Вiдомiсть (модуль 1)</p>
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
                        <md-button :style="primaryStyle" type="submit" class="md-dense md-raised md-primary" @click='prepareTable()'>Генерировать</md-button>
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
                    <!-- <td rotate class="rotate">ContentContentContentContentContent</td> -->
                    <tr>
                        <td colspan="12" class="bold cntr fa-m">Нацiональний авiацiйний унiверситет</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="bold italic fa-m">Навчально-науковий</td>
                        <td colspan="4" class="bold">Кафедра</td>
                        <td colspan="5" class="">Институт . . .</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="bold italic">Спецiальнiсть <br>Спецiалiзацiя</td>
                        <td colspan="10" class="bold">.......</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="bold italic">Навчальний рiк</td>
                        <td colspan="4" class="">2018/2019</td>
                        <td colspan="1" class="bold italic">Семестр</td>
                        <td colspan="1" class="">9</td>
                        <td colspan="1" class="bold italic">Курс</td>
                        <td colspan="1" class="">5</td>
                        <td colspan="1" class="bold italic">Група</td>
                        <td colspan="1" class="bold italic">117-а</td>
                    </tr>
                    <tr>
                        <td colspan="12" class="cntr bold fa-m">ВIДОМIСТЬ №1</td>
                    </tr>
                    <tr>
                        <td colspan="12" class="cntr bold fa-m">модульного контролю</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="italic bold">з дисциплiни</td>
                        <td colspan="1" class="">........</td>
                    </tr>
                    <tr>
                        <td rowspan="5" class="border-3-black cntr">
                            №
                        </td>
                        <td rowspan="5" class="border-3-black cntr">
                            Прізвище та ініціали <br>студента
                        </td>
                        <td colspan="10" class="border-3-black cntr">
                            Модульна рейтингова оцінка
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="border-3-black cntr bold">
                            Модуль №1
                        </td>
                        <td colspan="5" class="border-3-black cntr bold">
                            Модуль №2
                        </td>
                    </tr>
                    <tr >
                        <td colspan="5" class="border-3-black cntr bold">
                            Дата
                        </td>
                        <td colspan="5" class="border-3-black cntr bold">
                            Дата
                        </td>
                    </tr>
                    <tr >
                        <td rotate rowspan="2" class="border-3-black cntr rotate">
                            Поточна
                        </td>
                        <td colspan="2" class="border-3-black cntr ">
                            Контрольна
                        </td>
                        <td colspan="2" class="border-3-black cntr ">
                            Пiдсумкова
                        </td>
                        <td rotate rowspan="2" class="border-3-black cntr rotate">
                            Поточна
                        </td>
                        <td colspan="2" class="border-3-black cntr ">
                            Контрольна
                        </td>
                        <td colspan="2" class="border-3-black cntr ">
                            Пiдсумкова
                        </td>
                    </tr>
                    <tr >
                        <td rotate class="border-3-black cntr rotate">
                            Бали
                        </td>
                        <td class="border-3-black cntr ">
                            Нацiон. шкала
                        </td>
                        <td rotate class="border-3-black cntr rotate">
                            Бали
                        </td>
                        <td class="border-3-black cntr ">
                            Нацiон. шкала
                        </td>
                        <td rotate class="border-3-black cntr rotate">
                            Бали
                        </td>
                        <td class="border-3-black cntr ">
                            Нацiон. шкала
                        </td>
                        <td rotate class="border-3-black cntr rotate">
                            Бали
                        </td>
                        <td class="border-3-black cntr ">
                            Нацiон. шкала
                        </td>
                    </tr>
                    <tr v-for="(student, index) in groupStudents"><!-- groupStudents -->
                        <td style="border-bottom:3px solid black;border-top:3px solid black;border-left:3px solid black;border-right:3px solid black;text-align: center;">{{index+1}}</td>
                        <td style="border-bottom:3px solid black;border-top:3px solid black;border-left:3px solid black;border-right:3px solid black;text-align: center;">{{`${student.surname} ${student.firstName[0]}. ${student.middleName[0]}.`}}</td>
                        <td style="border-bottom:3px solid black;border-top:3px solid black;border-left:3px solid black;border-right:3px solid black;text-align: center;"><input class="input-auto" type="text"></td>
                        <td style="border-bottom:3px solid black;border-top:3px solid black;border-left:3px solid black;border-right:3px solid black;text-align: center;"><input class="input-auto" type="text"></td>
                        <td style="border-bottom:3px solid black;border-top:3px solid black;border-left:3px solid black;border-right:3px solid black;text-align: center;"><input class="input-auto" type="text"></td>
                        <td style="border-bottom:3px solid black;border-top:3px solid black;border-left:3px solid black;border-right:3px solid black;text-align: center;"><input class="input-auto" type="text"></td>
                        <td style="border-bottom:3px solid black;border-top:3px solid black;border-left:3px solid black;border-right:3px solid black;text-align: center;"><input class="input-auto" type="text"></td>
                        <td style="border-bottom:3px solid black;border-top:3px solid black;border-left:3px solid black;border-right:3px solid black;text-align: center;"><input class="input-auto" type="text"></td>
                        <td style="border-bottom:3px solid black;border-top:3px solid black;border-left:3px solid black;border-right:3px solid black;text-align: center;"><input class="input-auto" type="text"></td>
                        <td style="border-bottom:3px solid black;border-top:3px solid black;border-left:3px solid black;border-right:3px solid black;text-align: center;"><input class="input-auto" type="text"></td>
                        <td style="border-bottom:3px solid black;border-top:3px solid black;border-left:3px solid black;border-right:3px solid black;text-align: center;"><input class="input-auto" type="text"></td>
                        <td style="border-bottom:3px solid black;border-top:3px solid black;border-left:3px solid black;border-right:3px solid black;text-align: center;"><input class="input-auto" type="text"></td>
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
    .italic{
        font-style: italic;
    }
    .fa-m{
        font-size:18px;
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
        name: 'ZajavaIspit',
        data () {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                secondStyle:'',
                primaryStyle:'',
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
            this.getUserSession();
            console.log("CREATED");
            this.loadGroups();
            this.getInlineStyles();
        }
    }

</script>
