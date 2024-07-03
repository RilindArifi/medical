<script setup>
import LeaveTypeSelect from "@/components/leaves/LeaveTypeSelect.vue";
import {onBeforeMount, onMounted, ref, watch} from "vue";
import useModelOperations from "@/composables/model-operations.js";
import {useRoute, useRouter} from "vue-router";
import useForm from "@/composables/form.js";
import {required} from "@vuelidate/validators";
import {message} from "ant-design-vue";
import StaffSelect from "@/components/staff/StaffSelect.vue";
import {useAuthStore} from "@/stores/auth.js";
import {dateFormat, timeFormat} from "@/utils/strings.js";
import {PENDING} from "@/enums/status-appointments.js";
import moment from "moment";
import {useSettingsStore} from "@/stores/settings.js";


const
    settingStore = useSettingsStore(),
    options   = ref([]),
    model     = ref({}),
    models    = useModelOperations('leaves'),
    route     = useRoute(),
    router    = useRouter(),
    modelId   = route.params.id,
    authStore = useAuthStore(),

    {isLoading, state, fieldError, prepareRequest, rules, v$, initialState, errors} = useForm({
      loadModel: !!modelId,
      useFormChanges: true,
      model: model,
      onLoadModel: (model) => ({
        leave_type_id: model['leave_type_id'],
        user_id: model['user_id'],
        from: model['from'],
        to: model['to'],
        duration: model['duration'],
        days: model['days'],
        hours: model['hours'],
        reason: model['reason'],
        status: model['status'],
      }),
      initialState: {
        leave_type_id: null,
        user_id: authStore.user.id,
        from: null,
        to: null,
        duration: null,
        days: null,
        hours: null,
        reason: null,
        status: modelId ? '' : PENDING,
      },
      rules: {
        leave_type_id: {required},
        duration: {required},
        status: {required},
        user_id: {required},
        from: {required},
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
            message.success(`Leave was successfully ${modelId ? 'updated' : 'created'}.`)
            router.push({name: 'leaves.edit', params:{id: response.data.data.id}})
          }))
    },
    daysWork       = ref(settingStore.setting('working_days') ?? []),
    exceptionDates = ref(settingStore.setting('holidays') ?? []),

    handleDays = (newStartDate, newEndDate) => {
      const startDate = moment(newStartDate, dateFormat());
      const endDate = moment(newEndDate, dateFormat());
      let totalDays = 0;

      if (startDate.isValid() && endDate.isValid()) {
        for (let currentDay = startDate.clone(); currentDay.isSameOrBefore(endDate); currentDay.add(1, 'days')) {
          if (daysWork.value.includes(currentDay.format('dddd'))) {
            totalDays++;
          }
        }
      }
      exceptionDates.value.forEach(function (holiday) {
        if (holiday.date) {
          const holidayDate = moment(holiday.date, dateFormat());
          if (
              holidayDate.isSameOrAfter(startDate, 'day') &&
              holidayDate.isSameOrBefore(endDate, 'day') &&
              daysWork.value.includes(holidayDate.format('dddd'))
          ) {
            totalDays--;
          }
        }
      });

      state.value.days = totalDays < 0 ? 0 : totalDays
      state.value.hours = totalDays < 0 ? 0 : totalDays * 24
    },
    calculateHoursDifference = () => {
      const working_hours = settingStore.setting('working_hours'),
            startTime = moment(working_hours[0], timeFormat()),
            endTime = moment(working_hours[1], timeFormat()),
            duration = moment.duration(endTime.diff(startTime));
      return duration.hours();
    },
    pushHours = () => {
      for (let i = 1; i <= calculateHoursDifference(); i++){
        options.value.push({
          value: i,
          label: i
        })
      }
    },
    handleChange = async (opened) => {
      if (opened) {
        options.value
      }
    }

watch(
    [() => state.value.from, () => state.value.to],
    ([newStartDate, newEndDate]) => {
      handleDays(newStartDate, newEndDate)
    },
    { deep: true }
);

