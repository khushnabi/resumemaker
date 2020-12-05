<template>
    <div>
           <div v-if="expNext">
           Experiance
           <Experiance :notFinalize="notFinalize" :resumeId="resumeId" v-on:expData="experianceData($event)" ></Experiance>
       </div>

       <div v-else-if="eduNext">
           Education
            <Education :notFinalize="notFinalize" :resumeId="resumeId" v-on:eduData="geteducationData($event)" ></Education>
       </div>

       <div v-else-if="isSkill">
           Skill
            <Skill :notFinalize="notFinalize" :resumeId="resumeId" v-on:skillData="skillsData($event)" ></Skill>
       </div>

       <div v-else-if="isSummary">
           <Summary :notFinalize="notFinalize" :resumeId="resumeId" v-on:summaryData="getSummary($event)" ></Summary>
       </div>

       <div v-else-if="final">
           <Finalize :resumeId="resumeId" v-on:finalData="getFinal($event)" ></Finalize>

       </div>

       <div v-else>
           {{resumeEditId}}
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
                    action="/resume/upload">
                    <div style="padding: 20px 0">
                        <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                        <p>Click or drag files here to upload</p>
                    </div>
                </Upload>


                    <div class="demo-upload-list" v-if="resume.profile_img">
                             <img :src="resume.profile_img">
                            <div class="demo-upload-list-cover">
                                <Icon type="ios-trash-outline" @click="handleRemove"></Icon>
                            </div>
                    </div>

              <Form ref="formValidate" :model="formValidate" :rules="ruleValidate">
            <FormItem label="first name" prop="first_name">
                <Input v-model="resume.first_name" @input="getData()" placeholder="first name" />
            </FormItem>

              <FormItem label="last names" prop="last_name">
                <Input v-model="resume.last_name"  @input="getData()" placeholder="last name" />
            </FormItem>

              <FormItem label="address" prop="address">
                <Input v-model="resume.address" placeholder="address" />
            </FormItem>

             <FormItem label="City" prop="city">
               <Input v-model="resume.city" @input="getData()" placeholder="Enter your city" />
            </FormItem>

            <FormItem label="postalCode" prop="postal_code">
               <Input type="number" v-model="resume.postal_code" @input="getData()" placeholder="postal code" />
            </FormItem>

            <FormItem label="phone" prop="phone">
                <Input type="number" v-model="resume.phone" @input="getData()" placeholder="phone" />
            </FormItem>

            <FormItem label="E-mail" prop="email">
                <Input v-model="resume.email" @input="getData()" placeholder="Enter your e-mail" />
            </FormItem>

            <FormItem>
                <Button type="primary" :loading="isHeadinSend" @click="handleSubmit('formValidate')">Next</Button>
                <!-- <Button @click="handleReset('formValidate')" style="margin-left: 8px">Reset</Button> -->
            </FormItem>
        </Form>
       </div>
    </div>
