<template>
    <div>
        <b-form-group>
            <label for="notification_title" class="text-left">
                <span>Notification title</span>
            </label>
            <b-form-input
                id="notification_title"
                v-model="notification.title"
                placeholder="Notification title"
                @input="calculateTitleCharacters"
            ></b-form-input>
        </b-form-group>
        <small v-bind:class="[this.characters.title.error ? 'danger' : '']">
            {{characters.title.count}}/128 characters.
        </small>
        <b-form-group>
            <label for="notification_message" class="text-left">
                <span>Notification message</span>
                <i class="fa fa-question-circle" id="browser-behaviour"></i>
            </label>
            <b-form-textarea
                id="notification_message"
                v-model="notification.message"
                placeholder="Notification message"
                @input="calculateMessageCharacters"
            >
            </b-form-textarea>
            <small v-bind:class="[this.characters.message.error ? 'danger' : '']">
                {{characters.message.count}}/128 characters.
            </small>
            <div class="invalid-feedback">
                <span v-if="errors['notification.message']">{{errors['notification.message'][0]}}</span>
            </div>
        </b-form-group>
        <b-popover target="browser-behaviour" triggers="hover" placement="top">
            <template v-slot:title>Browser behaviour</template>
            <p>
                All browsers behave differently, the notification text length is different per browser type.
                We have listed the most common browsers with their character length per notification underneath:
            </p>
            <table>
                <tbody>
                <tr>
                    <td style="padding-right: 10px;">Chrome</td>
                    <td>128</td>
                </tr>
                <tr>
                    <td style="padding-right: 10px;">Safari</td>
                    <td>200</td>
                </tr>
                <tr>
                    <td style="padding-right: 10px;">Firefox</td>
                    <td>200</td>
                </tr>
                <tr>
                    <td style="padding-right: 10px;">Android</td>
                    <td>TBD</td>
                </tr>
                <tr>
                    <td style="padding-right: 10px;">AppleIOS</td>
                    <td>TBD</td>
                </tr>
                </tbody>
            </table>
        </b-popover>
    </div>
</template>

<script>
    export default {
        name: "PushNotificationMessage",
        data() {
            return {
                characters:{
                    message:{
                        count:0,
                        error:false
                    },
                    title:{
                        count:0,
                        error:false
                    }
                },
                notification:{
                    title:"",
                    message:"",
                },
                errors:[]
            };
        },
        mounted() {
        },
        methods: {
            calculateMessageCharacters() {
                this.characters.message.count = this.notification.message.length;
                if(this.characters.message.count > 128){
                    this.characters.message.error = true;
                } else {
                    this.characters.message.error = false;
                    this.$root.$emit('updateNotification', this.notification);
                }
            },
            calculateTitleCharacters() {
                this.characters.title.count = this.notification.title.length;
                if(this.characters.title.count > 128){
                    this.characters.title.error = true;
                } else {
                    this.characters.title.error = false;
                    this.$root.$emit('updateNotification', this.notification);
                }
            },
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
