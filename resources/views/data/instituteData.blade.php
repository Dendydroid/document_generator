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
    <div class="modal fade" id="removeInstitute" tabindex="-1" role="dialog" aria-labelledby="removeInstituteLabel" aria-hidden="true">
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
                        <button type="button" class="btn btn-sm btn-success" onclick="deleteInstitute()" data-dismiss="modal">Confirm</button>
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Are you sure Modal -->
    <!--Add Modal -->
    <div class="modal fade" id="addInstitute" tabindex="-1" role="dialog" aria-labelledby="addInstituteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addInstituteLabel"><i class="far fa-plus-square" style="color:#2ecc71;"></i>&nbsp;New Institute</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="fb-around form-group">
                                <label class="larafont p-0 mt-1">Full&nbsp;Name</label>
                                <input id="fn" type="text" class="form-control" placeholder="">
                        </div>
                        <div class="fb-around mt-2">
                            <div class="col-2">
                                <label class="larafont p-0 mt-1">Abbreviation</label>
                            </div>
                            <div class="">
                                <input id="abbrev" type="text" class="form-control" placeholder="">
                            </div>
                        </div>

                        <div class="fb-around mt-2">
                            <div class="col-2">
                                <label class="larafont p-0 mt-1">Faculty</label>
                            </div>
                            <div class="col-2">
                                <select id="faculty_name" class="form-control">

                                </select>
                            </div>
                        </div>


                    </div>

                </div>
                <div class="modal-footer">
                    <div class="btn-group" role="group" aria-label="Controls">
                        <button id="addInstituteSave" type="button" class="btn btn-sm btn-success" onclick="addInstitute()" data-dismiss="modal">Save</button>
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add Modal -->
    <!-- Edit Modal -->
    <div class="modal fade" id="editInstitute" tabindex="-1" role="dialog" aria-labelledby="editInstituteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editInstituteLabel"><i class="far fa-plus-square" style="color:#f6b93b;"></i>&nbsp;Edit Institute</h5>
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

                        <div class="fb-around mt-2">
                            <div class="col-2">
                                <label class="larafont p-0 mt-1">Faculty</label>
                            </div>
                            <div class="col-2">
                                <select id="edit_faculty_name" class="form-control">

                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="btn-group" role="group" aria-label="Controls">
                        <button type="button" class="btn btn-sm btn-success" onclick="editInstitute()" data-dismiss="modal">Save</button>
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Edit Modal -->
    <button id="addInstituteButton" class="btn btn-outline-info btn-sm mb-5 ml-1" >
        Add Institute
    </button>



    <div class="fb-center">
        <span id="messageBox" class="w-50"></span>
    </div>
{{--    <div class="fb-center">--}}
{{--        <p id="chosenFaculty" class="larafont">No Faculty selected</p>--}}
{{--    </div>--}}
    <table id="instituteTable" class="display mt-5 table table-striped" style="width:100%">
        <thead>
        <tr>
            <th>id</th>
            <th>Full Name</th>
            <th>Abbreviation</th>
            <th>Faculty Name</th>
            <th>Faculty ID</th>
            <th class="text-center">Remove</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>id</th>
            <th>Full Name</th>
            <th>Abbreviation</th>
            <th>Faculty Name</th>
            <th>Faculty ID</th>
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
        var removeModal = document.querySelector('#removeInstitute');
        var editModal = document.querySelector("#editInstitute");


        var facultyList = document.querySelector("#facultyList");
        var addInstituteButton = document.querySelector("#addInstituteSave");
        function updateTable(table){
            table.ajax.reload(function(){
                var tableRowsSelector = "tr[role='row'] td:not(:last-child)";
                $(tableRowsSelector).css("cursor","pointer");
                /**
                 * On click on DataTable whole row (tr)
                 */
                $(tableRowsSelector).click(function(event) {
                        $("#editInstitute").modal('show');
                        $("#edit_fn").val(this.children[1].innerText);
                        $("#edit_abbrev").val(this.children[2].innerText);
                        editModal.editId = this.children[0].innerText;
                });
            });
        }
        $("#addInstituteButton").click(function(event){
            $('#addInstitute').modal('show');
        });

        function getFaculties()
        {
            $.ajax({
                url: '/getFaculties',
                type: 'POST',
                dataType: 'html',
                data: {},
                success : function (res)
                {
                    var res = JSON.parse(res);
                    var data = res.data;
                    $(facultyList).html('');
                    data.forEach(function(element){
                        $(facultyList).append(`
                            <option value="${element.id}"  >${element.fullName}</option>
                        `);
                        $('#faculty_name').append(`
                            <option value="${element.id}"  >${element.fullName}</option>
                        `);
                        $('#edit_faculty_name').append(`
                            <option value="${element.id}"  >${element.fullName}</option>
                        `);
                    });
                }
            });
        }

        $(document).ready(function() {

            getFaculties();
            table = $('#instituteTable').DataTable( {
                "processing": true,
                "serverSide": false,
                "ajax": {
                    "url": "{{route('getInstitutes')}}",
                    "type": "POST"
                },
                "columns": [
                    { "data": "id" },
                    { "data": "fullName" },
                    { "data": "abbreviation" },
                    { "data": "faculty.1" },
                    { "data": "faculty.0"},
                    {
                        data: null,
                        className: "center",
                        defaultContent: `<span class='fb-center-xy f-r tableIcon mr-3 mt-1' style="cursor:pointer" data-toggle="modal" data-target="#removeInstitute" onclick="removeModal.removeId=this.parentElement.parentElement.children[0].innerText"><i class="far fa-trash-alt"></i></span>`
                    }
                ]
            } );

             updateTable(table);

        } );


        function addInstitute()
        {
            $.ajax({
                url: '{{route('createInstitute')}}',
                type: 'POST',
                dataType: 'html',
                data: {
                    fullName:$("#fn").val(),
                    abbreviation:$("#abbrev").val(),
                    facultyId:$("#edit_faculty_name").val()
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
                                <strong class="text-capitalize">Done!</strong>&nbsp;A new institute was successfully created!
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
        function deleteInstitute()
        {
            $.ajax({
                url: '{{route('deleteInstitute')}}',
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




    </script>

@endsection
