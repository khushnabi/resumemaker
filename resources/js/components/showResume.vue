<template>
    <div >


        <div v-if="selectTemp" class="container">

            <button @click="selectTemplete('template1')">Template1</button>
            <button @click="selectTemplete('template2')">Template2</button>
            
        </div>
        <div>
            <component 
                  :is='templete' :resume='resume' :experiance='experianceData':education='educationData'
                  :skill='skillData' :summary="summaryData" :custom="customData">
            </component>
        </div>
        
        <!-- <Another
          /> -->

    </div>
</template>

<script>

import Template1 from "../tempates/Template1";
import Template2 from "../tempates/Template2";
export default {
    props: ["resume", 'templete', 'experiance','education','skill','summary','custom'],
    components: {
     'template1':Template1,
     'template2':Template2
     

      },
    data() {
        return {
            selectTemp:true,
            experianceData:this.experiance||{},
            educationData:this.education||{},
            skillData:this.skill||{},
            summaryData:this.summary||{},
            customData:this.custom||{},
            isGetExpData: {},
        //    experiences: this.resume?.experiences ?? [],
        //    educations: this.resume?.educations ?? [],
           fields: [],
           skills: [],
           summaries: []
        }
    },


    mounted() {
        if(this.$route.path ==='/resumes/templates') {
            this.selectTemp = true
            console.log("i am comming from route")
        } else {
            this.selectTemp = false
            console.log("i am comming from component")
        }
        

    },

    methods: {
        selectTemplete(templete) {
            console.log(templete)

            this.selectTemp = false
            this.$router.push(`/resumes/${templete}/create`);
        }
    }

   
}
</script>
