<template :loading="isLoading">
    <div  v-if="isLoading">
        <div class="demo-spin-container">
               <Spin  fix>
                <Icon  type="ios-loading" size=30 class="demo-spin-icon-load"></Icon>
                <!-- <div style="font-size:30px  "> Loading....</div> -->   
            </Spin>
        </div>
    </div>
    <div v-else>

        <Row>
            <Col class="form-baground" span="12">
               <div class="overflow">
                   <div class="bred-crumb">
                        <div class=" bred-text">
                            <div>
                                 <div class=" active-text bred-crumb-text">heading</div>
                                 <div class=" active-line bred-line"></div>
                            </div>
                            <div>
                                 <div class=" active-text bred-crumb-text">experience</div>
                                 <div class="bred-line active-line"></div>
                            </div>
                             <div>
                                 <div class="active-text bred-crumb-text">education</div>
                                 <div class="active-line bred-line"></div>
                            </div>
                            <div>
                                 <div class="bred-crumb-text">skills</div>
                                 <div class="bred-line"></div>
                            </div>
                             <div>
                                 <div class="bred-crumb-text">summary</div>
                                 <div class="bred-line"></div>
                            </div>
                            <div>
                                 <div class="bred-crumb-text">finalize</div>
                                 <div class="bred-line"></div>
                            </div>

                        </div>
                      
                    </div>

                    <div class="formContainer">
                        <h4 class="form-header"><div> <span class="primary-color">Tell us </span> about your Education</div></h4>
                           <p class="form-para">Start with your recent university</p>

                        <CreateEdu :education="education"  :resumeId='id' v-on:eduData="educationData($event)"/>

                        <div class="buttons-container">
                            <div>
                                  <router-link  :to="`/resumes/${templete}/${id}/experiance`"><button class="back"><Icon size="17" type="md-arrow-round-back" />{{" "}}Back</button></router-link>
                            </div>
                            <div>
                               <router-link  :to="`/resumes/${templete}/${id}/skill`"><Button type="primary" style="margin-left: 8px">next to skill <Icon type="md-arrow-round-forward" /></Button></router-link>
                            </div>
                        </div>
                    </div>


               </div>

            </Col>

            <Col span="12" class="background-color">
               <div class="overflow">
                    <div v-if="id">
                           <router-link  :to="`/resumes/${id}/${resume.templete}/show`"><div class="resize"><Icon size="24" color="white" type="ios-resize" /></div></router-link>

                    </div>
                    <div class="close">
                        <router-link to="/resumes"><h1><Icon type="md-close" color="#434244" /></h1></router-link>
                         
                    </div>
                    <div class="showResumContainer">
                        <Show :templete='templete' :resume="resume" :education="education" />
                        
                    </div>
               </div>

            </Col>
        </Row>
    </div>
</template>
<script>
import Axios from "axios";
import CreateEdu from "../../components/Education.vue"
export default {
    components: { CreateEdu },
    data() {
        return {
            templete:"",
            isLoading: true,
            resume: {},
            education:{
                    school: 'dsfsdfs',
                    degree: 'sdfsd',
                    city: 'dsfds',
                    graduated_at: null,
                    description: "fsdfasdfasf",
            },
            id:null
        }
    },

    async mounted() {

         this.templete=this.$route.params.templete
        if(this.$route.params.id) {
            this.id = this.$route.params.id;
            const { data } = await Axios.get(`/api/resumes/${this.id}`);
            this.resume = data;
            console.log(this.resume)
            this.isLoading = false;
        } else {
             this.isLoading = true;
        }
       
    },

    methods: {
        educationData(obj) {
            this.resume = obj;
        }
    }


}
</script>

<style>
    
</style>
