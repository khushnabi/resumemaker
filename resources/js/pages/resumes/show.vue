<template>
    <div>
         <div class="layout">
        <Layout>
            <Sider class="print-hidden" breakpoint="md" collapsible :collapsed-width="48">
                    <div class="resume-container">
                         <div class="template1  display-flex show resumes" @click="selectTemplete('template1')">
                       <div class="sideBar">

                        <div style=" margin-bottom: 15px;" class="text-center">
                            <img class="img" src="/uploads/1609947566.jpeg">
                        </div>

                        <div>
                            <h3 class="uppercase text " style="color:#fff;">About me</h3>
                            <div class="little-spacer">
                                
                            </div>
                             <div>
                                <p class="summary-para para" style="color:rgb(255 255 255 / 79%); letter-spacing:0.5px" >
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exerci
                                </p>
                            </div>

                        </div>
                        
                    </div>

                    <div class="article">

                        <div class="prifile-section">
                            <div class="head-section">
                                <h2 :class="`big-heading`">firstname lastname</h2>
                            </div>

                            <div>

                                <div class="display-flex">
                                    <div>
                                        <div class="icon-round">
                                            <Icon type="ios-pin" color='white' size="5" />
                                        </div>
                                    </div>
                                    <div class="text-section">
                                        <p :class="`para `">address, city , postalcode</p>
                                        
                                    </div>
                                </div>
                                <div class="display-flex">
                                    <div class="icon-round">
                                         <Icon size="5"  color='white' type="md-call" />
                                    </div>
                                    <div class="text-section">
                                      <p :class="`para `">phone number</p>
                                        
                                    </div>
                                </div>
                                  <div class="display-flex">
                                    <div class="icon-round">
                                        <Icon  size="5"  color='white' type="ios-mail" />
                                    </div>
                                    <div class="text-section">
                                        <p :class="`para `">your email</p>
                                        
                                    </div>
                                </div>
                              
                            </div>

                        </div>

                        <div class="experience">
                            <div>
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
                                    
                                    <div>
                                       <div class="display-flex">
                                            <div class="expLoca">
                                                <p :class="`title uppercase`">emplyer</p>
                                                <p :class="`para `">city</p>
                                                <p :class="`para `"> start_at - end_at</p>
                                            </div>
                                            <div class="expJob">
                                                 <p :class="`title`">job_title</p>
                                                 <p :class="`para`">description</p>
                                            </div>
                                       </div>
                                        
                                    </div>

                                </div>
                           
                            </div>
                        </div>


                        <div class="education">
                            <div>
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
                                     <div  class="display-flex">
                                        <div class="eduschool">
                                            <p :class="`title uppercase`">school</p>
                                            <p :class="`para `">city</p>
                                             <p :class="`para `">graduated_at</p>
                                        </div>
                                        <div class="eduDegree">
                                             <p :class="`title ` ">degree</p>
                                             <p :class="`para `">description</p>
                                        </div>
                                     </div>

                                </div>

                            </div>
                        </div>

                        <div class="skill">
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
                                <div class="skillData">
                                    <p class="para  uppercase">skill skillfull </p>
                                    <div class="progress-bar">
                                        <div :class="`progress skillfull`"> 
                                        </div>

                                    </div>
                                </div>
                                 <div class="skillData">
                                    <p class="para  uppercase">skill bignner</p>
                                    <div class="progress-bar">
                                        <div :class="`progress beginner`"> 
                                        </div>

                                    </div>
                                </div>

                                 <div class="skillData">
                                    <p class="para  uppercase">skill bignner</p>
                                    <div class="progress-bar">
                                        <div :class="`progress novice`"> 
                                        </div>

                                    </div>
                                </div>

                            </div>

                            
                        </div>
                   
                        <div >

                        </div>

                      
                    </div>

                     </div>
                    </div>
                   
                  <div class="resume-container">
                      

                     <div class="template2 show display-flex resumes" @click="selectTemplete('template2')">
                       <div class="sideBar">

                        <div style=" margin-bottom: 15px;" class="text-center">
                            <img class="img" src="/uploads/1609947566.jpeg">
                        </div>

                        <div>
                            <h3 class="uppercase text " style="color:#fff;">About me</h3>
                            <div class="little-spacer">
                                
                            </div>
                             <div>
                                <p class="summary-para para" style="color:rgb(255 255 255 / 79%); letter-spacing:0.5px" >
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exerci
                                </p>
                            </div>

                        </div>
                        
                    </div>

                    <div class="article">

                        <div class="prifile-section">
                            <div class="head-section">
                                <h2 :class="`big-heading`">firstname lastname</h2>
                            </div>

                            <div>

                                <div class="display-flex">
                                    <div>
                                        <div class="icon-round">
                                            <Icon type="ios-pin" color='white' size="5" />
                                        </div>
                                    </div>
                                    <div class="text-section">
                                        <p :class="`para `">address, city , postalcode</p>
                                        
                                    </div>
                                </div>
                                <div class="display-flex">
                                    <div class="icon-round">
                                         <Icon size="5"  color='white' type="md-call" />
                                    </div>
                                    <div class="text-section">
                                      <p :class="`para `">phone number</p>
                                        
                                    </div>
                                </div>
                                  <div class="display-flex">
                                    <div class="icon-round">
                                        <Icon  size="5"  color='white' type="ios-mail" />
                                    </div>
                                    <div class="text-section">
                                        <p :class="`para `">your email</p>
                                        
                                    </div>
                                </div>
                              
                            </div>

                        </div>

                        <div class="experience">
                            <div>
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
                                    
                                    <div>
                                       <div class="display-flex">
                                            <div class="expLoca">
                                                <p :class="`title uppercase`">emplyer</p>
                                                <p :class="`para `">city</p>
                                                <p :class="`para `"> start_at - end_at</p>
                                            </div>
                                            <div class="expJob">
                                                 <p :class="`title`">job_title</p>
                                                 <p :class="`para`">description</p>
                                            </div>
                                       </div>
                                        
                                    </div>

                                </div>
                           
                            </div>
                        </div>


                        <div class="education">
                            <div>
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
                                     <div  class="display-flex">
                                        <div class="eduschool">
                                            <p :class="`title uppercase`">school</p>
                                            <p :class="`para `">city</p>
                                             <p :class="`para `">graduated_at</p>
                                        </div>
                                        <div class="eduDegree">
                                             <p :class="`title ` ">degree</p>
                                             <p :class="`para `">description</p>
                                        </div>
                                     </div>

                                </div>

                            </div>
                        </div>

                        <div class="skill">
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
                                <div class="skillData">
                                    <p class="para  uppercase">skill skillfull </p>
                                    <div class="progress-bar">
                                        <div :class="`progress skillfull`"> 
                                        </div>

                                    </div>
                                </div>
                                 <div class="skillData">
                                    <p class="para  uppercase">skill bignner</p>
                                    <div class="progress-bar">
                                        <div :class="`progress beginner`"> 
                                        </div>

                                    </div>
                                </div>

                                 <div class="skillData">
                                    <p class="para  uppercase">skill bignner</p>
                                    <div class="progress-bar">
                                        <div :class="`progress novice`"> 
                                        </div>

                                    </div>
                                </div>

                            </div>

                            
                        </div>
                   
                        <div >

                        </div>

                      
                    </div>

                     </div>

                  </div>
                <div slot="trigger"></div>
            </Sider>
           <div class="container">
                <Layout :style="{padding:'0rem 8rem 3rem 8rem'}">
               
                <div class=" print-container display-flex">
                     <div class="print-hidden">
                        <Button type="primary" @click="print()">print</Button>
                   </div>
                
                    <div>
                          <div class="print-hidden" v-if="isDownloaded">
                                 <router-link  :to="`/resumes/${resume.templete}/${resume.id}/final`"><h1><Icon type="md-close" /></h1></router-link>
                            </div>
                            <div class="print-hidden" v-else>
                               <router-link :to="`/resumes/${resume.id}/edit`"><h1><Icon type="md-close" /></h1></router-link>
                            </div>

                    </div>
                </div>
                <Content :style="{background: '#fff', minHeight: '220px'}">
                    
                    <component 
                          :is='templete' :iconSize="iconSize" :changeTemplete='changeTemplete' :isDownloaded='isDownloaded' :inShow="inShow" :resume='resume'>
                    </component>
                          
                </Content>
            </Layout>
           </div>
        </Layout>
    </div>

       

    </div>
