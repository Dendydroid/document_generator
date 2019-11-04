<template>
    <div class="pl-2 pr-2 grey-light page-height-default">
        <div class="p-t-b">
            <p class="display-4 text-center">Відомість</p>
            <div class="row pl-3 pr-3 pt-3">
                <div class="col-4">
                    <md-field>
                        <label>Выберите&nbsp;группу</label>
                        <md-select v-model="chosenGroup" name="chosenGroup" id="chosenGroup" :disabled="loadingDoc">
                            <md-option v-for="group in groupList" :value="group.id">{{group.idName}}</md-option>
                        </md-select>
                    </md-field>
                </div>
                <div class="col-4 center-button" v-show="groupIsChosen">
                    <form id="sendTableForm" action="http://127.0.0.1:5000/html2Excel" method="POST" >

                        <input type="hidden" name="html" v-model="requestTable">
                        <md-button type="button" class="md-dense md-raised md-primary" @click='prepareTable' :disabled="loadingDoc">Генерировать</md-button>
                    </form>
                </div>
            </div>

            <md-progress-bar md-mode="indeterminate" v-if="loadingDoc"></md-progress-bar>

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
                        <td colspan="12" class="bold cntr fa-m ">Нацiональний авiацiйний унiверситет</td>
                    </tr>
                    <tr>
                        <td colspan="12">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="1" class="bold italic border-3-black">Навчально-науковий інститут</td>
                        <td colspan="1" class="border-3-black">еуеууеуе</td>
                    </tr>
                    <tr>
                        <td colspan="1" class="bold italic border-3-black">Факультет</td>
                        <td colspan="1" class="bold border-3-black">.......</td>
                    </tr>
                    <tr>
                        <td colspan="1" class="bold italic border-3-black">Кафедра</td>
                        <td colspan="1" class="bold border-3-black">.......</td>
                    </tr>
                    <tr>
                        <td colspan="1" class="bold italic border-3-black">Спеціальність</td>
                        <td colspan="1" class="bold border-3-black">.......</td>
                    </tr>
                    <tr>
                        <td colspan="1" class="bold italic border-3-black">Спеціалізація</td>
                        <td colspan="1" class="bold border-3-black">.......</td>
                    </tr>
                    <tr>
                        <td colspan="1" class="bold italic border-3-black">Навчальний рiк</td>
                        <td colspan="1" class="border-3-black">2018/2019</td>
                    </tr>
                    <tr>
                        <td colspan="1" class="bold italic border-3-black">Семестр</td>
                        <td colspan="1" class="border-3-black">9</td>
                    </tr>
                    <tr>
                        <td colspan="1" class="bold italic border-3-black">Курс</td>
                        <td colspan="1" class="border-3-black">5</td>
                    </tr>
                    <tr>
                        <td colspan="1" class="bold italic border-3-black">Група</td>
                        <td colspan="1" class="bold italic border-3-black">117-а</td>
                    </tr>
                    <tr>
                        <td colspan="1" class="bold italic border-3-black">З дисциплiни</td>
                        <td colspan="1" class="bold border-3-black">........</td>
                    </tr>
                    <tr>
                        <td colspan="12" class="cntr bold fa-m">ВIДОМIСТЬ №1</td>
                    </tr>
                    <tr>
                        <td colspan="12" class="cntr bold fa-m">модульного контролю</td>
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
    .fa-m{
        font-size: 20px;
    }
</style>
<script>

    import axios from 'axios';

    axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };


    export default {
        name: 'Vidomist1Mod',
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
                loadingDoc:false,
                responseXLSX:[],
                requestTable:'',
                termNumber:1,
                termYears:new Date().getFullYear()+"/"+(new Date().getFullYear()+1),
                facultyName:'',
                chosenGroupName:'',
                subjectHasArr:[[],[],[],[]]
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

                if(!isNaN(tg.value)){

                    if(tg.value!=="" && tg.value !== '0')
                    {
                        tg.style.borderColor = "#38c172";
                    }else{
                        tg.style.borderColor = "#e3342f";
                    }

                    $(tg.parentElement.nextElementSibling).find('span').text(this.ratingToLetters(parseFloat(tg.value)));
                    $(tg.parentElement.nextElementSibling.nextElementSibling).find('span').text(this.ratingToFive(parseFloat(tg.value),false));
                    for(let i=0; i<currTR.length;i++)
                    {
                        mrk+=parseFloat(currTR[i].value);
                    }
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
                this.requestTable=document.getElementById("tableWrapper").innerHTML;
                setTimeout(function(){
                    $("#sendTableForm").submit();
                },1500);
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
                            this.subjectHasArr[0].push(val[subjectKey].name);
                        }else if(type === "pass")
                        {
                            this.passCount++;
                            this.subjectHasArr[1].push(val[subjectKey].name);
                        }else if(type === "exam")
                        {
                            this.examCount++;
                            this.subjectHasArr[2].push(val[subjectKey].name);
                        }else if(type === "practice")
                        {
                            this.practiceCount++;
                            this.subjectHasArr[3].push(val[subjectKey].name);
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
                    let curatorFIO = this.groupList[this.chosenGroup].curator.fio;
                    let curatorPhone = this.groupList[this.chosenGroup].curator.phone;
                    let headmanFIO = this.groupList[this.chosenGroup].headman.fio;
                    let headmanPhone = this.groupList[this.chosenGroup].headman.phone;
                    let courseYear = this.groupList[this.chosenGroup].idName.match(/\d+/)[0][0];
                    $("#curator").val(`Куратор: ${curatorFIO ? curatorFIO : ''} ${curatorPhone ? curatorPhone : ''}`);
                    $("#headman").val(`Командир: ${headmanFIO ? headmanFIO : ''} ${headmanPhone ? headmanPhone : ''}`);
                    this.facultyName = this.groupList[this.chosenGroup].department.fullName;
                    $("#courseYear").val(`${courseYear}`);
                    this.chosenGroupName = `Академічна группа ${groupIdName}`;
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
            $("#sendTableForm").bind('ajax:complete', function() {
                this.loadingDoc = false;
            });

        }
    }

</script>
