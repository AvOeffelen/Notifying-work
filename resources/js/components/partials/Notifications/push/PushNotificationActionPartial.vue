<template>
    <div>
        <b-row>
            <b-col>
                <b-form-group>
                    <label for="notification_action_title" class="text-left">
                        Notification action title
                    </label>
                    <b-form-input id="notification_action_title"
                                  v-model="action.title"
                                  placeholder="Notification action title" @input="updateAction"></b-form-input>
                </b-form-group>
            </b-col>
        </b-row>
        <b-row>
            <b-col>
                <b-form-group>
                    <label for="notification_action_link" class="text-left">
                        Notification action link
                    </label>
                    <b-form-input id="notification_action_link"
                                  v-model="action.link"
                                  placeholder="Notification action link" @input="updateAction"></b-form-input>
                </b-form-group>
            </b-col>
        </b-row>
    </div>
</template>

<script>
    export default {
        name: "PushNotificationActionPartial",
        data() {
            return {
                action:{
                    title:"",
                    link:"",
                },
            };
        },
        mounted() {
        },
        methods: {
            updateAction(){
                this.$root.$emit('updateActions', this.action);
            }
        }
    }
</script>

<style scoped>

</style>
