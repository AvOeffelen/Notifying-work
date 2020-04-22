<template>
    <div>
        <b-row>
            <b-col>
                <b-row>
                    <b-col>
                        <push-notification-reciever-partial :user="user"></push-notification-reciever-partial>
                    </b-col>
                </b-row>
                <b-row class="pt-5">
                    <b-col>
                        <b-button size="sm" variant="notify-blue" @click="sendNotification">send</b-button>
                    </b-col>
                </b-row>
            </b-col>
        </b-row>
    </div>
</template>

<script>
    import PushNotificationRecieverPartial from "./PushNotificationRecieverPartial";

    export default {
        name: "CreatePushNotificationPartial",
        components: {PushNotificationRecieverPartial},
        props: [
            'user'
        ],
        data() {
            return {

            };
        },
        mounted() {
            this.$root.$on('updateReceiver', (selectedReceiver, receiverType) => {
                this.updateReceiver(selectedReceiver, receiverType);
            });
        },
        methods:{
            sendNotification(){

            },
            updateReceiver (selectedReceiver, receiverType){
                console.log("receiver",selectedReceiver, receiverType)
            }
        }
    }
</script>

<style scoped>
    .bg-orange {
        background: orange;
    }
</style>
