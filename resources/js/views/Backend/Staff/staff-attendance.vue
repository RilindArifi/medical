<template>
  <div class="page-wrapper">
    <div class="content">
      <!-- Page Header -->
      <breadcrumb :title="title" :text="text" path="staff-list" />
      <!-- /Page Header -->

      <div class="row">
        <div class="col-sm-12">
          <div class="card card-table show-entire">
            <div class="card-body">
              <!-- Table Header -->
              <div class="page-table-header mb-2">
                <div class="row align-items-center">
                  <div class="col">
                    <div class="doctor-table-blk">
                      <h3>Attandance Sheet</h3>
                      <div class="doctor-search-blk">
                        <div class="top-nav-search table-search-blk">
                          <form>
                            <input type="text" class="form-control" placeholder="Search here" />
                            <a class="btn"
                              ><img src="@/assets/img/icons/search-normal.svg" alt=""
                            /></a>
                          </form>
                        </div>
                        <div class="add-group">
                          <a href="javascript:;" class="btn btn-primary add-pluss ms-2"
                            ><img src="@/assets/img/icons/plus.svg" alt=""
                          /></a>
                          <a href="javascript:;" class="btn btn-primary doctor-refresh ms-2"
                            ><img src="@/assets/img/icons/re-fresh.svg" alt=""
                          /></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-auto text-end float-end ms-auto download-grp">
                    <a href="javascript:;" class="me-2"
                      ><img src="@/assets/img/icons/pdf-icon-01.svg" alt=""
                    /></a>
                    <a href="javascript:;" class="me-2"
                      ><img src="@/assets/img/icons/pdf-icon-02.svg" alt=""
                    /></a>
                    <a href="javascript:;" class="me-2"
                      ><img src="@/assets/img/icons/pdf-icon-03.svg" alt=""
                    /></a>
                    <a href="javascript:;"
                      ><img src="@/assets/img/icons/pdf-icon-04.svg" alt=""
                    /></a>
                  </div>
                </div>
              </div>
              <!-- /Table Header -->
              <div class="staff-search-table">
                <form>
                  <div class="row">
                    <div class="col-12 col-md-6 col-xl-4">
                      <div class="input-block local-forms">
                        <label>Employee Name </label>
                        <input class="form-control" type="text" />
                      </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-4">
                      <div class="input-block local-forms">
                        <label>Year </label>
                        <vue-select :options="Years" id="selectyear" placeholder="Select Year" />
                      </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-4">
                      <div class="input-block local-forms">
                        <label>Month </label>
                        <vue-select :options="Month" id="selectmonth" placeholder="Select Month" />
                      </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-4">
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
                    <div class="col-12 col-md-6 col-xl-4">
                      <div class="input-block local-forms cal-icon">
                        <label>To </label>
                        <datepicker
                          v-model="startdateOne"
                          :input-format="dateFormat"
                          class="form-control datetimepicker"
                          :editable="true"
                          :clearable="false"
                          placeholder=""
                        />
                      </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-4">
                      <div class="doctor-submit">
                        <button type="submit" class="btn btn-primary submit-list-form me-2">
                          Submit
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="table-responsive">
                <table class="table border-0 custom-table attent-table datatable mb-0">
                  <thead>
                    <tr>
                      <th>September</th>
                      <th>01</th>
                      <th>02</th>
                      <th>03</th>
                      <th>04</th>
                      <th>05</th>
                      <th class="week-days">06</th>
                      <th class="week-days">07</th>
                      <th>08</th>
                      <th>09</th>
                      <th>10</th>
                      <th>11</th>
                      <th>12</th>
                      <th class="week-days">13</th>
                      <th class="week-days">14</th>
                      <th>15</th>
                      <th>16</th>
                      <th>17</th>
                      <th>18</th>
                      <th>19</th>
                      <th class="week-days">20</th>
                      <th class="week-days">21</th>
                      <th>22</th>
                      <th>23</th>
                      <th>24</th>
                      <th>25</th>
                      <th>26</th>
                      <th class="week-days">27</th>
                      <th class="week-days">28</th>
                      <th>29</th>
                      <th>30</th>
                      <th>31</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="month-table">
                        <h5>Andrea Lalema</h5>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                    </tr>
                    <tr>
                      <td class="month-table">
                        <h5>Smith Bruklin</h5>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                    </tr>
                    <tr>
                      <td class="month-table">
                        <h5>Galaviz Lalema</h5>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                    </tr>
                    <tr>
                      <td class="month-table">
                        <h5>Mark Hay Smith</h5>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                    </tr>
                    <tr>
                      <td class="month-table">
                        <h5>Cristina Groves</h5>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="present-table attent-status"
                          ><i class="feather-check"></i
                        ></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                      <td>
                        <span class="absent-table attent-status"><i class="feather-x"></i></span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue'
const currentDate = ref(new Date())
const currentDateOne = ref(new Date())
export default {
  data() {
    return {
      title: 'Staffs',
      text: 'Attandance Sheet',
      startdate: currentDate,
      startdateOne: currentDateOne,
      dateFormat: 'dd-MM-yyyy',
      Years: ['Select Year', '2022', '2021', '2020', '2019', '2018', '2017'],
      Month: ['Select Month', 'December', 'November', 'October', 'September']
    }
  }
}
</script>
