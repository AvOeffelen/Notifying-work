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
                        <b-col align-self="start"></b-col>
                        <b-col align-self="center">
                            <div class="text-center"><em>Department Employee management</em></div>
                        </b-col>
                        <b-col align-self="end">
                        </b-col>
                    </b-row>
                </div>
            </template>
            <b-card-text class="first-row-card-body">
                <div class="text-center" v-if="this.isBusy === true">
                    <b-spinner variant="primary" type="grow" label="Loading..."></b-spinner>
                </div>
                <div v-else>
                    <b-row>
                        <b-col></b-col>
                        <b-col md="5">
                            <div class="text-center">
                                <multiselect v-model="selectedDepartment"
                                             :options="departments"
                                             :preselect-first="true"
                                             placeholder="Select department"
                                             label="name"
                                             track-by="name"
                                             @input="departmentChange">
                                </multiselect>
                            </div>
                        </b-col>
                        <b-col>
                            <div class="text-right">
                                <div class="toggle-button-div">
                                    <span class="pr-3">
                                        Mass detachment
                                        &nbsp;
                                        <i class="fa fa-question-circle" id="single-delete"></i>
                                        <b-popover target="single-delete" triggers="hover" placement="top">
                                            <template v-slot:title>Mass detachment</template>
                                            Toggling mass detachment will allow you to detach multiple employees from the selected department at once.
                                        </b-popover>
                                    </span>
                                        <toggle-button class="pt-2"
                                                       :value="false"
                                                       v-model="MultiDeleteToggle"
                                                       :width="50"
                                                       @change="toggleMassDeletion"
                                        />
                                </div>
                            </div>
                        </b-col>
                    </b-row>
                    <b-row  v-if="this.selectedDepartment == null">
                        <b-col></b-col>
                        <b-col md="5">
                            <div class="text-center">
                                <p>Select a department to see all it's employees.</p>
                            </div>
                        </b-col>
                        <b-col></b-col>
                    </b-row>
                    <table class="table-borderless table" v-else>
                        <thead>
                        <tr>
                            <th>
                                <span></span>
                            </th>
                            <th>#</th>
                            <th>name</th>
                            <th>email</th>
                            <th>phone</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(employee,index) in selectedDepartment.user">
                                <td class="table-width-60">
                                    <i class="fa fa-minus-circle 2x deleteEmployee" v-if="MultiDeleteToggle == false"  @click="detachSingleEmployee(employee)"></i>
                                    <label class="form-checkbox" v-else>
                                        <input type="checkbox" class="form-checkbox disabled" :value="employee.id" v-model="selectedIds">
                                        <i class="form-icon"></i>
                                    </label>
                                </td>
                                <td class="table-width-40">{{index + 1 }}</td>
                                <td class="table-width-auto">{{employee.name}}</td>
                                <td class="table-width-auto">{{employee.email}}</td>
                                <td class="table-width-auto">{{employee.country_code}} {{employee.phonenumber}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </b-card-text>
            <template v-slot:footer>
                <div class="text-right">
                    <b-button v-if="MultiDeleteToggle != false" variant="danger" size="sm" @click="openConfirmDeleteModal">confirm detachment</b-button>
                    <b-button v-else size="sm" variant="primary" @click="initAssignEmployeeModal">attach employees to department</b-button>
                </div>
            </template>
        </b-card>
        <b-modal v-model="initConfirmDeleteModal" size="md">
            <b-row>
                <b-col align-self="center">
                    <b-row>
                        <b-col>
                            <div class="text-center">
                                <b-row>
                                    <b-col>
                                        <h4 v-if="this.selected.length > 1">You have selected {{this.selected.length}} employees to detach from department.</h4>
                                        <h4 v-else>You have selected {{this.selected.length}} employee to detach from department.</h4>
                                    </b-col>
                                </b-row>
                                <b-row>
                                    <b-col>
                                        <small>text here TBD</small>
                                    </b-col>
                                </b-row>
                                <b-row>
                                    <b-col>
                                        <small><p v-b-toggle.collapse-employee-list class="text-center make-fake-link">Show/hide selected employees.</p></small>
                                    </b-col>
                                </b-row>
                            </div>
                        </b-col>
                    </b-row>
                    <b-row>
                        <b-col>
                            <div class="text-center">
                                <b-collapse id="collapse-employee-list" v-model="employeeDeletionListCollapse">
                                    <h5 v-if="this.selected.length > 1">selected employees: </h5>
                                    <h5 v-else>selected employee: </h5>
                                    <table class="table table-borderless">
                                        <tbody>
                                        <tr v-for="(employee,index) in this.selected">
                                            <td>{{employee.name}}</td>
                                            <td class="text-right">
                                                <b-button v-if="selected.length > 1" size="sm" variant="success" @click="removeFromMassDeletionList(employee.id,index)">remove from list</b-button>
                                                <b-button v-else size="sm" variant="success" @click="removeFromMassDeletionList(employee.id,index)" disabled>remove from list</b-button>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </b-collapse>
                            </div>
                        </b-col>
                    </b-row>
                </b-col>
            </b-row>
            <template v-slot:modal-footer>
                    <b-row>
                        <b-col>
                            <div class="text-right">
                                <b-button variant="primary" size="sm" @click="cancelMassDelete">cancel</b-button>
                                <b-button variant="success" size="sm" @click="confirmMassDelete">detach</b-button>
                            </div>
                        </b-col>
                    </b-row>
            </template>
        </b-modal>
<!--        TODO:: Decide wether to move own component or not-->
        <b-modal v-model="assignEmployeeModal" v-if="this.selectedDepartment !== null" size="lg">
            <b-row>
                <b-col align-self="center">
                    <div class="text-center">
                        <h4>Assign employee(s) to department</h4>
                    </div>
                </b-col>
            </b-row>
            <b-row>
                <b-col align-self="start"></b-col>
                <b-col md="10" align-self="center">
                    <h5>department selected: <i>{{this.selectedDepartment.name}}</i></h5>
                    <div class="text-center">
                        <multiselect v-model="selectedEmployees"
                                     :options="employees"
                                     :preselect-first="true"
                                     placeholder="Select department"
                                     label="name"
                                     track-by="name"
                                    :taggable="true"
                                     :multiple="true"
                        >
                        </multiselect>
                    </div>
                </b-col>
                <b-col align-self="end"></b-col>
            </b-row>

            <template v-slot:modal-footer>
                <b-button size="sm" variant="danger" @click="cancelAttachEmployees">cancel</b-button>
                <b-button size="sm" variant="success" @click="confirmAttachEmployees">attach</b-button>
            </template>
        </b-modal>
        <b-modal v-model="detachSingleEmployeeModal"  v-if="this.selectedDepartment && this.employee !== null" size="md">
            <b-row>
                <b-col class="text-center">
                    <h4>Detaching employee from <i>{{this.selectedDepartment.name}}</i></h4>
                </b-col>
            </b-row>
            <b-row>
                <b-col>
                    <p>You're trying to detach <strong><i>{{this.employee.name}}</i></strong> from the department. Are you sure?</p>
                </b-col>
            </b-row>
            <template v-slot:modal-footer>
                <b-button variant="primary" size="sm" @click="cancelDetachSingleEmployee">cancel</b-button>
                <b-button variant="success" size="sm" @click="confirmDetachEmployee">detach</b-button>
            </template>
        </b-modal>
    </div>
</template>

<script>
    export default {
        name: "DepartmentEmployeeManagement",
        props: [
            'company'
        ],data() {
            return {
                isBusy:true,
                departments:null,
                errors:[],
                selectedDepartment:null,
                MultiDeleteToggle:false,
                selected:[],
                selectedIds:[],
                selectAll:false,
                initConfirmDeleteModal:false,
                selectedEmployees:[],
                employeeDeletionListCollapse:false,
                assignEmployeeModal:false,
                employees:null,
                selectedEmployees:[],
                detachSingleEmployeeModal:false,
                employee:null,

            };
        },
        created() {
            this.fetchDepartments();
            this.fetchEmployees();
        },
        methods: {
            cancelDetachSingleEmployee(){
              this.employee = null;
              this.detachSingleEmployeeModal = !this.detachSingleEmployeeModal;
            },
            confirmDetachEmployee(){
                let url = variables.detach_employee.format(this.company.id,this.selectedDepartment.id);
                axios.delete(url,{
                    params:{
                        employees: this.employee.id
                    }
                })
                    .then(response => {
                        this.detachSingleEmployeeModal = !this.detachSingleEmployeeModal;
                            for(let e in this.selectedDepartment.user){
                                if(this.employee.id == this.selectedDepartment.user[e].id){
                                    this.selectedDepartment.user.splice(e,1);
                                }
                            }
                        this.$toast.success("Sucesfully detached employee(s) from department.");
                    })
                    .catch(error => {
                        // if (error.response.status === 422) {
                        //     this.errors = error.response.data.errors;
                        // }
                    });
            },
            detachSingleEmployee(employee){
                this.detachSingleEmployeeModal = !this.detachSingleEmployeeModal;
                this.employee = employee;
            },
            cancelAttachEmployees(){
              this.selectedEmployees = [];
              this.assignEmployeeModal = !this.assignEmployeeModal;
            },
            initAssignEmployeeModal(){
                this.selectedEmployees = [];
                this.tempFunctionname();
                this.assignEmployeeModal = !this.assignEmployeeModal;
            },
            tempFunctionname(){
                for(let i in this.employees){
                    for(let x in this.selectedDepartment.user){
                        if(this.employees[i].id == this.selectedDepartment.user[x].id){
                            this.selectedEmployees.push(this.employees[i]);
                        }
                    }
                }
            },
            filterEmployeesAlreadyInDepartment(){
                for(let s in this.selectedEmployees){
                    for(let n in this.selectedDepartment.user){
                        if(this.selectedEmployees[s].id == this.selectedDepartment.user[n].id){
                            this.selectedEmployees.splice(s,1);
                        }
                    }
                }
            },
            confirmAttachEmployees(){
                this.filterEmployeesAlreadyInDepartment();
                if(this.selectedEmployees.length == 0 ){
                    this.tempFunctionname();
                } else {
                    this.assignEmployeeModal = false;
                    let url = variables.attach_employee.format(this.company.id,this.selectedDepartment.id);
                    axios.post(url,{
                        params:{
                            selectedEmployees : this.selectedEmployees,
                        }
                    }).then(response => {
                        for(let x in this.selectedEmployees){
                            this.selectedDepartment.user.push(this.selectedEmployees[x]);
                        }
                        this.$toast.success("Succesfully attached employees to department.");
                    })
                        .catch(error => {
                            // if (error.response.status === 422) {
                            //     this.errors = error.response.data.errors;
                            // }
                        });
                }

            },
            cancelEdit(company) {
                this.isEditing = !this.isEditing;
                Object.assign(company, this._beforeEditingCache);
                this._beforeEditingCache = null;
            },
            selectAllFunction() {
                this.selected = [];
                this.selectedIds = [];

                if (this.selectAll == true) {
                    for (let i in this.selectedDepartment.user) {
                        this.selected.push(this.selectedDepartment.user[i]);
                        this.selectedIds.push(this.selectedDepartment.user[i].id);
                    }
                }

            },
            removeFromMassDeletionList(employeeId,index){
                this.selected.splice(index,1);
                this.selectedIds.splice(index,1);
                this.$toast.info("Removed employee from list.");
            },
            toggleMassDeletion(){
                if(this.MultiDeleteToggle == true){
                    this.selectAll = true;
                    this.selectAllFunction();
                } else {
                    this.selected = [];
                    this.selectedIds = [];
                    this.selectAll = false;
                }
            },
            departmentChange(){
                if(this.MultiDeleteToggle == true){
                    this.selectAll = true;
                    this.selected = [];
                    this.selectedIds = [];
                    this.select();
                } else {
                    this.selected = [];
                    this.selectedIds = [];
                    this.selectAll = false;
                }
            },
            cancelMassDelete(){

                this.selected = [];
                this.selectedIds = [];
                this.selectAll = !this.selectAll;

                this.initConfirmDeleteModal = !this.initConfirmDeleteModal;
            },
            updateSelected(){
                this.selected = [];
                for(let id in this.selectedIds){
                    for(let e in this.selectedDepartment.user){
                        if(this.selectedIds[id] == this.selectedDepartment.user[e].id){
                            this.selected.push(this.selectedDepartment.user[e]);
                        }
                    }
                }
            },
            openConfirmDeleteModal(){
                this.updateSelected();
                this.initConfirmDeleteModal = !this.initConfirmDeleteModal;
            },
            confirmMassDelete(){
                let url = variables.detach_employee.format(this.company.id,this.selectedDepartment.id);
                axios.delete(url,{
                    params:{
                        employees: this.selectedIds
                    }
                }).then(response => {
                        this.initConfirmDeleteModal = !this.initConfirmDeleteModal;
                        for(let id in this.selectedIds){
                            for(let e in this.selectedDepartment.user){
                                if(this.selectedIds[id] == this.selectedDepartment.user[e].id){
                                    this.selectedDepartment.user.splice(e,1);
                                }
                            }
                        }
                        this.$toast.success("Sucesfully detached employee(s) from department.");
                    })
                    .catch(error => {
                        // if (error.response.status === 422) {
                        //     this.errors = error.response.data.errors;
                        // }
                    });
            },
            fetchEmployees(){
                let url = variables.get_employees_for_company.format(this.company.id);
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
            fetchDepartments(){
                let url = variables.get_department.format(this.company.id);
                axios.get(url)
                    .then(response => {
                        this.isBusy = false;
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

<style>
    .table-width-40{
        width: 40px;
    }
    .table-width-60{
        width: 60px;
    }

    .table-width-auto{
        width: auto;
    }
    .deleteEmployee{
        color: #e3342f;
    }

    .make-fake-link{
        color: #3490dc;
    }
    .make-fake-link:hover{
        color: #1d68a7;
    }
</style>
