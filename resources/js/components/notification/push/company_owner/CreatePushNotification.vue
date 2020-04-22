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
                                    <div class="text-center"><em>Create Push Notifications</em></div>
                                </b-col>
                                <b-col align-self="end">
                                </b-col>
                            </b-row>
                        </div>
                    </template>
                    <b-card-text>
                        <b-row>
                            <b-col></b-col>
                            <b-col>
                                <b-form-group>
                                    Notification reciever
                                    <label label="Notification Reciever" label-for="notification_reciever">
                                        <i class="fa fa-question-circle" id="notification_reciever"></i>
                                        <b-popover target="notification_reciever" triggers="hover" placement="top">
                                            <template v-slot:title>Notification reciever</template>
                                            <p>Employees who has accepted the request to recieve push notifications will
                                                recieve this notification.
                                                If your employee has not accepted this request they will <b>NOT</b>
                                                recieve this notification.
                                            </p>
                                        </b-popover>
                                    </label>
                                    <multiselect v-model="notification.selectedReciever"
                                                 :options="notification.recieverOptions"
                                                 placeholder="Select reciever type."
                                                 :preselect-first="true"
                                                 id="notifcation_reciever"
                                                 :searchable="false"
                                                 :allow-empty="false"
                                                 @input="updateSelectedReciever"
                                    >
                                    </multiselect>
                                </b-form-group>
                            </b-col>
                            <b-col></b-col>
                        </b-row>
                        <b-row v-if="notification.selectedReciever == 'department'">
                            <b-col></b-col>
                            <b-col>
                                <b-form-group>
                                    <label label="Select department"
                                           label-for="notification_reciever_selected_department">
                                        Select employees
                                        <i class="fa fa-question-circle" id="reciever-department"></i>
                                        <b-popover target="reciever-department" triggers="hover" placement="top">
                                            <template v-slot:title>Select Employees</template>
                                            <p>You've selected the option employees as a reciever.
                                                You can select (multiple) employee(s) as a reciever for this
                                                notification.</p>
                                        </b-popover>
                                    </label>
                                    <multiselect v-model="notification.to"
                                                 :options="this.departments"
                                                 :multiple="true"
                                                 :clear-on-select="false"
                                                 placeholder="Select department"
                                                 :preselect-first="false"
                                                 id="notification_reciever_selected_department"
                                                 :searchable="true"
                                                 label="name"
                                                 track-by="name"
                                    >
                                    </multiselect>
                                </b-form-group>
                            </b-col>
                            <b-col></b-col>
                        </b-row>
                        <b-row v-else-if="notification.selectedReciever == 'employees'">
                            <b-col></b-col>
                            <b-col>
                                <b-form-group>
                                    <label label="Select (multiple) employees"
                                           label-for="notification_reciever_selected_employees">
                                        Select employees
                                        <i class="fa fa-question-circle" id="reciever-employees"></i>
                                        <b-popover target="reciever-employees" triggers="hover" placement="top">
                                            <template v-slot:title>Select Employees</template>
                                            <p>You've selected the option department as a reciever.
                                                You can select (multiple) department(s) as a reciever for this
                                                notifcation.</p>
                                        </b-popover>
                                    </label>
                                    <multiselect v-model="notification.to"
                                                 :options="this.employees"
                                                 :multiple="true"
                                                 :clear-on-select="false"
                                                 placeholder="Select department"
                                                 :preselect-first="false"
                                                 id="notification_reciever_selected_employees"
                                                 :searchable="true"
                                                 label="name"
                                                 track-by="name"
                                    >
                                    </multiselect>
                                </b-form-group>
                            </b-col>
                            <b-col></b-col>
                        </b-row>
                        <b-row>
                            <b-col>

                            </b-col>
                            <b-col>
                                <b-form-group>
                                    <label for="notification_title" class="text-left">Notification title</label>
                                    <b-form-input id="notification_title" v-model="notification.notification.title"
                                                  placeholder="Notification title" @input="calculateTitleCarachters"></b-form-input>
                                </b-form-group>
                                <small v-bind:class="[this.characters.title.error ? 'danger' : '']">
                                    {{characters.title.characters}}/128 characters.
                                </small>
                                <div class="invalid-feedback">
                                    <span v-if="errors['notification.title']">{{errors['notification.title'][0]}}</span>
                                </div>
                            </b-col>
                            <b-col></b-col>
                        </b-row>
                        <b-row>
                            <b-col>

                            </b-col>
                            <b-col>
                                <b-form-group>
                                    <label for="notification_message" class="text-left">Notification message</label>
                                    <b-form-textarea id="notification_message"
                                                     v-model="notification.notification.message"
                                                     placeholder="Notification message"
                                                     @input="calculateMessageCarachters"></b-form-textarea>
                                    <small v-bind:class="[this.characters.message.error ? 'danger' : '']">
                                        {{characters.message.characters}}/128 characters.
                                        <i class="fa fa-question-circle" id="browser-behaviour"></i>
                                    </small>
                                    <div class="invalid-feedback">
                                        <span v-if="errors['notification.message']">{{errors['notification.message'][0]}}</span>
                                    </div>
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
                                </b-form-group>
                            </b-col>
                            <b-col></b-col>
                        </b-row>
                        <b-row>
                            <b-col>

                            </b-col>
                            <b-col>
                                <b-form-group>
                                    <label for="notification_action_title" class="text-left">Notification action
                                        title</label>
                                    <b-form-input id="notification_action_title"
                                                  v-model="notification.notification.action.title"
                                                  placeholder="Notification action title"></b-form-input>
                                </b-form-group>
                            </b-col>
                            <b-col></b-col>
                        </b-row>
                        <b-row>
                            <b-col>

                            </b-col>
                            <b-col>
                                <b-form-group>
                                    <label for="notification_action_link" class="text-left">Notification action
                                        link</label>
                                    <b-form-input id="notification_action_link"
                                                  v-model="notification.notification.action.link"
                                                  placeholder="Notification action link"></b-form-input>
                                </b-form-group>
                            </b-col>
                            <b-col></b-col>
                        </b-row>
