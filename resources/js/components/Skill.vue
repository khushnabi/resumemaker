<template>
    <div>
       <h1>skill</h1>
      <div>
           <Button v-if="notFinalize" @click="perviousToEdu()" style="margin-left: 8px">pervious to Education</Button>
      </div>

       <div>
            <Button type="primary" @click="addSkills()" style="margin-left: 8px">add Skill</Button>
       </div>
         <div v-if="addSkill">
              <Form ref="skills" :model="skills" :rules="ruleValidate">
                <FormItem label="skill" prop="skill">
                    <Input v-model="skills.skill" @input="getData()" placeholder="skill" />
                </FormItem>

                <RadioGroup v-model="skills.level" type="button" size="large">
                    <Radio  @input="getData()" label="novice" ></Radio>
                    <Radio  @input="getData()" label="beginner"></Radio>
                    <Radio  @input="getData()" label="skillfull"></Radio>
                    <Radio  @input="getData()" label="experienced"></Radio>
                    <Radio  @input="getData()" label="expert"></Radio>
                </RadioGroup>

                <Button :loading="skillSending" type="primary" @click="handleSubmit('skills')">Next</Button>
            </Form>
        </div>  

        <Button v-if="notFinalize" type="primary"  @click="nextToSummary">next to Summary</Button>
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
              skillSending:false,
               skillDatas:[],
                isSkill:true,
                expNext:false,
                isSummary:false,
                eduNext:false,
                addSkill:false,
                skills:{
                    skill:'',
                    level: ''
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
                this.$emit("skillData", [this.skills, this.skillDatas,  this.expNext, this.eduNext, this.isSkill, this.isSummary]);
            },

            handleSubmit (name) {
               
               this.$refs[name].validate( async (valid) => {
                    if (valid) {
                         this.skillSending = true
                          const res = await this.resumeApi('post', `/resume/${this.resume_data.id}/skill/create`, this.skills);

                          if(res.status===201) {
                               await this.getResumeData()
                               this.$Message.success('Success!');
                              this.isAddingEdu = false;
                               this.getData()
                               this.$refs[name].resetFields();
                               this.skillSending = false
                               this.addSkill = false
                                this.skills.level = ""
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
                 this.skillDatas = res.data.skills;
            },

            nextToSummary() {
                this.isSummary = true;
                this.expNext = false;
                this.eduNext = false;
                this.isSkill = false;
                this.getData();
            },

            perviousToEdu() {
                this.isSummary = false;
                this.expNext = false;
                this.eduNext = true;
                this.isSkill = false;
                this.getData();
            },
               addSkills() {
                   this.addSkill = true
                }
        
        },
     


    }
</script>




