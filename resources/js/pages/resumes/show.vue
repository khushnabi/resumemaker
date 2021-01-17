<template>
    <div>
         <div class="layout">
        <Layout>
            <Sider class="print-hidden" breakpoint="md" collapsible :collapsed-width="78">
                <Menu active-name="1-2" theme="dark" width="auto">
                    <MenuItem name="1-1">
                        <Icon type="ios-navigate"></Icon>
                        <span @click="selectTemplete('template1')">Template1</span>
                    </MenuItem>
                    <MenuItem name="1-2">
                        <Icon type="ios-search"></Icon>
                        <span @click="selectTemplete('template2')">Template2</span>
                    </MenuItem>
                    <MenuItem name="1-3">
                        <Icon type="ios-settings"></Icon>
                        <span>Profile</span>
                    </MenuItem>
                </Menu>
                <div slot="trigger"></div>
            </Sider>
           <div class="container">
                <Layout :style="{padding:'0rem 8rem 3rem 8rem'}">
                <div>
                        <div class="print-hidden">
                            <Button type="primary" @click="print()">print</Button>
                       </div>
                    </div>
                <div class="print-hidden" v-if="isDownloaded">
                     <router-link  :to="`/resumes/${resume.templete}/${resume.id}/final`"><h1><Icon type="md-close" /></h1></router-link>
                </div>
                <div class="print-hidden" v-else>
                   <router-link :to="`/resumes/${resume.id}/edit`"><h1><Icon type="md-close" /></h1></router-link>
                </div>

                <Content :style="{background: '#fff', minHeight: '220px'}">
                    
                    <component 
                          :is='templete' :iconSize="iconSize" :changeTemplete='changeTemplete' :isDownloaded='isDownloaded' :inShow="inShow" :resume='resume'>
                    </component>
                          
                </Content>
            </Layout>
           </div>
        </Layout>
    </div>

       

    </div>
</template>

<script>

import Axios from 'axios';

import Template1 from "../../tempates/Template1"
import Template2 from "../../tempates/Template2"
export default {
   
    components: {
     'template1':Template1,
     'template2':Template2
     

      },
    data() {
        return {
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
            print();
        }
    }


   
}
</script>
