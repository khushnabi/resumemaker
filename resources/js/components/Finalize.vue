<template>
    <div>
      
       <div>
           <Experiance  :experiance="experiance" :resumeId="resumeId" v-on:expData="experianceData($event)" ></Experiance>
       </div>
       <hr />
       <div>
            <Education :education="education" :resumeId="resumeId" v-on:eduData="geteducationData($event)" ></Education>
       </div>
          <hr />
       <div>
            <Skill :skill="skill" :resumeId="resumeId" v-on:skillData="skillData($event)" ></Skill>   
       </div>
           <hr />
       <div>
           <Summary :summary="summary" :resumeId="resumeId" v-on:summaryData="getSummary($event)" ></Summary> 
       </div>
        <hr />
       <div>
           <Custom :custom="custom" :resumeId="resumeId" v-on:customData="getCustomData($event)" ></Custom> 
       </div>

        <div>
            <Button type="primary" @click="chooseTemplet()">choose templete</Button>
            <div v-if="isTemplete"><router-link to="resumes/:templete1">templete1</router-link></div>
        </div>


          

       </div>
</template>
<script>
    import Education from "./Education.vue";
    import Experiance from "./Experiance.vue";
    import Skill from "./Skill.vue";
    import Summary from "./Summary";
    import Custom from "./Custom"

    export default {
         props:['resumeId','education','experiance','skill','custom','summary'],
        components: {
            Education,
            Experiance,
            Skill,
            Summary,
            Custom
        },
        data () {
            return {
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



