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
                                <td class="employee-count">employee count</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(department,index) in departments">
                                <td># {{index + 1 }}</td>
                                <td>
                                    <span v-if="isEditing == true && isEditingIndex == index">
                                        <b-form-input
                                            id="input-1"
                                            v-model="department.name"
                                            type="text"
                                        ></b-form-input>
                                    </span>
                                    <span v-else>
                                        {{department.name}}
                                    </span>
                                </td>
                                <td>
                                    <span v-if="isEditing == true && isEditingIndex == index">
                                        <multiselect v-model="department.manager" :options="employees"  placeholder="Select employee as manager" :preselect-first="true" label="name" track-by="name"></multiselect>
                                    </span>
                                    <span v-else>
                                    {{department.manager.name}}
                                    </span>
                                </td>
                                <td class="employee-count">{{department.user_count}}</td>
                                <td class="text-right">
                                    <span v-if="isEditing == true && isEditingIndex == index" >
                                        <b-button size="sm" variant="danger" @click="cancelEditing(department)">cancel</b-button>
                                        <b-button size="sm" variant="success" @click="finishEditing(department)">save</b-button>
                                    </span>
                                    <b-dropdown size="sm" id="dropdown-1" text="actions" variant="notify-blue">
                                        <b-dropdown-item v-on:click="startEditing(department,index)">edit</b-dropdown-item>
                                        <b-dropdown-item>show employees</b-dropdown-item>
                                        <b-dropdown-item variant="danger" v-on:click="showConfirmModal(department.id,index)">remove department</b-dropdown-item>
                                    </b-dropdown>
                                </td>
                                <b-popover :target="`manage-my-department-` + index" triggers="hover" placement="top">
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
        <b-modal title="Delete department" id="confirmModalTest" v-model="confirmModal">
            <p>Are you sure you want to delete this department? This will unbind all its employees from this department.</p>
            <template v-slot:modal-footer>
                <div class="text-right">
                    <b-button v-on:click="closeConfirmModal" variant="danger" size="sm">cancel</b-button>
                    <b-button v-on:click="confirmDelete(selectedId,selectedIndex)" variant="success" size="sm">i am sure</b-button>
                </div>
            </template>
        </b-modal>
<!--        Create department modal-->
        <b-modal title="Create department" id="confirmModalTest" v-model="createModal" size="lg">
            <b-row>
                <b-col md="2"></b-col>
                <b-col md="3">
                    <span>Department name</span>
                </b-col>
                <b-col md="5">
                    <b-form-input
                            id="input-2"
                            v-model="newDepartment.name"
                            placeholder="Enter department name"
                    ></b-form-input>
                    <div class="invalid-feedback">
                        <span v-if="errors.name">{{errors.name[0]}}</span>
                    </div>
                </b-col>
                <b-col md="2"></b-col>
            </b-row>
            <b-row class="padding-top-15">
                <b-col md="2"></b-col>
                <b-col md="3">
                    <span>Department manager</span>
                </b-col>
                <b-col md="5">
                    <!--<multiselect v-model="manager" :options="employees"  placeholder="Select employee as manager" label="name"></multiselect>-->
                    <multiselect v-model="newDepartment.manager" :options="employees"  placeholder="Select employee as manager" :preselect-first="true" label="name" track-by="name"></multiselect>
                    <div class="invalid-feedback">
                        <span v-if="errors.manager">{{errors.manager[0]}}</span>
                    </div>
                </b-col>
                <b-col md="2"></b-col>
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
                isEditing:false,
                isEditingIndex:null,
                editedDepartment:null
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
            startEditing(department,index){
                this.isEditing = !this.isEditing;
                this.isEditingIndex = index;
                this._beforeEditingCache = department;
                this._beforeEditingCache = Object.assign({},department);
                // this.editedUser = department;
            },
            cancelEditing(department){
                this.isEditing = !this.isEditing;
                this.isEditingIndex = null;

                Object.assign(department, this._beforeEditingCache);
                this._beforeEditingCache = null;
            },
            finishEditing(department){
                let url = variables.edit_department.format(department.id);
                axios.put(url,department)
                    .then(response => {
                        this.isEditing = !this.isEditing;
                        this._beforeEditingCache = null;

                    })
                    .catch(error => {
                        console.log(error);
                        // if (error.response.status === 422) {
                        //     this.errors = error.response.data.errors;
                        // }
                    });
            },
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
                axios.post(url,this.newDepartment)
                    .then(response => {
                        this.departments.push(response.data);
                        this.createModal = !this.createModal;
                    })
                    .catch(error => {
                        console.log(error);
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors;
                        }
                    });
            },
            openCreateDepartmentModal(){
                this.createModal = !this.createModal;
                this.fetchAllEmployees();
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
            closeConfirmModal(){
                this.confirmModal = !this.confirmModal;
                this.selectedId = null;
                this.selectedIndex = null;
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

<style scoped>
    .padding-top-15{
        padding-top: 15px;
    }

    [v-cloak] {
        display: none;
    }
    .edit {
        display: none;
    }
    .editing .edit {
        display: block
    }
    .editing .view {
        display: none;
    }

    .employee-count{
        width: 135px;
    }
</style>
