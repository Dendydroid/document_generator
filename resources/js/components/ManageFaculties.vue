<template>
    <div class="container grey-light page-height-default">
        <div class="p-t">
            <data-table
                url="http://localhost/getFaculties"
                :per-page="perPage"
                :columns="columns">
            </data-table>
        </div>
    </div>
</template>

<style>

</style>

<script>
    export default {
        data() {
            return {
                perPage: ['10', '25', '50'],
                columns: [
                    {
                        label: 'ID',
                        name: 'id',
                        filterable: true,
                    },
                    {
                        label: 'Name',
                        name: 'name',
                        filterable: true,
                    },
                    {
                        label: 'Email',
                        name: 'email',
                        filterable: true,
                    },
                    {
                        label: '',
                        name: 'View',
                        filterable: false,
                    },
                ]
            }
        },
    }
</script>
