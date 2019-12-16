<template>
    <div class="pl-2 pr-2 grey-light page-height-default">
        <div class="p-t-b">
            <p class="display-4 text-center">Зведена відомість</p>
            <div class="row pl-3 pr-3 pt-3">
                <div class="col-4">
                    <md-field>
                        <label>Выберите&nbsp;группу</label>
                        <md-select v-model="chosenGroup" name="chosenGroup" id="chosenGroup" >
                            <md-option v-for="group in groupList" :value="group.id">{{group.idName}}</md-option>
                        </md-select>
                    </md-field>
                </div>
                <div class="col-4 center-button" v-show="groupIsChosen">
                    <form id="sendTableForm" action="http://127.0.0.1:5000/html2Excel" method="POST" target="_blank">

                        <input type="hidden" name="html" v-model="requestTable" id="requestTable" @change="sendTable">
                        <md-button type="button" class="md-dense md-raised md-primary" @click='prepareTable' >Генерировать</md-button>
                    </form>
                </div>
            </div>


            <md-card id="tableWrapper">

                <table lang="uk-UK" id="documentTable" v-if="chosenGroup">
                    <thead>
                    <tr>
                        <th :colspan="maxColSpan">&nbsp;</th>

                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td :colspan="maxColSpan"></td>
                    </tr>
                    <tr>
                        <td :colspan="maxColSpan" class='cntr bold'>
                            НАЦІОНАЛЬНИЙ АВІАЦІЙНИЙ УНІВЕРСИТЕТ
                        </td>
                    </tr>
                    <tr>
                        <td :colspan="maxColSpan" class='cntr bold'>
                            ФАКУЛЬТЕТ <input type="text" id="facultyName" v-model="facultyName" class="input-auto input-top-fac text-input">
                        </td>
                    </tr>
                    <tr>
                        <td :colspan="maxColSpan" class='cntr bold'>
                            ЗВЕДЕНА ВІДОМІСТЬ УСПІШНОСТІ
                        </td>
                    </tr>
                    <tr>
                        <td :colspan="maxColSpan" class='cntr bold'>
                            <input type="text" :value="termYears" id="termYears" class="input-auto input-top-date text-input">
                        </td>
                    </tr>
                    <tr>
                        <td :colspan="maxColSpan" class='cntr bold'>
                            <input type="text" value="1" id="courseYear" v-model="courseYear" class="input-auto input-top-course text-input">&nbsp;курс
                        </td>
                    </tr>
                    <tr>
                        <td :colspan="maxColSpan" class='cntr bold' >
                            <input type="text" id="specialityName" v-model="specialityName" class='tableInp input-auto text-input'>
                        </td>
                    </tr>
                    <tr>
                        <td :colspan="maxColSpan" class='cntr bold'>
                            <input type="text" id="groupOpp" v-model="groupOpp" class='input-opp input-auto text-input'>
                        </td>
                    </tr>
                    <tr>
                        <td class='lft bold' noAuto>
                            Куратор:
                        </td>
                        <td :colspan="maxColSpan-1" class='lft'>
                            <input type="text" id="curator" v-model="curator" class='tableInp input-auto text-input'>
                        </td>
                    </tr>
                    <tr>
                        <td class='lft bold' noAuto>
                            Командир:
                        </td>
                        <td :colspan="maxColSpan-1" class='lft'>
                            <input type="text" id="headman" v-model="headman" class='tableInp input-auto text-input'>
                        </td>
                    </tr>
                    <tr>
                        <td :colspan="maxColSpan" class='lft'>
                            <input type="text" v-model="chosenGroupName" class='tableInp input-auto text-input'>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="3" class='cntr border-3-black bt'>
                            <input type="text" value="№" class="input-auto fill-secondary" >
                        </td>
                        <td rowspan="3" class='cntr border-3-black bt'>
                            Прізвище та ініціали студентів
                        </td>
                        <td rowspan="3" class='cntr border-3-black bt'>
                            № зал. кн.
                        </td>
                        <td rotate rowspan="3" class='cntr bold rotate border-3-black bt'>
                            Форма навчання
                        </td>
                        <td rotate rowspan="3" class='cntr rotate border-3-black bt'>
                            Середній бал
                        </td>
                        <td rotate rowspan="3" class='cntr rotate border-3-black bt'>
                            Індивідуальний рейтинг студента
                        </td>
                        <td rotate rowspan="3" class='cntr bold rotate border-3-black bt'>
                            Військове положення
                        </td>
                        <td :colspan="(courseCount+passCount+examCount+practiceCount)*3" class='cntr border-3-black bt'>
                            Назва навчальної дисципліни
                        </td>
                        <td colspan="4" rowspan="2" class='cntr bold border-3-black bt'>
                            Примітки
                        </td>
                    </tr>
                    <tr>

                        <td v-if="courseCount" :colspan='courseCount*3' class='cntr bold border-3-black bg-mark-0'>
                            Курсові роботи
                        </td>
                        <td v-if="passCount" :colspan='passCount*3' class='cntr bold border-3-black bg-mark-1'>
                            Заліки
                        </td>
                        <td v-if="examCount" :colspan='examCount*3' class='cntr bold border-3-black bg-mark-2'>
                            Екзамени
                        </td>
                        <td v-if="practiceCount" :colspan='practiceCount*3' class='cntr bold border-3-black bg-mark-3'>
                            Практика
                        </td>
                    </tr>
                    <tr>
                        <template v-for="(subjectList,sector) in subjectHasArr">
                               <template v-for="(subject,ind) in subjectList">
                                   <td colspan='3' :class='`cntr border-3-black bg-mark-${sector}`'>
                                        {{subject.name}}
                                    </td>
                               </template>
                        </template>
                        <td class='cntr border-3-black cursive rotate' rotate>
                            Борги
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
                    <tr v-for="(student, key) in groupStudents" :class='`student-id-${student.id} studentRow`'>
                        <td class='border-3-black cntr'>
                            {{key+1}}
                        </td>
                        <td class='lft border-3-black pl-2' noAuto>
                            {{`${student.surname}&nbsp;${student.firstName}&nbsp;${student.middleName}`}}
                        </td>
                        <td class='cntr border-3-black'>
                            <input type="text" :value="`${student.studentId!=null ? student.studentId : ''}`" class="input-auto fill-secondary" @input="colorChange">
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
                            {{(student.militaryService!==null ? "+" : "")}}
                        </td>
                        <template v-for="(subjectList,sector) in subjectHasArr" >
                               <template v-for="(subject,ind) in subjectList" >
                                <td :class='`border-3-black cntr bg-mark-${sector}`' ><input type="text" :class="`input-auto subj-1-mark fill mark-${subject.id}-${markTypes[sector]}`" @input="calcRating"></td>
                                    <td :class='`border-3-black cntr subj-2-mark bg-mark-${sector}`' class=''>0</td>
                                    <td :class='`border-3-black cntr subj-3-mark bg-mark-${sector}`' class=''>0</td>
                                    
                               </template>
                        </template>

                        <td class='lft border-3-black cntr bold depts'>
                            <input type="text" value="" class="input-auto fill-secondary" @input="colorChange">
                        </td>
                        <td class='lft border-3-black cntr bold personalTimetable'>
                             <input type="text" value="" class="input-auto fill-secondary" @input="colorChange">
                        </td>
                        <td class='lft border-3-black cntr bold IZDN'>
                             <input type="text" value="" class="input-auto fill-secondary" @input="colorChange">
                        </td>
                        <td class='lft border-3-black cntr bold kickOut'>
                             <input type="text" value="" class="input-auto fill-secondary" @input="colorChange">
                        </td>
                    </tr>
                    <tr>
                        <td class='lft border-3-black' colspan="7">
                            Провідний викладач
                        </td>
                        <template v-for="(subjectList,sector) in subjectHasArr">
                               <template v-for="(subject,ind) in subjectList">
                                   <td colspan='3' :class='`cntr border-3-black bg-mark-${sector}`'>
                                        {{subject.professor}}
                                    </td>
                               </template>
                        </template>
                    </tr>
                    <tr>
                        <td class='lft border-3-black' colspan="7">
                            Завідувач кафедри
                        </td>
                        <template v-for="(subjectList,sector) in subjectHasArr">
                               <template v-for="(subject,ind) in subjectList">
                                   <td colspan='3' :class='`cntr border-3-black bg-mark-${sector}`'>
                                        {{subject.headOfDepartment}}
                                    </td>
                               </template>
                        </template>
                    </tr>
                    <tr>
                        <td class='lft border-3-black' colspan="7">
                            Кількість модулів
                        </td>
                        <template v-for="(subjectList,sector) in subjectHasArr">
                               <template v-for="(subject,ind) in subjectList">
                                   <td colspan='3' :class='`cntr border-3-black bg-mark-${sector}`'>
                                        {{subject.moduleCount}}
                                    </td>
                               </template>
                        </template>
                    </tr>
                    <tr>
                        <td class='lft border-3-black' colspan="7">
                            Кількість годин, кредитів
                        </td>
                        <template v-for="(subjectList,sector) in subjectHasArr">
                               <template v-for="(subject,ind) in subjectList">
                                   <td :class='`border-3-black cntr bg-mark-${sector}`' colspan="2">
                                        {{subject.hoursCount}}
                                    </td>
                                    <td :class='`border-3-black cntr bg-mark-${sector}`' colspan="1">
                                        {{subject.creditsCount}}
                                    </td>
                               </template>
                        </template>
                    </tr>
                    <tr>
                        <td class='lft border-3-black bold' colspan="7">
                            ДАТА
                        </td>
                        <template v-for="(subjectList,sector) in subjectHasArr">
                               <template v-for="(subject,ind) in subjectList">
                                   <td colspan='3' :class='`cntr border-3-black bg-mark-${sector}`'>
                                        {{subject.dateBegin}}
                                    </td>
                               </template>
                        </template>
                    </tr>
                    <tr>
                        <td class='lft border-3-black bold' colspan="7">
                            НОМЕР ВІДОМОСТІ
                        </td>
                        <template v-for="(subjectList,sector) in subjectHasArr">
                               <template v-for="(subject,ind) in subjectList">
                                   <td :class='`border-3-black cntr bg-mark-${sector}`' colspan="3">
                                        <input type="text" class="input-auto input-top-fac text-input" :value="`№${(groupDisciplineMarks.filter(el => el.subjectId === subject.id).length!==0 ? groupDisciplineMarks.filter(el => el.subjectId === subject.id)[0].number : '')}`">
                                    </td>
                               </template>
                        </template>
                    </tr>
                    <tr>
                        <td :colspan="maxColSpan" class='cntr bold'>
                        </td>
                    </tr>
                    <tr>
                        <td :colspan="maxColSpan" class='cntr bold' >
                            <input type="text" id="footer" v-model="footer" class='tableInp input-auto text-input'>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </md-card>
        </div>
    </div>
