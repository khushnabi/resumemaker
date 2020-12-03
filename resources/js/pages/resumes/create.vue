<template>
    <div v-if="isLoading">Please wait while loading</div>
    <div v-else class="content">
        <Row type="flex" :gutter="15">
            <Col span="12">
                <Create :resume="resume" />
            </Col>
            <Col span="12">
                <Show :resume="resume" />
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
        return { isLoading: true, resume: {} }
    },
    async mounted() {
        const id = this.$route.params.id;
        const { data } = await Axios.get(`/api/resumes/${id}`);
        this.resume = data;
        this.isLoading = false;
    }
}
</script>

<style scoped>
    .content {
        padding: 20px;
    }
</style>
