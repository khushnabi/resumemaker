<template>
    <div>

       <h1>custom</h1>
         <div  v-if="customDatas.length>0">
            <div v-for="(custom, i) in customDatas" :key="i">
                {{custom.name}}
            </div>
        </div>
        <div>
            <Button type="primary" @click="addCustom">Add custom</Button>
        </div>
        <div v-if="addingcustom">
            <Form ref="custom" :model="custom" :rules="ruleValidate">
                <FormItem label="name" prop="name">
                    <Input v-model="custom.name" @input="inputEvent()" placeholder="job title" />
                </FormItem>

                <FormItem label="start_at" prop="start_at">
                    <Input v-model="custom.start_at"  @input="inputEvent()"  type="date" placeholder="start at" />
                </FormItem>

                <FormItem>
                    <Button type="primary" :loading="customSending" @click="handleSubmit('custom')">Next</Button>
                </FormItem>
            </Form>

        
        </div>
   
        


    </div>
</template>
<script>
    import Axios from 'axios'
    export default {
        props:['resumeId','custom'],
    //    components: {
    //        Experiance
    //    },
        data () {
            return {
                addingcustom:false,
                customDatas:[],
                customSending:false,
                resume:{},
              
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

        }
    }
</script>




