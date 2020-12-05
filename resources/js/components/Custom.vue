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
    import Axios from 'axios'
    export default {
        props:['resumeId'],
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
                        try {
                            this.eduSending = true
                            const res = await Axios.post(`/api/resumes/${this.resumeId}/customs`, this.customs);
                            await this.getResumeData()
                            this.$Message.success('Success!');
                            this.addingcustom = false;
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
            
            async getResumeData() {
                 const { data } = await Axios.get(`/api/resumes/${this.resumeId}`);
                 console.log("hellow i ma form reume")
                 console.log(data)
                 this.customData = data.customs;
                 console.log(this.customData)
                
            },

            addCustom() {
                this.addingcustom = true
            },

        }
    }
</script>




