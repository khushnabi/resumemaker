<template>
    <div>

        <div v-if="experianceData.length">
            <div v-for="(expData, i) in experianceData" :key="i">
               <div class="show-data">
                    <p class="link-para"><span  @click="editExp(expData.id)">{{expData.job_title}}</span>
                     <span><Icon class="delete" size="20" color="red" type="ios-trash" @click="deleteComfirm(expData)" /></span></p>
               </div>
        
              
              
                 <Modal v-model="isDeletedModel" width="360">
                    <p slot="header" style="color:#f60;text-align:center">
                        <Icon type="ios-information-circle"></Icon>
                        <span>Delete confirmation</span>
                    </p>
                    <div style="text-align:center">
                        <p>{{expDeleteData.job_title}} will be deleted</p>
                        <p>Will you delete it?</p>
                    </div>
                    <div slot="footer">
                        <Button type="error" size="large" long  @click="deleteExp(expDeleteData.id)" :loading="expDeleting" :disabled="expDeleting">Delete</Button>
                    </div>
                </Modal>
            </div>
        </div>

         <div v-if="experiance.job_title" class="show-data">
            <p @click="isAddingExp=!isAddingExp" class="link-para"> {{experiance.job_title}}</p>
             
        </div>

      
    <div v-if="isAddingExp">
        <div class="close-wrap">
               <Icon size="20" @click="closeEdit()" type="md-close" />
        </div>
     


      <div>
            <Form ref="experiance" :model="experiance" :rules="ruleValidate">
            <Row>
                <Col span="11">
                     <FormItem label="job title" prop="job_title">
                        <Input v-model="experiance.job_title" @input="inputEvent()" placeholder="job title" />
                    </FormItem>
                </Col>
                <Col span="1"><div class="space"></div></Col>
                <Col span="12">
                      <FormItem label="employer" prop="employer">
                        <Input v-model="experiance.employer" @input="inputEvent()" placeholder=" employer" />
                    </FormItem>
                </Col>
            </Row>
             <Row>
                <Col span="5">
                   <FormItem label="start at" prop="date">
                         <DatePicker type="date" placeholder="Select date" @input="inputEvent()" v-model="experiance.start_at" />
                    </FormItem>
                </Col>
                <Col span="1"><div class="space"></div></Col>
                  <Col span="5">
                     <FormItem label="end at" prop="date">
                         <DatePicker :disabled="experiance.work_here" @input="inputEvent()" type="date" placeholder="Select time" v-model="experiance.end_at"></DatePicker>
                    </FormItem>
                </Col>

                <Col span="1"><div class="space"></div></Col>
                <Col span="12">
                    <FormItem label="city" prop="city">
                        <Input v-model="experiance.city" @input="inputEvent()" placeholder="city" />
                    </FormItem>
                </Col>
            </Row>
          

           <FormItem label="currently work here" prop="work_here">
                <Checkbox v-model="experiance.work_here" @input="inputEvent()"></Checkbox>
            </FormItem>

             <FormItem label="Desc" >
                <Input v-model="experiance.description" @input="inputEvent()" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="Enter something..." />
            </FormItem>
            <FormItem>

              <div class="button-wrap">
                     <Button v-if="expEdit" type="primary" :loading="expsending" @click="handleSubmit('experiance')">edit experiances</Button>

                 <Button v-else type="primary" :loading="expsending" @click="handleSubmit('experiance')">create experiances</Button>
                <!-- <Button @click="handleReset('formValidate')" style="margin-left: 8px">Reset</Button> -->
              </div>

            </FormItem>
        </Form>
      </div>
    </div>

   
        <div>
            <div class="open-form" @click="addExperiance"><div class="add"><Icon color="#037bf8" size="16" type="md-add" /></div>Add Employment</div>
        </div>

         <div>
            <p class="small-para">
                In this section, list related employment experience in your last 10 years along with the dates. Mention the most recent employment first.
            </p>
        </div>

    </div>
