<template>
    <div>
       


         <div  v-if="skillData.length>0">
            <div v-for="(skill, i) in skillData" :key="i">

                <div class="show-data">
                    <p class="link-para">
                      <span  @click="editSkill(skill.id)">
                       {{skill.skill}} <span v-if="skill.level">{{skill.level}}</span>
                     </span>
                      <span><Icon class="delete" size="20" color="red" type="ios-trash" @click="deleteComfirm(skill)" /></span>
                  </p>
               </div>

               

               

                 <Modal v-model="isDeletedModel" width="360">
                    <p slot="header" style="color:#f60;text-align:center">
                        <Icon type="ios-information-circle"></Icon>
                        <span>Delete confirmation</span>
                    </p>
                    <div style="text-align:center">
                        <p>{{skillDeleteData.skill}} will be deleted</p>
                        <p>Will you delete it?</p>
                    </div>
                    <div slot="footer">
                        <Button type="error" size="large" long  @click="deleteSkill(skillDeleteData.id)" :loading="SkillDeleting" :disabled="SkillDeleting">Delete</Button>
                    </div>
                </Modal>
            </div>
        </div>
      
         <div v-if="skill.skill" class="show-data">
            <p @click="addSkill=!addSkill" class="link-para"> {{skill.skill}} <span v-if="skill.level">- {{skill.level}}</span> </p>
             
        </div>

        <div>
       </div>
         <div v-if="addSkill">

            <div class="close-wrap">
               <Icon size="20" @click="closeEdit()" type="md-close" />
              
            </div>
              <Form ref="skill" :model="skill" :rules="ruleValidate">
                     <FormItem label="skill" prop="skill">
                        <Input v-model="skill.skill" @input="inputEvent()" placeholder="skill" />
                    </FormItem>



                      <div v-if="skill.level">
                             <p class="level"> Level- <span :class="skill.level">{{skill.level}}</span></p>
                              <br />
                           </div>

                   <FormItem>

                        <RadioGroup v-model="skill.level" type="button" size="large">
                            <Radio  @input="inputEvent()" label="novice" ></Radio>
                            <Radio  @input="inputEvent()" label="beginner"></Radio>
                            <Radio  @input="inputEvent()" label="skillfull"></Radio>
                            <Radio  @input="inputEvent()" label="experienced"></Radio>
                            <Radio  @input="inputEvent()" label="expert"></Radio>

                        </RadioGroup>                      
                  </FormItem>


               

                   <FormItem>
                       <div class="button-wrap">
                            <Button v-if="skillEdit" :loading="skillSending" type="primary" @click="handleSubmit('skill')">Update </Button>

                           <Button v-else :loading="skillSending" type="primary" @click="handleSubmit('skill')">Create Skill</Button>
                          <!-- <Button @click="handleReset('formValidate')" style="margin-left: 8px">Reset</Button> -->
                        </div>
                      
                  </FormItem>

                      

               
               
            </Form>
        </div>  
        <div>
            <div class="open-form" @click="addSkills()"><div class="add"><Icon color="#037bf8" size="16" type="md-add" /></div>Add Skill</div>
        </div>


    </div>
</template>


<script>
    import Axios from 'axios'

    export default {
     props:['resumeId','skill'],
   
        data () {
            return {
              skillDeleteData:{},
                skillEdit:false,
                SkillDeleting:false,
                skillSending:false,
                isDeletedModel:false,
                skillData:[],
                resume:{},
                editId:null,
                addSkill:false,
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
            inputEvent() {
                this.skillSending = false
            },
            getData() {
                this.$emit("skillData",this.resume);
            },

            handleSubmit (name) {
               
               this.$refs[name].validate( async (valid) => {
                    if (valid) {

                      if(this.editId) {

                        try {
                            this.skillSending = true
                            const res = await Axios.put(`/api/resumes/${this.resumeId}/skills/${this.editId}`, this.skill);
                            await this.getResumeData()
                            this.$Message.success('Update!');
                            this.skillSending = false
                            this.skillEdit=false
                            this.editId = null
                            this.addSkill = false
                            this.removeData()
                        } catch {
                              this.$Message.error('Fail!');
                        }
                        

                      } else {

                        try {
                            this.skillSending = true
                            const res = await Axios.post(`/api/resumes/${this.resumeId}/skills`, this.skill);
                            await this.getResumeData()
                            this.$Message.success('Success!');
                            this.skillSending = false
                            this.addSkill = false
                            this.removeData()
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
                 this.skillData = data.skills;
                 this.resume = data;
                 this.getData();
          },  

         addSkills() {
          this.removeData()
          this.editId = null
          this.skillEdit = false
          this.addSkill = true
        },

        async closeEdit(){
          if(this.editId) {
            await this.getResumeData()
            this.removeData()
              this.addSkill = false
          }else {
              this.addSkill = false
              this.removeData()
              await this.getResumeData()
          
          }
           this.editId=null
          
            this.skillEdit = false
            

            

                
        },

        removeData() {
          this.skill.skill="";
          this.skill.level=""
        },

        async editSkill(id) {
            await this.getResumeData();
            this.skillEdit = true

            const { data } = await Axios.get(`/api/resumes/${this.resumeId}/skills/${id}`);
            this.addSkill = true
            this.skill.skill = data.skill;
            this.skill.level=data.level

            this.resume.skills =  this.resume.skills.filter(arr => arr.id !==id)
            this.editId = id

            this.getData()

        },

          deleteComfirm(skill) {
            this.skillDeleteData = skill
          this.isDeletedModel = true
        },




        async deleteSkill(id) {
          console.log(id)
          this.SkillDeleting = true
         const { data } = await Axios.delete(`/api/resumes/${this.resumeId}/skills/${id}`);
         await this.getResumeData()

          this.skillDeleteData={}
          this.SkillDeleting = false
          this.isDeletedModel =false
        },
    
   },



       

      


     


    }
</script>




