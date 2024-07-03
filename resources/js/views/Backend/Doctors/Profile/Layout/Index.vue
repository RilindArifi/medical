<script setup>
import {useRoute} from "vue-router";

const
    route = useRoute()

</script>

<template>
  <div class="row">
    <div class="col-lg-4">
      <div class="doctor-personals-grp">
        <div class="card">
          <div class="card-body">
            <div class="heading-detail">
              <h4 class="mb-3">About me</h4>
              <p>
                Hello I am Dr. Bruce Willis a Gynaecologist in Sanjivni Hospital Surat. I love to work
                with all my hospital staff and seniour doctors.
              </p>
            </div>
            <div class="about-me-list">
              <ul class="list-space">
                <li>
                  <h4>Gender</h4>
                  <span>Female</span>
                </li>
                <li>
                  <h4>Operation Done</h4>
                  <span>30+</span>
                </li>
                <li>
                  <h4>Designation</h4>
                  <span>Sr. Doctor</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="doctor-personals-grp">
        <div class="card">
          <div class="card-body">
            <div class="heading-detail">
              <h4>Skills:</h4>
            </div>
            <div class="skill-blk">
              <div class="skill-statistics">
                <div class="skills-head">
                  <h5>Operations</h5>
                  <p>45%</p>
                </div>
                <div class="progress mb-0">
                  <div
                      class="progress-bar bg-operations"
                      role="progressbar"
                      style="width: 45%"
                      aria-valuenow="45"
                      aria-valuemin="0"
                      aria-valuemax="100"
                  ></div>
                </div>
              </div>
              <div class="skill-statistics">
                <div class="skills-head">
                  <h5>Patient Care</h5>
                  <p>85%</p>
                </div>
                <div class="progress mb-0">
                  <div
                      class="progress-bar bg-statistics"
                      role="progressbar"
                      style="width: 85%"
                      aria-valuenow="85"
                      aria-valuemin="0"
                      aria-valuemax="100"
                  ></div>
                </div>
              </div>
              <div class="skill-statistics">
                <div class="skills-head">
                  <h5>Endoscopic</h5>
                  <p>65%</p>
                </div>
                <div class="progress mb-0">
                  <div
                      class="progress-bar bg-endoscopic"
                      role="progressbar"
                      style="width: 65%"
                      aria-valuenow="65"
                      aria-valuemin="0"
                      aria-valuemax="100"
                  ></div>
                </div>
              </div>
              <div class="skill-statistics">
                <div class="skills-head">
                  <h5>Patient Visit</h5>
                  <p>90%</p>
                </div>
                <div class="progress mb-0">
                  <div
                      class="progress-bar bg-visit"
                      role="progressbar"
                      style="width: 90%"
                      aria-valuenow="90"
                      aria-valuemin="0"
                      aria-valuemax="100"
                  ></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="doctor-personals-grp">
        <div class="card">
          <div class="card-body">
            <div class="heading-detail">
              <h4>Speciality</h4>
            </div>
            <div class="personal-activity">
              <div class="personal-icons status-grey">
                <img src="../../../../../assets/img/icons/medal-01.svg" alt="" />
              </div>
              <div class="views-personal">
                <h4>Proffesionals</h4>
                <h5>Certified Skin Treatment</h5>
              </div>
            </div>
            <div class="personal-activity">
              <div class="personal-icons status-green">
                <img src="../../../../../assets/img/icons/medal-02.svg" alt="" />
              </div>
              <div class="views-personal">
                <h4>Certified</h4>
                <h5>Cold Laser Operation</h5>
              </div>
            </div>
            <div class="personal-activity mb-0">
              <div class="personal-icons status-orange">
                <img src="../../../../../assets/img/icons/medal-03.svg" alt="" />
              </div>
              <div class="views-personal">
                <h4>Medication Laser</h4>
                <h5>Hair Lose Product</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="doctor-personals-grp">
        <div class="card">
          <div class="card-body">
            <div class="tab-content-set">
              <ul class="nav">
                <li>
                  <router-link :to="{name: 'doctors.view.profile'}" :class="route.name.includes('doctors.view.profile') ? 'active' : ''" ><span class="set-about-icon me-2" >
                    <img src="../../../../../assets/img/icons/menu-icon-02.svg" alt="" /></span >
                    About me
                  </router-link>
                </li>
                <li>
                  <router-link :to="{name: 'doctors.view.setting'}" :class="route.name.includes('doctors.view.setting') ? 'active' : ''" ><span class="set-about-icon me-2" ><img src="../../../../../assets/img/icons/menu-icon-16.svg" alt="" /></span>
                    Settings
                  </router-link >
                </li>
              </ul>
            </div>
            <router-view />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
