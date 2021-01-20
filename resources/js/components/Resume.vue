<template>
    <div v-if="hasError" class="container">
        <Alert type="error">
            Something went wrong
            <span slot="desc">{{this.error}}</span>
        </Alert>
    </div>
   
   <div v-else class="bg-color">
    <div class="spacer"></div>
    <div  class="container ">

        <div>
            <div>
                <div class="dashboard">
                    <div>
                        <h1>Dashboard</h1>
                    </div>
                   
                </div>
                <h2 class="dasboard-resume">Resumes</h2>

                <div class="display-flex">
                        <div class="bold-line"></div>
                     <div>
                        <router-link :to="`/resumes/templates`"><button class="create-new">Create new</button></router-link>
                    </div>
                </div>

                <div class="show-resumes">
                        <div v-for="(resume, i) in resumeDatas" :key="i">
                            <div>
                                <Card style="width:520px">
                                    
                                 <div class="display-flex">
                                     <router-link :to="`/resumes/${resume.id}/edit`">

                                     <div :class="`${resume.templete} display-flex resumes`">

                                        <div class="sideBar">

                                            <div style=" margin-bottom: 15px;"  v-if="resume.profile_img" class="text-center">
                                                <img class="img" :src="`${resume.profile_img}`">
                                            </div>

                                            <div  v-if="resume.summaries.length">
                                                <h3 class="uppercase text " style="color:#fff;">About me</h3>
                                                <div class="little-spacer">
                                                    
                                                </div>
                                                 <div :key="summary.id" v-for="summary in resume.summaries">
                                                    <p class="summary-para para" style="color:rgb(255 255 255 / 79%); letter-spacing:0.5px" >{{summary.summary}}</p>
                                                </div>

                                            </div>
                                            
                                        </div>

                                        <div class="article">

                                        <div class="prifile-section">
                                            <div class="head-section">
                                                <h2 :class="`big-heading`" v-if="resume.first_name||resume.last_name">{{resume.first_name}} {{resume.last_name}}</h2>
                                            </div>

                                            <div>

                                                <div v-if="resume.address" class="display-flex">
                                                    <div>
                                                        <div class="icon-round">
                                                            <Icon type="ios-pin" color='white' :size="5" />
                                                        </div>
                                                    </div>
                                                    <div class="text-section">
                                                        <p :class="`para `" v-if="resume.address">{{resume.address}},  {{resume.city}}, {{resume.postal_code}}</p>
                                                        
                                                    </div>
                                                </div>
                                                <div v-if="resume.phone" class="display-flex">
                                                    <div class="icon-round">
                                                         <Icon :size="5"  color='white' type="md-call" />
                                                    </div>
                                                    <div class="text-section">
                                                      <p :class="`para `"  v-if="resume.phone">{{resume.phone}}</p>
                                                        
                                                    </div>
                                                </div>
                                                  <div v-if="resume.email" class="display-flex">
                                                    <div class="icon-round">
                                                        <Icon  :size="5"  color='white' type="ios-mail" />
                                                    </div>
                                                    <div class="text-section">
                                                        <p :class="`para `" v-if="resume.email">{{resume.email}}</p>
                                                        
                                                    </div>
                                                </div>
                                              
                                            </div>

                                        </div>

                                        <div class="experience">
                                            <div v-if="resume.experiences.length">
                                                <div class="display-flex headline">
                                                    <div class="dot">
                                                    
                                                    </div>
                                                    <div :class="`text `">
                                                       <p> Experiances</p>
                                                    </div>
                                                    <div class="line">
                                                      
                                                    </div>
                                                </div>

                                                <div>
                                                    
                                                    <div :key="experience.id" v-for="experience in resume.experiences">
                                                       <div class="display-flex">
                                                            <div class="expLoca">
                                                                <p :class="`title uppercase`"> {{experience.employer}}</p>
                                                                <p :class="`para `"> {{experience.city}}</p>
                                                                <p :class="`para `"> {{experience.start_at}} - {{ experience.work_here && "present" || experience.end_at}}</p>
                                                            </div>
                                                            <div class="expJob">
                                                                 <p :class="`title`"> {{experience.job_title}}</p>
                                                                 <p :class="`para`">{{experience.description}}</p>
                                                            </div>
                                                       </div>
                                                        
                                                    </div>

                                                </div>
                                           
                    </div>
                </div>


                <div class="education">
                    <div v-if="resume.educations.length">
                         <div class="display-flex headline">
                            <div class="dot">
                            
                            </div>
                            <div :class="`text `">
                               <p> Education</p>
                            </div>
                            <div class="line">
                              
                            </div>
                        </div>

                         <div>
                             <div  class="display-flex" :key="education.id" v-for="education in resume.educations">
                                <div class="eduschool">
                                    <p :class="`title uppercase`"> {{education.school}}</p>
                                    <p :class="`para `"> {{education.city}}</p>
                                     <p :class="`para `"> {{education.graduated_at}}</p>
                                </div>
                                <div class="eduDegree">
                                     <p :class="`title ` "> {{education.degree}}</p>
                                     <p :class="`para `">{{education.description}}</p>
                                </div>
                             </div>

                        </div>

                    </div>
                </div>

                <div class="skill" v-if="resume.skills.length">
                     <div class="display-flex headline">
                        <div class="dot">
                        
                        </div>
                        <div :class="`text`">
                           <p>Skill</p>
                        </div>
                        <div class="line">
                          
                        </div>
                    </div>

                    <div class="progress-container">
                        <div class="skillData" :key="skill.id" v-for="skill in resume.skills">
                            <p class="para  uppercase"> {{skill.skill}}</p>
                            <div  v-if="skill.level" class="progress-bar">
                                <div :class="`progress ${skill.level}`"> 
                                </div>

                            </div>
                        </div>

                         
                            
                    </div>

                    
                </div>
           
                <div >

                </div>
            </div>

            </div> 

                                     </router-link>

                                 <div>
                        <div class="edit-section">
                            <p class="resume-title">{{resume.first_name}}</p>

                            <p class="created">
                                 <span v-if="resume.created_at">created {{timeFormate(resume.created_at)}}</span>
                                 <span v-else="resume.updated_at">updated {{timeFormate(resume.updated_at)}}</span>
                            </p>
                            <div class="edit">

                                <router-link :to="`/resumes/${resume.id}/edit`"><Icon size="18" color="rgb(40, 43, 50)" type="md-create" />Edit</router-link>
                            </div>
                            <div class="download">

                                <router-link :to="`/resumes/${resume.id}/${resume.templete}/download`"> <Icon size="18" color="rgb(40, 43, 50)"  type="md-download" />Download Pdf</router-link>


                                 
                            </div>

                            <div @click="copyContent(resume)" class="delete">
                                <Icon size="18" color="rgb(40, 43, 50)" type="md-copy" /> Duplicate
                            </div>

                            <div class="delete">
                                <div type="error" @click="isDeleted(resume, i)"> <Icon size="18" color="rgb(40, 43, 50)"  type="ios-trash" /> Delete</div>
                            </div>

                        </div>

                        <Modal v-model="isDeletedModel" width="360">
                            <p slot="header" style="color:#f60;text-align:center">
                                <Icon type="ios-information-circle"></Icon>
                                <span>Delete confirmation</span>
                            </p>
                            <div style="text-align:center">
                                <p>{{delete_data.first_name}} will be deleted</p>
                                <p>Will you delete it?</p>
                            </div>
                            <div slot="footer">
                                <Button type="error" size="large" long  @click="onDelete(delete_data, delete_data.id, index) " :loading="resume.isDeleting" :disabled="resume.isDeleting">Delete</Button>
                            </div>
                        </Modal>
                    </div>
                </div>

                    </Card>
                </div>
            <br />
        </div>

           
         
            </div>
          </div>
        </div>
    </div>

   </div>
