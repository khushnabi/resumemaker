<template>
  <div class="background-color spacer-padding">
    <div v-if="selectTemp" class="container">
      <h4 class="temp-header">select your template</h4>
      <p class="temp-para">To get started, select a resume template below.</p>
      <div class="display-flex">
        <div class="bold-line"></div>
        <div>
          <router-link to="/resumes"><h1><Icon type="md-close" color="#434244" /></h1
          ></router-link>
        </div>
      </div>
      <div class="spacer-temp"></div>
      <Carousel v-model="value1" loop>
        <CarouselItem>
          <div class="display-flex">
            <div
              class="template1 display-flex resumes"
              @click="selectTemplete('template1')"
            >
              <div class="sideBar">
                <div style="margin-bottom: 15px" class="text-center">
                  <img class="img" src="/uploads/1609947566.jpeg" />
                </div>
                <div>
                  <h3 class="uppercase text" style="color: #fff">About me</h3>
                  <div class="little-spacer"></div>
                  <div>
                    <p
                      class="summary-para para"
                      style="
                        color: rgb(255 255 255 / 79%);
                        letter-spacing: 0.5px;
                      "
                    >
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore magna
                      aliqua. Ut enim ad minim veniam, quis nostrud exerci
                    </p>
                  </div>
                </div>
              </div>

              <div class="article">
                <div class="prifile-section">
                  <div class="head-section">
                    <h2 :class="`big-heading`">firstname lastname</h2>
                  </div>

                  <div>
                    <div class="display-flex">
                      <div>
                        <div class="icon-round">
                          <Icon type="ios-pin" color="white" size="5" />
                        </div>
                      </div>
                      <div class="text-section">
                        <p :class="`para `">address, city , postalcode</p>
                      </div>
                    </div>
                    <div class="display-flex">
                      <div class="icon-round">
                        <Icon size="5" color="white" type="md-call" />
                      </div>
                      <div class="text-section">
                        <p :class="`para `">phone number</p>
                      </div>
                    </div>
                    <div class="display-flex">
                      <div class="icon-round">
                        <Icon size="5" color="white" type="ios-mail" />
                      </div>
                      <div class="text-section">
                        <p :class="`para `">your email</p>
                        phone numbe
                      </div>
                    </div>
                  </div>
                </div>

                <div class="experience">
                  <div>
                    <div class="display-flex headline">
                      <div class="dot"></div>
                      <div :class="`text `">
                        <p>Experiances</p>
                      </div>
                      <div class="line"></div>
                    </div>

                    <div>
                      <div>
                        <div class="display-flex">
                          <div class="expLoca">
                            <p :class="`title uppercase`">emplyer</p>
                            <p :class="`para `">city</p>
                            <p :class="`para `">start_at - end_at</p>
                          </div>
                          <div class="expJob">
                            <p :class="`title`">job_title</p>
                            <p :class="`para`">description</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="education">
                  <div>
                    <div class="display-flex headline">
                      <div class="dot"></div>
                      <div :class="`text `">
                        <p>Education</p>
                      </div>
                      <div class="line"></div>
                    </div>

                    <div>
                      <div class="display-flex">
                        <div class="eduschool">
                          <p :class="`title uppercase`">school</p>
                          <p :class="`para `">city</p>
                          <p :class="`para `">graduated_at</p>
                        </div>
                        <div class="eduDegree">
                          <p :class="`title `">degree</p>
                          <p :class="`para `">description</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="skill">
                  <div class="display-flex headline">
                    <div class="dot"></div>
                    <div :class="`text`">
                      <p>Skill</p>
                    </div>
                    <div class="line"></div>
                  </div>

                  <div class="progress-container">
                    <div class="skillData">
                      <p class="para uppercase">skill skillfull</p>
                      <div class="progress-bar">
                        <div :class="`progress skillfull`"></div>
                      </div>
                    </div>
                    <div class="skillData">
                      <p class="para uppercase">skill bignner</p>
                      <div class="progress-bar">
                        <div :class="`progress beginner`"></div>
                      </div>
                    </div>

                    <div class="skillData">
                      <p class="para uppercase">skill bignner</p>
                      <div class="progress-bar">
                        <div :class="`progress novice`"></div>
                      </div>
                    </div>
                  </div>
                </div>

                <div></div>
              </div>
            </div>
            <div
              class="margin-left template2 display-flex resumes"
              @click="selectTemplete('template2')"
            >
              <div class="sideBar">
                <div style="margin-bottom: 15px" class="text-center">
                  <img class="img" src="/uploads/1609947566.jpeg" />
                </div>

                <div>
                  <h3 class="uppercase text" style="color: #fff">About me</h3>
                  <div class="little-spacer"></div>
                  <div>
                    <p
                      class="summary-para para"
                      style="
                        color: rgb(255 255 255 / 79%);
                        letter-spacing: 0.5px;
                      "
                    >
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore magna
                      aliqua. Ut enim ad minim veniam, quis nostrud exerci
                    </p>
                  </div>
                </div>
              </div>

              <div class="article">
                <div class="prifile-section">
                  <div class="head-section">
                    <h2 :class="`big-heading`">firstname lastname</h2>
                  </div>

                  <div>
                    <div class="display-flex">
                      <div>
                        <div class="icon-round">
                          <Icon type="ios-pin" color="white" size="5" />
                        </div>
                      </div>
                      <div class="text-section">
                        <p :class="`para `">address, city , postalcode</p>
                      </div>
                    </div>
                    <div class="display-flex">
                      <div class="icon-round">
                        <Icon size="5" color="white" type="md-call" />
                      </div>
                      <div class="text-section">
                        <p :class="`para `">phone number</p>
                      </div>
                    </div>
                    <div class="display-flex">
                      <div class="icon-round">
                        <Icon size="5" color="white" type="ios-mail" />
                      </div>
                      <div class="text-section">
                        <p :class="`para `">your email</p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="experience">
                  <div>
                    <div class="display-flex headline">
                      <div class="dot"></div>
                      <div :class="`text `">
                        <p>Experiances</p>
                      </div>
                      <div class="line"></div>
                    </div>

                    <div>
                      <div>
                        <div class="display-flex">
                          <div class="expLoca">
                            <p :class="`title uppercase`">emplyer</p>
                            <p :class="`para `">city</p>
                            <p :class="`para `">start_at - end_at</p>
                          </div>
                          <div class="expJob">
                            <p :class="`title`">job_title</p>
                            <p :class="`para`">description</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="education">
                  <div>
                    <div class="display-flex headline">
                      <div class="dot"></div>
                      <div :class="`text `">
                        <p>Education</p>
                      </div>
                      <div class="line"></div>
                    </div>

                    <div>
                      <div class="display-flex">
                        <div class="eduschool">
                          <p :class="`title uppercase`">school</p>
                          <p :class="`para `">city</p>
                          <p :class="`para `">graduated_at</p>
                        </div>
                        <div class="eduDegree">
                          <p :class="`title `">degree</p>
                          <p :class="`para `">description</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="skill">
                  <div class="display-flex headline">
                    <div class="dot"></div>
                    <div :class="`text`">
                      <p>Skill</p>
                    </div>
                    <div class="line"></div>
                  </div>

                  <div class="progress-container">
                    <div class="skillData">
                      <p class="para uppercase">skill skillfull</p>
                      <div class="progress-bar">
                        <div :class="`progress skillfull`"></div>
                      </div>
                    </div>
                    <div class="skillData">
                      <p class="para uppercase">skill bignner</p>
                      <div class="progress-bar">
                        <div :class="`progress beginner`"></div>
                      </div>
                    </div>

                    <div class="skillData">
                      <p class="para uppercase">skill bignner</p>
                      <div class="progress-bar">
                        <div :class="`progress novice`"></div>
                      </div>
                    </div>
                  </div>
                </div>

                <div></div>
              </div>
            </div>
          </div>
        </CarouselItem>
        <CarouselItem>
          <div class="demo-carousel">2</div>
        </CarouselItem>
        <CarouselItem>
          <div class="demo-carousel">3</div>
        </CarouselItem>
        <CarouselItem>
          <div class="demo-carousel">4</div>
        </CarouselItem>
      </Carousel>
    </div>
    <div>
      <component
        :is="templete"
        :resume="resume"
        :experiance="experianceData"
        :education="educationData"
        :skill="skillData"
        :summary="summaryData"
        :custom="customData"
      >
      </component>
    </div>

    <!-- <Another
          /> -->
  </div>
