<template>
    <div>
        <b-modal title="Employees" v-model="employeeModal" v-if="initEmployeeOverviewModal == true"
                 @hidden="closeEmployeeOverviewModal" size="xl">
            <b-row class="padding-row-bottom-15">
                <b-col></b-col>
                <b-col class="text-center">
                    <div class="input-group">
                        <b-form-input
                            v-model="searchString"
                            type="text"
                            class="form-control"
                            placeholder="Search for employee..."
                            aria-label="Search"
                            aria-describedby="basic-addon2">
                        </b-form-input>
                        <div class="input-group-append">
                            <button class="btn btn-search" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </b-col>
                <b-col></b-col>
            </b-row>
            <b-row>
                <b-col lg="4" sm="4" md="4" v-for="(employee,employeeKey) in filteredEmployees" :key="employeeKey">
                    <div class="our-team-main">
                        <div class="team-front">
                            <img v-bind:src="'http://placehold.it/110x110/1e60b0/fff?text=' + employee.name"  class="img-fluid"/>
                            <h3>{{employee.name}}</h3>
                            <p>Web Designer</p>
                            <b-dropdown size="sm" id="dropdown-1" text="Notify" variant="notify-blue" disabled>
                                <b-dropdown-item>Text</b-dropdown-item>
                                <b-dropdown-item>Whatsapp</b-dropdown-item>
                                <b-dropdown-item>Push Notification</b-dropdown-item>
                                <b-dropdown-item>Email</b-dropdown-item>
                            </b-dropdown>
                        </div>
                    </div>
                </b-col>
            </b-row>
        </b-modal>
    </div>
</template>

<script>
    export default {
        name: "DepartmentEmployees",
        props: [
            'initEmployeeOverviewModal',
            'department'
        ],
        data() {
            return {
                employeeModal: true,
                searchString:'',
                isSearching:false,
            };
        },
        computed:{
            filteredEmployees: function () {
                return this.department.user.filter((user) => {
                    let regex = new RegExp('(' + this.searchString + ')', 'i');
                    if(user.name.match(regex) == null){
                    //    TODO:: Display error message if we want to.
                    } else {
                        return user.name.match(regex);
                    }
                })
            }
        },
        methods: {
            closeEmployeeOverviewModal() {
                this.employeeModal = !this.employeeModal;
                this.$emit('closeEmployeeOverviewModal')
            },
        }
    }
</script>

<style>

    .padding-row-bottom-15{
        padding-bottom: 15px;
    }
    .our-team-main
    {
        width:100%;
        height:auto;
        background:#fff;
        text-align:center;
        /*overflow:hidden;*/
        /*position:relative;*/
        /*transition:0.5s;*/
        margin-bottom:28px;
    }


    .our-team-main img
    {
        border-radius:50%;
        margin-bottom:20px;
        width: 90px;
    }

    .our-team-main h3
    {
        font-size:20px;
        font-weight:700;
    }

    .our-team-main p
    {
        margin-bottom:0;
    }

    /*.team-back*/
    /*{*/
    /*    width:100%;*/
    /*    height:auto;*/
    /*    position:absolute;*/
    /*    top:0;*/
    /*    left:0;*/
    /*    padding:5px 15px 0 15px;*/
    /*    text-align:left;*/
    /*    background:#fff;*/

    /*}*/

    .team-front
    {
        width:100%;
        height:auto;
        /*position:relative;*/
        z-index:10;
        background:#fff;
        padding:15px;
        bottom:0px;
        /*transition: all 0.5s ease;*/
    }

    /*.our-team-main:hover .team-front*/
    /*{*/
    /*    bottom:-200px;*/
    /*    transition: all 0.8s ease;*/
    /*}*/

    /*.our-team-main:hover*/
    /*{*/
    /*    transition:1s;*/
    /*}*/

    .action-list{
        text-decoration: none;
        list-style: none;
        padding-left: 0;
        padding-right: 0;
    }

    .action-list li{
        padding-top: 10px;
    }
</style>