</template>

<script>
import moment from'moment';
import Axios from "axios";
import ShowResume from "./showResume";
export default {
    components:{
      ShowResume
    },
    data () {
        return {
            hasError: false,
            resumeDatas:{},
            isDeletedModel:false,
            index:1,
            editId:null,
            isCreating:false,
            delete_data:{},
        }

    },
   async mounted() {
       console.log(this.a)
       this.a = "hellow world";
      
        console.log("hellow from resume")
        await this.getResumeData();

    },
    methods: {

        async copyContent(resume) {


              try {
                this.isHeadinSend = true
                const { data } = await Axios.post('/api/resumes',resume);
                resume.experiences.forEach(async(exp) => { 
                     const {ex} = await Axios.post(`/api/resumes/${data.id}/experiences`, exp);
                })

                 resume.educations.forEach(async(edu) => { 
                     const res = await Axios.post(`/api/resumes/${data.id}/educations`,edu);

                })

                   resume.skills.forEach(async(skill) => { 
                     const res = await Axios.post(`/api/resumes/${data.id}/skills`,skill);

                })

                 resume.summaries.forEach(async(summary) => { 
                     const res = await Axios.post(`/api/resumes/${this.resumeId}/summaries`,summary);

                })

                  resume.customs.forEach(async(custom) => { 
                     const res = await Axios.post(`/api/resumes/${this.resumeId}/customs`,custom);

                })



                this.getResumeData()
                this.$Message.success('duplicated!');
            } catch(err) {
                this.$Message.error('Fail!');
            }
        },

        timeFormate(time) {
            return moment(String(time)).format('Do MMMM, ddd ')
        },

        async getResumeData() {
            try {
                
                const { data } = await Axios.get("/api/resumes");
                console.log(data)
                this.resumeDatas = data;
                
            } catch(err) {
                this.hasError = true;
                this.error = err.message;
            }
        },

        isDeleted(resume, index) {
            this.delete_data=resume;
            this.index=index
            this.isDeletedModel = true
        },

      async onDelete(resume, id, index) {
                this.$set(resume, "isDeleting", true)
                console.log(id)
                const { data } = await Axios.delete(`/api/resumes/${id}`);
                console.log(data)
                this.resumeDatas.splice(index, 1)
                this.$Message.success(resume.first_name + ' is deleted!');
                this.isDeletedModel = false

           
        }


    },

}
</script>

