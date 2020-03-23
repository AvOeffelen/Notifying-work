<template>
    <div>
        <b-modal v-model="manageMyDepartmentModal" size="xl" title="Manage department" ok="false" hide-footer="true">

                <b-row>
                    <b-col md="12">
                        <div class="text-center">
                            <h5>General information</h5><i class="fa fa-question-circle" :id="`manage_my_departent_infomartion`"></i>
                            <b-popover :target="`manage_my_departent_infomartion`" triggers="hover" placement="top">
                                <template v-slot:title>Manage department?</template>
                                You can do all sorts of things in this feature: <i>Change the name, add employees, change the manager & delete it</i>.
                            </b-popover>
                        </div>
                    </b-col>
                </b-row>
            <div class="text-center">
                <b-row>
                    <b-col md="4"></b-col>
                    <b-col md="4">
                        <div class="align-content-center">
                            <table class="table table-borderless text-left">
                                <tbody>
                                <tr>
                                    <td>
                                        <span>name</span>
                                    </td>
                                    <td>
                                        <span v-if="isEditing == false">{{departmentToBeManaged.name}}</span>
                                        <span v-else>
                                            <b-form-input
                                                    id="input-1"
                                                    v-model="tempDepartment.name"
                                                    type="text"
                                                    placeholder="Company state"
                                            ></b-form-input>
                                            <div class="invalid-feedback">
                                                <span v-if="errors.name">{{errors.name[0]}}</span>
                                            </div>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>manager</span>
                                    </td>
                                    <td>
                                        <span v-if="isEditing == false">{{departmentToBeManaged.manager.name}}</span>
                                        <multiselect v-else v-model="departmentToBeManaged.manager" :options="this.employees"  placeholder="Select employee as manager" :preselect-first="true" label="name" track-by="name"></multiselect>
                                        <div class="invalid-feedback">
                                            <span v-if="errors.manager">{{errors.manager[0]}}</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>employee count</span>
                                    </td>
                                    <td>
                                        <span>{{departmentToBeManaged.user_count}}</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </b-col>
                    <b-col md="4"></b-col>
                </b-row>
                <b-row class="padding-row-top padding-row-bottom">
                    <b-col md="12">
                        <div class="text-center">
                            <b-button size="sm" variant="notify-blue" @click="startEditing" v-if="isEditing == false">edit</b-button>
                            <b-button size="sm" variant="danger" @click="cancelEditing" v-if="isEditing == true">cancel</b-button>
                            <b-button size="sm" variant="success" @click="finishEditing" v-if="isEditing == true">save</b-button>
                        </div>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col md="12">
                        <h5>Actions</h5>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col md="12">
                        <b-button size="sm" variant="notify-blue">employee management</b-button>
                        <b-button size="sm" variant="danger" @click="requestDelete">delete department</b-button>
                    </b-col>
                </b-row>
                <div v-if="deleteIniated == true">
                    <b-row class="padding-row-top">
                        <b-col md="12" class="text-center">
                            <h5>Are you sure you want to delete this department?</h5>
                            <small>If you continue deleting this department there is no undoing this.</small>
                        </b-col>
                    </b-row>
                    <b-row>
                        <b-col md="2">
                        </b-col>
                        <b-col md="8" class="text-center">
                            <b-button size="sm" variant="danger" @click="cancelDelete">cancel</b-button>
                            <b-button size="sm" variant="success" @click="confirmDelete">delete</b-button>
                        </b-col>
                        <b-col md="2">
                        </b-col>
                    </b-row>
                </div>
            </div>
            <template v-bind:slot="modal-footer">

            </template>
        </b-modal>
    </div>
</template>

<script>
    export default {
        name: "ManageDepartment",
        props: [
            'departmentToBeManaged',
            'manageMyDepartmentModal',
            'employees'
        ],
        data() {
            return {
                isEditing:false,
                errors:[],
                deleteIniated:false
            };
        },

        created() {
            // setTimeout(function () {
            //     this.getNotes();
            // }.bind(this),1500);
        },
        methods: {
            requestDelete(){
                this.deleteIniated = !this.deleteIniated;
            },
            cancelDelete(){
                this.deleteIniated = !this.deleteIniated;
            },
            confirmDelete(){

            },
            startEditing(){
                this.isEditing = !this.isEditing;
                this._beforeEditingCache = this.departmentToBeManaged;
                this._beforeEditingCache = Object.assign({},this.departmentToBeManaged);
                this.tempDepartment = this.departmentToBeManaged;
            },
            cancelEditing(){

                this.errors = [];
                this.isEditing = !this.isEditing;
                Object.assign(this.departmentToBeManaged, this._beforeEditingCache);
                this._beforeEditingCache = null;
            },
            finishEditing(){
                let url = variables.edit_department.format(this.departmentToBeManaged.id);
                axios.put(url,this.departmentToBeManaged)
                    .then(response => {
                        this.isEditing = !this.isEditing;

                    })
                    .catch(error => {
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors;
                        }
                    });
            }
        },
    }
</script>

<style>
    .padding-row-top{
        padding-top:15px;
    }
    .padding-row-bottom{
        padding-bottom: 15px;
    }
</style>
