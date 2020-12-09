<template>
    <div>


       <h1>Education</h1>
      
        <div  v-if="educationData.length>0">
            <div v-for="(eduData, i) in educationData" :key="i">
                {{eduData.school}}
            </div>
        </div>
     
    

        <div>
            <Button type="primary" @click="addEducation">Add Education</Button>
        </div>
        <div v-if="isAddingEdu">
               <Form ref="education" :model="education" :rules="ruleValidate">
                <FormItem label="school" prop="school">
                    <Input v-model="education.school" @input="inputEvent()" placeholder="job title" />
                </FormItem>

                <FormItem label="degree" prop="degree">
                    <Input v-model="education.degree" @input="inputEvent()" placeholder=" employer" />
                </FormItem>

                <FormItem label="city" prop="city">
                    <Input v-model="education.city" @input="inputEvent()" placeholder="city" />
                </FormItem>

                <FormItem label="graduated_at" prop="graduated_at">
                    <Input v-model="education.graduated_at" @input="inputEvent()"  type="date" placeholder="end_at" />
                </FormItem>

                <FormItem label="Desc" >
                    <Input v-model="education.description" @input="inputEvent()" type="textarea"  :autosize="{minRows: 2,maxRows: 5}" placeholder="Enter something..." />
                </FormItem> 
                <FormItem>
                    <Button type="primary" :loading="eduSending" @click="handleSubmit('education')">Next</Button>
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
        props:['resumeId', 'notFinalize', 'education'],
   
        data () {
            return {
                eduSending:false,
                educationData:[],
                resume:{},
                isAddingEdu:false,
               
                ruleValidate: {
                    school : [
                        { required: true, message: 'The first name cannot be empty', trigger: 'blur' }
                    ],
                      degree : [
                        { required: true, message: 'The last name cannot be empty', trigger: 'blur' }
                    ],

                     graduated_at : [
                        { required: false, message: 'The start cannot be empty', trigger: 'blur' }
                    ], 

                    city: [
                        { required: true, message: 'Please select the city', trigger: 'blur' }
                    ],
                  
                }
            }
        },
        

      async mounted() {
            await this.getResumeData()
            this.getData()
        },

        methods: {
            inputEvent(){
                this.eduSending = false;
            },
            getData() {
                this.$emit("eduData", this.resume);
            },

             handleSubmit (name) {
               
                this.$refs[name].validate( async (valid) => {
                    if (valid) {
                        try {
                            this.eduSending = true
                            const res = await Axios.post(`/api/resumes/${this.resumeId}/educations`, this.education);
                            await this.getResumeData()
                            this.$Message.success('Success!');
                            this.isAddingEdu = false;
                            this.$refs[name].resetFields();
                            this.eduSending=false
                        } catch {
                            this.$Message.error('Fail!');
                        }
                            
                    } else {
                        this.$Message.error('Fail!');
                    }
                })
            },
            
            addEducation() {
                this.isAddingEdu = true
            },

            async getResumeData() {
                  const { data } = await Axios.get(`/api/resumes/${this.resumeId}`);
                  this.educationData = data.educations
                  this.resume = data;
                  this.getData()

            },

        }
    }
</script>