</template>

<script>
import Template1 from "../tempates/Template1";
import Template2 from "../tempates/Template2";
export default {
  props: [
    "resume",
    "templete",
    "experiance",
    "education",
    "skill",
    "summary",
    "custom",
  ],
  components: {
    template1: Template1,
    template2: Template2,
  },
  data() {
    return {
      value1: 0,
      selectTemp: true,
      experianceData: this.experiance || {},
      educationData: this.education || {},
      skillData: this.skill || {},
      summaryData: this.summary || {},
      customData: this.custom || {},
      isGetExpData: {},
      //    experiences: this.resume?.experiences ?? [],
      //    educations: this.resume?.educations ?? [],
      fields: [],
      skills: [],
      summaries: [],
    };
  },

  mounted() {
    if (this.$route.path === "/resumes/templates") {
      this.selectTemp = true;
      console.log("i am comming from route");
    } else {
      this.selectTemp = false;
      console.log("i am comming from component");
    }
  },
  methods: {
    selectTemplete(templete) {
      this.selectTemp = false;
      this.$router.push(`/resumes/${templete}/create`);
    },
  },
};
</script>
<style scope>
.bold-line::before {
  content: "";
  position: absolute;
  width: 22%;
  height: 5px;
  background: rgb(76, 124, 247);
}

