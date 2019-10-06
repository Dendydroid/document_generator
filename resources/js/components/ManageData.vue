<template>
    <div class="container grey-light page-height-default" :style="secondStyle">
        <div class="p-t-b">
            <p class="display-4 text-center">
                Управление данными
            </p>
            <md-card md-with-hover class="orange-stress-transparent mt-2" onclick="window.location='/manageStudents'">
                <md-ripple>
                    <md-card-header>
                        <div class="md-title">Студенты</div>
                        <div class="md-subhead">Добавить / Удалить / Изменить</div>
                    </md-card-header>

                </md-ripple>
            </md-card>
            <md-card md-with-hover class="orange-stress-transparent mt-2" onclick="window.location='/manageGroups'">
                <md-ripple>
                    <md-card-header>
                        <div class="md-title">Группы</div>
                        <div class="md-subhead">Добавить / Удалить / Изменить</div>
                    </md-card-header>

                </md-ripple>
            </md-card>
            <md-card md-with-hover class="orange-stress-transparent mt-2" onclick="window.location='/manageSpecialities'">
                <md-ripple>
                    <md-card-header>
                        <div class="md-title">Специальности</div>
                        <div class="md-subhead">Добавить / Удалить / Изменить</div>
                    </md-card-header>

                </md-ripple>
            </md-card>
            <md-card md-with-hover class="orange-stress-transparent mt-2" onclick="window.location='/manageDepartments'">
                <md-ripple>
                    <md-card-header>
                        <div class="md-title">Кафедры</div>
                        <div class="md-subhead">Добавить / Удалить / Изменить</div>
                    </md-card-header>

                </md-ripple>
            </md-card>
            <md-card md-with-hover class="orange-stress-transparent mt-2" onclick="window.location='/manageSubjects'">
                <md-ripple>
                    <md-card-header>
                        <div class="md-title">Предметы</div>
                        <div class="md-subhead">Добавить / Удалить / Изменить</div>
                    </md-card-header>

                </md-ripple>
            </md-card>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };


    export default {
        data() {
            return {
                errors:[],
                secondStyle:'',
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
                        }

                    }).catch(e => {
                    console.log(e);
                    this.errors.push(e.data);
                });
            }
        },
        created() {
            this.getUserSession();
        }
    }
</script>
