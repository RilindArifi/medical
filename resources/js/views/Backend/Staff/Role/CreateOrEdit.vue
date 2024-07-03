<script setup>
import {onBeforeMount, ref, watch} from 'vue'
import useForm from "@/composables/form.js"
import {required} from "@vuelidate/validators"
import {ACTIVE} from "@/enums/status-global.js"
import {useRoute, useRouter} from "vue-router"
import useModelOperations from "@/composables/model-operations.js"
import {message} from "ant-design-vue"
import RButton from "@/components/RButton.vue"
import GeneralForm from "@/components/form/General.vue"
import Addresses from "@/components/form/Addresses.vue"
import RolePermissions from "@/views/Backend/Staff/RolePermissions.vue"

const
    model     = ref({}),
    models = useModelOperations('roles'),
    route = useRoute(),
    router = useRouter(),
    modelId = route.params.id,

    permission   = useModelOperations('permissions'),
    options      = ref([]),
    expandedKeys = ref([]),
    permissions  = ref([]),

    {isLoading, state, fieldError, prepareRequest, rules, v$, errors} = useForm({
      loadModel: !!modelId,
      useFormChanges: true,
      model: model,
      onLoadModel: (model) => ({
        name: model['name'],
        permissions: model['permissions'],
      }),
      initialState: {
        name: [],
        permissions: []
      },
      rules: {
        name:       {required}
      }
    }),

    checkedKeys  = ref([]),

    fetchPermissions = () => {
      isLoading.value = true
      permission.fetchData()
          .then(response => {
            permissions.value = response.data
          }).finally(() => isLoading.value = false)
    },

    onSubmit = async () => {
      errors.value = {}
      const result = await v$.value.$validate();

      if(!result){
        return;
      }
      await prepareRequest(() => (modelId ? models.updateAction(modelId, state.value) : models.storeAction(state.value))
          .then((response) => {
            message.success(`Role was successfully ${modelId ? 'updated' : 'created'}.`)
            router.push({name: 'roles.edit', params:{id: response.data.data.id}})
          }))
    }

    if(modelId) {
      isLoading.value = true
      models.fetchSingle(modelId)
          .then(response => {
            model.value = response.data.data
            checkedKeys.value = response.data.data.permissions?.map(permission => permission.name) ?? []
          }).finally(() => isLoading.value = false)
    }

    watch(checkedKeys, () => {
      state.value.permissions = []
      const numericPattern = /\b\d+-\d+\b/;

      checkedKeys.value.forEach(element => {
        if (!numericPattern.test(element)) {
          state.value.permissions.push(element)
        }
      });
    })

    onBeforeMount(() => {
      fetchPermissions()
    })

</script>

<template>
  <div class="page-wrapper">
    <div class="content">
      <breadcrumb title="Roles" :text="modelId ? 'Update Role' : 'New Role'" path="/roles" />
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <a-spin :spinning="isLoading">
                <form
                    @submit.prevent="onSubmit"
                >
                  <div class="row">
                    <div class="col-12">
                      <div class="form-heading">
                        <h4>{{modelId ? 'Update Role' : 'New Role'}}</h4>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-6">
                      <div class="input-block local-forms">
                        <label>Role <span class="login-danger">*</span></label>
                        <input
                            v-model="state.name"
                            class="form-control"
                            :class="{ 'is-invalid': fieldError('name') }"
                        />
                        <div class="invalid-feedback">{{ fieldError('name') }}</div>
                      </div>
                    </div>
                    <div class="input-block">
                      <label>Permissions</label>
                      <a-tree
                          v-model:expandedKeys="expandedKeys"
                          v-model:checkedKeys="checkedKeys"
                          checkable
                          :tree-data="permissions"
                      />
                    </div>


                    <div class="col-12">
                      <div class="doctor-submit text-end">
                        <RButton class-b="btn btn-primary submit-form me-2" text="Submit"/>
                        <router-link :to="{ name: 'roles.index' }" class="btn btn-primary cancel-form"> Cancel </router-link>
                      </div>
                    </div>
                  </div>
                </form>
              </a-spin>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>