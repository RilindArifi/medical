<template>
  <div class="page-wrapper">
    <div class="content">
      <!-- Page Header -->
      <breadcrumb :title="title" :text="text" path="admin-dashboard" />
      <!-- /Page Header -->

      <div class="good-morning-blk">
        <div class="row">
          <div class="col-md-6">
            <div class="morning-user">
              <h2>Hello, <span>{{ authStore.user.name }}</span></h2>
              <p>Have a nice day at work</p>
            </div>
          </div>
          <div class="col-md-6 position-blk">
            <div class="morning-img">
              <img src="@/assets/img/morning-img-02.png" alt="" />
            </div>
          </div>
        </div>
      </div>

      <div class="doctor-list-blk">
        <div class="row">
          <div class="col-xl-3 col-md-6">
            <div class="doctor-widget border-right-bg">
              <div class="doctor-box-icon flex-shrink-0">
                <img src="@/assets/img/icons/doctor-dash-01.svg" alt="" />
              </div>
              <div class="doctor-content dash-count flex-grow-1">
                <h4>
<!--                  <vue3-autocounter-->
<!--                      class="counter-up"-->
<!--                      ref="counter"-->
<!--                      :startAmount="0"-->
<!--                      :delay="3"-->
<!--                      :endAmount="30"-->
<!--                      :duration="1"-->
<!--                      separator=","-->
<!--                      :autoinit="true"-->
<!--                  />-->
                  <span>/85</span><span class="status-green">+60%</span>
                </h4>
                <h5>Appointments</h5>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="doctor-widget border-right-bg">
              <div class="doctor-box-icon flex-shrink-0">
                <img src="@/assets/img/icons/doctor-dash-02.svg" alt="" />
              </div>
              <div class="doctor-content dash-count flex-grow-1">
                <h4>
<!--                  <vue3-autocounter-->
<!--                      class="counter-up"-->
<!--                      ref="counter"-->
<!--                      :startAmount="0"-->
<!--                      :delay="3"-->
<!--                      :endAmount="20"-->
<!--                      :duration="1"-->
<!--                      separator=","-->
<!--                      :autoinit="true"-->
<!--                  />-->
                  <span>/125</span><span class="status-pink">-20%</span>
                </h4>
                <h5>Consultations</h5>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="doctor-widget border-right-bg">
              <div class="doctor-box-icon flex-shrink-0">
                <img src="@/assets/img/icons/doctor-dash-03.svg" alt="" />
              </div>
              <div class="doctor-content dash-count flex-grow-1">
                <h4>
<!--                  <vue3-autocounter-->
<!--                      class="counter-up"-->
<!--                      ref="counter"-->
<!--                      :startAmount="0"-->
<!--                      :delay="3"-->
<!--                      :endAmount="12"-->
<!--                      :duration="1"-->
<!--                      separator=","-->
<!--                      :autoinit="true"-->
<!--                  />-->
                  <span>/30</span><span class="status-green">+40%</span>
                </h4>
                <h5>Operations</h5>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="doctor-widget">
              <div class="doctor-box-icon flex-shrink-0">
                <img src="@/assets/img/icons/doctor-dash-04.svg" alt="" />
              </div>
              <div class="doctor-content dash-count flex-grow-1">
                <h4>
                  $
