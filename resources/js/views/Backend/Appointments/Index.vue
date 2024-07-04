<script setup>
import { computed, onMounted, reactive, ref, watch } from "vue";
import ButtonGroup from "@/components/table/ButtonGroup.vue";
import useModelOperations from "@/composables/model-operations.js";
import { message } from "ant-design-vue";
import DeleteRow from "@/components/table/DeleteModel.vue";
import RestoreRow from "@/components/table/RestoreModel.vue";
import ForceDeleteRow from "@/components/table/DeleteModel.vue";
import EditRow from "@/components/table/EditModel.vue";
import { APPROVED, PENDING } from "@/enums/status-appointments.js";
import VueAvatar from "@/components/VueAvatar.vue";
import RejectModel from "@/components/table/DisableModel.vue";
import ApproveModel from "@/components/table/EnableModel.vue";
import { dateFormat, rangePresets } from "@/utils/strings.js";
import LeaveStatusSelect from "@/components/leaves/LeaveStatusSelect.vue";
import LeaveTypeSelect from "@/components/leaves/LeaveTypeSelect.vue";
import PatientSelect from "@/components/patients/PatientSelect.vue";

const model = useModelOperations("appointments"),
    isLoading = ref(false),
    data = ref([]),
    state = reactive({
        per_page: 10,
        page: 1,
        sort: { prop: "id", order: "descending" },
        deleted: false,
        search: "",
        status: null,
        patient_id: null,
        from: null,
        to: null,
        custom: [],
    }),
    resetFilters = () => {
        (state.search = ""),
            (state.status = null),
            (state.staff_id = null),
            (state.leave_type_id = null),
            (state.from = null),
            (state.to = null),
            (state.custom = []);
    },
    pagination = computed(() => ({
        total: data.value.meta?.total,
        current: state.page,
        pageSize: state.per_page,
    })),
    fetchData = (loading) => {
        isLoading.value = loading;
        model
            .fetchData(state)
            .then((response) => {
                data.value = response.data;
            })
            .finally(() => (isLoading.value = false));
    },
    handleTableChange = (pag, filters, sorter) => {
        state.page = pag.current;
        state.per_page = pag.pageSize;
        state.sort.order = sorter.order;
        state.status = filters.status ? filters.status[0] : null;
    },
    stateDeleted = () => {
        state.deleted = !state.deleted;
    },
    deleteAction = (id) => {
        model.deleteAction(id).then(() => {
            message.success({
                content: "Appointment was successfully deleted.",
            });
            fetchData(false);
        });
    },
    restoreAction = (id) => {
        model.restoreAction(id).then(() => {
            message.success({
                content: "Appointment was successfully restored.",
            });
            fetchData(false);
        });
    },
    forceDeleteAction = (id) => {
        model.forceDeleteAction(id).then(() => {
            message.success({
                content: "Appointment was successfully force deleted.",
            });
            fetchData(false);
        });
    },
    enableAction = (id) => {
        model.enableAction(id).then(() => {
            message.success({
                content: "Appointment was successfully approved.",
            });
            fetchData(false);
        });
    },
    disableAction = (id) => {
        model.disableAction(id).then(() => {
            message.success({
                content: "Appointment was successfully rejected.",
            });
            fetchData(false);
        });
    },
    defineClassByStatus = (status) => {
        if (status === PENDING) {
            return "bg-primary-light";
        } else if (status === APPROVED) {
            return "bg-success-light";
        } else {
            return "bg-danger-light";
        }
    },
    onRangeChange = (dates, dateStrings) => {
        if (dates) {
            state.custom.push(dateStrings[0], dateStrings[0]);
        }
    };

watch(state, () => fetchData(true), { immediate: true });

