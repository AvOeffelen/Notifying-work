<template>
    <div>
        <b-row>
            <b-col>
                <b-card
                    header-tag="header"
                    header-class=""
                    header-bg-variant="notify-blue"
                    header-text-variant="white"
                    footer-tag="footer"
                    class="mb-2 text-center"
                >
                    <template v-slot:header>
                        <div class="header-card">
                            <b-row>
                                <b-col align-self="start"></b-col>
                                <b-col align-self="center">
                                    <div class="text-center"><em>Saved notifications</em></div>
                                </b-col>
                                <b-col align-self="end">
                                </b-col>
                            </b-row>
                        </div>
                    </template>
                    <b-card-text>
                        <b-row>
                            <b-col>
                                <table class="table table-borderless">
                                    <tr>
                                        <th></th>
                                        <th>title</th>
                                        <th>message</th>
                                        <th>recievers</th>
                                        <th></th>
                                    </tr>
                                    <tbody>
                                    <tr>
                                        <td></td>
                                        <td>Wist je dat?</td>
                                        <td>Over 15 minuten hebben we een vegardering</td>
                                        <td>Department x, Henk</td>
                                        <td class="text-right">
                                            <b-button size="sm" variant="notify-blue">
                                                send now
                                            </b-button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Wist je dat?</td>
                                        <td>Over 15 minuten hebben we een vegardering</td>
                                        <td>Department x, Henk</td>
                                        <td class="text-right">
                                            <b-button size="sm" variant="notify-blue">
                                                send now
                                            </b-button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Wist je dat?</td>
                                        <td>Over 15 minuten hebben we een vegardering</td>
                                        <td>Department x, Henk</td>
                                        <td class="text-right">
                                            <b-button size="sm" variant="notify-blue">
                                                send now
                                            </b-button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Wist je dat?</td>
                                        <td>Over 15 minuten hebben we een vegardering</td>
                                        <td>Department x, Henk</td>
                                        <td class="text-right">
                                            <b-button size="sm" variant="notify-blue">
                                                send now
                                            </b-button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Wist je dat?</td>
                                        <td>Over 15 minuten hebben we een vegardering</td>
                                        <td>Department x, Henk</td>
                                        <td class="text-right">
                                            <b-button size="sm" variant="notify-blue">
                                                send now
                                            </b-button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Wist je dat?</td>
                                        <td>Over 15 minuten hebben we een vegardering</td>
                                        <td>Department x, Henk</td>
                                        <td class="text-right">
                                            <b-button size="sm" variant="notify-blue">
                                                send now
                                            </b-button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Wist je dat?</td>
                                        <td>Over 15 minuten hebben we een vegardering</td>
                                        <td>Department x, Henk</td>
                                        <td class="text-right">
                                            <b-button size="sm" variant="notify-blue">
                                                send now
                                            </b-button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </b-col>
                        </b-row>
                    </b-card-text>
                    <template v-slot:footer>

                    </template>
                </b-card>
            </b-col>
        </b-row>
    </div>
</template>

<script>
    export default {
        name: "SavedPushNotifications"
    }
</script>

<style scoped>

</style>
