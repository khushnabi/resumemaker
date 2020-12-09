<template :loading="isLoading">
    <div v-if="isLoading">Please wait while loading</div>
    <div v-else class="content">
         <Breadcrumb :style="{ margin: '4px 0'}">
            <BreadcrumbItem>Heading</BreadcrumbItem>
        </Breadcrumb>
        <Row type="flex" :gutter="15">
            <Col span="12">
                <Create :editId='id' :resume="resume" />
            </Col>
            <Col span="12">
                <Show :resume="resume"/>
            </Col>
        </Row>
    </div>
</template>
<script>
import Axios from "axios";
import Create from "../../components/CreateResume"
import Show from "../../components/showResume";
export default {
    components: { Create, Show },
    data() {
        return {
            isLoading: true,
            resume: {
                address:"",
                city: "",
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
            id:null}
    },

    async mounted() {
        if(this.$route.params.id) {
            this.id = this.$route.params.id;
            const { data } = await Axios.get(`/api/resumes/${this.id}`);
            this.resume = data;
            console.log(this.resume)
            this.isLoading = false;
        } else {
             this.isLoading = false;
        }
       
    }
}
</script>

<style scoped>
    .content {
        padding: 20px;
    }
</style>
