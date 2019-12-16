<template>
    <div class="pl-2 pr-2 grey-light page-height-default">
        <div class="p-t-b">
            <p class="display-4 text-center">Відомість з дисципліни</p>
            <div class="row pl-3 pr-3 pt-3">
                <div class="col-4">
                    <md-field>
                        <label>Выберите&nbsp;предмет</label>
                        <md-select v-model="activeSubject">
                            <md-option v-for="subject in subjectList" :value="subject.id">{{subject.name}}</md-option>
                        </md-select>
                    </md-field>
                    <md-field>
                        <label>Выберите&nbsp;группу</label>
                        <md-select v-model="activeGroup" >
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


            <md-card id="tableWrapper" v-if="groupIsChosen">

                <table lang="uk-UK" id="documentTable">
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
                            Факультет <input type="text" v-model="tableData.facultyName" class="input-auto input-top-fac text-input">
                        </td>
                    </tr>
                    <tr>
                        <td  class='lft bold'>
<!--                            <img class='nau1' src="../../res/nau1.jpg" alt="">-->
                        </td>
                        <td :colspan="maxColSpan-2" class='cntr bold'>
                            Кафедра {{tableData.departmentName}}
                        </td>
                        <td  class='rght bold'>
<!--                            <img class='nau2' src="../../res/nau2.jpg" alt="">-->
                        </td>
                    </tr>
                    <tr>
                        <td :colspan="3" class='lft bold'>
                            Спеціальність:
                        </td>
                        <td :colspan="3" class='lft bold'>
                            {{tableData.specialityName}}
                        </td>
                    </tr>
                    <tr>
                        <td :colspan="3" class='lft bold'>
                            Освітня програма:
                        </td>
                        <td :colspan="3" class='lft bold'>
                            {{tableData.opp}}
                        </td>
                    </tr>
                    <tr>
                        <td :colspan="2" class='cntr bold border-3-black'>
                            Навчальний рік
                        </td>
                        <td class='cntr bold border-3-black'>
                            Семестр
                        </td>
                        <td class='cntr bold border-3-black'>
                            Курс
                        </td>
                        <td class='cntr bold border-3-black'>
                            Група
                        </td>
                        <td class='cntr bold border-3-black'>
                            Дата контролю
                        </td>
                    </tr>
                    <tr>
                        <td :colspan="2" class='cntr bold border-3-black'>
                            {{tableData.termYears}}
                        </td>
                        <td class='cntr bold border-3-black'>
                            <input value="1" type="text" v-model="tableData.semester" class="input-auto input-top-fac input-sm text-input">
                        </td>
                        <td class='cntr bold border-3-black'>
                            {{tableData.course}}
                        </td>
                        <td class='cntr bold border-3-black'>
                            Група {{tableData.groupName}}
                        </td>
                        <td class='cntr bold border-3-black'>
                            {{tableData.controlDate}}
                        </td>
                    </tr>
                    <tr>
                        <td :colspan="maxColSpan">&nbsp;</td>
                    </tr>
                    <tr>
                        <td :colspan="maxColSpan" class='cntr bold value-with-number'>
                            ЗАЛІКОВА-ЕКЗЕМЕНАЦІЙНА ВІДОМІСТЬ №<input v-model="vidomistNumber" type="text" class="input-auto input-sm text-input">
                        </td>
                    </tr>
                    <tr>
                        <td :colspan="maxColSpan" class='cntr'>
                            семестрового контролю (диференційований залік, екзамен)
                        </td>
                    </tr>
                    <tr>
                        <td :colspan="maxColSpan" class='cntr'>
                            (потрібно підкреслити)
                        </td>
                    </tr>
                    <tr>
                        <td :colspan="maxColSpan" class='lft bold'>
                            З навчальної дисципліни '{{tableData.subjectName[0].name}}'
                        </td>
                    </tr>

                    <tr>
                        <td rowspan="2" class='cntr bold border-3-black'>
                            № п/п
                        </td>
                        <td rowspan="2" class='cntr bold border-3-black'>
                            Прізвище та ініціали
                        </td>
                        <td rowspan="2" class='cntr bold border-3-black'>
                            № залікової книжки, ІНПС
                        </td>
                        <td :colspan="3*marksSpan" class='cntr border-3-black bt extraMarksPart'>
                            Окремі Бали
                        </td>
                        <td colspan="3" class='cntr bold border-3-black'>
                            Підсумкова семестрова рейтингова оцінка
                        </td>
                    </tr>



                    <tr>
                        <template v-for="(subject,sector) in subjectHasTranslation" class="extraMarksPart">
                            <td colspan='3' :class='`cntr border-3-black bg-mark-${sector} extraMarksPart`'>
                                {{subject.name}}
                            </td>
                        </template>
                        <td class='cntr bold border-3-black'>
                            Бали
                        </td>
                        <td class='cntr bold border-3-black'>
                            За національною шкалою
                        </td>
                        <td class='cntr bold border-3-black'>
                            За шкалою ECTS
                        </td>
                    </tr>
                    <tr v-for="(student,key) in tableData.groupStudents" :class="`student-data`">

                        <td class='cntr bold border-3-black'>
                            {{key+1}}
                        </td>
                        <td class='cntr bold border-3-black'>
                            {{student.surname}} {{student.firstName}}
                        </td>
                        <td class='cntr bold border-3-black'>
                            <input type="text" :value="student.studentId" class="input-auto fill-secondary student-id" @input="colorChange">
                        </td>
                        <template v-for="(el,sector) in tableData.subjectHas" :class="` sideMarks st-${key}`">
                            <td :class='`border-3-black cntr bg-mark-${sector} extraMarksPart ${el.name}-mark`' ><input type="text" value="0" class="input-auto subj-1-mark fill" @input="calcRating"></td>
                            <td :class='`border-3-black cntr subj-2-mark bg-mark-${sector} extraMarksPart`' class=''>0</td>
                            <td :class='`border-3-black cntr subj-3-mark bg-mark-${sector} extraMarksPart`' class=''>0</td>
                        </template>
                        <td class='cntr bold border-3-black rating main-rating'>
                            0
                        </td>
                        <td class='cntr bold border-3-black nationalRating'>
                            0
                        </td>
                        <td class='cntr bold border-3-black ectsRating'>
                            0
                        </td>
                    </tr>
                    </tbody>
                </table>
            </md-card>
        </div>
    </div>
