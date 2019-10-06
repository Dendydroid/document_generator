<template>
    <div class="container grey-light page-height-default super-text-main" :style="secondStyle">

            <p class="super-text">
                GENERATOR
            </p>

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
