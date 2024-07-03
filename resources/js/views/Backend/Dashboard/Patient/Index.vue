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
              <img src="@/assets/img/morning-img-03.png" alt="" />
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12 col-xl-7">
          <div class="card">
            <div class="card-body">
              <div class="chart-title patient-visit mb-0">
                <h4>Static of your Health</h4>
                <div class="income-value">
                  <p>
                    <span class="passive-view"
                    ><i class="feather-arrow-up-right me-1"></i>40%</span
                    >
                    vs last month
                  </p>
                </div>
                <div class="average-health">
                  <h5>72bmp <span>Average</span></h5>
                </div>
                <div class="input-block mb-0">
                  <vue-select :options="Years" placeholder="2022" />
                </div>
              </div>
              <div id="health-chart">
                <apexchart
                    type="line"
                    height="200"
                    :options="healthChart.chart"
                    :series="healthChart.series"
                ></apexchart>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-12 col-lg-12 col-xl-5 d-flex">
          <div class="card">
            <div class="card-body">
              <div class="chart-title patient-visit">
                <h4>Body Mass index</h4>
              </div>
              <div class="body-mass-blk">
                <div class="row">
                  <div class="col-md-6">
                    <div class="weight-blk">
                      <div class="center slider">
                        <Carousel
                            :wrap-around="true"
                            :settings="settings"
                            :breakpoints="breakpoints"
                        >
                          <Slide v-for="item in BodyMaskKg" :key="item.id">
                            <div>
                              <h4>{{ item.Weight }}</h4>
                              <span>kg</span>
                            </div>
                          </Slide>
                          <template #addons> </template>
                        </Carousel>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <body-mask-height></body-mask-height>
                  </div>
                </div>
                <div class="progress weight-bar">
                  <div class="progress-bar progress-bar-success" role="progressbar"></div>
                </div>
                <ul class="weight-checkit">
                  <li>Underweight</li>
                  <li>Normal (45.5)</li>
                  <li>Overweight</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-6 col-xl-3 d-flex">
          <div class="card report-blk">
            <div class="card-body">
              <div class="report-head">
                <h4>
                  <img
                      src="@/assets/img/icons/report-icon-01.svg"
                      class="me-2"
                      alt=""
                  />Heart Rate
                </h4>
              </div>
              <div id="heart-rate">
                <apexchart
                    type="line"
                    height="200"
                    :options="heartRate.chart"
                    :series="heartRate.series"
                ></apexchart>
              </div>
              <div class="dash-content">
                <h5>110 <span>bpm</span></h5>
                <p>
                  <span class="passive-view"
                  ><i class="feather-arrow-up-right me-1"></i>40%</span
                  >
                  vs last month
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3 d-flex">
          <div class="card report-blk">
            <div class="card-body">
              <div class="report-head">
                <h4>
                  <img
                      src="@/assets/img/icons/report-icon-02.svg"
                      class="me-2"
                      alt=""
                  />Temperature
                </h4>
              </div>
              <div id="temperature-chart">
                <apexchart
                    type="bar"
                    height="200"
                    :options="sColStacked.chart"
                    :series="sColStacked.series"
                ></apexchart>
              </div>
              <div class="dash-content">
                <h5>38.6 <span>c</span></h5>
                <p>
                  <span class="negative-view"
                  ><i class="feather-arrow-down-right me-1"></i>-20%</span
                  >
                  vs last month
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3 d-flex">
          <div class="card report-blk">
            <div class="card-body">
              <div class="report-head">
                <h4>
                  <img
                      src="@/assets/img/icons/report-icon-03.svg"
                      class="me-2"
                      alt=""
                  />Blood Pressure
                </h4>
              </div>
              <div id="pressure-chart">
                <apexchart
                    type="bar"
                    height="200"
                    :options="sCol.chart"
                    :series="sCol.series"
                ></apexchart>
              </div>
              <div class="dash-content">
                <h5>120 <span>mm/Hg</span></h5>
                <p>
                  <span class="negative-view"
                  ><i class="feather-arrow-down-right me-1"></i>-40%</span
                  >
                  vs last month
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3 d-flex">
          <div class="card report-blk">
            <div class="card-body">
              <div class="report-head">
                <h4>
                  <img
                      src="@/assets/img/icons/report-icon-04.svg"
                      class="me-2"
                      alt=""
                  />Sleep
                </h4>
              </div>
              <div id="sleep-chart">
                <apexchart
                    type="line"
                    height="200"
                    :options="sleepChart.chart"
                    :series="sleepChart.series"
                ></apexchart>
              </div>
              <div class="dash-content">
                <h5>7<span>h</span> 30 <span>m</span></h5>
                <p>
                  <span class="negative-view"
                  ><i class="feather-arrow-down-right me-1"></i>-10%</span
                  >
                  vs last month
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <patient-content></patient-content>
    </div>
  </div>
</template>

<script>
import { Carousel, Slide } from "vue3-carousel";
import "vue3-carousel/dist/carousel.css";
import BodyMaskKg from "@/assets/json/body-mask-kg.json";
import { healthChart, heartRate, sColStacked, sCol, sleepChart } from "./data";
import PatientContent from "@/views/Backend/Dashboard/Patient/PatientContent.vue";
import BodyMaskHeight from "@/views/Backend/Dashboard/Patient/BodyMaskHeight.vue";
import {useAuthStore} from "@/stores/auth.js";
// import Vue3Autocounter from 'vue3-autocounter';
export default {
  data() {
    return {
      authStore : useAuthStore(),
      BodyMaskKg: BodyMaskKg,
      healthChart: healthChart,
      heartRate: heartRate,
      sColStacked: sColStacked,
      sleepChart: sleepChart,
      sCol: sCol,
      title: "Dashboard",
      text: "Patient Dashboard",
      Years: ["2022", "2021", "2020", "2019"],
      settings: {
        itemsToShow: 1,
        snapAlign: "center",
      },
      breakpoints: {
        575: {
          itemsToShow: 5,
          snapAlign: "center",
        },
        767: {
          itemsToShow: 5,
          snapAlign: "center",
        },
        991: {
          itemsToShow: 5,
          snapAlign: "center",
        },
        1024: {
          itemsToShow: 4.5,
          snapAlign: "start",
        },
      },
    };
  },

  components: {
    BodyMaskHeight,
    PatientContent,
    Carousel,
    Slide,
    // Vue3Autocounter,
  },
};
</script>