<!--                        TODO::Fix this.-->
<!--                        <b-row>-->
<!--                            <b-col>-->

<!--                            </b-col>-->
<!--                            <b-col>-->
<!--                                <b-form-group>-->
<!--                                    <label for="notification_action_link" class="text-left">-->
<!--                                        Notification action link-->
<!--                                    </label>-->
<!--                                    <b-form-file-->
<!--                                        v-model="notification.notification.image"-->
<!--                                        :state="Boolean(notification.notification.image)"-->
<!--                                        placeholder="Choose a image or drop it here..."-->
<!--                                        drop-placeholder="Drop image here..."-->
<!--                                    ></b-form-file>-->
<!--                                </b-form-group>-->
<!--                            </b-col>-->
<!--                            <b-col></b-col>-->
<!--                        </b-row>-->
                        <b-row>
                            <b-col></b-col>
                            <b-col>
                                <b-button size="sm" variant="danger" disabled>
                                    clear
                                </b-button>
                                <b-button size="sm" variant="notify-blue" disabled>
                                    save
                                </b-button>
                                <b-button size="sm" variant="success" @click="sendNotification">
                                    send
                                </b-button>
                                <b-button size="sm" variant="primary">
                                    save & send
                                </b-button>
                            </b-col>
                            <b-col></b-col>
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
        name: "CreatePushNotification",
        props: [
            'company'
        ],
        data() {
            return {
                pushLink: variables.push,
                errors: {
                },
                notification: {
                    recieverOptions: [
                        'company',
                        'department',
                        'employees'
                    ],
                    selectedReciever: null,
                    notification: {
                        message: '',
                        title: '',
                        action: {
                            title: '',
                            link: '',
                        },
                        image: "http://placehold.it/110x110/1e60b0/fff?text=test"
                    },
                    to: [],
                },
                characters: {
                    message: {
                        characters: 0,
                        error: false
                    },
                    title: {
                        characters: 0,
                        error: false
                    }
                },
                departmentSelected: false,
                employeesSelected: false,
                employees: null,
                departments: null,
            };
        },
        mounted() {
        },
        created() {
            this.fetchEmployees();
            this.fetchDepartments();
        },
        methods: {
            calculateMessageCarachters() {
                this.characters.message.characters = this.notification.notification.message.length;
                if (this.characters.message.characters >= 128) {
                    this.characters.message.error = true;
                } else {
                    this.characters.message.error = false;
                }
            },
            calculateTitleCarachters() {
                this.characters.title.characters = this.notification.notification.title.length;
                if (this.characters.title.characters >= 128) {
                    this.characters.title.error = true;
                } else {
                    this.characters.title.error = false;
                }
            },
            sendNotification() {
                let url = variables.send_pushNotification;
                axios.post(url, this.notification)
                    .then(response => {

                    })
                    .catch(error => {
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors;
                        }
                    });
            },
            updateSelectedReciever() {
                this.notification.to = [];
            },
            fetchEmployees() {
                let url = variables.get_employees.format(this.company.id);
                axios.get(url)
                    .then(response => {
                        this.employees = response.data;
                    })
                    .catch(error => {
                        // if (error.response.status === 422) {
                        //     this.errors = error.response.data.errors;
                        // }
                    });
            },
            fetchDepartments() {
                let url = variables.get_departments.format(this.company.id);
                axios.get(url)
                    .then(response => {
                        this.departments = response.data;
                    })
                    .catch(error => {
                        // if (error.response.status === 422) {
                        //     this.errors = error.response.data.errors;
                        // }
                    });
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
