<template>
    <div class="page-wrapper">
        <div class="content">
            <!-- Page Header -->
            <breadcrumb :title="title" :text="text" path="expense-reports" />
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
                                            <h3>Invoice Report</h3>
                                            <div class="doctor-search-blk">
                                                <div
                                                    class="top-nav-search table-search-blk"
                                                >
                                                    <form>
                                                        <input
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
                                                    <router-link
                                                        to="/invoice/add-invoice"
                                                        class="btn btn-primary add-pluss ms-2"
                                                        ><img
                                                            src="../../../../assets/img/icons/plus.svg"
                                                            alt=""
                                                    /></router-link>
                                                    <a
                                                        href="javascript:;"
                                                        class="btn btn-primary doctor-refresh ms-2"
                                                        ><img
                                                            src="../../../../assets/img/icons/re-fresh.svg"
                                                            alt=""
                                                    /></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="col-auto text-end float-end ms-auto download-grp"
                                    >
                                        <a href="javascript:;" class="me-2"
                                            ><img
                                                src="../../../../assets/img/icons/pdf-icon-01.svg"
                                                alt=""
                                        /></a>
                                        <a href="javascript:;" class="me-2"
                                            ><img
                                                src="../../../../assets/img/icons/pdf-icon-02.svg"
                                                alt=""
                                        /></a>
                                        <a href="javascript:;" class="me-2"
                                            ><img
                                                src="../../../../assets/img/icons/pdf-icon-03.svg"
                                                alt=""
                                        /></a>
                                        <a href="javascript:;"
                                            ><img
                                                src="../../../../assets/img/icons/pdf-icon-04.svg"
                                                alt=""
                                        /></a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Table Header -->
                            <reports-head></reports-head>

                            <div class="table-responsive">
                                <a-table
                                    class="table custom-table comman-table mb-0 datatable"
                                    :columns="columns"
                                    :data-source="data"
                                    :row-selection="{}"
                                >
                                    <template #bodyCell="{ column, record }">
                                        <template
                                            v-if="
                                                column.key === 'InvoiceNumber'
                                            "
                                        >
                                            <div>
                                                <router-link
                                                    to="/accounts/invoice-view"
                                                    >#INV-0001</router-link
                                                >
                                            </div>
                                        </template>
                                        <template
                                            v-else-if="column.key === 'Client'"
                                        >
                                            <div class="profile-image">
                                                <router-link to="/profile"
                                                    ><img
                                                        width="28"
                                                        height="28"
                                                        :src="`/src/assets/img/profiles/${record.Image}`"
                                                        class="rounded-circle m-r-5"
                                                        alt=""
                                                    />
                                                    {{
                                                        record.Client
                                                    }}</router-link
                                                >
                                            </div>
                                        </template>
                                        <template
                                            v-else-if="column.key === 'Status'"
                                        >
                                            <div class="action-label">
                                                <a
                                                    class="custom-badge status-green"
                                                    href="javascript:;"
                                                >
                                                    Paid
                                                </a>
                                            </div>
                                        </template>
                                        <template
                                            v-else-if="column.key === 'action'"
                                        >
                                            <div class="text-end">
                                                <div
                                                    class="dropdown dropdown-action"
                                                >
                                                    <a
                                                        href="javascript:;"
                                                        class="action-icon dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                        ><i
                                                            class="fa fa-ellipsis-v"
                                                        ></i
                                                    ></a>
                                                    <div
                                                        class="dropdown-menu dropdown-menu-end"
                                                    >
                                                        <router-link
                                                            class="dropdown-item"
                                                            to="/accounts/edit-expense"
                                                            ><i
                                                                class="fa-solid fa-pen-to-square m-r-5"
                                                            ></i>
                                                            Edit</router-link
                                                        >
                                                        <a
                                                            class="dropdown-item"
                                                            href="javascript:;"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#delete_patient"
                                                            ><i
                                                                class="fa fa-trash-alt m-r-5"
                                                            ></i>
                                                            Delete</a
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
</template>
<script>
import Reports_Head from "@/views/Backend/Reports/reports-head.vue";

const columns = [
    {
        title: "Invoices Number",
        dataIndex: "InvoiceNumber",
        key: "InvoiceNumber",
        sorter: {
            compare: (a, b) => {
                a = a.InvoiceNumber.toLowerCase();
                b = b.InvoiceNumber.toLowerCase();
                return a > b ? -1 : b > a ? 1 : 0;
            },
        },
    },
    {
        title: "",
        dataIndex: "Client",
        key: "Client",
        sorter: {
            compare: (a, b) => {
                a = a.Client.toLowerCase();
                b = b.Client.toLowerCase();
                return a > b ? -1 : b > a ? 1 : 0;
            },
        },
    },
    {
        title: "Created Date",
        dataIndex: "CreatedDate",
        key: "CreatedDate",
        sorter: {
            compare: (a, b) => {
                a = a.CreatedDate.toLowerCase();
                b = b.CreatedDate.toLowerCase();
                return a > b ? -1 : b > a ? 1 : 0;
            },
        },
    },
    {
        title: "Due Date",
        dataIndex: "DueDate",
        sorter: {
            compare: (a, b) => {
                a = a.DueDate.toLowerCase();
                b = b.DueDate.toLowerCase();
                return a > b ? -1 : b > a ? 1 : 0;
            },
        },
    },
    {
        title: "Amount",
        dataIndex: "Amount",
        sorter: {
            compare: (a, b) => {
                a = a.Amount.toLowerCase();
                b = b.Amount.toLowerCase();
                return a > b ? -1 : b > a ? 1 : 0;
            },
        },
    },
    {
        title: "Status",
        dataIndex: "Status",
        sorter: {
            compare: (a, b) => {
                a = a.Status.toLowerCase();
                b = b.Status.toLowerCase();
                return a > b ? -1 : b > a ? 1 : 0;
            },
        },
    },
    {
        title: "",
        key: "action",
        class: "text-end",
        sorter: true,
    },
];
const data = [
    {
        InvoiceNumber: "#INV-0001",
        Client: "Andrea Lalema",
        Image: "avatar-01.jpg",
        CreatedDate: "04.10.2022",
        DueDate: "04.10.2022",
        Amount: "$1000",
        Status: "Paid",
    },
];
export default {
    data() {
        return {
            title: "Reports",
            text: "Invoices Report",
            data,
            columns,
        };
    },
    components: {
        Reports_Head,
    },
};
</script>