</template>

<script>

import Axios from 'axios';

import Template1 from "../../tempates/Template1"
import Template2 from "../../tempates/Template2"
export default {
   
    components: {
     'template1':Template1,
     'template2':Template2
     

      },
    data() {
        return {
            resume:{},
            changeTemplete:'change-templete',
            inShow:true,
            templete:'',
            selectTemp:true,
            experianceData:[],
            educationData:[],
            skillData:[],
            summaryData:[],
            customData:[],
            isGetExpData: [],
            isDownloaded:false,
            iconSize:13,
        //    experiences: this.resume?.experiences ?? [],
        //    educations: this.resume?.educations ?? [],
           fields: [],
           skills: [],
           summaries: []
        }
    },


   async mounted() {
            this.id = this.$route.params.id;


           
            console.log("hellwo from show methods")
            
            const { data } = await Axios.get(`/api/resumes/${this.id}`);
            this.resume = data;
            this.templete = data.templete
            console.log(this.resume)

            console.log(this.templete)

            console.log(this.$route.path === `/resumes/${this.id}/${this.templete}/download`)
      
         if(this.$route.path === `/resumes/${this.id}/${this.templete}/download`) {
                this.isDownloaded = true
        } else {
            this.isDownloaded = false
        }

    },

    methods: {


        selectTemplete(temp) {
            this.templete = temp
        },

        print() {
            print();
        }
    }


   
}
</script>

<style scope>

    .print-container {
        padding: 23px 0px 23px 45rem;
    }
        .show {
        cursor:pointer;
        width: 190px;
        min-height: 239.263px;
    }

   ,show .little-spacer {
        padding:0;
    }

    .ivu-layout-sider {
        flex: 0 0 259px !important;
        max-width: 240px !important;
        overflow: scroll;
        overflow-x: hidden
    }

    .show .sideBar {
      width: 29%;
    }

    .show .big-heading {
    font-size: 9px;
}

.show .headline {
    padding: 0.5rem 0rem 0.5rem 0rem;
}

.resume-container {
    margin: 26px 0px 0px 16px;
}

</style>