<script setup>
import { ref } from 'vue'
import useForm from "@/composables/form.js";
import {required} from "@vuelidate/validators";
import {ACTIVE, INACTIVE} from "@/enums/status-global.js";
import RadioStatus from "@/components/RadioStatus.vue";
import {useRoute, useRouter} from "vue-router";
import useModelOperations from "@/composables/model-operations.js";
import {dateFormat} from "@/utils/strings.js";
import {message} from "ant-design-vue";
import router from "@/router/index.js";
import RButton from "@/components/RButton.vue";

const
    model = ref({}),
    models = useModelOperations('taxes'),
    route = useRoute(),
    modelId = route.params.id,
    {isLoading, state, fieldError, prepareRequest, rules, v$, initialState, errors} = useForm({
      loadModel: !!modelId,
      useFormChanges: true,
      model: model,
      onLoadModel: (model) => ({
        name: model['name'],
        percentage: model['percentage'],
        information: model['information'],
        status: model['status'],
      }),
      initialState: {
        name: null,
        percentage: null,
        information: null,
        status: INACTIVE,
      },
      rules: {
        name: {required},
        percentage: {required},
        status: {required},
      }
    }),

    onSubmit = async () => {
      errors.value = {}
      const result = await v$.value.$validate();

      if(!result){
        return;
      }
      await prepareRequest(() => (modelId ? models.updateAction(modelId, state.value) : models.storeAction(state.value))
          .then((response) => {
            message.success(`Tax was successfully ${modelId ? 'updated' : 'created'}.`)
            return router.push({name: 'taxes.edit', params:{id: response.data.data.id}})
          }))
    }

if(modelId) {
  isLoading.value = true
  models.fetchSingle(modelId)
      .then(response => {
        model.value = response.data.data
      }).finally(() => isLoading.value = false)
}

</script>


<template>
  <div class="page-wrapper">
    <div class="content">
      <!-- Page Header -->
      <breadcrumb title="Taxes" :text="modelId ? 'Update Tax' : 'Add Tax'" :path="{name: 'taxes.index'}" />
      <!-- /Page Header -->
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
                    <h4>{{modelId ? 'Update Tax' : 'Add Tax'}}</h4>
                  </div>
                </div>
                <div class="col-12 col-md-6 col-xl-6">
                  <div class="input-block local-forms">
                    <label>Tax name <span class="login-danger">*</span></label>
                    <input
                        v-model="state.name"
                        class="form-control"
                        type="text"
                    :class="{ 'is-invalid': fieldError('name') }"
                    />
                    <div class="invalid-feedback">{{ fieldError('name') }}</div>
                  </div>
                </div>
                <div class="col-12 col-md-6 col-xl-6">
                  <div class="input-block local-forms">
                    <label>Tax Percentage <span class="login-danger">*</span></label>
                    <input
                        v-model="state.percentage"
                        class="form-control"
                        type="text"
                        :class="{ 'is-invalid': fieldError('percentage') }"
                    />
                    <div class="invalid-feedback">{{ fieldError('percentage') }}</div>
                  </div>
                </div>
                <div class="col-12 col-sm-12">
                  <div class="input-block local-forms">
                    <label>Other Information</label>
                    <textarea v-model="state.information" class="form-control" rows="3" cols="30" :class="{ 'is-invalid': fieldError('information') }"></textarea>
                  <div class="invalid-feedback">{{ fieldError('information') }}</div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-xl-6">
                <div class="input-block select-gender">
                  <label class="gen-label">Status <span class="login-danger">*</span></label>
                  <radio-status v-model:value="state.status" :class="{ 'is-invalid': fieldError('status') }"/>
                  <div class="invalid-feedback">{{ fieldError('status') }}</div>
                </div>
              </div>
              <div class="col-12">
                <div class="doctor-submit text-end">
                  <r-button text="Submit" :is-loading="isLoading" class-b="btn btn-primary submit-form me-2"/>
                  <router-link :to="{name: 'taxes.index'}" type="submit" class="btn btn-primary cancel-form">Cancel</router-link>
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

