<template>
    <div v-if="isLoading">Please wait while loading</div>
    <div v-else class="content">
        <Breadcrumb :style="{ margin: '4px 0'}">
            <BreadcrumbItem>Heading</BreadcrumbItem>
            <BreadcrumbItem>Experiance</BreadcrumbItem>
            <BreadcrumbItem>Education</BreadcrumbItem>
            <BreadcrumbItem>Skill</BreadcrumbItem>
             <BreadcrumbItem>Summary</BreadcrumbItem>
        </Breadcrumb>
        
        <router-link  :to="`/resumes/${id}/skill`"><Button type="default" style="margin-left: 8px">prev to skill</Button></router-link>
        <router-link  :to="`/resumes/${id}/final`"><Button type="primary" style="margin-left: 8px">next to finalize</Button></router-link>
        <div>
            <Row type="flex" :gutter="15">
                
                <Col span="12">
                    <CreateSummary :summary="summary"  :resumeId='id' v-on:summaryData="summaryData($event)"/>
                </Col>
                <Col span="12">
                    <Show :resume="resume" :summary="summary" />
                </Col>
                 <br/>
           </Row>
        </div>

        
       
    </div>
</template>
<script>
import Axios from "axios";
import CreateSummary from "../../components/Summary.vue"
import Show from "../../components/showResume";
export default {
    components: { CreateSummary, Show },
    data() {
        return {
            isLoading: true,
            resume: {},
            summary:{
                    summary: ''
            },
            id:null
        }
    },

    async mounted() {
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
        summaryData(obj) {
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
