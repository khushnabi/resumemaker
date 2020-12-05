<template>
    <div v-if="hasError" class="container">
        <Alert type="error">
            Something went wrong
            <span slot="desc">{{this.error}}</span>
        </Alert>
    </div>
    <div v-else class="container">
            <div v-if="isCreating" class="resumes">
                <div>
                    <Icon @click="onClose()" type="md-close" />
                </div>
                <div class="forms">
                    <Heading
                    :editId="editId" :emptyFormField="emptyFormField"
                    v-on:data="getData($event)"></Heading>
                </div>
                <div v-if="template1" class="datas">
                    <ShowResume :resumeContent='resumeContent' :expContent='expContent' :isGetExpData="isGetExpData" :educations="educations" :educationData="educationData" :skills="skills" :skillDatas="skillDatas" :summaries="summaries" :summariesData="summariesData" :editId="editId" :customs="customs" :customDatas="customDatas" v-on:template="getTemplate($event)"></ShowResume>
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
                                <div>
                                     <router-link :to="`/resumes/create`"> <Button type="primary">Create new</Button></router-link>
                                </div>
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
                                                        <router-link :to="`/resumes/${resumeData.id}/edit`"><Button type="default">Edit</Button></router-link>
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
                                <router-link :to="`/resumes/create`"> <Button type="primary">Create new</Button></router-link>
                               
                        </div>
                </div>
            </div>
        <div>
        </div>
    </div>
</template>

<script>
import Axios from "axios";
import ShowResume from "./showResume";
export default {
    components:{
      ShowResume
    },
    data () {
        return {
            hasError: false,
            emptyFormField:false,
            template1:false,
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
            skillDatas:[],
            customs:{},
            customDatas:[],
        }

    },
   async mounted() {
        await this.getResumeData();

    },
    methods: {
        getData(obj) {
           this.resumeContent = obj[0];
           this.expContent = obj[1]
           this.isGetExpData=obj[2]
           this.educationData=obj[3]
           this.educations = obj[4]
           this.skills = obj[5]
           this.skillDatas = obj[6]
           this.summaries = obj[7]
           this.summariesData = obj[8]
           this.customs = obj[9]
           this.customDatas = obj[10]

        },
        onCreate() {
            this.showTemplete = true;
            this.isCreating = false
        },

      async onClose() {
            this.resumeContent = {};
           this.expContent = {}
           this.isGetExpData=[]
           this.educationData=[]
           this.educations = {}
           this.skills = {}
           this.skillDatas = []
           this.summaries ={}
           this.summariesData = []
            this.customs = {}
            this.customDatas = []

            this.isCreating=false;
            this.showTemplete = false
            this.editId = null;
            await this.getResumeData();
        },
        async getResumeData() {
            try {
                const { data } = await Axios.get("/api/resumes");
                console.log(data)
                this.resumeDatas = data;
            } catch(err) {
                this.hasError = true;
                this.error = err.message;
            }
        },

        onEdit(id) {
            this.editId = id;
            this.isCreating = true
            this.template1 = true
            this.showTemplete = false
        },

        isDeleted(resume, index) {
            this.delete_data=resume;
            this.index=index
            this.isDeletedModel = true
        },

        simpleTemplete() {
            this.isCreating = true
            this.template1 = true
            this.showTemplete = false
        },

        getTemplate(template) {
           this.template1=template

        },

      async onDelete(resume, id, index) {
           try {
                this.$set(resume, "isDeleting", true)
                const { data } = await Axios.delete(`/api/resumes${id}/delete`);
                this.resumeDatas.splice(index, 1)
                this.$Message.success(resume.first_name + ' is deleted!');
                this.isDeletedModel = false

            } catch(err) {
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