.spacer-temp {
  padding-bottom: 2rem;
}
.temp-header {
  text-align: center;
  margin: 0px;
  position: relative;
  line-height: 1.2;
  font-size: 55px;
  font-weight: 900;
  letter-spacing: -1.5px;
  color: rgb(32, 32, 35);
  text-transform: capitalize;
}

.temp-para {
  text-align: center;
  max-width: 640px;
  margin: 7px auto 0px;
  position: relative;
  font-size: 20px;
  font-weight: 500;
  opacity: 0.7;
  color: rgb(40, 43, 50);
}

.bold-line {
  width: 94%;
  background: rgb(202, 209, 217);
  border-radius: 2.5px;
  height: 5px;
  margin-top: 24px;
}

.dasboard-resume {
  font-size: 18px;
  line-height: normal;
  margin-bottom: -17px;
  text-transform: capitalize;
  color: rgb(0, 135, 193);
  margin-top: 2rem;
  margin-left: 0rem;
}

.create-new {
  width: auto;
  will-change: box-shadow;
  display: inline-block;
  vertical-align: middle;
  margin-bottom: 0px;
  font-weight: bold;
  letter-spacing: normal;
  text-align: center;
  text-transform: uppercase;
  cursor: pointer;
  touch-action: manipulation;
  height: 55px;
  border: 1px solid rgb(0, 135, 193);
  background: rgb(0, 135, 193);
  color: rgb(255, 255, 255);
  transition: all 0.2s ease 0s;
  min-width: 180px;
  border-radius: 27.5px;
  padding: 15px 20px;
  font-size: 14px;
  line-height: normal;
}

.create-new:hover {
  border-color: rgb(26, 88, 133);
  background: rgb(26, 88, 133);
  color: rgb(255, 255, 255);
}

.container {
  width: 80%;
  margin: auto;
}

.dashboard {
  display: flex;
  justify-content: space-between;
}

.dashboard h1 {
  font-size: 37px;
  color: rgb(40, 43, 50);
  line-height: 42px;
  letter-spacing: -1px;
}

.primary {
  margin-top: 33px;
  padding: 1rem 2rem 1rem 2rem;
  border: none;
  color: #fff;
  border-radius: 27px;
  text-transform: uppercase;
  font-size: 12px;
  font-weight: bolder;
  box-shadow: 1px 1px 1px;
  border: 1px solid rgb(0, 135, 193);
  background: rgb(0, 135, 193);
  outline: none;
}

.primary:hover {
  border-color: rgb(26, 88, 133);
  background: rgb(26, 88, 133);
  color: rgb(255, 255, 255);
}

.datas {
  flex: 1;
  border-left: 1px solid black;
}
.forms {
  flex: 1;
}

.show-resumes > div {
  display: inline-block;
  margin-left: 1rem;
  margin-top: 1rem;
}

