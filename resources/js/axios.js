import Axios from "axios"

export default {
    data() {
        return {

        }
    },
    methods: {
       async resumeApi(method, url, dataobj) {
            try {
               return await axios({
                    method:method,
                    url:url,
                    data:dataobj
                });
            } catch (e) {
                return e.response
            }
        }
    },  
}