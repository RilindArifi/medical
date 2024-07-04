<script setup>
import { ref } from "vue";
import { patientChart, donutChart } from "./data.js";
import UpcomingAppointments from "@/views/Backend/Dashboard/Components/upcoming-appointments.vue";
import RecentPatients from "@/views/Backend/Dashboard/Components/recent-patients.vue";
import { useAuthStore } from "@/stores/auth.js";
// import Vue3Autocounter from 'vue3-autocounter';

const Years = ref("2022", "2021", "2020", "2019"),
    authStore = useAuthStore();
</script>
<template>
    <div class="page-wrapper">
        <div class="content">
            <breadcrumb title="Dashboard" text="" path="/dashboard" />

            <div class="good-morning-blk">
                <div class="row">
                    <div class="col-md-6">
                        <div class="morning-user">
                            <h2>
                                Hello, <span>{{ authStore.user.name }}</span>
                            </h2>
                            <p>Have a nice day at work</p>
                        </div>
                    </div>
                    <div class="col-md-6 position-blk">
                        <div class="morning-img">
                            <img src="@/assets/img/morning-img-01.png" alt="" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="dash-widget">
                        <div class="dash-boxs comman-flex-center">
                            <img src="@/assets/img/icons/calendar.svg" alt="" />
                        </div>
                        <div class="dash-content dash-count">
                            <h4>Appointments</h4>
                            <h2>
                                <!--                <vue3-autocounter-->
                                <!--                  class="counter-up"-->
                                <!--                  ref="counter"-->
                                <!--                  :startAmount="0"-->
                                <!--                  :delay="3"-->
                                <!--                  :endAmount="250"-->
                                <!--                  :duration="5"-->
                                <!--                  separator=","-->
                                <!--                  :autoinit="true"-->
                                <!--                />-->
                            </h2>
                            <p>
                                <span class="passive-view"
                                    ><i class="feather-arrow-up-right me-1"></i
                                    >40%</span
                                >
                                vs last month
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="dash-widget">
                        <div class="dash-boxs comman-flex-center">
                            <img
                                src="@/assets/img/icons/profile-add.svg"
                                alt=""
                            />
                        </div>
                        <div class="dash-content dash-count">
                            <h4>New Patients</h4>
                            <h2>
                                <!--                <vue3-autocounter-->
                                <!--                  class="counter-up"-->
                                <!--                  ref="counter"-->
                                <!--                  :startAmount="0"-->
                                <!--                  :delay="3"-->
                                <!--                  :endAmount="140"-->
                                <!--                  :duration="5"-->
                                <!--                  separator=","-->
                                <!--                  :autoinit="true"-->
                                <!--                />-->
                            </h2>
                            <p>
                                <span class="passive-view"
                                    ><i class="feather-arrow-up-right me-1"></i
                                    >20%</span
                                >
                                vs last month
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="dash-widget">
                        <div class="dash-boxs comman-flex-center">
                            <img src="@/assets/img/icons/scissor.svg" alt="" />
                        </div>
                        <div class="dash-content dash-count">
                            <h4>Operations</h4>
                            <h2>
                                <!--                <vue3-autocounter-->
                                <!--                  class="counter-up"-->
                                <!--                  ref="counter"-->
                                <!--                  :startAmount="0"-->
                                <!--                  :delay="3"-->
                                <!--                  :endAmount="56"-->
                                <!--                  :duration="5"-->
                                <!--                  separator=","-->
                                <!--                  :autoinit="true"-->
                                <!--                />-->
                            </h2>
                            <p>
                                <span class="negative-view"
                                    ><i
                                        class="feather-arrow-down-right me-1"
                                    ></i
                                    >15%</span
                                >
                                vs last month
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="dash-widget">
                        <div class="dash-boxs comman-flex-center">
                            <img
                                src="@/assets/img/icons/empty-wallet.svg"
                                alt=""
                            />
                        </div>
                        <div class="dash-content dash-count">
                            <h4>Earnings</h4>
                            <h2>
                                $
                                <!--                <vue3-autocounter-->
                                <!--                  class="counter-up"-->
                                <!--                  ref="counter"-->
                                <!--                  :startAmount="0"-->
                                <!--                  :delay="3"-->
                                <!--                  :endAmount="20250"-->
                                <!--                  :duration="5"-->
                                <!--                  separator=","-->
                                <!--                  :autoinit="true"-->
                                <!--                />-->
                            </h2>
                            <p>
                                <span class="passive-view"
                                    ><i class="feather-arrow-up-right me-1"></i
                                    >30%</span
                                >
                                vs last month
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-6 col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="chart-title patient-visit">
                                <h4>Patient Visit by Gender</h4>
                                <div>
                                    <ul class="nav chat-user-total">
                                        <li>
                                            <i
                                                class="fa fa-circle current-users"
                                                aria-hidden="true"
                                            ></i
                                            >Male 75%
                                        </li>
                                        <li>
                                            <i
                                                class="fa fa-circle old-users"
                                                aria-hidden="true"
                                            ></i>
                                            Female 25%
                                        </li>
                                    </ul>
                                </div>
                                <div class="input-block mb-0">
                                    <vue-select
                                        :options="Years"
                                        placeholder="2022"
                                    />
                                </div>
                            </div>

                            <apexchart
                                type="bar"
                                height="250"
                                :options="patientChart.chart"
                                :series="patientChart.series"
                            >
                            </apexchart>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-6 col-xl-3 d-flex">
                    <div class="card">
                        <div class="card-body">
                            <div class="chart-title">
                                <h4>Patient by Department</h4>
                            </div>
                            <div id="donut-chart-dash" class="chart-user-icon">
                                <apexchart
                                    type="donut"
                                    :options="donutChart.chart"
                                    :series="donutChart.series"
                                >
                                </apexchart>
                                <img
                                    src="@/assets/img/icons/user-icon.svg"
                                    alt=""
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-xl-4">
                    <div class="card top-departments">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Top Departments</h4>
                        </div>
                        <div class="card-body">
                            <div class="activity-top">
                                <div class="activity-boxs comman-flex-center">
                                    <img
                                        src="@/assets/img/icons/dep-icon-01.svg"
                                        alt=""
                                    />
                                </div>
                                <div class="departments-list">
                                    <h4>General Physician</h4>
                                    <p>35%</p>
                                </div>
                            </div>
                            <div class="activity-top">
                                <div class="activity-boxs comman-flex-center">
                                    <img
                                        src="@/assets/img/icons/dep-icon-02.svg"
                                        alt=""
                                    />
                                </div>
                                <div class="departments-list">
                                    <h4>Dentist</h4>
                                    <p>24%</p>
                                </div>
                            </div>
                            <div class="activity-top">
                                <div class="activity-boxs comman-flex-center">
                                    <img
                                        src="@/assets/img/icons/dep-icon-03.svg"
                                        alt=""
                                    />
                                </div>
                                <div class="departments-list">
                                    <h4>ENT</h4>
                                    <p>10%</p>
                                </div>
                            </div>
                            <div class="activity-top">
                                <div class="activity-boxs comman-flex-center">
                                    <img
                                        src="@/assets/img/icons/dep-icon-04.svg"
                                        alt=""
                                    />
                                </div>
                                <div class="departments-list">
                                    <h4>Cardiologist</h4>
                                    <p>15%</p>
                                </div>
                            </div>
                            <div class="activity-top mb-0">
                                <div class="activity-boxs comman-flex-center">
                                    <img
                                        src="@/assets/img/icons/dep-icon-05.svg"
                                        alt=""
                                    />
                                </div>
                                <div class="departments-list">
                                    <h4>Opthomology</h4>
                                    <p>20%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title d-inline-block">
                                Upcoming Appointments
                            </h4>
                            <router-link
                                to="/appointments/appointments-list"
                                class="patient-views float-end"
                                >Show all</router-link
                            >
                        </div>
                        <div class="card-body p-0 table-dash">
                            <div class="table-responsive">
                                <upcoming-appointments></upcoming-appointments>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title d-inline-block">
                                Recent Patients
                            </h4>
                            <router-link
                                to="/patients/patients-list"
                                class="float-end patient-views"
                                >Show all</router-link
                            >
                        </div>
                        <div class="card-block table-dash">
                            <div class="table-responsive">
                                <recent-patients></recent-patients>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
