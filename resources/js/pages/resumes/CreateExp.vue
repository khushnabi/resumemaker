<template>
    <div v-if="isLoading">Please wait while loading</div>
    <div v-else class="content">
        <Breadcrumb :style="{ margin: '4px 0'}">
            <BreadcrumbItem>Heading</BreadcrumbItem>
            <BreadcrumbItem>Experiance</BreadcrumbItem>
        </Breadcrumb>
        
        <router-link  :to="`/resumes/${id}/edit`"><Button  style="margin-left: 8px">pervious</Button></router-link>
        <router-link  :to="`/resumes/${id}/education`"><Button type="primary" style="margin-left: 8px">Next to education</Button></router-link>

        <div>
            <Row type="flex" :gutter="15">
                <Col span="12">
                    <CreateExp :experiance="experiance"  :resumeId='id' v-on:expData="experianceData($event)"/>
                </Col>
                <Col span="12">
                    <Show :resume="resume" :experiance="experiance" />
                </Col>
            </Row>
        </div>
    </div>
</template>
<script>
import Axios from "axios";
import CreateExp from "../../components/Experiance.vue"
import Show from "../../components/showResume";
export default {
    components: { CreateExp, Show },
    data() {
        return {
            isLoading: true,
            resume: {},
            experiance:{
                    job_title: 'dsfsdfs',
                    employer: 'sdfsd',
                    start_at: null,
                    city: 'dsfds',
                    end_at:'',
                    description: "fsdfasdfasf",
                    work_here:false
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
        experianceData(obj) {
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
