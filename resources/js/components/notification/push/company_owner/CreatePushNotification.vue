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
                                <b-col align-self="center">
<!--                                    TODO::THIS IS THE PUSH NOTIFICATION PAGE ONE.-->
                                    <div class="text-center"><em>Send Notification</em></div>
                                </b-col>
                            </b-row>
                        </div>
                    </template>
                    <b-card-text>
                        <create-push-notification-partial :user="this.user"></create-push-notification-partial>
                    </b-card-text>
                    <template v-slot:footer></template>
                </b-card>
            </b-col>
        </b-row>
    </div>
</template>

<script>
    import CreatePushNotificationPartial from "../../../partials/Notifications/push/CreatePushNotificationPartial";
    export default {
        name: "CreatePushNotification",
        components: {CreatePushNotificationPartial},
        props: [
            'user'
        ],
        data() {
            return {
            };
        },
        mounted() {
        },
        created() {
        }


    }
</script>

<style scoped>
    .danger {
        color: #e3342f;
    }
    .invalid-feedback {
        color: #e3342f;
    }
</style>
