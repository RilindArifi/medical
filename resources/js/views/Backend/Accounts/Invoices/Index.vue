<template>
  <div class="page-wrapper">
    <div class="content">
      <!-- Page Header -->
      <breadcrumb :title="title" :text="text" path="invoices" />
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
                      <h3>Invoice List</h3>
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
                          <router-link to="create-invoice" class="btn btn-primary add-pluss ms-2"
                            ><img src="@/assets/img/icons/plus.svg" alt=""
                          /></router-link>
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
                      <div class="input-block local-forms">
                        <label>Payment Status </label>
                        <vue-select
                          :options="Status"
                          id="status"
                          placeholder="Select Payment Status"
                        />
                      </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-4 ms-auto">
                      <div class="doctor-submit">
                        <button type="submit" class="btn btn-primary submit-list-form me-2">
                          Search
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="table-responsive">
                <a-table
                  class="table border-0 custom-table comman-table datatable mb-0"
                  :columns="columns"
                  :data-source="data"
                  :row-selection="{}"
                >
                  <template #bodyCell="{ column, record }">
                    <template v-if="column.key === 'Number'">
                      <div>
                        <router-link to="invoice-view">{{ record.Number }}</router-link>
                      </div>
                    </template>
                    <template v-else-if="column.key === 'Patient'">
                      <div class="profile-image">
                        <router-link to="/profile"
                          ><img
                            width="28"
                            height="28"
                            :src="`/src/assets/img/profiles/${record.Avatar}`"
                            class="rounded-circle m-r-5"
                            alt=""
                          />
                          {{ record.Patient }}</router-link
                        >
                      </div>
                    </template>
                    <template v-else-if="column.key === 'Status'">
                      <div>
                        <button :class="record.Class">{{ record.Status }}</button>
                      </div>
                    </template>
                    <template v-else-if="column.key === 'action'">
                      <div class="text-end">
                        <div class="dropdown dropdown-action">
                          <a
                            href="javascript:;"
                            class="action-icon dropdown-toggle"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            ><i class="fa fa-ellipsis-v"></i
                          ></a>
                          <div class="dropdown-menu dropdown-menu-end">
                            <router-link class="dropdown-item" to="edit-invoice"
                              ><i class="fa-solid fa-pen-to-square m-r-5"></i> Edit</router-link
                            >
                            <router-link class="dropdown-item" to="invoice-view"
                              ><i class="feather-eye m-r-5"></i> View</router-link
                            >
                            <a class="dropdown-item" href="javascript:;"
                              ><i class="feather-download m-r-5"></i> Download</a
                            >
                            <a
                              class="dropdown-item"
                              href="javascript:;"
                              data-bs-toggle="modal"
                              data-bs-target="#delete_patient"
                              ><i class="fa fa-trash-alt m-r-5"></i> Delete</a
                            >
                          </div>
                        </div>
                      </div>
                    </template>
                  </template>
                </a-table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <delete></delete>
</template>

<script>
const columns = [
  {
    title: 'Invoices Number',
    dataIndex: 'Number',
    key: 'Number',
    sorter: {
      compare: (a, b) => {
        a = a.Number.toLowerCase()
        b = b.Number.toLowerCase()
        return a > b ? -1 : b > a ? 1 : 0
      }
    }
  },
  {
    title: 'Patient',
    dataIndex: 'Patient',
    key: 'Patient',
    sorter: {
      compare: (a, b) => {
        a = a.Patient.toLowerCase()
        b = b.Patient.toLowerCase()
        return a > b ? -1 : b > a ? 1 : 0
      }
    }
  },
  {
    title: 'Created Date',
    dataIndex: 'CreatedDate',
    sorter: {
      compare: (a, b) => {
        a = a.CreatedDate.toLowerCase()
        b = b.CreatedDate.toLowerCase()
        return a > b ? -1 : b > a ? 1 : 0
      }
    }
  },
  {
    title: 'Due Date',
    dataIndex: 'DueDate',
    sorter: {
      compare: (a, b) => {
        a = a.DueDate.toLowerCase()
        b = b.DueDate.toLowerCase()
        return a > b ? -1 : b > a ? 1 : 0
      }
    }
  },
  {
    title: 'Amount',
    dataIndex: 'Amount',
    sorter: {
      compare: (a, b) => {
        a = a.Amount.toLowerCase()
        b = b.Amount.toLowerCase()
        return a > b ? -1 : b > a ? 1 : 0
      }
    }
  },
  {
    title: 'Status',
    dataIndex: 'Status',
    key: 'Status',
    sorter: {
      compare: (a, b) => {
        a = a.Status.toLowerCase()
        b = b.Status.toLowerCase()
        return a > b ? -1 : b > a ? 1 : 0
      }
    }
  },
  {
    title: '',
    key: 'action',
    sorter: true,
    class: 'text-end'
  }
]

const data = [
  {
    id: '1',
    Avatar: 'avatar-01.jpg',
    Number: '#INV-0004',
    Patient: 'Andrea Lalema',
    CreatedDate: '01.10.2022',
    DueDate: '01.10.2022',
    Amount: '$20',
    Status: 'Paid',
    Class: 'custom-badge status-green'
  },
  {
    id: '2',
    Avatar: 'avatar-02.jpg',
    Number: '#INV-0001',
    Patient: 'Smith Bruklin',
    CreatedDate: '02.10.2022',
    DueDate: '02.10.2022',
    Amount: '$15',
    Status: 'Un Paid',
    Class: 'custom-badge status-pink'
  },
  {
    id: '3',
    Avatar: 'avatar-03.jpg',
    Number: '#INV-0002',
    Patient: 'Bernardo James',
    CreatedDate: '01.10.2022',
    DueDate: '01.10.2022',
    Amount: '$20',
    Status: 'Paid',
    Class: 'custom-badge status-green'
  },
  {
    id: '4',
    Avatar: 'avatar-04.jpg',
    Number: '#INV-0003',
    Patient: 'Mark Hay Smith',
    CreatedDate: '05.10.2022',
    DueDate: '05.10.2022',
    Amount: '$10',
    Status: 'Patially Paid',
    Class: 'custom-badge status-orange'
  },
  {
    id: '5',
    Avatar: 'avatar-05.jpg',
    Number: '#INV-0004',
    Patient: 'Galaviz Lalema',
    CreatedDate: '01.10.2022',
    DueDate: '01.10.2022',
    Amount: '$20',
    Status: 'Paid',
    Class: 'custom-badge status-green'
  },
  {
    id: '6',
    Avatar: 'avatar-07.jpg',
    Number: '#INV-0003',
    Patient: 'Andrea Lalema',
    CreatedDate: '05.10.2022',
    DueDate: '05.10.2022',
    Amount: '$10',
    Status: 'Patially Paid',
    Class: 'custom-badge status-orange'
  },
  {
    id: '7',
    Avatar: 'avatar-08.jpg',
    Number: '#INV-0005',
    Patient: 'William Stephin',
    CreatedDate: '10.10.2022',
    DueDate: '10.10.2022',
    Amount: '$30',
    Status: 'Un Paid',
    Class: 'custom-badge status-pink'
  }
]

import { ref } from 'vue'
const currentDate = ref(new Date())
const currentDateOne = ref(new Date())
export default {
  data() {
    return {
      title: 'Accounts',
      text: 'Invoices',
      startdate: currentDate,
      startdateOne: currentDateOne,
      dateFormat: 'dd-MM-yyyy',
      Status: ['Select Payment Status', 'Paid', 'Un Paid', 'Patially Paid'],
      columns,
      data
    }
  }
}
</script>
