<template>
  <div class="staff-search-table">
    <form>
      <div class="row">
        <div class="col-12 col-md-6 col-xl-3">
          <div class="input-block local-forms">
            <label>Purchased by </label>
            <vue-select
              :options="SelectReport"
              id="selectreport"
              placeholder="Select Purchase by"
            />
          </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
          <div class="input-block local-forms cal-icon">
            <label>From </label>
            <datepicker
              v-model="startdate"
              :input-format="dateFormat"
              class="form-control datetimepicker"
              :editable="true"
              :clearable="false"
              placeholder=""
            />
          </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
          <div class="input-block local-forms cal-icon">
            <label>To </label>
            <datepicker
              v-model="startdate1"
              :input-format="dateFormat"
              class="form-control datetimepicker"
              :editable="true"
              :clearable="false"
              placeholder=""
            />
          </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
          <div class="doctor-submit">
            <button type="submit" class="btn btn-primary submit-list-form me-2">Search</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>
<script>
import { ref } from 'vue'
const currentDate = ref(new Date())
const currentDate1 = ref(new Date())
export default {
  data() {
    return {
      startdate: currentDate,
      startdate1: currentDate1,
      dateFormat: 'dd-MM-yyyy',
      SelectReport: ['Bernardo James', 'Bernadro James', 'Galaviz Lalema', 'Tarah Williams']
    }
  }
}
</script>
