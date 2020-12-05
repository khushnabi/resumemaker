import Axios from "axios"

export default {
    data() {
        return {

        }
    },
  methods: {
         resumeApi(method, url, dataobj) {
            return Axios({
                method: method,
                url: url,
                data: dataobj
            });
        }
    },  
}