@extends('backend.layout.default')
@section('content')
    <div class="login-section">
        <div class="login-form" id="auth">
            <div class="login-form-inputs">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="email" v-model="email">
                    <label class="mdl-textfield__label" for="email">Email Address</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="password" id="password" v-model="password">
                    <label class="mdl-textfield__label" for="password">Password</label>
                </div>
            </div>
            <div v-show="error" v-cloak>
                <p class="body mdl-color-text--red">{{ errorMessage }}</p>
            </div>
            <div class="login-form-footer">
                <div class="mdl-spinner mdl-spinner--submit-form mdl-js-spinner is-active" v-show="submitted" v-cloak></div>

                <button v-on:click="login($event)" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" :disabled="submitted">
                    Login
                </button>
            </div>
        </div>
    </div>
@stop