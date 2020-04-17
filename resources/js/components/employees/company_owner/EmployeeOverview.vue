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
                                    <div class="text-center"><em>Department Employee management</em></div>
                                </b-col>
                                <b-col align-self="end">
                                </b-col>
                            </b-row>
                        </div>
                    </template>
                    <b-card-text>
<!--                        <b-row>-->
<!--                            <b-col></b-col>-->
<!--                            <b-col class="text-center">-->
<!--                                <div class="input-group">-->
<!--                                    <b-form-input-->
<!--                                        v-model="searchString"-->
<!--                                        @input="searching"-->
<!--                                        type="text"-->
<!--                                        class="form-control"-->
<!--                                        placeholder="Search for employees..."-->
<!--                                        aria-label="Search"-->
<!--                                        aria-describedby="basic-addon2">-->
<!--                                    </b-form-input>-->
<!--                                    <div class="input-group-append">-->
<!--                                        <button class="btn btn-search" type="button">-->
<!--                                            <i class="fas fa-search"></i>-->
<!--                                        </button>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </b-col>-->
<!--                        </b-row>-->
                        <b-row>
                            <b-col>
                                <table class="table table-borderless">
                                    <tr>
                                        <th></th>
                                        <th>#</th>
                                        <th>naam</th>
                                        <th>email</th>
                                        <th></th>
                                    </tr>
                                    <tbody>
                                    <tr
                                        v-for="(employee,key) in this.employees.data"
                                        :key="employee.id"
                                    >
                                        <td></td>
                                        <td>{{key+1}}</td>
                                        <td>{{employee.name}}</td>
                                        <td>{{employee.email}}</td>
                                        <td class="text-right">
                                            <b-dropdown size="sm" id="employee-drowdown" text="Notify" variant="notify-blue">
                                                <b-dropdown-item>Action</b-dropdown-item>
                                                <b-dropdown-item>Action</b-dropdown-item>
                                                <b-dropdown-item>Action</b-dropdown-item>
                                                <b-dropdown-item>Action</b-dropdown-item>
                                            </b-dropdown>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </b-col>
                        </b-row>
                    </b-card-text>
                    <template v-slot:footer>
                        <b-row>
                            <b-col align-self="center">
                                    <pagination
                                        class="pagination-margin"
                                        size="small"
                                        :data="employees"
                                        @pagination-change-page="getEmployees">
                                    </pagination>
                            </b-col>
                        </b-row>
                    </template>
                </b-card>
            </b-col>
        </b-row>
    </div>
</template>

<script>
    export default {
        name: "EmployeeOverview",
        props: [
            'user',
            'company'
        ],
        data() {
            return {
                employees: {},
            };
        },
        mounted() {
            this.getEmployees();
        },
        created() {
        },
        computed: {
            // filteredEmployees: function () {
            //     return this.unfilteredEmployees.filter((employee) => {
            //         let regex = new RegExp('(' + this.searchString + ')', 'i');
            //         if (employee.name.match(regex) == null) {
            //             //    TODO:: Display error message if we want to.
            //         } else {
            //             return employee.name.match(regex);
            //         }
            //     })
            // }
        },
        methods: {
            getEmployees(page = 1) {
                let url = variables.get_employees;
                axios.get(url+'?page=' + page)
                    .then(response => {
                        this.employees = response.data;
                    });
            },
        }
    }
</script>

<style>

    .pagination-margin{
        margin: auto;
    }
</style>
