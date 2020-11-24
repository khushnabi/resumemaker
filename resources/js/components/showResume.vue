<template>
    <div>
           
        <div>
            <h1>resume</h1>
            <h1> {{resumeContent.first_name}}</h1>
        </div>
          
        <div v-if="expContent.job_title || isGetExpData.length>0">
            <hr />
            <h2>experiance</h2>
            <div v-if="isGetExpData.length>0">
                <div v-for="(exp, i) in isGetExpData" :key="i">
                    {{exp.job_title}}
                </div>
            </div>
            {{expContent.job_title}}
        </div>
           
        <div v-if="educations.school || educationData.length>0">
            <hr>
             <h3>educations</h3>

            <div v-if="educationData.length>0">
               <div v-for="(edu, i) in educationData" :key="i">
                   {{edu.school}}
               </div>
            </div>
           
            {{educations.school}}
        </div>

        <div>
            
        </div>

        <div v-if="skills.skill || skillDatas.length>0">
            <hr />
            <h4>skills</h4>
             <div v-if="skillDatas.length>0">
               <div v-for="(ski, i) in skillDatas" :key="i">
                   {{ski.skill}}
               </div>
            </div>
            
            {{skills.skill}}
        </div>


           
          <div v-if="summaries.summary || summariesData.length>0">
            <hr />
            <h4>skills</h4>
             <div v-if="summariesData.length>0">
               <div v-for="(sum, i) in summariesData" :key="i">
                   {{sum.summary}}
               </div>
            </div>
            
            {{summaries.summary}}
        </div>

        
    </div>
</template>    

<script>
export default {
    props:{
        resumeContent:Object,
        expContent:Object,
        isGetExpData:Array,
        educations:Object,
        educationData:Array,
        skills:Object,
        skillDatas:Array,
        summaries:Object,
        summariesData:Array
    },
    data() {
        return {
         
        }
    } ,


    methods: {
    
             
    }  
}
</script>