</template>
<style>
    .bg-mark-0{
        background-color: rgba(126, 214, 223, 0.3);
    }
    .bg-mark-1{
        background-color: rgba(255, 190, 118, 0.3);
    }
    .bg-mark-2{
        background-color: rgba(255, 121, 121, 0.3);
    }
    .bg-mark-3{
        background-color: rgba(123, 237, 159, 0.3);
    }
    .text-input{
        transition-timing-function: ease-out;
        transition: 0.5s;
        background:transparent;
        border:0;
        border-bottom: 1px solid lightgrey;
    }
    .text-input:focus{
        transition-timing-function: ease-in;
        transition: 0.5s;
        background:transparent;
        border:0;
        border-bottom: 1px solid black;
    }
    .input-top-course{
        height:1rem !important;
        width:2rem !important;
    }
    .input-top-spec{
        height:1rem !important;
        width:10rem !important;
    }
    .input-top-fac{
        height:1rem !important;
        width:12rem !important;
    }
    .input-top-date{
        height:1rem !important;
        width:6rem !important;
    }
    .subj-1-mark{
        padding: 10px;
    }
    .subj-2-mark{
        padding: 10px;
    }
    .subj-3-mark{
        padding: 10px;
    }
    input{

    }
    .not-wrap{
        overflow: none;
    }
    .input-auto.fill{
        padding: 10px;
        margin: 0px;
        display: flex;
        flex-flow: row wrap;
        width: 100% !important;
        border:3px solid #e3342f;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        transition-timing-function: ease-out;
        transition: 0.2s;
    }
    .input-auto.fill:focus{
        border-color:#3490dc;
        transition-timing-function: ease-in;
        transition: 0.2s;
    }
    .input-auto.fill-secondary{
        padding: 10px;
        margin: 0px;
        display: flex;
        flex-flow: row wrap;
        width: 100% !important;
        border:3px solid lightgrey;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        transition-timing-function: ease-out;
        transition: 0.2s;
    }
    .input-auto.fill-secondary:focus{
        border-color:#3490dc;
        transition-timing-function: ease-in;
        transition: 0.2s;
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
        height:1rem !important;
        width:15rem !important;
    }
    #loading{
        position:absolute;
        width:100%;
        height:100%;
        top:25%;
        margin:0 auto;
        background-color: rgba(0,0,0,0.2);
    }
    .bt{
        border-top-width: 1px;
    }
    .input-opp{
        height:1rem !important;
        width:25rem !important;
    }