.image {
  width: 40%;
  height: 40%;
}

.resumes {
  position: relative;
  height: inherit;
  min-height: 350.263px;
  width: 300px;
  background: #fff;
  border-radius: 3px;
  box-shadow: 0px 9px 9px 4px rgb(0 0 0 / 8%);
}

.resumes .img {
  width: 40px;
  height: 40px;
}

.resumes .sideBar {
  width: 40%;
  padding: 1.6rem 0.5rem;

  height: inherit;
  min-height: 195.525px;
}

.resumes .big-heading {
  font-size: 12px;
}

.resumes .para {
  font-size: 5px;
}

.resumes .icon-round {
  margin: 0px 0px 2px 0px;
  width: 10px;
  height: 10px;
  padding: 0px 0px 0px 2px;
  line-height: 3.5px;
}

.resumes .text {
  font-size: 7px;
  margin-top: -4px;
}

.resumes .title {
  font-size: 7px;
}

.resumes .article {
  padding: 1.5rem 0.6rem;
}

.resumes .headline {
  padding: 1rem 0rem 0.5rem 0rem;
}

.resumes .expLoca {
  width: 40%;
  padding: 8px 11px 0rem 0px;
}

.resumes .dot {
  width: 5px;
  height: 4px;
  border-radius: 50%;
  margin-right: 2px;
  margin-top: -1px;
}

.resumes .skill .dot {
  width: 4px;
  height: 3px;
}

.resumes .expJob {
  padding: 0.5rem 0px 0rem 13px;
}

.resumes .expJob::before {
  content: "";
  width: 4px;
  height: 4px;
  position: absolute;
  background-color: #434244ba;
  border-radius: 51%;

  margin-left: -15.8px;
}

.resumes .expJob::after {
  content: "";
  position: absolute;
  background-color: #434244ba;
  border-radius: 51%;
  width: 4px;
  height: 4px;
  margin-top: -25px;
  margin-left: -15.8px;
}

.resumes .eduschool {
  width: 40%;
  padding: 8px 11px 0rem 0px;
}

.resumes .eduDegree {
  padding: 0rem 0px 0rem 13px;
}

.bg-color {
  background-color: #f0f0f2;
}

.ivu-card {
  background-color: #f0f0f2 !important;
}

.resumes .eduDegree::after {
  content: "";
  border-radius: 51%;
  position: absolute;
  background-color: #434244ba;
  width: 4px;
  height: 4px;
  margin-top: -19px;
  margin-left: -15px;
}

.edit-section {
  padding: 24px 29px;
}

.edit {
  margin-top: 23px;
}

.edit a {
  position: relative;
  font-size: 15px;
  font-weight: 600;
  font-stretch: normal;
  font-style: normal;
  line-height: normal;
  letter-spacing: normal;
  color: rgb(40, 43, 50);
  margin-bottom: 13px;
}

.download {
  margin-top: 10px;
}

.download a {
  position: relative;
  font-size: 15px;
  font-weight: 600;
  font-stretch: normal;
  font-style: normal;
  line-height: normal;
  letter-spacing: normal;
  color: rgb(40, 43, 50);
}

.delete {
  margin-top: 10px;
  position: relative;
  font-size: 15px;
  font-weight: 600;
  font-stretch: normal;
  font-style: normal;
  line-height: normal;
  letter-spacing: normal;
  color: rgb(40, 43, 50);
}

.created {
  margin-top: -7px;
  margin-bottom: 13px;
  color: rgb(152, 156, 175);
  font-size: 10px;
  font-weight: 500;
  letter-spacing: normal;
  padding-right: 0px;
}

.resume-title {
  position: relative;
  font-size: 20px;
  font-weight: 600;
  font-stretch: normal;
  font-style: normal;
  line-height: normal;
  letter-spacing: normal;
  color: rgb(40, 43, 50);
  margin-bottom: 9px;
}

.spacer {
  padding-top: 4rem;
}

.margin-left {
  margin-left: 2rem;
}

.spacer-padding {
  padding-top: 2rem;
  padding-bottom: 2rem;
}

.ivu-carousel-dots-inside {
  position: relative !important;
  margin-top: 1rem !important;
}

a {
  cursor: pointer;
}
</style>
