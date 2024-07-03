<script setup>
import {ref} from "vue";
import useModelOperations from "@/composables/model-operations.js";
import {useRoute, useRouter} from "vue-router";
import useForm from "@/composables/form.js";
import {required} from "@vuelidate/validators";
import {message} from "ant-design-vue";
import StaffSelect from "@/components/staff/StaffSelect.vue";
import {useAuthStore} from "@/stores/auth.js";
import {ACTIVE, INACTIVE} from "@/enums/status-global.js";
import {BRUTO, NETO} from "@/enums/salary-type.js";
import RadioStatus from "@/components/RadioStatus.vue";
import {dateFormat} from "@/utils/strings.js";


const
    options   = ref([]),
    model     = ref({}),
    models    = useModelOperations('employee_salaries'),
    route     = useRoute(),
    router    = useRouter(),
    modelId   = route.params.id,
    authStore = useAuthStore(),

    {isLoading, state, fieldError, prepareRequest, rules, v$, initialState, errors} = useForm({
      loadModel: !!modelId,
      useFormChanges: true,
      model: model,
      onLoadModel: (model) => ({
        salary_type: model['salary_type'],
        salary: model['salary'],
        bonus: model['bonus'],
        user_id: model['user_id'],
        status: model['status'],
      }),
      initialState: {
        salary_type: null,
        salary: null,
        bonus: null,
        user_id: null,
        status: modelId ? '' : INACTIVE,
      },
      rules: {
        salary_type: {required},
        salary: {required},
        status: {required},
        user_id: {required},
      }
    }),
    salary_types = ref([
      {value: BRUTO, label: BRUTO},
      {value: NETO, label: NETO},
    ]),
    focusHandle = async (opened) => {
      if (opened) {
        options.value
      }
    },

    onSubmit = async () => {
      errors.value = {}
      const result = await v$.value.$validate();

      if(!result){
        return;
      }
      await prepareRequest(() => (modelId ? models.updateAction(modelId, state.value) : models.storeAction(state.value))
          .then((response) => {
            message.success(`Employee Salary was successfully ${modelId ? 'updated' : 'created'}.`)
            router.push({name: 'employees_salaries.edit', params:{id: response.data.data.id}})
          }))
    }

</script>

<template>
  <div class="page-wrapper">
    <div class="content">
      <!-- Page Header -->
      <breadcrumb title="Salaries List" text="Add Salary" path="/payroll/salary" />
      <!-- /Page Header -->
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <a-spin :spinning="isLoading">
                <form @submit.prevent="onSubmit">
                <div class="row">
                  <div class="col-12">
                    <div class="form-heading">
                      <h4>Add Employee Salary</h4>
                    </div>
                  </div>
                  <div class="col-12 col-md-12 col-xl-12">
                    <div class="input-block local-forms">
                      <label>Staff Name <span class="login-danger">*</span></label>
                      <staff-select
                        v-model:value="state.user_id"
                        :class="{ 'is-invalid': fieldError('user_id') }"
                      />
                      <div class="invalid-feedback">{{ fieldError('user_id') }}</div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-xl-6">
                    <div class="input-block local-forms">
                      <label>Salary <span class="login-danger">*</span></label>
                      <input
                          v-model="state.salary"
                          class="form-control"
                          type="number"
                          :class="{ 'is-invalid': fieldError('salary') }"
                      />
                      <div class="invalid-feedback">{{ fieldError('salary') }}</div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-xl-6">
                    <div class="input-block local-forms">
                      <label>Salary type <span class="login-danger">*</span></label>
                      <a-select
                          v-model:value="state.salary_type"
                          show-search
                          class="form-control"
                          :class="{ 'is-invalid': fieldError('salary_type') }"
                          :options="salary_types"
                          @dropdownVisibleChange="focusHandle"
                      />
                      <div class="invalid-feedback">{{ fieldError('salary_type') }}</div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-xl-6">
                    <div class="input-block local-forms">
                      <label>Salary term <span class="login-danger">*</span></label>
                      <input
                          v-model="state.salary_term"
                          class="form-control"
                          type="number"
                          :class="{ 'is-invalid': fieldError('salary_term') }"
                      />
                      <div class="invalid-feedback">{{ fieldError('salary_term') }}</div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-xl-6">
                    <div class="input-block local-forms">
                      <label>Date hired <span class="login-danger">*</span></label>
                      <a-date-picker
                          v-model:value="state.date_hired"
                          value-format="YYYY-MM-DD"
                          :format="dateFormat()"
                          class="form-control datetimepicker"
                          placeholder=""
                          :suffix-icon="false"
                          :class="{ 'is-invalid': fieldError('date_hired') }"
                      />
                      <div class="invalid-feedback">{{ fieldError('date_hired') }}</div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-xl-6">
                    <div class="input-block local-forms">
                      <label>Bonus</label>
                      <input
                          v-model="state.bonus"
                          class="form-control"
                          type="number"
                          :class="{ 'is-invalid': fieldError('bonus') }"
                      />
                      <div class="invalid-feedback">{{ fieldError('bonus') }}</div>
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
                      <button type="submit" class="btn btn-primary submit-form me-2">Submit</button>
                      <router-link :to="{name: 'employee_salaries.index'}" class="btn btn-primary cancel-form">Cancel</router-link>
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

