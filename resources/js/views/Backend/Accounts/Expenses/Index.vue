<script setup>
import useModelOperations from "@/composables/model-operations.js";
import { computed, reactive, ref, watch } from "vue";
import { message } from "ant-design-vue";
import { ACTIVE, INACTIVE } from "@/enums/status-global.js";
import ButtonGroup from "@/components/table/ButtonGroup.vue";
import EditModel from "@/components/table/EditModel.vue";
import ForceDeleteModel from "@/components/table/DeleteModel.vue";
import ActiveModel from "@/components/table/EnableModel.vue";
import DeleteModel from "@/components/table/DeleteModel.vue";
import InactiveModel from "@/components/table/DisableModel.vue";
import RestoreModel from "@/components/table/RestoreModel.vue";
import VueAvatar from "@/components/VueAvatar.vue";
import {
    APPROVED,
    CANCELLED,
    PENDING,
    REJECTED,
} from "@/enums/status-appointments.js";
import StaffSelect from "@/components/staff/StaffSelect.vue";
import LeaveTypeSelect from "@/components/leaves/LeaveTypeSelect.vue";
import LeaveStatusSelect from "@/components/leaves/LeaveStatusSelect.vue";
import { dateFormat, rangePresets } from "@/utils/strings.js";
import PaymentsMethod from "@/components/pay/PaymentsMethod.vue";

const model = useModelOperations("expenses"),
    isLoading = ref(false),
    data = ref([]),
    state = reactive({
        per_page: 10,
        page: 1,
        sort: { prop: "id", order: "descending" },
        deleted: false,
        search: "",
        status: null,
        staff_id: null,
        leave_type_id: null,
        from: null,
        to: null,
        custom: [],
    }),
    resetFilters = () => {
        (state.search = ""),
            (state.status = null),
            (state.paid_by = null),
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
            message.success({ content: "Expense was successfully deleted." });
            fetchData(false);
        });
    },
    restoreAction = (id) => {
        model.restoreAction(id).then(() => {
            message.success({ content: "Expense was successfully restored." });
            fetchData(false);
        });
    },
    forceDeleteAction = (id) => {
        model.forceDeleteAction(id).then(() => {
            message.success({
                content: "Expense was successfully force deleted.",
            });
            fetchData(false);
        });
    },
    enableAction = (id) => {
        model.enableAction(id).then(() => {
            message.success({ content: `Expense was successfully ${ACTIVE}.` });
            fetchData(false);
        });
    },
    disableAction = (id) => {
        model.disableAction(id).then(() => {
            message.success({ content: `Expense was successfully ${INACTIVE}.` });
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
        title: "Purchase by",
        key: "Purchaseby",
        sorter: {},
    },
    {
        title: "Item",
        dataIndex: "item_name",
        sorter: {},
    },
    {
        title: "Purchase From",
        dataIndex: "purchase_from",
        sorter: {},
    },
    {
        title: "Paid by",
        dataIndex: "paid_by",
        sorter: {},
    },
    {
        title: "Date",
        dataIndex: "purchase_date",
        sorter: {},
    },
    {
        title: "Amount",
        dataIndex: "amount",
        sorter: {},
    },
    {
        title: "Status",
        dataIndex: "status",
        key: "status",
        filters: [
            {
                text: PENDING,
                value: PENDING,
            },
            {
                text: APPROVED,
                value: APPROVED,
            },
            {
                text: REJECTED,
                value: REJECTED,
            },
            {
                text: CANCELLED,
                value: CANCELLED,
            },
        ],
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
        class: "text-end",
    },
];
</script>


<template>
    <div class="page-wrapper">
        <div class="content">
            <!-- Page Header -->
            <breadcrumb
                title="New Expense"
                text="Expenses"
                path="/accounts/expenses/create"
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
                                            <h3>Expenses</h3>
                                            <div class="doctor-search-blk">
                                                <div
                                                    class="top-nav-search table-search-blk"
                                                >
                                                    <form>
                                                        <input
                                                            v-model="state.search"
                                                            type="text"
                                                            class="form-control"
                                                            placeholder="Search here"
                                                        />
                                                        <a class="btn"
                                                        ><img
                                                            src="../../../../assets/img/icons/search-normal.svg"
                                                            alt=""
                                                        /></a>
                                                    </form>
                                                </div>
                                                <div class="add-group">
                                                    <ButtonGroup
                                                        model="expenses"
                                                        :deleted="state.deleted"
                                                        @on-deleted="stateDeleted"
                                                        @on-fetch="fetchData(true)"
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
                                                <label>Choose Staff </label>
                                                <staff-select
                                                    v-model:value="
                                                        state.staff_id
                                                    "
                                                />
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div
                                                class="input-block local-forms"
                                            >
                                                <label>Expense Status </label>
                                                <leave-status-select
                                                    v-model:value="state.status"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div
                                                class="input-block local-forms"
                                            >
                                                <label>Paid By </label>
                                                <payments-method
                                                    v-model:value="state.paid_by"
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
                                                    :presets="rangePresets"
                                                    @change="onRangeChange"
                                                    :suffix-icon="false"
                                                    placeholder=""
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
                                        <template #bodyCell="{ column, record }">
                                            <template v-if=" column.key === 'Purchaseby' " >
                                                <div class="profile-image">
                                                    <router-link to="/profile">
                                                        <vue-avatar
                                                            v-if="record.user"
                                                            :user="record.user"
                                                        />
                                                        {{ record.user?.name }}
                                                    </router-link>
                                                </div>
                                            </template>

                                            <template v-else-if="column.key === 'status'">
                                                <div><span
                                                    class="badge"
                                                    :class="defineClassByStatus(record.status)">{{record.status}}</span>
                                                </div>
                                            </template>

                                            <template v-else-if="column.key === 'LeaveType'" >
                                                <div>
                                                    <p class="mt-3"> {{ record.leave_type.name}}
                                                    </p>
                                                </div>
                                            </template>

                                            <template v-else-if="column.key ===  'quick-access'">
                                                <div class="text-end d-flex justify-content-end align-items-center" >
                                                    <ul class="icons-list mt-3">
                                                        <template v-if=" !state.deleted " >
                                                            <active-model
                                                                v-if=" $can(`enabled expenses`) "
                                                                @on-enabled=" enableAction( record.id ) "
                                                                :title-tooltip=" APPROVED "
                                                            />
                                                            <inactive-model
                                                                v-if=" $can(`disabled expenses`) "
                                                                @on-disabled=" disableAction( record.id ) "
                                                                :title-tooltip=" REJECTED "
                                                            />
                                                        </template>
                                                    </ul>
                                                </div>
                                            </template>

                                            <template v-else-if="column.key === 'action'">
                                                <div class="text-end d-flex justify-content-end align-items-center" >
                                                    <ul class="icons-list mt-3">
                                                        <template
                                                            v-if=" !state.deleted "
                                                        >
                                                            <edit-model
                                                                :id="record.id"
                                                                model="expenses"
                                                            />
                                                            <delete-model
                                                                v-if="$can(`delete expenses`)"
                                                                @on-delete="deleteAction(record.id)"
                                                            />
                                                        </template>
                                                        <template v-if="state.deleted">
                                                            <restore-model v-if="$can(`restore expenses`)"
                                                                           @on-restore="restoreAction(record.id)"
                                                            />
                                                            <force-delete-model v-if=" $can(`force-delete expenses`)"
                                                                                @on-delete="forceDeleteAction(record.id)"
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
