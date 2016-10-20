@extends('backend.layout.default')
@section('content')
    <div class="user-settings">
        <div class="user-settings" id="userSettings">
            <div class="user-settings-inputs">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="user-email" v-model="user.email">
                    <label class="mdl-textfield__label" for="user-email">Email Address</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="password" id="user-password" v-model="user.password">
                    <label class="mdl-textfield__label" for="user-password">Password</label>
                </div>
            </div>
            <div class="user-settings-footer">
                <button v-on:click="updateSettings($event)" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" :disabled="formSubmitted">
                    Update Settings
                </button>
                <div class="mdl-spinner mdl-spinner--submit-form mdl-js-spinner is-active" v-show="formSubmitted" v-cloak></div>
            </div>
        </div>
    </div>
@stop