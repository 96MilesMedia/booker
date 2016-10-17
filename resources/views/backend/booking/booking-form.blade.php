<div>
    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width">
        <tbody>
            <tr>
                <td class="mdl-data-table__cell--non-numeric">Party Name</td>
                <td>
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" name="name" type="text" id="name" v-model="booking.name" required="true">
                        <label class="mdl-textfield__label" for="name">Party Name</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="mdl-data-table__cell--non-numeric">Contact Email</td>
                <td>
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" name="email" type="email" id="email" v-model="booking.email" required="true">
                        <label class="mdl-textfield__label" for="email">Contact Email</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="mdl-data-table__cell--non-numeric">Contact Telephone</td>
                <td>
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" name="telephone" type="text" id="telephone" v-model="booking.telephone" required="true">
                        <label class="mdl-textfield__label" for="telephone">Contact Telephone</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="mdl-data-table__cell--non-numeric">Party Size</td>
                <td>
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" name="size" type="text" id="size" pattern="-?[0-9]*(\.[0-9]+)?" v-model="booking.size" required="true">
                        <label class="mdl-textfield__label" for="size">Party Size</label>
                        <span class="mdl-textfield__error">Input is not a number!</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="mdl-data-table__cell--non-numeric">Date of Booking</td>
                <td>
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input input-calendar" name="date" type="text" id="date" v-model="booking.date" required="true">
                        <label class="mdl-textfield__label" for="date"></label>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="mdl-data-table__cell--non-numeric">Time of Booking</td>
                <td>
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" name="time" type="text" id="time" v-model="booking.time" required="true">
                        <label class="mdl-textfield__label" for="time">Time</label>
                    </div>
                </td>
            </tr>
            <tr v-if="booking.status">
                <td class="mdl-data-table__cell--non-numeric">Status</td>
                <td>
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" name="status" type="text" id="status" v-model="booking.status"  readonly="readonly">
                        <label class="mdl-textfield__label" for="status">Status</label>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>