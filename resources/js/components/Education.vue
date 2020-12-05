<template>
    <div>

       <h1>Education</h1>
      
        <div  v-if="educationData.length>0">
            <div v-for="(eduData, i) in educationData" :key="i">
                {{eduData.school}}
            </div>
        </div>
     
        <Button  v-if="notFinalize" @click="perviousToExp()" style="margin-left: 8px">pervious to Experiance</Button>

        <div>
            <Button type="primary" @click="addEducation">Add Education</Button>
        </div>
        <div v-if="isAddingEdu">
               <Form ref="educations" :model="educations" :rules="ruleValidate">
            <FormItem label="school" prop="school">
                <Input v-model="educations.school" @input="getData()" placeholder="job title" />
            </FormItem>

              <FormItem label="degree" prop="degree">
                <Input v-model="educations.degree"  @input="getData()" placeholder=" employer" />
            </FormItem>

              <FormItem label="city" prop="city">
                <Input v-model="educations.city"  @input="getData()" placeholder="city" />
            </FormItem>

            <FormItem label="description" prop="description">
                 <Input v-model="educations.description" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="description something..." />
            </FormItem>

            <FormItem label="graduated_at" prop="graduated_at">
                <Input v-model="educations.graduated_at"  @input="getData()"  type="date" placeholder="end_at" />
            </FormItem>
            
             


            <!-- <CheckboxGroup>
                <Checkbox label="work-here"></Checkbox>
            </CheckboxGroup> -->

             <FormItem label="Desc" >
                <Input v-model="educations.description" type="textarea"   @input="getData()"  :autosize="{minRows: 2,maxRows: 5}" placeholder="Enter something..." />
            </FormItem> 
            <FormItem>
                <Button type="primary" :loading="eduSending" @click="handleSubmit('educations')">Next</Button>
                <!-- <Button @click="handleReset('formValidate')" style="margin-left: 8px">Reset</Button> -->
                
            </FormItem>
        </Form>

       
        </div>
        <div>
            <Button v-if="notFinalize" type="primary" @click="nextSkill">next to Skill</Button>
        </div>
        


    </div>
</template>
<script>

    import Axios from 'axios'

    export default {
        props:['resumeId', 'notFinalize'],
   
        data () {
            return {
                eduSending:false,
               educationData:[],
                experianceData:[],
                isAddingEdu:false,
                isSkill:false,
                eduNext:true,
                expNext:false,
                educations: {
                    school: 'dsfsdfs',
                    degree: 'sdfsd',
                    city: 'dsfds',
                    graduated_at: null,
                    description: "fsdfasdfasf",
                  
                 
                },
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

            getData() {
                this.$emit("eduData", [this.educations, this.expNext, this.educationData, this.isSkill, this.eduNext]);
            },

             handleSubmit (name) {
               
                this.$refs[name].validate( async (valid) => {
                    if (valid) {
                        try {
                            this.eduSending = true
                            const res = await Axios.post(`/api/resumes/${this.resumeId}/educations`, this.educations);
                            await this.getResumeData()
                            this.$Message.success('Success!');
                            this.isAddingEdu = false;
                            this.getData()
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
                this.isnotAdding=false;
                this.isAddingEdu = true
            },

            async getResumeData() {
                  const { data } = await Axios.get(`/api/resumes/${this.resumeId}`);
                 this.educationData = data.educations;
            },

            async getExperianceData() {
        },

        nextSkill() {
            this.isSkill=true
            this.eduNext = false
            this.expNext= false
            this.getData()
        },

            perviousToExp () {
                this.eduNext= false
                this.expNext = true
                this.isSkill = false
                this.getData()
            }
        }
    }
</script>




