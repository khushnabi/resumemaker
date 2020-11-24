<template>
    <div>
       <h1>final</h1>
      

            <Form ref="summaries" :model="summaries" :rules="ruleValidate">
                <FormItem label="summary" prop="summary">
                    <Input v-model="summaries.summary"  @input="getData()" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="Enter something..." />
                </FormItem>

                <Button type="primary" @click="handleSubmit('summaries')">Next</Button>
            </Form>

        <Button type="primary" :loading="sumarySending" @click="nextToFinalize">next to Finalize</Button>
    </div>
</template>


<script>
    // import Experiance from "./Exxperiance.vue"
    export default {
        props:['resume_data'],
    //    components: {
    //        Experiance
    //    },
        data () {
            return {
                sumarySending:false,
               summariesData:[],
               final:true,
                isSkill:false,
                expNext:false,
                isSummary:false,
                eduNext:false,
                summaries:{
                    summary:'',
                   
                },
                ruleValidate: {
                    skill : [
                        { required: true, message: 'The first name cannot be empty', trigger: 'blur' }
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
                console.log("i am from summary")
                this.$emit("summaryData", [this.final]);
            },

            handleSubmit (name) {
               
               this.$refs[name].validate( async (valid) => {
                    if (valid) {
                          this.sumarySending = true;
                          const res = await this.resumeApi('post', `/resume/${this.resume_data.id}/summary/create`, this.summaries);

                            console.log(res.data)
                            console.log("hellwo form sening data")
                          if(res.status===201) {
                               await this.getResumeData()
                               this.$Message.success('Success!');
                               this.isAddingEdu = false;
                               this.getData()
                               this.$refs[name].resetFields();
                               this.sumarySending = false
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
                 console.log("hellow form skills")
                 console.log(res.data);
                 this.summariesData = res.data.summaries;
                //  console.log(this.skillDatas);
                //  console.log(this.skillDatas[0])
            },

            nextToFinalize() {
                this.isSummary = false;
                this.expNext = false;
                this.eduNext = false;
                this.isSkill = false;
                this.final = true
                this.getData();
            },

        },


    

    }
</script>




