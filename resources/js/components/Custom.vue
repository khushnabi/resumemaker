<template>
    <div>

       <h1>Education</h1>
      
        <div>
            <Button type="primary" @click="addCustom">Add custom</Button>
        </div>
        <div v-if="addingcustom">
            <Form ref="customs" :model="customs" :rules="ruleValidate">
                <FormItem label="name" prop="name">
                    <Input v-model="customs.name" @input="getData()" placeholder="job title" />
                </FormItem>

                <FormItem label="start_at" prop="start_at">
                    <Input v-model="customs.start_at"  @input="getData()"  type="date" placeholder="start at" />
                </FormItem>

                <FormItem>
                    <Button type="primary" :loading="eduSending" @click="handleSubmit('customs')">Next</Button>
                </FormItem>
            </Form>

        
        </div>
   
        


    </div>
</template>
<script>
    // import Experiance from "./Exxperiance.vue"
    export default {
        props:{
            resume_data:Object,
            
            },
    //    components: {
    //        Experiance
    //    },
        data () {
            return {
                addingcustom:false,
                customData:[],
                eduSending:false,
                customs: {
                    name:'',
                    start_at: null,
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
                console.log(this.customs)
                this.$emit("customData", [this.customs, this.customData]);
            },

             handleSubmit (name) {
               
                this.$refs[name].validate( async (valid) => {
                    if (valid) {
                            this.eduSending = true
                            const res = await this.resumeApi('post', `/resume/${this.resume_data.id}/custom/create`, this.customs);
                            if(res.status===201) {
                                await this.getResumeData()
                                this.$Message.success('Success!');
                                this.addingcustom = false;
                                this.getData()
                                this.$refs[name].resetFields();
                                this.eduSending=false
                        } else {
                            this.$Message.error('Fail!');
                        }
                            
                    } else {
                        this.$Message.error('Fail!');
                    }
                })
            },
            
            async getResumeData() {
                 const res = await this.resumeApi('get', `/resume/${this.resume_data.id}`);
                 console.log("hellow form custom")
                 this.customData = res.data.customs
                 this.getData();
                
            },

            addCustom() {
                this.addingcustom = true
            },

        }
    }
</script>




