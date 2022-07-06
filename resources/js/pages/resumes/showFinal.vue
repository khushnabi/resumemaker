<template :loading="isLoading">
    <div  v-if="isLoading">
        <div class="demo-spin-container">
               <Spin  fix>
                <Icon  type="ios-loading" size=30 class="demo-spin-icon-load"></Icon>
                <!-- <div style="font-size:30px  "> Loading....</div> -->   
            </Spin>
        </div>
    </div>
    <div v-else>
         <div class="layout">
        <Layout>
            <Sider class="print-hidden" breakpoint="md" collapsible :collapsed-width="48">
                    <div class="resume-container">
                         <div  @click="selectTemplete('template1')">
                           <Dummy-text  template="template1 show" />
                     </div>
                    </div>
                   
                  <div class="resume-container">

                     <div  @click="selectTemplete('template2')">
                     <Dummy-text  template="template2 show" />
                     </div>

                  </div>

                <div slot="trigger"></div>
            </Sider>
           <div :style="{display:'flex'}" class="container">
               <div class="print-hidden" :style="{width:'10%'}">

               </div>
                <Layout>
               
                <div class=" print-container display-flex">
                     <div class="print-hidden">
                        <Button type="primary" @click="print()">print</Button>
                   </div>
                
                    <div>
                          <div class="print-hidden" v-if="isDownloaded">
                                 <router-link  :to="`/resumes/${resume.templete}/${resume.id}/final`"><h1><Icon type="md-close" /></h1></router-link>
                            </div>
                            <div class="print-hidden" v-else>
                               <router-link :to="`/resumes/${resume.id}/edit`"><h1><Icon type="md-close" /></h1></router-link>
                            </div>

                    </div>
                </div>
                <Content :style="{background: '#fff', minHeight: '220px'}">
                    <template1 
                          :templete="templete" :iconSize="iconSize" :changeTemplete='changeTemplete' :isDownloaded='isDownloaded' :inShow="inShow" :resume='resume'>
                    </template1>
                </Content>
            </Layout>
             <div class="print-hidden" :style="{width:'10%'}">
               </div>
           </div>
        </Layout>
    </div>

       

    </div>
</template>

<script>

import Axios from 'axios';

import Template1 from "../../tempates/Template1"
// import Template2 from "../../tempates/Template2"
import DummyText from "../../dummy/dummyText.vue"
export default {
   
    components: {
     'template1':Template1,
    //  'template2':Template2,  
     'Dummy-text':DummyText

      },
    data() {
        return {
            isLoading:true,
            resume:{},
            changeTemplete:'change-templete',
            inShow:true,
            templete:'',
            selectTemp:true,
            experianceData:[],
            educationData:[],
            skillData:[],
            summaryData:[],
            customData:[],
            isGetExpData: [],
            isDownloaded:false,
            iconSize:13,
        //    experiences: this.resume?.experiences ?? [],
        //    educations: this.resume?.educations ?? [],
           fields: [],
           skills: [],
           summaries: []
        }
    },


   async mounted() {
            this.id = this.$route.params.id;
            console.log("hellwo from show methods")
            
            const { data } = await Axios.get(`/api/resumes/${this.id}`);
            this.resume = data;
            this.templete = data.templete
            this.isLoading = false
            console.log(this.resume)

            console.log(this.templete)

            console.log(this.$route.path === `/resumes/${this.id}/${this.templete}/download`)
      
         if(this.$route.path === `/resumes/${this.id}/${this.templete}/download`) {
                this.isDownloaded = true
        } else {
            this.isDownloaded = false
        }

    },

    methods: {


        selectTemplete(temp) {
            this.templete = temp
        },

        print() {
            // setTimeout(() => {WinPrint.focus(); WinPrint.print()}, 200)
            print();
        }
    }


   
}
</script>

<style scope>

    .print-container {
        padding: 23px 0px 23px 45rem;
    }
        .show {
        cursor:pointer;
        width: 190px;
        min-height: 239.263px;
    }

   /* ,show .little-spacer {
        padding:0;
    } */

    .ivu-layout-sider {
        flex: 0 0 259px !important;
        max-width: 240px !important;
        overflow: scroll;
        overflow-x: hidden
    }

    .show .sideBar {
      width: 29%;
    }

    .show .big-heading {
    font-size: 9px;
}

.show .headline {
    padding: 0.5rem 0rem 0.5rem 0rem;
}

.resume-container {
    margin: 26px 0px 0px 16px;
}

</style>