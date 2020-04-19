<template>
    <div>
        <create-push-notification :company="company"></create-push-notification>
        <saved-push-notifications></saved-push-notifications>
    </div>
</template>

<script>

import CreatePushNotification from "./CreatePushNotification";
import SavedPushNotifications from "./SavedPushNotifications";

export default {
        name: "PushNotificationIndex",
    components: {SavedPushNotifications, CreatePushNotification},
    props: [
            'company'
        ],
        data() {
            return {
                test:null,
            };
        },
        mounted() {
        },
        created() {
        },
        methods: {
        }
    }
</script>

<style>

</style>
