<script setup>
import useModelOperations from "@/composables/model-operations.js";
import { computed, onBeforeMount, reactive, ref, watch } from "vue";
import { ACTIVE, INACTIVE } from "@/enums/status-global.js";
import ForceDeleteModel from "@/components/table/DeleteModel.vue";
import DeleteModel from "@/components/table/DeleteModel.vue";
import RestoreModel from "@/components/table/RestoreModel.vue";
import { message } from "ant-design-vue";
import EditModel from "@/components/table/EditModel.vue";
import TagStatus from "@/components/table/TagStatus.vue";
import ButtonGroup from "@/components/table/ButtonGroup.vue";
import ActiveModel from "@/components/table/EnableModel.vue";
import InactiveModel from "@/components/table/DisableModel.vue";

const model = useModelOperations("taxes"),
    isLoading = ref(false),
    data = ref([]),
    state = reactive({
        per_page: 10,
        page: 1,
        sort: { prop: "id", order: "descending" },
        deleted: false,
        search: "",
        status: null,
    }),
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
            message.success({ content: "Tax was successfully deleted." });
            fetchData(false);
        });
    },
    restoreAction = (id) => {
        model.restoreAction(id).then(() => {
            message.success({ content: "Tax was successfully restored." });
            fetchData(false);
        });
    },
    forceDeleteAction = (id) => {
        model.forceDeleteAction(id).then(() => {
            message.success({ content: "Tax was successfully force deleted." });
            fetchData(false);
        });
    },
    enableAction = (id) => {
        model.enableAction(id).then(() => {
            message.success({ content: `Tax was successfully ${ACTIVE}.` });
            fetchData(false);
        });
    },
    disableAction = (id) => {
        model.disableAction(id).then(() => {
            message.success({ content: `Tax was successfully ${INACTIVE}.` });
            fetchData(false);
        });
    };

watch(state, () => fetchData(false), { immediate: true });

const columns = [
    {
        title: "#",
        dataIndex: "id",
        sorter: true,
    },
    {
        title: "Tax Name",
        dataIndex: "name",
        sorter: true,
    },
    {
        title: "Tax Percentage",
        dataIndex: "percentage",
        key: "percentage",
        sorter: true,
    },
    {
        title: "Status",
        dataIndex: "status",
        key: "status",
        filters: [
            {
                text: ACTIVE,
                value: ACTIVE,
            },
            {
                text: INACTIVE,
                value: INACTIVE,
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
        width: 200,
    },
];
</script>

<template>
    <div class="page-wrapper">
        <div class="content">
            <!-- Page Header -->
            <breadcrumb title="Account" text="Taxes" path="taxes/create" />
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
                                            <h3>Taxes</h3>
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
                                                            placeholder="Search here"
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
                                                        model="taxes"
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
                                                v-if="
                                                    column.key === 'percentage'
                                                "
                                            >
                                                <p>{{ record.percentage }}%</p>
                                            </template>
                                            <template
                                                v-if="column.key === 'status'"
                                            >
                                                <TagStatus
                                                    :status="record.status"
                                                />
                                            </template>

                                            <template
                                                v-else-if="
                                                    column.key ===
                                                    'quick-access'
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
                                                            <active-model
                                                                v-if="
                                                                    $can(
                                                                        `enabled taxes`,
                                                                    )
                                                                "
                                                                @on-enabled="
                                                                    enableAction(
                                                                        record.id,
                                                                    )
                                                                "
                                                            />
                                                            <inactive-model
                                                                v-if="
                                                                    $can(
                                                                        `disabled taxes`,
                                                                    )
                                                                "
                                                                @on-disabled="
                                                                    disableAction(
                                                                        record.id,
                                                                    )
                                                                "
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
                                                            <edit-model
                                                                :id="record.id"
                                                                model="taxes"
                                                            />
                                                            <delete-model
                                                                v-if="
                                                                    $can(
                                                                        `delete taxes`,
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
                                                            <restore-model
                                                                v-if="
                                                                    $can(
                                                                        `restore taxes`,
                                                                    )
                                                                "
                                                                @on-restore="
                                                                    restoreAction(
                                                                        record.id,
                                                                    )
                                                                "
                                                            />
                                                            <force-delete-model
                                                                v-if="
                                                                    $can(
                                                                        `force-delete taxes`,
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
