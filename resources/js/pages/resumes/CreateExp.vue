<template>
    <div class="container" v-if="isLoading">Please wait while loading</div>
    <div v-else class="content container">
        <Breadcrumb :style="{ margin: '4px 0'}">
            <BreadcrumbItem>Heading</BreadcrumbItem>
            <BreadcrumbItem>Experiance</BreadcrumbItem>
        </Breadcrumb>
        
        <router-link  :to="`/resumes/${id}/edit`"><Button  style="margin-left: 8px">pervious</Button></router-link>
        <router-link  :to="`/resumes/${templete}/${id}/education`"><Button type="primary" style="margin-left: 8px">Next to education</Button></router-link>

        <div>
            <Row type="flex" :gutter="15">
                <Col span="12">
                    <CreateExp :experiance="experiance"  :resumeId='id' v-on:expData="experianceData($event)"/>
                </Col>
                <Col span="12">
                    <Show :templete="templete" :resume="resume" :experiance="experiance" />
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
    .content {
        padding: 20px;
    }
</style>
