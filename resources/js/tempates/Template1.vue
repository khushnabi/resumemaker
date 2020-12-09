<template>
    <div>
        <div>
           <div>

                <div>
                    <h1>resume</h1>
                    <h1>first_name: {{resumes.first_name}}</h1>
                    <h1>Last name : {{resumes.last_name}}</h1>
                    <p>address: {{resumes.address}}</p>
                    <p>city: {{resumes.city}}</p>
                    <p>postal code: {{resumes.postal_code}}</p>
                    <p>phone: {{resumes.phone}}</p>
                    <p> email: {{resumes.email}}</p>
                </div>
                   
                <div v-if="resumes.experiences.length>0">
                        <hr />
                        <h2>experiance</h2>
                    <div v-for="(exp, i) in resumes.experiences" :key="i">
                    <h5> {{exp.job_title}}</h5>
                        <p> {{exp.employer}}</p>
                        <p> {{exp.city}}</p>
                        <p> {{exp.start_at}} {{exp.work_here && "present" || exp.end_at}}</p>
                        <p>{{exp.description}}</p>
                        
                    </div>
                </div>
            
                <div v-if="resumes.educations.length">
                    <hr>
                    <h3>educations</h3>
                    <div v-for="(edu, i) in resumes.educations" :key="i">
                        <h3>{{edu.school}}</h3>
                        <p>{{edu.degree}}</p>
                        <p>{{edu.city}}</p>
                        <p>{{edu.graduated_at}}</p>
                        <p>{{edu.description}}</p>
                            
                    </div>
                </div>
                
                <div v-if="resumes.skills.length>0">
                    <hr />
                    <h4>skills</h4>
                    <div v-for="(ski, i) in resumes.skills" :key="i">
                        <h5>{{ski.skill}}</h5>
                        <p>{{ski.level}}</p>
                    </div>
                </div>
    
                <div v-if="resumes.summaries.length>0">
                    <hr />
                    <h4>summary</h4>
                    <div v-for="(sum, i) in resumes.summaries" :key="i">
                        <h3>{{sum.summary}}</h3>
                    </div>
                </div>

                <div v-if="resumes.customs.length">
                    <hr />
                        <h4>Customs</h4>
                    <div v-for="(custom, i) in resumes.customs" :key="i">
                        <h3>{{custom.name}}</h3>
                        <p>{{custom.start_at}}</p>
                    </div>
                </div>
                    
            </div>
        </div>
    </div>
</template>

<script>
import Axios from 'axios';
export default {
    data() {
        return {
            id:this.$route.params.id,
            resumes:[]
        }
    },

     async mounted() {
           const { data } = await Axios.get('/api/resumes/'+this.id+'');
           this.resumes = data;
            console.log(this.resumes.experiences)
            console.log(this.resumes.educations)
            console.log(this.resumes.skills)
            console.log(this.resumes.summaries)
            console.log(this.resumes.customs)
            
        },
}
</script>