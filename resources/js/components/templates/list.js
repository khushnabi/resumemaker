import Gratus from "./gratus.vue";
import gratusThumbnail from "../../assets/gratus.png";
const templateList = {
    default: {
        component: Gratus,
    },
    gratus: {
        component: Gratus,
        thumbnail: gratusThumbnail
    }
}

export default templateList;
