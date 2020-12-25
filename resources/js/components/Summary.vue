<template>
    <div>
       
       <h1>Summary</h1>
        <div  v-if="summariesData.length>0">
            <div v-for="(sum, i) in summariesData" :key="i">
                {{sum.summary}}

                <Icon size="20" class="edit" type="md-create" @click="editSkill(sum.id)"/>

                <Icon class="delete" size="20" color="red" type="ios-trash" @click="deleteComfirm(sum)" />

                 <Modal v-model="isDeletedModel" width="360">
                    <p slot="header" style="color:#f60;text-align:center">
                        <Icon type="ios-information-circle"></Icon>
                        <span>Delete confirmation</span>
                    </p>
                    <div style="text-align:center">
                        <p>{{sumData.summary}} will be deleted</p>
                        <p>Will you delete it?</p>
                    </div>
                    <div slot="footer">
                        <Button type="error" size="large" long  @click="deleteSummary(sumData.id)" :loading="summaryDeleting" :disabled="summaryDeleting">Delete</Button>
                    </div>
                </Modal>
            </div>
        </div>
        <div>
             <Button type="primary" @click="addSummries()"> Add Summary</Button>
        </div>
        <div v-if="addSummary">
          <Icon size="20" @click="closeEdit()" type="md-close" />

            <Form ref="summary" :model="summary" :rules="ruleValidate">
                <FormItem label="summary" prop="summary">
                    <Input v-model="summary.summary"  @input="inputEvent()" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="Enter something..." />
                </FormItem>
                <Button v-if="summaryEdit" type="primary" :loading="sumarySending" @click="handleSubmit('summary')">Update</Button>

                <Button v-else type="primary" :loading="sumarySending" @click="handleSubmit('summary')">add</Button>
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
              isDeletedModel:false,
              summaryDeleting:false,
              sumData:{},
              summaryEdit:false,
              editId:null,
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
                      if(this.editId) {
                        try {
                            this.sumarySending = true;
                            const res = await Axios.put(`/api/resumes/${this.resumeId}/summaries/${this.editId}`, this.summary);
                            await this.getResumeData();
                            this.$Message.success('Update!');

                            this.summaryEdit = false
                            this.editId = null

                            this.summary.summary=""
                            this.sumarySending = false
                            this.addSummary = false
                        } catch {
                            this.$Message.error('Fail!');
                        }
                      } else {
                        try {
                            this.sumarySending = true;
                            const res = await Axios.post(`/api/resumes/${this.resumeId}/summaries`, this.summary);
                            await this.getResumeData();
                            this.$Message.success('Success!');
                            this.summary.summary =""
                            this.sumarySending = false
                            this.addSummary = false
                        } catch {
                            this.$Message.error('Fail!');
                        }
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

           async editSkill(id) {
                this.summaryEdit = true
        
                const { data } = await Axios.get(`/api/resumes/${this.resumeId}/summaries/${id}`);

                this.addSummary = true
                this.summary.summary = data.summary;

                this.resume.summaries =  this.resume.summaries.filter(arr => arr.id !==id)
                this.editId = id

                this.getData()
            },

            deleteComfirm(summary) {
              this.sumData = summary
              this.isDeletedModel = true
            },


           async deleteSummary(id) {
                console.log(id)
                this.summaryDeleting = true
               const { data } = await Axios.delete(`/api/resumes/${this.resumeId}/summaries/${id}`);
               await this.getResumeData()

                this.sumData={}
                this.summaryDeleting = false
                this.isDeletedModel =false

            },

            addSummries() {
                this.editId = null
                this.summaryEdit = false
                this.summary.summary = ""
                this.addSummary = true
            },


            async closeEdit(){
                if(this.editId) {
                  await this.getResumeData()
                  this.summary.summary = ""
                }else {
                    this.summary.summary = ""
                    this.getData()

                }
                  this.editId=null
                  this.addSummary = false
                  this.summaryEdit = false

                  

                  

                
        },
        
        },


    

    }
</script>




