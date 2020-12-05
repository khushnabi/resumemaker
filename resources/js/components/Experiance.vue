<template>
    <div>
        {{resumeId}}
       <h1>Experiance</h1>
        <div v-if="experianceData.length">
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

    import Axios from 'axios'
 
    export default {
        props:['resumeId', 'notFinalize'],
   
        data () {
            return {
                expsending:false,
                isAddingExp:false,
         
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
                this.$emit("expData", [this.experiances, this.expNext, this.resumeId, this.experianceData, this.eduNext]);
            },

             handleSubmit (name) {

                this.$refs[name].validate( async (valid) => {
                    if (valid) {
                        try {
                            this.expsending = true
                            const res = await Axios.post(`/api/resumes/${this.resumeId}/experiences`, this.experiances);
                            console.log(res.data)
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
                 this.experianceData = data.experiences;
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




