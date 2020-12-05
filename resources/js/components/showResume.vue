<template>
    <div>
        <div>
            {{resume.id}}
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

            <div v-if="experiences.length">
                <hr />
                <h2>experiance</h2>
                <div :key="experience.id" v-for="experience in experiences">
                    <h3> {{experience.job_title}}</h3>
                    <p> {{experience.employer}}</p>
                    <p> {{experience.city}}</p>
                    <p> {{experience.start_at}} {{experience.start_at}} {{ experience.work_here && "present" || experience.end_at}}</p>
                    <p>{{experience.description}}</p>
                </div>
            </div>

            <div v-if="educations.length">
                <hr>
                <h3>educations</h3>
                <div :key="education.id" v-for="education in educations">
                    <h3>{{education.school}}</h3>
                    <p>{{education.degree}}</p>
                    <p>{{education.city}}</p>
                    <p>{{education.graduated_at}}</p>
                    <p>{{education.description}}</p>
                </div>
            </div>
            <div v-if="skills.length">
                <hr />
                <h4>skills</h4>
                <div :key="skill.id" v-for="skill in skills">
                    <h5>{{skills.skill}}</h5>
                    <p>{{skills.level}}</p>
                </div>
            </div>
            <div v-if="summaries.length">
                <hr />
                <div :key="summary.id" v-for="summary in summaries">
                    <h3>{{summaries.summary}}</h3>
                </div>
            </div>
            <div>Address of resume {{resume.address}}</div>
            <div v-if="fields.length">
                <hr />
                <h4>Fields</h4>
                <div :key="field.id" v-for="field in fields">
                <h3>{{field.name}}</h3>
                <p>{{field.start_at}}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [ "resume" ],
    data() {
        return {
            experiance: {},
            isGetExpData: {},
           experiences: this.resume?.experiences ?? [],
           educations: this.resume?.educations ?? [],
           fields: [],
           skills: [],
           summaries: []
        }
    },

    methods: {
    }
}
</script>