watch(
    () => state.value.duration,
    (newState) => {
      if(newState.includes('Single day') || newState.includes('Hours')) {
        state.value.to = null
        state.value.days = 1
      }
    },
    { deep: true }
);
if(modelId) {
  isLoading.value = true
  models.fetchSingle(modelId)
      .then(response => {
        model.value = response.data.data
      }).finally(() => isLoading.value = false)
}

onBeforeMount(async () => {
  pushHours()
})


</script>

<template>
  <div class="page-wrapper">
    <div class="content">
      <!-- Page Header -->
      <breadcrumb title="Leave List" text="Leave Request" path="/leaves" />
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
                      <h4>Add Leave Request</h4>
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-xl-6">
                    <div class="input-block local-forms">
                      <label>Leave Type <span class="login-danger">*</span></label>
                      <leave-type-select
                          :class="{ 'is-invalid': fieldError('leave_type_id') }"
                          v-model:value="state.leave_type_id"
                      />
                      <div class="invalid-feedback">{{ fieldError('leave_type_id') }}</div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-xl-6">
                    <div class="input-block local-forms">
                      <label>Staff Name <span class="login-danger">*</span></label>
                      <staff-select
                        v-model:value="state.user_id"
                      />
                      <div class="invalid-feedback">{{ fieldError('user_id') }}</div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-xl-6 mb-4">
                      <label>Duration <span class="login-danger">*</span></label><br />
                      <a-radio-group v-model:value="state.duration" button-style="solid" class="form-control" :class="{ 'is-invalid': fieldError('duration') }">
                        <a-radio-button value="Single day">Single day</a-radio-button>
                        <a-radio-button value="Multiple days">Multiple days</a-radio-button>
                        <a-radio-button value="Hours">Hours</a-radio-button>
                      </a-radio-group>
                    <div class="invalid-feedback">{{ fieldError('duration') }}</div>
                  </div>
                  <div class="col-12 col-md-6 col-xl-6">
                  </div>
                  <div class="col-12 col-md-6 col-xl-6">
                    <div class="input-block local-forms cal-icon">
                      <label>From <span class="login-danger">*</span></label>
                      <a-date-picker
                          v-model:value="state.from"
                          placeholder="Select Date"
                          class="form-control datetimepicker"
                          :suffix-icon="false"
                          value-format="YYYY-MM-DD"
                          :format="dateFormat()"
                          :class="{ 'is-invalid': fieldError('from') }"
                      />
                      <div class="invalid-feedback">{{ fieldError('from') }}</div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-xl-6" v-if="state.duration === 'Multiple days'">
                    <div class="input-block local-forms cal-icon">
                      <label>To</label>
                      <a-date-picker
                          v-model:value="state.to"
                          placeholder="Select Date"
                          class="form-control datetimepicker"
                          :suffix-icon="false"
                          value-format="YYYY-MM-DD"
                          :format="dateFormat()"
                          :class="{ 'is-invalid': fieldError('to') }"
                      />
                      <div class="invalid-feedback">{{ fieldError('to') }}</div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-xl-6" v-else-if="state.duration === 'Hours'">
                    <div class="input-block local-forms ">
                      <label>Hours</label>
                      <a-select
                          v-model:value="state.hours"
                          class="form-control"
                          style="width: 100%"
                          :options="options"
                          @change="handleChange"
                      ></a-select>
                    </div>
                  </div>
                  <div class="col-12 col-md-12 col-xl-12">
                    <div class="input-block local-forms">
                      <label>Number of Days</label>
                      <p class="form-control d-flex" type="text" >{{state.days}}&nbsp; <p v-if="state.hours">  ({{state.hours}} hours)</p></p>
                    </div>
                  </div>
                  <div class="col-12 col-sm-12">
                    <div class="input-block local-forms">
                      <label>Leave Reason </label>
                      <textarea class="form-control" rows="3" cols="30"></textarea>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="doctor-submit text-end">
                      <button type="submit" class="btn btn-primary submit-form me-2">Submit</button>
                      <router-link :to="{name: 'leaves.index'}" class="btn btn-primary cancel-form">Cancel</router-link>
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

