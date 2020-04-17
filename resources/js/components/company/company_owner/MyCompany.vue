<template>
    <!--    TODO:: REBUILD THIS CARD.-->
    <div>
        <b-row>
            <b-col md="7">
                <b-card
                    header-tag="header"
                    header-class="text-center"
                    header-bg-variant="notify-blue"
                    header-text-variant="white"
                    footer-tag="footer"
                    class="mb-2 first-row-cards"
                >
                    <template v-slot:header>
                        <em>General information</em>
                    </template>
                    <b-card-text>
                        <b-row>
                            <b-col>
                                <span class="text-left">Name</span>
                            </b-col>
                            <b-col>
                                <span v-if="isEditing == false">{{this.company.name}}</span>
                                <span v-else>
                                            <b-form-input
                                                id="input-1"
                                                v-model="tempCompany.name"
                                                type="text"
                                                placeholder="Company name"
                                            ></b-form-input>
                                            <div class="invalid-feedback">
                                                <span v-if="errors.name">{{errors.name[0]}}</span>
                                            </div>
                                        </span>
                            </b-col>
                        </b-row>
                        <b-row>
                            <b-col>
                                <span class="text-left">Email</span>
                            </b-col>
                            <b-col>
                                <span v-if="isEditing == false">
                                    {{this.company.email}}
                                </span>
                                <span v-else>
                                    <b-form-input
                                        id="input-1"
                                        v-model="tempCompany.email"
                                        type="email"
                                        placeholder="Company email"
                                    ></b-form-input>
                                    <div class="invalid-feedback">
                                        <span v-if="errors.email">{{errors.email[0]}}</span>
                                    </div>
                                </span>
                            </b-col>
                        </b-row>
                            <b-row>
                                <b-col>
                                    <span class="text-left">Street</span>
                                </b-col>
                                <b-col>
                                    <span v-if="isEditing == false">
                                        {{this.company.address}}&nbsp;{{this.company.number}}
                                    </span>
                                    <span v-else>
                                        <b-row>
                                            <b-col md="8">
                                                <b-form-input
                                                    id="input-1"
                                                    v-model="tempCompany.address"
                                                    type="text"
                                                    placeholder="Company address"
                                                ></b-form-input>
                                                    <div class="invalid-feedback">
                                                        <span v-if="errors.address">{{errors.address[0]}}</span>
                                                    </div>
                                            </b-col>
                                            <b-col md="4">
                                                <b-form-input
                                                    id="input-1"
                                                    v-model="tempCompany.number"
                                                    type="text"
                                                    placeholder="Company number"
                                                ></b-form-input>
                                                    <div class="invalid-feedback">
                                                        <span v-if="errors.number">{{errors.number[0]}}</span>
                                                    </div>
                                            </b-col>
                                        </b-row>
                                    </span>
                                </b-col>
                            </b-row>
                            <b-row>
                                <b-col>
                                    <span class="text-left">Zip & City</span>
                                </b-col>
                                <b-col>
                                    <span v-if="isEditing == false">
                                        {{this.company.zip}}&nbsp;{{this.company.city}}
                                    </span>
                                    <span v-else>
                                        <b-row>
                                            <b-col md="6">
                                                <b-form-input
                                                    id="input-1"
                                                    v-model="tempCompany.zip"
                                                    type="text"
                                                    placeholder="Company zip"
                                                ></b-form-input>
                                                <div class="invalid-feedback">
                                                    <span v-if="errors.zip">{{errors.zip[0]}}</span>
                                                </div>
                                            </b-col>
                                            <b-col md="6">
                                                <b-form-input
                                                    id="input-1"
                                                    v-model="tempCompany.city"
                                                    type="text"
                                                    placeholder="Company city"
                                                ></b-form-input>
                                                <div class="invalid-feedback">
                                                    <span v-if="errors.city">{{errors.city[0]}}</span>
                                                </div>
                                            </b-col>
                                        </b-row>
                                    </span>
                                </b-col>
                            </b-row>
                            <b-row>
                                <b-col>
                                    <span class="text-left">State & Country</span>
                                </b-col>
                                <b-col>
                                    <span v-if="isEditing == false">
                                        {{this.company.state}}, {{this.company.country}}
                                    </span>
                                    <span v-else>
                                        <b-row>
                                            <b-col md="6">
                                                <b-form-input
                                                    id="input-1"
                                                    v-model="tempCompany.state"
                                                    type="text"
                                                    placeholder="Company state"
                                                ></b-form-input>
                                                <div class="invalid-feedback">
                                                    <span v-if="errors.state">{{errors.state[0]}}</span>
                                                </div>
                                            </b-col>
                                            <b-col md="6">
                                                <b-form-input
                                                    id="input-1"
                                                    v-model="tempCompany.country"
                                                    type="text"
                                                    placeholder="Company country"
                                                ></b-form-input>
                                                <div class="invalid-feedback">
                                                    <span v-if="errors.country">{{errors.country[0]}}</span>
                                                </div>
                                            </b-col>
                                        </b-row>
                                    </span>
                                </b-col>
                            </b-row>
                    </b-card-text>
                    <template v-slot:footer>
                        <div class="text-right">
                            <b-button size="sm" variant="primary" @click="startEdit(company)"
                                      v-if="isEditing === false">edit
                            </b-button>
                            <b-button size="sm" variant="danger" @click="cancelEdit(company)" v-if="isEditing === true">
                                cancel
                            </b-button>
                            <b-button size="sm" variant="success" @click="finishEdit" v-if="isEditing === true">save
                            </b-button>
                        </div>
                    </template>
                </b-card>
            </b-col>
            <b-col md="5">
                <b-card
                    header-tag="header"
                    header-class=""
                    header-bg-variant="notify-blue"
                    header-text-variant="white"
                    footer-tag="footer"
                    class="mb-2 text-center first-row-cards"
                >
                    <template v-slot:header>
                        <em>Subscription information</em>
                    </template>
                    <b-card-text class="first-row-card-body">
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <td>Subscription type</td>
                                <td><i>Coming soon.</i></td>
                            </tr>
                            <tr>
                                <td>Subscription expiration</td>
                                <td><i>Coming soon.</i></td>
                            </tr>
                            <tr>
                                <td>Balance</td>
                                <td><i>Coming soon.</i></td>
                            </tr>
                            </tbody>
                        </table>
                    </b-card-text>
                    <template v-slot:footer>
                        <div class="text-right">
                            <b-button size="sm" variant="primary">upgrade subscription</b-button>
                            <b-button size="sm" variant="primary">deposit</b-button>
                        </div>
                    </template>
                </b-card>
            </b-col>
        </b-row>
        <b-row>
            <b-col md="12">
                <my-departments :company="this.company"></my-departments>
                <department-employee-management :company="this.company"></department-employee-management>
            </b-col>
        </b-row>
    </div>
