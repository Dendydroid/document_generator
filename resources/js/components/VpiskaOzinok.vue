<template>
    <div class="pl-2 pr-2 grey-light page-height-default">
        <div class="p-t-b">
            <p class="display-4 text-center">Виписка оцінок</p>
            <div class="row pl-3 pr-3 pt-3">
                <div class="col-4">
                    <md-field>
                        <label>Количество семестров</label>
                        <md-input v-model="termCount" type="number" min="1"></md-input>
                        <span class="md-helper-text">Количество семестров в группе</span>
                    </md-field>
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

                <table lang="uk-UK" id="documentTable" v-if="chosenGroup">
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
                        <td colspan="13" class="cntr bold italic" style="font-size: 18px;">Факультет <input type="text" id="facultyName" v-model="facultyName" class="input-auto input-top-fac text-input"></td>
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
                        <td colspan="6" class="bold italic"><input type="text" v-model="groupInput" class='input-group-line input-auto text-input'></td>
                        <td colspan="6" class="bold cntr italic"><input placeholder="Куратор" type="text" id="curator" class='tableInp input-auto text-input'></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="6"></td>
                        <td colspan="6" class="cntr italic">(П.І.Б)</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="3" class="bold italic">яка навчається за спеціальністю</td>
                        <td colspan="3" class='cntr bold' id="specialityName">
                        </td>
                        <td colspan="6" class="bold italic cntr italic" id="groupOpp">
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="3"></td>
                        <td colspan="3" class="italic cntr">(назва спеціальності)</td>
                        <td colspan="6" class="italic cntr italic">(назва ОПП)</td>
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
                        <td rotate rowspan="2" colspan="1" class="cntr border-3-black rotate">Навчальний рік</td>
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

                    <template v-for="item in termArr">
                        <tr>
                            <td rotate :rowspan="groupSubjects.length+1" colspan="1" class="cntr italic border-3-black"><input type="text" :value="termYears" class="input-auto fill-secondary" @input="colorChange"></td>  <!-- rowspan="number of subjects" -->
                            <td rotate :rowspan="groupSubjects.length+1" colspan="1" class="cntr italic border-3-black"><input type="text" value="перший" class="input-auto fill-secondary" @input="colorChange"> <!-- семестр--></td>  <!-- rowspan="number of subjects" -->
                        </tr>
                        <template v-for="(subject,key) in groupSubjects">
                               <tr>
                                    <td colspan="1" class="cntr italic border-3-black">{{key+1}}<!-- порядковый номер предмета --></td>
                                    <td colspan="3" class="cntr italic border-3-black">{{subject.name}}<!-- название предмета --></td>
                                    <td colspan="1" class="cntr italic border-3-black">{{subject.hoursCount}}<!-- кол-во часов --></td>
                                    <td colspan="1" class="cntr italic border-3-black">{{subject.creditsCount}}<!-- кол-во кредитов --></td>
                                    <td colspan="1" class="cntr italic border-3-black"><input type="text" value="0" class="input-auto subj-1-mark fill" @input="calcRating"></td>
                                    <td colspan="2" class="cntr italic border-3-black subj-2-mark"><!-- нац шкала --></td>
                                    <td colspan="2" class="cntr italic border-3-black subj-3-mark"><!-- шкала естс --></td>
                                </tr>
                        </template>
                    </template>
                    
                    
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
                        <td colspan="6" class="cntr italic">Заступник декана <input type="text" v-model="facultyName" class="input-auto input-top-fac text-input"></td>
                        <td></td>
                        <td colspan="6" class="cntr italic"><input type="text" v-model="departmentHead" class="input-auto input-top-fac text-input"></td>
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
    .input-top-group-name{
        height:1rem !important;
        width:6rem !important;
    }
    .input-term{
        height:1rem !important;
        width:8rem !important;
    }
    .input-group-line{
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
        name: 'VpiskaOzinok',
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
                departmentHead:'',
                termCount:1,
                termArr:[0]
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

                    $(tg.parentElement).siblings('.subj-2-mark').text(this.ratingToWord(parseFloat(tg.value)));
                    $(tg.parentElement).siblings('.subj-3-mark').text(this.ratingToLetters(parseFloat(tg.value),false));
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
                    let curatorFIO = this.groupList[this.chosenGroup].curator.fio;
                    let curatorPhone = this.groupList[this.chosenGroup].curator.phone;
                    let headmanFIO = this.groupList[this.chosenGroup].headman.fio;
                    let headmanPhone = this.groupList[this.chosenGroup].headman.phone;
                    $("#curator").val(`${curatorFIO ? curatorFIO : ''} ${curatorPhone ? curatorPhone : ''}`);
                    $("#headman").val(`${headmanFIO ? headmanFIO : ''} ${headmanPhone ? headmanPhone : ''}`);
                    this.facultyName = this.groupList[this.chosenGroup].department.fullName;
                    let courseYear = this.groupList[this.chosenGroup].idName.match(/\d+/)[0][0];
                    $("#courseYear").val(`${courseYear}`);
                    this.chosenGroupName = `${groupIdName}`;
                    $("#termYears").val(this.termYears + ` навчальний рік (${courseYear}семестр)`);
                    $("#specialityName").html(`${this.groupList[this.chosenGroup].speciality.number} ${this.groupList[this.chosenGroup].speciality.fullName}`);
                    $("#groupOpp").html(this.groupList[this.chosenGroup].eduProgram);
                    this.departmentHead = this.groupList[this.chosenGroup].department.head;
                    this.groupInput = `студенти ${courseYear} курсу ${this.chosenGroupName} групи`;
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
            },
            termCount: function(val)
            {
                this.termArr = new Array(parseInt(val));
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
