@extends('layouts.main')

@section('content')
    <style>
        .row{
            /**
             * Table wrapper row makes page wider causing x-overflow
             */
            margin:0 !important;
        }
        .row>.col-sm-12{
            /**
             * Table wrapper col in rows has padding, ugly
             */
            padding:0 !important;
        }
    </style>
    <!--Are you sure Modal -->
    <div class="modal fade" id="removeFaculty" tabindex="-1" role="dialog" aria-labelledby="removeFacultyLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeInstituteLabel"><i class="fas fa-exclamation-triangle f-r"></i>&nbsp;Are you sure?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>This action is <span class="f-r">irreversible</span>! <br> Are you sure you want to delete this record?</strong>
                    <input id="removeId" type="text" style="display:none">

                </div>
                <div class="modal-footer">
                    <div class="btn-group" role="group" aria-label="Controls">
                        <button type="button" class="btn btn-sm btn-success" onclick="deleteFaculty()" data-dismiss="modal">Confirm</button>
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Are you sure Modal -->
    <!--Add Modal -->
    <div class="modal fade" id="addFaculty" tabindex="-1" role="dialog" aria-labelledby="addFacultyLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFacultyLabel"><i class="far fa-plus-square" style="color:#2ecc71;"></i>&nbsp;New Faculty</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="container">
                        <div class="fb-around">
                            <div class="col-2">
                                <label class="larafont p-0 mt-1">Full&nbsp;Name</label>
                            </div>
                            <div class="">
                                <input id="fn" type="text" class="'form-control" placeholder="">
                            </div>
                        </div>
                        <div class="fb-around mt-2">
                            <div class="col-2">
                                <label class="larafont p-0 mt-1">Abbreviation</label>
                            </div>
                            <div class="">
                                <input id="abbrev" type="text" class="'form-control" placeholder="">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="btn-group" role="group" aria-label="Controls">
                        <button type="button" class="btn btn-sm btn-success" onclick="addFaculty()" data-dismiss="modal">Save</button>
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add Modal -->
    <!-- Edit Modal -->
    <div class="modal fade" id="editFaculty" tabindex="-1" role="dialog" aria-labelledby="editFacultyLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFacultyLabel"><i class="far fa-plus-square" style="color:#f6b93b;"></i>&nbsp;Edit Faculty</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="container">
                        <div class="fb-around">
                            <div class="col-2">
                                <label class="larafont p-0 mt-1">Full&nbsp;Name</label>
                            </div>
                            <div class="">
                                <input id="edit_fn" type="text" class="'form-control" placeholder="">
                            </div>
                        </div>
                        <div class="fb-around mt-2">
                            <div class="col-2">
                                <label class="larafont p-0 mt-1">Abbreviation</label>
                            </div>
                            <div class="">
                                <input id="edit_abbrev" type="text" class="'form-control" placeholder="">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="btn-group" role="group" aria-label="Controls">
                        <button type="button" class="btn btn-sm btn-success" onclick="editFaculty()" data-dismiss="modal">Save</button>
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Edit Modal -->
    <button class="btn btn-outline-info btn-sm mb-5 ml-1" data-toggle="modal" data-target="#addFaculty">
        Add Faculty
    </button>
    <div class="fb-center">
        <span id="messageBox" class="w-50"></span>
    </div>
    <table id="facultyTable" class="display mt-5 table table-striped" style="width:100%">
        <thead>
        <tr>
            <th>id</th>
            <th>Full Name</th>
            <th>Abbreviation</th>

            <th class="text-center">Remove</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>id</th>
            <th>Full Name</th>
            <th>Abbreviation</th>

            <th class="text-center">Remove</th>
        </tr>
        </tfoot>
    </table>
