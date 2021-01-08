<template>
    <div>

         <div  v-if="customDatas.length>0">
            <div v-for="(custom, i) in customDatas" :key="i">
                {{custom.name}}
                 <Icon size="20" class="edit" type="md-create" @click="editCustom(custom.id)"/>

                <Icon class="delete" size="20" color="red" type="ios-trash" @click="deleteComfirm(custom)" />

                 <Modal v-model="isDeletedModel" width="360">
                    <p slot="header" style="color:#f60;text-align:center">
                        <Icon type="ios-information-circle"></Icon>
                        <span>Delete confirmation</span>
                    </p>
                    <div style="text-align:center">
                        <p>{{deleteCustomData.name}} will be deleted</p>
                        <p>Will you delete it?</p>
                    </div>
                    <div slot="footer">
                        <Button type="error" size="large" long  @click="deleteCustom(deleteCustomData.id)" :loading="customDeleting" :disabled="customDeleting">Delete</Button>
                    </div>
                </Modal>
            </div>
        </div>
      
        <div v-if="addingcustom">
            <Form ref="custom" :model="custom" :rules="ruleValidate">
                <FormItem label="name" prop="name">
                    <Input v-model="custom.name" @input="inputEvent()" placeholder="job title" />
                </FormItem>

                 <FormItem label="start_at" prop="date">

                    <DatePicker @input="inputEvent()" type="date" placeholder="Select date" v-model="custom.start_at"></DatePicker>
                </FormItem>

                <FormItem>
                    <Button type="primary" :loading="customSending" @click="handleSubmit('custom')">Next</Button>
                </FormItem>
            </Form>

        
        </div>
   
        <div>
            <div class="open-form" @click="addCustom"><div class="add"><Icon color="#037bf8" size="16" type="md-add" /></div>Add custom</div>
            
        </div>


    </div>
</template>
<script>
    import Axios from 'axios'
    import moment from 'moment'
    export default {
        props:['resumeId','custom'],
    //    components: {
    //        Experiance
    //    },
        data () {
            return {
                customDeleting:false,
                isDeletedModel:false,
                addingcustom:false,
                deleteCustomData: {},
                customDatas:[],
                customSending:false,
                resume:{},
                customEditing:false,
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
            await this.getResumeData()
            this.getData()
        },

        methods: {
            inputEvent() {
                this.customSending = false

                 if(this.custom.start_at) {
                    this.custom.start_at = moment(String(this.custom.start_at)).format('YYYY-MM-DD')
                }
            },
            getData() {
                console.log(this.customs)
                this.$emit("customData", this.resume);
            },

             handleSubmit (name) {
               
                this.$refs[name].validate( async (valid) => {
                    if (valid) {
                        try {
                            this.customSending = true
                            const res = await Axios.post(`/api/resumes/${this.resumeId}/customs`, this.custom);
                            await this.getResumeData()
                            this.$Message.success('Success!');
                            this.addingcustom = false;
                            this.$refs[name].resetFields();
                            this.customSending=false

                        } catch {
                            this.$Message.error('Fail!');

                        }

                    } else {
                        this.$Message.error('Fail!');
                    }
                })
            },
            
            async getResumeData() {
                 const { data } = await Axios.get(`/api/resumes/${this.resumeId}`);
                 console.log("hellow i ma form reume")
                 this.customDatas = data.customs;
                 this.resume = data
                 this.getData()
                
            },

            addCustom() {
                this.addingcustom = true
            },

           async editCustom(id) {
                 await this.getResumeData();
                this.customEditing = true

                const { data } = await Axios.get(`/api/resumes/${this.resumeId}/customs/${id}`);
                this.addingcustom = true
                this.custom.name= data.customs.name

                this.resume.customs =  this.resume.customs.filter(arr => arr.id !==id)
                this.editId = id

                this.getData()

            },

            deleteComfirm(custom) {
                this.isDeletedModel = true
                this.deleteCustomData = custom
            },

          async deleteCustom(id) {
                console.log(id)
                  this.customDeleting = true
                 const { data } = await Axios.delete(`/api/resumes/${this.resumeId}/customs/${id}`);
                 await this.getResumeData()
                  this.deleteCustomData={}
                  this.customDeleting = false
                  this.isDeletedModel =false
            }

        }
    }
</script>