</template>

<script>
    import MyDepartments from "./MyDepartments";
    import DepartmentEmployeeManagement from "./DepartmentEmployeeManagement";

    export default {
        name: "MyCompany",
        components: {DepartmentEmployeeManagement, MyDepartments},
        props: [
            'user',
            'company'
        ],
        data() {
            return {
                companyCollapse: false,
                isEditing: false,
                tempCompany: {
                    name: '',
                    email: '',
                    address: '',
                    number: '',
                    state: '',
                    city: '',
                    country: ''
                },
                errors: [],
            };
        },
        methods: {
            cancelEdit(company) {
                this.isEditing = !this.isEditing;
                Object.assign(company, this._beforeEditingCache);
                this._beforeEditingCache = null;
                this.tempCompany = null;
            },
            startEdit(company) {
                this.companyCollapse = true;
                this.isEditing = !this.isEditing;

                this._beforeEditingCache = company;
                this._beforeEditingCache = Object.assign({}, company);

                this.tempCompany = this.company;
            },
            finishEdit() {
                this.company = this.tempCompany;
                let url = variables.edit_company.format(this.company.id);
                axios.put(url, this.tempCompany)
                    .then(response => {
                        this.isEditing = !this.isEditing;
                        this.companyCollapse = false;
                        this._beforeEditingCache = null;
                        this.tempCompany = null;
                        this.$toast.success("succesfully changed general company information.");
                    })
                    .catch(error => {
                        console.log(error);
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors;
                        }
                    });
            }
        }
    }
</script>

<style>
    .first-row-cards {
        min-height: 310px;
    }


    .invalid-feedback {
        display: block;
        font-size: 90%;
    }
</style>
