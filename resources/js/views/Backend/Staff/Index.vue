<script setup>
import {computed, onMounted, reactive, ref, watch} from "vue";
import ButtonGroup from "@/components/table/ButtonGroup.vue";
import useModelOperations from "@/composables/model-operations.js";
import {message} from "ant-design-vue";
import DeleteRow from "@/components/table/DeleteModel.vue";
import RestoreRow from "@/components/table/RestoreModel.vue";
import ForceDeleteRow from "@/components/table/DeleteModel.vue";
import EditRow from "@/components/table/EditModel.vue";
import TagStatus from "@/components/table/TagStatus.vue";
import {ACTIVE, INACTIVE} from "@/enums/status-global.js";
import {ADMIN} from "@/enums/role.js";
import VueAvatar from "@/components/VueAvatar.vue";
import EditModel from "@/components/table/EditModel.vue";
import ForceDeleteModel from "@/components/table/DeleteModel.vue";
import ActiveModel from "@/components/table/EnableModel.vue";
import DeleteModel from "@/components/table/DeleteModel.vue";
import InactiveModel from "@/components/table/DisableModel.vue";
import RestoreModel from "@/components/table/RestoreModel.vue";

const
    model = useModelOperations('staff'),
    isLoading = ref(false),
    data = ref([]),
    state = reactive({
      per_page: 10,
      page: 1,
      sort: {prop: 'id', order: 'descending'},
      deleted: false,
      search: '',
      status: null,
    }),
    pagination = computed(() => ({
      total: data.value.meta?.total,
      current: state.page,
      pageSize: state.per_page})),

    fetchData = (loading) => {
      isLoading.value = loading
      model.fetchData(state)
          .then(response => {
            data.value = response.data
          }).finally(() => isLoading.value = false)
    },
    handleTableChange = (pag, filters, sorter) => {
      state.page = pag.current
      state.per_page = pag.pageSize
      state.sort.order = sorter.order
      state.status = filters.status ? filters.status[0] : null
    },
    stateDeleted = () => {
      state.deleted = !state.deleted
    },
    deleteAction = (id) => {
      model.deleteAction(id)
          .then(() => { message.success({ content: 'Staff was successfully deleted.' }); fetchData(false) })
    },
    restoreAction = (id) => {
      model.restoreAction(id)
          .then(() => { message.success({ content: 'Staff was successfully restored.' }); fetchData(false) })
    },
    forceDeleteAction = (id) => {
      model.forceDeleteAction(id)
          .then(() => { message.success({ content: 'Staff was successfully force deleted.' }); fetchData(false) })
    },
    enableAction = (id) => {
      model.enableAction(id)
          .then(() => { message.success({ content: `Staff was successfully ${ACTIVE}.` }); fetchData(false) })
    },
    disableAction = (id) => {
      model.disableAction(id)
          .then(() => { message.success({ content: `Staff was successfully ${INACTIVE}.` }); fetchData(false) })
    }

  watch(state, () => fetchData(true), {immediate: true})


const columns = [
  {
    title: 'Name',
    dataIndex: 'name',
    key: 'Name',
    sorter: {}
  },
  {
    title: 'Department',
    dataIndex: 'department',
    key: 'Department',
    sorter: {}
  },
  {
    title: 'Education',
    dataIndex: 'education',
    sorter: {}
  },
  {
    title: 'Mobile',
    dataIndex: 'mobile',
    key: 'Mobile',
    sorter: {}
  },
  {
    title: 'Email',
    dataIndex: 'email',
    sorter: {}
  },
  {
    title: 'Role',
    dataIndex: 'role',
    key: 'role',
  },
  {
    title: 'Joining Date',
    dataIndex: 'created_at',
    sorter: {}
  },
  {
    title: 'Status',
    dataIndex: 'status',
    key: 'status',
    filters: [
      {
        text:  ACTIVE,
        value: ACTIVE,
      },
      {
        text:  INACTIVE,
        value: INACTIVE,
      },
    ],
  },
  {
    title: 'Quick access',
    key: 'quick-access',
    sorter: false,
    class: 'text-end'
  },
  {
    title: 'Action',
    key: 'action',
    sorter: true,
    class: 'text-end'
  }
]
</script>

<template>
  <div class="page-wrapper">
    <div class="content">
      <breadcrumb title="New Staff" text="Staff" path="/staff/create" />

      <div class="row">
        <div class="col-sm-12">
          <div class="card card-table show-entire">
            <div class="card-body">
              <!-- Table Header -->
              <div class="page-table-header mb-2">
                <div class="row align-items-center">
                  <div class="col">
                    <div class="doctor-table-blk">
                      <h3>Staff List</h3>
                      <div class="doctor-search-blk">
                        <div class="top-nav-search table-search-blk">
                          <form>
                            <input v-model="state.search" type="text" class="form-control" placeholder="Search here" />
                            <a class="btn"
                              ><img src="@/assets/img/icons/search-normal.svg" alt=""
                            /></a>
                          </form>
                        </div>
                        <div class="add-group">
                          <ButtonGroup model="staff" :deleted="state.deleted" @on-deleted="stateDeleted" @on-fetch="fetchData(true)"/>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /Table Header -->

              <div class="table-responsive">
                <a-skeleton :loading="isLoading" active :paragraph="{ rows: 25 }">
                  <a-table
                      class="table border-0 custom-table comman-table datatable mb-0"
                      :columns="columns"
                      :data-source="data.data"
                      :pagination="pagination"
                      @change="handleTableChange"
                  >
                  <template #bodyCell="{ column, record }">
                    <template v-if="column.key === 'Name'">
                      <div class="profile-image">
                        <router-link :to="{name: 'staff.edit', params:{id: record.id}}">
                          <vue-avatar :user="record"/>
                          {{ record.name }}
                        </router-link>
                      </div>
                    </template>
                    <template v-else-if="column.key === 'Department'">
                      <div>{{record.department?.name}}</div>
                    </template>
                    <template v-if="column.key === 'role'">
                      <div v-for="role in record.role">
                        <button class="custom-badge" :class="[ role === ADMIN ? 'status-green' : 'status-pink', record.role.length > 1 ? 'mb-1' : '']">{{ role }}</button>
                      </div>
                    </template>
                    <template v-if="column.key === 'status'">
                      <div>
                        <TagStatus :status="record.status" />
                      </div>
                    </template>

                    <template v-else-if="column.key === 'quick-access'">
                      <div class="text-end d-flex justify-content-end align-items-center">
                        <ul class="icons-list mt-3">
                          <template v-if="!state.deleted">
                            <active-model v-if="$can(`enabled staff`)" @on-enabled="enableAction(record.id)" />
                            <inactive-model v-if="$can(`disabled staff`)" @on-disabled="disableAction(record.id)"/>
                          </template>
                        </ul>
                      </div>
                    </template>

                    <template v-else-if="column.key === 'action'">
                      <div class="text-end d-flex justify-content-end align-items-center">
                        <ul class="icons-list mt-3">
                          <template v-if="!state.deleted">
                            <edit-model :id="record.id" model="staff" />
                            <delete-model v-if="$can(`delete staff`)" @on-delete="deleteAction(record.id)"/>
                          </template>
                          <template v-if="state.deleted">
                            <restore-model v-if="$can(`restore staff`)" @on-restore="restoreAction(record.id)"/>
                            <force-delete-model v-if="$can(`force-delete staff`)" @on-delete="forceDeleteAction(record.id)"/>
                          </template>
                        </ul>
                      </div>
                    </template>
                  </template>
                </a-table>
                </a-skeleton>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
