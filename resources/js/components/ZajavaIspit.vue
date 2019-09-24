<template>
    <div class="container grey-light page-height-default">
        <div class="p-t-b">
            <p class="display-4 text-center">Заява - іспит</p>
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
                    <form action="http://127.0.0.1:5000/html2Excel" method="POST">
                        <input type="text" name="html" v-model="requestTable" style="display:none">
                        <md-button type="submit" class="md-dense md-raised md-primary" @click="requestTable=$('#tableWrapper').html()">Генерировать</md-button>
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
<!-- <td rotate class="rotate" style="text-align:center;">ContentContentContentContentContent</td> -->
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>(Ф 03.02-80)</td>
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
                            <td>Декану ФККПІ</td>
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
                            <td>Азаренко О.В.</td>
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
                            <td style="text-align:right">студентів</td>
                            <td>групи СЗ-221</td>
                        </tr>
                        <tr>
                            <td colspan="13" style="text-align:center;font-weight:800;">ЗАЯВА</td>
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
                            <td colspan="13" style="text-align:center">
                                без порушень встановлених термінів і позитивної підсумкової семестрової модульної рейтингової оцінки,<br>
                                просимо Вашого дозволу на звільнення нас від складання семестрового екзамену з даної дисципліни<br>
                                провідний викладач ______________________________________ і зарахування відповідної<br>
                                підсумкової семестрової рейтингової оцінки.
                            </td>
                        </tr>
                        <tr>
                            <td colspan="13" style="text-align:center">
                                У зв’язку з отриманням у ___-му семестрі 2018/2019 навчального року позитивних підсумкових<br>
                                модульних рейтингових оцінок з усіх ____ модулів дисципліни _________________________________<br>
                                _______________________________________________________________________________
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="3" style="text-align:center;border-left:3px solid black;border-right:3px solid black;border-top:3px solid black;border-bottom:3px solid black;">
                                № п/п
                            </td>
                            <td rowspan="3" style="text-align:center;border-left:3px solid black;border-right:3px solid black;border-top:3px solid black;border-bottom:3px solid black;">
                                Прізвище та ініціали студента
                            </td>
                            <td colspan="10" style="text-align:center;border-left:3px solid black;border-right:3px solid black;border-top:3px solid black;border-bottom:3px solid black;">
                                Рейтингова оцінка
                            </td>
                            <td rowspan="3" style="text-align:center;border-left:3px solid black;border-right:3px solid black;border-top:3px solid black;border-bottom:3px solid black;">
                                Підпис студента
                            </td>

                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:center;border-left:3px solid black;border-right:3px solid black;border-top:3px solid black;border-bottom:3px solid black;">
                                Підсумкова модульна (бали)
                            </td>
                            <td colspan="2" style="text-align:center;border-left:3px solid black;border-right:3px solid black;border-top:3px solid black;border-bottom:3px solid black;">
                                Підсумкова семестрова модульна рейтингова оцінка
                            </td>
                            <td colspan="2" style="text-align:center;border-left:3px solid black;border-right:3px solid black;border-top:3px solid black;border-bottom:3px solid black;">
                                Екзаменаційна
                            </td>
                            <td colspan="2" style="text-align:center;border-left:3px solid black;border-right:3px solid black;border-top:3px solid black;border-bottom:3px solid black;">
                                Підсумкова семестрова рейтингова оцінка
                            </td>
                            <td><br>&nbsp;</td>
                        </tr>
                        <tr >
                            <td  style="text-align:center;border-left:3px solid black;border-right:3px solid black;border-top:3px solid black;border-bottom:3px solid black;">
                                Мод. №1
                            </td>
                            <td  style="text-align:center;border-left:3px solid black;border-right:3px solid black;border-top:3px solid black;border-bottom:3px solid black;">
                                Мод. №2
                            </td>
                            <td  style="text-align:center;border-left:3px solid black;border-right:3px solid black;border-top:3px solid black;border-bottom:3px solid black;">
                                Мод. №3
                            </td>
                            <td style="text-align:center;border-left:3px solid black;border-right:3px solid black;border-top:3px solid black;border-bottom:3px solid black;">
                                Бали
                            </td>
                            <td style="text-align:center;border-left:3px solid black;border-right:3px solid black;border-top:3px solid black;border-bottom:3px solid black;">
                                Націон. шкала
                            </td>
                            <td  style="text-align:center;border-left:3px solid black;border-right:3px solid black;border-top:3px solid black;border-bottom:3px solid black;">
                                Бали
                            </td>
                            <td  style="text-align:center;border-left:3px solid black;border-right:3px solid black;border-top:3px solid black;border-bottom:3px solid black;">
                                Націон. шкала
                            </td>
                            <td style="text-align:center;border-left:3px solid black;border-right:3px solid black;border-top:3px solid black;border-bottom:3px solid black;">
                                Бали
                            </td>
                            <td style="text-align:center;border-left:3px solid black;border-right:3px solid black;border-top:3px solid black;border-bottom:3px solid black;">
                                Націон. шкала
                            </td>
                            <td  style="text-align:center;border-left:3px solid black;border-right:3px solid black;border-top:3px solid black;border-bottom:3px solid black;">
                                Шкала ECTS
                            </td>
                        </tr>


                    </tbody>
                </table>
            </md-card>
        </div>
    </div>
</template>
<style>
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
                groupList:[],
                groupSubjects:[],
                chosenSubject:'',
                chosenGroup:'',
                groupIsChosen:false,
                subjectIsChosen:false,
                responseXLSX:[],
                requestTable:'',
                students:[]
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
                    .then(response => (this.students = response.data))
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
            }
        },
        watch: {
            chosenGroup: function(val)
            {
                if(val!='')
                {
                    this.getAllData();
                    this.groupIsChosen = true;
                }
            },
            chosenSubject: function(val)
            {
                if(val!='')
                {
                    this.subjectIsChosen = true;
                    this.requestTable = $("#tableWrapper").html();
                }
            }
        },
        created () {
            this.loadGroups();

        }
    }
</script>
