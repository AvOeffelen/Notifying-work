<template>
    <div>
        <create-push-notification :user="user"></create-push-notification>
        <saved-push-notifications></saved-push-notifications>
    </div>
</template>

<script>

import CreatePushNotification from "./CreatePushNotification";
import SavedPushNotifications from "./SavedPushNotifications";

export default {
        name: "PushNotificationIndex",
        components: {SavedPushNotifications, CreatePushNotification},
        props:[
            'company',
            'user'
        ],
        data() {
            return {
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
