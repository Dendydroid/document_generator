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
                <div class="col-4 center-button" v-show="groupIsChosen">
                    <form id="sendTableForm" action="http://127.0.0.1:5000/html2Excel" method="POST">

                        <input type="hidden" name="html" v-model="requestTable">
                        <md-button type="button" class="md-dense md-raised md-primary" @click='prepareTable()'>Генерировать</md-button>
                    </form>

                </div>
            </div>

            <md-card id="tableWrapper">
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
                            ФАКУЛЬТЕТ <input type="text" id="facultyName" v-model="facultyName" class="input-auto input-top-fac">
                        </td>
                    </tr>
                    <tr>
                        <td :colspan="maxColSpan" class='cntr bold'>
                            ЗВЕДЕНА ВІДОМІСТЬ УСПІШНОСТІ
                        </td>
                    </tr>
                    <tr>
                        <td :colspan="maxColSpan" class='cntr bold'>
                            <input type="text" :value="termYears" id="termYears" class="input-auto input-top-date">
                        </td>
                    </tr>
                    <tr>
                        <td :colspan="maxColSpan" class='cntr bold'>
                            <input type="text" value="1" id="courseYear" class="input-auto input-top-course">&nbsp;курс
                        </td>
                    </tr>
                    <tr>
                        <td :colspan="maxColSpan" class='cntr bold' id="specialityName">
                        </td>
                    </tr>
                    <tr>
                        <td :colspan="maxColSpan" class='cntr bold' id="groupOpp">
                        </td>
                    </tr>
                    <tr>
                        <td :colspan="maxColSpan" class='lft'>
                            Куратор:&nbsp;<input type="text" id="curator" class='tableInp input-auto'>
                        </td>
                    </tr>
                    <tr>
                        <td :colspan="maxColSpan" class='lft'>
                            Командир:&nbsp;<input type="text" id="headman" class='tableInp input-auto'>
                        </td>
                    </tr>
                    <tr>
                        <td :colspan="maxColSpan" class='lft' id="groupName">
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
                    <tr v-for="(student, key) in groupStudents" class='studentRow'>
                        <td class='lft border-3-black cntr'>
                            {{key+1}}
                        </td>
                        <td class='lft border-3-black'>
                            {{`${student.surname}&nbsp;${student.firstName}&nbsp;${student.middleName}`}}
                        </td>
                        <td class='lft border-3-black'>
                            <input type="text" :value="student.studentId" class="input-auto fill" @input="colorChange">
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
                                        <input type="text" value="0" class="input-auto subj-1-mark fill" @input="calcRating">
                                    </td>
                                    <td class='lft border-3-black cntr subj-2-mark'>
                                        <span>
                                            0
                                        </span>
                                    </td>
                                    <td class='lft border-3-black cntr subj-3-mark'>
                                        <span>
                                            0
                                        </span>
                                    </td>
                               </template>
                        </template>
                        
                        <td class='lft border-3-black cntr bold depts'>
                            <input type="text" value="" class="input-auto fill" @input="colorChange">
                        </td>
                        <td class='lft border-3-black cntr bold personalTimetable'>
                             <input type="text" value="" class="input-auto fill" @input="colorChange">
                        </td>
                        <td class='lft border-3-black cntr bold IZDN'>
                             <input type="text" value="" class="input-auto fill" @input="colorChange">
                        </td>
                        <td class='lft border-3-black cntr bold kickOut'>
                             <input type="text" value="" class="input-auto fill" @input="colorChange">
                        </td>
                    </tr>
                    
                    </tbody>
                </table>
            </md-card>
        </div>
    </div>
</template>
<style>
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
    .subj-2-mark{
        padding: 10px;
    }
    .subj-3-mark{
        padding: 10px;
    }
    input{
        width:4rem !important;
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
        outline:1px solid #e3342f;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
    }
    .input-auto.fill:focus{
        outline-color:#3490dc;
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
                maxColSpan:0,
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
                responseXLSX:[],
                requestTable:'',
                termNumber:1,
                termYears:new Date().getFullYear()+"/"+(new Date().getFullYear()+1),
                facultyName:''
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
            calcRating : function(event) {
                let tg = event.target;
                let currTR = $(tg.parentElement.parentElement).children('td').children('.subj-1-mark');
                let mrk = 0;

                if(tg.value!=="" && tg.value !== '0')
                {
                    tg.style.outlineColor = "#38c172";
                }else{
                    tg.style.outlineColor = "#e3342f";
                }

                $(tg.parentElement.nextElementSibling).find('span').text(this.ratingToLetters(parseFloat(tg.value)));
                $(tg.parentElement.nextElementSibling.nextElementSibling).find('span').text(this.ratingToFive(parseFloat(tg.value),false));
                for(let i=0; i<currTR.length;i++)
                {
                    mrk+=parseFloat(currTR[i].value);
                }
                mrk/=currTR.length;
                $(tg.parentElement).siblings(".rating").text(parseFloat(mrk.toFixed(2)));
                $(tg.parentElement).siblings(".averageMark").text(this.ratingToFive(mrk));
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
                this.getInlineStyles();
                this.requestTable=$("#tableWrapper").html();
                $("#sendTableForm").submit();
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

                    tdStyles+=`border-top-width:${$(el).css("border-top-width")};`;
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
                    //DEFAULT STYLES
                    tdStyles+=`overflow:auto;`;
                    $(el).attr("style",tdStyles);
                });
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
                this.maxColSpan = parseInt(this.getRealWidth());
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
