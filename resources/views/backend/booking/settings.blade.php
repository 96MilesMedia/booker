@extends('backend.layout.default')
@section('content')
    {!! Form::open(['url' => '/backend/booking/settings']) !!}
    <div class="page-wrap">
        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width">
            <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">Settings Type</th>
                    <th>Settings Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">Number of seats</td>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input" name="seats" type="text" id="seats" pattern="-?[0-9]*(\.[0-9]+)?" >
                            <label class="mdl-textfield__label" for="seats">Number</label>
                            <span class="mdl-textfield__error">Input is not a number!</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">Time Allocation</td>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input" name="time_allocation" type="text" id="time" pattern="-?[0-9]*(\.[0-9]+)?">
                            <label class="mdl-textfield__label" for="time">Number</label>
                            <span class="mdl-textfield__error">Input is not a number!</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">Email Address</td>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input" name="email" type="text" id="email">
                            <label class="mdl-textfield__label" for="email">Email Address</label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="section section--right">
            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
              Save Settings
            </button>
        </div>
    </div>
    {!! Form::close() !!}
@stop