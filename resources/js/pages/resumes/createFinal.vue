<template>
    <div v-if="isLoading">Please wait while loading</div>
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
                                 <div class=" active-text bred-crumb-text">experiance</div>
                                 <div class="bred-line active-line"></div>
                            </div>
                             <div>
                                 <div class="active-text bred-crumb-text">education</div>
                                 <div class="active-line bred-line"></div>
                            </div>
                            <div>
                                 <div class="active-text bred-crumb-text">skills</div>
                                 <div class="active-line bred-line"></div>
                            </div>
                             <div>
                                 <div class="active-text bred-crumb-text">summary</div>
                                 <div class="bred-line active-line"></div>
                            </div>
                            <div>
                                 <div class="bred-crumb-text active-text ">finalize</div>
                                 <div class="bred-line active-line"></div>
                            </div>

                        </div>
                      
                    </div>
                    <div class="formContainer">
                           <CreateFinal :resume='resume' :templete='templete' :experiance="experiance" :education="education" :skill="skill" :custom="custom" :summary="summary"  :resumeId='id' v-on:finalData="finalData($event)"/>
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

                        <Show :templete="templete" :resume="resume" :experiance="experiance" :education="education" :skill="skill" :custom="custom" :summary="summary" />
                    </div>

              </div>
            </Col>
        </Row>
    </div>
</template>
<script>
import Axios from "axios";
import CreateFinal from "../../components/Finalize.vue"
export default {
    components: { CreateFinal },
    data() {
        return {
            templete:"",
            isLoading: true,
            resume: {},
            skill:{
                   skill:'',
                    level: ''
            },

             resume: {
                address:"",
                city: "",
                templete:'',
                created_at: "",
                customs: '',
                educations: [],
                email: '',
                experiences: [],
                first_name: '',
                last_name: '',
                phone: null,
                postal_code: null,
                profile_img: '',
                skills:[],
                summaries: [],
                updated_at: '',
            },
            experiance:{
                    job_title: '',
                    employer: '',
                    start_at: null,
                    city: '',
                    end_at:null,
                    description: "",
                    work_here:false
            },
            education:{
                    school: 'dsfsdfs',
                    degree: 'sdfsd',
                    city: 'dsfds',
                    graduated_at: null,
                    description: "fsdfasdfasf",
            },

            summary:{
                summary: ''
            },
            custom:{},
            id:null
        }
    },

    async mounted() {
        this.templete=this.$route.params.templete;

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
        finalData(obj) {
            this.resume = obj;
        }
    }


}
</script>

<style>
    
 
</style>
