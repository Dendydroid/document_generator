<template>
    <div class="pl-2 pr-2 grey-light page-height-default">
        <div class="p-t-b">
            <p class="display-4 text-center">Зведена відомість</p>
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
                        <th colspan="40">&nbsp;</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    
                    <tr>
                        <td colspan="40"></td>
                    </tr>
                    <tr>
                        <td colspan="40" class='cntr bold'>
                            НАЦІОНАЛЬНИЙ АВІАЦІЙНИЙ УНІВЕРСИТЕТ
                        </td>
                    </tr>
                    <tr>
                        <td colspan="40" class='cntr bold'>
                            ФАКУЛЬТЕТ <input type="text" id="facultyName" v-model="facultyName" class="input-auto">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="40" class='cntr bold'>
                            ЗВЕДЕНА ВІДОМІСТЬ УСПІШНОСТІ
                        </td>
                    </tr>
                    <tr>
                        <td colspan="40" class='cntr bold'>
                            <input type="text" :value="termYears" id="termYears" class="input-auto">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="40" class='cntr bold'>
                            <input type="text" value="1" id="courseYear" class="input-auto">&nbsp;курс
                        </td>
                    </tr>
                    <tr>
                        <td colspan="40" class='cntr bold' id="specialityName">
                            <input type="text" value=""  class="input-auto">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="40" class='cntr bold' id="groupOpp">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="40" class='lft'>
                            Куратор:&nbsp;<input type="text" id="curator" class='tableInp'>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="40" class='lft'>
                            Командир:&nbsp;<input type="text" id="headman" class='tableInp'>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="40" class='lft' id="groupName">
                            Академічна група: КС-323Б
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="3" class='cntr border-3-black'>
                            №51
                        </td>
                        <td rowspan="3" class='cntr border-3-black'> 
                            Прізвище та ініціали студентів
                        </td>
                        <td rowspan="3" class='cntr border-3-black'>
                            № зал. кн.
                        </td> 
                        <td rotate rowspan="3" class='cntr bold rotate border-3-black'>
                            Форма навчання
                        </td>
                        <td rotate rowspan="3" class='cntr rotate border-3-black'>
                            Середній бал
                        </td>
                        <td rotate rowspan="3" class='cntr rotate border-3-black'>
                            Індивідуальний рейтинг студента
                        </td>
                        <td rotate rowspan="3" class='cntr bold rotate border-3-black'>
                            Військове положення
                        </td>
                        <td :colspan="(courseCount+passCount+examCount+practiceCount)*3" class='cntr border-3-black'>
                            Назва навчальної дисципліни
                        </td>
                        <td colspan="4" rowspan="2" class='cntr bold border-3-black'>
                            Примітки
                        </td>
                    </tr>
                    <tr>
                        
                        <td v-if="courseCount" :colspan='courseCount*3' class='cntr bold border-3-black'>
                            Курсові роботи
                        </td>
                        <td v-if="passCount" :colspan='passCount*3' class='cntr bold border-3-black'>
                            Заліки
                        </td>
                        <td v-if="examCount" :colspan='examCount*3' class='cntr bold border-3-black'>
                            Екзамени
                        </td>
                        <td v-if="practiceCount" :colspan='practiceCount*3' class='cntr bold border-3-black'>
                            Практика
                        </td>
                    </tr>
                    <tr>
                        <template  v-for="(subject,key) in groupSubjects">
                            <td colspan='3' class='cntr border-3-black' v-for="(hasValue,hasType) in subject.has">
                                {{subject.name}}
                            </td>
                        </template>
                        <td class='cntr border-3-black cursive rotate' rotate>
                            Бали
                        </td>
                        <td class='cntr border-3-black cursive rotate' rotate>
                            Інд. графік, академ відпустка
                        </td>
                        <td class='cntr border-3-black cursive rotate' rotate>
                            ІЗДН
                        </td>
                        <td class='cntr border-3-black cursive rotate' rotate>
                            Відрахування
                        </td>
                    </tr>
                    <tr v-for="(student, key) in groupStudents">
                        <td class='lft border-3-black cntr'>
                            {{key+1}}
                        </td>
                        <td class='lft border-3-black'>
                            {{`${student.surname}&nbsp;${student.firstName}&nbsp;${student.middleName}`}}
                        </td>
                        <td class='lft border-3-black'>
                            <input type="text" :value="student.studentId" class="input-auto">
                        </td>
                        <td class='cntr border-3-black '>
                            {{student.nauConditions}}
                        </td>
                        <td class='cntr border-3-black bold averageMark'>
                            0
                        </td>
                        <td class='cntr border-3-black bold rating'>
                            0
                        </td>
                        <td class='cntr border-3-black militaryService'>
                            {{(student.militaryService!==null ? "+" : "-")}}
                        </td>
                        
                        <template v-for="(subject,key) in groupSubjects">
                               <template v-for="(val,type) in subject.has">
                                   <td class='lft border-3-black cntr '>
                                        <input type="text" value="0" class="input-auto">
                                    </td>
                                    <td class='lft border-3-black cntr' >
                                        <input type="text" value="" class="input-auto">
                                    </td>
                                    <td class='lft border-3-black cntr'>
                                        <input type="text" value="" class="input-auto">
                                    </td>
                               </template>
                        </template>
                        
                        <td class='lft border-3-black cntr bold depts'>
                            <input type="text" value="" class="input-auto">
                        </td>
                        <td class='lft border-3-black cntr bold personalTimetable'>
                             <input type="text" value="" class="input-auto">
                        </td>
                        <td class='lft border-3-black cntr bold IZDN'>
                             <input type="text" value="" class="input-auto">
                        </td>
                        <td class='lft border-3-black cntr bold kickOut'>
                             <input type="text" value="" class="input-auto">
                        </td>
                    </tr>
                    
                    </tbody>
                </table>
            </md-card>
        </div>
    </div>
