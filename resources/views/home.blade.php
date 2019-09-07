@extends('layouts.main')

@section('content')
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="removeAccount" tabindex="-1" role="dialog" aria-labelledby="removeAccountLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeAccountLabel"><i class="fas fa-exclamation-triangle f-r"></i>&nbsp;Are you sure?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>This action is <span class="f-r">irreversible</span>! <br> Are you sure you want to delete your account?</strong>
                    <hr>
                    <span class="fb-around w-100">
                        <label for="deletePassword" class="col-md-4 col-form-label text-md-left">Enter password</label>
                        <input id="deletePassword" type="password" class="form-control form-control-sm mt-1">

                    </span>
                    <span id="errorMessagesModal" class="w-100"></span>

                </div>
                <div class="modal-footer">
                    <div class="btn-group" role="group" aria-label="Controls">
                        <button type="button" class="btn btn-sm btn-success" onclick="removeAccount()">Yes, I am sure</button>
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="container">
    <div class="row justify-content-center">
        <div id="errorMessages" class="col-md-8">

        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Your profile</div>
                <div class="card-body">

                        <form>
                            @csrf

                            <div class="form-group row">
                                <label for="firstName" class="col-md-4 col-form-label text-md-right">First Name</label>

                                <div class="col-md-6">
                                    <input value="{{ session('firstName') }}" id="firstName" type="text" class="form-control" name="firstName" required autocomplete="firstName" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="surname" class="col-md-4 col-form-label text-md-right">Surname</label>

                                <div class="col-md-6">
                                    <input value="{{ session('surname') }}" id="surname" type="text" class="form-control" name="surname" required autocomplete="surname" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="middleName" class="col-md-4 col-form-label text-md-right">Middle Name</label>

                                <div class="col-md-6">
                                    <input value="{{ session('middleName') }}" id="middleName" type="text" class="form-control" name="middleName" required autocomplete="middleName" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input value="{{ session('email') }}" id="email" type="email" class="form-control" name="email" required autocomplete="email" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="old_password" class="col-md-4 col-form-label text-md-right">Old Password</label>

                                <div class="col-md-6">
                                    <input id="old_password" type="password" class="form-control" name="old_password" required autocomplete="old_password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="remove_account" class="col-md-4 col-form-label text-md-right">Remove account</label>

                                <div class="col-md-6">
                                    <button type="button" class="form-control btn btn-sm btn-outline-danger mt-1" data-toggle="modal" data-target="#removeAccount">
                                        Delete
                                    </button>
                                </div>
                            </div>



                            <div class="form-group row mb-0 justify-content-center">
                                <div class="col-md-6 fb-center">
                                    <button type="button" class="btn btn-primary" onclick="updatePassword()">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
