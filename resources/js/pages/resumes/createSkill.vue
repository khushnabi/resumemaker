<template>
    <div class="container" v-if="isLoading">Please wait while loading</div>
    <div v-else class="content container">
        <Breadcrumb :style="{ margin: '4px 0'}">
            <BreadcrumbItem>Heading</BreadcrumbItem>
            <BreadcrumbItem>Experiance</BreadcrumbItem>
            <BreadcrumbItem>Education</BreadcrumbItem>
            <BreadcrumbItem>Skill</BreadcrumbItem>
        </Breadcrumb>
        
        <router-link  :to="`/resumes/${templete}/${id}/education`"><Button type="default" style="margin-left: 8px">prev to education</Button></router-link>
        <router-link  :to="`/resumes/${templete}/${id}/Summary`"><Button type="primary" style="margin-left: 8px">next to Summary</Button></router-link>


        <Row type="flex" :gutter="15">
            <Col span="12">
                <CreateSkill :skill="skill"  :resumeId='id' v-on:skillData="skillData($event)"/>
            </Col>
            <Col span="12">
                <Show :templete="templete" :resume="resume" :skill="skill" />
            </Col>
        </Row>

    </div>
</template>
<script>
import Axios from "axios";
import CreateSkill from "../../components/Skill.vue"
export default {
    components: { CreateSkill },
    data() {
        return {
            isLoading: true,
            templete:"",
            resume: {},
            skill:{
                   skill:'',
                    level: ''
            },
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
        skillData(obj) {
            this.resume = obj;
            console.log("i am from skill  data")
            console.log(this.resume)
        }
    }


}
</script>

<style scoped>
    .content {
        padding: 20px;
    }
</style>
