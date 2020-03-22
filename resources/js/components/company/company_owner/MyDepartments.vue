<template>
    <div>
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
                        <b-col md="5"></b-col>
                        <b-col md="2">
                            <div class="text-center"><em>My departments</em></div>
                        </b-col>
                        <b-col md="5">
                            <div class="text-right">
                                <i class="fa fa-question-circle" id="my-departments"></i>
                                <b-popover target="my-departments" triggers="hover" placement="top">
                                    <template v-slot:title>Questions?</template>
                                    Click <a href="https://www.google.com" target="_blank">here</a> to read about departments
                                </b-popover>
                            </div>
                        </b-col>
                    </b-row>
                </div>
            </template>
            <b-card-text class="first-row-card-body">
                <div class="text-center" v-if="this.isBusy === true">
                    <b-spinner variant="primary" type="grow" label="Loading..."></b-spinner>
                </div>
                <div v-else>
                    <table class="table-borderless table">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>name</td>
                                <td>manager</td>
                                <td># of employees</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(department,index) in departments">
                                <td># {{index + 1 }}</td>
                                <td>{{department.name}}</td>
                                <td>{{department.manager.name}}</td>
                                <td>{{department.user_count}}</td>
                                <td class="text-right">
                                    <b-dropdown size="sm" id="dropdown-1" text="actions" variant="notify-blue">
                                        <b-dropdown-item>manage department &nbsp;<i class="fa fa-question-circle" id="manage-my-department"></i></b-dropdown-item>
                                        <b-dropdown-item>show employees</b-dropdown-item>
                                        <b-dropdown-item variant="danger" v-on:click="showConfirmModal(department.id,index)">remove department</b-dropdown-item>
                                    </b-dropdown>
                                </td>
                                <b-popover target="manage-my-department" triggers="hover" placement="top">
                                    <template v-slot:title>Manage department?</template>
                                    You can do all sorts of things in this feature: <i>Change the name, add employees, change the manager & delete it</i>.
                                </b-popover>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </b-card-text>
            <template v-slot:footer>
                <div class="text-right">
                    <b-button size="sm" variant="primary" @click="openCreateDepartmentModal">create department</b-button>
                </div>
            </template>
        </b-card>
        <b-modal title="Are you sure?" id="confirmModalTest" v-model="confirmModal">
            <p>Are you sure? {{selectedId}} , {{selectedIndex}}</p>
            <template v-slot:modal-footer>
                <div class="text-right">
                    <b-button v-on:click="this.confirmModal === false" variant="danger" size="sm">cancel</b-button>
                    <b-button v-on:click="confirmDelete(selectedId,selectedIndex)" variant="success" size="sm">delete</b-button>
                </div>
            </template>
        </b-modal>
        <b-modal title="Create department" id="confirmModalTest" v-model="createModal" size="lg">
            <b-row>
                <b-col md="4">
                    <span>Department name</span>
                </b-col>
                <b-col md="6">
                    <b-form-input
                            id="input-2"
                            v-model="newDepartment.name"
                            placeholder="Enter department name"
                    ></b-form-input>
                </b-col>
            </b-row>
            <b-row class="padding-top-15">
                <b-col md="4">
                    <span>Department manager</span>
                </b-col>
                <b-col md="6">
                    <!--<multiselect v-model="manager" :options="employees"  placeholder="Select employee as manager" label="name"></multiselect>-->
                    <multiselect v-model="newDepartment.manager" :options="employees"  placeholder="Select employee as manager" :preselect-first="true" label="name" track-by="name"></multiselect>
                </b-col>
            </b-row>
            <template v-slot:modal-footer>
                <div class="text-right">
                    <b-button v-on:click="this.createModal === false" variant="danger" size="sm">cancel</b-button>
                    <b-button v-on:click="createDepartment" variant="success" size="sm">create</b-button>
                </div>
            </template>
        </b-modal>
    </div>
</template>

<script>
    export default {
        name: "MyDepartments",
        props: [
            'company'
        ],
        data() {
            return {
                isBusy:true,
                departments:null,
                confirmModal:false,
                selectedId:'',
                selectedIndex:'',
                createModal:false,
                employees:[],
                newDepartment:{
                    manager:[],
                    name:'',
                },
                errors:[],
            };
        },
        created() {
            // setTimeout(function () {
            //     this.getNotes();
            // }.bind(this),1500);
            this.fetchDepartments();
            this.fetchAllEmployees();
        },
        methods: {
            fetchAllEmployees(){
                let url = variables.get_employees_for_company.format(this.company.id);
                console.log("url",url);
                axios.get(url)
                    .then(response => {
                        this.employees = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                        // if (error.response.status === 422) {
                        //     this.errors = error.response.data.errors;
                        // }
                    });
            },
            createDepartment(){
                let url = variables.post_department;
                // if(this.newDepartment.manager != null){
                    axios.post(url,this.newDepartment)
                        .then(response => {
                            console.log("posted no errors")
                        })
                        .catch(error => {
                            console.log(error);
                            if (error.response.status === 422) {
                                this.errors = error.response.data.errors;
                            }
                        });
                // } else {
                //
                // }
            },
            openCreateDepartmentModal(){
                this.createModal = !this.createModal;
            },
            finishEditing(departmentEdit,department){
                let url = variables.edit_department.format(departmentEdit.id);
                axios.put(url)
                    .then(response => {
                    })
                    .catch(error => {
                        console.log(error);
                        // if (error.response.status === 422) {
                        //     this.errors = error.response.data.errors;
                        // }
                    });
            },
            cancelEditing(){
                this.isEditing = !this.isEditing;
            },
            startEditing(department){
              this.isEditing = !this.isEditing;

              this.departmentEdit.name = department.name;
              this.departmentEdit.id = department.id;
            },
            fetchDepartments(){
                let url = variables.get_department.format(this.company.id);
                console.log("url",url);
                axios.get(url)
                    .then(response => {
                        console.log(response.data);
                        this.isBusy = false;
                        this.departments = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                        // if (error.response.status === 422) {
                        //     this.errors = error.response.data.errors;
                        // }
                    });
            },
            showConfirmModal(id,index){
                this.confirmModal = !this.confirmModal;
                this.selectedId = id;
                this.selectedIndex = index;
            },
            confirmDelete(id,index){
                let url = variables.delete_department.format(id);
                axios.delete(url)
                    .then(response => {
                        this.departments.splice(index, 1);
                        this.confirmModal = !this.confirmModal;
                    })
                    .catch(error => {
                        console.log(error);
                        // if (error.response.status === 422) {
                        //     this.errors = error.response.data.errors;
                        // }
                    });

            },
        }

    }
</script>

<style>
    .padding-top-15{
        padding-top: 15px;
    }
</style>
