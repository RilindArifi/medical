import {createAcl, defineAclRules} from "vue-simple-acl";
import {ref} from "vue";
import axiosClient from "@/axios.js";
import router from "@/router/index.js";
import Cookies from "js-cookie";


const
    user = ref({}),

    rules = async () => defineAclRules((setRule) => {
        if(Cookies.get('token')) {
            axiosClient.get('user').then(response => {
                user.value = response.data.data
                const permissions = user.value.permissions?.map(permission => permission.name) || []
                permissions?.forEach((permission) => {
                    setRule(permission, (user) => permissions && permissions.includes(permission));
                });
                setRule(user.value.role, (user) => true);
            })
        }
    }),

    simpleAcl = createAcl({
        router,
        user,
        rules,
    });

export default simpleAcl;