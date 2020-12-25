<template>
    <div>
       

       <h1>skill</h1>

         <div  v-if="skillData.length>0">
            <div v-for="(skill, i) in skillData" :key="i">
                {{skill.skill}}
                 <Icon size="20" class="edit" type="md-create" @click="editSkill(skill.id)"/>

                <Icon class="delete" size="20" color="red" type="ios-trash" @click="deleteComfirm(skill)" />

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
     
        <div>
            <Button type="primary" @click="addSkills()" style="margin-left: 8px">add Skill</Button>
       </div>
         <div v-if="addSkill">

          <Icon size="20" @click="closeEdit()" type="md-close" />
              <Form ref="skill" :model="skill" :rules="ruleValidate">
                <FormItem label="skill" prop="skill">
                    <Input v-model="skill.skill" @input="inputEvent()" placeholder="skill" />
                </FormItem>
                <div>
                      {{skill.level}}
                </div>
                <RadioGroup v-model="skill.level" type="button" size="large">
                    <Radio  @input="inputEvent()" label="novice" ></Radio>
                    <Radio  @input="inputEvent()" label="beginner"></Radio>
                    <Radio  @input="inputEvent()" label="skillfull"></Radio>
                    <Radio  @input="inputEvent()" label="experienced"></Radio>
                    <Radio  @input="inputEvent()" label="expert"></Radio>
                </RadioGroup>

                <Button v-if="skillEdit" :loading="skillSending" type="primary" @click="handleSubmit('skill')">Update Skill</Button>
                <Button v-else :loading="skillSending" type="primary" @click="handleSubmit('skill')">Create Skill</Button>
            </Form>
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
          }else {
              this.removeData()
              await this.getResumeData()
          
          }
           this.editId=null
            this.addSkill = false
            this.skillEdit = false
            

            

                
        },

        removeData() {
          this.skill.skill="";
          this.skill.level=""
        },

        async editSkill(id) {
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




