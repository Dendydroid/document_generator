<template>
    <div class="container grey-light page-height-default">
        <div class="p-t">
            <md-card>
                <md-card-header>
                    <div class="md-title">
                        Факультеты
                    </div>
                    <div class="md-subhead">
                        Управление данными
                    </div>
                </md-card-header>
                <md-card-content>
                    <div class="buttons">
                        <md-button class="md-raised md-primary" v-on:click="add()">
                            Добавить
                        </md-button>
                        <md-button class="md-icon-button md-dense md-raised md-primary upd-icon">
                            <md-icon>cached</md-icon>
                        </md-button>
                    </div>
                </md-card-content>


                <md-table v-model="searched" md-card md-sort="id" md-sort-order="asc" md-fixed-header @md-selected="onSelect" :md-selected-value.sync="selected">
                    <md-table-toolbar>
                        <h1 class="md-title">
                        </h1>
                        <md-field md-clearable class="md-toolbar-section-end">
                            <md-input placeholder="Искать по наименованию.." v-model="search" @input="searchOnTable" />
                        </md-field>
                    </md-table-toolbar>

                    <md-table-toolbar slot="md-table-alternate-header" slot-scope="{ count }">
                        <div class="md-toolbar-section-start">{{ getAlternateLabel(count) }}</div>

                        <div class="md-toolbar-section-end">
                            <md-button v-if="showEditButton" class="md-icon-button md-raised btn-warn" @click="editSelected()" title="Изменить выделенный">
                                <md-icon>create</md-icon>
                            </md-button>
                            <md-button class="md-icon-button md-raised md-accent" title="Удалить выделенное"><md-icon>delete</md-icon></md-button>
                            <md-button class="md-icon-button md-raised" @click="clearSelected()" title="Сбросить выделение">
                                <md-icon>clear</md-icon>
                            </md-button>
                        </div>
                    </md-table-toolbar>

                    <md-table-empty-state
                        md-label="Факультет не найден"
                        :md-description="'Не было найдено ни одного факультета. Измените запрос или создайте новый факультет.'">
                        <md-button class="md-primary md-raised" @click="add()">Добавить</md-button>
                    </md-table-empty-state>

                    <md-table-row slot="md-table-row" slot-scope="{ item }" md-selectable="multiple" md-auto-select>
                        <md-table-cell md-label="ID" md-sort-by="id" md-numeric>{{ item.id }}</md-table-cell>
                        <md-table-cell md-label="Наименование" md-sort-by="fullName">{{ item.fullName }}</md-table-cell>
                        <md-table-cell md-label="Аббривиатура" md-sort-by="abbreviation">{{ item.abbreviation }}</md-table-cell>
                    </md-table-row>

                </md-table>

                <p>Selected:</p>
                {{ selected }}

            </md-card>
        </div>
    </div>
</template>

<style>
.buttons{
    display:flex;
    justify-content:space-between;
}
.upd-icon{
    margin-top:0.5rem;
}
.md-primary{
    background-color:orange !important;
    color:#448aff;
}
.md-numeric{
    text-align: center !important;
}
button.btn-warn{
    background-color:#feca57 !important;
}
</style>

<script>
    import axios from 'axios';

    const toLower = text => {
        return text.toString().toLowerCase();
    };

    const searchByName = (items, term) => {
        if (term) {
            return items.filter(item => toLower(item.fullName).includes(toLower(term)));
        }

        return items;
    };

    export default {
        name: 'ManageFaculties',
        data () {
            return {
                showEditButton:false,
                selected: [],
                search: null,
                searched: [],
                errors: [],
                dataSet: [
                    {
                        id: 1,
                        fullName: 'Shawna Dubbin',
                        abbreviation: 'wwwfa@geocities.com'
                    },
                    {
                        id: 2,
                        fullName: 'KSI Youtuber',
                        abbreviation: 'ksi21340@mail.com'
                    },
                    {
                        id: 3,
                        fullName: 'Jenna Marbles',
                        abbreviation: 'jmb220@gmail.com1'
                    },
                    {
                        id: 4,
                        fullName: 'Tony Kas1',
                        abbreviation: 'sdubbin0@geocities.com1'
                    },
                    {
                        id: 5,
                        fullName: 'Shawna Dubbin1',
                        abbreviation: 'wwwfa@geocities.com1'
                    },
                    {
                        id: 6,
                        fullName: 'KSI Youtuber1',
                        abbreviation: 'ksi21340@mail.com1'
                    },
                    {
                        id: 7,
                        fullName: 'Jenna Marbles2',
                        abbreviation: 'jmb220@gmail.com2'
                    },
                    {
                        id: 8,
                        fullName: 'Tony Kas2',
                        abbreviation: 'sdubbin0@geocities.com2'
                    },
                    {
                        id: 9,
                        fullName: 'Shawna Dubbin2',
                        abbreviation: 'wwwfa@geocities.com2'
                    },
                    {
                        id: 10,
                        fullName: 'KSI Youtuber3',
                        abbreviation: 'ksi21340@mail.com3'
                    },
                    {
                        id: 11,
                        fullName: 'Jenna Marbles3',
                        abbreviation: 'jmb220@gmail.com3'
                    },
                    {
                        id: 12,
                        fullName: 'Tony Kas3',
                        abbreviation: 'sdubbin0@geocities.com3'
                    },
                ]
            }
        },
        methods: {
            onSelect (items) {
                this.selected = items;
                this.toggleShowEditButton(items);
            },
            getAlternateLabel (count) {
                let plural = '';

                if (parseInt(count.toString().split('').pop()) === 1) {
                    plural = '';
                }else if (parseInt(count.toString().split('').pop()) > 1 && parseInt(count.toString().split('').pop()) < 5){
                    plural = 'а';
                }else{
                    plural = 'ов';
                }

                if(count > 10 && count < 21){
                    plural = 'ов';
                }

                return `Выделено ${count} факультет${plural}`;
            },
            add: function(){},
            refresh: function(){},
            searchOnTable () {
                this.searched = searchByName(this.dataSet, this.search)
            },
            clearSelected() {
                this.selected = [];
            },
            editSelected() {

            },
            toggleShowEditButton : function(items) {
                if(items.length === 1){
                    this.showEditButton = true;
                    return;
                }
                this.showEditButton = false;
            }
        },
        mounted() {
            axios
                .post('/getFaculties')
                .then(response => (this.dataSet = response.data))
                .catch(e => {
                    this.errors.push(e)
                });
        },
        created () {
            this.searched = this.dataSet;
        }
    }
</script>
