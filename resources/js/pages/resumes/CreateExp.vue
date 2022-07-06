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
                
        <div>
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
                                     <div class="active-text bred-crumb-text">experience</div>
                                     <div class=" active-line bred-line"></div>
                                </div>
                                 <div>
                                     <div class="bred-crumb-text">education</div>
                                     <div class="bred-line"></div>
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
                            <h4 class="form-header"><div> <span class="primary-color">Tell us </span> about your Experience</div></h4>
                           <p class="form-para">Start with your recent job</p>

                            <CreateExp :experiance="experiance"  :resumeId='id' v-on:expData="experianceData($event)"/>
                        <div class="buttons-container">
                            <div>
                                <router-link  :to="`/resumes/${id}/edit`"><button class="back" style="margin-left: 8px"><Icon size="17" type="md-arrow-round-back" />{{" "}}Back</button></router-link>
                            </div>
                            <div>
                                <router-link  :to="`/resumes/${templete}/${id}/education`"><Button type="primary" style="margin-left: 8px">Next to education <Icon type="md-arrow-round-forward" /></Button></router-link>
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
                            <Show :templete="templete" :resume="resume" :experiance="experiance" />
                            
                        </div>

                    </div>
                </Col>
            </Row>
        </div>
    </div>
</template>
<script>
import Axios from "axios";
import CreateExp from "../../components/Experiance.vue"
export default {
    components: { CreateExp },
    data() {
        return {
            isLoading: true,
            resume: {},
            templete:"",
            experiance:{
                    job_title: '',
                    employer: '',
                    start_at: null,
                    city: '',
                    end_at:'',
                    description: "",
                    work_here:false
            },
            id:null
        }
    },

    async mounted() {
          // this.templete=this.$route.params.templete
        if(this.$route.params.id) {
            this.id = this.$route.params.id;
            const { data } = await Axios.get(`/api/resumes/${this.id}`);
            this.resume = data;
            this.templete = data.templete
            console.log(this.resume)
            this.isLoading = false;
        } else {
             this.isLoading = true;
        }
       
    },

    methods: {
        experianceData(obj) {
            this.resume = obj;
        }
    }


}
</script>

<style scoped>
  
</style>
