<template>
    <div>
        <div>
            {{resumeContent.id}}
           <div v-if="resumeContent.id">
               <router-link :to="`/resumes/${resumeContent.id}`">view the resume page</router-link>
           </div>

              <div>
                <h1>resume</h1>
                <h1 v-if="resumeContent.first_name">first_name: {{resumeContent.first_name}}</h1>
                <h1 v-if="resumeContent.last_name">Last name : {{resumeContent.last_name}}</h1>
                <p v-if="resumeContent.address">address: {{resumeContent.address}}</p>
                <p v-if="resumeContent.city">city: {{resumeContent.city}}</p>
                <p v-if="resumeContent.postal_code">postal code: {{resumeContent.postal_code}}</p>
                <p v-if="resumeContent.phone">phone: {{resumeContent.phone}}</p>
                <p v-if="resumeContent.email"> email: {{resumeContent.email}}</p>
            </div>
            
            <div v-if="expContent.job_title || isGetExpData.length>0">
                <hr />
                <h2>experiance</h2>
                <div v-if="isGetExpData.length>0">
                    <div v-for="(exp, i) in isGetExpData" :key="i">
                    <h5> {{exp.job_title}}</h5>
                        <p> {{exp.employer}}</p>
                        <p> {{exp.city}}</p>
                        <p> {{exp.start_at}} {{exp.work_here && "present" || exp.end_at}}</p>
                        <p>{{exp.description}}</p>
                        
                    </div>
                </div>
                <h3> {{expContent.job_title}}</h3>
                <p> {{expContent.employer}}</p>
                <p> {{expContent.city}}</p>
                <p> {{expContent.start_at}} {{expContent.start_at}} {{expContent.work_here && "present" || expContent   .end_at}}</p>
                <p>{{expContent.description}}</p>
            </div>
            
            <div v-if="educations.school || educationData.length>0">
                <hr>
                <h3>educations</h3>
                <div v-if="educationData.length>0">
                <div v-for="(edu, i) in educationData" :key="i">
                    <h3>{{edu.school}}</h3>
                    <p>{{edu.degree}}</p>
                    <p>{{edu.city}}</p>
                    <p>{{edu.graduated_at}}</p>
                    <p>{{edu.description}}</p>
                        
                </div>
                </div>
                    <h3>{{educations.school}}</h3>
                    <p>{{educations.degree}}</p>
                    <p>{{educations.city}}</p>
                    <p>{{educations.graduated_at}}</p>
                    <p>{{educations.description}}</p>
            </div>


            <div v-if="skills.skill || skillDatas.length>0">
                <hr />
                <h4>skills</h4>
                <div v-if="skillDatas.length>0">
                <div v-for="(ski, i) in skillDatas" :key="i">
                    <h5>{{ski.skill}}</h5>
                    <p>{{ski.level}}</p>
                </div>
                </div>
                
                <h5>{{skills.skill}}</h5>
                <p>{{skills.level}}</p>
            </div>

            <div v-if="summaries.summary || summariesData.length>0">
                <hr />
                <h4>summary</h4>
                <div v-if="summariesData.length>0">
                <div v-for="(sum, i) in summariesData" :key="i">
                    <h3>{{sum.summary}}</h3>
                </div>
                </div>
                
            <h3>{{summaries.summary}}</h3>
            </div>


             
            <div v-if="customs.name || customDatas.length>0">
                <hr />
                <h4>Customs</h4>
                <div v-if="customDatas.length>0">
                <div v-for="(custom, i) in customDatas" :key="i">
                    <h3>{{custom.name}}</h3>
                    <p>{{custom.start_at}}</p>
                </div>
                </div>
                
                <h3>{{customs.name}}</h3>
                <p>{{customs.start_at}}</p>
            </div>
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
        summariesData:Array,
        editId:Number,
        customs:Object,
        customDatas:Array
    },
    data() {
        return {
            template1:true,
            expData:[],
            eduData:[],
            skillData:[],
            summaryData:[]
        }
    } ,

  async mounted() {
        this.$emit('template', this.template1)
    
    },

    methods: {
    
             
    }  
}
</script>