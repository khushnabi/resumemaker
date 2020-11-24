<template>
    <div class="container">
          <div v-if="isCreating" class="resumes">
                <div>
                    <Icon @click="onClose()" type="md-close" />
                </div>
                <div class="forms">
                        <Heading :editId="editId" v-on:data="getData($event)"></Heading>
                </div>
                <div v-if="templet1" class="datas">
                    <ShowResume :resumeContent='resumeContent' :expContent='expContent'  :isGetExpData="isGetExpData" :educations="educations" :educationData="educationData" :skills="skills" :skillDatas="skillDatas" :summaries="summaries" :summariesData="summariesData"></ShowResume>   
                </div>
            </div>

            <div v-else-if="showTemplete">
                <div @click="simpleTemplete">
                    simple templete
                </div>
            </div>
            <div v-else>
                <div>
                        <div class="dashboard">
                                <div>
                                    <h1>Dashboard</h1>
                                </div>
                                <div><button class="primary" @click="onCreate">Create new</button></div>
                        </div>
                        <hr />
                        <div class="show-resumes">
                                <div v-for="(resumeData, i) in resumeDatas" :key="i"> 
                                    <div>
                                        <Card style="width:220px">
                                                <div style="text-align:center">
                                                <div>
                                                        <p> {{resumeData.first_name}}</p>
                                                            <img  v-if="resumeData.profile_img"  class="image" :src="resumeData.profile_img" alt="">
                                                        <Button type="default" @click="onEdit(resumeData.id)">edit</Button>
                                                        <Button type="error" @click="isDeleted(resumeData, i)">Delete</Button>
                                                        
                                                </div>
                                                        <Modal v-model="isDeletedModel" width="360">
                                                            <p slot="header" style="color:#f60;text-align:center">
                                                                <Icon type="ios-information-circle"></Icon>
                                                                <span>Delete confirmation</span>
                                                            </p>
                                                            <div style="text-align:center">
                                                                <p>{{delete_data.first_name}} will be deleted</p>
                                                                <p>Will you delete it?</p>
                                                            </div>
                                                            <div slot="footer">
                                                                <Button type="error" size="large" long  @click="onDelete(delete_data, delete_data.id, index) " :loading="resumeData.isDeleting" :disabled="resumeData.isDeleting">Delete</Button>
                                                            </div>
                                                        </Modal>

                                                </div>
                                        </Card>
                                    </div>
                                <br />
                                </div>
                                <Button type="primary" @click="onCreate">Create new</Button>
                        </div>
                </div>
            </div>
        <div>
          

          
        </div>
        
    </div>
</template>



<script>



import Heading from './Heading';
import ShowResume from "./showResume";

export default {
    components:{
      Heading,
      ShowResume
    },
    data () {
        return {
            templet1:false,
            showTemplete:false,
            isGetExpData:[],
            summaries:{},
            summariesData:[],
            educations:{},
            educationData:[],
            isDeletedModel:false,
            index:1,
            editId:null,
            resumeDatas:{},
            isCreating:false,
            delete_data:{},
            resumeContent:{},
            expContent:{},
            skills:{},
            skillDatas:[]
        }
   
    },
   async mounted() {
       await this.getResumeData();
    },
    methods: {
        getData(obj) {
            console.log(obj[0])
           this.resumeContent = obj[0];
           this.expContent = obj[1]
           this.isGetExpData=obj[2]
           this.educationData=obj[3]
           this.educations = obj[4]
           this.skills = obj[5]
           this.skillDatas = obj[6]
           console.log('hillow from resume data');
           this.summaries = obj[7]
           console.log(this.summaries)
           this.summariesData = obj[8]
           console.log(this.summariesData)

        },
        onCreate() {
            this.showTemplete = true;
            this.isCreating = false
        },

        onClose() {
              this.isCreating=false;
              this.showTemplete = false
              this.editId = null;

        },
     async getResumeData() {
           const allDAta = await this.resumeApi('get', '/resume/get');
            this.resumeDatas = allDAta.data;
        },

        onEdit(id) {
            this.editId = id;
            this.isCreating=true;
        },

        isDeleted(resume, index) {
            this.delete_data=resume;
            this.index=index
            console.log(resume)
            this.isDeletedModel = true
        },

        simpleTemplete() {
            this.isCreating = true
            this.templet1 = true
            this.showTemplete = false
        },

      async onDelete(resume, id, index) {
          console.log(id);

            this.$set(resume, "isDeleting", true)
            const res = await this.resumeApi('post', "resume/"+ id +"/delete", resume)

            if(res.status===200) {
                this.resumeDatas.splice(index, 1)
                this.$Message.success(resume.first_name + ' is deleted!');
                this.isDeletedModel = false
            } else {
                  this.$Message.error('Fail!');
            }
        }
        

    },
    
}
</script>

<style>


    .container {
        width: 80%;
        margin: auto;
    }

    .dashboard {
        display: flex;
        justify-content: space-between;
    }

    .dashboard h1 {
            font-size: 2.3em;
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

    .resumes {
        display: flex;
    }

    .datas {
        flex: 1;
        border-left: 1px solid black;
    }
    .forms {
        flex: 1;
    }

    .show-resumes > div{
       display: inline-block;
       margin-left: 1rem;
       margin-top: 1rem;
    }

    .image{
        width: 40%;
        height:40%;
    }

</style>