</template>
<script>

    import moment from'moment'

    import Axios from 'axios'
 
    export default {
        props:['resumeId',"experiance"],
   
        data () {
            return {
                expDeleting:false,
                expDeleteData:{},
                isDeletedModel:false,
                expsending:false,
                isAddingExp:false,
                expEdit:false,
                resume:{},
                editId:null,
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
                     end_at: [
                        { required: false, message: 'Please select the end at', trigger: 'blur' }
                    ],

                }
            }
        },


      async mounted() {
        this.removeData()
            await this.getResumeData()
            this.getData()
        },

        methods: {
            inputEvent() {
                if(this.experiance.start_at) {
                    this.experiance.start_at = moment(String(this.experiance.start_at)).format('YYYY-MM-DD')
                    console.log(this.experiance.end_at)
                }


                if ( this.experiance.end_at) {
                    this.experiance.end_at = moment(String(this.experiance.end_at)).format('YYYY-MM-DD')
                     
                } else {
                    this.experiance.end_at = this.experiance.end_at
                }
                
                this.expsending = false
            },


            getData() {

                this.$emit("expData", this.resume);
            },

             handleSubmit (name) {
                 this.$refs[name].validate( async (valid) => {

                    if (valid) {
                       
                       if(this.experiance.work_here === true) {
                        this.experiance.work_here = 1
                       } else {
                        this.experiance.work_here = 0
                       }

                        if(this.expEdit) {

                             try {
                                console.log('hellwo')
                                this.expsending = true
                                const {res} = await Axios.put(`/api/resumes/${this.resumeId}/experiences/${this.editId}`, this.experiance);

                                console.log("hellwo from editing")
                                console.log(res)
                                await this.getResumeData()
                                this.closeEdit()
                                this.$Message.success('Success!');
                                
                                this.expsending = false
                           
                        } catch{
                               this.$Message.error('Fail!');
                        }
                            
                     } else {
                          try {
                                this.expsending = true
                                const res = await Axios.post(`/api/resumes/${this.resumeId}/experiences`, this.experiance);
                                await this.getResumeData()
                                this.$Message.success('Success!');
                                this.isAddingExp = false;
                                this.expsending = false
                                this.removeData()
                           
                        } catch{
                               this.$Message.error('Fail!');
                        }
                     }




                       
                    } else {
                        this.$Message.error('Fail!');
                    }
                })
            },


            removeData() {
                 this.experiance.job_title = '';
                this.experiance.employer = ''
                this.experiance.start_at = null
                this.experiance.end_at = null
                this.experiance.description =''
                this.experiance.work_here = false
                this.experiance.city = ""
            },

            async closeEdit() {

                if(this.editId) {
                    await this.getResumeData()
                    this.removeData()
                }else {
                      this.removeData()
                      await this.getResumeData()
                  
                  }
                this.editId=null
                this.isAddingExp = false
                this.expEdit = false

            },

            addExperiance() {
                this.removeData();
                this.editId = null
                this.expEdit = false
                this.isAddingExp = true
            },

            deleteComfirm(experiance) {
                this.expDeleteData = experiance
                this.isDeletedModel=true
            },

           async deleteExp(id) {
                this.expDeleting= true
                const {res} = await Axios.delete(`/api/resumes/${this.resumeId}/experiences/${id}`);
                this.removeData()
                await this.getResumeData();
                this.expDeleteData = {}
                this.isAddingExp = false
                this.expDeleting = false
                this.isDeletedModel = false

                 

            },

            async getResumeData() {
                 const { data } = await Axios.get(`/api/resumes/${this.resumeId}`);
                 this.experianceData = data.experiences
                 this.resume = data
                 this.getData()
                 

            },

           async editExp(id) {
                this.getResumeData()
                this.expEdit = true
                const { data } = await Axios.get(`/api/resumes/${this.resumeId}/experiences/${id}`);

                this.editId = id

                this.experiance.job_title = data.job_title;
                this.experiance.employer = data.employer
                this.experiance.start_at = data.start_at
                this.experiance.end_at = data.end_at
                this.experiance.description = data.description

                if(data.work_here === 0) {
                    this.experiance.work_here= false
                } else {
                    this.experiance.work_here = true
                }

                this.experiance.city = data.city
                this.isAddingExp = true

                this.resume.experiences =  this.resume.experiences.filter(arr => arr.id !==id)

            }

        }
    }
</script>

<style>



</style>



