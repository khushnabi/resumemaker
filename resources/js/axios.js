import Axios from "axios"

export default {
    data() {
        return {
            globalVar:"somthing si interesting"
        }
    },
  methods: {
         resumeApi(globalVar) {
            return this.globalVar = globalVar;
        }
    },  
}