<style scope>

    .bold-line {
       width: 94%;
        background: rgb(202, 209, 217);
        border-radius: 2.5px;
        height: 5px;
        margin-top: 24px;
    }
    
    .dasboard-resume {
           font-size: 18px;
        line-height: normal;
        margin-bottom: -17px;
        text-transform: capitalize;
        color: rgb(0, 135, 193);
        margin-top: 2rem;
        margin-left: 0rem;
    }

    .create-new {
        width: auto;
        will-change: box-shadow;
        display: inline-block;
        vertical-align: middle;
        margin-bottom: 0px;
        font-weight: bold;
        letter-spacing: normal;
        text-align: center;
        text-transform: uppercase;
        cursor: pointer;
        touch-action: manipulation;
        height: 55px;
        border: 1px solid rgb(0, 135, 193);
        background: rgb(0, 135, 193);
        color: rgb(255, 255, 255);
        transition: all 0.2s ease 0s;
        min-width: 180px;
        border-radius: 27.5px;
        padding: 15px 20px;
        font-size: 14px;
        line-height: normal;
    }

    .create-new:hover {
        border-color: rgb(26, 88, 133);
        background: rgb(26, 88, 133);
        color: rgb(255, 255, 255);
    }

    .container {
        width: 80%;
        margin: auto;
    }

    .dashboard {
        display: flex;
        justify-content: space-between;
    }

    .dashboard h1 {
            font-size: 37px;
            color: rgb(40, 43, 50);
            line-height: 42px;
            letter-spacing: -1px;
    }

    .primary {
        margin-top: 33px;
         padding: 1rem 2rem 1rem 2rem;
        border: none;
        color: #fff;
        border-radius: 27px;
        text-transform: uppercase;
        font-size: 12px;
        font-weight: bolder;
        box-shadow: 1px 1px 1px;
           border: 1px solid rgb(0, 135, 193);
    background: rgb(0, 135, 193);
        outline: none;
    }

    .primary:hover {
            border-color: rgb(26, 88, 133);
       background: rgb(26, 88, 133);
        color: rgb(255, 255, 255);
    }

    .datas {
        flex: 1;
        border-left: 1px solid black;
    }
    .forms {
        flex: 1;
    }

    .show-resumes > div{
       display: inline-block;
       margin-left: 1rem;
       margin-top: 1rem;
    }

    .image{
        width: 40%;
        height:40%;
    }



    .resumes {
               position: relative;
    height: inherit;
      min-height: 350.263px;
    width: 300px;
    background: #fff;
    border-radius: 3px;
    box-shadow: 0px 9px 9px 4px rgb(0 0 0 / 8%);
    }

    .resumes .img {
        width:40px;
        height:40px;
    }

