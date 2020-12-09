<template>
    <div>
       

       <h1>skill</h1>

         <div  v-if="skillData.length>0">
            <div v-for="(skill, i) in skillData" :key="i">
                {{skill.skill}}
            </div>
        </div>
     
        <div>
            <Button type="primary" @click="addSkills()" style="margin-left: 8px">add Skill</Button>
       </div>
         <div v-if="addSkill">
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

                <Button :loading="skillSending" type="primary" @click="handleSubmit('skill')">Next</Button>
            </Form>
        </div>  

        <Button v-if="notFinalize" type="primary"  @click="nextToSummary">next to Summary</Button>
    </div>
</template>


<script>
    import Axios from 'axios'

    export default {
     props:['resumeId', 'notFinalize','skill'],
   
        data () {
            return {
                skillSending:false,
                skillData:[],
                resume:{},
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
                        try {
                            this.skillSending = true
                            const res = await Axios.post(`/api/resumes/${this.resumeId}/skills`, this.skill);
                            await this.getResumeData()
                            this.$Message.success('Success!');
                            this.isAddingEdu = false;
                            this.$refs[name].resetFields();
                            this.skillSending = false
                            this.addSkill = false
                            this.skill.level = ""
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
                 this.skillData = data.skills;
                 this.resume = data;
                 this.getData();
            },  

               addSkills() {
                   this.addSkill = true
                }
        
        },
     


    }
</script>