<!--                  <vue3-autocounter-->
<!--                      class="counter-up"-->
<!--                      ref="counter"-->
<!--                      :startAmount="0"-->
<!--                      :delay="3"-->
<!--                      :endAmount="530"-->
<!--                      :duration="1"-->
<!--                      separator=","-->
<!--                      :autoinit="true"-->
<!--                  />-->
                  <span></span><span class="status-green">+50%</span>
                </h4>
                <h5>Earnings</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12 col-xl-7">
          <div class="card">
            <div class="card-body">
              <div class="chart-title patient-visit mb-0">
                <h4>Income</h4>
                <div class="income-value">
                  <h3><span>$</span> 20,560</h3>
                  <p>
                    <span class="passive-view"
                    ><i class="feather-arrow-up-right me-1"></i>40%</span
                    >
                    vs last month
                  </p>
                </div>
                <div class="input-block mb-0">
                  <vue-select :options="Years" placeholder="2022" />
                </div>
              </div>
              <div id="apexcharts-area"></div>
              <apexchart
                  type="line"
                  height="200"
                  :options="areaChart.chart"
                  :series="areaChart.series"
              >
              </apexchart>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-12 col-lg-6 col-xl-3 d-flex">
          <div class="card">
            <div class="card-body">
              <div id="radial-patients">
                <apexchart
                    type="donut"
                    height="400"
                    :options="donutChart.chart"
                    :series="donutChart.series"
                ></apexchart>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-12 col-lg-6 col-xl-2 d-flex">
          <div class="struct-point">
            <div class="card patient-structure">
              <div class="card-body">
                <h5>New Patients</h5>
                <h3>
                  56<span class="status-green"
                ><img
                    src="@/assets/img/icons/sort-icon-01.svg"
                    alt=""
                    class="me-1"
                />60%</span
                >
                </h3>
              </div>
            </div>
            <div class="card patient-structure">
              <div class="card-body">
                <h5>Old Patients</h5>
                <h3>
                  35<span class="status-pink"
                ><img
                    src="@/assets/img/icons/sort-icon-02.svg"
                    alt=""
                    class="me-1"
                />-20%</span
                >
                </h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-12 col-xl-7">
          <div class="card">
            <div class="card-body">
              <div class="chart-title patient-visit">
                <h4>Activity Chart</h4>
                <div>
                  <ul class="nav chat-user-total">
                    <li><i class="fa fa-circle low-users" aria-hidden="true"></i>Low</li>
                    <li>
                      <i class="fa fa-circle current-users" aria-hidden="true"></i> High
                    </li>
                  </ul>
                </div>
                <div class="input-block mb-0">
                  <vue-select :oprions="Days" placeholder="This Week" />
                </div>
              </div>
              <div id="activity-chart">
                <apexchart
                    type="bar"
                    height="250"
                    :options="sColStacked.chart"
                    :series="sColStacked.series"
                ></apexchart>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-md-12 col-xl-8">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title d-inline-block">Recent Appointments</h4>
                  <router-link to="/appointments/appointments-list" class="patient-views float-end"
                  >Show all</router-link
                  >
                </div>
                <div class="card-body p-0 table-dash">
                  <appointment-recent></appointment-recent>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-12 col-xl-4 d-flex">
              <div class="card wallet-widget">
                <div class="circle-bar circle-bar2">
                  <div>
                    <circle-progress class="circle-graph2" :percent="40" />
                    <b><img src="@/assets/img/icons/timer.svg" alt="" /></b>
                  </div>
                </div>
                <div class="main-limit">
                  <p>Next Appointment in</p>
                  <h4>02h:12m</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-12 col-xl-5 d-flex">
          <div class="card flex-fill comman-shadow">
            <div class="card-header">
              <h4 class="card-title d-inline-block">Recent Appointments</h4>
              <router-link to="/appointments/appointments-list" class="patient-views float-end"
              >Show all</router-link
              >
            </div>
            <div class="card-body">
              <div class="teaching-card">
                <ul class="steps-history">
                  <li>08:00</li>
                </ul>
                <ul class="activity-feed">
                  <li class="feed-item d-flex align-items-center">
                    <div class="dolor-activity hide-activity">
                      <ul class="doctor-date-list mb-2">
                        <li class="stick-line">
                          <i class="fas fa-circle me-2"></i>08:00
                          <span>Benjamin Bruklin</span>
                        </li>
                        <li class="stick-line">
                          <i class="fas fa-circle me-2"></i>08:00
                          <span>Andrea Lalema</span>
                        </li>
                        <li class="dropdown ongoing-blk">
                          <a
                              href="javascript:;"
                              class="dropdown-toggle active-doctor"
                              data-bs-toggle="dropdown"
                          >
                            <i class="fas fa-circle me-2 active-circles"></i>08:00
                            <span>Andrea Lalema</span
                            ><span class="ongoing-drapt"
                          >Ongoing <i class="feather-chevron-down ms-2"></i
                          ></span>
                          </a>
                          <ul class="doctor-sub-list dropdown-menu">
                            <li class="patient-new-list dropdown-item">
                              Patient<span>Marie kennedy</span
                            ><a href="javascript:;" class="new-dot status-green"
                            ><i class="fas fa-circle me-1 fa-2xs"></i>New</a
                            >
                            </li>
                            <li class="dropdown-item">
                              Time<span>8:30 - 9:00 (30min)</span>
                            </li>
                            <li class="schedule-blk mb-0 pt-2 dropdown-item">
                              <ul class="nav schedule-time">
                                <li>
                                  <a href="javascript:;"
                                  ><img src="@/assets/img/icons/trash.svg" alt=""
                                  /></a>
                                </li>
                                <li>
                                  <a href="javascript:;"
                                  ><img src="@/assets/img/icons/profile.svg" alt=""
                                  /></a>
                                </li>
                                <li>
                                  <a href="javascript:;"
                                  ><img src="@/assets/img/icons/edit.svg" alt=""
                                  /></a>
                                </li>
                              </ul>
                              <a class="btn btn-primary appoint-start"
                              >Start Appointment</a
                              >
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="teaching-card">
                <ul class="steps-history">
                  <li>09:00</li>
                </ul>
                <ul class="activity-feed">
                  <li class="feed-item d-flex align-items-center">
                    <div class="dolor-activity">
                      <ul class="doctor-date-list mb-2">
                        <li>
                          <i class="fas fa-circle me-2"></i>09:00
                          <span>Galaviz Lalema</span>
                        </li>
                        <li>
                          <i class="fas fa-circle me-2"></i>09:20
                          <span>Benjamin Bruklin</span>
                        </li>
                        <li>
                          <i class="fas fa-circle me-2"></i>09:40 <span>Jenny Smith</span>
                        </li>
                      </ul>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="teaching-card">
                <ul class="steps-history">
                  <li>10:00</li>
                </ul>
                <ul class="activity-feed">
                  <li class="feed-item d-flex align-items-center">
                    <div class="dolor-activity">
                      <ul class="doctor-date-list mb-2">
                        <li>
                          <i class="fas fa-circle me-2"></i>10:00
                          <span>Cristina Groves</span>
                        </li>
                        <li>
                          <i class="fas fa-circle me-2"></i>10:30
                          <span>Benjamin Bruklin</span>
                        </li>
                      </ul>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="teaching-card">
                <ul class="steps-history">
                  <li>11:00</li>
                </ul>
                <ul class="activity-feed">
                  <li class="feed-item d-flex align-items-center">
                    <div class="dolor-activity">
                      <ul class="doctor-date-list mb-2">
                        <li>
                          <i class="fas fa-circle me-2"></i>11:00
                          <span>Cristina Groves</span>
                        </li>
                        <li>
                          <i class="fas fa-circle me-2"></i>11:30
                          <span>Benjamin Bruklin</span>
                        </li>
                      </ul>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import CircleProgress from "vue3-circle-progress";
import "vue3-circle-progress/dist/circle-progress.css";
import { areaChart, donutChart, sColStacked } from "./data";
import { ref } from "vue";
import {useAuthStore} from "@/stores/auth.js";
// import Vue3Autocounter from 'vue3-autocounter';
export default {
  components: {
    CircleProgress,
    // Vue3Autocounter,
  },
  data() {
    return {
      authStore: useAuthStore(),
      title: "Dashboard",
      text: "Doctor Dashboard",
      Years: ["2022", "2021", "2020", "2019"],
      Days: ["This Week", "Last Week", "This Month", "Last Month"],
      areaChart: areaChart,
      donutChart: donutChart,
      sColStacked: sColStacked,
    };
  },
  mounted() {
    const percent = ref(75);
    setInterval(() => {
      if (percent.value === 25) {
        percent.value = 75;
      } else {
        percent.value = 25;
      }
    }, 1000);
  },
};
</script>