</style>
<script>

    import axios from 'axios';

    axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };


    export default {
        name: 'ZvedenaVidomist',
        data () {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                maxColSpan:0,
                groupList:[],
                groupSubjects:[],
                groupStudents: [],
                groupStudentsCopy: {},
                groupDisciplineMarks: [],
                chosenSubject:'',
                courseCount:0,
                passCount:0,
                examCount:0,
                practiceCount:0,
                chosenGroup:'',
                groupIsChosen:false,
                loadingDoc:false,
                responseXLSX:[],
                requestTable:'',
                termNumber:1,
                termYears:new Date().getFullYear()+"/"+(new Date().getFullYear()+1),
                facultyName:'',
                chosenGroupName:'',
                subjectHasArr:[[],[],[],[]],
                courseYear:'',
                curator:'',
                headman:'',
                specialityName:'',
                groupOpp:'',
                footer:'',
                studentMarksArray:[],
                markTypes:{
                    0:"course",
                    1:"pass",
                    2:"exam",
                    3:"practice",
                },
                studentIdList:[],
                recordNumberList:[]
            }
        },
        methods: {
            getRealWidth (tr) {
                return 11 + ((this.courseCount+this.passCount+this.examCount+this.practiceCount)*3);
            },
            colorChange: function(event) {
                let tg = event.target;
                if(tg.value!=="" && tg.value !== '0')
                {
                    tg.style.outlineColor = "#38c172";
                }else{
                    tg.style.outlineColor = "#e3342f";
                }
            },
            calcRatingManual: function() {
                let inputs = document.querySelectorAll('.subj-1-mark');
                for(let n in inputs){
                    let tg = inputs[n];
                    let currTR = $(tg.parentElement.parentElement).children('td').children('.subj-1-mark');
                    let mrk = 0;
                    let deptsCount = 0;

                    if(!isNaN(tg.value)){

                        tg.value = parseFloat(tg.value, 10);

                        if(tg.value>100){
                            tg.value=100;
                        }

                        if(tg.value!=="" && tg.value !== '0')
                        {
                            tg.style.borderColor = "#38c172";
                        }else{
                            tg.style.borderColor = "#e3342f";
                        }

                        $(tg.parentElement.nextElementSibling).text(this.ratingToLetters(parseFloat(tg.value)));
                        $(tg.parentElement.nextElementSibling.nextElementSibling).text(this.ratingToFive(parseFloat(tg.value),false));
                        for(let i=0; i<currTR.length;i++)
                        {
                            mrk+=parseFloat(currTR[i].value);
                            if(parseFloat(currTR[i].value) === 0){
                                deptsCount++;
                            }
                        }
                        $(tg.parentElement.parentElement).find(".depts").text(deptsCount);
                        mrk/=currTR.length;
                        if(mrk!==""){
                            $(tg.parentElement).siblings(".rating").text(parseFloat(mrk.toFixed(2)));
                            $(tg.parentElement).siblings(".averageMark").text(this.ratingToFive(mrk));
                        }
                    }else{
                        tg.value = tg.value.slice(0, -1);
                    }
                }
            },
            calcRating : function(event) {
                let tg = event.target;
                let currTR = $(tg.parentElement.parentElement).children('td').children('.subj-1-mark');
                let mrk = 0;
                let deptsCount = 0;

                if(!isNaN(tg.value)){

                    tg.value = parseFloat(tg.value, 10);

                    if(tg.value>100){
                        tg.value=100;
                    }

                    if(tg.value!=="" && tg.value !== '0')
                    {
                        tg.style.borderColor = "#38c172";
                    }else{
                        tg.style.borderColor = "#e3342f";
                    }

                    $(tg.parentElement.nextElementSibling).text(this.ratingToLetters(parseFloat(tg.value)));
                    $(tg.parentElement.nextElementSibling.nextElementSibling).text(this.ratingToFive(parseFloat(tg.value),false));
                    for(let i=0; i<currTR.length;i++)
                    {
                        mrk+=parseFloat(currTR[i].value);
                        if(parseFloat(currTR[i].value) === 0){
                            deptsCount++;
                        }
                    }
                    $(tg.parentElement.parentElement).find(".depts").text(deptsCount);
                    mrk/=currTR.length;
                    if(mrk!==""){
                        $(tg.parentElement).siblings(".rating").text(parseFloat(mrk.toFixed(2)));
                        $(tg.parentElement).siblings(".averageMark").text(this.ratingToFive(mrk));
                    }
                }else{
                    tg.value = tg.value.slice(0, -1);
                }
            },
            ratingToFive(r, full = true) {
                if(full){
                    return parseFloat((parseFloat(r)*5/100).toFixed(2));
                }
                return parseFloat((parseFloat(r)*5/100).toFixed(0));
            },
            ratingToLetters(r) {
                if(r >= 90){
                    return 'A';
                }else if(r <= 89 && r>=82){
                    return 'B';
                }else if(r <= 81 && r>=75){
                    return 'C';
                }else if(r <= 74 && r>=67){
                    return 'D';
                }else if(r <= 66 && r>=60){
                    return 'E';
                }else if(r <= 59 && r>=35){
                    return 'FX';
                }else if(r <= 34){
                    return 'F';
                }
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
                    .then(response => {
                        this.groupStudents = response.data;this.getSubjectsByGroup();
                    })
                    .catch(e => {
                        this.errors.push(e)
                    });
            },
            getGroupDisciplineMarks() {
                axios
                    .get(`/getDisciplineMarksByGroup/${this.chosenGroup}`)
                    .then(response => {
                        this.groupDisciplineMarks = response.data;
                    })
                    .catch(e => {
                        this.errors.push(e)
                    });

            },
            getSubjectsByGroup() {
                axios
                    .get(`/getSubjectsByGroup/${this.chosenGroup}`)
                    .then(response => {this.groupSubjects = response.data.defaultSubjects;this.getGroupDisciplineMarks();})
                    .catch(e => {
                        this.errors.push(e)
                    });
            },
            getAllData(){
                this.getStudentsByGroup();
            },
            sendDoc() {
                console.log(this.requestTable);
                axios
                    .post(`http://127.0.0.1:5000/html2Excel`, {
                        html:this.requestTable
                    })
                    .then(response => {})
                    .catch(e => {
                    });
            },
            prepareTable()
            {
                this.loadingDoc = true;
                $('.input-auto').each(function(index, elem){
                    elem.parentElement.innerHTML = elem.value;
                });
                $("#termYears").html(this.termYears);
                $("#termNumber").html(this.termNumber);
                this.getInlineStyles();
            },
            popStudentId(key)
            {
                let student = this.groupStudentsCopy[key].pop();
                return student.id;
            },
            getInlineStyles()
            {
                let tdStyles = "";
                $("#documentTable > tbody > tr > td").each(function(index, el){
                    tdStyles="";
                    tdStyles+=`border-top-style:${$(el).css("border-top-style")};`;
                    tdStyles+=`border-bottom-style:${$(el).css("border-bottom-style")};`;
                    tdStyles+=`border-left-style:${$(el).css("border-left-style")};`;
                    tdStyles+=`border-right-style:${$(el).css("border-right-style")};`;

                    tdStyles+=`border-top-width:${$(el).css("border-top-width")} !important;`;
                    tdStyles+=`border-bottom-width:${$(el).css("border-bottom-width")};`;
                    tdStyles+=`border-left-width:${$(el).css("border-left-width")};`;
                    tdStyles+=`border-right-width:${$(el).css("border-right-width")};`;

                    tdStyles+=`border-top-color:${$(el).css("border-top-color")};`;
                    tdStyles+=`border-bottom-color:${$(el).css("border-bottom-color")};`;
                    tdStyles+=`border-left-color:${$(el).css("border-left-color")};`;
                    tdStyles+=`border-right-color:${$(el).css("border-right-color")};`;

                    tdStyles+=`text-align:${$(el).css("text-align")};`;
                    tdStyles+=`font-weight:${$(el).css("font-weight")};`;
                    tdStyles+=`background-color:${$(el).css("background-color")};`;
                    tdStyles+=`padding-top:${$(el).css("padding-top")};`;
                    tdStyles+=`padding-bottom:${$(el).css("padding-bottom")};`;
                    tdStyles+=`padding-left:${$(el).css("padding-left")};`;
                    tdStyles+=`padding-right:${$(el).css("padding-right")};`;

                    //DEFAULT STYLES
                    tdStyles+=`overflow:auto;`;
                    tdStyles+=`width:auto;`;
                    $(el).attr("style",tdStyles);
                    if($("#documentTable > tbody > tr > td").length-1 === index){
                        $("#requestTable").val(document.getElementById("tableWrapper").innerHTML);
                        $("#sendTableForm").submit();
                    }
                });


            },
            sendTable: function(evt){
            },
            processData(){
                this.groupIsChosen = true;
                let groupIdName = this.groupList.filter(el => el.id == this.chosenGroup)[0].idName;
                let curatorFIO = this.groupList[this.chosenGroup].curator.fio;
                let curatorPhone = this.groupList[this.chosenGroup].curator.phone;
                let headmanFIO = this.groupList[this.chosenGroup].headman.fio;
                let headmanPhone = this.groupList[this.chosenGroup].headman.phone;
                let courseYear = this.groupList[this.chosenGroup].idName.match(/\d+/)[0][0];
                let departmentHead = this.groupList.filter(el => el.id == this.chosenGroup)[0].department.head;
                this.facultyName = this.groupList[this.chosenGroup].department.fullName;
                this.chosenGroupName = `Академічна группа ${groupIdName}`;

                this.courseYear = `${courseYear}`;
                this.curator = `${curatorFIO ? curatorFIO : ''} ${curatorPhone ? curatorPhone : ''}`;
                this.headman = `${headmanFIO ? headmanFIO : ''} ${headmanPhone ? headmanPhone : ''}`;
                $("#termYears").val(this.termYears + ` навчальний рік (${courseYear}семестр)`);
                this.specialityName = `${this.groupList[this.chosenGroup].speciality.number} ${this.groupList[this.chosenGroup].speciality.fullName}`;
                this.groupOpp = this.groupList[this.chosenGroup].eduProgram;
                this.footer = `Декан _______________ ${departmentHead}`;
                let studentRow = null;
                let studentMark = 0;
                for(let studentNumber in this.studentMarksArray){
                    studentRow = document.querySelector(`.student-id-${studentNumber}`);
                    for(let subjectNumber in this.studentMarksArray[studentNumber]){
                        if(Object.keys(this.studentMarksArray[studentNumber][subjectNumber]).length !== 0){
                            for(let has in this.studentMarksArray[studentNumber][subjectNumber]){
                                studentMark = this.studentMarksArray[studentNumber][subjectNumber][has];
                                $(studentRow).find(`.mark-${subjectNumber}-${has}`).val(studentMark);
                            }
                        }else{
                            let currentSubjHas = this.groupSubjects.filter(el => el.id === parseInt(subjectNumber))[0];
                            for(let key in currentSubjHas.has){
                                $(studentRow).find(`.mark-${subjectNumber}-${key}`).val(0);
                            }
                        }
                    }
                }
                this.calcRatingManual();

            }
        },
        watch: {
            groupDisciplineMarks: function(val){
                let subjectMarks = [];
                let recordNumber = 0;
                for(let stId in this.groupStudents){
                    this.studentMarksArray[this.groupStudents[stId].id] = [];
                    for(let i in this.groupSubjects){
                        this.recordNumberList.push({id:this.groupSubjects[i].id, number:this.groupSubjects[i].number});
                        this.studentMarksArray[this.groupStudents[stId].id][this.groupSubjects[i].id] = [];
                        subjectMarks = this.groupDisciplineMarks.filter(el => el.subjectId === this.groupSubjects[i].id);
                        if(subjectMarks.length){
                            this.studentIdList.push({id:this.groupStudents[stId].id, studentId:this.groupStudents[stId].studentId});
                            subjectMarks = JSON.parse(subjectMarks[0]["studentData"]);
                            for(let has in this.groupSubjects[i].has){
                                this.studentMarksArray[this.groupStudents[stId].id][this.groupSubjects[i].id][has] = subjectMarks.filter(st => st.id === this.groupStudents[stId].id)[0].rating[has];
                            }
                        }
                    }
                }
                this.processData();
            },
            groupSubjects: function(val)
            {
                this.courseCount=0;
                this.passCount=0;
                this.examCount=0;
                this.practiceCount=0;
                this.subjectHasArr = [[],[],[],[]];
                for(let subjectKey in val)
                {
                    for(let type in val[subjectKey].has)
                    {
                        if(type === "course")
                        {
                            this.courseCount++;
                            this.subjectHasArr[0].push(val[subjectKey]);
                        }else if(type === "pass")
                        {
                            this.passCount++;
                            this.subjectHasArr[1].push(val[subjectKey]);
                        }else if(type === "exam")
                        {
                            this.examCount++;
                            this.subjectHasArr[2].push(val[subjectKey]);
                        }else if(type === "practice")
                        {
                            this.practiceCount++;
                            this.subjectHasArr[3].push(val[subjectKey]);
                        }
                    }
                }
                this.maxColSpan = parseInt(this.getRealWidth());
            },
            chosenGroup: function(val)
            {
                if(val!='')
                {
                    this.getAllData();
                }

            },
            chosenSubject: function(val)
            {
                if(val!='')
                {
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
        }
    }

</script>
