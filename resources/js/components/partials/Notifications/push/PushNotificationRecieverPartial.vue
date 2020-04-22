<template>
    <div>
       <b-row v-if="user.type == 'default'">
           <b-col>
               <multiselect v-model="selectedReceiver"
                            :options="employees"
                            :preselect-first="true"
                            :close-on-select="false"
                            placeholder="Select employee(s)"
                            label="name"
                            track-by="name"
                            :taggable="true"
                            :multiple="true"
                            @input="updateReceiver"
               >
               </multiselect>
           </b-col>
       </b-row>
       <b-row v-else>
           <b-col>
               <span>Select receiver</span>
               <multiselect v-model="receiverType"
                            :options="receiverOptions"
                            :preselect-first="true"
                            :close-on-select="false"
                            placeholder="Select receiver"
                            :taggable="true"
                            :multiple="true"
                            @input="updateReceiver"
               >
               </multiselect>
           </b-col>
       </b-row>
    </div>
</template>

<script>
    export default {
        name: "PushNotificationRecieverPartial",
        props:[
          'user'
        ],
        data() {
            return {
                employees: [],
                departments:[],
                receiverOptions: [
                    'company',
                    'department',
                    'employees'
                ],
                selectedReceiver:[],
                receiverType:'',
            };
        },
        created() {
            this.fetchEmployees();
            this.checkUserType();
        },
        methods:{
            checkUserType(){
              if(this.user.type != 'default'){
                  this.fetchDepartments();
              }
            },
            fetchEmployees(){
                let url = variables.get_employees;
                axios.get(url)
                    .then(response => {
                        this.employees = response.data

                })
                    .catch(error => {
                        console.log(error);
                        // if (error.response.status === 422) {
                        //     this.errors = error.response.data.errors;
                        // }
                    });
            },
            fetchDepartments(){
                let url = variables.get_departments;
                axios.get(url)
                    .then(response => {
                        this.departments = response.data

                })
                    .catch(error => {
                        console.log(error);
                        // if (error.response.status === 422) {
                        //     this.errors = error.response.data.errors;
                        // }
                    });
            },
            updateReceiver(){
                if(this.user.type == 'default'){
                    this.recieverType = 'employees';
                    this.$root.$emit('updateReceiver', this.selectedReceiver, this.recieverType);
                } else if (this.user.type != 'default'){
                    this.$root.$emit('updateReceiver', this.selectedReceiver, this.recieverType);
                }
            }
        }
    }
</script>

<style scoped>

</style>
