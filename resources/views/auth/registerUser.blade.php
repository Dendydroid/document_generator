@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div id="errorMessages" class="col-md-8">

            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header larafont fs-modal-title">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form>
                            @csrf

                            <div class="form-group row">
                                <label for="firstName" class="col-md-4 col-form-label text-md-right">First Name</label>

                                <div class="col-md-6">
                                    <input id="firstName" type="text" class="form-control" name="firstName" required autocomplete="firstName" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="surname" class="col-md-4 col-form-label text-md-right">Surname</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text" class="form-control" name="surname" required autocomplete="surname" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="middleName" class="col-md-4 col-form-label text-md-right">Middle Name</label>

                                <div class="col-md-6">
                                    <input id="middleName" type="text" class="form-control" name="middleName" required autocomplete="middleName" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" required autocomplete="email">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

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

                            <div class="form-group row mb-0 justify-content-center">
                                <div class="col-md-6 fb-center">
                                    <button type="button" class="btn btn-primary" onclick="postRegister()">
                                        {{ __('Register') }}
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
