<template>
    <div class="container" v-if="isLoading">Please wait while loading</div>
    <div v-else class="content container">
                <Breadcrumb :style="{ margin: '4px 0'}">
                    <BreadcrumbItem>Heading</BreadcrumbItem>
                    <BreadcrumbItem>Experiance</BreadcrumbItem>
                    <BreadcrumbItem>Education</BreadcrumbItem>
                </Breadcrumb>
        
        <router-link  :to="`/resumes/${templete}/${id}/experiance`"><Button type="default" style="margin-left: 8px">prev to experiance</Button></router-link>
        <router-link  :to="`/resumes/${templete}/${id}/skill`"><Button type="primary" style="margin-left: 8px">next to skill</Button></router-link>


        <Row type="flex" :gutter="15">
            <Col span="12">
                <CreateEdu :education="education"  :resumeId='id' v-on:eduData="educationData($event)"/>
            </Col>
            <Col span="12">
                <Show :templete='templete' :resume="resume" :education="education" />
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

<style scoped>
    .content {
        padding: 20px;
    }
</style>
