<template :loading="isLoading">
  <div v-if="isLoading">
    <div class="demo-spin-container">
      <Spin fix>
        <Icon type="ios-loading" size="30" class="demo-spin-icon-load"></Icon>
        <!-- <div style="font-size:30px  "> Loading....</div> -->
      </Spin>
    </div>
  </div>
  <div v-else>
    <Row>
      <Col class="form-baground" span="12">
        <div class="overflow">
          <div class="bred-crumb">
            <div class="bred-text">
              <div>
                <div class="active-text bred-crumb-text">heading</div>
                <div class="active-line bred-line"></div>
              </div>
              <div>
                <div class="bred-crumb-text">experiance</div>
                <div class="bred-line"></div>
              </div>
              <div>
                <div class="bred-crumb-text">education</div>
                <div class="bred-line"></div>
              </div>
              <div>
                <div class="bred-crumb-text">skills</div>
                <div class="bred-line"></div>
              </div>
              <div>
                <div class="bred-crumb-text">summary</div>
                <div class="bred-line"></div>
              </div>
              <div>
                <div class="bred-crumb-text">finalize</div>
                <div class="bred-line"></div>
              </div>
            </div>
          </div>

          <div class="formContainer">
            <h4 class="form-header">
              <div>
                What's the <span class="primary-color">best way</span> for
                Employers to contact you?
              </div>
            </h4>
            <p class="form-para">
              We suggest including an email and phone number
            </p>
            <Create :templete="template" :resume="resume" />
          </div>
        </div>
      </Col>
      <Col :span="12" class="background-color">
        <div class="overflow">
          <div v-if="id">
            <router-link :to="`/resumes/${id}/${resume.templete}/show`"
              ><div class="resize">
                <Icon size="24" color="white" type="ios-resize" /></div
            ></router-link>
          </div>
          <div class="close">
            <router-link to="/resumes"><h1><Icon type="md-close" color="#434244" /></h1></router-link>
          </div>
          <div>
            <component :is="template" :resume='resume'></component>
          </div>
        </div>
      </Col>
    </Row>
  </div>
</template>
<script>
import Axios from "axios";
import templateList from "../../components/templates/list";
import Create from "../../components/CreateResume";
export default {
  components: { Create, Component: null },
  data() {
    return {
      isLoading: true,
      template: "",
      resume: {
        address: "",
        city: "",
        templete: "",
        created_at: "",
        customs: "",
        educations: [],
        email: "",
        experiences: [],
        first_name: "",
        last_name: "",
        phone: null,
        postal_code: null,
        profile_img: "",
        skills: [],
        summaries: [],
        updated_at: "",
      }
    };
  },

  methods: {

  },

  async mounted() {
    const template = this.$route.params.templete;
    if (templateList[template]) {
        this.template = templateList[template].component;
    } else {
        this.template = templateList.default.component;
    }

    // this.template = template;
    if (this.$route.params.id) {
      this.id = this.$route.params.id;
      const { data } = await Axios.get(`/api/resumes/${this.id}`);
      this.resume = data;
      this.template = data.templete;
      this.isLoading = false;
    } else if (this.$route.params.templete) {
      this.isLoading = false;
    } else {
        const { data } = await Axios.get('/api/profile');
        const [ first_name, ...lastName ] = data.name.split(' ');
        this.resume = { ...this.resume, ...data, name: undefined, id: undefined, first_name, last_name: lastName.join('') };
        this.isLoading = false;
    }
  },
};
</script>

<style lang="scss" scoped>
    .close {
        right: 0;
        position: absolute;
        z-index: 100;
    }
</style>
