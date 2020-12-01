<template>
    <div>

 

       <h1>Experiance</h1>
      
        <div  v-if="experianceData.length>0">
            <div v-for="(expData, i) in experianceData" :key="i">
                {{expData.job_title}}
            </div>
        </div>
     
        <Button v-if="notFinalize" @click="pervious()" style="margin-left: 8px">pervious</Button>
        <div>
            <Button type="primary" @click="addExperiance">Add Experiance</Button>
        </div>
        <div v-if="isAddingExp">
               <Form ref="experiances" :model="experiances" :rules="ruleValidate">
            <FormItem label="job title" prop="job_title">
                <Input v-model="experiances.job_title" @input="getData()" placeholder="job title" />
            </FormItem>

              <FormItem label="employer" prop="employer">
                <Input v-model="experiances.employer"  @input="getData()" placeholder=" employer" />
            </FormItem>

              <FormItem label="city" prop="city">
                <Input v-model="experiances.city"  @input="getData()" placeholder="city" />
            </FormItem>

              <FormItem label="start at" prop="start_at">
                <Input v-model="experiances.start_at"  @input="getData()"  type="date" placeholder="start at" />
            </FormItem>

              <FormItem label="end at" prop="end_at">
                <Input :disabled="experiances.work_here" v-model="experiances.end_at"  @input="getData()"  type="date" placeholder="end_at" />
            </FormItem>

           <FormItem label="currently work here" prop="work_here">
                <Checkbox v-model="experiances.work_here">Checkbox</Checkbox>
            </FormItem>

           

             <FormItem label="Desc" >
                <Input v-model="experiances.description" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="Enter something..." />
            </FormItem> 
            <FormItem>
                <Button type="primary" :loading="expsending" @click="handleSubmit('experiances')">create experiances</Button>
                <!-- <Button @click="handleReset('formValidate')" style="margin-left: 8px">Reset</Button> -->
                
            </FormItem>
        </Form>
        </div>

        

        <div>
              <Button v-if="notFinalize" @click="nextToEdu()" style="margin-left: 8px">Next to education</Button>
          </div>
    </div>
</template>
<script>
    // import Experiance from "./Exxperiance.vue"
    export default {
          props:{
            resume_data:Object,
            notFinalize:Boolean
            },
    //    components: {
    //        Experiance
    //    },
        data () {
            return {
                expsending:false,
                isAddingExp:false,
                isnotAdding:false,
                expNext:true,
                eduNext:false,
                experianceData:[],
                experiances: {
                    job_title: 'dsfsdfs',
                    employer: 'sdfsd',
                    start_at: null,
                    city: 'dsfds',
                    end_at:'',
                    description: "fsdfasdfasf",
                    work_here:false
                  
                 
                },
                ruleValidate: {
                    job_title : [
                        { required: true, message: 'The first name cannot be empty', trigger: 'blur' }
                    ],
                      employer : [
                        { required: true, message: 'The last name cannot be empty', trigger: 'blur' }
                    ],

                     start_at : [
                        { required: false, message: 'The start cannot be empty', trigger: 'blur' }
                    ], 

                    city: [
                        { required: true, message: 'Please select the city', trigger: 'blur' }
                    ],
                     start_at: [
                        { required: true, message: 'Please select the end at', trigger: 'blur' }
                    ],
                    
                }
            }
        },


      async mounted() {
            await this.getResumeData()
            this.getData()
        },

        methods: {

            getData() {
                this.$emit("expData", [this.experiances, this.expNext, this.resume_data.id, this.experianceData, this.eduNext]);
            },

             handleSubmit (name) {
               
                this.$refs[name].validate( async (valid) => {
                    if (valid) {
                            this.expsending = true
                            const res = await this.resumeApi('post', `/resume/${this.resume_data.id}/experiance/create`, this.experiances);
                            if(res.status===201) {
                                await this.getResumeData()
                                this.$Message.success('Success!');
                                this.isnotAdding=true;
                                this.isAddingExp = false;
                                this.getData()
                                this.$refs[name].resetFields();
                                this.expsending = false
                        } else {
                            this.$Message.error('Fail!');
                        }
                            
                    } else {
                        this.$Message.error('Fail!');
                    }
                })
            },
            
            addExperiance() {
                this.isnotAdding=false;
                this.isAddingExp = true
            },

            async getResumeData() {
                 const res = await this.resumeApi('get', `/resume/${this.resume_data.id}`);
                 this.experianceData = res.data.experiences;
            },

            async getExperianceData() {
                
        },

            nextToEdu() {
                this.eduNext = true
                 this.expNext = false
                this.getData()
            },

            pervious () {
                this.eduNext = false,
                this.expNext = false
               this.getData()
            }
        }
    }
</script>




