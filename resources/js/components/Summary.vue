<template>
    <div>
       <h1>Summary</h1>
        <div>
            <Button v-if="notFinalize" @click="perviousToEdu()" style="margin-left: 8px">pervious to Skill</Button>
        </div>
        <div>
             <Button type="primary" @click="addSummries()"> Add Summary</Button>
        </div>
        <div v-if="addSummary">
            <Form ref="summaries" :model="summaries" :rules="ruleValidate">
                <FormItem label="summary" prop="summary">
                    <Input v-model="summaries.summary"  @input="getData()" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="Enter something..." />
                </FormItem>

                <Button type="primary" :loading="sumarySending" @click="handleSubmit('summaries')">add</Button>
            </Form>
        </div>

        <Button v-if="notFinalize" type="primary"  @click="nextToFinalize">next to Finalize</Button>
    </div>
</template>


<script>
    // import Experiance from "./Exxperiance.vue"
    export default {
        props:{
            resume_data:Object,
            notFinalize:Boolean
            },
    //    components: {
    //        Experiance
    //    },
        data () {
            return {
                sumarySending:false,
               summariesData:[],
               final:false,
               addSummary:false,
                isSkill:false,
                expNext:false,
                isSummary:true,
                eduNext:false,
                summaries:{
                    summary:'',
                   
                },
                ruleValidate: {
                    summary : [
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
                this.$emit("summaryData", [this.summaries, this.summariesData,  this.expNext, this.eduNext, this.isSkill, this.isSummary, this.final]);
            },

            handleSubmit (name) {
               
               this.$refs[name].validate( async (valid) => {
                    if (valid) {
                          this.sumarySending = true;
                          const res = await this.resumeApi('post', `/resume/${this.resume_data.id}/summary/create`, this.summaries);

                          if(res.status===201) {
                               await this.getResumeData()
                               this.$Message.success('Success!');
                               this.isAddingEdu = false;
                               this.getData()
                               this.$refs[name].resetFields();
                               this.sumarySending = false
                               this.addSummary = false
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
                 this.summariesData = res.data.summaries;
            },

            nextToFinalize() {
                this.isSummary = false;
                this.expNext = false;
                this.eduNext = false;
                this.isSkill = false;
                this.final = true
                this.getData();
            },

            perviousToEdu() {
                this.isSummary = false;
                this.expNext = false;
                this.eduNext = false;
                this.isSkill = true;
                this.final = false
                this.getData();
            },

            addSummries() {
                this.addSummary = true
            }
        
        },


    

    }
</script>




