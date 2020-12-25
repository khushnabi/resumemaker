<template :loading="isLoading">
    <div class="container" v-if="isLoading">Please wait while loading</div>
    <div v-else class="content container">
         <Breadcrumb :style="{ margin: '4px 0'}">
            <BreadcrumbItem>Heading</BreadcrumbItem>
        </Breadcrumb>
        <Row type="flex" :gutter="15">
            <Col span="12">
                <Create :templete='template' :editId='id' :resume="resume" />
            </Col>
            <Col span="12">

                
                <Show :templete='template' :resume='resume' />
            </Col>
        </Row>
    </div>
</template>
<script>
import Axios from "axios";
import Create from "../../components/CreateResume"
export default {
    components: { Create },
    data() {
        return {

            isLoading: true,
            template:'',
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
            id:null}
    },

    async mounted() {
        console.log("fom create")


        if(this.$route.params.id) {
             this.id = this.$route.params.id;
            const { data } = await Axios.get(`/api/resumes/${this.id}`);
            this.resume = data;
            this.template = data.templete;
            console.log(this.resume)
            this.isLoading = false;

        } else if(this.$route.params.templete) {
            this.template=this.$route.params.templete
            console.log(this.template)
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
