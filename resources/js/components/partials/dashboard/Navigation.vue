<template>
    <div>
        <b-nav class="navbar navbar-expand navbar-dark static-top test">
            <!--            todo:: fix this garbage-->
            <a class="navbar-brand mr-1 text-white" href="#">Notifying.work</a>

            <b-button variant="light-blue" class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle"
                      @click="sideBarToggle()">
                <i class="fas fa-bars"></i>
            </b-button>
            <!-- Navbar Search -->
            <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

            </div>
            <!-- Navbar -->
            <ul class="navbar-nav ml-auto ml-md-0 text-white">
                <li class="nav-item dropdown text-white">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <span>{{user.name}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Activity Log</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            Logout
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown no-arrow">
                <li class="nav-item dropdown text-white">
                     <span class="badge badge-pill badge-danger"
                            style="float:right;margin-bottom:-10px;margin-right: 25px; z-index: 20;">
                         1
                     </span>
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell fa-2x" style="z-index: 1;"></i>
                    </a>
                        <!--                        @foreach(auth()->user()->unreadNotifications as $notification)-->
                        <!--                        <a class="dropdown-item" href="#">{{$notification['data']['title']}}</a>-->
                        <!--                        @endforeach-->
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="head text-light bg-light-blue">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-12">
                                        <span>Notifications (3)</span>
                                        <a href="" class="float-right text-light">Mark all as read</a>
                                    </div>
                                </div>
                            </li>
                            <li class="notification-box">
                                <b-row>
                                    <b-col md="8" lg="8" sm="8">
                                        <div  class="padding-left-15">
                                            <h6>Lorem ipsum dolor sit amet, consectetur</h6>
                                            <span>subtext</span>
                                            <small>date</small>
                                        </div>

                                    </b-col>
                                    <b-col>
                                        <i class="fa fa-eye-slash"></i>
                                    </b-col>
                                    <b-col>
                                        <i class="fa fa-arrow-right"></i>
                                    </b-col>
                                </b-row>
                            </li>
                            <li class="footer bg-light-blue text-center">
                                <a href="" class="text-light">View All</a>
                            </li>
                        </ul>
                </li>
            </ul>
        </b-nav>
    </div>
</template>

<script>


    export default {
        name: "Navigation",
        props: [
            'user',
        ],
        data() {
            return {};
        },
        created() {
            console.log("tf", this.user);
        },
        methods: {
            sideBarToggle() {
                $("body").toggleClass("sidebar-toggled");
                $(".sidebar").toggleClass("toggled");
            }
        }
    }
</script>

<style scoped>
    .dropdown-menu{
        top: 60px;
        right: 0px;
        left: unset;
        width: 460px;
        box-shadow: 0px 5px 7px -1px #c1c1c1;
        padding-bottom: 0px;
        padding: 0px;
    }
    .dropdown-menu:before{
        content: "";
        position: absolute;
        top: -20px;
        right: 12px;
        border:10px solid #343A40;
        border-color: transparent transparent #343A40 transparent;
    }
    .head{
        padding:5px 15px;
        border-radius: 3px 3px 0px 0px;
    }
    .footer{
        padding:5px 15px;
        border-radius: 0px 0px 3px 3px;
    }
    .notification-box{
        padding: 10px 0px;
    }
    .bg-gray{
        background-color: #eee;
    }

    .bg-light-blue{
        background: #1e60b0;
    }

    .padding-left-15{
        padding-left:15px;
    }
    .padding-left-10{
        padding-left:10px;
    }
    @media (max-width: 640px) {
        .dropdown-menu{
            top: 50px;
            left: -16px;
            width: 290px;
        }
        .nav{
            display: block;
        }
        .nav .nav-item,.nav .nav-item a{
            padding-left: 0px;
        }
        .message{
            font-size: 13px;
        }
    }
</style>