</template>
<style>
    .nau1{
        width:100px;
    }
    .nau2{
        width:75px;
    }
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
        overflow: unset;
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
        name: 'TeacherVidomist',
        data () {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                maxColSpan:0,
                vidomistNumber:0,
                allSubjectGroups:[],
                subjectList:[],
                groupList:[],
                activeSubject:{},
                activeGroup:-1,
                facultyInfo:{},
                subjectHasTranslation:[],
                tableData:{
                    facultyName:'',
                    specialityName:'',
                    departmentName:'',
                    subjectName:'',
                    opp:'',
                    termYears:new Date().getFullYear()+"/"+(new Date().getFullYear()+1),
                    course:'',
                    groupName:'',
                    controlDate:'',
                    courseCount:0,
                    passCount:0,
                    examCount:0,
                    practiceCount:0,
                    groupStudents: [],
                    subjectHas:[{name:"course"},{name:"exam"},{name:"pass"},{name:"practice"}],
                    semester:'',
                    marksSpan:1,
                },
                studentData:[],
                groupIsChosen:false,
                loadingDoc:false,
                responseXLSX:[],
                requestTable:'',
                footer:''
            }
        },
        methods: {
            getTeacherSubjects(){
                axios
                    .post('/getTeacherSubjects', {
                    })
                    .then(response => {
                        this.allSubjectGroups = response.data;
                    }).catch(e => {
                        this.errors.push(e.response.data.errors);
                    });
            },
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
            calcRating : function(event) {
                let tg = event.target;
                let currTR = $(tg.parentElement.parentElement).children('td').children('.subj-1-mark');

                let mrk = 0;
                if(!isNaN(tg.value)){

                    if(tg.value>100){
                        tg.value=100;
                    }

                    if(tg.value!=="" && tg.value !== '0')
                    {
                        tg.style.borderColor = "#38c172";
                    }else{
                        tg.style.borderColor = "#e3342f";
                    }

                    $(tg.parentElement.nextElementSibling).text(this.ratingToWord(parseFloat(tg.value)));
                    $(tg.parentElement.nextElementSibling.nextElementSibling).text(this.ratingToLetters(parseFloat(tg.value),false));

                    for(let i=0; i<currTR.length;i++)
                    {
                        mrk+=parseFloat(currTR[i].value);
                    }
                    mrk/=currTR.length;
                    if(mrk!==""){
                        $(tg.parentElement.parentElement).find(".rating").text(parseFloat(mrk.toFixed(2)));
                        $(tg.parentElement.parentElement).find(".nationalRating").text(this.ratingToWord(mrk));
                        $(tg.parentElement.parentElement).find(".ectsRating").text(this.ratingToLetters(mrk));
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
            ratingToWord: function(r)
            {
                if(r >= 90){
                    return 'Відмінно';
                }else if(r <= 89 && r>=82){
                    return 'Дуже добре';
                }else if(r <= 81 && r>=75){
                    return 'Добре';
                }else if(r <= 74 && r>=67){
                    return 'Задовільно';
                }else if(r <= 66 && r>=60){
                    return 'Достатньо';
                }else if(r <= 59 && r>=35){
                    return 'Незадовільно';
                }else if(r <= 34){
                    return 'Незадовільно';
                }
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
                    .get(`/getStudentsByGroup/${this.activeGroup}`)
                    .then(response => (this.tableData.groupStudents = response.data))
                    .catch(e => {
                        this.errors.push(e)
                    });
            },
            getAllData(){
                this.getStudentsByGroup();
            },
            getFacultyInfo() {
                axios
                    .post(`/getFacultyInfo`, {
                    })
                    .then(response => (this.facultyInfo = response.data))
                    .catch(e => {
                    });
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
                let allRatings = [];
                let allStudentIds = document.body.getElementsByClassName("student-id");

                $("tr.student-data").each((index, el) => {
                    allRatings[index] = {};
                    for(let num in this.tableData.subjectHas){
                        allRatings[index][this.tableData.subjectHas[num].name] = parseInt($(el).find(`.${this.tableData.subjectHas[num].name}-mark input`).val());
                    }
                });
                $(".extraMarksPart").remove();

                for(let i=0; i < this.tableData.groupStudents.length;i++){
                    this.studentData.push({
                        id : this.tableData.groupStudents[i].id,
                        studentId : allStudentIds[i]!==undefined ? allStudentIds[i].value : "",
                        rating : allRatings[i]
                    });
                }
                axios
                    .post(`/saveGroupDisciplineMarks`, {
                        group:this.activeGroup,
                        subject:this.activeSubject,
                        studentData:this.studentData,
                        number:this.vidomistNumber
                    })
                    .then(response => {})
                    .catch(e => {
                    });
                this.loadingDoc = true;
                $('.input-auto').each(function(index, elem){
                    if($(elem.parentElement).hasClass('value-with-number')){
                        elem.parentElement.innerHTML = elem.parentElement.innerText + elem.value;
                    }else{
                        elem.parentElement.innerHTML = elem.value;
                    }
                });
                $("#termYears").html(this.termYears);
                $("#termNumber").html(this.termNumber);
                this.getInlineStyles();
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
            getSubjects: function(){
                this.subjectList = this.allSubjectGroups.map(el => el.subject);
            },
            getSubjectHas(subject){
                this.subjectHasTranslation = [];
                this.tableData.subjectHas = [];
                this.marksSpan = 0;
                for(let property in subject.has){
                    this.marksSpan++;
                    let translation = "";
                    if(property === "course"){
                         translation = "Курсова";
                    }
                    if(property === "pass"){
                         translation = "Залік";
                    }
                    if(property === "exam"){
                         translation = "Екзамен";
                    }
                    if(property === "practice"){
                         translation = "Практика";
                    }

                    this.tableData.subjectHas.push({
                        name:`${property}`,
                    });

                    this.subjectHasTranslation.push({
                        name:`${translation}`,
                    });
                }
                this.maxColSpan = 6+this.marksSpan*3;
                console.log(`span is ${this.marksSpan}`);
            }
        },
        watch: {
            allSubjectGroups: function(val){
                if(val.length!==0){
                    this.getSubjects();
                }
            },
            activeSubject: function(val){
                if(val !== 0){
                    for(let num in this.allSubjectGroups){
                        if(this.allSubjectGroups[num].subject.id === this.activeSubject){
                            this.groupList = this.allSubjectGroups[num].groups;
                            this.getSubjectHas(this.allSubjectGroups[num].subject);
                        }
                    }
                    this.tableData.subjectName = this.subjectList.filter(el => el.id === this.activeSubject);
                }
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
            activeGroup: function(val)
            {
                if(val!==-1)
                {
                    this.getAllData();
                    this.groupIsChosen = true;
                    let now = new Date();
                    this.tableData.facultyName = this.facultyInfo.fullName;
                    let group = this.groupList.filter(el => el.id == this.activeGroup)[0];
                    this.tableData.groupName = group.idName;
                    this.tableData.controlDate = `${now.getDate()}.${now.getMonth()}.${now.getFullYear()}`;
                    this.tableData.course = group.idName.match(/\d+/)[0][0];
                    this.tableData.departmentName = group.department.fullName;
                    this.tableData.specialityName = `${group.speciality.number} ${group.speciality.fullName}`;
                    this.tableData.opp = group.eduProgram;
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
            this.getTeacherSubjects();
            this.getFacultyInfo();
        }
    }

</script>
