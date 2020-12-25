<template>
    <div class="container" v-if="isLoading">Please wait while loading</div>
    <div v-else class="content container">
        <Breadcrumb :style="{ margin: '4px 0'}">
            <BreadcrumbItem>Heading</BreadcrumbItem>
            <BreadcrumbItem>Experiance</BreadcrumbItem>
            <BreadcrumbItem>Education</BreadcrumbItem>
            <BreadcrumbItem>Skill</BreadcrumbItem>
             <BreadcrumbItem>Summary</BreadcrumbItem>
             <BreadcrumbItem>Final</BreadcrumbItem>
        </Breadcrumb>
        

        <Row type="flex" :gutter="15">
            <Col span="12">
                <CreateFinal :templete='templete' :experiance="experiance" :education="education" :skill="skill" :custom="custom" :summary="summary"  :resumeId='id' v-on:finalData="finalData($event)"/>
            </Col>
            <Col span="12">
                <Show :templete="templete" :resume="resume" :experiance="experiance" :education="education" :skill="skill" :custom="custom" :summary="summary" />
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
            summary:{},
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

<style scoped>
    .content {
        padding: 20px;
    }
</style>
