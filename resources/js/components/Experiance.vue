<template>
    <div>
        <div v-if="notFinalize">

        </div>
       <h1>Experiance</h1>
        <div v-if="experianceData.length">
            <div v-for="(expData, i) in experianceData" :key="i">
                {{expData.job_title}}
            </div>
        </div>


        <div>
            <Button type="primary" @click="addExperiance">Add Experiance</Button>
        </div>
        <div v-if="isAddingExp">
               <Form ref="experiance" :model="experiance" :rules="ruleValidate">
            <FormItem label="job title" prop="job_title">
                <Input v-model="experiance.job_title" @input="inputEvent()" placeholder="job title" />
            </FormItem>

              <FormItem label="employer" prop="employer">
                <Input v-model="experiance.employer" @input="inputEvent()" placeholder=" employer" />
            </FormItem>

              <FormItem label="city" prop="city">
                <Input v-model="experiance.city" @input="inputEvent()" placeholder="city" />
            </FormItem>

              <FormItem label="start at" prop="start_at">
                <Input v-model="experiance.start_at" @input="inputEvent()" type="date" placeholder="start at" />
            </FormItem>

              <FormItem label="end at" prop="end_at">
                <Input :disabled="experiance.work_here" @input="inputEvent()" v-model="experiance.end_at" type="date" placeholder="end_at" />
            </FormItem>

           <FormItem label="currently work here" prop="work_here">
                <Checkbox v-model="experiance.work_here" @input="inputEvent()">Checkbox</Checkbox>
            </FormItem>

             <FormItem label="Desc" >
                <Input v-model="experiance.description" @input="inputEvent()" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="Enter something..." />
            </FormItem>
            <FormItem>
                <Button type="primary" :loading="expsending" @click="handleSubmit('experiance')">create experiances</Button>
                <!-- <Button @click="handleReset('formValidate')" style="margin-left: 8px">Reset</Button> -->

            </FormItem>
        </Form>
        </div>



        <div>

          </div>
    </div>
</template>
<script>

    import Axios from 'axios'
 
    export default {
        props:['resumeId', 'notFinalize',"experiance"],
   
        data () {
            return {
                expsending:false,
                isAddingExp:false,
                resume:{},
                experianceData:[],
                
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
            inputEvent() {
                this.expsending = false
            },

            getData() {
                this.$emit("expData", this.resume);
            },

             handleSubmit (name) {

                this.$refs[name].validate( async (valid) => {
                    if (valid) {
                        try {
                            this.expsending = true
                            const res = await Axios.post(`/api/resumes/${this.resumeId}/experiences`, this.experiance);
                             await this.getResumeData()
                                this.$Message.success('Success!');
                                this.isAddingExp = false;
                                this.getData()
                                this.$refs[name].resetFields();
                                this.expsending = false

                        } catch{
                               this.$Message.error('Fail!');
                        }
                            
                    } else {
                        this.$Message.error('Fail!');
                    }
                })
            },

            addExperiance() {
                this.isAddingExp = true
            },

            async getResumeData() {
                 const { data } = await Axios.get(`/api/resumes/${this.resumeId}`);
                 this.experianceData = data.experiences
                 this.resume = data
            },

        }
    }
</script>




