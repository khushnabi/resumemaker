<template>
    <div>
        <div> 
              <div>
                 <h4 class="form-header">{{resume.first_name}}</h4>
                 <br />
                 <div class="head-line">
                     <div><Icon size="30" color="#1688fe" type="md-contact" /></div>

                     <div class="second-heading">personal information</div>
                 </div>

              </div>

              <CreateResume :templete='templete' :isfinal="isfinal" :editId='resumeId' :resume="resume" />
        </div>
        <div>

          <div>
                 <div class="spacer-bottom"></div>
                 <div class="head-line">
                     <div>
                     <Icon size="30" color="#1688fe"  type="md-checkbox-outline" />
                     </div>

                     <div class="second-heading">Employment History</div>
                 </div>

              </div>

           <Experiance :experiance="experiance" :resumeId="resumeId" v-on:expData="experianceData($event)" ></Experiance>
       </div>


       <div>
            <div>
                 <div class="spacer-bottom"></div>
                 <div class="head-line">
                     <div>
                         <Icon size="30" color="#1688fe" type="ios-school" />
                     </div>

                     <div class="second-heading">Education</div>
                  </div>

            </div>

            <Education :education="education" :resumeId="resumeId" v-on:eduData="geteducationData($event)" ></Education>
       </div>

       <div>
          <div>
               <div class="spacer-bottom"></div>
               <div class="head-line">
                   <div>
                       <Icon size="30" color="#1688fe" type="md-ribbon"  />
                   </div>

                   <div class="second-heading">Skills</div>
                </div>

            </div>


            <Skill :skill="skill" :resumeId="resumeId" v-on:skillData="skillData($event)" ></Skill>   
       </div>
       <div>

           <div>
             <br>
             <div class="spacer-bottom"></div>
             <div class="head-line">
                 <div>
                     <Icon size="30" color="#1688fe" type="md-clipboard"  />
                 </div>

                 <div class="second-heading">Professional Summary</div>
              </div>

          </div>


           <Summary :summary="summary" :resumeId="resumeId" v-on:summaryData="getSummary($event)" ></Summary> 
       </div>
       <div>


        <div>
             <br>
             <div class="spacer-bottom"></div>
             <div class="head-line">

                 <div class="second-heading">add blocks</div>
              </div>

          </div>



           <Custom :custom="custom" :resumeId="resumeId" v-on:customData="getCustomData($event)" ></Custom> 
       </div>

       <br />

    

       <div class="button-wrap">
                <router-link :to="`/resumes/${resumeId}/${templete}/download`"><Button type="primary">next to download  <Icon type="md-arrow-round-forward" /></Button></router-link>
        </div>
       </div>
</template>
<script>

  import { jsPDF } from 'jspdf'
  import html2canvas from 'html2canvas';
    import Axios from 'axios'
    import Education from "./Education.vue";
    import CreateResume from "./CreateResume.vue"
    import Experiance from "./Experiance.vue";
    import Skill from "./Skill.vue";
    import Summary from "./Summary";
    import Custom from "./Custom";
    import ShowResume from "./showResume"

    export default {
         props:['resumeId','education','experiance','skill','custom','summary','templete', 'resume'],
        components: {
            Education,
            Experiance,
            Skill,
            Summary,
            Custom,
            CreateResume
        },
        data () {
            return {
            isfinal:true,
               notFinalize:false,
               resume:{},
               isGetExpData:[],
               experiances:{},
               educations:{},
               educationData:[],
               skills:{},
               skillDatas:[],
               summariesData:[],
               summaries:{},
               customDatas:[],
               isTemplete:false,
               customs:{},
            }
        },
     

  

        mounted() {
            // this.getData()
        },

        methods: {
            getData() {
                this.$emit("finalData", this.resume);
            },

        dwonload() {
             var doc = new jsPDF();
              var margins = {
                  top: 80,
                  bottom: 60,
                  left: 40,
                  width: 522
              };
      
              doc.fromHTML(this.$refs.content, margins.left, margins.top,{
                'width' : margins.width
              });
              
              doc.save('test.pdf');



            },


            experianceData(expData) {
                this.resume = expData
                this.getData()
            },

            geteducationData(eduData) {
                this.resume = eduData
                this.getData()

            },

            skillData(skillData) {
                this.resume = skillData
                this.getData()
            },

            getSummary(summaryData) {
                this.resume = summaryData
                this.getData()
            },
            getCustomData(customData) {
                this.resume = customData
                 this.getData()
            },
            chooseTemplet() {
                this.isTemplete = true
            }
       
       
        }
    }
</script>

<style>


    .color-white {
        color:#fff;
    }

    .demo-upload-list{
        display: inline-block;
        width: 60px;
        height: 60px;
        text-align: center;
        line-height: 60px;
        border: 1px solid transparent;
        border-radius: 4px;
        overflow: hidden;
        background: #fff;
        position: relative;
        box-shadow: 0 1px 1px rgba(0,0,0,.2);
        margin-right: 4px;
    }
    .demo-upload-list img{
        width: 100%;
        height: 100%;
    }
    .demo-upload-list-cover{
        display: none;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,.6);
    }
    .demo-upload-list:hover .demo-upload-list-cover{
        display: block;
    }
    .demo-upload-list-cover i{
        color: #fff;
        font-size: 20px;
        cursor: pointer;
        margin: 0 2px;
    }
</style>