@endsection
@section('pageScript')
    <script>

        var table = null;
        var msg = document.querySelector("#messageBox");
        var msgFadeOutTime = 5000;
        var msgFadeInTime = 500;
        var removeModal = document.querySelector('#removeFaculty');
        var editModal = document.querySelector("#editFaculty");

        function updateTable(table){
            table.ajax.reload(function(){
                var tableRowsSelector = "tr[role='row'] td:not(:last-child)";
                $(tableRowsSelector).css("cursor","pointer");
                /**
                 * On click on DataTable whole row (tr)
                 */
                $(tableRowsSelector).click(function(event) {
                    $("#editFaculty").modal('show');
                    $("#edit_fn").val(this.parentElement.children[1].innerText);
                    $("#edit_abbrev").val(this.parentElement.children[2].innerText);
                    editModal.editId = this.parentElement.children[0].innerText;
                });
            });
        }

        $(document).ready(function() {
            table = $('#facultyTable').DataTable( {
                "processing": true,
                "serverSide": false,
                "ajax": {
                    "url": "{{route('getFaculties')}}",
                    "type": "POST"
                },
                "columns": [
                    { "data": "id" },
                    { "data": "fullName" },
                    { "data": "abbreviation" },

                    {
                        data: null,
                        className: "center",
                        defaultContent: `<span class='fb-center-xy f-r tableIcon mr-3 mt-1' style="cursor:pointer" data-toggle="modal" data-target="#removeFaculty" onclick="removeModal.removeId=this.parentElement.parentElement.children[0].innerText"><i class="far fa-trash-alt"></i></span>`
                    }
                ]
            } );

            updateTable(table);

        } );


        function addFaculty()
        {
            $.ajax({
                url: '{{route('createFaculty')}}',
                type: 'POST',
                dataType: 'html',
                data: {
                    fullName:$("#fn").val(),
                    abbreviation:$("#abbrev").val()
                },
                success : function(res)
                {
                    updateTable(table);
                    res = JSON.parse(res);
                    if(res.success)
                    {
                        $(msg).html('');
                        $(msg).append(`
                           <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom:0 !important; margin-top:1rem !important;">
                                <strong class="text-capitalize">Done!</strong>&nbsp;A new faculty was successfully created!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        `);
                        $(msg).fadeIn(msgFadeInTime);
                        $(msg).fadeOut(msgFadeOutTime);
                    }else if(res.errors){
                        $(msg).html('');
                        for (var property in res.errors){
                            $(msg).append(`
                               <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong class="text-capitalize">${property}</strong>&nbsp;${res.errors[property]}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            `);
                        }
                        $(msg).fadeIn(msgFadeInTime);
                        $(msg).fadeOut(msgFadeOutTime);
                    }else{
                        $(msg).html('');
                        for (var property in res){
                            $(msg).append(`
                               <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong class="text-capitalize">Failed</strong>&nbsp;Some error occured!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            `);
                        }
                        $(msg).fadeIn(msgFadeInTime);
                        $(msg).fadeOut(msgFadeOutTime);
                    }
                }
            });
        }
        function deleteFaculty()
        {
            $.ajax({
                url: '{{route('deleteFaculty')}}',
                type: 'POST',
                dataType: 'html',
                data: {
                    id: removeModal.removeId,
                },
                success: function (res) {
                    updateTable(table);
                    res = JSON.parse(res);
                }
            });
        }
        function editFaculty()
        {
            $.ajax({
                url: '{{route('editFaculty')}}',
                type: 'POST',
                dataType: 'html',
                data: {
                    id: editModal.editId,
                    fullName: $("#edit_fn").val(),
                    abbreviation: $("#edit_abbrev").val()
                },
                success: function (res) {
                    updateTable(table);
                    res = JSON.parse(res);
                    if(res.success)
                    {
                        $(msg).html('');
                        $(msg).append(`
                           <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom:0 !important; margin-top:1rem !important;">
                                <strong class="text-capitalize">Done!</strong>&nbsp;A faculty was successfully updated!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        `);
                        $(msg).fadeIn(msgFadeInTime);
                        $(msg).fadeOut(msgFadeOutTime);
                    }else if(res.errors){
                        $(msg).html('');
                        for (var property in res.errors){
                            $(msg).append(`
                               <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong class="text-capitalize">${property}</strong>&nbsp;${res.errors[property]}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            `);
                        }
                        $(msg).fadeIn(msgFadeInTime);
                        $(msg).fadeOut(msgFadeOutTime);
                    }else{
                        $(msg).html('');
                        for (var property in res){
                            $(msg).append(`
                               <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong class="text-capitalize">Failed</strong>&nbsp;Some error occured!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            `);
                        }
                        $(msg).fadeIn(msgFadeInTime);
                        $(msg).fadeOut(msgFadeOutTime);
                    }
                }
            });
        }




    </script>

@endsection
