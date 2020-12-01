<template>
    <div>

       

       <div>
           Experiance
           <Experiance  :notFinalize="notFinalize" :resume_data="resume_data" v-on:expData="experianceData($event)" ></Experiance>
       </div>
       <hr />
       <div>
           Education
            <Education  :notFinalize="notFinalize" :resume_data="resume_data" v-on:eduData="geteducationData($event)" ></Education>
       </div>
          <hr />
       <div>
           Skill
            <Skill  :notFinalize="notFinalize" :resume_data="resume_data" v-on:skillData="skillsData($event)" ></Skill>   
       </div>
           <hr />
       <div>
           <Summary :notFinalize="notFinalize" :resume_data="resume_data" v-on:summaryData="getSummary($event)" ></Summary> 
       </div>
        <hr />
       <div>
           <Custom :notFinalize="notFinalize" :resume_data="resume_data" v-on:customData="getCustomData($event)" ></Custom> 
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
         props:['resume_data'],
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
                this.$emit("finalData", [this.experiances, this.isGetExpData, this.educationData, this.educations, this.skills, this.skillDatas, this.summaries, this.summariesData, this.customs, this.customDatas]);
            },

        
            experianceData(expData) {
                this.experiances = expData[0]
                this.isGetExpData = expData[3]
                this.getData()
            },

            geteducationData(eduData) {
                this.educations = eduData[0]
                this.educationData = eduData[2]
                this.getData()

            },

            skillsData(skillData) {
                this.skills = skillData[0];
                this.skillDatas = skillData[1];
                this.getData()
            },

            getSummary(summaryData) {
                 this.summaries = summaryData[0];
                this.summariesData = summaryData[1];
                this.getData()
            },
            getCustomData(customData) {
                console.log("customs data")
                this.customs = customData[0];
                this.customDatas = customData[1]
                console.log(this.customDatas)
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