.resumes .sideBar {
        width:40%;
        padding: 1.6rem 0.5rem;
       
        height: inherit;
        min-height: 195.525px;
    }

.resumes .big-heading {
    font-size:12px
}

.resumes .para {
    font-size:5px;
}

.resumes .icon-round {
         margin: 0px 0px 2px 0px;
    width: 10px;
    height: 10px;
    padding: 0px 0px 0px 2px;
    line-height: 3.5px;
}

.resumes .text {
font-size: 7px;
margin-top:-4px;
}

.resumes .title {
    font-size:7px
}

.resumes .article {
    padding: 1.5rem 0.6rem
}

.resumes .headline {
    padding: 1rem 0rem 0.5rem 0rem;
}

.resumes .expLoca {
    width: 40%;
    padding: 8px 11px 0rem 0px;
}

.resumes .dot {
    width: 5px;
    height: 4px;
    border-radius: 50%;
    margin-right: 2px;
    margin-top: -1px;
}

.resumes .skill .dot {
    width: 4px;
    height: 3px;
}


.resumes .expJob {
   padding: 0.5rem 0px 0rem 13px;
}

.resumes .expJob::before {
    content: "";
    width: 4px;
    height: 4px;
    position: absolute;
    background-color: #434244ba;
    border-radius: 51%;
   
    margin-left: -15.8px;
}

.resumes .expJob::after {
    content: "";
    position: absolute;
    background-color: #434244ba;
    border-radius: 51%;
     width: 4px;
    height: 4px;
     margin-top: -25px;
     margin-left: -15.8px;
     }


.resumes .eduschool {
    width: 40%;
    padding: 8px 11px 0rem 0px;
}

.resumes .eduDegree {
    padding: 0rem 0px 0rem 13px;
}

.bg-color {
    background-color:#f0f0f2
}

.ivu-card {
  background-color:#f0f0f2 !important   
}


.resumes .eduDegree::after {
    content: "";
    border-radius: 51%;
    position: absolute;
    background-color: #434244ba;
    width: 4px;
    height: 4px;
    margin-top: -19px;
    margin-left: -15px;
}


.edit-section {
       padding: 24px 29px;
}

.edit {
    
    margin-top: 23px;

}

.edit a {
     position: relative;
    font-size: 15px;
    font-weight: 600;
    font-stretch: normal;
    font-style: normal;
    line-height: normal;
    letter-spacing: normal;
    color: rgb(40, 43, 50);
    margin-bottom: 13px;

}

.download {
     margin-top: 10px;
    
}

.download a {
     position: relative;
    font-size: 15px;
    font-weight: 600;
    font-stretch: normal;
    font-style: normal;
    line-height: normal;
    letter-spacing: normal;
    color: rgb(40, 43, 50);
}


.delete {
    margin-top: 10px;
     position: relative;
    font-size: 15px;
    font-weight: 600;
    font-stretch: normal;
    font-style: normal;
    line-height: normal;
    letter-spacing: normal;
    color: rgb(40, 43, 50);
}

.created {
       margin-top: -7px;
    margin-bottom: 13px;
    color: rgb(152, 156, 175);
    font-size: 10px;
    /* line-height: normal; */
    font-weight: 500;
    letter-spacing: normal;
    padding-right: 0px;
}

.resume-title {
    position: relative;
    font-size: 20px;
    font-weight: 600;
    font-stretch: normal;
    font-style: normal;
    line-height: normal;
    letter-spacing: normal;
    color: rgb(40, 43, 50);
    margin-bottom: 9px;

}

.spacer{
    padding-top:4rem;
}

</style>
