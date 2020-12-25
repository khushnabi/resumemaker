<template>
    <div>
        <div>
            <h1>from another show method</h1>
          <router-link to="/resumes"><h1><Icon type="md-close" /></h1></router-link>
           <div v-if="resume.id">
               <router-link :to="`/resumes/${resume.id}`">view the resume page</router-link>
           </div>
              <div>
                <h1>Resume</h1>
                <h1 v-if="resume.first_name">first_name: {{resume.first_name}}</h1>
                <h1 v-if="resume.last_name">Last name : {{resume.last_name}}</h1>
                <p v-if="resume.address">address: {{resume.address}}</p>
                <p v-if="resume.city">city: {{resume.city}}</p>
                <p v-if="resume.postal_code">postal code: {{resume.postal_code}}</p>
                <p v-if="resume.phone">phone: {{resume.phone}}</p>
                <p v-if="resume.email"> email: {{resume.email}}</p>
            </div>

            <div v-if="resume.experiences.length || experianceData.job_title">
                <hr />
                <h2>experiance</h2>
                <div :key="experience.id" v-for="experience in resume.experiences">
                    <h3> {{experience.job_title}}</h3>
                    <p> {{experience.employer}}</p>
                    <p> {{experience.city}}</p>
                    <p> {{experience.start_at}} {{experience.start_at}} {{ experience.work_here && "present" || experience.end_at}}</p>
                    <p>{{experience.description}}</p>
                </div>
                
                <div>
                   <h3>{{experianceData.job_title}}</h3>
                   <p> {{experianceData.employer}} </p>
                   <p> {{experianceData.city}} </p>
                    <p> {{experianceData.start_at}} {{experianceData.start_at}} {{ experianceData.work_here && "present" || experianceData.end_at}}</p>
                    <p>{{experianceData.description}}</p>
                </div>
            </div>

            <div v-if="resume.educations.length||educationData.school">
                <hr>
                <h3>educations</h3>
                <div :key="education.id" v-for="education in resume.educations">
                    <h3>{{education.school}}</h3>
                    <p>{{education.degree}}</p>
                    <p>{{education.city}}</p>
                    <p>{{education.graduated_at}}</p>
                    <p>{{education.description}}</p>
                </div>
                    <h3>{{educationData.school}}</h3>
                    <p>{{educationData.degree}}</p>
                    <p>{{educationData.city}}</p>
                    <p>{{educationData.graduated_at}}</p>
                    <p>{{educationData.description}}</p>
            </div>
            <div v-if="resume.skills.length || skillData.skill">
                <hr />
                <h4>skills</h4>
                <div :key="skill.id" v-for="skill in resume.skills">
                    <h5>{{skill.skill}}</h5>
                    <p>{{skill.level}}</p>
                </div>
               <h5>{{skillData.skill}}</h5>
                <p>{{skillData.level}}</p>
            </div>

            <div v-if="resume.summaries.length || summaryData.summary">
                <hr />
                <h4>Summary</h4>
                <div :key="summary.id" v-for="summary in resume.summaries">
                    <h3>{{summary.summary}}</h3>
                </div>
                <h3>{{summaryData.summary}}</h3>
            </div>
            <div v-if="resume.customs.length||customData.name">
                <hr />
                <h4>custom</h4>
                <div :key="field.id" v-for="field in resume.customs">
                    <h3>{{field.name}}</h3>
                    <p>{{field.start_at}}</p>
                </div>
                <div>
                    <h3>{{customData.name}}</h3>
                    <p>{{customData.start_at}}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [ "resume", 'experiance','education','skill','summary','custom' ],
    data() {
        return {
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

    methods: {
    }
}
</script>
