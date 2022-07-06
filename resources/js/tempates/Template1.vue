<template>
    <div :class="` ${templete} display-flex ${changeTempleteWidth}`">
            <div class="sideBar">

                <div style=" margin-bottom: 15px;"  v-if="resume.profile_img" class="text-center">
                    <img class="img" :src="`${resume.profile_img}`">
                </div>

                <div  v-if="resume.summaries.length || summaryData.summary">
                    <h3 class="uppercase text " style="color:#fff;">About me</h3>
                    <div class="little-spacer">
                        
                    </div>
                     <div :key="summary.id" v-for="summary in resume.summaries">
                        <p class="summary-para para" style="color:rgb(255 255 255 / 79%); letter-spacing:0.5px" >{{summary.summary}}</p>
                    </div>

                       <p class=" summary-para para" style="color:rgb(255 255 255 / 79%); letter-spacing:0.5px" >{{summaryData.summary}}</p>

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
                                    <Icon type="ios-pin" color='white' :size="iconRoundSize" />
                                </div>
                            </div>
                            <div class="text-section">
                                <p :class="`para `" v-if="resume.address">{{resume.address}},  {{resume.city}}, {{resume.postal_code}}</p>
                                
                            </div>
                        </div>
                        <div v-if="resume.phone" class="display-flex">
                            <div class="icon-round">
                                 <Icon :size="iconRoundSize"  color='white' type="md-call" />
                            </div>
                            <div class="text-section">
                              <p :class="`para `"  v-if="resume.phone">{{resume.phone}}</p>
                                
                            </div>
                        </div>
                          <div v-if="resume.email" class="display-flex">
                            <div class="icon-round">
                                <Icon  :size="iconRoundSize"  color='white' type="ios-mail" />
                            </div>
                            <div class="text-section">
                                <p :class="`para `" v-if="resume.email">{{resume.email}}</p>
                                
                            </div>
                        </div>
                      
                    </div>

                </div>

                <div class="experience">
                    <div v-if="resume.experiences.length || experianceData.job_title">
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
                        <div>
                            
                            <div v-if="experianceData.job_title">
                               <div class="display-flex">
                                    <div class="expLoca">
                                        <p :class="`title uppercase `"> {{experianceData.employer}}</p>
                                        <p :class="`para `"> {{experianceData.city}}</p>
                                        <p :class="`para `"> {{experianceData.start_at}} - {{ experianceData.work_here && "present" || experianceData.end_at}}</p>
                                    </div>
                                    <div class="expJob">
                                         <p :class="`title ` "> {{experianceData.job_title}}</p>
                                         <p :class="`para `">{{experianceData.description}}</p>
                                    </div>
                               </div>
                                
                            </div>

                        </div>
                        
                   
                    </div>
                </div>


                <div class="education">
                    <div v-if="resume.educations.length||educationData.school">
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

                             <div v-if="educationData.school" class="display-flex">
                                <div class="eduschool">
                                    <p :class="`title uppercase ` "> {{educationData.school}}</p>
                                    <p :class="`para `"> {{educationData.city}}</p>
                                     <p :class="`para `"> {{educationData.graduated_at}}</p>
                                </div>
                                <div class="eduDegree">
                                     <p :class="`title` "> {{educationData.degree}}</p>
                                     <p :class="`para`">{{educationData.description}}</p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="skill" v-if="resume.skills.length || skillData.skill">
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

                         <div v-if="skillData.skill" class="skillData">
                            <p class="para  uppercase"> {{skillData.skill}}</p>
                            <div v-if="skillData.level" class="progress-bar">
                                <div :class="`progress ${skillData.level}`"> 
                                </div>

                            </div>
                        </div>
                            
                    </div>

                    
                </div>
           
                <div >

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
    props: ["templete", "resume", 'experiance','education','skill','summary','custom','inShow','changeTemplete','iconSize' ],
    data() {
        return {
            experianceData:this.experiance||{},
            iconRoundSize:this.iconSize||7,
            changeTempleteWidth:this.changeTemplete||'default-templete',
            educationData:this.education||{},
            skillData:this.skill||{},
            summaryData:this.summary||{},
            customData:this.custom||{},
            isGetExpData: {},
            isShow:this.inShow||false,
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

<style>
    
    .text-center {
      text-align:center
    }

    .little-spacer {
        padding-top:10px;
    }

    .template1 {
        background-color:#fff;
        border-radius:4px;
        position: relative;
       
    }


     .default-templete {
         height: inherit;
         min-height: 695.525px;
     }

    .change-templete {
         height: inherit;
         height: 995.525px;
    }


    .default-templete .para {
        font-size: 7.8128px;
        line-height: 11.90952px;
        
    }

    .default-templete .title {
        font-size: 8.5px;

    }



    .default-templete .summary-para {
        margin-top: 3px;
    }

    .default-templete .big-heading {
         font-size: 26.3222px;
          line-height: 26.3222px;
    } 

    .default-templete .text {
        font-size:10px
    }



    .default-templete .icon-round {
         margin: 0px 0px 2px 0px;
        width: 14px;
        height: 15px;
        padding: 0px 0px 0px 3.5px;
       
        line-height: 11px;
    }

    .default-templete .dot {
        width: 7px;
        height: 5px;
      
        margin: 4px 5px 0px 0px;
    }

    .default-templete .expJob::before {
        width: 5px;
        height: 5px;
        margin-left: -1rem;
    }

     .default-templete .expJob::after {
        width: 5px;
        height: 5px;
       
        margin-left: -1rem;
        margin-top: -40px;
    }

    .default-templete .eduDegree::after {
         width: 5px;
        height: 5px;
       
        margin-left: -1rem;
        margin-top: -40px;
    }

    .default-templete .img {
         width: 95px;
         height: 95px;
    }

    .default-templete .line {
         margin: 6px 0px 0px 6px;
    }

    .change-templete .text {
        font-size: 16px;
    }

    .change-templete .line {
        margin: 10px 0px 0px 6px;
    }

     .change-templete .summary-para {
        margin-top: 5px;
    }

    .change-templete .expJob::before {
        width: 6px;
        height: 6px;
         margin-left: -16.4px;
        margin-top: 3px;
    }

    .change-templete .img {
            width: 140px;
    height: 140px;
    }

     .change-templete .eduDegree::after {
        width: 6px;
        height: 6px;
        margin-left: -16.4px;
        margin-top: -63px;
    }


     .change-templete .expJob::after {
            width: 6px;
            height: 6px;
            margin-left: -16.4px;
            margin-top: -63px;
    }


    .change-templete .title {
        font-size: 16px;
        line-height: 28px;
    }

    .change-templete .dot {
        width: 9px;
        height: 7px;
        margin: 7px 5px 0px 0px;
    }

    .change-templete .icon-round {
        margin: 0px 0px 7px 0px;
        width: 22px;
        height: 23px;
        line-height: 20px;  
        padding: 0px 0px 0px 5px;
    }

    .change-templete .para {
        font-size: 12px;
    }

    .change-templete .big-heading{
         font-size: 3em;
        line-height: 1.1em;
    }

    .display-flex {
        display:flex
    }

    .template1 .sideBar {
        width:50%;
        padding: 2.5rem 1rem;
        background-color:#434244;
        border-radius:4px 0px 0px 4px ;   
        color:#fff;
        height: inherit;
        min-height: 695.525px;
    }

.template1 .article {
        width:130%;
        padding: 2.5rem 1rem;
    }

    .template1.prifile-section {

    }

    .template1 .prifile-section {
        display:flex
    }

      .template1 .img {

        border-style: none;
       
        border-radius: 50%;
    }

    .template1 .dot {
        background-color: #434244ba;
        border-radius: 51%;
       
    }

      .template1 .line {
            height: 1px;
            width: 100%;
            background-color: #43424459;
       
    }

      .template1 .text {
        
        text-transform: uppercase;
        color: rgb(65, 65, 66);;
        font-weight: bold;
        letter-spacing: 0.3px;
    }

      .template1 .expLoca {
        width:30%
    }

      .template1 .title {
        text-transform:capitalize;
        position: relative;
        margin: 0px;
        padding: 0px;
        white-space: pre-wrap;
        break-inside: avoid;
        font-family: "Lato Bold";
        color: rgb(99, 100, 102);
        z-index: 1;
      
        word-break: break-word !important;
    }

   

      .template1 .para {
        position: relative;
        padding: 0px;
        white-space: pre-wrap;
        break-inside: auto;
        font-family: Lato;
        color: rgb(128, 129, 131);
        text-transform: capitalize;
        word-break: break-word !important;
        }

  

      .template1 .uppercase {
        text-transform:uppercase
    }

      .template1 .big-heading {
        position: relative;
        margin: 0px;
        padding: 0px;
        white-space: pre-wrap;
        text-transform: uppercase;
        break-inside: avoid;
        font-family: BebasNeue;
        transition: background-color 0.5s ease 0s;
        color: rgb(65, 65, 66);
       
       
        letter-spacing: 1.31921px;
        word-break: break-word !important;
    } 




      .template1 .icon-round {
          background: #434244;
           border-radius: 61%;
        
        }

      .template1 .head-section {
            width: 65%;
    }

      .template1 .text-section {
            margin: 4px 0px 0px 4px;
    }

      .template1 .headline {
            padding: 2rem 0rem 1rem 0rem;
    }

      .template1 .expJob {
            border-left: 1px solid #43424459;
           padding: 1rem 0px 1rem 13px;
           position:relative;
    }

   

      .template1 .expJob::before {
           content: "";
            width: 5px;
            height: 5px;
            position: absolute;
            background-color: #434244ba;
            border-radius: 51%;
            
    }

      .template1 .expJob::after {
          content: "";
      
        position: absolute;
        background-color: #434244ba;
         border-radius: 51%;
     
    }


      .template1 .expLoca {
        padding: 1rem 14px 1rem 0px;
    }

       .template1 .eduschool {
        width:30%;
        padding: 1rem 14px 1rem 0px;
    }

       .template1 .eduDegree {
           border-left: 1px solid #43424459;
           padding: 1rem 0px 1rem 13px;
           position:relative;
    }

       .template1 .eduDegree::after {
        content: "";
        border-radius: 51%;
        position: absolute;
        background-color: #434244ba;
       
    }

      .template1 .skill .dot {
        width: 6px;
        height: 5px;
    }

      .template1 .skillData {
        
        position: relative;
        -webkit-box-flex: 1;
        flex: 1 0 44%;
        max-width: 44%;
        margin-bottom: 10px;
        flex-direction: column;
        display: block;

    }

   

     .template1 .progress-container {
        position: relative;
        display: flex;
        flex-flow: row wrap;
        -webkit-box-pack: justify;
        justify-content: space-between;
    }

      .template1 .progress-bar {
        height: 3px;
        background: #4342443b;
    }
     .template1 .progress {
        height:3px;
        background: #434244;
    }

      .template1 .novice {
        width:20%
    }

      .template1 .beginner {
        width:40%;
    }

      .template1 .skillfull {
        width:60%
    }

      .template1 .experienced {
        width:80%
    }

      .template1 .expert {
        width:100%
    }

   
</style>
