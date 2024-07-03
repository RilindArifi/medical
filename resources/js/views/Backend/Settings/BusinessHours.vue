<script setup>
import DaysSelect from "@/components/schedule/DaysSelect.vue";
import {dateFormat, timeFormat} from "@/utils/strings.js";
import {h, onBeforeMount, onMounted, reactive, ref, watch} from "vue";
import { DeleteOutlined } from "@ant-design/icons-vue";
import { useSettingsStore } from "@/stores/settings.js";

const props = defineProps({
      state: Object,
      fieldError: Function
    }),
    settingsStore = useSettingsStore(),

    exceptionDates = reactive({
      holidays: []
    }),
    getError = (key) =>  props.fieldError(key),

    removeHoliday = (item) => {
      const index = exceptionDates.holidays.indexOf(item);
      if (index !== -1) {
        exceptionDates.holidays.splice(index, 1);
      }
    },

    addHoliday = () => {
      exceptionDates.holidays.push({ date: '', description: '' });
    },

    sendHolidaysToState = () => {
      props.state.holidays = [...exceptionDates.holidays];
    };

    watch(() => exceptionDates.holidays, () => {
      sendHolidaysToState();
    }, { deep: true });

    onBeforeMount(async () => {
      exceptionDates.holidays = settingsStore.setting('holidays');
    })
</script>

<template>
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title">Working days </h5>
        </div>
        <div class="card-body pt-0">
          <div class="settings-form">
            <div class="input-block local-forms">
              <label>Days <span class="star-red">*</span></label>
              <DaysSelect v-model:value="state.working_days"/>
              <div class="invalid-feedback">{{ getError('working_days') }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title">Working hours</h5>
        </div>
        <div class="card-body pt-0">
          <a-time-range-picker
              v-model:value="state.working_hours"
              value-format="HH:mm"
              :format="timeFormat()"
          />
          <div class="invalid-feedback">{{ getError('working_hours') }}</div>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title">Annual holidays </h5>
        </div>
        <div class="card-body pt-0">
          <form>
            <div class="settings-form">
              <div class="input-block">
                <div class="row" v-for="holiday in exceptionDates.holidays" :key="holiday.date">
                  <div class="col-12 col-md-3 col-xl-3">
                    <div class="input-block local-forms cal-icon">
                      <label>Date<span class="star-red">*</span></label>
                      <a-date-picker
                          v-model:value="holiday.date"
                          value-format="YYYY-MM-DD"
                          :format="dateFormat()"
                          class="form-control datetimepicker"
                          placeholder=""
                          :suffix-icon="false"
                      />
                    </div>
                  </div>
                  <div class="col-12 col-md-8 col-xl-8">
                    <div class="input-block local-forms">
                      <label>Holiday<span class="star-red">*</span></label>
                      <textarea
                          v-model="holiday.description"
                          class="form-control"
                          type="text"
                      />
                    </div>
                  </div>
                  <div class="col-md-1 col-xl-1">
                    <a-button @click.prevent="removeHoliday(holiday)" class="d-flex justify-content-center align-items-center" danger shape="circle" :icon="h(DeleteOutlined)" />
                  </div>
                  <div class="invalid-feedback">{{ getError('holidays') }}</div>
                </div>
              </div>
            </div>
            <div class="input-block mb-0">
              <div class="settings-btns">
                <button
                    @click.prevent="addHoliday"
                    class="border-0 btn btn-primary btn-gradient-primary btn-rounded"
                >
                  Add Holiday
                </button>&nbsp;&nbsp;
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>