</template>
<style>
    input{
        width:4rem !important;
    }
    .not-wrap{
        overflow: none;
    }
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
    .lft{
        text-align:left;
    }
    .bold{
        font-weight:800;
    }
    #tableWrapper{
        min-height:100vh;
        overflow-x: auto;
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
    .cursive{
        font-style:italic;
    }
    .tableInp{
        height:0.5rem !important;
    }
</style>
<script>

    import axios from 'axios';

    axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };

    export default {
        name: 'zvedenaVidomist',
        data () {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                groupList:[],
                groupSubjects:[],
                groupStudents: [],
                chosenSubject:'',
                courseCount:0,
                passCount:0,
                examCount:0,
                practiceCount:0,
                chosenGroup:'',
                groupIsChosen:false,
                subjectIsChosen:false,
                responseXLSX:[],
                requestTable:'',
                termNumber:1,
                termYears:new Date().getFullYear()+"/"+(new Date().getFullYear()+1),
                facultyName:''
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
            groupSubjects: function(val)
            {
                for(let subjectKey in val)
                {
                    for(let type in val[subjectKey].has)
                    {
                        if(type === "course")
                        {
                            this.courseCount++;
                        }else if(type === "pass")
                        {
                            this.passCount++;
                        }else if(type === "exam")
                        {
                            this.examCount++;
                        }else if(type === "practice")
                        {
                            this.practiceCount++;
                        }
                    }
                }
            },
            chosenGroup: function(val)
            {
                if(val!='')
                {
                    this.getAllData();
                    this.groupIsChosen = true;
                    let groupIdName = this.groupList.filter(el => el.id == val)[0].idName;
                    $("#groupName").text(`Академічна группа ${groupIdName}`);
                    let curatorFIO = this.groupList[this.chosenGroup].curator.fio;
                    let curatorPhone = this.groupList[this.chosenGroup].curator.phone;
                    let headmanFIO = this.groupList[this.chosenGroup].headman.fio;
                    let headmanPhone = this.groupList[this.chosenGroup].headman.phone;
                    $("#curator").val(`${curatorFIO ? curatorFIO : ''} ${curatorPhone ? curatorPhone : ''}`);
                    $("#headman").val(`${headmanFIO ? headmanFIO : ''} ${headmanPhone ? headmanPhone : ''}`);
                    this.facultyName = this.groupList[this.chosenGroup].department.fullName;
                    let courseYear = this.groupList[this.chosenGroup].idName.match(/\d+/)[0][0];
                    $("#courseYear").val(`${courseYear}`);
                    $("#termYears").val(this.termYears + ` навчальний рік (${courseYear}семестр)`);
                    $("#specialityName").html(`${this.groupList[this.chosenGroup].speciality.number} ${this.groupList[this.chosenGroup].speciality.fullName}`);
                    $("#groupOpp").html(this.groupList[this.chosenGroup].eduProgram);
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
                    $("#subjectName").text(subject.name);
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
