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
                <b-row>
                    <b-col></b-col>
                    <b-col>
                        <div class="text-right">
                            <div class="toggle-button-div">
                                    <span class="pr-3">
                                        Mass detachment
                                        &nbsp;
                                        <i class="fa fa-question-circle" id="single-delete"></i>
                                        <b-popover target="single-delete" triggers="hover" placement="top">
                                            <template v-slot:title>Mass delete</template>
                                            Toggling mass delete department will give you the ability to delete multiple departments at once.
                                        </b-popover>
                                    </span>
                                <toggle-button class="pt-2"
                                               :value="false"
                                               v-model="multiDeleteToggle"
                                               :width="50"
                                               @change="toggleMassDeletion"
                                />
                            </div>
                        </div>
                    </b-col>
                </b-row>
                <div class="text-center" v-if="this.isBusy === true">
                    <b-spinner variant="primary" type="grow" label="Loading..."></b-spinner>
                </div>
                <div v-else>
                    <table class="table-borderless table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>name</th>
                                <th>manager</th>
                                <th class="employee-count">employee count</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(department,index) in departments">
                                <td class="table-width-60">
                                    <i class="fa fa-minus-circle 2x deleteEmployee" v-if="multiDeleteToggle == false"  @click="removeSingleDepartment(department)"></i>
                                    <label class="form-checkbox" v-else>
                                        <input type="checkbox" class="form-checkbox disabled" :value="department.id" v-model="selectedIds">
                                        <i class="form-icon"></i>
                                    </label>
                                </td>
                                <td>{{index + 1 }}</td>
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
                    <b-button v-if="multiDeleteToggle == true" size="sm" variant="danger" @click="openConfirmMassDeleteModal">delete departments</b-button>
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
        <b-modal v-model="confirmMassDeleteModal" title="Delete departments">
            <b-row>
                <b-col align-self="center">
                    <b-row>
                        <b-col>
                            <div class="text-center">
                                <b-row>
                                    <b-col>
                                        <h4 v-if="this.selected.length > 1">You have selected {{this.selected.length}} departments.</h4>
                                        <h4 v-else>You have selected {{this.selected.length}} deparment.</h4>
                                    </b-col>
                                </b-row>
                                <b-row>
                                    <b-col>
                                        <p><strong>Note: Employees will not be deleted.</strong></p>
                                        <small>text here TBD</small>
                                    </b-col>
                                </b-row>
                                <b-row>
                                    <b-col>
                                        <small><p v-b-toggle.collapse-department-list class="text-center make-fake-link">Show/hide selected employees.</p></small>
                                    </b-col>
                                </b-row>
                                <b-row>
                                    <b-col>
                                        <div class="text-center">
                                            <b-collapse id="collapse-department-list" v-model="departmentListCollapse">
                                                <h5 v-if="this.selected.length > 1">selected departments:</h5>
                                                <h5 v-else>selected department: </h5>
                                                <table class="table table-borderless">
                                                    <thead>
                                                        <th>Name</th>
                                                        <th># of employees</th>
                                                        <th></th>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="(department,index) in this.selected">
                                                        <td>{{department.name}}</td>
                                                        <td>{{department.user_count}}</td>
                                                        <td class="text-right">
                                                            <b-button v-if="selected.length > 1" size="sm" variant="success" @click="removeFromMassDeletionList(index)">remove from list</b-button>
                                                            <b-button v-else size="sm" variant="success" @click="removeFromMassDeletionList(index)" disabled>remove from list</b-button>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </b-collapse>
                                        </div>
                                    </b-col>
                                </b-row>
                            </div>
                        </b-col>
                    </b-row>
                </b-col>
            </b-row>
            <template v-slot:modal-footer>
                <b-button variant="primary" size="sm" @click="cancelMassDelete">cancel</b-button>
                <b-button variant="success" size="sm" @click="confirmMassDelete">delete</b-button>
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
                aparamString:"",
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
                editedDepartment:null,
                multiDeleteToggle:false,
                selected:[],
                selectedIds:[],
                selectAll:false,
                confirmMassDeleteModal:false,
                departmentListCollapse:false,
            };
        },
        created() {
            this.fetchDepartments();
            this.fetchAllEmployees();
        },
        methods: {
            cancelMassDelete(){
                this.selected = [];
                this.selectedIds = [];
                this.selectAll = !this.selectAll;
                this.confirmMassDeleteModal = !this.confirmMassDeleteModal;
            },
            prepareParams(){
                this.aparamString = this.selectedIds.join(',');
            },
            confirmMassDelete(){
                this.prepareParams();
                console.log(this.aparamString);
              // let url = variables.delete_departments;
              //   axios.delete(url,{
              //       params:{
              //           selectedIds:this.selectedIds
              //       }
              //   })
              //       .then(response => {
              //           this.departments.splice(index, 1);
              //           this.confirmModal = !this.confirmModal;
              //       })
              //       .catch(error => {
              //           console.log(error);
              //           // if (error.response.status === 422) {
              //           //     this.errors = error.response.data.errors;
              //           // }
              //       });
            },
            openConfirmMassDeleteModal(){
              this.confirmMassDeleteModal = !this.confirmMassDeleteModal;
              this.updateSelectedList();
            },
            toggleMassDeletion(){
                if(this.multiDeleteToggle == true){
                    this.selectAll = true;
                    this.selectAllFunction();
                } else {
                    this.selected = [];
                    this.selectedIds = [];
                    this.selectAll = false;
                }
            },
            selectAllFunction() {
                this.selected = [];
                this.selectedIds = [];
                if (this.selectAll == true) {
                    for (let i in this.departments) {
                        this.selected.push(this.departments[i]);
                        this.selectedIds.push(this.departments[i].id);
                    }
                }
            },
            removeFromMassDeletionList(index){
                this.selected.splice(index,1);
                this.selectedIds.splice(index,1);
                this.$toast.info("Removed employee from list.");
                this.prepareParams();
            },
            updateSelectedList(){

            },
            startEditing(department,index){
                this.isEditing = !this.isEditing;
                this.isEditingIndex = index;
                this._beforeEditingCache = department;
                this._beforeEditingCache = Object.assign({},department);
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
