<template>
    <div>
        <b-row>
            <b-col>
                <b-row>
                    <b-col>
                        <push-notification-reciever-partial :user="this.user"></push-notification-reciever-partial>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col>
                        <push-notification-message></push-notification-message>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col>
                        <push-notification-action-partial></push-notification-action-partial>
                    </b-col>
                </b-row>
                <b-row class="pt-3">
                    <b-col align-self="end">
                        <div class="text-right">
                            <b-button size="sm" variant="notify-blue" @click="sendNotification">send</b-button>
                        </div>
                    </b-col>
                </b-row>
            </b-col>
        </b-row>
    </div>
</template>

<script>
    import PushNotificationRecieverPartial from "./PushNotificationRecieverPartial";
    import PushNotificationMessage from "./PushNotificationMessage";
    import PushNotificationActionPartial from "./PushNotificationActionPartial";

    export default {
        name: "CreatePushNotificationPartial",
        components: {PushNotificationActionPartial, PushNotificationMessage, PushNotificationRecieverPartial},
        props: [
            'user'
        ],
        data() {
            return {
                notification: {
                    receiverType: null,
                    notification: {
                        message: '',
                        title: '',
                        action: {
                            title: '',
                            link: '',
                        },
                    },
                    to: [],
                },
            };
        },
        created() {
        },
        mounted() {
            this.$root.$on('updateReceiver', (selectedReceiver, receiverType) => {
                this.updateReceiver(selectedReceiver, receiverType);
            });
            this.$root.$on('updateActions', (selectedAction) => {
                this.updateActions(selectedAction);
            });
            this.$root.$on('updateNotification', (notification) => {
                this.updateNotification(notification);
            });
        },
        methods: {
            sendNotification() {
                let url = variables.send_pushNotification;
                axios.post(url, this.notification)
                    .then(response => {
                        this.$toast.success(`Successfully send push notification.`)
                    })
                    .catch(error => {
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors;
                        }
                    });
            },
            updateReceiver(selectedReceiver, receiverType) {
                this.notification.receiverType = receiverType;
                this.notification.to = selectedReceiver;
            },
            updateActions(selectedAction){
                this.notification.notification.action.link = selectedAction.link;
                this.notification.notification.action.title = selectedAction.title;
            },
            updateNotification(notification){
                this.notification.notification.message = notification.message;
                this.notification.notification.title = notification.title;
            }
        }
    }
</script>

<style scoped>
    .bg-orange {
        background: orange;
    }
</style>
