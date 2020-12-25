<template>
    <div>


       <h1>Education</h1>
      
        <div  v-if="educationData.length>0">
            <div v-for="(eduData, i) in educationData" :key="i">
                {{eduData.school}}
                 <Icon size="20" class="edit" type="md-create" @click="editEdu(eduData.id)"/>

                <Icon class="delete" size="20" color="red" type="ios-trash" @click="deleteConfirm(eduData)" />
                 <Modal v-model="isDeletedModel" width="360">
                    <p slot="header" style="color:#f60;text-align:center">
                        <Icon type="ios-information-circle"></Icon>
                        <span>Delete confirmation</span>
                    </p>
                    <div style="text-align:center">
                        <p>{{eduDeleteData.school}} will be deleted</p>
                        <p>Will you delete it?</p>
                    </div>
                    <div slot="footer">
                        <Button type="error" size="large" long  @click="deleteEdu(eduDeleteData.id)" :loading="eduDeleting" :disabled="eduDeleting">Delete</Button>
                    </div>
                </Modal>
            </div>
        </div>
     
    

        <div>
            <Button type="primary" @click="addEducation">Add Education</Button>
        </div>
        <div v-if="isAddingEdu">
                    <Icon size="20" @click="closeEdit()" type="md-close" />

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

                <FormItem label="graduated_at" prop="date">
                    <DatePicker type="date" placeholder="Graduated date" @input="inputEvent()" v-model="education.graduated_at" />

                </FormItem>

                <FormItem label="Desc" >
                    <Input v-model="education.description" @input="inputEvent()" type="textarea"  :autosize="{minRows: 2,maxRows: 5}" placeholder="Enter something..." />
                </FormItem> 
                <FormItem>

                    <Button v-if="isEditEdu" type="primary" :loading="eduSending" @click="handleSubmit('education')">Update</Button>
                    <Button v-else type="primary" :loading="eduSending" @click="handleSubmit('education')">create Education</Button>
                    <!-- <Button @click="handleReset('formValidate')" style="margin-left: 8px">Reset</Button> -->
                    
                </FormItem>
            </Form>
        </div>
        <div>
            
        </div>
        


    </div>
</template>
<script>


    import moment from'moment'


    import Axios from 'axios'

    export default {
        props:['resumeId', 'education'],
   
        data () {
            return {
                isDeletedModel:false,
                eduDeleteData:{},
                eduSending:false,
                isEditEdu:false,
                educationData:[],
                eduDeleting:false,
                resume:{},
                isAddingEdu:false,
                editId:null,
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
            this.removeEduData()
            await this.getResumeData()
            this.getData()
        },

        methods: {
            inputEvent(){
                this.eduSending = false;

                if(this.education.graduated_at) {
                    this.education.graduated_at = moment(String(this.education.graduated_at)).format('YYYY-MM-DD')
                }
            },
            getData() {
                this.$emit("eduData", this.resume);
            },

             handleSubmit (name) {
               
                this.$refs[name].validate( async (valid) => {
                    if (valid) {

                        if(this.editId) {
                            console.log('hellow from updated')

                            try {
                            this.eduSending = true
                            const res = await Axios.put(`/api/resumes/${this.resumeId}/educations/${this.editId}`, this.education);
                            await this.getResumeData()
                            this.$Message.success('Update!');
                            this.isAddingEdu = false;
                            this.removeEduData()
                            this.editId = null
                            this.eduSending=false
                            this.isEditEdu = false
                        } catch {
                            this.$Message.error('Fail!');
                        }
                            

                        } else {

                            try {
                            this.eduSending = true
                            const res = await Axios.post(`/api/resumes/${this.resumeId}/educations`, this.education);
                            await this.getResumeData()
                            this.$Message.success('Success!');
                            this.isAddingEdu = false;
                            this.removeEduData()
                            this.eduSending=false
                        } catch {
                            this.$Message.error('Fail!');
                        }
                            
                        }

                        
                    } else {
                        this.$Message.error('Fail!');
                    }
                })
            },
            
            addEducation() {
                this.editId = null
                this.removeEduData()
                this.isEditEdu = false
                this.isAddingEdu = true

            },

            removeEduData() {
                this.education.degree = ""
                this.education.school = ""
                this.education.description = ""
                this.education.city = ""
                this.education.graduated_at = null
            },


            async editEdu(id) {

                this.isEditEdu = true
            
                const { data } = await Axios.get(`/api/resumes/${this.resumeId}/educations/${id}`);

                console.log(data)
                this.education.degree = data.degree
                this.education.school = data.school
                this.education.description = data.description
                this.education.city = data.city
                this.education.graduated_at = data.graduated_at

               
                this.isAddingEdu = true


                this.resume.educations =  this.resume.educations.filter(arr => arr.id !==id)
                 this.editId = id
                 this.getData()

            },

            deleteConfirm(education) {
                this.eduDeleteData = education
                this.isDeletedModel = true
            },

           async deleteEdu(id) {
                this.eduDeleting = true
                const {res} = await Axios.delete(`/api/resumes/${this.resumeId}/educations/${id}`);
                this.removeEduData()
                await this.getResumeData();
                this.eduDeleteData = {}
                this.isAddingEdu = false
                this.eduDeleting = 
                this.isDeletedModel = false
            },

            async closeEdit() {

                  if(this.editId) {
                    await this.getResumeData()
                    this.removeEduData()
                }else {
                      this.removeEduData()
                      await this.getResumeData()
                  
                  }

                this.editId=null
                this.isAddingEdu = false
                this.isEditEdu = false

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




