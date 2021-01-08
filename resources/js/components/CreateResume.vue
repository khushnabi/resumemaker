<template>
    <div>

       <div>

               
               <div class="display-flex margin-left-auto ">
                   

                    <div class="demo-upload-list" v-if="resume.profile_img">
                             <img :src="resume.profile_img">
                            <div class="demo-upload-list-cover">
                                <Icon type="ios-trash-outline" @click="handleRemove"></Icon>
                            </div>
                    </div>

                     <Upload
                        ref="uploads"
                        :on-success="handleSuccess"
                        :format="['jpg','jpeg','png']"
                        :max-size="2048"
                        :on-format-error="handleFormatError"
                        :on-exceeded-size="handleMaxSize"
                        multiple
                        type="drag"
                        :headers="{'x-csrf-token':token}"
                        action="/api/resumes/upload">
                        <div style="padding: 20px 0">
                            <Icon type="ios-cloud-upload" size="40" style="color: #3399ff"></Icon>
                            <!-- <p>Click or drag files here to upload</p> -->
                        </div>
                    </Upload>

               </div>

              <Form ref="resume" :model="resume" :rules="ruleValidate">
                <Row>
                    <Col span="11"> <FormItem width="50" label="first name" prop="first_name">
                            <Input v-model="resume.first_name" @input="inputEvent()" placeholder="first name" />
                        </FormItem>
                    </Col>
                    <Col span="2"><div class="space"></div></Col>
                    <Col span="11">
                          <FormItem label="last names" prop="last_name">
                            <Input v-model="resume.last_name"  @input="inputEvent()" placeholder="last name" />
                        </FormItem>
                    </Col>
                </Row>
           


              <FormItem label="address" prop="address">
                <Input v-model="resume.address" placeholder="address" />
            </FormItem>

              <Row>
                    <Col span="11">
                       <FormItem label="City" prop="city">
                           <Input v-model="resume.city" @input="inputEvent()" placeholder="Enter your city" />
                        </FormItem>
                    </Col>
                    <Col span="2"><div class="space"></div></Col>
                    <Col span="11">
                          <FormItem label="postalCode" prop="postal_code">
                               <Input type="number" v-model="resume.postal_code" @input="inputEvent()" placeholder="postal code" />
                            </FormItem>
                    </Col>
                </Row>

             <Row>
                    <Col span="11">
                        <FormItem label="phone" prop="phone">
                            <Input type="number" v-model="resume.phone" @input="inputEvent()" placeholder="phone" />
                        </FormItem>

                    </Col>
                    <Col span="2"><div class="space"></div></Col>
                    <Col span="11">
                        <FormItem label="E-mail" prop="email">
                            <Input v-model="resume.email" @input="inputEvent()" placeholder="Enter your e-mail" />
                        </FormItem>
                    </Col>
                </Row>


            

           

         
          

            <FormItem>
                <div class="button-wrap">
                <Button v-if="final" type="primary" :loading="isHeadinSend" @click="handleSubmit('resume')">Update </Button>
                <Button v-else="final" type="primary" :loading="isHeadinSend" @click="handleSubmit('resume')">Next to experiance <Icon type="md-arrow-round-forward" /></Button>
                </div>
             
                <!-- <Button @click="handleReset('formValidate')" style="margin-left: 8px">Reset</Button> -->
            </FormItem>
        </Form>
       </div>
    </div>
</template>
<script>

    import Axios from 'axios'
  

    export default {
        props:['editId', "resume", "templete", 'isfinal'],
        token:"",
       
        data () {
            return {
                final:this.isfinal||false,
                notFinalize:true,
                isHeadinSend:false,
                resume_data:{},
                updateId:"",
                resumeEditId:null,
                isAddingRsm:true,
                resumeId:null,
               
                ruleValidate: {
                    first_name : [
                        { required: true, message: 'The first name cannot be empty', trigger: 'blur' }
                    ],
                      last_name : [
                        { required: true, message: 'The last name cannot be empty', trigger: 'blur' }
                    ],

                     address : [
                        { required: true, message: 'The address cannot be empty', trigger: 'blur' }
                    ],

                    email: [
                        { required: true, message: 'Mailbox cannot be empty', trigger: 'blur' },
                        { type: 'email', message: 'Incorrect email format', trigger: 'blur' }
                    ],
                    city: [
                        { required: true, message: 'Please select the city', trigger: 'change' }
                    ],
                      phone: [
                        { required: true, message: 'Please enter your phone', trigger: 'change' }
                    ],
                       postal_code: [
                        { required: true, message: 'Please enter your postal_code', trigger: 'change' }
                    ]

                }
            }
        },


        created() {
            this.resume.templete = this.templete
              this.token = window.Laravel.csrfToken;
        },


        methods: {

            handleSubmit (name) {

                this.$refs[name].validate( async (valid) => {   
                    if (valid) {
                        if(this.editId !== null) {
                            try {
                                this.isHeadinSend = true
                                const { data } = await Axios.put(`/api/resumes/${this.editId}`, this.resume);
                                this.resumeId = this.editId;
                                 if(this.resumeId !==null) {
                                    if(this.final) {
                                        console.log('hellow')
                                    } else {
                                         this.$router.push(`/resumes/${this.templete}/${this.resumeId}/experiance`) 
                                    }
                                   
                                }
                                this.$Message.success('updated!');
                                this.isAddingRsm=false;
                                this.isHeadinSend=false
                                this.$refs[name].resetFields();
                                this.editId =null
                            } catch(err) {
                                this.$Message.error('Fail!');
                            }

                        
                        } else {
                                
                              try {
                                this.isHeadinSend = true
                                const { data } = await Axios.post('/api/resumes', this.resume);
                                this.resumeId = data.id;
                                if(this.resumeId) {
                                    this.$router.push(`/resumes/${this.templete}/${this.resumeId}/experiance`)  
                                }
                                this.$Message.success('created!');
                                this.isAddingRsm=false;
                                this.isHeadinSend=false
                                this.$refs[name].resetFields();
                            } catch(err) {
                                this.$Message.error('Fail!');
                            }
                        }

                    } else {
                        this.$Message.error('Fail!');
                    }
                })
            },
            handleReset (name) {
                this.$refs[name].resetFields();
            },

        

            inputEvent() {
                this.isHeadinSend=false
            },


            handleSuccess (res, file) {
                this.$refs.uploads.clearFiles();
                this.resume.profile_img = `/uploads/${res}`;
                // file.url = 'https://o5wwk8baw.qnssl.com/7eb99afb9d5f317c912f08b5212fd69a/avatar';
                // file.name = '7eb99afb9d5f317c912f08b5212fd69a';
            },


            handleFormatError (file) {
                this.$Notice.warning({
                    title: 'The file format is incorrect',
                    desc: 'File format of ' + file.name + ' is incorrect, please select jpg or png.'
                });
            },


            handleMaxSize (file) {
                this.$Notice.warning({
                    title: 'Exceeding file size limit',
                    desc: 'File  ' + file.name + ' is too large, no more than 2M.'
                });
            },

           async handleRemove() {
               let image = this.resume.profile_img;
               this.resume.profile_img = "";
                const {res} = await Axios.post('/api/resumes/profile_img', this.resume);

                console.log(res)
                // this.resume.profile_img = image;
            },

            async getResume(id) {
                console.log("i am from fetching one data with help of id")
                const { data } = await Axios.get(`/api/resumes/${id}`);
                console.log(data);
                this.resume_data = data;

            }
        }
    }
</script>

<style>


</style>