const columns = [
    {
        title: "Name",
        dataIndex: "Name",
        key: "Name",
        sorter: {},
    },
    {
        title: "Consulting Doctor",
        dataIndex: "Consulting Doctor",
        key: "Consulting Doctor",
        sorter: {},
    },
    {
        title: "Treatment",
        dataIndex: "treatment",
        sorter: {},
    },
    {
        title: "Date",
        dataIndex: "date",
        sorter: {},
    },
    {
        title: "From",
        dataIndex: "from",
        sorter: {},
    },
    {
        title: "To",
        dataIndex: "to",
        sorter: {},
    },
    {
        title: "Mobile",
        dataIndex: "Mobile",
        key: "Mobile",
        sorter: {},
    },
    {
        title: "Status",
        dataIndex: "status",
        key: "Status",
        sorter: {},
    },
    {
        title: "Quick access",
        key: "quick-access",
        sorter: false,
        class: "text-end",
    },
    {
        title: "Action",
        key: "action",
        sorter: false,
        class: "text-end",
    },
];
</script>
<template>
    <div class="page-wrapper">
        <div class="content">
            <!-- Page Header -->
            <breadcrumb
                :title="$t('appointments.newAppointment')"
                :text="$t('appointments.apps')"
                path="/appointments/create"
            />
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
                                            <h3>
                                                {{
                                                    $t(
                                                        "appointments.appointmentList",
                                                    )
                                                }}
                                            </h3>
                                            <div class="doctor-search-blk">
                                                <div
                                                    class="top-nav-search table-search-blk"
                                                >
                                                    <form>
                                                        <input
                                                            v-model="
                                                                state.search
                                                            "
                                                            type="text"
                                                            class="form-control"
                                                            :placeholder="
                                                                $t(
                                                                    'table.search',
                                                                )
                                                            "
                                                        />
                                                        <a class="btn"
                                                            ><img
                                                                src="@/assets/img/icons/search-normal.svg"
                                                                alt=""
                                                        /></a>
                                                    </form>
                                                </div>
                                                <div class="add-group">
                                                    <ButtonGroup
                                                        model="appointments"
                                                        :deleted="state.deleted"
                                                        @on-deleted="
                                                            stateDeleted
                                                        "
                                                        @on-fetch="
                                                            fetchData(true)
                                                        "
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Table Header -->

                            <div class="staff-search-table">
                                <form>
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div
                                                class="input-block local-forms"
                                            >
                                                <label>Patient Name </label>
                                                <patient-select
                                                    v-model:value="
                                                        state.patient_id
                                                    "
                                                />
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div
                                                class="input-block local-forms"
                                            >
                                                <label>Leave Type </label>
                                                <leave-type-select
                                                    v-model:value="
                                                        state.leave_type_id
                                                    "
                                                />
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div
                                                class="input-block local-forms"
                                            >
                                                <label>Leave Status </label>
                                                <leave-status-select
                                                    v-model:value="state.status"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-8">
                                            <div
                                                class="input-block local-forms cal-icon"
                                            >
                                                <label>From To </label>
                                                <a-range-picker
                                                    value-format="YYYY-MM-DD"
                                                    :format="dateFormat()"
                                                    class="form-control d-flex"
                                                    placeholder=""
                                                    :presets="rangePresets"
                                                    @change="onRangeChange"
                                                    :suffix-icon="false"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="doctor-submit">
                                                <button
                                                    @click.prevent="
                                                        resetFilters
                                                    "
                                                    class="btn btn-primary submit-list-form me-2"
                                                >
                                                    Reset
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="table-responsive">
                                <a-skeleton
                                    :loading="isLoading"
                                    active
                                    :paragraph="{ rows: 25 }"
                                >
                                    <a-table
                                        class="table border-0 custom-table comman-table datatable mb-0"
                                        :columns="columns"
                                        :data-source="data.data"
                                        :pagination="pagination"
                                        @change="handleTableChange"
                                    >
                                        <template
                                            #bodyCell="{ column, record }"
                                        >
                                            <template
                                                v-if="column.key === 'Name'"
                                            >
                                                <div class="profile-image">
                                                    <router-link
                                                        :to="{
                                                            name: 'appointments.edit',
                                                            params: {
                                                                id: record.id,
                                                            },
                                                        }"
                                                    >
                                                        <vue-avatar
                                                            v-if="
                                                                record.patient
                                                            "
                                                            :user="
                                                                record.patient
                                                            "
                                                        />
                                                        {{
                                                            record.patient?.name
                                                        }}
                                                    </router-link>
                                                </div>
                                            </template>
                                            <template
                                                v-else-if="
                                                    column.key ===
                                                    'Consulting Doctor'
                                                "
                                            >
                                                <div class="profile-image">
                                                    <router-link to="/profile">
                                                        <vue-avatar
                                                            v-if="record.doctor"
                                                            :user="
                                                                record.doctor
                                                            "
                                                        />
                                                        {{
                                                            record.doctor?.name
                                                        }}
                                                    </router-link>
                                                </div>
                                            </template>
                                            <template
                                                v-else-if="
                                                    column.key === 'Mobile'
                                                "
                                            >
                                                <p class="mt-3">
                                                    {{ record.patient?.mobile }}
                                                </p>
                                            </template>
                                            <template
                                                v-else-if="
                                                    column.key === 'Status'
                                                "
                                            >
                                                <div>
                                                    <span
                                                        class="badge"
                                                        :class="
                                                            defineClassByStatus(
                                                                record.status,
                                                            )
                                                        "
                                                        >{{
                                                            record.status
                                                        }}</span
                                                    >
                                                </div>
                                            </template>
                                            <template
                                                v-else-if="
                                                    column.key ===
                                                        'quick-access' &&
                                                    !state.deleted
                                                "
                                            >
                                                <div
                                                    class="text-end d-flex justify-content-end align-items-center"
                                                >
                                                    <ul class="icons-list mt-3">
                                                        <template
                                                            v-if="
                                                                !state.deleted
                                                            "
                                                        >
                                                            <approve-model
                                                                v-if="
                                                                    $can(
                                                                        `enabled appointments`,
                                                                    )
                                                                "
                                                                @on-enabled="
                                                                    enableAction(
                                                                        record.id,
                                                                    )
                                                                "
                                                                titleTooltip="Approve"
                                                            />
                                                            <reject-model
                                                                v-if="
                                                                    $can(
                                                                        `disabled appointments`,
                                                                    )
                                                                "
                                                                @on-disabled="
                                                                    disableAction(
                                                                        record.id,
                                                                    )
                                                                "
                                                                titleTooltip="Reject"
                                                            />
                                                        </template>
                                                    </ul>
                                                </div>
                                            </template>
                                            <template
                                                v-else-if="
                                                    column.key === 'action'
                                                "
                                            >
                                                <div
                                                    class="text-end d-flex justify-content-end align-items-center"
                                                >
                                                    <ul class="icons-list mt-3">
                                                        <template
                                                            v-if="
                                                                !state.deleted
                                                            "
                                                        >
                                                            <edit-row
                                                                :id="record.id"
                                                                model="appointments"
                                                            />
                                                            <delete-row
                                                                v-if="
                                                                    $can(
                                                                        `delete appointments`,
                                                                    )
                                                                "
                                                                @on-delete="
                                                                    deleteAction(
                                                                        record.id,
                                                                    )
                                                                "
                                                            />
                                                        </template>
                                                        <template
                                                            v-if="state.deleted"
                                                        >
                                                            <restore-row
                                                                v-if="
                                                                    $can(
                                                                        `restore appointments`,
                                                                    )
                                                                "
                                                                @on-restore="
                                                                    restoreAction(
                                                                        record.id,
                                                                    )
                                                                "
                                                            />
                                                            <force-delete-row
                                                                v-if="
                                                                    $can(
                                                                        `force-delete appointments`,
                                                                    )
                                                                "
                                                                @on-delete="
                                                                    forceDeleteAction(
                                                                        record.id,
                                                                    )
                                                                "
                                                            />
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
