<template>
    <div>
<!--        <div class="row">-->
<!--            <div class="col-xl-3 col-sm-6 mb-3">-->
<!--                <div class="card text-white bg-primary o-hidden h-100">-->
<!--                    <div class="card-body">-->
<!--                        <div class="card-body-icon">-->
<!--                            <i class="fas fa-fw fa-comments"></i>-->
<!--                            <div class="mr-5">-->
<!--                                <h5>You have {{this.unreadNotificationsCounter}} unread notifications!</h5>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <a class="card-footer text-white clearfix small z-1" href="#">-->
<!--                        <b-row>-->
<!--                            <b-col>-->
<!--                                <div  class="text-left">-->
<!--                                    <span>View Details</span>-->
<!--                                </div>-->
<!--                            </b-col>-->
<!--                            <b-col>-->
<!--                                <div class="text-right">-->
<!--                                    <i class="fas fa-angle-right"></i>-->
<!--                                </div>-->
<!--                            </b-col>-->
<!--                        </b-row>-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-xl-3 col-sm-6 mb-3">-->
<!--                <div class="card text-white bg-info o-hidden h-100">-->
<!--                    <div class="card-body">-->
<!--                        <div class="card-body-icon">-->
<!--                            <i class="fas fa-fw fa-list"></i>-->
<!--                        </div>-->
<!--                        <div class="mr-5">Sumthing sumthing!</div>-->
<!--                    </div>-->
<!--                    <a class="card-footer text-white clearfix small z-1" href="#">-->
<!--                        <span class="float-left">View Details</span>-->
<!--                        <span class="float-right">-->
<!--                  <i class="fas fa-angle-right"></i>-->
<!--                </span>-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-xl-3 col-sm-6 mb-3">-->
<!--                <div class="card text-white bg-success o-hidden h-100">-->
<!--                    <div class="card-body">-->
<!--                        <div class="card-body-icon">-->
<!--                            <i class="fas fa-fw fa-shopping-cart"></i>-->
<!--                        </div>-->
<!--                        <div class="mr-5">Sumthing sumthing!</div>-->
<!--                    </div>-->
<!--                    <a class="card-footer text-white clearfix small z-1" href="#">-->
<!--                        <span class="float-left">View Details</span>-->
<!--                        <span class="float-right">-->
<!--                  <i class="fas fa-angle-right"></i>-->
<!--                </span>-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-xl-3 col-sm-6 mb-3">-->
<!--                <div class="card text-white bg-danger o-hidden h-100">-->
<!--                    <div class="card-body">-->
<!--                        <div class="card-body-icon">-->
<!--                            <i class="fas fa-fw fa-life-ring"></i>-->
<!--                        </div>-->
<!--                        <div class="mr-5">Sumthing sumthing!</div>-->
<!--                    </div>-->
<!--                    <a class="card-footer text-white clearfix small z-1" href="#">-->
<!--                        <span class="float-left">View Details</span>-->
<!--                        <span class="float-right">-->
<!--                  <i class="fas fa-angle-right"></i>-->
<!--                </span>-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <b-row>-->
<!--            <b-col>-->
<!--                <b-card-->
<!--                    header-tag="header"-->
<!--                    header-class=""-->
<!--                    header-bg-variant="notify-blue"-->
<!--                    header-text-variant="white"-->
<!--                    footer-tag="footer"-->
<!--                    class="mb-2 text-center"-->
<!--                >-->
<!--                    <template v-slot:header>-->
<!--                        <div class="header-card">-->
<!--                            <b-row>-->
<!--                                <b-col md="5"></b-col>-->
<!--                                <b-col md="2">-->
<!--                                    <div class="text-center"><em>Send Notification</em></div>-->
<!--                                </b-col>-->
<!--                                <b-col md="5">-->
<!--                                </b-col>-->
<!--                            </b-row>-->
<!--                        </div>-->
<!--                    </template>-->
<!--                    <b-card-text>-->
<!--                        <create-push-notification-partial :user="user"></create-push-notification-partial>-->
<!--                    </b-card-text>-->
<!--                    <template v-slot:footer></template>-->
<!--                </b-card>-->
<!--            </b-col>-->
<!--            <b-col>-->
<!--                <b-card-->
<!--                    header-tag="header"-->
<!--                    header-class=""-->
<!--                    header-bg-variant="notify-blue"-->
<!--                    header-text-variant="white"-->
<!--                    footer-tag="footer"-->
<!--                    class="mb-2 text-center"-->
<!--                >-->
<!--                    <template v-slot:header>-->
<!--                        <div class="header-card">-->
<!--                            <b-row>-->
<!--                                <b-col md="4"></b-col>-->
<!--                                <b-col md="4">-->
<!--                                    <div class="text-center"><em>Latest notifications</em></div>-->
<!--                                </b-col>-->
<!--                                <b-col md="4">-->
<!--                                </b-col>-->
<!--                            </b-row>-->
<!--                        </div>-->
<!--                    </template>-->
<!--                    <b-card-text>-->
<!--                        <b-row>-->

<!--                        </b-row>-->
<!--                        <b-row>-->
<!--                            <b-col></b-col>-->
<!--                            <b-col>-->
<!--                                <a href="#"><span>show more</span></a>-->
<!--                            </b-col>-->
<!--                            <b-col></b-col>-->
<!--                        </b-row>-->
<!--                    </b-card-text>-->
<!--                    <template v-slot:footer>-->
<!--                    </template>-->
<!--                </b-card>-->
<!--            </b-col>-->
<!--        </b-row>-->
        <b-row>
            <b-col>
                <div class="text-center">
                    Coming soon!
                </div>
            </b-col>
        </b-row>
    </div>
</template>

<script>
    import CreatePushNotificationPartial from "../partials/Notifications/push/CreatePushNotificationPartial";
    export default {
        name: "DefaultIndex",
        components: {CreatePushNotificationPartial},
        props: [
            'user',
        ],
        data() {
            return {
                unreadNotificationsCounter: 0,
                notifications: null,
                polling: null,
            };
        },
        created() {
            this.getNotifications();
            this.pollData();
        },
        methods: {
            pollData() {
                this.polling = setInterval(() => {
                    this.getNotifications();
                    this.countUnreadNotifications();
                }, 60000);
            },
            getNotifications() {
                axios.get('/axios/notifications/push/get')
                    .then(response => {
                        this.notifications = response.data;
                        this.countUnreadNotifications();
                    })
                    .catch(error => {
                        console.log(error);
                        // if (error.response.status === 422) {
                        //     this.errors = error.response.data.errors;
                        // }
                    });
            },
            markAsRead(notification) {
                if (notification.read_at == null) {
                    axios.post('/axios/notifications/push/{0}/mark-as-read'.format(notification.id))
                        .then(response => {
                            this.updateMarkAsRead(response.data);
                        })
                        .catch(error => {
                            console.log(error);
                            // if (error.response.status === 422) {
                            //     this.errors = error.response.data.errors;
                            // }
                        });
                }
            },
            updateMarkAsRead(updatedNotification) {
                for (let x in this.notifications) {
                    if (this.notifications[x].id == updatedNotification.id) {
                        this.notifications[x] = updatedNotification;
                        this.countUnreadNotifications();
                    }
                }
            },
            countUnreadNotifications() {
                this.unreadNotificationsCounter = 0;
                for (let x in this.notifications) {
                    if (this.notifications[x].read_at == null) {
                        this.unreadNotificationsCounter++;
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>
