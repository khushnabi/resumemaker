<template>
    <div>
       
       <h1>Summary</h1>
        <div  v-if="summariesData.length>0">
            <div v-for="(sum, i) in summariesData" :key="i">
                {{sum.summary}}
            </div>
        </div>
        <div>
             <Button type="primary" @click="addSummries()"> Add Summary</Button>
        </div>
        <div v-if="addSummary">
            <Form ref="summary" :model="summary" :rules="ruleValidate">
                <FormItem label="summary" prop="summary">
                    <Input v-model="summary.summary"  @input="inputEvent()" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="Enter something..." />
                </FormItem>

                <Button type="primary" :loading="sumarySending" @click="handleSubmit('summary')">add</Button>
            </Form>
        </div>

    </div>
</template>


<script>
    import Axios from 'axios'
    export default {
        props:['resumeId','notFinalize','summary'],

        data () {
            return {
               sumarySending:false,
               summariesData:[],
               resume:{},
               addSummary:false,
               
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

            inputEvent() {
                this.sumarySending = false
            },
            getData() {
                this.$emit("summaryData", this.resume);
            },

            handleSubmit (name) {
               
               this.$refs[name].validate( async (valid) => {
                    if (valid) {
                        try {
                            this.sumarySending = true;
                            const res = await Axios.post(`/api/resumes/${this.resumeId}/summaries`, this.summary);
                            await this.getResumeData();
                            this.$Message.success('Success!');
                            this.$refs[name].resetFields();
                            this.sumarySending = false
                            this.addSummary = false
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
                 this.summariesData = data.summaries;
                 this.resume = data
                 this.getData()
            },

            addSummries() {
                this.addSummary = true
            }
        
        },


    

    }
</script>




