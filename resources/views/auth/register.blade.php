@extends('layouts.app')

@section('main')

    <div class="columns">
        <div class="column is-one-third is-offset-one-third">

            <div class="el-card">
                <div class="el-card__header"><p class="title">{{ __('Register') }}</p> </div>

                <div class="el-card__body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="field is-horizontal">
                            <div class="field-label is-normal"><label for="username" class="label">{{ __('Username') }}</label></div>

                            <div class="field-body">
                                <div class="field">
                                    <div class="control">
                                        <input id="username" type="text" class="input{{ $errors->has('username') ? ' is-danger' : '' }}" name="username" required value="{{ old('username') }}">
                                    </div>
                                    @if ($errors->has('username'))
                                        <p class="help is-danger">{{ $errors->first('username') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label is-normal"><label for="password" class="label">{{ __('Password') }}</label></div>

                            <div class="field-body">
                                <div class="field">
                                    <div class="control">
                                        <input id="password" type="password" class="input{{ $errors->has('password') ? ' is-danger' : '' }}" name="password" required>
                                    </div>
                                    @if ($errors->has('password'))
                                        <p class="help is-danger">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label is-normal"><label for="password-confirm" class="label">{{ __('Confirm Password') }}</label></div>

                            <div class="field-body">
                                <div class="field">
                                    <div class="control">
                                        <input id="password-confirm" type="password" class="input{{ $errors->has('password') ? ' is-danger' : '' }}" name="password_confirmation" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label">
                                <!-- Left empty for spacing -->
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <div class="control">
                                        <button type="submit" class="button is-primary">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>



@endsection


@section('script')
    <script>
        const data ={
            data: function () {},
            methods: {},
        }
    </script>
@endsection