</template>
<script>

    import Axios from 'axios'
    import Education from "./Education.vue";
    import Experiance from "./Experiance.vue";
    import Skill from "./Skill.vue";
    import Summary from "./Summary";
    import Finalize from "./Finalize"

    export default {
        props:['editId','emptyFormField', "resume"],
        token:"",
        components: {
            Experiance,
            Education,
            Skill,
            Summary,
            Finalize
        },
        data () {
            return {
                notFinalize:true,
                isHeadinSend:false,
                eduNext:false,
                isSummary:false,
                skills:{},
                skillDatas:[],
                final:false,
                educations:{},
                isSkill:false,
                isGetExpData:[],
                educationData:[],
                resume_data:{},
                updateId:"",
                expNext: false,
                resumeEditId:null,
                experiance:{},
                isAddingRsm:true,
                summaries:{},
                summariesData:[],
                customs:{},
                customDatas:[],
                resumeId:null,
                formValidate: {
                    profile_img:'',
                    first_name: 'ddjkf',
                    last_name: 'djfkdl',
                    address: 'dffdk',
                    city: 'dfd',
                    postal_code: '44354',
                    phone: '834985',
                    email: "dfddtdsyujkp@hsda.com",
                    created_at:'',


                },
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
              this.token = window.Laravel.csrfToken;
        },

        mounted() {
            // this.resumeEditId = this.editId
            // this.getSingle(this.resumeEditId);

        },

        methods: {

            getData() {
                this.$emit("data", [this.formValidate, this.experiance, this.isGetExpData, this.educationData, this.educations, this.skills, this.skillDatas, this.summaries, this.summariesData, this.customs, this.customDatas]);
            },

            handleSubmit (name) {

                this.$refs[name].validate( async (valid) => {   
                    console.log(this.resume)
                    if (valid) {
                        if(this.editId !== null) {
                            try {
                                this.isHeadinSend = true
                                const { data } = await Axios.put(`/api/resumes/${this.editId}`, this.resume);
                                console.log('from updatd resume')
                                this.resumeId = this.editId;
                                console.log(this.resumeId)
                                this.$Message.success('updated!');
                                this.expNext = true;
                                this.isAddingRsm=false;
                                this.isHeadinSend=false
                                this.$refs[name].resetFields();
                            } catch(err) {
                                this.$Message.error('Fail!');
                            }

                        
                        } else {
                                
                              try {
                                this.isHeadinSend = true
                                const { data } = await Axios.post('/api/resumes', this.resume);
                                this.resumeId = data.id;
                                this.$Message.success('created!');
                                this.expNext = true;
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

            experianceData(expData) {

                this.experiance = expData[0]

                this.expNext = expData[1]

                this.resumeEditId = expData[2]

                this.isGetExpData = expData[3]

                this.eduNext = expData[4]

                if(this.editId !== this.resumeEditId) {
                    this.getSingle(this.resumeEditId);
                }else {
                    this.getSingle(this.resumeEditId);
                }

            },

            geteducationData(eduData) {
                this.educations = eduData[0]
                this.expNext=eduData[1]
                this.educationData = eduData[2]
                this.isSkill = eduData[3]
                 this.eduNext = eduData[4]


                this.getData()

            },

            skillsData(skillData) {
                this.skills = skillData[0];
                this.skillDatas = skillData[1];
                this.expNext = skillData[2];
                this.eduNext = skillData[3];
                this.isSkill = skillData[4];
                this.isSummary = skillData[5];
                this.getData()
            },

            getSummary(summaryData) {
                 this.summaries = summaryData[0];
                this.summariesData = summaryData[1];
                this.expNext = summaryData[2];
                this.eduNext = summaryData[3];
                this.isSkill = summaryData[4];
                this.isSummary = summaryData[5];
                this.final = summaryData[6]
                this.getData()
            },

            getFinal(finalData) {
                this.experiance = finalData[0]
                this.isGetExpData=finalData[1]
                this.educationData=finalData[2]
                this.educations = finalData[3]
                this.skills = finalData[4]
                this.skillDatas = finalData[5]
                this.summaries = finalData[6]
                this.summariesData = finalData[7]

                this.customs = finalData[8]

                this.customDatas = finalData[9]
                console.log("hellow from heading custom data")
                console.log(this.customs)
                console.log(this.customDatas)
                 this.getData()
            },


           async getSingle(id) {
               if(id !== null) {
                   this.updateId = id;
                   await this.getResume(this.updateId);
               } else {
                   console.log("these si not id")
               }
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
              const res = await this.resumeApi('post', '/resume/profile_img', {profile_img:image} );
              if(res.status !=200) {
                  this.resume.profile_img = image;
              }
            },

            async getResume(id) {
                console.log("i am from fetching one data with help of id")
                const { data } = await Axios.get(`/api/resumes/${id}`);
                console.log(data);
                this.resume_data = data;

                // this.summariesData = res.data.summaries;
                // this.isGetExpData = res.data.experiences;
                // this.educationData = res.data.educations
                // this.skillDatas = res.data.skills;
                // this.summaryData = res.data.summaries
                // this.getData()
            }
        }
    }
</script>

<style>


    .color-white {
        color:#fff;
    }

    .demo-upload-list{
        display: inline-block;
        width: 60px;
        height: 60px;
        text-align: center;
        line-height: 60px;
        border: 1px solid transparent;
        border-radius: 4px;
        overflow: hidden;
        background: #fff;
        position: relative;
        box-shadow: 0 1px 1px rgba(0,0,0,.2);
        margin-right: 4px;
    }
    .demo-upload-list img{
        width: 100%;
        height: 100%;
    }
    .demo-upload-list-cover{
        display: none;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,.6);
    }
    .demo-upload-list:hover .demo-upload-list-cover{
        display: block;
    }
    .demo-upload-list-cover i{
        color: #fff;
        font-size: 20px;
        cursor: pointer;
        margin: 0 2px;
    }
</style>



